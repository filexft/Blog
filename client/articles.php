<?php
    require_once('header.php');
?>

    <h1>
        <?php
        if(isset($_SESSION['user'])){
            //print user Name in this case email
            echo $_SESSION['user']->pseudo;
        }else{

            //if user session isn't filled (user not logged in) redirect to login page
            header("location: login.php");
            exit();
        }
        ?>
    </h1>
    <div class="articlContainer">
        <form class="filter" method="GET">
            <label for="searchAuthor">Pseudo </label>
            <input type="text" name="pseudo_category" id="searchAuthor" placeholder="author or Category">
            
            <!-- <input type="checkbox" name="categorySearch" id="categorySearch">
            <label for="categorySearch">Search by category </label> -->
        </form>

        <?php
            if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['pseudo_category'])){

            }
        ?>




        <div class="cardContainer">
            <?php
            if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['pseudo_category'])){
                $res = file_get_contents('http://localhost/blog/Api/index.php/articles/'.$_GET['pseudo_category']);
            }else {
                $res = file_get_contents('http://localhost/blog/Api/index.php/articles');
            }
            $res = json_decode($res);
            
            // var_dump($res);

            if(!empty($res)){
                // var_dump($res);
                foreach ($res as $item){
                    $categoriesArray = explode(',', $item->article_categories);
                    // echo $item->article_categories;
                    $categories = '';
                    foreach($categoriesArray as $categ){
                        $categories .= '<span class="categ">'.$categ.'</span>';
                    }

                    $author = $item->article_author == null? 'Unknown' :$item->article_author; 

                    echo'
                        <a href="article.php?id='.$item->article_id.'">
                            <div class="card">
                                <input type="hidden" id="articel_id" name="id" value="'.$item->article_id.'" />
                                <h2>'.$item->article_title.'</h2>
                                <div class="categList">'.$categories.'</div>
                                <h4>'.$item->article_description.'</h4>
                                <h5>'.$author.'</h5>
                            </div>
                        </a>';
                }
            }else{
                echo "table is empty ";
            }
            
            ?>
        </div>
    </div>


<?php
    require_once('footer.php')
?>