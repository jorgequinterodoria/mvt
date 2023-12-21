<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Editar"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="edit" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto  back-btn-col" >
                    <a class="back-btn btn " href="{{ url()->previous() }}" >
                        <i class="material-icons">arrow_back</i>                                
                    </a>
                </div>
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">Editar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-9 comp-grid " >
                    <div  class="card card-1 border rounded page-content" >
                        <!--[form-start]-->
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("usuarios/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="nombre">Nombre <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-nombre-holder" class=" ">
                                            <input id="ctrl-nombre" data-field="nombre"  value="<?php  echo $data['nombre']; ?>" type="text" placeholder="Escribir Nombre"  required="" name="nombre"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="user">User <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-user-holder" class=" ">
                                            <input id="ctrl-user" data-field="user"  value="<?php  echo $data['user']; ?>" type="text" placeholder="Escribir User"  required="" name="user"  data-url="componentsdata/usuarios_user_value_exist/" data-loading-msg="Comprobando disponibilidad ..." data-available-msg="Disponible" data-unavailable-msg="No disponible" class="form-control  ctrl-check-duplicate" />
                                            <div class="check-status"></div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="foto">Foto <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-foto-holder" class=" ">
                                            <div class="dropzone required" input="#ctrl-foto" fieldname="foto" uploadurl="{{ url('fileuploader/upload/foto') }}"    data-multiple="false" dropmsg="Elija archivos o suelte archivos aquí"    btntext="Vistazo" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                <input name="foto" id="ctrl-foto" data-field="foto" required="" class="dropzone-input form-control" value="<?php  echo $data['foto']; ?>" type="text"  />
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Por favor un archivo de elegir</div>-->
                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                            </div>
                                        </div>
                                        <?php Html :: uploaded_files_list($data['foto'], '#ctrl-foto'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="id_rol">Id Rol <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-id_rol-holder" class=" ">
                                            <input id="ctrl-id_rol" data-field="id_rol"  value="<?php  echo $data['id_rol']; ?>" type="number" placeholder="Escribir Id Rol" step="any"  required="" name="id_rol"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-ajax-status"></div>
                        <!--[form-content-end]-->
                        <!--[form-button-start]-->
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">
                            Actualizar
                            <i class="material-icons">send</i>
                            </button>
                        </div>
                        <!--[form-button-end]-->
                    </form>
                    <!--[form-end]-->
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
<!-- Page custom css -->
@section('pagecss')
<style>

</style>
@endsection
<!-- Page custom js -->
@section('pagejs')
<script>
    <!--pageautofill-->
$(document).ready(function(){
	// custom javascript | jquery codes
});

</script>
@endsection
