// photos page scripts


/**
 * changes the gallery view between grid, list and slider
 *
 * @param string view  the view to switch to
 * @param object btn   the clicked button
 */
function setView(view, btn) {

    const grid = document.getElementById('photosGrid');
    const slider = document.getElementById('sliderView');

    if (!grid || !slider) {
        return;
    }

    // show slider if the slider view was selected
    if (view === 'slider') {
        grid.style.display = 'none';
        slider.style.display = 'block';
    } else {
        // otherwise show the grid
        slider.style.display = 'none';
        grid.style.display = 'grid';

        // switch between list view and normal grid columns
        if (view === 'list') {
            grid.className = 'photos-grid list-view';
        } else {
            grid.className = 'photos-grid cols-' + view;
        }
    }

    // update the active class on the buttons
    document.querySelectorAll('.grid-btn').forEach(function(button) {
        button.classList.remove('active');
    });

    btn.classList.add('active');

    // remember the choice in the browser
    localStorage.setItem('galleryView', view);
}


/**
 * changes the active slide in the slider view
 *
 * @param int direction  -1 for previous, 1 for next
 */
function changeSlide(direction) {

    const slides = document.querySelectorAll('.slide');

    if (slides.length === 0) {
        return;
    }

    let currentIndex = 0;

    // find the current slide
    slides.forEach(function(slide, index) {
        if (slide.classList.contains('active-slide')) {
            currentIndex = index;
        }
        slide.classList.remove('active-slide');
    });

    currentIndex += direction;

    // wrap around if we go past the last or first slide
    if (currentIndex >= slides.length) {
        currentIndex = 0;
    }

    if (currentIndex < 0) {
        currentIndex = slides.length - 1;
    }

    slides[currentIndex].classList.add('active-slide');
}


/**
 * restores the last selected gallery view when the page loads
 */
document.addEventListener('DOMContentLoaded', function() {

    const savedView = localStorage.getItem('galleryView');

    if (savedView) {

        const button = document.querySelector(
            '.grid-btn[data-view="' + savedView + '"]'
        );

        if (button) {
            setView(savedView, button);
        }
    }
});