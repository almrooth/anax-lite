SHOW DATABASES;
USE toab16;

SET NAMES utf8;

SHOW TABLES;

-- Tables
DROP TABLE IF EXISTS `InventoryLog`;
DROP TABLE IF EXISTS `Inventory`;
DROP TABLE IF EXISTS `ShoppingCart`;
DROP TABLE IF EXISTS `Orders`;
DROP TABLE IF EXISTS `Product`;

-- Product & category
CREATE TABLE `Product` (
    `id` INT AUTO_INCREMENT,
	`category` VARCHAR(30),
    `name` VARCHAR(20),
    `description` VARCHAR(100),
    `image` VARCHAR(20),
    `price` DECIMAL(6, 2),

    PRIMARY KEY (`id`)
);

-- Inventory
CREATE TABLE `Inventory` (
    `id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `items` INT,

    PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`)
);

-- Shopping cart

CREATE TABLE `ShoppingCart` (
	`id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `items` INT,
    
    PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`)
);

-- Order

CREATE TABLE `Orders` (
	`id` INT AUTO_INCREMENT,
    `order_id` INT,
    `prod_id` INT,
    `items` INT,
    
    PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`)
);

-- InventoryLog

CREATE TABLE `InventoryLog` (
	`id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `what` VARCHAR(20),
    `when` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`)
);

-- Add data ------------------------------------------------------------

INSERT INTO Product VALUES (null, "Fruit", "Apple", "Red apple", "apple.jpg", 10);
INSERT INTO Product VALUES (null, "Fruit", "Apricot", "Delicious apricot", "apricot.jpg", 15);
INSERT INTO Product VALUES (null, "Fruit", "Bananas", "A bunch of bananas", "banana.jpg", 20);
INSERT INTO Product VALUES (null, "Fruit", "Kiwi", "Kiwi from New Zeeland", "kiwi.jpg", 5);
INSERT INTO Product VALUES (null, "Fruit", "Lemon", "Lemon of sunshine", "lemon.jpg", 12);
INSERT INTO Product VALUES (null, "Fruit", "Peach", "A big peach", "peach.jpg", 10);
INSERT INTO Product VALUES (null, "Nuts", "Peanuts", "A bag of peanuts", "peanuts.jpg", 30);
INSERT INTO Product VALUES (null, "Nuts", "Walnuts", "A bag of walnuts", "walnuts.jpg", 50); 

INSERT INTO Inventory VALUES (null, 1, 10);
INSERT INTO Inventory VALUES (null, 2, 10);
INSERT INTO Inventory VALUES (null, 3, 10);
INSERT INTO Inventory VALUES (null, 4, 10);
INSERT INTO Inventory VALUES (null, 5, 10);
INSERT INTO Inventory VALUES (null, 6, 10);
INSERT INTO Inventory VALUES (null, 7, 10);
INSERT INTO Inventory VALUES (null, 8, 10);

-- Product view -------------------------------------------------------

DROP VIEW IF EXISTS VProducts;

CREATE VIEW `VProducts` AS
SELECT
	P.id,
	P.name,
    P.image,
    P.description,
    P.category,
    P.price,
    I.items,
    ProdStatus(P.id) AS status
FROM Product AS P
	INNER JOIN Inventory AS I
		ON I.prod_id = P.id
ORDER BY P.id;

SELECT * FROM VProducts;

-- -----------------------

DROP PROCEDURE IF EXISTS viewProducts;

DELIMITER //

CREATE PROCEDURE viewProducts()
BEGIN
	SELECT * FROM VProducts;
END

//

DELIMITER ;

-- Products -------------------------------------------------------------

-- Get product

DROP PROCEDURE IF EXISTS getProduct;

DELIMITER //

CREATE PROCEDURE getProduct (
	get_Id INT
)
BEGIN
	SELECT * FROM VProducts WHERE id = get_Id;
END

//

DELIMITER ;

-- Delete product ----------------------------------------

DROP PROCEDURE IF EXISTS deleteProduct;

DELIMITER //

CREATE PROCEDURE deleteProduct (
	del_Id INT
)
BEGIN
    DELETE FROM Inventory WHERE prod_id = del_id;
	DELETE FROM Product WHERE id = del_Id;
END

//

DELIMITER ;

-- Add product ----------------------------------------

DROP PROCEDURE IF EXISTS addProduct;

DELIMITER //

CREATE PROCEDURE addProduct (
	name VARCHAR(20)
)
BEGIN
    INSERT INTO Product VALUES (null, "Fruit", name, "description", "default.jpg", 0);
	
    SET @id = (SELECT MAX(id) FROM Product);
    
    INSERT INTO Inventory VALUES (null, @id, 0);
END

//

DELIMITER ;

-- Edit product -----------------------------------------

DROP PROCEDURE IF EXISTS editProduct;

DELIMITER //

CREATE PROCEDURE editProduct (
	edit_id INT,
	new_name VARCHAR(20),
    new_category VARCHAR(30),
    new_description VARCHAR(100),
    new_image VARCHAR(20),
    new_price DECIMAL(6, 2),
    new_items INT    
)
BEGIN
    UPDATE Product SET
		category = new_category,
		name = new_name,
        description = new_description,
        image = new_image,
        price = new_price
	WHERE id = edit_id;
    
    UPDATE Inventory SET
		items = new_items
	WHERE prod_id = edit_id;
END

//

DELIMITER ;

-- Functions -----------------------------------------------------------------

DROP FUNCTION IF EXISTS ProdStatus;

DELIMITER //

CREATE FUNCTION ProdStatus (
	check_id INT
)
RETURNS VARCHAR(10)
BEGIN
	DECLARE items_left INT;
	SET items_left = (SELECT items FROM Inventory WHERE prod_id = check_id);
    
	IF items_left > 5 THEN
		RETURN "available";
	ELSEIF items_left > 0 AND items_left <= 5 THEN
		RETURN "low stock";
	END IF;
    RETURN "sold out";
END

//

DELIMITER ;

-- Shopping cart -----------------------------------------------

-- Add to shopping cart

DROP PROCEDURE IF EXISTS addToShoppingCart;

DELIMITER //

CREATE PROCEDURE addToShoppingCart (
	add_id INT,
    add_items INT
)
BEGIN
	    
    IF EXISTS (SELECT * FROM ShoppingCart WHERE prod_id = add_id) THEN
		UPDATE ShoppingCart
        SET
			items = items + add_items
		WHERE prod_id = add_id;
	ELSE 
		INSERT INTO ShoppingCart VALUES (null, add_id, add_items);
	END IF;

END

//

DELIMITER ;

-- CALL addToShoppingCart(3, 5);
-- SELECT * FROM ShoppingCart;

-- Delete from Shopping cart ----------------------------------------

DROP PROCEDURE IF EXISTS deleteFromShoppingCart;

DELIMITER //

CREATE PROCEDURE deleteFromShoppingCart (
	del_id INT,
    del_items INT
)
BEGIN
	    
    IF EXISTS (SELECT prod_id FROM ShoppingCart) THEN
		IF (SELECT items FROM ShoppingCart WHERE prod_id = del_id) <= del_items THEN
			DELETE FROM ShoppingCart WHERE prod_id = del_id;
		ELSE
			UPDATE ShoppingCart
            SET
				items = items - del_items
			WHERE prod_id = del_id;
		END IF;
	END IF;
END

//

DELIMITER ;

-- CALL deleteFromShoppingCart(1, 2);

-- View Shopping Cart --------------------------------------

DROP VIEW IF EXISTS VShoppingCart;

CREATE VIEW `VShoppingCart` AS
SELECT 
	P.name AS Product,
    P.price AS Price_p_prod,
    S.items AS Quantity,
    S.items * P.price AS Price_total
FROM ShoppingCart AS S 
	INNER JOIN Product AS P 
		ON P.id = S.prod_id
ORDER BY P.name;

SELECT * FROM VShoppingCart;

-- 

DROP PROCEDURE IF EXISTS viewShoppingCart;

DELIMITER //

CREATE PROCEDURE viewShoppingCart()
BEGIN
	SELECT * FROM VShoppingCart;
END

//

DELIMITER ;

-- Order ---------------------------------------------------------

DROP PROCEDURE IF EXISTS makeOrder;

DELIMITER //

CREATE PROCEDURE makeOrder ()
BEGIN

	DECLARE p_id INT;
    DECLARE p_items INT;
    DECLARE p_order_id INT DEFAULT 1;
    
    DECLARE done BOOLEAN DEFAULT 0;
    DECLARE cur CURSOR 
    FOR
	SELECT prod_id FROM ShoppingCart;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done=1;
    
    START TRANSACTION;
		IF EXISTS (SELECT * FROM Orders) THEN
			SET p_order_id = (SELECT MAX(order_id) FROM Orders) + 1;
		END IF;
			
		OPEN cur;
		cur_loop: LOOP
			FETCH cur INTO p_id;
			
			IF done THEN
				LEAVE cur_loop;
			END IF;
			
			SET p_items = (SELECT items FROM ShoppingCart WHERE prod_id = p_id);
			
			INSERT INTO Orders(order_id, prod_Id, items) VALUES (p_order_id, p_id, p_items);
            
            UPDATE Inventory
            SET
				items = items - p_items
			WHERE
				prod_id = p_id;
		
		END LOOP cur_loop;
		CLOSE cur;
		
		DELETE FROM ShoppingCart;
    
    COMMIT;    
END;

//

DELIMITER ;

-- Delete order --------------------------------------------------

DROP PROCEDURE IF EXISTS deleteOrder;

DELIMITER //

CREATE PROCEDURE deleteOrder(
	del_id INT
)
BEGIN
	DELETE FROM Orders WHERE order_id = del_id;
END

//

DELIMITER ;

-- Orders view ----------------------------------------------------

DROP VIEW IF EXISTS VOrders;

CREATE VIEW `VOrders` AS
SELECT 
	O.order_id AS Order_ID,
    P.name AS Product,
    O.items AS Quantity,
    P.price * O.items AS Price
FROM Orders AS O
	INNER JOIN Product AS P
		ON P.id = O.prod_id
ORDER BY O.order_id;

-- -------------------

DROP PROCEDURE IF EXISTS viewOrders;

DELIMITER //

CREATE PROCEDURE viewOrders()
BEGIN
	SELECT * FROM VOrders;
END

//

DELIMITER ;

-- View 1 order -------------------------------------------------

DROP PROCEDURE IF EXISTS viewOrder;

DELIMITER //

CREATE PROCEDURE viewOrder(
	v_id INT
)
BEGIN
	SELECT * FROM VOrders WHERE Order_ID = v_id;
END

//

DELIMITER ;

-- Trigger ---------------------------------------------------

-- InventoryLog

DROP TRIGGER IF EXISTS LogInventoryUpdate;

DELIMITER //

CREATE TRIGGER LogInventoryUpdate
AFTER UPDATE
ON Inventory FOR EACH ROW
	IF NEW.items < 5 THEN
		INSERT INTO InventoryLog(what, prod_id) VALUES ("time to restock", NEW.prod_id);
	END IF;
    
//
    
DELIMITER ;

-- Inventory order report--------------------------------------------

DROP PROCEDURE IF EXISTS getInventoryLog;

DELIMITER //

CREATE PROCEDURE getInventoryLog()
BEGIN
	SELECT 
		IL.when AS Time,
        IL.what AS Notice,
        P.name AS Product,
        I.items AS Left_in_stock
	FROM InventoryLog AS IL
		INNER JOIN Product AS P
			ON P.id = IL.prod_id
		INNER JOIN Inventory AS I
			ON I.prod_id = IL.prod_id
	ORDER BY IL.when;
END

//

DELIMITER ;