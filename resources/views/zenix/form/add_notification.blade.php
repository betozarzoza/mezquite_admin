{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
	<div class="container-fluid">
	    <!-- row -->
	    <div class="row">
	        <div class="col-xl-6 col-lg-6">
	            <div class="card">
	                <div class="card-header">
	                    <h4 class="card-title">Formulario para agregar notificacion</h4>
	                </div>
	                <div class="card-body">
	                    <div class="basic-form">
	                        <form action="create-notification" method="post">
	                        	@csrf
	                            <div class="mb-3">
	                            	<label class="form-label">Mensaje:</label>
	                                <input type="text" class="form-control input-default " name="contenido">
	                            </div>
	                            <div class="mb-3">
	                                <label class="form-label">Color:</label>
	                                <select name="color" class="default-select  form-control wide" >
	                                	<option value="alert-danger">Rojo</option>
	                                    <option value="alert-warning">Amarillo</option>
	                                    <option value="alert-info">Azul</option>
	                                    <option value="alert-success">Verde</option>
	                                    <option value="alert-dark">Gris</option>
	                                    <option value="alert-light">Blanco</option>
	                                    <option value="alert-primary">Anaranjado</option>
	                                </select>
	                            </div>
                                 <div class="mb-3">
                                    <label class="form-label">Dias:</label>
                                    <input type="number" name="dias" class="form-control">
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