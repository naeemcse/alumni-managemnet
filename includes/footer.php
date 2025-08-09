<footer class="professional-footer">
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <!-- About Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-section">
                        <h5 class="footer-title">
                            <i class="fas fa-graduation-cap me-2"></i>
                            CSE Alumni Network
                        </h5>
                        <p class="footer-text">
                            Connecting Computer Science & Engineering graduates from Comilla University. 
                            Building a strong network for career growth, knowledge sharing, and community development.
                        </p>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Comilla University, Kotbari, Cumilla</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>cse@cou.ac.bd</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-section">
                        <h5 class="footer-title">Quick Links</h5>
                        <ul class="footer-links">
                            <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                            <li><a href="alumni.php"><i class="fas fa-users"></i> Alumni</a></li>
                            <li><a href="students.php"><i class="fas fa-user-graduate"></i> Students</a></li>
                            <li><a href="events.php"><i class="fas fa-calendar-alt"></i> Events</a></li>
                            <li><a href="jobs.php"><i class="fas fa-briefcase"></i> Jobs</a></li>
                            <li><a href="gallery.php"><i class="fas fa-images"></i> Gallery</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Services -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-section">
                        <h5 class="footer-title">Services</h5>
                        <ul class="footer-links">
                            <li><a href="signup.php"><i class="fas fa-user-plus"></i> Join Network</a></li>
                            <li><a href="search.php"><i class="fas fa-search"></i> Alumni Search</a></li>
                            <li><a href="#"><i class="fas fa-handshake"></i> Mentorship</a></li>
                            <li><a href="#"><i class="fas fa-users"></i> Networking</a></li>
                            <li><a href="#"><i class="fas fa-trophy"></i> Achievements</a></li>
                            <li><a href="admin-login.php"><i class="fas fa-user-shield"></i> Admin</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Department & Social -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-section">
                        <h5 class="footer-title">Department Links</h5>
                        <div class="department-links mb-3">
                            <a href="https://www.cou.ac.bd/cse/department-details" target="_blank" class="dept-link">
                                <i class="fas fa-university"></i>
                                CSE Department - CoU
                            </a>
                            <a href="https://www.cou.ac.bd" target="_blank" class="dept-link">
                                <i class="fas fa-globe"></i>
                                Comilla University
                            </a>
                        </div>
                        
                        <h6 class="social-title">Follow Us</h6>
                        <div class="social-links">
                            <a href="https://www.facebook.com/groups/CSESocietyCoU/" target="_blank" class="social-link facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" target="_blank" class="social-link linkedin">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" target="_blank" class="social-link twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" target="_blank" class="social-link youtube">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="#" target="_blank" class="social-link github">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                        
                        <div class="newsletter mt-3">
                            <h6 class="newsletter-title">Stay Updated</h6>
                            <p class="newsletter-text">Get latest updates about events and opportunities</p>
                            <div class="newsletter-form">
                                <input type="email" class="form-control" placeholder="Enter your email">
                                <button type="button" class="btn btn-subscribe">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright">
                        &copy; 2025 <strong>CSE Alumni Network</strong>. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="developer-credit">
                        <i class="fas fa-code"></i> Developed with <i class="fas fa-heart text-danger"></i> by <strong>CSE Department</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
  
    </div>

   
</footer>

<!-- Professional Footer Styles -->
<style>
.professional-footer {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: #ecf0f1;
    margin-top: 5rem;
}

.footer-main {
    padding: 4rem 0 2rem 0;
}

.footer-section {
    height: 100%;
}

.footer-title {
    color: #fff;
    font-weight: 600;
    margin-bottom: 1.5rem;
    font-size: 1.1rem;
    position: relative;
    padding-bottom: 0.5rem;
}

.footer-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 2px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 2px;
}

.footer-text {
    color: #bdc3c7;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
}

.contact-info {
    margin-top: 1rem;
}

.contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
    color: #bdc3c7;
    font-size: 0.9rem;
}

.contact-item i {
    color: #667eea;
    margin-right: 0.75rem;
    width: 15px;
    text-align: center;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 0.75rem;
}

.footer-links a {
    color: #bdc3c7;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
}

.footer-links a i {
    margin-right: 0.5rem;
    width: 15px;
    text-align: center;
    color: #667eea;
}

.footer-links a:hover {
    color: #667eea;
    transform: translateX(5px);
}

.department-links {
    margin-bottom: 1.5rem;
}

.dept-link {
    display: block;
    color: #bdc3c7;
    text-decoration: none;
    padding: 0.5rem 0;
    border-bottom: 1px solid #34495e;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.dept-link:hover {
    color: #667eea;
    border-bottom-color: #667eea;
}

.dept-link i {
    margin-right: 0.75rem;
    color: #667eea;
    width: 15px;
    text-align: center;
}

.social-title, .newsletter-title {
    color: #fff;
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 1rem;
}

.social-links {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    text-decoration: none;
    color: #fff;
    transition: all 0.3s ease;
    font-size: 1.1rem;
}

.social-link.facebook { background: #3b5998; }
.social-link.linkedin { background: #0077b5; }
.social-link.twitter { background: #1da1f2; }
.social-link.youtube { background: #ff0000; }
.social-link.github { background: #333; }

.social-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    color: #fff;
}

.newsletter-text {
    color: #bdc3c7;
    font-size: 0.85rem;
    margin-bottom: 1rem;
}

.newsletter-form {
    display: flex;
    gap: 0.5rem;
}

.newsletter-form .form-control {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    color: #fff;
    font-size: 0.9rem;
    padding: 0.5rem 0.75rem;
}

.newsletter-form .form-control::placeholder {
    color: #bdc3c7;
}

.newsletter-form .form-control:focus {
    background: rgba(255,255,255,0.15);
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    color: #fff;
}

.btn-subscribe {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: #fff;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    transition: all 0.3s ease;
}

.btn-subscribe:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

.footer-bottom {
    background: rgba(0,0,0,0.2);
    padding: 1.5rem 0;
    border-top: 1px solid rgba(255,255,255,0.1);
}

.copyright, .developer-credit {
    margin: 0;
    color: #bdc3c7;
    font-size: 0.9rem;
}

.developer-credit strong {
    color: #667eea;
}

.developer-credit .fa-heart {
    animation: heartbeat 1.5s ease-in-out infinite;
}

@keyframes heartbeat {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .footer-main {
        padding: 3rem 0 1.5rem 0;
    }
    
    .social-links {
        justify-content: center;
    }
    
    .newsletter-form {
        flex-direction: column;
    }
    
    .newsletter-form .btn-subscribe {
        margin-top: 0.5rem;
    }
    
    .footer-bottom .col-md-6:last-child {
        text-align: center !important;
        margin-top: 1rem;
    }
}
</style>

<!-- all js here -->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>

<!-- Additional JS if needed -->
<?php if(isset($additionalJS)) echo $additionalJS; ?>

</body>
</html>