<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function showProducts(Request $request)
    {
        $perPage = $request->input('per_page', 16);
        $query = Product::query();

        $searchTerm = $request->input('search');

        // Apply search filter if query present
        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('Product_Name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('Description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Apply filters
        if ($request->filter_by_category != null || $request->filter_by_stock != null) {
            $query->where('Category_ID', $request->filter_by_category ?? 0)
                ->where('Amount', '>=', $request->filter_by_stock ?? 0);
        }

        // Apply sorting
        if ($request->get('sort') == 'price_ascending') {
            $query->orderBy('Product_Price', 'asc');
        } elseif ($request->get('sort') == 'price_descending') {
            $query->orderBy('Product_Price', 'desc');
        } elseif ($request->get('sort') == 'prod_cat') {
            $query->orderBy('Category_ID', 'asc');
        } elseif ($request->get('sort') == 'popularity') {
            $query->orderBy('Amount', 'asc');
        }

        $products = $query->paginate($perPage);

        // Add sort parameter to pagination links
        $products->appends([
            'search' => $searchTerm,
            'sort' => $request->get('sort'),
        ]);

        return view('product', ['products' => $products, 'searchTerm' => $searchTerm]);
    }

    public function aProduct($Product_ID)
    {
        $aProduct = Product::where('Product_ID', $Product_ID)->first();
        return view('item', ['item' => $aProduct]);
    }

    public function search()
    {
        $search = $_GET['search'];
        if (!empty($search)) {
            $product = Product::where('Product_Name', 'LIKE', '%' . $search . '%')
                ->orWhere('Description', 'LIKE', '%' . $search . '%')
                ->get();
            return view('/search', compact('product'));
        } else {
            return redirect('/product');
        }
    }
}