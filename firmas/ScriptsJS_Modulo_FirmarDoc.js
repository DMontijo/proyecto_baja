
function FIEL_RestVal(){

    document.getElementById('FIEL_upload_response').innerHTML = "";
    document.getElementById('FIEL_upload_response').style.color = "";
    document.getElementById('FIEL_progress_percent').innerHTML = "";
    document.getElementById('FIEL_b_transfered').innerHTML = "";    
    document.getElementById("FIEL_progress_info").style.display = "none";
}


function FIEL_DirectSign() { // FUNCION DE FIRMA DIRECTA
    
    document.getElementById("ClaveFIEL").style.backgroundColor = "";
    document.getElementById("RespServ").innerHTML = "";
    
    FIEL_RestVal();
    
    document.getElementById("FIEL_progress_info").style.display = "block";

    if (document.getElementById("ArchFIELpdf").value.length === 0){
        Swal.fire({
            customClass: {
              confirmButton: 'swalBtnColor'
            },
            title: '¡Seleccione el archivo .pdf a firmar!',
            icon: 'error'
          });
        return false;
    }

    if (document.getElementById("ArchFIELkey").value.length === 0){
        Swal.fire({
            customClass: {
              confirmButton: 'swalBtnColor'
            },
            title: '¡Seleccione el archivo .key a subir!',
            icon: 'error'
          });
        return false;
    }
    
    if (document.getElementById("ArchFIELcer").value.length === 0){
        Swal.fire({
            customClass: {
              confirmButton: 'swalBtnColor'
            },
            title: '¡Seleccione el archivo .cer a subir!',
            icon: 'error'
          });
        return false;
    }

    var ClaveSellos = document.getElementById("ClaveFIEL").value;
    
    if (ClaveSellos.length===0){
        document.getElementById("ClaveFIEL").style.backgroundColor = "#FF9";
        document.getElementById("ClaveFIEL").focus();
        Swal.fire({
            customClass: {
              confirmButton: 'swalBtnColor'
            },
            title: 'Escriba la contraseña',
            icon: 'error'
          });
        return false;
    }

    // cleanup all temp states
    iPreviousBytesLoaded = 0;

    var oProgress = document.getElementById('FIEL_progress');
    oProgress.style.display = 'block';
    oProgress.style.width = '0px';
    document.getElementById("FIEL_progressBar").style.display = "";

    // get form data for POSTing
    var vFD = new FormData(document.getElementById('FIEL_upload_form'));

    //create XMLHttpRequest object, adding few event listeners, and POSTing our data
    var oXHR = new XMLHttpRequest();
    oXHR.upload.addEventListener('progress', FIEL_uploadProgress, false);
    oXHR.addEventListener('load',  Resp_Validate, false);
    oXHR.addEventListener('abort', FIEL_uploadAbort, false);
    oXHR.open('POST', 'DirectSign.php');
    oXHR.send(vFD);

}

function FIEL_fileSelected(Obj) {

    FIEL_RestVal();
    
    var Arch1 = document.getElementById("ArchFIELpdf").value.toUpperCase();
    var Arch2 = document.getElementById("ArchFIELkey").value.toUpperCase();
    var Arch3 = document.getElementById("ArchFIELcer").value.toUpperCase();

    var Ext1 = Arch1.substr(Arch1.length-4, 4);
    var Ext2 = Arch2.substr(Arch2.length-4, 4);
    var Ext3 = Arch3.substr(Arch3.length-4, 4);
    
    if (Ext1.length>0){
        if (Ext1!==".PDF"){
            Swal.fire({
                customClass: {
                  confirmButton: 'swalBtnColor'
                },
                title: '¡El archivo seleccionado no es válido, seleccione un archivo con extensión .pdf!',
                icon: 'error'
              });
            document.getElementById("ArchFIELpdf").value = "";
            return false;
        }
    }
    if (Ext2.length>0){
        if (Ext2!==".KEY"){
            Swal.fire({
                customClass: {
                  confirmButton: 'swalBtnColor'
                },
                title: '¡El archivo seleccionado no es válido, seleccione un archivo con extensión .key!',
                icon: 'error'
              });            document.getElementById("ArchFIELkey").value = "";
            return false;
        }
    }
    if (Ext3.length>0){
        if (Ext3!==".CER"){
            Swal.fire({
                customClass: {
                  confirmButton: 'swalBtnColor'
                },
                title: '¡El archivo seleccionado no es válido, seleccione un archivo con extensión .cer!',
                icon: 'error'
              });            document.getElementById("ArchFIELcer").value = "";
            return false;
        }
    }





}

function Resp_Validate ({ target }) {
    document.getElementById('FIEL_progress_percent').innerHTML = '100%';
    document.getElementById('FIEL_progress').style.width = '100%';

    var oUploadResponse = document.getElementById('FIEL_upload_response');
    oUploadResponse.innerHTML = '';
    oUploadResponse.style.display = 'none';

    const response = JSON.parse(target.response);
    if (target.status === 400) {
        Display_Error(response)
    } else if (target.status === 200) {
        Display_Document(response);
    }
}

function Display_Document (resp) {
    document.getElementById("RespServ").style.display = "block";
        
    var CodHTML = '';

    CodHTML += '<table border="1" cellpadding="8" cellspacing="0" style="width: 550px; margin-top: 20px;" class="EstiloBordeFino">';

        CodHTML += '<tr>';

            CodHTML += '<td align="center" valign="top" style="width: 160px;" rowspan="2">';
                CodHTML += '<img src="'+resp.NomArchPNG+'" width="150" height="150" alt="CodQR"/>';
            CodHTML += '</td>';

            CodHTML += '<td align="center" valign="top" style="width: auto; padding-top: 4px;">';

                CodHTML += '<table border="0" cellpadding="1" cellspacing="0" style="width: 100%">';
                    CodHTML += '<tr>';
                        CodHTML += '<td align="left" valign="middle" style="width: 28%; font-size: 13pt; height: 40px;">';
                            CodHTML += '<input type="button" value="Imprimir documento firmado" onclick="ImprDocPDF(\''+resp.NomArchPDF+'\');" class="myButtonVerde" style="width: 340px;"/>';
                        CodHTML += '</td>';
                    CodHTML += '</tr>';
                    CodHTML += '<tr>';
                        CodHTML += '<td align="left" valign="middle" style="font-size: 13pt; height: 40px;">';
                            CodHTML += '<input type="button" value="Descargar archivos del documento firmado" onclick="DescargarDocFirmado(\''+resp.NomArchZIP+'\');" class="myButtonAzul" style="width: 340px;"/>';
                        CodHTML += '</td>';
                    CodHTML += '</tr>';
                CodHTML += '</table>';

            CodHTML += '</td>';

        CodHTML += '</tr>';

    CodHTML += '</table>';
    
    document.getElementById("RespServ").innerHTML = CodHTML;
    
    // document.getElementById("TablaOpcsDocsPDF").style.display = "none";
}

function Display_Error (error) {
    CodHTML = '';

    if (error.StatusVigencia==="CADUCO"){
            
        CodHTML += '<table border="1" cellpadding="5" cellspacing="0" style="width: 400px; margin-top: 20px;" class="EstiloBordeFino">';
            CodHTML += '<tr>';
                CodHTML += '<td valign="middle" height="" align="left" style="width: 130px;">';
                    CodHTML += '<img src="images/Exclamacion.png" width="120" height="120" alt="Exclamacion"/>';
                CodHTML += '</td>';
                CodHTML += '<td valign="middle" height="" align="left" style="width: auto; font-size: 14pt;">';
                    CodHTML += 'Los archivos de la FIEL han caducado.';
                CodHTML += '</td>';
            CodHTML += '</tr>';
        CodHTML += '</table>';
        
        document.getElementById("RespServ").innerHTML = CodHTML;
        
        document.getElementById("FIEL_progress_info").style.display = "none";
        document.getElementById("RespServ").style.display = "";
        document.getElementById("RespServ").innerHTML = CodHTML;

        return false;
    }

    if (error.Valid_ApertArchsFIEL===1){
        
        CodHTML += '<table border="1" cellpadding="5" cellspacing="0" style="width: 400px; margin-top: 20px;" class="EstiloBordeFino">';
            CodHTML += '<tr>';
                CodHTML += '<td valign="middle" height="" align="left" style="width: 130px;">';
                    CodHTML += '<img src="images/Exclamacion.png" width="120" height="120" alt="Exclamacion"/>';
                CodHTML += '</td>';
                CodHTML += '<td valign="middle" height="" align="left" style="width: auto; font-size: 14pt;">';
                    CodHTML += 'Los archivos cargados no se puedieron abrir.';
                CodHTML += '</td>';
            CodHTML += '</tr>';
        CodHTML += '</table>';
        
        document.getElementById("RespServ").innerHTML = CodHTML;
    }
    
    if (error.Valid_EsFIEL===1){
        
        CodHTML += '<table border="1" cellpadding="5" cellspacing="0" style="width: 400px; margin-top: 20px;" class="EstiloBordeFino">';
            CodHTML += '<tr>';
                CodHTML += '<td valign="middle" height="" align="left" style="width: 130px;">';
                    CodHTML += '<img src="images/Exclamacion.png" width="120" height="120" alt="Exclamacion"/>';
                CodHTML += '</td>';
                CodHTML += '<td valign="middle" height="" align="left" style="width: auto; font-size: 14pt;">';
                    CodHTML += 'Los archivos cargados no corresponden a una FIEL';
                CodHTML += '</td>';
            CodHTML += '</tr>';
        CodHTML += '</table>';
        
        document.getElementById("RespServ").innerHTML = CodHTML;
    }

    if (error.Valid_ObtenDatsFIEL===1){
        
        CodHTML += '<table border="1" cellpadding="5" cellspacing="0" style="width: 400px; margin-top: 20px;" class="EstiloBordeFino">';
            CodHTML += '<tr>';
                CodHTML += '<td valign="middle" height="" align="left" style="width: 130px;">';
                    CodHTML += '<img src="images/Exclamacion.png" width="120" height="120" alt="Exclamacion"/>';
                CodHTML += '</td>';
                CodHTML += '<td valign="middle" height="" align="left" style="width: auto; font-size: 14pt;">';
                    CodHTML += 'No se pudieron obtener datos de la FIEL.';
                CodHTML += '</td>';
            CodHTML += '</tr>';
        CodHTML += '</table>';
        
        document.getElementById("RespServ").innerHTML = CodHTML;
    }
    
    if (error.Valid_ApertArchsFIEL===0 && error.Valid_EsFIEL===0 && error.Valid_ObtenDatsFIEL===0){
        
        FIEL_LimpiarDatsArch();

        document.getElementById("ClaveFIEL").focus();

        CodHTML += '<table border="1" cellpadding="8" cellspacing="0" style="width: 650px; margin-top: 20px;" class="EstiloBordeFino">';

            CodHTML += '<tr>';

                CodHTML += '<td align="center" valign="top" style="width: 120px;" rowspan="2">';
                    CodHTML += '<img src="images/bien_120x120.png" width="100" height="100" alt="bien_120x120"/>';
                CodHTML += '</td>';

                CodHTML += '<td align="left" valign="top" style="width: auto; padding-top: 4px;">';

                    CodHTML += '<table border="0" cellpadding="1" cellspacing="0" style="width: 450px">';
                        CodHTML += '<tr>';
                            CodHTML += '<td align="left" valign="top" style="color: #006B1B; font-size: 17pt; padding-bottom: 10px;" colspan="2" >';
                                CodHTML += 'Datos obtenidos de la FIEL.';
                            CodHTML += '</td>';
                        CodHTML += '</tr>';
                        CodHTML += '<tr>';
                            CodHTML += '<td align="left" valign="top" style="width: 27%; font-size: 13pt;">';
                                CodHTML += 'RFC:';
                            CodHTML += '</td>';
                            CodHTML += '<td align="left" valign="top" style="width: 73%; font-size: 13pt; color: #000099;">';
                                CodHTML += RFC;
                            CodHTML += '</td>';
                        CodHTML += '</tr>';
                        CodHTML += '<tr>';
                            CodHTML += '<td align="left" valign="top" style="font-size: 13pt;">';
                                CodHTML += 'Nombre:';
                            CodHTML += '</td>';
                            CodHTML += '<td align="left" valign="top" style="font-size: 13pt; color: #000000;">';
                                CodHTML += Nombre;
                            CodHTML += '</td>';
                        CodHTML += '</tr>';
                        CodHTML += '<tr>';
                            CodHTML += '<td align="left" valign="top" style="font-size: 13pt;">';
                                CodHTML += 'Certificado:';
                            CodHTML += '</td>';
                            CodHTML += '<td align="left" valign="top" style="font-size: 13pt; color: #A70202;">';
                                CodHTML += NoCert;
                            CodHTML += '</td>';
                        CodHTML += '</tr>';
                    CodHTML += '</table>';

                CodHTML += '</td>';
        
            CodHTML += '</tr>';

        CodHTML += '</table>';
        
        document.getElementById("FIEL_progress_info").style.display = "none";
        document.getElementById("RespServ").style.display = "";
        document.getElementById("RespServ").innerHTML = CodHTML;
        
        document.getElementById("TablaOpcsDocsPDF").style.display = "";
    }
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
    
    FIEL_VerifArchsKey();
}


var NoCert = "";
var RFC    = "";
var Nombre = "";
var FIEL_password = "";
var RefAlfa = "";

function FIEL_LimpiarDatsArch(){
    
    document.getElementById("ArchFIELkey").value = "";
    document.getElementById("ArchFIELcer").value = "";
    document.getElementById("ArchFIELpdf").value = "";
    document.getElementById('FIEL_progressBar').value = "0";
    document.getElementById('FIEL_progressBar').style.display = "none";
    document.getElementById("FIEL_progress_info").style.display = "none";
    document.getElementById("ClaveFIEL").value = "";
//    document.getElementById("RefAlfa").value = "";
}



function FirmarDoc(){   // FUNCION QUE FIRMA EL DOCUMENTO
    
    document.getElementById("TablaOpcsDocsPDF").style.display = "none";
    document.getElementById("RespServ").style.display = "block";
    
    var CodHTML = '';
    
    CodHTML += '<table border="0" cellpadding="0" cellspacing="0" style="width: 300px;">';
        CodHTML += '<tr>';
            CodHTML += '<td align="left" valign="middle" style="width: 100px; height: 80px;">';
                CodHTML += '<img src="images/loader.gif" width="100" alt="loader"/>';
            CodHTML += '</td>';
            CodHTML += '<td align="left" valign="middle" style="width: auto; font-size: 13pt; color: #5C5C5C; padding-left: 18px;">';
                CodHTML += 'Espere...';
            CodHTML += '</td>';
        CodHTML += '</tr>';
    CodHTML += '</table>';
    
    document.getElementById("RespServ").innerHTML = CodHTML;
    
    //==========================================================================
    
    var idx = document.getElementById("OpcDocAFirmar").selectedIndex;
        
    var NomArchPDF = Array_NomArchPDF[idx-1];
    var DescripDoc = Array_DescripDoc[idx-1];
    
    
    
    CreateXmlHttp();
    xmlHttp.onreadystatechange = Resp_FirmDoc;
    xmlHttp.open("POST","ScriptPHP_FirmarDocumento.php");
    xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xmlHttp.send("NoCert="+NoCert+"&RFC="+RFC+"&Nombre="+Nombre+"&FIEL_password="+FIEL_password+"&RefAlfa="+RefAlfa+"&NomArchPDF="+NomArchPDF+"&DescripDoc="+DescripDoc);
}


var NomArchPNG = "";
var NomArchPDF = "";
var NomArchZIP = "";


function ImprDocPDF(dir){
    window.open(dir,"_blank");        
}

function DescargarDocFirmado(file){
        
    var URL = "DescZIP.php?NomArchZIP=" + file;
    window.open(URL,"_blank");
}


//##############################################################################

var Array_NomArchPDF = new Array();
var Array_DescripDoc = new Array();

function VaciarArrays(){
    Array_NomArchPDF = [];
    Array_DescripDoc = [];
}

function CargLstDocsPDF(){
    
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

        // var DocXML     = xmlHttp.responseXML;
        // var CantRegs   = DocXML.getElementsByTagName("rst").length;
        
        // document.getElementById("OpcDocAFirmar").options[0] = new Option("");

        // for(var i=0;i<CantRegs;i++){

        //     Array_NomArchPDF.push(DocXML.firstChild.getElementsByTagName("rst")[i].getAttribute("NomArchPDF"));
        //     Array_DescripDoc.push(DocXML.firstChild.getElementsByTagName("rst")[i].getAttribute("DescripDoc"));
            
        //     document.getElementById("OpcDocAFirmar").options[i+1] = new Option(DocXML.firstChild.getElementsByTagName("rst")[i].getAttribute("DescripDoc"));
        // }
    }    
}

function ProcesOpcDocAFirm(){
    
    var idx = document.getElementById("OpcDocAFirmar").selectedIndex;
    
    if (idx===0){
        document.getElementById("Img_PDF").style.display = "none";
        document.getElementById("Btn_FirmDoc").style.display = "none";
    }else{
        document.getElementById("Img_PDF").style.display = "";
        document.getElementById("Btn_FirmDoc").style.display = "";
    }
    
}


function PrevisDocPDF(){
    
    var idx = document.getElementById("OpcDocAFirmar").selectedIndex;
    
    if (idx>0){
        
        var NomArchPDF = Array_NomArchPDF[idx-1];
        
        var Senda_Archs_PDF = "archs_pdf/";
        
        var URL = Senda_Archs_PDF+NomArchPDF;
        
        window.open(URL,"_blank"); 
    }
}



CargLstDocsPDF();




