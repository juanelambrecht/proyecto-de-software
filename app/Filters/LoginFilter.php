<?php

namespace App\Filters;

use CodeIgniter\CLI\Console;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = session()->isLoggedIn;
        
        if (!$auth) {
            return redirect()->to('/usuarios/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

?>