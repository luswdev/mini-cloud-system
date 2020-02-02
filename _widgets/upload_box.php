<div class="file-upload-box">
	<form class="file-upload" method="post" name="fileUpload" action="_partial/upload.php" method="post" enctype="multipart/form-data">
		<h4>Select file to upload:</h4>
		<div class="file-upload-btn-box">
			<div class="file-location-box">
				<span class="file-location"></span>
			</div>
			<label class="file-upload-btn">
				<input type="file" name="fileToUpload" id="fileToUpload" style="display:none;" required="required">
				Pick
			</label>
		</div>
		<div class="check-btn-box">
			<button class="ready-upload-btn check-btn" type='submit'>Upload</button>
			<button class="close-upload-btn check-btn">Cancel</button>
		</div>
	</form>
</div>