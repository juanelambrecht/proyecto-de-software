<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return redirect()->to('welcome_message');
        //edit por mati v2
    }
}
