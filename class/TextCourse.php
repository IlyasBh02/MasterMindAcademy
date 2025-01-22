<?php
require_once __DIR__. "/../class/Course.php";
class TextCourse extends course{
    public function __construct($titre, $description, $content, $contentVedeo, $categorieId, $enseignantId,$price)
    {
        parent::__construct($titre, $description, $content, $contentVedeo, $categorieId, $enseignantId,$price,'text');
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
            echo "new vedeo course added";
        } catch (Exception $e) {
            $db->rollBack();
            echo "Failed to create course and attach tags: " . $e->getMessage();
        }
    }
}