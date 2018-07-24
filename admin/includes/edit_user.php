<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 07/05/2018
 * Time: 04:05
 */
?>

<?php

if(isset($_GET['edit_user'])) {

    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id "; // LIMIT 3 PODE COLOCAR LIMITE NA ROW
    $select_users_query = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($select_users_query)) {
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


    if (isset($_POST['edit_user'])) {
        global $con;

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];


        if (!empty($user_password)) {

            $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
            $get_user_query = mysqli_query($con, $query_password);
            testQuery($get_user_query);


            $row = mysqli_fetch_array($get_user_query);

            $db_user_password = $row['user_password'];

            if ($db_user_password != $user_password) {

                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
            }

            $query = "UPDATE users SET user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_role = '$user_role', username = '$username', user_email = '$user_email', user_password = '{$hashed_password}' WHERE user_id = {$user_id} ";

            $edit_user_query = mysqli_query($con, $query);

            testQuery($edit_user_query);

            // verificar pq tem erro aqui <<<
            echo "<p class='alert-success'>User Updated. <a href='users.php?source=edit_user&edit_user={$user_id}'>View User</a> or <a href='users.php'>Edit More Users</a></p>";

        }


    }

} else {

    header("Location: index.php");



}

?>

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

        <select name="user_role" id="">

            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

            <?php

            if($user_role == 'admin') {

                echo "<option value='subscriber'>subscriber</option>";

            } else {

                echo "<option value='admin'>admin</option>";


            }

            ?>

        </select>



    </div>



    <!--        <div class="form-group">-->
    <!--            <label for="post_image">Post Image</label>-->
    <!--            <input type="file"  name="image">-->
    <!--        </div>-->


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
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User !">
    </div>


</form>
