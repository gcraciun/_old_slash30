CREATE TABLE small_clase (
  small_id int(3) unsigned NOT NULL auto_increment,
  clasa_s varchar(20) NOT NULL default '',
  descr varchar(50) NOT NULL default '',
  parent int(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (small_id),
  UNIQUE KEY clasa_s (clasa_s)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

