<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Log;
use App\Models\Task;
use App\Models\JobsEmail;
use Auth;

class LogController extends Controller
{
    public function store(Request $request, Task $task)
    {
        // se puede utilizar un FormRequest, pero cuando son formularios con más datos,
        // para este ejemplo utilizare validator

        $validator = Validator::make($request->all(), [
            'comment' => 'required|max:150'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        Log::create([
            'task_id' => $task->id,
            'comment' => $request->comment
        ]);

        // crea una tarea para enviar el correo despues. pero en el backend se preocupa de eso.
        // "NO" se enviara desde aca para no afectar la experiencia del usuario.
        JobsEmail::create([
			'queue' => 3,
			'payload' => json_encode([
					'email' => Auth::user()->email,
					'data'  => $request->comment
				])
		]);

        return back()->with('status', 'Log creado con éxito');
    }
}
