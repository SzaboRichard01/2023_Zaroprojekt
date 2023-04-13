-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Ápr 13. 09:25
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
  `nap` varchar(16) NOT NULL,
  `edzesterv` text NOT NULL,
  `terv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `edzestervek`
--

INSERT INTO `edzestervek` (`edzes_id`, `nap`, `edzesterv`, `terv_id`) VALUES
(18, 'Hétfő', '<p>hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</p>', 4),
(19, 'Szerda', '<p>sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</p>', 4),
(21, 'Minden alkalomra', '<p>lllllllllllllllllllllllllllllllllllllllll</p>', 6),
(28, 'Hétfő', '<p>h111</p>', 8),
(29, 'Hétfő', '<p>h222</p>', 8),
(30, 'Szerda', '<p>sz</p>', 8),
(32, 'Hétfő', '<p>hétfő teszt</p><h1>gfdgfdgdf</h1><div><span style=\"background-color: rgb(192, 80, 77);\">jjjjjjjjjjjjjjjjjjjj</span></div>', 10),
(33, 'Szerda', '<p>szerda gfdg<strike>dfgdfgdfgd</strike>f</p>', 10),
(38, 'Hétfő', '<p>e1eeeeeee</p>\r\n', 11),
(39, 'Péntek', '<p>e2eeeee</p>\r\n', 11),
(41, 'Szerda', '<p>11</p>', 14),
(42, 'Minden alkalomra', '<p>jkljkjklk</p>\r\n', 13),
(55, 'Csütörtök', '<p></p><div><table><tbody><tr><td>11111</td><td>22222222222</td><td>3333333333</td></tr><tr><td>e</td><td>k</td><td>h</td></tr></tbody></table><br></div><ul><li>ljkljkl</li><li>ljkljkl</li><li>ljkljkl</li><li>ljkljkl</li></ul><p></p><ol><li>sdfsfsd</li><li>fdsfsdfsd</li><li>sdfsdf</li></ol><p></p><p></p>\r\n', 7),
(56, 'Hétfő', '<p>hhhhhhhhh</p>', 7),
(57, 'Kedd', '<p>kkkkkkkkk</p>', 7),
(58, 'Szerda', '<p>ssssssssss</p>', 7),
(59, 'Péntek', '<p>ppppppppp</p>', 7),
(60, 'Szombat', '<p>szzzzzzz</p>', 7),
(61, 'Minden alkalomra', '<p>222222222222</p>', 15);

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

--
-- A tábla adatainak kiíratása `edzoklienskapcs`
--

INSERT INTO `edzoklienskapcs` (`kapcs_id`, `kuldo_az`, `fogado_az`, `elfogadva`, `felkeres_datuma`, `kapcs_kezdete`) VALUES
(2, 1, 9, 1, '2023-04-03 09:54:49', '2023-04-03 09:55:00'),
(3, 5, 1, 1, '2023-04-04 10:56:34', '2023-04-04 10:56:41'),
(4, 9, 11, 1, '2023-04-13 07:46:24', '2023-04-13 07:52:42'),
(5, 11, 5, 1, '2023-04-13 07:51:15', '2023-04-13 07:53:11');

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

--
-- A tábla adatainak kiíratása `etrendek`
--

INSERT INTO `etrendek` (`etrend_id`, `nap`, `etrend`, `terv_id`) VALUES
(3, 'Hétfő', '<p>111111111111111111111111111111111111111111111111111111111111111111111</p>', 4),
(4, 'Szerda', '<p>3333333333333333333333333333333333333333333333333333333333</p>', 4),
(6, 'Hétfő', '<p>ppppppppppppppppp</p>', 6),
(7, 'Szombat', '<p>ppppppppppppppppppppp</p>', 6),
(9, 'Kedd', '<p>k111</p>', 8),
(10, 'Kedd', '<p>k222</p>', 8),
(11, 'Szombat', '<p>szsz</p>', 8),
(12, 'Hétfő', '<p>hétfő</p><p><ol><li>fdsfsdfsd</li><li>fsdfsdf</li><li>sdfsdfsdf</li></ol></p>', 10),
(13, 'Szerda', '<p>szerda</p><p>szszszszszszszszszszszszszszszszszszszszszszszszszszszsz</p>', 10),
(14, 'Péntek', '<p>péntek</p><p>pp<b>pppppppp</b>ppppppppppppppp</p>', 10),
(18, 'Hétfő', '<p>é1ééééééé</p>\r\n', 11),
(19, 'Péntek', '<p>é2éééééééééé</p>\r\n', 11),
(20, 'Vasárnap', '<p>é3ééééééééééé</p>\r\n', 11),
(22, 'Minden alk', '<h1>ááááááá</h1><p>é<i>ééééééé</i>ééééééééé<strike>ééééééééééééééééééé</strike>éééééééééééééééééééééééééé<b>ééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééé</b>éééééééééééééééééééééééééééééééééééééééé</p>\r\n', 12),
(25, 'Minden alk', '<p>mmmmmm</p><p><table><tbody><tr><td>11111</td><td>22222222222</td><td>3333333333</td></tr><tr><td>e</td><td>k</td><td>h</td></tr></tbody></table><br></p><p></p><ul><li>ljkljkljkl</li><li>kljkl</li><li>jkljkl</li></ul><p></p><p></p><ol><li>jkljkl</li><li>jkljkl</li><li>lkjljkj</li></ol><p></p>\r\n', 7);

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
(1, 'Szabó', 'Richárd', 'pelda@gmail.com', '$2y$10$2G7wd/fLUU1WBHCoCGfqVedDTteliK0ZeORMVvdScHB1v2rKKSbIy', 'edző', '1679050736.jpeg', 1, '<p>Személyre szabott edzésterveket készítek az ügyfeleimnek, fizikai adottságait, idejét és kérését figyelembe véve, valamint ennek megfelelően étrendet is a hatékonyabb eredmények elérésének érdekében. Várom leendő klienseim jelentkezését!<br></p><p><table><tbody><tr><td>11111</td><td>22222222222</td><td>3333333333</td></tr><tr><td>e</td><td>k</td><td>h</td></tr></tbody></table><br></p><p></p><ul><li>jhgjghj</li><li>jghjghj</li><li>hgjghjhg</li></ul><p></p><ol><li>ghjhgj</li><li>ghjghj</li><li>ghjghjg</li></ol><p></p><p></p>\r\n', '+36201234567'),
(2, 'Híves', 'Sebastian', 'sebihives2001@gmail.com', '$2y$10$LMEes.8nKycHExaH/k317eGFIkAvfcvlmwgtECmuPd35zuYArOAza', 'edző', '1680080537.jpeg', 1, '<p>Több éves edzői szakmai tapasztalattal rendelkezem. Személyre szabott edzésterveket készítek az ügyfeleimnek, fizikai adottságait, idejét és kérését figyelembe véve, valamint ennek megfelelően étrendet is a hatékonyabb eredmények elérésének érdekében. Várom leendő klienseim jelentkezését!<br></p>', '+4219156297'),
(5, 'Tóth', 'Ildikó', 'tildiko34@gmail.com', '$2y$10$4pikLxHsX9XrO10Sj3EDZesYbyXNP0rvWukrTMGU8bRt49x6SdnWK', 'kliens', '1680164255.jpeg', 0, '', NULL),
(9, 'Kiss', 'Péter', 'peterk1@gmail.com', '$2y$10$GqnS5czFnLJ8py2F8yIMUe.6LbthFEPT84OXyO/33T7e2SQA7W4tK', 'kliens', 'nincskep.png', 1, '', ''),
(11, 'Teszt', 'Edző', 'edzo@gmail.com', '$2y$10$qQ6MCMeA.0UH8hZcGWfrD.rDgfKe/f4nlFrzuKouD.PcAZxYdkFEm', 'edző', 'nincskep.png', 1, '<p>gfffffffffffffffffffffffffffffddddddddddddddddddddddddddddddddddddddddddddd</p>', '36201234567');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `feljegyzesek`
--

CREATE TABLE `feljegyzesek` (
  `felj_id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `leiras` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `feljegyzesek`
--

INSERT INTO `feljegyzesek` (`felj_id`, `felhasznalo_id`, `datum`, `leiras`) VALUES
(1, 9, '2023-04-04', '<p>kjkljkj</p><ul><li>hgjghj</li><li>ghjghj</li><li>ghjghj</li></ul><ol><li>ghjghj</li><li>ghjghj</li><li>ghjghj</li></ol><p></p><table id=\"table65905\"><tbody><tr><td>rewrwe<br></td><td>rrrrr<br></td><td>ttttttttt<br></td></tr><tr><td>111<br></td><td>2222<br></td><td>4444444444444444444444444<br></td></tr></tbody></table><p></p><br><p></p>\n'),
(3, 5, '2023-04-13', '<p>eeeeeeeeeeeeeeeeeeaaa<b>aaaaa</b>aa</p>\r\n'),
(6, 5, '2023-04-14', '<p>cccccccccccccccc</p><p><ol><li>jhkhjk</li><li>hjk</li><li>hj</li><li>k</li><li>k</li><li>hjkhjk</li></ol></p>\r\n'),
(10, 5, '2023-04-14', '<p>111111111111111111111111111111111111</p>'),
(11, 5, '2023-05-02', '<p>222222222222</p>'),
(12, 5, '2023-05-01', '<p>33333333333</p>'),
(14, 5, '2023-05-04', '<p>44444444444444444444444444444</p>'),
(18, 5, '2023-05-13', '<p>99999999999999999999999999999</p>');

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

--
-- A tábla adatainak kiíratása `terv`
--

INSERT INTO `terv` (`terv_id`, `neve`, `leiras`, `kapcs_id`) VALUES
(4, 'Pelda', '<p>elso</p>', 2),
(6, 'ujra', '<p>klkélékll</p>', 2),
(7, '33333', '<p></p><div><table id=\"table33795\"><tbody><tr><td>11111</td><td>22222222222</td><td>3333333333</td></tr><tr><td>e</td><td>k</td><td>h</td></tr></tbody></table><p></p><br></div><ul><li>ljkljkl</li><li>ljkljkl</li><li>ljkljkl</li><li>ljkljkl</li></ul><p></p><ol><li>sdfsfsd</li><li>fdsfsdfsd</li><li>sdfsdf</li></ol><p></p><p></p>\r\n', 2),
(8, 'teszt1111', '<p>11</p>\r\n', 2),
(10, 'teszt222224', '<p><span style=\"background-color: rgb(31, 73, 125);\">2222222gfdgdfgdfgdf</span></p>\r\n', 2),
(11, 'eterv és étrend teszttttttttt', '<p>teszttttttt<b><strike>ttjhkhjkhjkhj</strike></b></p>\r\n', 2),
(12, 'ááááááááá', '', 2),
(13, '10', '', 2),
(14, '11', '<p>11</p>', 2),
(15, 'hjjjjjjjjjjjjjjjjjjjjg', '', 5);

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
-- A tábla adatainak kiíratása `uzenetek`
--

INSERT INTO `uzenetek` (`uzenet_id`, `kimeno_id`, `bejovo_id`, `uzenet`) VALUES
(8, 1, 9, 'kélklékél'),
(9, 1, 9, 'kélklékél'),
(10, 1, 9, 'hgfhfg'),
(11, 1, 9, 'hgfhfg');

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
-- A tábla indexei `feljegyzesek`
--
ALTER TABLE `feljegyzesek`
  ADD PRIMARY KEY (`felj_id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`);

--
-- A tábla indexei `terv`
--
ALTER TABLE `terv`
  ADD PRIMARY KEY (`terv_id`),
  ADD KEY `edzo-felhasznalo_id` (`kapcs_id`);

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
  MODIFY `edzes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT a táblához `edzoklienskapcs`
--
ALTER TABLE `edzoklienskapcs`
  MODIFY `kapcs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `etrendek`
--
ALTER TABLE `etrendek`
  MODIFY `etrend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `felhasznalo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `feljegyzesek`
--
ALTER TABLE `feljegyzesek`
  MODIFY `felj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT a táblához `terv`
--
ALTER TABLE `terv`
  MODIFY `terv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT a táblához `uzenetek`
--
ALTER TABLE `uzenetek`
  MODIFY `uzenet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Megkötések a táblához `feljegyzesek`
--
ALTER TABLE `feljegyzesek`
  ADD CONSTRAINT `feljegyzesek_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`felhasznalo_id`);

--
-- Megkötések a táblához `terv`
--
ALTER TABLE `terv`
  ADD CONSTRAINT `terv_ibfk_1` FOREIGN KEY (`kapcs_id`) REFERENCES `edzoklienskapcs` (`kapcs_id`) ON DELETE CASCADE;

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
