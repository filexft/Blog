<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        header("location: login.php");
            exit();
    ?>
    <h1>Home page</h1>
    <h3>list of users</h3>


    
    <table>
            <tr>
                <td>TITLE </td>
                <td>TITLE </td>
                <td>TITLE </td>
                <td>TITLE </td>
                <td>TITLE </td>
            </tr>
    <?php
        $res = file_get_contents('http://localhost/blog/Api/index.php/articles');
        $res = json_decode($res);
        if(!empty($res)){
            foreach ($res as $item){
            echo'<tr>
                <td>' . $item->id . '</td>
                <td>' . $item->titre . '</td>
                <td>' . $item->description . '</td>
                <td>' . $item->pseudo . '</td>
                <td>' . $item->categories . '</td>
            </tr>';
            }
        }else{
            echo "table is empty ";
        }
        
        ?>
    </table>


    

</body>
</html>