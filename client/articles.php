<?php
    require_once('header.php');
?>

    <div class="articlContainer">
        <?php
        $res = file_get_contents('http://localhost/ex/blog/Api/index.php/articles');
        $res = json_decode($res);
        if(!empty($res)){
            foreach ($res as $item){
                echo'
                    <div class="card">
                        <input type="hidden" id="articel_id" name="id" value="'.$item->id.'" />
                        <h2>'.$item->titre.'</h2>
                        <h3>'.$category[$item->categories].'</h3>
                        <h4>'.$item->description.'</h4>
                        <h5>'.$item->pseudo.'</h5>
                    </div>';
            }
        }else{
            echo "table is empty ";
        }
        
        ?>
        <a href="http://localhost/ex/blog/Api/index.php/article/1">
             <div class="card">
            <input type="hidden" name="id">
            <h2>react roadmap</h2>
            <h3>readt</h3>
            <h4>description of react</h4>
            <h5>rik</h5>
            </div>
        </a>
        
    </div>


<?php
    require_once('footer.php')
?>