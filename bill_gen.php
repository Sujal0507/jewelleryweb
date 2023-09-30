<?php
session_start();

// Include the MongoDB PHP library (make sure you have it installed)
require 'vendor/autoload.php';

use MongoDB\Client as MongoClient;

// Set the timezone to Indian Standard Time (IST)
date_default_timezone_set('Asia/Kolkata');

// MongoDB connection setup
$mongoClient = new MongoClient("mongodb://localhost:27017");
$db = $mongoClient->selectDatabase('five_Jewellers');
$collection = $db->selectCollection('bills');

// Function to delete a bill
function deleteBill($billId, $collection) {
    $result = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($billId)]);

    if ($result->getDeletedCount() > 0) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_bill"])) {
    $billIdToDelete = $_POST["bill_id"];

    if (deleteBill($billIdToDelete, $collection)) {
        // Bill deleted successfully, you can add a success message here if needed
    } else {
        // Failed to delete the bill, you can handle this case as needed
    }
}

// Query MongoDB to fetch all bills
$billsCursor = $collection->find();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | 5ive</title>
    <link rel="stylesheet" href="css/bill.css">
</head>
<body>
    <?php include('anavbar.html');?>
    <h1>Bill Generated</h1>
    <div class="bill-container">
        <table>
            <thead>
                <tr>
                    <th>Bill ID</th>
                    <th>Username</th>
                    <th>Total</th>
                    <th>Timestamp</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($billsCursor as $bill) { ?>
                    <tr>
                        <td><?= $bill['_id'] ?></td>
                        <td><?= $bill['username'] ?></td>
                        <td>₹ <?= $bill['total'] ?></td>
                        <td><?= date('Y-m-d H:i:s', $bill['timestamp']->toDateTime()->getTimestamp()) ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="bill_id" value="<?= $bill['_id'] ?>">
                                <button type="submit" name="delete_bill" class="delete-button">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
