<html>
<head>
<title>Lectura Archivo</title>
</head>
<body><?php 
 $entrada=fopen("datos.txt","r") or die("No se pudo abrir el archivo");
  while(!feof($entrada)){
	  $linea=fgets($entrada);
	  $lineasalto=nl2br($linea);
	  echo $lineasalto;
  }
  fclose($entrada);
?>
</body>
</html>