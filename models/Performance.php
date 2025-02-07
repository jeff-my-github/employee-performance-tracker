<?php
require_once '../config/config.php';

class Performance {

    public function add($employee_id, $rating_month, $communication, $teamwork, $productivity) {
        global $pdo;
        $average_score = ($communication + $teamwork + $productivity) / 3;
        $stmt = $pdo->prepare("INSERT INTO performance_ratings (employee_id, rating_month, communication, teamwork, productivity, average_score) 
                               VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$employee_id, $rating_month, $communication, $teamwork, $productivity, $average_score]);
    }

    public function getByEmployee($employee_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM performance_ratings WHERE employee_id = ?");
        $stmt->execute([$employee_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM performance_ratings");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($rating_id, $communication, $teamwork, $productivity) {
        global $pdo;
        $average_score = ($communication + $teamwork + $productivity) / 3;
        $stmt = $pdo->prepare("UPDATE performance_ratings SET communication = ?, teamwork = ?, productivity = ?, average_score = ? WHERE rating_id = ?");
        return $stmt->execute([$communication, $teamwork, $productivity, $average_score, $rating_id]);
    }
}
?>
