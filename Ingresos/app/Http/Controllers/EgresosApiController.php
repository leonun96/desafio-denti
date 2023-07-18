<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Egresos;

class EgresosApiController extends Controller
{
	public function index ()
	{
		$egresos = Egresos::orderBy('fecha', 'desc')->get();
		return response()->json($egresos, 200);
	}
	public function store (Request $request)
	{
		$val = $request->validate([
			'fecha' => 'required',
			'monto' => ['required', 'min:1', 'numeric'],
		]);
		$egreso = Egresos::create($val);
		return response()->json($egreso, 200);
	}
	public function delete (Request $request, $id)
	{
		// dd($id, $request);
		$egreso = Egresos::findOrFail($id);
		$egreso->delete();
		return response()->json(['mensaje' => 'Registro eliminado correctamente'], 200);
	}
}
