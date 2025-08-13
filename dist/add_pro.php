<?php
// --- PHP FORM PROCESSING ---
// This block should be at the VERY TOP of your file, before any HTML.

require '../connect.php';

// Initialize message variables
$success_message = '';
$error_message = '';

// Check if the form was submitted by checking for the 'save' button's name
if (isset($_POST['save'])) {
    $pro_name = $_POST['pro_name'];
    $pro_price = $_POST['pro_price'];
    $pro_amount = $_POST['pro_amount'];
    $pro_status = $_POST['pro_status'];


    // --- 1. VALIDATION ---
    if (empty($pro_name) || empty($pro_price) || empty($pro_amount)) {
        $error_message = 'Please enter all data.';
    } else {
        // --- 2. CHECK FOR EXISTING PRODUCT NAME (optional, remove if not needed) ---
        $stmt = $con->prepare("SELECT pro_name FROM products WHERE pro_name = ?");
        $stmt->bind_param("s", $pro_name);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Product name already exists
            $error_message = 'This product name is already taken.';
        } else {
            // --- 3. INSERT NEW PRODUCT (Secure way) ---
            $insert_sql = "INSERT INTO products (pro_name, pro_price, pro_amount, pro_status) VALUES (?, ?, ?, ?)";
            $insert_stmt = $con->prepare($insert_sql);
            $insert_stmt->bind_param("siss", $pro_name, $pro_price, $pro_amount, $pro_status);

            if ($insert_stmt->execute()) {
                $success_message = 'Product added successfully!';
            } else {
                $error_message = 'Failed to save data. Please try again.';
            }
            $insert_stmt->close();
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <!-- Add your CSS links for AdminLTE here -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-alpha.1/dist/css/adminlte.min.css">
</head>

<body>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar content would go here -->
    </aside>

    <div class="app-wrapper">
        <main class="app-main p-3">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Add Product</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">

                    <!-- Display Success or Error Messages Here -->
                    <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>


                    <div class="card card-primary mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Add Product Form</h3>
                        </div>
                        <!-- The form action is empty to submit to the same page -->
                        <form action="" method="post">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="pro_name">Product Name</label>
                                    <input type="text" class="form-control" id="pro_name" name="pro_name" placeholder="Enter product name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pro_price">Price</label>
                                    <input type="number" class="form-control" id="pro_price" name="pro_price" placeholder="Enter price" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pro_amount">Amount</label>
                                    <input type="number" class="form-control" id="pro_amount" name="pro_amount" placeholder="Enter amount" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="radio" class="form-check-input" id="in_stock" name="pro_status" value="Active" checked>
                                    <label class="form-check-label" for="in_stock">In stock</label>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="radio" class="form-check-input" id="not_in_stock" name="pro_status" value="Inactive">
                                    <label class="form-check-label" for="not_in_stock">Not in stock</label>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="save" class="btn btn-primary">Save Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Add your JS links for AdminLTE and Bootstrap here -->
</body>

</html>