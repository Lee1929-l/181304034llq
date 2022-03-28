var isTouch = Modernizr.touchevents,
	isMobile = false,
	mobile= false,
	win_width = 0,
	win_height = 0,
	navItem = 0,
	serachItem=0,
	scrollH=0,
	atH=50,
	danNum=0,
	pageNH=50,
	$menuBtn=jQuery('.menu-handler'),
	$menuBox=jQuery(".menuBox"),
	$menuMobile=jQuery("#navMobile"),
	$serachToggle=jQuery(".serach-icon"),
	$serachBox=jQuery(".box-Serach");
var pageInit = {
		init: function () {
	        win_width = $(window).width();
			win_height = $(window).height();
			menuboxW = win_width -atH;
			if (win_width <= 1024) {
		        isMobile = true;
		    } else if (win_width > 1024) {
		        isMobile = false;
		    	danNum=0;
				jQuery(".footList .t").unbind("click");
				jQuery(".cpnav").unbind("click");
		        jQuery(".cpnav").next(".cpnavbox").stop(false,false).fadeIn();
		    };
		    if(jQuery(".pagenav").length>=1){
				pageNH=jQuery(".pagenav").height();
			}
			if (win_width <= 640) {
		        mobile = true;
				menuboxW = win_width -atH;
		        $menuBox.width(menuboxW);
		    } else if (win_width > 640) {
		        mobile = false;
		    };
	   },
	   setImgMax: function(img, imgW, imgH, tW, tH) {
	   		var tWidth = tW || win_width;
		    var tHeight = tH || win_height;
		    var coe = imgH / imgW;
		    var coe2 = tHeight / tWidth;
		    if (coe < coe2) {
		        var imgWidth = tHeight / coe;
		        img.css({ height: tHeight, width: imgWidth, left: -(imgWidth - tWidth) / 2, top: 0 });
		    } else {
		        var imgHeight = tWidth * coe;
		        img.css({ height: imgHeight, width: tWidth, left: 0, top: -(imgHeight - tHeight) / 2 });
		    };
	   	}
	},
	nav={
		init:function(){
			 jQuery("#nav li").hover(function () {
		        if (jQuery(this).find(".subnav").length > 0) {
		            $(this).children("a").addClass("hov");
		            $(this).children(".subnav").stop(false, false).animate({top:50,"opacity":"show"},300);
		        };
		    }, function () {
		        $(this).children("a").removeClass("hov");
		        $(this).children(".subnav").stop(false, false).fadeOut(250,function(){jQuery(this).css("top","0");})
		    });
		}
	},
   	menu = {
		init: function(){
			$menuBtn.bind("click", function () {
				$serachToggle.removeClass("active");
	            $serachBox.removeClass("open-box");
	            serachItem = 0;
		        if (navItem == 0 && !mobile) {
		            jQuery(this).addClass("active");
		            $menuBox.width(570);
		            $menuBox.css({ "transform": "translate(0px,0px)" ,"-webkit-transform": "translate(0px,0px)" });
		            jQuery(".pusher").css({ "transform": "translate(-570px,0px)" ,"-webkit-transform": "translate(-570px,0px)" });
		            jQuery(".top").css({ "transform": "translate(-570px,0px)" ,"-webkit-transform": "translate(-570px,0px)" });
		            jQuery("html").addClass("menuOpen");
		            navItem = 1;
		        } else if (navItem == 1 && !mobile) {
		            jQuery(this).removeClass("active");
		            jQuery("html").removeClass("menuOpen");
		            $menuBox.css({ "transform": "translate(570px,0px)" ,"-webkit-transform": "translate(570px,0px)" });
		            jQuery(".pusher").css({ "transform": "translate(0px,0px)" ,"-webkit-transform": "translate(0px,0px)" });
		            jQuery(".top").css({ "transform": "translate(0px,0px)" ,"-webkit-transform": "translate(0px,0px)" });
		            navItem = 0;
		        } else if (navItem == 0 && mobile) {
		            jQuery(this).addClass("active");
		            $menuBox.width(menuboxW);
		            jQuery("html").addClass("menuOpen");
		            $menuBox.css({ "transform": "translate(0px,0px)" ,"-webkit-transform": "translate(0px,0px)" });
		            jQuery(".pusher").css({ "transform": "translate(-" + menuboxW + "px,0px)" ,"-webkit-transform": "translate(-" + menuboxW + "px,0px)" });
		            jQuery(".top").css({ "transform": "translate(-" + menuboxW + "px,0px)" ,"-webkit-transform": "translate(-" + menuboxW + "px,0px)"});
		            navItem = 1;
		        } else if (navItem == 1 && mobile) {
		            jQuery(this).removeClass("active");
		            jQuery("html").removeClass("menuOpen");
		            $menuBox.css({ "transform": "translate(" + menuboxW + "px,0px)" ,"-webkit-transform": "translate(" + menuboxW + "px,0px)" });
		            jQuery(".pusher").css({ "transform": "translate(0px,0px)" ,"-webkit-transform": "translate(0px,0px)" });
		            jQuery(".top").css({ "transform": "translate(0px,0px)" ,"-webkit-transform": "translate(0px,0px)" });
		            navItem = 0;
		        };
		    });
		    jQuery(".pusher-black").bind("click", function () {
		        if (navItem == 1 && !mobile) {
		            $menuBtn.removeClass("active");
		            jQuery("html").removeClass("menuOpen");
		            $menuBox.css({ "transform": "translate(570px,0px)" ,"-webkit-transform": "translate(570px,0px)" });
		            jQuery(".pusher").css({ "transform": "translate(0px,0px)" ,"-webkit-transform": "translate(0px,0px)" });
		            jQuery(".top").css({ "transform": "translate(0px,0px)" ,"-webkit-transform": "translate(0px,0px)" });
		            navItem = 0;
		        } else if (navItem == 1 && mobile) {
		            $menuBtn.removeClass("active");
		            jQuery("html").removeClass("menuOpen");
		            $menuBox.css({ "transform": "translate(" + menuboxW + "px,0px)" ,"-webkit-transform": "translate(" + menuboxW + "px,0px)" });
		            jQuery(".pusher").css({ "transform": "translate(0px,0px)" ,"-webkit-transform": "translate(0px,0px)" });
		            jQuery(".top").css({ "transform": "translate(0px,0px)" ,"-webkit-transform": "translate(0px,0px)" });
		            navItem = 0;
		        };
		    });
		     $(document).on("click", ".navMobile .nav-link", function (e) {
	            var mnavcur = $(this);
	            var mnavbox = $(this).parents("li");
	            if (mnavbox.find(".subnav").size() > 0) {
	                if (mnavbox.hasClass("active")) {
	                    mnavbox.find(".subnav").stop(false, false).slideUp();
	                    mnavbox.removeClass("active");
	                } else {
	                    jQuery(".navMobile li").removeClass("active");
	                    jQuery(".subnav").stop(false, false).slideUp();
	                    mnavbox.find(".subnav").stop(false, false).slideDown();
	                    mnavbox.addClass("active");
	                    e.preventDefault();
	                }
	            }
	        });
		}
	},
	serachBox={
		init:function(){
			$serachToggle.bind("click", function () {
		        if (serachItem == 0) {
		            jQuery(this).addClass("active");
		            $serachBox.addClass("open-box");
		            serachItem = 1;
		        }else{
		        	jQuery(this).removeClass("active");
		            $serachBox.removeClass("open-box");
		            serachItem = 0;
		        }
		    });
		}
	},
	userLoginBox={
		init:function(){
			jQuery(".login-toggle,.signin-toggle").hide();
			jQuery(".user-toggle,.usernews-toggle").show();
		}
	},
	noLoginBox={
		init:function(){
			jQuery(".login-toggle,.signin-toggle").show();
			jQuery(".user-toggle,.usernews-toggle").hide();
		}
	},
	dock={
		init: function(){
			var dock=0;
		    jQuery(".dockCon li").mouseenter(function(){
		    	jQuery(this).find(".con").stop(false,false).animate({right:62,"opacity":"show"},300);
		    }).mouseleave(function(){
		    	jQuery(this).find(".con").stop(false,false).animate({right:0,"opacity":"hide"},300);
		    });
		}
	};
jQuery(window).resize(function () {
    pageInit.init();
});
function getHash() {
	var hash = location.href.split("#")[1];
	if (hash) {
	    jQuery("html,body").delay(300).animate({ scrollTop: jQuery("#" + hash).offset().top - atH }, 0);
	}
};
function setScroll(anchorCur) {
    jQuery("html,body").delay(300).animate({ scrollTop: jQuery(anchorCur).offset().top - atH }, 800, 'easeInOutExpo');
};
load();
window.onload = function () {
	if(jQuery(".pagenav").length>=1){
		scrollH=jQuery(".pagenav").offset().top-atH;
	}
}
jQuery(window).resize(function () {
    pageInit.init();
    pageBanner();
});

function pageBanner() {
	if(!isMobile){
    	jQuery('.pBanner').css("height",jQuery(".pBanner img.vt").height());
    }else{
    	jQuery('.pBanner').css("height","auto");
    }
};
function load() {
    var maxNum = $(".pBanner img.vt").size();
    var curNum = 0;
    jQuery(".pBanner img.vt").each(function () {
        $(this).attr("src", $(this).attr("_src"));
        jQuery(this).load(function () {
            curNum++;
            if (curNum == maxNum) {
                pageBanner();
				if(jQuery(".pagenav").length>=1){
					scrollH=jQuery(".pagenav").offset().top-atH;
				}
            }
        });
    });
};
$(document).ready(function() {
    pageInit.init();
    nav.init();
    menu.init();
    serachBox.init();
    dock.init();
	jQuery(".ermico").click(function () {
		jQuery(".ermblack").fadeIn();
		jQuery(".ermBox .close").click(function () {
			jQuery(".ermblack").remove();
		});
		jQuery(".ermblack").click(function () { jQuery(".ermblack").hide(); });
		return false;
	});
	jQuery(".cpnav").bind("click",function(){
		if(danNum==0){
			jQuery(this).next(".cpnavbox").stop(false,false).fadeIn();
			danNum=1;
		}else{
			jQuery(this).next(".cpnavbox").stop(false,false).fadeOut();
			danNum=0;
		}
	});
    jQuery(".backTop").bind("click", function() { 
    	jQuery(this).addClass("enterBack");
		jQuery('html, body').stop().animate({scrollTop: 0}, 800,'easeInOutExpo',function(){
			jQuery(".backTop").removeClass("enterBack");
		});
	});
    jQuery(".box-slist .liradio").click(function () {
        jQuery(".box-slist .liradio").removeClass("active");
		jQuery(this).addClass("active");
	});

	jQuery(".ssxianlu .sradio").click(function () {
	    jQuery(".ssxianlu .sradio").removeClass("active");
	    jQuery(this).addClass("active");
	});

	jQuery(".serach-slider").click(function(){
		jQuery(".slider-search").animate({top:0,"opacity":"show"},600);
	});
	jQuery(".btnclosess").click(function(){
		jQuery(".slider-search").animate({top:"-100%","opacity":"hide"},600);
	});
    jQuery(window).scroll(function () {
		var windowTop=jQuery(window).scrollTop();
		if(windowTop>0){
			jQuery(".top").addClass("topScroll");
		}else{
			jQuery(".top").removeClass("topScroll");
		};
		if(windowTop>0){
			jQuery(".backTop").stop(false,false).animate({bottom:"5%"},300);
		}else{
			jQuery(".backTop").stop(false,false).delay(300).animate({bottom:"-60px"},800);
		};
        if (windowTop < win_height  && !isMobile) {
            jQuery('.pBanner .img').css('transform',"translate(0px,"+(windowTop) / 1.5+"px)");
        }
         if(windowTop>scrollH){
			jQuery(".pagenav").addClass("fixed");
		}else if(windowTop<scrollH){
			jQuery(".pagenav").removeClass("fixed");
		};
	});
//	var $pBanner=jQuery(".pBanner");
//  if($pBanner.length>=1){
//	    setTimeout(function() {
//	      $pBanner.addClass('trans-1');
//	      $pBanner.removeClass('picw');
//	    }, 100);
//	    setTimeout(function() {
//	      $pBanner.removeClass('trans-1');
//	    }, 600);
//  };
    jQuery(".footList p.t").bind("click",function(){
		jQuery(this).next(".c").slideToggle();
		jQuery(this).toggleClass("active");
	});
	var sliderdt=jQuery(".pageDbox-dt"),
	    sliderdd=jQuery(".pageDbox-dc");
	 	sliderdt.click(function () {
        var classname=$(this).parent().attr("class");
        if(classname=="pageDbox-dl active"){
            jQuery(this).parent().removeClass("active");
            jQuery(this).next(".pageDbox-dc").stop(false,false).slideUp("normal"); 
        }else{
            sliderdt.parent().removeClass("active");
            jQuery(this).parent().addClass("active");
            sliderdd.slideUp("normal");
            jQuery(this).next(".pageDbox-dc").stop(false,false).slideDown("normal"); 
        }
    });
    if(jQuery(".toolBox .user-toggle").length>=1){
		jQuery(".toolBox .user-toggle").mouseenter(function(){
			jQuery(this).children(".user-nav").stop(false,false).fadeIn();
		}).mouseleave(function(){
			jQuery(this).children(".user-nav").stop(false,false).fadeOut();
		});
    };

    jQuery(document).on('mouseenter', '.xzy-share-btn2', function () {
        if (jQuery(".xzy-share-box").length > 0) { jQuery(".xzy-share-box").remove() };
        var optL = jQuery(this).offset().left;
        var optT = jQuery(this).offset().top + jQuery(this).outerHeight();
        var sharpWeixin = jQuery(this).attr("sharpWeixin");
        var shareTsina = jQuery(this).attr("shareTsina");
        var outW = jQuery(this).outerWidth();
        jQuery("body").append('<div class="xzy-share-box"><span class="zwbox"></span><a class="tsina" target="_blank" href="' + shareTsina + '"><i class="ico"></i>分享到微博</a><a  target="_blank" href="' + sharpWeixin + '" class="weixin"><i class="ico"></i>分享到微信</a></div>');
        if (outW > 80) {
            jQuery(".xzy-share-box").css({ width: outW, left: optL, top: optT, "display": "block" });
        } else {
            jQuery(".xzy-share-box").css({ width: "118px", "marginLeft": "-50px", left: optL, top: optT, "display": "block" });
            jQuery(".xzy-share-box .zwbox").css({ width: "50%", left: "25%" });
        }
        jQuery(".xzy-share-box .zwbox").css({ height: jQuery(this).outerHeight(), top: -jQuery(this).outerHeight() });
        jQuery(".xzy-share-box").mouseleave(function () {
            $(this).stop(false, false)
            .animate({ "opacity": 0 }, 300, function () {
                $(this).remove();
            });
        });
    })
	jQuery(".xzy-yh .b-close").click(function(){
		jQuery(".xzy-yh").fadeOut();
	})
});
$(document).on('click','.overlayClose',function(){
 	$('.imgShowBox').removeClass('img-show');
    jQuery('html').removeClass('openImg');
    setTimeout(function () { jQuery('.imgShowBox').remove(); }, 800);
});
function openshowImg(num,imgthis) {
    jQuery('html').addClass('openImg');
    jQuery("body").append('<div class="imgShowBox"><div class="imgShowDemo imgShowDemo2"></div><a class="overlayClose"><i></i>返回</a></div>');
    var imgList=jQuery(imgthis);
    for(var i = 0 ; i < imgList.length ; i++){
		jQuery('.imgShowDemo').append('<div class="item"><img src="" class="img"/><div class="con"></div></div>')
		var imgurl = imgList.eq(i).attr('data-img');
		var imgtitle = imgList.eq(i).attr('data-title');
		jQuery('.imgShowDemo .item').eq(i).find(".img").attr("src",imgurl);
		jQuery('.imgShowDemo .item').eq(i).find('.con').html(imgtitle);	
	}
    jQuery(".imgShowBox").css({ height: win_height });
    jQuery('.imgShowDemo').css({ height: win_height });
    jQuery('.imgShowDemo .item').css({ height: win_height });
    
    jQuery(window).resize(function(){
		jQuery(".imgShowBox").css({ height: win_height });
        jQuery('.imgShowDemo').css({ height: win_height });
        jQuery('.imgShowDemo .item').css({ height: win_height });
    });
    
    var imgowl=jQuery(".imgShowDemo").owlCarousel({
        items: 1,
        slideSpeed : 600,
        autoPlay: false,
        navigation: true,
        pagination: false,
        singleItem: true,
        rewindNav: false
    });
	jQuery('.imgShowBox').addClass('img-show');
}
 
function xzybox(htmlAddress){		
	if(jQuery(".md-modal").length>=1){
		jQuery('html').removeClass('md-show');
		jQuery('.md-modal').remove();
	};
	$.ajax({
		url: htmlAddress,
		dataType: "html",
		success: function (data) {
			if (data == "" || data == null) {
				return;
			}
			else {
				$(".pusher").after('<div class="md-modal"><div class="align-vertical"><div class="vertical-inner"></div></div></div>');
				$('.vertical-inner').append(data);
				setTimeout(function(){$("html").addClass("md-show");},50);
				jQuery('.user-close').bind('click',function(e){//back
					jQuery('html').removeClass('md-show');
					setTimeout(function(){jQuery('.md-modal').remove();},400);
				});
				jQuery('.blackBox').bind('click',function(){//back
					jQuery('html').removeClass('md-show');
					setTimeout(function(){jQuery('.md-modal').remove();},400);
				});
 				jQuery('.vertical-inner').bind('click', function (e) { 
				 	if ($(e.target).hasClass('vertical-inner')) { 
				 		jQuery('html').removeClass('md-show');
						setTimeout(function(){jQuery('.md-modal').remove();},400);
				 	} 
 				});
 				if(!placeholderSupport()){   // 判断浏览器是否支持 placeholder
				    $('[placeholder]').focus(function() {
				        var input = $(this);
				        if (input.val() == input.attr('placeholder')) {
				            input.val('');
				            input.removeClass('placeholder');
				        }
				    }).blur(function() {
				        var input = $(this);
				        if (input.val() == '' || input.val() == input.attr('placeholder')) {
				            input.addClass('placeholder');
				            input.val(input.attr('placeholder'));
				        }
				    }).blur();
				};
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			jQuery('html').removeClass('md-show');
			jQuery('.md-modal').remove();
		}
	});
};

//$(document).on("click", "#user-signUpbtn", function () {
//    if(usitem==0){
//    	xzybox('signUpOk.aspx');
//    	return true;
//    }
//});


function todyue() {
    var name = $('#txt_dyname').val();
    var phone = $('#txt_dyphone').val();
    if (name=="") {
        layer.msg("请输入您的姓名", { icon: 0 });
        return false;
    }
    if (phone == "") {
        layer.msg("请输入您的手机号码", { icon: 0 });
        return false;
    }
    var rphone = /^1[3|4|5|7|8]\d{9}$/;
    if (!rphone.test(phone)) {
        layer.msg("请输入正确的手机号", { icon: 0 });
        return false;
    }

    $.ajax({
        type: 'POST',
        //URL方式为POST
        url: '/ajax/to_dy.aspx', //这里是指向登录验证的页面 
        data: {
            "name": name,
            // "qq": qq,
            "phone": phone,
            /* "zd":zd,*/
            "t": Math.random()
        },
        dataType: "json",
        //把要验证的参数传过去 
        //数据类型为JSON格式的验证 
        //在发送数据之前要运行的函数
        //        beforeSend: function () {
        //            $('#confirm').html('登录中.........');
        //        },
        success: function (json) {
            //这是个重点，根据验证页面（login.aspx）输出的JSON格式数据判断是否登录成功 
            //这里我用1表示的 
            //sta就是那个输出到客户端的标示 
            if (json.sta == 1) {
                layer.msg("信息已提交后台", { icon: 1 });
                //   alert("提交成功,请等候管理员联系");
                //location.href = "userPersonalr.aspx";
            }
            else {
                layer.msg(json.info, { icon: 0 });
            }
        }


    });


}

function to_xlsc(id) {
    $.ajax({
        type: 'POST',
        url: '/ajax/xlsc.aspx',
        data: {
            "id": id,

            "t": Math.random()
        },
        dataType: "json",
        success: function (json) {

            if (json.sta == 1) {
                layer.msg("已收藏", { icon: 1 });
                $('#i_' + id).addClass("active");

            }
            else if (json.sta == 3) {
                layer.msg("已取消收藏", { icon: 1 });
                $('#i_' + id).removeClass("active");
            }
            else {
                var strinfo = json.info;

                if (strinfo == "请先登录") {
                    xzybox('login.aspx');
                } else {
                    layer.msg(json.info, { icon: 0 });
                }
            }
        }


    });

}

function to_wzsc(id, pid, ty) {
    $.ajax({
        type: 'POST',
        url: '/ajax/wzsc.aspx',
        data: {
            "id": id,
            "pid": pid,
            "ty": ty,
            "t": Math.random()
        },
        dataType: "json",
        success: function (json) {

            if (json.sta == 1) {
                layer.msg("已收藏", { icon: 1 });
                $('#i_w' + id).addClass("active");

            } else if (json.sta == 3) {
                layer.msg("已取消收藏", { icon: 1 });
                $('#i_w' + id).removeClass("active");
            } else {
                var strinfo = json.info;

                if (strinfo == "请先登录") {
                    xzybox('login.aspx');
                } else {
                    layer.msg(json.info, { icon: 0 });
                }
            }
        }

    });
}


function to_hdsc(id) {
    $.ajax({
        type: 'POST',
        url: '/ajax/hdsc.aspx',
        data: {
            "id": id,

            "t": Math.random()
        },
        dataType: "json",
        success: function (json) {

            if (json.sta == 1) {
                layer.msg("已收藏", { icon: 1 });
                $('#i_h' + id).addClass("active");

            } else if (json.sta == 3) {
                layer.msg("已取消收藏", { icon: 1 });
                $('#i_h' + id).removeClass("active");
            }
            else {
                var strinfo = json.info;

                if (strinfo == "请先登录") {
                    xzybox('login.aspx');
                } else {
                    layer.msg(json.info, { icon: 0 });
                }


            }
        }

    });
}

function isMobile() {
    if (/android/i.test(navigator.userAgent)) {
        //document.write("This is Android'browser.");//这是Android平台下浏览器
        return true;
    }
    if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) {
        //document.write("This is iOS'browser.");//这是iOS平台下浏览器
        return true;
    }
    if (/Linux/i.test(navigator.userAgent)) {
        //document.write("This is Linux'browser.");//这是Linux平台下浏览器
        return true;
    }
    if (/Linux/i.test(navigator.platform)) {
        //document.write("This is Linux operating system.");//这是Linux操作系统平台
        return true;
    }
    if (/MicroMessenger/i.test(navigator.userAgent)) {
        //document.write("This is MicroMessenger'browser.");//这是微信平台下浏览器
        return true;
    }

    return false;
}


