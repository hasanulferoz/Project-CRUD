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

			$file_name = $_FILES['photo']['name'];
			$file_tmp_name = $_FILES['photo']['tmp_name'];
			$file_size = $_FILES['photo']['size'];

			$unique_file_name = md5(time().rand()).$file_name;


			if(empty($name) || empty($email) || empty($cell) || empty($uname) || empty($age) || empty($gender) || empty($shift) || empty($location) ){
				$mess = validationMsg('All Fields needed!', 'warning');
			}elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
				$mess = validationMsg('Invalide Email Address', 'info');
			}elseif( $age <= 5 || $age >=12){
				$mess = validationMsg('Your age is not okay for our school', 'warning');
			}else{

				$sql = "INSERT INTO students (name, email, cell, uname, age, shift, gender, location, photo) 
				
				VALUES('$name', '$email', '$cell', '$uname', '$age', '$shift', '$gender', '$location', '$unique_file_name') ";

				$connection -> query($sql);

				move_uploaded_file($file_tmp_name,'photo/students/' . $unique_file_name );

				$mess = validationMsg('Data stable', 'success');

			}
				
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
						<input name="name" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input name="uname" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Age</label>
						<input name="age" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Gender</label><br>
						<input type="radio" name="gender" value="Male" id="male"> <label for="male">Male</label>
						<input type="radio" name="gender" value="Female" id="female"> <label for="male">Female</label>
					</div>
					
					<div class="form-group">
						<label for="">Shift</label>
						<select class="form-control" name="shift" id="">
							<option value="">--select--</option>
							<option value="day">Day</option>
							<option value="evening">Evening</option>
							
						</select>
					</div>
					
					<div class="form-group">
						<label for="">Location</label>
						<select class="form-control" name="location" id="">
							<option value="">--select--</option>
							<option value="Dhaka">Dhaka</option>
							<option value="Barisal">Barisal</option>
							<option value="Chittagong">Chittagong</option>
							<option value="Khulna">Khulna</option>
							<option value="Mymensing">Mymensing</option>
							<option value="Rajshahi">Rajshahi</option>
							<option value="Rangpur">Rangpur</option>
							<option value="Sylhet">Sylhet</option>
						</select>
					</div>
					<div class="form-group">
						<label for="">Photo</label>
						<input name="photo" class="form-control-file" type="file">
					</div>

					<div class="form-group">
						<input name="add" class="btn btn-primary" type="submit" value="Add New Student">
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