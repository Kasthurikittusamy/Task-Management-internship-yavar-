document.getElementById('task-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const taskInput = document.getElementById('new-task');
    const taskName = taskInput.value;

    fetch('task.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'task_name=' + encodeURIComponent(taskName)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const taskList = document.getElementById('task-list');
            const newTask = document.createElement('li');
            newTask.textContent = taskName;
            taskList.appendChild(newTask);
            taskInput.value = '';
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
