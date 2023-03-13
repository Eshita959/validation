<!DOCTYPE html>
<html>
<head>
	<title>Registered Users</title>
</head>
<body>
	<h2>Registered Users</h2>
	<table>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Profile Picture</th>
			<th>Date and Time Registered</th>
		</tr>
		<?php
		$file = fopen('users.csv', 'r');
		while (($data = fgetcsv($file)) !== false) {
			echo "<tr>";
			echo "<td>" . $data[0] . "</td>";
			echo "<td>" . $data[1] . "</td>";
			echo "<td><img src='uploads/" . $data[2] . "' width='50'></td>";
			echo "<td>" . $data[3] . "</td>";
			echo "</tr>";
		}
		fclose($file);
		?>
	</table>
