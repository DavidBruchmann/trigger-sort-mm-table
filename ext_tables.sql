CREATE TABLE tx_btp_domain_model_team (
	name varchar(255) NOT NULL DEFAULT '',
	expertise int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_btp_domain_model_expertise (
	title varchar(255) NOT NULL DEFAULT '',
	team int(11) unsigned NOT NULL DEFAULT '0'
);
