<?php
$product = [
    'name' => 'Tiramisu Cake',
    'description' => "This tantalizing tiramisu cake is a slice of the classic Italian dessert, beautifully presented. The cake features layers of creamy mascarpone cheese, chocolate sponge cake, and subtle coffee flavor, all dusted with cocoa powder.",
    'image' => 'Images/Tiramisu Cake.jpeg'
];

$reviews = [
    [
        'name' => 'Bob Smith',
        'rating' => 5,
        'date' => '11/Sept/25',
        'text' => 'Definitely a great place to have a wonderful cup of coffee and pastry :).',
        'tone' => 'tone-one',
        'image' => 'Images/BobSmith.jpeg'
    ],
    [
        'name' => 'The Artist',
        'rating' => 4,
        'date' => '25/Jul/25',
        'text' => 'This dessert is one of the best dessert I have ever tasted!!! So rich, creamy, and heavenly.Wowww. The layers were so moist and flavorful. das essen war einfach köstlich.',
        'tone' => 'tone-two',
        'image' => 'Images/theArtist.jpeg'
    ],
    [
        'name' => 'Alice Johnson',
        'rating' => 4,
        'date' => '04/May/25',
        'text' => 'The Tiramisu was good but a bit too sweet for my taste. I would prefer a less sugary version.',
        'tone' => 'tone-three',
        'image' => 'Images/Alice Johnson.jpeg'
    ],
    [
        'name' => 'TheFakeGordon',
        'rating' => 2,
        'date' => '31/Feb/25',
        'text' => "That was an enjoyable dessert but i wish that the mascarpone layer was a bit thicker. My grandma can do better! And she's dead!",
        'tone' => 'tone-four',
        'image' => 'Images/ThefakeGordon.jpeg'
    ]
];

$socialLinks = [
    ['label' => 'Facebook', 'icon' => 'bi-facebook'],
    ['label' => 'LinkedIn', 'icon' => 'bi-linkedin'],
    ['label' => 'YouTube', 'icon' => 'bi-youtube'],
    ['label' => 'Instagram', 'icon' => 'bi-instagram'],
];

$footerTopics = ['Topic', 'Topic', 'Topic'];

function initials(string $name): string
{
    $parts = preg_split('/\s+/', trim($name));
    if (!$parts) {
        return 'U';
    }

    $first = strtoupper(substr($parts[0], 0, 1));
    $last = count($parts) > 1 ? strtoupper(substr($parts[count($parts) - 1], 0, 1)) : '';
    return $first . $last;
}
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
      <button type="button" class="btn btn-light">Logged in</button>
      <button type="button" class="btn btn-dark wide">Nakul Kumar Singh Baboolall</button>
    </nav>
  </header>

  <main>
    <section class="hero container">
      <div class="hero-image">
        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
      </div>

      <div class="hero-content">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <p><?php echo htmlspecialchars($product['description']); ?></p>
        <a class="btn btn-dark full" href="ProductDetail.php">See pricing</a>
      </div>
    </section>

    <section class="reviews container">
      <h2>Reviews</h2>

      <div class="reviews-scroll" aria-label="Customer reviews">
        <?php foreach ($reviews as $review): ?>
          <article class="review-item">
            <div class="avatar <?php echo htmlspecialchars($review['tone']); ?>" aria-hidden="true">
              <?php if (!empty($review['image'])): ?>
                <img src="<?php echo htmlspecialchars($review['image']); ?>" alt="<?php echo htmlspecialchars($review['name']); ?>">
              <?php else: ?>
                <?php echo htmlspecialchars(initials($review['name'])); ?>
              <?php endif; ?>
            </div>

            <div class="review-main">
              <div class="review-head">
                <strong><?php echo htmlspecialchars($review['name']); ?></strong>
                <span class="stars"><?php echo str_repeat('?', (int)$review['rating']) . str_repeat('?', 5 - (int)$review['rating']); ?></span>
              </div>
              <p>"<?php echo htmlspecialchars($review['text']); ?>"</p>
            </div>

            <span class="review-date"><?php echo htmlspecialchars($review['date']); ?></span>
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
</body>
</html>
