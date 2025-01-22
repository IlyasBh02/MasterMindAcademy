<?php
// require __DIR__ . "/../interface/coursInterface.php";
require_once __DIR__ . "/../class/Database.php";
abstract class course
{
    protected $id;
    protected $titre;
    protected $description;
    protected $content;
    protected $contentVedeo;
    protected $categorieId;
    protected $enseignantId;
    protected $type;
    protected $price;

    public function __construct($titre, $description, $content, $contentVedeo, $categorieId, $enseignantId,$price,$type=null)
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->content = $content;
        $this->contentVedeo = $contentVedeo;
        $this->categorieId = $categorieId;
        $this->enseignantId = $enseignantId;
        $this->type = $type;
        $this->price = $price;
    }


    abstract public function createCourse($tagsArray);
    // work on createCourse and showCourse

    public static function showCourses($page = 1,$itemPerPage = 4)
    {
        $db = Database::getInstance()->getConnection();
        $offset = ($page - 1) * $itemPerPage;
        $sql = "select cours.*,
        categories.nom as CategoryName,
        user.name as Enseignant , 
        group_concat(tags.nom) as tags from cours 
        join categories on categories.idCategory = cours.categorie_id 
        join user on user.id = cours.enseignant_id 
        join cours_tags on cours.idCours = cours_tags.cours_id
        join tags on tags.idTag = cours_tags.tag_id
        group by cours.idCours
        limit :limit offset :offset
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":limit",$itemPerPage,PDO::PARAM_INT);
        $stmt->bindValue(":offset",$offset,PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }
    public static function CourseCount(){
        $db = Database::getInstance()->getConnection();
        $sql = "select count(*) as total from cours";
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else{
            return 0;
        }
    }
    // to show all the data to the admin
    public static function showAllCourses(){
        $db = Database::getInstance()->getConnection();
        $sql = "select cours.*,
        categories.nom as CategoryName,
        user.name as Enseignant , 
        group_concat(tags.nom) as tags from cours 
        join categories on categories.idCategory = cours.categorie_id 
        join user on user.id = cours.enseignant_id 
        join cours_tags on cours.idCours = cours_tags.cours_id
        join tags on tags.idTag = cours_tags.tag_id
        group by cours.idCours";
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);       
        }
    }
    public static function search($keyword)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "select cours.* , categories.nom as CategoryName from cours join categories on categories.idCategory = cours.categorie_id where categories.nom like ? or cours.titre like ?";
        $stmt = $db->prepare($sql);
        $keyword = "%" . $keyword . "%";
        $stmt->execute([$keyword, $keyword]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function showCourseById($id){
        $db =  Database::getInstance()->getConnection();
        $sql = "select cours.*,categories.nom as CategoryName,user.name as Enseignant , group_concat(tags.nom) as tags from cours 
        join categories on categories.idCategory = cours.categorie_id 
        join user on user.id = cours.enseignant_id 
        join cours_tags on cours.idCours = cours_tags.cours_id
        join tags on tags.idTag = cours_tags.tag_id
        group by cours.idCours
        having cours.idCours = ?
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function EnrollCourse($userId , $coursId){
        $db =  Database::getInstance()->getConnection();
        $sql = "insert into favoris(etudiant_id,cours_id) values(?,?)";
        $stmt = $db->prepare($sql);
        if($stmt->execute([$userId,$coursId])){
            return true;
        }
    }
    public static function isUserEnrolled($userId, $courseId) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM favoris WHERE etudiant_id = ? AND cours_id = ?");
        $stmt->execute([$userId, $courseId]);
        return $stmt->fetchColumn() > 0;
    }

    public function updateCourse($id){
        $db = Database::getInstance()->getConnection();
        $sql = "UPDATE cours SET titre = ?, description = ?, contenu = ?, vedeo = ?, categorie_id = ? WHERE idCours = ?";
        $stmt = $db->prepare($sql);
    
        if($stmt->execute([$this->titre, $this->description, $this->content, $this->contentVedeo, $this->categorieId, $id])) {
            return true;
        } else {
            return false;
        }
    }
    public static function deleteCourse($id){
        $db = Database::getInstance()->getConnection();

        $sql = "delete from cours where idCours = ?";
        $stmt = $db->prepare($sql);

        if($stmt->execute([$id])){
            echo "Cours deleted success";
        }
        else{
            echo "failed to delete";
        }
    }
}
