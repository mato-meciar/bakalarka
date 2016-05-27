-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2016 at 01:59 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekty`
--

-- --------------------------------------------------------

--
-- Table structure for table `nastavenia`
--

DROP TABLE IF EXISTS `nastavenia`;
CREATE TABLE IF NOT EXISTS `nastavenia` (
  `vytvaranie_skupin` DATETIME   NOT NULL,
  `boli_pridelene`    TINYINT(1) NOT NULL DEFAULT '0'
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  COLLATE = utf8_slovak_ci;

--
-- Dumping data for table `nastavenia`
--

INSERT INTO `nastavenia` (`vytvaranie_skupin`, `boli_pridelene`) VALUES
  ('2016-05-29 23:59:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pouzivatel`
--

DROP TABLE IF EXISTS `pouzivatel`;
CREATE TABLE IF NOT EXISTS `pouzivatel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `google_id` varchar(21) COLLATE utf8_slovak_ci DEFAULT NULL,
  `email` tinytext COLLATE utf8_slovak_ci NOT NULL,
  `heslo` varchar(32) COLLATE utf8_slovak_ci DEFAULT NULL COMMENT 'md5 hash hesla',
  `rola` varchar(10) COLLATE utf8_slovak_ci NOT NULL DEFAULT 'uzivatel',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 20
  DEFAULT CHARSET = utf8
  COLLATE = utf8_slovak_ci;

--
-- Dumping data for table `pouzivatel`
--

INSERT INTO `pouzivatel` (`id`, `google_id`, `email`, `heslo`, `rola`) VALUES
(1, 'NULL', 'admin@test.com', '0192023a7bbd73250516f069df18b500', 'admin'),
(2, 'NULL', 'uzivatel@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'uzivatel'),
(4, 'NULL', 'uzivatel2@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'uzivatel'),
(6, 'NULL', 'zadavatel@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'zadavatel'),
  (7, '105564633106620413434', 'mato.meciar@gmail.com', '', 'uzivatel'),
  (8, 'NULL', 'zadavatel1@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'zadavatel'),
  (9, 'NULL', 'zadavatel2@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'zadavatel'),
  (10, 'NULL', 'zadavatel3@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'zadavatel'),
  (14, 'NULL', 'uzivatel1@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'uzivatel'),
  (16, 'NULL', 'uzivatel3@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'uzivatel'),
  (17, 'NULL', 'uzivatel4@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'uzivatel'),
  (19, 'NULL', 'uzivatel5@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'uzivatel');

-- --------------------------------------------------------

--
-- Table structure for table `projekt`
--

DROP TABLE IF EXISTS `projekt`;
CREATE TABLE IF NOT EXISTS `projekt` (
  `id`              INT(10) UNSIGNED                NOT NULL AUTO_INCREMENT,
  `nazov`           VARCHAR(100)
                    COLLATE utf8_slovak_ci          NOT NULL,
  `kontaktny_email` TINYTEXT COLLATE utf8_slovak_ci NOT NULL,
  `popis`           TEXT COLLATE utf8_slovak_ci     NOT NULL,
  `vytvoril_id`     INT(11)                         NOT NULL,
  `skupina_id`      INT(11)                         NOT NULL DEFAULT '-1',
  `oblast`          TEXT COLLATE utf8_slovak_ci     NOT NULL,
  `platforma`       TEXT COLLATE utf8_slovak_ci     NOT NULL,
  `technologie`     TEXT COLLATE utf8_slovak_ci     NOT NULL,
  `schvaleny`       TINYINT(1)                      NOT NULL DEFAULT '0',
  `dolezity`        TINYINT(3) UNSIGNED             NOT NULL DEFAULT '0',
  `rok`             SMALLINT(5) UNSIGNED            NOT NULL,
  UNIQUE KEY `id` (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 11
  DEFAULT CHARSET = utf8
  COLLATE = utf8_slovak_ci;

--
-- Dumping data for table `projekt`
--

INSERT INTO `projekt` (`id`, `nazov`, `kontaktny_email`, `popis`, `vytvoril_id`, `skupina_id`, `oblast`, `platforma`, `technologie`, `schvaleny`, `dolezity`, `rok`)
VALUES
  (1, 'Predikcia šírenia infekčných ochorení', 'admin@test.com',
      'V súčasnosti prebieha projekt APVV s lekárskou fakultou, kde sa zaoberáme predikciou šírenia infekčných ochorení. Vhodným doplnením našich výpočtov bude vizualizácia na mape Slovenskej Republiky. Šírenie choroby simulujeme na úrovni krajov (resp. okresov) pomocou jednoduchého systému 3 diferenčných/diferenciálnych rovníc. Vizualizácia bude spočívať vo farebnom odlíšení od úrovne počtu nakazených v jednotlivých okresoch a tak bude možné sledovať priestorový priebeh šírenia nákazy v danom časovom horizonte.',
      1, -1, 'medicina', 'web,webova aplikacia', 'html,css,javascript,php,mysql', 1, 0, 2016),
  (2, 'Poskladaj si avatara', 'admin@test.com',
      'Deti si budú môcť na základe poskytnutého výberu (oči, uši, vlasy, farby,...) poskladať postavičku figúrky-obrázka, ktorá ich bude sprevádzať aktivitami (namiesto ich fotky). Predstavujem si to modulárne, t.j. že sa budú dať pridávať témy napr. tučniaci, víly, ... Malo by to byť realizované pre webový prehliadač ako Javascriptový objekt + HTML5 (canvas, audio), aby sa to dalo ľahko použiť napr. do Multimediálnej čítanky. (Niečo podobné ako je zemiakový chlapec v KDE, Linuxe.)',
      1, 2, 'web', 'windows', 'html,css,javascript', 1, 0, 2016),
  (3, 'Štatistiky z frisbee turnajov', 'admin@test.com',
      'Máme takéto štatistiky: http://www.outsiterz.org/turnaje/\r\nJe to spravené v PHP, sú tam: hráči, turnaje, prepojenie medzi nimi (účasti na turnajoch). Databáza je MySQL. Potom sa z toho robia rôzne štatistiky. Je k tomu aj admin rozhranie.\r\n\r\nÚlohou bude spraviť to poriadnejšie, od začiatku s poriadnym návrhom, s jasnejším modelom (ideálne MVC), použitím vhodnejšieho jazyka (ruby, python, scala, ...). Bude treba prekopať štatistiky, príp. vytvoriť nové. Zvážiť použitie iného nonintrusive javascript knižnice na sortovanie a filtrovanie tabuliek. Súčasťou bude aj migrácia dát (rádovo stovky hráčov a turnajov).',
      1, 1, 'statistika', 'web,webova aplikacia', 'php,html,javascript,css,mvc,ruby,python,scala', 1, 0, 2016),
  (4, 'Počítačová simulácia a vizualizácia hier piškvorky a reversi pomocou algoritmu Minimax', 'admin@test.com',
      'Vytvoriť softvér na vizualizáciu hier reversi a piškvorky, na ktorých sa v prednáške bude ukazovať spôsob, akým pracuje minimax algoritmus.',
      1, -1, 'matematika', 'aplikacia,windows', 'java,c#,c++,python,lazarus', 1, 0, 2016),
  (5, 'Interaktívna prednáška', 'admin@test.com',
      'Webová aplikácia na podporu interaktívnych prednášok. Študenti pomocou mobilného telefónu, tabletu alebo notebooku môžu participovať na spätnej väzbe k prednáške - jednak napísaním otázok, ktoré by sa hneď zobrazovali na aktualizovanej stránke, jednak hlasovaním na otázku, ktorú by prednášajúci zadal - otázky môžu byť typu áno-nie, multiple-choice, alebo slovná odpoveď, výledky sa hneď zobrazia formou grafu s počtami a percentami hlasov za jednotlivé alternatívy, označí sa najpopulárnejšia odpoveď, možnosť vyberať otázky, ktoré boli pripravené vopred pred prednáškou, alebo zadané priamo na prednáške, odpovede sa uchovajú a môžu sa neskôr prezerať. dôležité je prehľadné a jednoduché použitie.',
      1, 5, 'web,webova aplikacia', 'web', 'html,css,php,javascript', 1, 0, 2016),
  (6, 'Meracia aparatúra', 'admin@test.com',
      'Zaznamenávanie a vizualizácia aktuálne nameraných fyzikálnych veličín, ukladanie meraní do databázy a ich čítanie, parciálne vyhodnocovanie výsledkov. Katedra experimentálnej fyziky.',
      1, 4, 'vizualizacia,fyzika', 'webova aplikacia', 'html,css,php,javascript', 1, 0, 2016),
  (7, 'Letná liga', 'admin@test.com',
      'V letnom semestri prebieha súťaž pre robotické krúžky - Letná Liga (www.fll.sk - turnaje - letna liga). Admin zadáva zadania úloh, tímy nahrávajú svoje riešenia (obrázok tímu, robota, program, popis, linka na youtube), rozhodcovia hodnotia riešenia, automaticky sa po uplynutí času zobrazujú riesenia, generuje sa výsledková tabuľka, archivujú sa predchádzajúce ročníky atď. Systém je funkčný a v prevádzke, ale má viacero nedostatkov, ktoré treba analyzovať a vyriešiť, prípadne to celé napísať nanovo. Je potrebné pridať viacjazyčnosť a zobrazenie na samostatnej stránke mimo portálu fll.sk.',
      1, 3, 'robotika', 'web,webova aplikacia', 'html,css,javascript,php', 1, 0, 2016),
  (8, 'Erasmus', 'zadavatel1@test.com',
      'Existuje systém na evidenciu bilaterálnych dohôd pre výmenný program Erasmus, vycestovaní študentov, mapovania ich absolvovaných predmetov, a evidovania ich &quot;learning agreement&quot;ov. Treba pridať komponenty na prihlasovanie sa na Erasmus (vyplnenie prihlášky online), životný cyklus prihlášok (akceptované, vyradené, ...).',
      8, -1, '', 'webova aplikacia', 'html,css,php,javascript', 1, 0, 2016),
  (9, 'Interaktívna mapa turistickej skupiny', 'zadavatel1@test.com',
      'Uzavretá po celej krajine distribuovaná skupina turistov potrebuje webovú aplikáciu na zdieľanie zápiskov z výletov, obrázkov, prípadne GPS trackov, možnosť zobrazenia na mape.',
      8, 6, 'webova aplikacia', 'web', 'html,css,php,javascript', 1, 0, 2016),
  (10, 'Podpora vzdialeného monitorovania fyzikálnych experimentov v laboratóriu', 'zadavatel1@test.com',
       'Na SAV je laboratórium, kde prebiehajú experimenty, často aj niekoľko hodín alebo cez noc, niektoré údaje sa zaznamenávajú, niektoré zatiaľ nie, ale mali by sa a všetko by malo byť viditeľné na nejakom webovom serveri, aktuálne sa musia nalogovať cez remote desktop na windows počítač v laboratóriu, odkiaľ už sledujú niektoré parametre na lokálnej sieti, ktorá nie je prepojená na Internet, toto treba zmeniť, aby mali všetko možnosť vidieť cez web na nejakom prístupnom serveri, kde sa zobrazuje stav pripojenia aj údaje, na server ich automaticky bude posielať nejaký proces, čo pobeží na počítačoch v laboratóriu - ideálne asi windows service, ale môže to byť a bežný program.',
       8, 7, '', 'webova aplikacia,windows', 'php,html,css,javascript,mysql', 1, 0, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `skupina`
--

DROP TABLE IF EXISTS `skupina`;
CREATE TABLE IF NOT EXISTS `skupina` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nazov` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `email` varchar(120) CHARACTER SET utf32 COLLATE utf32_slovak_ci NOT NULL,
  `veduci_id` int(10) UNSIGNED NOT NULL,
  `schopnosti` text COLLATE utf8_slovak_ci NOT NULL,
  `clenovia` text COLLATE utf8_slovak_ci NOT NULL,
  `preferencie` text COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 8
  DEFAULT CHARSET = utf8
  COLLATE = utf8_slovak_ci;

--
-- Dumping data for table `skupina`
--

INSERT INTO `skupina` (`id`, `nazov`, `email`, `veduci_id`, `schopnosti`, `clenovia`, `preferencie`) VALUES
  (1, 'Oštepári', 'uzivatel1@test.com', 14, 'html,css,php,javascript,python',
   'jános rosztovics,michal piják,michal rakovský,károly belokostolský', '1:3;2:3;3:4;4:3;5:2;6:1;7:3;8:2;9:3;'),
  (2, 'DreamTeam', 'uzivatel2@test.com', 4, 'php,html,css,javascript,mysql,web',
   'lukáš danko,peter daráš,dušan matejka,viktor nagy', '1:3;2:4;3:4;4:2;5:2;6:2;7:3;8:3;9:2;10:1;'),
  (3, 'Room54', 'uzivatel3@test.com', 16, 'html,css,javascript,python,php',
   'tomáš grešík,monika štrbová,patrik katrinec,pavol jeleník', '1:4;2:3;3:2;4:1;5:2;6:3;7:4;8:3;9:2;10:3;'),
  (4, 'NewGeneration', 'uzivatel4@test.com', 17, 'html,css,javascript,php,mysql,python,java',
   'dominik kotvan,laco wagner,martin palka,jan pavlasek', '1:2;2:2;3:3;4:3;5:4;6:4;7:3;8:1;10:2;'),
  (5, 'SWED Team', 'uzivatel5@test.com', 19, 'web,html,css,php,mvc,javascript,jquery,ajax',
   'martin danek,jozef čelko,martin krasňan,dominik turák', '1:3;2:2;3:1;4:3;5:4;6:1;7:1;8:2;9:3;10:2;'),
  (6, 'cool_IT', 'uzivatel@test.com', 2, 'html,css,php,web,javascript,mysql,python',
   'alžbeta bachroníková,michal štefanec,martin fiala,slávka ivaničová', '1:2;2:2;3:3;4:3;5:1;6:1;7:1;8:4;9:4;10:3;'),
  (7, 'BoardSmashers', 'mato.meciar@gmail.com', 7, 'html,css,php,mvc,javascript,mysql,web',
   'jakub motýľ,timotej jurášek,martin miklis,marián glatzner', '1:2;2:4;3:2;4:3;5:2;6:3;7:1;8:3;9:2;10:4;');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
