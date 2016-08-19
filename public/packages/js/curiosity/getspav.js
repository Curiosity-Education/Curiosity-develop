var $sprite = {

  index : 0,
  putSpriteSelected : function($name, $selector){
    $.ajax({
      url: '/getSpriteselected-'+$name,
      type: 'POST'
    })
    .done(function(response) {      
      if (response['estatus'] == true){
        $sprite.startAnim($selector, response['sprite']);
      }
      else{
        $selector.attr("src", "/packages/images/avatars_curiosity/secuencias/"+response['sprite']);
      }
    })
    .fail(function(error) {
      console.log(error);
    });
  },
  startAnim : function($img, $array, $framesToStay, $speedForce){
    if ($framesToStay == undefined){
      $framesToStay = 0;
    }
    if ($speedForce == undefined){
      $speedForce = 100;
    }
    var stay = 0;
    var temp = setInterval(function(){
      if ($sprite.index < $array.length){
        $img.attr("src", "/packages/images/avatars_curiosity/secuencias/"+$array[$sprite.index]['sprite']);
        if ($sprite.index == $array.length - 1){
          if (stay < $framesToStay){
            stay++;
          }
          else{
            clearInterval(temp);
            $sprite.index = 1;
            $sprite.startAnim($img, $array, $framesToStay, $speedForce);
          }
        }
        else{
          $sprite.index++;
        }
      }
    }, $speedForce);
  }

}
