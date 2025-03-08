{{-- Extends layout --}}
@extends('layout.default')




{{-- Content --}}
@section('content')
<link href="{{ asset('vendor/fullcalendar/css/main.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{ asset('vendor/moment/moment.min.js')}}"></script>
<script src="{{ asset('vendor/fullcalendar/js/main.min.js')}}"></script>
<script src="{{ asset('js/plugins-init/fullcalendar-init.js')}}"></script>


<script src="{{ asset('vendor/moment/moment.min.js')}}"></script>
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
            <div class="col-xl-3 col-xxl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-intro-title">Proximos eventos</h4>
                        <div>
                            @if (count($schedules) > 0)
                                @foreach ($schedules as $schedule)
                                    <div id="external-events" class="my-3">
                                        <div class="external-event btn-secondary light" data-class="bg-secondary"><i class="fa fa-move"></i>{{ $schedule->name }} (Casa {{ $schedule->scheduled_by}})</div>
                                    </div>
                                @endforeach
                            @else
                                <div id="external-events" class="my-3">
                                    <div class="external-event btn-secondary light" data-class="bg-secondary"><i class="fa fa-move"></i>No hay registros</div>
                                </div>
                            @endif
                            <a href="javascript:void()" data-bs-toggle="modal" data-bs-target="#add-category" class="btn btn-primary btn-event w-100">
                                <span class="align-middle"><i class="ti-plus"></i></span> Agendar evento
                            </a>
                        </div>
                        <h4 class="pt-3 card-intro-title">Eventos pasados</h4>
                        <div>
                            @if (count($past_events) > 0)
                                @foreach ($past_events as $past_event)
                                    <div id="external-events" class="my-3">
                                        <div class="external-event btn-secondary light" data-class="bg-secondary"><i class="fa fa-move"></i>{{ $past_event->name }} (Casa {{ $past_event->scheduled_by}})</div>
                                    </div>
                                @endforeach
                            @else
                                <div id="external-events" class="my-3">
                                    <div class="external-event btn-secondary light" data-class="bg-secondary"><i class="fa fa-move"></i>No hay registros</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-xxl-8">
                <div class="card">
                    <div class="card-body">
                        <div id="calendar" class="app-fullcalendar"></div>
                    </div>
                </div>
            </div>
            <!-- Modal Add Category -->
            <div class="modal fade none-border" id="add-category">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Agendar evento</strong></h4>
                        </div>
                        <form action="create-schedule" method="post">
                             @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label form-label">Nombre del evento</label>
                                        <input class="form-control form-white" type="text" name="nombre">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label form-label">Fecha</label>
                                        <input type="date" name="fecha" class="datepicker-default form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check custom-checkbox mt-3 mb-3 checkbox-info">
                                            <input type="checkbox" class="form-check-input" name="separar_alberca" id="separar_alberca">
                                            <label class="form-check-label" for="separar_alberca">Separar alberca (tiene un costo de $700)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-block">Agendar</button>
                                <button type="button" class="btn btn-danger btn-block" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(window).on('load',function(){
            setTimeout(function(){
                var schedules = {!! json_encode($schedules->toArray()) !!};
                var events = [];
                for (i = 0; i < schedules.length; i++) {
                    events.push({
                      title: schedules[i].name,
                      start: moment(schedules[i].date).format('YYYY-MM-DD')
                    });
                }
                fullCalender(events); 
            }, 1000);
        }); 
    </script>
@endsection