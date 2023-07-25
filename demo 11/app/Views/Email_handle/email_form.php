<?= form_open(base_url() . 'email/send') ?>
        <div class="form-group">
            <label for="receiver">Your Username:</label>
            <input type="text" name="username" placeholder = "Username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="receiver">Your registered email:</label>
            <input type="email" name="receiver" placeholder = "Your Email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Send Email</button>
<?= form_close() ?>