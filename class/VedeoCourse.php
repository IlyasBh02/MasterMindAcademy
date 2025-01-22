<?php
require_once __DIR__."/../session_start.php";
require_once __DIR__."/Database.php";
require_once __DIR__."/Course.php";


class VedeoCourse extends course{
    public function __construct($titre, $description, $content, $contentVedeo, $categorieId, $enseignantId,$price)
    {
        parent::__construct($titre, $description, $content, $contentVedeo, $categorieId, $enseignantId, $price, 'vedeo');
    }
    public function createCourse($tagsArray)
    {
        $db = Database::getInstance()->getConnection();

        try {
            $db->beginTransaction();
            $sql = "insert into cours(titre,description,contenu,vedeo,categorie_id,enseignant_id,price,type) values(?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$this->titre, $this->description, $this->content, $this->contentVedeo, $this->categorieId, $this->enseignantId,$this->price,$this->type]);

            $coursId = $db->lastInsertId();

            foreach ($tagsArray as $tag) {
                $sql2 = "insert into cours_tags(cours_id,tag_id) values(?,?)";
                $stmt = $db->prepare($sql2);
                $stmt->execute([$coursId, $tag]);
            }
            $db->commit();
            $_SESSION['MessageStatus'] =  'success';
            $_SESSION['Message'] = 'New video course added successfully!';
            header("Location: /edex-html/pages/enseignant/MyCourses.php");
        } catch (Exception $e) {
            $db->rollBack();
            $_SESSION['MessageStatus'] =  'error';
            $_SESSION['Message'] = 'Failed to upload new course !';
            header("Location: /edex-html/pages/enseignant/MyCourses.php");
        }
    }
}