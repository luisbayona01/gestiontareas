@extends('layouts.app')

@section('template_title')
    Tasks
@endsection

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.1.0/js/dataTables.js"></script>
<script>
$(document).ready( function () {
    $('#tabletask').DataTable();
});

</script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tasks') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                   
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                   
                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tabletask">
                                <thead class="thead">
                                    <tr>
                                     <th>No</th>
                                        
									<th >Usuario</th>
									<th >Título</th>
									<th >Descripcion</th>
									<th >estado</th>
									<th >fecha límite.</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{$task->id }}</td>
                                            
										<td >{{ $task->user_name }}</td>
										<td >{{ $task->title }}</td>
										<td >{{ $task->description }}</td>
										<td >{{ $task->status }}</td>
										<td >{{ $task->due_date }}</td>

                                            <td>
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('tasks.show', $task->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('tasks.edit', $task->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('desea  eliminar esta tarea?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
             
            </div>
        </div>
    </div>
@endsection
