@extends('admin_base')

@section('title')
  Pago de suscripción
@stop

@section('mi_css')
@stop

@section('titulo_contenido')
    Pago de suscripción
@stop

@section('migas')
  <li><a href="/inicio">Inicio</a></li>
@stop

@section('panel_opcion')
    <h1>Sign Up</h1>
    <form action="/pay-suscription" method="POST">
      <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_test_m45LhNC5wCOm0pm45g5tCVrv"
        data-amount="5800"
        data-name="Curiosity Educación"
        data-description="Suscripción Mensual"
        data-image="/packages/images/Curiosity-mini.png"
        data-locale="auto">
      </script>
    </form>
@stop

@section('mi_js')
  {{HTML::script('/packages/js/curiosity/actividad.js')}}
@stop
