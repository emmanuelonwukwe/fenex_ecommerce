<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class NotConnectedException extends Exception
{
    public function report(): bool {
        return false;
    }

    public function render(Request $request){
        return response()->json(["error" => "You are not connected to the internet"]);
    }
}
