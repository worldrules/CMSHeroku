<?php


function redirect($location){


    header("Location:" . $location);
    exit;

}


function ifItIsMethod($method=null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true;

    }

    return false;

}

function isLoggedIn(){

    if(isset($_SESSION['user_role'])){

        return true;


    }


   return false;

}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){

    if(isLoggedIn()){

        redirect($redirectLocation);

    }

}





function escape($string) {

global $con;

return mysqli_real_escape_string($con, trim($string));


}



function set_message($msg){

if(!$msg) {

$_SESSION['message']= $msg;

} else {

$msg = "";

    }


}


function display_message() {

    if(isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }


}




function users_online() {


    if(isset($_GET['onlineusers'])) {

    global $con;

    if(!$con) {





        include("../includes/db.php");
        $session = session_id();
        session_start();
        $time = time();
        $time_out_in_seconds = 05;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($con, $query);
        $count = mysqli_num_rows($send_query);

            if($count == NULL) {

                //Verficar como fazer esse contador pois está dando um loop infinito

            //mysqli_query($con, "INSERT INTO users_online(session, time) VALUES('$session','$time')");


            } else {

            mysqli_query($con, "UPDATE users_online SET time = '$time' WHERE session = '$session'");


            }

        $users_online_query =  mysqli_query($con, "SELECT * FROM users_online WHERE time > '$time_out'");
        echo $count_user = mysqli_num_rows($users_online_query);


    }






    } // get request isset()


}



//Verficar como fazer esse contador pois está dando um loop infinito

users_online();




function testQuery($result) {
    
    global $con;

    if(!$result ) {
          
          die("QUERY FAILED ." . mysqli_error($con));
   
          
      }
    

}



function insert_categories(){
    
    global $con;

        if(isset($_POST['submit'])){

            $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)) {
        
             echo "This Field should not be empty";
    
    } else {





    $stmt = mysqli_prepare($con, "INSERT INTO categories(cat_title) VALUES(?) ");

    mysqli_stmt_bind_param($stmt, 's', $cat_title);

    mysqli_stmt_execute($stmt);


        if(!$stmt) {
        die('QUERY FAILED'. mysqli_error($con));
        
                  }


        
             }

             
    mysqli_stmt_close($stmt);
   
        
       }

}


function findAllCategories() {
global $con;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($con,$query);  

    while($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<tr>";
        
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
   echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
   echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "</tr>";

    }


}


function deleteCategories(){
global $con;

    if(isset($_GET['delete'])){
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
    $delete_query = mysqli_query($con,$query);
    header("Location: categories.php");


    }
            


}


function UnApprove() {
global $con;
if(isset($_GET['unapprove'])){
    
    $the_comment_id = $_GET['unapprove'];
    
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";
    $unapprove_comment_query = mysqli_query($con, $query);
    header("Location: comments.php");
    
    
    }

    
    

}


function is_admin($username = '') {

    global $con; 

    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $query);
    testQuery($result);

    $row = mysqli_fetch_array($result);


    if($row['user_role'] == 'Admin'){

        return true;

    }else {


        return false;
    }

}



function username_exists($username){

    global $con;

    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $query);
    testQuery($result);

    if(mysqli_num_rows($result) > 0) {

        return true;

    } else {

        return false;

    }





}



function email_exists($email){

    global $con;


    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($con, $query);
    testQuery($result);

    if(mysqli_num_rows($result) > 0) {

        return true;

    } else {

        return false;

    }



}


function register_user($username, $email, $password) {

    global $con;


    $username = mysqli_real_escape_string($con, $username);
    $email = mysqli_real_escape_string($con, $email);
    $password = mysqli_real_escape_string($con, $password);

    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));


    $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
    $query .= "VALUES('{$username}','{$email}', '{$password}', 'Subscriber' )";
    $register_user_query = mysqli_query($con, $query);

    testQuery($register_user_query);

}

function login_user($username, $password)
 {

     global $con;

         $username = trim($username);
         $password = trim($password);

         $username = mysqli_real_escape_string($con, $username);
         $password = mysqli_real_escape_string($con, $password);


     $query = "SELECT * FROM users WHERE username = '{$username}' ";
     $select_user_query = mysqli_query($con, $query);
     if (!$select_user_query) {

         die("QUERY FAILED" . mysqli_error($con));

     }


     while ($row = mysqli_fetch_array($select_user_query)) {

         $db_user_id = $row['user_id'];
         $db_username = $row['username'];
         $db_user_password = $row['user_password'];
         $db_user_firstname = $row['user_firstname'];
         $db_user_lastname = $row['user_lastname'];
         $db_user_role = $row['user_role'];

     if (password_verify($password,$db_user_password)) {

         $_SESSION['username'] = $db_username;
         $_SESSION['firstname'] = $db_user_firstname;
         $_SESSION['lastname'] = $db_user_lastname;
         $_SESSION['user_role'] = $db_user_role;



         redirect("/cms/admin");


         } else {


         redirect("/cms/index.php");



         }


     }

     return true;

 }

function recordCount($table){

    global $con;

    $query = "SELECT * FROM ". $table;

    $select_all_post = mysqli_query($con, $query);

    $result = mysqli_num_rows($select_all_post);

    testQuery($result);

    return $result;
}


function checkStatus($table, $column, $status){
    global $con;

        $query = "SELECT * FROM $table WHERE $column = '$status' ";

        $result = mysqli_query($con, $query);

        return mysqli_num_rows($result);
}

function checkUserRole($table, $column, $role){
    global $con;

    $query = "SELECT * FROM $table WHERE $column = '$role' ";

    $result = mysqli_query($con, $query);

    return mysqli_num_rows($result);
}


