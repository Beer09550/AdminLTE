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
    $filename = $_FILES['image']['name'];

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
            move_uploaded_file($_FILES['image']['tmp_name'], 'assets/user_img/' . $filename);

            $insert_sql = "INSERT INTO products (pro_name, pro_price, pro_amount, pro_status, image) VALUES (?, ?, ?, ?, ?)";
            $insert_stmt = $con->prepare($insert_sql);
            $insert_stmt->bind_param("sisss", $pro_name, $pro_price, $pro_amount, $pro_status, $filename);

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

<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Add Product</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">add_pro</li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::App Content Header-->
<!--begin::App Content-->
<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row g-4">
            <!--begin::Col-->
            <div class="col-md-6">
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">Add Product</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <!--begin::Body-->
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
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" id="exampleInputPassword1" />
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="save" class="btn btn-primary">Save Product</button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Quick Example-->
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::App Content-->