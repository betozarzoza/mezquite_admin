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
	                    <h4 class="card-title">Formulario para agregar pago de mantenimiento</h4>
	                </div>
	                <div class="card-body">
	                    <div class="basic-form">
	                        <form action="create_activity" method="post">
	                        	@csrf
	                            <div class="mb-3">
	                                <label class="form-label">Destinatario:</label>
	                                <select name="objetivo[]" multiple class=" btn-outline-secondary default-select form-control wide" >
	                                	<option value="condominio">Condominio</option>
	                                	<option value="banio">Banio</option>
	                                	<option value="palapa">Palapa</option>
	                                	<option value="caseta">Caseta</option>
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
	                                </select>
	                            </div>
	                            <div class="mb-3">
	                                <label class="form-label">Actividad:</label>
	                                <select name="actividad" class="default-select  form-control wide" >
	                                    <option value="barrió">Barrer</option>
	                                    <option value="trapió">Trapear</option>
	                                    <option value="regó">Regar</option>
	                                    <option value="sacó basura">Sacar basura</option>
	                                    <option value="limpió baño">Limpiar baño</option>
	                                    <option value="otro">Otro</option>
	                                </select>
	                            </div>
	                            <div class="mb-3">
	                            	<label class="form-label">Nota</label>
	                                <textarea class="form-control" name="nota" rows="4" id="nota"></textarea>
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