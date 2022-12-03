<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["confirmed"] == false || $_SESSION["role"] !== "ADMIN"){
    header("location: index.php");
    exit;
}

if (isset($_GET['id'])){
	$id=$GET['id'];
	

}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the admininstration page.</h1>
    <p>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
	 <h1>List of Employees</h1>
	 <br>
	 <table class="table">
	  <thead>
			<tr>
				<th>ID</th>
				<th>Username</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Role</th>
				<th>Confirmed</th>
				<th>Actions</th>

			</tr>
		</thead>
	<tbody>
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$database = "tsi-shop-db";

			// Create connection
			$connection = new mysqli($servername, $username, $password, $database);

			// Check connection
			if ($connection->connect_error) {
				die("Connection failed: " . $connection->connect_error);
			}

			// read all needed rows from database table
			$sql = "SELECT id, username, name, surname, email, role, confirmed FROM users";

			$result = $connection->query($sql);

			if (!$result) {
				die("Invalid query: " . $connection->error);
			}

			// read data of each row
			while($row = $result->fetch_assoc()) {
				echo "<tr>
					<td>" . $row["id"] . "</td>
					<td>" . $row["username"] . "</td>
					<td>" . $row["name"] . "</td>
					<td>" . $row["surname"] . "</td>
					<td>" . $row["email"] . "</td>
					<td>" . $row["role"] . "</td>
					<td>" . $row["confirmed"] . "</td>
					<td>
						<a class='btn btn-primary btn-sm' href='confirm.php'>Confirm account</a>
						<a class='btn btn-danger btn-sm' href='delete.php'>Delete account</a>
					</td>
				</tr>";
			}

			$connection->close();
		?>	
	</tbody>
	</table>

	
	
	
</body>
</html>