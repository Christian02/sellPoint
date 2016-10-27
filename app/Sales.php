<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Quotation;
use App\Product;
use Illuminate\Pagination\Paginator;
use \Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Sales extends Model
{
    /*Cada venta tiene muchos productos*/
    public function products()
    {
      return $this->hasMany('App\Product', 'id');
    }

    protected $fillable = ['folio',
   						  'product_id',
   						  'amount',
   						  'price_sale',
   						  ];

    public static $create_validation_rules=[
   		'amount'=>'required',
   ];
    public function getTheLastFolio()
    {	
 
    	$lastFolio= DB::table('sales')->select('folio')->orderBy('folio', 'desc')->limit(1)->get();
      return $lastFolio[0]->folio;   
    }
    public function getAll($numRecords)
   {
       
       $sales = \DB::table('sales')
        ->join('products', 'products.id', '=', 'sales.product_id')
        ->select(DB::raw('products.*, sales.*,sales.id as saleId'))
        ->paginate($numRecords);



    //$sales = DB::table('sales')->paginate(20);
    
    return $sales ;
   }
   public function getAllByName($name,$pagesize)
   {

    $sales = \DB::table('sales')
        ->join('products', 'products.id', '=', 'sales.product_id')
        ->select(DB::raw('products.*, sales.*,sales.id as saleId'))
        ->where('name', 'like', '%'.$name.'%')->paginate($pagesize);
        return $sales;
   }
   public function getByDate($date,$pagesize)
   {
    
    $sales = \DB::table('sales')
        ->join('products', 'products.id', '=', 'sales.product_id')
        ->select(DB::raw('products.*, sales.*,sales.id as saleId'))
        ->whereDate("sales.created_at" ,"{$date}" )
        ->paginate($pagesize);

    return $sales;
    //SELECT * FROM sales  WHERE date_format(sales.created_at,'%m-%d-%Y')='10-23-2016'
   }
   public function getByDateAndName($date,$name,$pagesize)
   {
    $sales = \DB::table('sales')
        ->join('products', 'products.id', '=', 'sales.product_id')
        ->select(DB::raw('products.*, sales.*,sales.id as saleId'))
        ->whereDate("sales.created_at" ,"{$date}" )->where('name','like','%'.$name.'%')
        ->paginate($pagesize);

    return $sales;
   }
   public function load($id)
   {
        
      $sale = \DB::table('sales')
              ->join('products', 'products.id', '=', 'sales.product_id')
              ->where('sales.id','=',$id)
              ->select(DB::raw('products.*, sales.*,sales.id as saleId'))
              ->first();
      


      $arraySale = array(
              0=>$sale->saleId,
              1=>$sale->folio,
              2=>$sale->name,
              3=>$sale->price_sale,
              4=>$sale->amount,
              5=>$this->getFormatDate($sale->created_at),
          );
      
      echo json_encode($arraySale);
   }
   public static function getFormatDate($date)
   {
    return  Carbon::parse($date)->format('Y-m-d');
   }
  
}
