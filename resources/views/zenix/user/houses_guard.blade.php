{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
	<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
	<div class="container-fluid">
		<div class="card">
			<div class="card-header d-sm-flex d-block">
				<div class="me-auto mb-sm-0 mb-3">
					<h4 class="card-title mb-2">Casas en condominio</h4>
					<span>Casas en el condominio</span>
				</div>
			</div>
			<div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
						<thead>
							<tr>
								<th>#</th>
								<th>Dueño</th>
								<th>Llamar</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($houses as $house)
								<tr>
									<td>
										<h6>{{ $house->id }}</h6>
									</td>
									<td>
										<div>
											<h6>{{ $house->owner_name }}</h6>
											<span>{{ $house->owner_contact }}</span>
										</div>
										<div class="d-flex action-button">
											<a href="tel:{{ $house->owner_contact }}" class="btn btn-info btn-xs light px-2">
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