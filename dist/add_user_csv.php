<?php
require '../connect.php';

// ตรวจสอบว่ามีไฟล์ถูกเลือก
if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0) {
    $uploadDir = __DIR__ . '/assets/user_csv/';

    // ถ้าโฟลเดอร์ยังไม่มี ให้สร้างขึ้นมา
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filename = basename($_FILES['csv_file']['name']);
    $filePath = $uploadDir . $filename;

    // ย้ายไฟล์ไปเก็บ
    if (move_uploaded_file($_FILES['csv_file']['tmp_name'], $filePath)) {
        if (($csv = fopen($filePath, "r")) !== false) {
            // อ่าน csv ทีละแถว
            while (($csvArr = fgetcsv($csv, 1000, ',')) !== false) {
                $username = $csvArr[0] ?? '';
                $password = $csvArr[1] ?? '';
                $fullname = $csvArr[2] ?? '';
                $phone    = $csvArr[3] ?? '';
                $email    = $csvArr[4] ?? '';

                $sql = "INSERT INTO users(username,password,fullname,phone,email) 
                        VALUES('$username','$password','$fullname','$phone','$email')";
                $result = $con->query($sql);

                if (!$result) {
                    echo "<script>alert('เพิ่มข้อมูลสำเร็จทั้งหมด $rows แถว') window.location.href='index.php?page=users_list'</script>";
                }
            }
            fclose($csv);

            echo "<script>window.location.href='index.php?page=users_list'</script>";
        } else {
            echo "ไม่สามารถเปิดไฟล์ CSV ได้";
        }
    } else {
        echo "อัปโหลดไฟล์ไม่สำเร็จ";
    }
} else {
    echo "<script>alert('กรุณาเลือกไฟล์ CSV ก่อนอัปโหลด')</script>";
}
