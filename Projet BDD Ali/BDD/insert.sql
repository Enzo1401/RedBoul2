-----------------------REQUETE SQL-----------------------


insert into produit (nom, prix, descriptions,images,stock) values 
(?,?,?,?,?);

select * from produit;


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

INSERT INTO users (id_users, nom, email) VALUES (1, 'Nom Utilisateur', 'email@example.com');


CALL passer_commande(1, 1, 2, '2023-10-01');
