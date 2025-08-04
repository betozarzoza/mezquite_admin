{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
	<div class="container-fluid">
		<div class="form-head d-flex align-items-center flex-wrap mb-sm-5 mb-3">
			<h2 class="font-w600 mb-2 text-black">Ingresos y egresos</h2>
		</div>
		<div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form action="movements-filtered" method="post">
					        @csrf
						 	<div class="input-group mb-3">
					            <select name="filter[]" multiple class=" btn-outline-secondary default-select form-control" >
									<option value="0">Otro</option>
					                <option value="1">Casa 1</option>
					                <option value="2">Casa 2</option>
					                <option value="3">Casa 3</option>
					                <option value="4">Casa 4</option>
					                <option value="5">Casa 5</option>
					                <option value="6">Casa 6</option>
					                <option value="7">Casa 7</option>
					                <option value="8">Casa 8</option>
					                <option value="9">Casa 9</option>
					                <option value="10">Casa 10</option>
					                <option value="11">Casa 11</option>
					                <option value="12">Casa 12</option>
					                <option value="13">Casa 13</option>
					                <option value="14">Casa 14</option>
					                <option value="15">Casa 15</option>
					                <option value="16">Casa 16</option>
					                <option value="17">Casa 17</option>
					                <option value="18">Casa 18</option>
					                <option value="19">Casa 19</option>
					                <option value="20">Casa 20</option>
					                <option value="21">Casa 21</option>
					                <option value="22">Casa 22</option>
					                <option value="23">Casa 23</option>
					                <option value="24">Casa 24</option>
					                <option value="25">Casa 25</option>
					                <option value="26">Casa 26</option>
					                <option value="27">Casa 27</option>
					                <option value="28">Casa 28</option>
					                <option value="29">Guardia</option>
					                <option value="30">Luz</option>
					                <option value="31">Agua</option>
								</select>
								<button class="btn btn-primary" type="submit">Filtrar</button>
				        	</div>
				        </form>
				    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
								<thead>
									<tr>
										<th>Tipo</th>
										<th>Nombre</th>
										<th>Saldo anterior</th>
										<th>Cantidad</th>
										<th>Saldo posterior</th>
										<th>Persona</th>
										<th>Mes</th>
										<th>Nota</th>
										<th>Creado por</th>
										<th>Fecha y hora</th>
										<th>Recibo</th>
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
										<td>{{ number_format($movement->last_balance) }}</td>
										<td>
											<span class="text-black font-w600">@if ($movement->type == 'ingreso') + @else - @endif ${{ $movement->quantity }}</span>
										</td>
										<td>@if ($movement->type == 'ingreso')
												{{ number_format($movement->last_balance + $movement->quantity) }}
											@else
												{{ number_format($movement->last_balance - $movement->quantity) }}
											@endif </td>
										<td>@if ($movement->type == 'ingreso') Mantenimiento Casa {{ $movement->addressat }}  @elseif ($movement->addressat == 0) Otro egreso @else Se le pago a: {{ $movement->addressat }} @endif</td>
										<td>@if ($movement->type == 'ingreso') {{ $movement->month }} @endif</td>
										<td>
											<p class="mb-0 wspace-no">{{ $movement->note }}</p>
										</td>
										<td>{{ $movement->user->name }}</td>
										<td>{{ \Carbon\Carbon::parse($movement->created_at)->format('l jS \\of F Y h:i:s A') }}</td>
										<td><a href="https://condominioselmezquite.homes/invoice_mezquite/{{$movement->id}}">Ver recibo</a></td>
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