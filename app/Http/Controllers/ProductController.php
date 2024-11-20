<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rating;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function add_product_form()
    {
         $categories = Category::all();
        return view('applyproduct', ['categories' => $categories]);
    }
    public function create_product(CreateProductRequest $request)
    {
        $category = $request->category;
        $product_name = $request->product_name;
        $description = $request->description;
        $quantity = $request->quantity;
        $size = $request->size;
        $price = $request->price;

        $image_name = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()){
            $image = $request->file('image'); 
            $image_name = $image->hashName();//hashname is create unique name for my photo name 
            $image->move('uploads/', $image_name);
        }

        $user_id = Auth::id();

        $product = Product::create([
        //    'user_id' => $user_id,
           'category_id' => $category,
           'product_name' => $product_name ,
           'description' => $description,
           'quantity' => $quantity,
           'size' => $size,
           'image' => $image_name,
           'price' => $price,
           'stock' => $quantity // Initialize stock with the same value as quantity
        ]);
        
        return redirect('home')->with('message', "Product Add Successfully!");
    }

    public function single_product($id)
    {
        $product = Product::find($id);
        $ratings = Rating::where('product_id', $id)->with('user')->get();
        return view ('singleproduct', ['product' => $product, 'ratings' => $ratings]);
    }


   
    
    public function showProducts(Request $request)
    {
        // Get search query, category filter, and price range from request
        $query = $request->input('query');
        $categoryId = $request->input('category');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
    
        // Initialize the products query builder
        $productsQuery = Product::query();
    
        // Apply search filter if query is provided
        if ($query) {
            $productsQuery->where('product_name', 'LIKE', "%{$query}%")
                ->orWhereHas('category', function ($q) use ($query) {
                    $q->where('product_title', 'LIKE', "%{$query}%");
                });
        }
    
        // Apply category filter if category is selected
        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
        }
    
        // Apply price filter if min and/or max price are provided
        if ($minPrice !== null && $maxPrice !== null) {
            $productsQuery->whereBetween('price', [$minPrice, $maxPrice]);
        } elseif ($minPrice !== null) {
            $productsQuery->where('price', '>=', $minPrice);
        } elseif ($maxPrice !== null) {
            $productsQuery->where('price', '<=', $maxPrice);
        }
    
        // Get the filtered or full list of products
        $products = $productsQuery->get();
    
        // Get all categories to display in the dropdown filter
        $categories = Category::all();
    
        return view('showproduct', compact('products', 'categories'));
    }
    
    }


//     public function search(Request $request)
//             {
//                 $query = $request->input('query');

//                 // Perform the search query across product name and description
//                 $products = Product::where('name', 'LIKE', "%{$query}%")
//                                     ->orWhere('description', 'LIKE', "%{$query}%")
//                                     ->orWhereHas('category', function ($q) use ($query) {
//                                         $q->where('name', 'LIKE', "%{$query}%");
//                                     })
//                                     ->get();

//                 // Return a view with the search results
//                 return view('search-results', compact('products'));
//             }




