<script type="text/javascript" language="javascript">
	$(document).ready(function(){

	$('#noti').click(function(){
	
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/setstatus.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
					$.each(data, function(i,item){ 
					
				
				
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#no').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#no').html(item.np);
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
							
							
							
							
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
	
			});
	});
	

function getcount()
{
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#no').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#no').html(item.np);
						if(item.np>0)
						{
							$('#chatAudio')[0].play();
						}
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
	}
	getcount();
		function get_notification()
		{
				$('#notification').html('');
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/getnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){

					$.each(data, function(i,item){ 
                                             
					        var menudate = new Date(item.noti_date_time);
  						var menudate1 = menudate.toString("d MMM yyyy hh:mm:ss");
                                                var menudate2 = menudate1.split(" "); 
var finalmenuDate = menudate2[2] + " " + menudate2[1] + " " + menudate2[3] + " " + menudate2[4];

						if(item.hotel_id!="")
						{
						$('#notification').append('<li><a href="#" class="not_class" id='+item.notification_id+'><div class="details"><div class="name">'+finalmenuDate+'</div><div class="message">'+item.noti_msg+' '+item.hotelname+'...</div></div></a></li>');
						}
						
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
			   $('#notification').append('<li><a href="view_noti_menu.php" class="more-messages">See All Notification <i class="icon-arrow-right"></i></a></li>');
		}
	get_notification();
	
	setInterval(get_notification,10000);
	setInterval(getcount,10000);
	
	$(document).on('click','.not_class',function(){
//	alert('sd');
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/deletenotification.php?id='+$(this).attr("id"),
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#no').html(data.length);
					$.each(data, function(i,item){ 
					
						get_notification();
						window.location='view_unapprove_menu.php';
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
		
		
	});
	
	
	
	
	
	
	
	$('#noti1').click(function(){
	
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/order_setstatus.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
					$.each(data, function(i,item){ 
					
				
				
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/order_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#no1').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#no1').html(item.ordernoti);
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
							
							
							
							
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
	
			});
	});
	

function getcount1()
{
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/order_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#no1').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#no1').html(item.ordernoti);
						if(item.ordernoti>0)
						{
							$('#chatAudio1')[0].play();
						}
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
	}
	getcount1();
		function get_notification1()
		{
			
				$('#notification1').html('');
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/order_getnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){

					$.each(data, function(i,item){ 
				//	alert(item.hotel_id);

                                                var orderdate = new Date(item.order_noti_date_time);
  						var orderdate1 = orderdate.toString("d MMM yyyy hh:mm:ss");
                                                var orderdate2 = orderdate1.split(" "); 
var finalorderDate = orderdate2[2] + " " + orderdate2[1] + " " + orderdate2[3] + " " + orderdate2[4];

						if(item.hotel_id=="")
						{
					
						}
						else
						{
								$('#notification1').append('<li><a href="#" class="not_class1" id1='+item.order_noti_id+'><div class="details"><div class="name">'+finalorderDate+'</div><div class="message">'+item.order_message+' '+item.username+'</div></div></a></li>');
						}
						
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
			   $('#notification1').append('<li><a href="view_noti_order.php" class="more-messages">See All Notification <i class="icon-arrow-right"></i></a></li>');
		}
	get_notification1();
	
	setInterval(get_notification1,10000);
	setInterval(getcount1,10000);
	
	$(document).on('click','.not_class1',function(){
	
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/order_deletenotification.php?id='+$(this).attr("id1"),
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#no1').html(data.length);
					$.each(data, function(i,item){ 
					
						get_notification1();
						window.location='view_order.php';
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
		
		
	});
	
	
	
	
	$('#noti2').click(function(){
	
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/complete_order_setstatus.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
					$.each(data, function(i,item){ 
					
				
				
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/complete_order_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#no2').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#no2').html(item.ordernoti);
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
							
							
							
							
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
	
			});
	});
	
	
	
	
	function getcount2()
{
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/complete_order_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#no2').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#no2').html(item.ordernoti);
						if(item.ordernoti>0)
						{
							$('#chatAudio2')[0].play();
						}
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
	}
	getcount2();
		function get_notification2()
		{
			
				$('#notification2').html('');
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/complete_order_getnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){

					$.each(data, function(i,item){ 
				//	alert(item.hotel_id);

                                                var completeorderdate = new Date(item.complete_date_time);
  						var completeorderdate1 = completeorderdate.toString("d MMM yyyy hh:mm:ss");
                                                 var completeorderdate2 = completeorderdate1.split(" "); 
var finalcompleteorderDate = completeorderdate2[2] + " " + completeorderdate2[1] + " " + completeorderdate2[3] + " " + completeorderdate2[4];

						if(item.hotel_id=="")
						{
					
						}
						else
						{
								$('#notification2').append('<li><a href="#" class="not_class2" id2='+item.complete_noti_id+'><div class="details"><div class="name">'+finalcompleteorderDate+'</div><div class="message">Order 000'+item.order_id+' '+item.complete_message+'<br/> By '+item.comhotelname +'</div></div></a></li>');
						}
						
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
			   $('#notification2').append('<li><a href="view_noti_completeorder.php" class="more-messages">See All Notification <i class="icon-arrow-right"></i></a></li>');
		}
	get_notification2();
	
	setInterval(get_notification2,10000);
	setInterval(getcount2,10000);
	
	$(document).on('click','.not_class2',function(){
	
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/complete_order_deletenotification.php?id='+$(this).attr("id2"),
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#no2').html(data.length);
					$.each(data, function(i,item){ 
					
						get_notification1();
						window.location='view_order.php';
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
		
		
	});
	
$('#gronoti1').click(function(){
	
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/group_setstatus.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
					$.each(data, function(i,item){ 
					
				
				
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/group_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#grpno1').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#grpno1').html(item.gp);
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
							
							
							
							
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
	
			});
	});
	

function getcount3()
{
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/group_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#grpno1').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#grpno1').html(item.gp);
						if(item.gp>0)
						{
						//	$('#chatAudio')[0].play();
						}
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
	}
	getcount3();
	
	setInterval(getcount3,10000);
	
	
		$('#grpnoti2').click(function(){
	
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/group_setstatus.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
					$.each(data, function(i,item){ 
					
				
				
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/group_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#grpno2').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#grpno2').html(item.gp);
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
							
							
							
							
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
	
			});
	});
	
	
	
	
	function getcount4()
{
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/group_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#grpno2').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#grpno2').html(item.gp);
						if(item.gp>0)
						{
						//	$('#chatAudio2')[0].play();
						}
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
	}
	getcount4();
		function get_notification4()
		{
			
				$('#grpnotification2').html('');
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/group_getnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){

					$.each(data, function(i,item){ 
				//	alert(item.hotel_id);
              
                                        var groupdate = new Date(item.group_noti_date_time);
  				        var groupdate1 = groupdate.toString("d MMM yyyy hh:mm:ss");
                                        var groupdate2 = groupdate1.split(" "); 
var finalgroupDate = groupdate2[2] + " " + groupdate2[1] + " " + groupdate2[3] + " " + groupdate2[4];

						
								$('#grpnotification2').append('<li><a href="#" class="not_class3" id3='+item.group_notification_id+'><div class="details"><div class="name">'+finalgroupDate+'</div><div class="message">'+item.group_message+'</div></div></a></li>');
						
						
						
					});
				},
				error: function(){
					console.log('There was an error loading the dataf.');
				}
			   });
			   $('#grpnotification2').append('<li><a href="view_noti_groupbooking.php" class="more-messages">See All Notification <i class="icon-arrow-right"></i></a></li>');
		}
	get_notification4();
	
	setInterval(get_notification4,10000);
	setInterval(getcount4,10000);
	
	$(document).on('click','.not_class3',function(){
	
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/group_deletenotification.php?id='+$(this).attr("id3"),
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#grpno2').html(data.length);
					$.each(data, function(i,item){ 
					
						get_notification4();
						window.location='view_group_booking.php';
						
					});
				},
				error: function(){
					console.log('There was an error loading the data6.');
				}
			   });
		
		
	});
		
//Contact Us Notification

$('#contactnoti1').click(function(){
	
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/contact_us_setstatus.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
					$.each(data, function(i,item){ 
					
				
				
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/contact_us_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#contactno1').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#contactno1').html(item.cntntf);
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
							
							
							
							
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
	
			});
	});
	

function getcount5()
{
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/contact_us_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#contactno1').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#contactno1').html(item.cntntf);
						if(item.cntntf>0)
						{
						//	$('#chatAudio')[0].play();
						}
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
	}
	getcount5();
	
	setInterval(getcount5,10000);
	
	
		$('#contactnoti2').click(function(){
	
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/contact_us_setstatus.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
					$.each(data, function(i,item){ 
					
				
				
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/contact_us_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#contactno2').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#contactno2').html(item.cntntf);
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
							
							
							
							
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
	
			});
	});
	
	
	
	
	function getcount6()
{
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/contact_us_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#contactno2').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#contactno2').html(item.cntntf);
						if(item.cntntf>0)
						{
						//	$('#chatAudio2')[0].play();
						}
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
	}
	getcount6();
		function get_notification6()
		{
			
				$('#contactnotification2').html('');
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/contact_us_getnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){

					$.each(data, function(i,item){ 
				//	alert(item.hotel_id);
 
                                        var contactusdate = new Date(item.contact_noti_date_time);
  				       var contactusdate1 = contactusdate.toString("d MMM yyyy hh:mm:ss");
                                       var contactusdate2 = contactusdate1.split(" "); 
var finalcontactusDate = contactusdate2[2] + " " + contactusdate2[1] + " " + contactusdate2[3] + " " + contactusdate2[4];

						
								$('#contactnotification2').append('<li><a href="#" class="not_class4" id4='+item.contact_notification_id+'><div class="details"><div class="name">'+finalcontactusDate+'</div><div class="message">'+item.contact_message+'</div></div></a></li>');
						
						
						
					});
				},
				error: function(){
					console.log('There was an error loading the dataf.');
				}
			   });
			   $('#contactnotification2').append('<li><a href="view_noti_contact_us.php" class="more-messages">See All Notification <i class="icon-arrow-right"></i></a></li>');
		}
	get_notification6();
	
	setInterval(get_notification6,10000);
	setInterval(getcount6,10000);
	
	$(document).on('click','.not_class4',function(){
	
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/contact_us_deletenotification.php?id='+$(this).attr("id4"),
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#contactno2').html(data.length);
					$.each(data, function(i,item){ 
					
						get_notification6();
						window.location='view_contact_us.php';
						
					});
				},
				error: function(){
					console.log('There was an error loading the data6.');
				}
			   });
		
		
	});

//Feedback Notification


$('#feedbacknoti1').click(function(){
	
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/feedback_setstatus.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
					$.each(data, function(i,item){ 
					
				
				
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/feedback_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#feedbackno1').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#feedbackno1').html(item.feedbacknoti);
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
							
							
							
							
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
	
			});
	});
	

function getcount7()
{
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/feedback_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#feedbackno1').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#feedbackno1').html(item.feedbacknoti);
						if(item.feedbacknoti>0)
						{
						//	$('#chatAudio')[0].play();
						}
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
	}
	getcount7();
	
	setInterval(getcount7,10000);
	
	
		$('#feedbacknoti2').click(function(){
	
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/feedback_setstatus.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
					$.each(data, function(i,item){ 
					
				
				
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/feedback_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#feedbackno2').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#feedbackno2').html(item.feedbacknoti);
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
							
							
							
							
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
	
			});
	});
	
	
	
	
	function getcount8()
{
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/feedback_getpendingnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#feedbackno2').html(data.length);
					$.each(data, function(i,item){ 
					
						$('#feedbackno2').html(item.feedbacknoti);
						if(item.feedbacknoti>0)
						{
						//	$('#chatAudio2')[0].play();
						}
						
					});
				},
				error: function(){
					console.log('There was an error loading the data.');
				}
			   });
	}
	getcount8();
		function get_notification8()
		{
			
				$('#feedbacknotification2').html('');
				$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/feedback_getnotification.php',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){

					$.each(data, function(i,item){ 
				//	alert(item.hotel_id);

                                        var feedbackdate = new Date(item.feedback_noti_date_time);
  					var feedbackdate1 = feedbackdate.toString("d MMM yyyy hh:mm:ss");
                                         var feedbackdate2 = feedbackdate1.split(" "); 
var finalfeedbackDate = feedbackdate2[2] + " " + feedbackdate2[1] + " " + feedbackdate2[3] + " " + feedbackdate2[4];

						
								$('#feedbacknotification2').append('<li><a href="#" class="not_class5" id5='+item.feedback_notification_id+'><div class="details"><div class="name">'+finalfeedbackDate+'</div><div class="message">'+item.feedback_message+'</div></div></a></li>');
						
						
						
					});
				},
				error: function(){
					console.log('There was an error loading the dataf.');
				}
			   });
			   $('#feedbacknotification2').append('<li><a href="view_noti_feedback.php" class="more-messages">See All Notification <i class="icon-arrow-right"></i></a></li>');
		}
	get_notification8();
	
	setInterval(get_notification8,10000);
	setInterval(getcount8,10000);
	
	$(document).on('click','.not_class5',function(){
	
		$.ajax({
				url: 'http://bookmyhighwaymeal.com/admin/json/feedback_deletenotification.php?id='+$(this).attr("id5"),
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				timeout: 5000,
				success: function(data, status){
				$('#feedbackno2').html(data.length);
					$.each(data, function(i,item){ 
					
						get_notification8();
						window.location='view_feedback.php';
						
					});
				},
				error: function(){
					console.log('There was an error loading the data6.');
				}
			   });
		
		
	});		
	
	
});	
	
</script>	
<audio id="chatAudio"><source src="Bells.ogg" type="audio/ogg"><source src="notify.mp3" type="audio/mpeg"><source src="Bells.ogg" type="audio/ogg"></audio>
<audio id="chatAudio1"><source src="Bells.ogg" type="audio/ogg"><source src="notify.mp3" type="audio/mpeg"><source src="Bells.ogg" type="audio/ogg"></audio>
<audio id="chatAudio2"><source src="Bells.ogg" type="audio/ogg"><source src="notify.mp3" type="audio/mpeg"><source src="Bells.ogg" type="audio/ogg"></audio>
<div id="navigation">
		<div class="container-fluid">
			<a href="#" id="brand">Highway</a>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
			<ul class='main-nav'>
			
				<li>
					<a href="#" data-toggle="dropdown" class="dropdown-toggle">
						<span>Category</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li class="active">
							<a href="view_main_category.php">Main Category</a>
						</li>
						<li>
							<a href="view_category.php">Category</a>
						</li>
						<li>
							<a href="view_special_category.php">Special Hotel Category</a>
						</li>
						
					</ul>
				</li>
				<!--<li >
					<a href="view_category.php">
						<span>Category</span>
					</a>
				</li>-->
		
				<li>
					<a href="#" data-toggle="dropdown" class="dropdown-toggle">
						<span>Menu</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li class="active">
							<a href="view_menu.php">Menu</a>
						</li>
						<li>
							<a href="view_special_menu.php">Special Menu</a>
						</li>
						
						
					</ul>
				</li>
				
				<li>
					<a href="#" data-toggle="dropdown" class="dropdown-toggle">
						<span>Hotel</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
<li class="active">
							<a href="view_special_hotel.php">Special Hotel</a>
						</li>
						<li>
							<a href="add_hotel.php">Add Hotel</a>
						</li>
						<li>
							<a href="view_hotel.php">View Hotel</a>
						</li>
						<li>
							<a href="hotel_location.php">Hotel Location</a>
						</li>
						
					</ul>
				</li>
				
				<!--<li >
					<a href="view_hotel.php">
						<span>Hotel</span>
					</a>
				</li>-->
				
				<li>
					<a href="#" data-toggle="dropdown" class="dropdown-toggle">
						<span>Order</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li class="active">
							<a href="view_order.php">All Order</a>
						</li>
						<li>
							<a href="order_report.php">Order Report</a>
						</li>
						
						
					</ul>
				</li>
				<li>
					<a href="#" data-toggle="dropdown" class="dropdown-toggle">
						<span>Others</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
<li class="active">
							<a href="active_user.php">Active User</a>
						</li>
						<li class="">
							<a href="view_user.php">All User</a>
						</li>
						<li id="feedbacknoti1">
							<a href="view_feedback.php">All Feedback &nbsp; <span class="label label-lightred" id="feedbackno1"></span></a>
						</li>
						<li id="contactnoti1">
							<a href="view_contact_us.php">All Contact Us &nbsp; <span class="label label-lightred" id="contactno1"></span></a>
						</li>
						<li>
							<a href="view_subscribe.php">All Subscribe</a>
						</li>
						<li id="gronoti1">
							<a href="view_group_booking.php" >All Group Booking &nbsp;<span class="label label-lightred" id="grpno1"></span> </a>
							
						</li>
						
						
					</ul>
				</li>
				
				
				<!--<li >
					<a href="view_user.php">
						<span>User</span>
					</a>
				</li>-->
				<!--<li >
					<a href="view_order.php">
						<span>Order</span>
					</a>
				</li>
				<li >
					<a href="order_report.php">
						<span>Report</span>
					</a>
				</li>-->
				<!--<li >
					<a href="hotel_location.php">
						<span>Hotel Location</span>
					</a>
				</li>-->
				
				<!--<li >
					<a href="view_feedback.php">
						<span>Feedback</span>
					</a>
				</li>-->
				<!--<li >
					<a href="view_contact_us.php">
						<span>Contact Us</span>
					</a>
				</li>-->
				
				
				
			
				
				
			</ul>
			<div class="user">
			<ul class="icon-nav" >



                                     <li class='dropdown' id="contactnoti2" >
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-user"></i><span class="label label-lightred" id="contactno2" ></span></a>
						<ul class="dropdown-menu pull-right message-ul" id="contactnotification2">
							
							
							
							
						</ul>
					</li>
					
					<li class='dropdown' id="grpnoti2" >
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-group"></i><span class="label label-lightred" id="grpno2" ></span></a>
						<ul class="dropdown-menu pull-right message-ul" id="grpnotification2" >
							
							
							
							
						</ul>
					</li>

                                        <li class='dropdown' id="feedbacknoti2" >
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-pencil"></i><span class="label label-lightred" id="feedbackno2" ></span></a>
						<ul class="dropdown-menu pull-right message-ul" id="feedbacknotification2">
							
							
							
							
						</ul>
					</li>

					<li class='dropdown' id="noti">
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-bell"></i><span class="label label-lightred" id="no"></span></a>
						<ul class="dropdown-menu pull-right message-ul" id="notification">
							
							
							
							
						</ul>
					</li>
					<li class='dropdown' id="noti1">
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class=" icon-shopping-cart"></i><span class="label label-lightred" id="no1"></span></a>
						<ul class="dropdown-menu pull-right message-ul" id="notification1">
							
							
							
							
						</ul>
					</li>
					
					<li class='dropdown' id="noti2">
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-ok"></i><span class="label label-lightred" id="no2"></span></a>
						<ul class="dropdown-menu pull-right message-ul" id="notification2">
							
							
							
							
						</ul>
					</li>
					
					
					
					
				</ul>
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo $_SESSION['adminname']; ?> <img src="img/user.png" style="height:30px; width:30px;" alt=""></a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="change_pwd.php">Change Password</a>
						</li>
						
						<li>
							<a href="logout.php">Log out</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>