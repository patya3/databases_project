-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2018. Nov 11. 19:01
-- Kiszolgáló verziója: 10.1.34-MariaDB
-- PHP verzió: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `tv_guide`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `channels`
--

CREATE TABLE `channels` (
  `id` int(11) NOT NULL,
  `channel_name` varchar(150) COLLATE utf8_hungarian_ci NOT NULL,
  `channel_category_id` int(11) NOT NULL,
  `channel_logo` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `channel_picture` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `channels`
--

INSERT INTO `channels` (`id`, `channel_name`, `channel_category_id`, `channel_logo`, `channel_picture`) VALUES
(1, 'RTL Klub', 1, './public/img/rtl_logo.png', './public/img/rtl_klub.jpg'),
(2, 'TV2', 1, './public/img/tv2_logo.png', './public/img/tv2.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `channel_categories`
--

CREATE TABLE `channel_categories` (
  `id` int(11) NOT NULL,
  `channel_category_name` varchar(100) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `channel_categories`
--

INSERT INTO `channel_categories` (`id`, `channel_category_name`) VALUES
(1, 'Szórakoztató csatornák'),
(2, 'Ismeretterjesztő csatornák'),
(3, 'Sport csatornák');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `shows`
--

CREATE TABLE `shows` (
  `id` int(11) NOT NULL,
  `show_name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `channel_id` int(11) NOT NULL,
  `show_category_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `shows_tags`
--

CREATE TABLE `shows_tags` (
  `show_id` int(11) NOT NULL,
  `show_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `show_categories`
--

CREATE TABLE `show_categories` (
  `id` int(11) NOT NULL,
  `show_category_name` varchar(100) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `register_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `profile_picture`, `register_date`) VALUES
(1, 'patya3', 'Password1', 'meszi1031@gmail.com', 'Mészáros Patrik', NULL, '0000-00-00'),
(2, 'patya31', 'Password1', 'hulye31@gmail.com', 'MÃ©szÃ¡ros Patrik', '', '0000-00-00'),
(3, 'username', 'Password1', 'kecske@gmail.com', 'MÃ©szÃ¡ros Patrik', '', '0000-00-00'),
(4, 'username2', 'Password1', 'meszi1031@gmail.com', 'MÃ©szÃ¡ros Patrik', '', '0000-00-00'),
(5, 'jancsika', 'Password1', 'mindex@gmail.com', 'jancsika asd', '', '0000-00-00'),
(6, 'kecskemecske', 'Kecske1', 'mecske@gmail.com', 'kecske ', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users_favourites`
--

CREATE TABLE `users_favourites` (
  `user_id` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channel_category_id` (`channel_category_id`);

--
-- A tábla indexei `channel_categories`
--
ALTER TABLE `channel_categories`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channel_id` (`channel_id`),
  ADD KEY `show_category_id` (`show_category_id`);

--
-- A tábla indexei `shows_tags`
--
ALTER TABLE `shows_tags`
  ADD KEY `show_id` (`show_id`),
  ADD KEY `show_category_id` (`show_category_id`);

--
-- A tábla indexei `show_categories`
--
ALTER TABLE `show_categories`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users_favourites`
--
ALTER TABLE `users_favourites`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `channel_id` (`channel_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `channels`
--
ALTER TABLE `channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `channel_categories`
--
ALTER TABLE `channel_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `shows`
--
ALTER TABLE `shows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `show_categories`
--
ALTER TABLE `show_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `channels`
--
ALTER TABLE `channels`
  ADD CONSTRAINT `channels_ibfk_1` FOREIGN KEY (`channel_category_id`) REFERENCES `channel_categories` (`id`);

--
-- Megkötések a táblához `shows`
--
ALTER TABLE `shows`
  ADD CONSTRAINT `shows_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`);

--
-- Megkötések a táblához `shows_tags`
--
ALTER TABLE `shows_tags`
  ADD CONSTRAINT `shows_tags_ibfk_1` FOREIGN KEY (`show_id`) REFERENCES `shows` (`id`),
  ADD CONSTRAINT `shows_tags_ibfk_2` FOREIGN KEY (`show_category_id`) REFERENCES `show_categories` (`id`);

--
-- Megkötések a táblához `users_favourites`
--
ALTER TABLE `users_favourites`
  ADD CONSTRAINT `users_favourites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_favourites_ibfk_2` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
