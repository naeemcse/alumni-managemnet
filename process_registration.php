<?php
include("_dbconnect.php");

// Check if form was submitted
if (!isset($_POST['submit']) || !isset($_POST['type'])) {
    header("Location: signup.php?error=Invalid form submission");
    exit();
}

$type = $_POST['type'];
$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);
$email = trim($_POST['email']);
$contact = trim($_POST['number']);
$id = trim($_POST['id']);

// Validate required fields
if (empty($firstname) || empty($lastname) || empty($email) || empty($contact) || empty($id)) {
    header("Location: signup.php?error=Please fill in all required fields");
    exit();
}

// Handle file upload
$uploadSuccess = false;
$folder = "";

if (isset($_FILES["uploadfile"]) && $_FILES["uploadfile"]["error"] == 0) {
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $fileext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($tempname);
    if ($check === false) {
        header("Location: signup.php?error=File is not an image");
        exit();
    }
    
    // Check file size (5MB maximum)
    if ($_FILES["uploadfile"]["size"] > 5000000) {
        header("Location: signup.php?error=Sorry, your file is too large");
        exit();
    }
    
    // Allow certain file formats
    if (!in_array($fileext, ["jpg", "jpeg", "png", "gif"])) {
        header("Location: signup.php?error=Sorry, only JPG, JPEG, PNG & GIF files are allowed");
        exit();
    }
    
    // Generate unique filename
    $newfilename = $type . "_" . $id . "_" . time() . "." . $fileext;
    $folder = "images/" . $newfilename;
    
    if (move_uploaded_file($tempname, $folder)) {
        $uploadSuccess = true;
    }
}

try {
    if ($type === 'alumni') {
        // Handle Alumni Registration
        $session = trim($_POST['session']);
        $company = trim($_POST['industry']);
        $position = trim($_POST['position']);
        
        // Check if alumni ID already exists
        $stmt = $conn->prepare("SELECT aid FROM Alumni WHERE aid = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            header("Location: signup.php?error=Alumni ID already exists");
            exit();
        }
        
        // Check if email already exists
        $stmt = $conn->prepare("SELECT aemail FROM Alumni WHERE aemail = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            header("Location: signup.php?error=Email already registered");
            exit();
        }
        
        // Insert alumni record
        $stmt = $conn->prepare("INSERT INTO Alumni (aid, a_image, aname, a2name, aemail, acontact, asession, acompany, atitle) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $id, $folder, $firstname, $lastname, $email, $contact, $session, $company, $position);
        
        if ($stmt->execute()) {
            header("Location: signup.php?success=alumni");
        } else {
            header("Location: signup.php?error=Registration failed. Please try again.");
        }
        
    } elseif ($type === 'student') {
        // Handle Student Registration
        $semester = trim($_POST['semester']);
        $year = trim($_POST['year']);
        $gpa = !empty($_POST['gpa']) ? floatval($_POST['gpa']) : null;
        
        // Check if student ID already exists
        $stmt = $conn->prepare("SELECT student_id FROM RunningStudents WHERE student_id = ?");
        if ($stmt === false) {
            header("Location: signup.php?error=Database error: " . $conn->error);
            exit();
        }
        
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $stmt->close();
            header("Location: signup.php?error=Student ID already exists");
            exit();
        }
        $stmt->close();
        
        // Check if email already exists
        $stmt = $conn->prepare("SELECT semail FROM RunningStudents WHERE semail = ?");
        if ($stmt === false) {
            header("Location: signup.php?error=Database error: " . $conn->error);
            exit();
        }
        
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $stmt->close();
            header("Location: signup.php?error=Email already registered");
            exit();
        }
        $stmt->close();
        
        // Insert student record
        if ($gpa !== null) {
            $stmt = $conn->prepare("INSERT INTO RunningStudents (student_id, s_image, sname, s2name, semail, scontact, ssemester, syear, sgpa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                header("Location: signup.php?error=Database error: " . $conn->error);
                exit();
            }
            $stmt->bind_param("ssssssssd", $id, $folder, $firstname, $lastname, $email, $contact, $semester, $year, $gpa);
        } else {
            $stmt = $conn->prepare("INSERT INTO RunningStudents (student_id, s_image, sname, s2name, semail, scontact, ssemester, syear) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                header("Location: signup.php?error=Database error: " . $conn->error);
                exit();
            }
            $stmt->bind_param("ssssssss", $id, $folder, $firstname, $lastname, $email, $contact, $semester, $year);
        }
        
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: signup.php?success=student");
        } else {
            $stmt->close();
            header("Location: signup.php?error=Registration failed. Please try again.");
        }
    }
    
} catch (Exception $e) {
    // If there was an error and we uploaded a file, delete it
    if ($uploadSuccess && file_exists($folder)) {
        unlink($folder);
    }
    
    header("Location: signup.php?error=Registration failed: " . $e->getMessage());
} finally {
    if (isset($stmt) && $stmt !== false) {
        $stmt->close();
    }
    $conn->close();
}
?>
