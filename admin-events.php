<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin-login.php');
    exit();
}

include '_dbconnect.php';

$action = $_GET['action'] ?? 'list';
$event_id = $_GET['id'] ?? null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_event'])) {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
        $event_time = mysqli_real_escape_string($conn, $_POST['event_time']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $admin_id = $_SESSION['admin_id'];
        
        // Handle image upload
        $image = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['image']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if (in_array($ext, $allowed)) {
                $new_filename = 'event_' . time() . '.' . $ext;
                $upload_path = 'images/' . $new_filename;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                    $image = $upload_path;
                }
            }
        }
        
        $sql = "INSERT INTO Events (title, description, event_date, event_time, location, image, status, created_by) 
                VALUES ('$title', '$description', '$event_date', '$event_time', '$location', '$image', '$status', $admin_id)";
        
        if (mysqli_query($conn, $sql)) {
            header('Location: admin-events.php?success=created');
            exit();
        } else {
            $error = 'Failed to create event.';
        }
    }
    
    if (isset($_POST['update_event'])) {
        $id = (int)$_POST['event_id'];
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
        $event_time = mysqli_real_escape_string($conn, $_POST['event_time']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        
        $sql = "UPDATE Events SET title='$title', description='$description', event_date='$event_date', 
                event_time='$event_time', location='$location', status='$status' WHERE id=$id";
        
        if (mysqli_query($conn, $sql)) {
            header('Location: admin-events.php?success=updated');
            exit();
        } else {
            $error = 'Failed to update event.';
        }
    }
}

// Handle delete action
if ($action === 'delete' && $event_id) {
    $sql = "DELETE FROM Events WHERE id = " . (int)$event_id;
    if (mysqli_query($conn, $sql)) {
        header('Location: admin-events.php?success=deleted');
        exit();
    }
}

$pageTitle = "Events Management - Admin";
$additionalCSS = '<link href="css/admin.css" rel="stylesheet" type="text/css">';
include 'includes/header.php';
?>

<div class="admin-container">
    <div class="container">
        <div class="admin-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Events Management</h1>
                    <p>Create, edit, and manage alumni events</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="admin-dashboard.php" class="btn btn-outline-primary me-2">
                        <i class="fas fa-arrow-left"></i> Dashboard
                    </a>
                    <?php if ($action !== 'create'): ?>
                        <a href="admin-events.php?action=create" class="btn btn-success">
                            <i class="fas fa-plus"></i> Create Event
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php 
                switch($_GET['success']) {
                    case 'created': echo 'Event created successfully!'; break;
                    case 'updated': echo 'Event updated successfully!'; break;
                    case 'deleted': echo 'Event deleted successfully!'; break;
                }
                ?>
            </div>
        <?php endif; ?>

        <?php if ($action === 'create' || $action === 'edit'): ?>
            <!-- Create/Edit Form -->
            <?php
            $event = null;
            if ($action === 'edit' && $event_id) {
                $result = mysqli_query($conn, "SELECT * FROM Events WHERE id = " . (int)$event_id);
                $event = mysqli_fetch_assoc($result);
            }
            ?>
            
            <div class="admin-form">
                <h2><?php echo $action === 'create' ? 'Create New Event' : 'Edit Event'; ?></h2>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" enctype="multipart/form-data">
                    <?php if ($action === 'edit'): ?>
                        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="title">Event Title *</label>
                                <input type="text" id="title" name="title" required 
                                       value="<?php echo $event ? htmlspecialchars($event['title']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Status *</label>
                                <select id="status" name="status" required>
                                    <option value="active" <?php echo ($event && $event['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="inactive" <?php echo ($event && $event['status'] === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description *</label>
                        <textarea id="description" name="description" required rows="4"><?php echo $event ? htmlspecialchars($event['description']) : ''; ?></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="event_date">Event Date *</label>
                                <input type="date" id="event_date" name="event_date" required 
                                       value="<?php echo $event ? $event['event_date'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="event_time">Event Time</label>
                                <input type="time" id="event_time" name="event_time" 
                                       value="<?php echo $event ? $event['event_time'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" id="location" name="location" 
                                       value="<?php echo $event ? htmlspecialchars($event['location']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <?php if ($action === 'create'): ?>
                        <div class="form-group">
                            <label for="image">Event Image</label>
                            <input type="file" id="image" name="image" accept="image/*">
                            <small class="text-muted">Upload an image for the event (optional)</small>
                        </div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <button type="submit" name="<?php echo $action === 'create' ? 'create_event' : 'update_event'; ?>" class="btn btn-primary">
                            <i class="fas fa-save"></i> <?php echo $action === 'create' ? 'Create Event' : 'Update Event'; ?>
                        </button>
                        <a href="admin-events.php" class="btn btn-secondary ms-2">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
            
        <?php else: ?>
            <!-- Events List -->
            <div class="admin-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $events = mysqli_query($conn, "SELECT * FROM Events ORDER BY created_at DESC");
                        if (mysqli_num_rows($events) > 0):
                            while ($event = mysqli_fetch_assoc($events)):
                        ?>
                            <tr>
                                <td>
                                    <strong><?php echo htmlspecialchars($event['title']); ?></strong>
                                    <br>
                                    <small class="text-muted"><?php echo substr($event['description'], 0, 100) . '...'; ?></small>
                                </td>
                                <td>
                                    <?php echo date('M d, Y', strtotime($event['event_date'])); ?>
                                    <?php if ($event['event_time']): ?>
                                        <br><small><?php echo date('h:i A', strtotime($event['event_time'])); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($event['location']) ?: 'TBA'; ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo $event['status']; ?>">
                                        <?php echo ucfirst($event['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($event['created_at'])); ?></td>
                                <td>
                                    <a href="admin-events.php?action=edit&id=<?php echo $event['id']; ?>" class="btn btn-sm btn-primary me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="admin-events.php?action=delete&id=<?php echo $event['id']; ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this event?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php 
                            endwhile;
                        else:
                        ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    No events found. <a href="admin-events.php?action=create">Create your first event</a>
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
