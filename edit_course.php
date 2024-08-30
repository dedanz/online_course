<?php
include 'koneksi.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['judul_kur'];
    $description = $_POST['deskripsi'];
    $duration = $_POST['durasi'];

    $sql = "UPDATE kursus SET judul_kur = ?, deskripsi = ?, durasi = ? WHERE kursus_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssii', $title, $description, $duration, $id);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$sql = "SELECT * FROM kursus WHERE kursus_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$course = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Course</title>

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Edit Course</h1>
        <form method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="judul" value="<?php echo htmlspecialchars($course['judul_kur']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="deskripsi" required><?php echo htmlspecialchars($course['deskripsi']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="duration">Duration (hours)</label>
                <input type="number" class="form-control" id="duration" name="durasi" value="<?php echo htmlspecialchars($course['durasi']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Course</button>
        </form>
    </div>
</body>

</html>
