<?php 
$pageTitle = "Photo Gallery - CSE Alumni";
$additionalCSS = '<link href="css/homepage-enhanced.css" rel="stylesheet" type="text/css">';
include 'includes/header.php'; 
include '_dbconnect.php';

// Get all photos from gallery directory
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
?>

<div class="container-fluid py-5" style="background: #f8f9fa;">
    <div class="container">
        <!-- Page Header -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-4 mb-3" style="color: #2c3e50; font-weight: 700;">
                    <i class="fas fa-images mr-3" style="color: #667eea;"></i>
                    Photo Gallery
                </h1>
                <p class="lead text-muted">
                    Explore memorable moments from our CSE community - events, graduations, and achievements
                </p>
                <div style="width: 100px; height: 3px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: 0 auto;"></div>
            </div>
        </div>

        <!-- Gallery Filter Buttons -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary active" onclick="filterGallery('all')">
                        <i class="fas fa-th"></i> All Photos
                    </button>
                    <button type="button" class="btn btn-outline-primary" onclick="filterGallery('events')">
                        <i class="fas fa-calendar-alt"></i> Events
                    </button>
                    <button type="button" class="btn btn-outline-primary" onclick="filterGallery('graduation')">
                        <i class="fas fa-graduation-cap"></i> Graduations
                    </button>
                    <button type="button" class="btn btn-outline-primary" onclick="filterGallery('students')">
                        <i class="fas fa-user-graduate"></i> Students
                    </button>
                </div>
            </div>
        </div>

        <!-- Photo Gallery Grid -->
        <?php if (!empty($gallery_photos)): ?>
            <div class="gallery-grid-full">
                <?php foreach ($gallery_photos as $index => $photo): 
                    $filename = basename($photo);
                    $category = 'all';
                    
                    // Determine category based on filename
                    if (strpos($filename, 'event') !== false) {
                        $category = 'events';
                    } elseif (strpos($filename, 'graduation') !== false) {
                        $category = 'graduation';
                    } elseif (strpos($filename, 'student') !== false) {
                        $category = 'students';
                    }
                ?>
                    <div class="gallery-item-full" data-category="<?php echo $category; ?>" data-aos="fade-up" data-aos-delay="<?php echo ($index % 12) * 100; ?>">
                        <div class="gallery-image-wrapper-full">
                            <img src="<?php echo htmlspecialchars($photo); ?>" alt="Gallery Image <?php echo $index + 1; ?>" class="gallery-image-full">
                            <div class="gallery-overlay-full">
                                <div class="gallery-overlay-content-full">
                                    <button class="btn-gallery-view" onclick="openLightboxFull('<?php echo htmlspecialchars($photo); ?>')">
                                        <i class="fas fa-search-plus"></i>
                                    </button>
                                    <div class="photo-info">
                                        <small class="text-white"><?php echo ucfirst($category); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-12 text-center py-5">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <h3 class="text-muted">No Photos Available</h3>
                    <p class="text-muted">Photos will be displayed here once they are uploaded to the gallery.</p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Back to Home Button -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="index.php" class="btn btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 50px; padding: 12px 30px;">
                    <i class="fas fa-home mr-2"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightboxModalFull" class="lightbox-modal" onclick="closeLightboxFull()">
    <div class="lightbox-content">
        <span class="lightbox-close" onclick="closeLightboxFull()">&times;</span>
        <img id="lightboxImageFull" src="" alt="Gallery Image">
        <div class="lightbox-nav">
            <button class="lightbox-prev" onclick="previousImageFull()">&#10094;</button>
            <button class="lightbox-next" onclick="nextImageFull()">&#10095;</button>
        </div>
    </div>
</div>

<!-- Custom CSS for Gallery Page -->
<style>
.gallery-grid-full {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.gallery-item-full {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    aspect-ratio: 4/3;
}

.gallery-item-full:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.gallery-image-wrapper-full {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.gallery-image-full {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item-full:hover .gallery-image-full {
    transform: scale(1.1);
}

.gallery-overlay-full {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(102, 126, 234, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item-full:hover .gallery-overlay-full {
    opacity: 1;
}

.gallery-overlay-content-full {
    text-align: center;
}

.btn-gallery-view {
    background: white;
    color: #667eea;
    border: none;
    padding: 1rem;
    border-radius: 50%;
    font-size: 1.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 1rem;
}

.btn-gallery-view:hover {
    background: #667eea;
    color: white;
    transform: scale(1.1);
}

.photo-info {
    text-align: center;
}

.btn-outline-primary {
    border-color: #667eea;
    color: #667eea;
}

.btn-outline-primary:hover,
.btn-outline-primary.active {
    background-color: #667eea;
    border-color: #667eea;
    color: white;
}

/* Hide filtered items */
.gallery-item-full.hidden {
    display: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .gallery-grid-full {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
    }
    
    .btn-group {
        flex-direction: column;
        width: 100%;
    }
    
    .btn-group .btn {
        border-radius: 0.375rem !important;
        margin-bottom: 0.5rem;
    }
}
</style>

<!-- JavaScript for Gallery Functionality -->
<script>
// Gallery filtering
function filterGallery(category) {
    const items = document.querySelectorAll('.gallery-item-full');
    const buttons = document.querySelectorAll('.btn-group .btn');
    
    // Update active button
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    // Filter items
    items.forEach(item => {
        const itemCategory = item.getAttribute('data-category');
        if (category === 'all' || itemCategory === category) {
            item.classList.remove('hidden');
            item.style.display = 'block';
        } else {
            item.classList.add('hidden');
            item.style.display = 'none';
        }
    });
}

// Lightbox functionality for gallery page
let currentImageIndexFull = 0;
let galleryImagesFull = [];

function openLightboxFull(imageSrc) {
    const visibleItems = document.querySelectorAll('.gallery-item-full:not(.hidden) .gallery-image-full');
    galleryImagesFull = Array.from(visibleItems).map(img => img.src);
    currentImageIndexFull = galleryImagesFull.indexOf(imageSrc);
    
    document.getElementById('lightboxImageFull').src = imageSrc;
    document.getElementById('lightboxModalFull').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeLightboxFull() {
    document.getElementById('lightboxModalFull').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function nextImageFull() {
    currentImageIndexFull = (currentImageIndexFull + 1) % galleryImagesFull.length;
    document.getElementById('lightboxImageFull').src = galleryImagesFull[currentImageIndexFull];
}

function previousImageFull() {
    currentImageIndexFull = (currentImageIndexFull - 1 + galleryImagesFull.length) % galleryImagesFull.length;
    document.getElementById('lightboxImageFull').src = galleryImagesFull[currentImageIndexFull];
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('lightboxModalFull');
    if (modal.style.display === 'block') {
        if (e.key === 'Escape') {
            closeLightboxFull();
        } else if (e.key === 'ArrowRight') {
            nextImageFull();
        } else if (e.key === 'ArrowLeft') {
            previousImageFull();
        }
    }
});

// AOS Animation (if available)
if (typeof AOS !== 'undefined') {
    AOS.init({
        duration: 600,
        offset: 100,
        once: true
    });
}
</script>

<?php include 'includes/footer.php'; ?>
