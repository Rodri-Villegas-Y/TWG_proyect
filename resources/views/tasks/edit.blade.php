

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Tarea</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form id="form" action="{{ route('task.update', $task) }}" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Usuario *</label>
                        <select name="user_id" class="select2 form-control" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @if ($user->id == $task->user_id) selected @endif>{{ $user->name }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Descripción *</label>
                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" required value="{{ old('description', $task->description) }}">
                        @error('description') 
                        <div class="invalid-feedback" role="alert">
                            {{ $errors->first('description') }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Fecha Plazo *</label>
                        <input type="date" name="max_date" class="form-control @error('max_date') is-invalid @enderror" required value="{{ old('max_date', $task->max_date) }}">
                        @error('max_date') 
                        <div class="invalid-feedback" role="alert">
                            {{ $errors->first('max_date') }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-database"></i> Actualizar Tarea
                        </button>
                    </div>

                    </form>
                    <a class="float text-right" href="{{ route('task') }}">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection