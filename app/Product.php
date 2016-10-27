<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Quotation;
use Carbon\Carbon;
class Product extends Model
{

  public function sale()
  {
    return $this->belongsTo('Sales','product_id');
  }
  public function purchases()
  {
    return $this->belongsTo('Purchase','product_id');
  }


   protected $fillable = ['name',
   						  'description',
   						  'unit_price',
   						  'price_sale'];
   						  
   public static $create_validation_rules=[
   		  'name'=>'required',
        'description'=>'required',
        'unit_price' =>'required',
        'price_sale' =>'required',
   ];
   public static function getCurrentDate(){
   		date_default_timezone_set('America/Mexico_City');
        $myDate = date('Y/m/d');
        return $myDate;
   }

   public function getPriceSaleProductById($id)
   {
      $priceSaleProduct = DB::table('products')->select('price_sale')->where('id','=',$id)->get();
    return  floatval($priceSaleProduct[0]->price_sale) ;
   }

   public function getProductById($id)
   {
      try{
         // try code
        $product = Product::findOrFail($id); 
        return $product; 
      } 
      catch(\Exception $e){
         
      }
       

   }

   public function getAll()
   {
    $products = DB::table('products')->paginate(10);
    return $products;
   }
   public function getAllByName($name,$pagesize)
   {

    $products = DB::table('products')
                ->where('name','like','%'.$name.'%')
                ->paginate($pagesize);

    return $products;
   }
   
   public function load($id)
   {

    $product =  Product::find($id);
    $arrayProduct = array(
            0=>$product->id,
            1=>$product->name,
            2=>$product->description,
            3=>$product->unit_price,
            4=>$product->price_sale,
            5=> $this->getFormatDate($product->created_at),
        );
    echo json_encode($arrayProduct);
   }

   public static function getFormatDate($date)
   {
    return  Carbon::parse($date)->format('Y-m-d');
   }
  
}
