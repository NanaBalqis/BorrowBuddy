<div class="item-details-page" id="login">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading">
          <div class="line-dec"></div>
          <h4>Login To Your Account</h4>
          <span>Home > <a href="#login">Login</a></span>
        </div>
      </div>

      <div class="col-lg-12">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" style="border-radius:20px;">
              <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" style="border-radius:20px;">
              <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form id="contact" action="<?= site_url('login/process') ?>" method="post">
          <div class="row">
            <div class="col-lg-12">
              <fieldset>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" autocomplete="on" required>
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    <button type="button" id="togglePassword" class="eye-toggle-btn">
                        <i class="fas fa-eye"></i>
                    </button>
                  </div>
              </fieldset>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember Me</label>
            </div>
            <div class="col-lg-12 text-left">
                <a href="<?= site_url('forgotpassword') ?>" class="forgot-password-link">Forgot Password?</a>
            </div>
            <div class="col-lg-12 text-center">
              <fieldset>
                <button type="submit" id="form-submit" class="orange-button">Login</button>
              </fieldset>
              <p class="mt-3">Don't have an account? <a href="<?= base_url('register') ?>">Register here</a></p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>
