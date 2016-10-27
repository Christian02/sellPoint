@extends('layouts.gentella_master')
@section('content')
<script type="text/javascript" src="../public/chart/Chart.min.js"></script>
<div class="row">
<div class="alert" id="message">
    <a href="" class="close" id="close" data-dismiss="alert">&times;</a>
    <strong>Aviso!</strong> Puede capturar otro año y seleccionar mostrar.
</div>
	{!!Form::text('yearText',$currentDate,array("placeholder"=>
									"Ingrese un año",
									"class"=>"form-control",
									"id"=>"yearText")) !!}
	<button id="year" type="button" class="btn btn-success">Mostrar</button>
<div>
<!-- page content -->
        <div class="" role="main">
          <div class="">
	            <div class="clearfix"></div>
	            <div class="row">
	              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                <div class="x_panel">
	                  <div class="x_title">
	                    <h2>Bar graph <small>Sessions</small></h2>
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
	                    <canvas id="mybarChart"></canvas>
	                  </div>
	                </div>
	              </div>
	            </div>
        	</div>
        </div>
<script type="text/javascript">

$( document ).ready(function() 
{
	$('#close').click(function(){
		$('#message').html(" ");
	});
	// Bar chart
      var ctx = document.getElementById("mybarChart");
      var barOptions=
      {
      	type: 'bar',
        data: {
          labels: ["Enero", "Febrero", "Marzo", "Abril", 
          		   "Mayo", "Junio", "Julio","Agosto",
          		   "Septiembre","Octubre","Noviembre","Diciembre"],
          datasets: [{
            label: '# cantidad en $',
            backgroundColor: "#26B99A",
            data: []
          }]
        },

        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }

      }

    loadChart();
    function loadChart()
    {
    	var year = $("#yearText").val();
    	$.ajax(
            {
				type:'GET',
				url:'reportsByMonthChart',
				data:'year='+year,
				success: function(json)
				{	
					barOptions.data.datasets[0].data= eval(json);
					var mybarChart = new Chart(ctx,barOptions );
				}
			}); 


    	
    }
      
      


	$( "#year" ).click(function() 
    {
    	loadChart();
	});	
});	
</script>
@endsection