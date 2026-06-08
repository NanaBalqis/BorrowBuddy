<div class="item-details-page" id="reset-password">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading">
          <div class="line-dec"></div>
          <h4>Reset Your Password</h4>
          <span>Home > <a href="#reset-password">Reset Password</a></span>
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

        <form id="contact" action="<?= site_url('resetpasswordprocess') ?>" method="post">
          <div class="row">
            <input type="hidden" name="reset_token" value="<?= $token ?>">
            <div class="col-lg-12">
              <fieldset>
                <label for="password">New Password</label>
                <div class="password-wrapper">
                  <input type="password" name="password" id="password" placeholder="Enter new password" required>
                  <button type="button" id="togglePassword" class="eye-toggle-btn">
                      <i class="fas fa-eye"></i>
                  </button>
                </div>
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm new password" required>
              </fieldset>
            </div>
            <div class="col-lg-12 text-center">
              <fieldset>
                <button type="submit" id="form-submit" class="orange-button">Reset Password</button>
              </fieldset>
              <p class="mt-3">Back to <a href="<?= base_url('login') ?>">Login</a></p>
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
