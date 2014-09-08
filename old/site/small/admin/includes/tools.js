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
	alert(page);
	ajaxVar.open('GET', page, true);
	ajaxVar.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
	ajaxVar.onreadystatechange = deleteThing;
	ajaxVar.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajaxVar.send(null);
}
function deleteThing()
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



function showGal(id){
	var params="id="+id;
	var page = "test2/showgal.php?"+params;
	//alert(page);
	ajaxVar.open('GET', page, true);
	ajaxVar.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
	ajaxVar.onreadystatechange = showgalcallback;
	ajaxVar.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajaxVar.send(null);
}
function showgalcallback()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  $("gallerybox").innerHTML = "<img src='test2/images/loading.gif'>";
    return;
  }
  else {
	window.status = "";
	//alert("showgal");
	var result = ajaxVar.responseText;
	$("#gallerybox").innerHTML = result;
		//alert(document.body.offsetHeight);
	//alert(document.body.scrollHeight);
		 var t=setTimeout("set()",1000);
  }
}

function set(){
	//alert(document.body.offsetHeight);
	//alert(document.body.scrollHeight);
	var height = Math.max( document.body.offsetHeight, document.body.scrollHeight );
	 //alert ("height: "+ height);
	 $('innerframe').src = "http://fishjunkie.3dcartstores.com/resize.html?w=333&h="+height;
}
function allgals(){
	var page = "test2/allgals.php";
	//alert(page);
	ajaxVar.open('GET', page, true);
	ajaxVar.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
	ajaxVar.onreadystatechange = allgalcallback;
	ajaxVar.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajaxVar.send(null);
}
function allgalcallback()
{
	//alert("readystate" + xmlHttp.readyState);
  if (ajaxVar.readyState != 4){
  $("#gallerybox").innerHTML = "<img src='test2/images/loading.gif'>";
    return;
  }
  else {
	window.status = "";
	//alert("allgal");
	var result = ajaxVar.responseText;
	$("gallerybox").innerHTML = result;
	var t=setTimeout("set()",1500);
  }
}

function showEdit(rowID){
	if(navigator.appName.indexOf("Microsoft") > -1){
		$(rowID).style.display='block';
	} else {
		$('#'+rowID).style.display='table-row';
	}
}

function addNew(rowID){
		var elem="#"+rowID;
		$(elem).css('display','block');
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


