{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
	<div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Buenos dias!</h4>
                    <p class="mb-0">Tareas del dia</p>
                </div>
            </div>
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tareas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Estatus</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <th>{{$task->id}}</th>
                                            <td>{{$task->name}}</td>
                                            @if ($task->status == 'en espera')
                                            <td><span class="badge badge-warning">{{$task->status}}</span></td>
                                            <td><a href="/complete_task/{{$task->id}}" class="btn btn-success">Terminar</a>
                                            @elseif ($task->status == 'completada')
                                            <td><span class="badge badge-success">{{$task->status}}</span></td>
                                            <td><a href="/waiting_task/{{$task->id}}" class="btn btn-danger">En espera</a>
                                            @endif
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