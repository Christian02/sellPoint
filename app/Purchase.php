<?php

namespace App;
use DB;
use App\Quotation;
use App\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
	/*Cada compra tiene muchos productos*/
    public function products()
    {
      return $this->hasMany('App\Product', 'id');
    }
 	protected $fillable = array('id', 'product_id', 'amount','unit_price_purchase');
 	public function getAll(){ 
 		$sales = \DB::table('purchases')
        ->join('products', 'products.id', '=', 'purchases.product_id')
        ->select(DB::raw('products.*, purchases.*,purchases.id as purchasesId'))->get();
        return $sales;
    }
    public function load($id)
    {
    	$purchase = \DB::table('purchases')
    	->select('purchases.id','description',
    		'unit_price_purchase','amount','purchases.product_id')
        ->join('products', 'products.id', '=', 'purchases.product_id')
        ->where('purchases.id','=',$id)->first();
        return $purchase;
    }
    public function loadProduct($id)
    {
    	
    	return Product::find($id);
    }
    public function getProducts()
    {
        return Product::all();
    }
}
