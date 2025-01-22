<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Only start the session if it's not already active
}
require_once __DIR__. "/./User.php";

class Enseignant extends User{
    public function __construct($nom,$email,$password)
    {
        parent::__construct($nom,$email,$password,"Enseignant");
    }
    public static function login($email,$password){
        $db = Database::getInstance()->getConnection();

        $sql = 'select * from user where email = ? and role = "Enseignant"';
        $stmt = $db->prepare($sql);

        if($stmt->execute([$email])){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user && password_verify($password,$user['password'])){
                $_SESSION['userId'] = $user['id'];
                $_SESSION['userName'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                if($user['status'] == 'active'){
                    $_SESSION['status'] == 'welcome';
                    header("Location: /edex-html/pages/enseignant/MyCourses.php");
                }
                else{
                    $_SESSION['status'] == 'wait';
                    header("Location: /edex-html/pages/enseignant/WaitingPage.php");
                }
                exit();
            }
            else{
                echo "error in the login";
            }
        }

    }
    public static function showMyCourses($id){
        $db = Database::getInstance()->getConnection();
        $sql = "select cours.*,categories.nom from youdemy.cours 
        join categories on categories.idCategory = cours.Categorie_id 
        where enseignant_id = ?";
        $stmt = $db->prepare($sql);
        if($stmt->execute([$id])){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }   
    public static function MesInscription($id){
        $db = Database::getInstance()->getConnection();

        $sql = "select 
        u1.id as StudentId,
        u1.name as StudentName,
        c.idCours as CoursId,
        c.titre as CourseTitle,
        u2.id as TeacherId,
        u2.name as TeacherName
        from favoris f
        join user u1 on u1.id = f.etudiant_id
        join cours c on c.idCours = f.cours_id
        join user u2 on u2.id = c.enseignant_id";
        $stmt = $db->prepare($sql);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public static function NbrEtudiantInscrit($id){
        $db = Database::getInstance()->getConnection();
        $sql = "select count(*) as total from favoris f 
        join user u1 on u1.id = f.etudiant_id 
        join cours c on f.cours_id = c.idCours 
        join user u2 on u2.id = c.enseignant_id 
        where u2.id = ?;";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);  
        return $stmt->fetchColumn();
    }
    public static function NbrCours($id){
        $db = Database::getInstance()->getConnection();
        $sql = "select count(*) as total from cours 
        where enseignant_id = ?;";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }
}

// $test = new Enseignant("abid","abid@gmail.com","abid123");
// $test->register();
// $test->login("abid@gmail.com","abid123");