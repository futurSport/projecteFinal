$(document).ready(function(){
    $('.delete').click(function(){
        var id=$(this).attr('data-id');
        var controller=$(this).attr('data-controller');
        var ruta="/projecteFinal/public/"+controller+"/delete/";
         var father=$(this).parents("tr");
        $.post(ruta+id, function( data ) {
            
            if(data==1){
                father.hide(1000, function(){
                    father.remove();
                });
            }
            else{
                alert("ERROR ");
            }
        });
    });
    
    $('#search').click(function(){
         $('#divBusqueda').css("display", "inline");
         
        $('#search').keyup(function() {
           
             var search=$('#search').val();
             setTimeout(function(){  
             if(search!=''){
                $.post( "/projecteFinal/public/camp/search/"+search, function(data) {
                    document.getElementById('llistaBusqueda').innerHTML='';
                    if(data!="0"){
                         var datas=JSON.parse(data);
                        var resultat=Array.from(datas);
                        for(var i=0; i<resultat.length; i++){
                            var li=$('<li id="libusc">');
                            var base_url = window.location.origin;
                            var a=$('<a href="'+base_url+'/projecteFinal/public/profile/profile/'+resultat[i].id+'">');
                            a.text(resultat[i].name+' '+resultat[i].surname);
                            a.appendTo(li);
                            li.appendTo("#llistaBusqueda");

                        }
                    }
                });
             }
             }, 1000);

        });
    });    
    $('#divBusqueda').mouseleave(function() {
       
        $('#divBusqueda').css("display", "none");
    
    });
    
});
function uploadTempImg(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#img-profile')
        .attr('src', e.target.result)
    };
    reader.readAsDataURL(input.files[0]);
  }
}
function selectComarca(){
    var id_provincia=document.getElementById('provincia').value;
    document.getElementById('selectComarques').innerHTML='';
    if(id_provincia==''){
        id_provincia=0;
    }
$.post( "/projecteFinal/public/profile/select-comarques/"+id_provincia, function( data ) {
        if(data!="0"){
            
            var datas=JSON.parse(data);
            var comarques=Array.from(datas);
            for(var i=0; i<comarques.length; i++){
                var op=$('<option value="'+comarques[i][0]+'">');
                op.text(comarques[i][1]);
                op.appendTo('#selectComarques');
            }
        }
    });
}
//<?=$this->url('admin-users', ['action' => 'delete', 'id'=>$user['id']]);?>