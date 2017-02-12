-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 18. led 2017, 09:34
-- Verze serveru: 10.1.19-MariaDB
-- Verze PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `praxe`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `firmy`
--

CREATE TABLE `firmy` (
  `id` int(11) NOT NULL,
  `nazev_firmy` varchar(60) COLLATE utf8_czech_ci DEFAULT NULL,
  `ulice` varchar(60) COLLATE utf8_czech_ci DEFAULT NULL,
  `cp` varchar(10) COLLATE utf8_czech_ci DEFAULT NULL,
  `mesto` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `psc` varchar(10) COLLATE utf8_czech_ci DEFAULT NULL,
  `kontaktni_osoba` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `telefon` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `poznamka` text COLLATE utf8_czech_ci,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL COMMENT '"OK" indicates that no errors occurred; the address was successfully parsed and at least one geocode was returned.\n"ZERO_RESULTS" indicates that the geocode was successful but returned no results. This may occur if the geocoder was passed a non-existent address.\n"OVER_QUERY_LIMIT" indicates that you are over your quota.\n"REQUEST_DENIED" indicates that your request was denied.\n"INVALID_REQUEST" generally indicates that the query (address, components or latlng) is missing.\n"UNKNOWN_ERROR" indicates that the request could not be processed due to a server error. The request may succeed if you try again.\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `firmy`
--

INSERT INTO `firmy` (`id`, `nazev_firmy`, `ulice`, `cp`, `mesto`, `psc`, `kontaktni_osoba`, `telefon`, `poznamka`, `latitude`, `longitude`, `status`) VALUES
(1, 'SPŠD Plzeň', 'Karlovarská', '99', 'Plzeň', '323 00', 'Jiří Svoboda', '777 889 122', 'Je přítomen pouze po předchozí domluvě', 49.7695, 13.3614, 'OK'),
(2, 'Autocentrum Hrádek', 'Rokycanská', '3', 'Hrádek', NULL, 'p. Roth', '602 258 362', NULL, 49.7184, 13.6367, 'OK'),
(3, 'PORCHE PLZEŇ', 'Gerská', '37', 'Plzeň', '323 00', 'Miroslav Kepka', '724 359 522', NULL, 49.7818, 13.3708, 'OK'),
(4, 'LUKRENA a.s.', NULL, '196', 'Dolní Lukavice', '334 44', 'Martina Žofáková', '737 260 033', NULL, NULL, NULL, 'ZERO_RESULTS'),
(5, 'Zoologická a botanická zahrada Plzeň', 'Pod Vinicemi', '9', 'Plzeň', '301 00', 'L.Václavová', '378 038 325', NULL, 49.7596, 13.3613, 'OK'),
(6, 'AUTODOPRAVA - ZPROSTŘEDKOVATELSKÁ ČINNOST, Jezdecká škola Kr', NULL, '333', 'Tři Sekery', NULL, 'Kouba Roman', '608 980 087', NULL, 49.9422, 12.6166, 'OK'),
(7, 'Aeroklub Plzeň - Letkov', NULL, NULL, 'Plzeň – Letkov', NULL, 'Ing.Jaroslav Čejka', '606 939 248', NULL, 49.7304, 13.465, 'OK'),
(8, 'GRAMMER CZ, s.r.o.', 'Okružní', '2042', 'Tachov', '347 01', 'p. Štefanka Luboš', '374 799 011', NULL, 49.8051, 12.6469, 'OK'),
(9, 'HZS PK - Stanice Nepomuk', 'Budějovická', '430', 'Nepomuk', NULL, 'Npor. Bc. Zbyšek Zuber', '950 334 062', NULL, 49.4826, 13.5784, 'OK');

-- --------------------------------------------------------

--
-- Struktura tabulky `kontrola`
--

CREATE TABLE `kontrola` (
  `id` int(11) NOT NULL,
  `id_ucitele` int(11) DEFAULT NULL,
  `id_studenti` int(11) DEFAULT NULL,
  `cas_vyberu` datetime DEFAULT NULL COMMENT 'Čas, kdy si studenta učitel zamluvil.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `kontrola`
--

INSERT INTO `kontrola` (`id`, `id_ucitele`, `id_studenti`, `cas_vyberu`) VALUES
(1, 6, 1, '2017-01-16 14:18:00'),
(2, 1, 16, '2017-01-14 14:18:00'),
(3, 3, 5, '2017-01-13 14:18:00'),
(4, 3, 6, '2017-01-16 14:18:00'),
(5, 6, 10, '2017-01-14 14:18:00'),
(6, 6, 11, '2017-01-13 14:18:00'),
(7, 2, 15, '2017-01-13 14:18:00'),
(8, 2, 17, '2017-01-16 14:18:00'),
(9, 6, 18, '2017-01-15 14:18:00');

-- --------------------------------------------------------

--
-- Struktura tabulky `studenti`
--

CREATE TABLE `studenti` (
  `id` int(11) NOT NULL,
  `id_trida` int(11) NOT NULL,
  `id_firmy` int(11) DEFAULT NULL,
  `id_ucitele_admin` int(11) DEFAULT NULL COMMENT 'Určuje, který učitel má daného studenta na starosti. Zapíše, v jaké firmě má vykonávat praxi.',
  `jmeno` varchar(60) COLLATE utf8_czech_ci DEFAULT NULL,
  `prijmeni` varchar(60) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `studenti`
--

INSERT INTO `studenti` (`id`, `id_trida`, `id_firmy`, `id_ucitele_admin`, `jmeno`, `prijmeni`) VALUES
(1, 1, NULL, 5, 'Radek', 'Novák'),
(2, 2, NULL, 2, 'Roman', 'Zeman'),
(3, 3, NULL, 2, 'Eva', 'Nováková'),
(4, 1, NULL, 5, 'Ema', 'Nová'),
(5, 1, NULL, NULL, 'Ivan', 'Novák'),
(6, 6, NULL, 5, 'Jana', 'Zímová'),
(7, 7, NULL, 2, 'Radek', 'Zinek'),
(8, 5, NULL, 5, 'Jan', 'Novák'),
(9, 5, NULL, 5, 'Petr', 'Urban'),
(10, 4, NULL, 5, 'Radek', 'Jaro'),
(11, 3, NULL, NULL, 'Roman', 'Zima'),
(12, 2, NULL, 2, 'Eva', 'Znaková'),
(13, 2, NULL, 5, 'Ema', 'Stará'),
(14, 3, NULL, 5, 'Ivan', 'Starý'),
(15, 4, NULL, 5, 'Jana', 'Stašková'),
(16, 5, NULL, 2, 'Radek', 'Staněk'),
(17, 6, NULL, NULL, 'Jan', 'Surovec'),
(18, 6, NULL, NULL, 'Petr', 'Stach');

-- --------------------------------------------------------

--
-- Struktura tabulky `tridy`
--

CREATE TABLE `tridy` (
  `id` int(11) NOT NULL,
  `trida` varchar(10) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `tridy`
--

INSERT INTO `tridy` (`id`, `trida`) VALUES
(1, 'DP3'),
(2, 'MEK1'),
(3, 'MEK2'),
(4, 'MEK3'),
(5, 'MPP1'),
(6, 'MPP2'),
(7, 'MPP3');

-- --------------------------------------------------------

--
-- Struktura tabulky `ucitele`
--

CREATE TABLE `ucitele` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(60) COLLATE utf8_czech_ci DEFAULT NULL,
  `prijmeni` varchar(60) COLLATE utf8_czech_ci DEFAULT NULL,
  `username` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(60) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `ucitele`
--

INSERT INTO `ucitele` (`id`, `jmeno`, `prijmeni`, `username`, `heslo`) VALUES
(1, 'Robert', 'Pecko', 'rpecko', 'kolo'),
(2, 'Lukáš', 'Feřt', 'lfert', ''),
(3, 'Gabriela', 'Buchtová', 'gbuchtova', ''),
(4, 'Miroslava', 'Chocholová', 'mchocholova', ''),
(5, 'Vladimír', 'Beneš', 'vbenes', ''),
(6, 'Miroslav', 'Muller', 'mmuller', '');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `firmy`
--
ALTER TABLE `firmy`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `kontrola`
--
ALTER TABLE `kontrola`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_studenti_UNIQUE` (`id_studenti`),
  ADD KEY `fk_Kontrola_ucitele1_idx` (`id_ucitele`),
  ADD KEY `fk_kontrola_studenti1_idx` (`id_studenti`);

--
-- Klíče pro tabulku `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_student_trida_idx` (`id_trida`),
  ADD KEY `fk_studenti_firma1_idx` (`id_firmy`),
  ADD KEY `fk_studenti_ucitele1_idx` (`id_ucitele_admin`);

--
-- Klíče pro tabulku `tridy`
--
ALTER TABLE `tridy`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `ucitele`
--
ALTER TABLE `ucitele`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `firmy`
--
ALTER TABLE `firmy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pro tabulku `kontrola`
--
ALTER TABLE `kontrola`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pro tabulku `studenti`
--
ALTER TABLE `studenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pro tabulku `tridy`
--
ALTER TABLE `tridy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pro tabulku `ucitele`
--
ALTER TABLE `ucitele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `kontrola`
--
ALTER TABLE `kontrola`
  ADD CONSTRAINT `fk_Kontrola_ucitele1` FOREIGN KEY (`id_ucitele`) REFERENCES `ucitele` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kontrola_studenti1` FOREIGN KEY (`id_studenti`) REFERENCES `studenti` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `studenti`
--
ALTER TABLE `studenti`
  ADD CONSTRAINT `fk_student_trida` FOREIGN KEY (`id_trida`) REFERENCES `tridy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_studenti_firma1` FOREIGN KEY (`id_firmy`) REFERENCES `firmy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_studenti_ucitele1` FOREIGN KEY (`id_ucitele_admin`) REFERENCES `ucitele` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
