// upload page scripts


/**
 * handles the upload form submission.
 * checks all the fields and prevents sending the form twice
 */
document.getElementById('uploadForm').addEventListener('submit', function(event) {

    const title = document.getElementById('title').value.trim();
    const description = document.getElementById('description').value.trim();
    const photo = document.getElementById('photo').files[0];
    const uploadError = document.getElementById('uploadError');
    const submitBtn = document.getElementById('submitBtn');

    // reset error
    uploadError.style.display = 'none';
    uploadError.textContent = '';

    // prevent double submit
    if (submitBtn.disabled) {
        event.preventDefault();
        return false;
    }

    // check title
    if (title === '') {
        event.preventDefault();
        uploadError.textContent = 'Title is required.';
        uploadError.style.display = 'block';
        return;
    }

    if (title.length > 200) {
        event.preventDefault();
        uploadError.textContent = 'Title is too long.';
        uploadError.style.display = 'block';
        return;
    }

    // check description length
    if (description.length > 5000) {
        event.preventDefault();
        uploadError.textContent = 'Description is too long.';
        uploadError.style.display = 'block';
        return;
    }

    // check photo
    if (!photo) {
        event.preventDefault();
        uploadError.textContent = 'Please choose a photo.';
        uploadError.style.display = 'block';
        return;
    }

    // check photo type
    const allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp'
    ];

    if (!allowedTypes.includes(photo.type)) {
        event.preventDefault();
        uploadError.textContent = 'Please choose a valid image file.';
        uploadError.style.display = 'block';
        return;
    }

    // check photo size (max 5MB)
    if (photo.size > 5 * 1024 * 1024) {
        event.preventDefault();
        uploadError.textContent = 'Photo size must not exceed 5 MB.';
        uploadError.style.display = 'block';
        return;
    }

    // all checks passed, so disable the button to prevent double upload
    submitBtn.disabled = true;
    submitBtn.textContent = 'Uploading...';
    submitBtn.style.opacity = '0.6';
    submitBtn.style.cursor = 'not-allowed';
});