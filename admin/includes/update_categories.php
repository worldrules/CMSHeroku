<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 06/05/2018
 * Time: 14:51
 */
?>


<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>


        <?php

        if(isset($_GET['edit'])) {

            $cat_id = $_GET['edit'];

            $query = "SELECT * FROM categories WHERE cat_id = $cat_id  "; // LIMIT 3 PODE COLOCAR LIMITE NA ROW
            $select_categories_id = mysqli_query($con, $query);

            while($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

            }

            ?>
            <input value="<?php if(isset($cat_title)) {echo $cat_title;} ?>" class="form-control" type="text" name="cat_title">


        <?php } ?>

        <?php
        // UPDATE QUERY

        if(isset($_POST['update_category'])) {

            $the_cat_title = escape($_POST['cat_title']);

            $stmt = mysqli_prepare($con, "UPDATE categories SET cat_title = ? WHERE cat_id = ? ");

            mysqli_stmt_bind_param($stmt, 'si', $the_cat_title, $cat_id);

            mysqli_stmt_execute($stmt);


          if(!$stmt){

                          die("QUERY FAILED" . mysqli_error($con));

                      }

                      mysqli_stmt_close($stmt);


                     redirect("categories.php");


        }

        ?>




    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>
