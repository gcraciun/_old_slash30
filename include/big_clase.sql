CREATE TABLE big_clase (
  big_id int(3) unsigned NOT NULL auto_increment,
  clasa_b varchar(20) NOT NULL default '',
  descr varchar(50) NOT NULL default '',
  PRIMARY KEY  (big_id),
  UNIQUE KEY clasa (clasa_b)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

