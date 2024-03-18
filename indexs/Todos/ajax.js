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

function Pagina(nropagina){
 //donde se mostrar� los registros
 divContenido = document.getElementById('contenido');
 
 ajax=objetoAjax();
 //uso del medoto GET
 //indicamos el archivo que realizar� el proceso de paginar
 //junto con un valor que representa el nro de pagina
 ajax.open("GET", "indexs/todos/paginador.php?pag="+nropagina);
 divContenido.innerHTML= '<div class="Post" style="font-size: 12px; font-weight:bold;">&nbsp<img src="loading.gif"> Cargando p�gina... <div style="height:795px">&nbsp;</div><div>&nbsp<img src="loading.gif"> Cargando p�gina...</div></div>';
 ajax.onreadystatechange=function() {
  if (ajax.readyState==4) {
   //mostrar resultados en esta capa
   divContenido.innerHTML = ajax.responseText
  }
 }
 //como hacemos uso del metodo GET
 //colocamos null ya que enviamos 
 //el valor por la url ?pag=nropagina
 ajax.send(null)
}
