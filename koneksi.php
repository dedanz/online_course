<?php
$servername = "localhost";
$username = "root";
$password = "";
$databases = "online_course_db";

$conn = new mysqli($servername, $username, $password, $databases);

if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}
