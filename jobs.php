<?php
include '_dbconnect.php';

$pageTitle = "Job Circulars - CSE Alumni Portal";
$additionalCSS = '<link href="css/directory.css" rel="stylesheet" type="text/css">';
include 'includes/header.php';
?>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header text-center mb-5">
                    <h1 class="display-4 mb-3">Job Opportunities</h1>
                    <p class="lead">Explore exciting career opportunities for CSE graduates and students</p>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="filter-section">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <input type="text" id="searchJobs" class="form-control" placeholder="Search jobs...">
                        </div>
                        <div class="col-md-2">
                            <select id="experienceFilter" class="form-select">
                                <option value="">All Experience</option>
                                <option value="entry">Entry Level</option>
                                <option value="1-2">1-2 years</option>
                                <option value="3-5">3-5 years</option>
                                <option value="5+">5+ years</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="locationFilter" class="form-control" placeholder="Filter by location...">
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="clearFilters" class="btn btn-outline-secondary w-100">
                                Clear Filters
                            </button>
                        </div>
                        <div class="col-md-2 text-end">
                            <div class="job-count">
                                <span id="jobCount"><?php 
                                    $count_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM Jobs WHERE status = 'active'");
                                    $count = mysqli_fetch_assoc($count_result)['total'];
                                    echo $count;
                                ?></span> Jobs Available
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="jobsContainer">
            <?php
            // Get active jobs ordered by creation date
            $sql = "SELECT * FROM Jobs WHERE status = 'active' ORDER BY created_at DESC";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0):
                while ($job = mysqli_fetch_assoc($result)):
                    $deadline = $job['deadline'] ? new DateTime($job['deadline']) : null;
                    $current_date = new DateTime();
                    $is_expired = $deadline && $deadline < $current_date;
            ?>
                <div class="col-lg-6 col-xl-4 mb-4 job-item" 
                     data-title="<?php echo strtolower($job['title']); ?>"
                     data-company="<?php echo strtolower($job['company']); ?>"
                     data-position="<?php echo strtolower($job['position']); ?>"
                     data-experience="<?php echo strtolower($job['experience']); ?>"
                     data-location="<?php echo strtolower($job['location']); ?>">
                    <div class="job-card <?php echo $is_expired ? 'expired-job' : ''; ?>">
                        <div class="job-header">
                            <div class="company-info">
                                <h3 class="job-title"><?php echo htmlspecialchars($job['title']); ?></h3>
                                <p class="company-name"><?php echo htmlspecialchars($job['company']); ?></p>
                            </div>
                            <?php if ($is_expired): ?>
                                <div class="job-status expired">
                                    <i class="fas fa-clock"></i>
                                    Expired
                                </div>
                            <?php else: ?>
                                <div class="job-status active">
                                    <i class="fas fa-briefcase"></i>
                                    Active
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="job-details">
                            <div class="detail-row">
                                <i class="fas fa-user-tie"></i>
                                <span><strong>Position:</strong> <?php echo htmlspecialchars($job['position']); ?></span>
                            </div>
                            
                            <?php if ($job['experience']): ?>
                                <div class="detail-row">
                                    <i class="fas fa-star"></i>
                                    <span><strong>Experience:</strong> <?php echo htmlspecialchars($job['experience']); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($job['location']): ?>
                                <div class="detail-row">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($job['salary']): ?>
                                <div class="detail-row">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span><strong>Salary:</strong> <?php echo htmlspecialchars($job['salary']); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($deadline): ?>
                                <div class="detail-row">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span><strong>Deadline:</strong> <?php echo $deadline->format('M d, Y'); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="job-description">
                            <p><?php echo nl2br(htmlspecialchars(substr($job['description'], 0, 150))); ?>
                            <?php if (strlen($job['description']) > 150): ?>...<?php endif; ?></p>
                        </div>
                        
                        <?php if ($job['requirements']): ?>
                            <div class="job-requirements">
                                <h5>Key Requirements:</h5>
                                <p><?php echo nl2br(htmlspecialchars(substr($job['requirements'], 0, 100))); ?>
                                <?php if (strlen($job['requirements']) > 100): ?>...<?php endif; ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <div class="job-actions">
                            <?php if (!$is_expired): ?>
                                <a href="<?php echo htmlspecialchars($job['apply_link']); ?>" 
                                   target="_blank" class="btn btn-primary apply-btn">
                                    <i class="fas fa-external-link-alt"></i> Apply Now
                                </a>
                            <?php else: ?>
                                <button class="btn btn-secondary" disabled>
                                    <i class="fas fa-times"></i> Application Closed
                                </button>
                            <?php endif; ?>
                            <small class="text-muted">Posted on <?php echo date('M d, Y', strtotime($job['created_at'])); ?></small>
                        </div>
                    </div>
                </div>
            <?php 
                endwhile;
            else:
            ?>
                <div class="col-12">
                    <div class="no-jobs">
                        <div class="text-center py-5">
                            <i class="fas fa-briefcase fa-4x text-muted mb-3"></i>
                            <h3 class="text-muted">No Job Opportunities Available</h3>
                            <p class="text-muted">There are currently no active job postings. Please check back later.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.filter-section {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.job-count {
    font-weight: 600;
    color: #007bff;
}

.job-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.job-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.job-card.expired-job {
    opacity: 0.6;
    background: #f8f9fa;
}

.job-header {
    padding: 20px 20px 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.company-info h3 {
    font-size: 1.4rem;
    font-weight: 600;
    margin: 0 0 5px 0;
    color: #333;
    line-height: 1.3;
}

.company-name {
    color: #007bff;
    font-weight: 500;
    margin: 0;
    font-size: 1.1rem;
}

.job-status {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.job-status.active {
    background: #d4edda;
    color: #155724;
}

.job-status.expired {
    background: #f8d7da;
    color: #721c24;
}

.job-details {
    padding: 0 20px 15px 20px;
}

.detail-row {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    color: #666;
    font-size: 0.9rem;
}

.detail-row i {
    width: 18px;
    margin-right: 10px;
    color: #007bff;
}

.job-description {
    padding: 0 20px 15px 20px;
    color: #666;
    line-height: 1.6;
}

.job-requirements {
    padding: 0 20px 15px 20px;
    background: #f8f9fa;
    margin: 0 20px;
    border-radius: 8px;
}

.job-requirements h5 {
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 5px;
    color: #333;
}

.job-requirements p {
    font-size: 0.85rem;
    color: #666;
    margin: 0;
    line-height: 1.5;
}

.job-actions {
    padding: 20px;
    margin-top: auto;
    border-top: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.apply-btn {
    padding: 10px 20px;
    font-weight: 600;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.apply-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,123,255,0.3);
}

.no-jobs {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.page-header {
    margin-bottom: 3rem;
}

.page-header h1 {
    color: #333;
    font-weight: 700;
}

.page-header .lead {
    color: #666;
    font-size: 1.2rem;
}

@media (max-width: 768px) {
    .job-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .job-status {
        margin-top: 10px;
    }
    
    .job-actions {
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
    }
    
    .filter-section .row {
        gap: 15px;
    }
    
    .filter-section .col-md-2,
    .filter-section .col-md-3 {
        margin-bottom: 10px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchJobs');
    const experienceFilter = document.getElementById('experienceFilter');
    const locationFilter = document.getElementById('locationFilter');
    const clearFiltersBtn = document.getElementById('clearFilters');
    const jobItems = document.querySelectorAll('.job-item');
    const jobCount = document.getElementById('jobCount');

    function filterJobs() {
        const searchTerm = searchInput.value.toLowerCase();
        const experienceValue = experienceFilter.value.toLowerCase();
        const locationValue = locationFilter.value.toLowerCase();
        
        let visibleCount = 0;

        jobItems.forEach(item => {
            const title = item.dataset.title;
            const company = item.dataset.company;
            const position = item.dataset.position;
            const experience = item.dataset.experience;
            const location = item.dataset.location;

            const matchesSearch = !searchTerm || 
                title.includes(searchTerm) || 
                company.includes(searchTerm) || 
                position.includes(searchTerm);
            
            const matchesExperience = !experienceValue || 
                experience.includes(experienceValue);
            
            const matchesLocation = !locationValue || 
                location.includes(locationValue);

            if (matchesSearch && matchesExperience && matchesLocation) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        jobCount.textContent = visibleCount;
    }

    function clearFilters() {
        searchInput.value = '';
        experienceFilter.value = '';
        locationFilter.value = '';
        filterJobs();
    }

    searchInput.addEventListener('input', filterJobs);
    experienceFilter.addEventListener('change', filterJobs);
    locationFilter.addEventListener('input', filterJobs);
    clearFiltersBtn.addEventListener('click', clearFilters);
});
</script>

<?php include 'includes/footer.php'; ?>
