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

                $the_post_id     = $_GET['p_id'];
                $the_post_user = $_GET['user'];
            }

            $query = "SELECT * FROM posts WHERE post_user = '{$the_post_user}' ";
            $select_all_posts_query = mysqli_query($con, $query);

            while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id= $row['post_id'];
                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
                $post_date= $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

                ?>


                <!-- First Blog Post -->
                 <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    <h2>Posts from <?php echo $post_user ?></h2></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?> " alt="">
                <hr>
                <p><?php echo $post_content?></p>

                <hr>




            <?php } ?>

            <!-- Blog Comments -->

            <?php
//query que Cria o comentario se ele tiver sido setado , e executa a query no finalzinho ele testa se a query funfa
            if(isset($_POST['create_comment'])) {

                $the_post_id = $_GET['p_id'];

                $comment_user = $_POST['comment_user'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                if(!empty($comment_user) && !empty($comment_email) && !empty($comment_content)) {

                    $query = "INSERT INTO comments (comment_post_id, comment_user, comment_email, comment_content, comment_status, comment_date )";
                    $query.= "VALUES ($the_post_id, '{$comment_user}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                    $create_comment_query = mysqli_query($con, $query);


                    testQuery($create_comment_query);




                    //------------------------------------------------------------------------------------------------------------------//
//query para fazer update no post, e aumentar a quantidade de comentarios e atualizar
                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                    $query .= "WHERE post_id = $the_post_id " ;
                    $update_comment_count = mysqli_query($con, $query);






                } else {

                    echo "<script>alert('Fields Cannot be Empty')</script>";



                }

                }







           ?>





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
