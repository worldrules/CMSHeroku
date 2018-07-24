<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 07/05/2018
 * Time: 03:54
 */



?>

<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>


    </tr>
    </thead>
    <tbody>

    <?php

    $query = "SELECT * FROM users "; // LIMIT 3 PODE COLOCAR LIMITE NA ROW
    $select_users = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];


        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$username}</td>";


//
//        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}  "; // LIMIT 3 PODE COLOCAR LIMITE NA ROW
//        $select_categories_id = mysqli_query($con, $query);
//
//        while($row = mysqli_fetch_assoc($select_categories_id)) {
//            $cat_id = $row['cat_id'];
//            $cat_title = $row['cat_title'];
//
//            echo "<td>{$cat_title}</td>";
//        }

        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td>{$user_role}</td>";


//        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
//        $select_post_id_query = mysqli_query($con, $query);
//
//        while ($row = mysqli_fetch_assoc($select_post_id_query)) {
//
//            $post_id = $row['post_id'];
//            $post_title = $row['post_title'];
//
//            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
//
//        }








        echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
        echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</a></td>";
        echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'>Edit</a></td>";
        echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
        echo "</tr>";




    }


    ?>




    </tbody>
</table>



<?php
// query para passar o user para admin

if(isset($_GET['change_to_admin'])) {

    $the_user_id = $_GET['change_to_admin'];

    $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = '$the_user_id' ";
    $change_to_admin_query = mysqli_query($con, $query);
    header("Location: users.php");
}


//------------------------------------------------------------------------------------------------------------------//
// query para passar o user para subscriber
if(isset($_GET['change_to_sub'])) {


    $the_user_id = $_GET['change_to_sub'];

    $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = '$the_user_id' ";
    $change_to_sub_query= mysqli_query($con, $query);
    header("Location: users.php");
}



//------------------------------------------------------------------------------------------------------------------//
// query para deletar um comentario

if(isset($_GET['delete'])) {

    if(isset($_SESSION['user_role'])) {

        if ($_SESSION['user_role'] == 'admin') {



        $the_user_id = mysqli_real_escape_string($con, $_GET['delete']);

        $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
        $delete_user_query = mysqli_query($con, $query);
        header("Location: users.php");
       }

    }
}

?>

