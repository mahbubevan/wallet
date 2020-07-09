<?php

namespace App\Http\Composers;

use App\Notification;
use Illuminate\Contracts\View\View;

class MasterComposer{

    public function compose(View $view)
    {
        $count = Notification::where('seen',0)->count();
        $view->with('count',$count);
    }

}