$(document).ready(function(){
	$("img.rank").mouseenter(function(event){
		var t=Number(event.target.getAttribute("id").substr(-1));
		for(var j=1;j<=t;j++){
			$("img#star_"+j).attr("src", "/images/star_activated.png");
		}
	});
	$("img.rank").mouseleave(function(event){
		var t=Number(event.target.getAttribute("id").substr(-1));
		for(var j=1;j<=t;j++){
			$("img#star_"+j).attr("src", "/images/star_deactivated.png");
		}
	});
	$("img.rank").click(function(event){
		$("img.rank").hide();
		var t=Number(event.target.getAttribute("id").substr(-1));
		$.getJSON("/index.php/ranks/rank/"+postId+"/"+t+".json", function(data){
			if(data["message"]=="success"){
				$("img#rank_pic").attr("src", "/images/likes1.png");
				$("span#avg_rank").text(data["avg_rank"]);
			}
			else{
				$("img.rank").show();
			}
		});
	});
});