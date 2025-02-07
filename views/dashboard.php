<?php include('header.php'); ?>

<h2>Employee Performance Dashboard</h2>

<!-- Add Employee Section -->
<div>
    <h3>Add New Employee</h3>
    <form id="employee-form">
        <input type="text" id="employee-name" name="name" placeholder="Employee Name" required />
        <input type="text" id="employee-department" name="department" placeholder="Department" required />
        <input type="text" id="employee-position" name="position" placeholder="Position" required />
        <input type="date" id="employee-hire-date" name="hire_date" required />
        <button type="submit">Add Employee</button>
    </form>
</div>

<!-- Display existing employees and performance ratings -->
<div id="employee-performance">
    <h3>Performance Ratings</h3>
    <a href="/views/performance.php">Manage Performance Ratings</a>
</div>

<!-- Link to the dashboard CSS -->
<link rel="stylesheet" href="../assets/css/dashboard.css">

<script>
// Handle form submission using AJAX
document.addEventListener('DOMContentLoaded', function () {
    const employeeForm = document.getElementById('employee-form');
    if (employeeForm) {
        employeeForm.addEventListener('submit', function (event) {
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

            fetch('/employee-performance-tracker/controllers/EmployeeController.php?action=add', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Employee added successfully');
                    // Optionally, you can reset the form or update the UI
                } else {
                    alert('Failed to add employee: ' + data.error);
                }
            })
            .catch(error => alert('Error: ' + error));
        });
    }
});
</script>

<?php include('footer.php'); ?>
