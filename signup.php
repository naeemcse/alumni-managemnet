<?php
$pageTitle = "New Registration";
$additionalCSS = '<link href="css/signup.css" rel="stylesheet" type="text/css">';
include 'includes/header.php'; 

// Handle success/error messages
$showAlert = false;
$alertMessage = '';
$alertType = '';

if (isset($_GET['success'])) {
    $showAlert = true;
    $alertType = 'success';
    if ($_GET['success'] == 'alumni') {
        $alertMessage = 'Alumni registration successful! Thank you for joining us.';
    } else if ($_GET['success'] == 'student') {
        $alertMessage = 'Student registration successful! Welcome to our community.';
    }
}

if (isset($_GET['error'])) {
    $showAlert = true;
    $alertType = 'danger';
    $alertMessage = $_GET['error'];
}
?>

<div class="registration-container">
    <div class="registration-wrapper">
        <div class="registration-header">
            <h1>Registration Portal</h1>
            <p>Choose your registration type and fill out the form below</p>
        </div>

        <?php if ($showAlert): ?>
            <div class="alert alert-<?php echo $alertType; ?>">
                <?php echo $alertMessage; ?>
            </div>
        <?php endif; ?>

        <!-- Type Selector -->
        <div class="type-selector">
            <div class="type-btn" id="alumni-btn">
                <h3>Alumni</h3>
                <p>For graduated students</p>
            </div>
            <div class="type-btn" id="student-btn">
                <h3>Running Student</h3>
                <p>For current students</p>
            </div>
        </div>

        <!-- Alumni Registration Form -->
        <div class="form-container" id="alumni-form">
            <form action="process_registration.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="type" value="alumni">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="alumni_firstname">First Name *</label>
                        <input type="text" id="alumni_firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="alumni_lastname">Last Name *</label>
                        <input type="text" id="alumni_lastname" name="lastname" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="alumni_email">Email Address *</label>
                        <input type="email" id="alumni_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="alumni_contact">Contact Number *</label>
                        <input type="tel" id="alumni_contact" name="number" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="alumni_session">Passing Year *</label>
                        <input type="number" id="alumni_session" name="session" min="2000" max="2030" required>
                    </div>
                    <div class="form-group">
                        <label for="alumni_id">Student ID *</label>
                        <input type="text" id="alumni_id" name="id" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="alumni_company">Company Name</label>
                        <input type="text" id="alumni_company" name="industry">
                    </div>
                    <div class="form-group">
                        <label for="alumni_position">Job Title</label>
                        <input type="text" id="alumni_position" name="position">
                    </div>
                </div>

                <div class="form-group">
                    <label for="alumni_photo">Profile Photo</label>
                    <div class="file-upload">
                        <input type="file" id="alumni_photo" name="uploadfile" accept="image/*">
                        <label for="alumni_photo" class="file-upload-label">
                            Click to upload or drag and drop your photo
                        </label>
                    </div>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="alumni_terms" name="terms" required>
                    <label for="alumni_terms">I confirm that all information provided is correct and accurate.</label>
                </div>

                <button type="submit" name="submit" class="submit-btn">Register as Alumni</button>
            </form>
        </div>

        <!-- Student Registration Form -->
        <div class="form-container" id="student-form">
            <form action="process_registration.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="type" value="student">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="student_firstname">First Name *</label>
                        <input type="text" id="student_firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="student_lastname">Last Name *</label>
                        <input type="text" id="student_lastname" name="lastname" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="student_email">Email Address *</label>
                        <input type="email" id="student_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="student_contact">Contact Number *</label>
                        <input type="tel" id="student_contact" name="number" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="student_semester">Current Semester *</label>
                        <select id="student_semester" name="semester" required>
                            <option value="">Select Semester</option>
                            <option value="1st">1st Semester</option>
                            <option value="2nd">2nd Semester</option>
                            <option value="3rd">3rd Semester</option>
                            <option value="4th">4th Semester</option>
                            <option value="5th">5th Semester</option>
                            <option value="6th">6th Semester</option>
                            <option value="7th">7th Semester</option>
                            <option value="8th">8th Semester</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="student_year">Academic Year *</label>
                        <input type="text" id="student_year" name="year" placeholder="e.g., 2023-2024" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="student_id">Student ID *</label>
                        <input type="text" id="student_id" name="id" required>
                    </div>
                    <div class="form-group">
                        <label for="student_gpa">Current GPA</label>
                        <input type="number" id="student_gpa" name="gpa" step="0.01" min="0" max="4.00" placeholder="e.g., 3.75">
                    </div>
                </div>

                <div class="form-group">
                    <label for="student_photo">Profile Photo</label>
                    <div class="file-upload">
                        <input type="file" id="student_photo" name="uploadfile" accept="image/*">
                        <label for="student_photo" class="file-upload-label">
                            Click to upload or drag and drop your photo
                        </label>
                    </div>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="student_terms" name="terms" required>
                    <label for="student_terms">I confirm that all information provided is correct and accurate.</label>
                </div>

                <button type="submit" name="submit" class="submit-btn">Register as Student</button>
            </form>
        </div>
    </div>
</div>

<script>
function selectType(type) {
    // Remove active class from all buttons
    document.getElementById('alumni-btn').classList.remove('active');
    document.getElementById('student-btn').classList.remove('active');
    
    // Hide all forms
    document.getElementById('alumni-form').classList.remove('active');
    document.getElementById('student-form').classList.remove('active');
    
    // Show selected type
    if (type === 'alumni') {
        document.getElementById('alumni-btn').classList.add('active');
        setTimeout(() => {
            document.getElementById('alumni-form').classList.add('active');
        }, 100);
    } else {
        document.getElementById('student-btn').classList.add('active');
        setTimeout(() => {
            document.getElementById('student-form').classList.add('active');
        }, 100);
    }
}

// Don't auto-select anything initially
document.addEventListener('DOMContentLoaded', function() {
    // Add click handlers
    document.getElementById('alumni-btn').addEventListener('click', () => selectType('alumni'));
    document.getElementById('student-btn').addEventListener('click', () => selectType('student'));
    
    // File upload preview
    const fileInputs = document.querySelectorAll('input[type="file"]');
    
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const label = this.nextElementSibling;
            if (this.files && this.files[0]) {
                label.textContent = this.files[0].name;
                label.style.background = '#28a745';
                label.style.color = 'white';
            } else {
                label.textContent = 'Click to upload or drag and drop your photo';
                label.style.background = '#f8f9ff';
                label.style.color = '#333';
            }
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>