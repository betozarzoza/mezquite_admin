{{-- Extends layout --}}
@extends('layout.fullwidth')



{{-- Content --}}
@section('content')
    <div class="col-md-6">
        <div class="authincation-content">
            <div class="row no-gutters">
                <div class="col-xl-12">
                    <div class="auth-form">
                        @if($errors->any())
                        <div class="alert alert-danger solid alert-dismissible fade show">
                            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                            <strong>Error!</strong> {{$errors->first()}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                            </button>
                        </div>
                        @endif
    					<div class="text-center mb-3">
    						<img src="images/logo-mezquite.png" alt="">
    					</div>
                        <h4 class="text-center mb-4">Conectate a tu cuenta</h4>
                        <form action="auth/login" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="mb-1"><strong>Correo</strong></label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="mb-1"><strong>Contrasena</strong></label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block">Iniciar sesion</button>
                            </div>
                        </form>
                        <div class="new-account mt-3">
                            <p>Eres condomino y quieres una cuenta? Manda un whatsapp a <a class="text-primary" href="{!! url('/page-register'); !!}">8120392234</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  