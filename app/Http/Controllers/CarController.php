<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{

    public function index()
    {
        $cars = CarResource::collection(Car::all());
        return response()->json(['cars' => $cars], 200);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required|exists:brands,id',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'price_per_day' => 'required|numeric',
            'is_available' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $car = Car::create($validator->validated());
        return response()->json(['message' => 'Car successfully created!'], 200);
    }

    public function update(Request $request, Car $car)
    {
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required|exists:brands,id',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'price_per_day' => 'required|numeric',
            'is_available' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $car->update($validator->validated());
        return response()->json(['message' => 'Car successfully updated!'], 200);
    }

    public function destroy($id)
    {
        $car = Car::find($id);
        $car->delete();
        return response()->json(['message' => 'Car successfully deleted!'], 200);
    }

    public function findByBrand(Request $request)
    {
        $brandId = $request->brand_id;

        if (!$brandId) {
            return response()->json(['message' => 'Brand ID is required!'], 422);
        }

        $cars = Car::where('brand_id', $brandId)->get();

        return response()->json(['cars' => CarResource::collection($cars)], 200);
    }

    public function paginacija(Request $request)
    {
        $perPage = $request->per_page ?? 2;

        $cars = Car::paginate($perPage);

        return response()->json(['cars' => $cars], 200);
    }
}
