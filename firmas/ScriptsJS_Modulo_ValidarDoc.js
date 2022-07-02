

var iMaxFilesize = 2097152;


function XML_fileSelected(Obj) {

    XML_RestVal();
    
    var Arch1 = document.getElementById("ArchXML").value.toUpperCase();
    var Ext1 = Arch1.substr(Arch1.length-4, 4);
    
    if (Ext1.length>0){
        if (Ext1!==".XML"){
            alert("El archivo seleccionado no es válido");
            document.getElementById("ArchXML").value = "";
            return false;
        }
    }
    
    var Arch2 = document.getElementById("ArchPUB").value.toUpperCase();
    var Ext2 = Arch2.substr(Arch2.length-4, 4);
    
    if (Ext2.length>0){
        if (Ext2!==".PUB"){
            alert("El archivo seleccionado no es válido");
            document.getElementById("ArchPUB").value = "";
            return false;
        }
    }
}


function XML_RestVal(){

    document.getElementById('XML_upload_response').innerHTML = "";
    document.getElementById('XML_upload_response').style.color = "";
    document.getElementById('XML_progress_percent').innerHTML = "";
    document.getElementById('XML_b_transfered').innerHTML = "";    
    document.getElementById("XML_progress_info").style.display = "none";
}


function XML_startUploading() {
    
    XML_RestVal();
    
    document.getElementById("XML_progress_info").style.display = "block";

    if (document.getElementById("ArchXML").value.length === 0){
        alert("¡Seleccione el archivo .xml a subir!");
        return false;
    }
    
    if (document.getElementById("ArchPUB").value.length === 0){
        alert("¡Seleccione el archivo .pub a subir!");
        return false;
    }
    
    document.getElementById("RefAlfa").value = CrearID(10);

    // cleanup all temp states
    iPreviousBytesLoaded = 0;

    var oProgress = document.getElementById('XML_progress');
    oProgress.style.display = 'block';
    oProgress.style.width = '0px';
    document.getElementById("XML_progressBar").style.display = "";

    // get form data for POSTing
    var vFD = new FormData(document.getElementById('XML_upload_form'));
    

    // create XMLHttpRequest object, adding few event listeners, and POSTing our data
    var oXHR = new XMLHttpRequest();
    oXHR.upload.addEventListener('progress', XML_uploadProgress, false);
    oXHR.addEventListener('load',  XML_uploadFinish, false);
    oXHR.addEventListener('error', XML_uploadError, false);
    oXHR.addEventListener('abort', XML_uploadAbort, false);
    oXHR.open('POST', 'UpLoad_XmlPub.php');
    oXHR.send(vFD);
}


function XML_uploadProgress(e) { // upload process in progress
    
    if (e.lengthComputable) {
        iBytesUploaded = e.loaded;
        iBytesTotal = e.total;

        var iPercentComplete = Math.round(e.loaded * 100 / e.total);
        var iBytesTransfered = bytesToSize(iBytesUploaded);
        document.getElementById('XML_progress_percent').innerHTML = iPercentComplete.toString() + '%';
        document.getElementById("XML_progressBar").value = iPercentComplete;
        document.getElementById('XML_b_transfered').innerHTML = iBytesTransfered;
        if (iPercentComplete === 100) {
            var oUploadResponse = document.getElementById('XML_upload_response');
            oUploadResponse.innerHTML = 'Espere, procesando...';
            oUploadResponse.style.display = 'block';
        }
    } else {
        document.getElementById('XML_progress').innerHTML = 'unable to compute';
    }
}


function XML_uploadError(e) { // upload error
    alert(e);
    document.getElementById('XML_error2').style.display = 'block';
//    clearInterval(oTimer);
}


function XML_uploadAbort(e) { // upload abort
    alert(e);
    document.getElementById('XML_abort').style.display = 'block';
//    clearInterval(oTimer);
}


var XML_CadBase = "";

function XML_uploadFinish(e) { // upload successfully finished
    
    document.getElementById('XML_progress_percent').innerHTML = '100%';
    document.getElementById('XML_progress').style.width = '400px';
    
    XML_VerifArchXML();
}


function XML_VerifArchXML(){
    
    var RefAlfa = document.getElementById("RefAlfa").value;
    
    CreateXmlHttp();
    xmlHttp.onreadystatechange = Resp_VerifArchXML;
    xmlHttp.open("POST","ScriptPHP_VerifArchXML.php");
    xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xmlHttp.send("RefAlfa="+RefAlfa);
}

var NoCert = "";
var RFC    = "";
var RazSoc = "";
var XML_password = "";

function Resp_VerifArchXML(){

    if(xmlHttp.readyState === 4 && xmlHttp.status === 200){
        
//        alert(xmlHttp.responseText);

        document.getElementById("XML_progress_info").style.display = "none";

        var CodHTML = '';

        var DocXML = xmlHttp.responseXML;
        
        var Resp = DocXML.firstChild.getElementsByTagName("param")[0].getAttribute("Resp");
        var CodErr = parseInt(DocXML.firstChild.getElementsByTagName("param")[0].getAttribute("CodErr"));
        
        if (CodErr===0){

            CodHTML += '<table border="1" cellpadding="6" cellspacing="0" style="width: 500px; margin-top: 20px;" class="EstiloBordeFino">';
                CodHTML += '<tr>';
                    CodHTML += '<td align="left" valign="middle" style="width: 130px; height: 80px;">';
                        CodHTML += '<img src="images/bien_120x120.png" width="120" height="120" alt="bien"/>';
                    CodHTML += '</td>';
                    CodHTML += '<td align="left" valign="middle" style="width: auto; font-size: 14pt; color: #5C5C5C; padding-left: 18px;">';
                        CodHTML += Resp;
                    CodHTML += '</td>';
                CodHTML += '</tr>';
            CodHTML += '</table>';

            document.getElementById("RespServ").innerHTML = CodHTML;
            
        }else{
            
            CodHTML += '<table border="1" cellpadding="6" cellspacing="0" style="width: 500px; margin-top: 20px;" class="EstiloBordeFino">';
                CodHTML += '<tr>';
                    CodHTML += '<td align="left" valign="middle" style="width: 130px; height: 80px;">';
                        CodHTML += '<img src="images/mal_120x103.png" width="120" height="103" alt="mal_120x103"/>';
                    CodHTML += '</td>';
                    CodHTML += '<td align="left" valign="middle" style="width: auto; font-size: 14pt; color: #5C5C5C; padding-left: 18px;">';
                        CodHTML += Resp;
                    CodHTML += '</td>';
                CodHTML += '</tr>';
            CodHTML += '</table>';

            document.getElementById("RespServ").innerHTML = CodHTML;
        }
    }
}
 
 
function XML_LimpiarDatsArch(){
    
    document.getElementById("ArchXML").value = "";
    document.getElementById("ArchFIELcer").value = "";
    document.getElementById("ArchFIELpdf").value = "";
    document.getElementById('XML_progressBar').value = "0";
    document.getElementById('XML_progressBar').style.display = "none";
    document.getElementById("XML_progress_info").style.display = "none";
    document.getElementById("ClaveFIEL").value = "";
}



//function FirmarDoc(){
//    
//    document.getElementById("RespServ").style.display = "block";
//    
//    var CodHTML = '';
//    
//    CodHTML += '<table border="0" cellpadding="0" cellspacing="0" style="width: 300px;">';
//        CodHTML += '<tr>';
//            CodHTML += '<td align="left" valign="middle" style="width: 100px; height: 80px;">';
//                CodHTML += '<img src="images/loader.gif" width="100" alt="loader"/>';
//            CodHTML += '</td>';
//            CodHTML += '<td align="left" valign="middle" style="width: auto; font-size: 13pt; color: #5C5C5C; padding-left: 18px;">';
//                CodHTML += 'Espere...';
//            CodHTML += '</td>';
//        CodHTML += '</tr>';
//    CodHTML += '</table>';
//    
//    document.getElementById("RespServ").innerHTML = CodHTML;
//    
//    CreateXmlHttp();
//    xmlHttp.onreadystatechange = Resp_FirmDoc;
//    xmlHttp.open("POST","ScriptPHP_FirmarDocumento.php");
//    xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
//    xmlHttp.send("NoCert="+NoCert+"&RFC="+RFC+"&RazSoc="+RazSoc+"&XML_password="+XML_password);
//}
//
//
//function Resp_FirmDoc(){
//
//    if(xmlHttp.readyState === 4 && xmlHttp.status === 200){
//        
////        alert(xmlHttp.responseText);
//        
//        document.getElementById("RespServ").style.display = "block";
//        
//        var CodHTML = '';
//        
//        var Senda_Archs_Firmados = "archs_firmados/";
//        
//        var DocXML = xmlHttp.responseXML;
//        
//        NomArchPNG = DocXML.firstChild.getElementsByTagName("param")[0].getAttribute("NomArchPNG");
//        NomArchPDF = DocXML.firstChild.getElementsByTagName("param")[0].getAttribute("NomArchPDF");
//        NomArchXML = DocXML.firstChild.getElementsByTagName("param")[0].getAttribute("NomArchXML");
//    
//        CodHTML += '<table border="1" cellpadding="8" cellspacing="0" style="width: 450px; margin-top: 20px;" class="EstiloBordeFino">';
//
//            CodHTML += '<tr>';
//
//                CodHTML += '<td align="center" valign="top" style="width: 160px;" rowspan="2">';
//                    CodHTML += '<img src="'+Senda_Archs_Firmados+NomArchPNG+'" width="150" height="150" alt="CodQR"/>';
//                CodHTML += '</td>';
//
//                CodHTML += '<td align="center" valign="top" style="width: auto; padding-top: 4px;">';
//
//                    CodHTML += '<table border="0" cellpadding="1" cellspacing="0" style="width: 100%">';
//                        CodHTML += '<tr>';
//                            CodHTML += '<td align="left" valign="middle" style="width: 28%; font-size: 13pt; height: 40px;">';
//                                CodHTML += '<input type="button" value="Imprimir documento firmado" onclick="ImprDocPDF();" class="myButtonVerde" style="width: 240px;"/>';
//                            CodHTML += '</td>';
//                        CodHTML += '</tr>';
//                        CodHTML += '<tr>';
//                            CodHTML += '<td align="left" valign="middle" style="font-size: 13pt; height: 40px;">';
//                                CodHTML += '<input type="button" value="Descargar archivo .XML" onclick="DescargArchXML();" class="myButtonAzul" style="width: 240px;"/>';
//                            CodHTML += '</td>';
//                        CodHTML += '</tr>';
//                    CodHTML += '</table>';
//
//                CodHTML += '</td>';
//
//            CodHTML += '</tr>';
//
//        CodHTML += '</table>';
//        
//        document.getElementById("RespServ").innerHTML = CodHTML;
//    }
//}


function ImprDocPDF(){
    
    var Senda_Archs_Firmados = "archs_firmados/";
    var URL = Senda_Archs_Firmados+NomArchPDF;
    window.open(URL,"_blank");        
}


function DescargArchXML(){
    
    var Senda_Archs_Firmados = "archs_firmados/";
    
     window.open("descargar_xml.php?NomArch="+NomArchXML+"&Senda="+Senda_Archs_Firmados,"_blank");
}






