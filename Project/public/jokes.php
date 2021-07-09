<?php

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/DatabaseTable.php';

	$jokesTable = new DatabaseTable($pdo, 'joke', 'id');
	$authorsTable = new DatabaseTable($pdo, 'author', 'id');

    $result = $jokesTable->findAll();

	$jokes = [];
	foreach ($result as $joke) {
		$author = $authorsTable->findById($joke['authorId']);

		$jokes[] = [
			'id' => $joke['id'],
			'joketext' => $joke['joketext'],
			'jokedate' => $joke['jokedate'],
			'name' => $author['name'],
			'email' => $author['email']
		];

	}
    
    $title = '유머 글 목록';

    $totalJokes = $jokesTable->total();

    ob_start(); // 버퍼 저장 시작

    include __DIR__ . '/../templates/jokes.html.php';    // 출력 버퍼의 내용을 읽고 $output변수에 저장한다.

    $output = ob_get_clean();   // $output은 layout.html.php에서 사용된다.


} catch (PDOException $e) {
    $output = '데이터베이스 서버에 접속할 수 없습니다: ' . $e;
    $e->getMessage() . ', 위치: ' .
    $e->getFile() . ':' . $e->getLine();
}


include __DIR__ . '/../templates/layout.html.php';

?>