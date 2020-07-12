<?php

include '../../../include/cp_header.php';
if ( file_exists("../language/".$xoopsConfig['language']."/main.php") ) {
	include "../language/".$xoopsConfig['language']."/main.php";
} else {
	include "../language/french/main.php";
}

include_once XOOPS_ROOT_PATH.'/class/module.errorhandler.php';
$myts =& MyTextSanitizer::getInstance();
$eh = new ErrorHandler;

function PGSAAdmin() {
        global $xoopsDB, $xoopsConfig, $xoopsModule;
        xoops_cp_header();
        OpenTable();

        echo "<big><b>"._AM_PGSA_TITLE."</big></b>";

        echo "<h4 style='text-align:left;'>"._AM_PGSA_ADDMENUITEM."</h4>
        <form action='addserver.php' method='post'>
        <table border='0' cellpadding='0' cellspacing='0' valign='top' width='100%'>
        <tr>
        <td class='bg2'>
                <table width='100%' border='0' cellpadding='4' cellspacing='1'>
                <tr>
                <td class='bg3'><b>"._AM_PGSA_NAME."</b></td>
                <td class='bg1'><input type='text' name='server_name' size='50' maxlength='60' /></td>
                </tr>
                <tr>
                <td class='bg3'><b>"._AM_PGSA_IP."</b></td>
                <td class='bg1'><input type='text' name='server_ip' size='50' maxlength='60'/></td>
                </tr>
                <tr>
                <td class='bg3'><b>"._AM_PGSA_PORT."</b></td>
                <td class='bg1'><input type='text' name='server_port' size='5' maxlength='5'/>(0:65535)</td>
                </tr>
                <tr>
                <td class='bg3'><b>"._AM_PGSA_RCONPASSWORD."</b></td>
                <td class='bg1'><input type='password' name='server_rconpassword' size='50' maxlength='60'/>
                </td>
                </tr>

                <tr>
                <td class='bg3'>&nbsp;</td>
                <td class='bg1'><input type='hidden' name='fct' value='pgsa' /><input type='hidden' name='op' value='PGSAAdd' /><input type='submit' value='"._AM_PGSA_ADD."' /></td>
                </tr>
                </table>
        </td>
        </tr>
        </table>
        </form>
        <br />";

        //*********** List server ******************************************************

       echo "<h4 style='text-align:left;'>"._AM_PGSA_CHANGEMENUITEM."</h4>
        <form action='addserver.php' method='post'>
        <table border='0' cellpadding='0' cellspacing='0' valign='top' width='100%'>
        <tr>
        <td class='bg2'>
                <table width='100%' border='0' cellpadding='4' cellspacing='1'>
                <tr class='bg3'>
                <td><b>"._AM_PGSA_ID."</b></td>
                <td><b>"._AM_PGSA_NAME."</b></td>
                <td><b>"._AM_PGSA_IP."</b></td>
                <td><b>"._AM_PGSA_PORT."</b></td>
                <td><b>"._AM_PGSA_RCONPASSWORD."</b></td>
                <td><b>"._AM_PGSA_FUNCTION."</b></td>";
                $result = $xoopsDB->query("SELECT id_server, name_server, ip_server, port_server, password FROM ".$xoopsDB->prefix("pgsa_server")." ORDER BY id_server");
                $myts =& MyTextSanitizer::getInstance();
                while ( list($server_id, $server_name, $server_ip, $server_port, $server_rconpassword) = $xoopsDB->fetchRow($result) ) {
                        $server_name = $myts->makeTboxData4Show($server_name);
                        $server_ip = $myts->makeTboxData4Show($server_ip);
                        $server_rconpassword = $myts->makeTboxData4Show($server_rconpassword);
                        echo "<tr class='bg1'><td align='right'>$server_id</td>";

                        echo "<td>$server_name</td>";
                        echo "<td>$server_ip</td>";
                        echo "<td>$server_port</td>";
                        echo "<td>$server_rconpassword</td>";
                echo "<td><a href='addserver.php?op=PGSAEdit&server_id=$server_id'>"._AM_PGSA_EDIT."</a> | <a href='addserver.php?op=PGSADel&amp;server_id=$server_id&amp;ok=0'>"._AM_PGSA_DELETE."</a></td>
                </tr>";
                }
                echo "</table>
        </td>
        </tr>
        </table>
        </form>";

        CloseTable();
}

function PGSAEdit($server_id) {
        global $xoopsDB, $xoopsConfig, $xoopsModule;
        xoops_cp_header();
        $result = $xoopsDB->query("SELECT id_server, name_server, ip_server, port_server, password FROM ".$xoopsDB->prefix("pgsa_server")." WHERE id_server=$server_id");
        list($server_id, $server_name, $server_ip, $server_port, $server_rconpassword) = $xoopsDB->fetchRow($result);
        $myts =& MyTextSanitizer::getInstance();

        $server_name = $myts->makeTboxData4Edit($server_name);
        $server_ip = $myts->makeTboxData4Edit($server_ip);
        $server_rconpassword = $myts->makeTboxData4Edit($server_rconpassword);

        OpenTable();
        echo "<big><b>"._AM_PGSA_TITLE."</big></b>
        <h4 style='text-align:left;'>"._AM_PGSA_EDITMENUITEM."</h4>
        <form action='addserver.php' method='post'>
        <input type='hidden' name='server_id' value='$server_id' />
        <table border='0' cellpadding='0' cellspacing='0' valign='top' width='100%'>
        <tr>
        <td class='bg2'>
                <table width='100%' border='0' cellpadding='4' cellspacing='1'>
                <tr>
                <td class='bg3'><b>"._AM_PGSA_NAME."</b></td>
                <td class='bg1'><input type='text' name='server_name' size='50' maxlength='60' value='$server_name' /></td>
                </tr>
                <tr>
                <td class='bg3'><b>"._AM_PGSA_IP."</b></td>
                <td class='bg1'><input type='text' name='server_ip' size='50' maxlength='60' value='$server_ip' /></td>
                </tr>
                <tr>
                <td class='bg3'><b>"._AM_PGSA_PORT."</b></td>
                <td class='bg1'><input type='text' name='server_port' size='5' maxlength='5' value='$server_port' />(0:65535)</td>
                </tr>
                <tr>
                <td class='bg3'><b>"._AM_PGSA_RCONPASSWORD."</b></td>
                <td class='bg1'><input type='password' name='server_rconpassword' size='50' maxlength='60' value='$server_rconpassword'></td>
                </tr>


                <tr>
                <td class='bg3'>&nbsp;</td>
                <td class='bg1'><input type='hidden' name='fct' value='pgsa' /><input type='hidden' name='op' value='PGSASave' /><input type='submit' value='"._AM_PGSA_SAVECHANG."' /></td>
                </tr>
                </table>
        </td>
        </tr>
        </table>

        </form>";

        CloseTable();
}

function PGSASave($server_id, $server_name, $server_ip, $server_port, $server_rconpassword) {
        global $xoopsDB;
        $myts =& MyTextSanitizer::getInstance();

        $server_name = $myts->makeTboxData4Save(trim($server_name));
   		$server_ip = $myts->makeTboxData4Save(trim($server_ip));
   		$server_rconpassword = $myts->makeTboxData4Save(trim($server_rconpassword));

        $xoopsDB->query("UPDATE ".$xoopsDB->prefix("pgsa_server")." SET name_server='$server_name', ip_server='$server_ip', port_server='$server_port',password='$server_rconpassword' WHERE id_server=$server_id");
        redirect_header("addserver.php?op=PGSAAdmin",1,_AM_PGSA_DBUPDATED);
        exit();
}

function PGSAAdd($server_name, $server_ip, $server_port, $server_rconpassword) {
   global $xoopsDB, $eh, $myts;
   $server_name = $myts->makeTboxData4Save($server_name);
   $server_ip = $myts->makeTboxData4Save($server_ip);
   $server_rconpassword = $myts->makeTboxData4Save($server_rconpassword);
   $newid = $xoopsDB->genId($xoopsDB->prefix("pgsa_server")."_id_server_seq");
   $sql = sprintf("INSERT INTO %s (id_server, name_server, ip_server, port_server, password) VALUES (%u, '%s', '%s', %u, '%s')", $xoopsDB->prefix("pgsa_server"), $newid, $server_name, $server_ip, $server_port, $server_rconpassword);
   $xoopsDB->query($sql) or $eh->show("0013");
   // Si y'a pas d'erreurs ds la requete ci dessus, on redirige vers la page d'accueil ADMIN
   redirect_header("addserver.php?op=PGSAAdmin",1,_AM_PGSA_DBUPDATED);
   exit();
}



function PGSADel($server_id, $ok=0) {
        global $xoopsDB, $xoopsConfig, $xoopsModule;
        if ( $ok == 1 ) {
                $xoopsDB->queryF("DELETE FROM ".$xoopsDB->prefix("pgsa_server")." WHERE id_server=$server_id");
                redirect_header("addserver.php?op=PGSAAdmin",1,_AM_PGSA_DBUPDATED);
                exit();
        } else {
                xoops_cp_header();
                OpenTable();
                $result = $xoopsDB->query("SELECT name_server, ip_server, port_server, password FROM ".$xoopsDB->prefix("pgsa_server")." WHERE id_server=$server_id");
                list($server_name, $server_ip, $server_port, $server_rconpassword) = $xoopsDB->fetchRow($result);
                echo "<big><b>"._AM_PGSA_TITLE."</big></b>";
                echo "<h4 style='text-align:left;'>"._AM_PGSA_DELETEMENUITEM."</h4>
                <form action='addserver.php' method='post'>
                <input type='hidden' name='server_id' value='$server_id' />
                <table border='0' cellpadding='0' cellspacing='0' valign='top' width='100%'>
                        <tr>
                        <td class='bg2'>
                        <table width='100%' valign='top' border='0' cellpadding='4' cellspacing='1'>
                                <tr>
                                <td class='bg3' width='30%'><b>"._AM_PGSA_NAME."</b></td>
                                <td class='bg1'>".$server_name."</td>
                                </tr>
                                <tr>
                                <td class='bg3'><b>"._AM_PGSA_IP."</b></td>
                                <td class='bg1'>".$server_ip."</td>
                                </tr>
                                <tr>
                                <td class='bg3'><b>"._AM_PGSA_PORT."</b></td>
                                <td class='bg1'>".$server_port."</td>
                                </tr>
                                <tr>
                                <td class='bg3'><b>"._AM_PGSA_RCONPASSWORD."</b></td>
                                <td class='bg1'>".$server_rconpassword."</td>
                                </tr>
                        </table>
                        </td>
                        </tr>
                </table>
                </form>";
                echo "<table valign='top'><tr>";
                echo "<td width='30%'valign='top'><span style='color:#ff0000;'><b>"._AM_PGSA_WANTDEL."</b></span></td>";
                echo "<td width='3%'>\n";
                echo myTextForm("addserver.php?op=PGSADel&server_id=$server_id&ok=1", _AM_PGSA_YES);
                echo "</td><td>\n";
                echo myTextForm("addserver.php?op=PGSAAdmin", _AM_PGSA_NO);
                echo "</td></tr></table>\n";
                CloseTable();
        }
}

if(!isset($HTTP_POST_VARS['op'])) {
    $op = isset($HTTP_GET_VARS['op']) ? $HTTP_GET_VARS['op'] : 'main';
} else {
    $op = $HTTP_POST_VARS['op'];
}
foreach( $_REQUEST as $a => $b)
{
  $$a = $b;
}
switch($op) {
       case "PGSADel":
                PGSADel($server_id, $ok);
                break;
        case "PGSAAdd":
                PGSAAdd($server_name, $server_ip, $server_port, $server_rconpassword);
                break;
        case "PGSASave":
                PGSASave($server_id, $server_name, $server_ip, $server_port, $server_rconpassword);
                break;
        case "PGSAAdmin":
                PGSAAdmin();
                break;
        case "PGSAEdit":
                PGSAEdit($server_id);
                break;
        default:
                PGSAAdmin();
                break;
}
xoops_cp_footer();
?>