<?php
try {
	include __DIR__ . '/../classes/EntryPoint.php';

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/'); # ltrim : 앞의 /를 삭제

    $entryPoint = new EntryPoint($route);
    $entryPoint->run();
} catch (PDOException $e) {
    $title = '오류가 발생했습니다';

    $output = '데이터베이스 서버에 접속할 수 없습니다: ' . $e;
    $e->getMessage() . ', 위치: ' .
        $e->getFile() . ':' . $e->getLine();

include __DIR__ . '/../templates/layout.html.php';
}