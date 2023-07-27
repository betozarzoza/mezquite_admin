{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')

<div class="container-fluid">
	<div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
		<h2 class="font-w600 title mb-2 me-auto ">Inicio</h2>
	</div>
	@foreach ($notifications as $notification)
		<div class="row">
			<div class="alert {{ $notification->color }} solid alert-square "><strong>Mensaje importante:</strong> {{ $notification->content }}</div>
		</div>
	@endforeach
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
								<button type="submit" class="btn btn-light btn-block py-4">Abrir porton</button>
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
							<p class="mb-1">Gastos de la ultima semana</p>
							<h3 class="text-white">${{ number_format($egresos) }}</h3>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
	<div class="container-fluid">
		<div class="card">
			<div class="card-header d-sm-flex d-block">
				<div class="me-auto mb-sm-0 mb-3">
					<h4 class="card-title mb-2">Deudores</h4>
					<span>Nota: A principios de mes automaticamente se agrega la cantidad de la cuota de mantenimiento a todos, por lo tanto todos seremos deudores a principios de mes.</span>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table style-1" id="ListDatatableView">
						<thead>
							<tr>
								<th>#</th>
								<th>Dueño</th>
								<th>Ultimo pago</th>
								<th>Estatus</th>
								<th>Accion</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($houses as $house)
								<tr>
									<td>
										<h6>{{ $house->id }}</h6>
									</td>
									<td>
										<div class="media style-1">
											<img src="{{ asset('images/avatar/1.jpg') }}" class="img-fluid me-2" alt="">
											<div class="media-body">
												<h6>{{ $house->owner_name }}</h6>
												<span>{{ $house->owner_contact }}</span>
											</div>
										</div>
									</td>
									<td>
										<div>
											<h6 class="text-secondary">{{ $house->last_payment }}</h6>
											<span>Pagado</span>
										</div>
									</td>
									@if ($house->active)
										<td><span class="badge badge-success">Activo</span></td>
									@else
										<td><span class="badge badge-danger">Inactivo</span></td>
									@endif
									<td>
										<div class="d-flex action-button">
											<a href="javascript:void(0);" class="btn btn-info btn-xs light px-2">
												<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28.314 28.323" style="enable-background:new 0 0 28.314 28.323" xml:space="preserve"><path d="m27.728 20.384-4.242-4.242a1.982 1.982 0 0 0-1.413-.586h-.002c-.534 0-1.036.209-1.413.586L17.83 18.97l-8.485-8.485 2.828-2.828c.78-.78.78-2.05-.001-2.83L7.929.585A1.986 1.986 0 0 0 6.516 0h-.001C5.98 0 5.478.209 5.101.587L.858 4.83C.729 4.958-.389 6.168.142 8.827c.626 3.129 3.246 7.019 7.787 11.56 6.499 6.499 10.598 7.937 12.953 7.937 1.63 0 2.426-.689 2.604-.867l4.242-4.242c.378-.378.587-.881.586-1.416 0-.534-.208-1.037-.586-1.415zm-5.656 5.658c-.028.028-3.409 2.249-12.729-7.07C-.178 9.452 2.276 6.243 2.272 6.244L6.515 2l4.243 4.244-3.535 3.535a.999.999 0 0 0 0 1.414l9.899 9.899a.999.999 0 0 0 1.414 0l3.535-3.536 4.243 4.244-4.242 4.242z"/></svg>
											</a>
										</div>
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
@endsection	