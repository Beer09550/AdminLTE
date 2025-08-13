<?php

require '../connect.php';
$sql = "SELECT * FROM products";
$result = $con->query($sql);

?>
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">product</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">product</li>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Bordered Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="index.php?page=add_pro" class="btn btn-success  mb-4">+add product</a>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">pro_id</th>
                                        <th>pro_name</th>
                                        <th>pro_price</th>
                                        <th>pro_amount	</th>
                                        <th>pro_status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        <?php
                                        while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                            <td><?php echo $row['pro_id']?></td>
                                            <td><?php echo $row['pro_name'] ?></td>
                                            <td><?php echo $row['pro_price'] ?></td>
                                            <td><?php echo $row['pro_amount'] ?></td>
                                            <td><?php echo $row['pro_status'] ?></td>
                                            <td>
                                                <a href="index.php?page=edit_pro&pro_id=<?php echo $row ['pro_id'] ?>" class="btn btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="index.php?page=del_pro&pro_id=<?php echo $row ['pro_id'] ?>" class="btn btn-danger" onclick="return confirm('Confirm on Delete')" >
                                                <i class="bi bi-trash3"></i>
                                                </a>
                                            </td>

                                    </tr>
                                <?php
                                        }
                                ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-end">
                                <li class="page-item">
                                    <a class="page-link" href="#">&laquo;</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">&raquo;</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>