<?php
include('includes/db_connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $collection->findOne(['username' => $username]);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['_id'];
        header('Location: index.php');
        exit();
    } else {
        $error = "Invalid credentials";
    }
}
?>

<?php include('includes/header.php'); ?>
<div class="login-container">
    <form action="login.php" method="post">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </form>
</div>
<?php include('includes/footer.php'); ?>
