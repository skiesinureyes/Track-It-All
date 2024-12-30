<?php
namespace App\Controllers;
use App\Models\Login;

class LoginController extends BaseController
{
    public function index()
    {
        return view('header').view('menu').view('login', ['error' => session()->getFlashdata('error')]).view('footer');
    }

    public function login_action()
    {
        $model = model(Login::class);
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password'); 

        $user = $model->getDataUsers($email);

        if ($user && password_verify($password, $user->password)) {
            session()->set([
                'user_id' => $user->id, 
                'user_email' => $email,
                'full_name' => $user->full_name,
                'logged_in' => true,
            ]);

            if (!session()->get('user_id')) {
                die('Session user_id not set after login.');
            }

            return redirect()->to('/todo');
        } 
        
        else {
            session()->setFlashdata('error', 'Invalid email or password');
            return redirect()->to('/login');
        }

        var_dump(session()->get()); // Debugging
        die();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
