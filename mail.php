<?php
// Database connection settings
$host = "localhost";
$username = "u218441615_itsfreetown";
$password = "itsdb@%2Zk";
$dbname = "u218441615_its_db";


// Email notification settings
$recipientEmail = "contact@itservicesfreetown.com";
$subject = "Form Submission";


// Create a connection
$conn = new mysqli('localhost', 'u218441615_itsfreetown', 'itsdb@%2Zk', 'u218441615_its_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$successMessage = "";

 if (!empty($successMessage)) { ?>
    <div class="success-message">
        <?php echo $successMessage; ?>
    </div>
<?php } 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form inputs
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address=$_POST["address"];
    $problem = $_POST["problem"];
    $brand = $_POST["brand"];
    $message = $_POST["message"];

    // Validate the 'message' field
    if (empty($message)) {
        echo "Error: Message field cannot be empty.";
    } else {
        // Prepare the SQL statement
        $sql = "INSERT INTO form (name, phone, email, address, problem, brand, message) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

         // Bind the parameters
        $stmt->bind_param("sssssss", $name, $phone, $email, $address, $problem, $brand, $message);

        // Execute the statement
        if ($stmt->execute()) {
            // Send email notification
            $messageBody = "A form submission has been received.\n\n";
            $messageBody .= "Name: " . $name . "\n";
            $messageBody .= "Phone: " . $phone . "\n";
            $messageBody .= "Email: " . $email . "\n";
            $messageBody .= "Address: " . $address . "\n";
            $messageBody .= "Problem: " . $problem . "\n";
            $messageBody .= "Brand: " . $brand . "\n";
            $messageBody .= "Message: " . $message . "\n";

            // Set additional headers if needed (e.g., From, Reply-To)
            $headers = "From: contact@itservicesfreetown.com";

            // Send the email
            $mailSent = mail($recipientEmail, $subject, $messageBody, $headers);

            if ($mailSent) {
                $successMessage = "Form submitted successfully! An email notification has been sent.";
            } else {
                $successMessage = "Form submitted successfully! However, an error occurred while sending the email.";
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>