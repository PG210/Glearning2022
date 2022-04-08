<?php

namespace App\Http\Controllers\RegController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Position;
use App\Area;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;

class RegunicoController extends Controller
{
    public function index(){
    $avat=DB::table('avatars')->get();
    
    return view('admin.regunicouser')->with('avat', $avat);
    }

    public function regunico(Request $request){
         
          //validar el usuario
          $uval=$request->nameuser;
          $bususu = DB::table('users')->where('username', '=', $uval)->count();
          //validar Correo
          $ucorreo=$request->correo;
          $buscorreo = DB::table('users')->where('email', '=', $ucorreo)->count();
          if($bususu!=0){
            Session::flash('notuser', 'Usuario ya se encuentra registrado!'); 
          }else{
             if($buscorreo!=0){
                Session::flash('notcorreo', 'Correo ya se encuentra registrado!'); 
             }
             else{
                 //registrar usuario
                 $category = new User();
                 $category->firstname=$request->input('nombre');
                 $category->lastname=$request->input('apellido');
                 $category->avatar_id=$request->input('avatar');
                 $category->sexo=$request->input('sexo');
                 $category->username= $request->input('nameuser');
                 $category->email= $request->input('correo');
                 $category->password=Hash::make($request->input('password_confirmation'));
                 $category->save();
                 Session::flash('usu_reg', 'Usuario registrado con éxito!');
             }

          }
       return back();
    }
}
