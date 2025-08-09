<?php 
$pageTitle = "Running Students - Directory";
$additionalCSS = '<link href="css/directory.css" rel="stylesheet" type="text/css">';
include 'includes/header.php'; 
include '_dbconnect.php';

// Get search parameters
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$filter_column = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Build SQL query based on search and filter
$sql = "SELECT * FROM RunningStudents WHERE 1=1";

if (!empty($search)) {
    if ($filter_column === 'all') {
        $sql .= " AND (sname LIKE '%$search%' OR s2name LIKE '%$search%' OR semail LIKE '%$search%' OR student_id LIKE '%$search%' OR ssemester LIKE '%$search%' OR syear LIKE '%$search%')";
    } else {
        $sql .= " AND $filter_column LIKE '%$search%'";
    }
}

$sql .= " ORDER BY sname ASC";
$result = mysqli_query($conn, $sql);
$total_students = mysqli_num_rows($result);
?>

<div class="directory-container">
    <div class="container">
        <!-- Header Section -->
        <div class="directory-header">
            <h1>Running Students Directory</h1>
            <p>Total Students: <span class="count"><?php echo $total_students; ?></span></p>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <div class="row">
                <div class="col-md-8">
                    <form method="GET" class="search-form">
                        <div class="input-group">
                            <input type="text" 
                                   name="search" 
                                   class="form-control search-input" 
                                   placeholder="Search students..." 
                                   value="<?php echo htmlspecialchars($search); ?>">
                            <select name="filter" class="form-select filter-select">
                                <option value="all" <?php echo $filter_column === 'all' ? 'selected' : ''; ?>>All Fields</option>
                                <option value="sname" <?php echo $filter_column === 'sname' ? 'selected' : ''; ?>>First Name</option>
                                <option value="s2name" <?php echo $filter_column === 's2name' ? 'selected' : ''; ?>>Last Name</option>
                                <option value="student_id" <?php echo $filter_column === 'student_id' ? 'selected' : ''; ?>>Student ID</option>
                                <option value="semail" <?php echo $filter_column === 'semail' ? 'selected' : ''; ?>>Email</option>
                                <option value="ssemester" <?php echo $filter_column === 'ssemester' ? 'selected' : ''; ?>>Semester</option>
                                <option value="syear" <?php echo $filter_column === 'syear' ? 'selected' : ''; ?>>Academic Year</option>
                            </select>
                            <button type="submit" class="btn btn-search">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a href="signup.php" class="btn btn-add">
                        <i class="fas fa-plus"></i> Add New Student
                    </a>
                </div>
            </div>
        </div>

        <!-- Results Section -->
        <div class="results-section">
            <?php if ($total_students > 0): ?>
                <div class="table-responsive">
                    <table class="table students-table">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Semester</th>
                                <th>Academic Year</th>
                                <th>GPA</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td class="photo-cell">
                                        <?php if (!empty($row['s_image']) && file_exists($row['s_image'])): ?>
                                            <img src="<?php echo htmlspecialchars($row['s_image']); ?>" 
                                                 alt="<?php echo htmlspecialchars($row['sname']); ?>" 
                                                 class="student-photo">
                                        <?php else: ?>
                                            <div class="no-photo">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="id-cell"><?php echo htmlspecialchars($row['student_id']); ?></td>
                                    <td class="name-cell">
                                        <?php echo htmlspecialchars($row['sname'] . ' ' . $row['s2name']); ?>
                                    </td>
                                    <td class="email-cell">
                                        <a href="mailto:<?php echo htmlspecialchars($row['semail']); ?>">
                                            <?php echo htmlspecialchars($row['semail']); ?>
                                        </a>
                                    </td>
                                    <td class="contact-cell">
                                        <a href="tel:<?php echo htmlspecialchars($row['scontact']); ?>">
                                            <?php echo htmlspecialchars($row['scontact']); ?>
                                        </a>
                                    </td>
                                    <td class="semester-cell">
                                        <span class="badge badge-semester"><?php echo htmlspecialchars($row['ssemester']); ?></span>
                                    </td>
                                    <td class="year-cell"><?php echo htmlspecialchars($row['syear']); ?></td>
                                    <td class="gpa-cell">
                                        <?php if ($row['sgpa']): ?>
                                            <span class="gpa-badge"><?php echo number_format($row['sgpa'], 2); ?></span>
                                        <?php else: ?>
                                            <span class="text-muted">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="actions-cell">
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-view" onclick="viewStudent(<?php echo $row['sid']; ?>)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-edit" onclick="editStudent(<?php echo $row['sid']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="no-results">
                    <div class="no-results-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>No Students Found</h3>
                    <p>
                        <?php if (!empty($search)): ?>
                            No students match your search criteria. Try adjusting your search terms.
                        <?php else: ?>
                            No students are currently registered in the system.
                        <?php endif; ?>
                    </p>
                    <a href="signup.php" class="btn btn-primary">Add First Student</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function viewStudent(id) {
    // Implement view functionality
    alert('View student with ID: ' + id);
}

function editStudent(id) {
    // Implement edit functionality
    alert('Edit student with ID: ' + id);
}

// Auto-submit form on filter change
document.querySelector('.filter-select').addEventListener('change', function() {
    this.form.submit();
});

// Clear search
function clearSearch() {
    window.location.href = 'students.php';
}
</script>

<?php include 'includes/footer.php'; ?>
