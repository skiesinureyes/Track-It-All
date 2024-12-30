<?php

namespace App\Controllers;

use App\Models\ExpenseModel;
use CodeIgniter\Controller;

class Expense extends Controller
{
    protected $expenseModel;
    
    public function __construct()
    {
        $this->expenseModel = new ExpenseModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pocketify - Pencatatan Pengeluaran Mahasiswa',
            'expenses' => $this->expenseModel->orderBy('date', 'DESC')->findAll()
        ];
        
        return view('expenses/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pengeluaran Baru'
        ];

        return view('expenses/create', $data);
    }

    public function store()
    {
        if (!$this->validate($this->expenseModel->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->expenseModel->insert([
            'user_id' => 1, // Sementara hardcode, nanti bisa disesuaikan dengan sistem auth
            'amount' => $this->request->getPost('amount'),
            'category' => $this->request->getPost('category'),
            'description' => $this->request->getPost('description'),
            'date' => $this->request->getPost('date')
        ]);

        return redirect()->to('/expenses')->with('message', 'Pengeluaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Pengeluaran',
            'expense' => $this->expenseModel->find($id)
        ];

        if (empty($data['expense'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengeluaran tidak ditemukan');
        }

        return view('expenses/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate($this->expenseModel->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->expenseModel->update($id, [
            'amount' => $this->request->getPost('amount'),
            'category' => $this->request->getPost('category'),
            'description' => $this->request->getPost('description'),
            'date' => $this->request->getPost('date')
        ]);

        return redirect()->to('/expenses')->with('message', 'Pengeluaran berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->expenseModel->delete($id);
        return redirect()->to('/expenses')->with('message', 'Pengeluaran berhasil dihapus');
    }
}