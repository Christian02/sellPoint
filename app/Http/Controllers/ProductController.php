<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
	public function index()
	{
        if (Input::get('name'))
        {
            $products= $this->getListByName();
        }else
        {
            $product= new Product();
            $products = $product->getAll();
        }


    	return \View::make('products.list_product',compact('products'));
	}
    
    public function create()
	{
		return \View::make('products.create');
	}

	public function store(Request $request)
	{
		
		if($request->ajax())
		{	
			$arrayForm = $request->all();
			$contains_empty = in_array("",$arrayForm , true);

			if(!$contains_empty){
				$data =$arrayForm;
				Product::create($data);
				echo 'Producto registrado exitosamente';	
			}else{
				echo 'Debe llenar todos los campos';
			}

			
			

		}
		
	}
	
    public function show()
    {
    	/*
    	$product= new Product();
    	$products = $product->getAll();
    	return \View::make('products.list_product',compact('products'));
	*/
    }
    public function edit(Request $request)  
    {


		if($request->ajax())
		{	
			
			$product = new Product();
			$product->id = $_POST['id'];
			$product = $product->load($product->id);
		
			return $product;
		}

    }

    
    public function update(Request $request) 
    {
    

    	if( $request->ajax() )
    	{
    		
    		$input = $request->only([
    					  'name',
   						  'description',
   						  'unit_price',
   						  'price_sale'
			]);
    		$contains_empty = in_array("",$input,true);
    		if(!$contains_empty)
    		{
    			$product = Product::findOrFail(Input::get('id'));
    			$product->fill($input)->save();
                $this->fillTable();
    		}else{
    			echo 'debe llenar todos los campos';
    		}
		 


    	}
    }
    public function destroy($id, Request $request)
    {
    	$product = Product::findOrFail( $id );

	    if ( $request->ajax() ) {
    		$product->delete();
    		$this->fillTable();
            
	    }
    	

    }
    public function  fillTable()
    {
         $product= new Product();
         $products = $product->getAll();       
         $html = \View::make('products._list_product',
                         compact('products'))->render();
         echo $html;	
    }
    public function getListByName()
    {   

        $pagesize=20;
        $name=Input::get('name');
        $product = new Product();
        $products = $product->getAllByName($name,$pagesize);
        
        return $products;    
    }
    
    

}
