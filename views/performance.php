<?php include('header.php'); ?>
<link rel="stylesheet" href="../assets/css/performance.css">

<h2>Employee Performance Ratings</h2>

<!-- Performance Rating Section -->
<div>
    <h3>Submit Performance Ratings</h3>
    <div class="employee-list">
        <!-- Example employee form, dynamically populate employee data from the database -->
        <div class="employee" data-employee-id="1">
            <h4>Employee Name: John Doe</h4>
            <form id="performance-form" action="/controllers/PerformanceController.php?action=rate" method="POST">
                <input type="hidden" id="employee-id" name="employee_id" value="1" />
                <input type="month" id="rating-month" name="rating_month" required />
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
        <!-- Add more employee performance forms here dynamically -->
    </div>
</div>

<?php include('footer.php'); ?>
