$(document).ready(function(){
    $alerts =$("<div/>",{class:"cont-alerts"});
    $("body").append($alerts);
    $alerts.hide();
    alerta={
        show:function (titulo,message,tipy,autoclose){
            $alerts.show();
            $alert = $("<div/>",{class:"alert "+tipy});
            $img = $("<img/>",{src:"packages/images/curiosity.png"});
            $h4Title =$("<h4/>").text(titulo);
            $demiss = $("<i/>").text("x");
            $p = $("<p/>").text(message);
            $alert.append($img);
            $alert.append($h4Title);
            $alert.append($demiss);
            $alert.append($p);
            $alerts.append($alert);
            if(autoclose){
                $alert.fadeOut(6100,function(){
                    if($alerts.isEmptyObject){
                        $alerts.hide();
                    }
                    else{
                        $alert.first().remove();
                    }
                });
            }
        },
        errorOnInputs:function(errors){
            $.each(errors,function(c,o){
               $label = $("<label>",{id:c+"-error",class:"error"}).text(o);
               $("input[name='"+c+"']").parent().parent().append($label);
               $("select[name='"+c+"']").parent().parent().append($label);
               $("input[name='"+c+"']").addClass("error");
               $("select[name='"+c+"']").addClass("error");
            });
        },
        errorAtInput:function(errors){
            $.each(errors,function(c,o){
               $label = $("<label>",{id:c+"-error",class:"error"}).text(o);
               $("input[name='"+c+"']").parent().append($label);
               $("select[name='"+c+"']").parent().append($label);
               $("input[name='"+c+"']").addClass("error");
               $("select[name='"+c+"']").addClass("error");
            });
        }

    }


    $("body").on("click",".alert>i",function(){
            $(this).parent().remove();
        });
});
