{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
	<div class="container-fluid">
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
                                                    <a href="/activate_guest_again/{{$guest->access_id}}" class="me-4" data-placement="top" title="Activate"><i
                                                            class="fas fa-check"></i></a>
                                                    <a href="/visitor_access_user/{{$guest->access_id}}" class="me-4" data-bs-toggle="tooltip"
                                                        data-placement="top" title="Ver"><i
                                                            class="fas fa-eye color-muted"></i> </a>
                                                    <a href="/cancel_guest_access/{{$guest->access_id}}" data-bs-toggle="tooltip"
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