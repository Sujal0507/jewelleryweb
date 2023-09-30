<?php
// Include the TCPDF library for PDF generation
require 'vendor/tecnickcom/tcpdf/tcpdf.php';

// Retrieve the billId and username from the query string
$billId = $_GET['billId'];
$username = $_GET['username'];

// Function to generate and serve the PDF
function generateAndServePDF($billId, $username, $cartData) {
    // Create a new TCPDF instance
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator('5ive Jewellers');
    $pdf->SetAuthor('5ive Jewellers');
    $pdf->SetTitle('Invoice');
    $pdf->SetSubject('Invoice');
    $pdf->SetKeywords('Invoice, 5ive Jewellers');

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Title
    $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');

    // Bill ID and Username
    $pdf->Cell(0, 10, 'Bill ID: ' . $billId, 0, 1);
    $pdf->Cell(0, 10, 'Username: ' . $username, 0, 1);

    // Table headers
    $pdf->SetFillColor(200, 200, 200);
    $pdf->Cell(40, 10, 'Product', 1, 0, 'C', 1);
    $pdf->Cell(30, 10, 'Price', 1, 0, 'C', 1);
    $pdf->Cell(20, 10, 'Quantity', 1, 0, 'C', 1);
    $pdf->Cell(40, 10, 'Total', 1, 1, 'C', 1);

    // Loop through cart data and populate the table
    foreach ($cartData as $cartItem) {
        $product = $cartItem["title"];
        $price = $cartItem["price"];
        $quantity = $cartItem["quantity"];
        $subtotal = $price * $quantity;

        $pdf->Cell(40, 10, $product, 1);
        $pdf->Cell(30, 10, '₹ ' . number_format($price, 2), 1);
        $pdf->Cell(20, 10, $quantity, 1);
        $pdf->Cell(40, 10, '₹ ' . number_format($subtotal, 2), 1, 1);
    }

    // Calculate and display the total
    $total = array_reduce($cartData, function ($carry, $item) {
        return $carry + ($item["price"] * $item["quantity"]);
    }, 0);

    $pdf->Cell(90, 10, 'Total', 1);
    $pdf->Cell(40, 10, '₹ ' . number_format($total, 2), 1, 1);

    // Output the PDF for download
    $pdf->Output('bill.pdf', 'D');
}

// Sample cart data - Replace this with your actual cart data
$cartData = [
    ["title" => "Product 1", "price" => 10.00, "quantity" => 2],
    ["title" => "Product 2", "price" => 15.00, "quantity" => 3],
];

// Call the function to generate and serve the PDF
generateAndServePDF($billId, $username, $cartData);
?>
