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
			{!! Form::open(array('route' => 'home','class'=>'form-signin')) !!}
              <h1>Login Form</h1>
              <div>

                {!! Form::label('email') !!}
				{!! Form::text('email',null,array('class'=>'form-control')) !!}


              </div>
              <div>
                {!! Form::label('password') !!}
				{!! Form::password('password',array('class'=>'form-control')) !!}
              
              </div>
              <div>
                {!! Form::token() !!}
				{!! Form::submit(null,array('class'=>'btn btn-default submit ')) !!}

				{!! Form::close() !!}

              </div>

              <div class="clearfix"></div>

              <div class="separator">
                
                <div class="clearfix"></div>
                <br />

               {{ link_to_route('createUser','Crear nueva cuenta') }}
              </div>
          </section>
        </div>
      </div>
    </div>
  </body>

@endsection