<p class="text-center">
	<a href="#" class="btn btn-3d btn-success btn-back"><i class="fa fa-angle-left"></i>&nbsp; Regresar atrás</a>
</p>

<script type="text/javascript">
    let btn_back = document.querySelector(".btn-back");

    btn_back.addEventListener('click', function(e){
        e.preventDefault();
        window.history.back();
    });
</script>