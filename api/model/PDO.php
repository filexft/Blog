
<?php

    $db = null;

    try{
        
    }catch(Exception $e){
        die("error de db ". $e->getMessage());
    }

    function getAllArticle(){
        $stmt = $db->query("SELECT * FROM article;");
        $rows = $stmt->fetchAll();
        return $rows;
    }


?>