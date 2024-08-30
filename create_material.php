<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['kursus_id'];
    $title = $_POST['judul_mat'];
    $description = $_POST['deskripsi'];
    $embed_link = $_POST['link_embed'];

    $sql = "INSERT INTO materi (kursus_id, judul_mat, deskripsi, link_embed) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isss', $course_id, $title, $description, $embed_link);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$sql = "SELECT * FROM kursus";
$courses_result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Create Material</title>

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Create Material</h1>
        <form method="POST">
            <div class="form-group">
                <label for="course_id">Course</label>
                <select class="form-control" id="course_id" name="kursus_id" required>
                    <?php while($course = $courses_result->fetch_assoc()): ?>
                        <option value="<?php echo $course['kursus_id']; ?>"><?php echo htmlspecialchars($course['judul_kur']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="judul_mat" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="embed_link">Embed Link</label>
                <input type="text" class="form-control" id="embed_link" name="link_embed" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Material</button>
        </form>
    </div>
</body>

</html>
