<?php
include 'koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM materi WHERE materi_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    header('Location: index.php');
    exit();
} else {
    echo "Error: " . $stmt->error;
}
?>
