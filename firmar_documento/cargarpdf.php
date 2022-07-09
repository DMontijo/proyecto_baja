
<!DOCTYPE html>

<html>
    
    <head>
        <title>Cargar documentos PDF.</title>
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
                    <td align="left" valign="top" style="height: auto; width: 1000px; padding: 0px; margin: 0px; background-color: #FFFFFF;">

                        <div id="Div_Cont1" style="padding: 10px;">
                            
                            <table class="table" border="1" cellpadding="2" cellspacing="0" width="100%" class="EstiloBordeFino">

                                <tr>
                                    <td align="left" valign="top" colspan="3" style="padding: 12px;">
                                        
                                        <div id="Div_Cont2">
                                            
                                            <div style="font-size: 13pt; margin-top: 0px; margin-bottom: 10px; color: #bf9b55;">
                                                Cargar documentos PDF para ser firmados.
                                            </div>
                                            
                                            <form id="FIEL_upload_form" enctype="multipart/form-data" method="post" action="#">

                                                <table class="table" border="1" cellpadding="5" cellspacing="0" style="width: 650px;" class="EstiloBordeFino">

                                                <thead>
                                                        <tr>
                                                        <th valign="middle" align="left" class="EstiloGrisTenue" style="background-color:#3e0e20; color: #FFFFFF; padding: 10px; padding-left: 10px; font-size: 11pt;" colspan="2">
                                                            Seleccione el documento PDF a ser firmado.
                                                        </th>
                                                    </tr>
                                                </thead>
                                                    <tr>
                                                        <td valign="middle" align="right">
                                                            Descripción del documento:
                                                        </td>
                                                        <td valign="middle" align="left">
                                                            <input class="form-control input-sm" type="text" id="DescripDoc" size="40" onchange="LimpiarCadenaObj(Objeto)" class="EstiloTextBox" style="font-size: 11pt;" />
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td valign="middle" height="" align="left" colspan="2">
                                                            Archivo .PDF&nbsp;<input class="form-control input-sm" name="ArchPDF" id="ArchPDF" type="file" onchange="FIEL_fileSelected(this);" />
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td valign="middle" align="left" colspan="2" style="padding-left: 10px; height: 40px;">
                                                            <input class="btn btn-outline-dark" type="button" onclick="FIEL_startUploading()" value="Subir archivo" />
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

                                            
                                            <div id="Div_Cont3" style="width: 600px; height: auto; overflow-y: auto; padding: 6px;" class="EstiloBordeFino">

                                                

                                            </div>
                                            
                                            
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
            
            document.getElementById("DescripDoc").focus();
            
            $.ajax({
                url: "Funciones.js",
                dataType: "script",
                cache: false
            });               
         
    
            $.ajax({
                url: "ScriptsJS_Modulo_GargarDocsPDF.js?sesion="+NumAleat(),
                dataType: "script",
                cache: false
            });
            

            document.getElementById("Div_Cont1").style.height = ($(window).height()-82) + "px";
            document.getElementById("Div_Cont2").style.height = ($(window).height()-120) + "px";
            document.getElementById("Div_Cont3").style.height = ($(window).height()-390) + "px";

            $(window).resize(function(){
                document.getElementById("Div_Cont1").style.height = ($(window).height()-82) + "px";
                document.getElementById("Div_Cont2").style.height = ($(window).height()-120) + "px";
                document.getElementById("Div_Cont3").style.height = ($(window).height()-390) + "px";
            }); 
       
        </script>
        
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
</html>








