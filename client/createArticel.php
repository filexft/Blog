<?php
    require_once('header.php');
    
    require_once('utile.php');
    
    CheckAuth();
?>    
    <div class="creationContainer">
        <form Method="POST">
            <label for="title">Add Article Title</label>
            <input type="text" name="titre" placeholder="How to Speak predica" required>

            <div class="catgory">
                
            <h3>Add Article categories </h3>
            <?php
                    
                    echo ' <div class="filtercateg" >';
                    $res = file_get_contents("http://localhost/blog/Api/index.php/admin");
                    if($res != false){
                        $data = json_decode($res);
                        
                        if(!empty($data)){
                            $data = $data;
                        
                            
                            foreach ($data as $categ) {
                                echo ' <div class="filteritem" >';
                                echo '<input type="checkbox" name="c-'.$categ->id.'" id="'.$categ->id.'" value="'. $categ->id .'">';
                                echo '<label for="'.$categ->id.'">'. $categ->nom .'</label>';
                                echo ' </div>';
                            }
                        }else{
                            echo "there is not category!";
                        }
                    }else{  
                        echo "error with data fetching!";
                    }
                    
                    echo ' </div>';
                ?>
            </div>

            
            <label for="description">Add Article Description </label>
            <textarea name="description" rows="20" cols="100" placeholder="How to Speak predica in 10m with ease." required></textarea>
        

            <button class="btn">Add Article</button> 
        </form>

        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['titre'])   && isset($_POST['description'])){
                    $payload = ['data' => $_POST, 'user' => $_SESSION['user']];

                    
                    $res = json_decode(httpPost("http://localhost/blog/Api/index.php/user", $payload));
                    // echo '<span class="info">'.$res->message.'</span>';

                    if($res->success){
                        header("location: articles.php");
                        exit();
                    }
                    
            }
        ?>

    </div>


    


<?php
    require_once('footer.php')
?>