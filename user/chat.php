<?php
include "../lib/DBA.php";
include "../lib/AUTH.php";
$auth = new AUTH();
if (!empty($_SESSION['uid'])) {
    $name = $_SESSION['name'];
} else {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="../favi.ico" />
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="user-style.css" />
        <link rel="stylesheet" href="chater.css" type="text/css" />
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript" src="chat.js"></script>
        <title>Social share Chatting area!</title>
    </head>
    <script>
        var name = '<?php echo $name;?>';
        name = name.replace(/(<([^>]+)>)/ig,"");
    	
        // display name on page
        $("#name-area").html("You are: <span>" + name + "</span>");
    	
        // kick off chat
        var chat =  new Chat();
        $(function() {
    	
            chat.getState(); 
    		 
            // watch textarea for key presses
            $("#sendie").keydown(function(event) {  
             
                var key = event.which;  
           
                //all keys including return.  
                if (key >= 33) {
                   
                    var maxLength = $(this).attr("maxlength");  
                    var length = this.value.length;  
                     
                    // don't allow new content if length is maxed out
                    if (length >= maxLength) {  
                        event.preventDefault();  
                    }  
                }  
            });
            // watch textarea for release of key press
            $('#sendie').keyup(function(e) {	
    		 					 
                if (e.keyCode == 13) { 
    			  
                    var text = $(this).val();
                    var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                     
                    // send 
                    if (length <= maxLength + 1) { 
                     
                        chat.send(text, name);	
                        $(this).val("");
    			        
                    } else {
                    
                        $(this).val(text.substring(0, maxLength));
    					
                    }	
    				
    				
                }
            });
            
        });
    </script>
</script>
<body onload="setInterval('chat.update()', 1000)">
    <!--starting of nav bar -->
    <?php include "/components/header.php"; ?>
    <!--End of nav bar -->    
    <div class="container wrap">
        <br/>
        <div class="content" style="margin-left: 5%;margin-right: 5%;width:90%;text-align: left;">
            <center><h3>Chat</h3></center>
            <div id="chat-wrap">
                <div id="chat-area"></div>
            </div>
            <form id="send-message-area">
                <p>Type message: </p>
                <textarea id="sendie" maxlength='100' cols="100" rows="1"></textarea>
            </form>
        </div>
        <br/>
    </div>
</body>
</html>