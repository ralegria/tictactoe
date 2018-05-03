<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="<?php echo $this->_helpers->linkTo("js/materialize.js", "Assets")?>"></script>
<script>
    function logMessages(elem, anim, color, message, after){
        $('.'+elem).addClass('animated '+anim).html(message).attr('style','background-color:'+color+' !important;');
        setTimeout(function(){
            $('.'+elem).removeClass('animated '+anim).html(after).removeAttr('style');
        }, 3000);
    }
</script>
