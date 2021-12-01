
INSERT INTO `inventory` (`ItemName`, `ItemCode`, `ItemImage`, `ItemQuantity`, `ItemPrice`) VALUES
('Ramune', '1001','../Pictures/Ramune.jpg', 1000, 3.50),
('Fanta-Berry', '1002','../Pictures/fantaBerry.jpg', 2000, 2.50),
('Fanta-Cassis', '1003','../Pictures/fantaCassis.jpg', 2500, 2.50),
('MountainDew-Major-Melon', '1004','../Pictures/mountainDewMajorMelon.jpg', 3000, 2.50),
('Sprite-Cranberry', '1005','../Pictures/spriteCranberry.jpg', 2500, 2.50),
('Ananaskuchen', '1006','../Pictures/ananasKuchen.jpg', 200, 4.50),
('Haribo-Watermelon', '1007','../Pictures/HariboWatermelon.png', 400, 3.50),
('KitKat-fruity-Cereal', '1008','../Pictures/kitkatfruitycereal.jpg', 500, 3.50),
('Pocky-Strawberry', '1009','../Pictures/pockystrawberry.jpg', 800, 3.50),
('Takis-fuego', '1010','../Pictures/TakisFuego.png', 1000, 3.50);
COMMIT;

SELECT * from inventory;

delete from inventory