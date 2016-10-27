@extends('layouts.gentella_master')

@section('content')
  <script src="../public/datePicker/bootstrap-datepicker.js"></script>
  <link href="../public/css/datepicker.css" rel="stylesheet"/>
	<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
	                    <h2>Listado de ventas </h2>
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
	                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
	                    	<div class="row">
	                    		<div class="col-xs-6 col-sm-4">
                            {!! Form::open(array('id'=>'form_search_by_date', 'method' => 'GET',"class"=>"form-inline")) !!}
                            
                            {!! Form::text("date",null,
                                array("class"=>"datepicker form-control",
                                "id"=>"date","readonly","placeholder"=>"Haz click")) !!}

                            {{ Form::submit('Buscar',['class' => 'btn  btn-primary btn-sm']) }}
                            {!! Form::close() !!} 
                          </div>
                          <div class="col-xs-6 col-sm-4"></div>
	                    		
                          <div class="col-xs-6 col-sm-4"></div>
	                    	</div>
	                    </div >
	                  		<div id="contentTable">
    							       @include('sales._list-sales')
							
		                    </div>
	                    
                    
                 </div>
              </div>
    		</div>

    </div>


    <!-- Modal para la actualización de un registro-->
    <div class="modal fade" id="editSaleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Editar venta</b></h4>
            </div>
            <form id="formEditSale" class="formulario" onsubmit="return update_sale();">
              <div class="modal-body">
        				<table border="0" width="100%">
        					<tr>
                    <td>         
                    {!! Form::text('id',
                                    null,array('class'=>'form-control',
                                    'id'=>'id','rows'=>'5',
                                    'readonly','required',
                                    'style'=>'visibility:hidden')) !!}
                    </td> 
                  </tr>     		
                  <tr>
                    <td>{!! Form::label("folio_l","Folio") !!}</td>
                    <td>
                      {!! Form::text('folio',
                                      null,array('class'=>'form-control',
                                      'id'=>'folio','rows'=>'5',
                                      'readonly','required')) !!}
                    </td>
                  </tr>     		 
                  <tr>
                    <td>{!! Form::label("name_l","Nombre") !!} </td>
                    <td>
                      {!! Form::text('name',
                                      null,array('class'=>'form-control',
                                      'id'=>'name','rows'=>'5',
                                      'maxlength'=>'25',
                                      'readonly','required')) !!}
                    </td>
                  </tr>
                  <tr>
                    <td>{!! Form::label("price_sale_l","Precio de venta") !!}</td>
                    <td>
                    {!! Form::input('number', 'price_sale',null,
                                    array('class'=>'form-control',
                                    'id'=>'price_sale','maxlength'=>'8',
                                    'readonly','rows'=>'5',
                                    'step'=>'0.01', ) )  !!}
                    </td>                  
                  </tr>         
                  <tr>
                    <td>{!! Form::label("amount_l","Cantidad") !!}</td>
                    <td>
                     {!! Form::input('number','amount',null,
                                     array('class'=>'form-control',
                                     'id'=>'amount','maxlength'=>'8',
                                     'rows'=>'5','step'=>'0.01' )) !!}
                    </td>
                  </tr>          
                  <tr>
                    <td>{!! Form::label("date_l","Fecha") !!}</td>
                    <td>
                      {!! Form::text('date',null,
                                     array('required','readonly',
                                     'id'=>'date','class'=>'form-control')) !!}
                    </td>
                  </tr>
                            
                </table>
              </div>
              <div class="modal-footer">
                <input type="submit" value="Editar" class="btn btn-warning"  id="editSubmit"/>
              </div>
            </form>
          </div>
        </div>
      </div>


@include('messages._modal-messageAfterUpdateOrDelete')  

<script type="text/javascript">   
    $(document).ready(function () 
    {
      $('#date').datepicker({
            format: "yyyy-mm-dd"
        }); 
    });
</script>

@endsection

