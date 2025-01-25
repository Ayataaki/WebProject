<?php

	include('config/db_connect.php');
$title=$email=$Ingredients='';
$errors=array('email'=>'','title'=>'','Ingredients'=>'');

if(isset($_POST['submit'])){
		echo htmlspecialchars($_POST['email']);
		echo htmlspecialchars($_POST['title']);
		echo htmlspecialchars($_POST['Ingredients']);
}

		//check email
		if(empty($_POST['email']))
			echo 'An email is required <br />';
		else{
			$email =$_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email']='email must be a valid email address';
			}
		}

		//check title
		if(empty($_POST['title']))
			echo 'A title is required <br />';
		else
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title']='title must be valid';
			}
		
		//check ingredients
		if(empty($_POST['Ingredients']))
				$errors['Ingredients']='ingredients must be valid';
		else{
			$Ingredients = $_POST['Ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$Ingredients)){
				$errors['Ingredients']='Ingredients must be valid';
			}
		}
		if (array_filter($errors)){
			//echo "errors ";
		} else{

			$email=mysqli_real_escape_string($conn,$_POST['email']);			
			$title=mysqli_real_escape_string($conn,$_POST['title']);
			$ingredients=mysqli_real_escape_string($conn,$_POST['Ingredients']);

			// create sql
			$sql="INSERT INTO pizzas (title,email,ingredients) VALUES('$title','$email','$ingredients')";

			// save to db and check
			if(mysqli_query($conn,$sql)){
				//success
				header('location: index.php');
			}else{
				//error
				echo 'query error: '.mysqli_error($conn);
			}

		}
	

?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php'); ?>
	<section class="container grey-text">
		<h4 class="center"> Add a Pizza</h4>
		<form class="white" action="add.php" method="POST">
			<label>Your email :</label>
			<input type="text" name="email" value="<?php echo $email; ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>
			<label>Pizza title :</label>
			<input type="text" name="title" value="<?php echo $title; ?>">
			<div class="red-text"><?php echo $errors['title']; ?></div>
			<label>Ingredients (comma separated) :</label>
			<input type="text" name="Ingredients" value="<?php echo $Ingredients; ?>">
			<div class="red-text"><?php echo $errors['Ingredients']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>
			
		</form>
		
	</section>
	<?php include('templates/footer.php'); ?>

</html>


