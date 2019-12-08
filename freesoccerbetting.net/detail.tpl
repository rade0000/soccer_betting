{include file='header.tpl' p="detail"} 


{php}


{/php}
 
<div id="zavesa" class="brebres"> </div>
<div id="trejler_div">

 
<iframe src="" width="480" height="270" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true" frameborder="no" scrolling="no"></iframe>
 
</div>

<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="left" valign="top">

	</td>
  </tr>
  <tr>
    <td align="left" valign="top">
	<div id="detail_page">
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
		  <tr>
			<td valign="top"> 
			
 

{if $video.imdbgore !==""}
{$video.imdbgore}





{else}
 
{php}
 $videoAr= $this->get_template_vars('video'); 

$rootSajta=constant('_URL')."/";

$ceoURL_T = $_SERVER['REQUEST_URI']; //trenutna stranica
$delovi = explode('/',$ceoURL_T);
$trenutniDIR = "http://".$_SERVER['SERVER_NAME'];
for ($i = 0; $i < count($delovi) - 1; $i++) {
 $trenutniDIR .= $delovi[$i] . "/";
}
$trenutniDIR=$trenutniDIR."";
$razlika=str_replace($rootSajta,"",$trenutniDIR);






if(substr_count($razlika, '/')=="0")
{
$prefiks="";
}
else if(substr_count($razlika, '/')=="1")
{
$prefiks="../";
}
else if(substr_count($razlika, '/')=="2")
{
$prefiks= "../../";
}
$_GET['sta']=$imeFilmaAr;
include("imdb/testiranje/detalji.php");
include("include/functions.php");  
{/php}


{/if}

 






<!--
				<h2 class="h2_song">{$song}</h2>
				<h2 class="h2_artist">{$artist}</h2>
				-->
			</td>
 
		  </tr>
		</table>
		<div  >



 



		{if $featured == 1}



		<span class="tag_featured">{$lang.featured}</span>



		{/if}


{$ad_15}
<h1 style="color: orange;"> {$song} {$rade} sa prevodom </h1>
<table class="plejer_tb"><tr><td  >
 


<div id="detail_vd">{$lang.submittedby}: <a href="{$smarty.const._URL}/profile.{$smarty.const._FEXT}?u={$submitter}">{$submitter}</a> | {$lang.category}: {$category_name} | {$lang.views}: {$views} | <a href="#comments" class="anchorLink">{$lang.comments}</a>: {$comments_no}  </div> </div>


		 {include file="player.tpl" page="detail"}
  
</td><td valign="top">
{$ad_17}

  </td></tr></table>

	</div>




</div>

<div style="padding-top:10px; padding-left:10px;">
<div style="display:inline;"><a class="control" href="javascript:reportPopup('1', '{$uniq_id}')">Prijavi neispravan video</a></div>

 			{if $logged_in == '1'}
				<form action="javascript:getfav(document.getElementById('addtofavorites'));" name="addtofavorites" id="addtofavorites" style="padding:0;">
				 
				
				<input type="hidden" value="{$uniq_id}" name="video_id" id="video_id" />
				<input type="hidden" value="{$s_user_id}" name="user_id" id="user_id" />
 

<a href="javascript:void();" class="control" onclick="parentNode.submit();$(this).html('Dodato');">Dodaj u Favorite</a>
				</form>
				 
			{/if}

 
 
{if $is_admin == 'yes' ||  $is_moderator == 'yes'}
<a href="{$smarty.const._URL}/admin/modify.php?vid={$video.uniq_id}" class="control" title="" target="_blank">EDIT</a>
{/if}
{literal}
<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
  });
</script>




{/literal}
			


</div>

<div style="padding-top:-100px; padding-left:350px; float:left;"> 
<div class="fb-like" id="fb" style="display:inline-block;" data-href="" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>

    </div>


      <table width="100%" border="0" cellspacing="0" cellpadding="0">
 
	      <tr>



	        <td><div id="detail_page">



			<table width="100%" border="0" cellspacing="0" cellpadding="0">
{$ad_7}


		  <tr>



			<td valign="top">


{if !empty($description)}



		<tr>



		    <td colspan="2" align="left">



			



			<div id="enclosed">

			

			</div>



			</td>



		</tr>



		{/if}
            



         



            </td>



			</tr>



		</table>
 </div>
<div id="leva_reklama">
<div id="detail_show_more">
				{$show_more_related}	
 </div>
</div>
		
	<a name="comments" id="comments"></a>



		<div id="detail_page_comments">



		{if $logged_in == '1'}



		<h3>{$lang.post_comment}</h3>



		<span class="mycommentspan" name="mycommentspan" id="mycommentspan"></span>



		<form   name="myform" method="post" id="myform">



		 <textarea name="comment_txt" id="c_comment_txt" style="width:99%" rows="5" onkeyup="textLimit(this, 400);"></textarea>



		 <input type="hidden" id="c_vid" name="vid" value="{$uniq_id}" />



		 <input type="hidden" id="c_user_id" name="user_id" value="{$user_id}" />



		 <br /><br />



		 <input type="submit" id="c_submit" name="Submit" value="{$lang.submit_comment}" class="inputbutton" />



		 <br />



		 <span class="small-warning">* {$lang.post_comment_notice}</span>



		</form>



		{elseif $logged_in == 0 && $guests_can_comment == 1}



			<h3>{$lang.post_comment}</h3>



			<span class="mycommentspan" name="mycommentspan" id="mycommentspan"></span>



			<form  name="myform" method="post" id="myform">



			<input type="text" id="c_username" name="username" value="{$lang.your_name}" onBlur='{literal}if(this.value == "") { this.value="{/literal}{$lang.your_name}{literal}"}{/literal}' onFocus='{literal}if (this.value == "{/literal}{$lang.your_name}{literal}") {this.value=""}{/literal}' class="inputtext" /><br /><br />



			<textarea id="c_comment_txt" name="comment_txt" style="width:95%" rows="5" onkeyup="textLimit(this, 400);"></textarea><br /><br />



			<img src="{$smarty.const._URL}/include/securimage_show.php?sid={php}echo md5(uniqid(time()));{/php}" id="image" align="absmiddle" />



			<a href="#" onclick="document.getElementById('image').src = '{$smarty.const._URL}/include/securimage_show.php?sid=' + Math.random(); return false"><img src="http://www.gledalica.com/reload.gif" border="0" align="absmiddle" /></a>



			<br />



     		<input class="inputtext" name="captcha" type="text" id="captcha" size="15" maxlength="15" />







			<input type="hidden" id="c_vid" name="vid" value="{$uniq_id}" />



			<input type="hidden" id="c_user_id" name="user_id" value="0" />



			<br /><br />



			<input type="submit" id="c_submit" name="Submit" value="{$lang.submit_comment}" class="inputbutton" />



			<br /><span class="small-warning">* {$lang.post_comment_notice}</span>



			</form>



		{/if}



		<br /><br />



		<h3>{$lang.comments}</h3>



			<div class="comment_box">



			{if $show_comments == 'empty'}



				<ol>



				<li id="preview_comment">



				</li>



				</ol>



				<div id="be_the_first">{$lang.be_the_first}</div>



			{else}



				<ol>



				<li id="preview_comment"></li>



				</ol>



				<ol id="comments_ol">



				{$show_comments}



				</ol>



			{/if}



			{if $logged_in != '1' && $guests_can_comment != 1}<br />{$must_sign_in}{/if}



			</div>



		</div></div></td>



	 



        </tr>

		{if !empty($tags)}



		<tr>



		    <td colspan="2" align="left" style="padding:20px;">







			<h3>{$lang.tags}</h3>



			<div id="tags">



			{$tags}	</div>

<center><h3>{$song} {$ad_13}</h3> <p style="font-size:12px;color:orange;">{$description}</p></center>

			</td>



		</tr>



		{/if}	






    </table></td>



    



  </tr>

 
 
</table>


 


{include file='footer.tpl'}
{literal}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

var vidljiv="da"; 
 var phpTrailer="DDD";
$("#trejlerLink , .brebres").click(function(){
	var adresaLink=$(this).attr("href");

	 event.preventDefault();

  $("#zavesa").fadeToggle();
  $("#trejler_div").fadeToggle();
  if(vidljiv=="da")
 {
  	$("#trejler_div").html('<iframe src="'+adresaLink+'" width="480" height="270" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true" frameborder="no" scrolling="no"></iframe>');
  	vidljiv="ne";
  }
  else
  {
  	$("#trejler_div").html("");
  	vidljiv="da";
  } 

});


var vidljivaReklama=1;
var reklama1Link;

function zatvaranjeReklama()
{
		if(vidljivaReklama==1)
	{
		$("#reklama1").fadeOut();
		$("#reklama2").css("display","table");
		vidljivaReklama=2;
	}
	else
	{
		$("#reklama2").fadeOut();
		$("#zatvori").fadeOut();
		vidljivaReklama=1;
	}
}

$("#zatvori").click(function(){
	event.preventDefault();
zatvaranjeReklama();
});


$("#reklama1").click(function(){
	
	reklama1Link=$(this).find("a").attr("href");
	window.open(reklama1Link, '_blank');
zatvaranjeReklama();
	 
});

$("#reklama_g").click(function(){
	
	reklama1Link=$(this).find("a").attr("href");
	window.open(reklama1Link, '_blank');
zatvaranjeReklama();
	 
});
 




var sUrl = window.location;
document.getElementById('fb').setAttribute('href', sUrl);



$(document).ready(function(){
	
	$("#preview_comment").hide();
	
	$("#c_submit").click(function(){
		
		//	hide the button
		//$(this).hide();
		
		//	display the 'loading' gif;
		$("#mycommentspan").html('<img src="'+TemplateP+'/images/ajax-loader.gif" alt="Loading" id="loading" />').show();

		//	get the info
		var userId = $("#c_user_id").val();
		var videoId	= $("#c_vid").val();
		var commentTxt = $("#c_comment_txt").val();
		var uName = $("#c_username").val();
		var captchaCode = $("#captcha").val();
		
		if(userId == 0)
		{
			// guest comment
			$.post( MELODYURL2+"/comment.php", { username: uName, captcha: captchaCode, vid: videoId, user_id: userId, comment_txt: commentTxt },
   					function(data){
						if(data.cond == true)
						{
							$("#myform").slideUp("normal", function() {
								$("#mycommentspan").html(data.msg).show();
								
								//	preview comment
								if(data.preview == true)
								{
									$comment = data.html;
									$comment = $comment.replace(/\n/g, "<br />").replace(/\n\n+/g, '<br /><br />');
									$("#be_the_first").hide();
									$("#preview_comment").html($comment).fadeIn(700);
								}
							});
						}
						else if(data.cond == false)
						{
							$("#c_submit").show();
						 	$("#mycommentspan").html(data.msg).show();									
						}
						
   					},"json"
				 );
		}
		else if(userId > 0)
		{
			// user comment
			$.post( MELODYURL2+"/comment.php", { vid: videoId, user_id: userId, comment_txt: commentTxt },
   					function(data){
						
						if(data.cond == true)
						{
							$("#myform").slideUp("normal", function() {  
								$("#mycommentspan").html(data.msg).show();
								
								//	preview comment
								if(data.preview == true)
								{
									$("#be_the_first").hide();										
									$("#preview_comment").html(data.html).fadeIn(700);
								}
							});
							
						}
						else if(data.cond == false)
						{
							$("#c_submit").show();
						 	$("#mycommentspan").html(data.msg).show();
						}
						
   					},"json"
				 );
		}
      return false;

	});	
});
function getfav(obj) {
  var poststr = "video_id=" + encodeURI( document.getElementById("video_id").value ) +
				"&user_id=" + encodeURI( document.getElementById("user_id").value );
  makePOSTRequest(''+MELODYURL+'/ajax_favorite.php', poststr);
}
</script>
 

<style type="text/css">
	
	#footer {
    background:#333333;
}
</style>
{/literal}