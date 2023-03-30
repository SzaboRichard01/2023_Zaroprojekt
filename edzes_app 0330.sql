-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Már 30. 11:08
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
(14, 'Hétfő', '<p><h4>Guggoló nap</h4><table><thead><tr><td>Gyakorlat</td><td>Sorozatok</td><td>Ismétlések</td><td>pihenő (perc)</td></tr></thead><tbody><tr><td><a href=\"https://shop.builder.hu/guggolas-a2571\">Guggolás</a></td><td>4-5</td><td>4-6</td><td>3-4</td></tr><tr><td><a href=\"https://shop.builder.hu/guggolas-mellso-tartassal-a2572\">Elölguggolás</a></td><td>3</td><td>4-6</td><td>3</td></tr><tr><td><a href=\"https://shop.builder.hu/labtolas-a2580\">Lábtolás</a></td><td>3</td><td>4-6</td><td>3</td></tr><tr><td><a href=\"https://shop.builder.hu/labnyujtas-a2579\">Lábnyújtás</a></td><td>2</td><td>4-6</td><td>3</td></tr><tr><td><a href=\"https://shop.builder.hu/labhajlitas-ulve-a2578\">Lábhajlítás ülve</a></td><td>2</td><td>4-6</td><td>3</td></tr></tbody></table><br></p>', 1),
(15, 'Szerda', '<p><h4>Nyomó nap</h4><table><thead><tr><td>Gyakorlat</td><td>Sorozatok</td><td>Ismétlések</td><td>pihenő (perc)</td></tr></thead><tbody><tr><td><a href=\"https://shop.builder.hu/fekvenyomas-egyenes-padon-a2452\">Fekvenyomás</a></td><td>4-5</td><td>4-6</td><td>3</td></tr><tr><td><a href=\"https://shop.builder.hu/fekvenyomas-ferde-padon-a2455\">Fekvenyomás ferdepadon</a></td><td>3-4</td><td>4-6</td><td>3</td></tr><tr><td><a href=\"https://shop.builder.hu/mellrol-nyomas-allva-a2566\">Mellről nyomás (military press)</a></td><td>3</td><td>4-6</td><td>3</td></tr></tbody></table><br></p>', 1),
(16, 'Péntek', '<p><h4>Felhúzó nap</h4><table><thead><tr><td>Gyakorlat</td><td>Sorozatok</td><td>Ismétlések</td><td>pihenő (perc)</td></tr></thead><tbody><tr><td><a href=\"https://shop.builder.hu/felhuzas-elemeles-a2499\">Felhúzás</a></td><td>3-4</td><td>4-6</td><td>4-5</td></tr><tr><td><a href=\"https://shop.builder.hu/dontott-torzsu-evezes-a2500\">Döntött törzsű evezés</a></td><td>2-3</td><td>4-6</td><td>3</td></tr><tr><td><a href=\"https://shop.builder.hu/szeles-fogasu-huzodzkodas-a2506\">Húzódzkodás</a></td><td>2</td><td>amennyi megy</td><td>3</td></tr><tr><td><a href=\"https://shop.builder.hu/hiperhajlitas-a2514\">Hiperhajlítás</a></td><td>3</td><td>10-12</td><td>2</td></tr></tbody></table><br></p>', 1);

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
(1, 3, 1, 1, '2023-03-30 10:19:26', '2023-03-30 10:21:10');

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
(2, 'Minden nap', '<p><table><thead><tr><th>Mennyiség (gramm)</th><th>Fehérje (gramm)</th><th>Szénhidrát (gramm)</th><th>Zsír (gramm)</th><th>Kalória (kcal)</th></tr></thead><tbody><tr><td>Első turmix<br>06:30:00</td></tr><tr><td>Zabpehely</td><td>60</td><td>8,6</td><td>38,6</td><td>4,1</td><td>232</td></tr><tr><td><a href=\"https://shopbuilder.hu/tejsavo-feherje-koncentratumok/scitec-nutrition-100-whey-protein-professional-2-35-kg-p5146\">100% Whey Protein Professional</a></td><td>30</td><td>22</td><td>2,5</td><td>1,8</td><td>114</td></tr><tr><td>Preworkout ital<br>07:30:00</td></tr><tr><td><a href=\"https://shopbuilder.hu/edzes-elotti-termekek/scitec-nutrition-hot-blood-hardcore-700-gr-p15461\">Scitec Hot Blood Hardcore</a></td><td>25</td><td>13,25</td><td>8</td><td>0</td><td>90</td></tr><tr><td>Edzés utáni turmix&nbsp;09:00:00</td></tr><tr><td><a href=\"https://shopbuilder.hu/tomegnovelok-haladoknak/scitec-nutrition-jumbo-hardcore-1-53-kg-p12664\">Jumbo Hardcore</a></td><td>76,5</td><td>31,5</td><td>30</td><td>5</td><td>300</td></tr><tr><td>1. csirke-rizs<br>10:00:00</td></tr><tr><td>Csirkemell filé</td><td>50</td><td>12,3</td><td>0,2</td><td>0,5</td><td>56,2</td></tr><tr><td>Rizs</td><td>50</td><td>4</td><td>38,8</td><td>0,2</td><td>177</td></tr><tr><td>Brokkoli</td><td>50</td><td>1,65</td><td>1,05</td><td>0,1</td><td>12</td></tr><tr><td>2. csirke-rizs<br>13:00:00</td></tr><tr><td>Csirkemell filé</td><td>50</td><td>12,3</td><td>0,2</td><td>0,5</td><td>56,2</td></tr><tr><td>Rizs</td><td>50</td><td>4</td><td>38,8</td><td>0,2</td><td>177</td></tr><tr><td>Brokkoli</td><td>50</td><td>1,65</td><td>1,05</td><td>0,1</td><td>12</td></tr><tr><td>3. csirke-rizs<br>16:00:00</td></tr><tr><td>Csirkemell filé</td><td>50</td><td>12,3</td><td>0,2</td><td>0,5</td><td>56,2</td></tr><tr><td>Rizs</td><td>50</td><td>4</td><td>38,8</td><td>0,2</td><td>177</td></tr><tr><td>Brokkoli</td><td>50</td><td>1,65</td><td>1,05</td><td>0,1</td><td>12</td></tr><tr><td>Esti kaja<br>19:00:00</td></tr><tr><td>Csirkemell filé</td><td>50</td><td>12,3</td><td>0,2</td><td>0,5</td><td>56,2</td></tr><tr><td>Zöldsaláta</td><td>30</td><td>0,4</td><td>0,6</td><td>0,1</td><td>4,9</td></tr><tr><td>Lenmagolaj</td><td>30</td><td>0</td><td>0</td><td>30</td><td>279</td></tr><tr><td>Lefekvés előtti turmix&nbsp;21:00:00</td></tr><tr><td><a href=\"https://shopbuilder.hu/kazein-casein/scitec-nutrition-100-casein-complex-2-35-kg-p9208\">Scitec 100% Casein Complex</a></td><td>30</td><td>22</td><td>2,8</td><td>0,7</td><td>106</td></tr><tr><td>Napi bevitel összesen</td><td>163,9</td><td>202,85</td><td>44,6</td><td>1917</td></tr></tbody></table><br></p>', 1);

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
(1, 'Szabó', 'Richárd', 'pelda@gmail.com', '$2y$10$2G7wd/fLUU1WBHCoCGfqVedDTteliK0ZeORMVvdScHB1v2rKKSbIy', 'edző', '1679050736.jpeg', 'férfi', '<p>Személyre szabott edzésterveket készítek az ügyfeleimnek, fizikai adottságait, idejét és kérését figyelembe véve, valamint ennek megfelelően étrendet is a hatékonyabb eredmények elérésének érdekében. Várom leendő klienseim jelentkezését!<br></p>', '06201234567'),
(2, 'Híves', 'Sebastian', 'sebihives2001@gmail.com', '$2y$10$LMEes.8nKycHExaH/k317eGFIkAvfcvlmwgtECmuPd35zuYArOAza', 'edző', '1680080537.jpeg', 'férfi', '<p>Több éves edzői szakmai tapasztalattal rendelkezem. Személyre szabott edzésterveket készítek az ügyfeleimnek, fizikai adottságait, idejét és kérését figyelembe véve, valamint ennek megfelelően étrendet is a hatékonyabb eredmények elérésének érdekében. Várom leendő klienseim jelentkezését!<br></p>', '+4219156297'),
(3, 'Kiss', 'Péter', 'peterk1@gmail.com', '$2y$10$SOyZ/8g82q5p25eY7i8YwuUiGksifH1cr5OXa0YKi56Sum/FGf10G', 'kliens', '1680164324.jpeg', 'férfi', '', ''),
(4, 'Kovács', 'Pál', 'kovacs45@gmail.com', '$2y$10$niPHu8/UYT9NtM67T7zUauqM9s5YdtobotTq.hv79uMneq8VNyB.W', 'kliens', 'nincskep.png', 'férfi', '', ''),
(5, 'Tóth', 'Ildikó', 'tildoko34@gmail.com', '$2y$10$eFsImHeLP2fZt6/nQnePx.2CP/XCthfZUtudoze8tc/0A/pOJKpcW', 'edző', '1680164255.jpeg', 'nő', '<p>Tóth Ildikó vagyok személyi edző, gerinctréner. Tudom milyen az, amikor az addig oly fontos mozgás háttérbe szorul és milyen érzés sok kihagyás után újrakezdeni.<br></p>', '06204686898');

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
(1, 'Erőnövelő edzésterv és étrend', '<h2>Edzésterv</h2><p>Lássunk egy edzéstervet, melynek segítségével a három erőemelő fogásnak, tehát a fekvenyomás, a felhúzás és a guggolás erősítését érheted el!&nbsp;Jól láthatóan nem rakétatudomány a dolog: 3 fogásnem, 3 edzésnap. Alapozásnak tökéletes. Hasat és alsó hátat minden edzésen érdemes edzeni, az alkarra és a vádlira egyelőre nem kell nagy hangsúlyt fektetni.<br></p><h2>Étrend</h2><div>Napi 7 étkezés a turmixokkal együtt.&nbsp;Testsúlykilogrammonként picivel több, mint 2 g fehérje, 3 gramm szénhidrát, 1900 kalória napi szinten.<br></div>', 1);

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
  MODIFY `felhasznalo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `uzenet_id` int(11) NOT NULL AUTO_INCREMENT;

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
