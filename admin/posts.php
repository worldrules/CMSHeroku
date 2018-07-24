<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 06/05/2018
 * Time: 15:46
 */
?>

<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 04/05/2018
 * Time: 18:23
 */

?>

<?php include "includes/adm_header.php" ?>

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
                        <small>Posts</small>
                    </h1>

                    <?php


                    if(isset($_GET['source'])) {

                        $source = $_GET['source'];
                    } else {

                        $source = '';
                    }

                    switch ($source) {

                    case 'add_post';
                        include "includes/add_post.php";
                        break;

                    case 'edit_post';
                        include "includes/edit_post.php";
                        break;

                    case '34';
                    echo "NICE";
                    break;
                    case '34';
                    echo "NICE";
                    break;


                        default:

                            include "includes/view_all_posts.php";

                            break;

                    }










                    ?>










                    </div>
                </div>


                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include "includes/adm_footer.php" ?>


