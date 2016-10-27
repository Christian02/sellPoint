<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<h4 class="modal-title" id="myModalLabel"><b>Mensaje</b></h4>
            </div>
			<div class="well" id="radius">
				{!! Form::label('change','Cambio',
									array( "class"=>"form-control-label" )) !!}	

				{!! Form::input('number','getChange',null,
									array('class'=>'form-control',
										  'id'=>'getChange',
										  'readonly'=>'readonly'))!!}

				<center>{!! link_to('#', $title='cerrar',
									$attributes = ['id'=>'closeModal',
												   'class'=>'btn btn-default'],
												   $secure= null) !!}
				</center>
			</div>
		</div>
	</div>
</div>