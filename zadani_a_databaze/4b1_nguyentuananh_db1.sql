-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Čtv 30. bře 2023, 19:28
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
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_published` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Zveřejněný/Nezveřejněný'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `articles`
--

INSERT INTO `articles` (`id`, `introduction`, `content`, `title`, `author_id`, `category_id`, `created_at`, `is_published`) VALUES
(1, 'Největší švýcarská banka UBS patrně koupí za více než dvě miliardy dolarů (více než 45 miliard Kč) svého domácího rivala Credit Suisse. Úřady se snaží, aby obchod proběhl do pondělního rána, kdy se otevírají burzy.', '<h2><em>Bankovn&iacute; panika</em></h2>\r\n<p>&Scaron;v&yacute;carsk&aacute; banka Credit Suisse se dostala pod tlak během minul&eacute;ho t&yacute;dne pot&eacute;, co padla kalifornsk&aacute; banka Silicon Valley Bank a panika se rychle roz&scaron;&iacute;řila po cel&eacute;m světě. Probl&eacute;my &scaron;v&yacute;carsk&eacute;ho věřitele se v&scaron;ak obzvl&aacute;&scaron;tě vyostřily ve středu, kdy největ&scaron;&iacute; akcion&aacute;ř Saudi National Bank odm&iacute;tl nav&yacute;&scaron;it svou investici v bance, a do Credit Suisse tak nal&iacute;t dodatečn&yacute; kapit&aacute;l.</p>\r\n<p>Kapit&aacute;l banka potřebuje, aby odvr&aacute;tila pochyby o&nbsp;sv&eacute;m finančn&iacute;m zdrav&iacute;. Už během loňsk&eacute;ho roku bohat&iacute; klienti a&nbsp;instituce vyb&iacute;rali masivně sv&eacute; vklady. V&nbsp;posledn&iacute;ch třech měs&iacute;c&iacute;ch loňsk&eacute;ho roku si klienti ze skupiny vybrali 111&nbsp;miliard &scaron;v&yacute;carsk&yacute;ch franků. A&nbsp;v&nbsp;minul&eacute;m t&yacute;dnu přes&aacute;hl denn&iacute; odliv vkladů v&nbsp;probl&eacute;mov&eacute; &scaron;v&yacute;carsk&eacute; bance 10&nbsp;miliard franků.</p>\r\n<h2 class=\"e_V e_M g_V\" style=\"text-align: center;\"><em><span style=\"text-decoration: underline;\">Vznik giganta</span></em></h2>\r\n<p>Potenci&aacute;ln&iacute; převzet&iacute; ukazuje, jak rozd&iacute;ln&yacute; je př&iacute;běh obou &scaron;v&yacute;carsk&yacute;ch bank. Za posledn&iacute; tři roky akcie UBS pos&iacute;lily přibližně o&nbsp;120&nbsp;procent, zat&iacute;mco akcie jej&iacute;ho men&scaron;&iacute;ho konkurenta se propadly zhruba o&nbsp;70&nbsp;procent.</p>', 'Credit Suisse v problémech zřejmě koupí největší švýcarská banka UBS.!!!', 2, 1, '2023-03-12 15:23:30', 1),
(2, 'Při sobotním střetu stovek lidí s odpůrci trans komunity v Melbourne bylo vidět, jak někteří demonstranti hajlují. Australští politici nyní řeší zákaz nacistického pozdravu, aby se podobné nenávistné epizody už nemohly opakovat.', '<h2 class=\"e_V e_M g_V\">Policie chr&aacute;n&iacute; projevy nacismu</h2>\r\n<p>Mnoz&iacute; z&nbsp;davu, kter&yacute; při&scaron;el podpořit pr&aacute;va transgender lid&iacute;, vyj&aacute;dřili na soci&aacute;ln&iacute;ch s&iacute;t&iacute;ch zklam&aacute;n&iacute; a&nbsp;hněv nad rol&iacute; policie. Podle někter&yacute;ch totiž policie chr&aacute;nila jasn&eacute; projevy nacismu a&nbsp;nen&aacute;visti. Na jednom video koluj&iacute;c&iacute;m na twitteru je vidět, jak policie chr&aacute;n&iacute; skupinu maskovan&yacute;ch můžu v&nbsp;čern&eacute;m, kteř&iacute; pochoduj&iacute; s&nbsp;australskou vlajkou a&nbsp;během toho hajluj&iacute;.</p>\r\n<p>Tajemn&iacute;k policejn&iacute; asociace Wayne Gatt uvedl, že policist&eacute; byli &bdquo;znechuceni&ldquo; jedn&aacute;n&iacute;m těchto mužů, ale museli je chr&aacute;nit před odpůrci. Řekl, že je prac&iacute; policie chr&aacute;nit v&scaron;echny lidi, i&nbsp;ty, se kter&yacute;mi policist&eacute; nesouhlas&iacute;.</p>\r\n<div class=\"g_ae\" data-cbgdeehfedfdggjgjjgk=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Dal&scaron;&iacute; probl&eacute;m je, že hajlovan&iacute; nen&iacute; v&nbsp;Austr&aacute;lie neleg&aacute;ln&iacute;. St&aacute;t Victoria se stal prvn&iacute; australskou jurisdikc&iacute;, kter&aacute; zak&aacute;zala nacistick&yacute; h&aacute;kov&yacute; kř&iacute;ž. Za jeho vystavov&aacute;n&iacute; hroz&iacute; vysok&eacute; pokuty či odnět&iacute; svobody. Tento z&aacute;kaz se ale nevstahuje na nacistick&yacute; pozdrav zdvižen&eacute; pravice.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-cbgdeehfedfdggjgjjgk=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">&bdquo;Ned&aacute;v&aacute; smysl, že je nyn&iacute; ve Victorii nez&aacute;konn&eacute; vystavovat nacistick&yacute; symbol (&hellip;), ale je dovoleno dělat to, co se stalo včera, tedy chodit a&nbsp;salutovat neonacistick&eacute; ideologii,&ldquo; řekl feder&aacute;ln&iacute; poslanec za labouristy Josh Burns.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-cbgdeehfedfdggjgjjgk=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">&bdquo;Mysl&iacute;m, že se mus&iacute;me např&iacute;č vl&aacute;dou pod&iacute;vat na to, jak&eacute; z&aacute;kony jsou v&nbsp;cel&eacute; zemi potřeba, jak můžeme spolupracovat, abychom zajistili, že se podobn&eacute; bigotn&iacute; a&nbsp;opravdu o&scaron;kliv&eacute; sc&eacute;ny, kter&eacute; jsme viděli, už nebudou opakovat,&ldquo; pokračoval.</span></p>\r\n</div>', 'V australské Victorii se smí hajlovat. Po protestu proti translidem se to změní.', 2, 1, '2023-03-19 22:52:18', 1),
(3, 'Největší švýcarská banka UBS převezme svého domácího rivala Credit Suisse, který se potýká s vážnými finančními problémy. Za transakci zaplatí v přepočtu asi 73 miliard korun!\r\n', '<h2 class=\"e_V e_N g_V g_N\">Probl&eacute;m jeden za druh&yacute;m</h2>\r\n<div class=\"g_ae\" data-cbgdeehfedfdggjgjjgk=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Za loňsk&yacute; rok měla Credit Suisse čistou ztr&aacute;tu 7,29&nbsp;miliardy franků (176,8&nbsp;miliardy Kč), což je nejhor&scaron;&iacute; v&yacute;sledek od glob&aacute;ln&iacute; finančn&iacute; krize z&nbsp;roku 2008.&nbsp;Za rok 2021&nbsp;měla banka ztr&aacute;tu 1,65&nbsp;miliardy franků, m&aacute; tak za sebou druh&yacute; rok v&nbsp;červen&yacute;ch č&iacute;slech.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-cbgdeehfedfdggjgjjgk=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Credit Suisse už koncem loňsk&eacute;ho roku uvedla, že zaznamen&aacute;v&aacute; citelně vy&scaron;&scaron;&iacute; v&yacute;běry hotovostn&iacute;ch vkladů, neobnoven&iacute; splatn&yacute;ch term&iacute;nov&yacute;ch vkladů a&nbsp;čist&yacute; odliv aktiv. V&nbsp;posledn&iacute;ch třech měs&iacute;c&iacute;ch loňsk&eacute;ho roku klienti odčerpali v&iacute;ce než 110&nbsp;miliard CHF, a&nbsp;to kvůli řadě skand&aacute;lů, zděděn&yacute;ch rizik a&nbsp;selh&aacute;n&iacute; při dodržov&aacute;n&iacute; předpisů. V&yacute;běry nad&aacute;le pokračuj&iacute;. Dva zdroje listu Financial Times (FT) uvedly, že odliv vkladů z&nbsp;banky koncem minul&eacute;ho t&yacute;dne přes&aacute;hl deset miliard &scaron;v&yacute;carsk&yacute;ch franků (244&nbsp;miliard Kč) za den.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-cbgdeehfedfdggjgjjgk=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Za posledn&iacute; rok akcie banky ztratily t&eacute;měř tři čtvrtiny sv&eacute; hodnoty a&nbsp;propadly se na historick&aacute; minima. Tento t&yacute;den ve středu se propadly až o&nbsp;30&nbsp;procent. Jej&iacute; největ&scaron;&iacute; investor, kter&yacute;m je finančn&iacute; &uacute;stav Saudi National Bank (SNP), už kvůli regulačn&iacute;m omezen&iacute;m nemohl nakupovat dal&scaron;&iacute; akcie Credit Suisse. Měl by v&nbsp;n&iacute; totiž už v&iacute;ce než desetiprocentn&iacute; pod&iacute;l. Sa&uacute;dskoarabsk&aacute; banka nyn&iacute; v&nbsp;Credit Suisse vlastn&iacute; 9,88&nbsp;procenta akci&iacute;.</span></p>\r\n</div>', 'Svět peněz si oddychl. UBS definitivně převezme Credit Suisse, která má problémy.', 1, 1, '2023-03-19 22:56:36', 1),
(5, 'Momentálně je prakticky nemožné Putina zatknout a postavit před soud, říká v rozhovoru pro Seznam Zprávy Vladimír Dzuro, který vyšetřoval válečné zločiny v Jugoslávii. Co dnes čeká ty, kteří se budou zabývat děním na Ukrajině?', '<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<h2 class=\"e_ae\"><span style=\"text-decoration: underline;\"><span class=\"atm-text-decorator\">Nadpis</span></span></h2>\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Než při&scaron;la v&aacute;lka na Ukrajině, patřily nejčerstvěj&scaron;&iacute; vzpom&iacute;nky na krvav&eacute; děn&iacute; v Evropě Balk&aacute;nu a 90. letům minul&eacute;ho stolet&iacute;. Rozpad b&yacute;val&eacute; Jugosl&aacute;vie doprov&aacute;zely v&aacute;lečn&eacute; zločiny, kter&eacute; na tamn&iacute;ch n&aacute;rodech zanechaly hlubok&eacute; jizvy a na jejichž vy&scaron;etřov&aacute;n&iacute; se pod&iacute;lel i rod&aacute;k z Kladna Vladim&iacute;r Dzuro.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">&bdquo;R&aacute;ny na tamn&iacute;ch du&scaron;&iacute;ch je&scaron;tě nejsou zacelen&eacute; a&nbsp;určit&eacute; nacionalistick&eacute; skupiny st&aacute;le vytahuj&iacute; na světlo d&eacute;mony minulosti i&nbsp;d&eacute;mony v&nbsp;lidech,&ldquo; popsal v&nbsp;rozhovoru pro Seznam Zpr&aacute;vy sv&eacute; dojmy z&nbsp;n&aacute;vratu na Balk&aacute;n b&yacute;val&yacute; kriminalista. Do regionu se vydal po v&iacute;ce než 17&nbsp;letech, aby se pod&iacute;lel na vzniku filmu Vy&scaron;etřovatel, kter&yacute; je v&nbsp;kinech od 9.&nbsp;března.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Během sv&eacute;ho působen&iacute; u&nbsp;Mezin&aacute;rodn&iacute;ho trestn&iacute;ho tribun&aacute;lu pro b&yacute;valou Jugosl&aacute;vii (ICTY) se zab&yacute;val např&iacute;klad masakrem na farmě Ovčara a&nbsp;spolu se sv&yacute;m t&yacute;mem dopadl prvn&iacute;ho v&aacute;lečn&eacute;ho zločince jugosl&aacute;vsk&yacute;ch v&aacute;lek Slavka Dokmanoviće, starostu chorvatsk&eacute;ho Vukovaru, kter&yacute; se pr&aacute;vě na ovčarsk&yacute;ch ud&aacute;lostech pod&iacute;lel.</span></p>\r\n</div>\r\n<div class=\"g_bi\" data-dot=\"mol-self-promo\">\r\n<div class=\"g_f5 js-ad g_bq\">&nbsp;</div>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">V rozhovoru popsal např&iacute;klad to, proč bylo zatčen&iacute; Dokmanoviće důležit&eacute; a&nbsp;zda procesy s&nbsp;v&aacute;lečn&yacute;mi zločinci mohou přin&eacute;st usm&iacute;řen&iacute;. Nevynech&aacute;v&aacute; ani dne&scaron;n&iacute; děn&iacute; ve v&yacute;chodn&iacute; Evropě, kter&eacute; mimo jin&eacute; vyvol&aacute;v&aacute; ot&aacute;zku, jak těžk&yacute; &uacute;kol maj&iacute; před sebou vy&scaron;etřovatel&eacute;, kteř&iacute; se konfliktem na Ukrajině zab&yacute;vaj&iacute;.</span></p>\r\n<h2 class=\"e_ae\"><span class=\"atm-text-decorator\">Co ř&iacute;k&aacute;te na skutečnost že Mezin&aacute;rodn&iacute; trestn&iacute; soud v&nbsp;Haagu vydal zatykač na prezidenta Vladimira Putina?</span></h2>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Na tuhle ot&aacute;zku je poměrně komplikovan&aacute; odpověď. Pokud se mě pt&aacute;te jako občana, kter&yacute; s&nbsp;velk&yacute;m znepokojen&iacute;m sleduje děn&iacute; na Ukrajině, tak je odpověď jednoznačn&aacute;. Jsem r&aacute;d, že soud zatykač vydal, protože je to spr&aacute;vn&yacute; sign&aacute;l v&scaron;em, kteř&iacute; pl&aacute;nuj&iacute; agresivn&iacute; v&aacute;lku proti sv&yacute;m sousedům. Pokud se mě ale pt&aacute;te jako vy&scaron;etřovatele v&aacute;lečn&yacute;ch zločinů, moje odpověď bude m&eacute;ně optimistick&aacute;.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">V současn&eacute; situaci je prakticky nemožn&eacute; prezidenta Putina zatknout a&nbsp;postavit před soud. Stejně tak, jako to bylo se srbsk&yacute;m prezidentem Slobodanem Milo&scaron;evićem, bude nejsp&iacute;&scaron;e nutn&aacute; změna režimu v&nbsp;Rusku, kter&aacute; by umožnila jeho zatčen&iacute; a&nbsp;n&aacute;sledn&eacute; vyd&aacute;n&iacute;. Co je ale mysl&iacute;m dobr&aacute; zpr&aacute;va, je to, že Putin vejde do dějin jako obviněn&yacute; v&aacute;lečn&yacute; zločinec bez ohledu na to, jestli bude kdy souzen.</span></p>\r\n<h2 class=\"e_ae\"><span class=\"atm-text-decorator\">Vraťme se do b&yacute;aval&eacute; Jugosl&aacute;vie. Jak&eacute; to pro v&aacute;s bylo b&yacute;t po tolika letech na Balk&aacute;ně? Věř&iacute;m, že jste se ocitl i na m&iacute;stech, kter&aacute; pro v&aacute;s byla dost emotivn&iacute;.</span></h2>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Od tribun&aacute;lu jsem ode&scaron;el v&nbsp;roce 2004&nbsp;kvůli pr&aacute;ci pro &Uacute;řad pro vnitřn&iacute; z&aacute;ležitosti OSN, kterou jsem dělal až do konce minul&eacute;ho měs&iacute;ce. Od t&eacute; doby jsem byl na Balk&aacute;ně pouze jednou v&nbsp;roce 2006, kdy jsem pracoval v&nbsp;Kosovu. &Scaron;lo tedy o&nbsp;prvn&iacute; n&aacute;vrat do Chorvatska, Srbska a&nbsp;Bosny za posledn&iacute;ch v&iacute;ce než 17&nbsp;let a&nbsp;nevěděl jsem, co od toho m&aacute;m čekat.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Opět jsem si uvědomil, jak jednoduch&eacute; je opravit materi&aacute;ln&iacute; &scaron;kody. Když jsem je&scaron;tě pracoval pro tribun&aacute;l ve Vukovaru, tak i&nbsp;po osmi letech po skončen&iacute; v&aacute;lky byl Vukovar takov&aacute; &bdquo;poloruina&ldquo;. Tentokr&aacute;t v&scaron;ak město bylo skoro stejn&eacute; jako před v&aacute;lkou a&nbsp;dř&iacute;ve zcela rozbořen&eacute; domy z&aacute;řily novotou. Vukovar dnes vypad&aacute; jako každ&eacute; jin&eacute; město v&nbsp;Chorvatsku, dokud nezačnete mluvit s&nbsp;lidmi.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">V jejich hlav&aacute;ch je st&aacute;le hluboce zakořeněna v&aacute;lka a&nbsp;nedůvěra k&nbsp;okol&iacute;. Tohle totiž - na rozd&iacute;l třeba od druh&eacute; světov&eacute; v&aacute;lky, nebo od v&aacute;lky na Ukrajině - byla v&aacute;lka sousedů a&nbsp;někdy pak i&nbsp;v&aacute;lka rodin. Často se st&aacute;valo, že na opačn&eacute; straně pomysln&yacute;ch barik&aacute;d byli př&iacute;buzn&iacute;, kteř&iacute; spolu po desetilet&iacute; žili a&nbsp;kter&eacute; najednou rozdělila politika.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Jako prvn&iacute; jsem si tak v&scaron;iml kontrastu mezi t&iacute;m, jak jednoduch&eacute; je opravit domy nebo silnice a&nbsp;jak těžk&eacute; je opravit my&scaron;len&iacute; lid&iacute;. Samostatnou kapitolou pak bylo opětovn&eacute; setk&aacute;n&iacute; se svědky, kteř&iacute; v&nbsp;dokumentu figuruj&iacute; a&nbsp;kter&eacute; jsem před lety vysl&yacute;chal.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Když to totiž děl&aacute;te dobře, lid&eacute; se v&aacute;m otevřou a&nbsp;řeknou v&aacute;m i&nbsp;takov&eacute; věci, kter&eacute; by třeba norm&aacute;lně ř&iacute;ct nechtěli. Vy s&nbsp;nimi podep&iacute;&scaron;ete protokol a&nbsp;n&aacute;sledně si je převezme syst&eacute;m, kter&yacute; je podrob&iacute; celkem brut&aacute;ln&iacute;mu procesu. Ocitnou se na jim nezn&aacute;m&eacute;m m&iacute;stě - před soudem v&nbsp;Haagu, kde potřebuj&iacute; tlumočn&iacute;ka, aby se vůbec dorozuměli - a&nbsp;v soudn&iacute; s&iacute;ni jsou podrobeni kř&iacute;žov&eacute;mu v&yacute;slechu obhajoby, během kter&eacute;ho je zesmě&scaron;ňuj&iacute; a&nbsp;snaž&iacute; se dok&aacute;zat, že nemluv&iacute; pravdu.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Nebyl jsem si tak jist&yacute;, jak se na mě budou d&iacute;vat kvůli tomu, č&iacute;m jsem je vlastně prohnal. Byla to ale velice pozitivn&iacute; setk&aacute;n&iacute; a&nbsp;měl jsem z&nbsp;nich dobr&yacute; pocit. V&nbsp;hlav&aacute;ch ov&scaron;em st&aacute;le maj&iacute; strach ze sousedů. Ve Vukovaru jsem viděl &scaron;kolu, kde z&nbsp;jedn&eacute; strany chod&iacute; srbsk&eacute; děti a&nbsp;z druh&eacute; strany chorvatsk&eacute;. &Uacute;pln&eacute; usm&iacute;řen&iacute; je tak zřejmě je&scaron;tě hodně daleko.</span></p>\r\n</div>\r\n</div>\r\n</div>', 'Zatknout Putina je nyní nemožné, říká vyšetřovatel z JugoslávieXX', 2, 1, '2023-03-20 12:52:26', 1),
(9, 'Momentálně je prakticky nemožné Putina zatknout a postavit před soud, říká v rozhovoru pro Seznam Zprávy Vladimír Dzuro, který vyšetřoval válečné zločiny v Jugoslávii. Co dnes čeká ty, kteří se budou zabývat děním na Ukrajině?', '<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<h2 class=\"e_ae\"><span class=\"atm-text-decorator\">Nadpis</span></h2>\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Než při&scaron;la v&aacute;lka na Ukrajině, patřily nejčerstvěj&scaron;&iacute; vzpom&iacute;nky na krvav&eacute; děn&iacute; v Evropě Balk&aacute;nu a 90. letům minul&eacute;ho stolet&iacute;. Rozpad b&yacute;val&eacute; Jugosl&aacute;vie doprov&aacute;zely v&aacute;lečn&eacute; zločiny, kter&eacute; na tamn&iacute;ch n&aacute;rodech zanechaly hlubok&eacute; jizvy a na jejichž vy&scaron;etřov&aacute;n&iacute; se pod&iacute;lel i rod&aacute;k z Kladna Vladim&iacute;r Dzuro.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">&bdquo;R&aacute;ny na tamn&iacute;ch du&scaron;&iacute;ch je&scaron;tě nejsou zacelen&eacute; a&nbsp;určit&eacute; nacionalistick&eacute; skupiny st&aacute;le vytahuj&iacute; na světlo d&eacute;mony minulosti i&nbsp;d&eacute;mony v&nbsp;lidech,&ldquo; popsal v&nbsp;rozhovoru pro Seznam Zpr&aacute;vy sv&eacute; dojmy z&nbsp;n&aacute;vratu na Balk&aacute;n b&yacute;val&yacute; kriminalista. Do regionu se vydal po v&iacute;ce než 17&nbsp;letech, aby se pod&iacute;lel na vzniku filmu Vy&scaron;etřovatel, kter&yacute; je v&nbsp;kinech od 9.&nbsp;března.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Během sv&eacute;ho působen&iacute; u&nbsp;Mezin&aacute;rodn&iacute;ho trestn&iacute;ho tribun&aacute;lu pro b&yacute;valou Jugosl&aacute;vii (ICTY) se zab&yacute;val např&iacute;klad masakrem na farmě Ovčara a&nbsp;spolu se sv&yacute;m t&yacute;mem dopadl prvn&iacute;ho v&aacute;lečn&eacute;ho zločince jugosl&aacute;vsk&yacute;ch v&aacute;lek Slavka Dokmanoviće, starostu chorvatsk&eacute;ho Vukovaru, kter&yacute; se pr&aacute;vě na ovčarsk&yacute;ch ud&aacute;lostech pod&iacute;lel.</span></p>\r\n</div>\r\n<div class=\"g_bi\" data-dot=\"mol-self-promo\">\r\n<div class=\"g_f5 js-ad g_bq\">&nbsp;</div>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">V rozhovoru popsal např&iacute;klad to, proč bylo zatčen&iacute; Dokmanoviće důležit&eacute; a&nbsp;zda procesy s&nbsp;v&aacute;lečn&yacute;mi zločinci mohou přin&eacute;st usm&iacute;řen&iacute;. Nevynech&aacute;v&aacute; ani dne&scaron;n&iacute; děn&iacute; ve v&yacute;chodn&iacute; Evropě, kter&eacute; mimo jin&eacute; vyvol&aacute;v&aacute; ot&aacute;zku, jak těžk&yacute; &uacute;kol maj&iacute; před sebou vy&scaron;etřovatel&eacute;, kteř&iacute; se konfliktem na Ukrajině zab&yacute;vaj&iacute;.</span></p>\r\n<h2 class=\"e_ae\"><span class=\"atm-text-decorator\">Co ř&iacute;k&aacute;te na skutečnost že Mezin&aacute;rodn&iacute; trestn&iacute; soud v&nbsp;Haagu vydal zatykač na prezidenta Vladimira Putina?</span></h2>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Na tuhle ot&aacute;zku je poměrně komplikovan&aacute; odpověď. Pokud se mě pt&aacute;te jako občana, kter&yacute; s&nbsp;velk&yacute;m znepokojen&iacute;m sleduje děn&iacute; na Ukrajině, tak je odpověď jednoznačn&aacute;. Jsem r&aacute;d, že soud zatykač vydal, protože je to spr&aacute;vn&yacute; sign&aacute;l v&scaron;em, kteř&iacute; pl&aacute;nuj&iacute; agresivn&iacute; v&aacute;lku proti sv&yacute;m sousedům. Pokud se mě ale pt&aacute;te jako vy&scaron;etřovatele v&aacute;lečn&yacute;ch zločinů, moje odpověď bude m&eacute;ně optimistick&aacute;.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">V současn&eacute; situaci je prakticky nemožn&eacute; prezidenta Putina zatknout a&nbsp;postavit před soud. Stejně tak, jako to bylo se srbsk&yacute;m prezidentem Slobodanem Milo&scaron;evićem, bude nejsp&iacute;&scaron;e nutn&aacute; změna režimu v&nbsp;Rusku, kter&aacute; by umožnila jeho zatčen&iacute; a&nbsp;n&aacute;sledn&eacute; vyd&aacute;n&iacute;. Co je ale mysl&iacute;m dobr&aacute; zpr&aacute;va, je to, že Putin vejde do dějin jako obviněn&yacute; v&aacute;lečn&yacute; zločinec bez ohledu na to, jestli bude kdy souzen.</span></p>\r\n<h2 class=\"e_ae\"><span class=\"atm-text-decorator\">Vraťme se do b&yacute;val&eacute; Jugosl&aacute;vie. Jak&eacute; to pro v&aacute;s bylo b&yacute;t po tolika letech na Balk&aacute;ně? Věř&iacute;m, že jste se ocitl i&nbsp;na m&iacute;stech, kter&aacute; pro v&aacute;s byla dost emotivn&iacute;.</span></h2>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Od tribun&aacute;lu jsem ode&scaron;el v&nbsp;roce 2004&nbsp;kvůli pr&aacute;ci pro &Uacute;řad pro vnitřn&iacute; z&aacute;ležitosti OSN, kterou jsem dělal až do konce minul&eacute;ho měs&iacute;ce. Od t&eacute; doby jsem byl na Balk&aacute;ně pouze jednou v&nbsp;roce 2006, kdy jsem pracoval v&nbsp;Kosovu. &Scaron;lo tedy o&nbsp;prvn&iacute; n&aacute;vrat do Chorvatska, Srbska a&nbsp;Bosny za posledn&iacute;ch v&iacute;ce než 17&nbsp;let a&nbsp;nevěděl jsem, co od toho m&aacute;m čekat.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Opět jsem si uvědomil, jak jednoduch&eacute; je opravit materi&aacute;ln&iacute; &scaron;kody. Když jsem je&scaron;tě pracoval pro tribun&aacute;l ve Vukovaru, tak i&nbsp;po osmi letech po skončen&iacute; v&aacute;lky byl Vukovar takov&aacute; &bdquo;poloruina&ldquo;. Tentokr&aacute;t v&scaron;ak město bylo skoro stejn&eacute; jako před v&aacute;lkou a&nbsp;dř&iacute;ve zcela rozbořen&eacute; domy z&aacute;řily novotou. Vukovar dnes vypad&aacute; jako každ&eacute; jin&eacute; město v&nbsp;Chorvatsku, dokud nezačnete mluvit s&nbsp;lidmi.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">V jejich hlav&aacute;ch je st&aacute;le hluboce zakořeněna v&aacute;lka a&nbsp;nedůvěra k&nbsp;okol&iacute;. Tohle totiž - na rozd&iacute;l třeba od druh&eacute; světov&eacute; v&aacute;lky, nebo od v&aacute;lky na Ukrajině - byla v&aacute;lka sousedů a&nbsp;někdy pak i&nbsp;v&aacute;lka rodin. Často se st&aacute;valo, že na opačn&eacute; straně pomysln&yacute;ch barik&aacute;d byli př&iacute;buzn&iacute;, kteř&iacute; spolu po desetilet&iacute; žili a&nbsp;kter&eacute; najednou rozdělila politika.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Jako prvn&iacute; jsem si tak v&scaron;iml kontrastu mezi t&iacute;m, jak jednoduch&eacute; je opravit domy nebo silnice a&nbsp;jak těžk&eacute; je opravit my&scaron;len&iacute; lid&iacute;. Samostatnou kapitolou pak bylo opětovn&eacute; setk&aacute;n&iacute; se svědky, kteř&iacute; v&nbsp;dokumentu figuruj&iacute; a&nbsp;kter&eacute; jsem před lety vysl&yacute;chal.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Když to totiž děl&aacute;te dobře, lid&eacute; se v&aacute;m otevřou a&nbsp;řeknou v&aacute;m i&nbsp;takov&eacute; věci, kter&eacute; by třeba norm&aacute;lně ř&iacute;ct nechtěli. Vy s&nbsp;nimi podep&iacute;&scaron;ete protokol a&nbsp;n&aacute;sledně si je převezme syst&eacute;m, kter&yacute; je podrob&iacute; celkem brut&aacute;ln&iacute;mu procesu. Ocitnou se na jim nezn&aacute;m&eacute;m m&iacute;stě - před soudem v&nbsp;Haagu, kde potřebuj&iacute; tlumočn&iacute;ka, aby se vůbec dorozuměli - a&nbsp;v soudn&iacute; s&iacute;ni jsou podrobeni kř&iacute;žov&eacute;mu v&yacute;slechu obhajoby, během kter&eacute;ho je zesmě&scaron;ňuj&iacute; a&nbsp;snaž&iacute; se dok&aacute;zat, že nemluv&iacute; pravdu.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Nebyl jsem si tak jist&yacute;, jak se na mě budou d&iacute;vat kvůli tomu, č&iacute;m jsem je vlastně prohnal. Byla to ale velice pozitivn&iacute; setk&aacute;n&iacute; a&nbsp;měl jsem z&nbsp;nich dobr&yacute; pocit. V&nbsp;hlav&aacute;ch ov&scaron;em st&aacute;le maj&iacute; strach ze sousedů. Ve Vukovaru jsem viděl &scaron;kolu, kde z&nbsp;jedn&eacute; strany chod&iacute; srbsk&eacute; děti a&nbsp;z druh&eacute; strany chorvatsk&eacute;. &Uacute;pln&eacute; usm&iacute;řen&iacute; je tak zřejmě je&scaron;tě hodně daleko.</span></p>\r\n</div>\r\n</div>\r\n</div>', 'Zatknout Putina je nyní nemožné, říká vyšetřovatel z Jugoslávie', 1, 2, '2023-03-20 12:52:26', 1),
(10, 'Momentálně je prakticky nemožné Putina zatknout a postavit před soud, říká v rozhovoru pro Seznam Zprávy Vladimír Dzuro, který vyšetřoval válečné zločiny v Jugoslávii. Co dnes čeká ty, kteří se budou zabývat děním na Ukrajině?', '<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<h2 class=\"e_ae\"><span class=\"atm-text-decorator\">Nadpis</span></h2>\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Než při&scaron;la v&aacute;lka na Ukrajině, patřily nejčerstvěj&scaron;&iacute; vzpom&iacute;nky na krvav&eacute; děn&iacute; v Evropě Balk&aacute;nu a 90. letům minul&eacute;ho stolet&iacute;. Rozpad b&yacute;val&eacute; Jugosl&aacute;vie doprov&aacute;zely v&aacute;lečn&eacute; zločiny, kter&eacute; na tamn&iacute;ch n&aacute;rodech zanechaly hlubok&eacute; jizvy a na jejichž vy&scaron;etřov&aacute;n&iacute; se pod&iacute;lel i rod&aacute;k z Kladna Vladim&iacute;r Dzuro.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">&bdquo;R&aacute;ny na tamn&iacute;ch du&scaron;&iacute;ch je&scaron;tě nejsou zacelen&eacute; a&nbsp;určit&eacute; nacionalistick&eacute; skupiny st&aacute;le vytahuj&iacute; na světlo d&eacute;mony minulosti i&nbsp;d&eacute;mony v&nbsp;lidech,&ldquo; popsal v&nbsp;rozhovoru pro Seznam Zpr&aacute;vy sv&eacute; dojmy z&nbsp;n&aacute;vratu na Balk&aacute;n b&yacute;val&yacute; kriminalista. Do regionu se vydal po v&iacute;ce než 17&nbsp;letech, aby se pod&iacute;lel na vzniku filmu Vy&scaron;etřovatel, kter&yacute; je v&nbsp;kinech od 9.&nbsp;března.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Během sv&eacute;ho působen&iacute; u&nbsp;Mezin&aacute;rodn&iacute;ho trestn&iacute;ho tribun&aacute;lu pro b&yacute;valou Jugosl&aacute;vii (ICTY) se zab&yacute;val např&iacute;klad masakrem na farmě Ovčara a&nbsp;spolu se sv&yacute;m t&yacute;mem dopadl prvn&iacute;ho v&aacute;lečn&eacute;ho zločince jugosl&aacute;vsk&yacute;ch v&aacute;lek Slavka Dokmanoviće, starostu chorvatsk&eacute;ho Vukovaru, kter&yacute; se pr&aacute;vě na ovčarsk&yacute;ch ud&aacute;lostech pod&iacute;lel.</span></p>\r\n</div>\r\n<div class=\"g_bi\" data-dot=\"mol-self-promo\">\r\n<div class=\"g_f5 js-ad g_bq\">&nbsp;</div>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">V rozhovoru popsal např&iacute;klad to, proč bylo zatčen&iacute; Dokmanoviće důležit&eacute; a&nbsp;zda procesy s&nbsp;v&aacute;lečn&yacute;mi zločinci mohou přin&eacute;st usm&iacute;řen&iacute;. Nevynech&aacute;v&aacute; ani dne&scaron;n&iacute; děn&iacute; ve v&yacute;chodn&iacute; Evropě, kter&eacute; mimo jin&eacute; vyvol&aacute;v&aacute; ot&aacute;zku, jak těžk&yacute; &uacute;kol maj&iacute; před sebou vy&scaron;etřovatel&eacute;, kteř&iacute; se konfliktem na Ukrajině zab&yacute;vaj&iacute;.</span></p>\r\n<h2 class=\"e_ae\"><span class=\"atm-text-decorator\">Co ř&iacute;k&aacute;te na skutečnost že Mezin&aacute;rodn&iacute; trestn&iacute; soud v&nbsp;Haagu vydal zatykač na prezidenta Vladimira Putina?</span></h2>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Na tuhle ot&aacute;zku je poměrně komplikovan&aacute; odpověď. Pokud se mě pt&aacute;te jako občana, kter&yacute; s&nbsp;velk&yacute;m znepokojen&iacute;m sleduje děn&iacute; na Ukrajině, tak je odpověď jednoznačn&aacute;. Jsem r&aacute;d, že soud zatykač vydal, protože je to spr&aacute;vn&yacute; sign&aacute;l v&scaron;em, kteř&iacute; pl&aacute;nuj&iacute; agresivn&iacute; v&aacute;lku proti sv&yacute;m sousedům. Pokud se mě ale pt&aacute;te jako vy&scaron;etřovatele v&aacute;lečn&yacute;ch zločinů, moje odpověď bude m&eacute;ně optimistick&aacute;.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">V současn&eacute; situaci je prakticky nemožn&eacute; prezidenta Putina zatknout a&nbsp;postavit před soud. Stejně tak, jako to bylo se srbsk&yacute;m prezidentem Slobodanem Milo&scaron;evićem, bude nejsp&iacute;&scaron;e nutn&aacute; změna režimu v&nbsp;Rusku, kter&aacute; by umožnila jeho zatčen&iacute; a&nbsp;n&aacute;sledn&eacute; vyd&aacute;n&iacute;. Co je ale mysl&iacute;m dobr&aacute; zpr&aacute;va, je to, že Putin vejde do dějin jako obviněn&yacute; v&aacute;lečn&yacute; zločinec bez ohledu na to, jestli bude kdy souzen.</span></p>\r\n<h2 class=\"e_ae\"><span class=\"atm-text-decorator\">Vraťme se do b&yacute;val&eacute; Jugosl&aacute;vie. Jak&eacute; to pro v&aacute;s bylo b&yacute;t po tolika letech na Balk&aacute;ně? Věř&iacute;m, že jste se ocitl i&nbsp;na m&iacute;stech, kter&aacute; pro v&aacute;s byla dost emotivn&iacute;.</span></h2>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Od tribun&aacute;lu jsem ode&scaron;el v&nbsp;roce 2004&nbsp;kvůli pr&aacute;ci pro &Uacute;řad pro vnitřn&iacute; z&aacute;ležitosti OSN, kterou jsem dělal až do konce minul&eacute;ho měs&iacute;ce. Od t&eacute; doby jsem byl na Balk&aacute;ně pouze jednou v&nbsp;roce 2006, kdy jsem pracoval v&nbsp;Kosovu. &Scaron;lo tedy o&nbsp;prvn&iacute; n&aacute;vrat do Chorvatska, Srbska a&nbsp;Bosny za posledn&iacute;ch v&iacute;ce než 17&nbsp;let a&nbsp;nevěděl jsem, co od toho m&aacute;m čekat.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Opět jsem si uvědomil, jak jednoduch&eacute; je opravit materi&aacute;ln&iacute; &scaron;kody. Když jsem je&scaron;tě pracoval pro tribun&aacute;l ve Vukovaru, tak i&nbsp;po osmi letech po skončen&iacute; v&aacute;lky byl Vukovar takov&aacute; &bdquo;poloruina&ldquo;. Tentokr&aacute;t v&scaron;ak město bylo skoro stejn&eacute; jako před v&aacute;lkou a&nbsp;dř&iacute;ve zcela rozbořen&eacute; domy z&aacute;řily novotou. Vukovar dnes vypad&aacute; jako každ&eacute; jin&eacute; město v&nbsp;Chorvatsku, dokud nezačnete mluvit s&nbsp;lidmi.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">V jejich hlav&aacute;ch je st&aacute;le hluboce zakořeněna v&aacute;lka a&nbsp;nedůvěra k&nbsp;okol&iacute;. Tohle totiž - na rozd&iacute;l třeba od druh&eacute; světov&eacute; v&aacute;lky, nebo od v&aacute;lky na Ukrajině - byla v&aacute;lka sousedů a&nbsp;někdy pak i&nbsp;v&aacute;lka rodin. Často se st&aacute;valo, že na opačn&eacute; straně pomysln&yacute;ch barik&aacute;d byli př&iacute;buzn&iacute;, kteř&iacute; spolu po desetilet&iacute; žili a&nbsp;kter&eacute; najednou rozdělila politika.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Jako prvn&iacute; jsem si tak v&scaron;iml kontrastu mezi t&iacute;m, jak jednoduch&eacute; je opravit domy nebo silnice a&nbsp;jak těžk&eacute; je opravit my&scaron;len&iacute; lid&iacute;. Samostatnou kapitolou pak bylo opětovn&eacute; setk&aacute;n&iacute; se svědky, kteř&iacute; v&nbsp;dokumentu figuruj&iacute; a&nbsp;kter&eacute; jsem před lety vysl&yacute;chal.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Když to totiž děl&aacute;te dobře, lid&eacute; se v&aacute;m otevřou a&nbsp;řeknou v&aacute;m i&nbsp;takov&eacute; věci, kter&eacute; by třeba norm&aacute;lně ř&iacute;ct nechtěli. Vy s&nbsp;nimi podep&iacute;&scaron;ete protokol a&nbsp;n&aacute;sledně si je převezme syst&eacute;m, kter&yacute; je podrob&iacute; celkem brut&aacute;ln&iacute;mu procesu. Ocitnou se na jim nezn&aacute;m&eacute;m m&iacute;stě - před soudem v&nbsp;Haagu, kde potřebuj&iacute; tlumočn&iacute;ka, aby se vůbec dorozuměli - a&nbsp;v soudn&iacute; s&iacute;ni jsou podrobeni kř&iacute;žov&eacute;mu v&yacute;slechu obhajoby, během kter&eacute;ho je zesmě&scaron;ňuj&iacute; a&nbsp;snaž&iacute; se dok&aacute;zat, že nemluv&iacute; pravdu.</span></p>\r\n</div>\r\n<div class=\"g_ae\" data-dot=\"mol-paragraph\">\r\n<p class=\"e_ae\"><span class=\"atm-text-decorator\">Nebyl jsem si tak jist&yacute;, jak se na mě budou d&iacute;vat kvůli tomu, č&iacute;m jsem je vlastně prohnal. Byla to ale velice pozitivn&iacute; setk&aacute;n&iacute; a&nbsp;měl jsem z&nbsp;nich dobr&yacute; pocit. V&nbsp;hlav&aacute;ch ov&scaron;em st&aacute;le maj&iacute; strach ze sousedů. Ve Vukovaru jsem viděl &scaron;kolu, kde z&nbsp;jedn&eacute; strany chod&iacute; srbsk&eacute; děti a&nbsp;z druh&eacute; strany chorvatsk&eacute;. &Uacute;pln&eacute; usm&iacute;řen&iacute; je tak zřejmě je&scaron;tě hodně daleko.</span></p>\r\n</div>\r\n</div>\r\n</div>', 'Zatknout Putina je nyní nemožné, říká vyšetřovatel z Jugoslávie', 1, 2, '2023-03-20 12:52:26', 1);

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
(1, 'Karel', 'Novákov', '2023-03-12 15:22:30'),
(2, 'OndrejY', 'SvobodaYa', '2023-03-19 22:52:59');

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
(1, 'Energetika'),
(2, 'Světoborné');

-- --------------------------------------------------------

--
-- Struktura tabulky `permissions`
--

CREATE TABLE `permissions` (
  `perm_id` int(10) UNSIGNED NOT NULL,
  `perm_name` varchar(20) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `permissions`
--

INSERT INTO `permissions` (`perm_id`, `perm_name`) VALUES
(1, 'read'),
(2, 'write'),
(3, 'delete'),
(4, 'full_access');

-- --------------------------------------------------------

--
-- Struktura tabulky `resources`
--

CREATE TABLE `resources` (
  `resource_id` int(10) UNSIGNED NOT NULL,
  `resource_name` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `resources`
--

INSERT INTO `resources` (`resource_id`, `resource_name`) VALUES
(2, 'articles'),
(3, 'authors'),
(4, 'categories'),
(5, 'all');

-- --------------------------------------------------------

--
-- Struktura tabulky `roles`
--

CREATE TABLE `roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(20) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Struktura tabulky `roles_perms`
--

CREATE TABLE `roles_perms` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `perm_id` int(10) UNSIGNED NOT NULL,
  `resource_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `roles_perms`
--

INSERT INTO `roles_perms` (`id`, `role_id`, `perm_id`, `resource_id`) VALUES
(2, 1, 4, 5),
(3, 2, 1, 5);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_czech_ci NOT NULL COMMENT 'Zahashovaný plain text algoritmem BCRYPT',
  `role_id` int(10) UNSIGNED NOT NULL
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
-- Klíče pro tabulku `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`perm_id`);

--
-- Klíče pro tabulku `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resource_id`);

--
-- Klíče pro tabulku `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Klíče pro tabulku `roles_perms`
--
ALTER TABLE `roles_perms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perm_id` (`perm_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `resource_id` (`resource_id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pro tabulku `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `permissions`
--
ALTER TABLE `permissions`
  MODIFY `perm_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `resources`
--
ALTER TABLE `resources`
  MODIFY `resource_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `roles_perms`
--
ALTER TABLE `roles_perms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- Omezení pro tabulku `roles_perms`
--
ALTER TABLE `roles_perms`
  ADD CONSTRAINT `roles_perms_ibfk_1` FOREIGN KEY (`perm_id`) REFERENCES `permissions` (`perm_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_perms_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_perms_ibfk_3` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`resource_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
