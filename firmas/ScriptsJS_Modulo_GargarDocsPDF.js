
var Array_NomArchPDF = new Array();
var Array_DescripDoc = new Array();

function VaciarArrays(){
    Array_NomArchPDF = [];
    Array_DescripDoc = [];
}


function FIEL_fileSelected(Obj) {

    FIEL_RestVal();
    
    var Arch1 = document.getElementById("ArchPDF").value.toUpperCase();
    var Ext1 = Arch1.substr(Arch1.length-4, 4);
    
    if (Ext1.length>0){
        if (Ext1!==".PDF"){
            alert("El archivo seleccionado no es válido");
            document.getElementById("ArchPDF").value = "";
            return false;
        }
    }
}


function FIEL_RestVal(){

    document.getElementById('FIEL_upload_response').innerHTML = "";
    document.getElementById('FIEL_upload_response').style.color = "";
    document.getElementById('FIEL_progress_percent').innerHTML = "";
    document.getElementById('FIEL_b_transfered').innerHTML = "";    
    document.getElementById("FIEL_progress_info").style.display = "none";
}



function FIEL_startUploading() {

    if (document.getElementById("DescripDoc").value.length === 0){
        alert("Capture una descripción del documento a subir.");
        document.getElementById("DescripDoc").focus();
        return false;
    }
    

    if (document.getElementById("ArchPDF").value.length === 0){
        alert("¡Seleccione el archivo .pdf a subir!.");
        return false;
    }
    
    document.getElementById("DescripDoc").disabled = true;
    
    FIEL_RestVal();
    
    document.getElementById("FIEL_progress_info").style.display = "block";
    
    document.getElementById("RefAlfa").value = CrearID(10);

    // cleanup all temp states
    iPreviousBytesLoaded = 0;

    var oProgress = document.getElementById('FIEL_progress');
    oProgress.style.display = 'block';
    oProgress.style.width = '0px';
    document.getElementById("FIEL_progressBar").style.display = "";

    // get form data for POSTing
    var vFD = new FormData(document.getElementById('FIEL_upload_form'));

    // create XMLHttpRequest object, adding few event listeners, and POSTing our data
    var oXHR = new XMLHttpRequest();
    oXHR.upload.addEventListener('progress', FIEL_uploadProgress, false);
    oXHR.addEventListener('load',  FIEL_uploadFinish, false);
    oXHR.addEventListener('error', FIEL_uploadError, false);
    oXHR.addEventListener('abort', FIEL_uploadAbort, false);
    oXHR.open('POST', 'UpLoad_PDF.php');
    oXHR.send(vFD);
}


function FIEL_uploadProgress(e) { // upload process in progress
    
    if (e.lengthComputable) {
        iBytesUploaded = e.loaded;
        iBytesTotal = e.total;

        var iPercentComplete = Math.round(e.loaded * 100 / e.total);
        var iBytesTransfered = bytesToSize(iBytesUploaded);
        document.getElementById('FIEL_progress_percent').innerHTML = iPercentComplete.toString() + '%';
        document.getElementById("FIEL_progressBar").value = iPercentComplete;
        document.getElementById('FIEL_b_transfered').innerHTML = iBytesTransfered;
        if (iPercentComplete === 100) {
            var oUploadResponse = document.getElementById('FIEL_upload_response');
            oUploadResponse.innerHTML = 'Espere, procesando...';
            oUploadResponse.style.display = 'block';
        }
    } else {
        document.getElementById('FIEL_progress').innerHTML = 'unable to compute';
    }
}


function FIEL_uploadError(e) { // upload error
    alert(e);
    document.getElementById('FIEL_error2').style.display = 'block';
//    clearInterval(oTimer);
}


function FIEL_uploadAbort(e) { // upload abort
    alert(e);
    document.getElementById('FIEL_abort').style.display = 'block';
//    clearInterval(oTimer);
}


//var FIEL_CadBase = "";

function FIEL_uploadFinish(e) { // upload successfully finished
    
    document.getElementById('FIEL_progress_percent').innerHTML = '100%';
    document.getElementById('FIEL_progress').style.width = '400px';
    
    var DescripDoc = document.getElementById("DescripDoc").value;
    var RefAlfa = document.getElementById("RefAlfa").value;
    
    var CadDats = '';
    
    for (var i=0; i<Array_NomArchPDF.length; i++){
        
        if (CadDats.length>0){
            CadDats += "|";
        }

        CadDats += Array_NomArchPDF[i] + "*" + Array_DescripDoc[i];
    }

    CreateXmlHttp();
    xmlHttp.onreadystatechange = Resp_VerifCargaArchPDF;
    xmlHttp.open("POST","ScriptPHP_VerifCargaArchPDF.php");
    xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xmlHttp.send("RefAlfa="+RefAlfa+"&DescripDoc="+DescripDoc+"&CadDats="+CadDats);
}



function Resp_VerifCargaArchPDF(){
    
    if(xmlHttp.readyState===4 && xmlHttp.status===200){
        
//        alert(xmlHttp.responseText);
        
        var DocXML = xmlHttp.responseXML;
        
        var DescripDoc = DocXML.firstChild.getElementsByTagName('param')[0].getAttribute('DescripDoc');
        var NomArch = DocXML.firstChild.getElementsByTagName('param')[0].getAttribute('NomArch');
        var ExisteArch = DocXML.firstChild.getElementsByTagName('param')[0].getAttribute('ExisteArch');
        
        if (ExisteArch === "NO"){
        
            alert("Hubo un error, no se cargó el documento PDF.");
            
        }else{
            
            Array_NomArchPDF.push(NomArch);
            Array_DescripDoc.push(DescripDoc);
            CrearTabla();
            
            document.getElementById("FIEL_progress_info").style.display = "none";
            document.getElementById("DescripDoc").disabled = false;
            document.getElementById("ArchPDF").value = "";
            document.getElementById("DescripDoc").value = "";
            document.getElementById("DescripDoc").focus();
        }
    }
}

//##############################################################################

function CargarLstDocsPDF(){
    
    CreateXmlHttp();
    xmlHttp.onreadystatechange = Resp_CargarLstDocsPDF;
    xmlHttp.open("POST","ScriptPHP_CargLstDocsPDF.php");
    xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xmlHttp.send();
}


function Resp_CargarLstDocsPDF(){
    
    if(xmlHttp.readyState===4 && xmlHttp.status===200){

//        alert(xmlHttp.responseText);
        
        VaciarArrays();        

        var DocXML     = xmlHttp.responseXML;
        var CantRegs   = DocXML.getElementsByTagName("rst").length;

        for(var i=0;i<CantRegs;i++){

            Array_NomArchPDF.push(DocXML.firstChild.getElementsByTagName("rst")[i].getAttribute("NomArchPDF"));
            Array_DescripDoc.push(DocXML.firstChild.getElementsByTagName("rst")[i].getAttribute("DescripDoc"));
        }

        CrearTabla();
    }    
}


var UltIndTabla = -1;

function CrearTabla(){
    
    UltIndTabla = -1;
    
    var CodHTML = '';
    
    CodHTML += '<table border="1" cellpadding="2" cellspacing="0" style="width: 570px;" class="EstiloBordeFino">';
    
        for (var i=0; i<Array_NomArchPDF.length; i++){
    
            CodHTML += '<tr id="TR_LstDocsPDF'+i+'" onmouseover="ProcesTR_Over('+i+')" onmouseout="" >';
                CodHTML += '<td align="left" valign="middle" style="width: 84%; height: 20px; padding-left: 5px; font-size: 11pt;">';
                    CodHTML += Array_DescripDoc[i];
                CodHTML += '</td>';
                CodHTML += '<td align="center" valign="middle" style="width: 8%; padding-top: 6px;">';
                    CodHTML += '<img src="images/pdf.png" width="32" height="32" alt="pdf" style="cursor: pointer;" onclick="VerDocPDF('+i+')" />';
                CodHTML += '</td>';
                CodHTML += '<td align="center" valign="middle" style="width: 8%; padding-top: 4px;">';
                    CodHTML += '<img src="images/delete_16x16.png" width="16" height="16" alt="delete" style="cursor: pointer;" onclick="EliminDocPDF('+i+')" />';
                CodHTML += '</td>';
            CodHTML += '</tr>';
        }
        
    CodHTML += '</table>';
    
    document.getElementById("Div_Cont3").innerHTML = CodHTML;
}

function ProcesTR_Over(Ind){
    
    if (UltIndTabla>-1){
        document.getElementById("TR_LstDocsPDF"+UltIndTabla).style.color = "";
        document.getElementById("TR_LstDocsPDF"+UltIndTabla).style.backgroundColor = "";
    }
    
    document.getElementById("TR_LstDocsPDF"+Ind).style.color = "#000000";
    document.getElementById("TR_LstDocsPDF"+Ind).style.backgroundColor = "#E1FFFE";
    
    UltIndTabla = Ind;
}


function VerDocPDF(Ind){
   
    var NomArchPDF = Array_NomArchPDF[Ind];
    
    var URL = "archs_pdf/" + NomArchPDF;
    
    window.open(URL,"_blank");    
}


function EliminDocPDF(Ind){
    
    var NomArchPDF = Array_NomArchPDF[Ind];
    var CadDats = '';
    var idx = Array_NomArchPDF.indexOf(NomArchPDF);
    
    if (idx>-1){
        
        Array_NomArchPDF.splice(idx, 1);
        Array_DescripDoc.splice(idx, 1);;
    
        for (var i=0; i<Array_NomArchPDF.length; i++){

            if (CadDats.length>0){
                CadDats += "|";
            }

            CadDats += Array_NomArchPDF[i] + "*" + Array_DescripDoc[i];
        }
        
        CreateXmlHttp();
        xmlHttp.onreadystatechange = Resp_EliminDocPDF;
        xmlHttp.open("POST","ScriptPHP_EliminDocPDF.php");
        xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        xmlHttp.send("NomArchPDF="+NomArchPDF+"&CadDats="+CadDats+"&Ind="+Ind);    
        
        CrearTabla();
    }
}


function Resp_EliminDocPDF(){
    
    if(xmlHttp.readyState===4 && xmlHttp.status===200){

        // alert(xmlHttp.responseText);
        
    }
}

CargarLstDocsPDF();

