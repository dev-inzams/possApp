<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller {
    // invoiceCreate
    public function invoiceCreate( Request $request ) {
        DB::beginTransaction();

        try {
            $user_id = $request->header( 'id' );
            $total = $request->input( 'total' );
            $discount = $request->input( 'discount' );
            $vat = $request->input( 'vat' );
            $payable = $request->input( 'payable' );

            $customer_id = $request->input( 'customer_id' );

            $invoice = Invoice::create( [
                'user_id'     => $user_id,
                'customer_id' => $customer_id,
                'total'       => $total,
                'discount'    => $discount,
                'vat'         => $vat,
                'payable'     => $payable,
            ] );

            $invoiceID = $invoice->id;

            $product = $request->input( 'products' );

            foreach ( $product as $value ) {
                InvoiceProduct::create( [
                    'invoice_id' => $invoiceID,
                    'product_id' => $value['product_id'],
                    'qty'        => $value['qty'],
                    'user_id'    => $user_id,
                    'sale_price' => $value['sale_price'],
                ] );
            }

            DB::commit();
            return response()->json([
                'status'  => "success",
                'message' => 'Invoice created successfully'
            ]);
        } catch ( \Exception $e ) {
            DB::rollBack();
            return 0;
        }
    } // invoiceCreate

    // invoice select
    public function invoiceSelect( Request $request ) {
        $user_id = $request->header( 'id' );
        $invoice = Invoice::where( 'user_id', $user_id )->with( 'customer' )->get();
        return $invoice;
    }

    // invoice details
    public function invoiceDetails( Request $request ) {
        $user_id = $request->header( 'id' );
        $customerDetails = Customer::where( 'user_id', $user_id )->where( 'id', $request->input( 'cus_id' ) )->first();
        $invoiceTotal = Invoice::where( 'user_id', $user_id )->where( 'id', $request->input( 'inv_id' ) )->first();
        $invoiceProduct = InvoiceProduct::where( 'user_id', $user_id )->where( 'invoice_id', $request->input( 'inv_id' ) )->get();

        return [
            'customerDetails' => $customerDetails,
            'invoiceTotal'    => $invoiceTotal,
            'invoiceProduct'  => $invoiceProduct,
        ];

    }

    // invoice delete
    public function invoiceDelete( Request $request ) {
        $user_id = $request->header( 'id' );
        $invoice_id = $request->input( 'inv_id' );

        try {
            DB::beginTransaction();

            // Delete invoice product
            InvoiceProduct::where( 'user_id', $user_id )
                ->where( 'invoice_id', $invoice_id )
                ->delete();

            // Delete invoice
            Invoice::where( 'user_id', $user_id )
                ->where( 'id', $invoice_id )
                ->delete();

            DB::commit();
            return response()->json([
                'status'  => "success",
                'message' => 'Invoice deleted successfully'
            ]);
        } catch ( \Exception $e ) {
            DB::rollBack();
            return 0;
        }
    }
}
