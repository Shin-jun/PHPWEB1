<?php
try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';
    include __DIR__ . '/../controllers/RegisterController.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');
    $registerController = new RegisterController($authorsTable);

    $action = $_GET['action'] ?? 'home';
    
    if ($action == strtolower($action)) {
        $registerController->$action();
    }else {
        http_response_code(301);
        header('location: index.php?action=' . strtolower($action));
    }

    $title = $page['title'];

    if (isset($page['variables'])) {
		$output = loadTemplate($page['template'], $page['variables']);
	} else {
        $output = loadTemplate($page['template']);
    }
} catch (PDOException $e) {
    $title = '오류가 발생했습니다';

    $output = '데이터베이스 서버에 접속할 수 없습니다: ' . $e;
    $e->getMessage() . ', 위치: ' .
        $e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';