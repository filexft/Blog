<?php
    require_once('header.php');
?>

    <h1>
        <?php
        if(isset($_SESSION['user'])){
            //print user Name in this case email
            echo $_SESSION['user']->admin;
        }else{

            //if user session isn't filled (user not logged in) redirect to login page
            header("location: login.php");
            exit();
        }
        ?>
    </h1>
    <div class="articlContainer">
        <div class="filter">
            <label for="category">categories </label>
            <?php
                    // $res = file_get_contents("http://localhost/blog/Api/index.php/admin");
                    // if($res != false){
                    //     $data = json_decode($res);
                    //     if(!empty($data)){
                    //         $data = $data;
                        
                            
                    //         echo ' <select id="category" name="category" required>';
                    //         foreach ($data as $categ) {
                    //             echo '<option value="'.$categ->id.'">'. $categ->nom . '</option>';
                    //         }
                    //         echo ' </select>';
                    //     }else{
                    //         echo "there is not category!";
                    //     }
                    // }else{  
                    //     echo "error with data fetching!";
                    // }
                ?>
        </div>
        <?php
        $res = file_get_contents('http://localhost/blog/Api/index.php/articles');
        $res = json_decode($res);
        if(!empty($res)){
            foreach ($res as $item){
                echo'
                    <a href="article.php?id='.$item->id.'">
                        <div class="card">
                            <input type="hidden" id="articel_id" name="id" value="'.$item->id.'" />
                            <h2>'.$item->titre.'</h2>
                            <h3 class="categ">'.$item->categories.'</h3>
                            <h4>'.$item->description.'</h4>
                            <h5>'.$item->pseudo.'</h5>
                        </div>
                    </a>';
            }
        }else{
            echo "table is empty ";
        }
        
        ?>
        
    </div>


<?php
    require_once('footer.php')
?>