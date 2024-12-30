<style>
    /* CSS */
    @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap');

    .lexend-<uniquifier> {
    font-family: "Lexend", serif;
    font-optical-sizing: auto;
    font-weight: <weight>;
    font-style: normal;
    }

    body {
        font-family: "Lexend", sans-serif;
        font-style: bold;
        font-weight: 100;
        margin: 0;
        padding: 0;
        background: white;
    }

    .header {
        margin-left: 35px;
        margin-top: 90px;
    }

    .header h1 {
        font-size: 2.5rem;
        color: black;
    }

    .todo-container {
        margin: 0px auto;
        width: 95%;
    }

    .todo-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 1rem;
    }

    .todo-table th, .todo-table td {
        text-align: center;
        padding: 10px;
        border: 1px solid #ccc;
    }

    .todo-table th {
        background-color: #f4f4f4;
        color: #333;
    }

    .todo-table td {
        background-color: #fff;
    }

    .todo-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .add-task-form {
        margin-top: 20px;
        
        margin-bottom: 20px;
        font-family: "Lexend", serif;
    }

    .add-task-form input, .add-task-form select {
        margin: 5px 0;
        padding: 8px;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 20px;
        font-family: "Lexend", serif;
        font-size: 1rem;
    }

    .add-task-form button {
        padding: 10px 15px;
        width: 100%;
        background-color: black;
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        transition: background-color 0.3s;
        font-family: "Lexend", serif;
        margin-top: 10px;
        font-size: 15px;
    }

    .add-task-form button:hover {
        background-color: #ef436b;
    }

    .btn-delete {
        padding: 5px 10px;
        background-color: #dc3545;
        color: white;
        text-decoration: none;
        border-radius: 20px;
        font-weight: 300px;
        cursor: pointer;
    }

    /* Overlay Styles */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .overlay.active {
        display: flex;
    }

    /* Form Box Styles */
    .overlay-content {
        background-color: white;
        padding: 20px;
        width: 800px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .overlay-content h2 {
        text-align: center;
    }

    /* Close Button Styles */
    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        color: black;
        font-weight: bold;
        padding: 10px 10px;
        border-radius: 50px;
    }

    .close-btn:hover {
        color: #ef436b;
    }

    .add-task-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: black;
        color: white;
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        font-size: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        z-index: 1000; /* Ensure the button appears on top */
    }

    .add-task-btn:hover {
        background-color: #ef436b;
    }

    .category-filter {
        font-family: "Lexend", serif;
        font-weight: 300;
    }

    .category-select {
        font-family: "Lexend", serif;
        font-weight: 300;
        border-radius: 20px;
    }
</style>

<body>

<div class="header">
    <h1> Welcome Back, <?= htmlspecialchars($full_name ?? 'User') ?>. </h1>
</div>

<div class="todo-container">
    <h2>Time to Do Your To-Do List and Get It Done!</h2>

    <!-- Add Task Button -->
    <button class="add-task-btn" id="addTaskBtn">+</button>

    <!-- Filter -->
    <div class="filter">
        <label for="category-filter" class="category-filter">Filter by Category:</label>
        <select id="category-filter" class="category-select">
            <option value="all">All</option>
            <option value="Academic">Academic</option>
            <option value="Competition">Competition</option>
            <option value="Personal Care">Personal Care</option>
            <option value="Others">Others</option>
        </select>
    </div>

    <!-- Add Task Form -->
    <div class="overlay" id="overlay">
        <div class="overlay-content">
            <button class="close-btn" id="closeOverlay">X</button>
            <h2>Add New Task</h2>
            <form class="add-task-form" action="/todo/add-task" method="POST">
                <select name="category" required>
                    <option value="" disabled selected>Category</option>
                    <option value="Academic">Academic</option>
                    <option value="Competition">Competition</option>
                    <option value="Personal Care">Personal Care</option>
                    <option value="Others">Others</option>
                </select>

                <input type="text" name="task" placeholder="Task" required>

                <select name="priority" required>
                    <option value="" disabled selected>Priority</option>
                    <option value="Urgent">Urgent</option>
                    <option value="Do Now">Do Now</option>
                    <option value="Next Up">Next Up</option>
                    <option value="Scheduled">Scheduled</option>
                    <option value="Whenever Possible">Whenever Possible</option>
                </select>

                <input type="date" name="due_date" placeholder="Due Date" required>
                <input type="time" name="due_time" placeholder="Due Time" required>

                <select name="status" required>
                    <option value="" disabled selected>Status</option>
                    <option value="Not Started">Not Started</option>
                    <option value="In Progress">In Progress</option>
                </select>

                <input type="text" name="additional_notes" placeholder="Additional Notes">

                <button type="submit">Add Task</button>
            </form>
        </div>
    </div>

    <!-- To-Do List Table -->
    <table class="todo-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Category</th>
                <th>Task</th>
                <th>Priority</th>
                <th>Due Date</th>
                <th>Due Time</th>
                <th>Status</th>
                <th>Additional Notes</th>
                <th>Completed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="todo-body">
            <?php if (!empty($tasks)): ?>
                <?php foreach ($tasks as $index => $task): ?>
                    <tr style="background-color: <?= $task['completed'] ? 'lightgreen' : '' ?>">
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($task['category']) ?></td>
                        <td><?= htmlspecialchars($task['task']) ?></td>
                        <td><?= htmlspecialchars($task['priority']) ?></td>
                        <td><?= htmlspecialchars($task['due_date']) ?></td>
                        <td><?= htmlspecialchars($task['due_time']) ?></td>
                        <td><?= htmlspecialchars($task['status']) ?></td>
                        <td><?= htmlspecialchars($task['additional_notes']) ?></td>
                        <td>
                            <input type="checkbox" class="mark-completed" data-id="<?= $task['id'] ?>" <?= $task['completed'] ? 'checked' : '' ?>>
                        </td>
                        <td>
                            <a href="/todo/delete/<?= $task['id'] ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" style="text-align: center;">You don't have any tasks! 🎉</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>

<script>
    // Add task
    document.getElementById('addTaskBtn').addEventListener('click', function () {
        console.log('Add Task button clicked');
        document.getElementById('overlay').classList.add('active');
    });

    // Close overlay
    document.getElementById('closeOverlay').addEventListener('click', function () {
        document.getElementById('overlay').classList.remove('active');
    });

    // Close
    document.getElementById('overlay').addEventListener('click', function (event) {
        if (event.target === this) {
            this.classList.remove('active');
        }
    });

    // Add task
    document.querySelector('.add-task-form').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        const form = event.target;

        // Prepare task data from the form inputs
        const taskData = {
            category: form.category.value,
            task: form.task.value,
            priority: form.priority.value,
            due_date: form.due_date.value,
            due_time: form.due_time.value,
            status: form.status.value,
            additional_notes: form.additional_notes.value,
        };

        console.log('Task Data:', taskData); // Debugging: Check if taskData is correct

        // Make an AJAX request to submit the task
        fetch('/todo/add-task', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            credentials: 'include', // Include cookies in the request
            body: JSON.stringify(taskData), // Send the form data as JSON
        })
            .then(response => response.json()) // Parse the JSON response
            .then(data => {
                console.log('Raw Response:', data);

                if (data.success) {
                    alert('Task added successfully!');
                    document.getElementById('overlay').classList.remove('active'); // Close the overlay
                    location.reload(); // Reload the page to reflect the new task
                } else {
                    alert(`Failed to add task: ${data.message}`);
                }
            })
            .catch(error => {
                console.error('Error adding task:', error);
                alert('An error occurred while adding the task. Please try again.');
            });
    });

    // Filter
    document.getElementById('category-filter').addEventListener('change', function () {
        const selectedCategory = this.value; // Get the selected category
        const todoBody = document.getElementById('todo-body'); // Get the table body

        // Clear the table while fetching
        todoBody.innerHTML = '<tr><td colspan="8" style="text-align: center;">Loading...</td></tr>';

        // Make an AJAX request to fetch filtered tasks
        fetch(`/todo/filter?category=${encodeURIComponent(selectedCategory)}`)
            .then(response => response.json()) // Parse the JSON response
            .then(tasks => {
                todoBody.innerHTML = ''; // Clear the table body
                if (tasks.length > 0) {
                    tasks.forEach((task, index) => {
                        todoBody.innerHTML += `
                            <tr style="background-color: ${task.completed ? 'lightgreen' : ''}">
                                <td>${index + 1}</td>
                                <td>${task.category}</td>
                                <td>${task.task}</td>
                                <td>${task.priority}</td>
                                <td>${task.due_date}</td>
                                <td>${task.due_time}</td>
                                <td>${task.status}</td>
                                <td>${task.additional_notes}</td>
                                <td>
                                    <input type="checkbox" class="mark-completed" data-id="${task.id}" ${task.completed === 1 ? 'checked' : ''}>
                                </td>
                                <td>
                                    <a href="/todo/delete/${task.id}" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    todoBody.innerHTML = '<tr><td colspan="10" style="text-align: center;">You have no tasks! 🎉</td></tr>';
                }
            })
            .catch(error => {
                console.error('Error fetching tasks:', error);
                todoBody.innerHTML = '<tr><td colspan="10" style="text-align: center;">Error loading tasks</td></tr>';
            });
    });

    // Checkbox toggle
    document.getElementById('todo-body').addEventListener('change', function (event) {
        if (event.target.classList.contains('mark-completed')) {
            const checkbox = event.target;
            const taskId = checkbox.dataset.id;

            console.log(`Task ID: ${taskId} checkbox toggled`);

            // Send AJAX request to update task completion status
            fetch(`/todo/mark-completed/${taskId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
                .then(response => {
                    console.log('Response:', response);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data:', data); 

                    if (data.success) {
                        const row = checkbox.closest('tr');
                        console.log('Row:', row);

                        if (data.completed) {
                            row.querySelectorAll('td').forEach(td => {
                                td.style.backgroundColor = '#aaf0c9';
                            });
                        } 
                        else {
                            row.querySelectorAll('td').forEach(td => {
                                td.style.backgroundColor = '';
                            });
                        }

                        console.log('Row classes after toggle:', row.classList);
                    } 
                    else {
                        alert('Failed to update task status');
                    }
                })
                .catch(error => {
                    console.error('Error updating task status:', error);
                    alert('Error updating task status. Please try again.');
                });
        }
    });
</script>

