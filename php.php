<?php
echo "<h1>PHP</h1>";

require "./Backend/connection.php";

?>
<h1>connection</h1>
<?php
print_r($conn);
$sql = "SELECT * FROM `users`";
$statement = $conn->prepare($sql);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>users</h1>
<pre>
	<?php
	print_r($users);
	?>
</pre>
