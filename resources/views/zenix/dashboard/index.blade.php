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
		<div class="col-xl-3 col-sm-6 m-t35">
			<form action="open-gate" method="post">
                @csrf
				<div class="card  card-coin">
		            <div class="card-body text-center ai-icon  text-primary">
						<h4 class="my-2">Abrir porton del condominio</h4>
						@if ($user->active)
							<button type="submit" class="btn btn-primary btn-block">Abrir porton</button>
						@else
							<td><span class="badge badge-danger">Inactivo</span></td>
						@endif
					</div>
				</div>
			</form>
		</div>
		<div class="col-xl-3 col-sm-6 m-t35">
			<div class="card card-coin">
				<div class="card-body text-center">
					<svg class="mb-3 currency-icon" width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="40" cy="40" r="40" fill="white"/>
						<path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#00ADA3"/>
						<path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM40.0033 19.1441L49.272 35.6798L40.8133 30.973C40.3083 30.693 39.6966 30.693 39.1916 30.973L30.7329 35.6798L40.0033 19.1441ZM40.0033 60.8509L30.7329 44.3152L39.1916 49.022C39.4433 49.162 39.7233 49.232 40.0016 49.232C40.28 49.232 40.56 49.162 40.8117 49.022L49.2703 44.3152L40.0033 60.8509ZM40.0033 45.6569L29.8296 39.9967L40.0033 34.3364L50.1754 39.9967L40.0033 45.6569Z" fill="#00ADA3"/>
					</svg>
					<h2 class="text-black mb-2 font-w600">${{ $balance }}</h2>
					<p class="mb-0 fs-14">
						En caja del condominio
					</p>	
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 m-t35">
			<div class="card card-coin">
				<div class="card-body text-center">
					<svg class="mb-3 currency-icon" width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="40" cy="40" r="40" fill="white"/>
						<path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#374C98"/>
						<path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM52.5455 56.9324H26.0111L29.2612 38.9483L25.4944 39.7317V36.6649L29.8279 35.7482L32.6447 20.2809H43.2284L40.8283 33.4481L44.5285 32.6647V35.7315L40.2616 36.6149L37.7949 50.2154H54.5122L52.5455 56.9324Z" fill="#374C98"/>
					</svg>
					<h2 class="text-black mb-2 font-w600">${{ $egresos }}</h2>
					<p class="mb-0 fs-14">
						<svg width="29" height="22" viewBox="0 0 29 22" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g filter="url(#filter0_d4)">
							<path d="M5 4C5.91797 5.08433 8.89728 8.27228 10.5 10L16.5 7L23.5 16" stroke="#FF2E2E" stroke-width="2" stroke-linecap="round"/>
							</g>
							<defs>
							<filter id="filter0_d4" x="-3.05176e-05" y="0" width="28.5001" height="22.0001" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
							<feFlood flood-opacity="0" result="BackgroundImageFix"/>
							<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
							<feOffset dy="1"/>
							<feGaussianBlur stdDeviation="2"/>
							<feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 0.180392 0 0 0 0 0.180392 0 0 0 0.61 0"/>
							<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
							<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
							</filter>
							</defs>
						</svg>
						<span class="text-danger me-1"></span>Egresos desde hace una semana
					</p>	
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 m-t35">
			<div class="card card-coin">
				<div class="card-body text-center">
					<svg class="mb-3 currency-icon" width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="40" cy="40" r="40" fill="white"/>
						<path d="M40.725 0.00669178C18.6241 -0.393325 0.406708 17.1907 0.00669178 39.275C-0.393325 61.3592 17.1907 79.5933 39.275 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8093 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17365 57.3257 7.507 39.4083C7.82368 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8097 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#FF782C"/>
						<path d="M40.525 10.8238C24.441 10.5405 11.1238 23.391 10.8405 39.475C10.7455 44.5352 11.9605 49.3204 14.1639 53.5139H23.3326V24.8027C23.3326 23.0476 25.7177 22.4893 26.4928 24.0643L40 51.4171L53.5072 24.066C54.2822 22.4893 56.6674 23.0476 56.6674 24.8027V53.5139H65.8077C67.8578 49.6171 69.0779 45.2169 69.1595 40.525C69.4429 24.441 56.609 11.1238 40.525 10.8238Z" fill="#FF782C"/>
						<path d="M53.3339 55.1806V31.943L41.4934 55.919C40.9334 57.0574 39.065 57.0574 38.5049 55.919L26.6661 31.943V55.1806C26.6661 56.1007 25.9211 56.8474 24.9994 56.8474H16.2474C21.4326 64.1327 29.8629 68.9795 39.475 69.1595C49.4704 69.3362 58.3908 64.436 63.786 56.8474H55.0006C54.0789 56.8474 53.3339 56.1007 53.3339 55.1806Z" fill="#FF782C"/>
					</svg>
					<h2 class="text-black mb-2 font-w600">${{ $ingresos }}</h2>
					<p class="mb-0 fs-14">
						<svg width="29" height="22" viewBox="0 0 29 22" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g filter="url(#filter0_d5)">
							<path d="M5 16C5.91797 14.9157 8.89728 11.7277 10.5 10L16.5 13L23.5 4" stroke="#2BC155" stroke-width="2" stroke-linecap="round"/>
							</g>
							<defs>
							<filter id="filter0_d5" x="-3.05176e-05" y="-6.10352e-05" width="28.5001" height="22.0001" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
							<feFlood flood-opacity="0" result="BackgroundImageFix"/>
							<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
							<feOffset dy="1"/>
							<feGaussianBlur stdDeviation="2"/>
							<feColorMatrix type="matrix" values="0 0 0 0 0.172549 0 0 0 0 0.72549 0 0 0 0 0.337255 0 0 0 0.61 0"/>
							<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
							<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
							</filter>
							</defs>
						</svg>
						<span class="text-success me-1"></span>Ingresos desde hace una semana
					</p>	
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="card">
			<div class="card-header d-sm-flex d-block">
				<div class="me-auto mb-sm-0 mb-3">
					<h4 class="card-title mb-2">Deudores</h4>
					<span>Nota: cada mes automaticamente se agrega la cantidad de la cuota de mantenimiento a todos, por lo tanto todos seremos deudores a principios de mes.</span>
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