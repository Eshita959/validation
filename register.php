<?php
// check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// get form inputs
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$profile_pic = $_FILES['profile_pic'];

	// validate form inputs
	if (empty($name) || empty($email) || empty($password) || empty($profile_pic['name'])) {
		echo "Please fill out all fields.";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "Please enter a valid email address.";
	} else {
		// save profile picture to server with unique filename
		$filename = uniqid() . '_' . $profile_pic['name'];
		$upload_path = 'uploads/' . $filename;
		move_uploaded_file($profile_pic['tmp_name'], $upload_path);

		// save user's data to CSV file
		$user_data = array($name, $email, $filename, date('Y-m-d H:i:s'));
		$file = fopen('users.csv', 'a');
		fputcsv($file, $user_data);
		fclose($file);

		// start session and set cookie with user's name
		session_start();
		$_SESSION['name'] = $name;
		setcookie('name', $name, time() + 3600); 
		echo "Registration successful!";
	}
}
?>