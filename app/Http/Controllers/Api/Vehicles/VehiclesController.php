<?php

namespace App\Http\Controllers\Api\Vehicles;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Models\VehicleType;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class VehiclesController extends Controller
{
    //All Vehicle Types

    public function getVehicleTypes()
    {
       $vehicleTypes = VehicleType::get();
        return Response::json([
            'status'  => 200,
            'message' => 'all vehicle types',
            'data'=>$vehicleTypes
        ], 200);
    }

    //Add new Vehicle Type
    public function addNewVehicleType(Request $request)
    {
        try {
            $name = $request->get('name');
            if(!$name){
                return Response::json([
                    'status'  => 400,
                    'message' => 'Vehicle Type name is required',
                ], 400);
            }
            $checkName = VehicleType::where('name',$name);
            if($checkName->exists()){
                return Response::json([
                    'status'  => 400,
                    'message' => 'Vehicle Type with such name exists',
                ], 400);
            }
            $newVehicleType = [
                'id'=>Str::uuid()->toString(),
                'name'=>$name,
                'created_at'=>now(),
                'updated_at'=>now()
            ];
            VehicleType::insert($newVehicleType);
            return Response::json([
                'status'  => 200,
                'message' => 'New Vehicle Type inserted successfully',
                'data'=>$newVehicleType
            ], 200);
        } catch (\Throwable $th) {
           DB::rollback();
           return Response::json([
            'status'  => 500,
            'message' => 'an error occured..please try again',
        ], 500);
        }
    }

    //Single Vehicle Type
    public function getSingleVehicleType($type)
    {
        $singleVehicleType = VehicleType::find($type);
        if(!$singleVehicleType){
            return Response::json([
                'status'  => 404,
                'message' => 'Vehicle Type not found',
            ], 404);
        }
        return Response::json([
            'status'  => 200,
            'message' => 'single vehicle type with details',
            'data'=>[
                'type'=>$singleVehicleType,
                'categories_count'=>$singleVehicleType->categories()->count(),
                'vehicles_count'=>$singleVehicleType->vehicles()->count()    
            ]
        ], 200);
    }
    //get Vehicle Type Categories
    public function getSingleVehicleTypeCategories($type)
    {
        $singleVehicleType = VehicleType::find($type);
        if(!$singleVehicleType){
            return Response::json([
                'status'  => 404,
                'message' => 'Vehicle Type not found',
            ], 404);
        }
        return Response::json([
            'status'  => 200,
            'message' => 'single vehicle type with its categories',
            'data'=>[
                'type'=>$singleVehicleType,
                'categories'=>$singleVehicleType->categories()->get(),  
            ]
        ], 200);
    }
    //create New Category under a type
    public function createNewVehicheTypeCategory(Request $request , $type)
    {
        try {
            $name = $request->get('name');
            if(!$name){
                return Response::json([
                    'status'  => 400,
                    'message' => 'Vehicle Category name is required',
                ], 400);
            }
            $singleVehicleType = VehicleType::find($type);
            if(!$singleVehicleType){
                return Response::json([
                    'status'  => 404,
                    'message' => 'Vehicle Type not found',
                ], 404);
            }
            $checkName = VehicleCategory::where('name',$name)
            ->where('type_id',$type);
            if($checkName->exists()){
                return Response::json([
                    'status'  => 400,
                    'message' => 'Vehicle Category with such name exists under '.$singleVehicleType->name. ' type',
                ], 400);
            }
            $newVehicleCategory = [
                'id'=>Str::uuid()->toString(),
                'type_id'=>$type,
                'name'=>$name,
                'created_at'=>now(),
                'updated_at'=>now()
            ];
            VehicleCategory::insert($newVehicleCategory);
            return Response::json([
                'status'  => 200,
                'message' => 'New Vehicle Category inserted  under '.$singleVehicleType->name. ' type successfully',
                'data'=>$newVehicleCategory
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return Response::json([
             'status'  => 500,
             'message' => 'an error occured..please try again',
         ], 500);
        }
    }

    //View Vehicles
    public function getSingleCategoryVehicles($type, $category)
    {
        $singleVehicleType = VehicleType::find($type);
        if(!$singleVehicleType){
            return Response::json([
                'status'  => 404,
                'message' => 'Vehicle Type not found',
            ], 404);
        }
        $singleVehicleCategory = VehicleCategory::find($category);
        if(!$singleVehicleCategory){
            return Response::json([
                'status'  => 404,
                'message' => 'Vehicle Category not found',
            ], 404);
        }
        $vehicles = Vehicle::where('type_id',$type)
        ->where('category_id',$category)
        ->get();
        return Response::json([
            'status'  => 200,
            'message' => 'Vehicles',
            'data'=>$vehicles
        ], 200);
    }

    public function addNewVehicle($type,$category,Request $request)
    {
        try {
            $singleVehicleType = VehicleType::find($type);
            if(!$singleVehicleType){
                return Response::json([
                    'status'  => 404,
                    'message' => 'Vehicle Type not found',
                ], 404);
            }
            $singleVehicleCategory = VehicleCategory::find($category);
            if(!$singleVehicleCategory){
                return Response::json([
                    'status'  => 404,
                    'message' => 'Vehicle Category not found',
                ], 404);
            }
            $data = $request->all();
            $checkPlateNo = Vehicle::where('type_id',$type)
            ->where('category_id',$category)
            ->where('plate_no',$data['plate_no'])
            if($checkPlateNo->exists())
            {
                return Response::json([
                    'status'  => 404,
                    'message' => 'plate number provided exists in this category',
                ], 404);
            }
            $newVehicle = [
                'id'=>Str::uuid()->toString(),
                'type_id'=>$type,
                'category_id'=>$category,
                'department_id'=>$data['department'];
                'driver_id'=>$data['driver'] ? $data['driver']:"",
                'brand'=>$data['brand'],
                'model'=>$data['model'],
                'plate_no'=>$data['plate_no'],
                'acquisition_date'=>$data['acquisition_date'],
                'is_assured'=>$data['is_assured']
            ];
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    //View Drivers
    public function getAllDrivers()
    {
        $allDrivers = Driver::get();
        return Response::json([
            'status'  => 200,
            'message' => 'all drivers available',
            'data'=>$allDrivers
        ], 200);
    }
    //add new driver

    public function addNewDriver(Request $request)
    {
        try {
            $names = $request->get('names');
            if(!$names){
                return Response::json([
                    'status'  => 400,
                    'message' => 'driver names are required',
                ], 400);
            }
            $newDriver = [
                'id'=>Str::uuid()->toString(),
                'names'=>$names,
                'created_at'=>now(),
                'updated_at'=>now()
            ];
            Driver::insert($newDriver);
            return Response::json([
                'status'  => 200,
                'message' => 'New Driver inserted successfully',
                'data'=>$newDriver
            ], 200);

        } catch (\Throwable $th) {
            DB::rollback();
            return Response::json([
             'status'  => 500,
             'message' => 'an error occured..please try again',
         ], 500);
        }
    }

}
