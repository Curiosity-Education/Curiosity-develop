@extends('admin_base')

@section('title')
  Inicio
@stop

@section('mi_css')
@stop

@section('titulo_contenido')
  {{HTML::style('/packages/css/curiosity/home_actividades.css')}}
  {{HTML::style('/packages/css/libs/owl_carousel/owl.carousel.css')}}
@stop

@section('migas')
@stop

@section('panel_opcion')
  <section class="panelWelcome">
    <div class="row">
      <div class="col-sm-4">
        <center><img src="/packages/images/vatar.jpg" id="avatarWelcome"></center>
      </div>
      <div class="col-sm-8 text-center">
        <h3><b>¡Aprende mientras te diviertes!</b></h3>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam, porro velit, recusandae temporibus blanditiis eaque aliquam modi maxime magnam, assumenda incidunt necessitatibus fugit optio amet nisi enim autem culpa doloremque.
        </p>
        <br>
        <h6 class="pull-right"><i>Nombre de alguien famoso</i></h6>
      </div>
    </div>
  </section>

  <section class="carruselNews">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="/packages/images/fondos/fondo.jpg" class="imgSlideNew">
          <div class="carousel-caption">
            <h3>Nombre del juego</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis, id quo facilis magni ex aspernatur? Magnam nam voluptate perferendis fuga, error libero, cum, laudantium voluptates ipsum sunt, dignissimos inventore amet.
            </p>
            <button type="button" class="btn btn-warning">
              Comenzar a jugar
            </button>
            <br><br>
          </div>
        </div>

        <div class="item">
          <img src="/packages/images/fondos/fondo2.jpg" class="imgSlideNew">
          <div class="carousel-caption">
            <h3>Nombre del juego</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati, id provident error doloremque sequi ex, deserunt consequatur! At quod nemo qui numquam rem necessitatibus nam esse voluptates consequuntur temporibus.
            </p>
            <button type="button" class="btn btn-warning">
              Comenzar a jugar
            </button>
            <br><br>
          </div>
        </div>

        <div class="item">
          <img src="/packages/images/fondos/fondo3.jpg" class="imgSlideNew">
          <div class="carousel-caption">
            <h3>Nombre del juego</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus unde voluptate laboriosam, nostrum velit nisi fugiat, non similique enim odit expedita pariatur voluptatem ipsa. Veritatis nemo a ad nesciunt deserunt.
            </p>
            <button type="button" class="btn btn-warning">
              Comenzar a jugar
            </button>
            <br><br>
          </div>
        </div>

        <div class="item">
          <img src="/packages/images/fondos/videoFondocp.jpg" class="imgSlideNew">
          <div class="carousel-caption">
            <h3>Nombre del juego</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel ab quod optio iure! Soluta, magni velit ipsa labore aliquam accusantium aperiam rerum quibusdam architecto ratione est recusandae error excepturi amet?
            </p>
            <button type="button" class="btn btn-warning">
              Comenzar a jugar
            </button>
            <br><br>
          </div>
        </div>
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>

  <section class="panels">
    <div class="row">
      <div class="col-sm-6 col-md-3">
        <div class="panelsLook panelPopular">
          <center><h4>Más Populares</h4></center>
          <hr>
          <!--  -->
          <div class='row elementObj'>
            <div class='col-xs-3 col-sm-4'>
              <img src='/packages/images/temas/figuras.png' class='img-circle img-responsive'>
            </div>
            <div class='col-xs-9 col-sm-8 nameGamePanels'>
              <h5>Nombre del juego</h5>
              <span class='fa fa-star starRank'></span>
              <span class='fa fa-star starRank'></span>
            </div>
          </div>
          <!--  -->
          <div class='row elementObj'>
            <div class="col-xs-3 col-sm-4">
              <img src="/packages/images/temas/figuras.png" class="img-circle img-responsive">
            </div>
            <div class="col-xs-9 col-sm-8 nameGamePanels">
              <h5>Nombre del juego</h5>
              <span class="fa fa-star starRank"></span>
              <span class="fa fa-star starRank"></span>
            </div>
          </div>
          <!--  -->
          <div class='row elementObj'>
            <div class="col-xs-3 col-sm-4">
              <img src="/packages/images/temas/figuras.png" class="img-circle img-responsive">
            </div>
            <div class="col-xs-9 col-sm-8 nameGamePanels">
              <h5>Nombre del juego</h5>
              <span class="fa fa-star starRank"></span>
              <span class="fa fa-star starRank"></span>
            </div>
          </div>
          <!--  -->
          <div class='row elementObj'>
            <div class="col-xs-3 col-sm-4">
              <img src="/packages/images/temas/figuras.png" class="img-circle img-responsive">
            </div>
            <div class="col-xs-9 col-sm-8 nameGamePanels">
              <h5>Nombre del juego</h5>
              <span class="fa fa-star starRank"></span>
              <span class="fa fa-star starRank"></span>
            </div>
          </div>
          <!--  -->
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="panelsLook panelRanking">
          <center><h4>Mejor Calificados</h4></center>
          <hr>
          <!--  -->
          <div class='row elementObj'>
            <div class="col-xs-3 col-sm-4">
              <img src="/packages/images/temas/figuras.png" class="img-circle img-responsive">
            </div>
            <div class="col-xs-9 col-sm-8 nameGamePanels">
              <h5>Nombre del juego</h5>
              <span class="fa fa-star starRank"></span>
              <span class="fa fa-star starRank"></span>
            </div>
          </div>
          <!--  -->
          <div class='row elementObj'>
            <div class="col-xs-3 col-sm-4">
              <img src="/packages/images/temas/figuras.png" class="img-circle img-responsive">
            </div>
            <div class="col-xs-9 col-sm-8 nameGamePanels">
              <h5>Nombre del juego</h5>
              <span class="fa fa-star starRank"></span>
              <span class="fa fa-star starRank"></span>
            </div>
          </div>
          <!--  -->
          <div class='row elementObj'>
            <div class="col-xs-3 col-sm-4">
              <img src="/packages/images/temas/figuras.png" class="img-circle img-responsive">
            </div>
            <div class="col-xs-9 col-sm-8 nameGamePanels">
              <h5>Nombre del juego</h5>
              <span class="fa fa-star starRank"></span>
              <span class="fa fa-star starRank"></span>
            </div>
          </div>
          <!--  -->
          <div class='row elementObj'>
            <div class="col-xs-3 col-sm-4">
              <img src="/packages/images/temas/figuras.png" class="img-circle img-responsive">
            </div>
            <div class="col-xs-9 col-sm-8 nameGamePanels">
              <h5>Nombre del juego</h5>
              <span class="fa fa-star starRank"></span>
              <span class="fa fa-star starRank"></span>
            </div>
          </div>
          <!--  -->
        </div>
      </div>
      <div class="col-xs-12 col-md-6">
        <div class="panelsLook panelParaTi">
          <center><h4>Recomendados para Tí</h4></center>
          <hr>
          <!--  -->
          <div class='row elementObj'>
            <div class='col-xs-3 col-sm-2'>
              <img src='/packages/images/temas/figuras.png' class='img-circle img-responsive'>
            </div>
            <div class='col-xs-9 col-sm-10 nameGamePanels'>
              <h5>Nombre del juego</h5>
              <p class='objetivoGame hidden-xs'>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam id culpa, magnam quod quibusdam ex consectetur quam perspiciatis possimus ipsam quasi dolores nihil vitae maiores suscipit architecto velit reiciendis! Recusandae.
              </p>
              <span class="fa fa-star starRank"></span>
              <span class="fa fa-star starRank"></span>
            </div>
          </div>
          <!--  -->
          <div class='row elementObj'>
            <div class='col-xs-3 col-sm-2'>
              <img src='/packages/images/temas/figuras.png' class='img-circle img-responsive'>
            </div>
            <div class='col-xs-9 col-sm-10 nameGamePanels'>
              <h5>Nombre del juego</h5>
              <p class='objetivoGame hidden-xs'>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam id culpa, magnam quod quibusdam ex consectetur quam perspiciatis possimus ipsam quasi dolores nihil vitae maiores suscipit architecto velit reiciendis! Recusandae.
              </p>
              <span class="fa fa-star starRank"></span>
              <span class="fa fa-star starRank"></span>
            </div>
          </div>
          <!--  -->
        </div>
      </div>
    </div>
  </section>

  <section class="slideVideos">
    <div class="owl-carousel">
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
      <div class="itemVideo">
        <img src="/packages/images/fondos/fondo.jpg" />
      </div>
    </div>
  </section>

  <section class="row divisorGrados">
    <div class="col-xs-12">
      <center>
        <h3><b><span class="tilde">~ </span>Grado Escolar<span class="tilde"> ~</span></b></h3>
      </center>
    </div>
  </section>

  <section class="row grades">
    @foreach($grados as $grado)
    <div class="col-xs-4 col-md-2 grade">
      <img src="/packages/images/niveles/{{$grado->imagen}}" class="img-responsive imgGrade"
      data-grade='{{$grado->id}}'
      data-status="{{$grado->estatus}}">
    </div>
    @endforeach
  </section>
@stop

@section('mi_js')
  {{HTML::script('/packages/js/libs/owl_carousel/owl.carousel.min.js')}}
  <script type="text/javascript">
    $(document).ready(function() {
      $('.owl-carousel').owlCarousel({
          loop:true,margin:10,responsiveClass:true,responsive:{
              0:{
                  items:1,
                  nav:true
              },
              600:{
                  items:3,
                  nav:false
              },
              1000:{
                  items:4,
                  nav:true,
                  loop:false
              }
          }
      });      
      $(".owl-next").text("Siguiente");
      $(".owl-prev").text("Anterior");
      $(".imgGrade").click(function(){
        var $grado = $(this);
        if($grado.data('status') != 'lock'){
          // window.location.href = "/edu-"+$grado.data('grade')+"-inteligencia";
          window.location.href="/inteligencia"+$grado.data('grade');
        }
        else{
          $curiosity.noty("Disponible próximamente", "warning");
        }
      });
    });
  </script>
@stop
