<?php

function totalJokes($pdo) {
	// query()함수로 보낼 빈 배열 생성

	// query() 함수를 호출할 때 빈 $parameters 배열 전달
	$query = query($pdo, 'SELECT COUNT(*) FROM `joke`');

	$row = $query->fetch();

	return $row[0];
}

function getJoke($pdo, $id){
	// query()함수에서 사용할 $parameters 배열 생성
	$parameters = [':id'=> $id];

	$query = query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id', $parameters);

	return $query->fetch();
}

function query($pdo, $sql, $parameters=[]){
	$query = $pdo->prepare($sql);
	$query->execute($parameters);

	return $query;
}

function insertJoke($pdo, $fields){
	$query = 'INSERT INTO `joke` (';

	foreach($fields as $key => $value) {
		$query .= '`' . $key . '`,';
	}

	$query = rtrim($query, ',');

	$query .= ') VALUES ( ';

	foreach($fields as $key => $value) {
		$query .=':' . $key . ',';
	}

	$query = rtrim($query, ',');

	$query .= ')';

	$fields = processDates($fields);

	query($pdo, $query, $fields);
}

function updateJoke($pdo, $fields) {
	$query = ' UPDATE `joke` SET';

	foreach($fields as $key => $value) {
		$query .= '`' . $key . '` = :' . $key . ',';
	}

	$query = rtrim($query, ',');

	$query .= ' WHERE `id` = :primaryKey';

	$fields = processDates($fields);

	// : primaryKey 변수 설정
	$fileds['primaryKey'] = $fields['id'];

	query($pdo, $query, $fields);
}

function deleteJoke($pdo, $id) {
	$parameters = [':id'=> $id];

	query($pdo, 'DELETE FROM `joke`
	WHERE `id` = :id', $parameters);
}

function allJokes($pdo){
	$jokes = query($pdo, 'SELECT `joke`.`id`, `joketext`, `jokedate`, `name`, `email`
	FROM `joke` INNER JOIN `author`
	ON `authorid` = `author`.`id`');

	return $jokes->fetchAll();
}
function processDates($fields) {
	foreach($fields as $key => $value) {
		if ($value instanceof DateTime) {
			$fields[$key] = $value->format('Y-m-d H:i:s');
		}
	}
	return $fields;
}

function allAuthors($pdo){
	$authors = query($pdo, 'SELECT * FROM `author`');

	return $authors->fetchAll();
} 

function deleteAuthor($pdo, $id) {
	$parameters = [':id' => $id];

	query($pdo, 'DELETE FROM `author`
	WHERE `id` = :id', $parameters);
}

function insertAuthor($pdo, $fields) {
	$query = 'INSERT INTO `author` (';

	foreach($fields as $key =>$value) {
		$query .= '`' . $key . '`,';
	}

	$query = rtrim($query, ',');

	$query .= ') VALUES (';

	foreach($fields as $key => $value) {
		$query .= ':' . $key . ',';
	}
	$query = rtrim($query, ',');

	$query .= ')';

	$fields = processDates($fields);

	query($pdo, $query, $fields);
}
?>