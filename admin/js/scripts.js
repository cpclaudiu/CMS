tinymce.init({ selector:'textarea'});



$(document).ready(function(){
   
$('#selectAllBoxes').click(function(event){
    
    if(this.checked){
        
        $('.checkBoxes').each(function(){
            
            this.checked = true;
            
        });
        
    } else {
        
        $('.checkBoxes').each(function(){
            
            this.checked = false;
            
        });
        
    }
    
    
    
    
});
    
    
    var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    
    $("body").prepend(div_box);
    
    $('#load-screen').delay(100).fadeOut(100, function(){
       $(this).remove(); 
    });  
});



// show users online in realtime

function loadUsersOnline() {
    
    $.get("functions.php?onlineusers=result", function(data){
        
        $(".usersonline").text(data);
        
        
    });
    
}

setInterval(function(){
    

loadUsersOnline();

},500);






















