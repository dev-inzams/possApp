<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    // get all categories
    function getCategories(Request $request) {
        try {
            $user_id = $request->header('id');
            $categories = Category::where('user_id', $user_id)->get();
            if($categories == null) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No categories found',
                    'data' => 'No categories found',
                ], 200);
            }else{
               return view('auth.category', ['categories' => $categories]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 200);
        }

    }


    // user create category
    function addCategory( Request $request ) {
        try {
            $user_id = $request->header( 'id' );
            $name = $request->input( 'name' );
            Category::create( [
                'name'    => $name,
                'user_id' => $user_id,
            ] );
            return response()->json( [
                'status'  => 'success',
                'message' => 'Category created successfull',
            ], 200 );
        } catch ( \Exception $e ) {
            return response()->json( [
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 200 );
        } // end of try

    } // createCategory end of function

} // end of controller
