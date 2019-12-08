<?php
require_once 'core/init.php';

			
				if (isset($_POST['message'])) {
					if (!empty($_POST['message'])) {
						Chat::Message($_POST['message']);
					}else{
						echo "Message field cant be empty";
					}
					
				}
			
			

?>
<!DOCTYPE html>
    <head>
    	<style>
    		.mytext{
    border:0;padding:10px;background:whitesmoke;
}
.text{
    width:25%;display:flex;flex-direction:column;
}
.text > p:first-of-type{
    width:100%;margin-top:0;margin-bottom:auto;line-height: 13px;font-size: 12px;
}
.text > p:last-of-type{
    width:50%;text-align:right;color:silver;margin-bottom:-7px;margin-top:auto;
}

.macro{
    margin-top:5px;width:85%;border-radius:5px;padding:5px;display:flex;
}
.msj-rta{
    float:right;background:whitesmoke;
}
.msj{
    float:left;background:white;
}
.frame{
    background:#e0e0de;
    height:450px;
    overflow:hidden;
    padding:0;
}
.frame > div:last-of-type{
    position:absolute;bottom:5px;width:100%;display:flex;
}
ul {
    width:100%;
    list-style-type: none;
    padding:18px;
    position:absolute;
    bottom:32px;
    display:flex;
    flex-direction: column;

}
.msj:before{
    width: 0;
    height: 0;
    content:"";
    top:-5px;
    left:-14px;
    position:relative;
    border-style: solid;
    border-width: 0 13px 13px 0;
    border-color: transparent #ffffff transparent transparent;            
}
.msj-rta:after{
    width: 0;
    height: 0;
    content:"";
    top:-5px;
    left:14px;
    position:relative;
    border-style: solid;
    border-width: 13px 13px 0 0;
    border-color: whitesmoke transparent transparent transparent;           
}  
input:focus{
    outline: none;
}        
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
    color: #d4d4d4;
}
::-moz-placeholder { /* Firefox 19+ */
    color: #d4d4d4;
}
:-ms-input-placeholder { /* IE 10+ */
    color: #d4d4d4;
}
:-moz-placeholder { /* Firefox 18- */
    color: #d4d4d4;
}   
    	</style>
    </head>
    <body>

    	  


			
			

			<div id="chat" class="text text-r" style="background:whitesmoke !important">
				

			</div>
			<script>

				function ajaxFunction(){
					var xhr;
					try{
						xhr = new XMLHttpRequest();
					}catch(e){
						try{
							xhr = new ActiveXObject('Msxml2.XMLHTTP');
						}catch(e){
							try{
								xhr = new ActiveXObject('Microsft.XMLHTTP');
							}catch(e){
								alert('Vas pretrazivac ne podrzava AJAX.');
								return false;
							}
						}
					}
					return xhr;
				}

				function osvezi(){

					var xhr = ajaxFunction();
					xhr.open('GET', 'rezultati.php', true);
					xhr.send(null);

					xhr.onreadystatechange = function(){
			
						 if (xhr.readyState === 4) {
							var rezultati = JSON.parse(xhr.responseText);
							renderHTML(rezultati);
						}
					}
				}

				function renderHTML(r){
					var htmlStr = "";
					for (var i in r){
						htmlStr += "<p>" + r[i].author + ":" + r[i].text +"</p>";
					}
					document.getElementById('chat').innerHTML = htmlStr;
				}
				osvezi();
				setInterval(osvezi, 5000);

			</script>
			<br/>
				<form action="/chat.php" method="POST">
			  <input class="mytext" name="message" placeholder="Type a message"/>
			 
			  
			</form>
    </body>

    </html>