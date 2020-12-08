<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label for="inputTitle">Title</label>
		<input type="text" class="form-control" id="inputTitle" name="title" placeholder="Title" value="<?php echo (isset($_POST['title']) ? $_POST['title'] : ''); ?>" required>
	</div>

	<div class="form-group">
		<label for="inputDesc">Description</label>
		<input type="text" class="form-control" id="inputDesc" name="desc" placeholder="Description (optional)">
	</div>

	<div class="row">
		<div class="col-xs-8">
			<div class="form-group">
				<label for="inputImage">Image</label>
				<input type="file" name="image" id="inputImage" accept="image/*" onchange="readURL(this);">
				<p class="help-block">Best resolution of image is 800px x 400px.</p>
			</div>
		</div>
		<div class="col-xs-4">
			<img id="previewImage" src="http://placehold.it/800x400" onerror="this.onerror=null;this.src='http://placehold.it/800x400'" class="img-thumbnail" style="width:100%;">
		</div>
	</div>

	<div class="form-group">
		<label for="inputContent">Content</label>
		<textarea class="form-control" rows="8" id="inputContent" name="content" placeholder="Content"><?php echo (isset($_POST['content']) ? $_POST['content'] : ''); ?></textarea>
	</div>

	<div class="text-center">
		<button type="submit" class="btn btn-large btn-primary">Post</button>
	</div>
</form>