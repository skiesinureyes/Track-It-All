<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class SignUp extends BaseController
{
    public function index()
    {
        return view('header').view('menu').view('signup').view('footer');
    }

    public function process()
    {
        // Load helper for form and URL
        helper(['form', 'url']);

        // Validation rules
        $validationRules = [
            'full_name'        => 'required|min_length[3]|max_length[100]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($validationRules)) {
            // Validation failed
            return view('signup', ['validation' => $this->validator]);
        }

        // Save user to the database
        $db = \Config\Database::connect();
        $builder = $db->table('users');

        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ];

        $builder->insert($data);

        // Redirect to success page or back to login
        return redirect()->to('/login')->with('success', 'Account created successfully. Please sign in.');
    }
}
