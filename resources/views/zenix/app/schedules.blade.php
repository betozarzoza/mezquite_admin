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
        <div class="row">
            <div class="col-xl-3 col-xxl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-intro-title">Agenda</h4>

                        <div class="">
                            @foreach ($schedules as $schedule)
                                <div id="external-events" class="my-3">
                                    <div class="external-event btn-secondary light" data-class="bg-secondary"><i class="fa fa-move"></i>{{ $schedule->name }}</div>
                                </div>
                            @endforeach
                            <a href="javascript:void()" data-bs-toggle="modal" data-bs-target="#add-category" class="btn btn-primary btn-event w-100">
                                <span class="align-middle"><i class="ti-plus"></i></span> Agendar evento
                            </a>
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
            <!-- BEGIN MODAL -->
            <div class="modal fade none-border" id="event-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Add New Event</strong></h4>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success save-event waves-effect waves-light">Create
                                event</button>

                            <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-bs-toggle="modal">Delete</button>
                        </div>
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
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary btn-block">Agendar</button>
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