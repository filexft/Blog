<?php
    require_once('header.php');
    
    require_once('utile.php');
?>
    <?php
        if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
            //print user Name in this case email
        }else{
            //if user session isn't filled (user not logged in) redirect to login page
            header("location: login.php");
            exit();
        }
        ?>
    
    <div class="creationContainer">
        <form Method="POST">
            <label for="title">Add Article Title</label>
            <input type="text" name="titre" placeholder="How to Speak predica" required>

            <label for="category">Add Article categories </label>
            <?php
                    $res = file_get_contents("http://localhost/ex/blog/Api/index.php/admin");
                    if($res != false){
                        $data = json_decode($res);
                        if(!empty($data)){
                            $data = $data;
                        
                            
                            echo ' <select id="category" name="category" required>';
                            foreach ($data as $categ) {
                                echo '<option value="'.$categ->id.'">'. $categ->nom . '</option>';
                            }
                            echo ' </select>';
                        }else{
                            echo "there is not category!";
                        }
                    }else{  
                        echo "error with data fetching!";
                    }
                ?>


            
            <label for="description">Add Article Description </label>
            <textarea name="description" rows="20" cols="100" placeholder="How to Speak predica in 10m with ease." required></textarea>
        

            <button class="btn">Add Article</button> 
        </form>

        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['titre'])  && isset($_POST['category'])  && isset($_POST['description'])){
                    echo "method Post";
                    $payload = ['titre' => $_POST["titre"], 'category' => $_POST["category"], 'description' => $_POST["description"]];
                    $res = httpPost("http://localhost/ex/blog/Api/index.php/user", $payload);
                    print_r($res);
            }
        ?>

    </div>


    


<?php
    require_once('footer.php')
?>