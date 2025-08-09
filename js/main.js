document.addEventListener('DOMContentLoaded', function() {
    // Desktop dropdown functionality (backup in case header.php script doesn't load)
    const dropdownBtn = document.getElementById('menuDropdown');
    const dropdownMenu = document.getElementById('dropdownMenu');
    
    if (dropdownBtn && dropdownMenu) {
        // Only add if no existing listeners
        if (!dropdownBtn.hasAttribute('data-listener-added')) {
            dropdownBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('show');
            });
            dropdownBtn.setAttribute('data-listener-added', 'true');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            dropdownMenu.classList.remove('show');
        });

        dropdownMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
    
    // Initialize carousel when DOM is ready
    slider_carouselInit();
});
    
// Js for Carosel  
function slider_carouselInit() {
    if (typeof $ !== 'undefined' && $.fn.owlCarousel) {
        $('.owl-carousel.slider_carousel').owlCarousel({
            dots: false,
            loop: true,
            margin: 30,
            stagePadding: 2,
            autoplay: false,
            nav: true,
            navText: ["<i class='far fa-arrow-alt-circle-left'></i>","<i class='far fa-arrow-alt-circle-right'></i>"],
            autoplayTimeout: 1500,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        });
    }
}
