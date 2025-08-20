<?php
require '../connect.php';

$filename = $_FILES['csv_file']['name'];
move_uploaded_file($_FILES['csv_file']['tmp_name'], 'assets/product_csv/' . $filename);

$csv = fopen("assets/product_csv/" . $filename, "r");

while ($csvArr = fgetcsv($csv, 1000, ',')) {
    $pro_name   = $csvArr[0];
    $pro_price  = $csvArr[1];
    $pro_amount = $csvArr[2];
    $pro_status = $csvArr[3];

    $sql = "INSERT INTO products (pro_name, pro_price, pro_amount, pro_status) 
            VALUES('$pro_name','$pro_price','$pro_amount','$pro_status')";
    $result = $con->query($sql);

    if (!$result) {
        // แสดง error ออกมาชัดเจน
        die("❌ INSERT ERROR: " . $con->error . "<br>SQL: " . $sql);
    }
    $rows++;
}

fclose($csv);

echo "<script>alert('เพิ่มข้อมูลสำเร็จทั้งหมด $rows แถว'); window.location.href='index.php?page=product'</script>";
?>