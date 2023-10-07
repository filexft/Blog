<?php
    require_once('../header.php');
    require_once('../utile.php');

    
?>
    <?php
        if(isset($_SESSION['user'])){
            //print user Name in this case email
        }else{

            //if user session isn't filled (user not logged in) redirect to login page
            header("location: login.php");
            exit();
        }
        ?>
    
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
                        // var_dump($categ);
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
                    
                    // echo '<ul class="categoList">';
                    // foreach ($data as $categ) {
                    //     var_dump($categ);
                    //     echo '<li class="categ">' . $categ->nom . '</li>';
                    // }
                    // echo '</ul>';

                }else{
                    echo "there is not category!";
                }
            }else{  
                echo "error with data fetching!";
            }
        ?>

        </div>


        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category'])){
                        $payload = ['category' => $_POST["category"]];
                        $res = httpPost("http://localhost/blog/Api/index.php/admin", $payload);
                        print_r($res);
                        // header("Refresh:0");
            }elseif($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['removeCategory'])){
                    
                        $payload = ['removeCategory' => $_POST["removeCategory"]];
                        $res = httpDELETE("http://localhost/blog/Api/index.php/admin", $payload);
                        var_dump($res);
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
                        print_r($res);
            }
            

    ?>

    </div>

    

<?php
    require_once('../footer.php')
?>