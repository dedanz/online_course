<?php
include 'koneksi.php';

// Ambil data kursus
$courses_sql = "SELECT * FROM kursus";
$courses_result = $conn->query($courses_sql);

// Ambil data materi
$materials_sql = "SELECT * FROM materi";
$materials_result = $conn->query($materials_sql);

if (!$courses_result || !$materials_result) {
    die("Query failed: " . $conn->error);
}

$courses_count = $courses_result->num_rows;
$materials_count = $materials_result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Online Course Dashboard</title>

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Online Course</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Components -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="create_course.php">
                    <i class="fas fa-fw fa-plus"></i>
                    <span>Create Course</span>
                </a>
            </li>

            <!-- Nav Item - Utilities -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="create_material.php">
                    <i class="fas fa-fw fa-plus"></i>
                    <span>Create Material</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Total Courses Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Courses</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $courses_count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Materials Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Materials</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $materials_count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-folder-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Courses List -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="text-gray-800">Courses</h4>
                            <ul class="list-group">
                                <?php while($course = $courses_result->fetch_assoc()): ?>
                                    <li class="list-group-item">
                                        <h5><?php echo htmlspecialchars($course['judul_kur']); ?></h5>
                                        <p><?php echo htmlspecialchars($course['deskripsi']); ?></p>
                                        <p><strong>Duration:</strong> <?php echo htmlspecialchars($course['durasi']); ?> hours</p>
                                        <a href="edit_course.php?id=<?php echo $course['kursus_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete_course.php?id=<?php echo $course['kursus_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Materials List -->
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <h4 class="text-gray-800">Materials</h4>
                            <ul class="list-group">
                                <?php while($material = $materials_result->fetch_assoc()): ?>
                                    <li class="list-group-item">
                                        <h5><?php echo htmlspecialchars($material['judul_mat']); ?></h5>
                                        <p><?php echo htmlspecialchars($material['deskripsi']); ?></p>
                                        <p><a href="<?php echo htmlspecialchars($material['link_embed']); ?>" target="_blank">View Material</a></p>
                                        <a href="edit_material.php?id=<?php echo $material['materi_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete_material.php?id=<?php echo $material['materi_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Online Course <?php echo date("Y"); ?></span>
                    </div>
                </div>
            </footer>

        </div>
    </div>

</body>

</html>

<?php
$conn->close();
?>
