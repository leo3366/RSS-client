<?php
/**
 *
 * @author Leonardo José Fernández Díaz.
 *
 * @version 15/10/2018
 */
session_start();
?>

<HTML>
<HEAD>
<TITLE>Unidad 2-Actividad obligatoria: lector RSS 2.0 de noticias</TITLE>
<link rel="stylesheet" type="text/css" href="estilos.css">
</HEAD>
<script type="text/javascript">
       function changeFunc() {
           document.getElementById("form").submit();
		}
  	</script>
<BODY>
	<center>
		<div id="principal">
			<div id="header">
				<b>Unidad 2-Actividad obligatoria: lector RSS 2.0 de noticias</b>
			</div>
			<br>
            <?php           
            if (isset($_SESSION["opcion"])) {
                switch ($_SESSION["opcion"]) {
                    case 0:
                        $filename = "https://www.neoteo.com/feed/";
                        break;
                    case 1:
                        $filename = "https://www.abc.es/rss/feeds/abc_ultima.xml";
                        break;
                    case 2:
                        $filename = "https://elpais.com/rss/elpais/portada.xml";
                        break;
                    case 3:
                        $filename = "https://hackaday.com/feed/";
                        break;
                    case 4:
                        $filename = "https://skatox.com/blog/feed/";
                        break;
                    case 5:
                        $filename = "http://rss.marca.com/rss/descarga.htm?data2=425";
                        break;
                    case 6:
                        $filename = "http://estaticos03.cache.el-mundo.net/elmundo/rss/portada.xml";
                        break;
                    case 7:
                        $filename = "http://www.aemet.es/es/rss/noticias.rss";
                        break;
                    case 8:
                        $filename = "https://www.cyberciti.biz/feed/";
                        break;                    
                }
            }
            ?>
          
            <form id="form" action="rss.php" method="post">
				<div id="formulario">
					Seleccione la fuente de noticias que desea leer: <select
						name="opciones" onchange="changeFunc();">
						<option value="">Seleccione una Fuente</option>
						<option value=0>Neo Teo</option>
						<option value=1>ABC</option>
						<option value=2>El Pais</option>
						<option value=3>Hackaday</option>
						<option value=4>Skatox</option>
						<option value=5>Marca</option>
						<option value=6>El Mundo</option>
						<option value=7>AEMET</option>
                        <option value=8>Nixcraft</option>
                       
					</select> <input type="submit" value="Leer Noticia">
				</div>
			</form>
            <?php

            if (isset($_SESSION['opcion'])) {
                /**
                 * *Creamos objeto DOM **
                 */
                $dom = new DOMDocument();
                /**
                 * * Leemos el archivop XML **
                 */
                $dom->load($filename);
                /**
                 * * Indicamos que se importe el archivo XML en formato SimpleXML **
                 */
                $elemento = simplexml_import_dom($dom);

                $n_item = $elemento->channel->item->count();
                echo "<div id= fuente>";
                echo "<a id='site' href='" . $elemento->channel->image->link .
                    "'><image id= 'logo' src=  " . $elemento->channel->image->url . "></image></a>";
                echo "<a id='enlaces' href='" . $elemento->channel->link . "'<h1 id='fuente-nom'>  ".
                    $elemento->channel->title . "</h1></a>";
                echo "<div style='clear:both'></div>";
                echo "</div><br>";

                for ($i = 0; $i < $n_item; $i ++) {
                    echo "<div id='titulo'><a id='enlaces' href='" . $elemento->channel->item[$i]->link .
                        "'>" . $elemento->channel->item[$i]->title . "</a><br><br></div>";
                    echo "<div id='contenido'>" . 
                     //   preg_replace("/<img.*>/","",$musica->channel->item[$i]->description);//evitamos que cargue imágenes dentro del contenido
                    $elemento->channel->item[$i]->description . "</div>";
                }
            }
            ?>
            <HR>
		</div>

</BODY>
</HTML>