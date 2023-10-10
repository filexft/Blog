


<?php
    require_once('header.php');
    require_once('utile.php');
?>

    <div class="loginContainer">
        <form Method="POST">
            <input type="text" name="pseudo" id="name" placeholder="Pseudo">
            <input type="email" name="email" placeholder="email .." required>
            <input type="password" name="mdp" placeholder="password" required>
            <input type="submit" value="submit">

            <p><?php echo (!empty($_SESSION['error'])? $_SESSION['error'] : ''); ?></p>
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['email']) && isset($_POST['mdp'])){
                $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo']: '';
                $payload = array(
                    'email' => $_POST['email'],
                    'mdp' => $_POST['mdp'],
                    'pseudo' => $pseudo
                );
                $res = httpPost("http://localhost/blog/api/index.php/auth/login", $payload);
                
                // var_dump($res);


                if(!empty($res) && $res != null) 
                {
                    $res = json_decode($res);
                    if($res == null){
                        var_dump('null value');
                        exit(1);
                    }
                    if($res->logged == true){
                        // var_dump($res);
                        // var_dump($res->data);
                        if($res->new == false){
                            $user = array('id' => $res->data[0]->id ,
                                    'email' => $res->data[0]->email,
                                    'mdp' => $res->data[0]->mdp,
                                    'pseudo' => $res->data[0]->pseudo,
                                    'admin' => $res->data[0]->admin,
                                    );
                            $_SESSION['user'] = (object)$user;
                            header("location: articles.php");
                            exit();
                        }else{
                            $res = json_decode(httpPost("http://localhost/blog/api/index.php/auth/login", $payload));
                            $user = array('id' => $res->data[0]->id ,
                                    'email' => $res->data[0]->email,
                                    'mdp' => $res->data[0]->mdp,
                                    'pseudo' => $res->data[0]->pseudo,
                                    'admin' => $res->data[0]->admin,
                                    );
                            $_SESSION['user'] = (object)$user;
                            header("location: articles.php");
                            exit();
                        }
                    }else{
                        $_SESSION['error'] = 'please fill the fields!!';
                    }
                }
            }else{
                
            }
        }
        ?>

    </div>


<?php
    require_once('footer.php')
?>