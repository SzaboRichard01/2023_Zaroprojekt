-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Jan 22. 13:14
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
  `edzesterv` varchar(255) NOT NULL,
  `edzesterv_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `edzesterv`
--

CREATE TABLE `edzesterv` (
  `edzesterv_id` int(255) NOT NULL,
  `neve` varchar(40) NOT NULL,
  `leiras` varchar(255) DEFAULT NULL,
  `edzo_az` int(255) NOT NULL,
  `felhasznalo_az` int(255) NOT NULL,
  `edzesnapok` int(1) NOT NULL,
  `edzo-felhasznalo_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `edzo-felhasznalo`
--

CREATE TABLE `edzo-felhasznalo` (
  `edzo-felhasznalo_id` int(255) NOT NULL,
  `edzo_az` int(255) NOT NULL,
  `kliens_az` int(255) NOT NULL,
  `kapcs_kezdete` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `edzo_felkeres`
--

CREATE TABLE `edzo_felkeres` (
  `edzo_felkeres_id` int(255) NOT NULL,
  `kuldo_az` int(255) NOT NULL,
  `fogado_az` int(255) NOT NULL,
  `elfogadva` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `etrend`
--

CREATE TABLE `etrend` (
  `etrend_id` int(255) NOT NULL,
  `nap` varchar(10) NOT NULL,
  `etrend` varchar(255) NOT NULL,
  `edzesterv_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

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
  `kepzettseg` varchar(255) DEFAULT NULL,
  `tapasztalat` int(2) DEFAULT NULL,
  `telefon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`felhasznalo_id`, `vnev`, `knev`, `email`, `jelszo`, `profil_tipus`, `kep`, `nem`, `online`, `kepzettseg`, `tapasztalat`, `telefon`) VALUES
(2, 'Szabó', 'Richárd', 'valami@gmail.com', 'valami', 'edző', '1674389602.jpg', 'férfi', 0, 'Személyi Edző', 3, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `uzenet`
--

CREATE TABLE `uzenet` (
  `uzenet_id` int(255) NOT NULL,
  `ki_az` int(255) NOT NULL,
  `kinek_az` int(255) NOT NULL,
  `mikor` datetime NOT NULL,
  `uzenet` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

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
  ADD KEY `edzo-felhasznalo_id` (`edzo-felhasznalo_id`);

--
-- A tábla indexei `edzo-felhasznalo`
--
ALTER TABLE `edzo-felhasznalo`
  ADD PRIMARY KEY (`edzo-felhasznalo_id`),
  ADD KEY `edzo_az` (`edzo_az`),
  ADD KEY `kliens_az` (`kliens_az`);

--
-- A tábla indexei `edzo_felkeres`
--
ALTER TABLE `edzo_felkeres`
  ADD PRIMARY KEY (`edzo_felkeres_id`),
  ADD KEY `kuldo_az` (`kuldo_az`),
  ADD KEY `fogado_az` (`fogado_az`);

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
  ADD KEY `ki_az` (`ki_az`),
  ADD KEY `kinek_az` (`kinek_az`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `edzes`
--
ALTER TABLE `edzes`
  MODIFY `edzes_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `edzesterv`
--
ALTER TABLE `edzesterv`
  MODIFY `edzesterv_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `edzo-felhasznalo`
--
ALTER TABLE `edzo-felhasznalo`
  MODIFY `edzo-felhasznalo_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `edzo_felkeres`
--
ALTER TABLE `edzo_felkeres`
  MODIFY `edzo_felkeres_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `etrend`
--
ALTER TABLE `etrend`
  MODIFY `etrend_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `felhasznalo_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `uzenet`
--
ALTER TABLE `uzenet`
  MODIFY `uzenet_id` int(255) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `edzesterv_ibfk_1` FOREIGN KEY (`edzo-felhasznalo_id`) REFERENCES `edzo-felhasznalo` (`edzo-felhasznalo_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `edzo-felhasznalo`
--
ALTER TABLE `edzo-felhasznalo`
  ADD CONSTRAINT `edzo-felhasznalo_ibfk_1` FOREIGN KEY (`edzo_az`) REFERENCES `felhasznalok` (`felhasznalo_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `edzo-felhasznalo_ibfk_2` FOREIGN KEY (`kliens_az`) REFERENCES `felhasznalok` (`felhasznalo_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `edzo_felkeres`
--
ALTER TABLE `edzo_felkeres`
  ADD CONSTRAINT `edzo_felkeres_ibfk_1` FOREIGN KEY (`kuldo_az`) REFERENCES `felhasznalok` (`felhasznalo_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `edzo_felkeres_ibfk_2` FOREIGN KEY (`fogado_az`) REFERENCES `felhasznalok` (`felhasznalo_id`);

--
-- Megkötések a táblához `etrend`
--
ALTER TABLE `etrend`
  ADD CONSTRAINT `etrend_ibfk_1` FOREIGN KEY (`edzesterv_id`) REFERENCES `edzesterv` (`edzesterv_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `uzenet`
--
ALTER TABLE `uzenet`
  ADD CONSTRAINT `uzenet_ibfk_1` FOREIGN KEY (`ki_az`) REFERENCES `felhasznalok` (`felhasznalo_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `uzenet_ibfk_2` FOREIGN KEY (`kinek_az`) REFERENCES `felhasznalok` (`felhasznalo_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
