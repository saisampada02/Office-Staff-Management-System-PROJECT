<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
    <link rel="stylesheet" href="feedback.css">
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "office";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['name'], $_POST['email'], $_POST['message'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            $sql = "INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("sss", $name, $email, $message);
                if ($stmt->execute()) {
                    echo "<script>
                    alert(' feedback submitted  successfully.');
                    window.location.href='feedback.php'; // Change this to your actual current page
                  </script>";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close(); // Close the statement
            } else {
                echo "Error preparing statement: " . $conn->error;
            }
        } else {
            echo "All fields are required.";
        }
    }
    $conn->close();
    ?>

    <header>
        <h1>Submit Your Feedback</h1>
        <nav>
            <ul>
                <li><a href="help.html">Back to Help</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="message">Feedback:</label><br>
            <textarea id="message" name="message" required></textarea><br>
            <input type="submit" value="Submit">
        </form>
    </main>
</body>
</html>
