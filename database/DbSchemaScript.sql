drop view v_listeemploye cascade;

drop view v_historiqueaffectation;

drop table traitements CASCADE;

drop table demandes CASCADE;

drop table typeconges CASCADE;

drop table branches_employes CASCADE;

drop table branches CASCADE;

drop table employes CASCADE;

drop table admins CASCADE;


CREATE  TABLE "public".admins ( 
	idadmin              serial  NOT NULL  ,
	users                varchar(20)    ,
	mdp                  varchar(20)    ,
	api_token            varchar DEFAULT '0'::character varying   ,
	CONSTRAINT admins_pkey PRIMARY KEY ( idadmin )
 );



CREATE  TABLE "public".employes ( 
	idemploye            serial  NOT NULL  ,
	nom                  text    ,
	prenom               text    ,
	datenaissance        date    ,
	sexe                 varchar(10)    ,
	residence            varchar(50)    ,
	phone                varchar(50)    ,
	imgprofile           text    ,
	mail                 varchar(30)    ,
	mdp                  varchar(30)    ,
	api_token            varchar DEFAULT '0'::character varying   ,
	etatsup              integer DEFAULT 0   ,
	CONSTRAINT employes_pkey PRIMARY KEY ( idemploye )
 );



CREATE  TABLE "public".branches ( 
	idbranche            serial  NOT NULL  ,
	branche              varchar(25)    ,
	description          text    ,
	CONSTRAINT pk_branches PRIMARY KEY ( idbranche )
 );



CREATE  TABLE "public".typeconges ( 
	idtypeconge          serial  NOT NULL  ,
	typeconge            varchar(25)    ,
	description          text    ,
	dureemax             integer    ,
	CONSTRAINT pk_typeconges PRIMARY KEY ( idtypeconge )
 );



CREATE  TABLE "public".branches_employes ( 
	id_branche_employe   serial  NOT NULL  ,
	idemploye            integer    ,
	idbranche            integer    ,
	dateaffectation      date    ,
	CONSTRAINT pk_branches_employes PRIMARY KEY ( id_branche_employe )
 );

ALTER TABLE "public".branches_employes ADD CONSTRAINT idemploye FOREIGN KEY ( idemploye ) REFERENCES "public".employes( idemploye );

ALTER TABLE "public".branches_employes ADD CONSTRAINT idbranche FOREIGN KEY ( idbranche ) REFERENCES "public".branches( idbranche );



CREATE  TABLE "public".demandes ( 
	iddemande            serial  NOT NULL  ,
	idemploye            integer    ,
	idtypeconge          integer    ,
	datedemande          date DEFAULT CURRENT_DATE   ,
	datedebut            date    ,
	datefin              date    ,
	motif                text    ,
	etat                 varchar DEFAULT 'En attente'   ,
	etatsup              integer DEFAULT 0   ,
	CONSTRAINT pk_demande PRIMARY KEY ( iddemande )
 );

ALTER TABLE "public".demandes ADD CONSTRAINT idemploye FOREIGN KEY ( idemploye ) REFERENCES "public".employes( idemploye );

ALTER TABLE "public".demandes ADD CONSTRAINT idtypeconge FOREIGN KEY ( idtypeconge ) REFERENCES "public".typeconges( idtypeconge );



CREATE  TABLE "public".traitements ( 
	idtraitement         serial  NOT NULL  ,
	iddemande            integer    ,
	datetraitement       date    ,
	motif                text    ,
	CONSTRAINT pk_traitement PRIMARY KEY ( idtraitement )
 );

ALTER TABLE "public".traitements ADD CONSTRAINT iddemande FOREIGN KEY ( iddemande ) REFERENCES "public".demandes( iddemande );









CREATE OR REPLACE VIEW "public".v_listeemploye AS
SELECT
    e.idemploye, -- Ajout de l'idemploye
    e.nom,
    e.prenom,
    e.imgprofile,
    CASE 
        WHEN e.sexe = 'homme' THEN COALESCE(b.branche, 'Non affecté')
        WHEN e.sexe = 'femme' THEN COALESCE(b.branche, 'Non affectée')
        ELSE COALESCE(b.branche, 'Non affecté(e)')
    END AS branche,
    be.dateaffectation
FROM
    "public".employes e
LEFT JOIN (
    SELECT
        idemploye,
        idbranche,
        dateaffectation,
        ROW_NUMBER() OVER (
            PARTITION BY idemploye
            ORDER BY dateaffectation DESC
        ) AS rn
    FROM
        "public".branches_employes
) be ON e.idemploye = be.idemploye AND be.rn = 1
LEFT JOIN "public".branches b ON be.idbranche = b.idbranche;


CREATE
or REPLACE VIEW "public".v_historiqueaffectation AS
SELECT
    e.nom,
    e.prenom,
    e.imgprofile,
    b.branche,
    be.dateaffectation
FROM
    "public".employes e
    JOIN "public".branches_employes be ON e.idemploye = be.idemploye
    JOIN "public".branches b ON be.idbranche = b.idbranche
ORDER BY
    be.dateaffectation DESC;



















-- Insertion d'employés
INSERT INTO public.employes (nom, prenom, datenaissance, sexe, residence, phone, mail, mdp)
VALUES
  ('Doe', 'John', '1990-01-01', 'homme', '123 Main St', '555-1234', 'john.doe@example.com', 'password1'),
  ('Smith', 'Jane', '1985-05-15', 'femme', '456 Oak St', '555-5678', 'jane.smith@example.com', 'password2'),
  ('Johnson', 'Bob', '1982-11-30', 'homme', '789 Maple St', '555-9876', 'bob.johnson@example.com', 'password3'),
  ('Taylor', 'Emily', '1993-08-22', 'femme', '101 Pine St', '555-4321', 'emily.taylor@example.com', 'password4'),
  ('Anderson', 'Mike', '1988-04-10', 'homme', '202 Cedar St', '555-8765', 'mike.anderson@example.com', 'password5'),
  ('Brown', 'Jessica', '1995-02-28', 'femme', '303 Elm St', '555-6789', 'jessica.brown@example.com', 'password6'),
  ('Miller', 'Chris', '1980-07-12', 'homme', '404 Birch St', '555-2345', 'chris.miller@example.com', 'password7'),
  ('Davis', 'Laura', '1991-09-18', 'femme', '505 Walnut St', '555-7890', 'laura.davis@example.com', 'password8'),
  ('Wilson', 'Mark', '1987-03-25', 'homme', '606 Pineapple St', '555-5432', 'mark.wilson@example.com', 'password9'),
  ('White', 'Megan', '1994-12-03', 'femme', '707 Cherry St', '555-8765', 'megan.white@example.com', 'password10'),
  ('Johnson', 'Tom', '1984-06-17', 'homme', '808 Oak St', '555-3210', 'tom.johnson@example.com', 'password11'),
  -- Add more employees as needed
  ('Clark', 'Eva', '1990-05-20', 'femme', '909 Pine St', '555-4567', 'eva.clark@example.com', 'password12'),
  ('Hall', 'Jack', '1983-11-15', 'homme', '101 Maple St', '555-6789', 'jack.hall@example.com', 'password13'),
  ('Baker', 'Sara', '1992-08-05', 'femme', '202 Elm St', '555-8901', 'sara.baker@example.com', 'password14'),
  ('Adams', 'Peter', '1986-04-30', 'homme', '303 Cedar St', '555-1234', 'peter.adams@example.com', 'password15'),
  ('Barnes', 'Olivia', '1993-02-10', 'femme', '404 Birch St', '555-5678', 'olivia.barnes@example.com', 'password16'),
  ('Young', 'Daniel', '1980-09-25', 'homme', '505 Oak St', '555-7890', 'daniel.young@example.com', 'password17'),
  ('Fisher', 'Sophia', '1995-06-18', 'femme', '606 Maple St', '555-4321', 'sophia.fisher@example.com', 'password18'),
  ('Collins', 'Ryan', '1987-01-12', 'homme', '707 Pine St', '555-8765', 'ryan.collins@example.com', 'password19'),
  ('Turner', 'Isabella', '1994-07-30', 'femme', '808 Elm St', '555-2345', 'isabella.turner@example.com', 'password20'),
  -- Continue adding employees until you have more than 20
  ('Morgan', 'Matthew', '1982-03-05', 'homme', '909 Cedar St', '555-6789', 'matthew.morgan@example.com', 'password21');



INSERT INTO public.employes (nom, prenom, datenaissance, sexe, residence, phone, mail, mdp)
VALUES
  -- ... (le script précédent pour les 30 premiers employés)

  ('Cooper', 'Grace', '1991-08-12', 'femme', '101 Birch St', '555-8901', 'grace.cooper@example.com', 'password22'),
  ('Ward', 'Andrew', '1985-02-28', 'homme', '202 Oak St', '555-1234', 'andrew.ward@example.com', 'password23'),
  ('Watson', 'Zoe', '1994-12-03', 'femme', '303 Pine St', '555-5678', 'zoe.watson@example.com', 'password24'),
  ('Reed', 'Jason', '1980-07-22', 'homme', '404 Cedar St', '555-8765', 'jason.reed@example.com', 'password25'),
  ('Sanders', 'Ava', '1993-04-15', 'femme', '505 Elm St', '555-4321', 'ava.sanders@example.com', 'password26'),
  ('Turner', 'Eric', '1988-11-30', 'homme', '606 Maple St', '555-7890', 'eric.turner@example.com', 'password27'),
  ('Perez', 'Sophie', '1992-06-18', 'femme', '707 Oak St', '555-2345', 'sophie.perez@example.com', 'password28'),
  ('Hughes', 'Samuel', '1983-01-12', 'homme', '808 Pine St', '555-6789', 'samuel.hughes@example.com', 'password29'),
  ('Bennett', 'Chloe', '1995-09-25', 'femme', '909 Birch St', '555-3210', 'chloe.bennett@example.com', 'password30'),
  -- Continue adding employees until you have 40
  ('Fletcher', 'Nathan', '1986-04-30', 'homme', '101 Cedar St', '555-5432', 'nathan.fletcher@example.com', 'password31');


  INSERT INTO public.employes (nom, prenom, datenaissance, sexe, residence, phone, mail, mdp)
VALUES
  -- ... (le script précédent pour les 40 premiers employés)

  ('Gomez', 'Lucy', '1990-05-15', 'femme', '202 Pine St', '555-8765', 'lucy.gomez@example.com', 'password32'),
  ('Murray', 'Dylan', '1987-10-28', 'homme', '303 Elm St', '555-2345', 'dylan.murray@example.com', 'password33'),
  ('Nelson', 'Hannah', '1994-03-12', 'femme', '404 Oak St', '555-6789', 'hannah.nelson@example.com', 'password34'),
  ('Fisher', 'Max', '1982-08-22', 'homme', '505 Maple St', '555-4321', 'max.fisher@example.com', 'password35'),
  ('Stewart', 'Lily', '1993-12-03', 'femme', '606 Cedar St', '555-7890', 'lily.stewart@example.com', 'password36'),
  ('Owens', 'Ethan', '1980-06-17', 'homme', '707 Birch St', '555-3210', 'ethan.owens@example.com', 'password37'),
  ('Sullivan', 'Olivia', '1991-02-28', 'femme', '808 Pine St', '555-5432', 'olivia.sullivan@example.com', 'password38'),
  ('Gibson', 'Jake', '1985-09-15', 'homme', '909 Elm St', '555-9876', 'jake.gibson@example.com', 'password39'),
  ('Chen', 'Sophia', '1992-04-10', 'femme', '101 Cedar St', '555-6789', 'sophia.chen@example.com', 'password40'),
  -- Continue adding employees until you have 50
  ('Kim', 'Daniel', '1988-11-30', 'homme', '202 Oak St', '555-1234', 'daniel.kim@example.com', 'password41');





-- Insertion de branches
INSERT INTO
    "public".branches (branche, description)
VALUES
    ('Branche A', 'Description de la Branche A'),
    ('Branche B', 'Description de la Branche B'),
    ('Branche C', 'Description de la Branche C');

-- Insertion des affectations des employés aux branches
INSERT INTO
    "public".branches_employes (idemploye, idbranche, dateaffectation)
VALUES
    (1, 1, '2023-01-01'),
    (1, 3, '2023-03-15'),
    (2, 2, '2023-02-10'),
    (3, 1, '2023-04-05'),
    (3, 2, '2023-05-20');