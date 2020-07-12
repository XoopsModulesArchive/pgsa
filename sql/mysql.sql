# phpMyAdmin SQL Dump
# version 2.5.3
# http://www.phpmyadmin.net
#
# Serveur: localhost
# Généré le : Mardi 23 Mars 2004 à 11:54
# Version du serveur: 4.0.15
# Version de PHP: 4.3.3
# 
# Base de données: `xoopsdev`
# 

# --------------------------------------------------------

#
# Structure de la table `xoops_pgsa_commandes`
#

CREATE TABLE `pgsa_commandes` (
  `id_server` int(5) NOT NULL default '0',
  `id_command` int(5) NOT NULL default '0',
  `groupid` int(5) NOT NULL default '0'
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `pgsa_ref_commandes`
#

CREATE TABLE `pgsa_ref_commandes` (
  `id_command` int(5) NOT NULL default '0',
  `name_command` varchar(100) NOT NULL default '',
  `valeur_command` varchar(100) NOT NULL default ''
) TYPE=MyISAM;

# --------------------------------------------------------


#
# Structure de la table `xoops_pgsa_server`
#

CREATE TABLE `pgsa_server` (
  `id_server` int(5) unsigned NOT NULL auto_increment,
  `name_server` varchar(100) NOT NULL default '',
  `ip_server` varchar(15) NOT NULL default '',
  `port_server` varchar(5) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `groupid` varchar(10) NOT NULL default '',
  KEY `id_server` (`id_server`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

# --------------------------------------------------------


#
# Structure de la table `xoops_pgsa_log`
#

CREATE TABLE `pgsa_log` (
  `id_log` int(5) NOT NULL auto_increment,
  `time_log` varchar(30) NOT NULL default '',
  `uname_log` varchar(25) NOT NULL default '',
  `ip_log` varchar(15) NOT NULL default '',
  `server_log` varchar(100) NOT NULL default '',
  `command_log` varchar(255) NOT NULL default '',
  `result_log` text NOT NULL,
  KEY `id_log` (`id_log`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

