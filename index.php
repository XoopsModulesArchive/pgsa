<?php
include("header.php");
include(XOOPS_ROOT_PATH."/header.php");

include_once XOOPS_ROOT_PATH.'/class/module.errorhandler.php';
$myts =& MyTextSanitizer::getInstance();
$eh = new ErrorHandler;

function OpenRconSocket($host, $port, $pass, $query)
{
 $fp = fsockopen("udp://$host", $port, $errno, $errstr);
  if(!$fp)
  	{
    echo "$errstr ($errno)<br>\n";
  	} else {
  fwrite($fp, $query);
  socket_set_timeout($fp, 1);
  $data_returned = fread($fp, 1500);
  $data_stream=stream_get_meta_data($fp);
  if($data_stream > 0)
  fclose($fp);
  return $data_returned;
		}
	}



function PGSAFORM() {
global $xoopsDB;

OpenTable();

        //echo '<CENTER>';
 echo '<TABLE align="center" width="300">';
		echo '<TR>';
		echo '<TD width="100" align="left">';
		echo '<FONT Face=arial Size=2>'._MI_PGSA_SERVERCHOICE.'</FONT>';
		echo '</TD>';
		echo '<TD width="200" align="left">';

 echo "<form action='index.php' method='post'>";
  echo '<select name="server">';
$result = $xoopsDB->query("SELECT id_server, name_server, ip_server, port_server, password FROM ".$xoopsDB->prefix("pgsa_server")." ORDER BY id_server");
$myts =& MyTextSanitizer::getInstance();
 while ( list($server_id, $server_name, $server_ip, $server_port, $server_rconpassword) = $xoopsDB->fetchRow($result) ) {
                        $server_name = $myts->makeTboxData4Show($server_name);

                        $theserver = $server_name." (".$server_ip.":".$server_port.")";
						echo "<option value='".$server_id."'>".$theserver."</option>";
                }
						echo '</select>';
                        		echo '</TD>';
		echo '</TR>';
		echo '<TR>';
		echo '<TD width="100" align="left">';
		echo '<FONT Face=arial Size=2>'._MI_PGSA_COMMAND.'</FONT>';
		echo '</TD>';
		echo '<TD width="200" align="left">';
		echo '<INPUT Type=text Name="command" Size=25 VALUE="status">';
		echo '</TD>';
		echo '</TR>';
		echo '</TABLE>';

 		echo "<input type='hidden' name='fct' value='pgsa' /><input type='hidden' name='op' value='PGSASENDCOMMAND' /><input type='submit' value='"._MI_PGSA_GO."' />";
 CloseTable();
 echo '</form>';
}



function PGSASENDCOMMAND($server_id, $command) {
global $xoopsDB, $xoopsConfig;

OpenTable();


$result = $xoopsDB->query("SELECT id_server, name_server, ip_server, port_server, password FROM ".$xoopsDB->prefix("pgsa_server")." WHERE id_server=$server_id");
        list($server_id, $server_name, $server_ip, $server_port, $server_rconpassword) = $xoopsDB->fetchRow($result);
        $myts =& MyTextSanitizer::getInstance();

        $server_name = $myts->makeTboxData4Edit($server_name);
        $server_ip = $myts->makeTboxData4Edit($server_ip);
        $server_rconpassword = $myts->makeTboxData4Edit($server_rconpassword);


		$host = $server_ip;
		$port = $server_port;
		$pass = $server_rconpassword;

		$query = "\xFF\xFF\xFF\xFF\x02rcon $pass $command\n";
        $return_data = OpenRconSocket($host, $port, $pass, $query);


//if($command=="status"){
list($trash, $useable_data) = explode("print", $return_data);
//}
if($return_data){
echo "
<center>
<TEXTAREA ReadOnly cols=85 rows=20>$useable_data</TEXTAREA></CENTER>";
// "<FONT FACE=Arial SIZE=2>Server output:<BR>$return_data);</FONT>";
}
echo "<Center>";
echo "<form action='index.php' method='post'>";
echo "<input type='hidden' name='fct' value='pgsa' /><input type='hidden' name='op' value='PGSAFORM' /><input type='submit' value='"._MI_PGSA_RETURN."' />";
echo '</form>';
echo "</Center>";
CloseTable();

PGSALOG($server_name, $server_ip, $server_port, $command, $useable_data);

}

function PGSALOG($server_name, $server_ip, $server_port, $command, $useable_data) {
 global $xoopsDB, $eh, $myts, $xoopsUser;

   $server_name = $myts->makeTboxData4Save($server_name);
   $server_ip = $myts->makeTboxData4Save($server_ip);
   $command = $myts->makeTboxData4Save($command);
   $useable_data = $myts->makeTboxData4Save($useable_data);
if($xoopsUser) {
  $log_uname = $xoopsUser->uname();
}
$log_ip = getenv("REMOTE_ADDR");
$log_time = date("Y-m-d H:i:s ");
$log_server_name = $server_name." (".$server_ip.":".$server_port.")";
   $newid = $xoopsDB->genId($xoopsDB->prefix("pgsa_log")."_id_log_seq");
   $sql = sprintf("INSERT INTO %s (id_log, time_log, uname_log, ip_log, server_log, command_log, result_log) VALUES (%u, '%s', '%s', '%s', '%s', '%s', '%s')", $xoopsDB->prefix("pgsa_log"), $newid, $log_time, $log_uname, $log_ip, $log_server_name, $command, $useable_data);
   $xoopsDB->query($sql) or $eh->show("0013");


}

if(!isset($HTTP_POST_VARS['op'])) {
     $op = isset($HTTP_GET_VARS['op']) ? $HTTP_GET_VARS['op'] : 'PGSAFORM';
} else {
     $op = $HTTP_POST_VARS['op'];
}
switch($op) {
       case "PGSASENDCOMMAND":
                PGSASENDCOMMAND($_POST["server"], $_POST['command']);
                break;
        case "PGSAFORM":
                PGSAFORM();
                break;
        default:
                PGSAFORM();
                break;
}

include(XOOPS_ROOT_PATH."/footer.php");
?>