$(document).ready(function() {
    const productId = new URLSearchParams(window.location.search).get('id') || 'tiramisu-cake';
    
    // Load product info
    loadProductInfo();
    
    // Handle form submission
    $('#reviewForm').on('submit', function(e) {
        e.preventDefault();
        
        const rating = $('#rating').val();
        const comment = $('#comment').val();
        
        if (!rating || !comment) {
            showMessage('Please fill all fields', 'error');
            return;
        }
        
        $.ajax({
            url: 'api/submit_review.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                product_id: productId,
                rating: parseInt(rating),
                comment: comment
            }),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showMessage(response.message, 'success');
                    $('#reviewForm')[0].reset();
                    setTimeout(() => {
                        window.location.href = `review.php?id=${productId}`;
                    }, 2000);
                } else {
                    showMessage(response.error, 'error');
                }
            },
            error: function() {
                showMessage('Error submitting review', 'error');
            }
        });
    });
    
    function loadProductInfo() {
        $.ajax({
            url: 'api/get_product.php',
            type: 'GET',
            data: { id: productId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#productName').text(response.data.Name);
                    $('#productDesc').text(response.data.Description);
                    $('#productImage').attr('src', response.data.Image);
                }
            }
        });
    }
    
    function showMessage(msg, type) {
        const messageDiv = $('#message');
        messageDiv.removeClass('success error').addClass(type).text(msg).show();
        setTimeout(() => messageDiv.fadeOut(), 3000);
    }
});