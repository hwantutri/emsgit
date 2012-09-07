jQuery(document).ready(function(){ 
  jQuery("#htmlTable").jqGrid({
    url:'someurl.php',
	editurl:'someurl.php',
    datatype: 'json',
    mtype: 'POST',
    colNames:['Stock ID','Name', 'Brand','Price','Quantity','Total Price'],
    colModel :[{
		name:'sid'
		,index:'sid'
		,align:'center'
		,width:120
		,editable:true
	},{
		name:'sname'
		,index:'sname'
		,width:150
		,align:'center'
		,editable:true
	},{
		name:'sbrand'
		,index:'sbrand'
		,width:150
		,align:'center'
		,editable:true
	},{
		name:'sprice'
		,index:'sprice'
		,width:150
		,align:'center'
		,editable:true
	},{
		name:'squantity'
		,index:'squantity'
		,width:150
		,align:'center'
		,editable:true
	},{
		name:'stotal'
		,index:'stotal'
		,width:150
		,align:'center'
		,editable:false
	}],
    pager: jQuery('#htmlPager'),
    rowNum:10,
    rowList:[10,20,30],
    sortname: 'sid',
    sortorder: "asc",
    viewrecords: true,
    imgpath: 'themes/coffee/images',
    caption: 'MAGNUM Computer Sales and Services - Inventory',
	/* These are custom vars sent on each READ, or SELECT request */
	postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
	}
  }).navGrid('#htmlPager', {del:false}); 
});/* end of on ready event */ 
