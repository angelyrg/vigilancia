$(document).ready(function(){
    
    $('#btnBuscar').click(function(){
        event.preventDefault();
        var numdni = $('#dni_search').val();
        var link_consulta = "https://dniruc.apisperu.com/api/v1/dni/" + numdni +"?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6IjIwMTcxNDEwNTBAdW5oLmVkdS5wZSJ9.BcwBnatEDNd9Qv1L9kZkA06RQaP9vOj77skUwNpdWUE";
        
        if (numdni!='') {
            $.ajax({
                url : link_consulta,
                success:function(data){
                    $('#icono_cargando').hide();

                    if (data.dni == null){
                        $('#mensaje').show();
                        $('#mensaje').delay(4000).hide(1000);
                    }else{
                        //console.log(data);
                        $('#icono_cargando').hide();
                        $('#nombres').val(data.nombres);
                        $('#apellidos').val(data.apellidoPaterno + " " + data.apellidoMaterno);
                        $('#dni').val(data.dni);   
                        $('#descripcion').focus();
                        
                        
                    }
                },
                error : function() {                        
                    $('#icono_cargando').hide();
                    $('#mensaje').show();
                    $('#mensaje').delay(4000).hide(1000);

                    $('#nombres').val('');
                    $('#apellidos').val('');
                    $('#dni').val('');
                },
                beforeSend: function( ) {
                    $('#icono_cargando').show();
                }

            });
        }else{
            alert('¡Escriba el número de DNI!');
            $('#dni_search').focus();
        }
    });

});