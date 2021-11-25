<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>쿠키생성</title>
</head>
<body>
    <?php
    $cookie_name = "myCookie";
    $cookie_value = "홍길동";
    setcookie($cookie_name, $cookie_value, time() + 86400 * 30);
    ?>
    쿠키를 만듭니다. <br/>
    쿠키 내용은 <a href="./result_cookie.php">여기로</a> !!!
</body>
</html>