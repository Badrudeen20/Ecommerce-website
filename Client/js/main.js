if(window.innerWidth < 800){
    $('#nav-menu').slideUp(0)
  
}  

   
$(document).ready(function(){
     
    $(".ion-navicon-round").click(function(){
        $("#nav-menu").slideToggle();
      });
      $(window).resize(function(){
           if(window.innerWidth > 800){
            $('#nav-menu').slideDown(0)
           }
           if(window.innerWidth < 800){
            $('#nav-menu').slideUp(0)  
           }         
      })
 
   

})