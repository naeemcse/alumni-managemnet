<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin-login.php');
    exit();
}

include '_dbconnect.php';

// Get statistics
$events_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Events"));
$jobs_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Jobs"));
$alumni_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Alumni"));
$students_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM RunningStudents"));

$pageTitle = "Admin Dashboard - Alumni Portal";
$additionalCSS = '<link href="css/admin.css" rel="stylesheet" type="text/css">';
include 'includes/header.php';
?>

<div class="admin-container">
    <div class="container">
        <div class="admin-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Admin Dashboard</h1>
                    <p>Welcome back, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="admin-logout.php" class="btn btn-outline-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-section">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon alumni-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $alumni_count; ?></h3>
                            <p>Total Alumni</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon students-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $students_count; ?></h3>
                            <p>Running Students</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon events-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $events_count; ?></h3>
                            <p>Events</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon jobs-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $jobs_count; ?></h3>
                            <p>Job Circulars</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="actions-section">
            <h2>Quick Actions</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="action-card">
                        <div class="action-header">
                            <i class="fas fa-calendar-plus"></i>
                            <h3>Event Management</h3>
                        </div>
                        <p>Create, edit, and manage alumni events</p>
                        <div class="action-buttons">
                            <a href="admin-events.php" class="btn btn-primary">
                                <i class="fas fa-eye"></i> View All Events
                            </a>
                            <a href="admin-events.php?action=create" class="btn btn-success">
                                <i class="fas fa-plus"></i> Create Event
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="action-card">
                        <div class="action-header">
                            <i class="fas fa-briefcase"></i>
                            <h3>Job Management</h3>
                        </div>
                        <p>Post and manage job circulars for alumni and students</p>
                        <div class="action-buttons">
                            <a href="admin-jobs.php" class="btn btn-primary">
                                <i class="fas fa-eye"></i> View All Jobs
                            </a>
                            <a href="admin-jobs.php?action=create" class="btn btn-success">
                                <i class="fas fa-plus"></i> Post Job
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="recent-section">
            <h2>Recent Activity</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="recent-card">
                        <h4>Latest Events</h4>
                        <?php
                        $recent_events = mysqli_query($conn, "SELECT * FROM Events ORDER BY created_at DESC LIMIT 5");
                        if (mysqli_num_rows($recent_events) > 0):
                        ?>
                            <ul class="recent-list">
                                <?php while ($event = mysqli_fetch_assoc($recent_events)): ?>
                                    <li>
                                        <strong><?php echo htmlspecialchars($event['title']); ?></strong>
                                        <small><?php echo date('M d, Y', strtotime($event['event_date'])); ?></small>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">No events created yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="recent-card">
                        <h4>Latest Jobs</h4>
                        <?php
                        $recent_jobs = mysqli_query($conn, "SELECT * FROM Jobs ORDER BY created_at DESC LIMIT 5");
                        if (mysqli_num_rows($recent_jobs) > 0):
                        ?>
                            <ul class="recent-list">
                                <?php while ($job = mysqli_fetch_assoc($recent_jobs)): ?>
                                    <li>
                                        <strong><?php echo htmlspecialchars($job['title']); ?></strong>
                                        <small><?php echo htmlspecialchars($job['company']); ?></small>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">No job circulars posted yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
