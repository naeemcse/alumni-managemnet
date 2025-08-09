<?php 
$pageTitle = "Quick Search - Alumni Portal";
$additionalCSS = '<style>
.search-container {
    min-height: 80vh;
    padding: 2rem 0;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.search-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.search-card h2 {
    color: #2c3e50;
    margin-bottom: 1rem;
    font-weight: 700;
}

.search-card p {
    color: #7f8c8d;
    margin-bottom: 2rem;
    font-size: 1.1rem;
}

.directory-options {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-top: 2rem;
}

.directory-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    border-radius: 15px;
    text-decoration: none;
    transition: all 0.3s ease;
    text-align: center;
}

.directory-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
    color: white;
    text-decoration: none;
}

.directory-card h3 {
    margin-bottom: 0.5rem;
    font-size: 1.5rem;
}

.directory-card p {
    margin: 0;
    opacity: 0.9;
}

.directory-card i {
    font-size: 3rem;
    margin-bottom: 1rem;
    display: block;
}

@media (max-width: 768px) {
    .directory-options {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}
</style>';
include 'includes/header.php'; 
?>

<div class="search-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="search-card">
                    <h2>Quick Search Portal</h2>
                    <p>Choose which directory you want to search through</p>
                    
                    <div class="directory-options">
                        <a href="alumni.php" class="directory-card">
                            <i class="fas fa-graduation-cap"></i>
                            <h3>Alumni Directory</h3>
                            <p>Search through graduated students</p>
                        </a>
                        
                        <a href="students.php" class="directory-card">
                            <i class="fas fa-user-graduate"></i>
                            <h3>Running Students</h3>
                            <p>Search through current students</p>
                        </a>
                    </div>
                    
                    <hr style="margin: 2rem 0; border-color: #e9ecef;">
                    
                    <p style="margin-bottom: 1rem; color: #6c757d;">
                        <strong>Quick Actions:</strong>
                    </p>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <a href="signup.php" class="btn btn-primary btn-lg w-100" style="background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); border: none; margin-bottom: 1rem;">
                                <i class="fas fa-plus"></i> Register New Member
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="index.php" class="btn btn-outline-primary btn-lg w-100">
                                <i class="fas fa-home"></i> Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
