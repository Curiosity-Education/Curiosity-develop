@extends('admin_base')
@section('mi_css')
{{HTML::style('/packages/css/curiosity/tienda.css')}}
@stop

@section('title')
	Tienda Curiosity
@stop


@section('titulo_contenido')
	¡Tienda Curiosity!
@stop

@section('panel_opcion')
  <section class="container-fluid">

  	<div class="row">
  		<div class="col-sm-4">
  			<div class="ordenador color-top">
  				<center><img src="/packages/images/avatars_curiosity/secuencias/{{$avatarActual->sprite}}" id='miAvatar' class="img-responsive"></center>
  			</div>
  		</div>
			<div class="col-sm-8">
				<div class="ordenador color-top">
					<h4 class="text-center"><b>{{$nombreAvatarActual}}</b></h4>
					<br>
					<p class="text-center">{{$avatarActual->historia}}</p>
				</div>
			</div>
  	</div>

		<div class="row">

			<div class="col-sm-8 col-md-9">
				<!-- Estilos para el avtar -->
				<div class="ordenador">
					<center><h4 class="titleforpanel" id="seccEstilo">Cambia el estilo de tu avatar</h4></center>
					<div class="row">
						@foreach ($avatarEstilos as $estilo)
						@if ($experiencia->cantidad_exp >= $estilo->valor)
							@if ($estilo->id == $avatarActual->idEstilo)
								<div class="col-sm-6 col-md-3">
							@else
								<div class="col-sm-6 col-md-3 myStyle" id="{{$estilo->id}}ast">
							@endif
						@else
						<div class="col-sm-6 col-md-3 style">
						@endif
							<div class="panelItem itemAvatar">
								@if ($experiencia->cantidad_exp >= $estilo->valor)
								<span class="fa fa-unlock iconlock"></span>
								@else
								<span class="fa fa-lock iconlock"></span>
								@endif
								<center>
									<img src="/packages/images/avatars_curiosity/estilos/{{$estilo->preview}}" class="img-responsive">
									<div class="captionInfo captionAvatar">
										@if ($estilo->id == $avatarActual->idEstilo)
											En uso
										@elseif ($experiencia->cantidad_exp >= $estilo->valor)
											Utilizar
										@else
											Exp | {{$estilo->valor}} pts
										@endif
									</div>
								</center>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<!-- Skins para el sistema -->
				<div class="ordenador">
					<center><h4 class="titleforpanel" id="seccSkin">Escoge tu color favorito</h4></center>
					<div class="row">
						@foreach ($mySkins as $skin)
						<div class="col-sm-6 col-md-3">
							@if ($skin->uso == 1)
							<div class="panelItem itemSkin">
							@else
							<div class="panelItem itemSkin sk" id='{{$skin->id}}sku'>
							@endif
								<center>
									<img src="/packages/images/skins/{{$skin->preview}}" class="img-responsive">
									<div class="captionInfo captionSkin">
										@if ($skin->uso == 1)
											En uso
										@else
											Utilizar
										@endif
									</div>
								</center>
							</div>
						</div>
						@endforeach
						@foreach ($skinsBuy as $skin)
						<div class="col-sm-6 col-md-3">
							<div class="panelItem itemSkin skout" id='{{$skin->id}}sku'>
								<center>
									<img src="/packages/images/skins/{{$skin->preview}}" class="img-responsive">
									<div class="captionInfo captionSkin">
										@if ($skin->costo == 0)
											Utilizar
										@else
											CC | {{$skin->costo}} cc
										@endif
									</div>
								</center>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>

			<div class="col-sm-4 col-md-3">
				<div class="col-xs-12 ordenador" id="orderExp">
					<center>
						<img src="/packages/icons/settings.png" class="img-responsive imgforinfo">
						<div class="orderInfo" id="orderInfoExp">
							<h5 class="titleforinfo"><b>Mi Experiencia</b></h5>
							<b class="myinfo" id="cantExp">{{$experiencia->cantidad_exp}} pts</b>
						</div>
					</center>
				</div>
				<div class="col-xs-12 ordenador" id="orderCoins">
					<center>
						<img src="/packages/icons/medall.png" class="img-responsive imgforinfo">
						<div class="orderInfo" id="orderInfoCoins">
							<h5 class="titleforinfo"><b>Curiosity Coins</b></h5>
							<b class="myinfo" id="cantCoins">{{$experiencia->coins}} cc</b>
						</div>
					</center>
				</div>
			</div>

		</div>

  </section>
@stop


@section('mi_js')

{{HTML::script('/packages/js/curiosity/tienda.js')}}
{{HTML::script('/packages/js/curiosity/useTienda.js')}}
@stop
