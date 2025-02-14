{{-- Extends layout --}}
@extends('layout.fullwidth')



{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo rounded"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<div class="profile-statistics">
									<div class="text-center">
										<div class="row">
											<div class="col">
												<h3 class="m-b-0">Bienvenido {{count($visitor) ? $visitor[0]['name'] : 'visitante'}} a Condominios El Mezquite</h3>
												@if(count($visitor) && $visitor[0]['active'])
												<span>pulse el boton para abrir el porton</span>
												@else
													<span>Este acceso esta inactivo o no existe</span>
												@endif
											</div>
										</div>
										@if(count($visitor) && $visitor[0]['active'])
											<div class="mt-4">
												<form action="/release_the_kraken" method="post">
													@csrf
													<input type="hidden" value="{{$visitor[0]['access_id']}}" name="access_id">
													<button type="submit" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#sendMessageModal">Abrir porton</button>
												</form>
											</div>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
@endsection	