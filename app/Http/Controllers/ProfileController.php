<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use  App\Models\Cart;
use  App\Models\Purchase;
use  App\Models\Address;
use  App\Models\User;
use  App\Models\Category;
use  App\Models\Product;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }




    public function showProfile()
            {
                $user = Auth::user();
                $purchases = Purchase::where('user_id', $user->id)->with('product')->get();
                $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
                $addresses = Address::where('user_id', $user->id)->get();

                return view('userpanel', compact('purchases', 'cartItems', 'addresses'));
            }
    
    public function showAllUsers()
        {
            // Fetch all users from the database
                    $users = User::all();
                    $categories = Category::all();
                    $products = Product::all();
                    $orders = Purchase::with(['user', 'product'])->get();

                // Fetch total counts
                    $totalUsers = User::count();
                    $totalCategories = Category::count();
                    $totalProducts = Product::count();
                    $totalOrders = Purchase::count();

                    // dd($totalUsers, $totalCategories, $totalProducts, $totalOrders);
                
                            
                // Pass users to the Blade view
            return view('adminpanel', compact('users', 'categories', 'products', 'orders', 'totalUsers', 'totalCategories', 'totalProducts', 'totalOrders'));
        }
        
}
