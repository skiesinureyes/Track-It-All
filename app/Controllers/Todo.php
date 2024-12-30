<?php

namespace App\Controllers;

class Todo extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $session = session();

        // Check if the user is logged in
        $userId = $session->get('user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Please log in to view your tasks.');
        }

        // Fetch tasks for the logged-in user
        $tasks = $db->table('tasks')
        ->where('user_id', $userId) // Only fetch tasks for the current user
        ->get()
        ->getResultArray();
        
        $data = [
            'logged_in' => $session->get('logged_in'),
            'user_email' => $session->get('user_email'),
            'full_name' => $session->get('full_name'),
            'tasks' => $tasks,
        ];

        return view('header').view('menu', $data).view('todo', $data).view('footer');
    }

    public function addTask()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'User not logged in']);
        }

        $userId = session()->get('user_id'); // Ensure user ID is stored
        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'User ID missing from session']);
        }

        // Decode JSON payload
        $rawData = $this->request->getBody();
        log_message('debug', 'Raw Data: ' . $rawData);

        $data = json_decode($rawData, true);
        if (!$data) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid JSON payload']);
        }

        // Add necessary fields
        $data['user_id'] = $userId; // Associate task with logged-in user
        $data['completed'] = 0; // Default completed status

        log_message('debug', 'Data to be inserted: ' . json_encode($data));

        $db = \Config\Database::connect();

        if (!$db->table('tasks')->insert($data)) {
            $dbError = $db->error();
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to insert data', 'error' => $dbError]);
        }

        if ($db->affectedRows() > 0) {
            return $this->response->setJSON(['success' => true, 'message' => 'Task added successfully']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to add task. No rows affected.']);
        }
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();
        $task = $db->table('tasks')->getWhere(['id' => $id])->getRowArray();

        if (!$task) {
            return redirect()->to('/todo')->with('error', 'Task not found.');
        }

        $data = [
            'task' => $task,
            'full_name' => session()->get('full_name'),
        ];

        return view('header')
            . view('menu', $data)
            . view('edit_task', $data)
            . view('footer');
    }

    public function update($id)
    {
        $db = \Config\Database::connect();
        $data = [
            'category' => $this->request->getPost('category'),
            'task' => $this->request->getPost('task'),
            'priority' => $this->request->getPost('priority'),
            'due_date' => $this->request->getPost('due_date'),
            'due_time' => $this->request->getPost('due_time'),
            'status' => $this->request->getPost('status'),
        ];

        $db->table('tasks')->where('id', $id)->update($data);

        return redirect()->to('/todo')->with('success', 'Task updated successfully.');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();
        $db->table('tasks')->where('id', $id)->delete();

        return redirect()->to('/todo')->with('success', 'Task deleted successfully.');
    }

    public function filter()
    {
        $userId = session()->get('user_id'); // Get the logged-in user's ID
        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'User not logged in'], 401);
        }

        $category = $this->request->getGet('category'); // Get the selected category from the query parameter
        $todoModel = new \App\Models\TodoModel();

        // Fetch tasks based on the selected category
        if ($category === 'all') {
            $tasks = $todoModel->where('user_id', $userId)->findAll(); // Fetch all tasks if "all" is selected
        } else {
            $tasks = $todoModel->where('user_id', $userId)->where('category', $category)->findAll(); // Fetch tasks for the specific category
        }

        // Debugging
        log_message('debug', 'Filtered tasks for category: ' . $category . ' -> ' . json_encode($tasks));

        return $this->response->setJSON($tasks); // Return tasks as JSON
    }

    public function markCompleted($id)
    {
        try {
            $todoModel = new \App\Models\TodoModel();
    
            // Find the task by ID
            $task = $todoModel->find($id);
    
            if (!$task) {
                // Debugging: Task not found
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Task not found'
                ], 404);
            }
    
            // Toggle the completed status
            $task['completed'] = !$task['completed'];
            if ($todoModel->save($task)) {
                // Debugging: Task saved successfully
                return $this->response->setJSON([
                    'success' => true,
                    'completed' => $task['completed']
                ]);
            }
    
            // Debugging: Failed to save task
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to save task'
            ]);
        } catch (\Exception $e) {
            // Debugging: Exception occurred
            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}