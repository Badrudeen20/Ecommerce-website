<?php 
 define('FILE_PATH',$_SERVER['DOCUMENT_ROOT'].'/ecommerce/images/profile/');
 function redirect($link){ ?>
    <script>
        window.location.href ='<?php  echo $link ?>';
    </script>
  <?php
  die();
}
?>