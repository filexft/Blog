
<?php
class User{

    private $db = null;
    public function __construct($db){
        $this->db = $db;
    }

    public function login($email, $mdp, $pseudo){
        try{
            $querystmt = "SELECT * FROM user WHERE email = ? AND mdp = ?";
            $stmt = $this->db->prepare($querystmt);
            $stmt->execute([$email, $mdp]);

            $rows = $stmt->fetchAll();

            if($rows  && $rows[0]["pseudo"] != $pseudo){
                $query = "UPDATE  user SET pseudo  = ?  where  email = ? AND mdp = ?";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$pseudo,$email, $mdp]);

                $querystmt = "SELECT * FROM user WHERE email = ? AND mdp = ?";
                $stmt = $this->db->prepare($querystmt);
                $stmt->execute([$email, $mdp]);
                $rows = $stmt->fetchAll();
            }

            // echo json_encode(['logged' => true , 'data' => $rows[0]["pseudo"], 'new' => $rows ]);

            if(empty($rows)){
                $query = "INSERT INTO user (email, mdp) VALUES (?,?)";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$email, $mdp]);

                $querystmt = "SELECT * FROM user WHERE email = ? AND mdp = ?";
                $stmt = $this->db->prepare($querystmt);
                $stmt->execute([$email, $mdp]);
                $newrows = $stmt->fetchAll();

                    
                echo json_encode(['logged' => true , 'data' => $newrows, 'new' => true ]);
            }else{
                echo json_encode(['logged' => true , 'data' => $rows, 'new' => false ]);
            }
        }catch(PDOException $e){
            echo json_encode(['logged' => false , 'error' => $e.getMessage()]);
        }

    }

    
    public function signup(){
        
    }

    public function deleteArticle(){
        
    }

    
    public function test(){
        
        echo json_encode(['message' => "welcom to login class"]);
    }
}

?>