<?php
require '../connect.php';

// รับค่า pro_id จาก URL เพื่อใช้ดึงข้อมูล
$pro_id = $_GET['pro_id'] ?? '';

// ตรวจสอบว่า pro_id ถูกส่งมาหรือไม่
if (!empty($pro_id)) {
    $sql = "SELECT * FROM products WHERE pro_id = '$pro_id'";
    $result = $con->query($sql);
    $row = mysqli_fetch_array($result);
}

// เมื่อมีการกดปุ่มบันทึก
if (isset($_POST['save'])) {
    $pro_id     = $_POST['pro_id'];
    $pro_name   = $_POST['pro_name'];
    $pro_price  = $_POST['pro_price'];
    $pro_amount = $_POST['pro_amount'];
    $pro_status = $_POST['pro_status'];

    // ตรวจสอบค่าว่าง
    if (empty($pro_id) || empty($pro_name) || empty($pro_price) || empty($pro_amount) || empty($pro_status)) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน'); history.back();</script>";
    } else {
        // อัปเดตข้อมูลสินค้า
        $sql = "UPDATE products
            SET pro_name='$pro_name',
                pro_price='$pro_price',
                pro_amount='$pro_amount',
                pro_status='$pro_status'
            WHERE pro_id='$pro_id'";

        if ($con->query($sql)) {
            echo "<script>alert('อัปเดตข้อมูลสินค้าสำเร็จ ✅'); window.location.href='index.php?page=product';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล ❌'); history.back();</script>";
        }
    }
}
?>
<!--begin::App Content Header--><!--begin::App Content Header-->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">𝐄𝐝𝐢𝐭 𝐏𝐫𝐨𝐝𝐮𝐜𝐭𝐬 🎈</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">edit_pro</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--end::App Content Header-->

<!--begin::App Content-->
<div class="app-content">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <div class="card-title">แก้ไขข้อมูลสินค้า 🖋</div>
                    </div>

                    <form action="" method="post">
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">❗ Products ID (ไม่สามารถแก้ไขได้) 🔒</label>
                                <input type="text" class="form-control" name="pro_id" value="<?php echo $row['pro_id'] ?? ''; ?>" disabled />
                                <div class="form-text">รหัสสินค้าจะต้องไม่ซ้ำกัน (Products ID must be unique.)</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Products Name</label>
                                <input type="text" name="pro_name" class="form-control" value="<?php echo $row['pro_name'] ?? ''; ?>" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Products Price</label>
                                <input type="text" name="pro_price" class="form-control" value="<?php echo $row['pro_price'] ?? ''; ?>" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Products Amount</label>
                                <input type="number" name="pro_amount" class="form-control" value="<?php echo $row['pro_amount'] ?? ''; ?>" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Status</label><br />
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pro_status" id="in_stock" value="In stock"
                                        <?php if (($row['pro_status'] ?? '') == 'Active') echo 'checked'; ?> />
                                    <label class="form-check-label" for="in_stock">In stock</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pro_status" id="not_in_stock" value="Not in stock"
                                        <?php if (($row['pro_status'] ?? '') == 'Inactive') echo 'checked'; ?> />
                                    <label class="form-check-label" for="not_in_stock">Not in stock</label>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success" name="save">บันทึกข้อมูล</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!--end::App Content-->