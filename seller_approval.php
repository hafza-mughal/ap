<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start session only if not already started
}
include("../includes/db.php"); // Ensure correct path


if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
?>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard / View Sellers
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-users fa-fw"></i> View Sellers
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Seller Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Approve</th>
                                <th>Reject</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $get_sellers = "SELECT * FROM sellers WHERE status = 'pending'";
                            $run_sellers = mysqli_query($con, $get_sellers);
                            while($row_sellers = mysqli_fetch_array($run_sellers)){
                                $seller_id = $row_sellers['id'];
                                $seller_name = $row_sellers['name'];
                                $seller_email = $row_sellers['email'];
                                $seller_phone = $row_sellers['phone'];
                                $seller_status = $row_sellers['status'];
                                $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $seller_name; ?></td>
                                <td><?php echo $seller_email; ?></td>
                                <td><?php echo $seller_phone; ?></td>
                                <td><?php echo ucfirst($seller_status); ?></td>
                                <td>
                                    <a href="seller_approval.php?approve_seller=<?php echo $seller_id; ?>" class="btn btn-success">Approve</a>
                                </td>
                                <td>
                                    <a href="seller_approval.php?reject_seller=<?php echo $seller_id; ?>" class="btn btn-danger">Reject</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}

if (isset($_GET['approve_seller'])) {
    include("../includes/db.php"); // Ensure correct connection
    $seller_id = $_GET['approve_seller'];
    $update_seller = "UPDATE sellers SET status='approved' WHERE id='$seller_id'";
    $run_update = mysqli_query($con, $update_seller);

    if ($run_update) {
        echo "<script>alert('Seller approved successfully!');</script>";
        echo "<script>window.location.href='index.php?view_sellers';</script>";
    }
}

if (isset($_GET['reject_seller'])) {
    include("../includes/db.php"); // Ensure correct connection
    $seller_id = $_GET['reject_seller'];
    $update_seller = "UPDATE sellers SET status='rejected' WHERE id='$seller_id'";
    $run_update = mysqli_query($con, $update_seller);

    if ($run_update) {
        echo "<script>alert('Seller rejected successfully!');</script>";
        echo "<script>window.location.href='index.php?seller_reject';</script>";
    }
}

?>
