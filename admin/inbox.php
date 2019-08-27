  <?php include 'inc/header.php';  ?>
      <?php include 'inc/sidebar.php';  ?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>

      <?php  
       if (isset($_GET['seenid'])) {
       	 $seenid = $_GET['seenid'];

       	 $query = "UPDATE tbl_contact
                    SET
                    status = '1'
                    WHERE id = '$seenid' ";


                    $update_row = $db->update($query);
                    if ($update_row) {
                        echo "<span class='success'> Message send in the seen box </span>";
                    } else {
                        echo "<span class='error'> Something Wrong </span>";
                    }
       }

      ?>


                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

 					<?php
                    $query =  "select * from tbl_contact where status='0' order by id desc";
                    $msg = $db->select($query);
                  $i=0;
                    if ($msg) {
                     	while ($result = $msg->fetch_assoc()) {
                     		$i++;
                                      ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textShorten($result['body'], 30); ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a>
							 || <a onclick="return confirm('Are you sure to Move the Seen Message box'); " href="?seenid=<?php echo $result['id']; ?>">Seen</a></td>
						</tr>
						 <?php  } } ?>
					</tbody>
				</table>
               </div>
            </div>






 <div class="box round first grid">
                <h2>Seen Message</h2>

 			<?php
            if (isset($_GET['delid'])) {
            	$delid = $_GET['delid'];
            	$delquery = "delete from tbl_contact where id='$delid'";
            	$deldata = $db->delete($delquery);
            	if ($deldata) {
                        echo "<span class='success'> Message Deleted Successfully.</span>";
                    } else {
                        echo "<span class='error'> Message Not Deleted </span>";
                    }
            }

            ?>

                <div class="block">        
                   <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

 					<?php
                    $query =  "select * from tbl_contact where status='1' order by id desc";
                    $msg = $db->select($query);
                  $i=0;
                    if ($msg) {
                     	while ($result = $msg->fetch_assoc()) {
                     		$i++;
                                      ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textShorten($result['body'], 30); ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a>
							 ||	 <a onclick="return confirm('Are you sure to Delete'); "  href="?delid=<?php echo $result['id']; ?>">Delete</a></td>
						</tr>
						 <?php  } } ?>
					</tbody>
				</table>
               </div>
            </div>












        </div>

  <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();


        });
    </script>
        
 <?php include 'inc/footer.php';  ?>
