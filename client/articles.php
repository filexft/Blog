<?php
    require_once('header.php');
    
    require_once('utile.php');
    CheckAuth();
?>

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
            

            if(!empty($res)){

                foreach ($res as $item){

                    // var_dump($res);

                    $categoriesArray = explode(',', $item->article_categories);
                    $categories = '';
                    foreach($categoriesArray as $categ){
                        $categories .= '<span class="categ">'.$categ.'</span>';
                    }

                    $author = $item->article_author == null? 'Unknown' :$item->article_author; 

                    $deleteArticle = $_SESSION['user']->id == $item->article_author_pseudo? 
                                                "<form method='POSt'>                                
                                                    <input type='hidden' name='delete' readonly value=".$item->article_id." >
                                                    <button class='btn'><i class='fa-solid fa-trash'></i></input>
                                                </form>" : '';

                    echo'
                        <a href="article.php?id='.$item->article_id.'">
                            <div class="card">
                                <input type="hidden" id="articel_id" name="id" value="'.$item->article_id.'" />
                                <h2>'.$item->article_title.'</h2>
                                <div class="categList">'.$categories.'</div>
                                <h4>'.$item->article_description.'</h4>
                                <h5>'.$author.'</h5>
                                '.$deleteArticle.'
                            </div>
                        </a>';
                }
            }else{
                echo "table is empty ";
            }


            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])){
                $payload = ['article_id' => $_POST['delete']];

                $res = httpDELETE('http://localhost/blog/Api/index.php/article/', $payload);
                        
                //it throws an error if i want to refresh the page
                // header("Refresh:0");
            }
            
            ?>
        </div>
    </div>


<?php
    require_once('footer.php')
?>