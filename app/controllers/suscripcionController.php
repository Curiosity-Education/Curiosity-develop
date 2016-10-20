<?php
class suscripcionController extends BaseController{

    public function suscripcion(){
        if(Request::method() == 'GET'){
          $datos=[
            "estados"     =>$estados = estado::all(),
            "ciudades"    =>$ciudades = ciudad::where("estado_id","=",$estados->first()->id)->get(),
            "paises"      =>ladaPais::all()
           ];
            return View::make('vista_registro_padre')->with("datos",$datos);
        }
        else{
            require_once(__DIR__.'/conekta-php/lib/Conekta.php');
            Conekta::setApiKey("key_vK8GrZTfhXuDp9GwnR14HQ");
            try{
              $customer = Conekta_Customer::create(array(
                "name"=> "Lews ",
                "email"=> "lews.therin@gmail.com",
                "phone"=> "55-5555-5555",
                "cards"=> array('tok_test_visa_1881')// array(Input::get('conektaTokenId'))  //"tok_a4Ff0dD2xYZZq82d9"
              ));
                  /*$plan = Conekta_Plan::create(array(
                      "id"=> "curiosity_plan_sub",
                      "name"=> "Curiosity",
                      "amount"=> 4900,
                      "currency"=> "MXN",
                      "interval"=> "month"
                    ));*/

                $subscription = $customer->createSubscription(array(
                  "plan_id"=> "curiosity_plan_sub"
                ));
                if ($subscription->status == 'active') {
                     //la suscripción inicializó exitosamente!
                        return Response::json(array(0=>'success'));

                    }
                    elseif ($subscription->status == 'past_due') {
                     //la suscripción falló a inicializarse
                        return Response::json(array(0=>'error'));
                    }
            }catch (Conekta_Error $e){
              echo $e->getMessage();
             //el cliente no pudo ser creado
            }




        }
    }
}
