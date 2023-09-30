


<?php
    require_once('header.php');
    require_once('utile.php');
?>

    <div class="loginContainer">
        <form Method="POST">
        <input type="email" name="email" placeholder="email .." required>
        <input type="password" name="mdp" placeholder="password" required>
        <input type="submit" value="submit">
        <p><?php echo (!empty($_SESSION['error'])? $_SESSION['error'] : ''); ?></p>
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['email']) && isset($_POST['mdp'])){
                $payload = [
                    'email' => $_POST['email'],
                    'mdp' => $_POST['mdp']
                ];
                $res = json_decode(httpPost("http://localhost/ex/blog/api/index.php/auth/login", $payload));
                if(!empty($res))
                {
                    if($res->logged == true){
                    echo "successful loggged";
                    header("location: articles.php");
                    exit();
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





<?php
    // BoilerPlate
    // require_once('header.php')




    // require_once('footer.php')
?>