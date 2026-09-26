// Handle likes and comments on the photo details page.

const likeButton = document.getElementById('likeButton');

if (likeButton) {

    likeButton.addEventListener(
        'click',
        async function(event) {

            // Stop the normal link navigation.
            event.preventDefault();

            if (likeButton.dataset.loading === 'true') {
                return;
            }

            likeButton.dataset.loading = 'true';

            try {

                const response = await fetch(
                    likeButton.dataset.url,
                    {
                        method: 'POST',
                        headers: {
                            'X-Requested-With':
                                'XMLHttpRequest'
                        }
                    }
                );

                const data = await response.json();

                if (!response.ok || !data.success) {
                    alert(
                        data.message ||
                        'Something went wrong.'
                    );

                    return;
                }

                const count = data.likeCount;

                const countText =
                    count === 1
                        ? 'like'
                        : 'likes';

                const countElement =
                    document.getElementById(
                        'likeCount'
                    );

                const icon =
                    likeButton.querySelector('svg');

                countElement.textContent =
                    count + ' ' + countText;

                likeButton.classList.toggle(
                    'liked',
                    data.liked
                );

                icon.setAttribute(
                    'fill',
                    data.liked
                        ? 'currentColor'
                        : 'none'
                );

            } catch (error) {

                alert(
                    'Could not update the like. Please try again.'
                );

            } finally {

                likeButton.dataset.loading = 'false';
            }
        }
    );
}


const commentForm =
    document.getElementById('commentForm');

if (commentForm) {

    commentForm.addEventListener(
        'submit',
        async function(event) {

            event.preventDefault();

            const input =
                document.getElementById(
                    'commentInput'
                );

            const errorBox =
                document.getElementById(
                    'commentError'
                );

            const sendButton =
                document.getElementById(
                    'sendCommentBtn'
                );

            const commentText =
                input.value.trim();

            errorBox.style.display = 'none';
            errorBox.textContent = '';

            // Check the comment before sending it.
            if (commentText === '') {

                errorBox.textContent =
                    'Comment is required.';

                errorBox.style.display =
                    'block';

                return;
            }

            if (commentText.length > 1000) {

                errorBox.textContent =
                    'Comment is too long.';

                errorBox.style.display =
                    'block';

                return;
            }

            sendButton.disabled = true;
            sendButton.textContent = 'Sending...';

            try {

                const formData =
                    new FormData(commentForm);

                const response = await fetch(
                    commentForm.action,
                    {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With':
                                'XMLHttpRequest'
                        }
                    }
                );

                const data =
                    await response.json();

                if (!response.ok || !data.success) {

                    errorBox.textContent =
                        data.message ||
                        'Could not add the comment.';

                    errorBox.style.display =
                        'block';

                    return;
                }

                addCommentToPage(
                    data.comment
                );

                input.value = '';

            } catch (error) {

                errorBox.textContent =
                    'Could not add the comment. Please try again.';

                errorBox.style.display =
                    'block';

            } finally {

                sendButton.disabled = false;
                sendButton.textContent = 'Send';
            }
        }
    );
}


// Add the new comment to the page without reloading it.
function addCommentToPage(comment)
{
    const commentsList =
        document.querySelector(
            '.comments-list'
        );

    const noComments =
        document.querySelector(
            '.no-comments'
        );

    if (noComments) {
        noComments.remove();
    }

    let list = commentsList;

    if (!list) {

        list = document.createElement(
            'div'
        );

        list.className =
            'comments-list';

        const commentsCard =
            document.querySelector(
                '.comments-card'
            );

        commentsCard.appendChild(list);
    }

    const item =
        document.createElement(
            'div'
        );

    item.className =
        'comment-item';

    const user =
        document.createElement(
            'div'
        );

    user.className =
        'comment-user';

    const circle =
        document.createElement(
            'div'
        );

    circle.className =
        'user-circle';

    circle.textContent =
        comment.first_name
            .charAt(0)
            .toUpperCase();

    const name =
        document.createElement(
            'strong'
        );

    name.textContent =
        comment.first_name;

    user.appendChild(circle);
    user.appendChild(name);

    const text =
        document.createElement(
            'p'
        );

    text.className =
        'comment-text';

    text.textContent =
        comment.comment;

    const date =
        document.createElement(
            'small'
        );

    date.className =
        'comment-date';

    date.textContent =
        comment.date_time;

    item.appendChild(user);
    item.appendChild(text);
    item.appendChild(date);

    list.prepend(item);
}