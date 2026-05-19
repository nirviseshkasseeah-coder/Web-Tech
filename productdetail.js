$(document).ready(function() {
    // Get product ID from URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id') || 2005;
    
    // Load product details on page load
    loadProductDetails();
    loadRelatedProducts();
    
    // Add to cart button handler
    $('.add-btn').on('click', function() {
        addToCart();
    });
    
    function loadProductDetails() {
        $.ajax({
            url: 'api/get_product.php',
            type: 'GET',
            data: { id: productId },
            dataType: 'json',
            timeout: 10000,
            success: function(response) {
                if (response.success) {
                    const product = response.data;
                    
                    // Update page title
                    document.title = `${product.Name} | Ryan's Coffee & Pastries`;
                    
                    // Update product information
                    $('#productName').text(product.Name);
                    $('#productDesc').text(product.Description);
                    $('#productPrice').html(`Rs ${parseFloat(product.Price).toFixed(2)} <span>(+${product.Points} points)</span>`);
                    
                    // FIXED: Use the image path from the API
                    $('#productImage').attr('src', product.Image).attr('alt', product.Name);
                    
                    // Handle image loading error
                    $('#productImage').on('error', function() {
                        $(this).attr('src', 'Images/placeholder.jpeg');
                    });
                } else {
                    showError('Product not found');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $('#productName').text('Error loading product');
                $('#productDesc').text('Unable to load product details. Please try again later.');
            }
        });
    }
    
    function loadRelatedProducts() {
        $.ajax({
            url: 'api/get_related_products.php',
            type: 'GET',
            data: { id: productId, limit: 3 },
            dataType: 'json',
            timeout: 10000,
            success: function(response) {
                if (response.success && response.data.length > 0) {
                    displayRelatedProducts(response.data);
                } else {
                    $('.related-grid').html('<p>No related products found.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $('.related-grid').html('<p>Unable to load related products.</p>');
            }
        });
    }
    
    function displayRelatedProducts(products) {
        const relatedHtml = products.map(product => {
            // Truncate description
            const shortDesc = product.Description.length > 100 
                ? product.Description.substring(0, 100) + '...' 
                : product.Description;
            
            return `
                <article class="product-card">
                    <img src="${product.Image}" 
                         alt="${escapeHtml(product.Name)}"
                         onerror="this.src='Images/placeholder.jpeg'">
                    <h3>${escapeHtml(product.Name)}</h3>
                    <p>${escapeHtml(shortDesc)}</p>
                    <a class="btn btn-dark" href="ProductDetail.php?id=${product.ProductID}">
                        Rs ${parseFloat(product.Price).toFixed(2)} 
                        <span>(+${product.Points} points)</span>
                    </a>
                </article>
            `;
        }).join('');
        
        $('.related-grid').html(relatedHtml);
    }
    
    function addToCart() {
        // Get current product details
        const productName = $('#productName').text();
        const productPrice = $('#productPrice').text();
        
        // Show confirmation (you can replace with actual cart logic)
        alert(`Added to cart:\n${productName}\n${productPrice}`);
        
        // TODO: Implement actual cart functionality
        // You can store in localStorage, session, or send to server
        /*
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        cart.push({
            id: productId,
            name: productName,
            price: productPrice,
            quantity: 1
        });
        localStorage.setItem('cart', JSON.stringify(cart));
        */
    }
    
    function showError(message) {
        $('.product-info').prepend(`
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                ⚠️ ${escapeHtml(message)}
            </div>
        `);
    }
    
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
});