// Fancybox for images
Fancybox.bind("[data-fancybox^=gallery1]", {
    loop: true,
    buttons: [
        "zoom",
        "slideShow",
        "fullScreen",
        "close"
    ],
    animationEffect: "fade",
    transitionEffect: "fade"
});

// Slider functionality
function setupSlider(sectionSelector) {
    const section = document.querySelector(sectionSelector);
    if (!section) return;
    const slides = section.querySelectorAll('.fancybox-slide');
    const leftArrow = section.querySelector('.custom-arrow-left');
    const rightArrow = section.querySelector('.custom-arrow-right');
    const dots = section.querySelectorAll('.fancybox-dot');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.display = i === index ? 'flex' : 'none';
        });
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
        currentSlide = index;
    }

    leftArrow.addEventListener('click', () => {
        let next = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(next);
    });
    rightArrow.addEventListener('click', () => {
        let next = (currentSlide + 1) % slides.length;
        showSlide(next);
    });
    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => showSlide(i));
    });
    showSlide(0);
}

// Initialize sliders when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize both sliders
    setupSlider('.custom-feature-section');
    setupSlider('.custom-feature-section-second');

    // Language button functionality
    document.getElementById('language-button').addEventListener('click', function () {
        const languageText = document.getElementById('language-text');
        const languageFlag = document.getElementById('language-flag');

        if (languageText.textContent === 'English') {
            languageText.textContent = 'ქართული'; // Change to Georgian
            languageFlag.src = './assets/img/🇬🇪.png'; // Change to Georgian flag
            languageFlag.alt = 'Georgian Flag';
        } else {
            languageText.textContent = 'English'; // Change back to English
            languageFlag.src = './assets/img/🇺🇸.png'; // Change back to US flag
            languageFlag.alt = 'US Flag';
        }
    });
});