<?= form_open(base_url() . 'confirmEmail/Finish') ?>   
        <h2> Check your mailbox to verify your email and set up your account </h2>
        <div class="form-group">
            <label for="receiver">Your Username:</label>
            <input type="text" name="username" placeholder = "Username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="receiver">Enter the token you received:</label>
            <input type="text" name="confirmToken" placeholder = "Your Token" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Confirm this email</button>
<?= form_close() ?>