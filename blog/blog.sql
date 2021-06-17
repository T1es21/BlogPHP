-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 24 2020 г., 08:15
-- Версия сервера: 5.6.38
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_name` int(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id_like`, `id_post`, `id_name`) VALUES
(25, 164, 4),
(29, 163, 4),
(31, 27, 4),
(32, 26, 4),
(34, 162, 4),
(37, 25, 4),
(38, 165, 7),
(40, 18, 7),
(41, 166, 7),
(42, 22, 7),
(43, 163, 7),
(44, 28, 7),
(45, 164, 7),
(46, 24, 7),
(47, 25, 7),
(48, 29, 7),
(49, 20, 7),
(50, 165, 4),
(51, 18, 4),
(53, 28, 4),
(54, 22, 4),
(55, 20, 4),
(57, 167, 4),
(58, 166, 4),
(59, 168, 4),
(61, 176, 15),
(62, 176, 14),
(63, 165, 14),
(64, 164, 14),
(65, 162, 14),
(66, 163, 14),
(67, 177, 14),
(68, 179, 14);

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `message` text NOT NULL,
  `image_post` char(150) NOT NULL DEFAULT '404',
  `time` char(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id_post`, `id_author`, `message`, `image_post`, `time`) VALUES
(18, 4, 'Вернее уже первый.', 'pic18.png', '16.04.2020 в 19:19'),
(20, 4, 'Это мой третий пост (с картинкой).', 'pic20.png', '16.04.2020 в 20:25'),
(22, 4, 'Когда наступила очередь Бирбала, падишах стал его то и дело понукать. Акбар любил длинные сказки, и стоило рассказчику кончить фразу, как падишах тотчас с нетерпением спрашивал:\n\n— А что дальше?\n\nКороткой сказкой ему было не угодить, подавай непременно целую повесть.\n\nКак-то раз долго говорил Бирбал, уже и ночь наступила, а падишах слушает и не похоже, чтобы он собирался отпустить рассказчика. Рассердился Бирбал, думает: «Ох и нелегко же угодить его величеству. Ему-то что, скажет одно слово и отдыхает. Найти бы такой способ, чтобы падишаху расхотелось долго слушать». Как известно, человек он был мудрый и придумал такое средство, начав новый рассказ.', 'pic22.png', '16.04.2020 в 22:23'),
(24, 5, 'Hello world!', '404', '17.04.2020 в 00:14'),
(25, 6, 'Hello world!', '404', '17.04.2020 в 00:19'),
(26, 7, 'Первый пост внатуре ляяя', '404', '17.04.2020 в 14:53'),
(27, 7, 'Кортенка', 'pic27.png', '17.04.2020 в 14:54'),
(28, 8, 'да.\r\n', '404', '17.04.2020 в 14:54'),
(29, 6, 'Второй пост!', 'pic29.png', '17.04.2020 в 23:13'),
(162, 7, 'Отчего так предан Пёс, \nИ в любви своей бескраен? \nНо в глазах – всегда вопрос, \nЛюбит ли его хозяин. \nОттого, что кто-то – сек, \nОттого, что в прошлом – клетка! \nОттого, что человек \nПредавал его нередко. \nЯ по улицам брожу, \nЛюдям вглядываюсь в лица, \nЯ теперь за всем слежу, \nЧтоб, как Пёс, не ошибиться.', 'pic162.png', '21.04.2020 в 01:38'),
(163, 7, 'Собсна, вот и 4 пост', '404', '23.04.2020 в 21:56'),
(164, 5, 'wefwgw', '404', '23.04.2020 в 21:56'),
(165, 4, 'Ну привет, Геральт', '404', '24.04.2020 в 00:50'),
(176, 15, 'Хало пачаны', '404', '24.04.2020 в 06:50'),
(179, 14, 'Пушка', 'pic179.png', '24.04.2020 в 06:54');

-- --------------------------------------------------------

--
-- Структура таблицы `subs`
--

CREATE TABLE `subs` (
  `id_sub` int(11) NOT NULL,
  `name1` int(11) NOT NULL,
  `name2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subs`
--

INSERT INTO `subs` (`id_sub`, `name1`, `name2`) VALUES
(21, 5, 4),
(67, 4, 13),
(70, 4, 7),
(72, 4, 5),
(74, 4, 12),
(76, 11, 8),
(81, 11, 12),
(87, 11, 5),
(88, 11, 4),
(90, 4, 6),
(91, 7, 4),
(92, 7, 5),
(93, 7, 6),
(94, 14, 15),
(95, 14, 7),
(96, 14, 6),
(97, 14, 5),
(98, 14, 4),
(99, 5, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` char(150) NOT NULL,
  `password` char(150) NOT NULL,
  `email` char(150) NOT NULL,
  `image` char(150) NOT NULL DEFAULT 'img/404.png',
  `truename` char(150) NOT NULL DEFAULT 'Нет',
  `status` text NOT NULL,
  `subs` int(11) NOT NULL DEFAULT '0',
  `followes` int(11) NOT NULL DEFAULT '0',
  `guest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`, `email`, `image`, `truename`, `status`, `subs`, `followes`, `guest`) VALUES
(4, 'semen', '149150151', 'semich9608@gmail.com', 'kylo.jpg', 'Семён', '21', 5, 4, 1),
(5, 'admin', '197200209205210', '', 'D0QpjsL9fl0.jpg', 'Каво', 'Шо', 2, 4, 0),
(6, 'tkachenko', '152153154', '', 'star-destroyer.png', 'Семён', 'Каво', 0, 3, 0),
(7, 'persik', '150150156', '', '7038.970.png', 'Персик', 'Не понял', 3, 3, 1),
(8, 'neponyalmmm', '149150151', '', 'Без названия (1).jpg', 'Нет', 'вв', 0, 1, 0),
(9, 'anatoliy', '149151153', '', '404', 'Нет', 'ы', 0, 0, 0),
(11, 'kavo', '215204211', '', '404', 'Нет', '', 4, 0, 0),
(12, 'kavooo', '207197', '', '404', 'Нет', '', 0, 2, 0),
(13, 'root', '214211211216', '', 'images.png', 'Весемир', 'Ведьмак школы волка', 0, 1, 0),
(14, 'uuu', '206207208', '', 'Lada2106.jpg', 'Нет', '', 5, 0, 0),
(15, 'sem', '207197', '', 'poroshok.jpg', 'Люцифер', 'Не понял', 0, 1, 0),
(16, 'jkl', '203203', '', 'img/404.png', 'Нет', '', 0, 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `name` (`id_name`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_author` (`id_author`);

--
-- Индексы таблицы `subs`
--
ALTER TABLE `subs`
  ADD PRIMARY KEY (`id_sub`),
  ADD KEY `name1` (`name1`),
  ADD KEY `name2` (`name2`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT для таблицы `subs`
--
ALTER TABLE `subs`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_name`) REFERENCES `users` (`id_user`);

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `users` (`id_user`);

--
-- Ограничения внешнего ключа таблицы `subs`
--
ALTER TABLE `subs`
  ADD CONSTRAINT `subs_ibfk_1` FOREIGN KEY (`name1`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `subs_ibfk_2` FOREIGN KEY (`name2`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
