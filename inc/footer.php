</div>

	<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>


	  <?php
    $query = "select * from tbl_footer where id='1'";
    $footernote = $db->select($query);
    if ($footernote) {
        while ($result = $footernote->fetch_assoc()) {
         
        ?>
	  <p>&copy; <?php echo $result['note']; ?> <?php echo date('Y'); ?>  </p>
 <?php    }   }  ?>

	</div>

<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>