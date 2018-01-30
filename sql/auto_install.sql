DROP TABLE IF EXISTS `civicrm_termreport`;


-- /*******************************************************
-- *
-- * civicrm_civitermreport
-- *
-- * A Term report entry.
-- *
-- *******************************************************/
CREATE TABLE `civicrm_termreport` (
     `id` int unsigned NOT NULL AUTO_INCREMENT  COMMENT 'Renewal Term Report ID',
     `membership_id` varchar(255) NOT NULL   COMMENT 'Membership id from - civicrm_membership table.',
     `start_date` date NOT NULL   COMMENT 'Start Date',
     `end_date` date NOT NULL   COMMENT 'End Date',

    PRIMARY KEY ( `id` )
    ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;