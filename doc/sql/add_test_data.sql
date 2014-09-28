INSERT INTO shoppinglist_items
	( name, shop, price, bought)
	VALUES
	( 'Olut', 'LIDL', '2,99', 'true' ),
	( 'WC-paperi', '', '', 'false' ),
	( 'Hiiri', 'Verkkokauppa.com', '', 'false' ),
	( 'Hiirimatto', '', '10', 'false' );
	
INSERT INTO shoppinglist_shoppinglists
	(id, name, active, updated)
	VALUES
	( 1, 'Testilista', 'true', NOW());
	
INSERT INTO shoppinglist_items_to_lists_ref
	(itemid, shoppinglistid)
	VALUES
	(1, 1),
	(2, 1),
	(4, 1);
	
	
	