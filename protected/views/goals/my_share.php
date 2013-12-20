<div class="container m-top-25 m-bottom-30">
	<div class="row">
		<div class="span12">
		<?php $this->widget('bootstrap.widgets.TbAlert', array(
			'block'=>true, // display a larger alert block?
			'fade'=>true, // use transitions?
			'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
			'alerts'=>array( // configurations per alert type
				'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
			),
		)); ?>
		</div>
		<div class="span12">
			<div class="theme-box outer-box">
				<div class="theme-box-head">
					
					<?php
					$us = Users::model()->findByPk(outBin($uId));
					$fn = "";
					if(!empty($us)) $fn = $us->first_name."'s";
					
					if(currentUser() && currentUser()->id==outBin($uId)){
						$fn = "";
					?>
					
					<?php } ?>
					<h4><?php echo ucwords($fn);?> Goals</h4>
				</div>
				
				
						
						
							<?php
							
							if(!empty($lists)){
								$list = $lists;
								// foreach($lists as $key=>$list){
							?>
							<div class="p-20 ">
								<div class="theme-box">
									<div class="p-12">
										<h5>
										
										<?php echo $list->name;?></h5>
										
										<?php
											if(!empty($list->goals)){
												foreach($list->goals as $k=>$goal){
													$this->renderPartial('//common/_goals',array(
														'goal'=>$goal,
														'uId'=>$uId,
														'listId'=>outStr($list->id),
														'share'=>true,
														'guest'=>false
													));
										
												}
											}
										?>										
										
										
										
										
										
										<?php
										//if(currentUser() && currentUser()->id==outBin($uId)){
										?>
										<!--<a href="<?php echo Yii::app()->createUrl('/goals/add',array('listId'=>outStr($list->id)));?>" class="btn btn-info pull-right margin-top-5"><i class="icon-plus icon-white"></i> Add Goal</a>-->
										<?php //} ?>
										<div class="clearfix"></div>
									</div>
									
								</div>
							</div>
							<?php
								// }
							}else{
							?>
							<div class="p-20 p-bottom-none">
								<div class="theme-box">
									<div class="p-12">
										Goals not found 
									</div>
								</div>
							</div>
							<?php
							}
							?>
							
						
						
				
				
			</div>
			
		</div>
		<div class="span12" style="margin-top:10px;">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments span12" data-href="<?php echo $_SERVER["SERVER_NAME"]."/".Yii::app()->request->url;?>" data-width="800" data-num-posts="2" style="text-align:center"></div>

		</div>
	</div>
</div>
<script>
var title = "";
var listid = "";
$().ready(function(e){
	$("#share-list").live('click',function(e){
		title = $(this).attr('name');
		listid = $(this).attr('listid');
	});
	$("#sEmail").live('click',function(e){
		window.location.href = "<?php echo Yii::app()->baseUrl;?>/site/shareMail?url="+$(this).attr('url')+"&listid="+listid+"&title="+title;
	});
});
</script>
<div id="myModalShare" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Share your list</h3>
	</div>
	<div class="modal-body">
		<div class="p-20">
			<div class="theme-box">
<style>
ul.way2blogging-social {
list-style: none;
margin: 5px 0;
display: inline-block;
}
ul.way2blogging-social li {
display: inline;
float: left;
background-repeat: no-repeat;
}
.stButton {
position: relative;
z-index: 1;
text-decoration: none;
color: #000;
display: inline-block;
cursor: pointer;
margin-right: 3px;
margin-left: 3px;
font-size: 11px;
line-height: 16px;
}
ul.way2blogging-size32 li a {
width: 32px;
height: 32px;
}

ul.way2blogging-social li a {
display: block;
padding-right: 5px;
position: relative;
text-decoration: none;
}
#sharethisfacebook strong{display:none}
#sharethistwitter strong{display:none}
</style>
				<div class="p-12" id="container-share" style="text-align:center">
				<ul class="way2blogging-social way2blogging-size32">
					<li >
						<a class='javascript:void(0)' id="sEmail" url="<?php echo $this->createAbsoluteUrl('/goals?uId='.$uId);?>" >
							<span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton"><span class="stLarge" style="background-image: url(<?php echo Yii::app()->baseUrl;?>/images/email_32.png);"></span>
								<img src="http://w.sharethis.com/images/check-big.png" style="position: absolute; top: -7px; right: -7px; width: 19px; height: 19px; max-width: 19px; max-height: 19px; display: none;">
							</span>
						</a>				
					</li>
				</ul>
				


				<script type="text/javascript">var switchTo5x=true;</script>
				<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
				<script type="text/javascript">stLight.options({publisher: "55a97ade-d68f-4b04-ad48-b0569533210d"});</script>

				<?php
$this->widget('ext.sharebox.EShareBox', array(
    // url to share, required.
    'url' => $this->createAbsoluteUrl('/goals?uId='.$uId),
 
    // A title to describe your link, required.
    // Some services will ignore this value.
    'title'=> 'My Awesome web site !!',
 
    // Size of the icons to display, in pixels.
    // Default is 24px, available sizes : 16, 24, 32, 48.
    'iconSize' => 32,
 
    // Whether to animate the links.
    // Default is true
    'animate' => false,
    
 
   // Social networks to include, excluding all others.
   // The exclude filter is still run.
   //'include' => array('technorati', 'digg'),
 
   // Social networks to exclude from display.
   // By default none are excluded.
   'exclude' => array('technorati','email', 'digg','reddit','linkedin','stumbleupon','google-plus','newsvine','delicious'),
 
   // Use your own icons! Note that you will need to have
   // a subfolder of the appropriate icons sizes.
   // ie: /myimages/social/16px /myimages/social/24px ...
   //'iconPath' => '/myimages/social',
 
   // HTML options for the UL element.
   //'ulHtmlOptions' => array('class' => 'myCustomUlClass'),
 
   // HTML options for all the LI elements.
   //'liHtmlOptions' => array('class' => 'myCustomLiClass'),
));
				?>

				</div>
				
			</div>
		</div>
	</div>
	<div class="modal-footer">
		
	</div>
</div>
<?php if(currentUser()) : ?>
<div id="myModalCreateList" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Create new list</h3>
	</div>
	<?php 
	$model = new Lists;
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'lists-form',
		'action'=>Yii::app()->createUrl('/goals/createList'),
		'enableAjaxValidation'=>true,
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		'focus'=>array($model,'name'),
		'htmlOptions'=>array(
			'style'=>"margin-bottom:0px"
		)
	)); 
	?>
	
	<div class="modal-body">
		<div class="p-20">
			<div class="theme-box">
				
				<div class="p-12">
						<fieldset>
							<?php echo $form->labelEx($model,'name'); ?>
							<?php echo $form->textField($model,'name',array('style'=>'width:98%','placeholder'=>'Name')); ?>
							<?php echo $form->error($model,'name'); ?>
							<div class="clearfix"></div>
							

						</fieldset>
					
				</div>
				
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-info">Create</button>
		
	</div>
	<?php $this->endWidget(); ?>
</div>
<?php endif;?>
