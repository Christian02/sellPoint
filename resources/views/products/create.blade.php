
@extends('layouts.gentella_master')

@section('content')
<div id="message" >
   
</div>
<h3> Nuevo Producto</h3>


{!! Form::open(array('id'=>'form_product' )) !!}


<div class="form-group">
    {!! Form::label('name','Nombre') !!}
    {!! Form::text('name',null,array('class'=>'form-control','id'=>'name')) !!}
</div>
 <div class="form-group">
  {!! Form::label('Descripción') !!}
  {!! Form::textarea('description',null,array('class'=>'form-control','id'=>'description')) !!}
</div>

<div class="form-group">
  {!! Form::label('Precio unitario') !!}
  {!! Form::input('number', 'unit_price',null,array('class'=>'form-control','id'=>'unit_price' ) )  !!}
</div>

<div class="form-group">
  {!! Form::label('Precio de venta') !!}
  {!! Form::input('number', 'price_sale',null,array('class'=>'form-control','id'=>'price_sale' ) )  !!}
</div>


{!! Form::token() !!}


{!! link_to('#', $title='Registrar',$attributes = ['id'=>'register','class'=>'btn btn-primary'], $secure= null) !!}



{!! Form::close() !!}


@endsection





