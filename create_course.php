<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['judul_kur'];
    $description = $_POST['deskripsi'];
    $duration = $_POST['durasi'];

    $sql = "INSERT INTO kursus (judul_kur, deskripsi, durasi) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $title, $description, $duration);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Create Course</title>

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Create Course</h1>
        <form method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="judul_kur" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="duration">Duration (hours)</label>
                <input type="number" class="form-control" id="duration" name="durasi" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Course</button>
        </form>
    </div>
</body>

</html>
