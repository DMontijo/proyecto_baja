


    function redondear(numero, lugares_decimales){
      var p = Math.pow(10, lugares_decimales);
      return Math.round(numero * p) / p;
    }


    function NomVent(){
        var fechaHora = new Date();
        var horas = fechaHora.getHours();
        var minutos = fechaHora.getMinutes();
        var segundos = fechaHora.getSeconds();
        var Vent = "Vent"+horas+minutos+segundos;
        return Vent;
    }


    function LimpiarCadenaCad(Cad){

          Cadena = "";
          Cad2 = "";
          Espacio = 0;
          Letr = "";

          Cadena = allTrim(Cad.toUpperCase());
          Cadena = Cadena.replace(/[*\&\|\’\'\\]/gi, "");

          ArrayLetras = Cadena.split("");

          NoElement = ArrayLetras.length;
          A = 0

          while (NoElement>0){

             if (ArrayLetras[A]==" " ){
                  if (Espacio == 0){
                    Cad2 = Cad2 + ArrayLetras[A];
                    Espacio = 1;
                  }
             }else{
                 Letr = ArrayLetras[A];
                 Cad2 = Cad2 + Letr;
                 Espacio = 0;
             }

             A = A + 1;
             NoElement = NoElement - 1;
          }

          return Cad2;
    }


    function LimpiarCadena(Cad){
        
        alert("Funcion");

          Cadena = "";
          Cad2 = "";
          Espacio = 0;
          Letr = "";

          Cadena = allTrim(Cad);
          Cadena = Cadena.replace(/[*\&\|\’\'\\]/gi, "");
          
          return Cadena;
    }



function SoloNumerosCad(Cad){

      var Cadena = "";
      var Cad2 = "";
      var Letr = "";
      var Punto = 0;

      Cadena = allTrim(Cad.toUpperCase());

      ArrayLetras = Cadena.split("");

      NoElement = ArrayLetras.length;
      A = 0;

      while (NoElement>0)
      {
             Letr = ArrayLetras[A];
             if (Letr == "-" || Letr == "." || Letr == "0" || Letr == "1" || Letr == "2" || Letr == "3" || Letr == "4" || Letr == "5" || Letr == "6" || Letr == "7" || Letr == "8" || Letr == "9")
             {
                if (Letr==".")
                {
                    if (Punto==0)
                    {
                        Cad2 = Cad2 + ArrayLetras[A];
                        Punto=1;
                    }
                }else{
                    Cad2 = Cad2 + ArrayLetras[A];
                }
             }

         A = A + 1;
         NoElement = NoElement - 1;
      }

      if (Cad2.length===0){Cad2=0;}
      return Cad=Cad2;
}


function LimpiarCadenaObj(Objeto){

      Cadena = "";
      Cad2 = "";
      Espacio = 0;
      Letr = "";

      Cadena = allTrim(Objeto.value);
      Cadena = Cadena.replace(/[*\&\|\’\'\\]/gi, "");

      ArrayLetras = Cadena.split("");

      NoElement = ArrayLetras.length;
      A = 0;

      while (NoElement>0){

         if (ArrayLetras[A] == " "){
              if (Espacio == 0){
                Cad2 = Cad2 + ArrayLetras[A];
                Espacio = 1;
              }
         }else{
             Letr = ArrayLetras[A];
             
             Cad2 = Cad2 + Letr;
             Espacio = 0;
         }

         A = A + 1;
         NoElement = NoElement - 1;
      }

      Objeto.value = Cad2;
}

function LimpiarCadenaObjAccCli(Objeto){

      Cadena = "";
      Cad2 = "";
      Espacio = 0;
      Letr = "";

      Cadena = allTrim(Objeto.value);
      Cadena = Cadena.replace(/[\&\|\’\'\\]/gi, "");

      ArrayLetras = Cadena.split("");

      NoElement = ArrayLetras.length;
      A = 0;

      while (NoElement>0){

         if (ArrayLetras[A] == " "){
              if (Espacio == 0){
                Cad2 = Cad2 + ArrayLetras[A];
                Espacio = 1;
              }
         }else{
             Letr = ArrayLetras[A];
             
             Cad2 = Cad2 + Letr;
             Espacio = 0;
         }

         A = A + 1;
         NoElement = NoElement - 1;
      }

      Objeto.value = Cad2;
      
}




function lTrim(sStr){
  while (sStr.charAt(0) == " ")
   sStr = sStr.substr(1, sStr.length - 1);
  return sStr;
}


function rTrim(sStr){
  while (sStr.charAt(sStr.length - 1) == " ")
    sStr = sStr.substr(0, sStr.length - 1);
  return sStr;
}


function allTrim(sStr){
  return rTrim(lTrim(sStr));
}


function FormatNum(Num){
    
      var Cad0 = SoloNumerosCad(String(Num));
      var Cad1 = "";
      var Cad2 = "";
      var Cad4 = "";
      var Cont = 0;

      arr = Cad0.split(".");
      entero = arr[0];
      decimal = arr[1];

      Cad1 = entero;

      while (Cad1.length > 0){

        if (Cont===3){

            if (Cad1 === "-"){
                Cad2=Cad1.substring(Cad1.length-1,Cad1.length)+Cad2;
            }else{
                Cad2=Cad1.substring(Cad1.length-1,Cad1.length)+","+Cad2;
            }

            Cont=1;

        }else{
            Cad2 = Cad1.substring(Cad1.length-1,Cad1.length)+Cad2;
            Cont=Cont+1;
        }

        Cad1 = Cad1.substring(0,Cad1.length-1);

      }

      Cad1 = decimal;

      if (!isNaN(Cad1)===false){
          Cad4="00";
      }else{
          if(Cad1.length===1){Cad4=Cad1+"0";}
          if(Cad1.length===2){Cad4=Cad1;}
          if(Cad1.length>2){Cad4=Cad1.substring(0,2);}
      }

      Cad2=Cad2+"."+Cad4;
      
      return Cad2;
}

function FormatNumSinComa(Num){
    
      var Cad0 = SoloNumerosCad(String(Num));
      var Cad1 = "";
      var Cad2 = "";
      var Cad4 = "";
      var Cont = 0;

      arr = Cad0.split(".");
      entero = arr[0];
      decimal = arr[1];

      Cad1 = entero;

      while (Cad1.length > 0){

        if (Cont===3){

            if (Cad1 === "-"){
                Cad2=Cad1.substring(Cad1.length-1,Cad1.length)+Cad2;
            }else{
                Cad2=Cad1.substring(Cad1.length-1,Cad1.length)+""+Cad2;
            }

            Cont=1;

        }else{
            Cad2 = Cad1.substring(Cad1.length-1,Cad1.length)+Cad2;
            Cont=Cont+1;
        }

        Cad1 = Cad1.substring(0,Cad1.length-1);

      }

      Cad1 = decimal;

      if (!isNaN(Cad1)===false){
          Cad4="00";
      }else{
          if(Cad1.length===1){Cad4=Cad1+"0";}
          if(Cad1.length===2){Cad4=Cad1;}
          if(Cad1.length>2){Cad4=Cad1.substring(0,2);}
      }

      Cad2=Cad2+"."+Cad4;
      
      return Cad2;
}




function FormatoNumObj(Objeto){

      var Contenido = Objeto.value;

      var Cad0 = String(Contenido);
      var Cad1 = "";
      var Cad2 = "";
      var Cad4 = "";
      var Cont = 0;

      arr = Cad0.split(".");
      entero = arr[0];
      decimal = arr[1];

      Cad1 = entero;

      while (Cad1.length > 0){

        if (Cont==3){

            if (Cad1 == "-"){
                Cad2=Cad1.substring(Cad1.length-1,Cad1.length)+Cad2;
            }else{
                Cad2=Cad1.substring(Cad1.length-1,Cad1.length)+","+Cad2;
            }

            Cont=1;

        }else{
            Cad2 = Cad1.substring(Cad1.length-1,Cad1.length)+Cad2;
            Cont=Cont+1
        }

        Cad1 = Cad1.substring(0,Cad1.length-1);

      }

      Cad1 = decimal;

      if (!isNaN(Cad1)==false){
          Cad4="00";
      }else{
          if(Cad1.length==1){Cad4=Cad1+"0";}
          if(Cad1.length==2){Cad4=Cad1;}
          if(Cad1.length>2){Cad4=Cad1.substring(0,2);}
      }

      Cad2=Cad2+"."+Cad4;

      Objeto.value = Cad2;

      return true;

}


    function SoloNumerosObj(Objeto){

          var Cadena = "";
          var Cad2 = "";
          var Letr = "";
          var Punto = 0;

          Cadena = allTrim(Objeto.value.toUpperCase());

          ArrayLetras = Cadena.split("");

          NoElement = ArrayLetras.length;
          A = 0;

          while (NoElement>0)
          {
                 Letr = ArrayLetras[A];
                 if (Letr == "-" || Letr == "." || Letr == "0" || Letr == "1" || Letr == "2" || Letr == "3" || Letr == "4" || Letr == "5" || Letr == "6" || Letr == "7" || Letr == "8" || Letr == "9")
                 {
                    if (Letr==".")
                    {
                        if (Punto==0)
                        {
                            Cad2 = Cad2 + ArrayLetras[A];
                            Punto=1;
                        }
                    }else{
                        Cad2 = Cad2 + ArrayLetras[A];
                    }
                 }

             A = A + 1;
             NoElement = NoElement - 1;
          }

          if (Cad2.length==0){Cad2=0}

          return Objeto.value = Cad2
    }


function Fec1(){
    var date = new Date();
    var d  = date.getDate();
    var dia = (d < 10) ? '0' + d : d;    
    var m = date.getMonth()+1;
    var mes = (m < 10) ? '0' + m : m;
    var año = date.getFullYear();
    var Result = dia + "/" + mes + "/" + año;

    return Result;
}

function Fec2(){
    var date = new Date();
    var d  = date.getDate();
    var dia = (d < 10) ? '0' + d : d;    
    var m = date.getMonth()+1;
    var mes = (m < 10) ? '0' + m : m;
    var año = date.getFullYear();
    var Result =  año + "/" + mes + "/" + dia;

    return Result;
}


function Hora(){
    var d = new Date();
    var hora = d.getHours();
        hora = (hora < 10) ? '0' + hora : hora;
    var min = d.getMinutes();
        min = (min < 10) ? '0' + min : min;
    var seg = d.getSeconds();
        seg = (seg < 10) ? '0' + seg : seg;
    var HoraAct = hora + ":" + min + ":" + seg;

    return HoraAct;
}   


function Fec1ToFec2(Fecha){
    
    Dia = Fecha.substring(0,2);
    Mes = Fecha.substring(3,5);
    Ano = Fecha.substring(6,10);
    
    var Fec = Ano+"/"+Mes+"/"+Dia;
    
    return Fec;
}


function esFechaValida(fecha){

      var fechaf = fecha.split("/");
      var day = fechaf[0];
      var month = fechaf[1];
      var year = fechaf[2];
      var date = new Date(year,month,'0');
      if((day-0)>(date.getDate()-0)){
            return false;
      }
      return true;
}


function sumaFecha(fecha, d){
    
    var Fecha = new Date();
    var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
    var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
    var aFecha = sFecha.split(sep);
    var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
    
    fecha = new Date(fecha);
    
    fecha.setDate(fecha.getDate()+parseInt(d));
    
    var anno=fecha.getFullYear();
    var mes= fecha.getMonth()+1;
    var dia= fecha.getDate();
    
    mes = (mes < 10) ? ("0" + mes) : mes;
    dia = (dia < 10) ? ("0" + dia) : dia;
    
    var fechaFinal = dia+sep+mes+sep+anno;
    
    return (fechaFinal);
}



function ProcesFec_Copia(fecha_ori){

    var FechaBase = fecha_ori;
    var NuevaFecha = "";
    var StrMes = "";
    var OtraFecha = "";
    var Dia = 0;
    var StrDia = "";
    var Mes = 0;

    NuevaFecha = FechaBase.split("/");

    Mes = parseInt(NuevaFecha[1])+1;

    if (Mes<10){
        StrMes = "0"+Mes;
    }else{
        StrMes = Mes;
    }

    NuevaFecha = NuevaFecha[0]+'/'+StrMes+'/'+NuevaFecha[2];

    //==========================================================

    while (esFechaValida(NuevaFecha)===false){

        OtraFecha = NuevaFecha.split("/");

        Dia = parseInt(OtraFecha[0])-1;

        if (Dia<10){
            StrDia = "0"+Dia;
        }else{
            StrDia = Dia;
        }

        NuevaFecha = StrDia+'/'+OtraFecha[1]+'/'+OtraFecha[2];
    }

    return NuevaFecha;
}


function esFechaValida(fecha){

      var fechaf = fecha.split("/");
      var day = fechaf[0];
      var month = fechaf[1];
      var year = fechaf[2];
      var date = new Date(year,month,'0');
      if((day-0)>(date.getDate()-0)){
            return false;
      }
      return true;
}


function ProcesFec(fecha_ori, NumDia){

    var FechaBase = fecha_ori;
    var NuevaFecha = "";
    var StrMes = "";
    var OtraFecha = "";
    var Dia = 0;
    var StrDia = "";
    var Mes = 0;
    var Anio = 0;

    NuevaFecha = FechaBase.split("/");

    Mes = parseInt(NuevaFecha[1])+1;
    Anio = parseInt(NuevaFecha[2]);
    
    if (Mes===13){
        Mes = 1;
        Anio++;
    }

    if (Mes<10){
        StrMes = "0"+Mes;
    }else{
        StrMes = Mes;
    }

    NuevaFecha = NumDia+'/'+StrMes+'/'+Anio;

    //==========================================================

    while (esFechaValida(NuevaFecha)===false){

        OtraFecha = NuevaFecha.split("/");

        Dia = parseInt(OtraFecha[0])-1;

        if (Dia<10){
            StrDia = "0"+Dia;
        }else{
            StrDia = Dia;
        }

        NuevaFecha = StrDia+'/'+OtraFecha[1]+'/'+OtraFecha[2];
    }

    return NuevaFecha;
}


function FecToNum(fecha){
    
    ArrayFec = fecha.split("/");
    
    var Cad = ArrayFec[2] + ArrayFec[1] + ArrayFec[0];
    
    return parseInt(Cad);
}


function FechaMes(fecha){
    
    ArrayFec = fecha.split("/");
    
    var NomMes = '';
    
    if (ArrayFec[1]==="01"){NomMes="Ene";}
    if (ArrayFec[1]==="02"){NomMes="Feb";}
    if (ArrayFec[1]==="03"){NomMes="Mar";}
    if (ArrayFec[1]==="04"){NomMes="Abr";}
    if (ArrayFec[1]==="05"){NomMes="May";}
    if (ArrayFec[1]==="06"){NomMes="Jun";}
    if (ArrayFec[1]==="07"){NomMes="Jul";}
    if (ArrayFec[1]==="08"){NomMes="Ago";}
    if (ArrayFec[1]==="09"){NomMes="Sep";}
    if (ArrayFec[1]==="10"){NomMes="Oct";}
    if (ArrayFec[1]==="11"){NomMes="Nov";}
    if (ArrayFec[1]==="12"){NomMes="Dic";}
    
    var Cad = ArrayFec[0] + "/" + NomMes + "/" + ArrayFec[2];
    
    return Cad;
}


function HoraAMPM(Fecha, Hora) {
    
    var CadFec = Fec1ToFec2(Fecha) + " " + Hora;
    var fecha = new Date(CadFec);
    var horas = fecha.getHours();
    var minutos = fecha.getMinutes();
    var ampm = horas >= 12 ? 'PM' : 'AM';
    horas = horas % 12;
    horas = horas ? horas : 12;
    minutos = minutos < 10 ? '0'+minutos : minutos;
    var tiempo = horas + ':' + minutos + ' ' + ampm;
    
    return tiempo;
}


function fechaCompleta(Fecha){
    
    var fecha = new Date(Fec1ToFec2(Fecha));    
   
    var mes = fecha.getMonth()
    var diaMes = fecha.getDate()
    var diaSemana = fecha.getDay()
    var anio = fecha.getFullYear()
    var dias = new Array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sábado')
    var meses = new Array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre')

    return dias[diaSemana] + ", " + diaMes + " de " + meses[mes] + " de " + anio;
}


// Función para calcular los días transcurridos entre dos fechas
function restaFechas(f1,f2){
     var aFecha1 = f1.split('/'); 
     var aFecha2 = f2.split('/'); 
     var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
     var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
     var dif = fFecha2 - fFecha1;
     var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
     return dias;
 }


// PROCESOS PARA CARGA DE ARCHIVOS =============================================

var iBytesUploaded = 0;
var iBytesTotal = 0;
var iPreviousBytesLoaded = 0;
var iMaxFilesize = 2097152; // 2MB
var oTimer = 0;
var sResultFileSize = '';

function secondsToTime(secs) { // we will use this function to convert seconds in normal time format
    var hr = Math.floor(secs / 3600);
    var min = Math.floor((secs - (hr * 3600))/60);
    var sec = Math.floor(secs - (hr * 3600) -  (min * 60));

    if (hr < 10) {hr = "0" + hr;}
    if (min < 10) {min = "0" + min;}
    if (sec < 10) {sec = "0" + sec;}
    if (hr) {hr = "00";}
    return hr + ':' + min + ':' + sec;
}

function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB'];
    if (bytes === 0) return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
}

// FIN DE PROCESOS PARA CARGA DE ARCHIVOS ======================================



function CrearID(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}