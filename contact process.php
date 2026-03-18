<?php
include("db.php");

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$sql = "INSERT INTO contacts (name, email, message)
VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    header("Location: contact.php?success=1");
} else {
    echo "Error: " . $conn->error;
}
?>

if (mysqli_query($conn, $sql)) {
    echo "<h2 style='text-align:center;color:green;'>Message sent successfully!</h2>";
    echo "<p style='text-align:center;'><a href='home.php'>Back to Home</a></p>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>