<?php
    session_start();

    if(!isset($_SESSION['user'])){
        //if user session isn't filled (user not logged in) redirect to login page
        header("location: ../login.php");
        exit();
    }
    require_once('../utile.php');
?>    
<?php
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category'])){
                        $payload = ['category' => $_POST["category"]];
                        $res = httpPost("http://localhost/blog/Api/index.php/admin", $payload);
                        
                        header("Refresh:0");
            }elseif($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addCategoryBtn'])){
                    unset($_SESSION['old_categ']);
                    header("Refresh:0");
            }elseif($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['removeCategory'])){
                    
                        $payload = ['removeCategory' => $_POST["removeCategory"]];
                        $res = httpDELETE("http://localhost/blog/Api/index.php/admin", $payload);
            }elseif($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['UpdateCategory'])){
                        $_SESSION['old_categ'] = $_POST['UpdateCategory'];
                        header("Refresh:0");
            }elseif($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['oldcategory']) && isset($_POST['newcategory'])){
                        if(isset($_SESSION['old_categ'])){
                            unset($_SESSION['old_categ']);
                        }
                        $payload = ['oldcategory' => $_POST["oldcategory"], 'newcategory' => $_POST["newcategory"]];
                        $res = httpPUT("http://localhost/blog/Api/index.php/admin", $payload);
                        header("Refresh:0");
            }
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
    <link rel="stylesheet" href="../styles.css?<?php echo time(); ?>"> 
</head>
<body>

    <nav>
        <div class="logo">
            <a href="articles.php">
                <h1>Golden Blog</h1>
            </a>
        </div>
        <ul class="pages">
                <li><a href="../articles.php">Home</a></li>
                
                <li><a href="../createArticel.php">Create Article</a></li>

                <li><a href="adminCateg.php">Catgory Edit</a></li>
        </ul>  

        <div class="user">
            <?php isset($_SESSION['user'])?$_SESSION['user']->email: ''; ?>
            <form method="POST">
                <input type="submit" name="logout" class="btn" value="Log out">
            </form>


            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout']) && isset($_SESSION['user'])){
                    unset($_SESSION['user']);
            }
            ?>
        </div>
    </nav>
    
    <div class="adminContainer">

        <form method="POST" class="addForm">
            <?php


                $addCategoryform = '<label for="addcategory">Add a Category</label>
                                <input type="text" name="category" id="addcategory" placeholder="tech">
                                <button>Add Category</button>';
                
                $updateCategoryForm = '<label for="addcategory">Add a Category</label>
                                        <input type="text" name="oldcategory" id="editcategory" readonly value="'.(!empty($_SESSION['old_categ'])?$_SESSION['old_categ']:'').'">
                                        <input type="text" name="newcategory" id="newcategory" placeholder="new category (ex: fitness)">
                                        <button>Update Category</button>';

                echo isset($_SESSION['old_categ'])? $updateCategoryForm : $addCategoryform;

            ?>
        </form>
        <?php
            $addCategoryBtn = '<form method="POST" class="addForm">
                                    <input type="hidden" name="addCategoryBtn" id="addCategoryBtn">
                                    <button>return to add Category </button>
                                </form>';

            echo isset($_SESSION['old_categ'])? $addCategoryBtn : '';

        ?>

        <div>
        <h2>Categoy List</h2>
        <?php
            $res = file_get_contents("http://localhost/blog/Api/index.php/admin");
            if($res != false){
                $data = json_decode($res);
                if(!empty($data)){
                    $data = $data;
                    

                    
                    echo '<div class="categoryContainer">';
                    foreach ($data as $categ) {
                        echo '<div class="singleCategoy">';
                        echo '<li class="categ">'.$categ->nom.'</li>

                            <div class="control">
                                <form method="POST" class="addForm">
                                    <input type="hidden" name="removeCategory" id="removeCategory" value="'.$categ->nom.'">
                                    <button><i class="fa-solid fa-trash"></i></button>
                                </form>


                                
                                <form method="POST" class="addForm"> 
                                    <input type="hidden" name="UpdateCategory" id="editcategory" value="'.$categ->nom.'">
                                    <button><i class="fa-regular fa-pen-to-square"></i></button>
                                </form>
                            </div>';
                        echo '</div>';
                        }
                    echo '</div>';
                }else{
                    echo "there is not category!";
                }
            }else{  
                echo "error with data fetching!";
            }
        ?>

        </div>


        

    </div>

    

<?php
    require_once('../footer.php')
?>