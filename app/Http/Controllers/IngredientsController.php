<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use Validator;

class IngredientsController extends BaseController
{
    public function index()
    {
        $ingredients = Ingredient::all();
        return $this->sendResponse($ingredients, "Ingredients successfully fetched.");
    }
    public function show($id)
    {
        $ingredient = Ingredient::find($id);
        return $this->sendResponse($ingredient, "Ingredient successfully fetched.");
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'raw_material' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError("Error validation", $validator->errors(), 403);
        }
        $ingredient = Ingredient::create($request->all());
        return $this->sendResponse($ingredient, 'Ingredient successfully created.');
    }
    public function update(Request $request, $id)
    {
        try {
            $ingredient = Ingredient::find($id);
            $ingredient->update($request->all());
            return $this->sendResponse($ingredient, 'Ingredient successfully updated.');
        } catch (\Throwable $th) {
            return $this->sendError("Error in updating of ingredient", $th, 403);
        }
    }
    public function delete($id)
    {
        $ingredient = Ingredient::destroy($id);
        return $this->sendResponse($ingredient, "Ingredient successfully deleted.");
    }
    public function search($material)
    {
        $ingredient = Ingredient::where("raw_material", "like", "%" . $material . "%")->get();
        return $this->sendResponse($ingredient, "Searched ingredient(s) successfully fetched.");
    }
}
