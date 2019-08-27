 <?php include 'inc/header.php';  ?>

 <?php
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
       echo "<script>window.location = '404.php';</script>";
      
    } else {
        $id = $_GET['pageid'];
    }
 
   ?>



				<?php
                $pagequery = "select * from tbl_page where id='$id' ";
                $page = $db->select($pagequery);
                if ($page) {
                    while ($result = $page->fetch_assoc()) {
                     
                    ?>



	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $result['name'];  ?></h2>
	
				<?php echo $result['body'];  ?>
	</div>

		</div>
			 <?php  } } else { header("Location:404.php"); } ?>


		 <?php include 'inc/sidebar.php';  ?>
         <?php include 'inc/footer.php';  ?>