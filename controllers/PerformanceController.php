<?php 
include('../config/config.php'); // Include your PDO database connection

class PerformanceController {

    private $pdo;

    // Constructor to initialize the PDO connection
    public function __construct($pdo) {
        $this->pdo = $pdo;  // Set the PDO connection to the class property
    }

    // Method to calculate the average score
    public function calculateAverageScore($communication, $teamwork, $productivity) {
        // Calculate the average of the three ratings
        return ($communication + $teamwork + $productivity) / 3;
    }

    // Method to handle the performance rating insertion
    public function ratePerformance($employee_id, $rating_month, $communication, $teamwork, $productivity) {
        // Calculate the average score
        $average_score = $this->calculateAverageScore($communication, $teamwork, $productivity);

        // Insert the performance ratings into the database
        $query = "INSERT INTO performance_ratings (employee_id, rating_month, communication, teamwork, productivity, average_score)
                  VALUES (:employee_id, :rating_month, :communication, :teamwork, :productivity, :average_score)";
        $stmt = $this->pdo->prepare($query);  // Use $this->pdo to access the connection

        // Bind the parameters
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->bindParam(':rating_month', $rating_month);
        $stmt->bindParam(':communication', $communication);
        $stmt->bindParam(':teamwork', $teamwork);
        $stmt->bindParam(':productivity', $productivity);
        $stmt->bindParam(':average_score', $average_score);

        // Execute the statement
        return $stmt->execute();
    }

    // Handle the form submission
    public function handleRequest() {
        // Check if the request method is POST and the action is 'rate'
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'rate') {
            // Get POST data
            $employee_id = $_POST['employee_id'];
            $rating_month = $_POST['rating_month'];
            $communication = $_POST['communication'];
            $teamwork = $_POST['teamwork'];
            $productivity = $_POST['productivity'];

            // Set the JSON response header
            header('Content-Type: application/json');

            try {
                // Call the ratePerformance method to store the data
                $result = $this->ratePerformance($employee_id, $rating_month, $communication, $teamwork, $productivity);

                // Check if the insert was successful
                if ($result) {
                    // Send success response
                    echo json_encode(['success' => true, 'message' => 'Performance rated successfully.']);
                } else {
                    // Send failure response
                    echo json_encode(['success' => false, 'error' => 'Failed to rate performance.']);
                }
            } catch (Exception $e) {
                // Handle any exceptions and send the error as JSON
                echo json_encode(['success' => false, 'error' => 'An error occurred: ' . $e->getMessage()]);
            }
        }
    }
}

// Create an instance of the controller and pass the PDO connection
$controller = new PerformanceController($pdo);
$controller->handleRequest();
?>
