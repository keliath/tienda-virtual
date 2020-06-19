<nav class="topnav" id="Topnav">
    <a href="./" class="active">Inicio</a>
    <div class="dropdown">
        <button class="dropbtn">Productos 
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="./productos.php?cat=per">Perfumes</a>
            <a href="./productos.php?cat=aro">Aromatizantes</a>
        </div>
    </div>  
    <a href="./nosotros.php">Nosotros</a>
    <a href="./contactenos.php">Contactenos</a>
    <a href="javascript:void(0);" class="icon" id="ico" onclick="myFunction()">
    <i class="fa fa-bars"></i>
    </a>
</nav>


<script>
    var ico = document.getElementById('ico');
    var drop = document.getElementById('drop');
    ico.onclick = function() {
        var x = document.getElementById("Topnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
    
    // esta funciona como quiero xd
    $(document).on("click",function(e) {
                    
         var container = $("#Topnav");
                            
            if (!container.is(e.target) && container.has(e.target).length === 0) { 
                container.removeClass('responsive');
            }
     });
     
    
    /* no funciona como quiero 
    document.onclick = function(e){
        var x = document.getElementById("Topnav");
        target = e.target
        if(target == x){
            alert('se a clickeado dentroo');
        }else{
            alert('se a clickeado fuera');
        }
    }
    */
</script>
