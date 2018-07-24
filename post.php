<?php include "includes/header.php"; ?>

<?php include "admin/functions.php"; ?>




<!-- Navigation -->


<?php require_once "includes/navigation.php"; ?>



<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->



        <div class="col-md-8">

            <?php

            if(isset($_GET['p_id'])) {

                $the_post_id = $_GET['p_id'];


                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id ";
                $send_query = mysqli_query($con, $view_query);

                if(!$send_query) {

                    die("Query Failed");
                }

                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin' ) {

                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";


                } else {


                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND  post_status = 'published'";

                }


            $select_all_posts_query = mysqli_query($con, $query);


            if(mysqli_num_rows($select_all_posts_query) < 1 ) {

                echo "<h1 class='text-center'>No Posts Available</h1>";


            } else {


            while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id= $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date= $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

                ?>


                <!-- First Blog Post -->
                 <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?> " alt="">
                <hr>
                <p><?php echo $post_content?></p>

                <hr>




            <?php }





            ?>

            <!-- Blog Comments -->

            <?php
//query que Cria o comentario se ele tiver sido setado , e executa a query no finalzinho ele testa se a query funfa
            if(isset($_POST['create_comment'])) {

                $the_post_id = $_GET['p_id'];

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date )";
                    $query.= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                    $create_comment_query = mysqli_query($con, $query);


                    testQuery($create_comment_query);




                    //------------------------------------------------------------------------------------------------------------------//
//query para fazer update no post, e aumentar a quantidade de comentarios e atualizar
//                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
//                    $query .= "WHERE post_id = $the_post_id " ;
//                    $update_comment_count = mysqli_query($con, $query);






                } else {

                    echo "<script>alert('Fields Cannot be Empty')</script>";



                }

                }







            ?>


            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">

                    </div>


                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" name="comment_author" class="form-control" name="text comment_author">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                    <input type="email" name="comment_email"  class="form-control" name="text comment_email">
                    </div>
                    <div class="form-group">
                        <label for="Comment">Your Comment</label>
                    <textarea name="comment_content" class="form-control" rows="3" class="form-control"></textarea>
                    </div>


                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
<?php

            $query = "SELECT * FROM comments WHERE comment_post_id  = {$the_post_id} ";
            $query.= "AND comment_status = 'approved' ";
            $query.= "ORDER BY comment_id DESC ";
            $select_comment_query = mysqli_query($con, $query);

                testQuery($select_comment_query);


            while ($row = mysqli_fetch_array($select_comment_query)) {

                $comment_date = $row['comment_date'];
                $comment_content= $row['comment_content'];
                $comment_author = $row['comment_author'];
?>


                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>

                        <?php echo $comment_content; ?></div>
                </div>



         <?php } } } else {

                    header("Location: index.php");


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