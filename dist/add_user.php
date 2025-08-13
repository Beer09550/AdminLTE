<?php
require '../connect.php';
if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $filename = $_FILES['image']['name'];

    if (empty($username) || empty($password) || empty($fullname) || empty($phone) || empty($email)) {
        echo "<script>alert('Please enter all data');history.back();</script>";
    } else {
        $exit_username = mysqli_fetch_array($con->query("SELECT * FROM users"));
        if ($username == $exit_username['username']) {
            echo "<script>alert('This username already exists'); history.back();</script>";
        } else {
            move_uploaded_file($_FILES['image']['tmp_name'], 'assets/user_img/' .$filename);
            $sql = "INSERT INTO users(username,password,fullname,phone,email,image) 
                    VALUES('$username', '$password', '$fullname', '$phone', '$email','$filename')";
            $result = $con->query($sql);
            if (!$result) {
                echo "<script>alert('Error saving data'); history.back();</script>";
            } else {
                echo"<script>window.lacation.href='index.php?page=user_list'</script>";
            }
        }
    }
}
?>
<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">General Form</li>
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

            <!--begin::Col-->
            <div class="col-md-12">
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">Quick Example</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Username</label>
                                <input
                                    type="text"
                                    name="username"
                                    class="form-control"
                                    id="exampleInputEmail1"
                                    aria-describedby="emailHelp" />
                                <div id="emailHelp" class="form-text">
                                    User ต้องไม่ซ้ำกับคนอื่น
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">ชื่อ-นามสกุล</label>
                                <input type="text" name="fullname" class="form-control" id="exampleInputPassword1" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">เบอร์โทรศัพท์</label>
                                <input type="text" name="phone" class="form-control" id="exampleInputPassword1" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputPassword1" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">image</label>
                                <input type="file" name="image" class="form-control" id="exampleInputPassword1" />
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="save" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>

                    </form>

                </div>

            </div>


        </div>

    </div>

    </div>

</main>