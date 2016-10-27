<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Quotation;
use Carbon\Carbon;
class Report extends Model
{

   public static function getFormatDate($date)
   {
    return  Carbon::parse($date)->format('Y-m-d');
   }


   public function getSalesPerDate($date,$filter="")
   {
    $sales = DB::select(
    		$this->getSqlForSales($date,$filter)
    	);
   	return $sales;
   }
   public function getSalesPerMonth($month,$year)
   {
   	$sales = DB::table('sales')
   			 ->select('amount','price_sale')
   			 ->where(DB::raw('MONTH(created_at)'),'=',$month)
   			 ->where(DB::raw('YEAR(created_at)'),'=',$year)
   			 ->get();
   	return $sales;
   }
    
    private function getSqlForSales($date,$filter="")
    {
	return   $sql =
    		 "SELECT name,SUM(amount) as amount,sales.price_sale FROM sales "
             . "INNER JOIN products on product_id=products.id "
             . "WHERE date_format(sales.created_at,'%m/%d/%Y')='{$date}' ". $filter . " group by product_id,name,sales.price_sale";
    }
}
