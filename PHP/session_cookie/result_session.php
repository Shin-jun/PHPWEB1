<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>세션결과</title>
</head>
<body>
    <?php
    session_start();
    ?>
    세션값은 :<?php echo $_SESSION['mySession']; ?> 입니다.
    
</body>
</html>