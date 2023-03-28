-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Már 27. 11:22
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

--
-- A tábla adatainak kiíratása `edzestervek`
--

INSERT INTO `edzestervek` (`edzes_id`, `nap`, `edzesterv`, `terv_id`) VALUES
(19, 'Hétfő', '<p><table><thead><tr><td>Valami 11111111111111111111111111111111111111</td><td>teszt </td><td>pelda </td></tr><tr><td>1</td><td>3</td><td>5</td></tr><tr><td>2</td><td>4</td><td>6</td></tr></thead></table>fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</p><p>ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</p><p>fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff<br></p>', 17),
(22, 'hétfő', '<p>gfgdfgdf<br></p>', 20),
(23, 'ljkljk', '<p>jlkljk</p>', 21),
(24, 'kjhkh', '<p>khjkhj</p>', 22);

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
(1, 3, 1, 1, '2023-03-17 12:12:55', '2023-03-17 12:13:09'),
(2, 1, 4, 1, '2023-03-21 09:15:05', '2023-03-21 09:15:50'),
(5, 6, 1, 1, '2023-03-22 01:01:25', '2023-03-24 09:36:12'),
(8, 1, 7, 0, '2023-03-24 09:37:19', '0000-00-00 00:00:00'),
(9, 5, 7, 1, '2023-03-24 11:15:29', '2023-03-24 11:15:36');

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
(18, 'Szerda', '<p><table><thead><tr><td>Valami 11111111111111111111111111111111111111</td><td>teszt </td><td>pelda </td></tr><tr><td>1</td><td>3</td><td>5</td></tr><tr><td>2</td><td>4</td><td>6</td></tr></thead></table>bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb<br></p>', 17),
(21, 'Hétfő', '<p>jhgjghjhg<br></p>', 20),
(22, 'ljkljkl', '<p>ljkljkljk</p>', 21),
(23, 'khjkhj', '<p>khjkhj</p>', 22);

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
  `nem` varchar(10) NOT NULL,
  `bemutatkozo` text DEFAULT NULL,
  `telefon` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`felhasznalo_id`, `vnev`, `knev`, `email`, `jelszo`, `profil_tipus`, `kep`, `nem`, `bemutatkozo`, `telefon`) VALUES
(1, 'Szabó', 'Richárd', 'valami@gmail.com', '$2y$10$8xK7nlP2Zx80F3LXdPxVYuDL5C8JTVbl9bHWXU67GKlVpQE1Og9vW', 'edző', '1679050736.jpeg', 'férfi', '', ''),
(2, 'Híves', 'Sebastian', 'sebihives2001@gmail.com', '$2y$10$cW8YiByeMP.Mszhw1V9qV.5OalY9HTJCxoprnL4XrXbDhrl8K85g2', 'edző', 'nincskep.png', 'férfi', '11111111111111111111111111111111111111111111111111111111', '06201234567'),
(3, 'Teszt', 'Kliens', 'kliens@gmail.com', '$2y$10$SzSPrx2kJmrjt5lpZrHcSeqQrj1P34gkZOu7Y5ay8vJfxgoQeWvpq', 'kliens', '1679397111.jpeg', 'férfi', '<p>gffffffffffffffffffffffffffffffffffffffffffff<span style=\"background-color: rgb(192, 80, 77);\">ffffffffffffffffffffffffffffffffffffffffff</span>fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffd</p>', '06201234567'),
(4, 'Teszt', 'Kliens2', 'kliens2@gmail.com', '$2y$10$w9t1EZ.ou4h52RrR2ty0jOmfd/2maFptaUQE5GdG4vdnsuUscxl3q', 'kliens', 'nincskep.png', 'férfi', '<p><br></p>', ''),
(5, 'Teszt', 'Edző', 'edzo@gmail.com', '$2y$10$qkzaavnP9KZRoTk/Boju6Oeio/8cZzYkUmnZGzgpxfKijBiZDa.BC', 'edző', '1679400859.jpeg', 'férfi', '<h1><span style=\"background-color: rgb(255, 255, 255);\">3</span>3<span style=\"color: #c09100;\">3</span><span style=\"background-color: rgb(79, 129, 189);\"><span style=\"color: #ffffff;\">33333</span></span>333</h1><p>12312312312312<span style=\"background-color: rgb(227, 108, 9);\"><span style=\"color: #ffffff;\">31232131232131</span></span>23</p><ul><li><strike>fdhgfh</strike></li><li><b>gfhgfhf</b></li><li><i>gfhfghfg</i></li></ul><p>trr<strike>rrrrrrrrr</strike>rrrrrrrrrrrrrrrrrrrr<b>rrrrrrrrrrrrrrrrrrrrrrrrrrr</b>rrrrrrrrrrrrr<i>rrrrrrrrrrrrrrrr</i>rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrre<br></p>\r\n', '06201234564'),
(6, 'Teszt', 'Kliens3', 'kliens3@gmail.com', '$2y$10$k15BFd5GpyvNbR0NIUn5beGupjHfw.BnnXg.IDFTYYc5S/YEj30Gu', 'kliens', 'nincskep.png', 'férfi', '<p><br></p>', ''),
(7, 'Teszt', 'Kliens4', 'kliens4@gmail.com', '$2y$10$0UebjddasW5XQ206ZzMOKOu.kl3L8N436OCgMeqHGXAPbuyvT9w4u', 'kliens', 'nincskep.png', 'férfi', '<p>12345678911234567891123456789112345678911234567891123456789112345678911234567891</p>', '06201234567'),
(9, 'Teszt2', 'Edző', 'edzo2@gmail.com', '$2y$10$oCDhuPYapSqstvY6nxTtWOv.mSFwmoYJP0rlMnjU/8v5hZRlawv62', 'edző', '1679907239.jpeg', 'férfi', '<p>nbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbv</p>', '06201234567');

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
(17, 'Teszt', '<h1>Teszt</h1><p>kép teszt:</p><p><img src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTR6h5wcGaKcrNn4FzMNCyHNFFTwvdwBxNrjP-XF3SX&amp;s\" style=\"\"></p><p>Videó teszt:</p><p><br><iframe src=\"https://www.youtube.com/embed/CmpvcQ8WYpg\" title=\"YouTube video player\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen=\"\" width=\"560\" height=\"315\" frameborder=\"0\"></iframe></p><p></p><table id=\"table92106\"><thead><tr><td>Valami 11111111111111 <br></td><td>teszt 222222222222222 <br></td><td>pelda 2222<br></td></tr></thead><tbody><tr><td>1<br></td><td>3<br></td><td>5<br></td></tr><tr><td>2<br></td><td>4<br></td><td>6<br></td></tr></tbody></table><p></p><br><p></p>\r\n', 1),
(20, 'teszt edző - edzésterv kliens4', '<p>hgfhgfhgfhfghgf<br></p>', 9),
(21, 'lkljlk', '<p>kljljkl</p>', 1),
(22, 'ljkljkljklkjk', '<p>4324</p>', 5);

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

--
-- A tábla adatainak kiíratása `tevekenysegek`
--

INSERT INTO `tevekenysegek` (`tev_id`, `felhasznalo_id`, `datum`, `leiras`) VALUES
(1, 3, '2023-03-17', '111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111'),
(2, 3, '2023-03-18', '22222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222'),
(3, 3, '2023-03-16', '33333'),
(4, 3, '2023-03-19', '4444444444444444'),
(5, 3, '2023-03-21', '<h1><b>ljklkjljkljkljkljklj</b></h1><div>őáélál<b><i><strike>éáléáléáléáéláléálé</strike></i></b></div><div><span style=\"background-color: rgb(31, 73, 125);\"><font color=\"#ffffff\">ddddddddddddddddddddddddddd<b><i><strike><br></strike></i></b></font></span></div>'),
(6, 3, '2023-03-22', '<h1>Pelda</h1><ul><li>hjghjhgjhgjhgjghjghjgh</li><li>jhgjghjghjghjghjghjghj</li><li>ghjghjghjghjghjghjghjgh</li><li>jghjghjghjghjghjgh</li></ul><div><table id=\"table52677\"><thead><tr><td>pelda <br></td><td>teszt <br></td><td>1233333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333 <br></td></tr></thead><tbody><tr><td>1<br></td><td>3<br></td><td>5<br></td></tr><tr><td>2<br></td><td>4<br></td><td>6<br></td></tr></tbody></table><p></p><br></div>'),
(8, 6, '2023-03-27', '<p>KLIENS 3 feljegyzése</p>'),
(9, 3, '2023-03-22', '<p>éklékl</p>');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `uzenetek`
--

CREATE TABLE `uzenetek` (
  `uzenet_id` int(11) NOT NULL,
  `kimeno_id` int(11) NOT NULL,
  `bejovo_id` int(11) NOT NULL,
  `mikor` datetime NOT NULL,
  `uzenet` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `uzenetek`
--

INSERT INTO `uzenetek` (`uzenet_id`, `kimeno_id`, `bejovo_id`, `mikor`, `uzenet`) VALUES
(1, 3, 1, '2023-03-17 12:09:40', 'Szia'),
(2, 1, 3, '2023-03-17 12:09:53', 'Hello'),
(3, 1, 3, '2023-03-22 08:02:01', 'jhkjhk');

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
  MODIFY `edzes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT a táblához `edzoklienskapcs`
--
ALTER TABLE `edzoklienskapcs`
  MODIFY `kapcs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `etrendek`
--
ALTER TABLE `etrendek`
  MODIFY `etrend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `felhasznalo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `terv`
--
ALTER TABLE `terv`
  MODIFY `terv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT a táblához `tevekenysegek`
--
ALTER TABLE `tevekenysegek`
  MODIFY `tev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `uzenetek`
--
ALTER TABLE `uzenetek`
  MODIFY `uzenet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
