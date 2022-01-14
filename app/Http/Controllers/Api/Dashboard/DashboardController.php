<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\VehicleCategory;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\Department;
use App\Models\Driver;

class DashboardController extends Controller
{
    public function getDashboardOverview()
    {
        $cardsData = [];
        $chartsData = [];
        $data = [];
        $departments = Department::get();
        $insuredVehicles = Vehicle::where('is_assured',true)->count();
        $latestAddedData = [];
        $latestAddedVehicles = Vehicle::latest()->limit('4')->get();
        $latestVehicles = [];
        $taxedVehicles = Vehicle::where('is_taxed',true)->count();
        $totalCategories = VehicleCategory::count();
        $totalDrivers = Driver::count();
        $totalVehicles = Vehicle::count();
        $uninsuredVehicles = Vehicle::where('is_assured',false)->count();
        $unTaxedVehicles = Vehicle::where('is_taxed',false)->count();
        $vehiclesPerDepartment= [];
        $vehiclesPerInsurance = [];
        $vehiclesPerTax = [];
        $vehiclesPerType = [];
        $vehicleTypes = VehicleType::get();
        foreach($latestAddedVehicles as $vehicle){
            $latestVehicles[] = [
                'type'=>$vehicle->type->name,
                'category'=>$vehicle->category->name,
                'department'=>$vehicle->department->name,
                'brand'=>$vehicle->brand,
                'model'=>$vehicle->model,
                'plate_no'=>$vehicle->plate_no,
            ];
        }
        foreach($vehicleTypes as $type){
            $typeVehicles = $type->vehicles()->count();
            $vehiclesPerType[] = [
                'type'=>$type->name,
                'vehicles_count'=> $typeVehicles,
            ];
        }
        foreach($departments as $department){
            $departmentVehicles = $department->vehicles()->count();
            $vehiclesPerDepartment[] = [
                'department'=>$department->name,
                'vehicles_count'=> $departmentVehicles,
            ];
        }
        $vehiclesPerInsurance[]=[
            'insured_vehicles'=>$insuredVehicles,
            'uninsured_vehicles'=>$uninsuredVehicles,
        ];
        $vehiclesPerTax[]=[
            'taxed_vehicles'=>$taxedVehicles,
            'unTaxed_vehicles'=>$unTaxedVehicles,
        ];
        $cardsData = [
            'total_vehicles'=>$totalVehicles,
            'total_vehicle_categories'=>$totalCategories,
            'total_drivers'=>$totalDrivers
        ];
        $chartsData = [
            'vehicles_per_type'=>$vehiclesPerType,
            'vehicles_per_department'=>$vehiclesPerDepartment,
            'vehicles_per_insurance'=>$vehiclesPerInsurance,
            'vehicles_per_tax'=>$vehiclesPerTax
        ];
        $latestAddedData = [
            'latest_vehicles'=>$latestVehicles
        ];
        $data = [
            'cards_data'=>$cardsData,
            'charts_data'=>$chartsData,
            'latest_added_data'=>$latestAddedData
        ];
        return Response::json([
            'status'  => 200,
            'message' => 'Dashboard overview',
            'data'=>$data
        ], 200);
    }
    public function searchVehicle(Request $request)
    {
        $type = $request->input('type');
        $category = $request->input('category');
        $department = $request->input('department');
        $is_taxed = $request->input('is_taxed');
        $is_insured = $request->input('is_insured');
        $searchResults = [];
        $data = [];
        $mainQuery = Vehicle::where('type_id',$type)
                  ->where('category_id',$category);
        if(!$type || !$category){
            return Response::json([
                'status'  => 404,
                'message' => 'The Type and Category are mandatory',
            ], 404);
        }
        //search with only type && category
        if(!$department && !$is_taxed && !$is_insured){
            $searchResults = $mainQuery->get();
        }
        //search with only type && category && department
        if($department && !$is_taxed && !$is_insured){
            $searchResults = $mainQuery
            ->where('department_id',$department)
            ->get();
        }
        //search with only type && category && tax status
        if(!$department && $is_taxed && !$is_insured){
            if($is_taxed ==="yes"){
                //vehicles with taxes
                $searchResults =$mainQuery
                ->where('is_taxed',true)
                ->get();
            }else{
                // vehicles with no taxes
                $searchResults =$mainQuery
                ->where('is_taxed',false)
                ->get();
            }
        }
        //search with only type && category && tax status
        if(!$department && !$is_taxed && $is_insured){
            if($is_insured ==="yes"){
                //vehicles with taxes
                $searchResults =$mainQuery
                ->where('is_assured',true)
                ->get();
            }else{
                // vehicles with no taxes
                $searchResults =$mainQuery
                ->where('is_assured',false)
                ->get();
            }
        }
        //search with only type && category && department && tax status
        if($department && $is_taxed && !$is_insured){
            // vehicles with taxes
            if($is_taxed ==="yes"){
                $searchResults =$mainQuery
                ->where('department_id',$department)
                ->where('is_taxed',true)
                ->get();
            }else{
                // vehicles with no taxes
                $searchResults =$mainQuery
                ->where('department_id',$department)
                ->where('is_taxed',false)
                ->get();
            }
        }
        //search with only type && category && department && insurance status
        if($department && !$is_taxed && $is_insured){
            // vehicles with taxes
            if($is_insured ==="yes"){
                $searchResults = $mainQuery
                ->where('department_id',$department)
                ->where('is_assured',true)
                ->get();
            }else{
                // vehicles with no taxes
                $searchResults = $mainQuery
                ->where('department_id',$department)
                ->where('is_assured',false)
                ->get();
            }
        }
        //search with only type && category && tax status && insurance status
        if(!$department && $is_taxed && $is_insured){
            // vehicles with taxes and insurances
              if($is_insured ==="yes" && $is_taxed ==="yes"){
                $searchResults = $mainQuery
                ->where('is_assured',true)
                ->where('is_taxed',true)
                ->get();
              }
              if($is_insured ==="yes" && $is_taxed ==="no"){
                $searchResults = $mainQuery
                ->where('is_assured',true)
                ->where('is_taxed',false)
                ->get();
              }
              if($is_insured ==="no" && $is_taxed ==="yes"){
                $searchResults = $mainQuery
                ->where('is_assured',false)
                ->where('is_taxed',true)
                ->get();
              }
              if($is_insured ==="no" && $is_taxed ==="no"){
                $searchResults = $mainQuery
                ->where('is_assured',false)
                ->where('is_taxed',false)
                ->get();
              }
        }
        //search with all
        if($department && $is_taxed && $is_insured){
            // vehicles with taxes and insurances
              if($is_insured ==="yes" && $is_taxed ==="yes"){
                $searchResults = $mainQuery
                ->where('is_assured',true)
                ->where('is_taxed',true)
                ->where('department_id',$department)
                ->get();
              }
              if($is_insured ==="yes" && $is_taxed ==="no"){
                $searchResults = $mainQuery
                ->where('is_assured',true)
                ->where('is_taxed',false)
                ->where('department_id',$department)
                ->get();
              }
              if($is_insured ==="no" && $is_taxed ==="yes"){
                $searchResults = $mainQuery
                ->where('is_assured',false)
                ->where('is_taxed',true)
                ->where('department_id',$department)
                ->get();
              }
              if($is_insured ==="no" && $is_taxed ==="no"){
                $searchResults = $mainQuery
                ->where('is_assured',false)
                ->where('is_taxed',false)
                ->where('department_id',$department)
                ->get();
              }
        }
        foreach ($searchResults as $result) {
            $data[] = [
                'id'=>$result->id,
                'type'=>$result->type->name,
                'category'=>$result->category->name,
                'department'=>$result->department->name,
                'driver'=>$result->driver->names,
                'brand'=>$result->brand,
                'model'=>$result->model,
                'plate_no'=>$result->plate_no,
                'acquisition_date'=>$result->acquisition_date
            ];
        }
        return Response::json([
            'status'  => 200,
            'message' => 'search results',
            'data'=>$data
        ], 200);
    }
}
