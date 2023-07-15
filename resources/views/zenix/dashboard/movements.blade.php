{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
	<div class="container-fluid">
		<div class="form-head d-flex align-items-center flex-wrap mb-sm-5 mb-3">
			<h2 class="font-w600 mb-0 text-black">Movimientos</h2>
			<a href="javascript:void(0);" class="btn btn-outline-secondary ms-auto"><i class="las la-calendar scale5 me-2"></i>Filtrar periodo</a>
		</div>
		<div class="row">
			<div class="col-xl-12">
				<div class="table-responsive table-hover fs-14">
					<table class="table display mb-4 dataTablesCard short-one card-table text-black" id="example6">
						<thead>
							<tr>
								<th></th>
								<th>Nombre</th>
								<th>Fecha</th>
								<th>Cantidad</th>
								<th>Destinatario</th>
								<th>Nota</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($movements as $movement)
							    <tr>
								<td class="pr-0">
									@if ($movement->type == 'ingreso')
										<span class="bg-success ic-icon">
											<svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M1.13282 8.90433L1.13282 8.90433L1.11612 1.99607C1.11609 1.99224 1.1161 1.98868 1.11615 1.98542M1.13282 8.90433L1.61615 1.99089L1.11615 1.99005C1.11617 1.97692 1.11672 1.96665 1.11697 1.96234L1.11706 1.96082C1.11686 1.96411 1.11633 1.97298 1.11616 1.98431C1.11616 1.98468 1.11615 1.98505 1.11615 1.98542M1.13282 8.90433C1.13475 9.69817 1.77979 10.3403 2.57378 10.3384C3.36769 10.3365 4.00975 9.6914 4.00787 8.89749L4.00787 8.89746L3.99954 5.46873M1.13282 8.90433L3.99954 5.46873M1.11615 1.98542C1.11853 1.19684 1.75837 0.554508 2.54973 0.552379C2.55142 0.552358 2.55317 0.552346 2.55498 0.552343L2.55703 0.552338L2.57419 0.552393L9.46803 0.569049L9.46682 1.06905L9.46804 0.569049C10.2617 0.570981 10.904 1.21593 10.9021 2.01004C10.9002 2.80394 10.2551 3.44597 9.4612 3.44409L9.46117 3.4441L6.03249 3.43582L19.2151 16.6184C19.7765 17.1798 19.7765 18.0899 19.2151 18.6513C18.6537 19.2127 17.7435 19.2127 17.1821 18.6513L3.99954 5.46873M1.11615 1.98542C1.11614 1.98743 1.11615 1.98943 1.11615 1.99144L3.99954 5.46873M2.55508 0.552375C2.55572 0.552375 2.55637 0.552373 2.55703 0.552376L2.55508 0.552375Z" fill="white" stroke="white"/>
											</svg>
										</span>
									@else
									    <span class="bg-danger ic-icon">
											<svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M20.7529 19.1563L7.5703 5.97367C7.00891 5.41228 6.09876 5.41228 5.53737 5.97367C4.97598 6.53505 4.97598 7.44521 5.53737 8.0066L18.72 21.1892L15.2913 21.1809L15.2912 21.1809C14.4973 21.179 13.8522 21.8211 13.8503 22.615C13.8484 23.4091 14.4907 24.054 15.2844 24.056L15.2856 23.556L15.2844 24.056L22.1954 24.0727L22.2028 24.0727L22.2051 24.0726C22.9947 24.0692 23.6329 23.4284 23.6363 22.6414L23.6363 22.6391L23.6363 22.6317L23.6196 15.7207L23.6196 15.7207C23.6177 14.9268 22.9727 14.2847 22.1787 14.2866C21.3847 14.2885 20.7427 14.9336 20.7446 15.7275L20.7446 15.7275L20.7529 19.1563Z" fill="white" stroke="white"/>
											</svg>
										</span>
									@endif
								</td>
								<td>{{ $movement->name }}</td>
								<td>{{ $movement->created_at }}</td>
								<td>
									<span class="text-black font-w600">@if ($movement->type == 'ingreso') + @else - @endif ${{ $movement->quantity }}</span>
								</td>
								<td>{{ $movement->addressat }}</td>
								<td>
									<p class="mb-0 wspace-no">{{ $movement->note }}</p>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>	
			</div>
		</div>
	</div>
@endsection