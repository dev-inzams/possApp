<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller {

    // get customer
    public function getCustomers(Request $request) {
        $user_id = $request->header( 'id' );
        $getCustomer = Customer::where('user_id', $user_id)->get();
        if($getCustomer == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'No customers found',
                'data' => 'No customers found',
            ], 200);
        }else{
            return response()->json( $getCustomer, 200 );
        }

    } // end getCustomers

    // get customer
    public function getCustomer(Request $request) {
        $user_id = $request->header( 'id' );
        $customer_id = $request->input( 'id' );
        $getCustomer = Customer::where('user_id', $user_id)->where('id', $customer_id)->first();
        if($getCustomer == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'No customers found',
                'data' => 'No customers found',
            ], 200);
        }else{
            return response()->json( $getCustomer, 200 );
        }
    }

    //  updateCustomer
    public function updateCustomer(Request $request){
        try{
            $user_id = $request->header('id');
            $customer_id = $request->input('id');
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            Customer::where('user_id', $user_id)->where('id', $customer_id)->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Customer updated successfully',
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 200);
        }

    } // end updateCustomer


    // deleteCustomer
    public function deleteCustomer(Request $request){
        try{
            $user_id = $request->header('id');
            $customer_id = $request->input('id');
            Customer::where('user_id', $user_id)->where('id', $customer_id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Customer deleted successfully',
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    // addCustomer
    public function addCustomer(Request $request){
        try{
            $user_id = $request->header('id');
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            Customer::create([
                'user_id' => $user_id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Customer added successfully',
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 200);
        }
    }

} // end class
