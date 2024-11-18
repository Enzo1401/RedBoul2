create database redboul;

create table users(
    id_users int primary key auto_increment,
    nom varchar(50) not null,
    prenom varchar(50) not null,
    passwords varchar(50) not null,
    email varchar(100) not null,
    adresse varchar(255) not null,
    id_role INT,
    FOREIGN KEY (id_role) REFERENCES roles(id_role)
 );

create table roles (
    id_roles INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(50) NOT NULL
);


create table produit(
    id_produit int primary key auto_increment,
    nom varchar(50) not null,
    prix decimal(10,2) not null,
    descriptions text not null,
    images varchar(255) not null,
    stock int not null
);

create table commandes(
    id_commandes int primary key auto_increment,
    id_produit int not null,
    quantite int not null,
    date_commande date not null,
    commentaire text not null,
    foreign key (id_produit) references produit(id_produit)
);

CREATE TABLE produit_log(
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    id_produit INT,
    nom VARCHAR(50),
    prix decimal(10,2) not null,
    date_suppression TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_produit) REFERENCES produit(id_produit)  
);

insert into produit (nom, prix, descriptions,images,stock) values 
('Redbull Sea blue Edition', 2.50, 'Description for Sea blue Edition', 'image/blueEdition.png', 10),
('Redbull Green Edition', 2.50, 'Description for Green Edition', 'image/greenEdition.png', 10),
('Redbull Red Edition', 2.50, 'Description for Red Edition', 'image/redEdition.png', 10),
('Redbull White Edition', 2.50, 'Description for White Edition', 'image/whiteEdition.png', 10);

-- Insérer les rôles "Administrateur" et "Utilisateur"
INSERT INTO roles (role_name) VALUES 
('Administrateur'),
('Utilisateur');


INSERT INTO users (nom, prenom, passwords, email, adresse, id_role) 
VALUES ('admin', 'admin', '1234', 'admin@gmail.com', 'rue du loulou', 1); -- 1 pour Administrateur, 2 pour Utilisateur

-----------------------REQUETE SQL-----------------------


insert into produit (nom, prix, descriptions,images,stock) values 
(?,?,?,?,?);

select * from produit;
insert into users(nom, prenom, passwords, email,adresse)VALUES(
    'flahaut','axel','aaa','aaa@gmail.com','aa');


delete from produit where nom= ?; 

update set produit stock = stock + ? where nom =?;


DELIMITER //

CREATE PROCEDURE passer_commande(
    IN p_id_users INT,
    IN p_id_produit INT,
    IN p_quantite INT,
    IN p_date_commande DATE
)
BEGIN
    -- Insérer la commande dans la table commandes
    INSERT INTO commandes (id_users, id_produit, quantite, date_commande)
    VALUES (p_id_users, p_id_produit, p_quantite, p_date_commande);

    -- Mettre à jour le stock du produit
    UPDATE produit
    SET stock = stock - p_quantite
    WHERE id_produit = p_id_produit;
END //

DELIMITER ;

DELIMITER //

CREATE TRIGGER update_stock_after_order
AFTER INSERT ON commandes
FOR EACH ROW
BEGIN
    -- Mettre à jour le stock du produit
    UPDATE produit
    SET stock = stock - NEW.quantite
    WHERE id_produit = NEW.id_produit;
END //

DELIMITER ;


DELIMITER //

CREATE TRIGGER check_stock_before_insert
BEFORE INSERT ON commandes
FOR EACH ROW
BEGIN
    DECLARE current_stock INT;

    -- Récupérer le stock actuel du produit
    SELECT stock INTO current_stock 
    FROM produit 
    WHERE id_produit = NEW.id_produit;

    -- Vérifier si le stock est suffisant
    IF current_stock < NEW.quantite THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Stock insuffisant pour ce produit';
    END IF;
END //

DELIMITER ;


INSERT INTO users (id_users, nom, email) VALUES (1, 'Nom Utilisateur', 'email@example.com');


CALL passer_commande(1, 1, 2, '2023-10-01');

DELIMITER //

CREATE TRIGGER log_suppression_produit
AFTER DELETE ON produit
FOR EACH ROW
BEGIN
    INSERT INTO produit_log (id_produit, nom, prix) VALUES (OLD.id_produit, OLD.nom, OLD.prix);
END //
DELIMITER ;

/*Curseur permettant de vérifié les stock */

DELIMITER //

CREATE PROCEDURE check_product_stock()
BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE product_id INT;
    DECLARE product_stock INT;
    DECLARE stock_cursor CURSOR FOR
        SELECT id_produit, stock
        FROM produit;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
    
    OPEN stock_cursor;
    
    read_loop: LOOP
        FETCH stock_cursor INTO product_id, product_stock;
        IF done THEN
            LEAVE read_loop;
        END IF;
        IF product_stock < 1 THEN
            SELECT CONCAT('Le produit ID ', product_id, ' est en rupture de stock');
        END IF;
    END LOOP;
    
    CLOSE stock_cursor;
END //

DELIMITER ;

CALL `check_product_stock`();
