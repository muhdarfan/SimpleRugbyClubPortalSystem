<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputTitle">Album Name</label>
        <input type="text" class="form-control" id="inputTitle" name="eName" placeholder="Title"
               value="<?php echo $AlbumData['album_name']; ?>" required>
    </div>

    <div class="form-group">
        <label for="inputDesc">Description</label>
        <input type="text" class="form-control" id="inputDesc" name="eDesc" placeholder="Description (optional)"
               value="<?php echo $AlbumData['album_desc']; ?>">
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th>Photo ID</th>
                    <th style="width: 20%;">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $DB->where('album_id', $AlbumData['album_id']);
                $Photos = $DB->get('tbl_photos');

                if (count($Photos) > 0) {
                    $count = 0;
                    foreach ($Photos as $Photo) {
                        $count++;
                        ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $Photo['photo_id']; ?> <a>Click to view.</a></td>
                            <td><a href="pid=<?php echo $Photo['photo_id']; ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='3'>No photos to be displayed.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-large btn-primary">Save</button>
    </div>
</form>
