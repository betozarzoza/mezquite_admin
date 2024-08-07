{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
	<div class="container-fluid">
        <div class="row page-titles mx-0">
            <div>
                <div class="welcome-text">
                     <input type="button" class="btn btn-light btn-block" onclick="printableDiv('invoice_mezquite')" value="Imprimir" />
                </div>
            </div>
        </div>
        <div class="row" id="invoice_mezquite">
            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-header"> Recibo de pago <strong>{{ \Carbon\Carbon::parse($movement->created_at)->format('l jS \\of F Y h:i:s A') }}</strong> <span class="float-end">
                            <strong>Estatus:</strong> Pago completado</span> </div>
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                <h6>De:</h6>
                                <div> <strong>Condominios El Mezquite</strong> </div>
                                <div>Elias Gtz de C 3301</div>
                                <div>Ciudad Victoria, Tamaulipas</div>
                                <div>Correo: hola@condominioselmezquite.com</div>
                                <div>Telefono: +812 039 22 34</div>
                            </div>
                            <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                <h6>Para:</h6>
                                <div> <strong>{{$movement->house->owner_name}}</strong> </div>
                                <div>Casa {{ $movement->house->id }}</div>
                                <div>Telefono: {{ $movement->house->owner_contact }}</div>
                            </div>
                            <div class="mt-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
                                <div class="row align-items-center">
									<div class="col-sm-9"> 
										<div class="brand-logo mb-3">
											<img class="logo-abbr me-2" width="50" src="{{ asset('images/logo.png') }}" alt="">
											<img class="logo-compact" width="110" src="{{ asset('images/logo-text.png') }}" alt="">
										</div>
                                        <span>Please send exact amount: <strong class="d-block">0.15050000 BTC</strong>
                                            <strong>1DonateWffyhwAjskoEwXt83pHZxhLTr8H</strong></span><br>
                                        <small class="text-muted">Current exchange rate 1BTC = $6590 USD</small>
                                    </div>
                                    <div class="col-sm-3 mt-3"> <img src="{{ asset('images/qr.png') }}" alt="" class="img-fluid width110"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Nombre</th>
                                        <th class="right">Costo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="center">1</td>
                                        <td class="left strong">{{$movement->name}}</td>
                                        <td class="right">${{$movement->quantity}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5"> </div>
                            <div class="col-lg-4 col-sm-5 ms-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left"><strong>Total</strong></td>
                                            <td class="right"><strong>${{$movement->quantity}}</strong><br>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function printableDiv(printableAreaDivId) {
             var printContents = document.getElementById(printableAreaDivId).innerHTML;
             var originalContents = document.body.innerHTML;

             document.body.innerHTML = printContents;

             window.print();

             document.body.innerHTML = originalContents;
        }
    </script>
@endsection