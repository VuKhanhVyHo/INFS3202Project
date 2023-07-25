<?= form_open_multipart(base_url() . 'upload/upload_file') ?>
    <label for="title">Item Name</label>
    <input type="text" name="title" size="20">
    <br><br>
    <div id = "dropzone">
        <input type="file" name="userfile[]" multiple>
        <br><br>
    </div>
	<input type="text" class="form-control" placeholder="Your comments" required="required" name="comments">
    <br><br>
    <input type="submit" value="upload">
</form>

<script>
    const dropZone = document.getElementById("dropzone");

    dropZone.addEventListener('dragenter',(event)=>{
        dropZone.classList.add("dragger");
    });
    
    dropZone.addEventListener("dragleave", (event) => {
        dropArea.classList.remove("dragger");
    });

    dropZone.addEventListener("drop", (event)=>{

    });
</script>