<?php
session_start();
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 2005;

$socialLinks = [
    ['label' => 'Facebook', 'icon' => 'bi-facebook'],
    ['label' => 'LinkedIn', 'icon' => 'bi-linkedin'],
    ['label' => 'YouTube', 'icon' => 'bi-youtube'],
    ['label' => 'Instagram', 'icon' => 'bi-instagram'],
];

$footerTopics = ['Topic', 'Topic', 'Topic'];
$footerPages = ['Page', 'Page', 'Page', 'Page'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Write Review | Ryan's Coffee & Pastries</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Jacques+Francois&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="writereview.css">
</head>
<body>
  <header class="topbar">
    <div class="brand">
      <img src="Images/logo.jpeg" alt="Ryan's Coffee & Pastries logo">
    </div>

    <nav class="top-actions" aria-label="Quick actions">
      <a class="btn btn-dark" href="index.php">HOME</a>
      <?php if (isset($_SESSION['user_id'])): ?>
        <button type="button" class="btn btn-light">Logged in</button>
        <button type="button" class="btn btn-dark wide"><?php echo htmlspecialchars($_SESSION['username']); ?></button>
      <?php else: ?>
        <button type="button" class="btn btn-light">NOT LOGGED IN</button>
        <a href="index.php#contact" class="btn btn-dark wide">LOGIN</a>
      <?php endif; ?>
    </nav>
  </header>

  <main class="container">
    <section class="hero">
      <div class="hero-image">
        <img id="productImage" src="" alt="Product image">
      </div>

      <div class="hero-content">
        <h1 id="productName">Loading...</h1>
        <p id="productDesc"></p>
        <a class="btn btn-outline full" href="review.php?id=<?= $productId ?>">View Reviews</a>
      </div>
    </section>

    <section class="review-form-section">
      <h2>Write a review</h2>
      
      <div id="message" style="display:none;"></div>

      <form id="reviewForm" class="review-form">
        <label for="rating">Rating (1-5 stars)</label>
        <select id="rating" name="rating" required style="width:100%; padding:10px; margin-bottom:20px;">
          <option value="">Select rating</option>
          <option value="1">1 star - Poor</option>
          <option value="2">2 stars - Fair</option>
          <option value="3">3 stars - Good</option>
          <option value="4">4 stars - Very Good</option>
          <option value="5">5 stars - Excellent</option>
        </select>

        <label for="comment">Your review</label>
        <textarea id="comment" name="comment" placeholder="Write your comment here (5-500 characters)" required></textarea>
        
        <button class="btn btn-dark submit-btn" type="submit">Post Review</button>
      </form>
    </section>
  </main>

  <footer class="site-footer">
    <div class="footer-inner container">
      <div>
        <h4>Site name</h4>
        <div class="socials" aria-label="Social links">
          <?php foreach ($socialLinks as $social): ?>
            <a href="#" aria-label="<?php echo htmlspecialchars($social['label']); ?>"><i class="bi <?php echo htmlspecialchars($social['icon']); ?>"></i></a>
          <?php endforeach; ?>
        </div>
      </div>

      <?php foreach ($footerTopics as $topic): ?>
        <div>
          <h5><?php echo htmlspecialchars($topic); ?></h5>
          <?php foreach ($footerPages as $page): ?>
            <a href="#"><?php echo htmlspecialchars($page); ?></a>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="writereview.js"></script>
  
  <script>
  $(document).ready(function() {
      const productId = '<?= $productId ?>';
      
      $.ajax({
          url: 'api/get_product.php',
          type: 'GET',
          data: { id: productId },
          success: function(response) {
              if (response.success) {
                  $('#productName').text(response.data.Name);
                  $('#productDesc').text(response.data.Description);
                  $('#productImage').attr('src', response.data.Image);
              }
          }
      });
  });
  </script>
</body>
</html>