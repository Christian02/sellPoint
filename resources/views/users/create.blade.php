@extends('layouts.master')

@section('content')

@if(count($errors))
	<div class="alert alert-danger">
		@foreach($errors->all() as $error)
			<li> {{ $error }} </li>
		@endforeach
	</div>
@endif

<body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
			<h2>Registro de usuario</h2>

          	{!! Form::open(array('route' => 'storeUser','files'=>'true','method' => 'post')) !!}
			<div class="form-group">
				{!! Form::label('name','Username') !!}
				{!! Form::text('name',null,array('class'=>'form-control')) !!}
			</div>
			<div class="form-group">
			{!! Form::label('Foto de perfil') !!}
			{!! Form::file('image',null,array('class'=>'form-control')) !!}

			</div>

			<div class="form-group">
			{!! Form::label('email') !!}
			{!! Form::text('email',null,array('class'=>'form-control')) !!}

			</div>

			<div class="form-group">
			{!! Form::label('password') !!}
			{!! Form::password('password',array('class'=>'form-control')) !!}

			</div>



			{!! Form::token() !!}
			{!! Form::submit(null,array('class'=>'btn btn-default')) !!}

			{!! Form::close() !!}
            

              <div class="clearfix"></div>

              <div class="separator">
                
                <div class="clearfix"></div>
                <br />
              </div>
          </section>
        </div>
      </div>
    </div>
  </body>



 
@endsection