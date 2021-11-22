-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Lis 2021, 14:17
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mymess`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `ifRead` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `conversations`
--

INSERT INTO `conversations` (`id`, `id_user`, `id_sender`, `ifRead`) VALUES
(24, 1, 1, 1),
(25, 2, 3, 1),
(26, 3, 2, 1),
(27, 2, 1, 1),
(28, 1, 2, 1),
(29, 2, 4, 1),
(30, 4, 2, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `text` mediumtext COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `id_receiver`, `id_sender`, `text`) VALUES
(64, 3, 2, '😋'),
(65, 2, 3, 'o ty'),
(66, 2, 3, 'fsfdsfd');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `prof_pic` varchar(255) NOT NULL DEFAULT 'user (1).png',
  `code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `prof_pic`, `code`) VALUES
(1, 'user1', 'haslo', 'uzyt', 'user (1).png', 'abc13'),
(2, 'user2', 'haslo', 'szykon', 'user (1).png', 'abc14'),
(3, 'user3', 'haslo', 'przemoemo', 'man.png', 'abc12'),
(4, 'user4', 'haslo', 'userek', 'user (1).png', 'ABCDE');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
