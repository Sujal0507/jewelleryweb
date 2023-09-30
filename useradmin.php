<?php
require_once __DIR__ . '/vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");


$db = $client->five_Jewellers;
$collection = $db->users;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["remove"])) {
    $emailToRemove = $_GET["remove"];
    $result = $collection->deleteOne(["email" => $emailToRemove]);

    if ($result->getDeletedCount() > 0) {
        echo "<script>alert('User removed successfully');</script>";
    } else {
        echo "<script>alert('User removal failed');</script>";
    }
}


$users = $collection->find();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Administration</title>
    <link rel="stylesheet" href="css/useradmin.css">
</head>
<body>
<?php include('anavbar.html');
?>
    <div class="container">
        <h2>5ive Customers</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user["name"] ?></td>
                    <td><?= $user["email"] ?></td>
                    <td><a href="?remove=<?= $user["email"] ?>">Remove</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="home.php">Go back</a>
    </div>
</body>
</html>
