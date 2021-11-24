
INSERT INTO `inventory` (`ItemName`, `ItemCode`, `ItemImage`, `ItemQuantity`, `ItemPrice`) VALUES
                                                                                               ( 'Cola', '1001', '../Pictures/cola.png', 1000.00, 3.50),
                                                                                               ( 'Fanta', '1002' ,'../Pictures/Fanta.png', 2000.00, 3.50),
                                                                                               ( 'Fanta Blau', '1003', '../Pictures/FantaBlau.jpg', 500.00, 3.50),
                                                                                               ( 'Sprite', '1004', '../Pictures/Sprite.png', 800.00, 3.50),
( 'Snickers', '1005', '../Pictures/Snickers.jpg', 800.00, 3.50),
( 'Twix', '1006', '../Pictures/Twix.jpg', 800.00, 3.50),
( 'Koppers', '1007', '../Pictures/Knoppers.png', 800.00, 3.50);
COMMIT;

delete from inventory;


SELECT * from inventory;