<?php
// Verify database tables
include '_dbconnect.php';

echo "<h2>Database Table Verification</h2>";

// Check Alumni table
$result = mysqli_query($conn, "DESCRIBE Alumni");
if ($result) {
    echo "<h3>✅ Alumni Table Structure:</h3>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: red;'>❌ Alumni table not found</p>";
}

// Check RunningStudents table
$result = mysqli_query($conn, "DESCRIBE RunningStudents");
if ($result) {
    echo "<h3>✅ RunningStudents Table Structure:</h3>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: red;'>❌ RunningStudents table not found</p>";
}

// Count records
$alumni_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Alumni"));
$students_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM RunningStudents"));

echo "<h3>Record Counts:</h3>";
echo "<p>Alumni: <strong>$alumni_count</strong></p>";
echo "<p>Running Students: <strong>$students_count</strong></p>";

echo "<br><a href='signup.php'>Test Registration</a> | <a href='alumni.php'>View Alumni</a> | <a href='students.php'>View Students</a>";

mysqli_close($conn);
?>

<style>
body { font-family: Arial, sans-serif; padding: 20px; }
table { border-collapse: collapse; margin: 10px 0; }
th { background: #f0f0f0; }
</style>
