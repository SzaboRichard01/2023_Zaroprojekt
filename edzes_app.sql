-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Gép: mysql.omega:3306
-- Létrehozás ideje: 2023. Ápr 17. 11:56
-- Kiszolgáló verziója: 5.7.40-log
-- PHP verzió: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `nap` varchar(16) COLLATE utf8_hungarian_ci NOT NULL,
  `edzesterv` text COLLATE utf8_hungarian_ci NOT NULL,
  `terv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `edzestervek`
--

INSERT INTO `edzestervek` (`edzes_id`, `nap`, `edzesterv`, `terv_id`) VALUES
(4, 'Hétfő', '<p><h4>1. Nap: Mell-kar</h4><ul><li>Fekvőtmámasz: 4x10-25</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=22\">Tárogatás</a> (vagy törölközős tárogatás, lásd <a href=\"https://shopbuilder.hu/otthoni-melledzes-a2243\">Otthoni melledzés-cikk</a> ): 3x12-15</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=30\">Fekvenyomás \"ferdepadon\"</a>, vagy tolódzkodás (lásd Otthoni melledzés-cikk): 4x10-12</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=33\">Bicepsz ülve, váltott karral</a>: 4x10-12</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=167\">Kalapácsbicepsz</a>: 3x10-12</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=34\">Koncentrált bicepsz</a>: 3x10-12</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=35\">Tricepsznyújtás ülve</a> (vagy tolódzkodás padon/széken, lásd <a href=\"https://shopbuilder.hu/otthoni-tricepszedzes-a2253\">Otthoni tricepszedzés-cikk</a>): 4x10-14</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=50\">Lórúgás</a> (vagy plank-tricepsznyújtás, lásd Otthoni tricepszedzés-cikk, ebből annyit csinálj, amennyi megy): 3x10-18</li></ul><p><img alt=\"Fekvőtámasz - Otthoni edzés összes: a komplett program\" src=\"http://body.builder.hu/images/bbcomment/otthoni_edzes_a_komplett_program_2.jpg\" title=\"Fekvőtámasz - Otthoni edzés összes: a komplett program\" style=\"width: 388.271px; height: 203px;\"></p><br></p>', 16),
(5, 'Szerda', '<p><h4>2. Nap: Láb-has</h4><ul><li>Guggolás kézisúlyzóval vagy saját testsúllyal, vagy: 4x6-12 (attól függően, mennyi súly áll rendelkezésre, súly nélkül 20 ismétlés legyen a plafon, nehezítésképpen mehet egylábas guggolás)</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=37\">Kitörés</a> (súllyal, vagy anélkül): 3x20</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=119\">Merevlábas felhúzás rúddal</a> vagy kézisúlyzóval, vagy bordásfalas lábbicepszgyakorlat (lásd <a href=\"https://shopbuilder.hu/otthoni-labedzes-a2208\">Otthoni lábedzés-cikk</a>, bordásfal nélkül is kivitelezhető): 4x10-12</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=12\">Vádli állva</a> (súllyal, vagy anélkül): 3x20-30</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=14\">Hasprés</a>: 4x20-30</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=107\">Lábfelhúzás fekve</a>: 3x20</li></ul></p>', 16),
(6, 'Péntek', '<p><h4>3. Nap: Hát-váll</h4><ul><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=18\">Döntött törzsű evezés</a> kézisúlyzóval, vagy inverz evezés (lásd <a href=\"https://shopbuilder.hu/otthoni-hatedzes-a2211\">Otthoni hátedzés-cikk</a>): 5x6-12</li><li>Húzódzkodás változó fogással: 5 sorozat, amennyi megy</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=39\">Egykezes evezés</a>: 3x10-12</li><li>Felhomorítás: tudod, mint a hasprés. Csak fordítva. Hason fekszel, kezek a tarkón, és egyenes háttal szó szerint felhomorítasz. Végezz 3-4 sorozatot 15-20 ismétléssel.</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=21\">Oldalemelés</a>: 4x10-12</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=54\">Vállbólnyomás</a>, vagy <a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=48\">előreemelés kézisúlyzóval</a> (attól függően, mennyi súlyod van, vagy mihez van kedved): 3x10-12</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=32\">Döntött törzsű oldalemelés</a>: 3x10-14</li></ul><p>A váll edzése során szinte tényleg elkerülhetetlen, hogy legalább egy kézisúlyzód legyen, így oldalemeléseket, előremelést akár váltott karral is végezhetsz.</p><p><img alt=\"Komplett program, otthoni edzés összes - bicepszezés\" src=\"http://body.builder.hu/images/bbcomment/otthoni_edzes_a_komplett_program_5.jpg\" title=\"Komplett program, otthoni edzés összes - bicepszezés\" style=\"width: 393.93px; height: 206px;\"></p><br></p>', 16),
(7, 'Hétfő', '<p><h4>1. Nap: Mell-kar</h4><ul><li>Fekvőtmámasz: 4x10-25</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=22\">Tárogatás</a>&nbsp;(vagy törölközős tárogatás, lásd&nbsp;<a href=\"https://shopbuilder.hu/otthoni-melledzes-a2243\">Otthoni melledzés-cikk</a>&nbsp;): 3x12-15</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=30\">Fekvenyomás \"ferdepadon\"</a>, vagy tolódzkodás (lásd Otthoni melledzés-cikk): 4x10-12</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=33\">Bicepsz ülve, váltott karral</a>: 4x10-12</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=167\">Kalapácsbicepsz</a>: 3x10-12</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=34\">Koncentrált bicepsz</a>: 3x10-12</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=35\">Tricepsznyújtás ülve</a>&nbsp;(vagy tolódzkodás padon/széken, lásd&nbsp;<a href=\"https://shopbuilder.hu/otthoni-tricepszedzes-a2253\">Otthoni tricepszedzés-cikk</a>): 4x10-14</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=50\">Lórúgás</a>&nbsp;(vagy plank-tricepsznyújtás, lásd Otthoni tricepszedzés-cikk, ebből annyit csinálj, amennyi megy): 3x10-18</li></ul><p><img alt=\"Fekvőtámasz - Otthoni edzés összes: a komplett program\" src=\"http://body.builder.hu/images/bbcomment/otthoni_edzes_a_komplett_program_2.jpg\" title=\"Fekvőtámasz - Otthoni edzés összes: a komplett program\" style=\"width: 401.274px; height: 210px;\"></p><br></p>', 17),
(8, 'Szerda', '<p><h4>2. Nap: Láb-has</h4><ul><li>Guggolás kézisúlyzóval vagy saját testsúllyal, vagy: 4x6-12 (attól függően, mennyi súly áll rendelkezésre, súly nélkül 20 ismétlés legyen a plafon, nehezítésképpen mehet egylábas guggolás)</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=37\">Kitörés</a>&nbsp;(súllyal, vagy anélkül): 3x20</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=119\">Merevlábas felhúzás rúddal</a>&nbsp;vagy kézisúlyzóval, vagy bordásfalas lábbicepszgyakorlat (lásd&nbsp;<a href=\"https://shopbuilder.hu/otthoni-labedzes-a2208\">Otthoni lábedzés-cikk</a>, bordásfal nélkül is kivitelezhető): 4x10-12</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=12\">Vádli állva</a>&nbsp;(súllyal, vagy anélkül): 3x20-30</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=14\">Hasprés</a>: 4x20-30</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=107\">Lábfelhúzás fekve</a>: 3x20</li></ul><br></p>', 17),
(9, 'Péntek', '<p><h4>3. Nap: Hát-váll</h4><ul><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=18\">Döntött törzsű evezés</a>&nbsp;kézisúlyzóval, vagy inverz evezés (lásd&nbsp;<a href=\"https://shopbuilder.hu/otthoni-hatedzes-a2211\">Otthoni hátedzés-cikk</a>): 5x6-12</li><li>Húzódzkodás változó fogással: 5 sorozat, amennyi megy</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=39\">Egykezes evezés</a>: 3x10-12</li><li>Felhomorítás: tudod, mint a hasprés. Csak fordítva. Hason fekszel, kezek a tarkón, és egyenes háttal szó szerint felhomorítasz. Végezz 3-4 sorozatot 15-20 ismétléssel.</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=21\">Oldalemelés</a>: 4x10-12</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=54\">Vállbólnyomás</a>, vagy&nbsp;<a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=48\">előreemelés kézisúlyzóval</a>&nbsp;(attól függően, mennyi súlyod van, vagy mihez van kedved): 3x10-12</li><li><a href=\"https://shopbuilder.hu/edzesek_reszletes.htm4?id=32\">Döntött törzsű oldalemelés</a>: 3x10-14</li></ul><p>A váll edzése során szinte tényleg elkerülhetetlen, hogy legalább egy kézisúlyzód legyen, így oldalemeléseket, előremelést akár váltott karral is végezhetsz.</p><p><img alt=\"Komplett program, otthoni edzés összes - bicepszezés\" src=\"http://body.builder.hu/images/bbcomment/otthoni_edzes_a_komplett_program_5.jpg\" title=\"Komplett program, otthoni edzés összes - bicepszezés\" style=\"width: 385.987px; height: 202px;\"></p><br></p>', 17);

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
(1, 5, 1, 1, '2023-04-17 11:04:28', '2023-04-17 11:05:04');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `etrendek`
--

CREATE TABLE `etrendek` (
  `etrend_id` int(11) NOT NULL,
  `nap` varchar(16) COLLATE utf8_hungarian_ci NOT NULL,
  `etrend` text COLLATE utf8_hungarian_ci NOT NULL,
  `terv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `etrendek`
--

INSERT INTO `etrendek` (`etrend_id`, `nap`, `etrend`, `terv_id`) VALUES
(2, 'Minden alkalomra', '<p><p><b>1. étkezés</b></p><p>– 150 g teljes kiőrlésű kenyér (2 szelet), 1 főtt tojás, 1 nagyobb paradicsom, 100 g csirkemell sonka szelet, 1 evőkanál lenmag olaj</p><p><em>750 kcal, 50 g fehérje, 67 g szénhidrát, 30 g zsír</em></p><p><b>2. étkezés</b></p><p>– 1 db nagyobb alma</p><p><em>66 kcal, 0,8 g fehérje, 14 g szénhidrát, 0 g zsír</em></p><p><b>3. étkezés</b></p><p>– 150 g teljes őrlésű tészta, 80 g csirkemell filé, 50 g zsírszegény sajt</p><p><em>700 kcal, 53 g fehérje, 102 g szénhidrát, 8,8 g zsír</em></p><p>4. étkezés (edzés előtt)</p><p><b>– 1 db közepes banán</b></p><p><em>150 kalória, 2 g fehérje, 36 g szénhidrát, 0 g zsír</em></p><p>5. étkezés (edzés után)</p><p>– 1 adag<a href=\"http://shop.biotechusashop.hu/tomegnovelok/hyper_mass_5000___4000_g_zsak_374\"> Hyper Mass 5000</a></p><p><em>245 kcal, 16 g fehérje, 44 g szénhidrát, 0 g zsír</em></p><p><b>6. étkezés</b></p><p>– 100 g barna rizs, 100 g csirkemll filé, 1 nagyobb paradicsom</p><p><em>493 kcal, 34 g fehérje, 80 g szénhidrát, 4 g zsír</em></p><p><span style=\"background-color: initial; color: black;\"><b>7. étkezés</b></span><br></p><p>– 150 g sovány túró, 1 adag <a href=\"http://shop.biotechusashop.hu/nitro_gold_pro_enzy_fusion___2200_g_zsak_394\">Nitro Gold Pro Enzy Fusion</a></p><p><em>234 kcal, 43 g fehérje, 8,5g szénhidrát, 2,5 g zsír</em></p><p>Ajánlott vitamin csomag:</p><ul><li><a href=\"http://shop.biotechusashop.hu/vitabolic___30_tabletta_180\">Vitabolic</a></li><li><a href=\"http://shop.biotechusashop.hu/vitamin_c_1000_usa___100_tabletta_620\">C-1000</a></li><li><a href=\"http://shop.biotechusashop.hu/omega_3___90_kapszula_179\">Omega 3</a></li><li><a href=\"http://shop.biotechusashop.hu/calcium_complete___90_kapszula_187\">Calcium Complete</a></li></ul><br></p>', 16),
(3, 'Minden alkalomra', '<p><p>1. étkezés</p><p>– 150 g teljes kiőrlésű kenyér (2 szelet), 1 főtt tojás, 1 nagyobb paradicsom, 100 g csirkemell sonka szelet, 1 evőkanál lenmag olaj</p><p><em>750 kcal, 50 g fehérje, 67 g szénhidrát, 30 g zsír</em></p><p>2. étkezés</p><p>– 1 db nagyobb alma</p><p><em>66 kcal, 0,8 g fehérje, 14 g szénhidrát, 0 g zsír</em></p><p>3. étkezés</p><p>– 150 g teljes őrlésű tészta, 80 g csirkemell filé, 50 g zsírszegény sajt</p><p><em>700 kcal, 53 g fehérje, 102 g szénhidrát, 8,8 g zsír</em></p><p>4. étkezés (edzés előtt)</p><p>– 1 db közepes banán</p><p><em>150 kalória, 2 g fehérje, 36 g szénhidrát, 0 g zsír</em></p><p>5. étkezés (edzés után)</p><p>– 1 adag<a href=\"http://shop.biotechusashop.hu/tomegnovelok/hyper_mass_5000___4000_g_zsak_374\">&nbsp;Hyper Mass 5000</a></p><p><em>245 kcal, 16 g fehérje, 44 g szénhidrát, 0 g zsír</em></p><p>6. étkezés</p><p>– 100 g barna rizs, 100 g csirkemll filé, 1 nagyobb paradicsom</p><p><em>493 kcal, 34 g fehérje, 80 g szénhidrát, 4 g zsír</em></p><p>7. étkezés</p><p>– 150 g sovány túró, 1 adag&nbsp;<a href=\"http://shop.biotechusashop.hu/nitro_gold_pro_enzy_fusion___2200_g_zsak_394\">Nitro Gold Pro Enzy Fusion</a></p><p><em>234 kcal, 43 g fehérje, 8,5g szénhidrát, 2,5 g zsír</em></p><p>Ajánlott vitamin csomag:</p><ul><li><a href=\"http://shop.biotechusashop.hu/vitabolic___30_tabletta_180\">Vitabolic</a></li><li><a href=\"http://shop.biotechusashop.hu/vitamin_c_1000_usa___100_tabletta_620\">C-1000</a></li><li><a href=\"http://shop.biotechusashop.hu/omega_3___90_kapszula_179\">Omega 3</a></li><li><a href=\"http://shop.biotechusashop.hu/calcium_complete___90_kapszula_187\">Calcium Complete</a></li></ul><br></p>', 17);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `felhasznalo_id` int(11) NOT NULL,
  `vnev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `knev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `profil_tipus` varchar(6) COLLATE utf8_hungarian_ci NOT NULL,
  `kep` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `nem` tinyint(1) NOT NULL,
  `bemutatkozo` text COLLATE utf8_hungarian_ci,
  `telefon` varchar(16) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`felhasznalo_id`, `vnev`, `knev`, `email`, `jelszo`, `profil_tipus`, `kep`, `nem`, `bemutatkozo`, `telefon`) VALUES
(1, 'Szabó', 'Richárd', 'pelda@gmail.com', '$2y$10$2G7wd/fLUU1WBHCoCGfqVedDTteliK0ZeORMVvdScHB1v2rKKSbIy', 'edző', '1679050736.jpeg', 1, '<p>Személyre szabott edzésterveket készítek az ügyfeleimnek, erőszintjét, idejét és kérését figyelembe véve, valamint ennek megfelelően étrendet is a hatékonyabb eredmények elérésének érdekében. Várom leendő klienseim jelentkezését!<br></p><p></p><br><p></p><p></p>\r\n', '+36201234567'),
(2, 'Híves', 'Sebastian', 'sebihives2001@gmail.com', '$2y$10$LMEes.8nKycHExaH/k317eGFIkAvfcvlmwgtECmuPd35zuYArOAza', 'edző', '1680080537.jpeg', 1, '<p>Több éves edzői szakmai tapasztalattal rendelkezem. Személyre szabott edzésterveket készítek az ügyfeleimnek, fizikai adottságait, idejét és kérését figyelembe véve, valamint ennek megfelelően étrendet is a hatékonyabb eredmények elérésének érdekében. Várom leendő klienseim jelentkezését!<br></p>', '+4219156297'),
(5, 'Tóth', 'Ildikó', 'tildiko34@gmail.com', '$2y$10$4pikLxHsX9XrO10Sj3EDZesYbyXNP0rvWukrTMGU8bRt49x6SdnWK', 'kliens', '1680164255.jpeg', 0, '', NULL),
(9, 'Kiss', 'Péter', 'peterk1@gmail.com', '$2y$10$GqnS5czFnLJ8py2F8yIMUe.6LbthFEPT84OXyO/33T7e2SQA7W4tK', 'kliens', 'nincskep.png', 1, '', ''),
(10, 'Teszt', 'Edző', 'edzo@gmail.com', '$2y$10$rwMnTkRGwdctT0hfBBNlIu1Jxdaqb2QbUMR8NiV9957JB45PqcWJa', 'edző', 'nincskep.png', 1, '<p><font color=\"#9bbb59\">Személyre szabott</font> edzésterveket készítek az ügyfeleimnek, erőszintjét, idejét és kérését figyelembe véve, valamint ennek megfelelően étrendet is a hatékonyabb eredmények elérésének érdekében.</p><p><span style=\"color: #1f497d;\"><b>Várom leendő klienseim jelentkezését!</b></span><br></p>', '+36201234567');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `feljegyzesek`
--

CREATE TABLE `feljegyzesek` (
  `felj_id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `leiras` text COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `feljegyzesek`
--

INSERT INTO `feljegyzesek` (`felj_id`, `felhasznalo_id`, `datum`, `leiras`) VALUES
(23, 5, '2023-04-15', '<p style=\"\"><b style=\"background-color: rgb(255, 255, 255);\"><font color=\"#c0504d\">Személyi edző felkeresése</font></b></p>'),
(24, 5, '2023-04-17', '<p>Új edzésterv kérése</p>'),
(25, 5, '2023-04-19', '<h1>Étrend átbeszélése</h1><p><ol><li>reggeli lecserélése</li><li>ebéd bővítése</li></ol></p>'),
(26, 5, '2023-04-20', '<p><b>Váll sérülés</b></p><p></p><ul><li>megfelelő edzésterv kérése</li><li>további teendők</li></ul><img src=\"https://www.gyogytornaszom.hu/storage/2021/05/5daba62a919201bcb08a2a6fed456ba9.png\" jsaction=\"VQAsE\" class=\"r48jcc pT0Scc iPVvYb\" style=\"max-width: 924px; width: 661.234px; height: 379px;\" alt=\"Befagyott váll kezelése gyógytornával Budapesten\" jsname=\"kn3ccd\" data-iml=\"9419.399999976158\"><br><p></p><p><br></p>\r\n'),
(27, 5, '2023-04-08', '<p>Nyújtó gyakorlatok</p>'),
(28, 5, '2023-04-05', '<p>Napi étrend</p>'),
(29, 5, '2023-03-24', '<p>Tömegnövelő étrend kérése</p>');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `terv`
--

CREATE TABLE `terv` (
  `terv_id` int(11) NOT NULL,
  `neve` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `leiras` text COLLATE utf8_hungarian_ci,
  `kapcs_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `terv`
--

INSERT INTO `terv` (`terv_id`, `neve`, `leiras`, `kapcs_id`) VALUES
(16, 'Otthoni edzésterv', '<p>Az edzéstervet 3 napra osztottam fel. Azt vesszük alapul, hogy van 1-2 eszközöd (kézisúlyzód, haspadod, ilyesmi), illetve alternatívákat is írok a gyakorlatokhoz ezekre, ha valami hiányzik.<br></p>', 1),
(17, 'Otthoni 3 napos edzésterv', '<p>Az edzéstervet 3 napra osztottam fel.&nbsp;Azt vesszük alapul, hogy van 1-2 eszközöd (kézisúlyzód, haspadod, ilyesmi), illetve alternatívákat is írok a gyakorlatokhoz ezekre, ha valami hiányzik.<br></p>', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `uzenetek`
--

CREATE TABLE `uzenetek` (
  `uzenet_id` int(11) NOT NULL,
  `kimeno_id` int(11) NOT NULL,
  `bejovo_id` int(11) NOT NULL,
  `uzenet` text COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `uzenetek`
--

INSERT INTO `uzenetek` (`uzenet_id`, `kimeno_id`, `bejovo_id`, `uzenet`) VALUES
(1, 1, 5, 'Szia'),
(2, 5, 1, 'Hello'),
(3, 9, 1, 'Szia! Új erőnövelő edzéstervet szeretnék. Úgy érzem, hogy már nem tudok fejlődni azzal amit korábban kértem.'),
(4, 1, 9, 'Szia! Egy pillanat utána kell néznem a régi edzéstervednek.'),
(5, 1, 9, 'Valóban régen frissítettük már az edzéstervedet, elkezdek egy újat összeállítani.'),
(6, 9, 1, 'Rendben várom');

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
  MODIFY `edzes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `edzoklienskapcs`
--
ALTER TABLE `edzoklienskapcs`
  MODIFY `kapcs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `etrendek`
--
ALTER TABLE `etrendek`
  MODIFY `etrend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `felhasznalo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `feljegyzesek`
--
ALTER TABLE `feljegyzesek`
  MODIFY `felj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT a táblához `terv`
--
ALTER TABLE `terv`
  MODIFY `terv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `uzenetek`
--
ALTER TABLE `uzenetek`
  MODIFY `uzenet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
