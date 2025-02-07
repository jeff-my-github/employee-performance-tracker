<?php
require_once '../config/config.php';

class Employee {

    public function add($name, $department, $position, $hire_date) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO employees (name, department, position, hire_date) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $department, $position, $hire_date]);
    }

    public function getAll() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM employees");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($employee_id, $name, $department, $position, $hire_date) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE employees SET name = ?, department = ?, position = ?, hire_date = ? WHERE employee_id = ?");
        return $stmt->execute([$name, $department, $position, $hire_date, $employee_id]);
    }

    public function delete($employee_id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM employees WHERE employee_id = ?");
        return $stmt->execute([$employee_id]);
    }
}
?>
