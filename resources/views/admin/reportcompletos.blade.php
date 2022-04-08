@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Completos</li>
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
            <div class="col-md-10">
                <h1>RETOS COMPLETOS</h1>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nombre de Usuario</th>
                                <th>Email</th>
                                <th>Nivel Actual</th>
                                <th>Puntos S</th>
                                <th>puntos I</th>
                                <th>Retos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $user)

                                
                                <tr>
                                    
                                    <td>{{ $user->firstname }} {{ $user->lastname }} </td>                
                                    <td>{{ $user->username }} </td>
                                    <td>{{ $user->email }} </td>

                                    <?php 
                                    $numeroiduser = $user->id;                                
                                    $currentlevel = DB::select("SELECT chapters.id, chapters.name, chapters.title FROM challenge_user INNER JOIN challenges ON challenge_user.challenge_id = challenges.id INNER JOIN subchapters ON challenges.subchapter_id = subchapters.id INNER JOIN chapters ON subchapters.chapter_id = chapters.id where user_id = '$numeroiduser' and challenge_id = (SELECT max(challenge_id) FROM challenge_user)");
                                    $currentlevel = json_encode($currentlevel);                                  
                                ?>
                                    <td> {{$currentlevel}}</td>
                                    <td>{{ $user->s_point }} </td>
                                    <td>{{ $user->i_point }} </td>
                                    <td><a href="{{ route('reportcompletos.show', $user->id) }}">Completados</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>        
                </div>
            </div>
            <!-- /.col -->                                
        </div>
    </div>
    <!-- /.box-body -->
</div>
@endsection
