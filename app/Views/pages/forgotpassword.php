<div class="item-details-page" id="forgotpassword">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading">
          <div class="line-dec"></div>
          <h4>Forgot Your Password?</h4>
          <span>Home > <a href="#forgotpassword">Forgot Password</a></span>
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

        <form id="contact" action="<?= site_url('forgotpassword/process') ?>" method="post">
          <div class="row">
            <div class="col-lg-12">
              <fieldset>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your registered email" required>
              </fieldset>
            </div>
            <div class="col-lg-12 text-center">
              <fieldset>
                <button type="submit" id="form-submit" class="orange-button">Send Reset Link</button>
              </fieldset>
              <p class="mt-3">Want to login? <a href="<?= base_url('login') ?>">Login here</a></p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

