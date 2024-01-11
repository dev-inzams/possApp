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
               return $categories;
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 200);
        }

    }

    // get Category use id
    function getCategory( Request $request ) {
        $user_id =  $request->header( 'id' );
        $category_id = $request->input( 'category_id' );
        $category = Category::where( 'id', $category_id )->where( 'user_id', $user_id )->first();
        return response()->json([
            'name' => $category->name
        ]);
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


    // update category
    function updateCategory( Request $request ) {
        $user_id =  $request->header( 'id' );
        $category_id = $request->input( 'category_id' );
        $name = $request->input( 'name' );

        Category::where( 'id', $category_id )->where( 'user_id', $user_id )->update( [
            'name' => $name,
        ]);
        return response()->json( [
            'status'  => 'success',
            'message' => 'Category updated successfull',
        ]);
    }

    // delete category
    function deleteCategory( Request $request ) {
        $user_id =  $request->header( 'id' );
        $category_id = $request->input( 'category_id' );
        Category::where( 'id', $category_id )->where( 'user_id', $user_id )->delete();
        return response()->json( [
            'status'  => 'success',
            'message' => 'Category deleted successfull',
        ]);
    }

} // end of controller
