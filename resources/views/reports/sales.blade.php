@extends('layouts.gentella_master')
@section('content')
	<h2>Reporte de ventas por fecha</h2>
 	<script src="../public/datePicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../public/chart/exporting.js"></script>
	<script type="text/javascript" src="../public/chart/highcharts.js"></script>
	<script type="text/javascript" src="../public/chart/Chart.min.js"></script>
	<link href="../public/css/datepicker.css" rel="stylesheet"/>
	<section class="row">
	    <div class="col-xs-12 col-sm-8 col-md-9 col-lg-12" >
	    	{!! Form::label("selectDate_l","Seleccione una fecha") !!}
	    	
	    	{!! Form::text("date",null,
	                	    array("class"=>"datepicker form-control",
	                	    "id"=>"date","readonly","placeholder"=>"Haz click")) !!}	
	    	<button id="perweek" type="button" class="btn btn-success">Mostrar</button>
	    </div>
	    <article class="col-xs-12 col-sm-8">
	    	<!--<div  id="circleChart" > </div>-->
	                <div class="x_panel">
	                  <div class="x_title">
	                    <h2>Chart graph<small>Sessions</small></h2>
	                    <ul class="nav navbar-right panel_toolbox">
	                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	                      </li>
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
	                        <ul class="dropdown-menu" role="menu">
	                          <li><a href="#">Settings 1</a>
	                          </li>
	                          <li><a href="#">Settings 2</a>
	                          </li>
	                        </ul>
	                      </li>
	                      <li><a class="close-link"><i class="fa fa-close"></i></a>
	                      </li>
	                    </ul>
	                    <div class="clearfix"></div>
	                  </div>
	                  <div class="x_content">
	                    <div id="circleChart"></div>
	                  </div>
	                </div>
	    </article>
	    <aside class="col-xs-12 col-sm-4 col-md-3 col-lg-3 ">
	    	<div id="showDetailSales" > </div>
	    </aside>
  	<section> 
 <script type="text/javascript">   
    $(document).ready(function () 
    {
        $('#date').datepicker({
            format: "mm-dd-yyyy"
        });  
        $( "#perweek" ).click(function() 
        {

            var d=document.getElementById("date").value;
            var date=d;
            var options = 
            	{
                    chart:{
                            renderTo: 'circleChart',
                            plotBackgroundColor: null,
                            backgroundColor:'rgba(0, 0, 0, 0)',
                            plotBorderWidth: null,
                            plotShadow: true
                            },
                            title:{
                                    text: 'Porcentaje de ventas',	
                            },
                            credits:{
                                    enabled: false
                            },
                            tooltip:{
                                    formatter: function() 
                                    {
                                    	return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                            		}
                                },
                            plotOptions:{
                                    	pie:{
	                                        allowPointSelect: true,
	                                        cursor: 'pointer',
	                                        dataLabels: {
	                                            enabled: true,
	                                            color: '#000000',
	                                            connectorColor: '#000000',
	                                            formatter: function() 
	                                            {
	                                                return '<b>'+ this.point.name +
	                                                	   '</b>: '+ Highcharts.
	                                                	   numberFormat(this.percentage, 2) +' %';
	                                            }
                                        	}
                                    	}
                            },
                            series:[{
                                    type: 'pie',
                                    name: 'Browser share',
                                    data: []
                            }]
            	};
        	$.ajax(
            {
				type:'GET',
				url:'reports',
				data:'date='+escape(date),
				success: function(json)
				{	
					
					if(json.length != 2 )
					{
						options.series[0].data = eval(json);
                		chart = new Highcharts.Chart(options);
                		getpartialSale();
					}else{

                		getpartialSale();
                	}
				}
			});      
        });
    });
	function getpartialSale()
	{
		var d=document.getElementById("date").value;
		$.ajax
		({
			type:'GET',
			data:'d='+d,
			dataType:'html',
			url:'reports-getSaleTable',
			success: function(data)
			{	
		        $('#showDetailSales').html(data);
				return false;
			}
		});
		return false;
	}
 </script>
@endsection