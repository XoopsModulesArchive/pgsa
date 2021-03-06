<?php
// ------------------------------------------------------------------------- //
//                      PhpGamesServerAdmin for Xoops                        //
//                              Version:  1.0                                //
// ------------------------------------------------------------------------- //
// Author: Yoyo2021                                        				     //
// Purpose: PHP Games Serveur Admin                          				 //
// email: info@fpsquebec.net                                                 //
// URLs: http://www.fpsquebec.net                      //
//---------------------------------------------------------------------------//

$modversion['name'] = _MI_PGSA_NAME;
$modversion['version'] = 1.01;
$modversion['description'] = _MI_PGSA_DESC;
$modversion['credits'] = "Yoyo2021 (info@fpsquebec.net)";
$modversion['author'] = "Ecrit pour Xoops2<br />par Yoyo2021<br />http://www.fpsquebec.net";
$modversion['license'] = "";
$modversion['official'] = 1;
$modversion['image'] = "images/pgsa_slogo.png";
$modversion['help'] = "";
$modversion['dirname'] = "pgsa";

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
//$modversion['sqlfile']['postgresql'] = "sql/pgsql.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = "pgsa_commandes";
$modversion['tables'][1] = "pgsa_ref_commandes";
$modversion['tables'][2] = "pgsa_server";
$modversion['tables'][3] = "pgsa_log";
// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Menu
$modversion['hasMain'] = 1;

?>