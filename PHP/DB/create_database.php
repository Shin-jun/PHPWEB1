<?php
$mysql_host = "localhost"; // 데이터베이스 서버의 호스트 또는 ip
$mysql_user = "root";   // 데이터베이스 사용자 계정
$mysql_password = "1234";   // 데이터베이스 사용자 패스워드


$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password);

if (!$conn) {
    die("연결 실패: ". mysqli_connect_error());
}

// 데이터베이스 생성
$sql = "CREATE DATABASE project";

if (mysqli_query($conn, $sql)) {
    echo "데이터베이스 생성완료";
} else {
    echo "데이터베이스를 생성하는 중 오류가 발생: ".mysqli_error($conn);
}

mysqli_close($conn);