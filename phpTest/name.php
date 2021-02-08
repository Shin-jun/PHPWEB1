<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <?php
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    echo htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8') . ' ' . 
       '님, 홈페이지방문을 환영';
    ?>
</body>
</html>