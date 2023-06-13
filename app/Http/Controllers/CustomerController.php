<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller 
{
    public function index(Request $request)
    {
        // return Auth::user();
        // Retrieve customers that belong to the logged in user
        
        $query = Customer::get();
        // Search functionality

        $search = $request->input('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('email', 'LIKE', "%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%");
            });
        }
        // Order customers by points and last name

        $query->sortByDesc('points');
        // Fetch the customers

        $customers = $query;
        return response()->json(['customers' => $customers]);
    }
    public function promote(Customer $customer)
    {
        if ($customer->gender === 'Male') {
            $customer->points += 10;
        } elseif ($customer->gender === 'Female') {
            $customer->points += 5;
        }
        $customer->save();
        return response()->json(['message' => 'Customer promoted successfully']);
    }
    public function demote(Customer $customer)
    {
        if ($customer->gender === 'Male') {
            $customer->points -= 5;
        } elseif ($customer->gender === 'Female') {
            $customer->points -= 2;
        }
        $customer->save();
        return response()->json(['message' => 'Customer demoted successfully']);
    }
}