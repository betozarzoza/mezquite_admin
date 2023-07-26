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
	                    <h4 class="card-title">Formulario para agregar movimiento</h4>
	                </div>
	                <div class="card-body">
	                    <div class="basic-form">
	                        <form action="create-movement" method="post">
	                        	@csrf
	                            <div class="mb-3">
	                            	<label class="form-label">Nombre:</label>
	                                <input type="text" class="form-control input-default " name="nombre">
	                            </div>
	                             <div class="mb-3">
                                    <label class="form-label">Cantidad:</label>
                                    <input type="number" name="cantidad" class="form-control">
                                </div>
	                            <fieldset class="mb-3">
	                                <div class="row">
	                                    <label class="col-form-label col-sm-3 pt-0">Tipo:</label>
	                                    <div class="col-sm-9">
	                                        <div class="form-check">
	                                            <input class="form-check-input" type="radio" name="tipo" value="ingreso" checked>
	                                            <label class="form-check-label">
	                                                Ingreso
	                                            </label>
	                                        </div>
	                                        <div class="form-check">
	                                            <input class="form-check-input" type="radio" name="tipo" value="egreso">
	                                            <label class="form-check-label">
	                                                Egreso
	                                            </label>
	                                        </div>
	                                    </div>
	                                </div>
	                            </fieldset>
	                            <div class="mb-3">
	                                <label class="form-label">Mes de pago:</label>
	                                <select name="mes" class="default-select  form-control wide" >
	                                	<option value="Otro">Otro</option>
	                                    <option value="Enero">Enero</option>
	                                    <option value="Febrero">Febrero</option>
	                                    <option value="Marzo">Marzo</option>
	                                    <option value="Abril">Abril</option>
	                                    <option value="Mayo">Mayo</option>
	                                    <option value="Junio">Junio</option>
	                                    <option value="Julio">Julio</option>
	                                    <option value="Agosto">Agosto</option>
	                                    <option value="Septiembre">Septiembre</option>
	                                    <option value="Octubre">Octubre</option>
	                                    <option value="Noviembre">Noviembre</option>
	                                    <option value="Diciembre">Diciembre</option>
	                                </select>
	                            </div>
	                            <div class="mb-3">
	                                <label class="form-label">Destinatario:</label>
	                                <select name="destinatario" class="default-select  form-control wide" >
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
	                            </div>
	                            <div class="mb-3">
	                            	<label class="form-label">Nota</label>
	                                <textarea class="form-control" name="nota" rows="4" id="comment"></textarea>
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