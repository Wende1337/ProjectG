/*
 * Tabellenschema zur Speicherung der Benutzeraktivitäten
 * 1. alles wird gelöscht 2. alle Tabellen werden neu angelegt
 * 3. Ganz am Schluss werden noch die richtigen charset gesetzt. Wir verwenden utf8mb4(UTF8 im 4 byte format).
 */
drop table Uebung_beinhaltet_Aufgabe cascade ;
drop table Benutzer_bearbeitet_Lektion cascade;
drop table Uebung cascade;

drop table Aufgabenbearbeitung cascade;
drop table Lektion cascade ;
drop table Benutzer cascade;

CREATE TABLE `Benutzer`
(
  `id_benutzer` int(8) PRIMARY KEY,
  `vorname` varchar(255),
  `name` varchar(255),
  `emailadresse` varchar(255),
  `passwort` varchar(255)
);

CREATE TABLE `Benutzer_bearbeitet_Lektion`
(
  `id_benutzer_lektion` int(8) PRIMARY KEY,
  `id_benutzer` int(8),
  `id_lektion` int(8)
);

CREATE TABLE `Lektion`
(
  `id_lektion` int(8) PRIMARY KEY,
  `status` ENUM ('abgeschlossen', 'fehlgeschlagen', 'ausstehend'),
  `datum_angefangen` datetime,
  `datum_beendet` datetime
);

CREATE TABLE `Uebung`
(
  `id_uebung` int(8) PRIMARY KEY,
  `thema` varchar(255),
  `id_lektion` int(8)
);

CREATE TABLE `Aufgabenbearbeitung`
(
  `id_aufgabenbearbeitung` int(8) PRIMARY KEY,
  `erreichte_punkte` integer
);

CREATE TABLE `Uebung_beinhaltet_Aufgabe`
(
  `id_uebung_beinhaltet_aufgabe` int(8) PRIMARY KEY,
  `id_uebung` int(8),
  `id_aufgabenbearbeitung` int(8)
);
/*
 * Fremdschlüssel
 */
ALTER TABLE Benutzer_bearbeitet_Lektion ADD FOREIGN KEY (`id_benutzer`) REFERENCES `Benutzer` (`id_benutzer`);
ALTER TABLE `Benutzer_bearbeitet_Lektion` ADD FOREIGN KEY (`id_lektion`) REFERENCES `Lektion` (`id_lektion`);
ALTER TABLE `Uebung` ADD FOREIGN KEY (`id_lektion`) REFERENCES `Lektion` (`id_lektion`);
ALTER TABLE `Uebung_beinhaltet_Aufgabe` ADD FOREIGN KEY (`id_uebung`) REFERENCES `Uebung` (`id_uebung`);
ALTER TABLE `Uebung_beinhaltet_Aufgabe` ADD FOREIGN KEY (`id_aufgabenbearbeitung`) REFERENCES `Aufgabenbearbeitung` (`id_aufgabenbearbeitung`);

COMMIT;

/*
 * Tabllenschema zur Speicherung der Aufgaben
 * 1. alles wird gelöscht 2. alle Tabellen werden neu angelegt
 */

drop table A1;
drop table A2;
drop table A3;
drop table B1;
drop table B2;
drop table B3;
drop table C1;
drop table C2;
drop table C3;
drop table C4;
drop table D1;
drop table D2;
drop table D3;
drop table D4;
drop table D5;
drop table D6;
drop table E1;
drop table E2;
drop table E;
DROP TABLE Aufgabe;

CREATE TABLE `Aufgabe`
(
  `id_aufgabe` int(8) PRIMARY KEY,
  `lektion` varchar(255),
  `uebungstitel` varchar(255),
  `beschreibung` varchar(255),
  `auswahlmoeglichkeiten` varchar(255),
  `am_reihenfolge_relevanz` boolean,
  `loesung` varchar(255),
  `loesung_reihenfolge_relevanz` boolean,
  `max_punkte` integer,
  `schwierigkeitsgrad` integer,
  `schlagworte` varchar(255)
);

CREATE TABLE `A1`
(
  `id_a1` int(8) PRIMARY KEY,
  `id_aufgabe` int(8)
);

CREATE TABLE `A2`
(
  `id_a2` int(8) PRIMARY KEY,
  `id_aufgabe` int(8)
);

CREATE TABLE `A3`
(
  `id_a3` int(8) PRIMARY KEY,
  `loesungsvorgabe` varchar(255),
  `ueberschrift_tabelle1` varchar(255),
  `ueberschrift_tabelle2` varchar(255),
  `ueberschrift_tabelle3` varchar(255),
  `auswahlmoeglichkeiten1` varchar(255),
  `auswahlmoeglichkeiten2` varchar(255),
  `auswahlmoeglichkeiten3` varchar(255),
  `id_aufgabe` int(8)
);

CREATE TABLE `B1`
(
  `id_b1` int(8) PRIMARY KEY,
  `id_aufgabe` int(8)
);

CREATE TABLE `B2`
(
  `id_b2` int(8) PRIMARY KEY,
  `id_aufgabe` int(8)
);

CREATE TABLE `B3`
(
  `id_b3` int(8) PRIMARY KEY,
  `id_aufgabe` int(8)
);

CREATE TABLE `C1`
(
  `id_c1` int(8) PRIMARY KEY,
  `loesungsvorgabe_spalte1` varchar(255),
  `loesungsvorgabe_spalte1_reihenfolge` boolean,
  `loesungsvorgabe_spalte2` varchar(255),
  `loesungsvorgabe_spalte2_reihenfolge` boolean,
  `id_aufgabe` int(8)
);

CREATE TABLE `C2`
(
  `id_c2` int(8) PRIMARY KEY,
  `tabellenvorgabe_spalte1` varchar(255),
  `tabellenvorgabe_spalte1_reihenfolge` boolean,
  `tabellenvorgabe_spalte2` varchar(255),
  `tabellenvorgabe_spalte2_reihenfolge` boolean,
  `loesung_spalte1` varchar(255),
  `loesung_spalte1_reihenfolge` boolean,
  `loesung_spalte2` varchar(255),
  `loesung_spalte2_reihenfolge` boolean,
  `id_aufgabe` int(8)
);

CREATE TABLE `C3`
(
  `id_c3` int(8) PRIMARY KEY,
  `tabellenvorgabe_spalte1` varchar(255),
  `tabellenvorgabe_spalte1_reihenfolge` boolean,
  `tabellenvorgabe_spalte2` varchar(255),
  `tabellenvorgabe_spalte2_reihenfolge` boolean,
  `tabellenvorgabe_spalte3` varchar(255),
  `tabellenvorgabe_spalte3_reihenfolge` boolean,
  `loesung1` varchar(255),
  `loesung2` varchar(255),
  `loesung3` varchar(255),
  `id_aufgabe` int(8)
);

CREATE TABLE `C4`
(
  `id_c4` int(8) PRIMARY KEY,
  `ueberschrift_tabelle_spalte1` varchar(255),
  `ueberschrift_tabelle_spalte2` varchar(255),
  `loesung_spalte1` varchar(255),
  `loesung_spalte1_reihenfolge` boolean,
  `loesung_spalte2` varchar(255),
  `loesung_spalte2_reihenfolge` boolean,
  `id_aufgabe` int(8)
);

CREATE TABLE `D1`
(
  `id_d1` int(8) PRIMARY KEY,
  `id_aufgabe` int(8)
);

CREATE TABLE `D2`
(
  `id_d2` int(8) PRIMARY KEY,
  `id_aufgabe` int(8)
);

CREATE TABLE `D3`
(
  `id_d3` int(8) PRIMARY KEY,
  `id_aufgabe` int(8)
);

CREATE TABLE `D4`
(
  `id_d4` int(8) PRIMARY KEY,
  `id_aufgabe` int(8)
);

CREATE TABLE `D5`
(
  `id_d5` int(8) PRIMARY KEY,
  `id_aufgabe` int(8)
);

CREATE TABLE `D6`
(
  `id_d6` int(8) PRIMARY KEY,
  `id_aufgabe` int(8)
);

CREATE TABLE `E`
(
  `id_e` int(8) PRIMARY KEY,
  `loesungspaare` varchar(255),
  `loesungspaare_reihenfolge` boolean,
  `id_aufgabe` int(8)
);

CREATE TABLE `E1`
(
  `id_e1` int(8) PRIMARY KEY,
  `id_e` int(8)
);

CREATE TABLE `E2`
(
  `id_e2` int(8) PRIMARY KEY,
  `auswahlmoeglichkeiten1` varchar(255),
  `auswahlmoeglichkeiten1_reihenfolge` boolean,
  `auswahlmoeglichkeiten2` varchar(255),
  `auswahlmoeglichkeiten2_reihenfolge` boolean,
  `id_e` int(8)
);

/*
 * Fremdschlüssel
 */
ALTER TABLE `A1` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `A2` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `A3` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `B1` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `B2` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `B3` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `C1` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `C2` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `C3` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `C4` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `D1` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `D2` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `D3` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `D4` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `D5` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `D6` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `E` ADD FOREIGN KEY (`id_aufgabe`) REFERENCES `Aufgabe` (`id_aufgabe`);
ALTER TABLE `E1` ADD FOREIGN KEY (`id_e`) REFERENCES `E` (`id_e`);
ALTER TABLE `E2` ADD FOREIGN KEY (`id_e`) REFERENCES `E` (`id_e`);

commit ;

/*
 * Dieser Teil des Skript ist dazu da um zu gewährleisten dass die Datenbank und jede Tabelle die richtige uft8 im 4Byte format hat.
 */
ALTER DATABASE test_work_greek CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
commit ;

ALTER TABLE A1 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE A2 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE A3 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE Aufgabe CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE B1 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE B2 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE B3 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE C1 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE C2 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

ALTER TABLE C3 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE C4 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE D1 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE D2 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE D3 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE D4 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE D5 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE D6 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE E1 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE E2 CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE E CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
commit;

SELECT
  `tables`.`TABLE_NAME`,
  `collations`.`character_set_name`
FROM
  `information_schema`.`TABLES` AS `tables`,
  `information_schema`.`COLLATION_CHARACTER_SET_APPLICABILITY` AS `collations`
WHERE
  `tables`.`table_schema` = DATABASE()
  AND `collations`.`collation_name` = `tables`.`table_collation`
;
