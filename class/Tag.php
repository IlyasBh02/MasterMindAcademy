<?php 
require_once __DIR__. "/../class/Database.php";
class tag{
    private $id;
    private $tags  ;

    public function __construct($tags)
    {
        $this->tags = $tags;
    }

    // this for admin to create multiple tags
    public function createTags(){
        $db = Database::getInstance()->getConnection();
        try{
            $db->beginTransaction();
            $tagArray = explode(',', $this->tags);
            foreach($tagArray as $tag){
                $sql = "insert into tags(nom) values(?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$tag]);
            }
            $db->commit();
            return true;
        }
        catch(PDOException $e){
            $db->rollBack();
            return false;
        }
    }
    // this to show the formateur all tags
    public static function showTags(){
        $db = Database::getInstance()->getConnection();
        $sql = "select * from tags";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function deleteTag($idTag){
        $db = Database::getInstance()->getConnection();

        $sql = "delete from tags where idTag = ?";
        $stmt = $db->prepare($sql);

        if($stmt->execute([$idTag])){
            return true;
        }
        else{
            return false;
        }
    }
    public function updateTag($idTag){
        $db = Database::getInstance()->getConnection();

        $sql = "update tags set nom = ? where idTag = ? ";

        $stmt = $db->prepare($sql);

        if($stmt->execute([$this->tags,$idTag])){
            return true;
        }
        else{
            return false;
        }
    }
    public static function selectById($id){
        $db = Database::getInstance()->getConnection();

        $sql = "select * from tags where idTag = ?";

        $stmt = $db->prepare($sql);

        if($stmt->execute([$id])){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else{
            return false;
        }
    }
}

// $arragyTags = [1,2,3];
// $obj = new tag($arragyTags);
// $obj->attachTagToCours(1);
// $obj = new tag($arragyTags);
// $obj->createTags();

