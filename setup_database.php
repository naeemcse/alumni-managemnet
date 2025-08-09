<?php
// Create RunningStudents table
include '_dbconnect.php';

$sql = "CREATE TABLE IF NOT EXISTS RunningStudents (
    sid INT AUTO_INCREMENT PRIMARY KEY,
    s_image VARCHAR(255),
    sname VARCHAR(100) NOT NULL,
    s2name VARCHAR(100) NOT NULL,
    semail VARCHAR(150) UNIQUE NOT NULL,
    scontact VARCHAR(20) NOT NULL,
    ssemester VARCHAR(20) NOT NULL,
    syear VARCHAR(20) NOT NULL,
    student_id VARCHAR(50) UNIQUE NOT NULL,
    sgpa DECIMAL(3,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    echo "RunningStudents table created successfully!";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Database Setup</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Database Setup Complete</h2>
    <p><a href="signup.php">Go to Registration</a></p>
    <p><a href="students.php">View Students Directory</a></p>
</body>
</html>
