
INSERT INTO `inventory` (`ItemName`, `ItemCode`, `ItemImage`, `ItemQuantity`, `ItemPrice`) VALUES
( 'Cola', '1001', '../Pictures/cola.png', 1000.00, 3.50),
( 'Fanta', '1002' ,'../Pictures/Fanta.png', 2000.00, 3.50),
( 'Fanta Blau', '1003', '../Pictures/FantaBlau.jpg', 500.00, 3.50),
( 'Sprite', '1004', '../Pictures/Sprite.png', 800.00, 3.50);

COMMIT;

delete from inventory;