<!DOCTYPE html>

<html>
    
    <head>
        <title>Cargar documentos PDF.</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilos.css?ver=111000011" type="text/css" />
        <link rel="shortcut icon" href="Browser.ico"/>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
	    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link rel="preconnect" href="https://fonts.googleapis.com">
	    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

    </head>
     
    <body style="font-family: 'Montserrat', sans-serif;">
        <nav class="navbar" style="background-color:#511229;">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="../assets/img/FGEBC_SEJAP_LOGO.png" alt="" width="270" height="auto">
                </a>
            </div>
        </nav>


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
        <div class="container m-auto">

            <div class="card shadow py-4 px-3 border-0">
                <div class="card-body">
                    <h1 id="titulo" class="text-center fw-bolder pb-1 text-blue">FIRMAR DOCUMENTOS CON FIEL</h1>

                    
                    <div id="DivDefault">

                        <table width="100%">
                            <tr>
                                <td align="center" valign="top" style="width: 1000px; padding: 0px; margin: 0px; background-color: #FFFFFF;">
                                    <div id="Div_Cont1" style="padding: 10px;">
                                        <table width="100%" class="">
                                            <tr>
                                                <td align="center" valign="top"  style="padding: 8px;">
                                        
                                                    <div id="Div_Cont2">
                                                        <blockquote>
                                            
                                                            <form id="FIEL_upload_form" enctype="multipart/form-data" method="post" action="#">

                                                                <table  class="table table-bordered ">

                                                                            
                                                                    <thead>
                                                                        <tr>
                                                                            <th valign="middle" align="left" class="" style="background-color:#3e0e20; color: #FFFFFF; padding: 10px; padding-left: 10px; font-size: 11pt;" colspan="2">
                                                                                Seleccione los archivos correspondientes a la FIEL.
                                                                            </th>
                                                                        </tr>
                                                                    </thead>

                                                                        <tr>
                                                                            <td>
                                                                                Archivo .PDF
                                                                            </td>
                                                                            <td valign="middle" height="" align="left" colspan="2">
                                                                                <input class="form-control form-control-sm" name="ArchFIELpdf" id="ArchFIELpdf" type="file" accepts=".pdf" onchange="FIEL_fileSelected(this);" />
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td>
                                                                                 Archivo .KEY
                                                                            </td>
                                                                            <td valign="middle" height="" align="left">
                                                                                <input class="form-control form-control-sm" name="ArchFIELkey" id="ArchFIELkey" type="file" accepts=".key" onchange="FIEL_fileSelected(this);" />
                                                                            </td>
                                                                        </tr>
                                                        
                                                                        <tr>
                                                                            <td>
                                                                                Archivo .CER
                                                                            </td>
                                                                            <td valign="middle" height="" align="left">
                                                                                <input class="form-control form-control-sm" name="ArchFIELcer" id="ArchFIELcer" type="file" accepts=".cer" onchange="FIEL_fileSelected(this);" />
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>
                                                                                Contraseña
                                                                            </td>
                                                                            <td valign="middle" height="" align="left">
                                                                                <input class="form-control form-control-sm" type="password" name="ClaveFIEL" id="ClaveFIEL" value="" size="12" onchange="LimpiarCadenaObj(this)" class="EstiloTextBox" style="font-size: 11pt;" />
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td valign="middle" align="right" colspan="2" style="padding-left: 10px; height: 40px;">
                                                                                <input class="btn btn-outline-dark btn-sm" type="button" onclick="FIEL_DirectSign()" value="Firmar PDF" />
                                                                            </td>
                                                                        </tr>

                                                                </table>

                                                                <div id="FIEL_progress_info" style="display: none;">

                                                                    <table border="0" width="50%" cellpadding="6" cellspacing="0">

                                                                        <tr>
                                                                            <td width="100%" align="left" valign="top" height="22">
                                                                                <progress id="FIEL_progressBar" value="0" max="100" style="width:100%; height: 20px; display: none;"></progress>
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

                                                            </form>                                             

                                                            <div id="RespServ" style="margin-top: 10px; margin-bottom: 10px;"></div>
                                                        </blockquote>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>  
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br><br><br><br><br><br>
            </div>
            
        </div>
           
        <footer class="container-fluid text-center text-white d-flex align-items-center justify-content-center footer py-3" style="background-color:#511229;">
		    <span>© <?= date("Y") ?> Fiscalía General del Estado de Baja California</span>
	    </footer>

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
    
</html>

