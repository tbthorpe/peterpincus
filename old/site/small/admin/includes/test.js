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

var ajaxVar = getNewHTTPObject();

function getInfo(table,id)
{
	
	alert("here");
	
	var page = "includes/get.php?table="+table+"&id="+id;
	//alert(page);
	ajaxVar.open('GET', page, true);
	ajaxVar.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
	switch(table)
	{
	case "news":
	  ajaxVar.onreadystatechange = callbackFunctionNews;
	  break;    
	case "users_table":
	  ajaxVar.onreadystatechange = callbackFunctionUsers;
	  break;
	case "fp_gallery":
	  ajaxVar.onreadystatechange = callbackFunctionfpGallery;
	  break;
	default:
	  //nothing
	}
	ajaxVar.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajaxVar.send(null);
}

function callbackFunctionNews()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  window.status = "Gathering help...";
    return;
  }
  else {
	window.status = "";
	var result = ajaxVar.responseText;
	var info = new Array();
	info = result.split("<+++>",4);
	$("EditDiv").style.visibility="visible";
	$("nidedit").value = info[1];
	$("aedit").value = info[2];
	$("bedit").value = info[3];
  }
}

function callbackFunctionfpGallery()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  window.status = "Gathering help...";
    return;
  }
  else {
	window.status = "";
	var result = ajaxVar.responseText;
	var info = new Array();
	alert(result);
	info = result.split("<+++>",4);
	$("EditDiv").style.visibility="visible";
	$("fpidedit").value = info[1];
	$("aedit").value = info[2];
	$("bedit").value = info[3];
  }
}

function editNewsPost(){
	
	//alert("here");
	var params="table=news&id="+$("nidedit").value+"&a="+$("aedit").value+"&b="+$("bedit").value;
	var page = "includes/put.php?"+params;
	ajaxVar.open('GET', page, true);
	ajaxVar.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
	ajaxVar.onreadystatechange = callbackFunctionNewsEdit;
	ajaxVar.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajaxVar.send(null);
}
function callbackFunctionNewsEdit()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  window.status = "Gathering help...";
    return;
  }
  else {
	window.status = "";
		$("EditDiv").style.visibility="hidden";
	var result = ajaxVar.responseText;
	$("newsAdminTable").innerHTML = result;
  }
}

function removePost(table,id){
	
	
	var params="table="+table+"&id="+id;
	var page = "includes/delete.php?"+params;
	alert(page);
	ajaxVar.open('GET', page, true);
	ajaxVar.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
	switch(table)
	{
	case "news":
	  ajaxVar.onreadystatechange = callbackFunctionNewsDelete;
	  break;    
	case "users_table":
	  ajaxVar.onreadystatechange = callbackFunctionUsers;
	  break;
	case "fp_gallery":
	  ajaxVar.onreadystatechange = callbackFunctionFPDelete;
	  break;
	case "gallery_galleries":
	  ajaxVar.onreadystatechange = callbackFunctionGalDelete;
	  break;
	case "gallery_pics":
	  ajaxVar.onreadystatechange = callbackFunctionGalPicDelete;
	  break;
	default:
	  //nothing
	}
	ajaxVar.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajaxVar.send(null);
}

function callbackFunctionNewsDelete()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  window.status = "Deleting";
    return;
  }
  else {
	window.status = "";
	var result = ajaxVar.responseText;
	$("AdminTable").innerHTML = result;
  }
}
function callbackFunctionFPDelete()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  window.status = "Deleting";
    return;
  }
  else {
	window.status = "";
	var result = ajaxVar.responseText;
	$("AdminTable").innerHTML = result;
  }
}
function callbackFunctionGalDelete()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  window.status = "Deletinga";
    return;
  }
  else {
	window.status = "";
	var result = ajaxVar.responseText;
	$("AdminTable").innerHTML = result;
  }
}



function testFunction(){
		alert("test");
}