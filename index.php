
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Ryan's Coffee & Pastries</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Jacques+Francois:ital@0;1&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="style.css">
</head>
<body>


  <!-- HERO -->
  <main>
    <section class="hero">
      <div class="container hero-grid">
        <div class="hero-text">
          <blockquote class="hero-quote">“Brewed with passion,<br/>served with love.”</blockquote>
          <p class="hero-author">— Nakul 2025</p>

          <p class="hero-sub">Your friendly neighbourhood coffee shop where each cup tells a different story.</p>

          <div class="hero-actions">
            <a class="btn primary" href="#order">Order Online.</a>
            <a class="btn secondary" href="#shops">Find us.</a>
          </div>
        </div>

        <div class="hero-media">
          <img src="assets/coffee-hero.jpg" alt="Latte art in a cup" class="hero-img">
        </div>
      </div>
    </section>

    <!-- OUR STORY -->
    <section id="our-story" class="section story container">
      <div class="story-inner">
        <div class="story-text">
          <h2 class="section-title">Our Story</h2>
          <p class="lead">
            Founded in 2004, Ryan’s Coffee and Pastries brings ethically sourced beans and artisan brewing to your cup.
            Having been nominated coffee shop of the year, we assure you that our products and our services are worth the money.
            Whether you want to take that aesthetic picture to post on your social media and impress your friends or you want
            the best coffee you have ever tasted, our doors are always open to you.
          </p>
        </div>

        <figure class="story-image">
          <img src="assets/pastries.jpg" alt="Coffee and pastries">
        </figure>
      </div>
    </section>

    <!-- SHOPS -->
    <section id="shops" class="section shops container">
      <h3 class="section-title">Our Shops</h3>
      <p class="section-sub">We have various coffee shops across the globe each embodying a unique style and decor. All our shops have free wifi and we intend to provide our customers with utmost comfort.</p>

      <div class="shops-grid">
        <img src="assets/shop1.jpg" alt="Shop interior 1">
        <img src="assets/shop2.jpg" alt="Shop interior 2">
        <img src="assets/shop3.jpg" alt="Shop interior 3">
      </div>
    </section>

    <!-- LOGIN + SOCIALS -->
    <section id="contact" class="section account container">
      <div class="account-grid">
        <aside class="login-card card">
          <h4>Welcome Back</h4><br>

          <!-- php to retrive error or success message from login.php and displaying them-->
          <?php
          session_start();
          $loginErr = $_SESSION['loginErr'] ?? '';
          $successMsg = $_SESSION['successMsg'] ?? '';
          
          // Clear messages after showing them
          unset($_SESSION['loginErr']);
          unset($_SESSION['successMsg']);
          ?>
          
          <div class="login-messages">
              <?php if (!empty($loginErr)): ?>
                  <p class="error"><?= htmlspecialchars($loginErr) ?></p>
              <?php elseif (!empty($successMsg)): ?>
                  <p class="success"><?= htmlspecialchars($successMsg) ?></p>
              <?php endif; ?>
          </div>

          <form class="login-form" action="login.php" method="post" autocomplete="on">
            <label>
              <span class="label-text">Email</span>
              <input type="email" name="txt_email" placeholder="Enter your email" required>
            </label>

            <label>
              <span class="label-text">Password</span>
              <input type="password" name="txt_password" placeholder="Enter your password" title="Password must be 8-255 chars, include at least 1 uppercase, 1 lowercase, 1 number, and 1 special char." required>
            </label>

            <div class="form-row">
              <label class="checkbox">
                <input type="checkbox" name="remember">
                <span>Remember me</span>
              </label>
              <a class="forgot" href="#">Forgot password?</a>
            </div>

            <div class="form-actions">
              <button class="btn primary full" type="submit">Login</button>
              <a class="btn secondary full" href="#signup">Sign Up</a>
            </div>
          </form>
        </aside>

        <aside class="socials card">
          <h4>Find us on:</h4><br>

          <div class="social-grid">
            <a class="social" href="#" aria-label="Instagram">
              <img src="assets/instagram.png" alt="" />
              <span>@RyanCofPas</span>
            </a>

            <a class="social" href="#" aria-label="Facebook">
              <img src="assets/facebook.png" alt="" />
              <span>@RyanCofPas</span>
            </a>

            <a class="social" href="#" aria-label="Twitter">
              <img src="assets/twitter.png" alt="" />
              <span>@RyanCofPas</span>
            </a>

            <a class="social" href="#" aria-label="TikTok">
              <img src="assets/tiktok.png" alt="" />
              <span>@RyanCofPas</span>
            </a>
          </div>
        </aside>
      </div>
    </section>

    <!-- TESTIMONIALS -->
    <section id="testimonials" class="section testimonials container">
      <h3 class="section-title">What People Say</h3>

      <div class="testimonials-grid">
        <article class="testimonial card">
          <p class="quote">“A terrific piece of praise”</p>
          <div class="meta">
            <img src="assets/avatar1.jpg" alt="avatar" class="avatar">
            <div>
              <div class="name">Nakul</div>
              <div class="role">Customer</div>
            </div>
          </div>
        </article>

        <article class="testimonial card">
          <p class="quote">“A fantastic bit of feedback”</p>
          <div class="meta">
            <img src="assets/avatar2.jpg" alt="avatar" class="avatar">
            <div>
              <div class="name">Aisha</div>
              <div class="role">Regular</div>
            </div>
          </div>
        </article>

        <article class="testimonial card">
          <p class="quote">“A genuinely glowing review”</p>
          <div class="meta">
            <img src="assets/avatar3.jpg" alt="avatar" class="avatar">
            <div>
              <div class="name">Marcus</div>
              <div class="role">Blogger</div>
            </div>
          </div>
        </article>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="site-footer">
    <div class="container footer-inner">
      <p class="footer-links">PRIVACY POLICY | TERMS OF USE | YOUR PRIVACY RIGHTS | CHILDREN'S PRIVACY POLICY | INTEREST BASED ADS | DO NOT SELL MY INFO</p>
      <p class="copyright">© 2004-2025 | Kasseeah Nirvisesh</p>
    </div>
  </footer>
</body>
</html>
