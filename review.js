let currentIndex = 0;

function moveSlider(direction) {
    const track = document.getElementById('sliderTrack');
    const cards = document.querySelectorAll('.testimonial-card');
    const totalCards = cards.length;

    currentIndex += direction;

    if (currentIndex >= totalCards) {
        currentIndex = 0;
    } else if (currentIndex < 0) {
        currentIndex = totalCards - 1;
    }

    const offset = currentIndex * -100;
    track.style.transform = 'translateX(calc(${offset}% - ${currentIndex * 20}px))';
} 