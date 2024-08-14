<?php
include('../includes/db_connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fabric_type = $_POST['fabric_type'];
    $source = $_POST['source'];
    $cost_price = $_POST['cost_price'];
    $currency = $_POST['currency'];
    $notes = $_POST['notes'];

    $collection->insertOne([
        'fabric_type' => $fabric_type,
        'source' => $source,
        'cost_price' => floatval($cost_price),
        'currency' => $currency,
        'notes' => $notes,
        'created_by' => $_SESSION['user_id'],
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ]);

    header('Location: cost-price.php?success=true');
    exit();
}
?>

<?php include('../includes/header.php'); ?>
<div class="container">
    <h2>Cost Price Data Collection</h2>
    <form action="cost-price.php" method="post">
        <input type="text" name="fabric_type" placeholder="Fabric Type" required>
        <input type="text" name="source" placeholder="Source" required>
        <input type="number" step="0.01" name="cost_price" placeholder="Cost Price" required>
        <input type="text" name="currency" placeholder="Currency" required>
        <textarea name="notes" placeholder="Additional Notes"></textarea>
        <button type="submit">Save</button>
    </form>
    <?php if (isset($_GET['success'])) echo "<p>Data saved successfully!</p>"; ?>
</div>
<?php include('../includes/footer.php'); ?>
