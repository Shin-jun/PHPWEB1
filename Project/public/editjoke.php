<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try{
    if(isset($_POST['joketext'])){
        updateJoke($pdo, [
            'id' => $_POST['jokeid'],
            'joketext' => $_POST['joketext'],
            'authorId' => 1
        ]);

        header('location: jokes.php');
    } else{
        $joke = getJoke($pdo, $_GET['id']);

        $title = '유머 글 수정';

        ob_start();

        include __DIR__ . '/../templates/editjoke.html.php';

        $output = ob_get_clean();
    }
}catch (PDOException $e) {
    $title = '오류가 발생했습니다';

    $output = '데이터베이스 서버에 접속할 수 없습니다: ' . $e;
    $e->getMessage() . ', 위치: ' .
    $e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';