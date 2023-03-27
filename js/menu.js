    /* Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: El logueo de usuario
       Recursos:// */

document.addEventListener("DOMContentLoaded", function(event) {
   
    const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId),
    bodypd = document.getElementById(bodyId),
    headerpd = document.getElementById(headerId)
    
   
// Validar que existan todas las variables
    if(toggle && nav && bodypd && headerpd){
    toggle.addEventListener('click', ()=>{
    // mostrar la barra de navegación
    nav.classList.toggle('show')
    // cambiar el ícono
    toggle.classList.toggle('bx-x')
    // agregar relleno al cuerpo
    bodypd.classList.toggle('body-pd')
    // agregar relleno al encabezado
    headerpd.classList.toggle('body-pd')
    })
    }
    }
    
    showNavbar('header-toggle','nav-bar','body-pd','header')
    
    /*===== ENLACE ACTIVO =====*/
    const linkColor = document.querySelectorAll('.nav_link')
    
    function colorLink(){
    if(linkColor){
    linkColor.forEach(l=> l.classList.remove('active'))
    this.classList.add('active')
    }
    }
    linkColor.forEach(l=> l.addEventListener('click', colorLink))
    
     // Your code to run since DOM is loaded and ready
    });