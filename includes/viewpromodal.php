<?php

?>


<div id="comprar" class="login modal ">
    <form action="" method="post" class="login modal-content animate">
        <div id="display">
            
        </div>
    </form>
</div>

<script>
    // Get the modal
    var comprar = document.getElementById('abrir');
    var comModal = document.getElementById('comprar');

    /*$(function(){
        $(".vista").click(function(e){
            e.preventDefault();
            var id = $(this).attr('id');

            $('<img>',{
                'src':'./images/productos/002.jpg',
                'class':'proimg'
            }).hide().appendTo('.ids').fadeIn('slow');

            $("#idimg").val(id);
            $("#comprar").css("display", "block");
        })
    })*/
    
    comprar.onclick = function(){
        comModal.style.display = 'block';
    }

    //cuando el usuario da click fuera del modal este se cierra
    window.onclick = function(event) {
        if (event.target == loginModal) {
            loginModal.style.display = 'none';
        }
        if (event.target == regModal){
            regModal.style.display = 'none';
        }
        if (event.target == comModal){
            comModal.style.display = 'none';
        }
    }


</script>