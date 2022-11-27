<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class PasswordResetSendFlashListener
{

    public function handle($event)
    {
        swal()->success('Hesap şifreniz güncellendi.','Başarılı');
    }
}
