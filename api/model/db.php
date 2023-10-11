
<?php
class dataBase{
    
    private $db = null;

    public function __construct(){
        try{
            $this->db = new PDO('mysql:host=localhost;dbname=blog;', 'root', '');
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }

    public function getDB(){
        return $this->db;
    }
}

?>