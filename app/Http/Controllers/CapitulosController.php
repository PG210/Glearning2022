<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chapter;
use App\Subchapter;
use DB;
use Auth;

class CapitulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $status = "";
        $capitulos = Chapter::all();        
        return view('admin.capitulos')->with('capitulos', $capitulos)->with('status', $status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.CapitulosCreate');
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
        $status = "";
        $capitulo = new Chapter;
        $capitulo->name = $request->name;
        $capitulo->title = $request->title;
        $capitulo->order = $request->order;
        $capitulo->time = $request->time;
        $capitulo->description = $request->description;

        $capitulo->save();
        
        $capitulos = Chapter::all();        
        return view('admin.capitulos')->with('capitulos', $capitulos)->with('status', $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
        // ====================== PUNTAJES S EN CAPITULOS vs SUBCAPITULOS ==========================
        //cantidad puntos maximos de un capitulo
        $chapter = 100;

        //cantidad de subcapitulos en el capitulo actual
        $subchapters = DB::table('subchapters')->where('chapter_id', $id)->count();
        
        //cantidad puntos para subcapitulos
        $points = $chapter / $subchapters;

        //asignar y actualizar puntos a cada subcapitulo del capitulo elegido
        $updatepts = Subchapter::where('chapter_id', $id)->update(['s_point' => $points]);

        //volver a la vista presentando los subcapitulos del capitulo
        $capitulos = Chapter::find($id);
        return view('player.capitulos')->with('capitulos', $capitulos);
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
        $capitulos = Chapter::find($id);
        return view('admin.CapitulosEdit')->with('capitulos', $capitulos);
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

        $rules = [
            'name' => 'required|unique:challenges|max:255',            
            'desc' => 'required',
            'title' => 'required',
            'order' => 'required',
        ];         
        $messages = [
            'name.required' => 'Debes ingresar un Nombre de Area',
            'name.max' => 'El Nombre no puede exceder la cantidad de 255 caracteres',
            'name.unique' => 'Esta Area ya existe',
            'desc.required' => 'Ingresa una descripcion',
            'title.required' => 'Ingresa un titulo',
            'order.required' => 'Ingresa orden',
        ];         
        $this->validate($request, $rules, $messages);


        $status = "";
        $capitulo = Chapter::find($id);
        $capitulo->name = $request->name;
        $capitulo->title = $request->title;
        $capitulo->order = $request->order;
        // $capitulo->time = $request->time;
        $capitulo->description = $request->desc;

        $capitulo->save();

        $capitulos = Chapter::all();        
        return view('admin.capitulos')->with('capitulos', $capitulos)
                                    ->with('status', $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $capitulos = DB::table('subchapters')->where('chapter_id', $id)->get();

        $status="";
        $count=0;        
        $count+=count($capitulos->subchapters);
        
        if ($count>0) {
            $status = 'Capitulo esta relacionado con subcapitulos, Imposible eliminar';
        } else {
            Chapter::destroy($id);
            $status = 'Eliminado correctamente';
        }
        $capitulos = Chapter::all();        
        return view('admin.capitulos')->with('capitulos', $capitulos)
                                        ->with('status', $status);

    }
}
