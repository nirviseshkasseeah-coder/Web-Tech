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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reviews | Ryan's Coffee & Pastries</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Jacques+Francois&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="review.css">
</head>
<body>
  <header class="topbar">
    <div class="brand">
      <img src="Images/logo.jpeg" alt="Ryan's Coffee & Pastries logo">
    </div>

    <nav class="top-actions" aria-label="Quick actions">
      <a class="btn btn-dark" href="index.php">BACK</a>
      <?php if (isset($_SESSION['user_id'])): ?>
        <button type="button" class="btn btn-light">Logged in</button>
        <button type="button" class="btn btn-dark wide"><?php echo htmlspecialchars($_SESSION['username']); ?></button>
      <?php else: ?>
        <button type="button" class="btn btn-light">NOT LOGGED IN</button>
        <a href="index.php#contact" class="btn btn-dark wide">LOGIN</a>
      <?php endif; ?>
    </nav>
  </header>

  <main>
    <section class="hero container">
      <div class="hero-image">
        <img id="productImage" src="" alt="Product image">
      </div>

      <div class="hero-content">
        <h1 id="productName">Loading...</h1>
        <p id="productDesc"></p>
        <a class="btn btn-dark full" href="ProductDetail.php?id=<?= $productId ?>">See pricing</a>
      </div>
    </section>

    <section class="reviews container">
      <h2>Reviews (<span id="reviewCount">0</span>)</h2>
      <!-- ADDED: rating-summary div -->
      <div class="rating-summary" style="margin-bottom: 20px;"></div>
      <div class="reviews-scroll" id="reviewsList">
        <p>Loading reviews...</p>
      </div>
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
          <?php for ($i = 0; $i < 4; $i++): ?>
            <a href="#">Page</a>
          <?php endfor; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="review.js"></script>
  
  <!-- ADDED: Product info loader -->
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