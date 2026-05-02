<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Ryan's Coffee & Pastries</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Jacques+Francois:ital@0;1&display=swap" rel="stylesheet">

  <!-- FontAwesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Ajv (JSON Schema validator) for client‑side email validation -->
<script src="https://cdn.jsdelivr.net/npm/ajv@8.12.0/dist/ajv.bundle.js"></script>

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
          <h4 id="form-heading">Welcome Back</h4><br>

          <?php
          session_start();
          $loginErr = $_SESSION['loginErr'] ?? '';
          $successMsg = $_SESSION['successMsg'] ?? '';
          unset($_SESSION['loginErr']);
          unset($_SESSION['successMsg']);

          // CSRF protection: generate a token for the login form
          if (empty($_SESSION['login_csrf'])) {
              $_SESSION['login_csrf'] = bin2hex(random_bytes(32));
          }
          ?>
          
          <div class="login-messages">
              <?php if (!empty($loginErr)): ?>
                  <p class="error"><?= htmlspecialchars($loginErr) ?></p>
              <?php elseif (!empty($successMsg)): ?>
                  <p class="success"><?= htmlspecialchars($successMsg) ?></p>
              <?php endif; ?>
          </div>

          <form id="auth-form" class="login-form" action="login.php" method="post" autocomplete="on">
            <!-- CSRF token -->
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['login_csrf']) ?>">

            <label>
              <span class="label-text">Email</span>
              <input type="email" id="email" name="txt_email" placeholder="Enter your email" required>
            </label>

            <div id="login-fields">
              <label>
                <span class="label-text">Password</span>
                <div class="password-wrapper">
                  <input type="password" name="txt_password" id="password-field" placeholder="Enter your password" title="Password must be 8-255 chars, include at least 1 uppercase, 1 lowercase, 1 number, and 1 special char." required>
                  <button type="button" class="toggle-password" aria-label="Show/Hide Password">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
              </label>
              <div class="form-row">
                <label class="checkbox">
                  <input type="checkbox" name="remember">
                  <span>Remember me</span>
                </label>
                <a class="forgot" href="#" id="forgot-link">Forgot password?</a>
              </div>
            </div>

            <div class="form-actions" style="display: flex; gap: 10px;">
              <button class="btn primary full" type="submit" id="login-btn">Login</button>
              <button class="btn primary full" type="button" id="reset-submit-btn" style="display: none;">Submit</button>
              <a class="btn secondary full" href="#signup">Sign Up</a>
            </div>
          </form>
        </aside>

        <aside class="socials card">
          <h4>Find us on:</h4><br>
          <div class="social-grid">
            <a class="social" href="#" aria-label="Instagram"><img src="assets/instagram.png" alt=""><span>@RyanCofPas</span></a>
            <a class="social" href="#" aria-label="Facebook"><img src="assets/facebook.png" alt=""><span>@RyanCofPas</span></a>
            <a class="social" href="#" aria-label="Twitter"><img src="assets/twitter.png" alt=""><span>@RyanCofPas</span></a>
            <a class="social" href="#" aria-label="TikTok"><img src="assets/tiktok.png" alt=""><span>@RyanCofPas</span></a>
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
          <div class="meta"><img src="assets/avatar1.jpg" alt="avatar" class="avatar"><div><div class="name">Nakul</div><div class="role">Customer</div></div></div>
        </article>
        <article class="testimonial card">
          <p class="quote">“A fantastic bit of feedback”</p>
          <div class="meta"><img src="assets/avatar2.jpg" alt="avatar" class="avatar"><div><div class="name">Aisha</div><div class="role">Regular</div></div></div>
        </article>
        <article class="testimonial card">
          <p class="quote">“A genuinely glowing review”</p>
          <div class="meta"><img src="assets/avatar3.jpg" alt="avatar" class="avatar"><div><div class="name">Marcus</div><div class="role">Blogger</div></div></div>
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

  <script>
  $(function() {
      // Password toggle
      $('.toggle-password').on('click', function() {
          const $pwdField = $('#password-field');
          const type = $pwdField.attr('type') === 'password' ? 'text' : 'password';
          $pwdField.attr('type', type);
          $(this).html(type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>');
      });

      // Mode switching variables
      const $form = $('#auth-form');
      const $heading = $('#form-heading');
      const $loginFields = $('#login-fields');
      const $loginBtn = $('#login-btn');
      const $resetSubmitBtn = $('#reset-submit-btn');
      const $forgotLink = $('#forgot-link');
      const $emailInput = $('#email');
      const $passwordInput = $('input[name="txt_password"]');
      const $messages = $('.login-messages');

      let validateEmail;

      function setLoginMode() {
          $heading.text('Welcome Back');
          $loginFields.show();
          $loginBtn.css('display', 'inline-block');
          $resetSubmitBtn.hide();
          $form.attr('action', 'login.php');
          $passwordInput.prop('required', true);
          $messages.empty();
      }

      function setForgotMode() {
          $heading.text('Enter email to reset password');
          $loginFields.hide();
          $loginBtn.css('display', 'inline-block');
          $resetSubmitBtn.css('display', 'inline-block');
          $form.attr('action', 'forgot-password.php');
          $passwordInput.prop('required', false);
          $messages.empty();
      }

      $forgotLink.on('click', function(e) {
          e.preventDefault();
          setForgotMode();
      });

      $loginBtn.on('click', function(e) {
          if ($form.attr('action').indexOf('forgot-password.php') !== -1) {
              e.preventDefault();
              setLoginMode();
          }
      });

      // Load JSON Schema for email
      $.getJSON('email-schema.json')
          .then(function(schema) {
              const ajv = new Ajv();
              validateEmail = ajv.compile(schema);
          })
          .catch(function() {
              validateEmail = (email) => /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/.test(email); //fallback if the above fails
          });

      // AJAX callback
      $resetSubmitBtn.on('click', function() {
          const emailValue = $.trim($emailInput.val());
          if (emailValue === '') {
              $messages.html('<p class="error">Please enter your email address.</p>');
              return;
          }
          if (!validateEmail) {
              $messages.html('<p class="error">Validator still loading, please wait.</p>');
              return;
          }
          if (!validateEmail(emailValue)) {
              $messages.html('<p class="error">Invalid email format.</p>');
              return;
          }

          $(this).prop('disabled', true).text('Sending...');
          $messages.html('<p class="loading">Processing request...</p>');

          // ajax call to server
          $.ajax({
              url: 'forgot-password.php',
              method: 'POST',
              data: { email: emailValue, ajax: true },
              dataType: 'json',
              success: function(response) {
                  if (response.success && response.token) {
                      window.location.href = 'email-sent-page.php?token=' + encodeURIComponent(response.token);
                  } else {
                      $messages.html('<p class="error">' + (response.message || 'Unable to process request.') + '</p>');
                      $('#reset-submit-btn').prop('disabled', false).text('Submit');
                  }
              },
              error: function(xhr, status, error) {
                  console.error('AJAX error:', error);
                  $messages.html('<p class="error">Network error. Please try again.</p>');
                  $('#reset-submit-btn').prop('disabled', false).text('Submit');
              }
          });
      });
  });
  </script>
</body>
</html>