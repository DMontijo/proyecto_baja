
<!DOCTYPE html>

<html>
    
    <head>
        <title>Firmar documentos con FIEL.</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilos.css?ver=111000011" type="text/css" />
        <link rel="shortcut icon" href="Browser.ico"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
     
    <body>
        
        <script type="text/javascript" >

            var xmlHttp;

            function CreateXmlHttp() {
                if (window.XMLHttpRequest) {
                        xmlHttp =  new XMLHttpRequest();
                } else if (window.ActiveXObject) {
                        xmlHttp =  new ActiveXObject("Microsoft.XMLHTTP");
                }
            }
            
            function NumAleat(){
                Num =  Math.floor((Math.random()*10000000000)+1);
                return Num;
            }
            
        </script>
        
        
        <script src="jquery.js" type="text/javascript"></script>
        
        <div id="DivDefault" style="display: block;">

            <table class="table" border="0" cellpadding="2" cellspacing="0" width="80%">

                <tr>
                
                    
                    <td valign="top" style="height: auto; width: 1000px; padding: 0px; margin: 0px; background-color: #FFFFFF;">

                        <div id="Div_Cont1" style="padding: 10px;">
                            
                            <table class="table" cellpadding="2" cellspacing="0" width="100%" class="">

                                <tr>
                                    <td  valign="top" colspan="3" style="padding: 8px;">
                                        
                                        <div id="Div_Cont2" style="overflow-y: auto;">
                                            
                                            <div style="font-size: 13pt; margin-top: 0px; margin-bottom: 10px; color: #bf9b55;">
                                                Cargar y validar los archivos de la FIEL.
                                            </div>
                                            
                                            <blockquote>
                                            
                                                <form id="FIEL_upload_form" enctype="multipart/form-data" method="post" action="#">

                                                    <table class="table" border="1" cellpadding="5" cellspacing="0" style="width: 540px;" class="">

                                                    <thead>
                                                        <tr>
                                                            <th valign="middle" height="" align="left" class="" style=" background-color:#3e0e20; color: #FFFFFF; padding: 10px; padding-left: 10px; font-size: 11pt;">
                                                                Seleccione los archivos correspondientes a la FIEL.
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                        <tr>
                                                            <td valign="middle" height="" align="left">
                                                                Archivo .KEY&nbsp;<input class="form-control input-sm" name="ArchFIELkey" id="ArchFIELkey" type="file" onchange="FIEL_fileSelected(this);" />
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td valign="middle" height="" align="left">
                                                                Archivo .CER&nbsp;<input class="form-control input-sm" name="ArchFIELcer" id="ArchFIELcer" type="file" onchange="FIEL_fileSelected(this);" />
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td valign="middle" height="" align="left">
                                                                Contraseña:&nbsp;<input class="form-control input-sm" type="password" id="ClaveFIEL" value="" size="12" onchange="LimpiarCadenaObj(Objeto)" class="EstiloTextBox" style="font-size: 11pt;" />
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td valign="top" height="" align="left">
                                                                <input class="btn btn-outline-dark btn-sm" type="button" onclick="FIEL_startUploading()" value="Subir archivos" />
                                                            </td>
                                                        </tr>

                                                    </table>

                                                    <div id="FIEL_progress_info" style="display: none;">

                                                        <table class="table" border="0" width="50%" cellpadding="6" cellspacing="0">

                                                            <tr>
                                                                <td width="100%" align="left" valign="top" height="22">
                                                                    <progress id="FIEL_progressBar" value="0" max="100" style="width:400px; height: 20px; display: none;"></progress>
                                                                </td>
                                                            </tr>

                                                        </table>

                                                        <div id="FIEL_progress"></div>
                                                        <div id="FIEL_progress_percent">&nbsp;</div>
                                                        <div class="FIEL_clear_both"></div>

                                                        <div>
                                                            <div id="FIEL_b_transfered">&nbsp;</div>
                                                            <div class="FIEL_clear_both"></div>
                                                        </div>

                                                        <div id="FIEL_upload_response"></div>

                                                    </div>
                                                    
                                                    <input type="hidden" name="RefAlfa" id="RefAlfa" size="12" />

                                                </form>                                             

                                                <div id="RespServ" style="margin-top: 10px; margin-bottom: 10px;">
                                                    
                                                </div>
                                                
                                            </blockquote>
                                            
                                            <table id="TablaOpcsDocsPDF" border="1" cellpadding="4" cellspacing="0" style="width: auto; display: none;" class="EstiloBordeFino">

                                                <tr style="height: 50px;">
                                                    <td align="right" valign="middle" style="width: 150px; font-size: 11pt;">
                                                        Documento a firmar:&nbsp;
                                                    </td>
                                                    <td align="center" valign="middle" style="width: 320px;">
                                                        <select id="OpcDocAFirmar" style="font-size: 11pt; width: 300px;" onchange="ProcesOpcDocAFirm()" ></select>
                                                    </td>
                                                    <td align="left" valign="middle" style="width: 40px;">
                                                        &nbsp;
                                                    </td>
                                                    <td align="center" valign="middle" style="width: 40px; padding-top: 8px; padding-right: 6px;">
                                                        <img id="Img_PDF" src="images/pdf.png" width="32" height="32" alt="pdf" style="cursor: pointer; display: none;" onclick="PrevisDocPDF()" />
                                                    </td>
                                                    <td align="center" valign="middle" style="width: 200px;">
                                                        <input id="Btn_FirmDoc" style="display: none;" type="button" value="Firmar documento" onclick="FirmarDoc()" class="myButtonAzul" />
                                                    </td>
                                                </tr>

                                            </table>
                                            
                                        </div>
                                        
                                    </td>
                                </tr>

                            </table>
                            
                        </div>
                        
                    </td>
                    
                </tr>
                
            </table>
                
        </div>
        
        
        <script>
            
            $.ajax({
                url: "Funciones.js",
                dataType: "script",
                cache: false
            });               
         
    
            $.ajax({
                url: "ScriptsJS_Modulo_FirmarDoc.js?sesion="+NumAleat(),
                dataType: "script",
                cache: false
            });
            

            document.getElementById("Div_Cont1").style.height = ($(window).height()-82) + "px";
            document.getElementById("Div_Cont2").style.height = ($(window).height()-160) + "px";

            $(window).resize(function(){
                document.getElementById("Div_Cont1").style.height = ($(window).height()-82) + "px";
                document.getElementById("Div_Cont2").style.height = ($(window).height()-160) + "px";
            }); 
       
        </script>
        
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
</html>









