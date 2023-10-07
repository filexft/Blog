<?php
    require_once('header.php');
    require_once('utile.php');
?>

    <h1>
        <?php
        if(isset($_SESSION['user'])){
            //print user Name in this case email
        }else{

            //if user session isn't filled (user not logged in) redirect to login page
            header("location: login.php");
            exit();
        }
        ?>
    </h1>
    
    <div class="signleArticleContainer">
        <?php
            $uri = parse_url($_SERVER['REQUEST_URI']);
            $id  = explode('=',$uri['query'])[1];
            
            // if($id){
            //     //when user enter first save the id from the url 
            //     $_SESSION['single_article_id'] = $id ;
            // }else{
            //     //when user post a comment or delete a comment the url changeso save from session
            //     $id = $_SESSION['single_article_id'];
            // }

            // var_dump($uri);

            global $article_id;
            $article_id = $id;


            $url = "http://localhost/blog/Api/index.php/article/$id";
            $res = file_get_contents($url);

            // var_dump($res);



            if(!empty($res)){
                $item = json_decode($res)->article[0];

                global $Comments;
                $Comments = json_decode($res)->comments;
                
                // var_dump($Comments);

                    $categoriesArray = explode(',', $item->article_categories);
                    // echo $item->article_categories;

                    $categories = '';
                    foreach($categoriesArray as $categ){
                        $categories .= '<span class="categ">'.$categ.'</span>';
                    }

                    $author = $item->article_author == null? 'Unknown' :$item->article_author; 

                    echo'
                        <article>
                            <div class="card">
                                <input type="hidden" id="articel_id" name="id" value="'.$item->article_id.'" />
                                
                                <h1>'.$item->article_title.'</h1>
                                <div class="categAuther">
                                    <div class="categList">'.$categories.'</div>
                                    <h3>'.$author.'</h3>
                                </div>
                                <p>'.$item->article_description.'</p>
                                
                            </div>
                        </article>';
                
            }else{
                echo "table is empty ";
            }

        ?>


        <div class="comments">
            <h2>Comments</h2>
            <form action="" method="POST">
                <input type="text" name="comment" placeholder="this article is very good to loose brain cell">
                <button class="btn">Submit</button>
            </form>

            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment'])){
                    $payload = ['comment' => $_POST['comment'], 'user_id' => $_SESSION['user']->id, 
                                "article_id" => $article_id ];

                    $res = json_decode(httpPost('http://localhost/blog/Api/index.php/article/', $payload));
                    
                    // var_dump($res);
                }
            ?>


            <div class="commentList">
                <?php

                    if(isset($Comments)){

                        foreach($Comments as $comment){

                            $deleteComment = $_SESSION['user']->id == $comment->user_id? 
                                                "<form method='POSt'>                                
                                                    <input type='text' name='delete' readonly value=".$comment->id." >
                                                    <button class='btn'>Delete</input>
                                                </form>" : '';

                            // $deleteComment = '';
                            
                            // var_dump($comment->id);
                            
                            echo '<div class="comment" >
                            <div class="upperComment">
                            <h3>'.$comment->pseudo.'</h3>
                            '.$deleteComment.'
                            </div>
                            <p>'.$comment->description.'</p>
                            </div>';
                        }
                    }


                    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])){
                        $payload = ['article_id' => $article_id, 'comment_id' => $_POST['delete']];

                        $res = httpDELETE('http://localhost/blog/Api/index.php/user/', $payload);
                        
                        var_dump($res);
                    }



                ?>
            </div>            
        </div>

        
    </div>


<?php
    require_once('footer.php')
?>