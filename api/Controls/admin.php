
<?php
class Admin{
    
    private $db  = null;
    public  function __construct($db){
        $this->db = $db;
    }

    public function listCateg(){
        $stmt = $this->db->query("SELECT * FROM categorie;");
        $rows = $stmt->fetchAll();

        echo json_encode($rows);
    }


    public function addCateg($category){
        $query = "INSERT INTO categorie (nom) VALUES (?)";
        $stmt = $this->db->prepare($query);
    
        try{
            $stmt->execute([$category]);
            $rows = $stmt->fetchAll();
            echo json_encode(["message" => "data hava succss added", 'data' => $rows]);
        }catch(PDOException $e){
            echo json_encode(["message" => "error have occured", 'error' => $e->getMessage()]);
        }


    }

    public function updateCateg($oldCateg, $newCateg){
        $query = "UPDATE categorie SET nom = :newcateg WHERE nom = :oldcateg";
        $stmt = $this->db->prepare($query);

        try{
            $stmt->bindParam(':oldcateg', $oldCateg, PDO::PARAM_STR);
            $stmt->bindParam(':newcateg', $newCateg, PDO::PARAM_STR);
            $stmt->execute();

            echo json_encode(["message" => "data hava succss updating category", 'data' => 'success']);
        }catch(PDOException $e){
            echo json_encode(["message" => "error have occured", 'error' => $e->getMessage()]);
        }

    }

    public function deleteCateg($category){
        $query = "DELETE FROM categorie WHERE nom = :categ";
        $stmt = $this->db->prepare($query);
        
        try{
            $stmt->bindParam(':categ', $category, PDO::PARAM_STR);
            $stmt->execute();
            
            echo json_encode(["message" => "data hava succss deleting category", 'data' => 'success']);
        }catch(PDOException $e){
            echo json_encode(["message" => "error have occured", 'error' => $e->getMessage()]);
        }

    }
}

?>