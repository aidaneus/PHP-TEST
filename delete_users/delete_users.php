<?php
require_once '../connect.php';
require_once '../style.html'
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Удаление пользователя из группы</title>
        <script type = "text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"> </script>
        <script type = "text/javascript">

        $(function(){
            var name = $(".groups").val();
            $.ajax({
                type: "POST",
                url: "users.php",
                data: {name: name},
                success: function(data){
                    $ (".users").html(data);
                }
            });

            $(".groups").change(function(){
            var name = $(".groups").val();
            if (!name){
                    
            }
            $.ajax({
                type: "POST",
                url: "users.php",
                data: {name: name}, // aaaaaaa
                success: function(data){
                    $ (".users").html(data);
                }
            });
            });

        });

        </script>
    </head>
    <body>
    <!-- <style>
                a {
                    padding: 2px;
                    text-decoration: none;
                }
                a:hover {
                    background: #F0F8FF;
                    color: 	#FF69B4;
                }
    </style> -->
    <form action = "engine.php" method="post">
    <p><b>Выберите  группу:</b><br>
    <br>
    <select size='1' class="groups" name="groups">
    <option value="0">--Выберите группу--</option>
    <?php
    $querry = mysqli_query($request->connect, "SELECT * FROM groups;");
    while ($row = mysqli_fetch_array($querry)){
        echo "<option value='$row[name]'>$row[name]</option>";
    }
    ?>
    <br>
    </select>
    <span class="users">
    </span>

        <p><input type ="submit" value="Удалить"></p>
        <p><a href="http://localhost/PHP-TEST/">вернуться назад</a></p>
        
        </form>
    </body>
</html>