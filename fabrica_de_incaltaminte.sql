-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: ian. 08, 2024 la 08:34 PM
-- Versiune server: 10.4.21-MariaDB
-- Versiune PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `fabrica de incaltaminte`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `angajati`
--

CREATE TABLE `angajati` (
  `AngajatiD` int(11) NOT NULL,
  `Nume` varchar(50) NOT NULL,
  `Prenume` varchar(50) NOT NULL,
  `CNP` char(13) NOT NULL,
  `Oras` varchar(50) NOT NULL,
  `Strada` varchar(50) NOT NULL,
  `NrTel` char(13) NOT NULL,
  `Sex` char(1) NOT NULL,
  `DataNasterii` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Salariu` decimal(8,2) NOT NULL,
  `SupervizorID` int(11) DEFAULT NULL,
  `LinieProductieID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `angajati`
--

INSERT INTO `angajati` (`AngajatiD`, `Nume`, `Prenume`, `CNP`, `Oras`, `Strada`, `NrTel`, `Sex`, `DataNasterii`, `Salariu`, `SupervizorID`, `LinieProductieID`) VALUES
(3, 'Gicu ', 'Sandu', '1750124166555', 'Buzau', 'Foamei', '0761876680', 'M', '2023-12-10 22:28:35', '5600.00', 10, 3),
(4, 'Andrei', 'Cosmin', '1801231419299', 'Urziceni', 'Ion Creanga', '0777292837', 'M', '2023-11-23 18:43:07', '8000.00', 3, 4),
(10, 'Johnny', 'Deeper', '1630609371083', 'Vaslui', 'Piratilor', '0761399902', 'M', '2023-12-03 15:43:44', '6600.00', NULL, 1),
(14, 'Admin', 'null', '1234', 'null', 'null', 'null', 'M', '0000-00-00 00:00:00', '0.00', NULL, NULL),
(15, 'Gaiciu', 'Martinel', '5001212341716', 'Alexandria', 'crizantemelor', '0724245678', 'M', '2023-12-10 22:28:16', '4890.00', NULL, 2),
(16, 'Lipianu', 'Ana', '2980512327197', 'Sibiu', 'Salamului', '0761234565', 'F', '1998-05-11 21:00:00', '3300.00', NULL, NULL),
(17, 'Lascu', 'Mihnea', '5020929161610', 'Craiova', 'Iasomiei', '0723261515', 'M', '2002-09-28 21:00:00', '9800.00', NULL, 5),
(18, 'Dorada', 'Vasile', '1890405519378', 'Calarasi', 'Tifoiului', '0761798999', 'M', '1989-04-04 21:00:00', '5600.00', NULL, 5);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `angajatiarticole`
--

CREATE TABLE `angajatiarticole` (
  `AngajatID` int(11) NOT NULL,
  `ArticolID` int(255) NOT NULL,
  `NrOreSaptamana` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `angajatiarticole`
--

INSERT INTO `angajatiarticole` (`AngajatID`, `ArticolID`, `NrOreSaptamana`) VALUES
(4, 21, 12),
(10, 20, 40),
(10, 22, 40),
(10, 33, 30),
(10, 34, 15),
(18, 35, 10);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `articoleexport`
--

CREATE TABLE `articoleexport` (
  `ArticolID` int(11) NOT NULL,
  `ExportID` int(11) NOT NULL,
  `NrBucati` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `articoleexport`
--

INSERT INTO `articoleexport` (`ArticolID`, `ExportID`, `NrBucati`) VALUES
(33, 1, 22),
(33, 2, 5),
(33, 3, 1),
(34, 1, 22),
(34, 2, 5),
(34, 3, 6),
(35, 2, 2),
(35, 3, 6);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `articolevestimentare`
--

CREATE TABLE `articolevestimentare` (
  `ArticolID` int(11) NOT NULL,
  `NumeModel` varchar(50) NOT NULL,
  `CodArticol` varchar(50) NOT NULL,
  `Pret` decimal(8,2) NOT NULL,
  `TermenLimita` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `LinieProductieID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `articolevestimentare`
--

INSERT INTO `articolevestimentare` (`ArticolID`, `NumeModel`, `CodArticol`, `Pret`, `TermenLimita`, `LinieProductieID`) VALUES
(20, 'Blugi', '42226', '120.00', '2024-01-23 22:00:00', 1),
(21, 'Hanorac', '225200', '56.00', '0000-00-00 00:00:00', 4),
(22, 'Pantaloni', '200794', '120.00', '2024-07-03 21:00:00', 1),
(33, 'Blugi', '32456', '145.00', '2024-05-19 21:00:00', 1),
(34, 'Camasa', '24654', '100.00', '2024-07-03 21:00:00', 1),
(35, 'Camasa', '345123', '95.00', '2024-08-08 21:00:00', 5);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `export`
--

CREATE TABLE `export` (
  `ExportID` int(11) NOT NULL,
  `Tara` varchar(50) NOT NULL,
  `Oras` varchar(50) NOT NULL,
  `Magazin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `export`
--

INSERT INTO `export` (`ExportID`, `Tara`, `Oras`, `Magazin`) VALUES
(1, 'Romania', 'Bucuresti', 'AFI'),
(2, 'UK', 'Birmingham', 'Bull Ring'),
(3, 'Depozit', 'Depozit', 'Depozit');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `intretinuti`
--

CREATE TABLE `intretinuti` (
  `IntretinuitID` int(11) NOT NULL,
  `Nume` varchar(50) NOT NULL,
  `Prenume` varchar(50) NOT NULL,
  `Sex` char(1) NOT NULL,
  `DataNasterii` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `AngajatID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `intretinuti`
--

INSERT INTO `intretinuti` (`IntretinuitID`, `Nume`, `Prenume`, `Sex`, `DataNasterii`, `AngajatID`) VALUES
(49, 'Johnny', 'Deeper', 'M', '2023-11-23 20:22:31', 10),
(68, 'Andrei', 'Cosmin', 'M', '2023-11-23 18:43:07', 4),
(70, 'Dorada', 'Vasile', 'M', '1989-04-04 21:00:00', 18);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `liniedeproductie`
--

CREATE TABLE `liniedeproductie` (
  `LinieProductieID` int(11) NOT NULL,
  `NumeBrand` varchar(50) NOT NULL,
  `CodRaion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `liniedeproductie`
--

INSERT INTO `liniedeproductie` (`LinieProductieID`, `NumeBrand`, `CodRaion`) VALUES
(1, 'Zara', '200794'),
(2, 'Bershka', '645322'),
(3, 'Pull&Bear', '544328'),
(4, 'H&M', '789543'),
(5, 'Reserved', '747971');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `angajati`
--
ALTER TABLE `angajati`
  ADD PRIMARY KEY (`AngajatiD`),
  ADD KEY `angajati_linie` (`LinieProductieID`),
  ADD KEY `angajati_supervizor` (`SupervizorID`);

--
-- Indexuri pentru tabele `angajatiarticole`
--
ALTER TABLE `angajatiarticole`
  ADD PRIMARY KEY (`AngajatID`,`ArticolID`),
  ADD KEY `articole_angajat` (`ArticolID`);

--
-- Indexuri pentru tabele `articoleexport`
--
ALTER TABLE `articoleexport`
  ADD PRIMARY KEY (`ArticolID`,`ExportID`),
  ADD KEY `exporturi_articol` (`ExportID`);

--
-- Indexuri pentru tabele `articolevestimentare`
--
ALTER TABLE `articolevestimentare`
  ADD PRIMARY KEY (`ArticolID`),
  ADD KEY `linie_articole` (`LinieProductieID`);

--
-- Indexuri pentru tabele `export`
--
ALTER TABLE `export`
  ADD PRIMARY KEY (`ExportID`);

--
-- Indexuri pentru tabele `intretinuti`
--
ALTER TABLE `intretinuti`
  ADD PRIMARY KEY (`IntretinuitID`),
  ADD KEY `angajat_intretinuti` (`AngajatID`);

--
-- Indexuri pentru tabele `liniedeproductie`
--
ALTER TABLE `liniedeproductie`
  ADD PRIMARY KEY (`LinieProductieID`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `angajati`
--
ALTER TABLE `angajati`
  MODIFY `AngajatiD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pentru tabele `angajatiarticole`
--
ALTER TABLE `angajatiarticole`
  MODIFY `AngajatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pentru tabele `articoleexport`
--
ALTER TABLE `articoleexport`
  MODIFY `ArticolID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pentru tabele `articolevestimentare`
--
ALTER TABLE `articolevestimentare`
  MODIFY `ArticolID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pentru tabele `export`
--
ALTER TABLE `export`
  MODIFY `ExportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pentru tabele `intretinuti`
--
ALTER TABLE `intretinuti`
  MODIFY `IntretinuitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pentru tabele `liniedeproductie`
--
ALTER TABLE `liniedeproductie`
  MODIFY `LinieProductieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `angajati`
--
ALTER TABLE `angajati`
  ADD CONSTRAINT `angajati_linie` FOREIGN KEY (`LinieProductieID`) REFERENCES `liniedeproductie` (`LinieProductieID`),
  ADD CONSTRAINT `angajati_supervizor` FOREIGN KEY (`SupervizorID`) REFERENCES `angajati` (`AngajatiD`);

--
-- Constrângeri pentru tabele `angajatiarticole`
--
ALTER TABLE `angajatiarticole`
  ADD CONSTRAINT `angajati_articol` FOREIGN KEY (`AngajatID`) REFERENCES `angajati` (`AngajatiD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articole_angajat` FOREIGN KEY (`ArticolID`) REFERENCES `articolevestimentare` (`ArticolID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `articoleexport`
--
ALTER TABLE `articoleexport`
  ADD CONSTRAINT `articole_export` FOREIGN KEY (`ArticolID`) REFERENCES `articolevestimentare` (`ArticolID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exporturi_articol` FOREIGN KEY (`ExportID`) REFERENCES `export` (`ExportID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `articolevestimentare`
--
ALTER TABLE `articolevestimentare`
  ADD CONSTRAINT `linie_articole` FOREIGN KEY (`LinieProductieID`) REFERENCES `liniedeproductie` (`LinieProductieID`);

--
-- Constrângeri pentru tabele `intretinuti`
--
ALTER TABLE `intretinuti`
  ADD CONSTRAINT `angajat_intretinuti` FOREIGN KEY (`AngajatID`) REFERENCES `angajati` (`AngajatiD`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
