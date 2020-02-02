<div class="drag-upload-box">
    <div class="drag-upload">
	    <span>Drop file here to upload.</span>
    </div>
		<input type="file" name="drag-file" id="drag-file" style="display:none;">

    <form class="drag-file-upload" name="drag" method="post" action="_partial/drag_upload.php" method="post" enctype="multipart/form-data">
		<input type="file" name="drag-file[]" multiple id="drag-file" style="display:none;">
		<input type="text" name="pwd" id="drag-file-pwd" value="<?php echo $_SESSION['pwd'] ?>" style="display:none;">
	</form>
</div>