function getProducto(sku){
    return new Promise((resolve, reject)=>{
        $.ajax({
            url:`/productos/sku/${sku}?type=json`,
            method:'get',
            success:function(response){
               resolve(response);
            }
        });
    })
}


function getProductosById(id){
    return new Promise((resolve, reject)=>{
        $.ajax({
            url:`/productos/${id}`,
            method:'get',
            success:function(response){
               resolve(response);
            }
        });
    })
}


function getProductosByCategoria(categoria_id){
    return new Promise((resolve, reject)=>{
        $.ajax({
            url:`/productos/categoria/${categoria_id}`,
            method:'get',
            success:function(response){
               resolve(response);
            }
        });
    })
}


function getAllProductos(){
    return new Promise((resolve, reject)=>{
        $.ajax({
            url:`/productos?type=json`,
            method:'get',
            success:function(response){
               resolve(response);
            }
        });
    })
}