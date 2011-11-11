<?php
// 	This file is part of Lucterios/Diacamma, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// 	Thanks to have payed a retribution for using this module.
// 
// 	Lucterios/Diacamma is free software; you can redistribute it and/or modify
// 	it under the terms of the GNU General Public License as published by
// 	the Free Software Foundation; either version 2 of the License, or
// 	(at your option) any later version.
// 
// 	Lucterios/Diacamma is distributed in the hope that it will be useful,
// 	but WITHOUT ANY WARRANTY; without even the implied warranty of
// 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// 	GNU General Public License for more details.
// 
// 	You should have received a copy of the GNU General Public License
// 	along with Lucterios; if not, write to the Free Software
// 	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY// Method file write by SDK tool
// --- Last modification: Date 10 November 2011 4:36:26 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Project.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ 

function Project_APAS_getValue(&$self)
{
//@CODE_ACTION@
$last=(float)$self->timeLast;
$total=(float)$self->timeTotal;
$val=ceil(10000*($total-$last)/$total)/100;
$val_based=ceil(25.0*$val/100.0);
$text=str_pad($val."% ",5,"#",STR_PAD_LEFT);
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
