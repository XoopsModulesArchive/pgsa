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

CREATE TABLE `xoops_pgsa_commandes` (
  `id_server` int(5) NOT NULL default '0',
  `id_command` int(5) NOT NULL default '0',
  `groupid` int(5) NOT NULL default '0'
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `xoops_pgsa_ref_commandes`
#

CREATE TABLE `xoops_pgsa_ref_commandes` (
  `id_command` int(5) NOT NULL default '0',
  `name_command` varchar(100) NOT NULL default '',
  `valeur_command` varchar(100) NOT NULL default ''
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `xoops_pgsa_server`
#

CREATE TABLE `xoops_pgsa_server` (
  `id_server` int(5) NOT NULL default '0',
  `name_server` varchar(100) NOT NULL default '',
  `ip_server` varchar(15) NOT NULL default '',
  `port_server` varchar(5) NOT NULL default '',
  `groupid` varchar(10) NOT NULL default ''
) TYPE=MyISAM;
