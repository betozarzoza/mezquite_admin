{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
	<link href="{{ asset('vendor/jquery-asColorPicker/css/asColorPicker.min.css') }}" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="{{ asset('vendor/jquery-asColor/jquery-asColor.min.js')}}"></script>
	<script src="{{ asset('vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js')}}"></script>
	<script src="{{ asset('js/plugins-init/jquery-asColorPicker.init.js')}}"></script>

    <div class="container-fluid">        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo rounded"></div>
                        </div>
                        <div class="profile-info">
							<div class="profile-photo">
								<img src="{{ asset('images/profile/profile.png') }}" class="img-fluid rounded-circle" alt="">
							</div>
							<div class="profile-details">
								<div class="profile-name px-3 pt-2">
									<h4 class="text-primary mb-0">{{ auth()->user()->name }}</h4>
									<p>Casa {{ auth()->user()->houses_id }}</p>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-tab">
                                <div id="profile-settings">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary">Informacion de la cuenta</h4>
                                            <form action="auth/reset" method="post">
                            					@csrf
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label class="form-label">Contrasena</label>
                                                        <input type="password" name="contrasena" class="form-control">
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Cambiar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="profile-tab">
                                <div id="profile-settings">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary">Informacion de la casa</h4>
                                            <form action="profile_update" method="post">
                            					@csrf
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label class="form-label">Nombre del propietario</label>
                                                        <input type="text" name="nombre_del_propietario" value="{{$house->owner_name}}" class="form-control">
                                                    </div>
                                                </div>
                                                 <div class="row mb-3">
                                                    <div class="col">
                                                        <label class="form-label">Telefono</label>
                                                        <input type="number" name="telefono" value="{{$house->owner_contact}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
					                                <div class="row">
					                                    <label class="form-label">Color de casa</label>
					                                    <input type="text" name="color" class="as_colorpicker form-control" value="{{$house->color}}">
					                                </div>
					                            </div>
                                                <button class="btn btn-primary" type="submit">Cambiar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
		    
		    // Colorpicker
		    $(".as_colorpicker").asColorPicker();
		})(jQuery);
    </script>
@endsection	   