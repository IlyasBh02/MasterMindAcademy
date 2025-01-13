<?php
// models/Course.php
class Course {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllCourses() {
        $query = "SELECT * FROM courses";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }

    public function getCoursesByTeacher($teacherId) {
        $query = "SELECT * FROM courses WHERE teacher_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$teacherId]);
        return $stmt->fetchAll();
    }

    public function createCourse($title, $description, $teacherId) {
        $query = "INSERT INTO courses (title, description, teacher_id) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$title, $description, $teacherId]);
    }
}
