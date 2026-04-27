<?php
$product = [
    'name' => 'Tiramisu Cake',
    'description' => "This tantalizing tiramisu cake is a slice of the classic Italian dessert, beautifully presented. The cake features layers of creamy mascarpone cheese, chocolate sponge cake, and subtle coffee flavor, all dusted with cocoa powder.",
    'image' => 'Images/Tiramisu Cake.jpeg',
];

$socialLinks = [
    ['label' => 'Facebook', 'icon' => 'bi-facebook'],
    ['label' => 'LinkedIn', 'icon' => 'bi-linkedin'],
    ['label' => 'YouTube', 'icon' => 'bi-youtube'],
    ['label' => 'Instagram', 'icon' => 'bi-instagram'],
];

$footerTopics = ['Topic', 'Topic', 'Topic'];
$footerPages = ['Page', 'Page', 'Page', 'Page'];

$headerActions = [
    ['type' => 'link', 'label' => 'HOME', 'class' => 'btn btn-dark', 'href' => 'index.php'],
    ['type' => 'button', 'label' => 'Logged in', 'class' => 'btn btn-light'],
    ['type' => 'button', 'label' => 'Nakul Kumar Singh Baboolall', 'class' => 'btn btn-dark wide'],
];

$review = '';
$isPosted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $review = trim($_POST['review'] ?? '');
    $isPosted = $review !== '';
}
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
      <?php foreach ($headerActions as $action): ?>
        <?php if ($action['type'] === 'link'): ?>
          <a class="<?php echo htmlspecialchars($action['class']); ?>" href="<?php echo htmlspecialchars($action['href']); ?>">
            <?php echo htmlspecialchars($action['label']); ?>
          </a>
        <?php else: ?>
          <button type="button" class="<?php echo htmlspecialchars($action['class']); ?>">
            <?php echo htmlspecialchars($action['label']); ?>
          </button>
        <?php endif; ?>
      <?php endforeach; ?>
    </nav>
  </header>

  <main class="container">
    <section class="hero">
      <div class="hero-image">
        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
      </div>

      <div class="hero-content">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <p><?php echo htmlspecialchars($product['description']); ?></p>
        <a class="btn btn-outline full" href="review.php">View Reviews</a>
      </div>
    </section>

    <section class="review-form-section">
      <h2>Write a review</h2>

      <?php if ($isPosted): ?>
        <p class="status">Thanks! Your review was posted.</p>
      <?php endif; ?>

      <form method="post" class="review-form">
        <label for="review">Your review</label>
        <textarea id="review" name="review" placeholder="Write your comment here" required><?php echo htmlspecialchars($review); ?></textarea>
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
</body>
</html>
