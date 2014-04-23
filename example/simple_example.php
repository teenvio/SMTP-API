<?php
/**
 * @copyright Ipdea Land, S.L. / Teenvio
 *
 * LGPL v3 - GNU LESSER GENERAL PUBLIC LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU LESSER General Public License as published by
 * the Free Software Foundation, either version 3 of the License.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU LESSER General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *
 */

$fp = stream_socket_client("ssl://api.teenvio.com:46500", $errno, $errstr, 30);
if (!$fp) {
	echo "$errstr ($errno)<br />\n";
} else {
	echo "Conexión válida, saludo del SMTP:<br/>\n";

	$buffer = fgets($fp, 1024);
	echo $buffer."<br/>\n";

	echo "Contesto al saludo y su respuesta es:<br/>\n";

	fwrite($fp, "EHLO PruebaPHP\n");

	while (($buffer = fgets($fp, 1024)) !== false) {
		echo $buffer."<br/>\n";
		if(substr($buffer,0,4) == "250 ") break;
	}

	echo "Finalizo esta prueba<br/>\n";

	fwrite($fp, "QUIT\n");
	$buffer = fgets($fp, 1024);
	echo $buffer;

	fclose($fp);
}
?>