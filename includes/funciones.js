/** XHConn - Simple XMLHTTP Interface - bfults@gmail.com - 2005-04-08        **
 ** Code licensed under Creative Commons Attribution-ShareAlike License      **
 ** http://creativecommons.org/licenses/by-sa/2.0/                           **/
function XHConn() {
  var xmlhttp, bComplete = false;
  try { xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); }
  catch (e) { try { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); }
  catch (e) { try { xmlhttp = new XMLHttpRequest(); }
  catch (e) { xmlhttp = false; }}}
  if(!xmlhttp) return null;
  this.connect = function(sURL, sMethod, sVars, fnDone) {
    if(!xmlhttp) {
      return false;
    }

    bComplete = false;
    sMethod = sMethod.toUpperCase();

    try {
      if (sMethod == 'GET') {
        xmlhttp.open(sMethod, sURL + '?' + sVars, true);
        sVars = '';
      } else {
        xmlhttp.open(sMethod, sURL, true);
        xmlhttp.setRequestHeader('Method', 'POST ' + sURL + ' HTTP/1.1');
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      }

      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && !bComplete) {
          bComplete = true;
          fnDone(xmlhttp);
        }
      };

      xmlhttp.send(sVars);
    } catch(z) {
      return false;
    }

    return true;
  };

  return this;
}
  
function show_preview(titulo, cuerpo, tipo, id, variable, categoria, tags, privado, coments, f) {
  if (cuerpo.length > 65536) {
    alert('El cuerpo del post es demasiado largo. Este no puede superar los 65536 bytes.');
    return false;
  }
  
  privado = f.privado.checked ? 1 : 0;
  coments = f.coments.checked ? 1 : 0;

  if (f.categoria.options[f.categoria.options.selectedIndex].value == -1) {
    alert('La categoria es obligatoria.');
    return false;
  }

  if (cuerpo.indexOf('imageshack.us') > 0) {
    alert('No se permiten imágenes de imageshack.us');
    return false;
  }

  if (cuerpo == '') {
    alert('El post no puede estar vacío');
    return false;
  }

  if (titulo == '') {
    alert('El título es obligatorio');
    return false;
  }

  if (tags == '') {
    alert('Los tags no pueden estar vacíos');
    return false;
  }

  var params = 'titulo=' + encodeURIComponent(titulo) + '&cuerpo=' + encodeURIComponent(cuerpo) + '&tipo=' + encodeURIComponent(tipo) + '&id=' + encodeURIComponent(id) + '&variable=' + encodeURIComponent(variable) + '&categoria=' + encodeURIComponent(categoria) + '&tags=' + encodeURIComponent(tags) + '&privado=' + encodeURIComponent(privado) + '&coments=' + encodeURIComponent(coments);

  //ajaxCall('/preview.php', 'POST', params, show_preview_2);
  window.ajaxConn = new XHConn();
  ajaxConn.connect('/apuntatelo/preview.php', 'POST', params, show_preview_2);
}

function show_preview_2(html) {
  scrollUp();
  document.getElementById('preview').innerHTML = html.responseText;
  document.getElementById('preview').style.display = 'inline';
}

function scrollUp() {
  var cs = (document.documentElement && document.documentElement.scrollTop) ? document.documentElement : document.body;
  var step = Math.ceil(cs.scrollTop / 10);
  scrollBy(0, (step - (step * 2)));

  if (cs.scrollTop > 0) {
    setTimeout('scrollUp()', 40);
  }
}

function kill_preview() {
  document.getElementById('preview').innerHTML = '';
  document.getElementById('preview').style.display = 'none';
}

// Smileys
function smile(myValue, myField) {
  myValue = ' ' + myValue + ' ';

  if (myField == null) {
    myField = document.forms.reg.cuerpo;
  }

  // IE support
  if (document.selection) {
    myField.focus();
    sel = document.selection.createRange();
    sel.text = myValue;
    myField.focus();
  }

  // MOZILLA / NETSCAPE support
  else if (myField.selectionStart || myField.selectionStart == '0') {
    var startPos = myField.selectionStart;
    var endPos = myField.selectionEnd;
    myField.value = myField.value.substring(0, startPos)
      + myValue 
      + myField.value.substring(endPos, myField.value.length);

    myField.focus();
    myField.selectionStart = startPos + myValue.length;
    myField.selectionEnd = startPos + myValue.length;
  } else {
    myField.value += myValue;
    myField.focus();
  }
}

// YOUTUBE
function youtube() {
  var input = document.reg.cuerpo;

  if (typeof document.selection != 'undefined' && document.selection) {
    var str = document.selection.createRange().text;
    input.focus();

    var my_link = prompt("Código de video de Youtube:\nEjemplo:\nSi la URL es http://www.youtube.com/watch?v=KqQBJA6vc9I\nentonces el código es: KqQBJA6vc9I", '');

    if (my_link != null) {
      if (str.length == 0) {
        str = my_link;
      }

      var sel = document.selection.createRange();
      sel.text = "[swf=http://www.youtube.com/v/" + str + "][/swf]";
      sel.select();
    }

    return;
  } else if (typeof input.selectionStart != 'undefined') {
    var start = input.selectionStart;
    var end = input.selectionEnd;
    var insText = input.value.substring(start, end);
    var my_link = prompt("Código de video de Youtube:\nEjemplo:\nSi la URL es http://www.youtube.com/watch?v=KqQBJA6vc9I\nentonces el código es: KqQBJA6vc9I", "");

    if (my_link != null) {
      if (insText.length == 0) {
        insText = my_link;
      }

      input.value = input.value.substr(0, start) + "[swf=http://www.youtube.com/v/" + insText + "]"+ input.value.substr(end);
      input.focus();
      input.setSelectionRange(start + 11 + my_link.length + insText.length + 4, start + 11 + my_link.length + insText.length + 4);
    }

    return;
  } else {
    var my_link = prompt("Código de video de Youtube:\nEjemplo:\nSi la URL es http://www.youtube.com/watch?v=KqQBJA6vc9I\nentonces el código es: KqQBJA6vc9I", '');
    var my_text = prompt("Ingresar el texto del link:", '');
    input.value += " [swf=http://www.youtube.com/v/" + my_text + "]";

    return;
  }
}
    
// ICONITOS
function instag(tag) {
  var input = document.reg.cuerpo;

  if (typeof document.selection != 'undefined' && document.selection) {
    var str = document.selection.createRange().text;
    input.focus();
    var sel = document.selection.createRange();
    sel.text = "[" + tag + "]" + str + "[/" +tag+ "]";
    sel.select();

    return;
  } else if (typeof input.selectionStart != 'undefined') {
    var start = input.selectionStart;
    var end = input.selectionEnd;
    var insText = input.value.substring(start, end);
    input.value = input.value.substr(0, start) + '[' + tag + ']' + insText + '[/' + tag + ']' + input.value.substr(end);
    input.focus();
    input.setSelectionRange(start + 2 + tag.length + insText.length + 3 + tag.length, start + 2 + tag.length + insText.length + 3 + tag.length);

    return;
  } else {
    input.value+=' ['+tag+']Reemplace este texto[/'+tag+']';

    return;
  }
}
    
function texto(a, b) {
  var input = document.reg.cuerpo;

  if (typeof document.selection != 'undefined' && document.selection) {
    var str = document.selection.createRange().text;
    input.focus();
    var sel = document.selection.createRange();
    sel.text = "[" + a + "]" + str + "[/" +b+ "]";
    sel.select();

    return;
  } else if (typeof input.selectionStart != 'undefined') {
    var start = input.selectionStart;
    var end = input.selectionEnd;
    var insText = input.value.substring(start, end);
    input.value = input.value.substr(0, start) + '[' + a + ']' + insText + '[/' + b + ']'+ input.value.substr(end);
    input.focus();
    input.setSelectionRange(start + 2 + tag.length + insText.length + 3 + tag.length, start + 2 + tag.length + insText.length + 3 + tag.length);

    return;
  } else {
    input.value+=' ['+a+']Reemplace este texto[/'+b+']';

    return;
  }
}

function inslink() {
  var input = document.reg.cuerpo;

  if (typeof document.selection != 'undefined' && document.selection) {
    var str = document.selection.createRange().text;
    input.focus();
    var my_link = prompt('Enter URL:', 'http://');

    if (my_link != null) {
      if (str.length == 0) {
        str = my_link;
      }

      var sel = document.selection.createRange();
      sel.text = "[url=" + my_link + "]" + str + "[/url]";
      sel.select();
    }

    return;
  } else if (typeof input.selectionStart != 'undefined') {
    var start = input.selectionStart;
    var end = input.selectionEnd;
    var insText = input.value.substring(start, end);
    var my_link = prompt('Ingresar la URL:', 'http://');

    if (my_link != null) {
      if (insText.length == 0) {
        insText = my_link;
      }

      input.value = input.value.substr(0, start) + "[url=" + my_link + "]" + insText + "[/url]" + input.value.substr(end);
      input.focus();
      input.setSelectionRange(start + 11 + my_link.length + insText.length + 4, start + 11 + my_link.length + insText.length + 4);
    }

    return;
  } else {
    var my_link = prompt('Ingresar URL:', 'http://');
    var my_text = prompt('Ingresar el texto del link:', '');
    input.value += " [url=" + my_link + "]" + my_text + "[/url]";

    return;
  }
}

function insimg() {
  var input = document.reg.cuerpo;

  if (typeof document.selection != 'undefined' && document.selection) {
    var str = document.selection.createRange().text;
    input.focus();
    var my_link = prompt('Enter URL:', 'http://');

    if (my_link != null) {
      if (str.length == 0) {
        str = my_link;
      }

      var sel = document.selection.createRange();
      sel.text = "[img]" + str + "[/img]";
      sel.select();
    }

    return;
  } else if (typeof input.selectionStart != 'undefined') {
    var start = input.selectionStart;
    var end = input.selectionEnd;
    var insText = input.value.substring(start, end);
    var my_link = prompt('Ingresar la URL de la imagen:', 'http://');

    if (my_link != null) {
      if (insText.length == 0) {
        insText = my_link;
      }

      input.value = input.value.substr(0, start) + "[img]" + insText + "[/img]" + input.value.substr(end);
      input.focus();
      input.setSelectionRange(start + 11 + my_link.length + insText.length + 4, start + 11 + my_link.length + insText.length + 4);
    }

    return;
  } else {
    var my_link = prompt('Ingresar URL:', 'http://');
    var my_text = prompt('Ingresar el texto del link:', '');
    input.value += " [img]" + my_text + "[/img]";

    return;
  }
}
