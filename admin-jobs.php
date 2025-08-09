<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin-login.php');
    exit();
}

include '_dbconnect.php';

$action = $_GET['action'] ?? 'list';
$job_id = $_GET['id'] ?? null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_job'])) {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $company = mysqli_real_escape_string($conn, $_POST['company']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);
        $experience = mysqli_real_escape_string($conn, $_POST['experience']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $salary = mysqli_real_escape_string($conn, $_POST['salary']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $requirements = mysqli_real_escape_string($conn, $_POST['requirements']);
        $apply_link = mysqli_real_escape_string($conn, $_POST['apply_link']);
        $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $admin_id = $_SESSION['admin_id'];
        
        $sql = "INSERT INTO Jobs (title, company, position, experience, location, salary, description, requirements, apply_link, deadline, status, created_by) 
                VALUES ('$title', '$company', '$position', '$experience', '$location', '$salary', '$description', '$requirements', '$apply_link', '$deadline', '$status', $admin_id)";
        
        if (mysqli_query($conn, $sql)) {
            header('Location: admin-jobs.php?success=created');
            exit();
        } else {
            $error = 'Failed to create job posting.';
        }
    }
    
    if (isset($_POST['update_job'])) {
        $id = (int)$_POST['job_id'];
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $company = mysqli_real_escape_string($conn, $_POST['company']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);
        $experience = mysqli_real_escape_string($conn, $_POST['experience']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $salary = mysqli_real_escape_string($conn, $_POST['salary']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $requirements = mysqli_real_escape_string($conn, $_POST['requirements']);
        $apply_link = mysqli_real_escape_string($conn, $_POST['apply_link']);
        $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        
        $sql = "UPDATE Jobs SET title='$title', company='$company', position='$position', experience='$experience', 
                location='$location', salary='$salary', description='$description', requirements='$requirements', 
                apply_link='$apply_link', deadline='$deadline', status='$status' WHERE id=$id";
        
        if (mysqli_query($conn, $sql)) {
            header('Location: admin-jobs.php?success=updated');
            exit();
        } else {
            $error = 'Failed to update job posting.';
        }
    }
}

// Handle delete action
if ($action === 'delete' && $job_id) {
    $sql = "DELETE FROM Jobs WHERE id = " . (int)$job_id;
    if (mysqli_query($conn, $sql)) {
        header('Location: admin-jobs.php?success=deleted');
        exit();
    }
}

$pageTitle = "Jobs Management - Admin";
$additionalCSS = '<link href="css/admin.css" rel="stylesheet" type="text/css">';
include 'includes/header.php';
?>

<div class="admin-container">
    <div class="container">
        <div class="admin-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Jobs Management</h1>
                    <p>Post and manage job circulars for alumni and students</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="admin-dashboard.php" class="btn btn-outline-primary me-2">
                        <i class="fas fa-arrow-left"></i> Dashboard
                    </a>
                    <?php if ($action !== 'create'): ?>
                        <a href="admin-jobs.php?action=create" class="btn btn-success">
                            <i class="fas fa-plus"></i> Post Job
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php 
                switch($_GET['success']) {
                    case 'created': echo 'Job posted successfully!'; break;
                    case 'updated': echo 'Job updated successfully!'; break;
                    case 'deleted': echo 'Job deleted successfully!'; break;
                }
                ?>
            </div>
        <?php endif; ?>

        <?php if ($action === 'create' || $action === 'edit'): ?>
            <!-- Create/Edit Form -->
            <?php
            $job = null;
            if ($action === 'edit' && $job_id) {
                $result = mysqli_query($conn, "SELECT * FROM Jobs WHERE id = " . (int)$job_id);
                $job = mysqli_fetch_assoc($result);
            }
            ?>
            
            <div class="admin-form">
                <h2><?php echo $action === 'create' ? 'Post New Job' : 'Edit Job'; ?></h2>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <?php if ($action === 'edit'): ?>
                        <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="title">Job Title *</label>
                                <input type="text" id="title" name="title" required 
                                       value="<?php echo $job ? htmlspecialchars($job['title']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Status *</label>
                                <select id="status" name="status" required>
                                    <option value="active" <?php echo ($job && $job['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="inactive" <?php echo ($job && $job['status'] === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company">Company Name *</label>
                                <input type="text" id="company" name="company" required 
                                       value="<?php echo $job ? htmlspecialchars($job['company']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="position">Position/Department *</label>
                                <input type="text" id="position" name="position" required 
                                       value="<?php echo $job ? htmlspecialchars($job['position']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="experience">Experience Required</label>
                                <input type="text" id="experience" name="experience" 
                                       placeholder="e.g., 2-3 years"
                                       value="<?php echo $job ? htmlspecialchars($job['experience']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" id="location" name="location" 
                                       value="<?php echo $job ? htmlspecialchars($job['location']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="salary">Salary Range</label>
                                <input type="text" id="salary" name="salary" 
                                       placeholder="e.g., 25,000 - 35,000 BDT"
                                       value="<?php echo $job ? htmlspecialchars($job['salary']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Job Description *</label>
                        <textarea id="description" name="description" required rows="4"><?php echo $job ? htmlspecialchars($job['description']) : ''; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="requirements">Requirements</label>
                        <textarea id="requirements" name="requirements" rows="3"><?php echo $job ? htmlspecialchars($job['requirements']) : ''; ?></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="apply_link">Application Link *</label>
                                <input type="url" id="apply_link" name="apply_link" required 
                                       placeholder="https://company.com/apply"
                                       value="<?php echo $job ? htmlspecialchars($job['apply_link']) : ''; ?>">
                                <small class="text-muted">URL where candidates can apply for this job</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="deadline">Application Deadline</label>
                                <input type="date" id="deadline" name="deadline" 
                                       value="<?php echo $job ? $job['deadline'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" name="<?php echo $action === 'create' ? 'create_job' : 'update_job'; ?>" class="btn btn-primary">
                            <i class="fas fa-save"></i> <?php echo $action === 'create' ? 'Post Job' : 'Update Job'; ?>
                        </button>
                        <a href="admin-jobs.php" class="btn btn-secondary ms-2">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
            
        <?php else: ?>
            <!-- Jobs List -->
            <div class="admin-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Position</th>
                            <th>Location</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $jobs = mysqli_query($conn, "SELECT * FROM Jobs ORDER BY created_at DESC");
                        if (mysqli_num_rows($jobs) > 0):
                            while ($job = mysqli_fetch_assoc($jobs)):
                        ?>
                            <tr>
                                <td>
                                    <strong><?php echo htmlspecialchars($job['title']); ?></strong>
                                    <br>
                                    <small class="text-muted"><?php echo substr($job['description'], 0, 80) . '...'; ?></small>
                                </td>
                                <td><?php echo htmlspecialchars($job['company']); ?></td>
                                <td><?php echo htmlspecialchars($job['position']); ?></td>
                                <td><?php echo htmlspecialchars($job['location']) ?: 'Remote'; ?></td>
                                <td>
                                    <?php if ($job['deadline']): ?>
                                        <?php echo date('M d, Y', strtotime($job['deadline'])); ?>
                                    <?php else: ?>
                                        <span class="text-muted">No deadline</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="status-badge status-<?php echo $job['status']; ?>">
                                        <?php echo ucfirst($job['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo htmlspecialchars($job['apply_link']); ?>" 
                                       target="_blank" class="btn btn-sm btn-success me-1" 
                                       title="View Application Link">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    <a href="admin-jobs.php?action=edit&id=<?php echo $job['id']; ?>" class="btn btn-sm btn-primary me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="admin-jobs.php?action=delete&id=<?php echo $job['id']; ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this job posting?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php 
                            endwhile;
                        else:
                        ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No job postings found. <a href="admin-jobs.php?action=create">Post your first job</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
