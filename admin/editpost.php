 <?php include 'inc/header.php';  ?>
 <?php include 'inc/sidebar.php';  ?>


  <?php
    if (!isset($_GET['editpostid']) || $_GET['editpostid'] == NULL) {
       echo "<script>window.location = 'postlist.php';</script>";

      } else {
        $postid = $_GET['editpostid'];
    }

   ?>


         
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>
                <div class="block">     


    <?php

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = mysqli_real_escape_string($db->link,  $_POST['title']);
                $cat = mysqli_real_escape_string($db->link,  $_POST['cat']);
                $body = mysqli_real_escape_string($db->link,  $_POST['body']);
                $tags = mysqli_real_escape_string($db->link,  $_POST['tags']);
                $author = mysqli_real_escape_string($db->link,  $_POST['author']);
                $userid = mysqli_real_escape_string($db->link,  $_POST['userid']);

               
               $permited = array('jpg', 'jpeg', 'png' , 'gif');
               $file_name = $_FILES['image']['name'];
               $file_size = $_FILES['image']['size'];
               $file_temp = $_FILES['image']['tmp_name'];

               $div = explode('.',  $file_name);
               $file_ext = strtolower(end($div));
               $unique_image =  substr(md5(time()), 0, 10).'.'.$file_ext;
               $uploaded_image = "upload/".$unique_image;

            if ($title == "" || $cat == "" || $body == "" || $tags == "" || $author == "") {
                 echo "<span class='error'>  Field must not be empty </span>";
           
            }

        if (!empty($file_name)) {
          
       

             if ($file_size  > 1086544) {
                echo "<span class='error'>  Image size should be less then 1mb! </span>";
            } elseif (in_array($file_ext, $permited) == false) {
                echo "<span class='error'>  You can only Upload" .implode(' ', $permited).  "</span>";
            }else {
                move_uploaded_file( $file_temp, $uploaded_image);
                 $query = "UPDATE tbl_post
                 SET
                 cat = '$cat',
                 title = '$title',
                 body = '$body',
                 image = '$uploaded_image',
                 author = '$author',
                 tags = '$tags',
                 userid = '$userid'  
                 WHERE id = '$postid'           
                ";
               $updated_row = $db->update($query);
               if ($updated_row) {
                  echo "<span class='success'> Post Updated Successfully </span>";
               }else{
                echo "<span class='error'>  Post Not Updated </span>";
               }

            }

 }else {

 $query = "UPDATE tbl_post
                 SET
                 cat = '$cat',
                 title = '$title',
                 body = '$body',
                 author = '$author',
                 tags = '$tags', 
                 userid = '$userid'
                 WHERE id = '$postid'           
                ";
               $updated_row = $db->update($query);
               if ($updated_row) {
                  echo "<span class='success'> Post Updated Successfully </span>";
               }else{
                echo "<span class='error'>  Post Not Updated </span>";
               }
 }



            }
    ?>


             <?php
  $query = "select * from tbl_post where id='$postid' order by id desc";
  $getpost = $db->select($query);
  while ($postresult = $getpost->fetch_assoc()) {
     

             ?>


                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $postresult['title']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">

                                     <option>Select Cateory</option>

                      <?php
                         $query  = "select * from tbl_category";
                         $category = $db->select($query);

                         if ($category) {
                            while ($result = $category->fetch_assoc() ) {
                                 
                         

                      ?>

                     <option
                   <?php 
                   if ($postresult['cat'] == $result['id']) {  ?>
                     selected="selected"
                  <?php  } ?>
                      value="<?php echo $result['id']; ?>"><?php echo $result['name'];  ?></option>
                                     
                          <?php    }    } ?>


                                </select>
                            </td>
                        </tr>
                   
                    
                         
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                 <img src="<?php echo $postresult['image']; ?>" height="50px" width="100px"><br>
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                  <?php echo $postresult['body']; ?> 
                                </textarea>
                            </td>
                        </tr>
						<tr>


                    <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $postresult['tags']; ?>"  class="medium" />
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
  <input type="text" name="author" value="<?php echo $postresult['author']; ?>"  class="medium" />
   <input type="hidden" name="userid"  value="<?php echo Session::get('userId');  ?>" class="medium" />
                            </td>
                        </tr>




                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
             <?php  } ?>

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


 