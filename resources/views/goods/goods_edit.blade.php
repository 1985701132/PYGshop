<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/respond.min.js"></script>
<script type="text/javascript" src="js/PIE_IE678.js"></script>
<![endif]-->
<link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/css/style.css"/>       
<link href="/assets/css/codemirror.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/ace.min.css" />
      <link rel="stylesheet" href="/Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
<link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
<link href="/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="/Widget/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />

<title>新增图片</title>
</head>
<body>
<div class="clearfix" id="add_picture">
<div id="scrollsidebar" class="left_Treeview">
    <div class="show_btn" id="rightArrow"><span></span></div>
    <div class="widget-box side_content" >
    <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
     <div class="side_list">
      <div class="widget-header header-color-green2">
          <h4 class="lighter smaller">选择产品类型</h4>
      </div>
      <div class="widget-body">
          {{-- <div class="widget-main padding-8">
              <div  id="treeDemo" class="ztree"></div>
          </div> --}}
  </div>
  </div>
  </div>  
  </div>
   <div class="page_right_style">
   <div class="type_title">添加商品</div>
   <form action="{{ route('goods.edit',['id'=>$goods->id]) }}" method="post" class="form form-horizontal" enctype="multipart/form-data" id="form-article-add">
    {{ csrf_field() }}

		<div class=" clearfix cl">
         <label class="form-label col-2">商品名称：</label>
         <div class="formControls col-10">
         <input type="text" class="input-text" value="{{ $goods->goods_name }}" placeholder="" id="" name="goods_name">
        </div>
        </div>
        
        <div class=" clearfix cl">
            <label class="form-label col-2">LOGO：</label>
            <img width="130" height="130" class="img_preview" src="/uploads/{{ $goods->logo }}" alt="">
            <input class="preview" name="logo" id="" type="file">                
        </div>
			
		<div class="clearfix cl">
			<label class="form-label col-2">内容摘要：</label>
			<div class="formControls col-10">
            <textarea name="description" cols="" rows="" class="textarea"  placeholder="{{ $goods->description }}" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,200)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
        </div>

        <div class=" clearfix cl">
            <label class="form-label col-2">商品分类：</label>
            <select name="cat1_id" id="catid" class="required">
                <option value="">请选择</option>
                @foreach($category as $v)
            <option @if($v->id == $goods->cat1_id) selected @endif  value="{{ $v->id }}">{{ $v->cat_name }}</option>
                @endforeach
            </select>
            <select name="cat2_id" id="catid2" class="required">
                <option value="catid2">请选择</option>
            </select>
                <select name="cat3_id" id="catid3" class="required">
                    <option value="catid3">请选择</option>
                </select>
            </div>

            <div class=" clearfix cl">
                <label class="form-label col-2">商品品牌：</label>
                <select name="brand_id" id="" class="required">
                    <option value="">请选择</option>
                    @foreach($brand as $v)
                <option @if($v->id == $goods->brand_id) selected @endif value="{{ $v->id }}">{{ $v->brand_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class=" clearfix cl">
                    <h4>商品属性 <input class="btn btn-secondary btn-warning" id="btn-attr" type="button" value="添加一个属性"></h4>
                    <div id="attr-container">
                        @foreach($attr as $v)
                        <table width="100%">
                            <tr>
                                <td class="form-label col-2">属性名称:</td>
                                <td>
                                <input type='text' class="input-text" name='attr_name[]' value="{{ $v->attr_name }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="form-label col-2">属性值:</td>
                                <td>
                                <input type='text' class="input-text" name='attr_value[]' value="{{ $v->attr_value }}">
                                </td>
                            </tr>
                            <tr>
                                <td class=""></td>
                                <td>
                                    <input class="btn" onclick="del_attr(this)" type="button" value="删除">
                                </td>
                            </tr>
                        </table>
                        @endforeach
                    </div>
                </div>
                <br><br>
                <div class=" clearfix cl">
                    <h4>SKU <input id="btn-sku" class="btn btn-secondary btn-warning" type="button" value="添加一个sku"></h4>
                    <div id="sku-container">
                        @foreach($sku as $v)
                        <table width="100%">
                            <tr>
                                <td class="form-label col-2">SKU名称:</td>
                                <td>
                                    <input type='text' class="input-text" name='sku_name[]' value="{{ $v->sku_name }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="form-label col-2">库存量:</td>
                                <td>
                                    <input type='text' class="input-text" name='stock[]' value="{{ $v->stock }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="form-label col-2">价格:</td>
                                <td>
                                    ￥<input type='text' size="10" name='price[]' value="{{ $v->price }}"> 元
                                </td>
                            </tr>
                            <tr>
                                <td class=""></td>
                                <td>
                                    <input class="btn" onclick="del_attr(this)" type="button" value="删除">
                                </td>
                            </tr>
                        </table>
                        @endforeach
                    </div>
                </div>
                <br><br>
                <div class="clearfix cl">
                    <h4>商品图片 <input id="btn-image" class="btn btn-secondary btn-warning" type="button" value="添加一个图片"></h4>
                    <div id="image-container">
                        <table width="100%">
                            <tr>
                                <td class=""><input type="hidden" id="img_id" name="img_id"></td>
                                <td>
                                    @foreach ($image as $v)
                                    <img width="130" height="130" class="img_preview" src="/uploads/{{ $v->path }}" alt="">
                                    <input img_id="{{$v->id}}" class="preview" type='file' name='image[]'>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class=""></td>
                                <td>
                                    <input class="btn" onclick="del_attr(this)" type="button" value="删除">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
        
		<div class="clearfix cl">
			<div class="Button_operation">
				<button  class="btn btn-primary radius" type="submit"><i class="icon-save "></i>保存并提交审核</button>
				<button  class="btn btn-secondary  btn-warning" type="button"><i class="icon-save"></i>保存草稿</button>
				<button  class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
    </div>
</div>
</div>
<script src="/js/jquery-1.9.1.min.js"></script>   
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/typeahead-bs2.min.js"></script>
<script src="/assets/layer/layer.js" type="text/javascript" ></script>
<script src="/assets/laydate/laydate.js" type="text/javascript"></script>
<script type="text/javascript" src="/Widget/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/Widget/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/Widget/zTree/js/jquery.ztree.all-3.5.min.js"></script> 
<script type="text/javascript" src="/Widget/Validform/5.3.2/Validform.min.js"></script> 
<script type="text/javascript" src="/Widget/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/Widget/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/Widget/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/Widget/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script> 
<script src="/js/lrtk.js" type="text/javascript" ></script>
<script type="text/javascript" src="/js/H-ui.js"></script> 
<script type="text/javascript" src="/js/H-ui.admin.js"></script> 
<script>
$(function() { 
	$("#add_picture").fix({
		float : 'left',
		skin : 'green',	
		durationTime :false,
		stylewidth:'220',
		spacingw:0,
		spacingh:260,
	});
});
$( document).ready(function(){
//初始化宽度、高度
  
   $(".widget-box").height($(window).height()); 
   $(".page_right_style").height($(window).height()); 
   $(".page_right_style").width($(window).width()-220); 
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){

	 $(".widget-box").height($(window).height()); 
	 $(".page_right_style").height($(window).height()); 
	 $(".page_right_style").width($(window).width()-220); 
	});	
});
$(function(){
	var ue = UE.getEditor('editor');
});
/******树状图********/
var setting = {
	view: {
		dblClickExpand: false,
		showLine: false,
		selectedMulti: false
	},
	data: {
		simpleData: {
			enable:true,
			idKey: "id",
			pIdKey: "pId",
			rootPId: ""
		}
	},
	callback: {
		beforeClick: function(treeId, treeNode) {
			var zTree = $.fn.zTree.getZTreeObj("tree");
			if (treeNode.isParent) {
				zTree.expandNode(treeNode);
				return false;
			} else {
				demoIframe.attr("src",treeNode.file + ".html");
				return true;
			}
		}
	}
};

var zNodes =[
	{ id:1, pId:0, name:"商城分类列表", open:true},
	{ id:11, pId:1, name:"蔬菜水果"},
	{ id:111, pId:11, name:"蔬菜"},
	{ id:112, pId:11, name:"苹果"},
	{ id:113, pId:11, name:"大蒜"},
	{ id:114, pId:11, name:"白菜"},
	{ id:115, pId:11, name:"青菜"},
	{ id:12, pId:1, name:"手机数码"},
	{ id:121, pId:12, name:"手机 "},
	{ id:122, pId:12, name:"照相机 "},
	{ id:13, pId:1, name:"电脑配件"},
	{ id:131, pId:13, name:"手机 "},
	{ id:122, pId:13, name:"照相机 "},
	{ id:14, pId:1, name:"服装鞋帽"},
	{ id:141, pId:14, name:"手机 "},
	{ id:42, pId:14, name:"照相机 "},
];
		
var code;
		
function showCode(str) {
	if (!code) code = $("#code");
	code.empty();
	code.append("<li>"+str+"</li>");
}
$(document).ready(function(){
	var t = $("#treeDemo");
	t = $.fn.zTree.init(t, setting, zNodes);
	demoIframe = $("#testIframe");
	//demoIframe.bind("load", loadReady);
	var zTree = $.fn.zTree.getZTreeObj("tree");
	//zTree.selectNode(zTree.getNodeByParam("id",'11'));
});			
</script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$list = $("#fileList"),
	$btn = $("#btn-star"),
	state = "pending",
	uploader;

	var uploader = WebUploader.create({
		auto: true,
		swf: 'lib/webuploader/0.1.5/Uploader.swf',
	
		// 文件接收服务端。
		server: 'http://lib.h-ui.net/webuploader/0.1.5/server/fileupload.php',
	
		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		pick: '#filePicker',
	
		// 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
		resize: false,
		// 只允许选择图片文件。
		accept: {
			title: 'Images',
			extensions: 'gif,jpg,jpeg,bmp,png',
			mimeTypes: 'image/*'
		}
	});
	uploader.on( 'fileQueued', function( file ) {
		var $li = $(
			'<div id="' + file.id + '" class="item">' +
				'<div class="pic-box"><img></div>'+
				'<div class="info">' + file.name + '</div>' +
				'<p class="state">等待上传...</p>'+
			'</div>'
		),
		$img = $li.find('img');
		$list.append( $li );
	
		// 创建缩略图
		// 如果为非图片文件，可以不用调用此方法。
		// thumbnailWidth x thumbnailHeight 为 100 x 100
		uploader.makeThumb( file, function( error, src ) {
			if ( error ) {
				$img.replaceWith('<span>不能预览</span>');
				return;
			}
	
			$img.attr( 'src', src );
		}, thumbnailWidth, thumbnailHeight );
	});
	// 文件上传过程中创建进度条实时显示。
	uploader.on( 'uploadProgress', function( file, percentage ) {
		var $li = $( '#'+file.id ),
			$percent = $li.find('.progress-box .sr-only');
	
		// 避免重复创建
		if ( !$percent.length ) {
			$percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo( $li ).find('.sr-only');
		}
		$li.find(".state").text("上传中");
		$percent.css( 'width', percentage * 100 + '%' );
	});
	
	// 文件上传成功，给item添加成功class, 用样式标记上传成功。
	uploader.on( 'uploadSuccess', function( file ) {
		$( '#'+file.id ).addClass('upload-state-success').find(".state").text("已上传");
	});
	
	// 文件上传失败，显示上传出错。
	uploader.on( 'uploadError', function( file ) {
		$( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
	});
	
	// 完成上传完了，成功或者失败，先删除进度条。
	uploader.on( 'uploadComplete', function( file ) {
		$( '#'+file.id ).find('.progress-box').fadeOut();
	});
	uploader.on('all', function (type) {
        if (type === 'startUpload') {
            state = 'uploading';
        } else if (type === 'stopUpload') {
            state = 'paused';
        } else if (type === 'uploadFinished') {
            state = 'done';
        }

        if (state === 'uploading') {
            $btn.text('暂停上传');
        } else {
            $btn.text('开始上传');
        }
    });

    $btn.on('click', function () {
        if (state === 'uploading') {
            uploader.stop();
        } else {
            uploader.upload();
        }
    });

});

(function( $ ){
    // 当domReady的时候开始初始化
    $(function() {
        var $wrap = $('.uploader-list-container'),

            // 图片容器
            $queue = $( '<ul class="filelist"></ul>' )
                .appendTo( $wrap.find( '.queueList' ) ),

            // 状态栏，包括进度和控制按钮
            $statusBar = $wrap.find( '.statusBar' ),

            // 文件总体选择信息。
            $info = $statusBar.find( '.info' ),

            // 上传按钮
            $upload = $wrap.find( '.uploadBtn' ),

            // 没选择文件之前的内容。
            $placeHolder = $wrap.find( '.placeholder' ),

            $progress = $statusBar.find( '.progress' ).hide(),

            // 添加的文件数量
            fileCount = 0,

            // 添加的文件总大小
            fileSize = 0,

            // 优化retina, 在retina下这个值是2
            ratio = window.devicePixelRatio || 1,

            // 缩略图大小
            thumbnailWidth = 110 * ratio,
            thumbnailHeight = 110 * ratio,

            // 可能有pedding, ready, uploading, confirm, done.
            state = 'pedding',

            // 所有文件的进度信息，key为file id
            percentages = {},
            // 判断浏览器是否支持图片的base64
            isSupportBase64 = ( function() {
                var data = new Image();
                var support = true;
                data.onload = data.onerror = function() {
                    if( this.width != 1 || this.height != 1 ) {
                        support = false;
                    }
                }
                data.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
                return support;
            } )(),

            // 检测是否已经安装flash，检测flash的版本
            flashVersion = ( function() {
                var version;

                try {
                    version = navigator.plugins[ 'Shockwave Flash' ];
                    version = version.description;
                } catch ( ex ) {
                    try {
                        version = new ActiveXObject('ShockwaveFlash.ShockwaveFlash')
                                .GetVariable('$version');
                    } catch ( ex2 ) {
                        version = '0.0';
                    }
                }
                version = version.match( /\d+/g );
                return parseFloat( version[ 0 ] + '.' + version[ 1 ], 10 );
            } )(),

            supportTransition = (function(){
                var s = document.createElement('p').style,
                    r = 'transition' in s ||
                            'WebkitTransition' in s ||
                            'MozTransition' in s ||
                            'msTransition' in s ||
                            'OTransition' in s;
                s = null;
                return r;
            })(),

            // WebUploader实例
            uploader;

        if ( !WebUploader.Uploader.support('flash') && WebUploader.browser.ie ) {

            // flash 安装了但是版本过低。
            if (flashVersion) {
                (function(container) {
                    window['expressinstallcallback'] = function( state ) {
                        switch(state) {
                            case 'Download.Cancelled':
                                alert('您取消了更新！')
                                break;

                            case 'Download.Failed':
                                alert('安装失败')
                                break;

                            default:
                                alert('安装已成功，请刷新！');
                                break;
                        }
                        delete window['expressinstallcallback'];
                    };

                    var swf = 'expressInstall.swf';
                    // insert flash object
                    var html = '<object type="application/' +
                            'x-shockwave-flash" data="' +  swf + '" ';

                    if (WebUploader.browser.ie) {
                        html += 'classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ';
                    }

                    html += 'width="100%" height="100%" style="outline:0">'  +
                        '<param name="movie" value="' + swf + '" />' +
                        '<param name="wmode" value="transparent" />' +
                        '<param name="allowscriptaccess" value="always" />' +
                    '</object>';

                    container.html(html);

                })($wrap);

            // 压根就没有安转。
            } else {
                $wrap.html('<a href="http://www.adobe.com/go/getflashplayer" target="_blank" border="0"><img alt="get flash player" src="http://www.adobe.com/macromedia/style_guide/images/160x41_Get_Flash_Player.jpg" /></a>');
            }

            return;
        } else if (!WebUploader.Uploader.support()) {
            alert( 'Web Uploader 不支持您的浏览器！');
            return;
        }

        // 实例化
        uploader = WebUploader.create({
            pick: {
                id: '#filePicker-2',
                label: '点击选择图片'
            },
            formData: {
                uid: 123
            },
            dnd: '#dndArea',
            paste: '#uploader',
            swf: 'lib/webuploader/0.1.5/Uploader.swf',
            chunked: false,
            chunkSize: 512 * 1024,
            server: 'http://lib.h-ui.net/webuploader/0.1.5/server/fileupload.php',
            // runtimeOrder: 'flash',

            // accept: {
            //     title: 'Images',
            //     extensions: 'gif,jpg,jpeg,bmp,png',
            //     mimeTypes: 'image/*'
            // },

            // 禁掉全局的拖拽功能。这样不会出现图片拖进页面的时候，把图片打开。
            disableGlobalDnd: true,
            fileNumLimit: 300,
            fileSizeLimit: 200 * 1024 * 1024,    // 200 M
            fileSingleSizeLimit: 50 * 1024 * 1024    // 50 M
        });

        // 拖拽时不接受 js, txt 文件。
        uploader.on( 'dndAccept', function( items ) {
            var denied = false,
                len = items.length,
                i = 0,
                // 修改js类型
                unAllowed = 'text/plain;application/javascript ';

            for ( ; i < len; i++ ) {
                // 如果在列表里面
                if ( ~unAllowed.indexOf( items[ i ].type ) ) {
                    denied = true;
                    break;
                }
            }

            return !denied;
        });

        uploader.on('dialogOpen', function() {
            console.log('here');
        });

        // uploader.on('filesQueued', function() {
        //     uploader.sort(function( a, b ) {
        //         if ( a.name < b.name )
        //           return -1;
        //         if ( a.name > b.name )
        //           return 1;
        //         return 0;
        //     });
        // });

        // 添加“添加文件”的按钮，
        uploader.addButton({
            id: '#filePicker2',
            label: '继续添加'
        });

        uploader.on('ready', function() {
            window.uploader = uploader;
        });

        // 当有文件添加进来时执行，负责view的创建
        function addFile( file ) {
            var $li = $( '<li id="' + file.id + '">' +
                    '<p class="title">' + file.name + '</p>' +
                    '<p class="imgWrap"></p>'+
                    '<p class="progress"><span></span></p>' +
                    '</li>' ),

                $btns = $('<div class="file-panel">' +
                    '<span class="cancel">删除</span>' +
                    '<span class="rotateRight">向右旋转</span>' +
                    '<span class="rotateLeft">向左旋转</span></div>').appendTo( $li ),
                $prgress = $li.find('p.progress span'),
                $wrap = $li.find( 'p.imgWrap' ),
                $info = $('<p class="error"></p>'),

                showError = function( code ) {
                    switch( code ) {
                        case 'exceed_size':
                            text = '文件大小超出';
                            break;

                        case 'interrupt':
                            text = '上传暂停';
                            break;

                        default:
                            text = '上传失败，请重试';
                            break;
                    }

                    $info.text( text ).appendTo( $li );
                };

            if ( file.getStatus() === 'invalid' ) {
                showError( file.statusText );
            } else {
                // @todo lazyload
                $wrap.text( '预览中' );
                uploader.makeThumb( file, function( error, src ) {
                    var img;

                    if ( error ) {
                        $wrap.text( '不能预览' );
                        return;
                    }

                    if( isSupportBase64 ) {
                        img = $('<img src="'+src+'">');
                        $wrap.empty().append( img );
                    } else {
                        $.ajax('lib/webuploader/0.1.5/server/preview.php', {
                            method: 'POST',
                            data: src,
                            dataType:'json'
                        }).done(function( response ) {
                            if (response.result) {
                                img = $('<img src="'+response.result+'">');
                                $wrap.empty().append( img );
                            } else {
                                $wrap.text("预览出错");
                            }
                        });
                    }
                }, thumbnailWidth, thumbnailHeight );

                percentages[ file.id ] = [ file.size, 0 ];
                file.rotation = 0;
            }

            file.on('statuschange', function( cur, prev ) {
                if ( prev === 'progress' ) {
                    $prgress.hide().width(0);
                } else if ( prev === 'queued' ) {
                    $li.off( 'mouseenter mouseleave' );
                    $btns.remove();
                }

                // 成功
                if ( cur === 'error' || cur === 'invalid' ) {
                    console.log( file.statusText );
                    showError( file.statusText );
                    percentages[ file.id ][ 1 ] = 1;
                } else if ( cur === 'interrupt' ) {
                    showError( 'interrupt' );
                } else if ( cur === 'queued' ) {
                    percentages[ file.id ][ 1 ] = 0;
                } else if ( cur === 'progress' ) {
                    $info.remove();
                    $prgress.css('display', 'block');
                } else if ( cur === 'complete' ) {
                    $li.append( '<span class="success"></span>' );
                }

                $li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
            });

            $li.on( 'mouseenter', function() {
                $btns.stop().animate({height: 30});
            });

            $li.on( 'mouseleave', function() {
                $btns.stop().animate({height: 0});
            });

            $btns.on( 'click', 'span', function() {
                var index = $(this).index(),
                    deg;

                switch ( index ) {
                    case 0:
                        uploader.removeFile( file );
                        return;

                    case 1:
                        file.rotation += 90;
                        break;

                    case 2:
                        file.rotation -= 90;
                        break;
                }

                if ( supportTransition ) {
                    deg = 'rotate(' + file.rotation + 'deg)';
                    $wrap.css({
                        '-webkit-transform': deg,
                        '-mos-transform': deg,
                        '-o-transform': deg,
                        'transform': deg
                    });
                } else {
                    $wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');
                    // use jquery animate to rotation
                    // $({
                    //     rotation: rotation
                    // }).animate({
                    //     rotation: file.rotation
                    // }, {
                    //     easing: 'linear',
                    //     step: function( now ) {
                    //         now = now * Math.PI / 180;

                    //         var cos = Math.cos( now ),
                    //             sin = Math.sin( now );

                    //         $wrap.css( 'filter', "progid:DXImageTransform.Microsoft.Matrix(M11=" + cos + ",M12=" + (-sin) + ",M21=" + sin + ",M22=" + cos + ",SizingMethod='auto expand')");
                    //     }
                    // });
                }


            });

            $li.appendTo( $queue );
        }

        // 负责view的销毁
        function removeFile( file ) {
            var $li = $('#'+file.id);

            delete percentages[ file.id ];
            updateTotalProgress();
            $li.off().find('.file-panel').off().end().remove();
        }

        function updateTotalProgress() {
            var loaded = 0,
                total = 0,
                spans = $progress.children(),
                percent;

            $.each( percentages, function( k, v ) {
                total += v[ 0 ];
                loaded += v[ 0 ] * v[ 1 ];
            } );

            percent = total ? loaded / total : 0;


            spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
            spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
            updateStatus();
        }

        function updateStatus() {
            var text = '', stats;

            if ( state === 'ready' ) {
                text = '选中' + fileCount + '张图片，共' +
                        WebUploader.formatSize( fileSize ) + '。';
            } else if ( state === 'confirm' ) {
                stats = uploader.getStats();
                if ( stats.uploadFailNum ) {
                    text = '已成功上传' + stats.successNum+ '张照片至XX相册，'+
                        stats.uploadFailNum + '张照片上传失败，<a class="retry" href="#">重新上传</a>失败图片或<a class="ignore" href="#">忽略</a>'
                }

            } else {
                stats = uploader.getStats();
                text = '共' + fileCount + '张（' +
                        WebUploader.formatSize( fileSize )  +
                        '），已上传' + stats.successNum + '张';

                if ( stats.uploadFailNum ) {
                    text += '，失败' + stats.uploadFailNum + '张';
                }
            }

            $info.html( text );
        }

        function setState( val ) {
            var file, stats;

            if ( val === state ) {
                return;
            }

            $upload.removeClass( 'state-' + state );
            $upload.addClass( 'state-' + val );
            state = val;

            switch ( state ) {
                case 'pedding':
                    $placeHolder.removeClass( 'element-invisible' );
                    $queue.hide();
                    $statusBar.addClass( 'element-invisible' );
                    uploader.refresh();
                    break;

                case 'ready':
                    $placeHolder.addClass( 'element-invisible' );
                    $( '#filePicker2' ).removeClass( 'element-invisible');
                    $queue.show();
                    $statusBar.removeClass('element-invisible');
                    uploader.refresh();
                    break;

                case 'uploading':
                    $( '#filePicker2' ).addClass( 'element-invisible' );
                    $progress.show();
                    $upload.text( '暂停上传' );
                    break;

                case 'paused':
                    $progress.show();
                    $upload.text( '继续上传' );
                    break;

                case 'confirm':
                    $progress.hide();
                    $( '#filePicker2' ).removeClass( 'element-invisible' );
                    $upload.text( '开始上传' );

                    stats = uploader.getStats();
                    if ( stats.successNum && !stats.uploadFailNum ) {
                        setState( 'finish' );
                        return;
                    }
                    break;
                case 'finish':
                    stats = uploader.getStats();
                    if ( stats.successNum ) {
                        alert( '上传成功' );
                    } else {
                        // 没有成功的图片，重设
                        state = 'done';
                        location.reload();
                    }
                    break;
            }

            updateStatus();
        }

        uploader.onUploadProgress = function( file, percentage ) {
            var $li = $('#'+file.id),
                $percent = $li.find('.progress span');

            $percent.css( 'width', percentage * 100 + '%' );
            percentages[ file.id ][ 1 ] = percentage;
            updateTotalProgress();
        };

        uploader.onFileQueued = function( file ) {
            fileCount++;
            fileSize += file.size;

            if ( fileCount === 1 ) {
                $placeHolder.addClass( 'element-invisible' );
                $statusBar.show();
            }

            addFile( file );
            setState( 'ready' );
            updateTotalProgress();
        };

        uploader.onFileDequeued = function( file ) {
            fileCount--;
            fileSize -= file.size;

            if ( !fileCount ) {
                setState( 'pedding' );
            }

            removeFile( file );
            updateTotalProgress();

        };

        uploader.on( 'all', function( type ) {
            var stats;
            switch( type ) {
                case 'uploadFinished':
                    setState( 'confirm' );
                    break;

                case 'startUpload':
                    setState( 'uploading' );
                    break;

                case 'stopUpload':
                    setState( 'paused' );
                    break;

            }
        });

        uploader.onError = function( code ) {
            alert( 'Eroor: ' + code );
        };

        $upload.on('click', function() {
            if ( $(this).hasClass( 'disabled' ) ) {
                return false;
            }

            if ( state === 'ready' ) {
                uploader.upload();
            } else if ( state === 'paused' ) {
                uploader.upload();
            } else if ( state === 'uploading' ) {
                uploader.stop();
            }
        });

        $info.on( 'click', '.retry', function() {
            uploader.retry();
        } );

        $info.on( 'click', '.ignore', function() {
            alert( 'todo' );
        } );

        $upload.addClass( 'state-' + state );
        updateTotalProgress();
    });

})( jQuery );

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
    var old_id = $(this).attr('img_id')
    var old_val = $("#img_id").val()
    if(old_val=='')
    {
        old_val = old_id
        $("#img_id").val(old_val)
    }
    else
    {
        old_val += ','+old_id
        $("#img_id").val(old_val)

    }
    // 获取选择的图片
    var file = this.files[0];
    // 转成字符串
    var str = getObjectUrl(file);
    // 先删除上一个
    $(this).prev('.img_preview').remove();
    // 在框的前面放一个图片
    $(this).before("<div class='img_preview'><img src='"+str+"' width='120' height='120'></div>");
});


//商品分类选项
$("#catid").change(function () {
        var id = $(this).val()
        if (id != '') {
            $.ajax({
                type: 'GET',
                url: "{{ route('ajax_getParent') }}",
                data:{id:id},
                dataType: 'json',
                success: function (data) {
                    var str = ''
                    for (var i = 0; i < data.length; i++) {
                        if("{{$goods->cat2_id}}"==data[i]['id'])
                        {
                            str += "<option selected  value='" + data[i]['id'] + "'>" + data[i]['cat_name'] + "</option>"
                        }
                        else
                        {
                            str += "<option  value='" + data[i]['id'] + "'>" + data[i]['cat_name'] + "</option>"
                        }
                    }
                    $("#catid2").html(str)
                    $("#catid2").trigger('change')
                }
            })
        }
    })
    $("#catid2").change(function () {
        var id = $(this).val()
        if (id != '') {
            $.ajax({
                type: 'GET',
                url: "{{ route('ajax_getParent') }}",
                data:{id:id},
                dataType: 'json',
                success: function (data) {
                    var str = ''
                    for (var i = 0; i < data.length; i++) {
                        str += "<option value='" + data[i]['id'] + "'>" + data[i]['cat_name'] + "</option>"
                    }
                    $("#catid3").html(str)
                }
            })
        }
    });
    $("#catid").trigger('change')

    //添加属性
    var attrStr = `<hr><table width="100%">
                        <tr>
                            <td class="form-label col-2">属性名称:</td>
                            <td>
                                <input type='text' class="input-text" name='attr_name[]'>
                            </td>
                        </tr>
                        <tr>
                            <td class="form-label col-2">属性值:</td>
                            <td>
                                <input type='text' class="input-text" name='attr_value[]'>
                            </td>
                        </tr>
                        <tr>
                            <td class=""></td>
                            <td>
                                <input class="btn" onclick="del_attr(this)" type="button" value="删除">
                            </td>
                        </tr>
                    </table>`
    
    $("#btn-attr").click(function(){
        $("#attr-container").append(attrStr)
    });

    function del_attr(o)
    {
        if(confirm("确定要删除吗？"))
        {
            var table = $(o).parent().parent().parent().parent()
            table.prev('hr').remove()
            table.remove()
        }
        
    }

//添加SKU
    var skuStr = `<hr><table width="100%">
                        <tr>
                            <td class="form-label col-2">SKU名称:</td>
                            <td>
                                <input type='text' class="input-text" name='sku_name[]'>
                            </td>
                        </tr>
                        <tr>
                            <td class="form-label col-2">库存量:</td>
                            <td>
                                <input type='text' class="input-text" name='stock[]'>
                            </td>
                        </tr>
                        <tr>
                            <td class="form-label col-2">价格:</td>
                            <td>
                                ￥<input type='text' size="10" name='price[]'> 元
                            </td>
                        </tr>
                        <tr>
                            <td class=""></td>
                            <td>
                                <input class="btn" onclick="del_attr(this)" type="button" value="删除">
                            </td>
                        </tr>
                    </table>`

 $("#btn-sku").click(function(){
        $("#sku-container").append(skuStr)
    });

    function del_attr(o)
    {
        if(confirm("确定要删除吗？"))
        {
            var table = $(o).parent().parent().parent().parent()
            table.prev('hr').remove()
            table.remove()
        }
        
    }

    var imageStr = `<hr><table width="100%">
                        <tr>
                            <td class=""></td>
                            <td>
                                <input class="preview" type='file' name='image[]'>
                            </td>
                        </tr>
                        <tr>
                            <td class=""></td>
                            <td>
                                <input class="btn" onclick="del_attr(this)" type="button" value="删除">
                            </td>
                        </tr>
                    </table>`

$("#btn-image").click(function(){

// 添加一个图片
$("#image-container").append(imageStr)


// 绑定预览事件
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
});
</script>
</body>
</html>