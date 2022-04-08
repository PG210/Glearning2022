<?php

namespace App\Http\Controllers\Carga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session\SessionManager;
use App\Archivos\Cargarchivo;


use App\User;
use App\Position;
use App\Area;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;



class SubirArchivoController extends Controller
{
    //

    public function index(Request $request, SessionManager $sessionManager){

      
        //$request->file('archivo')->store('public');
        //dd("subido y guardado");

            if($request->hasFile('uploadedfile')){
                
                $category = new Cargarchivo();
               
                $file = $request->file('uploadedfile');//guarda la variable id en un file
                $name = $file->getClientOriginalName();
                $limpiarnombre = str_replace(array("#", ".", ";", ""), '', $name);
                $val = $limpiarnombre.".".$file->guessExtension();//renombra el archivo subido
                $ruta = public_path("csv/".$val);//ruta para guardar el archivo pdf/ es la carpeta

                
                if($file->guessExtension()=="txt"){
                  
                 copy($file, $ruta);
                 $category->descripcion = $request->input('nombre');
                 $category->ruta = $val;//ingresa el nombre de la ruta a la base de datos
                 $category->save();//guarda los datos
                    //$lines = file($rut);
                    //$utf= array_map('utf8_encode', $lines);
                    //$array =array_map('str_getcsv', $utf);


                    //$sessionManager->flash('mensaje', '');
                    return redirect()->route('cargamasiva')->with('mensaje', 'Archivo cargado con exito');
                }
             
                else{
                    return redirect()->route('cargamasiva')->with('mensaje', 'Archivo no fue cargado');
                }
              
        }
    }

    public function cargar(){
      // $rut = public_path('csv/usuarioscsv.txt');
      // $lines = file($rut);
       //$utf= array_map('utf8_encode', $lines);
        //$array = array_map('str_getcsv', $utf); //datos normalizados
       
           // $msj='';
            $listado = Cargarchivo::all();
                return view('admin.lista_archivos', compact('listado'));
            
        
    }
    public function registrar($file_name){
       $rut = public_path('csv/'.$file_name);
       $lines = file($rut);
       $utf= array_map('utf8_encode', $lines);
       $array = array_map('str_getcsv', $utf); //datos normalizados
       //return $array;
      for($i=1; $i<sizeof($array); ++$i){
          $category = new User();
          $category->firstname=$array[$i][0];
          $category->lastname=$array[$i][1];
          $category->avatar_id=$array[$i][9];
          $category->sexo=$array[$i][3];
          $datovalidar = User::all()->where('username', '=', $array[$i][6])->first();
          
          if($datovalidar==NULL){
           
            $category->username= $array[$i][6];

          } 
        else{
          $nom = $datovalidar->firstname;
          $msj="¡Datos Repetidos: ".$nom.", Cambie el nombre de usuario ò Email!";
          return back()->with('mensaje',$msj);

         }
          $validaremail = User::all()->where('username', '=', $array[$i][2])->first();
          if($validaremail==NULL){
            $category->email= $array[$i][2];
          }
          else{
           $hola='datos duplicados';
           return back()->with('success','Product successfully added.');

         }
          $category->password=Hash::make($array[$i][7]);

         // $user->positions()->attach($array[$i][4]);
          //$user->areas()->attach($array[$I][5]);
          $category->save();

      }
      return back();
    }

  public function eliminar($id){
    //$category = new Cargarchivo();
    $elim = Cargarchivo::findOrfail($id);
    $nom=$elim->ruta;
    $elim->delete();
    $msj="¡Archivo Eliminado: ".$nom.", Eliminado con exito!";
    return back()->with('mensaje',$msj);
  }
       

}
