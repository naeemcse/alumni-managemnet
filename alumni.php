<?php 
$pageTitle = "Alumni - Directory";
$additionalCSS = '<link href="css/directory.css" rel="stylesheet" type="text/css">';
include 'includes/header.php'; 
include '_dbconnect.php';

// Get search parameters
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$filter_column = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Build SQL query based on search and filter
$sql = "SELECT * FROM Alumni WHERE 1=1";

if (!empty($search)) {
    if ($filter_column === 'all') {
        $sql .= " AND (aname LIKE '%$search%' OR a2name LIKE '%$search%' OR aemail LIKE '%$search%' OR aid LIKE '%$search%' OR acompany LIKE '%$search%' OR atitle LIKE '%$search%' OR asession LIKE '%$search%')";
    } else {
        $sql .= " AND $filter_column LIKE '%$search%'";
    }
}

$sql .= " ORDER BY aname ASC";
$result = mysqli_query($conn, $sql);
$total_alumni = mysqli_num_rows($result);
?>

<div class="directory-container">
    <div class="container">
        <!-- Header Section -->
        <div class="directory-header">
            <h1>Alumni Directory</h1>
            <p>Total Alumni: <span class="count"><?php echo $total_alumni; ?></span></p>
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
                                   placeholder="Search alumni..." 
                                   value="<?php echo htmlspecialchars($search); ?>">
                            <select name="filter" class="form-select filter-select">
                                <option value="all" <?php echo $filter_column === 'all' ? 'selected' : ''; ?>>All Fields</option>
                                <option value="aname" <?php echo $filter_column === 'aname' ? 'selected' : ''; ?>>First Name</option>
                                <option value="a2name" <?php echo $filter_column === 'a2name' ? 'selected' : ''; ?>>Last Name</option>
                                <option value="aid" <?php echo $filter_column === 'aid' ? 'selected' : ''; ?>>Alumni ID</option>
                                <option value="aemail" <?php echo $filter_column === 'aemail' ? 'selected' : ''; ?>>Email</option>
                                <option value="acompany" <?php echo $filter_column === 'acompany' ? 'selected' : ''; ?>>Company</option>
                                <option value="atitle" <?php echo $filter_column === 'atitle' ? 'selected' : ''; ?>>Job Title</option>
                                <option value="asession" <?php echo $filter_column === 'asession' ? 'selected' : ''; ?>>Passing Year</option>
                            </select>
                            <button type="submit" class="btn btn-search">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a href="signup.php" class="btn btn-add">
                        <i class="fas fa-plus"></i> Add New Alumni
                    </a>
                </div>
            </div>
        </div>

        <!-- Results Section -->
        <div class="results-section">
            <?php if ($total_alumni > 0): ?>
                <div class="table-responsive">
                    <table class="table alumni-table">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Alumni ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Passing Year</th>
                                <th>Company</th>
                                <th>Job Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td class="photo-cell">
                                        <?php if (!empty($row['a_image']) && file_exists($row['a_image'])): ?>
                                            <img src="<?php echo htmlspecialchars($row['a_image']); ?>" 
                                                 alt="<?php echo htmlspecialchars($row['aname']); ?>" 
                                                 class="alumni-photo">
                                        <?php else: ?>
                                            <div class="no-photo">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="id-cell"><?php echo htmlspecialchars($row['aid']); ?></td>
                                    <td class="name-cell">
                                        <?php echo htmlspecialchars($row['aname'] . ' ' . $row['a2name']); ?>
                                    </td>
                                    <td class="email-cell">
                                        <a href="mailto:<?php echo htmlspecialchars($row['aemail']); ?>">
                                            <?php echo htmlspecialchars($row['aemail']); ?>
                                        </a>
                                    </td>
                                    <td class="contact-cell">
                                        <a href="tel:<?php echo htmlspecialchars($row['acontact']); ?>">
                                            <?php echo htmlspecialchars($row['acontact']); ?>
                                        </a>
                                    </td>
                                    <td class="year-cell">
                                        <span class="badge badge-year"><?php echo htmlspecialchars($row['asession']); ?></span>
                                    </td>
                                    <td class="company-cell">
                                        <?php if (!empty($row['acompany'])): ?>
                                            <span class="company-name"><?php echo htmlspecialchars($row['acompany']); ?></span>
                                        <?php else: ?>
                                            <span class="text-muted">Not specified</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="title-cell">
                                        <?php if (!empty($row['atitle'])): ?>
                                            <span class="job-title"><?php echo htmlspecialchars($row['atitle']); ?></span>
                                        <?php else: ?>
                                            <span class="text-muted">Not specified</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="actions-cell">
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-view" onclick="viewAlumni('<?php echo $row['aid']; ?>')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-edit" onclick="editAlumni('<?php echo $row['aid']; ?>')">
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
                    <h3>No Alumni Found</h3>
                    <p>
                        <?php if (!empty($search)): ?>
                            No alumni match your search criteria. Try adjusting your search terms.
                        <?php else: ?>
                            No alumni are currently registered in the system.
                        <?php endif; ?>
                    </p>
                    <a href="signup.php" class="btn btn-primary">Add First Alumni</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function viewAlumni(id) {
    // Implement view functionality
    alert('View alumni with ID: ' + id);
}

function editAlumni(id) {
    // Implement edit functionality
    alert('Edit alumni with ID: ' + id);
}

// Auto-submit form on filter change
document.querySelector('.filter-select').addEventListener('change', function() {
    this.form.submit();
});

// Clear search
function clearSearch() {
    window.location.href = 'alumni.php';
}
</script>

<?php include 'includes/footer.php'; ?>
