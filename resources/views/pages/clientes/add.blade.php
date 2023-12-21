<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Agregar nuevo"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
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
                        <div class="h5 font-weight-bold text-primary">Agregar nuevo</div>
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
                        <form id="clientes-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('clientes.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="nombre">Nombre <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-nombre-holder" class=" ">
                                                <input id="ctrl-nombre" data-field="nombre"  value="<?php echo get_value('nombre') ?>" type="text" placeholder="Escribir Nombre"  required="" name="nombre"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="edad">Edad <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-edad-holder" class=" ">
                                                <input id="ctrl-edad" data-field="edad"  value="<?php echo get_value('edad') ?>" type="number" placeholder="Escribir Edad" step="any"  required="" name="edad"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="imc">Imc </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-imc-holder" class=" ">
                                                <input id="ctrl-imc" data-field="imc"  value="<?php echo get_value('imc', "NULL") ?>" type="number" placeholder="Escribir Imc" step="0.1"  name="imc"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="correo">Correo <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-correo-holder" class=" ">
                                                <input id="ctrl-correo" data-field="correo"  value="<?php echo get_value('correo') ?>" type="text" placeholder="Escribir Correo"  required="" name="correo"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="celular">Celular <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-celular-holder" class=" ">
                                                <input id="ctrl-celular" data-field="celular"  value="<?php echo get_value('celular') ?>" type="text" placeholder="Escribir Celular"  required="" name="celular"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="eps">Eps <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-eps-holder" class=" ">
                                                <input id="ctrl-eps" data-field="eps"  value="<?php echo get_value('eps') ?>" type="text" placeholder="Escribir Eps"  required="" name="eps"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="telefono">Telefono de emergencia <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-telefono-holder" class=" ">
                                                <input id="ctrl-telefono" data-field="telefono"  value="<?php echo get_value('telefono') ?>" type="text" placeholder="Escribir Telefono de emergencia"  required="" name="telefono"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="foto">Foto </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-foto-holder" class=" ">
                                                <div class="dropzone " input="#ctrl-foto" fieldname="foto" uploadurl="{{ url('fileuploader/upload/foto') }}"    data-multiple="false" dropmsg="Elija archivos o suelte archivos aquí"    btntext="Vistazo" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                    <input name="foto" id="ctrl-foto" data-field="foto" class="dropzone-input form-control" value="<?php echo get_value('foto') ?>" type="text"  />
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Por favor un archivo de elegir</div>-->
                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <!--[form-button-start]-->
                            <div class="form-group form-submit-btn-holder text-center mt-3">
                                <button class="btn btn-primary" type="submit">
                                Guardar
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
    
$(document).ready(function(){
	// custom javascript | jquery codes
});

</script>
@endsection
