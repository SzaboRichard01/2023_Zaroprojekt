-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Már 13. 11:32
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
-- Tábla szerkezet ehhez a táblához `edzes`
--

CREATE TABLE `edzes` (
  `edzes_id` int(255) NOT NULL,
  `nap` varchar(10) NOT NULL,
  `edzesterv` text NOT NULL,
  `edzesterv_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `edzes`
--

INSERT INTO `edzes` (`edzes_id`, `nap`, `edzesterv`, `edzesterv_id`) VALUES
(1, 'Hétfő', '20 fekvőtámasz - 3 ismétlés\r\n30 felülés - 2 ismétlés', 1),
(2, 'Kedd', 'nyújtás\r\n2km futás', 1),
(3, 'Csütörtök', '70kg felhúzás 5x 2 ismétlés', 1),
(4, 'Hétfő', '1', 2),
(5, 'Szerda', '2', 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `edzesterv`
--

CREATE TABLE `edzesterv` (
  `edzesterv_id` int(255) NOT NULL,
  `neve` varchar(40) NOT NULL,
  `leiras` varchar(255) DEFAULT NULL,
  `ekkapcs_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `edzesterv`
--

INSERT INTO `edzesterv` (`edzesterv_id`, `neve`, `leiras`, `ekkapcs_id`) VALUES
(1, 'Edzésterv Teszt Kliens számára', 'valami', 3),
(2, 'Teszt Edzésterv', '', 4);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ekkapcs`
--

CREATE TABLE `ekkapcs` (
  `ekkapcs_id` int(255) NOT NULL,
  `kuldo_az` int(255) NOT NULL,
  `fogado_az` int(255) NOT NULL,
  `elfogadva` tinyint(1) NOT NULL,
  `felkeres_datuma` datetime NOT NULL,
  `kapcs_kezdete` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `ekkapcs`
--

INSERT INTO `ekkapcs` (`ekkapcs_id`, `kuldo_az`, `fogado_az`, `elfogadva`, `felkeres_datuma`, `kapcs_kezdete`) VALUES
(1, 4, 1, 1, '2023-03-13 10:02:18', '2023-03-13 10:05:21'),
(2, 4, 2, 0, '2023-03-13 10:02:26', '0000-00-00 00:00:00'),
(3, 1, 3, 1, '2023-03-13 10:02:56', '2023-03-13 10:03:24'),
(4, 6, 3, 1, '2023-03-13 10:25:55', '2023-03-13 10:26:01');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `etrend`
--

CREATE TABLE `etrend` (
  `etrend_id` int(255) NOT NULL,
  `nap` varchar(10) NOT NULL,
  `etrend` text NOT NULL,
  `edzesterv_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `etrend`
--

INSERT INTO `etrend` (`etrend_id`, `nap`, `etrend`, `edzesterv_id`) VALUES
(1, 'Hétfő', 'valami1', 1),
(2, 'Szerda', 'valami2', 1),
(3, 'Szerda', '3', 2),
(4, 'Péntek', '5', 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `felhasznalo_id` int(255) NOT NULL,
  `vnev` varchar(255) NOT NULL,
  `knev` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `profil_tipus` varchar(6) NOT NULL,
  `kep` varchar(255) NOT NULL,
  `nem` varchar(10) NOT NULL,
  `online` tinyint(1) NOT NULL,
  `bemutatkozo` text DEFAULT NULL,
  `telefon` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`felhasznalo_id`, `vnev`, `knev`, `email`, `jelszo`, `profil_tipus`, `kep`, `nem`, `online`, `bemutatkozo`, `telefon`) VALUES
(1, 'Szabó', 'Richárd', 'valami@gmail.com', 'valami', 'edző', '1678695541.jpeg', 'férfi', 0, 'gfdkgldfégmkédfmgkdfngkdfngkldfngdflk', '06201234567'),
(2, 'Híves', 'Sebastian', 'sebihives2001@gmail.com', 'Valami123', 'edző', 'nincskep.png', 'férfi', 0, 'hgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggfhgfhgfhggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggf', '06201234567'),
(3, 'Teszt', 'Kliens', 'kliens@gmail.com', 'kliens', 'kliens', '1678697347.jpeg', 'nő', 0, NULL, NULL),
(4, 'Teszt', 'Kliens2', 'kliens2@gmail.com', 'kliens2', 'kliens', 'nincskep.png', 'férfi', 0, NULL, NULL),
(6, 'Teszt', 'Edzo', 'edzo@gmail.com', 'edzo', 'edző', 'nincskep.png', 'férfi', 0, '', ''),
(7, 'Teszt', 'Kliens3', 'kliens3@gmail.com', 'kliens3', 'kliens', 'nincskep.png', 'férfi', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `uzenet`
--

CREATE TABLE `uzenet` (
  `uzenet_id` int(255) NOT NULL,
  `kimeno_id` int(255) NOT NULL,
  `bejovo_id` int(255) NOT NULL,
  `mikor` datetime NOT NULL,
  `uzenet` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `uzenet`
--

INSERT INTO `uzenet` (`uzenet_id`, `kimeno_id`, `bejovo_id`, `mikor`, `uzenet`) VALUES
(2, 1, 3, '2023-03-13 10:29:49', 'Szia'),
(3, 3, 1, '2023-03-13 10:29:58', 'Hello');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `edzes`
--
ALTER TABLE `edzes`
  ADD PRIMARY KEY (`edzes_id`),
  ADD KEY `edzesterv_id` (`edzesterv_id`);

--
-- A tábla indexei `edzesterv`
--
ALTER TABLE `edzesterv`
  ADD PRIMARY KEY (`edzesterv_id`),
  ADD KEY `edzo-felhasznalo_id` (`ekkapcs_id`);

--
-- A tábla indexei `ekkapcs`
--
ALTER TABLE `ekkapcs`
  ADD PRIMARY KEY (`ekkapcs_id`),
  ADD KEY `edzo_az` (`kuldo_az`),
  ADD KEY `kliens_az` (`fogado_az`);

--
-- A tábla indexei `etrend`
--
ALTER TABLE `etrend`
  ADD PRIMARY KEY (`etrend_id`),
  ADD KEY `edzesterv_id` (`edzesterv_id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`felhasznalo_id`);

--
-- A tábla indexei `uzenet`
--
ALTER TABLE `uzenet`
  ADD PRIMARY KEY (`uzenet_id`),
  ADD KEY `ki_az` (`kimeno_id`),
  ADD KEY `kinek_az` (`bejovo_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `edzes`
--
ALTER TABLE `edzes`
  MODIFY `edzes_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `edzesterv`
--
ALTER TABLE `edzesterv`
  MODIFY `edzesterv_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `ekkapcs`
--
ALTER TABLE `ekkapcs`
  MODIFY `ekkapcs_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `etrend`
--
ALTER TABLE `etrend`
  MODIFY `etrend_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `felhasznalo_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `uzenet`
--
ALTER TABLE `uzenet`
  MODIFY `uzenet_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `edzes`
--
ALTER TABLE `edzes`
  ADD CONSTRAINT `edzes_ibfk_1` FOREIGN KEY (`edzesterv_id`) REFERENCES `edzesterv` (`edzesterv_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `edzesterv`
--
ALTER TABLE `edzesterv`
  ADD CONSTRAINT `edzesterv_ibfk_1` FOREIGN KEY (`ekkapcs_id`) REFERENCES `ekkapcs` (`ekkapcs_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `ekkapcs`
--
ALTER TABLE `ekkapcs`
  ADD CONSTRAINT `ekkapcs_ibfk_1` FOREIGN KEY (`kuldo_az`) REFERENCES `felhasznalok` (`felhasznalo_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ekkapcs_ibfk_2` FOREIGN KEY (`fogado_az`) REFERENCES `felhasznalok` (`felhasznalo_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `etrend`
--
ALTER TABLE `etrend`
  ADD CONSTRAINT `etrend_ibfk_1` FOREIGN KEY (`edzesterv_id`) REFERENCES `edzesterv` (`edzesterv_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `uzenet`
--
ALTER TABLE `uzenet`
  ADD CONSTRAINT `uzenet_ibfk_1` FOREIGN KEY (`kimeno_id`) REFERENCES `felhasznalok` (`felhasznalo_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `uzenet_ibfk_2` FOREIGN KEY (`bejovo_id`) REFERENCES `felhasznalok` (`felhasznalo_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
