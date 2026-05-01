<?php
session_start();

$cakes = [
    [
        'id' => 2001,
        'name' => 'Chocolate Cake',
        'image' => 'Images/Chocolate Cake.jpeg',
        'description' => 'Experience the ultimate indulgence with this rich chocolate cake, layered to perfection and topped with glossy chocolate ganache and fresh strawberry.',
        'price' => 'Rs 159.99',
        'points' => '(+100 points)',
    ],
    [
        'id' => 2002,
        'name' => 'Creamy Chocolate Cake',
        'image' => 'Images/Creamy Chocolate Cake.jpeg',
        'description' => 'Indulge in the rich layers of this decadent chocolate cake. Perfectly creamy and sweet, each slice boasts an exquisite blend of flavors topped with a hint of cocoa.',
        'price' => 'Rs 180.00',
        'points' => '(+125 points)',
        
    ],
    [
        'id' => 2003,
        'name' => 'Raspberry Cake',
        'image' => 'Images/Raspberry cake.jpeg',
        'description' => 'The rich chocolate and fresh raspberries create a harmonious blend of flavors, beautifully presented on a plate. Topped with vibrant raspberries and a hint of mint.',
        'price' => 'Rs 149.99',
        'points' => '(+90 points)',
    ],
    [
        'id' => 2004,
        'name' => 'Cheesecake with grated chocolate',
        'image' => 'Images/Cheesecake with grated chocolate.png',
        'description' => 'Indulge in this luscious cheesecake slice, beautifully adorned with rich chocolate drizzle, a vibrant cherry, and delicate chocolate shavings. A sweetly irresistible, crisp pastry base complements the creamy texture, making it the perfect dessert choice.',
        'price' => 'Rs 190.00',
        'points' => '(+130 points)',
    ],
    [
        'id' => 2005,
        'name' => 'Tiramisu Cake',
        'image' => 'Images/Tiramisu Cake.jpeg',
        'description' => 'This tantalizing tiramisu cake is a slice of the classic Italian dessert, beautifully presented. The cake features layers of creamy mascarpone cheese, chocolate sponge cake, and subtle coffee flavor, all dusted with cocoa powder.',
        'price' => 'Rs 200.00',
        'points' => '(+150 points)',
    ],
];

$pancakes = [
    [
        'id' => 2006,
        'name' => 'Chocolate Pancake',
        'image' => 'Images/Chocolate Pancake.jpeg',
        'description' => 'Indulge in the delectable delights of soft, fluffy pancakes generously drizzled with rich, velvety chocolate sauce. Perfect for a luxurious breakfast. These pancakes promise a heavenly taste experience.',
        'price' => 'Rs 99.99',
        'points' => '(+50 points)',
    ],
    [
        'id' => 2007,
        'name' => 'Strawberry Pancake',
        'image' => 'Images/strawberry pancake.png',
        'description' => 'Indulge in this mouthwatering wallpaper featuring fluffy pancakes filled with fresh strawberries. Topped with powdered sugar and accompanied by vibrant strawberries, this dessert is a feast for the eyes.',
        'price' => 'Rs 90.00',
        'points' => '(+55 points)',
    ],
    [
        'id' => 2008,
        'name' => 'Stacked Fluffy Pancake',
        'image' => 'Images/Stackedfluffypancake.png',
        'description' => 'Indulge in this mouthwatering featuring a towering stack of golden pancakes drizzled with syrup, topped with fresh blueberries, raspberries, and mint leaves.',
        'price' => 'Rs 150.00',
        'points' => '(+90 points)',
        
    ],
];

$footerTopics = ['Topic', 'Topic', 'Topic'];
$socialIcons = ['bi-facebook', 'bi-linkedin', 'bi-youtube', 'bi-instagram'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Desserts | Ryan's Coffee & Pastries</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Jacques+Francois&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="dessert.css">
</head>
<body>
  <header class="topbar">
    <div class="brand">
      <img src="Images/logo.jpeg" alt="Ryan's Coffee & Pastries logo">
      <span>About Ryan's Coffee &amp; Pastries</span>
    </div>

    <nav class="top-actions" aria-label="Quick actions">
      <a href="index.php" class="btn btn-dark">BACK</a>
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
    <section class="hero">
      <div class="hero-overlay">
        <h1>Desserts</h1>
        <p>No cup of coffee is ever complete without some delicacies</p>
        <div class="hero-actions">
          <a href="index.php" class="cta">Home.</a>
          <a href="review.php" class="cta">Shop.</a>
        </div>
      </div>
    </section>

    <section class="menu container">
      <h2>Cakes</h2>
      <div class="cards cards-five">
        <?php foreach ($cakes as $cake): ?>
          <article class="card<?php echo !empty($cake['highlight']) ? ' highlight' : ''; ?>">
            <img src="<?php echo htmlspecialchars($cake['image']); ?>" alt="<?php echo htmlspecialchars($cake['name']); ?>">
            <h3><?php echo htmlspecialchars($cake['name']); ?></h3>
            <p><?php echo htmlspecialchars($cake['description']); ?></p>
            <a href="ProductDetail.php?id=<?php echo $cake['id']; ?>" class="price"><?php echo htmlspecialchars($cake['price']); ?> <span><?php echo htmlspecialchars($cake['points']); ?></span></a>
          </article>
        <?php endforeach; ?>
      </div>

      <div class="cards cards-three">
        <?php foreach ($pancakes as $pancake): ?>
          <article class="card<?php echo !empty($pancake['highlight']) ? ' highlight' : ''; ?>">
            <img src="<?php echo htmlspecialchars($pancake['image']); ?>" alt="<?php echo htmlspecialchars($pancake['name']); ?>">
            <h3><?php echo htmlspecialchars($pancake['name']); ?></h3>
            <p><?php echo htmlspecialchars($pancake['description']); ?></p>
            <a href="ProductDetail.php?id=<?php echo $pancake['id']; ?>" class="price"><?php echo htmlspecialchars($pancake['price']); ?> <span><?php echo htmlspecialchars($pancake['points']); ?></span></a>
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
          <?php foreach ($socialIcons as $icon): ?>
            <a href="#" aria-label="Social"><i class="bi <?php echo htmlspecialchars($icon); ?>"></i></a>
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
</body>
</html>