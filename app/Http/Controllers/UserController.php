<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subchapter;
use App\User;
use App\Challenge;
use App\Area;
use App\Position;
use Auth;
use DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $countusers = DB::table('users')->count();
        $status="";

        $users = User::all();
        return view('admin.usuarios', [
            'users' => $users,
            'countusers' => $countusers,
        ])->with('status', $status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Auth::logout();
        return Redirect('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $usuarios = User::find($id);     
        $areas = $usuarios->areas()->first();
        $position = $usuarios->positions()->first();

        $avatars = DB::table('avatars')->get();    
        return view('admin.usuariosEdit')
                                ->with('usuarios', $usuarios)
                                ->with('avatars', $avatars)
                                ->with('areas', $areas)
                                ->with('positions', $position);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate(request(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::find($id);

        //DB::table('users')->where('id', '=', $id)->delete();
        
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->avatar_id = $request->avatar_id;
        $user->sexo = $request->AvatarSexo;

        $user->save();

        return back();        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $users = User::find($id);
        $allusers = User::all();
          
        //codigo actualizado
       // $area = DB::table('area_user')->where('user_id', '=', $id)->first();
        //$puser = DB::table('position_user')->where('user_id', '=', $id)->first();

        //$area->delete();
        //$puser->delete();
       // $users->delete();
        //return back();

       $status="";
        $count=0;
        $countuserchallenge=0;
        $countaea=0;
        
        $countuserchallenge+=count($users->challenges);
        $countaea+=count($users->areas);
        $count+=count($users->subchapters);
        

        if ($count>0 || $countuserchallenge>0) {
            $status = 'El Usuario esta relacionado con un Subcapitulo o alguna Actividad, Imposible eliminar';
        } else {
            User::find($id)->areas()->detach();
            User::find($id)->positions()->detach();
            User::destroy($id);
            $status = 'Eliminado correctamente';
        }
        
        return view('admin.usuarios')->with('status', $status)->with('users', $allusers);                
    }
}
