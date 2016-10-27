
<div  id="message"></div>
<div id ="addTable">
       <table id="datatable" class="table table-striped table-bordered">
                 <thead>
                     <th>Código</th>
                     <th>Nombre</th>
                     <th>Descripción</th>
                     <th>Precio unitario</th>
                     <th>Precio de venta</th>
                     <th>Fecha de registro</th>
                     <th>Acción</th>
                 </thead>
            	 <tbody>
                       @foreach( $products as $product)

                       		 <tr>
                             <td scope="row">{{{$product->id}}}</td>
                             <td>{{{$product->name}}}</td>
                             <td>{{{$product->description}}}</td>
                             <td>{{{$product->unit_price}}}</td>
                             <td>{{{$product->price_sale}}}</td> 
                             <td>{{{date('Y-m-d', strtotime($product->created_at)) }}}</td>
                             <td>
                             <a href="javascript:editProduct({{{ $product->id }}})" class="glyphicon glyphicon-edit"></a> 
                             <a href="javascript:deleteProduct({{{ $product->id }}})" class="glyphicon glyphicon-remove-circle"></a>

                             </td>
                        </tr>
                       @endforeach


                   

            	</tbody> 
             </table>
</div>