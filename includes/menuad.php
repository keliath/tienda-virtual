<nav id="sidenav" class="sidenav">
   <a href="javascript:void(0);" class="icon" id="icoa" onclick="">
   <i class="fa fa-bars"></i>
    <a href="./admin.php" >Inicio</a>
    <button class="dropdown-btn">Productos
    <i class="fa fa-caret-down"></i>
  </button>
    <div class="dropdown-container animated">
        <a href="./newpro.php">Nuevo producto</a>
    <a href="./compra.php">Comprar productos</a>
    </div>
    <button class="dropdown-btn">Reportes
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="repobodega.php">Bodega</a>
    <a href="repoventas.php">Ventas</a>
  </div> 
</nav>

<script>
    var icoa = document.getElementById('icoa');
    var men = document.getElementById('sidenav');
    
    icoa.onclick = function(){
        if(men.className === "sidenav"){
            men.className += ' sidenavresponsive';
            document.body.className += 'mainresponsive';
        }else{
            men.className = 'sidenav';
            document.body.className = 'main';
        }
    }
    
    var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("actived");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>

