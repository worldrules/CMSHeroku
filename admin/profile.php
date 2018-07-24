<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 15/05/2018
 * Time: 23:58
 */
?>

<?php include "includes/adm_header.php"; ?>

<?php

if(isset($_SESSION['username'])) {

$username = $_SESSION['username'];

$query = "SELECT * FROM users WHERE username = '{$username}' ";

$select_user_profile = mysqli_query($con, $query);

while($row = mysqli_fetch_array($select_user_profile)) {
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
    $user_image = $row['user_image'];
}

}

?>

<?php

if(isset($_POST['edit_user'])) {
    global $con;

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];


//        $post_image = $_FILES['image']['name'];
//        $post_image_temp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
//        $post_date = date('d-m-y');



//            move_uploaded_file($post_image_temp, "../images/$post_image");
//
    $query = "UPDATE users SET user_firstname = '$user_firstname', user_lastname = '$user_lastname', username = '$username', user_email = '$user_email', user_password = '$user_password' WHERE username = '{$username}' ";

    $edit_user_query = mysqli_query($con, $query);

    testQuery($edit_user_query);

}


?>







<div id="wrapper">

    <!-- Navigation -->

    <?php include "includes/adm_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        CMS
                        <small>Users</small>
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="title">Firstname</label>
                            <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="">Lastname</label>
                            <input type="text" value="<?php echo $user_lastname; ?>"  class="form-control" name="user_lastname">
                        </div>



                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" value="<?php echo $username; ?>"  class="form-control" name="username">

                        </div>

                        <div class="form-group">
                            <label for="user email">Email</label>
                            <input type="email" value="<?php echo $user_email; ?>"  class="form-control" name="user_email">

                        </div>

                        <div class="form-group">
                            <label for="user password">Password</label>
                            <input autocomplete="off" type="password" class="form-control" name="user_password">

                        </div>




                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile !">
                        </div>


                    </form>

                </div>
            </div>


            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/adm_footer.php" ?>



