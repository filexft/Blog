<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// Extract the endpoint from the URI
$endpoint = $uri[5];


// Handle different endpoints
if ($endpoint === 'admin') {
    
    // Logic for the "/person" endpoint
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        
        //admin->listCateg
        echo json_encode(['message' => 'GET request for /person endpoint']);
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        
        //admin->addCateg
        echo json_encode(['message' => 'POST request for /person endpoint']);
    } elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
        
        
        //admin->updateCateg
        echo json_encode(['message' => 'PUT request for /person endpoint']);
    } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        
        
        //admin->deleteCateg
        echo json_encode(['message' => 'DELETE request for /person endpoint']);
    } else {
        http_response_code(405); // Method Not Allowed
        echo json_encode(['error' => 'Method not allowed']);
    }
} elseif ($endpoint === 'auth') {
    // Logic for another endpoint
    // Implement handling for different HTTP methods as needed
    if($uri[6] == "login" && $_SERVER["REQUEST_METHOD"] == "POST"){
        //reponse to login 
        
        // user->login;
        echo json_encode(['message' => "welcom to login"]);
    }elseif($uri[6] == "signup" && $_SERVER["REQUEST_METHOD"] == "POST"){
        //reponse to sign up 

        // user->signup;
        echo json_encode(['message' => "welcom to signup"]);
    }else {
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'Endpoint not found']);
    }
}elseif ($endpoint === 'articles') {
    // Logic for another endpoint
    // Implement handling for different HTTP methods as needed
    if(!isset($uri[6])){
        //reponse to list of article
        
        // article->listArticles;
        echo json_encode(['message' => "list of articles"]);
    }elseif(is_numeric($uri[6])){
        //reponse to category f articles articel

        // article->listArticlesbyCateg;
        echo json_encode(['message' => "welcom to category of article"]);
    }else {
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'Endpoint not found']);
    }
}elseif ($endpoint === 'article') {
    if(is_numeric($uri[6]) && $_SERVER['REQUEST_METHOD'] == "GET"){
        //reponse to signle articel


        // article->singleArticles;
        echo json_encode(['message' => "welcom to single article"]);
    }elseif(is_numeric($uri[6]) && $_SERVER['REQUEST_METHOD'] == "DELETE"){
        //reponse to signle articel
        
        // user->deleteArticle;
        echo json_encode(['message' => "user deleting to single article"]);
    }else {
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'Endpoint not found']);
    }
}elseif ($endpoint === 'user') {
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //reponse to signle articel

        //article-> addArticle;
        echo json_encode(['message' => "user published article"]);
    }else {
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'Endpoint not found']);
    }
}else {
    http_response_code(404); // Not Found
    echo json_encode(['error' => 'Endpoint not found']);
}
?>
