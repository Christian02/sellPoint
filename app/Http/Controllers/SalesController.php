<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Sales;
use App\Product;
use DB;
use App\Quotation;
use Illuminate\Support\Facades\Input;
class SalesController extends Controller
{
	protected  $pagesize=20;
	public function index()
	{
		if(Input::get('date'))
		{
			$sale= new Sales();
			$sales = $sale->getByDate(Input::get('date'),$this->pagesize);
		}
		else
		{
			$sale= new Sales();
			$sales = $sale->getAll($this->pagesize);
		}
		
		return \View::make('sales.list_sales',compact('sales'));	
		    	
	}
    public function store(Request $request)
	{
		//$this->validate($request,Sales::$create_validation_rules);
		if($request->ajax())
		{	
			$product = new Product();
			$products=json_decode($_POST['dataProducts'] ) ;
			$sale = new Sales();
			$folio= $sale->getTheLastFolio()+1;
			for($index=6;$index<=sizeof($products);$index=$index+6)
			{  


				$sale = 
				Sales::create([
					'folio' => $folio,
	           		'product_id' =>$products[$index-6],
	           		'amount' => $products[$index-3], 
	           		'price_sale' =>$product->getPriceSaleProductById($products[$index-6]),
	           		
					]);
    		}
    		
    		$receivables = $_POST['dataReceivables'];
			$total = $_POST['dataTotalToCharge'];

			$change = ($receivables-$total);
			echo $change;
		}
	}

	public function fillTable(Request $request)
	{
		if( $request->ajax() ){
	   	    $idProduct = Input::get('codeProduct');
			$product = new Product();
    		$product =	$product->getProductById($idProduct);
		    if( $product){
		    	$amount =    Input::get('amountProduct');
    			date_default_timezone_set('America/Mexico_City');
    			$currentDate = date('Y/m/d');
		    	$html = \View::make('sales._current-list-sales',
		    			 compact('product','amount','currentDate'))->render();
 				echo $html;
		    }else{
		        
		        echo ' ';
		    }                
		}
	}
	public function getChange(Request $request)
	{
		if( $request->ajax() )
		{
			$receivables = $_POST['dataReceivables'];
			$total  	 = $_POST['dataTotalToCharge'];
			$data= $receivables-$total;
			echo $data;
		}



	}
	public function edit(Request $request)
	{
		if($request->ajax())
		{	
			
			$sale = new Sales();
			$sale->id = $_POST['id'];
			$sale = $sale->load($sale->id);
			return $sale;
		}

	}
	public function update(Request $request){
		
		if( $request->ajax() )
    	{
    		
    		$input = $request->only([
    					  'id',
    					  'amount',
   						  
			]);
    		$contains_empty = in_array("",$input,true);
    		if(!$contains_empty)
    		{
    			$sale = Sales::findOrFail(Input::get('id'));
    			$sale->fill($input)->save();
    			$this->listSalesAfterChange();
    		}else{
    			echo 'debe llenar todos los campos';
    		}
		
    	}
	}
	
	public function destroy(Request $request){
		

	    if ( $request->ajax() ) {
	    	$sale = Sales::findOrFail( $_POST['id'] );
    		$sale->delete();
    		$this->listSalesAfterChange();
	    }
	}
	public function listSalesAfterChange()
	{	
		$sale= new Sales();
		$sales = $sale->getAll($this->pagesize);
 		$html = \View::make('sales._list-sales', compact('sales'))->render();
 		echo $html;
	}
	public function getListByName($name)
	{	
		
		$sales = new Sales();
		$sales = $sales->getAllByName($name,$this->pagesize);
		return $sales;	
	}

}
