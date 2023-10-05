
<?php

class  Article{

    private $db = null;
    public  function __construct($db){
        $this->db = $db;
    }

    public function addArticle($titre, $description, $category, $pseudo){
        try{
            // var_dump($titre, $description, $category, $pseudo);
            $querystmt = "INSERT INTO article (titre, description, pseudo) values (?,?,?)";
            $stmt = $this->db->prepare($querystmt);
            $stmt->execute([$titre, $description, $pseudo]);
            // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $articleID = $this->db->lastInsertId();

        
            foreach($category as $categ){
                $querystmt = "INSERT INTO articles_category (article_id, category_id) values (?,?)";
                $stmt = $this->db->prepare($querystmt);
                $stmt->execute([$articleID, $categ]);
            }
            echo json_encode(['message' => "article successfully Add!"]);
        }
        catch(PDOException $e){
            echo json_encode(['message' => "article successfully Add!", 'error' => $e->getMessage()]);
        }
    }

    public function listArticles(){
        $query = "  SELECT
                        a.id AS article_id,
                        a.titre AS article_title,
                        a.description AS article_description,
                        a.pseudo AS article_author_pseudo,
                        u.pseudo AS article_author,
                        GROUP_CONCAT(c.nom) AS article_categories
                    FROM
                        article AS a
                    LEFT JOIN
                        articles_category AS ac ON a.id = ac.article_id
                    LEFT JOIN
                        user AS u ON a.pseudo = u.id
                    LEFT JOIN
                        categorie AS c ON ac.category_id = c.id
                    GROUP BY
                        a.id;";


        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        echo json_encode($rows);

    }

    public function listArticlesbyCateg($category){
        $query = "SELECT
                        a.id AS article_id,
                        a.titre AS article_title,
                        a.description AS article_description,
                        a.pseudo AS article_author_pseudo,
                        u.pseudo AS article_author,
                        GROUP_CONCAT(c.nom) AS article_categories
                    FROM
                        article AS a
                    LEFT JOIN
                        articles_category AS ac ON a.id = ac.article_id
                    LEFT JOIN
                        user AS u ON a.pseudo = u.id
                    LEFT JOIN
                        categorie AS c ON ac.category_id = c.id
                    WHERE  c.nom  = ?

                    GROUP BY a.id;
                        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$category]);

        $rows = $stmt->fetchAll();

        echo json_encode($rows);
    }

    public function listArticlesbyPseudo($pseudo){
        $query = "SELECT
                        a.id AS article_id,
                        a.titre AS article_title,
                        a.description AS article_description,
                        a.pseudo AS article_author_pseudo,
                        u.pseudo AS article_author,
                        GROUP_CONCAT(c.nom) AS article_categories
                    FROM
                        article AS a
                    LEFT JOIN
                        articles_category AS ac ON a.id = ac.article_id
                    LEFT JOIN
                        user AS u ON a.pseudo = u.id
                    LEFT JOIN
                        categorie AS c ON ac.category_id = c.id
                    WHERE u.pseudo = ?

                    GROUP BY a.id;
                        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$pseudo]);

        $rows = $stmt->fetchAll();

        if(empty($rows)){
            $this->listArticlesbyCateg($pseudo);
        }else{
            echo json_encode($rows);
        }

    } 

    public function singleArticle($id){


        $query = "SELECT
                        a.id AS article_id,
                        a.titre AS article_title,
                        a.description AS article_description,
                        a.pseudo AS article_author_pseudo,
                        u.pseudo AS article_author,
                        GROUP_CONCAT(c.nom) AS article_categories
                    FROM
                        article AS a
                    LEFT JOIN
                        articles_category AS ac ON a.id = ac.article_id
                    LEFT JOIN
                        user AS u ON a.pseudo = u.id
                    LEFT JOIN
                        categorie AS c ON ac.category_id = c.id
                    WHERE a.id = ?

                    GROUP BY a.id;
                        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);

        $rows = $stmt->fetchAll();


        
        echo json_encode($rows);

        // $querystmt =  "SELECT * FROM article WHERE id = ?;";
        // $stmt = $this->db->prepare($querystmt);
        // // $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // $stmt->execute([$id]);
        // // $stmt->bindValue(':categ', $categort, PDO::PARAM_INT);
        
        // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo json_encode($rows);
    }


    
}

?>