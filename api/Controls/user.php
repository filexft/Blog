
<?php
class User{

    private $db = null;
    public function __construct($db){
        $this->db = $db;
    }

    public function login($email, $mdp){
        $querystmt = "SELECT * FROM user WHERE email = ? AND mdp = ?";
        $stmt = $this->db->prepare($querystmt);
        $stmt->execute([$email, $mdp]);

        $rows = $stmt->fetchAll();

        if(empty($rows)){
            $query = "INSERT INTO user (email, mdp) VALUES (?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$email, $mdp]);

            $rows = $stmt->fetchAll();
                
            print_r($rows);
            echo json_encode(['logged' => true , 'data' => $rows, 'new' => true ]);
        }
        echo json_encode(['logged' => true , 'data' => $rows, 'new' => false ]);

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