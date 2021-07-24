


    <!--footer-->
    <div class="footer">
        <div class="container">
            <img src="../images/Brand.jpg" />
            <div class="row">
             
            <div class="link">
                <div class="footer-col-2">
                    <h3>Service</h3>
                    <p>Our purpose Is To Sustainabley Make The Pleasure And Befefits of Sports Accessible To the Many.</p>
                </div>
              </div>
               
            <div class="link">
                <div class="footer-col-3">
                    <h3>useful Link</h3>
                    <ul>
                        <li>Coupons</li>
                        <li>Blog Post</li>
                        <li>Return Policy</li>
                        <li>Join Affiliate</li>
                    </ul>
                </div>
              
                <div class="footer-col-4">
                    <h3>Follow Us</h3>
                    <ul>
                        <li>FaceBook</li>
                        <li>Instagram</li>
                        <li>Twitter</li>
                        <li>YouTube</li>
                    </ul>
                </div>
            </div>
             
               
            </div>
        </div>
    </div>
    <div class="copyRight">
        <p>Copyright© Free Themes Cloud 2018. All Right Reserved.</p>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slidesjs/3.0/jquery.slides.min.js" integrity="sha512-TxlLXEZX6gqIhL0yu/40Aed5AJpP2DagJBE3cXgu1oLXoZ33TG3Na+I8Cdnb7KdM15Z5srcDIsbuGMBnESY+EQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/keen-slider@5.5.0/keen-slider.min.js"></script>
    <script src="js/carousel.js"></script>
    <script>
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

     
       $('#grid').click(function(){
        $("#product").removeClass("detailed");
       })

       $('#detail').click(function(){
        $("#product").addClass("detailed");
       })
    
     

})

    </script>
</body>
</html>