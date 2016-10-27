
<div id="target-content">
		                    
	<table id="datatable" class="table table-striped table-bordered">
			                      <thead>
			                        <tr>
			                          <th>Folio</th>
			                          <th>Código</th>
			                          <th>Nombre</th>
			                          <th>Cantidad</th>
			                          <th>Precio de venta</th>
			                          <th>Fecha</th>
			                          <th>Total</th>
			                          <th>Acciones</th>
			                        </tr>
			                      </thead>
			                      <tbody>
			                        @foreach( $sales as $sale)
			                       		<tr>
			                       		<td >{{{$sale->folio}}}</td>
				                             <td>{{{$sale->id }}} </td>
		        							 <td>{{{$sale->name}}}</td>
				                             <td>{{{$sale->amount}}}</td>
				                             <td>{{{$sale->price_sale}}}</td>
				                             <td>{{{ date('Y-m-d', strtotime($sale->created_at)) }}}</td>
				                             <td>{{{($sale->price_sale * $sale->amount)}}}</td>
				                             <td>
				                             	<a href="javascript:edit_sale({{{ $sale->saleId }}})" class="glyphicon glyphicon-edit"> </a>
				                             	<a href="javascript:delete_sale( {{{ $sale->saleId }}} )" class="glyphicon glyphicon-remove-circle"></a>
				                             </td>
			                       		</tr>
			                       @endforeach
			                        
			                      </tbody>
	</table>					{{{ $sales->appends( Request::except('page') )->links() }}}
	
</div>							