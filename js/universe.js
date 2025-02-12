document.addEventListener('DOMContentLoaded', function() {
    const mainContainer = document.getElementById('main-container');
    let scale = 1;
    let isDragging = false;
    let startX, startY;
    let currentX = 0, currentY = 0;

    // Zoom functionality
    document.addEventListener('wheel', function(event) {
        if (event.deltaY < 0) {
            // Zoom in
            scale += 0.1;
        } else {
            // Zoom out
            scale -= 0.1;
        }

        // Limit the zoom scale
        scale = Math.max(0.5, Math.min(2, scale));

        mainContainer.style.transform = `scale(${scale}) translate(${currentX}px, ${currentY}px)`;
        event.preventDefault();
    }, { passive: false });

    // Dragging functionality
    document.addEventListener('mousedown', function(event) {
        isDragging = true;
        startX = event.clientX - currentX;
        startY = event.clientY - currentY;
        event.preventDefault();
    });

    document.addEventListener('mousemove', function(event) {
        if (isDragging) {
            currentX = event.clientX - startX;
            currentY = event.clientY - startY;

            mainContainer.style.transform = `scale(${scale}) translate(${currentX}px, ${currentY}px)`;
        }
    });

    document.addEventListener('mouseup', function() {
        isDragging = false;
    });
});