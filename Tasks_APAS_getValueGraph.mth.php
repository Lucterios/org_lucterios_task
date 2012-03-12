<?php
// 	This file is part of Diacamma, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// 	Thanks to have payed a retribution for using this module.
// 
// 	Diacamma is free software; you can redistribute it and/or modify
// 	it under the terms of the GNU General Public License as published by
// 	the Free Software Foundation; either version 2 of the License, or
// 	(at your option) any later version.
// 
// 	Diacamma is distributed in the hope that it will be useful,
// 	but WITHOUT ANY WARRANTY; without even the implied warranty of
// 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// 	GNU General Public License for more details.
// 
// 	You should have received a copy of the GNU General Public License
// 	along with Lucterios; if not, write to the Free Software
// 	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
// Method file write by SDK tool
// --- Last modification: Date 10 March 2011 0:31:44 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@

//@DESC@Representation graphique de la progression
//@PARAM@ 

function Tasks_APAS_getValueGraph(&$self)
{
//@CODE_ACTION@
/*$val_based=(int)(100.0*(float)$self->value/100.0);

$im = @imagecreate(100, 20);
$background = imagecolorallocate($im, 180, 180, 180);

$progresscolor = imagecolorallocate($im, 0, 150, 0);
imagerectangle($im,0,0,$val_based,20,$progresscolor);

$lettercolor = imagecolorallocate($im, 0, 0, 0);
$font_size=1;
$string=$self->value."%";
$text_width = imagefontwidth($font_size)*strlen($string);
ImageString($im, $font_size, 50-ceil($text_width/2), 10, $string, $lettercolor);

global $tmpPath;
$file_temp=tempnam($tmpPath,'imgtask');
imagepng($im,$file_temp);

$file_size = filesize($file_temp);
$handle = fopen($file_temp,'r');
$img = fread($handle,$file_size);
$img_base64 = chunk_split(base64_encode($img));
fclose($handle);

@unlink($file_temp);
return "data:image/*;base64,".$img_base64;*/

$val=(float)$self->value;
$val_based=ceil(25.0*$val/100.0);
$text=str_pad($self->value."% ",5,"#",STR_PAD_LEFT);
$text=str_replace('#','&#160;',$text);
$text.="{[bold]}{[font color='green']}".str_repeat('|',$val_based)."{[/font]}";
$text.="{[font color='white']}".str_repeat('|',25-$val_based)."{[/font]}{[/bold]} ";
$text_last=str_pad($self->timeLast."h",3,"#",STR_PAD_LEFT);
$text_last=str_replace('#','&#160;',$text_last);
$text.=$text_last;
return $text;
//@CODE_ACTION@
}

?>
