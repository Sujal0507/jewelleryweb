<?php
require_once 'db_connection1.php';

function deleteProduct($collection, $productId) {
    $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($productId)]);
}

$products = $collection->find();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Diamond</title>
</head>
<body>
<link rel="stylesheet" href="css/manageproduct.css">
<?php include('anavbar.html'); ?>
<h1>Manage Diamond</h1>
<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price (₹)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['title']; ?>" width="100"></td>
                <td><?php echo $product['title']; ?></td>
                <td><?php echo $product['description']; ?></td>
                <td>₹<?php echo number_format($product['price'], 2); ?></td>
                <td>
                    <a href="editdiamond.php?id=<?php echo $product['_id']; ?>">Edit</a> |
                    <a href="managediamond.php?action=delete&id=<?php echo $product['_id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="adddiamond.php" target="_blank">Add New Product</a>
</body>
</html>
