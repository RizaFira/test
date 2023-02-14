<?php
namespace App\Http\Controllers;

use App\Helpers\Bot;
use App\Models\User;
use App\Models\Events;
use App\Helpers\MyDate;

class WidgetController extends Controller
{

    public function chat($key)
    {
        if($key !='123123423'){
            abort(404);
        }
        $data['key'] = $key;
        return view('chat-new',$data);
    }
}
