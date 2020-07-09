<?php

namespace App\Http\Composers;

use App\Email;
use Illuminate\Contracts\View\View;

class EmailComposer{

    public function compose(View $view)
    {
        $count = Email::where('status',0)->count();
        $view->with('email_count',$count);
    }

}