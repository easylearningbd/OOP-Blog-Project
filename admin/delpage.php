 <?php 

include '../lib/Session.php'; 
 Session::checkSession();
 ?>

<?php include '../config/config.php';  ?>
<?php include '../lib/Database.php';  ?>
 

    <?php
    $db = new Database();
 
    ?>


    <?php
    if (!isset($_GET['delpage']) || $_GET['delpage'] == NULL) {
       echo "<script>window.location = 'index.php';</script>";
    
    } else {
        $postid = $_GET['delpage'];
   
     
       $delquery = "delete from tbl_page where id='$postid'";
       $delData = $db->delete($delquery);
       if ($delData) {
        echo "<script> alert('Data Deleted Successfully'); </script>";
         echo "<script>window.location = 'index.php';</script>";
       } else {
 			echo "<script> alert('Data  Not Deleted '); </script>";
            echo "<script>window.location = 'index.php';</script>";
       }


    }

   ?>