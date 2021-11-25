<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>세션생성</title>
</head>
<body>
    <?php
    session_start(); // 세션 생성
    $session_value = "홍길동";
    $_SESSION['mySession'] = $session_value;
    ?>
    세션을 만듭니다.<br/>
    세션 내용은 <a href="./result_session.php">여기로</a>!!!
</body>
</html>