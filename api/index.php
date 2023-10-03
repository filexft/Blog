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
$endpoint = $uri[5];

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
        if(isset($_GET["newcategory"]) && isset($_GET["oldcategory"])){
            $oldcategory = $_GET["oldcategory"];
            $newcategory = $_GET["newcategory"];

            $admin->updateCateg($oldcategory, $newcategory);

            // echo json_encode(['message' => 'Delete request for /person endpoint', 'categ' => $_GET["category"]);
        }else{
            echo json_encode(['message' => 'Delete request for /person endpoint']);
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        
        if(isset($_GET["removeCategory"])){
            $category = $_GET["removeCategory"];
            $admin->deleteCateg($category);

            // echo json_encode(['message' => 'Delete request for /person endpoint', 'categ' => $_GET["category"]);
        }else{
            echo json_encode(['message' => 'Delete request for /person endpoint']);
        }

    } else {
        http_response_code(405); // Method Not Allowed
        echo json_encode(['error' => 'Method not allowed']);
    }
} elseif ($endpoint === 'auth') {
    
    if($uri[6] == "login" && $_SERVER["REQUEST_METHOD"] == "POST"){
         //reponse to login 
        
        
        // echo json_encode(['message' => "Error with the ", 'post array' => $_POST]);

        if(isset($_POST['email']) && isset($_POST['mdp'])){
            // $user->test();

            $email = $_POST['email'];
            $mdp =  $_POST['mdp'];
            $user->login($email, $mdp);
        }else{
            echo json_encode(['message' => "Error with the  logging", 'logged' => false]);
        }

    }elseif($uri[6] == "signup" && $_SERVER["REQUEST_METHOD"] == "POST"){
        //reponse to sign up 

        // user->signup;
        echo json_encode(['message' => "welcom to signup"]);
    }else {
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'Endpoint not found']);
    }
}elseif ($endpoint === 'articles') {

    
   
    if(!isset($uri[6])){
        //reponse to list of article
        
        $article->listArticles();
    }elseif(is_numeric($uri[6])){
        //reponse to category of articles 

        $article->listArticlesbyCateg($uri[6]);
    }else {
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'Endpoint not found']);
    }
}elseif ($endpoint === 'article') {
    if(is_numeric($uri[6]) && $_SERVER['REQUEST_METHOD'] == "GET"){
        //reponse to signle articel (viewing an article)

        $article->singleArticle($uri[6]);
    }elseif(is_numeric($uri[6]) && $_SERVER['REQUEST_METHOD'] == "DELETE"){
        //reponse to DEleting a  signle articel
        
        // user->deleteArticle;
        echo json_encode(['message' => "user deleting to single article"]);
    }else {
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'Endpoint not found']);
    }
}elseif ($endpoint === 'user') {
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //reponse to User Create a  signle articel
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['titre'])  && isset($_POST['category'])  && isset($_POST['description'])){
                    $titre = $_POST["titre"];
                    $category = $_POST["category"];
                    $description = $_POST["description"];

                    //TO ASK THE TEACHER
                    $pseudo = isset($_SESSION['user'])? $_SESSION['user']->id : 'unknown';
                    
                    // echo json_encode('message' => $_SESSION);
                    $article->addArticle($titre, $description, $category, $pseudo);
        }
    }else {
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'Endpoint not found']);
    }
}else {
    http_response_code(404); // Not Found
    echo json_encode(['error' => 'Endpoint not found']);
}
?>
