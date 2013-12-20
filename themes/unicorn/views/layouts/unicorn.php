<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?php echo $this->pageTitle ?></title>
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fullcalendar.css" />	
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/unicorn.main.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/unicorn.grey.css" class="skin-color" />
	
    <!-- script -->
    

	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/excanvas.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.ui.custom.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
	
	
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/unicorn.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/unicorn.dashboard.js"></script>
	
	
	
</head>
<body>

		<div id="header">
			<h1><a href="<?php echo Yii::app()->createUrl('/');?>">Admin Cpanel</a></h1>		
		</div>
		
		<div id="search">
			<input type="text" placeholder="Search here..."/><button type="submit" class="tip-right" title="Search"><i class="icon-search icon-white"></i></button>
		</div>
		<div id="user-nav" class="navbar navbar-inverse">
			<?php
			if(!!currentUser()){
			?>
            <ul class="nav btn-group">
                
                <li class="btn btn-inverse dropdown" id="menu-messages"><a href="#"  id="menuprofile" ref="tooltip" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-user"></i> <span class="text"><?php echo currentUser()->first_name;?></span><!-- <span class="label label-important">5</span>--> <b class="caret"></b></a>
                    <!--<ul class="dropdown-menu">
                        <li><a class="sAdd" title="" href="<?php echo Yii::app()->createUrl('/user/changePassword');?>">Change password</a></li>
                        <?php
						// if(currentUser()->superuser==1){
						?>
							<li><a class="sAdd" title="" href="<?php echo Yii::app()->createUrl('/user/register');?>">Register User</a></li>
							<li><a class="sAdd" title="" href="<?php echo Yii::app()->createUrl('/user/admin');?>">Manage User</a></li>
						<?php
						// }
						?>
                    </ul>-->
                </li>
                <!--<li class="btn btn-inverse"><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>-->
                <li class="btn btn-inverse">
				<a href="<?php echo $this->createUrl("/user/logout");?>">
				<i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul>
			<?php
			}
			?>

        </div>
            
		<div id="sidebar">
			<a href="<?php echo Yii::app()->createUrl('/admin/dashboard');?>" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
			<ul>
				<li class="<?php echo (Yii::app()->controller->id=="dashboard" && Yii::app()->controller->action->id=="index") ? "active":"";?>"><a href="<?php echo Yii::app()->createUrl('/admin/dashboard');?>"><i class="icon icon-home"></i> <span>Dashboard</span></a></li>
				<li class="<?php echo (Yii::app()->controller->id=="admin" && Yii::app()->controller->action->id=="index") ? "active":"";?>"><a href="<?php echo Yii::app()->createUrl('/user/admin');?>"><i class="icon icon-user"></i> <span>User</span></a></li>
				<li class="<?php echo (Yii::app()->controller->id=="setting") ? "active":"";?>"><a href="<?php echo Yii::app()->createUrl('/admin/setting/admin');?>"><i class="icon icon-cog"></i> <span>Settings</span></a></li>
				


				

			</ul>
		
		</div>
		
		<div id="style-switcher">
			<i class="icon-arrow-left icon-white"></i>
			<span>Style:</span>
			<a href="#grey" style="background-color: #555555;border-color: #aaaaaa;"></a>
			<a href="#blue" style="background-color: #2D2F57;"></a>
			<a href="#red" style="background-color: #673232;"></a>
		</div>
		
		<div id="content">

			<?php
			echo $content;
			?>
		</div>
</body>
</html>
