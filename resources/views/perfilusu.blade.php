<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Actualizar</title>
    <style>

      body {
          background-image: url("{{asset('dist/img/LOG_BG.jpg')}}");
          background-attachment: fixed;
          background-repeat: no-repeat;
          background-size: cover;
          }
          footer {
            
          text-align: center;
          padding: 3px;
          background-color:#4b42bc;
          color: white;
          
            
          
        }
</style>
  </head>
  <body>
    <br>
      <h1 class="text-center"  style="color:#1ED5F4";>Bienvieni@ Actualiza Tu Perfil <b> {{Auth::user()->firstname}}</b></h1>
      <hr>
    <br>
   
<div class="container" >
    <div class="tab-pane" id="timeline">
          <form action="{{route('actualizarusu', $usu[0]->userid)}}" method="POST">
          @csrf
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne" style="color:black; background-color:#1bf9cd">
                    <h4 class="panel-title">
                        <a style="text-decoration: none;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h4> Datos Personales </h4>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <!--formulario -->
                          <br>
                        <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$usu[0]->firstname}}">
                               </div>          
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="{{$usu[0]->lastname}}">
                            </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="genero">Genero</label>
                                <input type="text" class="form-control" id="genero" name="genero" value="{{$usu[0]->sexo}}">
                            </div>
                            </div>
                           </div>                      
                  
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$usu[0]->email}}">
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" value="{{$usu[0]->username}}">
                            </div>
                           </div>
                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass">Actualizar Contraseña</label>
                                <input type="password" class="form-control" id="pass" name="pass">
                            </div>
                           </div>
                        </div>
               

                         <!--end formulario--->
                    </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo" style="color:black; background-color:#ffbd03">
                    <h4 class="panel-title">
                        <a style="text-decoration: none;" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                       <h4> Elegir Avatar Femenino </h4>
                        </a>
                    </h4>                  
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                      <!--Elegir Avatars-->
                                <!---formulario-->
                               
                                @foreach($avatar as $a)
                                <div class="row">
                                      <div class="col-md-7">
                                          <div class="input-group">
                                           <h3>{{$a->name}}</h3>
                                           <p style="text-align: justify; text-justify: inter-word;">{{$a->description}}</p>
                                          </div><!-- /input-group -->
                                      </div><!-- /.col-lg-6 -->
                                      <div class="col-md-3">
                                          <div class="input-group">
                                                  <br><br><br><br>
                                                  <img src="{{asset($a->img)}}" style="width: 100px; height: 100px;" >
                                          </div><!-- /input-group -->
                                      </div><!-- /.col-lg-6 -->
                                          <div class="col-md-2">
                                            <br>
                                          <label for="nombre"> Seleccionar</label>
                                          <br><br> <br><br>
                                          <input type="radio" id="contactChoice1"
                                            name="avat" value="{{$a->id}}" required>
                                            <label for="contactChoice1"> </label>
                                          
                                          </div><!-- /.col-lg-6 -->
                                  </div><!-- /.row -->
                                  @endforeach 
                      <!---End finalizar-->
                    </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTre"  style="color:black; background-color:#2BFF92">
                    <h4 class="panel-title">
                        <a style="text-decoration: none;" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTre" aria-expanded="false" aria-controls="collapseTre">
                        <h4>Elegir Avatar Masculino</h4>
                        </a>
                    </h4>
                    </div>
                    <div id="collapseTre" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTre">
                    <div class="panel-body">
                      <!--Elegir Avatars-->
                                <!---formulario-->
                                @foreach($avatarm as $m)
                                <div class="row">
                                      <div class="col-md-7">
                                          <div class="input-group">
                                           <h3>{{$m->name}}</h3>
                                           <p style="text-align: justify; text-justify: inter-word;">{{$m->description}}</p>
                                          </div><!-- /input-group -->
                                      </div><!-- /.col-lg-6 -->
                                      <div class="col-md-3">
                                          <div class="input-group">
                                                  <br><br><br><br>
                                                  <img src="{{asset($m->img)}}" style="width: 100px; height: 100px;" >
                                          </div><!-- /input-group -->
                                      </div><!-- /.col-lg-6 -->
                                      <div class="col-md-2">
                                        <br>
                                      <label for="nombre"> Seleccionar</label>
                                       <br><br> <br><br>
                                       <input type="radio" id="contactChoice1"
                                         name="avat" value="{{$m->id}}" required>
                                        <label for="contactChoice1"> </label>
                                       
                                      </div><!-- /.col-lg-6 -->
                                  </div><!-- /.row -->
                                  @endforeach 
                      <!---End finalizar-->
                    </div>
                    
                    </div>
                     
                </div>

                </div>
             <!--buton enviar-->
             <br>
               <button type="submit"  class="btn" style="color:black; background-color:#47EACD">
                      Continuar
              </button>
              <a href="/home" type="button"  class="btn" style="color:black; background-color:#4EFF6B">
                      Atras
              </a>
             
          </div>
          </form>
          </div>

      </div>
      <br>
  </body>
</html>