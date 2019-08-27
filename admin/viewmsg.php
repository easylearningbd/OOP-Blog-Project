 <?php include 'inc/header.php';  ?>
 <?php include 'inc/sidebar.php';  ?>

<?php
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
       echo "<script>window.location = 'inbox.php';</script>";
     
    } else {
        $id = $_GET['msgid'];
    }

   ?>
         
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Message Page</h2>
                <div class="block">     


    <?php

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<script>window.location = 'inbox.php';</script>";

            }
    ?>


                 <form action="" method="post" >

                    <?php
                    $query =  "select * from tbl_contact where id='$id'";
                    $msg = $db->select($query);
                  $i=0;
                    if ($msg) {
                        while ($result = $msg->fetch_assoc()) {
                            $i++;
                                      ?>

                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['firstname'];  ?>"  class="medium" />
                            </td>
                        </tr>

                                <tr>
                            <td>
                                <label>Email </label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['email'];  ?>" class="medium" />
                            </td>
                        </tr>
                     
                     
                         
                   
                           <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text"  readonly value="<?php echo $fm->formatDate($result['date']);  ?>"  class="medium" />
                            </td>
                        </tr>
                     
                    
                         
                        
                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce"  >
                                    <?php echo $result['body'];  ?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
 
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Done" />
                            </td>
                        </tr>
                    </table>

      <?php  } } ?>

                    </form>
                </div>
            </div>
        </div>


        
          <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    setupTinyMCE();
                    setDatePicker('date-picker');
                    $('input[type="checkbox"]').fancybutton();
                    $('input[type="radio"]').fancybutton();
                });
            </script>

<?php include 'inc/footer.php';  ?>


 