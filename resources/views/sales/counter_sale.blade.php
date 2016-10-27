@extends('layouts.gentella_master')
@section('content')
<h3> Venta en mostrador</h3>
<div  id="message"></div>
<section class="row " >
	<article class="col-xs-12 col-sm-8 col-md-9 col-lg-9" >
		{!! Form::open(array('id'=>'form_counter_sale')) !!}
			<div class="form-group ">
			  {!! Form::label('codeProduct','Código de Producto',array( "class"=>"form-control-label" )) !!}
			  {!! Form::input('number','codeProduct',null,array("class"=>"form-control"))!!}
			</div>
			<div class="form-group ">
				{!! Form::label('amountProduct','Cantidad',array( "class"=>"form-control-label" )) !!}
			  	{!! Form::input('number','amountProduct',null,array("class"=>"form-control"))!!}
			</div>
			<table class="table " id="mytable" style="visibility:hidden;">
				<thead>				
					<th>Código</th>
					<th>Nombre</th>
					<th>Monto</th>
					<th>Cantidad</th>
					<th>Fecha</th>
					<th>Acción</th>
				</thead>
				<tbody id="addRow">
					

				</tbody> 					
			</table>
			<div class="form-group "></div>
		{!! Form::token() !!}
		
		{!! Form::close() !!}
	</article>
	<aside class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
		<div class="well" id="radius">
			<ul>
				<li >Código: <strong>15</strong>  Torta de cochinita </li>
				<li>Código: <strong>14</strong>   Taco de cochinita </li>
				<li id="coke500">Código: <strong> 6</strong>   Coca Cola triple 500ml</li>
				<li id="cokeLight">Código:  <strong>7</strong>   Coca Cola Light 600ml </li>
				<li>Código:  <strong>9</strong>   Horchata 500ml </li>
						 
			</ul>
			<hr class="style-two">
			<center>			
				{!! Form::label('TotalToCharge','Total a cobrar',
								array( "class"=>"form-control-label" )) !!}
				<p id="add" style="font-size:150%;"></p>
			</center>
			<div class="well" id="radius">
				{!! Form::input('number','receivables',null,
										  array("class"=>"form-control",
								  		  "id" => "receivables",
								  		  "placeHolder"=>"Capture efectivo"))!!}
				<center>{!! link_to('#', $title='Vender',$attributes = ['id'=>'sell_counter','class'=>'btn btn-primary'], $secure= null) !!}
			</div>
		</div>				
	</aside>
</section>
<hr>
@include('messages._modal-message')
@endsection





