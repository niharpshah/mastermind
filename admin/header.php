<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		
//	$('#noti').click(function(){
//	
//		$.ajax({
//				url: 'http://localhost/mastermind/admin/noti/setstatus.php',
//				dataType: 'jsonp',
//				jsonp: 'jsoncallback',
//				timeout: 5000,
//				success: function(data, status){
//					$.each(data, function(i,item){ 
//					
//				
//				
//				$.ajax({
//				url: 'http://localhost/mastermind/admin/noti/getpendingnotification.php',
//				dataType: 'jsonp',
//				jsonp: 'jsoncallback',
//				timeout: 5000,
//				success: function(data, status){
//				$('#no').html(data.length);
//					$.each(data, function(i,item){ 
//					
//						$('#no').html(item.number);
//						
//					});
//				},
//				error: function(){
//					console.log('There was an error loading the data.');
//				}
//			   });
//					
//					});
//				},
//				error: function(){
//					console.log('There was an error loading the data.');
//				}
//	
//			});
//	});
//	

//function getcount()
//{
//		$.ajax({
//				url: 'http://localhost/mastermind/admin/noti/getpendingnotification.php',
//				dataType: 'jsonp',
//				jsonp: 'jsoncallback',
//				timeout: 5000,
//				success: function(data, status){
//				$('#no').html(data.length);
//					$.each(data, function(i,item){ 
//					
//						$('#no').html(item.number);
//						if(item.number>0)
//						{
//							$('#chatAudio')[0].play();
//						}
//						
//					});
//				},
//				error: function(){
//					console.log('There was an error loading the data.');
//				}
//			   });
//	}
//	getcount();
//		function get_notification()
//		{
//				$('#notification').html('');
//				$.ajax({
//				url: 'http://localhost/mastermind/admin/noti/getnotification.php',
//				dataType: 'jsonp',
//				jsonp: 'jsoncallback',
//				timeout: 5000,
//				success: function(data, status){
//
//					$.each(data, function(i,item){ 
//                                             
//					        var menudate = new Date(item.date_time);
//  						var menudate1 = menudate.toString("d MMM yyyy hh:mm:ss");
//                                                var menudate2 = menudate1.split(" "); 
//var finalmenuDate = menudate2[2] + " " + menudate2[1] + " " + menudate2[3] + " " + menudate2[4];
//
//						if(item.ticket_id!="")
//						{
//						$('#notification').append('<li><a href="#" class="not_class" id='+item.notification_id+'><div class="details"><div class="name">'+finalmenuDate+'</div><div class="message">A new Ticket Created<strong> '+item.ticketnoti+'</strong>...</div></div></a></li>');
//						}
//						
//						
//					});
//				},
//				error: function(){
//					console.log('There was an error loading the data.');
//				}
//			   });
//			   $('#notification').append('<li><a href="ticketview.php" class="more-messages">See All Notification <i class="icon-arrow-right"></i></a></li>');
//		}
//	get_notification();
//	
//	setInterval(get_notification,10000);
//	setInterval(getcount,10000);
//	
//	$(document).on('click','.not_class',function(){
////	alert('sd');
//		$.ajax({
//				url: 'http://localhost/mastermind/admin/noti/deletenotification.php?id='+$(this).attr("id"),
//				dataType: 'jsonp',
//				jsonp: 'jsoncallback',
//				timeout: 5000,
//				success: function(data, status){
//				$('#no').html(data.length);
//					$.each(data, function(i,item){ 
//					
//						get_notification();
//						window.location='ticketview.php';
//						
//					});
//				},
//				error: function(){
//					console.log('There was an error loading the data.');
//				}
//			   });
//		
//		
//	});
//});	
//	
</script>

<audio id="chatAudio"><source src="Bells.ogg" type="audio/ogg"><source src="Bells.ogg" type="audio/ogg"><source src="Bells.ogg" type="audio/ogg"></audio>


<div class="top-bar">
	<nav class="navbar navbar-default top-bar">
		<div class="menu-bar-mobile" id="open-left"><i class="ti-menu"></i>
		</div>

		<div class="admin-logo">
		<div class="logo-holder pull-left">
			&nbsp;&nbsp;<a href="dashboard.php"><img class="logo" src="assets/images/example.png" alt="logo"></a>
		</div>
		<!-- logo-holder -->			
	</div>
		<ul class="nav navbar-nav navbar-right top-elements">
		
			<li class="piluku-dropdown dropdown" id="noti">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="ion-ios-bell-outline icon-notification"></i><span class="badge info-number message" id="no"></span></a>
				<ul class="dropdown-menu dropdown-piluku-menu  animated fadeInUp wow notification-drop neat_drop dropdown-right" data-wow-duration="1500ms" role="menu"  style="overflow-y:scroll;" id="notification">

				</ul>
			</li>
			
			<li class="piluku-dropdown dropdown">
				<!-- @todo Change design here, its bit of odd or not upto usable -->

				<a href="#" class="dropdown-toggle avatar_width" data-toggle="dropdown" role="button" aria-expanded="false"><span class="avatar-holder"><img src="assets/images/avatar.jpg" alt=""></span><span class="avatar_info"><?php if(isset($_SESSION['logid'])){ echo ucwords($_SESSION['uname']); } ?></span><span class="drop-icon"><!-- <i class="ion ion-chevron-down"></i> --></span></a>
				<ul class="dropdown-menu dropdown-piluku-menu  animated fadeInUp wow avatar_drop neat_drop dropdown-right" data-wow-duration="1500ms" role="menu">
					<li>
						<a href="profile.php"> <i class="ion-android-create"></i>Edit profile</a>
					</li>
					<li>
						<a href="logout.php" class="logout_button"><i class="ion-power"></i>Logout</a>
					</li>   
				</ul>
			</li>
			
		</ul>

	</nav>

</div>