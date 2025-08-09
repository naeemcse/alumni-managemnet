
<?php 
$pageTitle = "Alumni of CSE - Home";
$additionalCSS = '<link href="css/homepage-enhanced.css" rel="stylesheet" type="text/css">';
include 'includes/header.php'; 
include '_dbconnect.php';
// Get statistics
$alumni_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Alumni"));
$students_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM RunningStudents"));
$events_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM events"));
$jobs_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM jobs"));

// Get recent events
$recent_events = mysqli_query($conn, "SELECT * FROM events ORDER BY created_at DESC LIMIT 3");

// Get latest jobs
$latest_jobs = mysqli_query($conn, "SELECT * FROM jobs ORDER BY created_at DESC LIMIT 3");
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1 class="hero-title">Welcome to <span>CSE Alumni Network</span></h1>
                        <p class="hero-description">
                            Connect with fellow graduates, discover opportunities, and stay updated with the latest happenings in our Computer Science & Engineering community.
                        </p>
                        <div class="hero-buttons">
                            <a href="alumni.php" class="btn-hero btn-primary">
                                <i class="fas fa-users"></i> Browse Alumni
                            </a>
                            <a href="signup.php" class="btn-hero btn-secondary">
                                <i class="fas fa-user-plus"></i> Join Network
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <img src="img/cse_logo.jpeg" alt="CSE Alumni" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number" data-target="<?php echo $alumni_count; ?>">0</h3>
                        <p class="stat-label">Alumni</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number" data-target="<?php echo $students_count; ?>">0</h3>
                        <p class="stat-label">Current Students</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number" data-target="<?php echo $events_count; ?>">0</h3>
                        <p class="stat-label">Events</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number" data-target="<?php echo $jobs_count; ?>">0</h3>
                        <p class="stat-label">Job Opportunities</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Recent Events Section -->
<?php if (mysqli_num_rows($recent_events) > 0): ?>
<section class="recent-events-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Recent Events</h2>
            <p class="section-subtitle">Stay updated with our latest happenings</p>
        </div>
        <div class="row">
            <?php while ($event = mysqli_fetch_assoc($recent_events)): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="event-card">
                        <?php if (!empty($event['image']) && file_exists($event['image'])): ?>
                            <img src="<?php echo htmlspecialchars($event['image']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" class="event-image">
                        <?php else: ?>
                            <div class="event-placeholder">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        <?php endif; ?>
                        <div class="event-content">
                            <div class="event-date">
                                <i class="fas fa-calendar"></i>
                                <?php echo date('M d, Y', strtotime($event['event_date'])); ?>
                            </div>
                            <h4 class="event-title"><?php echo htmlspecialchars($event['title']); ?></h4>
                            <p class="event-description">
                                <?php echo substr(htmlspecialchars($event['description']), 0, 100) . '...'; ?>
                            </p>
                            <?php if (!empty($event['location'])): ?>
                                <div class="event-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?php echo htmlspecialchars($event['location']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="section-footer">
            <a href="events.php" class="btn-view-all">
                <i class="fas fa-calendar-alt"></i> View All Events
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Latest Jobs Section -->
<?php if (mysqli_num_rows($latest_jobs) > 0): ?>
<section class="latest-jobs-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Latest Job Opportunities</h2>
            <p class="section-subtitle">Discover career opportunities from top companies</p>
        </div>
        <div class="row">
            <?php while ($job = mysqli_fetch_assoc($latest_jobs)): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="job-card">
                        <div class="job-header">
                            <h4 class="job-title"><?php echo htmlspecialchars($job['title']); ?></h4>
                            <span class="job-company"><?php echo htmlspecialchars($job['company']); ?></span>
                        </div>
                        <div class="job-details">
                            <div class="job-position">
                                <i class="fas fa-user-tie"></i>
                                <?php echo htmlspecialchars($job['position']); ?>
                            </div>
                            <?php if (!empty($job['location'])): ?>
                                <div class="job-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?php echo htmlspecialchars($job['location']); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($job['experience_required'])): ?>
                                <div class="job-experience">
                                    <i class="fas fa-clock"></i>
                                    <?php echo htmlspecialchars($job['experience_required']); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($job['deadline'])): ?>
                                <div class="job-deadline">
                                    <i class="fas fa-calendar-times"></i>
                                    Deadline: <?php echo date('M d, Y', strtotime($job['deadline'])); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="job-footer">
                            <?php if (!empty($job['application_link'])): ?>
                                <a href="<?php echo htmlspecialchars($job['application_link']); ?>" target="_blank" class="btn-apply">
                                    <i class="fas fa-external-link-alt"></i> Apply Now
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="section-footer">
            <a href="jobs.php" class="btn-view-all">
                <i class="fas fa-briefcase"></i> View All Jobs
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Quick Search Section -->
<section class="quick-search-section">
    <div class="container">
        <div class="search-wrapper">
            <div class="search-content">
                <h2 class="search-title">Find Alumni & Students</h2>
                <p class="search-subtitle">Connect with your peers and discover their journey</p>
                <div class="search-options">
                    <a href="alumni.php" class="search-option">
                        <div class="search-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4>Alumni Directory</h4>
                        <p>Browse graduated students</p>
                    </a>
                    <a href="students.php" class="search-option">
                        <div class="search-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h4>Current Students</h4>
                        <p>View running students</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Success Stories / Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Success Stories</h2>
            <p class="section-subtitle">Hear from our accomplished alumni</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p>"The CSE department at Comilla University provided me with the foundation I needed to excel in the tech industry. The knowledge and skills I gained here helped me secure a position at Microsoft."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="img/rajibBhai.jpg" alt="Rajib Paul" class="author-photo">
                        <div class="author-info">
                            <h5>Rajib Paul</h5>
                            <p>Software Engineer at Microsoft</p>
                            <span class="graduation-year">Class of 2020</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p>"The networking opportunities and mentorship I received from faculty members were invaluable. It opened doors to amazing career opportunities in California's tech scene."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="img/raihanBhai.jpg" alt="Raihan Khan" class="author-photo">
                        <div class="author-info">
                            <h5>Raihan Khan</h5>
                            <p>Network Engineer, California</p>
                            <span class="graduation-year">Class of 2019</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p>"From student to Assistant Commissioner, the journey has been incredible. The problem-solving skills and logical thinking I developed in CSE helped me in every step of my career."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="img/al imran vai.jpg" alt="Al Imran" class="author-photo">
                        <div class="author-info">
                            <h5>Al Imran</h5>
                            <p>Assistant Commissioner & Executive Magistrate</p>
                            <span class="graduation-year">Class of 2018</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Photo Gallery Section -->
<section class="gallery-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Photo Gallery</h2>
            <p class="section-subtitle">Capturing moments from our vibrant CSE community</p>
        </div>
        
        <?php
        // Get photos from gallery directory
        $gallery_dir = 'img/gallery/';
        $gallery_photos = array();
        
        if (is_dir($gallery_dir)) {
            $files = scandir($gallery_dir);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..' && in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif'])) {
                    $gallery_photos[] = $gallery_dir . $file;
                }
            }
        }
        
        // Display first 8 photos in grid
        $display_photos = array_slice($gallery_photos, 0, 8);
        ?>
        
        <div class="gallery-grid">
            <?php foreach ($display_photos as $index => $photo): ?>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                    <div class="gallery-image-wrapper">
                        <img src="<?php echo htmlspecialchars($photo); ?>" alt="Gallery Image <?php echo $index + 1; ?>" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-overlay-content">
                                <i class="fas fa-search-plus" onclick="openLightbox('<?php echo htmlspecialchars($photo); ?>')"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <?php if (count($gallery_photos) > 8): ?>
            <div class="section-footer">
                <a href="gallery.php" class="btn-view-all">
                    <i class="fas fa-images"></i> View More Photos
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightboxModal" class="lightbox-modal" onclick="closeLightbox()">
    <div class="lightbox-content">
        <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
        <img id="lightboxImage" src="" alt="Gallery Image">
        <div class="lightbox-nav">
            <button class="lightbox-prev" onclick="previousImage()">&#10094;</button>
            <button class="lightbox-next" onclick="nextImage()">&#10095;</button>
        </div>
    </div>
</div>

        <!-- card area start -->
    <div class="card_wrapper" id="faculty">
        <div class="container mt-4">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="head_text">Our Faculty Members</h2>
                    <p class="head_para"></p>
                </div>
                <div class="col-12">
                    <div class="owl-carousel slider_carousel">
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/raju sir.jpeg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Dr. Mahmudul</h4>
                                <h4> Hasan </h4>
                                <p>Chairman</p>
                                <P>Dept. of CSE</P>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/partha sir.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Partha </h4>
                                <h4>Chakraborty</h4>
                                <p>Assistant Professor </p>
                                <p>Dept. of CSE</p>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/Faisal sir.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Md. Faisal Bin </h4>
                                <h4> Abdul Aziz</h4>
                                <p>Assistant Professor</p>
                                <P>Dept. of CSE</P>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/eva mam.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Khairun </h4>
                                <h4>Nahar</h4>
                                <p>Assistant Professor</p>
                                <P>Dept. of CSE</P>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/nishu mam.png" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Mahmuda </h4>
                                <h4> Khatun</h4>
                                <p>Assistant Professor</p>
                                <P>Dept. of CSE</P>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/babar sir.png" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Jahirul Islam Babar</h4>
                                <p>Lecturer</p>
                                <P>Dept. of CSE</P>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/zahid sir.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Md. Zahidur </h4>
                                <h4>Rahman</h4>
                                <p>Lecturer</p>
                                <P>Dept. of CSE</P>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/atik sir.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Md. Atikur </h4>
                                <h4>Rahman</h4>
                                <p>Lecturer</p>
                                <P>Dept. of CSE</P>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="show_more">
                <a href="http://localhost/alumni/search.php" target="_self" class="button beautiful-button">See More Faculty</a>
            </div>
        </div>
    </div>
    <!-- card area end -->

    <!-- Alumni area start -->
    <div class="card_wrapper card_wrapper2" id="alumni">
        <div class="container mt-4">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="head_text">Our Alumni</h2>
                    <p class="head_para"></p>
                </div>
                <div class="col-12">
                    <div class="owl-carousel slider_carousel">
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/rajibBhai.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4> Rajib Paul</h4>
                                <p>Software Engineer. Microsoft</p>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/raihanBhai.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Raihan Khan</h4>
                                <p>Network Engineer. California</p>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/mahabubBhai.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Mahbubur </h4>
                                <p>Software Engineer. TigerIT</p>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/shafi vai.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Jawad Shafi</h4>
                                <p>Security Engineer. Banglalink</p>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/mestu paul vai.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Mestu Paul</h4>
                                <p>Software Engineer. Orbitax</p>
                            </div>
                        </div>
                       
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/bappyBhai.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Reazul Haque</h4>
                                <p>Software Engineer. Samsung </p>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/al imran vai.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Al Imran</h4>
                                <p>Assistant Commissioner & Executive Magistrate</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="show_more">
                <a href="http://localhost/alumni/search.php" target="_self" class="button beautiful-button2">See More Alumni</a>
            </div>
        </div>
    </div>
    <!-- Alumni area end -->
     <!-- Running Students -->
     <div class="card_wrapper card_wrapper2" id="running-student">
        <div class="container mt-4">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="head_text">Our Running Students</h2>
                    <p class="head_para"></p>
                </div>
                <div class="col-12">
                    <div class="owl-carousel slider_carousel">
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/eftekar.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Eftekar </h4>
                                <h4>Alam</h4>
                                <p>Web Developer</p>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/refat.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Rayhan</h4>
                                <h4>Refat</h4>
                                <p>Web Developer</p>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/jahid.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Avronil</h4>
                                <h4>Jahid</h4>
                                <p>Web Developer</p>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/mahi.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Mohsen</h4>
                                <h4>Amin</h4>
                                <p>Cyber Security Expert</p>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/himel.jpg" style="height: 200px;" alt="">
                            <div class="card_text"> 
                                <h4>Himel</h4>
                                <p>Machine Learning Expert</p>
                                
                            </div>
                        </div>
                       
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/aman vai.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Aman</h4>
                                <h4>Bhuiyan</h4>
                                <p>Cyber Security Expert</p>
                            </div>
                        </div>
                        <div class="card_box">
                            <img class="img-fluid w-100" src="img/rakib joy vai.jpg" style="height: 200px;" alt="">
                            <div class="card_text">
                                <h4>Rakib</h4>
                                <h4>Joy</h4>
                                <p>Programmer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="show_more">
                <a href="http://localhost/alumni/search.php" target="_self" class="button beautiful-button2">See More Students</a>
            </div>
        </div>
    </div>


   <!-- Your page content ends here -->

<!-- Enhanced Homepage JavaScript -->
<script>
// Animated Counter
function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            start = target;
            clearInterval(timer);
        }
        element.textContent = Math.floor(start);
    }, 16);
}

// Initialize counters when they come into view
function initCounters() {
    const counters = document.querySelectorAll('.stat-number');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                const target = parseInt(entry.target.getAttribute('data-target'));
                animateCounter(entry.target, target);
                entry.target.classList.add('animated');
            }
        });
    }, {
        threshold: 0.5
    });
    
    counters.forEach(counter => observer.observe(counter));
}

// Smooth scrolling for anchor links
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Parallax effect for hero section
function initParallax() {
    const hero = document.querySelector('.hero-section');
    if (hero) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            hero.style.transform = `translateY(${rate}px)`;
        });
    }
}

// Initialize all enhanced features
document.addEventListener('DOMContentLoaded', function() {
    initCounters();
    initSmoothScroll();
    initParallax();
    
    // Add loading animation
    document.body.classList.add('loaded');
});

// Gallery Lightbox functionality
let currentImageIndex = 0;
let galleryImages = [];

function openLightbox(imageSrc) {
    // Get all gallery images
    const galleryItems = document.querySelectorAll('.gallery-image');
    galleryImages = Array.from(galleryItems).map(img => img.src);
    currentImageIndex = galleryImages.indexOf(imageSrc);
    
    document.getElementById('lightboxImage').src = imageSrc;
    document.getElementById('lightboxModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightboxModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
    document.getElementById('lightboxImage').src = galleryImages[currentImageIndex];
}

function previousImage() {
    currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
    document.getElementById('lightboxImage').src = galleryImages[currentImageIndex];
}

// Close lightbox with escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    } else if (e.key === 'ArrowRight') {
        nextImage();
    } else if (e.key === 'ArrowLeft') {
        previousImage();
    }
});

// Loading animation CSS
const style = document.createElement('style');
style.textContent = `
    body {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }
    body.loaded {
        opacity: 1;
    }
    .stat-card, .event-card, .job-card, .search-option {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.6s ease forwards;
    }
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);
</script>

<?php include 'includes/footer.php'; ?> 