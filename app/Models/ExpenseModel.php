<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model
{
    protected $table = 'expenses';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['user_id', 'amount', 'category', 'description', 'date'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $validationRules = [
        'amount' => 'required|numeric',
        'category' => 'required|min_length[3]|max_length[100]',
        'description' => 'required|min_length[3]|max_length[255]',
        'date' => 'required|valid_date'
    ];

    public function getExpensesByUserId($userId)
    {
        return $this->where('user_id', $userId)->orderBy('date', 'DESC')->findAll();
    }

}