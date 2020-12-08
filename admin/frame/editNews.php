<?php
if (empty($_GET['id'])) {
	header("location: {$_SERVER['PHP_SELF']}");
}

$DB->where('newsID', intval($_GET['id']));
$editNewsData = $DB->getOne('tbl_news');
?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="editID" value="<?php echo $editNewsData['newsID'] ?>">

	<div class="form-group">
		<label for="inputTitle">Title</label>
		<input type="text" class="form-control" id="inputTitle" name="eTitle" placeholder="Title" value="<?php echo $editNewsData['title']; ?>" required>
	</div>

	<div class="form-group">
		<label for="inputDesc">Description</label>
		<input type="text" class="form-control" id="inputDesc" name="eDesc" placeholder="Description (optional)" value="<?php echo $editNewsData['desc']; ?>">
	</div>

	<div class="row">
		<div class="col-xs-8">
			<div class="form-group">
				<label for="inputImage">Image</label>
				<input type="file" name="eImage" id="inputImage" accept="image/*" onchange="readURL(this);">
				<p class="help-block">Best resolution of image is 800px x 400px.</p>
			</div>
		</div>
		<div class="col-xs-4">
			<img id="previewImage" src="<?php echo "/assets/img/news/" . $editNewsData['img_url']; ?>" onerror="this.onerror=null;this.src='http://placehold.it/800x400'" class="img-thumbnail" style="width:100%;">
		</div>
	</div>

	<div class="form-group">
		<label for="inputContent">Content</label>
		<textarea class="form-control" rows="8" id="inputContent" name="eContent" placeholder="Content"><?php echo $editNewsData['content']; ?></textarea>
	</div>

	<div class="text-center">
		<button type="submit" class="btn btn-large btn-primary">Save</button>
	</div>
</form>