<?php
require_once '../models/Performance.php';

class PerformanceController {

    // Add a new performance rating
    public function addPerformanceRating($employee_id, $rating_month, $communication, $teamwork, $productivity) {
        $performance = new Performance();
        return $performance->add($employee_id, $rating_month, $communication, $teamwork, $productivity);
    }

    // Get performance ratings for an employee
    public function getPerformanceRatings($employee_id) {
        $performance = new Performance();
        return $performance->getByEmployee($employee_id);
    }

    // Get performance ratings for all employees
    public function getAllPerformanceRatings() {
        $performance = new Performance();
        return $performance->getAll();
    }

    // Update performance rating
    public function updatePerformanceRating($rating_id, $communication, $teamwork, $productivity) {
        $performance = new Performance();
        return $performance->update($rating_id, $communication, $teamwork, $productivity);
    }
}
?>
