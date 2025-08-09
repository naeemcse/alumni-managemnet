<?php
// Fix RunningStudents table
include '_dbconnect.php';

echo "<h2>Fixing RunningStudents Table</h2>";

// Check if student_id column exists
$result = mysqli_query($conn, "SHOW COLUMNS FROM RunningStudents LIKE 'student_id'");
if (mysqli_num_rows($result) == 0) {
    // Add student_id column
    $sql = "ALTER TABLE RunningStudents ADD COLUMN student_id VARCHAR(50) UNIQUE AFTER sid";
    if (mysqli_query($conn, $sql)) {
        echo "<p style='color: green;'>✅ Added student_id column successfully</p>";
    } else {
        echo "<p style='color: red;'>❌ Error adding student_id column: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<p style='color: blue;'>ℹ️ student_id column already exists</p>";
}

// Update the table to make required fields NOT NULL
$updates = [
    "ALTER TABLE RunningStudents MODIFY COLUMN scontact VARCHAR(20) NOT NULL",
    "ALTER TABLE RunningStudents MODIFY COLUMN ssemester VARCHAR(20) NOT NULL", 
    "ALTER TABLE RunningStudents MODIFY COLUMN syear VARCHAR(20) NOT NULL"
];

foreach ($updates as $sql) {
    if (mysqli_query($conn, $sql)) {
        echo "<p style='color: green;'>✅ Updated table structure</p>";
    } else {
        echo "<p style='color: orange;'>⚠️ Update warning: " . mysqli_error($conn) . "</p>";
    }
}

echo "<br><h3>Current Table Structure:</h3>";
$result = mysqli_query($conn, "DESCRIBE RunningStudents");
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['Field'] . "</td>";
    echo "<td>" . $row['Type'] . "</td>";
    echo "<td>" . $row['Null'] . "</td>";
    echo "<td>" . $row['Key'] . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<br><a href='signup.php'>Test Registration Now</a>";

mysqli_close($conn);
?>

<style>
body { font-family: Arial, sans-serif; padding: 20px; }
table { border-collapse: collapse; margin: 10px 0; }
th { background: #f0f0f0; }
</style>
