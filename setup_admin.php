<?php
// Create admin tables
include '_dbconnect.php';

echo "<h2>Creating Admin System Tables</h2>";

// Create Admin table
$admin_sql = "CREATE TABLE IF NOT EXISTS Admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $admin_sql)) {
    echo "<p style='color: green;'>✅ Admin table created successfully</p>";
} else {
    echo "<p style='color: red;'>❌ Error creating Admin table: " . mysqli_error($conn) . "</p>";
}

// Create Events table
$events_sql = "CREATE TABLE IF NOT EXISTS Events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    event_date DATE NOT NULL,
    event_time TIME,
    location VARCHAR(200),
    image VARCHAR(255),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES Admin(id)
)";

if (mysqli_query($conn, $events_sql)) {
    echo "<p style='color: green;'>✅ Events table created successfully</p>";
} else {
    echo "<p style='color: red;'>❌ Error creating Events table: " . mysqli_error($conn) . "</p>";
}

// Create Jobs table
$jobs_sql = "CREATE TABLE IF NOT EXISTS Jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    company VARCHAR(150) NOT NULL,
    position VARCHAR(150) NOT NULL,
    experience VARCHAR(100),
    location VARCHAR(200),
    salary VARCHAR(100),
    description TEXT NOT NULL,
    requirements TEXT,
    apply_link VARCHAR(500) NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    deadline DATE,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES Admin(id)
)";

if (mysqli_query($conn, $jobs_sql)) {
    echo "<p style='color: green;'>✅ Jobs table created successfully</p>";
} else {
    echo "<p style='color: red;'>❌ Error creating Jobs table: " . mysqli_error($conn) . "</p>";
}

// Insert default admin user
$admin_check = mysqli_query($conn, "SELECT * FROM Admin WHERE email = 'admin@cou-cse.com'");
if (mysqli_num_rows($admin_check) == 0) {
    $hashed_password = password_hash('1234', PASSWORD_DEFAULT);
    $insert_admin = "INSERT INTO Admin (username, email, password) VALUES ('admin', 'admin@cou-cse.com', '$hashed_password')";
    
    if (mysqli_query($conn, $insert_admin)) {
        echo "<p style='color: green;'>✅ Default admin user created successfully</p>";
        echo "<p><strong>Login Credentials:</strong><br>Email: admin@cou-cse.com<br>Password: 1234</p>";
    } else {
        echo "<p style='color: red;'>❌ Error creating admin user: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<p style='color: blue;'>ℹ️ Admin user already exists</p>";
}

echo "<br><h3>Database Setup Complete!</h3>";
echo "<p><a href='admin-login.php'>Go to Admin Login</a></p>";
echo "<p><a href='events.php'>View Events</a> | <a href='jobs.php'>View Jobs</a></p>";

mysqli_close($conn);
?>

<style>
body { font-family: Arial, sans-serif; padding: 20px; }
</style>
