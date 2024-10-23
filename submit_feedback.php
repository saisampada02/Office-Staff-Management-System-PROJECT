<?php
include 'connection_feedback.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $conn = "INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn_feedback->prepare($sql)) {
            $stmt->bind_param("ssss", $name, $email, $subject, $message);
            if ($stmt->execute()) {
                echo "Message sent successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close(); // Close the statement
        } else {
            echo "Error preparing statement: " . $conn_feedback->error;
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close(); // Close the connection
?>
