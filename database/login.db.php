<?php

declare(strict_types=1);
require_once('database/connect.db.php');

function register_user(PDO $dbh, string $username, string $password): void
{
  $stmt = $dbh->prepare('INSERT INTO users VALUES (?, ?)');
  $stmt->execute(array($username, sha1($password)));
}

function verify_user(PDO $dbh, string $username, string $password): bool
{
  $stmt = $dbh->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
  $stmt->execute(array($username, sha1($password)));

  return $stmt->fetch() !== false;
}

function register_product(PDO $dbh, string $name, string $category): bool
{
  $stmt = $dbh->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
  $stmt->execute(array($username, sha1($password)));

  return $stmt->fetch() !== false;
}