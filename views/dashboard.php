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
    const submitButton = employeeForm.querySelector('button');

    // Flag to ensure that the form can only be submitted once
    let isSubmitting = false;
    
    if (employeeForm) {
        employeeForm.addEventListener('submit', function (event) {
            event.preventDefault();  // Prevent default form submission
            
            // Check if the form is already being submitted
            if (isSubmitting) {
                return;  // Prevent submission if it's already in progress
            }
            
            // Mark the form as being submitted
            isSubmitting = true;
            
            // Disable the submit button to prevent multiple submissions
            submitButton.disabled = true;

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
                    employeeForm.reset();  // Reset the form after successful addition
                } else {
                    alert('Failed to add employee: ' + data.error);
                }
            })
            .catch(error => alert('Error: ' + error))
            .finally(() => {
                // Re-enable the submit button after the submission is complete
                submitButton.disabled = false;
                // Reset the flag so the form can be submitted again
                isSubmitting = false;
            });
        });
    }
});
</script>

<?php include('footer.php'); ?>
