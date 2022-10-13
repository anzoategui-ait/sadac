<?php
if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3) {
    $lc->forzar_cierre_sesion_controlador();
    exit();
}
if ($_SESSION['tipo_tor'] != 1 && $_SESSION['tipo_tor'] != 2 && $_SESSION['tipo_tor'] != 4) {
    $lc->redireccionar_pagina_controlador();
    exit();
}

require_once './controladores/kategoriaControlador.php';
$ins_kategoria = new kategoriaControlador();
$kategorias = $ins_kategoria->datos_kategoria_controlador("Todos", 0);
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Productos por categoria</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>producto-new/">Nuevo producto <span class="fa-angle-right fa"></span></a> 
                <a href="<?php echo SERVERURL; ?>producto-list/">Lista de productos <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>producto-categoria/">Por categoria <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>producto-search/">Buscar producto <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>

<div class="container-fluid">
    <?php
    // require_once "./php/main.php";
    ?>
    <div class="row">
           <div class="col-12 col-md-3">
            <h2 class="text-center roboto-medium">Categorías</h2>
            <?php
            if ($kategorias->rowCount() > 0) {
                $kategorias = $kategorias->fetchAll();
                foreach ($kategorias as $row) {

                    echo '<a href="' . SERVERURL . 'producto-categoria/' . $ins_kategoria->encryption($row['kategoria_id']) . '/" class="btn btn-raised btn-info">' . $row['kategoria_nombre'] . '</a><br>';
                }
            } else {
                echo '<p class="text-center roboto-medium" >No hay categorías registradas</p>';
            }
            $kategorias = null;
            ?>
           </div>
        
                <div class="col-12 col-md-9">
                
                    <?php
                    $kategoria_id = (isset($pagina[1])) ? $pagina[1] : 0;

                    /* == Verificando kategoria == */
                    $check_kategoria = $ins_kategoria->datos_kategoria_controlador("Unico", $kategoria_id);

                    if ($check_kategoria->rowCount() > 0) {

                        $check_kategoria = $check_kategoria->fetch();

                        echo '
                        <h2 class="title text-center roboto-medium">' . $check_kategoria['kategoria_nombre'] . '  </h2>
                        <p class="text-center roboto-medium pb-6">&nbsp;&nbsp;&nbsp;  ' . $check_kategoria['kategoria_ubicacion'] . '</p>
                    ';
                        $kategoria_id_desencriptado = $check_kategoria['kategoria_id'];

                        //Coloco la lista producto kategoria
                        require_once "./controladores/productoControlador.php";
                        $ins_producto = new productoControlador();
                        echo $ins_producto->paginador_producto_controlador($pagina[2], 5, $_SESSION['privilegio_tor'], $_SESSION['id_tor'], $pagina[0] . '/' . $pagina[1], "", $kategoria_id_desencriptado);
                    } else {
                        echo '<h2 class="text-center roboto-medium title" >Seleccione una categoría para empezar</h2>';
                    }
                    $check_kategoria = null;
                    ?>
              
</div>
      
</div>
</div>

