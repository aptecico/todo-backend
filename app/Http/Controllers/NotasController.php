<?php

namespace App\Http\Controllers;

use App\Models\Notas;
use App\Models\User;
use Illuminate\Http\Request;

class NotasController extends Controller
{
    public function index(Request $request)
    {
        $notes = Notas:://where('usuario_id', $request->user()->id)
            orderBy('fecha_vencimiento', 'asc')
            ->get()->toArray();

            $users = User::all();
            //return response()->json($notes);
        return response()->json([
            'notes' => $notes,
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_vencimiento' => 'nullable|date',
            'etiqueta' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        $requestData=$request->all();
       // $path = $request->file('image') ? $request->file('image')->store('images') : null;
        if($request->hasFile('imagen')){
            $requestData['imagen']=$request->file('imagen')->store('archivos','public');
        }
        $requestData['usuario_id']=1;
        $notas = Notas::create($requestData);

        return response()->json($notas, 201);
    }

    public function show($id)
    {
        $notas = Notas::findOrFail($id);
        return response()->json($notas);
    }

    public function update(Request $request, $id)
    {
       
        $notas= Notas::findOrFail($id);
        
   
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_vencimiento' => 'nullable|date',
            'etiqueta' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
        ]);
        $requestData=$request->all();
        if($request->hasFile('imagen')){
            $requestData['imagen']=$request->file('imagen')->store('archivos','public');
        }
       // dd($requestData);
        $notas->update($requestData);

        return response()->json($notas, 200);
    }

    public function destroy($id)
    {
        $notas = Notas::findOrFail($id);
        $notas->delete();

        return response()->json(null, 204);
    }
}
