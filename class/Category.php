<?php 
require_once __DIR__."/../class/Database.php";
class Category{
    protected $id;
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
// WORK ON SHOW CATEGORIES
    public static function showcateroies(){
        $db = Database::getInstance()->getConnection();
        $sql = "select * from categories";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createCategory(){
        $db = Database::getInstance()->getConnection();
        
                $sql = "insert into categories(nom) values(?)";
                $stmt = $db->prepare($sql);
                if($stmt->execute([$this->name])){
                    return true;
                }
                else{
                    return false;
                }
            
    }
    public static function deleteCategory($categoryId){
        $db = Database::getInstance()->getConnection();
    
        $sql = "DELETE FROM categories WHERE idCategory = ?";
        $stmt = $db->prepare($sql);
    
        if($stmt->execute([$categoryId])){
            return true;  
        } else {
            return false; 
        }
    }
    public function updateCategory($categoryId) {
        $db = Database::getInstance()->getConnection();
    
        $sql = "UPDATE categories SET nom = ? WHERE idCategory = ?";
        $stmt = $db->prepare($sql);
    
        if ($stmt->execute([$this->name, $categoryId])) {
            return true;  
        } else {
            return false; 
        }
    }

    public static function selectById($id){
        $db = Database::getInstance()->getConnection();
    
        $sql = "select * from categories where idCategory = ? ";
        $stmt = $db->prepare($sql);
        
        if($stmt->execute([$id])){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
    }
    

}