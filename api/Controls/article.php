
<?php

class  Article{

    private $db = null;
    public  function __construct($db){
        $this->db = $db;
    }

    public function addArticle($titre, $description, $category, $pseudo){
        var_dump($titre, $description, $category, $pseudo);
        $querystmt = "INSERT INTO article (titre, description, categories, pseudo) values (?,?,?,?)";
        $stmt = $this->db->prepare($querystmt);
        $stmt->execute([$titre, $description, $category, $pseudo]);
        $rows = $stmt->fetchAll();
        print_r($rows);
        echo json_encode($rows);
    }

    public function listArticles(){
        $stmt = $this->db->query("SELECT * FROM article;");
        $rows = $stmt->fetchAll();
        echo json_encode($rows);

    }

    public function listArticlesbyCateg($categort){
        $querystmt =  "SELECT * FROM article WHERE categories = ?;";
        $stmt = $this->db->prepare($querystmt);
        $stmt->execute([$categort]);
        // $stmt->bindValue(':categ', $categort, PDO::PARAM_INT);
        
        $rows = $stmt->fetchAll();
        print_r($rows);
        echo json_encode($rows);
    }

    public function singleArticle($id){
        $querystmt =  "SELECT * FROM article WHERE id = ?;";
        $stmt = $this->db->prepare($querystmt);
        // $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute([$id]);
        // $stmt->bindValue(':categ', $categort, PDO::PARAM_INT);
        
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
    }


    
}

?>