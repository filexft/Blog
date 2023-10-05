<?php
    require_once('header.php');
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
            
            

            $url = "http://localhost/blog/Api/index.php/article/$id";
            $res = file_get_contents($url);

            // var_dump($res);



            if(!empty($res)){
                $item = json_decode($res)[0];
                
                // var_dump($item);

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




            // if ($res !== false) {
            //     $data = json_decode($res);

            //     if (!empty($data)) {
            //         $data = $data[0];
            //         $user = $data->pseudo == 1? 'Admin': 'unknown';
            //         echo '
            //             <article>
            //                 <h1>'.$data->titre.'</h1>
            //                 <p class="categ">'.$category[$data->categories].'</p>
            //                 <h3>'.$user.'</h3>
            //                 <p>'.$data->description.'</p>
            //                 <ulclass="comments">
            //                     <p>'.$data->commentaire.'</p>
            //                 </ul>
            //             </article>    
            //         ';
            //     } else {
            //         echo "Article not found.";
            //     }
            // } else {
            //     echo "Error fetching data from the API.";
            // }
            
        ?>

        
    </div>


<?php
    require_once('footer.php')
?>