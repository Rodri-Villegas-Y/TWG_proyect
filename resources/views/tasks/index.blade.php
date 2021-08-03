@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tareas</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                            	<th class="text-center">Descripción</th>
                                <th class="text-center">Asignado</th>
                                <th class="text-center">Plazo</th>
                                <th class="text-center">Quedan</th>
                                <th />
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr @if(!$task->status) 
                                    class="text-danger" 
                                @endif
                            > 
                                <td>
                                    {{ $task->id }}
                                </td>
                                <td class="text-center">
                                    {{ $task->description }}
                                </td>
                                <td>
                                    {{ $task->user->name }}
                                </td>
                                <td>
                                    {{ $task->limit }}
                                </td>
                                <td>
                                    {{ $task->remain }}
                                </td>
                                <td>
                                    @if (Auth::user()->id == $task->user_id)
                                    <a class="text-success" href="{{ route('task.edit', $task) }}">
                                        Editar
                                    </a>
                                    <a class="text-info" href="{{ route('task.log', $task) }}">
                                        Log
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <a class="float text-right" href="{{ route('task.create') }}">Crear</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
