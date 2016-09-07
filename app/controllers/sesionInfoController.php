<?php

class sesionInfoController extends BaseController{
    public function missedSession(){
        
        return View::make('missedSession');
    }
    public function getLastSession(){
        if(Auth::check()){
            Session::put('sesionInfo',array(
                'device'  => Auth::user()->sesion_info->device,
                'browser' => Auth::user()->sesion_info->browser,
                'app_version' => Auth::user()->sesion_info->app_version,
                'mobile'    => Auth::user()->sesion_info->mobile,
                'date_login' => Auth::user()->sesion_info->updated_at
            ));
            Auth::logout();
        }
        return Session::get('sesionInfo');
    }
}