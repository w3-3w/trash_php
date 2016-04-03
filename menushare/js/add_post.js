var pic_count = 1;

$(document).ready(function(){
	$("a#add_pic").click(function(){
		if(pic_count >= maxImageCount) return false;
		pic_count += 1;
		
		var inner = $("<label></label>").text("上传图片"+pic_count+"：");
		inner.attr("for","image_"+(pic_count-1));
		$("div#div_image_" + (pic_count - 2)).after(inner);
		var outer = $("<div></div>");
		outer.attr({"class":"label","id":"div_label_"+(pic_count - 1)});
		$("form#PostSubmitForm label[for=image_"+(pic_count-1)+"]").wrap(outer);
		
		inner = $("<input />");
		inner.attr({"name":"data[Image]["+(pic_count-1)+"]","id":"image_"+(pic_count-1),"type":"file","accept":"image/jpeg, image/pjpeg"});
		$("div#div_label_" + (pic_count - 1)).after(inner);
		outer = $("<div></div>");
		outer.attr({"class":"input","id":"div_image_"+(pic_count-1)});
		$("form#PostSubmitForm input#image_"+(pic_count-1)).wrap(outer);
		if(pic_count >= maxImageCount){
			$("div.comments li a").remove("#add_pic");
		}
		return true;
	});
});