<?php
include 'koneksi.php';

$id = $_GET['id'];

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['judul_mat'];
    $description = $_POST['deskripsi'];
    $embed_link = $_POST['link_embed'];

    // Query update untuk materi
    $sql = "UPDATE materi SET judul_mat = ?, deskripsi = ?, link_embed = ? WHERE materi_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare gagal: " . $conn->error);
    }
    $stmt->bind_param('sssi', $title, $description, $embed_link, $id);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Query untuk mendapatkan materi
$sql = "SELECT * FROM materi WHERE materi_id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare gagal: " . $conn->error);
}
$stmt->bind_param('i', $id);
$stmt->execute();
$material = $stmt->get_result()->fetch_assoc();

if (!$material) {
    die("Material not found.");
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

    <title>Edit Material</title>

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Edit Material</h1>
        <form method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="judul_mat" value="<?php echo htmlspecialchars($material['judul_mat']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="deskripsi" required><?php echo htmlspecialchars($material['deskripsi']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="embed_link">Embed Link</label>
                <input type="text" class="form-control" id="embed_link" name="link_embed" value="<?php echo htmlspecialchars($material['link_embed']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Material</button>
        </form>
    </div>
</body>

</html>

<?php
$conn->close();
?>
