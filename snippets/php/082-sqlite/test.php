<?php

include "lite.php";

$path = "test.db";

$lite = new Lite($path);
$lite->open();

$lite->tableCreate("users",[
	'name TEXT',
	'email TEXT',
]);

$users = $lite->select("users");
foreach ($users as $key => $value) {
	$lite->delete("users", $value['id']);
}
$users = $lite->select("users");

$users = $lite->exec("INSERT INTO users (name, email) VALUES (:name, :email);", [
	'name'=>'John Doe', 
	'email'=>'a@example.com'
]);

$id = $lite->lastId();

$users = $lite->select("users");

$users = $lite->query("select * from users where id = :id", [
	'id'=>$id,
]);

$lite->insert("users", [
	'name'=>'John Doe', 
	'email'=>'b@example.com'
]);

$users = $lite->select("users", [
	'name'=>'John Doe', 
	'email'=>'test@example.com'
]);

$users = $lite->select("users", ['name'=>'John Doe']);
var_dump($users);

$lite->close();