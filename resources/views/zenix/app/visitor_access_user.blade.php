{{-- Extends layout --}}
@extends('layout.default')



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
												<h3 class="m-b-0">Acceso para {{count($visitor) ? $visitor[0]['name'] : 'visitante'}} a Condominios El Mezquite</h3>
												@if(count($visitor) && $visitor[0]['active'])
												<span>comparta este acceso con su invitado</span>
												@else
													<span>Este acceso esta inactivo o no existe.</span>
												@endif
											</div>
										</div>
										@if(count($visitor) && $visitor[0]['active'])
											<div class="mt-4">
												<button class="btn btn-secondary mb-1" id='answer-example-share-button'>Compartir</button>
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
    <script type="text/javascript">
    	console.log(window.location.pathname.split("/").pop());
    	const shareButton = document.getElementById("answer-example-share-button"); 
		shareButton.addEventListener("click", (e) => { 
		  if (navigator.share) {
		    navigator.share({
		        title: 'Acceso a Condominios El Mezquite',
		        text: 'Entra a este link para acceder al condominio',
		        url: 'https://condominioselmezquite.homes/visitor_access/'+window.location.pathname.split("/").pop(),
		      })
		      .then(() => console.log('Successful share'))
		      .catch((error) => console.log('Error sharing', error));
		  } else {
		    console.log('Share not supported on this browser, do it the old way.');
		  }
		});
    </script>
@endsection	