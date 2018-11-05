<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/style.css"/>       
        <link href="assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
			<script src="assets/js/jquery.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/typeahead-bs2.min.js"></script>
		<!-- page specific plugin scripts -->
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="js/H-ui.js"></script> 
        <script type="text/javascript" src="js/H-ui.admin.js"></script> 
        <script src="assets/layer/layer.js" type="text/javascript" ></script>
		<script src="assets/laydate/laydate.js" type="text/javascript"></script>
		<style>
		
		</style>
<title>权限列表</title>
</head>

<body>
<div class="page-content clearfix">
    <div id="Member_Ratings">
      <div class="d_Confirm_Order_style">
    <div class="search_style">
     
      <ul class="search_content clearfix">
       <li><label class="l_f">权限名称</label><input name="" type="text"  class="text_add" placeholder="输入权限名称"  style=" width:400px"/></li>
       <li><label class="l_f">添加时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
       <li style="width:90px;"><button type="button" class="btn_search"><i class="icon-search"></i>查询</button></li>
      </ul>
    </div>
     <!---->
     <div class="border clearfix">
       <span class="l_f">
       <a href="{{ route('privilege_add') }}"  class="btn btn-warning"><i class="icon-plus"></i>添加权限</a>
        {{-- <a href="javascript:ovid()" class="btn btn-danger"><i class="icon-trash"></i>批量删除</a> --}}
       </span>
       {{-- <span class="r_f">共：<b>2345</b>条</span> --}}
     </div>
     <!---->
     <div class="table_menu_list">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
				<th width="25"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
        <th width="80">ID</th>
        <th width="180">权限名</th>
				<th width="180">URL地址</th>                        
				<th width="180">加入时间</th>
				<th width="180">操作</th>
			</tr>
		</thead>
	<tbody>
		@foreach($privilege as $v)
		<tr>
          <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
		<td>{{ $v->id }}</td>          
    <td style="text-align: left !important">{!!str_repeat('-', 2*(count(explode('-', $v->path))-2))!!}{{ $v->pri_name }}</td> 
    <td>{{ $v->url_path }}</td>             
    <td>{{ $v->created_at }}</td>
    <td class="td-manage">
			<a title="编辑" href="{{ route('privilege_edit',['id' => $v->id]) }}"  class="btn btn-xs btn-info" ><i class="icon-edit bigger-120"></i></a> 			
          	<a title="删除" href="javascript:;"  onclick="member_del(this,{{$v->id}})" class="btn btn-xs btn-warning" ><i class="icon-trash  bigger-120"></i></a>
          </td>
		</tr> 
		@endforeach
      </tbody>
	</table>
   </div>
  </div>
 </div>
</div>
</body>
</html>
<script>
jQuery(function($) {
			
	$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
	})



/*权限-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type:'GET',
			url:"{{ route('privilege.delete') }}",
			data:{id:id},
			success:function(data){
				$(obj).parents("tr").remove();	
				layer.msg('已删除!',{icon:1,time:1000});
			}
		})
	});
}
laydate({
    elem: '#start',
    event: 'focus' 
});

</script>