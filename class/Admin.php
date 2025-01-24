<?php 
require_once __DIR__."/../session_start.php";
require_once __DIR__. "/User.php";

class Admin extends User{
    public function __construct($nom,$email,$password)
    {
        parent::__construct($nom,$email,$password,"Admin");
    }

    public static function login($email,$password){
        $db = Database::getInstance()->getConnection();
        $sql = "select * from user where email = ? and role = 'Admin'";
        $stmt = $db->prepare($sql);

        if($stmt->execute([$email])){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user && password_verify($password,$user['password'])){
                $_SESSION['userId'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                return true;
            }
            else{
                return false;
            }
        }
    }
    public static function showAllEnseignant(){
        $db = Database::getInstance()->getConnection();

        $sql = "select * from user where role = 'Enseignant'";

        $stmt = $db->prepare($sql);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public static function activeEnseignant($userID){
        $db = Database::getInstance()->getConnection();

        // $CheckStatusQuery = "select status from user where id = ?";
        // $stmtCheckStatus = $db->prepare($CheckStatusQuery);
        // $stmtCheckStatus->execute([$userID]);
        // $user = $stmtCheckStatus->fetch(PDO::FETCH_ASSOC);
        
        // if($user && $user['status'] == 'active'){
        //     $_SESSION['status'] = 'welcome';
        //     return true;
        // }

        $UpdateStatusQuery = "update user set status = 'active' where id = ?";
        $stmt = $db->prepare($UpdateStatusQuery);

        if($stmt->execute([$userID])){
            $_SESSION['status'] = 'welcome';
            return true;
        }
        else{
            $_SESSION['status'] = 'wait';
            return false;
        }
    }

    public static function desactivEnseignant($userId){
        $db = Database::getInstance()->getConnection();

        $sql = "update user set status = 'suspended' where id = ?";
        $stmt = $db->prepare($sql);

        if($stmt->execute([$userId])){
            $_SESSION['status'] = 'not allowed';
            return true;
        }
        else{
            $_SESSION['status'] = 'wait';
            return false;
        }
    }
    public static function getallUser(){
        $db = Database::getInstance()->getConnection();

        $sql = "select * from user where role = 'Etudiant'";

        $stmt = $db->prepare($sql);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public static function desactiveUser($userId){
        $db = Database::getInstance()->getConnection();

        $sql = "update user set status = 'suspended' where id = ?";

        $stmt = $db->prepare($sql);
        
        if($stmt->execute([$userId])){
            return true;
        }
        else{
            return false;
        }
    }
    public static function activeUser($userId){
        $db = Database::getInstance()->getConnection();
        $sql = "update user set status = 'active' where id = ?";

        $stmt = $db->prepare($sql);

        if($stmt->execute([$userId])){
            return true;
        }
        else{
            return false;
        }
    }
    public static function CountCoursByCategory(){
        $db = Database::getInstance()->getConnection();

        $sql = "SELECT categories.nom, COUNT(cours.idCours) AS coursNbr 
                FROM categories
                LEFT JOIN cours ON categories.idCategory = cours.Categorie_id
                GROUP BY categories.nom";
        
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public static function BestCours(){
        $db = Database::getInstance()->getConnection();
        $sql = "select cours.titre ,count(user.id) as etudNbr from cours
        join favoris on cours.idCours= favoris.cours_id
        join user on user.id = favoris.etudiant_id
        group by cours.idCours
        order by etudNbr Desc
        limit 1;";
        $stmt = $db->prepare($sql);

        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
    public static function topThreeTeachers(){
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT u1.name, COUNT(favoris.cours_id) AS enrolle_count
        FROM user u1
        JOIN cours ON cours.enseignant_id = u1.id
        JOIN favoris ON favoris.cours_id = cours.idCours
        GROUP BY u1.id
        ORDER BY enrolle_count DESC
        LIMIT 3;";
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public static function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /mastermindacademy/pages/admin/login.php");
    }
}

// $test = new Admin("Azzedine","azzedine@gmail.com","azzedine2004");
// $test->register();
// $test->login("azzedine@gmail.com","azzedine2004");