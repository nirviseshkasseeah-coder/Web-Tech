$(document).ready(function() {
    const productId = new URLSearchParams(window.location.search).get('id') || 'tiramisu-cake';
    
    // Load reviews on page load
    loadReviews();
    
    function loadReviews() {
        $.ajax({
            url: 'api/get_reviews.php',
            type: 'GET',
            data: { id: productId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    displayReviews(response.data, response.average, response.total);
                } else {
                    console.error('Error:', response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    }
    
    function displayReviews(reviews, average, total) {
        // Update rating summary
        $('.rating-summary').html(`
            <div class="avg-rating">★ ${average}/5</div>
            <div>Based on ${total} customer review(s)</div>
        `);
        
        // Update reviews count
        $('.reviews h2').text(`Reviews (${total})`);
        
        // Display reviews
        const reviewsHtml = reviews.map(review => `
            <article class="review-item">
                <div class="avatar ${getToneClass(review.Rating)}">
                    ${getInitials(review.Username)}
                </div>
                <div class="review-main">
                    <div class="review-head">
                        <strong>${escapeHtml(review.Username)}</strong>
                        <span class="stars">${getStarRating(review.Rating)}</span>
                    </div>
                    <p>"${escapeHtml(review.Comment)}"</p>
                </div>
                <span class="review-date">${formatDate(review.CreatedAt)}</span>
            </article>
        `).join('');
        
        $('.reviews-scroll').html(reviewsHtml || '<p>No reviews yet. Be the first to write one!</p>');
    }
    
    function getToneClass(rating) {
        if (rating >= 4) return 'tone-one';
        if (rating >= 3) return 'tone-two';
        return 'tone-three';
    }
    
    function getStarRating(rating) {
        return '★'.repeat(rating) + '☆'.repeat(5 - rating);
    }
    
    function getInitials(name) {
        return name.split(' ').map(n => n[0]).join('').toUpperCase();
    }
    
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
    }
    
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
});