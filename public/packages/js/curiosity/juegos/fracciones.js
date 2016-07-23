$(document).ready(function(){
    var inicio=false;
    var numhtml1,numhtml2,numhtml3,numhtml4,cantidadp=0,y,z,q,efectividadniño=0,efectividadmaxima=0,puntos=0,y2,clase,var1arreglo,var2arreglo;
    var arregloresp=[];
     //Zona del estandar de desarrollo de juegos //
      $curiosity.menu.setPaginaId("#li-conteo-basico");
      $juego.setTitulo("Conteo - Basico");
      $juego.setBackgroundColor("rgb(25, 132, 179)");
      $juego.setBackgroundImg("/packages/images/fondos/fondo.jpg");
      $juego.boton.comenzar.setFuncion(function(){
         if(inicio==false){
                inicio=true;
                dinamica(aleatoriores());
                $juego.game.start(60,false);
            }
      });
      $juego.setSrcVideo({
        titulo:"| Conteo basico |",
        ruta:"/packages/video/games/instrucciones/conteo-basico.mp4",
        explanation1:"1. Cuenta los diferentes objetos que se mueven.",
        explanation2:"2. Elige la carta con el numero de objetos que contaste."
      });
       $juego.slider.changeImages({
          img1:"conteo01.png",
          img2:"conteo03.png",
          img3:"conteo02.png"
       });
   $("#game").on("finish",function(){
        inicio = false;
    });
    $("#game").on("exit",function(){
        inicio= false;
    });
    $("#game").on("restart",function(){
        inicio=false;
    });
    //Fin de la zona de estandar //
    function aleatorio(){
        var aleatorio=Math.round(Math.random()*10+1);
        return aleatorio;
    }
    function aleatorio2(a){
        var aleatorio=Math.round(Math.random()*6+a);
        return aleatorio;
    }
    function aleatoriores(){
        var aleatorio=Math.round(Math.random()*3+1);
        return aleatorio;
    }
    function reduccionresp(num1,num2){
        y=num1;
        z=num2;
        x=z;
        if((y%z)==0)
            {
                z=y/z;
                y=0;
                arregloresp[4]=z;
            }
        else
             {
                for(x=z;x>0;x--)
                    {
                        if((y%x)==0 && (z%x)==0)
                            {
                                y=y/x;
                                z=z/x;
                                arregloresp[4]=y/z;
                                x=0;
                            }
                    }
            }
    }
    function reduccion(num1,num2,num3,num4,operacion){
        var x;
        if(operacion==1)
            {
                $("#instruccion").text("Suma los numeros");
                y=(num1*num4)+(num2*num3);
                z=num2*num4;
                x=z;
                for(x=z;x>0;x--)
                    {
                        if((y%x)==0 && (z%x)==0)
                            {
                                y=y/x;
                                z=z/x;
                                x=0;
                            }
                    }
            }
        else if(operacion==2)
            {
                $("#instruccion").text("Resta los numeros");
                y=(num1*num4)-(num2*num3);
                z=num2*num4;
                x=z;
                for(x=z;x>0;x--)
                    {
                        if((y%x)==0 && (z%x)==0)
                            {
                                y=y/x;
                                z=z/x;
                                x=0;
                            }
                    }
            }
        else if(operacion==3)
            {
                $("#instruccion").text("Multiplica las Fracciones");
                y=num1*num3;
                z=num2*num4;
                x=z;
                for(x=z;x>0;x--)
                    {
                        if((y%x)==0 && (z%x)==0)
                            {
                                y=y/x;
                                z=z/x;
                                x=0;
                            }
                    }
            }
        else
            {
                $("#instruccion").text("Divide las Fracciones");
                y=num1*num4;
                z=num2*num3;
                x=z;
                for(x=z;x>0;x--)
                    {
                        if((y%x)==0 && (z%x)==0)
                            {
                                y=y/x;
                                z=z/x;
                                x=0;
                            }
                    }
            }
    }
    function respuestas(){
        q=aleatoriores();
        $("#rn"+clase).addClass("fdn");
        if(q==1)
            {
                reduccionresp(y,z);
                if(q==0)
                    {
                        $("#entero1").html(z);
                        $("#rn1").html('');
                        $("#rn2").html('');
                        $("#rn2").removeClass();
                        clase=2;
                    }
                else
                    {
                        $("#entero1").html('');
                        $("#rn1").html(y);
                        $("#rn2").html(z);    
                    }
            }
            else if(q==2)
                {
                    reduccionresp(y,z);
                    if(y==0)
                        {
                            $("#entero2").html(z);
                            $("#rn3").html('');
                            $("#rn4").html('');
                            $("#rn4").removeClass();
                            clase=4;
                        }
                    else
                        {
                            $("#entero2").html('');
                            $("#rn3").html(y);
                            $("#rn4").html(z);
                        }
                }
            else if(q==3)
                {
                    reduccionresp(y,z);
                    if(y==0)
                        {
                            $("#entero3").html(z);
                            $("#rn5").html('');
                            $("#rn6").html('');
                            $("#rn6").removeClass();
                            clase=6;
                        }
                    else
                        {
                            $("#entero3").html('');
                            $("#rn5").html(y);
                            $("#rn6").html(z);    
                        }
                }
            else
                {
                    reduccionresp(y,z);
                    if(y==0)
                        {
                            $("#entero4").html(z);
                            $("#rn7").html('');
                            $("#rn8").html('');
                            $("#rn8").removeClass();
                            clase=8;
                        }
                    else
                        {
                            $("#entero4").html('');
                            $("#rn7").html(y);
                            $("#rn8").html(z);
                        }
                }
    }
    function comparar(i){
        var bandera=false,c;
        while(bandera==false)
            {
                var1arreglo=aleatorio2(y);
                var2arreglo=aleatorio2(z);
                arregloresp[i]=(var1arreglo/var2arreglo);
                c=i;
                if(c!=0)
                    {
                        for(c=i;c>0;c--)
                        {
                            if(arregloresp[i]==arregloresp[c-1])
                                c=-1;
                            else if(c==1)
                                bandera=true;
                        }
                    }
                else
                    bandera=true;
                if(arregloresp[i]==arregloresp[4])
                            {
                                bandera=false;
                            }
            }
        //Esta parte del codigo es la que aun no arreglo roger, Se trata de que no remueve y añade correctamente la clase fdn al segundo span
        //de los div de respuestas cuando se calcula que el numero fue entero o en caso contrario lo reduce lo mas posible
        reduccionresp(var1arreglo,var2arreglo);
        if (i==0)
            c=1;
        else if(i==1)
            c=3;
        else if(i==2)
            c=5;
        else if(i==3)
            c=7;
        if(y==0)
            {
                $("#entero"+(i+1)).html(z);
                $("#rn"+c).html('');
                $("#rn"+(c+1)).html('');
                $("#rn"+(c+1)).removeClass();
                clase=8;
            }
        else
            {
                $("#entero"+(i+1)).html('');
                $("#rn"+(c)).html(y);
                $("#rn"+(c+1)).html(z);
                $("#rn"+(c+1)).addClass("fdn");
            }
        //Aqui termina el problema// aquí comienza no se le entiende nada a tu código felipe
    }
    function respuestasaleatorias(){
        $("#entero1").html('');
        comparar(0);
        $("#entero2").html('');
        comparar(1);
        $("#entero3").html('');
        comparar(2);
        $("#entero4").html('');
        comparar(3);
    }
    function dinamica(opcion){
        switch(opcion)
            {
                case 1:
                    {
                        numhtml1=aleatorio();
                        numhtml2=aleatorio();
                        numhtml3=aleatorio();
                        reduccion(numhtml1,numhtml2,numhtml3,1,1);
                        $("#num1").html(numhtml1);
                        $("#num2").html(numhtml2);
                        $("#num3").html('');
                        $("#num4").html('');
                        $("#simbolo").html(' + '+numhtml3);
                        respuestasaleatorias();
                        reduccion(numhtml1,numhtml2,numhtml3,1,1);
                        respuestas();
                    }break;
                case 2:
                    {
                        y2=-1;
                        while(y2<0)
                            {
                                numhtml1=aleatorio();
                                numhtml2=aleatorio();
                                numhtml3=aleatorio();
                                y2=(numhtml1/numhtml2)-numhtml3;
                            }
                        $("#num1").html(numhtml1);
                        $("#num2").html(numhtml2);
                        $("#num3").html('');
                        $("#num4").html('');
                        $("#simbolo").html(' - '+numhtml3);
                        reduccion(numhtml1,numhtml2,numhtml3,1,2);
                        respuestasaleatorias();
                        reduccion(numhtml1,numhtml2,numhtml3,1,2);
                        respuestas();
                    }break;
                case 3:
                    {
                        numhtml1=aleatorio();
                        numhtml2=aleatorio();
                        numhtml3=aleatorio();
                        numhtml4=aleatorio();
                        $("#num1").html(numhtml1);
                        $("#num2").html(numhtml2);
                        $("#num3").html(numhtml3);
                        $("#num4").html(numhtml4);
                        $("#simbolo").html(' x ')
                        reduccion(numhtml1,numhtml2,numhtml3,numhtml4,3);
                        respuestasaleatorias();
                        reduccion(numhtml1,numhtml2,numhtml3,numhtml4,3);
                        respuestas();
                    }break;
                default:
                    {
                        numhtml1=aleatorio();
                        numhtml2=aleatorio();
                        numhtml3=aleatorio();
                        numhtml4=aleatorio();
                        $("#num1").html(numhtml1);
                        $("#num2").html(numhtml2);
                        $("#num3").html(numhtml3);
                        $("#num4").html(numhtml4);
                        $("#simbolo").html(' / ')
                        reduccion(numhtml1,numhtml2,numhtml3,numhtml4,4);
                        respuestasaleatorias();
                        reduccion(numhtml1,numhtml2,numhtml3,numhtml4,4);
                        respuestas();
                    }break;
            }
    }
    $("#op1").click(function(){
        if(inicio==true)
            {
                if("op1"==("op"+q))
                    {
                        $juego.game.setCorrecto();
                        if(cantidadp==9)
                            {
                                //alert("terminaste");
                                //inicio=false;
                                //cantidadp=0;
                                //alert("Tu puntuacion es: "+Math.round(puntos*efectividadniño/efectividadmaxima)+"puntos");
                            }
                        else
                            {
                                //$("#cantidad").html((cantidadp+2)+"/10");
                                //$juego.game.setError(50);
                                dinamica(aleatoriores());
                                //$("#op1").append("<i class='fa fa-check'></i>")
                                //cantidadp++;
                            }
                    }else $juego.game.setError(50);
            }
    })
    $("#op2").click(function(){
        if(inicio==true)
            {
                if("op2"==("op"+q))
                    {
                        $juego.game.setCorrecto();
                        if(cantidadp==9)
                            {
                               // alert("terminaste");
                               // inicio=false;
                                //cantidadp=0;
                                //alert("Tu puntuacion es: "+Math.round(puntos*efectividadniño/efectividadmaxima)+"puntos");
                            }
                        else
                            {
                                //$("#cantidad").html((cantidadp+2)+"/10");
                                dinamica(aleatoriores());
                                //$("#op2").append("<i class='fa fa-check'></i>")
                                //cantidadp++;
                            }
                    }else $juego.game.setError(50);
            }
    })
    $("#op3").click(function(){
        if(inicio==true)
            {
                //efectividadmaxima++;
                if("op3"==("op"+q))
                    {
                        $juego.game.setCorrecto();
                        puntos=puntos+100;
                        efectividadniño++;
                        if(cantidadp==9)
                            {
                             //   alert("terminaste");
                               // inicio=false;
                               // cantidadp=0;
                               // alert("Tu puntuacion es: "+Math.round(puntos*efectividadniño/efectividadmaxima)+"puntos");
                            }
                        else
                            {
                                //$("#cantidad").html((cantidadp+2)+"/10");
                                dinamica(aleatoriores());
                               // $("#op3").append("<i class='fa fa-check'></i>")
                               // cantidadp++;
                            }
                    }else $juego.game.setError(50);
            }
    });
    $("#op4").click(function(){
        if(inicio==true)
            {
                efectividadmaxima++;
                if("op4"==("op"+q))
                    {
                        puntos=puntos+100;
                        efectividadniño++;
                        if(cantidadp==9)
                            {
                               // alert("terminaste");
                               // inicio=false;
                                //cantidadp=0;
                                //alert("Tu puntuacion es: "+Math.round(puntos*efectividadniño/efectividadmaxima)+"puntos");
                            }
                        else
                            {
                               // $("#cantidad").html((cantidadp+2)+"/10");
                                dinamica();
                               // $("#op4").append("<i class='fa fa-check'></i>")
                                //cantidadp++;
                            }
                    }else $juego.game.setError(50);
            }
    });
});