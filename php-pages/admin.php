<?php
$con = mysqli_connect('localhost', 'root', '', 'htuGym', 3307);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if ($email == 'admin@gmail.com' && $password == 'admin') {
        $_SESSION['admin'] = true;
    } else {
        echo "<script>alert('Invalid credentials!');</script>";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit();
}

if (isset($_POST['add'])) {
    $table = $_POST['table'];
    $fields = array_keys($_POST);
    $values = array_values($_POST);
    
    unset($fields[array_search('table', $fields)]);
    unset($fields[array_search('add', $fields)]);
    unset($values[array_search($table, $values)]);
    unset($values[array_search('Add', $values)]);
    
    $field_list = implode(', ', $fields);
    $value_list = "'" . implode("', '", $values) . "'";
    
    $sql = "INSERT INTO $table ($field_list) VALUES ($value_list)";
    mysqli_query($con, $sql);
    header("Location: admin.php?table=$table");
    exit();
}

if (isset($_GET['delete'])) {
    $table = $_GET['table'];
    $id = $_GET['delete'];
    $sql = "DELETE FROM $table WHERE id = $id";
    mysqli_query($con, $sql);
    header("Location: admin.php?table=$table");
    exit();
}

$current_table = isset($_GET['table']) ? $_GET['table'] : 'users';
$result = mysqli_query($con, "SELECT * FROM $current_table");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - HTU GYM</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        h1 { color: #333; margin-bottom: 20px; }
        .login-box { max-width: 400px; margin: 100px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .login-box h2 { margin-bottom: 20px; color: #333; }
        .login-box input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; }
        .login-box button { width: 100%; padding: 10px; background: rgb(163, 230, 53); border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
        .nav { background: #333; padding: 15px; margin-bottom: 20px; }
        .nav a { color: white; text-decoration: none; margin-right: 20px; padding: 8px 15px; background: #555; border-radius: 4px; }
        .nav a:hover { background: rgb(163, 230, 53); color: black; }
        .logout { float: right; background: #d32f2f !important; }
        table { width: 100%; background: white; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #333; color: white; }
        .btn { padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-delete { background: #d32f2f; color: white; }
        .add-form { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .add-form input { padding: 8px; margin-right: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .add-form button { padding: 8px 20px; background: rgb(163, 230, 53); border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>

<?php if (!isset($_SESSION['admin'])): ?>
    <div class="login-box">
        <h2>Admin Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <p style="margin-top: 15px; color: #666; font-size: 14px;">Email: admin@gmail.com<br>Password: admin</p>
    </div>
<?php else: ?>
    <div class="nav">
        <a href="?table=users">Users</a>
        <a href="?table=plans">Plans</a>
        <a href="?table=courses">Courses</a>
        <a href="?table=classes">Classes</a>
        <a href="?table=coaches">Coaches</a>
        <a href="?table=user_plans">User Plans</a>
        <a href="?logout=1" class="logout">Logout</a>
    </div>

    <div class="container">
        <h1><?php echo ucfirst($current_table); ?> Management</h1>

        <div class="add-form">
            <h3>Add New <?php echo ucfirst(rtrim($current_table, 's')); ?></h3>
            <form method="POST">
                <input type="hidden" name="table" value="<?php echo $current_table; ?>">
                <?php
                $columns = mysqli_query($con, "SHOW COLUMNS FROM $current_table");
                while ($col = mysqli_fetch_assoc($columns)) {
                    if ($col['Field'] != 'id' && $col['Field'] != 'subscribed_at') {
                        echo '<input type="text" name="' . $col['Field'] . '" placeholder="' . ucfirst(str_replace('_', ' ', $col['Field'])) . '" required>';
                    }
                }
                ?>
                <button type="submit" name="add">Add</button>
            </form>
        </div>

        <table>
            <tr>
                <?php
                $columns = mysqli_query($con, "SHOW COLUMNS FROM $current_table");
                while ($col = mysqli_fetch_assoc($columns)) {
                    echo '<th>' . ucfirst(str_replace('_', ' ', $col['Field'])) . '</th>';
                }
                echo '<th>Actions</th>';
                ?>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                foreach ($row as $value) {
                    echo '<td>' . $value . '</td>';
                }
                echo '<td><a href="?table=' . $current_table . '&delete=' . $row['id'] . '" class="btn btn-delete" onclick="return confirm(\'Are you sure?\')">Delete</a></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
<?php endif; ?>

</body>
</html>
