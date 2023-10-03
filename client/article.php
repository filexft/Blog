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
            print_r($id);
            $url = "http://localhost/ex/blog/Api/index.php/article/$id";
            $res = file_get_contents($url);
            
            if ($res !== false) {
                $data = json_decode($res);

                if (!empty($data)) {
                    $data = $data[0];
                    $user = $data->pseudo == 1? 'Admin': 'unknown';
                    echo '
                        <article>
                            <h1>'.$data->titre.'</h1>
                            <p class="categ">'.$category[$data->categories].'</p>
                            <h3>'.$user.'</h3>
                            <p>'.$data->description.'</p>
                            <ulclass="comments">
                                <p>'.$data->commentaire.'</p>
                            </ul>
                        </article>    
                    ';
                } else {
                    echo "Article not found.";
                }
            } else {
                echo "Error fetching data from the API.";
            }
            
        ?>
        
    </div>


<?php
    require_once('footer.php')
?>