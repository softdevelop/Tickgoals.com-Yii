<link href="<?php echo baseTheme();?>/css/jquery.counter-analog2.css" rel="stylesheet">
<script src="<?php echo baseTheme();?>/js/jquery.counter.js" type="text/javascript"></script>

<script>
	$().ready(function(e) {
		//$('#counter').counter();
		/*var widthWindow = Math.ceil(960/2);
		var x1PoolShare = $("#id_share_fb").find('iframe');
		console.log(widthWindow)
		console.log(x1PoolShare)
		
		$(".like-button").css({
			'marginLeft':widthWindow+"px"
		});*/
	});
</script>
<div class="home-header">
	<div class="container">
		<div class="row">
				<div class="span5 hidden-phone">
					<a href="<?php echo  Yii::app()->createUrl('/');?>">
						<img src="<?php echo Yii::app()->baseUrl;?>/img/tickgoals-mainimage.jpg" alt="image"></div>
					</a>
				<div class="span7">
					<?php $this->widget('bootstrap.widgets.TbAlert', array(
						'block'=>true, // display a larger alert block?
						'fade'=>true, // use transitions?
						'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
						'alerts'=>array( // configurations per alert type
							'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
						),
					)); ?>
					<h3>Tag line of website will go here probably about two lines of copy</h3>
					<p>Introductory copy Introductory copy Introductory copy Introductory copy Introductory copy Introductory copy Introductory copy Introductory copy Introductory copy </p>
					<?php if(!currentUser()) : ?>
					<div class="social-login-buttons">
						<div id="loginindex" style="display:none">
						<a href="#myModal" role="button" class="btn btn-info" data-toggle="modal" id="" >Login</a>
						</div>
						<a href="#myModalRegister" class="btn btn-info" role="button"  data-toggle="modal" >Register</a>
						<a href="#" class="btn btn-info" id="fb-login-popup">Login with Facebook</a>
						<a onclick='loginTwitter()' href="javascript:void(0)" class="btn btn-info" >Login with Twitter</a>
						
<?php
$oauth_verifier = "";
$twitter = "";
if(!empty($_REQUEST['oauth_verifier'])){
	$oauth_verifier = $_REQUEST['oauth_verifier'];

	/* Create a TwitterOauth object with consumer/user tokens. */
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, Yii::app()->session['oauth_token'], Yii::app()->session['oauth_token_secret']);
	$access_token = $connection->getAccessToken($oauth_verifier); 
	Yii::app()->session['oauth_verifier'] = $oauth_verifier;
	Yii::app()->session['twitter'] = $connection->get('/account/verify_credentials');
	$this->redirect('user/twitter?oauth_verifier='.$oauth_verifier);

}




?>
					</div>
					
<div id="fb-root"></div>
<script type="text/javascript">
var myPopup;
function loginTwitter(){
	document.cookie  = window.open ("<?php echo Yii::app()->createUrl('/site/lt');?>","mywindow","menubar=1,resizable=1,width=450,height=350");
	return false;
}

var userInfo;
var fid = 0;
var fbstatus ;
var accessToken ;
var imgArray;
// Load fb js
window.fbAsyncInit = function() {
  FB.init({
	appId		: '111091495732090', // App ID
	status		: true, // check login status
	cookie		: true, // enable cookies to allow the server to access the session
	xfbml		: true  // parse XFBML
  });
 // Additional initialization code here
  
  // listen for and handle auth.statusChange events
  FB.getLoginStatus(function(response) {
	 fbstatus = response.status;
	  if (response.status === 'connected') {
		// the user is logged in and has authenticated your
		// app, and response.authResponse supplies
		// the user's ID, a valid access token, a signed
		// request, and the time the access token 
		// and signed request each expire
		fid = response.authResponse.userID;
		accessToken = response.authResponse.accessToken;
		FB.api('/me', function(response) {
			femail = response.email;
			// Load image
		   FB.api(
				{
					method: 'fql.query',
					query: 'SELECT pid, src_small, src_small_width, src_small_height, src_big, src_big_height, src_big_width FROM photo WHERE aid IN ( SELECT aid FROM album WHERE owner="' + fid + '" AND name = "Profile Pictures")'
				},
				function(resp) {
					imgArray = new Array();
					var counter = 0;
					for( var index = 0 ; index < resp.length ; index++ )
					{
						imgArray[counter++] = resp[index].src_big;
					};
					var activekey = '';
					
				}
			);
		});
	  } else if (response.status === 'not_authorized') {
		// the user is logged in to Facebook, 
		// but has not authenticated your app
	  } else {
		// the user isn't logged in to Facebook.
	  }
	 });

	
};
// Load the SDK Asynchronously
(function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
 }(document));
$().ready(function(){
   // sign up / sign in fb 
   $('#fb-login-popup').click(function(){
	
	 if(fbstatus == 'connected')
	 {
		// notify
		FB.api('/me',function(resp){
				$.get('<?php echo Yii::app()->baseUrl;?>/user/facebook/store',{token : accessToken , info : resp},function(rs){
					
				   console.log(rs)
					if(rs.type == 'success')
					{
						window.location.href = rs.url;	
					}
				});
			});
	 }
	 else
	 {
		// notify
		FB.login(function(response) {
		   if (response.authResponse) {
			 // redirect to fb create user
			accessToken = response.authResponse.accessToken;
			FB.api('/me',function(resp){
				$.get('<?php echo Yii::app()->baseUrl;?>/user/facebook/store',{token : accessToken , info : resp},function(rs){
					console.log(rs)
					if(rs.type == 'success')
					{
						window.location.href = rs.url;	
					}
				});
			});
		   } 
		 },{scope: 'user_photos,user_videos,email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown'});
	 }
		return false;
   }); 
});
function openTabSignUpFaceBook(res){
	$("#tab-sign-in-email").show();
	$("#tab-sign-in").hide();
	var name = res.name.replace(/ /g,'');
	name = change_alias(name);
	console.log(name)
}
</script>

			
					
					<?php endif;?>
				</div>
		</div>
	</div>
</div>
<?php
if(!empty($_GET['status'])){
?>
<script>
	
	
	window.opener.location.reload();
	window.close();
	
</script>
<?php
}
?>
<div class="container pagination-centered m-top-20 hidden-phone">
	<div class="row">
		<div class="span12">
			<span id="counter" class="counter counter-analog2" data-direction="up" data-format="999,999,999" data-interval="700">
				<?php
				$number = count(Goals::model()->findAll());
				$quata = 6;
				if($number<10) $quata = 7;
				$_number = 0;
				for($i=0;$i<=$quata;$i++){
					$strZero = "1";
					for($y=$i;$y>=0;$y--){
						$strZero.="0";
					}

					$n = $number%$strZero;
					$strZero.=$n;
					$_number = $strZero;
				}
				$number = substr($_number,1);
				
				?>
				
				
				<span class="part part0">
					<span class="digit digit<?php echo substr($number,0,1);?>"><?php echo substr($number,0,1);?></span>
					<span class="digit digit<?php echo substr($number,1,1);?>"><?php echo substr($number,1,1);?></span>
					<span class="digit digit<?php echo substr($number,2,1);?>"><?php echo substr($number,2,1);?></span>
				</span>
				<span class="separator separator1">,</span>
				<span class="part part2">
					<span class="digit digit<?php echo substr($number,3,1);?>"><?php echo substr($number,3,1);?></span>
					<span class="digit digit<?php echo substr($number,4,1);?>"><?php echo substr($number,4,1);?></span>
					<span class="digit digit<?php echo substr($number,5,1);?>"><?php echo substr($number,5,1);?></span>
				</span>
				<span class="separator separator3">,</span>
				<span class="part part4">
					<span class="digit digit<?php echo substr($number,6,1);?>"><?php echo substr($number,6,1);?></span>
					<span class="digit digit<?php echo substr($number,7,1);?>"><?php echo substr($number,7,1);?></span>
					<span class="digit digit<?php echo substr($number,8,1);?>"><?php echo substr($number,8,1);?></span>
				</span>
			</span>
			<h4>GOALS CREATED</h4>
		</div>
		<div class="span12" style="position:relative">
			<div class="like-button" style="position:absolute;left:41.4%">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style ">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count" id="id_share_fb"></a>
				<a class="addthis_button_tweet" id="id_share_tw"></a>
				<!--<a class="addthis_button_pinterest_pinit"></a>
				<a class="addthis_counter addthis_pill_style"></a>-->
				</div>
				<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50cbde4c2c327052"></script>
				<!-- AddThis Button END -->
			</div>
		</div>

	</div>
</div>
