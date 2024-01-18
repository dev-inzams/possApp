<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class ProductController extends Controller {
    // create a new product
    public function create( Request $request ) {
    try{
        $user_id = $request->header( 'id' );
        $name = $request->input( 'name' );
        $price = $request->input( 'price' );
        $unit = $request->input( 'unit' );
        $category_id = $request->input( 'category_id' );

        $img = $request->file( 'img' );
        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$user_id}-{$t}-{$file_name}";
        $img_url = "img/products/{$img_name}";
        $img->move( public_path( 'img/products' ), $img_name );
        // create database data
        Product::create( [
            'category_id' => $category_id,
            'user_id'     => $user_id,
            'name'        => $name,
            'price'       => $price,
            'unit'        => $unit,
            'img_url'     => $img_url,
        ] );
        return response()->json( [
            'status'  => "success",
            'message' => "Product created successfull",
        ], 200 );
    } catch ( \Exception $e ) {
        return response()->json( [
            'status'  => "error",
            'message' => $e->getMessage(),
        ], 200 );
    } //end of try
    } //end of create


    // delete product
    public function delete( Request $request ) {
    try{
        $user_id = $request->header( 'id' );
        $product_id = $request->input( 'product_id' );
        $getFilePath = Product::where( 'id', $product_id )->where( 'user_id', $user_id )->value( 'img_url' );
        $filePath = public_path($getFilePath);
        File::delete($filePath);
        $deleteProduct = Product::where( 'id', $product_id )->where( 'user_id', $user_id )->delete();
        if( $deleteProduct ) {
            return response()->json( [
                'status'  => "success",
                'message' => "Product deleted successfull",
            ]);
        }else{
            return response()->json( [
                'status'  => "error",
                'message' => "Product not found",
            ], 200 );
        }
    } catch ( \Exception $e ) {
        return response()->json( [
            'status'  => "error",
            'message' => $e->getMessage(),
        ], 200 );
    }
    }



    // get product
    public function getProduct( Request $request ) {
        try{
            $user_id = $request->header('id');
            $product_id = $request->input('product_id');
            $hasProduct = Product::where('id', $product_id)->where('user_id', $user_id)->first();
            if($hasProduct){
                return response()->json( $hasProduct, 200 );
            }
        }catch ( \Exception $e ) {
            return response()->json( [
                'status'  => "error",
                'message' => $e->getMessage(),
            ], 200 );
        }
    }

    // update product
    public function update( Request $request ) {
        try{
            $user_id = $request->header('id');
            $product_id = $request->input('product_id');

            if($request->hasFile('img')){
                $img = $request->file('img');
                $t = time();
                $file_name = $img->getClientOriginalName();
                $img_name = "{$user_id}-{$t}-{$file_name}";
                $img_url = "img/products/{$img_name}";
                $img->move(public_path('img/products'), $img_name);

                // delete old file
                $oldImg = Product::where('id', $product_id)->where('user_id', $user_id)->value('img_url');
                $filePath = public_path($oldImg);
                File::delete($filePath);

                Product::where('id', $product_id)->where('user_id', $user_id)->update([
                    'category_id' => $request->input('category_id'),
                    'user_id'     => $user_id,
                    'name'        => $request->input('name'),
                    'price'       => $request->input('price'),
                    'unit'        => $request->input('unit'),
                    'img_url'     => $img_url,
                ]);
                return response()->json([
                    'status'  => "success",
                    'message' => "Product updated successfull",
                ]);
            }else{
                Product::where('id', $product_id)->where('user_id', $user_id)->update([
                    'category_id' => $request->input('category_id'),
                    'user_id'     => $user_id,
                    'name'        => $request->input('name'),
                    'price'       => $request->input('price'),
                    'unit'        => $request->input('unit'),
                ]);
                return response()->json([
                    'status'  => "success",
                    'message' => "Product updated successfull",
                ]);
            }
        }catch ( \Exception $e ) {
            return response()->json( [
                'status'  => "error",
                'message' => $e->getMessage(),
            ], 200 );
        } // end of try
    } // end of update


    // get all products
    public function getProducts( Request $request ) {
        try{
            $user_id = $request->header('id');
            return Product::where('user_id', $user_id)->get();
        }catch ( \Exception $e ) {
            return response()->json( [
                'status'  => "error",
                'message' => $e->getMessage(),
            ], 200 );
        }
    }


} // end of class
