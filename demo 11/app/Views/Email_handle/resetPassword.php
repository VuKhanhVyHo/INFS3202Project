<?= form_open(base_url() . 'resetPass/Confirm') ?>
        <div class="form-group">
            <label for="receiver">Enter the username of your account:</label>
            <input type="text" name="username" placeholder = "Username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="receiver">Enter the token you received:</label>
            <input type="text" name="Token" placeholder = "Your Token" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="receiver">Enter your new password:</label>
            <input type="password" name="nPassword" placeholder = "New password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="receiver">Re-enter your new password:</label>
            <input type="password" name="rPassword" placeholder = "Re-enter your new password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Confirm</button>
<?= form_close() ?>