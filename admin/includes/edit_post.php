<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 08/05/2018
 * Time: 16:35
 */
?>


<?php

    if(isset($_GET['p_id'])) {

        $the_post_id = $_GET['p_id'];

    }


        $query = "SELECT * FROM posts WHERE post_id = $the_post_id "; // LIMIT 3 PODE COLOCAR LIMITE NA ROW
        $select_posts_by_id = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
            $post_id = $row['post_id'];
            $post_user = $row['post_user'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $posts_tags = $row['posts_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];

        }

        if(isset($_POST['update_post'])) {

            $post_title = $_POST['post_title'];
            $post_user = $_POST['post_user'];
            $post_category_id = $_POST['post_category_id'];
            $post_status = $_POST['post_status'];

            $post_image = $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];

            $posts_tags = $_POST['posts_tags'];
            $post_content = $_POST['post_content'];

            move_uploaded_file($post_image_temp, "../images/$post_image");

            if(empty($post_image)) {

                $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                $select_image = mysqli_query($con, $query);

                while($row = mysqli_fetch_array($select_image)) {

                    $post_image = $row['post_image'];

                }
            }



//Query que faz update de todos os campos .. tem mais coisa pra lá >>>>>>>>>>>>
            $query = "UPDATE posts SET post_title = '$post_title', post_category_id = '$post_category_id', post_date = now(), post_user = '$post_user', post_status = '$post_status', posts_tags = '$posts_tags', post_content = '$post_content', post_image = '$post_image' WHERE post_id = {$the_post_id} ";

            $update_post = mysqli_query($con, $query);

           testQuery($update_post);

            echo "<p class='alert-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";


        }

?>


<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="categories">Categories</label>
        <select name="post_category_id" id="post_category_id">

        <?php

        $query = "SELECT * FROM categories"; // LIMIT 3 PODE COLOCAR LIMITE NA ROW
        $select_categories = mysqli_query($con, $query);

        testQuery($select_categories);

        while($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];



            if($cat_id == $post_category_id) {

                echo "<option selected value= '$cat_id'>{$cat_title}</option>";



            } else {


                echo "<option value= '$cat_id'>{$cat_title}</option>";

            }



        }

        ?>


        </select>
    </div>

    <div class="form-group">
        <label for="users">Users</label>
        <select name="post_user" id="">
            <?php echo "<option value= '{$post_user}'>{$post_user}</option>";?>


            <?php

            $users_query = "SELECT * FROM users"; // LIMIT 3 PODE COLOCAR LIMITE NA ROW
            $select_users = mysqli_query($con, $users_query);

            testQuery($select_users);

            while($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];

                echo "<option value= '{$username}'>{$username}</option>";


            }

            ?>
        </select>


    <div class="form-group">

        <select name="post_status" id="">

            <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>

            <?php

            if($post_status == 'published' ) {


                echo "<option value='draft'>draft</option>";


            } else {


                echo "<option value='published'>publish</option>";


            }



            ?>
        </select>


    </div>


    <div class="form-group">

        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input  type="file" name="image">
    </div>

    <div class="form-group">
        <label for="posts_tags">Post Tags</label>
        <input value="<?php echo $posts_tags; ?>" type="text" class="form-control" name="posts_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea  class="form-control "name="post_content" id="body" cols="30" rows="10"><?php echo str_replace('\r\n','</br>',$post_content) ; ?>

            </textarea>
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update !">
    </div>


</form>


