<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?php echo $this->pageTitle ?></title>
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/login.css" />
    
	<script>
		var homeURL = "<?php echo Yii::app()->theme->baseUrl; ?>";
	</script>
	
</head>
<body>
<?php echo $content;?>

</body>
</html>
