function seleccionar_parroquia(id){
        var parametros = {
                "id" : id,
        };
        $.ajax({
                data:  parametros,
                url:   './controladores/seleccionar_parroquia.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado_parroquia").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#resultado_parroquia").html(response);
                }
        });
}