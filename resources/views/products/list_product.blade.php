@extends('layouts.gentella_master')

@section('content')

<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2>Listado de productos </h2>
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
                          <div class="col-sm-6">
                            <div class="dataTables_length" id="datatable_length">
                              
                            </div>
                          </div>


                          <div class="col-sm-6">
                            <div id="datatable_filter" class="dataTables_filter">
                              {!! Form::open(array('id'=>'form_searchProduct', 'method' => 'GET')) !!}
                              {!! Form::input('text','name',null,array( 
                                                                          "class"=>"form-control input-sm", 
                                                                          "aria-controls"=>"datatable",
                                                                          "placeholder"=>"Captura un nombre" )) !!}
                              {{ Form::submit('Buscar',['class' => 'btn  btn-primary ']) }}
                              {!! Form::close() !!} 
                            </div>
                          </div>


                        </div>
                      </div >
                        <div id="contentTable">
                         @include('products._list_product')
              
                        </div>
                        {{{ $products->appends( Request::except('page') )->links() }}}
                    
                 </div>
              </div>
        </div>

    </div>

<!-- Modal para la actualización de un registro-->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Editar Producto</b></h4>
            </div>
            <form id="formEditProduct" class="form-horizontal" role="form" onsubmit=" return  update_product();" >
            <div class="modal-body">
				<table border="0" width="100%">
               		 <tr>
                        <td>{!! Form::label('code_l','Código') !!} </td>
                        <td colspan="2">

                          {!! Form::text('id',null,array('class'=>'form-control',
                                                         'id'=>'id','rows'=>'5',
                                                         'readonly','required')) !!}
                        </td>
                   </tr>
                	 <tr>
                    	<td>{!! Form::label('name_l','Nombre') !!}</td>
                      <td>
                          {!! Form::text('name',null,array('class'=>'form-control',
                                                         'id'=>'name','rows'=>'5',
                                                         'required','maxlength'=>'25')) !!}
                      </td>
                    </tr>
                    <tr>
                    	<td>{!! Form::label('description_l','Descripción') !!} </td>
                      <td> 
                          {!! Form::textarea('description',
                                              null,array('class'=>'form-control',
                                              'id'=>'description','rows'=>'5')) !!}
                      </td>
                        
                    </tr>
                   
                    <tr>
                       <td>{!! Form::label('unit_price_l','Precio Unitario') !!}</td>
                       <td>
                          {!! Form::input('number', 'unit_price',null,
                                           array('class'=>'form-control',
                                           'id'=>'unit_price','maxlength'=>'8',
                                           'rows'=>'5','step'=>'0.01', ) )  !!}
                       </td>
                    </tr>

                    <tr>
                       <td>{!! Form::label('price_sale','Precio de venta') !!}</td>
                       <td>
                           {!! Form::input('number', 'price_sale',null,
                                           array('class'=>'form-control',
                                           'id'=>'price_sale','maxlength'=>'8',
                                           'rows'=>'5','step'=>'0.01', ) )  !!}
                       </td>
                    </tr>
                    
                    <tr>
                    	<td>{!! Form::label('dateRecord_l','Fecha de Registro') !!} </td>
                      <td>

                          {!! Form::text('dateRecord',null,array('class'=>'form-control',
                                                         'id'=>'dateRecord','rows'=>'5',
                                                         'required','readonly')) !!}
                      </td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<div id="messageUpdate"></div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="modal-footer">
                <input type="submit" value="Editar" class="btn btn-warning"  id="editProduct"/>
            </div>
            </form>
          </div>
        </div>
      </div>




@include('messages._modal-messageAfterUpdateOrDelete')


@endsection