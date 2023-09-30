<?php
require_once __DIR__ . '/vendor/autoload.php';


$client = new MongoDB\Client("mongodb://localhost:27017");


$db = $client->five_Jewellers;
$collection = $db->contact_forms;


function getAllContacts($collection) {
    return $collection->find();
}

function deleteContact($collection, $contactId) {
    $result = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($contactId)]);
    return $result->getDeletedCount() > 0;
}


if (isset($_GET['delete'])) {
    $contactId = $_GET['delete'];
    if (deleteContact($collection, $contactId)) {
        echo "<script>alert('Contact deleted successfully');</script>";
    } else {
        echo "<script>alert('Contact deletion failed');</script>";
    }
}


$contacts = getAllContacts($collection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Contact Management - Admin</title>
    <link rel="stylesheet" href="css/admincontact.css">
</head>

<body>
<?php include('anavbar.html');
?>
   <center>
    <main>
        <section class="admin">
            <div class="container">
                <h2>Customer's Contacts</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact) : ?>
                            <tr>
                                <td><?= $contact['_id'] ?></td>
                                <td><?= $contact['first_name'] ?></td>
                                <td><?= $contact['last_name'] ?></td>
                                <td><?= $contact['email'] ?></td>
                                <td><?= $contact['message'] ?></td>
                                <td>
                                    <a href="?delete=<?= $contact['_id'] ?>" onclick="return confirm('Are you sure you want to delete this contact?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    </center>
</body>
</html>
