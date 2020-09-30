<?php include_once "app/autoload.php" ?>

<?php 

	if(isset($_GET['delete_id'])){
		$delete_id = $_GET['delete_id'];
		$delete_photo = $_GET['photo'];

		$sql = "DELETE FROM students WHERE id = '$delete_id'";

		$connection -> query($sql);

		unlink('photo/students/' . $delete_photo);

		header('location:students.php');
		

	}

	if(isset($_GET['active_id'])){
		$active_id = $_GET['active_id'];
		$sql = "Update students SET status='active' WHERE id='$active_id'";

		$connection -> query($sql);
		header('location:students.php');
	}

	if(isset($_GET['inactive_id'])){
		$inactive_id = $_GET['inactive_id'];
		$sql = "Update students SET status='inactive' WHERE id='$inactive_id'";

		$connection -> query($sql);
		header('location:students.php');
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/fonts/css/font-awesome/css/all.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	<div class="wrap-table ">
		<a href="index.php" class="btn btn-sm btn-primary">Add New Students</a>
		<div class="card shadow">
			<div class="card-body">
				<h2>All Data</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Cell</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					
						$data = $connection -> query("select * from students");
						$i = 1;
						while($student = $data -> fetch_assoc() ):
						
					?>
  
						<tr>
							<td><?php echo $i; $i++; ?></td>
							<td><?php echo $student['name']; ?></td>
							<td><?php echo $student['email']; ?></td>
							<td><?php echo $student['cell']; ?></td>
							<td><img src="photo/students/<?php echo $student['photo']; ?>" alt=""></td>
							<td>


								
								<?php if($student['status'] == 'inactive') : ?>
									<a class="btn btn-sm btn-dark" href="?active_id=<?php echo $student['id']; ?>"><i class="far fa-thumbs-up"></i></a>
								<?php elseif($student['status'] == 'active') : ?>
									<a class="btn btn-sm btn-danger" href="?inactive_id=<?php echo $student['id']; ?>"><i class="far fa-thumbs-down"></i></a>
								<?php endif; ?>

								<a class="btn btn-sm btn-info" href="profile.php?student_id=<?php echo $student['id']; ?>"><i class="fas fa-eye"></i></a>
								<a class="btn btn-sm btn-warning" href="edit.php?edit_id=<?php echo $student['id']; ?>"><i class="far fa-edit"></i></a>
								<a id="delete_btn" class="btn btn-sm btn-danger" href="?delete_id=<?php echo $student['id']; ?>&photo=<?php echo $student['photo']; ?>"><i class="fas fa-trash-alt"></i></a>
							</td>
						</tr>
						
						<?php endwhile; ?>
						

					</tbody>
				</table>
			</div>
		</div>
	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>
		$('a#delete_btn').click(function(){
			let conf = confirm('Are you sure?');
			if(conf){
				return true;
			}else{
				return false;
			}
		});
	</script>
</body>
</html>