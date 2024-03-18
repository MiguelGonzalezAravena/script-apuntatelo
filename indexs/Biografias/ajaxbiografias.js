function objetoAjax(){
 var xmlhttp=false;
  try{
   xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  }catch(e){
   try {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
   }catch(E){
    xmlhttp = false;
   }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
   xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

function Paginabiografias(nropagina){
 //donde se mostrará los registros
 divContenidobiografias = document.getElementById('contenidobiografias');
 
 ajax=objetoAjax();
 //uso del medoto GET
 //indicamos el archivo que realizará el proceso de paginar
 //junto con un valor que representa el nro de pagina
 ajax.open("GET", "indexs/biografias/paginador.php?pag="+nropagina);
 divContenidobiografias.innerHTML= '<div class="Post" style="font-size: 12px; font-weight:bold;">&nbsp<img src="loading.gif"> Cargando página... <div style="height:795px">&nbsp;</div><div>&nbsp<img src="loading.gif"> Cargando página...</div></div>';
 ajax.onreadystatechange=function() {
  if (ajax.readyState==4) {
   //mostrar resultados en esta capa
   divContenidobiografias.innerHTML = ajax.responseText
  }
 }
 //como hacemos uso del metodo GET
 //colocamos null ya que enviamos 
 //el valor por la url ?pag=nropagina
 ajax.send(null)
}
