{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
	<div class="container-fluid">
        @if($errors->any())
            <div class="alert alert-danger solid alert-dismissible fade show">
                <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                <strong>Error!</strong> {{$errors->first()}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Mis invitados</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>#code</th>
                                        <th>Nombre</th>
                                        <th>Estatus</th>
                                        <th>Duracion</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($my_guests as $guest)
                                        <tr>
                                            <th>{{$guest->access_id}}</th>
                                            <td>{{$guest->name}}</td>
                                            @if($guest->active)
                                                <td><span class="badge badge-success">Activo</span></td>
                                            @else
                                                <td><span class="badge badge-danger">Usado</span></td>
                                            @endif
                                            @switch($guest->duration)
                                                @case('1_time')
                                                    <td>1 sola vez</td>
                                                    @break

                                                @case('1_hour')
                                                    <td>1 hora</td>
                                                    @break

                                                @case('6_hours')
                                                    <td>6 horas</td>
                                                    @break

                                                @case('12_hours')
                                                    <td>12 horas</td>
                                                    @break
                                            @endswitch
                                            <td>
                                                <span>
                                                    <a href="/activate_guest_again/{{$user->id}}/{{$guest->access_id}}" class="me-4" data-placement="top" title="Activate"><i
                                                            class="fas fa-check"></i></a>
                                                    <a href="/visitor_access_user/{{$user->id}}/{{$guest->access_id}}" class="me-4" data-bs-toggle="tooltip"
                                                        data-placement="top" title="Ver"><i
                                                            class="fas fa-eye color-muted"></i> </a>
                                                    <a href="/cancel_guest_access/{{$user->id}}/{{$guest->access_id}}" data-bs-toggle="tooltip"
                                                        data-placement="top" title="Close"><i
                                                            class="fas fa-times"></i></a>
                                                </span>
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