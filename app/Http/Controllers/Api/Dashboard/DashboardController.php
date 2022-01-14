<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            'insured_vehicles'=>$taxedVehicles,
            'uninsured_vehicles'=>$unTaxedVehicles,
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
        return $data;
    }
    public function searchCar()
    {
        
    }
}
