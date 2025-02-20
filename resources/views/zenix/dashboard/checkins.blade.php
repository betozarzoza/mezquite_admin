{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
@php
	use Carbon\Carbon;
	Carbon::setLocale('es');
@endphp
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
	<div class="container-fluid">
		<div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                    <tr>
                                    	<th>Fecha</th>
                                        <th>Tipo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($checkins as $checkin)
                                    <tr>
                                    	<td>{{$checkin->created_at->diffForHumans()}}</td>
										<td class="color-primary">{{$checkin->type}}</td>
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