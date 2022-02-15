<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;
use Validator;

class ProductsController extends BaseController
{
    public function index()
    {
        $products = DB::table('products')
            ->join('ingredients', 'ingredient_id', '=', 'ingredients.id')
            ->select('name', 'price', 'raw_material', 'manufacture_date')
            ->get();
        return $this->sendResponse($products, "Products successfully fetched.");
    }
    public function show($id)
    {
        $product = DB::table('products')
            ->join('ingredients', 'ingredient_id', '=', 'ingredients.id')
            ->select('name', 'price', 'raw_material', 'manufacture_date')
            ->where('products.id', '=', $id)
            ->get();
        return $this->sendResponse($product, "Product successfully fetched.");
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'ingredient_id' => 'required',
            'manufacture_date' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError("Error validation", $validator->errors(), 403);
        }
        $product = Product::create($request->all());
        return $this->sendResponse($product, 'Product successfully created.');
    }
    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            $product->update($request->all());
            return $this->sendResponse($product, 'Product successfully updated.');
        } catch (\Throwable $th) {
            return $this->sendError("Error in updating of product", $th, 403);
        }
    }
    public function delete($id)
    {
        $product = Product::destroy($id);
        return $this->sendResponse($product, "Product successfully deleted.");
    }
    public function search($material)
    {
        $products = DB::table('products')
            ->join('ingredients', 'ingredient_id', '=', 'ingredients.id')
            ->select('name', 'price', 'raw_material', 'manufacture_date')
            ->where("raw_material", "like", "%" . $material . "%")
            ->get();
        return $this->sendResponse($products, "Searched product(s) successfully fetched.");
    }
}
