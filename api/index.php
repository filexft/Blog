<?php

session_start();

require_once 'model/db.php';
require_once 'Controls/article.php';
require_once 'Controls/user.php';
require_once 'Controls/admin.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// Extract the endpoint from the URI
$endpoint = $uri[4];

//Controls
$db = new dataBase();
$article = new Article($db->getDB());
$user = new User($db->getDB()); 
$admin = new Admin($db->getDB());

// Handle different endpoints
if ($endpoint === 'admin') {
    
    // Logic for the "/person" endpoint
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        
        $admin->listCateg();
        // echo json_encode(['message' => 'GET request for /person endpoint']);
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if(isset($_POST["category"])){
            $admin->addCateg($_POST["category"]);
        }else{
            echo json_encode(['message' => 'POST request for /person endpoint']);
        }

    } elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {

        $data = json_decode(file_get_contents("php://input"), true);
        // $up = $data['removeCategory'];
        
        if(isset($data['oldcategory']) && isset($data['newcategory'])){
                $admin->updateCateg($data['oldcategory'], $data['newcategory']);
        }else{
            echo json_encode(['message' => 'Delete request for /person endpoint']);
        }

    } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        

        //brought this from comment delete par tof user
        $data = json_decode(file_get_contents("php://input"), true);
        $removeCategory = $data['removeCategory'];
    
        if($removeCategory){
            $admin->deleteCateg($removeCategory);

        }else{
            echo json_encode(['message' => 'Delete request for /person endpoint']);
        }

    } else {
        http_response_code(405); // Method Not Allowed
        echo json_encode(['error' => 'Method not allowed']);
    }
} elseif ($endpoint === 'auth') {
    
    if($uri[5] == "login" && $_SERVER["REQUEST_METHOD"] == "POST"){
         //reponse to login 
        

        if(isset($_POST['email']) && isset($_POST['mdp'])){
            // $user->test();

            // echo json_encode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            $pseudo = $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo']: '';
            $email = $_POST['email'];
            $mdp =  $_POST['mdp'];
            $user->login($email, $mdp, $pseudo);
        }else{
            echo json_encode(['message' => "Error with the  logging", 'logged' => false]);
        }

    }elseif($uri[5] == "signup" && $_SERVER["REQUEST_METHOD"] == "POST"){
        //reponse to sign up 

        // user->signup;
        echo json_encode(['message' => "welcom to signup"]);
    }else {
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'Endpoint not found']);
    }
}elseif ($endpoint === 'articles') {

    
    if(!isset($uri[5])){

        //reponse to list of article

        $article->listArticles();
    }elseif(is_numeric($uri[5])){
        //reponse to category of articles 
        
        $article->listArticlesbyCateg($uri[5]);
    }elseif(!is_numeric($uri[5])){
        //reponse to Pseudo of articles 
        
        $article->listArticlesbyPseudo($uri[5]);
    }else {
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'Endpoint not found']);
    }
}elseif ($endpoint === 'article') {
    if(is_numeric($uri[5]) && $_SERVER['REQUEST_METHOD'] == "GET"){
        //reponse to signle articel (viewing an article)

        $article->singleArticle($uri[5]);
    }elseif($_SERVER['REQUEST_METHOD'] == "POST"){
        //reponse to Adding a Comment to  a  signle articel
        if(!empty($_POST['comment']) && $_POST['user_id'] && $_POST['article_id']){
            $user->AddComment($_POST['user_id'], $_POST['article_id'], $_POST['comment']);
            
        }else{
            echo json_encode(["message" => "enter a value" ]);
        }

    }elseif($_SERVER['REQUEST_METHOD'] == "DELETE"){
        $data = json_decode(file_get_contents("php://input"), true);
        if(isset($data['article_id'])){
            $article_id = $data['article_id'];
            
            $user->deleteArticle($article_id);
        }

    }else {
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'Endpoint not found']);
    }
}elseif ($endpoint === 'user') {
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //reponse to User Create a  signle articel
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['data']) && isset($_POST['user']) ){
            //&& isset($_POST['category']) && isset($_POST['titre'])    && isset($_POST['description'])
                    $data = $_POST['data'];
                    if(!empty($data)){
                        $titre = $data["titre"];
                        $description = $data["description"];
                        $category = array();
                        foreach($data as $item){
                            if(is_numeric($item)){
                                array_push($category, $item);
                            }
                        }

                        //TO ASK THE TEACHER
                        // $pseudo = isset($_SESSION['user'])? $_SESSION['user']->id : '0';
                        $user = $_POST['user']['id'];
                        
                        
                        // var_dump($titre, $description, $category, $user);
                        
                        // ($data, $titre, $description);
                        // echo json_encode('message' => $_SESSION);
                        $article->addArticle($titre, $description, $category, $user);
                    }
        }
    }elseif($_SERVER['REQUEST_METHOD'] == "DELETE"){
        $data = json_decode(file_get_contents("php://input"), true);
        $comment_id = $data['comment_id'];
        
        $user->deleteComment($comment_id);

    }else {
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'Endpoint not found']);
    }
}else {
    http_response_code(404); // Not Found
    echo json_encode(['error' => 'Endpoint not found']);
}
?>
