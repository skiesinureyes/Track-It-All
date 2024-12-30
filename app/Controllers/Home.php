<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        $data = [
            'logged_in' => $session->get('logged_in'),
            'user_email' => $session->get('user_email'),
            'full_name' => $session->get('full_name'),
        ];

        return view('header').view('menu', $data).view('dashboard').view('footer');
    }
}
