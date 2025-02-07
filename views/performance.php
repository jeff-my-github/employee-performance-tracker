<?php 
include('header.php');
include('../config/config.php'); // Include your PDO database connection

// Fetch employee names from the database using PDO
$query = "SELECT employee_id, name FROM employees"; // Adjust the table and column names if needed
$stmt = $pdo->prepare($query);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
?>

<link rel="stylesheet" href="../assets/css/performance.css">

<h2>Employee Performance Ratings</h2>

<!-- Performance Rating Section -->
<div>
    <h3>Submit Performance Ratings</h3>
    <div class="employee-list">
        <form id="performance-form" action="/controllers/PerformanceController.php?action=rate" method="POST">
            <div>
                <label for="employee-id">Select Employee</label>
                <select id="employee-id" name="employee_id" required>
                    <option value="">-- Select Employee --</option>
                    <?php 
                    // Loop through the fetched employees to create dropdown options
                    foreach ($employees as $employee) {
                        echo "<option value='{$employee['employee_id']}'>{$employee['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="rating-month">Rating Date</label>
                <!-- Change the input type to "date" to include the day -->
                <input type="date" id="rating-month" name="rating_month" required />
            </div>
            
            <div>
                <label for="communication">Communication (1-5)</label>
                <input type="number" id="communication" name="communication" min="1" max="5" required />
            </div>
            
            <div>
                <label for="teamwork">Teamwork (1-5)</label>
                <input type="number" id="teamwork" name="teamwork" min="1" max="5" required />
            </div>

            <div>
                <label for="productivity">Productivity (1-5)</label>
                <input type="number" id="productivity" name="productivity" min="1" max="5" required />
            </div>

            <button type="submit">Submit Rating</button>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>

<script>
document.getElementById('performance-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the normal form submission

    var formData = new FormData(this); // Create FormData object with the form data

    // Send the data using fetch to PerformanceController.php
    fetch('/employee-performance-tracker/controllers/PerformanceController.php?action=rate', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // Check if the response is valid
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Parse the JSON response
    })
    .then(data => {
        // Check if the success flag is true
        if (data.success) {
            alert('Performance rated successfully.');
        } else {
            alert('Error: ' + data.error); // Show the error message
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred.');
    });
});
</script>
