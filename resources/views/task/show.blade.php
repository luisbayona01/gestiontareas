@extends('layouts.app')

@section('template_title')
    {{ $task->title ?? __('Show') . " " . __('Task') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Task</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('tasks.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Usuaraio:</strong>
                                    {{ $task->user_name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Titulo:</strong>
                                    {{ $task->title }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Descricion:</strong>
                                    {{ $task->description }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>estado:</strong>
                                    {{ $task->status }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha limite:</strong>
                                    {{ $task->due_date }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
