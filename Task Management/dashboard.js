
const taskForm = document.getElementById('task-form');
const taskInput = document.getElementById('new-task');
const taskList = document.getElementById('task-list');

// Function to create a new task item
function createTaskItem(taskName) {
    const li = document.createElement('li');
    li.innerHTML = `
        <span>${taskName}</span>
        <button class="edit-button">Edit</button>
        <button class="delete-button">Delete</button>
    `;
    
    //Edit button
    const editButton = li.querySelector('.edit-button');
    editButton.addEventListener('click', function() {
        const newTaskName = prompt('Edit Task:', taskName);
        if (newTaskName !== null && newTaskName.trim() !== '') {
            li.querySelector('span').textContent = newTaskName;
        }
    });
    
    // Delete button
    const deleteButton = li.querySelector('.delete-button');
    deleteButton.addEventListener('click', function() {
        li.remove();
    });
    
    return li;
}

// Function to add a task
function addTask(taskName) {
    const taskItem = createTaskItem(taskName);
    taskList.appendChild(taskItem);
}

//Submit button
taskForm.addEventListener('submit', function(event) {
    event.preventDefault();
    
    const taskName = taskInput.value.trim();
    
    if (taskName !== '') {
        addTask(taskName);
        taskInput.value = ''; 
    }
});
