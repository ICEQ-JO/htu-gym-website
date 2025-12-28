<?php
$con = mysqli_connect('localhost', 'root', '', 'htuGym', 3307);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$action = isset($_GET['action']) ? $_GET['action'] : '';
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 1;

if ($action == 'add' && isset($_GET['plan_id'])) {
    $plan_id = $_GET['plan_id'];
    $sql = "INSERT INTO user_plans (user_id, plan_id) VALUES ($user_id, $plan_id)";
    
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Plan added successfully!'); window.location.href='dashboard.php?user_id=$user_id';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM user_plans WHERE id = $id";
    
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Plan removed successfully!'); window.location.href='dashboard.php?user_id=$user_id';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}

$sql = "SELECT user_plans.id as up_id, plans.* FROM plans 
        JOIN user_plans ON plans.id = user_plans.plan_id 
        WHERE user_plans.user_id = $user_id";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>My Dashboard - HTU GYM</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-black py-3">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center gap-2" href="../html-pages/index.html">
                <div class="bg-neon rounded-2 d-flex justify-content-center align-items-center" style="width: 35px; height: 35px;">
                    <i class="bi bi-dumbbell text-black"></i>
                </div>
                <span class="text-white fw-bold brand-italic fs-4 htu-logo">H.T.U <span class="text-neon">GYM</span></span>
            </a>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="../html-pages/index.html">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="../html-pages/classes.html">CLASSES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="../html-pages/about.html">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="../html-pages/community.html">COMMUNITY</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-4">
                    <a href="dashboard.php?user_id=<?php echo $user_id; ?>" class="btn bg-neon text-black rounded-pill fw-bold px-4">My Dashboard</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="dashboard-container">
        <h1>My <span>Plans</span></h1>
        <p class="dashboard-intro">Manage your membership plans</p>

        <div class="plans-grid">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="plan-card">';
                    echo '<h3>' . $row['plan_title'] . '</h3>';
                    echo '<h2>$' . $row['price'] . '</h2>';
                    echo '<p>' . $row['plan_desc'] . '</p>';
                    echo '<a href="dashboard.php?action=delete&id=' . $row['up_id'] . '&user_id=' . $user_id . '" class="delete-btn">Remove Plan</a>';
                    echo '</div>';
                }
            } else {
                echo '<p class="no-plans">You have no plans yet. <a href="../html-pages/classes.html">Browse Plans</a></p>';
            }
            ?>
        </div>
    </div>

    <footer>
        <div class="footer-left-side">
            <h3>H.T.U GYM</h3>
            <p>Empowering individuals through martial arts and fitness.</p>
        </div>
        <div class="footer-right-side">
            <h3>CONTACT US</h3>
            <p>LOCATION : AMMAN - MARJ AL HAMAM</p>
            <p>PHONE NUMBER : 0796019270</p>
            <p>EMAIL : 23110333@htu.edu.jo</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
