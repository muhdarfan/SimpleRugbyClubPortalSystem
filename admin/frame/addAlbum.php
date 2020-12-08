<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label for="inputName">Album Name</label>
		<input type="text" class="form-control" id="inputName" name="name" placeholder="Album Name" value="<?php echo (isset($_POST['name']) ? $_POST['name'] : ''); ?>" required>
	</div>

	<div class="form-group">
		<label for="inputDesc">Description</label>
		<input type="text" class="form-control" id="inputDesc" name="desc" placeholder="Description (optional)">
	</div>

	<div class="row">
		<div class="col-xs-8">
			<div class="form-group">
				<label for="inputImage">Thumbnail</label>
				<input type="file" name="image" id="inputImage" accept="image/*" onchange="readURL(this);">
				<p class="help-block">Best resolution of image is 500px x 300px.</p>
			</div>
		</div>
		<div class="col-xs-4">
			<img id="previewImage" src="http://placehold.it/500x300" onerror="this.onerror=null;this.src='http://placehold.it/500x300'" class="img-thumbnail" style="width:100%;">
		</div>
    </div>
    
	<div class="text-center">
		<button type="submit" class="btn btn-large btn-primary">Post</button>
	</div>
</form>