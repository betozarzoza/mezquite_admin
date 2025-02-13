{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
	<div class="container-fluid">
	    <!-- row -->
	    <div class="row">
	    	@if($errors->any())
	            <div class="alert alert-danger solid alert-dismissible fade show">
	                <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
	                <strong>Error!</strong> {{$errors->first()}}
	                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
	                </button>
	            </div>
	        @endif
	        <div class="col-xl-6 col-lg-6">
	            <div class="card">
	                <div class="card-header">
	                    <h4 class="card-title">Formulario para agregar visitante</h4>
	                </div>
	                <div class="card-body">
	                    <div class="basic-form">
	                        <form action="create_visitor" method="post">
	                        	@csrf
	                            <div class="mb-3">
	                            	<label class="form-label">Nombre:</label>
	                                <input type="text" class="form-control input-default " name="nombre">
	                            </div>
	                            <div class="mb-3">
	                                <label class="form-label">Duracion de codigo:</label>
	                                <select name="duracion" class="default-select  form-control wide" >
	                                		<option value="1_time">1 solo uso</option>
	                                    <option value="1_hour">1 hora</option>
	                                    <option value="6_hours">6 horas</option>
	                                    <option value="12_hours">12 horas</option>
	                                </select>
	                           </div>
	                           <button type="submit" class="btn btn-primary">Agregar</button>
	                        </form>
	                    </div>
	                </div>
	            </div>
			</div>
	    </div>
	</div>
@endsection