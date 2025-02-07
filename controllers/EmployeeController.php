<?php
require_once '../models/Employee.php';

class EmployeeController {

    // Add a new employee
    public function addEmployee($name, $department, $position, $hire_date) {
        $employee = new Employee();
        return $employee->add($name, $department, $position, $hire_date);
    }

    // Get all employees
    public function getEmployees() {
        $employee = new Employee();
        return $employee->getAll();
    }

    // Edit employee
    public function editEmployee($employee_id, $name, $department, $position, $hire_date) {
        $employee = new Employee();
        return $employee->update($employee_id, $name, $department, $position, $hire_date);
    }

    // Delete employee
    public function deleteEmployee($employee_id) {
        $employee = new Employee();
        return $employee->delete($employee_id);
    }
}
?>
