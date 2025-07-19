document.addEventListener("DOMContentLoaded", () => {
    let currentSlide = 0;
    const slides = document.querySelectorAll(".hero-slider .slide");

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove("active");
            if (i === index) slide.classList.add("active");
        });
    }

    function changeSlide(direction) {
        currentSlide += direction;
        if (currentSlide < 0) currentSlide = slides.length - 1;
        else if (currentSlide >= slides.length) currentSlide = 0;
        showSlide(currentSlide);
    }

    // Event listeners for arrows
    document
        .querySelector(".slider-nav.right")
        ?.addEventListener("click", () => {
            changeSlide(-1);
        });

    document
        .querySelector(".slider-nav.left")
        ?.addEventListener("click", () => {
            changeSlide(1);
        });

    // Auto slide every 5s
    setInterval(() => {
        changeSlide(1);
    }, 8000);

    // Show initial slide
    showSlide(currentSlide);
});
