<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 09/05/2018
 * Time: 01:19
 */
?>

<?php include "includes/header.php";
      include "admin/functions.php";
      include "includes/db.php";
?>





<!-- Navigation -->


<?php require_once "includes/navigation.php"; ?>



<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->



        <div class="col-md-8">

            <?php


           if(isset($_GET['category'])) {

               $post_category_id = $_GET['category'];

               if(isset($_SESSION['username']) && is_admin($_SESSION['username'])){

                   $stmt1 = mysqli_prepare($con, "SELECT post_id, post_title, post_user, post_date, post_image, post_content FROM posts WHERE post_category_id = ?");


               } else {

                   $stmt2 = mysqli_prepare($con, "SELECT post_id, post_title, post_user, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ? ");

                   $published = 'published';

               }




            if(isset($stmt1)) {


                   mysqli_stmt_bind_param($stmt1, "i", $post_category_id);

                   mysqli_stmt_execute($stmt1);

                   mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_user, $post_date, $post_image, $post_content);

                   $stmt = $stmt1;

            } else {

                    mysqli_stmt_bind_param($stmt2, "is", $post_category_id,$published);

                    mysqli_stmt_execute($stmt2);

                    mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_user, $post_date, $post_image, $post_content);

                    $stmt = $stmt2;

            }





//            if(mysqli_stmt_num_rows($stmt) === 0 ) {
//
//                echo "<h1 class='text-center'>No Posts Available</h1>";
//
//
//
//            }



            while(mysqli_stmt_fetch($stmt)) {

                ?>


                <!-- First Blog Post -->
            <h1 class="page-header">
                <?php  ?>
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_user ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?> " alt="">
                <hr>
                <p><?php echo $post_content?></p>

                <hr>









            <?php } } else {

               header("Locations: index.php");

           } ?>




        </div>



        <!-- Blog Sidebar Widgets Column -->




        <?php include "includes/sidebar.php"; ?>






    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">


                <?php include "includes/footer.php"; ?>

