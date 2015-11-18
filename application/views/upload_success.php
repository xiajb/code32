<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
上传成功
<ul>
<?php foreach ($upload_success as $key => $value) :?>

<li><?php  echo $key?>:<?php echo $value?></li>
<?php endforeach;?>
<?php echo anchor('upload','继续上传'); ?>
</ul>
</body>
</html>
