<?php

define('FILE_PATH',$_SERVER['DOCUMENT_ROOT']."/Ecommerce/images/product/");
define('IMG_PATH',$_SERVER['DOCUMENT_ROOT']."/Ecommerce/images/detail/");

function redirect($link){?>
    <script>
        window.location.href='<?php echo $link ?>'
    </script>
<?php
}
?>
