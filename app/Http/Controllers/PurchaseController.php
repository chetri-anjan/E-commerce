<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Rating;
use Illuminate\Support\Facades\Mail; // Import the Mail facade
use App\Mail\WelcomeEmail;

use App\Http\Requests\AddressRequest;
class PurchaseController extends Controller
{
    public function add_address_form()
    {
        $countries = Country::all();
        return view('address', ['countries' => $countries]);
    }   

    public function create_address_form(AddressRequest $request)
    {
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $postal_code = $request->postal_code;
        $street_no = $request->street_no;
        $house_no = $request->house_no;
        $location = $request->location;

        $duplicate_address = Address::where('user_id', Auth::id())->where('location', $request->location)->get();
        if(count($duplicate_address)>0)
        {
            return redirect()->back()->with('message', "This address already exists in the selected location.");
        }

        $user_id = Auth::id();
        $address = Address::create([
           'user_id' => $user_id,
           'country' => $country,
           'state' => $state,
           'city' => $city,
           'postal_code' => $postal_code,
           'street_no' => $street_no,
           'house_no' => $house_no,
           'location' => $location
        ]);

        // if ($addresses->isEmpty()) {
        //     return redirect()->back()->with('error', 'Please add an address before placing an order.');
        // }        
        return back()->with('message', "Address Add Successfully!");
    }
    
    // Display cart items
    public function index()
        {
            $user = Auth::user();
            $cartItems = $user->carts()->with('product')->get();

            return view('cart', compact('cartItems'));
        }

    // Add item to cart
    public function add(Request $request)
        {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        // Check if the product already exists in the cart
        $existingCartItem = $user->carts()->where('product_id', $request->product_id)->first();
    
        if ($existingCartItem) {
            // If item already exists, return with an error message
            return redirect()->route('cart.index')->with('error', 'This item is already in your cart.');
        }
    
        // Add item to the cart if it doesn't exist
        $user->carts()->create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);

            return redirect()->route('cart.index')->with('success', 'Item added to cart.');
        }


    //delete item from cart
        public function delete(Request $request, $id)
        {
            $user = Auth::user();
            $cartItem = $user->carts()->where('product_id', $id)->first();

            if ($cartItem) {
                $cartItem->delete();
                return redirect()->route('cart.index')->with('success', 'Item deleted from cart.');
            }

            return redirect()->route('cart.index')->with('error', 'Item not found in cart.');
        }


        //Buy now
        // public function productbuy($id)
        // {
        //     $product = Product::find($id);
        //     // $shippingCharge = 150; 
        //     $user = auth()->user();
        //     $addresses = Address::where('user_id', $user->id)->get();
        //     return view('buynow', ['product'=> $product, 'addresses' => $addresses] );
        // }


        public function productbuy(Request $request, $id)
        {
            $product = Product::find($id);
            $user = auth()->user();
            $addresses = Address::where('user_id', $user->id)->get();
            $shippingCharge = 500;
            $countries = Country::get();
            $quantity = $request->quantity;

            // Default to Nepal if no country is selected
            $selectedCountry = $request->input('country_name', 'Nepal'); 

             // Retrieve the selected currency from the request
                        $selectedCurrency = $request->input('currency', 'NPR'); // Default to NPR if no currency is selected

                        // Define conversion rates (example rates; replace with real-time rates in production)
                        $conversionRates = [
                            'USD'=> 0.0076,
                            'GBP'=> 0.0061,
                            'CAD'=> 0.010,
                            'NPR'=> 1.00,
                            'EUR'=> 0.0072,
                        ];

                        // Convert the total payment to the selected currency
                        $priceInSelectedCurrency = $product->price * $conversionRates[$selectedCurrency];
                        $totalpayment = ($priceInSelectedCurrency * $quantity) + $shippingCharge;
        
            
            return view('buynow', compact('product', 'addresses', 'countries', 'shippingCharge', 'totalpayment', 'selectedCurrency', 'selectedCountry')); // Pass the ratings to the view
        }

        public function showProduct($id)
        {
            $product = Product::findOrFail($id); // Retrieve the product by its ID
            $user = auth()->user();
            $addresses = Address::where('user_id', $user->id)->get();
            return view('product.show', compact('product', 'addresses')); // Pass the ratings to the view
        }

    
        public function checkout(Request $request, $id)
        {
            // Validation rules
            $rules = [
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
                'delivery_date' => 'required|date',
                'payment_method' => 'required|string|in:stripe,cod',
                'currency' => 'required|string',
            ];
        
            if ($request->input('use_alternative_address')) {
                $rules['alt_house_no'] = 'required|string';
                $rules['alt_street_no'] = 'required|string';
                $rules['alt_city'] = 'required|string';
                $rules['alt_state'] = 'required|string';
                $rules['alt_currency'] = 'required|string';
                $rules['alt_postal_code'] = 'required|string';
            } else {
                $rules['delivery_address'] = 'required|integer|exists:addresses,id';
            }
        
            $request->validate($rules);
        
            $product = Product::find($id);
            $delivery_fee = $request->delivery_fee;
            //  dd($delivery_fee);
            if (!$product) {
                return redirect()->back()->withErrors(['product_id' => 'Invalid product selected.']);
            }
        
            if ($product->stock < $request->quantity) {
                return redirect()->back()->withErrors(['quantity' => 'Not enough stock available.']);
            }
        
            $product->stock -= $request->quantity;
            $product->save();
        
            $user = auth()->user();
            $addresses = Address::where('user_id', $user->id)->get();
        
            if (!$request->input('use_alternative_address') && $addresses->isEmpty()) {
                return redirect()->back()->withErrors(['delivery_address' => 'You do not have a delivery address. Please add an address before placing the order.']);
            }
        
            if ($request->input('use_alternative_address')) {
                $address =  $request->input('alt_name') . ', ' .
                    $request->input('alt_currency') . ', ' .
                    $request->input('alt_state') . ', ' .
                    $request->input('alt_city') . ', ' .
                    $request->input('alt_postal_code') . ', ' .
                    $request->input('alt_street_no') . ', ' .
                    $request->input('alt_house_no');
            } else {
                $address = $request->input('delivery_address');
            }

            $selectedCurrency = $request->input('currency');
            $conversionRates = [
                'USD'=> 0.0076,
                'GBP'=> 0.0061,
                'CAD'=> 0.010,
                'NPR'=> 1.00,
                'EUR'=> 0.0072,
            ];
            
            // $shippingCharge = $delivery_fee;

            $priceInSelectedCurrency = $product->price * $conversionRates[$selectedCurrency];
            $totalpayment = ($priceInSelectedCurrency * $request->quantity) + $delivery_fee;
            
            $totalpayment = intval($totalpayment * 100);
            $delivery_fee = intval($delivery_fee * 100);
            $unitAmount = intval($priceInSelectedCurrency * 100);
                    
            //$totalpayment = ($product->price * $request->quantity) + $shippingCharge;
           // $unitAmount = intval($totalpayment * 100);
            $pointsEarned = floor($totalpayment / 1000);
        
            $purchase = Purchase::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'delivery_date' => $request->delivery_date,
                'delivery_address' => $address,
                'payment_method' => $request->payment_method,
                'total_payment' => $totalpayment,
                'points_earned' => $pointsEarned,
            ]);

            // dd($totalpayment, $selectedCurrency);
        
            $user->points += $pointsEarned;
            $user->save();

           

             // Get selected country from the address
                    // $selectedCountry = $request->input('country_name');

                    // if ($request->payment_method == 'cod' && $selectedCountry !== 'Nepal') {
                    //     return redirect()->back()->withErrors(['payment_method' => 'Cash on Delivery is only available in Nepal.']);
                    // }
        
            if ($request->payment_method === 'cod') {

                  // Send email on COD order
                    $userEmail = $user->email;
                    $message = "Your order has been successfully placed with Cash on Delivery. Order details: Product - {$product->product_name}, Quantity - {$request->quantity}, Total Payment - {$totalpayment} {$selectedCurrency}.";
                    $subject = "Order Confirmation";

                    // Send email
                    Mail::to($userEmail)->send(new WelcomeEmail($message, $subject));


                return redirect()->route('home')->with('message', 'Order placed successfully with Cash on Delivery.');
            } else {
                \Stripe\Stripe::setApiKey(config('stripe.sk'));

                $session = \Stripe\Checkout\Session::create([
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => strtolower($selectedCurrency),
                                'product_data' => [
                                    'name' => $product->product_name,
                                ],
                                'unit_amount' => $unitAmount,
                            ],
                            'quantity' => $request->quantity,
                        ],
                        [
                            'price_data' => [
                                'currency' => strtolower($selectedCurrency),
                                'product_data' => [
                                    'name' => 'Shipping Cost',
                                ],
                                'unit_amount' => $delivery_fee,  // Shipping price in the smallest currency unit (e.g., cents for USD)
                            ],
                            'quantity' => 1,  // Shipping is typically a one-time fee
                        ],
                    ],
                    'mode' => 'payment',
                    'success_url' => route('payment.success', ['purchase' => $purchase->id]),
                    //'cancel_url' => route('buyproduct', $id),
                ]);
                
                return redirect()->away($session->url);
                
            }
        }   
        
      public function paymentSuccess(Purchase $purchase)
     {              

                        $user = $purchase->user;
                        $product = $purchase->product; // Make sure you have a relationship set up in the Purchase model
                        $userEmail = $user->email;
                        $productName = $product->product_name; // Access product details
                        $quantity = $purchase->quantity;
                        $totalPayment = $purchase->total_payment;
                        $selectedCurrency = $purchase->currency; // Assuming you stor
                    
                    // Retrieve user email
                    $userEmail = $purchase->user->email;
                    
                
                    // Prepare email data
                    $message = "Your order has been successfully placed. Order details: Product - {$productName}, Quantity - {$quantity}";
                    $subject = "Order Confirmation";

                
                    // Send email
                    Mail::to($userEmail)->send(new WelcomeEmail($message, $subject));
                            
                    // Redirect to a thank you page or home
                    return redirect()->route('home')->with('message', 'Payment successful! A confirmation email has been sent.');
     }
        
    //     public function paymentSuccess(Purchase $purchase)
    // {
    //     // Retrieve user email
    //     $userEmail = $purchase->user->email;

    //     // dd($userEmail);
    //     // Prepare email data
    //     $message = "Your order has been successfully placed.";
    //     $subject = "Order Confirmation";

    //     // Debugging: Log the email sending attempt
    //     \Log::info('Attempting to send email to ' . $userEmail);

    //     try {
    //         // Send email
    //         Mail::to($userEmail)->send(new WelcomeEmail($message, $subject));

    //         // Debugging: Log the success of the email sending
    //         \Log::info('Email sent successfully to ' . $userEmail);

    //         // Redirect to a thank you page or home with success message
    //         return redirect()->route('home')->with('message', 'Payment successful! A confirmation email has been sent.');
    //     } 
    //     catch (\Exception $e) {
    //         // Log the full exception for debugging
    //         \Log::error('Mail sending failed: ' . $e->getMessage(), ['exception' => $e]);
        
    //         // Redirect with an error message if the email fails to send
    //         return redirect()->route('home')->with('error', 'Payment successful, but we could not send a confirmation email.');
    //     }
        
    // }



        //show all purchase items (named as Order)
        public function showallorders()//company user ko applications check garni
            {
                    $orders = Purchase::all();
                    return view('order', ['orders' => $orders]); // Pass an empty collection
                    
            }


            // public function showBillingDetails(Request $request, $id)
            // {
            //     $user = auth()->user(); // Assuming the user is authenticated
            //     $quantity = $request->quantity;
            //     $product= $product->product_name;
            //     $totalpayment= $request->totalpayment;
            //     $selectedCurrency= $request->selectedCurrency; // Replace with actual currency
            
            //     return view('billing', compact('user', 'quantity', 'product', 'totalpayment', 'selectedCurrency'));
            // }
            

            public function destroy($id)
            {
                // Fetch the purchase record
                $purchase = Purchase::findOrFail($id);
            
                // Check if the authenticated user is the owner of the purchase
                if ($purchase->user_id !== Auth::id()) {
                    return redirect()->route('userpanel')->with('error', 'Unauthorized action.');
                }
            
                // Delete the purchase
                $purchase->delete();
            
                // Redirect back with a success message
                return redirect()->route('userpanel')->with('success', 'Product removed successfully.');
            }
            

            public function edit($id)
            {
                $order = Purchase::find($id); // Assuming Purchase is your model for the orders
                return view('updateOrder', compact('order'));
            }
            
            public function update(Request $request)
            {
                // $validated = $request->validate([
                //     'order_id' => 'exists:purchases,id', 
                //     'consignment_number' => 'null|string',
                //     'courier_service' => 'null| string',
                //     'order_status' => 'null | string|in:shipping,delivered',
                //     'courier_office' => 'null | string',
                // ]);


                

                if($request->order_status === 'shipping'){
                $order = Purchase::find($request->order_id);
                $order->consignment_number = $request->consignment_number;
                $order->courier_service = $request->courier_service;
                $order->status = $request->order_status;
                $order->courier_office = $request->courier_office;
                $order->save();

                 // Retrieve user email
                 $userEmail = $order->user->email;
                    
                
                 // Prepare email data
                 $message = "Your order has been successfully shipping. Order details: Product - {$order->product->product_name}, Quantity - {$order->quantity}.";
                 $subject = "Order Shipping";

             
                 // Send email
                 Mail::to($userEmail)->send(new WelcomeEmail($message, $subject));

                }


                if($request->order_status === 'delivered'){
                    $order = Purchase::find($request->order_id);

                    $order->status = $request->order_status;
                    $order->save();


                    // Retrieve user email
                 $userEmail = $order->user->email;
                    
                
                 // Prepare email data
                 $message = "Your order has been successfully Delivered. Order details: Product - {$order->product->product_name}, Quantity - {$order->quantity}.";
                 $subject = "Order Delivered";

             
                 // Send email
                 Mail::to($userEmail)->send(new WelcomeEmail($message, $subject));

                }
            
                return redirect()->route('adminpanel')->with('success', 'Order updated successfully.');
            }
            
                







           
            
}

