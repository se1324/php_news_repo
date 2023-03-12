-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Ned 12. bře 2023, 15:25
-- Verze serveru: 10.3.25-MariaDB-0+deb10u1
-- Verze PHP: 5.6.36-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `4b1_nguyentuananh_db1`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `introduction` text COLLATE utf8_czech_ci DEFAULT NULL,
  `content` text COLLATE utf8_czech_ci DEFAULT NULL,
  `title` text COLLATE utf8_czech_ci DEFAULT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `articles`
--

INSERT INTO `articles` (`id`, `introduction`, `content`, `title`, `author_id`, `category_id`, `created_at`) VALUES
(1, 'České domácnosti v meziročním srovnání nevídaně šetřily energiemi. Elektrárny přitom vyrobily dostatek elektřiny – výpadek plynu nahradily hlavně uhlím.', 'Bezprecedentní šetření. Ještě nikdy v historii měření se českým domácnostem nepodařilo snížit spotřebu elektřiny tak jako v loňském roce. Celkem elektřiny spotřebovaly téměř o desetinu méně než v roce 2021. Vyplývá to ze zprávy o provozu elektrizační soustavy, kterou vydává Energetický regulační úřad (ERÚ).\r\n\r\n„Meziroční devítiprocentní pokles spotřeby byl nejvyšší za dvacet let, kdy ERÚ vydává zprávy o provozu elektrizační soustavy,“ říká Stanislav Trávníček, předseda Rady ERÚ. Největší změny nastaly hlavně v červnu a květnu, kdy byla spotřeba nejnižší za poslední čtyři roky.\r\n\r\nŠetření přitom nezpůsobil nedostatek vyrobené elektřiny. Naopak, i v loňském roce Česko vyvezlo více elektřiny, než jí přivezlo. Vysoké ceny na mezinárodních burzách totiž způsobily, že hodnota v Česku vyrobené elektřiny oproti předchozímu roku výrazně vzrostla.\r\n\r\nV celkovém množství vyrobené elektřiny přitom vznikl podstatný výpadek. Platil hlavně v případě paroplynových elektráren, které vyrobily o polovinu elektřiny méně než v roce 2021. Úbytek energie z paroplynových elektráren ale zastoupila produkce parních zařízení. Tedy těch, které pro výrobu elektřiny zpracovávají uhlí.\r\n\r\nJeště více se v minulém roce snížila spotřeba zemního plynu. A to nejen celoročně, ale také v každém jednotlivém měsíci – od ledna až do prosince. Celkově byla spotřeba nejnižší za posledních osm let.\r\n\r\nPokud navíc spotřebu přepočítáme na teplotní průměr, byla vůbec nejnižší od roku 2001, kdy ji ERÚ začal měřit. Tento přepočet říká, kolik plynu se spotřebuje v případě, že za dané období (v tomto případě rok) se teplota rovná dlouhodobému průměru. Je tedy přesnější, než když počítáme s absolutními hodnotami ve statistikách.', 'Nejen plyn, ale také elektřina. Domácnosti rekordně šetří energiemi', 1, 1, '2023-03-12 15:23:30');

-- --------------------------------------------------------

--
-- Struktura tabulky `authors`
--

CREATE TABLE `authors` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `surname` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `authors`
--

INSERT INTO `authors` (`id`, `name`, `surname`, `created_at`) VALUES
(1, 'Karel', 'Novák', '2023-03-12 15:22:30');

-- --------------------------------------------------------

--
-- Struktura tabulky `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Energetika');

-- --------------------------------------------------------

--
-- Struktura tabulky `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `fullname` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `content` text COLLATE utf8_czech_ci DEFAULT NULL,
  `article_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_article_category` (`category_id`),
  ADD KEY `FK_article_author` (`author_id`);

--
-- Klíče pro tabulku `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD KEY `FK_comment_article` (`article_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `FK_article_author` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `FK_article_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Omezení pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_comment_article` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
