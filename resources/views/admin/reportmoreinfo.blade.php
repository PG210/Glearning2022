@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ url('/reportcompletos') }}"><i class="fa fa-dashboard"></i> Retos Completos</a></li>
    <li><a href="{{ url('/reportcompletos/'.$idusuario) }}"><i class="fa fa-dashboard"></i> Detalle Completos</a></li>
    <li class="active">Detalle Evidencias</li>
    </ol>
</section>
@endsection

@section('usuarios')

<div class="box box-default" style="margin-top: 5%;">
    <div class="box-header with-border">
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">

            <h1>RETOS COMPLETOS</h1>
            
            @foreach($infocomplete as $info)

            <div class="container">
                <h3 class="col-md-12">Informacion de Usuario</h3>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="name">id Usuario</label>
                        <input type="text" class="form-control" value="{{ $info->id_usuario }}" disabled>                       
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group col-md-3">
                        <label for="name">Nombre Usuario</label>
                        <input type="text" class="form-control" value="{{ $info->Usuario}}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">Apellido</label>
                        <input type="text" class="form-control" value="{{ $info->Apellido }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->                    
                </div>
                <div class="row">
                    <h3 class="col-md-12">Informacion de Reto</h3>
                    <div class="form-group col-md-1">
                        <label for="name">Id Reto</label>
                        <input type="text" class="form-control" value="{{ $info->id_reto }}" disabled>                       
                    </div>                                    
                    <div class="form-group col-md-1">
                        <label for="name">Tiempo </label>
                        <input type="text" class="form-control" value="{{ $info->tiempo }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->
                    <div class="form-group col-md-2">
                        <label for="name">Material </label>
                        <input type="text" class="form-control" value="{{ $info->material }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->
                    <div class="form-group col-md-3">
                        <label for="name">Nombre Reto</label>
                        <input type="text" class="form-control" value="{{ $info->nombre_reto }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->
                </div>
                <div class="row">                                     
                    <!-- /.form-group -->
                    <div class="form-group col-md-3">
                        <label for="name">Palabras</label>
                        <input type="text" class="form-control" value="{{ $info->palabras }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->
                    <!-- /.form-group -->
                    <div class="form-group col-md-10">
                        <label for="name">Descripcion </label>
                        <textarea class="form-control" rows="5" name="desc" disabled>{{ $info->descripcion }}</textarea>            
                    </div>   
                </div>

                @if ($info->video)                    
                <div class="row">
                    <h3 class="col-md-12">Video del reto</h3>
                    <!-- /.form-group -->
                    <div class="form-group col-md-12">
                       <iframe width="600" height="315" src="{{ $info->video }}" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                   </div>  
                </div>
                @endif

                <div class="row">
                    <h3 class="col-md-12">puntos obtenidos por el usuario</h3>
                    <div class="form-group col-md-2">
                        <label for="name">Puntos S </label>
                        <input type="text" class="form-control" value="{{ $info->S_ganados }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->
                    <div class="form-group col-md-2">
                        <label for="name">Puntos I </label>
                        <input type="text" class="form-control" value="{{ $info->I_ganados }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->
                    <div class="form-group col-md-2">
                        <label for="name">Puntos G </label>
                        <input type="text" class="form-control" value="{{ $info->G_ganados }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->
                </div>

                @if($info->Evidencia_Salidas)
                <div class="row">
                    <h3 class="col-md-12">Evidencias Obtenidas</h3>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="name">Salidas </label>
                        <textarea class="form-control" rows="5" disabled>{{ $info->Evidencia_Salidas }}</textarea>
                    </div>                                    
                    <!-- /.form-group -->
                    <div class="form-group col-md-3">
                        <label for="name">Imagen Salidas </label>
                        <img src="{{ asset($info->imagen_Salidas)}}" width="90%">                     
                    </div>                                    
                    <!-- /.form-group -->
                </div>
                @endif

                @if($info->Evidencia_Fotografia)
                <div class="row">
                    <h3 class="col-md-12">Evidencias Obtenidas</h3>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="name">Evidencia Fotografias</label>
                        <textarea class="form-control" rows="5" disabled>{{ $info->Evidencia_Fotografia }}</textarea>
                    </div>                                    
                    <!-- /.form-group -->
                    <div class="form-group col-md-3">
                        <label for="name">Fotografias</label>
                        <img src="{{ asset($info->imagen_Fotografia)}}" width="90%">                     
                    </div>                                    
                    <!-- /.form-group -->
                </div>                    
                @endif

                @if ($info->Evidencia_Lecturas)
                <div class="row">
                    <h3 class="col-md-12">Evidencias Obtenidas</h3>
                </div>
                <div class="row">                
                    <div class="form-group col-md-8">
                        <label for="name">Evidencia Lecturas</label>
                        <textarea class="form-control" rows="5" disabled>{{ $info->Evidencia_Lecturas }}</textarea>
                    </div>                                    
                    <!-- /.form-group -->
                </div>
                @endif

                @if ($info->Evidencia_videos)
                <div class="row">
                    <h3 class="col-md-12">Evidencias Obtenidas</h3>
                </div>
                <div class="row">                    
                    <div class="form-group col-md-8">
                        <label for="name">Evidencia Videos</label>
                        <textarea class="form-control" rows="5" disabled>{{ $info->Evidencia_videos }}</textarea>                                            
                    </div>                                    
                    <!-- /.form-group -->
                </div>
                @endif
            </div>

            @endforeach                              
        </div>
    </div>
    <!-- /.box-body -->
</div>







@endsection
