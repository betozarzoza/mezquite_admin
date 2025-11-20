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
                                    <tr>
                                        <th>1</th>
                                        <td>Barrer casa 1</td>
                                        <td><span class="badge badge-success">Completada</span>
                                        </td>
                                        <td><button type="button" class="btn btn-success">Terminar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <td>Podar Ixora pasto</td>
                                        <td><span class="badge badge-warning">En espera</span>
                                        </td>
                                        <td><button type="button" class="btn btn-success">Terminar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <td>Rondin tirar basura</td>
                                        <td><span class="badge badge-warning">En espera</span>
                                        </td>
                                        <td><button type="button" class="btn btn-success">Terminar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection