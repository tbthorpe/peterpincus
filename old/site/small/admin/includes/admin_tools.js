function getNewHTTPObject()
{
        var xmlhttp;
        /** Special IE only code ... */
        /*@cc_on
          @if (@_jscript_version >= 5)
              try{
                  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
              }
              catch (e){
                  try{
                      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                  }
                  catch (E){
                      xmlhttp = false;
                  }
             }
          @else
             xmlhttp = false;
        @end @*/

        /** Every other browser on the planet */
        if (!xmlhttp && typeof XMLHttpRequest != 'undefined'){
            try{
                xmlhttp = new XMLHttpRequest();
            }
            catch (E){
                xmlhttp = false;
            }
        }
        return xmlhttp;
}

var xmlHttp = getNewHTTPObject();

function callbackFunction()
{
	//alert("readystate" + xmlHttp.readyState);
  if (xmlHttp.readyState != 4){
    return;
	} else {
  var result = xmlHttp.responseText;
  alert(result);

	
 }
}



//-----------------

var ajaxVar = getNewHTTPObject();

function removePost(table,id){
	var params="table="+table+"&id="+id;
	var page = "includes/delete.php?"+params;
	//alert(page);
	ajaxVar.open('GET', page, true);
	ajaxVar.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
	ajaxVar.onreadystatechange = deleteThing;
	ajaxVar.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajaxVar.send(null);
}
function setUpdated()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){

    return;
  }
  else {
	window.status = "";
	var result = ajaxVar.responseText;
	//alert(result);
	$("test").innerHTML = result;
	$("test").onclick = "changee(){change(\"test\");}";
	alert($("test").onclick);
  }
}

function changea(){
		alert("asdf");
}

function change(id){
		var oldtext = $('test').innerHTML;
		$('test').innerHTML = "<textarea rows=15 cols=45 name='"+id+"2' id='"+id+"2'>"+oldtext+"</textarea><br><input type='button' onclick='send(\""+id+"2\")'>";
		$('test').onclick = "changea";
}

function send(id){
	
	//var new = $(id).value;
	//alert($(id).value);
		var params="new="+$(id).value;
	var page = "update.php?"+params;
	//alert(page);
	ajaxVar.open('GET', page, true);
	ajaxVar.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
	ajaxVar.onreadystatechange = setUpdated;
	ajaxVar.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajaxVar.send(null);


}