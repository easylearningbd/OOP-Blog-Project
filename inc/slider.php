<div class="slidersection templete clear">
        <div id="slider">

  <?php

               $query = "select * from tbl_slider order by id limit 3";
                 $slider = $db->select($query);
                 if ($slider) {
 
                  while ($result = $slider->fetch_assoc()) {
                  	 
               ?>
    <a href="#"><img src="admin/<?php echo $result['image'];  ?>" alt="<?php echo $result['title'];  ?>" title="<?php echo $result['title'];  ?>" /> </a>
            
 <?php  } } ?>

        </div>
</div>


