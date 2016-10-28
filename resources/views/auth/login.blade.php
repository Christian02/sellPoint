@extends('layouts.master')

@section('content')


@if(count($errors))
	<div class="alert alert-danger">
		@foreach($errors->all() as $error)
			<li> {{ $error }} </li>
		@endforeach
	</div>
@endif
<style>
 .noTextShadow
 {
      text-shadow:2px 2px 8px #000000;
 }
</style>
<body style="height:100%;"> 
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="login_wrapper" >
        <div class="animate form login_form">
            <section class="login_content noTextShadow" >
             {!! Form::open(array('route' => 'home')) !!}
                <h1>Bienvenido</h1>
                <div>
                  {!! Form::text('email',null,array('class'=>'form-control',
                         'placeholder'=>'Correo electrónico')) !!}
                </div>
                <div>
                  {!! Form::password('password',array('class'=>'form-control',
                             'placeholder'=>'Contraseña')) !!}
                </div>
                <div>
                  {!! Form::token() !!}
                  {!! Form::submit(null,array('class'=>'btn btn-default submit ')) !!}
                  {!! Form::close() !!}
                  <a  href="#">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="clearfix"></div>
                <div class="separator">
                  <p class="change_link">¿Nuevo en el sitio?
                      <a  href="#signup" > Crear cuenta </a>
                  </p>
                  <div class="clearfix"></div>
                  <br />
                   
                </div>
           </section>
        </div>
      


        <div id="register" class="animate form registration_form">
          <section class="login_content noTextShadow">
              <h1>Crear Cuenta</h1>
              {!! Form::open(array('route' => 'storeUser','files'=>'true','method' => 'post')) !!}
                <div class="form-group">
                  {!! Form::text('name',null,array('class'=>'form-control','placeholder'=>'Nombre')) !!}
                </div>
                <div class="form-group">
                {!! Form::label('Foto de perfil') !!}
                {!! Form::file('image',null,array('class'=>'form-control')) !!}
                </div>

                <div class="form-group">
                {!! Form::text('email',null,array('class'=>'form-control','placeholder'=>'Correo electrónico')) !!}
                </div>
                <div class="form-group">
                {!! Form::password('password',array('class'=>'form-control','placeholder'=>'Contraseña')) !!}
                </div>
                {!! Form::token() !!}
                {!! Form::submit(null,array('class'=>'btn btn-default')) !!}

              {!! Form::close() !!}          
              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">¿Ya eres miembro ?
                  <a href="#signin" class="MyanchorLinkr"> Inicia </a>
                </p>

                <div class="clearfix"></div>
                <br />

                
              </div>
          </section>
        </div>
     </div>
    
   </div>


  </body>

 

     
 
@endsection