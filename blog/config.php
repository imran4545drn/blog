<?php
$servername = "db";
$username = "imran123";
$password = "imran123";
$database = "blog";

// MySQL'e bağlanma
$db = new mysqli($servername, $username, $password, $database);

// Bağlantı hatası kontrolü
if ($db->connect_error) {
    die("Bağlantı hatası: " . $db->connect_error);
}
?>