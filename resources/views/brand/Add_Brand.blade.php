<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加品牌</title>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
 <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/style.css"/>       
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link href="Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
	    <script src="js/jquery-1.9.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/typeahead-bs2.min.js"></script>
         <script src="assets/layer/layer.js" type="text/javascript"></script>
        <script type="text/javascript" src="Widget/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="Widget/swfupload/swfupload.queue.js"></script>
        <script type="text/javascript" src="Widget/swfupload/swfupload.speed.js"></script>
        <script type="text/javascript" src="Widget/swfupload/handlers.js"></script>
        <style>
            .tj{
                width: 600px;
                height: 500px;
                margin: 0 auto;
            }
        </style>
</head>

<body>
<div class=" clearfix tj">
 <div id="add_brand" class="clearfix" >
 <div class="left_add" >
   <div class="title_name">添加品牌</div>
 <form action="{{ route('brand.insert') }}" enctype="multipart/form-data" method="post">
        {{ csrf_field() }}
   <ul class="add_conent">
    <li class=" clearfix"><label class="label_name"><i>*</i>品牌名称：</label>
         <input name="brand_name" type="text" class="add_text"/></li>
    <li class=" clearfix"><label class="label_name">品牌图片：</label>
           <div class="demo l_f">
               <div class="logoupload">
                    <input class="preview" name="logo" id="" type="file">
                  <div class="progress-box" style="display:none;">
                  </div>
              </div>                             
    </li>
         <li class=" clearfix"><label class="label_name"><i>*</i>所属地区：</label>
         <input name="region" type="text" class="add_text" style="width:120px"/></li>
   </ul>
  <div class="button_brand"><input name="" type="submit"  class="btn btn-warning" value="保存"/>
    <input name="" type="reset" value="取消" class="btn btn-warning"/></div>
</form>
 </div>
 
 </div>
</div>
</body>
</html>
<script type="text/javascript">


// 把图片转成一个字符串
function getObjectUrl(file) {
    var url = null;
    if (window.createObjectURL != undefined) {
        url = window.createObjectURL(file)
    } else if (window.URL != undefined) {
        url = window.URL.createObjectURL(file)
    } else if (window.webkitURL != undefined) {
        url = window.webkitURL.createObjectURL(file)
    }
    return url
}

// 当选择图片时触发
$(".preview").change(function(){
    // 获取选择的图片
    var file = this.files[0];
    // 转成字符串
    var str = getObjectUrl(file);
    // 先删除上一个
    $(this).prev('.img_preview').remove();
    // 在框的前面放一个图片
    $(this).before("<div class='img_preview'><img src='"+str+"' width='120' height='120'></div>");
});
</script>
