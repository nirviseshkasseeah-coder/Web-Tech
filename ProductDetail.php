<?php
$allProducts = [
    'chocolate-cake' => [
        'id' => 'chocolate-cake',
        'image' => 'Images/Chocolate Cake.jpeg',
        'alt' => 'Chocolate cake',
        'name' => 'Chocolate Cake',
        'description' => 'Experience the ultimate indulgence with this rich chocolate cake, layered to perfection and topped with glossy chocolate ganache and fresh strawberry.',
        'price' => 'Rs 159.99',
        'points' => '(+100 points)',
    ],
    'creamy-chocolate-cake' => [
        'id' => 'creamy-chocolate-cake',
        'image' => 'Images/Creamy Chocolate Cake.jpeg',
        'alt' => 'Creamy chocolate cake',
        'name' => 'Creamy Chocolate Cake',
        'description' => 'Indulge in the rich layers of this decadent chocolate cake. Perfectly creamy and sweet, each slice boasts an exquisite blend of flavors topped with a hint of cocoa.',
        'price' => 'Rs 180.00',
        'points' => '(+125 points)',
    ],
    'raspberry-cake' => [
        'id' => 'raspberry-cake',
        'image' => 'Images/Raspberry cake.jpeg',
        'alt' => 'Raspberry cake',
        'name' => 'Raspberry Cake',
        'description' => 'The rich chocolate and fresh raspberries create a harmonious blend of flavors, beautifully presented on a plate. Topped with vibrant raspberries and a hint of mint.',
        'price' => 'Rs 149.99',
        'points' => '(+90 points)',
    ],
    'cheesecake-grated-chocolate' => [
        'id' => 'cheesecake-grated-chocolate',
        'image' => 'Images/Cheesecake with grated chocolate.png',
        'alt' => 'Cheesecake with grated chocolate',
        'name' => 'Cheesecake with grated chocolate',
        'description' => 'Indulge in this luscious cheesecake slice, beautifully adorned with rich chocolate drizzle, a vibrant cherry, and delicate chocolate shavings. A sweetly irresistible, crisp pastry base complements the creamy texture, making it the perfect dessert choice.',
        'price' => 'Rs 190.00',
        'points' => '(+130 points)',
    ],
    'tiramisu-cake' => [
        'id' => 'tiramisu-cake',
        'image' => 'Images/Tiramisu Cake.jpeg',
        'alt' => 'Tiramisu cake',
        'name' => 'Tiramisu Cake',
        'description' => 'This tantalizing tiramisu cake is a slice of the classic Italian dessert, beautifully presented. The cake features layers of creamy mascarpone cheese, chocolate sponge cake, and subtle coffee flavor, all dusted with cocoa powder.',
        'price' => 'Rs 200.00',
        'points' => '(+150 points)',
    ],
    'chocolate-pancake' => [
        'id' => 'chocolate-pancake',
        'image' => 'Images/Chocolate Pancake.jpeg',
        'alt' => 'Chocolate pancake',
        'name' => 'Chocolate Pancake',
        'description' => 'Indulge in the delectable delights of soft, fluffy pancakes generously drizzled with rich, velvety chocolate sauce. Perfect for a luxurious breakfast. These pancakes promise a heavenly taste experience.',
        'price' => 'Rs 99.99',
        'points' => '(+50 points)',
    ],
    'strawberry-pancake' => [
        'id' => 'strawberry-pancake',
        'image' => 'Images/strawberry pancake.png',
        'alt' => 'Strawberry pancake',
        'name' => 'Strawberry Pancake',
        'description' => 'Indulge in this mouthwatering wallpaper featuring fluffy pancakes filled with fresh strawberries. Topped with powdered sugar and accompanied by vibrant strawberries, this dessert is a feast for the eyes.',
        'price' => 'Rs 90.00',
        'points' => '(+55 points)',
    ],
    'stacked-fluffy-pancake' => [
        'id' => 'stacked-fluffy-pancake',
        'image' => 'Images/Stackedfluffypancake.png',
        'alt' => 'Stacked fluffy pancake',
        'name' => 'Stacked Fluffy Pancake',
        'description' => 'Indulge in this mouthwatering featuring a towering stack of golden pancakes drizzled with syrup, topped with fresh blueberries, raspberries, and mint leaves.',
        'price' => 'Rs 150.00',
        'points' => '(+90 points)',
    ],
];

$selectedProductKey = $_GET['product'] ?? 'tiramisu-cake';
$mainProduct = $allProducts[$selectedProductKey] ?? $allProducts['tiramisu-cake'];

$relatedProducts = [];
foreach ($allProducts as $productKey => $product) {
    if ($productKey === $mainProduct['id']) {
        continue;
    }

    $relatedProducts[] = $product;
    if (count($relatedProducts) === 3) {
        break;
    }
}

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
      <span>About Ryan's Coffee &amp; Pastries</span>
    </div>

    <nav class="top-actions" aria-label="Quick actions">
      <a href="index.php" class="btn btn-dark">HOME</a>
      <button type="button" class="btn btn-dark">CART</button>
      <button type="button" class="btn btn-light">Logged in</button>
      <button type="button" class="btn btn-dark wide">Anwar Chutoo</button>
    </nav>
  </header>

  <main>
    <section class="product-detail container">
      <div class="product-image">
        <img src="<?= htmlspecialchars($mainProduct['image']) ?>" alt="<?= htmlspecialchars($mainProduct['alt']) ?>">
      </div>

      <div class="product-info">
        <h1><?= htmlspecialchars($mainProduct['name']) ?></h1>
        <p class="price"><?= htmlspecialchars($mainProduct['price']) ?> <span><?= htmlspecialchars($mainProduct['points']) ?></span></p>
        <p class="description">
          <?= htmlspecialchars($mainProduct['description']) ?>
        </p>

        <button type="button" class="btn btn-dark add-btn">Add to cart</button>

        <div class="secondary-actions">
          <a href="writereview.php" class="btn btn-outline">Post a Review</a>
          <a href="review.php" class="btn btn-outline">View Reviews</a>
        </div>
      </div>
    </section>

    <section class="related container">
      <h2>Related products</h2>

      <div class="related-grid">
        <?php foreach ($relatedProducts as $product): ?>
          <article class="product-card">
            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['alt']) ?>">
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <p><?= htmlspecialchars($product['description']) ?></p>
            <a class="btn btn-dark" href="ProductDetail.php?product=<?= urlencode($product['id']) ?>"><?= htmlspecialchars($product['price']) ?> <span><?= htmlspecialchars($product['points']) ?></span></a>
          </article>
        <?php endforeach; ?>
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
</body>
</html>
