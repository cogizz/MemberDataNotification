-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************

--
-- Table `tl_module`
--

CREATE TABLE `tl_module` (
  `mdn_member_fields` blob NOT NULL,
  `mdn_message` varchar(255) NOT NULL default '',
  `mdn_template` varchar(32) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;