function alerta(title, msg, btn){
    Swal.fire({  title: title,
               text: msg,  
               type: btn,    
               showCancelButton: false,   
               confirmButtonText: 'Aceptar'});
    }