<?php

// Challenge: make this terrible code safe


echo "<!doctype html>\n";

$username = !empty($_GET['username']) ? $_GET['username'] : '';
$password = !empty($_GET['password']) ? $_GET['password'] : '';

$username = strip_tags($username);
$password = strip_tags($password);


function better_crypt($input, $rounds = 7)
{
    $salt = "kgndfsgndflkvjndfsjkvndvnlsdfjvnds&^*^&*^&%^$%^$%@#$%";
    $salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
    for($i=0; $i < 22; $i++) {
        $salt .= $salt_chars[array_rand($salt_chars)];
    }
    return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
}


$pdo = new PDO('sqlite::memory:');
$pdo->exec("DROP TABLE IF EXISTS users");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("CREATE TABLE users (username VARCHAR(255), password VARCHAR(255))");

$stmt =$pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->execute(['root', better_crypt("secret")]);

$statement = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ? ");
$statement->execute([$username, better_crypt($password)]);

if (count($statement->fetchAll())) {
    echo "Access granted to $username!<br>\n";
} else {
    echo "Access denied for $username!<br>\n";
}

