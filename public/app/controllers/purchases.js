
app.controller('purchasesController', function($scope, $http, API_URL) {
    $scope.pageSize=5;
    $scope.currentPage=1;
    $http.get("purchases")
            .success(function(response) {
                $scope.purchases = response; 
    });
    $scope.toggle = function(modalstate,id){
      $scope.modalstate = modalstate;
      switch(modalstate)
      {  
        case 'add':
            $scope.form_title = "Añadir Compra";
            $scope.id = id;
            $http.get('purchasesAdd/'+id) 
                    .success(function(response)
                    {
                        $scope.product= response; 
                    });
            break;
        case 'edit':
            $scope.form_title = "Editar compra";
            $scope.id = id;
            
            $http.get('purchasesShow/'+id) 
                    .success(function(response)
                    {
                        $scope.product= response; /*Retorna la  respuesta del servidor ante la petición*/   
                        $scope.product.unit_price = $scope.product.unit_price_purchase;  
                       
                       
                    });
            break;

      }
      $('#myModal').modal('show'); /*Muestra la ventana modal*/
    }

    $scope.save = function(modalstate,id)
    {
        var url="";
        url=(modalstate==='edit') ? 'purchasesUpdate'+'/'+id : 'purchasesStore';
        $http(
        {
            method:'POST',    
            url:url,
            data:$.param($scope.product),
            headers:{'Content-Type':'application/x-www-form-urlencoded'}
        }).success(function(response)
        {
            
            $('#frmAddPurchase')[0].reset();
            $scope.product={};
            location.reload();
        }).error(function(resonse)
        {
            alert('Esto es embarazoso . Un error ha ocurrido');
        });
        
    }

    //delete a record
    $scope.confirmDelete = function(id)
    {
        var isConfirmDelete = confirm('¿Estás seguro que quieres eliminar este registro?');
        if(isConfirmDelete)
        {
            $http(
            {
                method:'DELETE', 
                url:'purchasesDelete/'+id 
            }).     success(function(data)
                    {
                        location.reload();
                    }).
                    error(function(data)
                    {
                        alert('No se puede eliminar');  
                    });
        }else 
        {
            return false;
        }
        
        
    }
    
    
});
app.controller('SubjectDropDownController', function ($scope,$http,API_URL) {
    $http.get( "purchasesGetProducts")
            .success(function(response) {
                $scope.subjects = response;
        });
});

