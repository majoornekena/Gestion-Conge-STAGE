drop view v_benefices cascade;
drop view v_pertes cascade;
drop view v_recettes cascade;

drop view v_factures CASCADE;
drop view v_detailfactures cascade;
drop view v_depenses CASCADE;

drop table admins CASCADE;
drop table employes CASCADE;
drop table patients CASCADE;
drop table actes CASCADE;
drop table factures CASCADE;
drop table depenses CASCADE;

drop table actepatients CASCADE;
drop table typedepenses CASCADE;


create table admins (
idadmin SERIAL PRIMARY KEY,
users varchar(20),
mdp varchar(20)
);

insert into admins(users,mdp) values('hardi','hardi');

create table employes(
idemploye serial primary key,
nom text,
prenom text,
mail varchar(30),
mdp varchar(30),
etatsup int default 0
);

INSERT INTO employes (nom, prenom, mail, mdp) VALUES
('test', 'test', 'test', 'test');
create table patients (
    idpatient serial primary key,
    nom text,
    datenaissance date,
    genre text,
    etatsup int default 0

);

ALTER TABLE patients
ADD remboursement text;


CREATE TABLE actes (
    idacte serial PRIMARY KEY,
    acte text,
    budget_annuel decimal(10,2),
    code text,
    etatsup int DEFAULT 0
);



create table typedepenses (
    idtypedepense serial primary key,
    typedepense text,
    etatsup int default 0
);

ALTER TABLE typedepenses
ADD budget_annuel DECIMAL(10,2),
ADD code TEXT;

create table depenses ( 
    iddepense serial primary key,
    idtypedepense int references typedepenses(idtypedepense),
    datedepense date,
    montant decimal(10,2),
    quantite int, 
    etatsup int default 0
);


create table factures (
    idfacture serial primary key,
    idpatient int references patients(idpatient),
    datefacture date,
    etatsup int default 0
);

create table actepatients (
    idactepatient serial primary key,
    idfacture int references factures(idfacture),
    idacte int,
    quantite int,
    tarif decimal(10,2),
    etatsup int default 0
);

CREATE OR REPLACE VIEW v_depenses AS
SELECT
    d.iddepense,
    d.idtypedepense,
    d.datedepense,
    d.montant,
    d.quantite,
    d.etatsup,
    t.typedepense,
    d.quantite * d.montant AS montant_total,
    t.budget_annuel
FROM
    depenses d
LEFT JOIN
    typedepenses t ON d.idtypedepense = t.idtypedepense;


CREATE OR REPLACE VIEW v_factures AS
SELECT
    f.idfacture,
    f.idpatient,
    p.nom AS patient_nom,
    p.datenaissance AS patient_datenaissance,
    p.genre AS patient_genre,
    f.datefacture,
    f.etatsup
FROM
    factures f
JOIN
    patients p ON f.idpatient = p.idpatient
WHERE
    f.etatsup = 0 AND p.etatsup = 0;


CREATE OR REPLACE VIEW v_detailfactures AS
SELECT
    ap.idactepatient,
    ap.idfacture,
    f.idpatient,
    p.nom AS patient_nom,
    p.datenaissance AS patient_datenaissance,
    p.genre AS patient_genre,
    f.datefacture,
    ap.idacte,
    a.acte,
    ap.quantite,
    ap.tarif,
    ap.quantite * ap.tarif AS tarif_total,
    a.budget_annuel
FROM
    actepatients ap
JOIN
    factures f ON ap.idfacture = f.idfacture
JOIN
    patients p ON f.idpatient = p.idpatient
JOIN
    actes a ON ap.idacte = a.idacte
WHERE
    ap.etatsup = 0 AND f.etatsup = 0 AND a.etatsup = 0;


CREATE OR REPLACE VIEW v_recettes AS
SELECT
    a.acte,
    m.annee,
    m.mois,
    COALESCE(SUM(df.tarif_total), 0) AS total_recette,
    a.budget_annuel,
    CAST(a.budget_annuel / 12 AS DECIMAL(10,2)) AS budget_mensuel,
    CAST((COALESCE(SUM(df.tarif_total), 0) / (a.budget_annuel / 12)) * 100 AS DECIMAL(10,2)) AS pourcentage_realisation
FROM
    actes a
CROSS JOIN
    (WITH month as (
        select * from generate_series(1, 12) AS mois
    ),
     year as (
        select * from  generate_series(2019, EXTRACT (YEAR FROM NOW())::INTEGER) AS annee
     )
      select month.mois, year.annee from month cross join year) m
LEFT JOIN
    v_detailfactures df ON a.acte = df.acte AND EXTRACT(YEAR FROM df.datefacture) = m.annee AND EXTRACT(MONTH FROM df.datefacture) = m.mois
GROUP BY
    a.acte, m.annee, m.mois, a.budget_annuel
ORDER BY
    a.acte, m.annee, m.mois;


CREATE OR REPLACE VIEW v_pertes AS
SELECT
    td.typedepense,
    m.annee,
    m.mois,
    COALESCE(SUM(dp.montant_total), 0) AS total_depense,
    td.budget_annuel,
    CAST(td.budget_annuel / 12 AS DECIMAL(10, 2)) AS budget_mensuel,
    CAST(COALESCE((SUM(dp.montant_total) / (td.budget_annuel / 12)) * 100, 0) AS DECIMAL(10, 2)) AS pourcentage_realisation
FROM
    typedepenses td
CROSS JOIN
    (WITH month as (
        select * from generate_series(1, 12) AS mois
    ),
     year as (
        select * from  generate_series(2019, EXTRACT (YEAR FROM NOW())::INTEGER) AS annee
     )
      select month.mois, year.annee from month cross join year)  m
LEFT JOIN
    v_depenses dp ON td.idtypedepense = dp.idtypedepense AND EXTRACT(YEAR FROM dp.datedepense) = m.annee AND EXTRACT(MONTH FROM dp.datedepense) = m.mois
GROUP BY
    td.typedepense, m.annee, m.mois, td.budget_annuel
ORDER BY
    td.typedepense, m.annee, m.mois;




CREATE OR REPLACE VIEW v_benefices AS
SELECT
    recettes.annee,
    recettes.mois,
    CAST(SUM(recettes.total_recette) AS DECIMAL(10, 2)) AS total_recettes,
    CAST(SUM(pertes.total_depense) AS DECIMAL(10, 2)) AS total_depenses,
    CAST((SUM(recettes.total_recette) / SUM(recettes.budget_mensuel)) * 100 AS DECIMAL(10, 2)) AS total_realisation_recettes,
    CAST((SUM(pertes.total_depense) / SUM(pertes.budget_mensuel)) * 100 AS DECIMAL(10, 2)) AS total_realisation_depenses,
    CAST(SUM(DISTINCT recettes.budget_annuel) AS DECIMAL(10, 2)) AS total_budget_annuel_recettes,
    CAST(SUM(DISTINCT pertes.budget_annuel) AS DECIMAL(10, 2)) AS total_budget_annuel_depenses,
    CAST(SUM(DISTINCT recettes.budget_mensuel) AS DECIMAL(10, 2)) AS total_budget_mensuel_recettes,
    CAST(SUM(DISTINCT pertes.budget_mensuel) AS DECIMAL(10, 2)) AS total_budget_mensuel_depenses,
    CAST((SUM(recettes.total_recette) - SUM(pertes.total_depense)) AS DECIMAL(10, 2)) AS benefice,
    CAST(SUM(DISTINCT recettes.budget_mensuel) - SUM(DISTINCT pertes.budget_mensuel) AS DECIMAL(10, 2)) AS budget_du_mois,
    CAST(((SUM(recettes.total_recette) - SUM(pertes.total_depense)) * 100) / (SUM(DISTINCT recettes.budget_mensuel) - SUM(DISTINCT pertes.budget_mensuel)) AS DECIMAL(10, 2)) AS pourcentage_mois
FROM
    (SELECT annee, mois, SUM(total_recette) AS total_recette, AVG(pourcentage_realisation) AS pourcentage_realisation,
            SUM(budget_annuel) AS budget_annuel, SUM(budget_mensuel) AS budget_mensuel
     FROM v_recettes
     GROUP BY annee, mois) recettes
JOIN
    (SELECT annee, mois, SUM(total_depense) AS total_depense, AVG(pourcentage_realisation) AS pourcentage_realisation,
            SUM(budget_annuel) AS budget_annuel, SUM(budget_mensuel) AS budget_mensuel
     FROM v_pertes
     GROUP BY annee, mois) pertes ON recettes.annee = pertes.annee AND recettes.mois = pertes.mois
GROUP BY
    recettes.annee, recettes.mois
ORDER BY
    recettes.annee, recettes.mois;



