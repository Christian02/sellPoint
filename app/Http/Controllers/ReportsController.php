<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Report;
use Illuminate\Support\Facades\Input;

class ReportsController extends Controller
{
	public function index(Request $request)
	{
       
        if($request->ajax())
        {   
            if(Input::get('date'))
            {
                $date=Input::get('date');
                $date = str_replace("-", "/", $date);
                $report= new Report();
                $filter="AND name!='cochinita'";
                $sales= $report->getSalesPerDate($date,$filter);
                $rows=array();
                foreach ($sales as $sale ) {
                    $row[0]=$sale->name;
                    $row[1]=$sale->amount;
                    array_push($rows, $row);
                }    
                echo json_encode($rows,JSON_NUMERIC_CHECK);              
            }else if(Input::get('dateForGains') && Input::get('dateOFSold'))
            {
                $date=Input::get('dateForGains');
                $report = new Report();
                $reports = $report->getGainsPerDay($date);
                
                $total=0;
                $rows =array();
                foreach ($reports as $report ) {
                    $total+=$report->total;
                }
                if($total!=0)
                {
                    $totalSold = $this->getTotalSoldPerDay(Input::get('dateOFSold'));
                    $total = $totalSold-$total;
                    echo json_encode($total,JSON_NUMERIC_CHECK);
                }
                
            }
        }else
        {
            return \View::make('reports.sales');     
        }
        
    }
    private function getTotalSoldPerDay($date)
    {
        
        $date = str_replace("-", "/",$date);
        $sale = new Report();
        $sales= $sale->getSalesPerDate($date);
        $total=0;
        foreach ($sales as $sale) {
            $total=$total+($sale->amount*$sale->price_sale);
        }
        return $total;
    }

     public function listSalesTable(Request $request)
    {

        if($request->ajax())
        {
            $date = str_replace("-", "/",Input::get('d'));
            $sale = new Report();
            $sales= $sale->getSalesPerDate($date);
            $total=0;
                    
                    echo '<table class="table table-bordered" >
                        <thead>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>    
                        </thead>';
                    echo '<tbody>';
                    foreach ($sales as $sale) {
                        $total=$total+($sale->amount*$sale->price_sale);
                        echo '  
                        <tr>
                            <td > '.$sale->name.'</td>
                            <td > '.$sale->amount.'</td>  
                            <td > '.$sale->price_sale.'</td>   
                            <td>  <strong>'.(number_format( ($sale->amount*$sale->price_sale),2,',',' ') ).'</strong ></td>
                        </tr>';


                    }     
                    
              
            echo '<tr>
                    <td colspan="1"></td>
                    <td colspan="3">Total vendido: <strong>'.$total.' </strong> </td>

                 </tr> ';
            echo' </tbody> 
                  </table>';
            

        }
        
    }
    public function salesPerMonthChart(Request $request)
    {
        $currentDate= date("Y");
        if($request->ajax())
        {
            $vector = array();
            $year = Input::get('year');
            for($i=1;$i<=12;$i=$i+1)
            {   
                $sale = new Report();
                $subTotal=0;
                $sales=$sale->getSalesPerMonth($i,$year);
                foreach ($sales as $sale ) {
                     $subTotal +=($sale->amount * $sale->price_sale);
                }
                array_push($vector, $subTotal);
            }
            //$vector= array(10, 20, 30, 44, 42, 45, 6);
            echo json_encode($vector,JSON_NUMERIC_CHECK);   

        }else
        {
            return  \View::make('reports.sales_per_month')->with(array('currentDate' =>$currentDate)); 
        }


    }

        

}
