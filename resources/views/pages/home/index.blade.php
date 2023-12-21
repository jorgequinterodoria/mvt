<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = "Home"; // set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<div>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid " >
                    <div class="">
                        <div class="h5 font-weight-bold">Home</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-4 comp-grid " >
                    <?php $rec_count = $comp_model->getcount_clientes();  ?>
                    <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("clientes") ?>' >
                    <div class="row gutter-sm align-items-center">
                        <div class="col-auto" style="opacity: 1;">
                            <i class="material-icons ">people</i>
                        </div>
                        <div class="col">
                            <div class="flex-column justify-content align-center">
                                <div class="title">Clientes</div>
                                <small class="">Total Clientes</small>
                            </div>
                            <h2 class="value"><?php echo $rec_count; ?></h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 comp-grid " >
                <?php $rec_count = $comp_model->getcount_horarios();  ?>
                <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("horarios") ?>' >
                <div class="row gutter-sm align-items-center">
                    <div class="col-auto" style="opacity: 1;">
                        <i class="material-icons ">schedule</i>
                    </div>
                    <div class="col">
                        <div class="flex-column justify-content align-center">
                            <div class="title">Horarios</div>
                            <small class="">Total Horarios</small>
                        </div>
                        <h2 class="value"><?php echo $rec_count; ?></h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 comp-grid " >
            <?php $rec_count = $comp_model->getcount_planes();  ?>
            <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("planes") ?>' >
            <div class="row gutter-sm align-items-center">
                <div class="col-auto" style="opacity: 1;">
                    <i class="material-icons ">apps</i>
                </div>
                <div class="col">
                    <div class="flex-column justify-content align-center">
                        <div class="title">Planes</div>
                        <small class="">Total Planes</small>
                    </div>
                    <h2 class="value"><?php echo $rec_count; ?></h2>
                </div>
            </div>
        </a>
    </div>
</div>
</div>
</div>
</div>
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
