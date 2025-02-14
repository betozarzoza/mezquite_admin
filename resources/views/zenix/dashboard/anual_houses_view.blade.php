{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
	<div class="container-fluid">
		<div class="form-head d-flex align-items-center flex-wrap mb-sm-5 mb-3">
			<h2 class="font-w600 mb-2 text-black">Vista de adeudos anual</h2>
		</div>
		<div class="row">
            <div class="col-12">
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