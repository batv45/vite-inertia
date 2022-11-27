<?php

if( !function_exists('notyf') ){
    /**
     * @return \Flasher\Notyf\Prime\NotyfFactory
     */
    function notyf() : \Flasher\Notyf\Prime\NotyfFactory
    {
        return app(\Flasher\Notyf\Prime\NotyfFactory::class);
    }
}
if( !function_exists('swal') ){
    /**
     * @return \Flasher\SweetAlert\Prime\SweetAlertFactory
     */
    function swal() : \Flasher\SweetAlert\Prime\SweetAlertFactory
    {
        return app(\Flasher\SweetAlert\Prime\SweetAlertFactory::class);
    }
}
