<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="styles.css?<?php echo time(); ?>">
</head>
<body>


    <?php
        // if(!empty($_SESSION['user'])){
            
        //     $category = ;
        // }
        // $category = ['Java', 'JS', 'C'];
    ?>
    <nav>
        <div class="logo">
            <a href="articles.php">
                <h1>Golden Blog</h1>
            </a>
        </div>
        <ul class="pages">
                <li><a href="articles.php">Home</a></li>
                
                <li><a href="createArticel.php">Create Article</a></li>
                
                <li><a href="#">Discover</a></li>

                <?php   if(isset($_SESSION['user'])){
                        echo $_SESSION['user']->admin == 1? '<li><a href="adminCateg.php">Catgory Edit</a></li>': '';   
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