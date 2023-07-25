<div class="container">    
    <div class="col-4 offset-4">
    <?php echo form_open(base_url() . 'signup/check_signup'); ?>
		<h2 class="text-center">Register for your account</h2>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Username" required="required" name="username">
		</div>
		<div class="form-group">
			<input type="email" class="form-control" placeholder="Your email" required="required" name="email">
		</div>
		<div class="form-group">
			<input type="password" class="form-control" placeholder="Password" required="required" name="password">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block">Sign up</button>
		</div>
		<?php echo form_close(); ?>
    </div>
</div>
