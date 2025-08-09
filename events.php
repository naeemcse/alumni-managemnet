<?php
include '_dbconnect.php';

$pageTitle = "Events - CSE Alumni Portal";
$additionalCSS = '<link href="css/directory.css" rel="stylesheet" type="text/css">';
include 'includes/header.php';
?>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header text-center mb-5">
                    <h1 class="display-4 mb-3">Upcoming Events</h1>
                    <p class="lead">Stay updated with the latest events and activities from CSE Department</p>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            // Get active events ordered by event date
            $sql = "SELECT * FROM Events WHERE status = 'active' ORDER BY event_date ASC";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0):
                while ($event = mysqli_fetch_assoc($result)):
                    $event_date = new DateTime($event['event_date']);
                    $current_date = new DateTime();
                    $is_past = $event_date < $current_date;
            ?>
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="event-card <?php echo $is_past ? 'past-event' : ''; ?>">
                        <?php if ($event['image']): ?>
                            <div class="event-image">
                                <img src="uploads/events/<?php echo htmlspecialchars($event['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($event['title']); ?>"
                                     class="img-fluid">
                                <?php if ($is_past): ?>
                                    <div class="event-overlay">
                                        <span class="event-status">Past Event</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="event-content">
                            <div class="event-date">
                                <div class="date-box">
                                    <span class="day"><?php echo $event_date->format('d'); ?></span>
                                    <span class="month"><?php echo $event_date->format('M'); ?></span>
                                    <span class="year"><?php echo $event_date->format('Y'); ?></span>
                                </div>
                            </div>
                            
                            <h3 class="event-title">
                                <?php echo htmlspecialchars($event['title']); ?>
                            </h3>
                            
                            <div class="event-meta">
                                <?php if ($event['location']): ?>
                                    <div class="meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span><?php echo htmlspecialchars($event['location']); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span><?php echo $event_date->format('g:i A'); ?></span>
                                </div>
                                
                                <?php if ($event['organizer']): ?>
                                    <div class="meta-item">
                                        <i class="fas fa-user"></i>
                                        <span><?php echo htmlspecialchars($event['organizer']); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <p class="event-description">
                                <?php echo nl2br(htmlspecialchars($event['description'])); ?>
                            </p>
                            
                            <?php if ($event['registration_link'] && !$is_past): ?>
                                <div class="event-actions">
                                    <a href="<?php echo htmlspecialchars($event['registration_link']); ?>" 
                                       target="_blank" class="btn btn-primary">
                                        <i class="fas fa-external-link-alt"></i> Register Now
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php 
                endwhile;
            else:
            ?>
                <div class="col-12">
                    <div class="no-events">
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                            <h3 class="text-muted">No Events Scheduled</h3>
                            <p class="text-muted">There are currently no upcoming events. Please check back later.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.event-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.event-card.past-event {
    opacity: 0.7;
}

.event-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.event-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.event-card:hover .event-image img {
    transform: scale(1.05);
}

.event-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
}

.event-status {
    background: #dc3545;
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
}

.event-content {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative;
}

.event-date {
    position: absolute;
    top: -30px;
    right: 25px;
}

.date-box {
    background: #007bff;
    color: white;
    padding: 10px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,123,255,0.3);
    min-width: 60px;
}

.date-box .day {
    display: block;
    font-size: 20px;
    font-weight: bold;
    line-height: 1;
}

.date-box .month {
    display: block;
    font-size: 12px;
    text-transform: uppercase;
    line-height: 1;
    margin-top: 2px;
}

.date-box .year {
    display: block;
    font-size: 11px;
    line-height: 1;
    opacity: 0.8;
}

.event-title {
    font-size: 1.4rem;
    font-weight: 600;
    margin: 20px 0 15px 0;
    color: #333;
    line-height: 1.3;
}

.event-meta {
    margin-bottom: 15px;
}

.meta-item {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    color: #666;
    font-size: 0.9rem;
}

.meta-item i {
    width: 16px;
    margin-right: 8px;
    color: #007bff;
}

.event-description {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
    flex: 1;
}

.event-actions {
    margin-top: auto;
}

.no-events {
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
    .event-date {
        position: static;
        margin-bottom: 15px;
        text-align: center;
    }
    
    .event-title {
        margin-top: 0;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
