<?php
//crear listado de municipios y listado de oficios 
require_once './controladores/solicitudControlador.php';
$ins_solicitud = new solicitudControlador();

//obtener todos los municipios
require_once './controladores/municipioControlador.php';
$ins_municipio = new municipioControlador();

$municipios = $ins_municipio->datos_municipio_controlador("Todos", 0);

//Obtener listado de todas las parroquiaes registradas en el sistema
require_once './controladores/parroquiaControlador.php';
$ins_parroquia = new parroquiaControlador();
$parroquias = $ins_parroquia->datos_parroquia_controlador("Todos", 0);
?>

<?php
if (!isset($_SESSION['busqueda_consulta']) && empty($_SESSION['busqueda_consulta'])) {
//el empty() para saber si esta vacia y el isset() para saber si esta definida
    ?>

    <div class="container-fluid"> <!-- wrapper -->
        <div class="row" style="margin-top:100px !important;"> 
            <div class="col-md-6">
                <div class="panel panel-default">

                    <div class="panel-body">

                        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="modulo" value="consulta">
                            <h3 class="animated fadeInLeft text-center">CONSULTAR SU SOLICITUD</h3>


                            <div class="col-md-12">
                                <div class="form-group form-animate-text" style="margin-top:20px !important;">
                                    <input type="text" class="form-text" name="busqueda_inicial" id="inputSearch" maxlength="30" required="">
                                    <span class="bar"></span>
                                    <label for="usuario_dni">Ingrese su número de Cedula</label>
                                </div>
                            </div>


                            <div class="col-md-4">

                                <a href="<?php echo SERVERURL . 'solicitud/'; ?>"  class="btn btn-round btn-success"><i class="fa fa-search"></i> &nbsp;Volver</a>

                            </div>
                            <div class="col-md-8 text-center">
                                <button type="submit" class="btn btn-round btn-info">
                                    <i class="fa fa-search"></i> &nbsp;
                                    <span class="state">Consultar</span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php
} else {
    ?> 
    <div class="col-md-9">
        <div class="panel">

            <div class="panel-body"> 
                <div class="container-fluid">
                    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
                        <input type="hidden" name="modulo" value="consulta">
                        <input type="hidden" name="eliminar_busqueda" value="eliminar">
                        <div class="container-fluid">

                            <div class="col-12 col-md-12">
                                <p class="text-center" style="font-size: 20px;">
                                    Resultados de la busqueda <strong>"<?php echo $_SESSION['busqueda_consulta']; ?>"</strong>
                                </p>
                            </div>
                            <div class="col-12">
                                <p class="text-center" style="margin-top: 20px;">
                                    <button type="submit" class="btn btn-3d btn-danger"><i class="far fa-trash-alt"></i> &nbsp; ELIMINAR BÚSQUEDA</button>
                                </p>
                            </div>

                        </div>
                    </form>
                </div>
                <br><hr>

                <div class="container-fluid">
                    <div class="col-md-12">


                        <?php
                        require_once "./controladores/solicitudControlador.php";
                        $ins_solicitud = new solicitudControlador();
                        echo $ins_solicitud->paginador_consulta_ciudadano_controlador($pagina[1], 5, $pagina[0], $_SESSION['busqueda_consulta']);
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>