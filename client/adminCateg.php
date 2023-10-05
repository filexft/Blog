<?php
    require_once('header.php');
    require_once('utile.php');
    
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

        <div>
        <h2>Categoy List</h2>
        <?php
            $res = file_get_contents("http://localhost/blog/Api/index.php/admin");
            if($res != false){
                $data = json_decode($res);
                if(!empty($data)){
                    $data = $data;
                    
                    
                    echo '<ul class="categoList">';
                    foreach ($data as $categ) {
                        echo '<li class="categ">' . $categ->nom . '</li>';
                    }
                    echo '</ul>';
                }else{
                    echo "there is not category!";
                }
            }else{  
                echo "error with data fetching!";
            }
        ?>

        </div>


        <form method="POST" class="addForm">
            <label for="addcategory">Add a Category</label>
            <input type="text" name="category" id="addcategory" placeholder="tech">
            <button>Add Category</button>
        </form>
        
      
        <form method="DELETE" class="addForm">
            <label for="removeCategory">Remove a Category</label>
            <input type="text" name="removeCategory" id="removeCategory" placeholder="tech">
            <button>Remove Category</button>
        </form>


        
        <form method="PUT" class="addForm">
            <label for="editcategory">Edit a Category</label>
            <input type="text" name="oldcategory" id="editcategory" placeholder="old category (ex:tech)">
            <input type="text" name="newcategory" id="newcategory" placeholder="new category (ex: fitness)">
            <button>Edit Category</button>
        </form>



        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category'])){
                    echo "method Post";
                    $payload = ['category' => $_POST["category"]];
                    $res = httpPost("http://localhost/blog/Api/index.php/admin", $payload);
                    print_r($res);
        }elseif($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($_GET['removeCategory'])){
                    print_r("Method DELETE!");
                    $payload = ['removeCategory' => $_GET["removeCategory"]];
                    $res = httpDELETE("http://localhost/blog/Api/index.php/admin", $payload);
                    print_r($res);
        }elseif($_SERVER["REQUEST_METHOD"] == "PUT" && isset($_GET['oldcategory']) && isset($_GET['newcategory'])){
                    print_r("Method PUT!");
                    $payload = ['oldcategory' => $_GEt["oldcategory"], 'newcategory' => $_GEt["newcategory"]];
                    $res = httpDELPut("http://localhost/blog/Api/index.php/admin", $payload, "PUT");
                    print_r($res);
        }

    ?>

    </div>

    

<?php
    require_once('footer.php')
?>