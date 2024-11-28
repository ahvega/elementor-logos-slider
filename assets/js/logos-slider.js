/**
 * LogoSlider class
 * @class LogoSlider
 * @param {HTMLElement} element - The main container element for the logo slider
 */
class LogoSlider {
    constructor(element) {
        this.element = element;
        this.track = element.querySelector('.logo-track');
        this.init();
        this.disableImageDownload();
    }

    init() {
        // Get settings from Elementor
        const settings = this.element.dataset;

        // Force a reflow to ensure animation starts properly
        this.track.style.animation = 'none';
        this.track.offsetHeight; // Trigger reflow
        this.track.style.animation = null;

        // Initialize intersection observer
        this.setupIntersectionObserver();
    }

    setupIntersectionObserver() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.track.style.animationPlayState = 'running';
                } else {
                    this.track.style.animationPlayState = 'paused';
                }
            });
        }, { threshold: 0.1 });

        observer.observe(this.element);
    }

    disableImageDownload() {
        // Prevent right-click on the slider section
        this.element.addEventListener('contextmenu', (e) => {
            e.preventDefault();
            return false;
        });

        // Prevent dragging of images
        this.element.addEventListener('dragstart', (e) => {
            e.preventDefault();
            return false;
        });

        // Prevent image downloads through keyboard shortcuts
        this.element.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                return false;
            }
        });
    }
}

// Initialize all logo sliders when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const sliders = document.querySelectorAll('.logo-slider-section');
    sliders.forEach(slider => new LogoSlider(slider));
});

// Initialize for Elementor frontend
jQuery(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/logos-slider.default', ($element) => {
        new LogoSlider($element[0]);
    });
});

function updateLogoAnimationTiming() {
    const container = document.querySelector('.logo-slider-container');
    if (!container) return;

    const logos = container.querySelectorAll('.logo-item');
    const containerWidth = container.offsetWidth;

    logos.forEach((logo, index) => {
        const logoWidth = logo.offsetWidth + parseInt(getComputedStyle(logo).marginLeft) + parseInt(getComputedStyle(logo).marginRight);
        const animationDuration = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--animation-duration'));

        // Calculate time for one logo to enter completely
        const entryTime = (logoWidth / containerWidth) * animationDuration;

        // Calculate delay based on logo position
        const delay = (index * logoWidth / containerWidth) * animationDuration;

        logo.style.animationDuration = `${entryTime * 2}s`; // Double the time to account for both fade in and out
        logo.style.animationDelay = `-${delay}s`;
    });
}

// Run on load and resize
window.addEventListener('load', updateLogoAnimationTiming);
window.addEventListener('resize', updateLogoAnimationTiming);

// Add mutation observer for Elementor editor changes
const observer = new MutationObserver(updateLogoAnimationTiming);
observer.observe(document.body, { subtree: true, childList: true });