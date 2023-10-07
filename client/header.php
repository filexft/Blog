<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php
        $uri = parse_url($_SERVER['REQUEST_URI']);
        global $adminUriArray;  
        $adminUriArray = explode('/',$uri['path']);
        if($adminUriArray[count($adminUriArray)-2] == 'admin'){
            echo '<link rel="stylesheet" href="../styles.css?<?php echo time(); ?>">';
        }else{
            echo '<link rel="stylesheet" href="styles.css?<?php echo time(); ?>">';
        }
    ?>
    
    
</head>
<body>

    <nav>
        <div class="logo">
            <a href="articles.php">
                <h1>Golden Blog</h1>
            </a>
        </div>
        <ul class="pages">
                <li><a href="articles.php">Home</a></li>
                
                <li><a href="createArticel.php">Create Article</a></li>

                <?php   if(isset($_SESSION['user'])){
                        $adminPath = $adminUriArray[count($adminUriArray)-2] == 'admin'? 'adminCateg.php' :'admin/adminCateg.php';
                        echo $_SESSION['user']->admin == 1? '<li><a href="'.$adminPath.'">Catgory Edit</a></li>': '';   
                    }
                    ?> 
        </ul>  

        <div class="user">
            <?php isset($_SESSION['user'])?$_SESSION['user']->email: ''; ?>
            <form method="POST">
                <?php echo isset($_SESSION['user'])? '<input type="submit" name="logout" class="btn" value="Log out">' : ''; ?>
            </form>
            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout']) && isset($_SESSION['user'])){
                    unset($_SESSION['user']);
            }
            ?>
        </div>
    </nav>