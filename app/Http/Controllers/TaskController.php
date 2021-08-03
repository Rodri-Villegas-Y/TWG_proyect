<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
use App\Models\User;
use Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function my()
    {
        $my_id = Auth::user()->id;
        $tasks = Task::latest()->where('user_id', $my_id)->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::orderBy('name', 'ASC')->get();

        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        // se puede utilizar un FormRequest, pero cuando son formularios con más datos,
        // para este ejemplo utilizare validator

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|gt:0',
            'description' => 'required|max:150',
            'max_date' => 'required|date|max:10'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        Task::create([
            'user_id' => $request->user_id,
            'description' => $request->description,
            'max_date' => $request->max_date
        ]);

        return redirect()->route('task')->with('status', 'Tarea creada con éxito');
    }

    public function edit(Task $task)
    {
        $users = User::orderBy('name', 'ASC')->get();

        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        // se puede utilizar un FormRequest, pero cuando son formularios con más datos,
        // para este ejemplo utilizare validator

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|gt:0',
            'description' => 'required|max:150',
            'max_date' => 'required|date|max:10'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $task->update([
            'user_id' => $request->user_id,
            'description' => $request->description,
            'max_date' => $request->max_date
        ]);

        return redirect()->route('task')->with('status', 'Tarea actualizada con éxito');
    }

    public function log(Task $task)
    {
        return view('tasks.log', compact('task'));
    }
}
