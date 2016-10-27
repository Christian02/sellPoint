<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Purchase;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $purchase = new Purchase();
            $purchases= $purchase->getAll();
            return  json_encode($purchases);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function  loadProduct($id)
    {

        $purchase = new Purchase();
        $data= $purchase->loadProduct($id);
        return $data;
    }
    public function getProducts()
    {
        $purchase = new Purchase();
        return $purchase->getProducts();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $purchase = new Purchase();
        $purchase->product_id = $request->input('id');
        $purchase->unit_price_purchase = $request->input('unit_price');
        $purchase->amount = $request->input('amount');
        $purchase->save();
        return "Compra realizada exitosamente";


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $purchase = new Purchase();
        $e_purchase = $purchase->load($id); 
        return json_encode($e_purchase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($request->input('id'));
        
        $purchase->product_id = $request->input('product_id');
        $purchase->unit_price_purchase = $request->input('unit_price');
        $purchase->amount = $request->input('amount');
        $purchase->save();
        return "Compra actualizada exitosamente";

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::find($id);
        $purchase->delete();
        return "Compra eliminada satisfactoriamente";
    }
}
