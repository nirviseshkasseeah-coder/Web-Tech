<?php
$socialLinks = [
    ['label' => 'Facebook', 'icon' => 'bi-facebook'],
    ['label' => 'LinkedIn', 'icon' => 'bi-linkedin'],
    ['label' => 'YouTube', 'icon' => 'bi-youtube'],
    ['label' => 'Instagram', 'icon' => 'bi-instagram'],
];

$footerTopics = ['Topic', 'Topic', 'Topic'];
$footerPages = ['Page', 'Page', 'Page', 'Page'];

$headerLinks = [
    ['label' => 'HOME', 'href' => 'index.php'],
    ['label' => 'SHOP', 'href' => 'review.php'],
    ['label' => 'LOGIN', 'href' => 'login.php'],
    ['label' => 'SIGNUP', 'href' => '#'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About | Ryan's Coffee & Pastries</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Jacques+Francois&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="about.css?v=2">
</head>
<body>
  <header class="topbar">
    <div class="brand-wrap">
      <img src="Images/logo.jpeg" alt="Ryan's Coffee & Pastries logo">
      <p>About Ryan's Coffee &amp; Pastries</p>
    </div>

    <nav class="top-actions" aria-label="Main navigation">
      <?php foreach ($headerLinks as $link): ?>
        <a class="btn" href="<?php echo htmlspecialchars($link['href']); ?>"><?php echo htmlspecialchars($link['label']); ?></a>
      <?php endforeach; ?>
    </nav>
  </header>

  <main class="main-wrap">
    <section class="about-grid container">
      <article>
        <h1>About</h1>
        <p class="quote">"Good coffee. Good people. Good vibes."</p>

        <p>
          At Ryan's Coffee &amp; Pastries, we believe coffee is more than just a drink - it's a daily ritual.
          That's why we source quality beans, roast with care, and serve every cup with the perfect balance of
          flavor and comfort.
        </p>

        <p>
          Our space is designed for everyone - whether you're grabbing a quick latte on the go, catching up with
          friends, or finding a quiet corner to work. Fresh pastries, cozy seating, and friendly service make every
          visit feel like home.
        </p>

        <p>We're here to bring people together, one cup at a time.</p>
        <p class="signature">-Kasseeah Nirvisesh, CEO of Ryan's Coffee and Pastries</p>

        <section class="contact-block">
          <h2>Contact me</h2>
          <form class="contact-form" method="post" action="#">
            <div class="name-row">
              <label>
                <span>First name</span>
                <input type="text" name="first_name" placeholder="Ashutosh" required>
              </label>

              <label>
                <span>Last name</span>
                <input type="text" name="last_name" placeholder="Dinaram" required>
              </label>
            </div>

            <label>
              <span>Email address</span>
              <input type="email" name="email" placeholder="AshutoshDinaram@gmail.com" required>
            </label>

            <label>
              <span>Your message</span>
              <textarea name="message" placeholder="Enter your question or message" required></textarea>
            </label>

            <button type="submit" class="submit-btn">Submit</button>
          </form>
        </section>
      </article>

      <aside class="media-col">
        <img src="Images/RickAstley.png" alt="Rick Astley portrait">
        <p>Never Gonna give you up,<br>Never gonna let you down</p>
      </aside>
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
