<?php
require_once '../models/Employee.php';

class EmployeeController {

    // Add a new employee
    public function addEmployee($name, $department, $position, $hire_date) {
        $employee = new Employee();
        // Ensure the method adds the employee successfully
        return $employee->add($name, $department, $position, $hire_date);
    }

    // Handle requests based on the 'action' query parameter
    public function handleRequest() {
        // Only handle POST requests
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ensure we have the action parameter
            $action = isset($_GET['action']) ? $_GET['action'] : null;

            // Check if the action is 'add'
            if ($action === 'add') {
                // Ensure that all necessary POST data is available
                if (isset($_POST['name'], $_POST['department'], $_POST['position'], $_POST['hire_date'])) {
                    $name = $_POST['name'];
                    $department = $_POST['department'];
                    $position = $_POST['position'];
                    $hire_date = $_POST['hire_date'];

                    // Call the addEmployee function
                    $result = $this->addEmployee($name, $department, $position, $hire_date);

                    // Return success or failure as JSON
                    if ($result) {
                        echo json_encode(['success' => true]);
                    } else {
                        echo json_encode(['success' => false, 'error' => 'Failed to add employee']);
                    }
                } else {
                    // If some POST data is missing, return an error
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                // If the action is not recognized, send an error
                echo json_encode(['success' => false, 'error' => 'Invalid action']);
            }
        } else {
            // Handle non-POST requests
            echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        }

        // Ensure to stop the script execution after sending the response
        exit;
    }
}

// Make sure that the `handleRequest` function is called
$controller = new EmployeeController();
$controller->handleRequest();
?>
