<?php include_once "app/autoload.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>



<?php



if(isset($_POST['add'])){
	$edit_id = $_GET['edit_id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$cell = $_POST['cell'];
	$uname = $_POST['uname'];
	$age = $_POST['age'];
	if(isset($_POST['gender'])){
		$gender = $_POST['gender'];	
	}
	
	$shift = $_POST['shift'];
	$location = $_POST['location'];

	// $file_name = $_FILES['photo']['name'];
	// $file_tmp_name = $_FILES['photo']['tmp_name'];
	// $file_size = $_FILES['photo']['size'];

	// $unique_file_name = md5(time().rand()).$file_name;


	if(empty($name) || empty($email) || empty($cell) || empty($uname) || empty($age) || empty($gender) || empty($shift) || empty($location) ){
		$mess = validationMsg('All Fields needed!', 'warning');
	}elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
		$mess = validationMsg('Invalide Email Address', 'info');
	}elseif( $age <= 5 || $age >=12){
		$mess = validationMsg('Your age is not okay for our school', 'warning');
	}else{

		$sql = "UPDATE studens SET name='$name', email='$email', cell='$cell', uname='$uname', age='$age', gender='$gender', 
		
		shift='$shift', location='$location' WHERE id='$edit_id'";


		$connection -> query($sql);

		//move_uploaded_file($file_tmp_name,'photo/students/' . $unique_file_name );

		$mess = validationMsg('Data stable', 'success');

	}
		
}
 
?>




	<?php

		if(isset($_GET['edit_id'])){
			$edit_id = $_GET['edit_id'];

			$sql = "SELECT * FROM students WHERE id='$edit_id'";

			$data = $connection -> query($sql);

			$single_data = $data->fetch_assoc();
		}

 		
	?>
	

	<div class="wrap ">
		<a href="students.php" class="btn btn-sm btn-primary">All Students</a>
		<div class="card shadow">
			<div class="card-body">
				<h2>Add New Student</h2>
				<?php

						if(isset($mess)){
							echo $mess;
						}

				?>
				<form action="" method="POST" enctype="multipart/form-data"> 
					<div class="form-group">
						<label for="">Name</label>
						
						<input name="name" class="form-control" value="<?php echo $single_data['name']; ?>">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control" type="text" value="<?php echo $single_data['email']; ?>">
					</div>
					<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control" type="text" value="<?php echo $single_data['cell']; ?>">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input name="uname" class="form-control" type="text" value="<?php echo $single_data['uname']; ?>">
					</div>
					<div class="form-group">
						<label for="">Age</label>
						<input name="age" class="form-control" type="text" value="<?php echo $single_data['age']; ?>">
					</div>
					<div class="form-group">
						<label for="">Gender</label><br>
						<input type="radio" name="gender" <?php if($single_data['gender'] == 'Male') {echo "checked"; }?> value="Male" id="male"> <label for="male">Male</label>
						<input type="radio" name="gender" <?php if($single_data['gender'] == 'Female') {echo "checked"; }?> value="Female" id="female"> <label for="male">Female</label>
					</div>
					
					<div class="form-group">
						<label for="">Shift</label>
						<select class="form-control" name="shift" id="">
							<option value="">--select--</option>
							<option value="day" <?php if($single_data['shift'] == 'day') {echo "selected"; }?>>Day</option>
							<option value="evening" <?php if($single_data['shift'] == 'evening') {echo "selected"; }?>>Evening</option>
							
						</select>
					</div>
					
					<div class="form-group">
						<label for="">Location</label>
						<select class="form-control" name="location" id="">
							<option value="">--select--</option>
							<option value="Dhaka" <?php if($single_data['location'] == 'Dhaka') {echo "selected"; }?>>Dhaka</option>
							<option value="Barisal" <?php if($single_data['location'] == 'Barisal') {echo "selected"; }?>>Barisal</option>
							<option value="Chittagong" <?php if($single_data['location'] == 'Chittagong') {echo "selected"; }?>>Chittagong</option>
							<option value="Khulna" <?php if($single_data['location'] == 'Khulna') {echo "selected"; }?>>Khulna</option>
							<option value="Mymensing" <?php if($single_data['location'] == 'Mymensing') {echo "selected"; }?>>Mymensing</option>
							<option value="Rajshahi" <?php if($single_data['location'] == 'Rajshahi') {echo "selected"; }?>>Rajshahi</option>
							<option value="Rangpur" <?php if($single_data['location'] == 'Rangpur') {echo "selected"; }?>>Rangpur</option>
							<option value="Sylhet" <?php if($single_data['location'] == 'Sylhet') {echo "selected"; }?>>Sylhet</option>
						</select>
					</div>
					<div class="form-group">
						<img style="width: 200px;" src="photo/students/<?php echo $single_data['photo']?>" alt="">
						<input type="hidden" name="old_photo" value="<?php echo $single_data['photo']; ?>" >
					</div>
					<div class="form-group">
						<label for="">Photo</label>
						<input name="new_photo" class="form-control-file" type="file">
					</div>

					<div class="form-group">
						<input name="add" class="btn btn-primary" type="submit" value="Update Student">
					</div>
				</form>
			</div>
		</div>
	</div>
	


<br>
<br>
<br>
<br>
<br>





	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>