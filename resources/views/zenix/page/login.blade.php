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
                            <!--
                            <div class="form-group">
                                <label class="mb-1"><strong>Correo</strong></label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            -->
                            <div class="form-group">
                                <div class="mb-1">
                                    <label class="form-label">Casa:</label>
                                    <select name="email" class="form-control wide" >
                                        <option value="29">Guardia</option>
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
                            <p>Eres condomino y quieres una cuenta? Manda un whatsapp a <a class="text-primary" href="https://wa.me/528120392234">8120392234</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  