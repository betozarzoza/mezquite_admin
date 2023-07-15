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
	                                <label class="form-label">Destinatario:</label>
	                                <select name="destinatario" class="default-select  form-control wide" >
	                                	<option>Otro</option>
	                                    <option>Casa 1</option>
	                                    <option>Casa 2</option>
	                                    <option>Casa 3</option>
	                                    <option>Casa 4</option>
	                                    <option>Casa 5</option>
	                                    <option>Casa 6</option>
	                                    <option>Casa 7</option>
	                                    <option>Casa 8</option>
	                                    <option>Casa 9</option>
	                                    <option>Casa 10</option>
	                                    <option>Casa 11</option>
	                                    <option>Casa 12</option>
	                                    <option>Casa 13</option>
	                                    <option>Casa 14</option>
	                                    <option>Casa 15</option>
	                                    <option>Casa 16</option>
	                                    <option>Casa 17</option>
	                                    <option>Casa 18</option>
	                                    <option>Casa 19</option>
	                                    <option>Casa 20</option>
	                                    <option>Casa 21</option>
	                                    <option>Casa 22</option>
	                                    <option>Casa 23</option>
	                                    <option>Casa 24</option>
	                                    <option>Casa 25</option>
	                                    <option>Casa 26</option>
	                                    <option>Casa 27</option>
	                                    <option>Casa 28</option>
	                                    <option>Guardia</option>
	                                    <option>Luz</option>
	                                    <option>Agua</option>

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