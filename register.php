<?php
include('includes/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $collection->insertOne([
        'username' => $username,
        'password_hash' => $password,
        'email' => $email,
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ]);

    header('Location: login.php');
    exit();
}
?>

<?php include('includes/header.php'); ?>
<div class="register-container">
    <form action="register.php" method="post">
        <h2>Register</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
</div>
<?php include('includes/footer.php'); ?>
