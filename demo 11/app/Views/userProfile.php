<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img id="profile_image" src="<?php echo base_url().'writable/uploads/'.$user->image; ?>" width="150" height="150" onclick="document.getElementById('imageUpload').click();" />
            <form method="post" action="<?php echo base_url() . 'profile/update_image'; ?>" enctype="multipart/form-data">
                <input type="file" name="image" id="imageUpload" style="display:none;">
                <input type="hidden" name="cropX" id="cropX" />
                <input type="hidden" name="cropY" id="cropY" />
                <input type="hidden" name="cropWidth" id="cropWidth" />
                <input type="hidden" name="cropHeight" id="cropHeight" />
                <input type="hidden" name="croppedImage" id="croppedImage" />
                <button type="submit" class="btn btn-primary">Change Picture</button>
            </form>
        </div>
    </div>
</div>

<script>
    var inputImage = document.getElementById('imageUpload');
    var previewImage = document.getElementById('profile_image');
    var cropper = null;

    inputImage.addEventListener('change', function () {
        var file = this.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            previewImage.src = e.target.result;
            if (cropper !== null) {
                cropper.destroy();
            }
            cropper = new Cropper(previewImage, {
                aspectRatio: 1,
                viewMode: 1,
                crop: function(event) {
                    $('#cropX').val(event.detail.x);
                    $('#cropY').val(event.detail.y);
                    $('#cropWidth').val(event.detail.width);
                    $('#cropHeight').val(event.detail.height);

                    var canvas = cropper.getCroppedCanvas();
                    $('#croppedImage').val(canvas.toDataURL());
                }
            });
        }

        reader.readAsDataURL(file);
});
</script>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form method="post" action="<?php echo base_url() . 'profile/update'; ?>">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Username</td>
                            <td><?php echo $user->username; ?></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="password" value="<?php echo $user->password; ?>"></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><input type="text" name="firstName" value="<?php echo $user->firstName; ?>"></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><input type="text" name="lastName" value="<?php echo $user->lastName; ?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="email" name="email" value="<?php echo $user->email; ?>"></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><input type="text" name="address" value="<?php echo $user->address; ?>"></td>
                        </tr>
                        <tr>
                            <td>Payment</td>
                            <td><input type="text" name="payment" value="<?php echo $user->payment; ?>"></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
