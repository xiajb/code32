<!DOCTYPE html>
<html>
<head>
	<title>upload</title>
</head>
<body>

<?php echo $error;?>
<?php echo form_open_multipart('Upload/do_upload');?>
<input type="file" name="usefile" size="1000">
<input type="submit" value="upload">
</form>
</body>
</html>