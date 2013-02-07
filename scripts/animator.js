function getImg(img_id) {
    var img_element = document.getElementById(img_id);
    var t = new Image();
    t.src = (img_element.getAttribute ? img_element.getAttribute("src") : false) || img_element.src;
    return t;
}
var currentTimeDelay = 200;
var framesCount = 1;
var scale = 1;
var iwidth = 0;
var iheight = 0;
var frameWidth=0;
var seqOfFrames = '0';
var seq = [];
function framesCountChanged() {
    $('#frames_count').text(framesCount);
    var cols = "";
    frameWidth=iwidth/framesCount;
    $('#frame_info').html("Frame Width: <span class='green'>"+frameWidth+"</span>");

    for(i=0;i<framesCount;i++)cols=cols+'<td>&nbsp;</td>';
    $('#animator_grid').html('<tr>'+cols+'</tr>');
    $("#framesTotal").html("<strong>"+framesCount+"</strong>");
    $("#framesDelay").attr("value",currentTimeDelay);
    seqOfFrames = '0';
    for(i=1;i<framesCount;i++) seqOfFrames = seqOfFrames+','+i; 
    $('#framesSeq').val(seqOfFrames);
    seq = seqOfFrames.split(',');
    
}
function selectToAnimate(img_src) {
    var maxImgWidth = 450; // is max width then we scale
    framesCount = 1;
    framesCountChanged();
    $('#image_anim').attr("src",img_src);   
    $('#image_anim').one("load", function(){
        var img = getImg('image_anim');
    setTimeout(function(){
        iwidth = img.width;
        iheight = img.height;
        scale = 1;
        frameWidth=iwidth;
        $('#frame_info').html("Frame Width: <span class='green'>"+frameWidth+"</span>");
        var htmlOut = "Origin Image size: <span class='green'>"+iwidth+"x"+iheight+"</span>";
        if(iwidth>maxImgWidth) {
            scale = maxImgWidth/iwidth;
            htmlOut = htmlOut+"<br/>(here scaled: "+scale+")";
        }
        $('#image_info').html(htmlOut);
        var iw = iwidth*scale;
        var ih=iheight*scale;
        $('#image_anim').attr("width",iw);
        $('#animator_grid').attr("width",iw);
        $('#animator_grid').attr("height",ih);
        
        $('#animator_player').css("backgroundImage",'url('+img_src+')');
        
    }, 0);
 });   
}
var folder = '';
function imagesList() {
    $('#images_list').load('imageslist.php?folder='+folder, function() {
        selectToAnimate($('#right_0').attr('src'));
        $("img.delete").click(this,function(eventObject) {
            var n = "right_"+eventObject.currentTarget.name.substring(1);
            var srcn = $("#"+n).attr("src");
            if (confirm("Really want to delete the file? ")) {
                $.post("delete.php",{file:srcn}).complete(function() { 
                    imagesList();
                    alert("Deleted"); 
                });
            }
        });
      });
      
}
var frameCounter = 0;
var frameIndex = 0;
function animate_show() {
    $("#animator_player").css('background-position',(-frameIndex*frameWidth)+'px 0px');
    $("#framesSelected").html("<strong>"+(frameIndex)+"</strong>");
}

function animate_next() {
        frameCounter ++;
	frameCounter %= seq.length;
        frameIndex = parseInt(seq[frameCounter]);
        animate_show();
}
function animate_prev() {
        frameCounter += seq.length-1;
	frameCounter %= seq.length;
        frameIndex = parseInt(seq[frameCounter]);
        animate_show();
        alert(frameIndex+": "+seq);
}
var delayer = 0;

function playClik () {
    if (delayer===0) {
        frameCounter = 0;
        delayer = setInterval("animate_next()",currentTimeDelay);
    } else {
        clearInterval(delayer);
        delayer = 0;
    }
}
var playing = false;
$(document).ready(function() {
    $('#framesSeq').on('input',function(e) {
        seqOfFrames = $('#framesSeq').val();
        seq = seqOfFrames.split(',');
        //alert(": "+seq);
    });
    $('#clickForSeq').click(function() {
        $('#framesSeq').toggle('slow', function() {
            $('#framesSeq').val(seqOfFrames);
          });
    });
    $('#framesPlay').click(function() {
        if(playing===false) {
            playing = true;
            $('#framesPlay').attr("src","images/pause.png");
        } else {
            $('#framesPlay').attr("src","images/play.png");
            playing = false;
        }
        playClik ();
    });
    $('#framesPlus').click(function() {
        framesCount++;
        framesCountChanged();
    });
    $('#framesMinus').click(function() {
        if(framesCount>1) {
            framesCount--;
            framesCountChanged();
        }
    });
    $('#framesNext').click(function() {
        animate_next();
    });
    $('#framesPrev').click(function() {
        animate_prev();
    });
    $('#framesDelay').on('input',function(e) {
        currentTimeDelay = parseInt($('#framesDelay').attr('value'));
        playClik ();
        playClik ();
     });
    $("#image_anim_a").fancybox({
		maxWidth	: 1000,
		maxHeight	: 800,
		fitToView	: false,
		autoSize	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
                afterShow	: function() {
                    var obj = document.getElementById('animator_player');
                    obj.style.width=frameWidth+"px";
                    obj.style.height=iheight+"px";
			
		}
	});
});




