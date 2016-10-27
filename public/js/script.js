
$(function()
{
    var delay = (function()
    {
  		var timer = 0;
	  	return function(callback, ms)
        {
	       clearTimeout (timer);
	       timer = setTimeout(callback, ms);
  		};
	})();          
    $('#amountProduct').on('keyup',function()
    { 
        delay(function()
        { 
            var codeProduct = $('#codeProduct').val();
            if(!codeProduct){
                alert("Debe capturar el código de producto");
                return false;
            }
			var url = 'fillTable';
            var data =	$('#form_counter_sale').serialize(); 
			var dataType='html'; 
			callAjax(url,data,dataType,onSuccess);
			function onSuccess(param) 
			{
    			if(param!=' ')
    			{
                    $('#mytable').css("visibility", 'visible');
    				$('#form_counter_sale')[0].reset();
                    $('#addRow').append(param);
                    calculateAmount(); 
    			}else
    			{
                    alert("Producto no encontrado");
                    $('#form_counter_sale')[0].reset();
    			}
				}
        }	, 1000); 
	});
        $("#mytable").on('click','.remove',function()
        {
            $(this).parent().parent().remove();
            var rowCount = $('#mytable tr').length;
            if(rowCount<=1){
                var sum=0;
                $('#add').html(sum);
            }else{
                calculateAmount();
            }
                      
        });
        function calculateAmount() 
        {
            var sum=0;
            $('#mytable .amount').each(function()
            {  
                sum= sum+parseFloat(($(this).html()));
                $('#add').html(sum);
            });
        }
});  //Colección de funciones para sostener la vista de venta de productos 
function editProduct(id)
{
    var url ='editProduct';
    var data= 'id='+id;
    var dataType='text';
    callAjax(url,data,dataType,successLoadProduct);
    function successLoadProduct(values) 
    {
        var sale= eval(values);
        $('#editProduct').show();
        $('#id').val(sale[0]);
        $('#name').val(sale[1]);
        $('#description').val(sale[2]);
        $('#unit_price').val(sale[3]);
        $('#price_sale').val(sale[4]);
        $('#dateRecord').val(sale[5]);
        $('#edit-modal').modal({
                        show:true,
                        backdrop:'static'
                    });
    }
}
 function update_product()  
 {
    var url = 'updateProduct';
    var data =  $('#formEditProduct').serialize(); 
    var dataType='html';
    callAjax(url,data,dataType,successEditProduct);
    function successEditProduct(data)
    {
            $('#formEditProduct')[0].reset();
            $('#modal-body').html("Producto actualizado correctamente.");
            $('#myModal').modal({
                    show:true,
                    backdrop:'static'
            });
            setTimeout(function(){
                $("#myModal").modal('hide');
            }, 2000);
            $('#edit-modal').modal('hide');
            $('#addTable').html(data);
    }
    return false;
 }
 function deleteProduct(id)
 {
    var url = 'deleteProduct'+'/'+id;
    var data =id; 
    var dataType='html';
    var question = confirm('¿Esta seguro de eliminar este producto?');
    if (question==true){
        callAjax(url,data,dataType,successDeleteProduct);
        function successDeleteProduct(data)
        {
            $('#modal-body').html("Producto eliminado correctamente.");
            $('#myModal').modal({
                    show:true,
                    backdrop:'static'
            });
            setTimeout(function(){
                $("#myModal").modal('hide');
            }, 2000);
            $('#addTable').html(data); 
        }
    }else{
        return false;
    }
 }

/*
Acciones para ventas
*/
function edit_sale(id)
{
    var url ='editSale';
    var data= 'id='+id;
    var dataType='text';
    callAjax(url,data,dataType,successLoadSale);
    function successLoadSale(values) 
    {
        var sale= eval(values);
        $('#editSubmit').show();
        $('#id').val(sale[0]);
        $('#folio').val(sale[1]);
        $('#name').val(sale[2]);
        $('#price_sale').val(sale[3]);
        $('#amount').val(sale[4]);
        $('#date').val(sale[5]);
        $('#editSaleModal').modal({
                    show:true,
                    backdrop:'static'
                });
        return false;
    }
}
 function update_sale()  
 {
    var url = 'updateSale';
    var data =  $('#formEditSale').serialize(); 
    var dataType='html';
    callAjax(url,data,dataType,successEditProduct);
    function successEditProduct(data)
    {   
        $('#formEditSale')[0].reset();
        $('#modal-body').html("Venta actualizada correctamente.");
        $('#myModal').modal({
                        show:true,
                        backdrop:'static'
                    });
        setTimeout(function(){
                $("#myModal").modal('hide');
            }, 2000);
        $('#editSaleModal').modal('hide');
        $('#contentTable').html(data)     
    }
    return false;

 }
 function delete_sale(id)
 {  
    var url = 'deleteSale';
    var data ='id='+id; 
    var dataType='html';
    var question = confirm('¿Está seguro de eliminar esta venta?');
    if (question==true){
        callAjax(url,data,dataType,successDeleteSale);
        function successDeleteSale(data)
        {
            $('#modal-body').html("Venta eliminada correctamente.");
            $('#myModal').modal({
                    show:true,
                    backdrop:'static'
            });
            setTimeout(function(){
                $("#myModal").modal('hide');
            }, 2000);
            $('#contentTable').html(data);
        }
    }else{
        return false;
    }
 }
/*Termina acciones para ventas*/
$("#register").click(function()
{   
    var url = 'store';
    var data =  $('#form_product').serialize();
    var dataType = 'text';
    callAjax(url,data,dataType,successCallback);
    function successCallback(param) 
    {
        $('#form_product')[0].reset();
        $('#message').
        addClass('alert alert-success').
        html(param).show(200).delay(2500).
        hide(200);
    }				
});
/*Evento click para realizar una venta en mostrador*/
$("#sell_counter").click(function(){
    var url = 'storeSale';
	var dataProducts = [];
    $('#mytable td').each(function() 
        {
            var td = $(this).text(); 
            dataProducts.push(""+td+"");
        });
    if(dataProducts.length == 0)
    { 
        $('#message').
        addClass('alert alert-danger').
        html('Debe capturar al menos un producto para vender').
        show(200).
        delay(2500).
        hide(200);
        return false;
    }else
    {
        var jsonProducts= JSON.stringify(dataProducts);
        var receivables = parseFloat($('#receivables').val() );
        var totalToCharge= parseFloat( $('#add').text() ) ;
        if( $('#receivables').val()=="")
        {
            $('#message').
            addClass('alert alert-danger').
            html('Debe capturar el efectivo recibido').
            show(200).
            delay(2500).
            hide(200);
            return false;
        }
        if(receivables < totalToCharge)
        {
            alert("El efectivo es menor que el total");
            $('#receivables').val('');
        }else
        {

            var data ='dataProducts='+jsonProducts+'&dataReceivables='+receivables+'&dataTotalToCharge='+totalToCharge;
            var dataType = 'text';
            callAjax(url,data,dataType,successSellCounter);
            function successSellCounter(param)
            {   
                $('#form_counter_sale')[0].reset();
                $('#message').removeClass('alert alert-danger');            
                $('#mytable .remove').parent().parent().remove(); /*Se hace el reseteo de la tabla*/
                $('#add').html('');
                $('#receivables').val('');
                $('#messageModal').modal(
                                    {
                                        show:true,backdrop:'static'
                                    });
                $('#getChange').val(param);
                $('#closeModal').click(function()
                                    {
                                        $("#messageModal").modal('hide');
                                        $('#getChange').val('');
                                    });
            }
        }  
    }

});

$("#change").click(function()
{   
    var url = 'getChange';
    var receivables = parseFloat($('#receivables').val() );
    var totalToCharge= parseFloat( $('#add').text() ) ;
    if( $('#receivables').val()=="")
    {
        return false;
    }
    if(receivables < totalToCharge)
    {
        alert("El efectivo es menor que el total");
        $('#receivables').val('');
    }else
    {
        var data =  '&dataReceivables='+receivables+'&dataTotalToCharge='+totalToCharge;
        var dataType = 'text';
        callAjax(url,data,dataType,successChange);
        function successChange(data) 
        {
            $('#receivables').val('');
            $('#messageModal').modal({
                                 show:true,backdrop:'static',       
                                });
            $('#getChange').val(data);
            $('#closeModal').click(function()
            {
                $("#messageModal").modal('hide');
                                    $('#getChange').val('');
                                    });
                                         
        }
    }               
});

/*Función genérica para llamadas a Ajax*/
    function callAjax(urlparam,dataparam,dataType,successCallback)
	{
 
		$.ajax({
		    type: "POST",  
		    dataType:dataType,
		    headers: {
	    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  		},
		    url: urlparam,
		    data:dataparam, 
		    success: successCallback    
		});
	}