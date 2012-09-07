	
	$(document).ready(function(){
	
	//create tabs for navigation
	$('#container-1 > ul').tabs({ fx: { opacity: 'toggle'}});

	$('#nestedtab > ul').tabs();
	
	$('#wdate').DatePicker({
	//format:'Y-m-d',
	date: $('#wdate').val(),
	current: $('#wdate').val(),
	starts: 0,
	//position: 'right',
	onBeforeShow: function(){
				$('#wdate').DatePickerSetDate($('#wdate').val(), true);
			//	notify(vdate,'Please wait');
			},
	onChange: function(formated, dates){
		$('#wdate').val(formated);
		$('#wdate').DatePickerHide();
		var wdate = $("#wdate").val();
		}
	});
	
	$("#submitbtn").click(function(e){ 
        	e.preventDefault();
		var sclient = $.trim($("#client").val());
		var sdesc = $.trim($("#wdesc").val());
		if ((sclient.length > 0) && (sdesc.length > 0) ){
	        add_key(sdesc);
		}
		else {
			notify3('You shall not pass!!!','All fields are required');
		}
             $("#wdesc").val("");
			 $("#client").val("");
         });
		 
	$("#submitbutton").click(function(e){ 
        	e.preventDefault();
		var crid = $.trim($("#crewid").val());
		var assignment_name= $("#auto").val();
		if((crid.length == 0)&&(assignment_name.length == 0)){
			notify2('Error:','Both fields are required');
		}
		else if (crid.length > 0){
			$.post("check.php", {crid : crid}, function(data){
				data = $.trim(data);
				if (data.length==7){ 
					assign(crid);
				}
				else if (data.length == 1){
					notify3('Error:','Enter a valid crew ID');
				}
			});
		}
		else{
			notify2('Error:','Enter a crew ID');
		}
    });
		 
		
		function add_key(sk){
			 var wdate = $("#wdate").val();
	         var wtime = $("#wtime").val();
			 var wclient = $("#client").val();
        		$.post("./addrecord.php", {wdesc : sk, wdate : wdate, wtime : wtime, wclient : wclient }, function(data){
			data = $.trim(data);
          		if (data.length > 0){ 
				notify('Success!','New assignment added');
				$("#show").flexReload();
          		}
        });
	};
	
		function assign(crid){
			 var blah = $("#auto").val();
			 if(blah.length>0){
        		$.post("update.php", {crid : crid, asname : blah}, function(data){
			data = $.trim(data);
          		if (data.length==7){ 
				notify('Success!',blah+' is assigned to '+crid);
				$("#show").flexReload();
				$("#show1").flexReload();
				$("#auto").val("");
				$("#crewid").val("");
          		}
				else if (data.length == 1){
				notify3('Error:','Assignment is unavailable. Please try reloading the page');
				$("#auto").val("");
				}
				else if (data.length == 2){
				notify3('Error:','Conflict in schedule');
				}
        });
		}
			else{
				notify2('Error:','Enter assignment name');
			}
	};
	
		function notify(heading, msg) {
		var notice = 	
			'<div class="notice">'
			+ '<div class="notice-body">' 
			+ '<img src="./images/success_baby.jpg" alt="" />'
			+ '<h3>' + heading + '</h3>'
			+ '<p>' + msg + '</p>'
			+ '</div>'
			+ '<div class="notice-bottom">'
			+ '</div>'
			+ '</div>';

			$(notice).purr({
				usingTransparentPNG: true//,
			//isSticky : true
			});
		}
		
		function notify2(heading, msg) {
		var notice = 	
			'<div class="notice">'
			+ '<div class="notice-body">' 
			+ '<img src="./images/one-does-not-simply.jpg" alt="" />'
			+ '<h3>' + heading + '</h3>'
			+ '<p>' + msg + '</p>'
			+ '</div>'
			+ '<div class="notice-bottom">'
			+ '</div>'
			+ '</div>';

			$(notice).purr({
				usingTransparentPNG: true//,
			//isSticky : true
			});
		}
		
		function notify3(heading, msg) {
		var notice = 	
			'<div class="notice">'
			+ '<div class="notice-body">' 
			+ '<img src="./images/you-shall-not-pass2.jpg" alt="" />'
			+ '<h3>' + heading + '</h3>'
			+ '<p>' + msg + '</p>'
			+ '</div>'
			+ '<div class="notice-bottom">'
			+ '</div>'
			+ '</div>';

			$(notice).purr({
				usingTransparentPNG: true//,
			//isSticky : true
			});
		}
		
		var variable = "AVAILABLE";
		$("#show").flexigrid({
		title		: 'MAGNUM - Assignment Status',
		url			: 'fetch.php',
		dataType	: 'json',
		colModel 	: [
					{display: 'ID', name : 'wid', width : 80, sortable : true, align: 'center'},
					{display: 'Description', name : 'wdescription', width : 240, sortable : true, align: 'center'},
					{display: 'Client', name : 'wclient', width : 180, sortable : true, align: 'center'},
					{display: 'Date of Service', name : 'wtime', width : 125, sortable : false, align: 'center'},
					{display: 'Status', name : 'wstatus', width : 130, sortable : true, align: 'center'}//,
				  ],
		qtype		: 'wstatus',
		query		: variable,
		sortname	: 'wstatus',
		sortorder	: 'desc',
		usepager	: true,
		useRp		: false,
		rp		: 8,
		showTableToggleBtn: false,
		resizable	: false,
		width		: 815,
		height		: 185
		});
		
		$("#show1").flexigrid({
		title		: 'MAGNUM - Service Crew Status',
		url			: 'fetch2.php',
		dataType	: 'json',
		colModel 	: [
					{display: 'ID', name : 'cid', width : 80, sortable : true, align: 'center'},
					{display: 'Name', name : 'cname', width : 240, sortable : true, align: 'center'},
					{display: 'E-mail Address', name : 'ceadd', width : 180, sortable : true, align: 'center'},
					{display: 'No. of Assignments', name : 'caddress', width : 125, sortable : false, align: 'center'}//,
				  ],
		qtype		: 'cid',
		query		: variable,
		sortname	: 'cid',
		sortorder	: 'desc',
		usepager	: true,
		useRp		: false,
		rp		: 8,
		showTableToggleBtn: false,
		resizable	: false,
		width		: 670,
		height		: 185
		});
		
		var pass= $("#auto").val();
		$('#auto').autocomplete('search.php/?q='+pass+'&r=phrase', {
			selectFirst: true
		});
		var pass2= $("#crewid").val();
		$('#crewid').autocomplete('search.php/?q='+pass2+'&r=phrase2', {
			selectFirst: true
		});
		$('#crewid2').autocomplete('search.php/?q='+pass2+'&r=phrase2', {
			selectFirst: true
		});
}); 