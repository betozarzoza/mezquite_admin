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
												<h3 class="m-b-0">Bienvenido {{$name}}</h3><span>a Condominios El Mezquite, pulse el boton para abrir</span>
											</div>
										</div>
										<div class="mt-4">
											<a href="javascript:void();;" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#sendMessageModal">Abrir porton</a>
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
@endsection	