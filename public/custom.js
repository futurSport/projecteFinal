$(document).ready(function(){
    $('.deleteUser').click(function(){
        var id=$(this).attr('data-id');
         var father=$(this).parents("tr");
        $.post( "/practicaFinal/projecteFinal/public/admin-users/delete/"+id, function( data ) {
            
            if(data==1){
                father.hide(1000, function(){
                    father.remove();
                });
            }
            else{
                alert("ERROR AL ELIMINAR USUARI");
            }
        });
    });
});
//<?=$this->url('admin-users', ['action' => 'delete', 'id'=>$user['id']]);?>