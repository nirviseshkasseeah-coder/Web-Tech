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
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Product Detail | Ryan's Coffee & Pastries</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Jacques+Francois&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="ProductDetail.css">
</head>
<body>
  <header class="topbar">
    <div class="brand">
      <img src="Images/logo.jpeg" alt="Ryan's Coffee & Pastries logo">
      <span>Ryan's Coffee &amp; Pastries</span>
    </div>

    <nav class="top-actions" aria-label="Quick actions">
      <a href="index.php" class="btn btn-dark">HOME</a>
      <button type="button" class="btn btn-dark">CART</button>
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
    <section class="product-detail container">
      <div class="product-image">
        <img id="productImage" src="" alt="Product image">
      </div>

      <div class="product-info">
        <h1 id="productName">Loading...</h1>
        <p class="price" id="productPrice"></p>
        <p class="description" id="productDesc"></p>

        <button type="button" class="btn btn-dark add-btn">Add to cart</button>

        <div class="secondary-actions">
          <a href="writereview.php?id=<?= $productId ?>" class="btn btn-outline">Post a Review</a>
          <a href="review.php?id=<?= $productId ?>" class="btn btn-outline">View Reviews</a>
        </div>
      </div>
    </section>

    <section class="related container">
      <h2>Related products</h2>
      <div class="related-grid">
        <p>Loading related products...</p>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="footer-inner container">
      <div>
        <h4>Site name</h4>
        <div class="socials" aria-label="Social links">
          <?php foreach ($socialLinks as $social): ?>
            <a href="#" aria-label="<?= htmlspecialchars($social['label']) ?>"><i class="bi <?= htmlspecialchars($social['icon']) ?>"></i></a>
          <?php endforeach; ?>
        </div>
      </div>

      <?php foreach ($footerTopics as $topic): ?>
        <div>
          <h5><?= htmlspecialchars($topic) ?></h5>
          <?php for ($i = 0; $i < 4; $i++): ?>
            <a href="#">Page</a>
          <?php endfor; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="productdetail.js"></script>
</body>
</html>