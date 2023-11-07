drop table branches_employes CASCADE;

drop table typeconges CASCADE;

drop table branches CASCADE;

drop table employes CASCADE;

drop table admins CASCADE;

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

CREATE TABLE "public".admins (
    idadmin serial NOT NULL,
    users varchar(20),
    mdp varchar(20),
    api_token varchar DEFAULT '0' :: character varying,
    CONSTRAINT admins_pkey PRIMARY KEY (idadmin)
);

CREATE TABLE "public".branches (
    idbranche serial NOT NULL,
    branche varchar(25),
    description text,
    CONSTRAINT pk_branches PRIMARY KEY (idbranche)
);

CREATE TABLE "public".typeconges (
    idtypeconge serial NOT NULL,
    typeconge varchar(25),
    description text,
    dureemax integer,
    CONSTRAINT pk_typeconges PRIMARY KEY (idtypeconge)
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

