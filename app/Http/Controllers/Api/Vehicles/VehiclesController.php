<?php

namespace App\Http\Controllers\Api\Vehicles;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Models\VehicleTax;
use App\Models\VehicleType;
use App\Models\Department;
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

    public function viewSingleCategory($type, $category)
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
        return Response::json([
            'status'  => 200,
            'message' => 'Single Category',
            'data'=>[
                'category'=>$singleVehicleCategory,
                'vehicles_count'=>$singleVehicleCategory->vehicles()->count()
            ]
        ], 200);
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
            ->where('plate_no',$data['plate_no']);
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
                'department_id'=>$data['department'],
                'driver_id'=>$data['driver'] ? $data['driver']:"",
                'brand'=>$data['brand'],
                'model'=>$data['model'],
                'plate_no'=>$data['plate_no'],
                'acquisition_date'=>$data['acquisition_date'],
                'is_assured'=>false,
                'created_at'=>now(),
                'updated_at'=>now()
            ];
            Vehicle::insert($newVehicle);
            return Response::json([
                'status'  => 200,
                'message' => 'New Vehicle inserted successfully',
                'data'=>$newVehicle
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return Response::json([
             'status'  => 500,
             'message' => 'an error occured..please try again',
         ], 500);
        }
    }
    public function viewSingleVehicle($type,$category ,$vehicle)
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
        $singleVehicle = Vehicle::with('department')
        ->with('type')
        ->with('category')
        ->find($vehicle);
        if(!$singleVehicle){
            return Response::json([
                'status'  => 404,
                'message' => 'Vehicle  not found',
            ], 404);
        }
        return Response::json([
            'status'  => 200,
            'message' => 'Single Vehicle',
            'data'=>[
                'vehicle'=>$singleVehicle,
                'taxes'=>$singleVehicle->taxes()->count(),
                'assurance'=>$singleVehicle->is_assured? "Has Assurance":"Assurance Expired"
            ]
        ], 200);
        
    }
    public function viewVehicleTaxes($type,$category ,$vehicle)
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
        $singleVehicle = Vehicle::with('department')
        ->with('type')
        ->with('category')
        ->find($vehicle);
        if(!$singleVehicle){
            return Response::json([
                'status'  => 404,
                'message' => 'Vehicle  not found',
            ], 404);
        }
        $vehicleTaxes = VehicleTax::where('vehicle_id',$vehicle)->get();
        return Response::json([
            'status'  => 200,
            'message' => 'Vehicle Taxes',
            'data'=>$vehicleTaxes
        ], 200);
    }
    public function addNewVehicleTax($type,$category ,$vehicle , Request $request)
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
            $singleVehicle = Vehicle::with('department')
            ->with('type')
            ->with('category')
            ->find($vehicle);
            if(!$singleVehicle){
                return Response::json([
                    'status'  => 404,
                    'message' => 'Vehicle  not found',
                ], 404);
            }
            $amount = $request->get('amount');
            $from = $request->get('from');
            $to = $request->get('to');
            if(!$amount || !$from || !$to){
                return Response::json([
                    'status'  => 400,
                    'message' => 'Please fill all fields',
                ], 400);
            }
            $newTax = [
                'id'=>Str::uuid()->toString(),
                'vehicle_id'=>$vehicle,
                'amount'=>$amount,
                'from'=>$from,
                'to'=>$to
            ];
            VehicleTax::insert($newTax);
            return Response::json([
                'status'  => 200,
                'message' => 'New Tax inserted successfully',
                'data'=>$newTax
            ], 200);
            
        } catch (\Throwable $th) {
            DB::rollback();
            return Response::json([
             'status'  => 500,
             'message' => 'an error occured..please try again',
         ], 500);
        }
    }
    public function assignDriverToVehicle($type,$category ,$vehicle , Request $request)
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
        $singleVehicle = Vehicle::with('department')
        ->with('type')
        ->with('category')
        ->find($vehicle);
        if(!$singleVehicle){
            return Response::json([
                'status'  => 404,
                'message' => 'Vehicle  not found',
            ], 404);
        }
        $driverId = $request->get('driver');
        if(!$driverId){
            return Response::json([
                'status'  => 400,
                'message' => 'provide the driver',
            ], 400); 
        }
        $driver = Driver::find($driverId);
        if(!$driver){
            return Response::json([
                'status'  => 404,
                'message' => 'driver not found',
            ], 404);
        }
        if($driver->is_occupied){
            return Response::json([
                'status'  => 400,
                'message' => 'this driver is occupied..please select another',
            ], 400);
        }
        $vehicleToUpdate = Vehicle::find($vehicle)->update([
            'driver_id'=>$driverId
        ]);
        $driver->update([
            'is_occupied'=>true
        ]);
        return Response::json([
            'status'  => 200,
            'message' => 'Driver assigned to vehicle successfully',
        ], 200);

       } catch (\Throwable $th) {
            DB::rollback();
            return Response::json([
            'status'  => 500,
            'message' => 'an error occured..please try again',
        ], 500);
       }
    }
    public function detachDriverToVehicle($type,$category ,$vehicle , Request $request)
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
            $singleVehicle = Vehicle::with('department')
            ->with('type')
            ->with('category')
            ->find($vehicle);
            if(!$singleVehicle){
                return Response::json([
                    'status'  => 404,
                    'message' => 'Vehicle  not found',
                ], 404);
            }
            $driver = Driver::find($singleVehicle->driver_id);
            Vehicle::find($vehicle)->update([
                'driver_id'=>""
            ]);
            $driver->update([
                'is_occupied'=>false
            ]);
            return Response::json([
                'status'  => 200,
                'message' => 'Driver detached to vehicle successfully',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return Response::json([
            'status'  => 500,
            'message' => 'an error occured..please try again',
        ], 500);
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
    //View Free Drivers
    public function getAllFreeDrivers()
    {
        $allFreeDrivers = Driver::where('is_occupied',false)->get();
        return Response::json([
            'status'  => 200,
            'message' => 'all free drivers available',
            'data'=>$allFreeDrivers
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

    public function getAllDepartments()
    {
        $allDepartments = Department::get();
        return Response::json([
            'status'  => 200,
            'message' => 'all departments available',
            'data'=>$allDepartments
        ], 200);
    }

}
