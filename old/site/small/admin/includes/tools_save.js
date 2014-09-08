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


function showText()
{
	
	//alert("showtesxt");
	window.event.cancelBubble = true;
	window.event.returnValue = false;
	var objCell = document.elementFromPoint( window.event.x, window.event.y );
	//alert(objCell.innerText);
	//alert(objCell.id);
	
	var page = "get_help_strings.asp?string=" + objCell.id;
	//alert(page);
	xmlHttp.open('GET', page, true);
	xmlHttp.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
	xmlHttp.onreadystatechange = callbackFunction;
	xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlHttp.send(null);
}


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
function removeGalPic(table,id, id2, ct, before){	
  ajaxVar.onreadystatechange = callbackFunctionGalPicDelete;

  params="table="+table+"&id="+id+"&pid="+id2+"&ct="+ct+"&before="+before;
  page = "includes/delete.php?"+params;
	// alert (page);
	
	ajaxVar.open('GET', page, true);
	ajaxVar.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
	ajaxVar.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajaxVar.send(null);
}
function removePic(table,id, id2, ct){
	
//	alert("removePic");
	var params="table="+table+"&id="+id+"&pid="+id2;
	var page = "includes/delete.php?"+params;
//	alert(page);
	
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
	case "resume_pics":
	  ajaxVar.onreadystatechange = callbackFunctionResPicDelete;
	  break;
	case "page_pics":
		
	  ajaxVar.onreadystatechange = callbackFunctionPagePicDelete;
	  params="table="+table+"&id="+id+"&pid="+id2+"&ct="+ct;
	  page = "includes/delete.php?"+params;
	// alert (page);
	  break;
	default:
	  //nothing
	}
	ajaxVar.open('GET', page, true);
	ajaxVar.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
	ajaxVar.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajaxVar.send(null);
}


function removePost(table,id){
	
	var params="table="+table+"&id="+id;
	var page = "includes/delete.php?"+params;
	//alert(page);
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
	case "resume_pics":
	  ajaxVar.onreadystatechange = callbackFunctionResPicDelete;
	  break;
	case "resume":
	  ajaxVar.onreadystatechange = callbackFunctionResDelete;
	  break;
  case "burlesque":
	  ajaxVar.onreadystatechange = callbackFunctionBurDelete;
	  break;
	case "links":
	  ajaxVar.onreadystatechange = callbackFunctionLinkDelete;
	  break;
	case "m_cal":
	  ajaxVar.onreadystatechange = callbackFunctionCalDelete;
	  break;
	 case "fanpics":
	  ajaxVar.onreadystatechange = callbackFunctionFanDelete;
	  break;
	 case "scrapbook":
	  ajaxVar.onreadystatechange = callbackFunctionSbDelete;
	  break;
	 case "m_news":
	  ajaxVar.onreadystatechange = callbackFunctionMNewsDelete;
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


function callbackFunctionResDelete()
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
function callbackFunctionBurDelete()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  window.status = "Deleting";
    return;
  }
  else {
	window.status = "";
	var result = ajaxVar.responseText;
//	alert(result);
	$("AdminTable").innerHTML = result;
  }
}
function callbackFunctionCalDelete()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  window.status = "Deleting";
    return;
  }
  else {
	window.status = "";
	var result = ajaxVar.responseText;
//	alert(result);
	$("AdminTable").innerHTML = result;
  }
}
function callbackFunctionFanDelete()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  window.status = "Deleting";
    return;
  }
  else {
	window.status = "";
	var result = ajaxVar.responseText;
//	alert(result);
	$("AdminTable").innerHTML = result;
  }
}
function callbackFunctionMNewsDelete()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  window.status = "Deleting";
    return;
  }
  else {
	window.status = "";
	var result = ajaxVar.responseText;
//	alert(result);
	$("AdminTable").innerHTML = result;
  }
}
function callbackFunctionSbDelete()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  window.status = "Deleting";
    return;
  }
  else {
	window.status = "";
	var result = ajaxVar.responseText;
//	alert(result);
	$("AdminTable").innerHTML = result;
  }
}
function callbackFunctionLinkDelete()
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
function callbackFunctionGalPicDelete()
{
	//alert("Here");
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  window.status = "Deleting";
    return;
  }
  else {
	window.status = "";
	var result = ajaxVar.responseText;
	//alert(result);
	var info = new Array();
	info = result.split("<+++>",3);
	id = info[0];
	var before = info[1];
	//alert(before);
	$("row"+id+"imageList").innerHTML = info[2];
		//alert(	$("AdminTable").innerHTML);
	//$("AdminTable").innerHTML = info[1];
	//id = info[0];
//	showGalEdit("row"+id+"edit");
//	showGalEdit("row"+id+"imageEdit");
//$('tnail'+result).style.display="none";
//alert('tnail'+result);
//alert($('tnail'+result));
 r = "";
  for (i=0; i < result.length; i++) {
    if (result.charAt(i) != '\n' &&
        result.charAt(i) != '\r' &&
        result.charAt(i) != '\t') {
      r += result.charAt(i);
      }
    }
  
//alert('tnail'+r);
//$('tnail'+r).parentNode.removeChild($('tnail'+r))
  }
}

function callbackFunctionResPicDelete()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  window.status = "Deleting";
    return;
  }
  else {
	window.status = "";
	var result = ajaxVar.responseText;
	alert(result);
	var info = new Array();
	info = result.split("<+++>",2);
		id = info[0];
			$("row"+id+"imageList").innerHTML = info[1];
		//alert(	$("AdminTable").innerHTML);
	//$("AdminTable").innerHTML = info[1];
	//id = info[0];
//	showGalEdit("row"+id+"edit");
//	showGalEdit("row"+id+"imageEdit");
  }
}

function callbackFunctionPagePicDelete()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  window.status = "Deleting";
    return;
  }
  else {
	window.status = "";
	var result = ajaxVar.responseText;

	var info = new Array();
	info = result.split("<+++>",2);
		id = info[0];
		 r = "";
  for (i=0; i < id.length; i++) {
    if (id.charAt(i) != '\n' &&
        id.charAt(i) != '\r' &&
        id.charAt(i) != '\t') {
      r += id.charAt(i);
      }
    }
			$("row"+r+"imageFull").innerHTML = info[1];
		//	alert($("row"+id+"imageFull").style.display);
			$("row"+r+"imageFull").style.display= "block";
		//alert(	$("AdminTable").innerHTML);
	//$("AdminTable").innerHTML = info[1];
	//id = info[0];
//	showGalEdit("row"+id+"edit");
//	showGalEdit("row"+id+"imageEdit");
  }
}

///------------------- following is for Free Preview Gallery

function editfpGalPost(){
	
	//alert("here");
	var params="table=news&id="+$("fpidedit").value+"&a="+$("aedit").value+"&b="+$("bedit").value;
	var page = "includes/put.php?"+params;
	ajaxVar.open('GET', page, true);
	ajaxVar.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
	ajaxVar.onreadystatechange = callbackFunctionfpGalEdit;
	ajaxVar.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajaxVar.send(null);
}
function callbackFunctionfpGalEdit()
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
	$("AdminTable").innerHTML = result;
  }
}

function showEdit(rowID){
	if(navigator.appName.indexOf("Microsoft") > -1){
		$(rowID).style.display='block';
	} else {
		$(rowID).style.display='table-row';
	}
}

function addNew(rowID){

		$(rowID).style.display='block';

}

function showEdit2(rowID){
	//if(navigator.appName.indexOf("Microsoft") > -1){
		$(rowID).style.display='block';
	//} else {
		//$(rowID).style.display='table-row';
	//}
}

function hideEdit(rowID){
		$(rowID).style.display='none';
}

function doOnChange(elem){
//	alert($(elem).value + ", " + $(elem).attributes.getNamedItem('oval').nodeValue);
	if ($(elem).value == $(elem).attributes.getNamedItem('oval').nodeValue){
		//$(elem).setStyle({backgroundColor: "#FFE6FF"});
		$(elem).className='newPostInput';
	} else {
		//$(elem).setStyle({backgroundColor: "#AAD4FF"});
		$(elem).className='newPostInputChange';
	}
}

		function toggleImage(letter, elem){
				var s = elem.src;
				//alert(s.substr(0,s.indexOf("_")));
				var ss = s.substr(0,s.indexOf("_"));
				//alert(ss+"_"+letter);
				elem.src = ss+"_"+letter+".jpg";
		}


