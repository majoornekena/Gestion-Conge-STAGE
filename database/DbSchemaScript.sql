drop view v_listeemploye cascade;

drop view v_historiqueaffectation;

drop table traitements CASCADE;

drop table demandes CASCADE;

drop table typeconges CASCADE;

drop table branches_employes CASCADE;

drop table branches CASCADE;

drop table employes CASCADE;

drop table admins CASCADE;

CREATE TABLE "public".admins (
    idadmin serial NOT NULL,
    users varchar(20),
    mdp varchar(20),
    api_token varchar DEFAULT '0' :: character varying,
    CONSTRAINT admins_pkey PRIMARY KEY (idadmin)
);

INSERT INTO
    "public".admins (users, mdp)
VALUES
    ('admin', 'admin');

CREATE TABLE "public".employes (
    idemploye serial NOT NULL,
    nom text,
    prenom text,
    imgprofile text,
    sexe varchar(10),
    mail varchar(30),
    mdp varchar(30),
    api_token varchar DEFAULT '0' :: character varying,
    etatsup integer DEFAULT 0,
    CONSTRAINT employes_pkey PRIMARY KEY (idemploye)
);

CREATE TABLE "public".branches (
    idbranche serial NOT NULL,
    branche varchar(25),
    description text,
    CONSTRAINT pk_branches PRIMARY KEY (idbranche)
);

CREATE TABLE "public".branches_employes (
    id_branche_employe serial NOT NULL,
    idemploye integer,
    idbranche integer,
    dateaffectation date,
    CONSTRAINT pk_branches_employes PRIMARY KEY (id_branche_employe)
);

ALTER TABLE
    "public".branches_employes
ADD
    CONSTRAINT idemploye FOREIGN KEY (idemploye) REFERENCES "public".employes(idemploye);

ALTER TABLE
    "public".branches_employes
ADD
    CONSTRAINT idbranche FOREIGN KEY (idbranche) REFERENCES "public".branches(idbranche);

CREATE TABLE "public".typeconges (
    idtypeconge serial NOT NULL,
    typeconge varchar(25),
    description text,
    dureemax integer,
    CONSTRAINT pk_typeconges PRIMARY KEY (idtypeconge)
);

CREATE TABLE "public".demandes (
    iddemande serial NOT NULL,
    idemploye integer,
    idtypeconge integer,
    datedemande date DEFAULT CURRENT_DATE,
    datedebut date,
    datefin date,
    motif text,
    etat varchar DEFAULT 'En attente',
    etatsup integer DEFAULT 0,
    CONSTRAINT pk_demande PRIMARY KEY (iddemande)
);

ALTER TABLE
    "public".demandes
ADD
    CONSTRAINT idemploye FOREIGN KEY (idemploye) REFERENCES "public".employes(idemploye);

ALTER TABLE
    "public".demandes
ADD
    CONSTRAINT idtypeconge FOREIGN KEY (idtypeconge) REFERENCES "public".typeconges(idtypeconge);

CREATE TABLE "public".traitements (
    idtraitement serial NOT NULL,
    iddemande integer,
    datetraitement date,
    motif text,
    CONSTRAINT pk_traitement PRIMARY KEY (idtraitement)
);

ALTER TABLE
    "public".traitements
ADD
    CONSTRAINT iddemande FOREIGN KEY (iddemande) REFERENCES "public".demandes(iddemande);


CREATE OR REPLACE VIEW "public".v_listeemploye AS
SELECT
    e.idemploye, -- Ajout de l'idemploye
    e.nom,
    e.prenom,
    e.imgprofile,
    CASE 
        WHEN e.sexe = 'Homme' THEN COALESCE(b.branche, 'Non affecté')
        WHEN e.sexe = 'Femme' THEN COALESCE(b.branche, 'Non affectée')
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
INSERT INTO "public".employes (nom, prenom, sexe, mail, mdp)
VALUES 
    ('Smith', 'John', 'Homme', 'john.smith@example.com', 'motdepasse1'),
    ('Johnson', 'Emily', 'Femme', 'emily.johnson@example.com', 'motdepasse2'),
    ('Williams', 'Michael', 'Homme', 'michael.williams@example.com', 'motdepasse3'),
    ('Brown', 'Emma', 'Femme', 'emma.brown@example.com', 'motdepasse4'),
    ('Davis', 'Daniel', 'Homme', 'daniel.davis@example.com', 'motdepasse5'),
    ('Miller', 'Olivia', 'Femme', 'olivia.miller@example.com', 'motdepasse6'),
    ('Wilson', 'Sophia', 'Femme', 'sophia.wilson@example.com', 'motdepasse7'),
    ('Moore', 'Liam', 'Homme', 'liam.moore@example.com', 'motdepasse8'),
    ('Anderson', 'Ava', 'Femme', 'ava.anderson@example.com', 'motdepasse9'),
    ('Taylor', 'Ethan', 'Homme', 'ethan.taylor@example.com', 'motdepasse10'),
    ('Thomas', 'Isabella', 'Femme', 'isabella.thomas@example.com', 'motdepasse11'),
    ('Jackson', 'Noah', 'Homme', 'noah.jackson@example.com', 'motdepasse12'),
    ('White', 'Mia', 'Femme', 'mia.white@example.com', 'motdepasse13'),
    ('Harris', 'Liam', 'Homme', 'liam.harris@example.com', 'motdepasse14'),
    ('Clark', 'Ava', 'Femme', 'ava.clark@example.com', 'motdepasse15'),
    ('Lee', 'Elijah', 'Homme', 'elijah.lee@example.com', 'motdepasse16'),
    ('Lewis', 'Grace', 'Femme', 'grace.lewis@example.com', 'motdepasse17'),
    ('Martin', 'Lucas', 'Homme', 'lucas.martin@example.com', 'motdepasse18'),
    ('Hall', 'Chloe', 'Femme', 'chloe.hall@example.com', 'motdepasse19'),
    ('Young', 'Alexander', 'Homme', 'alexander.young@example.com', 'motdepasse20');

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