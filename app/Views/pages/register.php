<style>
  .d-none {
    display: none !important;
  }
</style>
<div class="item-details-page" id="register">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h4>Create Your Account Now</h4>
            <span>Home > <a href="#register">Register</a></span>
          </div>
        </div>
        <div class="col-lg-12">
            <?php if (session()->getFlashdata('validation')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('validation')->listErrors() ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger" style="border-radius:20px;"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success" style="border-radius:20px;"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
          <form id="contact" action="<?= site_url('register/process') ?>" method="post">
            <div class="row">
              <div class="col-lg-6">
                <fieldset>
                  <label for="name">Full Name</label>
                  <input type="text" name="fullName" id="fullName"  pattern="[A-Za-z\s]+" placeholder="Enter your full name" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Enter your email" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <label for="phoneNum">Phone Number</label>
                  <input type="tel" name="phoneNum" id="phoneNum" pattern="[0-9]{10,11}" placeholder="Enter your phone number 10-11 digit" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <label for="password">Password</label>
                  <div class="password-wrapper">
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    <button type="button" id="togglePassword" class="eye-toggle-btn">
                        <i class="fas fa-eye"></i>
                    </button>
                  </div>
                  <p id="password-message" class="password-message"></p>
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" required>
                  <p id="confirmpassword-message" class="password-message"></p>
                </fieldset>
              </div>
              <input type="hidden" name="userType" value="member">
              <div class="col-lg-12 text-center">
                <fieldset>
                  <button type="submit" id="form-submit" class="orange-button">Register</button>
                </fieldset>
                <p class="mt-3">Already have an account? <a href="<?= base_url('login') ?>">Login here</a></p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
        // Function to update eye toggle button position
        function updateEyeTogglePosition() {
            const toggleButton = document.getElementById('togglePassword');

            toggleButton.style.top = `25px`;
        }

        document.getElementById("password").addEventListener("input", function() {
            var password = this.value;
            var message = document.getElementById("password-message");
            var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{8,}$/;

            if (!regex.test(password)) {
                message.innerHTML = "Password must contain at least 1 digit, 1 uppercase letter, 1 lowercase letter, 1 special character, and be at least 8 characters long.";
                message.style.color = "#ff9999";
                message.style.marginBottom = "10px";

                updateEyeTogglePosition();
            } 
            else {
                message.innerHTML = "Password is secure.";
                message.style.color = "#66cc66";
                message.style.marginBottom = "10px";
            }
        });

        document.getElementById("confirm_password").addEventListener("input", function() {
            var password = document.getElementById("password").value;
            var confirmPassword = this.value;
            var message = document.getElementById("confirmpassword-message");

            if (password !== confirmPassword) {
                message.innerHTML = "Passwords do not match.";
                message.style.color = "#ff9999";
                message.style.marginBottom = "10px";

                updateEyeTogglePosition();
            } else {
                message.innerHTML = "Password is match.";
                message.style.color = "#66cc66";
                message.style.marginBottom = "10px";
            }
        });

        function showSuccessMessage(message, redirectUrl) {
            alert(message);
            window.location.href = redirectUrl;
        }

        <?php if (isset($successMessage)) : ?>
            showSuccessMessage("<?= $successMessage ?>", "<?= site_url('login') ?>");
        <?php endif; ?>

        // Eye toggle
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        document.getElementById("userType").addEventListener("change", function () {
          const userType = this.value;
          const adminFields = document.querySelectorAll(".admin-only");
          if (userType === "admin") {
            adminFields.forEach(el => el.classList.remove("d-none"));
          } else {
            adminFields.forEach(el => el.classList.add("d-none"));
          }
        });
  </script>