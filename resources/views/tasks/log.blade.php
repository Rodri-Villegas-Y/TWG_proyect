@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $task->description }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @foreach($task->logs as $log)   
                            <div class="card">
                                <div class="card-body">
                                    {{ $log->comment }}
                                </div>
                                <footer class="blockquote-footer text-right">
                                    {{ $log->created_at }}
                                </footer>
                            </div>
                            <br>
                        @endforeach

                    <form id="form" action="{{ route('log.store', $task) }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Comentario *</label>
                            <input type="text" name="comment" class="form-control @error('comment') is-invalid @enderror" required value="{{ old('comment') }}">
                            @error('comment') 
                            <div class="invalid-feedback" role="alert">
                                {{ $errors->first('comment') }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fas fa-database"></i> Guardar Comentario
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
