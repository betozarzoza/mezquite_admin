{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>

@php
	use Carbon\Carbon;
	Carbon::setLocale('es');
@endphp
<div class="container-fluid">
	<div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
		<h2 class="font-w600 title mb-2 me-auto ">Inicio</h2>
	</div>
	@foreach ($notifications as $notification)
		<div class="row">
			<div class="alert {{ $notification->color }} solid alert-square "><strong>Mensaje importante:</strong> {{ $notification->content }}</div>
		</div>
	@endforeach

	@foreach ($surveys as $survey)
		<div class="col">
	        <div class="card">
	            <div class="card-header d-block">
	                <h4 class="card-title">{{ $survey->question }}</h4>
	                <p class="mb-0 subtitle">{{ $survey->description }}</p>
	            </div>
	            <div class="card-body">
	            	@for ($i = 0; $i < $survey->number_of_answers; $i++)
	            		@if ($i == 0)
	            			<button type="button" class="btn btn-primary">Primary</button>
	            		@endif
	            		@if ($i == 1)
	            			<button type="button" class="btn btn-primary">Primary</button>
	            		@endif
	            		@if ($i == 2)
	            			<button type="button" class="btn btn-primary">Primary</button>
	            		@endif
	            	@endfor
	            	@for ($i = 0; $i < $survey->number_of_answers; $i++)
	            		@if ($i == 0)
	            			<h6 class="mt-4">{{ $survey->answer_1 }}
			                    <span class="pull-end">{{ $survey->percentage_answer_1 }}%</span>
			                </h6>
			                <div class="progress ">
			                    <div class="progress-bar bg-danger progress-animated" style="width: 80%; height:6px;" role="progressbar">
			                        <span class="sr-only">60% Complete</span>
			                    </div>
			                </div>
	            		@endif
	            		@if ($i == 1)
	            			<h6 class="mt-4">{{ $survey->answer_2 }}
			                    <span class="pull-end">{{ $survey->percentage_answer_2 }}%</span>
			                </h6>
			                <div class="progress ">
			                    <div class="progress-bar bg-danger progress-animated" style="width: 80%; height:6px;" role="progressbar">
			                        <span class="sr-only">60% Complete</span>
			                    </div>
			                </div>
	            		@endif
	            		@if ($i == 2)
	            			<h6 class="mt-4">{{ $survey->answer_3 }}
			                    <span class="pull-end">{{ $survey->percentage_answer_3 }}%</span>
			                </h6>
			                <div class="progress ">
			                    <div class="progress-bar bg-danger progress-animated" style="width: 80%; height:6px;" role="progressbar">
			                        <span class="sr-only">60% Complete</span>
			                    </div>
			                </div>
	            		@endif
	            	@endfor
	            </div>
	        </div>
	    </div>
	@endforeach
	@if ($user->id !== 29)
	<div class="row">
		<div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
			<div class="widget-stat card bg-danger">
				<div class="card-body  p-4">
					<div class="media">
						<span class="me-3">
							<i class="flaticon-381-calendar-1"></i>
						</span>
						<div class="media-body text-white text-right">
							@if ($user->active)
								<form action="open-gate" method="post">
	                        	@csrf
								<button type="submit" class="btn btn-light btn-block py-4">Abrir porton</button>
								</form>
							@else
								<td><span class="badge badge-danger">Inactivo</span></td>
							@endif
						</div>
					</div>
				</div>
			</div>
        </div>
		<div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
			<div class="widget-stat card bg-success">
				<div class="card-body p-4">
					<div class="media">
						<span class="me-3">
							<i class="flaticon-381-diamond"></i>
						</span>
						<div class="media-body text-white text-right">
							<p class="mb-1">En caja</p>
							<h3 class="text-white">${{ number_format($balance) }}</h3>
						</div>
					</div>
				</div>
			</div>
        </div>
		<div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
			<div class="widget-stat card bg-info">
				<div class="card-body p-4">
					<div class="media">
						<span class="me-3">
							<i class="flaticon-381-heart"></i>
						</span>
						<div class="media-body text-white text-right">
							<p class="mb-1">Tu deuda</p>
							<h3 class="text-white">@if ($user->balance < 0 ) $0 @else ${{ number_format($user->balance) }} @endif</h3>
						</div>
					</div>
				</div>
			</div>
        </div>
		<div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
			<div class="widget-stat card bg-primary">
				<div class="card-body p-4">
					<div class="media">
						<span class="me-3">
							<i class="flaticon-381-user-7"></i>
						</span>
						<div class="media-body text-white text-right">
							@if (count($arrived_at) > 0 && count($leaved_at) == 0)
								<p class="mb-1">Guardia llego hoy a las:</p>
								<p class="text-white">{{ $arrived_at[0]->created_at->toTimeString() }}</p>
							@elseif (count($leaved_at) == 0) 
								<p class="text-white">El guardia no ha llegado</p>
							@endif

							@if (count($leaved_at) > 0)
								<p class="mb-1">Guardia salio hoy a las:</p>
								<p class="text-white">{{ $leaved_at[0]->created_at->toTimeString() }}</p>
							@endif
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h4 class="card-title">Linea de tiempo</h4>
            </div>
            <div class="card-body">
                <div id="DZ_W_TimeLine111" class="widget-timeline dz-scroll style-1 height370">
                    <ul class="timeline">
                    	@if (count($activities))
	                    	@foreach ($activities as $activity)
	                    		@if ($activity->status == 1)
	                    		<li>
		                            <div class="timeline-badge info">
		                            </div>
		                            <a class="timeline-panel text-muted" href="#">
		                                <span>{{$activity->created_at->diffForHumans()}}</span>
		                                <h6 class="mb-0">{{ $activity->name }}</strong></h6>
										<p class="mb-0">Pago de mantenimiento</p>
		                            </a>
		                        </li>
		                        @endif
		                        @if ($activity->status == 2)
	                    		<li>
		                            <div class="timeline-badge success">
		                            </div>
		                            <a class="timeline-panel text-muted" href="#">
		                                <span>{{$activity->created_at->diffForHumans()}}</span>
		                                <h6 class="mb-0">{{ $activity->name }}</strong></h6>
										<p class="mb-0">Actividad guardia</p>
		                            </a>
		                        </li>
		                        @endif
		                        @if ($activity->status == 3)
	                    		<li>
		                            <div class="timeline-badge danger">
		                            </div>
		                            <a class="timeline-panel text-muted" href="#">
		                                <span>{{$activity->created_at->diffForHumans()}}</span>
		                                <h6 class="mb-0">{{ $activity->name }}</strong></h6>
										<p class="mb-0">Egreso </p>
		                            </a>
		                        </li>
		                        @endif
	                    	@endforeach
	                    @else
	                    	no hay actividades
	                    @endif
                    	<!--
                        <li>
                            <div class="timeline-badge primary"></div>
                            <a class="timeline-panel text-muted" href="#">
                                <span>10 minutes ago</span>
                                <h6 class="mb-0">Youtube, a video-sharing website, goes live <strong class="text-primary">$500</strong>.</h6>
                            </a>
                        </li>
                        <li>
                            <div class="timeline-badge info">
                            </div>
                            <a class="timeline-panel text-muted" href="#">
                                <span>20 minutes ago</span>
                                <h6 class="mb-0">New order placed <strong class="text-info">#XF-2356.</strong></h6>
								<p class="mb-0">Quisque a consequat ante Sit amet magna at volutapt...</p>
                            </a>
                        </li>
                        <li>
                            <div class="timeline-badge danger">
                            </div>
                            <a class="timeline-panel text-muted" href="#">
                                <span>30 minutes ago</span>
                                <h6 class="mb-0">john just buy your product <strong class="text-warning">Sell $250</strong></h6>
                            </a>
                        </li>
                        <li>
                            <div class="timeline-badge success">
                            </div>
                            <a class="timeline-panel text-muted" href="#">
                                <span>15 minutes ago</span>
                                <h6 class="mb-0">StumbleUpon is acquired by eBay. </h6>
                            </a>
                        </li>
                        <li>
                            <div class="timeline-badge warning">
                            </div>
                            <a class="timeline-panel text-muted" href="#">
                                <span>20 minutes ago</span>
                                <h6 class="mb-0">Mashable, a news website and blog, goes live.</h6>
                            </a>
                        </li>
                        <li>
                            <div class="timeline-badge dark">
                            </div>
                            <a class="timeline-panel text-muted" href="#">
                                <span>20 minutes ago</span>
                                <h6 class="mb-0">Mashable, a news website and blog, goes live.</h6>
                            </a>
                        </li>
                    	-->
                    </ul>
                </div>
            </div>
        </div>
	</div>
	<!--
	<div class="container-fluid">
		<div class="card">
            <div class="card-header">
                <h4 class="card-title">Pago de condominos</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                        <thead>
                            <tr>
                                <th scope="col">Casa</th>
                                <th scope="col">Ene</th>
                                <th scope="col">Feb</th>
                                <th scope="col">Mar</th>
                                <th scope="col">Abr</th>
                                <th scope="col">May</th>
                                <th scope="col">Jun</th>
                                <th scope="col">Jul</th>
                                <th scope="col">Ago</th>
                                <th scope="col">Sep</th>
                                <th scope="col">Oct</th>
                                <th scope="col">Nov</th>
                                <th scope="col">Dic</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach ($houses as $house)
                            <tr>
                            	<th>{{ $house->id }} - {{ $house->owner_name }}</th>
                            	@if ($house->ene == 1)
                            		<th style="text-align: center;"><span class="badge badge-success">O</span></th>
                            	@else
                            		<th style="text-align: center;"><span class="badge badge-danger">X</span></th>
                            	@endif

                            	@if ($house->feb == 1)
                            		<th style="text-align: center;"><span class="badge badge-success">O</span></th>
                            	@else
                            		<th style="text-align: center;"><span class="badge badge-danger">X</span></th>
                            	@endif

                            	@if ($house->mar == 1)
                            		<th style="text-align: center;"><span class="badge badge-success">O</span></th>
                            	@else
                            		<th style="text-align: center;"><span class="badge badge-danger">X</span></th>
                            	@endif

                            	@if ($house->abr == 1)
                            		<th style="text-align: center;"><span class="badge badge-success">O</span></th>
                            	@else
                            		<th style="text-align: center;"><span class="badge badge-danger">X</span></th>
                            	@endif

                            	@if ($house->may == 1)
                            		<th style="text-align: center;"><span class="badge badge-success">O</span></th>
                            	@else
                            		<th style="text-align: center;"><span class="badge badge-danger">X</span></th>
                            	@endif

                            	@if ($house->jun == 1)
                            		<th style="text-align: center;"><span class="badge badge-success">O</span></th>
                            	@else
                            		<th style="text-align: center;"><span class="badge badge-danger">X</span></th>
                            	@endif

                            	@if ($house->jul == 1)
                            		<th style="text-align: center;"><span class="badge badge-success">O</span></th>
                            	@else
                            		<th style="text-align: center;"><span class="badge badge-danger">X</span></th>
                            	@endif

                            	@if ($house->ago == 1)
                            		<th style="text-align: center;"><span class="badge badge-success">O</span></th>
                            	@else
                            		<th style="text-align: center;"><span class="badge badge-danger">X</span></th>
                            	@endif

                            	@if ($house->sep == 1)
                            		<th style="text-align: center;"><span class="badge badge-success">O</span></th>
                            	@else
                            		<th style="text-align: center;"><span class="badge badge-danger">X</span></th>
                            	@endif

                            	@if ($house->oct == 1)
                            		<th style="text-align: center;"><span class="badge badge-success">O</span></th>
                            	@else
                            		<th style="text-align: center;"><span class="badge badge-danger">X</span></th>
                            	@endif

                            	@if ($house->nov == 1)
                            		<th style="text-align: center;"><span class="badge badge-success">O</span></th>
                            	@else
                            		<th style="text-align: center;"><span class="badge badge-danger">X</span></th>
                            	@endif

                            	@if ($house->dic == 1)
                            		<th style="text-align: center;"><span class="badge badge-success">O</span></th>
                            	@else
                            		<th style="text-align: center;"><span class="badge badge-danger">X</span></th>
                            	@endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
	-->
	@else
	<div class="row">
		<div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
			<div class="widget-stat card bg-danger">
				<div class="card-body  p-4">
					<div class="media">
						<span class="me-3">
							<i class="flaticon-381-calendar-1"></i>
						</span>
						<div class="media-body text-white text-right">
							<button type="submit" class="btn btn-light btn-block py-4">Abrir porton</button>
						</div>
					</div>
				</div>
			</div>
        </div>
		<div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
			<div class="widget-stat card bg-success">
				<div class="card-body p-4">
					<div class="media">
						<span class="me-3">
							<i class="flaticon-381-diamond"></i>
						</span>
						@if (count($arrived_at) > 0)
							<div class="media-body text-white text-right">
								<form action="checkout" method="post">
		                            @csrf
									<button type="submit" class="btn btn-light btn-block py-4">Checar Salida</button>
								</form>
							</div>
						@else
							<div class="media-body text-white text-right">
								<form action="checkin" method="post">
		                            @csrf
									<button type="submit" class="btn btn-light btn-block py-4">Checar Entrada</button>
								</form>
							</div>
						@endif
					</div>
				</div>
			</div>
        </div>
		<div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
			<div class="widget-stat card bg-info">
				<div class="card-body p-4">
					<div class="media">
						<span class="me-3">
							<i class="flaticon-381-heart"></i>
						</span>
						@if (count($lunch) == 1)
							<div class="media-body text-white text-right">
								<form action="lunchback" method="post">
									@csrf
									<button type="submit" class="btn btn-light btn-block py-4">Regrese de comer</button>
								</form>
							</div>
						@elseif (count($lunch) == 0)
							<div class="media-body text-white text-right">
								<form action="lunch" method="post">
									@csrf
									<button type="submit" class="btn btn-light btn-block py-4">Sali a comer</button>
								</form>
							</div>
						@endif
					</div>
				</div>
			</div>
        </div>
		<div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
			<div class="widget-stat card bg-primary">
				<div class="card-body p-4">
					<div class="media">
						<span class="me-3">
							<i class="flaticon-381-user-7"></i>
						</span>
						<div class="media-body text-white text-right">
							<a href="tel:8120392234" class="btn btn-light btn-block py-4">Llamar administrador</a>
						</div>
					</div>
				</div>
			</div>
        </div>
	</div>
	@endif
</div> 
<script type="text/javascript">
    (function($) {
	    "use strict"
	    //example 1
	    var table = $('#example').DataTable({
	        createdRow: function ( row, data, index ) {
	           $(row).addClass('selected')
	        } ,
			language: {
				"lengthMenu": "Mostrar _MENU_ registros por pagina",
	            "zeroRecords": "No se encontro nada",
	            "info": "Mostrando pagina _PAGE_ de _PAGES_",
	            "infoEmpty": "No hay registros disponibles",
	            "infoFiltered": "(Filtrados de _MAX_ registros)",
				paginate: {
				  next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
				  previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>' 
				}
			}
	    });
	      
	    table.on('click', 'tbody tr', function() {
	    var $row = table.row(this).nodes().to$();
	    var hasClass = $row.hasClass('selected');
	    if (hasClass) {
	        $row.removeClass('selected')
	    } else {
	        $row.addClass('selected')
	    }
	    })
	    
	    table.rows().every(function() {
	    this.nodes().to$().removeClass('selected')
	    });



	    
		
	})(jQuery);
</script>  
@endsection	