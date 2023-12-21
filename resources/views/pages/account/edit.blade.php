<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
?>
@section('content')
<section class="page" data-page-type="edit" data-page-url="{{ url()->full() }}">
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-9 comp-grid " >
                    <div  class="card card-1 border rounded page-content" >
                        <!--[form-start]-->
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("account/edit"); ?>" method="post">
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
                                            <input id="ctrl-user" data-field="user"  value="<?php  echo $data['user']; ?>" type="text" placeholder="Escribir User"  required="" name="user"  class="form-control " />
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
