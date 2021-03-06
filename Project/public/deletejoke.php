<?php
    try{
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../classes/DatabaseTable.php';

        
        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');

        $jokesTable->delete($_POST['id']);

        header('location: jokes.php');
        } catch (PDOException $e) {
            $output = '데이터베이스 서버에 접속할 수 없습니다: ' . $e;
            $e->getMessage() . ', 위치: ' .
            $e->getFile() . ':' . $e->getLine();
        }
        
        
        include __DIR__ . '/../templates/layout.html.php';
    