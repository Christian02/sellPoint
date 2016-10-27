@extends('layouts.gentella_master')
@section('content')
<html lang="en-US" ng-app="purchasesApp">
<h2>Listado de compras</h2>
        <div  ng-controller="purchasesController">

            <!-- Table-to-load-the-data Part -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de producto</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio de compra</th>
                        <th>Registro</th>
                        <th>Subtotal</th>
                        <th>
                        	<div ng-controller="SubjectDropDownController" >
							    <div class="dropdown" >
							        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							            Productos
							            <span class="caret"></span>
							        </button>
							        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							            <li ng-repeat="l_products in subjects"><a ng-click="toggle('add', l_products.id)"><% l_products.name %></a></li>
							        </ul>
							    </div>
							</div>
						</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="purchase in purchases | startFrom:(currentPage-1)* pageSize | limitTo:pageSize">
                        <td><%purchase.purchasesId %> </td>
                        <td><%purchase.name %> </td>
                        <td><%purchase.description %> </td>
                        <td><%purchase.amount %> </td>
                        <td><%purchase.unit_price_purchase %></td>
                        <td><% purchase.created_at %></td>
                        <td>  <% ((purchase.amount) * (purchase.unit_price_purchase)) %>  </td>
                        
                        <td>
                            <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', purchase.purchasesId)">Editar</button>
                            <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(purchase.purchasesId)">Eliminar</button>
                        </td>

                    </tr>

                </tbody>
            </table>
            <ul uib-pagination direction-links="false" items-per-page="pageSize"
            	boundary-links="true" total-items="purchases.length" first-text="Primero"
            	last-text="Último"
            	ng-model="currentPage">
            </ul>
            
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel"><%form_title%></h4><!--Recupera el título del form -->
                        </div>
                        <div class="modal-body">
                            <form id="frmAddPurchase"  name="frmAddPurchase" class="form-horizontal" novalidate="">

                                <div class="form-group error">
                                    <label for="inputId" class="col-sm-3 control-label">Código</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="id" name="id" value="<%id%>" 
                                        ng-model="product.id" ng-required="true" readonly="readonly">
										<span class="help-inline" 
                                        	  ng-show="frmAddPurchase.id.$invalid && frmAddPurchase.id.$touched">
                                        	Id es un campo requerido
                                        </span>
   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription" class="col-sm-3 control-label">Descripción</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="description" name="description" placeholder="Descripción" value="<%description%>" 
                                        ng-model="product.description" ng-required="true" readonly="readonly">
                                        <span class="help-inline" 
                                        ng-show="frmAddPurchase.description.$invalid && frmAddPurchase.description.$touched">
                                        Descripción es requerido
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPricePurchase" class="col-sm-3 control-label">Precio de compra</label>
                                    <div class="col-sm-9">
                                       
                                        <input  type="number" step="0.01"
                                   		name="unit_price" id="unit_price" 
        								class="form-control" 
                                   		ng-model="product.unit_price" ng-required="true"/>
                                        <span class="help-inline" 
                                        ng-show="frmAddPurchase.unit_price.$invalid && frmAddPurchase.unit_price.$touched">
                                        Precio de compra es requerido
                                        </span>
                                    </div>
                                </div>
                                
	                             
	                                <div class="form-group">
	                                    <label for="inputAmount" class="col-sm-3 control-label">Cantidad</label>
	                                    <div class="col-sm-9">
	                                       
	                                        <input class="form-control" rows="2" type="number" step="any" 
	                                   		name="amount" id="amount" maxlength="11" ng-model="product.amount" 
	                                   		ng-required="true"/>
	                                        <span class="help-inline" 
	                                        ng-show="frmAddPurchase.amount.$invalid && frmAddPurchase.amount.$touched">
	                                        Cantidad es requerido
	                                        </span>
	                                    </div>
	                                </div>
                                
                
                            </form>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-primary" id="btn-save" 
                           		   ng-click="save(modalstate, id)" 
                           		   ng-disabled="frmAddPurchase.$invalid">Guardar cambios</button>
						</div>
                    </div>
                </div>
            </div>
                
        </div>
           
        <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
        <script src="<?= asset('lib/angular/angular.min.js') ?>"></script>
        <script type="text/javascript" src="lib/angular/ui-bootstrap-tpls-2.2.0.min.js" ></script>
        
   
        <!-- AngularJS Application Scripts -->
        <script src="<?= asset('app/app.js') ?>"></script>
        <script src="<?= asset('app/controllers/purchases.js') ?>"></script>
    
</html>

@endsection