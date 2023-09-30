<?php
require_once 'db_connection.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    
    // Retrieve the product details based on the _id
    $product = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($productId)]);
    
    if (!$product) {
        echo "Product not found.";
        exit;
    }
    
    // Handle form submission for updating the product
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get updated product data from the form
        $updatedProduct = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'price' => (float)$_POST['price'],
            // Add other fields as needed
        ];
        
        // Update the product in the database
        $result = $collection->updateOne(['_id' => new MongoDB\BSON\ObjectId($productId)], ['$set' => $updatedProduct]);
        
        if ($result->getModifiedCount() > 0) {
            header('Location: manageproduct.php');
            exit;
        } else {
            echo "Failed to update the product.";
        }
    }
} else {
    echo "Product ID not provided.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Gold</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }

        .edit-form-container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .edit-form-container h1 {
            text-align: center;
        }

        .edit-form-container label {
            display: block;
            margin-top: 10px;
        }

        .edit-form-container input[type="text"],
        .edit-form-container textarea,
        .edit-form-container input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .edit-form-container input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .edit-form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include('anavbar.html'); ?>
<div class="edit-form-container">
    <h1>Edit Gold</h1>
    <form method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $product['title']; ?>" required><br>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo $product['description']; ?></textarea><br>
        
        <label for="price">Price (₹):</label>
        <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" step="0.01" required><br>
        
        <!-- Add fields for other product details as needed -->
        
        <input type="submit" value="Update Product">
    </form>
</div>
</body>
</html>
