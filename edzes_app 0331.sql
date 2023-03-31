-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Már 31. 11:22
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `edzes_app`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `edzestervek`
--

CREATE TABLE `edzestervek` (
  `edzes_id` int(11) NOT NULL,
  `nap` varchar(10) NOT NULL,
  `edzesterv` text NOT NULL,
  `terv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `edzoklienskapcs`
--

CREATE TABLE `edzoklienskapcs` (
  `kapcs_id` int(11) NOT NULL,
  `kuldo_az` int(11) NOT NULL,
  `fogado_az` int(11) NOT NULL,
  `elfogadva` tinyint(1) NOT NULL,
  `felkeres_datuma` datetime NOT NULL,
  `kapcs_kezdete` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `etrendek`
--

CREATE TABLE `etrendek` (
  `etrend_id` int(11) NOT NULL,
  `nap` varchar(10) NOT NULL,
  `etrend` text NOT NULL,
  `terv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `felhasznalo_id` int(11) NOT NULL,
  `vnev` varchar(50) NOT NULL,
  `knev` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `profil_tipus` varchar(6) NOT NULL,
  `kep` varchar(255) NOT NULL,
  `nem` tinyint(1) NOT NULL,
  `bemutatkozo` text DEFAULT NULL,
  `telefon` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`felhasznalo_id`, `vnev`, `knev`, `email`, `jelszo`, `profil_tipus`, `kep`, `nem`, `bemutatkozo`, `telefon`) VALUES
(1, 'Szabó', 'Richárd', 'pelda@gmail.com', '$2y$10$2G7wd/fLUU1WBHCoCGfqVedDTteliK0ZeORMVvdScHB1v2rKKSbIy', 'edző', '1679050736.jpeg', 1, '<p>Személyre szabott edzésterveket készítek az ügyfeleimnek, fizikai adottságait, idejét és kérését figyelembe véve, valamint ennek megfelelően étrendet is a hatékonyabb eredmények elérésének érdekében. Várom leendő klienseim jelentkezését!<br></p>', '+36201234567'),
(2, 'Híves', 'Sebastian', 'sebihives2001@gmail.com', '$2y$10$LMEes.8nKycHExaH/k317eGFIkAvfcvlmwgtECmuPd35zuYArOAza', 'edző', '1680080537.jpeg', 1, '<p>Több éves edzői szakmai tapasztalattal rendelkezem. Személyre szabott edzésterveket készítek az ügyfeleimnek, fizikai adottságait, idejét és kérését figyelembe véve, valamint ennek megfelelően étrendet is a hatékonyabb eredmények elérésének érdekében. Várom leendő klienseim jelentkezését!<br></p>', '+4219156297'),
(5, 'Tóth', 'Ildikó', 'tildoko34@gmail.com', '$2y$10$eFsImHeLP2fZt6/nQnePx.2CP/XCthfZUtudoze8tc/0A/pOJKpcW', 'kliens', '1680164255.jpeg', 0, '', NULL),
(9, 'Kiss', 'Péter', 'peterk1@gmail.com', '$2y$10$GqnS5czFnLJ8py2F8yIMUe.6LbthFEPT84OXyO/33T7e2SQA7W4tK', 'kliens', 'nincskep.png', 1, '', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `terv`
--

CREATE TABLE `terv` (
  `terv_id` int(11) NOT NULL,
  `neve` varchar(40) NOT NULL,
  `leiras` text DEFAULT NULL,
  `kapcs_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tevekenysegek`
--

CREATE TABLE `tevekenysegek` (
  `tev_id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `leiras` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `uzenetek`
--

CREATE TABLE `uzenetek` (
  `uzenet_id` int(11) NOT NULL,
  `kimeno_id` int(11) NOT NULL,
  `bejovo_id` int(11) NOT NULL,
  `uzenet` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `edzestervek`
--
ALTER TABLE `edzestervek`
  ADD PRIMARY KEY (`edzes_id`),
  ADD KEY `edzesterv_id` (`terv_id`);

--
-- A tábla indexei `edzoklienskapcs`
--
ALTER TABLE `edzoklienskapcs`
  ADD PRIMARY KEY (`kapcs_id`),
  ADD KEY `edzo_az` (`kuldo_az`),
  ADD KEY `kliens_az` (`fogado_az`);

--
-- A tábla indexei `etrendek`
--
ALTER TABLE `etrendek`
  ADD PRIMARY KEY (`etrend_id`),
  ADD KEY `edzesterv_id` (`terv_id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`felhasznalo_id`);

--
-- A tábla indexei `terv`
--
ALTER TABLE `terv`
  ADD PRIMARY KEY (`terv_id`),
  ADD KEY `edzo-felhasznalo_id` (`kapcs_id`);

--
-- A tábla indexei `tevekenysegek`
--
ALTER TABLE `tevekenysegek`
  ADD PRIMARY KEY (`tev_id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`);

--
-- A tábla indexei `uzenetek`
--
ALTER TABLE `uzenetek`
  ADD PRIMARY KEY (`uzenet_id`),
  ADD KEY `ki_az` (`kimeno_id`),
  ADD KEY `kinek_az` (`bejovo_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `edzestervek`
--
ALTER TABLE `edzestervek`
  MODIFY `edzes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `edzoklienskapcs`
--
ALTER TABLE `edzoklienskapcs`
  MODIFY `kapcs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `etrendek`
--
ALTER TABLE `etrendek`
  MODIFY `etrend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `felhasznalo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `terv`
--
ALTER TABLE `terv`
  MODIFY `terv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `tevekenysegek`
--
ALTER TABLE `tevekenysegek`
  MODIFY `tev_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `uzenetek`
--
ALTER TABLE `uzenetek`
  MODIFY `uzenet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `edzestervek`
--
ALTER TABLE `edzestervek`
  ADD CONSTRAINT `edzestervek_ibfk_1` FOREIGN KEY (`terv_id`) REFERENCES `terv` (`terv_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `edzoklienskapcs`
--
ALTER TABLE `edzoklienskapcs`
  ADD CONSTRAINT `edzoklienskapcs_ibfk_1` FOREIGN KEY (`kuldo_az`) REFERENCES `felhasznalok` (`felhasznalo_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `edzoklienskapcs_ibfk_2` FOREIGN KEY (`fogado_az`) REFERENCES `felhasznalok` (`felhasznalo_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `etrendek`
--
ALTER TABLE `etrendek`
  ADD CONSTRAINT `etrendek_ibfk_1` FOREIGN KEY (`terv_id`) REFERENCES `terv` (`terv_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `terv`
--
ALTER TABLE `terv`
  ADD CONSTRAINT `terv_ibfk_1` FOREIGN KEY (`kapcs_id`) REFERENCES `edzoklienskapcs` (`kapcs_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `tevekenysegek`
--
ALTER TABLE `tevekenysegek`
  ADD CONSTRAINT `tevekenysegek_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`felhasznalo_id`);

--
-- Megkötések a táblához `uzenetek`
--
ALTER TABLE `uzenetek`
  ADD CONSTRAINT `uzenetek_ibfk_1` FOREIGN KEY (`kimeno_id`) REFERENCES `felhasznalok` (`felhasznalo_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `uzenetek_ibfk_2` FOREIGN KEY (`bejovo_id`) REFERENCES `felhasznalok` (`felhasznalo_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
