CREATE TABLE shoppinglist_users(
	id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	salt VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
	) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
	
CREATE TABLE shoppinglist_shoppinglists(
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	active ENUM('true', 'false') NOT NULL,
	updated TIMESTAMP NOT NULL,
	PRIMARY KEY (id)
	) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
	
CREATE TABLE shoppinglist_owners_to_lists_ref(
	userid INT NOT NULL,
	shoppinglistid INT NOT NULL,
	PRIMARY KEY (userid, shoppinglistid),
	FOREIGN KEY (userid) 
		REFERENCES shoppinglist_users(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (shoppinglistid) 
		REFERENCES shoppinglist_shoppinglists(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
	) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
	
CREATE TABLE shoppinglist_collaborators_to_lists_ref(
	userid INT NOT NULL,
	shoppinglistid INT NOT NULL,
	PRIMARY KEY (userid, shoppinglistid),
	FOREIGN KEY (userid) REFERENCES shoppinglist_users(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (shoppinglistid) REFERENCES shoppinglist_shoppinglists(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
	) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
	
CREATE TABLE shoppinglist_items(
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	shop VARCHAR(255),
	price INT,
	buyer INT,
	bought ENUM('true', 'false') NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (buyer) 
		REFERENCES shoppinglist_users(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
	)DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
	
CREATE TABLE shoppinglist_items_to_lists_ref(
	itemid INT NOT NULL,
	shoppinglistid INT NOT NULL,
	PRIMARY KEY (itemid, shoppinglistid),
	FOREIGN KEY (itemid) 
		REFERENCES shoppinglist_items(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (shoppinglistid) 
		REFERENCES shoppinglist_shoppinglists(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
	)DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
	