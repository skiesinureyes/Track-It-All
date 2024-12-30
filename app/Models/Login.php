<?php
namespace App\Models;
use CodeIgniter\Model;

class Login extends Model
{
    public function getDataUsers($email)
    {
        $db = \Config\Database::connect();
        
        $query = $db->query(
            'SELECT id, email, password, full_name FROM users WHERE email = ?',
            [$email]
        );
    
        return $query->getRow();
    }
}
