<?php
require 'vendor/autoload.php'; // Assuming you have MongoDB PHP library installed via Composer

$client = new MongoDB\Client("mongodb+srv://<username>:<password>@cluster0.mongodb.net/<dbname>?retryWrites=true&w=majority");

$collection = $client->fabric_distribution_db->Users; // Default to Users collection, can be changed dynamically
?>
