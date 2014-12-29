INSERT INTO shoppinglist_items
	( name, shop, price, buyerID, bought)
	VALUES
	( 'Olut', 		'LIDL', 			'2,99', '1',	'true'  ), 
	( 'WC-paperi', 	'', 				'', 	NULL	'false' ),
	( 'Hiiri', 		'Verkkokauppa.com', '', 	NULL	'false' ),
	( 'Hiirimatto', '', 				'10', 	NULL	'false' ),
	( 'Pesuaine', 	'', 				'', 	NULL	'false' );
	
INSERT INTO shoppinglist_shoppinglists
	(name, active, updated)
	VALUES
	( 'Testilista', 'true', NOW()),
	( 'Kakkoslista', 'true', NOW());
	
INSERT INTO shoppinglist_items_to_lists_ref
	(itemid, shoppinglistid)
	VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 2),
	(5, 2);
	
INSERT INTO shoppinglist_users
	(username, email, password, salt)
	VALUES
	('testi', 'testi@elmnainen.fi', '9ef6fa5a4f0659ec6861d926b671afae374ac54e7f5be3a77c8ee18fc1133745', '32fff52e3ca25dd0');
	
INSERT INTO shoppinglist_owners_to_lists_ref
	(userid, shoppinglistid)
	VALUES
	(1, 1),
	(1, 2);
	
	
	