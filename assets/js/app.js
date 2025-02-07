// app.js - Client-side JavaScript for Employee Performance Tracker

document.addEventListener('DOMContentLoaded', function() {

    // Handle form submission for adding a new employee
    const employeeForm = document.getElementById('employee-form');
    if (employeeForm) {
        employeeForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const name = document.getElementById('employee-name').value;
            const department = document.getElementById('employee-department').value;
            const position = document.getElementById('employee-position').value;
            const hire_date = document.getElementById('employee-hire-date').value;

            const data = new FormData();
            data.append('name', name);
            data.append('department', department);
            data.append('position', position);
            data.append('hire_date', hire_date);

            // Updated fetch URL to match the correct path to the controller
            fetch('../controllers/EmployeeController.php?action=add', {
                method: 'POST',
                body: data
            })
            .then(response => {
                // Log the response body to check if it's valid JSON
                return response.text().then(text => {
                    console.log(text);  // This will show what the server is returning
                    return JSON.parse(text);  // Only attempt to parse if it's valid JSON
                });
            })
            .then(data => {
                if (data.success) {
                    alert('Employee added successfully');
                    // Optionally update the UI to show the new employee
                } else {
                    alert('Failed to add employee: ' + data.error);
                }
            })
            .catch(error => alert('Error: ' + error));            
        });
    }

    // Handle performance rating submission
    const performanceForm = document.getElementById('performance-form');
    if (performanceForm) {
        performanceForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const employee_id = document.getElementById('employee-id').value;
            const rating_month = document.getElementById('rating-month').value;
            const communication = document.getElementById('communication').value;
            const teamwork = document.getElementById('teamwork').value;
            const productivity = document.getElementById('productivity').value;

            const data = new FormData();
            data.append('employee_id', employee_id);
            data.append('rating_month', rating_month);
            data.append('communication', communication);
            data.append('teamwork', teamwork);
            data.append('productivity', productivity);

            // Updated fetch URL for adding performance rating
            fetch('../controllers/PerformanceController.php?action=add', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Performance rating added successfully');
                    // Optionally update the UI to show the new performance rating
                } else {
                    alert('Failed to add rating: ' + data.error);
                }
            })
            .catch(error => alert('Error: ' + error));
        });
    }

    // Handle employee deletion
    const deleteButtons = document.querySelectorAll('.delete-employee');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const employeeId = event.target.dataset.employeeId;
            if (confirm('Are you sure you want to delete this employee?')) {
                fetch('../controllers/EmployeeController.php?action=delete', {
                    method: 'POST',
                    body: JSON.stringify({ employee_id: employeeId }),
                    headers: { 'Content-Type': 'application/json' }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Employee deleted successfully');
                        // Optionally remove the employee from the UI list
                    } else {
                        alert('Failed to delete employee: ' + data.error);
                    }
                })
                .catch(error => alert('Error: ' + error));
            }
        });
    });

    // Handle performance rating update
    const updatePerformanceForm = document.getElementById('update-performance-form');
    if (updatePerformanceForm) {
        updatePerformanceForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const rating_id = document.getElementById('rating-id').value;
            const communication = document.getElementById('update-communication').value;
            const teamwork = document.getElementById('update-teamwork').value;
            const productivity = document.getElementById('update-productivity').value;

            const data = new FormData();
            data.append('rating_id', rating_id);
            data.append('communication', communication);
            data.append('teamwork', teamwork);
            data.append('productivity', productivity);

            // Updated fetch URL for performance rating update
            fetch('../controllers/PerformanceController.php?action=update', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Performance rating updated successfully');
                    // Optionally update the UI with the new ratings
                } else {
                    alert('Failed to update rating: ' + data.error);
                }
            })
            .catch(error => alert('Error: ' + error));
        });
    }

    // Handle login form submission
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            const data = new FormData();
            data.append('username', username);
            data.append('password', password);

            // Updated fetch URL for login
            fetch('../controllers/UserController.php?action=login', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'dashboard.php';  // Redirect to the dashboard after login
                } else {
                    alert('Invalid credentials: ' + data.error);
                }
            })
            .catch(error => alert('Error: ' + error));
        });
    }

});
