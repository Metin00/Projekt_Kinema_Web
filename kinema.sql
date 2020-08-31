-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2018 at 07:30 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `koment`
--

CREATE TABLE `koment` (
  `movieID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `koment`
--

INSERT INTO `koment` (`movieID`, `userID`, `id`, `text`, `foto`) VALUES
(19, 36, 37, 'Will they overcome the almighty Thanos?!', 'images/thumb-79295.jpg'),
(19, 25, 38, 'Can\'t want to finally see it!', 'images/avatar101930_55.gif'),
(19, 25, 39, 'Ia vlen vertete!', 'images/avatar101930_55.gif'),
(19, 24, 40, 'So let it be written, so let it be done! The universe war starts here!', 'images/86518.png'),
(14, 24, 41, 'Not recommended to watch alone!!!', 'images/86518.png'),
(18, 24, 42, 'Hokuspokus fidipus', 'images/86518.png'),
(19, 36, 43, 'Une jam Zulfi Smaci\r\n', 'images/thumb-79295.jpg'),
(2, 36, 46, 'Mezor po e pres filmin', 'images/pc_user.gif'),
(16, 16, 47, 'ko,emt\r\n', 'images/abraham_lincoln_by_graffitiwatcher.png'),
(16, 36, 48, '', 'images/pc_user.gif'),
(16, 36, 49, 'wijdoiqdw', 'images/pc_user.gif');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `titulli` varchar(50) NOT NULL,
  `r_date` date NOT NULL,
  `pershkrim` varchar(500) DEFAULT NULL,
  `trailer` varchar(50) NOT NULL,
  `IMDB` float NOT NULL,
  `salla` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `orari` varchar(15) NOT NULL,
  `kohezgjatja` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `titulli`, `r_date`, `pershkrim`, `trailer`, `IMDB`, `salla`, `foto`, `orari`, `kohezgjatja`) VALUES
(1, 'Blade Runner 2049', '2017-10-06', 'A young blade runner discovery of a long buried secret leads him to track down former blade runner Rick Deckard, who has been missing for thirty years.', 'https://www.youtube.com/embed/gCcx85zbxz4', 8.3, 3, 'bladerunner.jpg', '20:30', 164),
(2, 'Captain Underpants: The First Epic Movie', '2017-06-22', 'Two overly imaginative pranksters named George and Harold hypnotize their principal into thinking he is a ridiculously enthusiastic, incredibly dimwitted superhero named Captain Underpants.', 'https://www.youtube.com/embed/zs2SrqLum1M', 6.2, 1, 'captainunderpants.jpg', '12:00', 89),
(3, 'Ferdinand', '2017-12-15', 'After Ferdinand, a bull with a big heart, is mistaken for a dangerous beast, he is captured and torn from his home. Determined to return to his family, he rallies a misfit team on the ultimate adventure.', 'https://www.youtube.com/embed/jyJgGsZo2wA', 6.8, 2, 'ferdinand.jpg', '12:30', 108),
(4, 'Jumanji: Welcome to the Jungle', '2017-12-20', 'Four teenagers are sucked into a magical video game, and the only way they can escape is to work together to finish the game.', 'https://www.youtube.com/embed/leE10vdvkho', 7.2, 3, 'jumanji.jpg', '12:00', 119),
(5, 'The Revenant', '2016-01-08', 'A frontiersman on a fur trading expedition in the 1820s fights for survival after being mauled by a bear and left for dead by members of his own hunting team.', 'https://www.youtube.com/embed/LoebZZ8K5N0', 8, 1, 'therevenant.jpg', '21:00', 156),
(6, 'The Greatest Showman ', '2017-12-20', 'Celebrates the birth of show business, and tells of a visionary who rose from nothing to create a spectacle that became a worldwide sensation.', 'https://www.youtube.com/embed/AXCTMGYUg9A', 8, 2, 'thegreatestshowman.jpg', '14:30', 105),
(7, 'Suburbicon ', '2017-10-27', 'As a 1950s suburban community self-destructs, a home invasion has sinister consequences for one seemingly normal family.', 'https://www.youtube.com/embed/cBezc1S1BAQ', 5.4, 3, 'suburbicon.jpg', '14:15', 105),
(8, 'Darkest Hour', '2017-12-22', 'During the early days of World War II, the fate of Western Europe hangs on the newly-appointed British Prime Minister Winston Churchill, who must decide whether to negotiate with Hitler, or fight on against incredible odds.', 'https://www.youtube.com/embed/LtJ60u7SUSw', 7.4, 1, 'darkesthour.jpg', '16:00', 125),
(9, 'Kingsman: The Golden Circle', '2017-09-22', 'When their headquarters are destroyed and the world is held hostage, the Kingsmans journey leads them to the discovery of an allied spy organization in the US. These two elite secret organizations must band together to defeat a common enemy.', 'https://www.youtube.com/embed/6Nxc-3WpMbg', 6.9, 2, 'kingsman.jpg', '16:30', 141),
(10, 'Justice League', '2017-11-17', 'Fueled by his restored faith in humanity and inspired by Supermans selfless act, Bruce Wayne enlists the help of his newfound ally, Diana Prince, to face an even greater enemy.', 'https://www.youtube.com/embed/r9-DM9uBtVI', 7, 3, 'justiceleague.jpg', '16:15', 120),
(11, 'Star Wars: The Last Jedi', '2017-12-15', 'Rey develops her newly discovered abilities with the guidance of Luke Skywalker, who is unsettled by the strength of her powers. Meanwhile, the Resistance prepares for battle with the First Order.', 'https://www.youtube.com/embed/Q0CbN8sfihY', 7.5, 1, 'starwars.jpg', '18:15', 152),
(12, 'Jigsaw', '2017-10-27', 'Bodies are turning up around the city, each having met a uniquely gruesome demise. As the investigation proceeds, evidence points to one suspect: John Kramer, the man known as Jigsaw, who has been dead for ten years.', 'https://www.youtube.com/embed/vPP6aIw1vgY', 6, 2, 'jigsaw.jpg', '19:00', 92),
(13, 'Insidious: The Last Key', '2018-01-05', 'Parapsychologist Dr. Elise Rainier faces her most fearsome and personal haunting yet - in her own family home.', 'https://www.youtube.com/embed/acQyrwQyCOk', 5.9, 3, 'insidiousthelastkey.jpg', '18:30', 103),
(14, 'It', '2017-09-08', 'A group of bullied kids band together when a shapeshifting monster, taking the appearance of a clown, begins hunting children.', 'https://www.youtube.com/embed/xKJmEC5ieOk', 7.6, 1, 'it.jpg', '13:45', 135),
(15, 'Thor: Ragnarok', '2017-11-03', 'Imprisoned, the mighty Thor finds himself in a lethal gladiatorial contest against the Hulk, his former ally. Thor must fight for survival and race against time to prevent the all-powerful Hela from destroying his home and the Asgardian civilization.', 'https://www.youtube.com/embed/ue80QwXMRHg', 8.1, 2, 'thorragnarok.jpg', '20:45', 130),
(18, 'Black Panther', '2018-02-12', 'TChalla, after the death of his father, the King of Wakanda, returns home to the isolated, technologically advanced African nation to succeed to the throne and take his rightful place as king.', 'https://www.youtube.com/embed/xjDjIWPwcPU', 0, 0, 'blackpanther.jpg', 'se shpejti', 0),
(17, 'Hostiles', '2018-01-26', 'In 1892, a legendary Army captain reluctantly agrees to escort a Cheyenne chief and his family through dangerous territory.', 'https://www.youtube.com/embed/vJz5l5ru7ws', 7.2, 0, 'hostiles.jpg', 'se shpejti', 134),
(16, 'Maze Runner: The Death Cure ', '2018-01-26', 'Young hero Thomas embarks on a mission to find a cure for a deadly disease known as the \"Flare\".', 'https://www.youtube.com/embed/ZQIQCBvyQuM', 7.3, 0, 'mazerunner.jpg', 'se shpejti', 142),
(19, 'Avengers', '2018-05-04', 'The Avengers and their allies must be willing to sacrifice all in an attempt to defeat the powerful Thanos before his blitz of devastation and ruin puts an end to the universe.', 'https://www.youtube.com/embed/6ZfuNTqbHE8', 0, 0, 'avengers.jpg', 'se shpejti', 0),
(20, 'Rampage', '2018-04-20', 'Based on the classic 1980s video game featuring apes and monsters destroying cities.', 'https://www.youtube.com/embed/coOKvrsmQiI', 0, 0, 'rampage.jpg', 'se shpejti', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `avatar`, `status`, `reg_date`, `admin`) VALUES
(2, 'albin', 'albin.kurti@gmail.com', 'c8158b37788654cc3c1f3c94422f1957', '', 0, '2018-01-19 12:28:28', 0),
(16, 'adminLeo', 'leo.diCaprio@gmail.com', '4f07ad7e3a3d8f4dd3d74dbde6305548', 'images/abraham_lincoln_by_graffitiwatcher.png', 1, '2018-01-20 08:35:19', 1),
(24, 'aldi99', 'adi.deraj@gmail.com', '2f74694e11583eeff94fa208bbab42dd', 'images/86518.png', 1, '2018-01-21 09:09:45', 0),
(25, 'arben', 'arben.bitri@gmail.com', '9e5b18532ad268ca03263612920d08aa', 'images/avatar101930_55.gif', 1, '2018-01-21 09:10:15', 0),
(30, 'friday', 'friday.crusoe@gmail.com', '66add1e6911489d703fb6edbabe747cf', 'images/pc_user.gif', 1, '2018-01-21 09:55:28', 0),
(36, 'klajdi33', 'klajdi.dushku@gmail.com', 'd38e52c316db27e280416505376ffd15', 'images/pc_user.gif', 1, '2018-01-29 14:23:08', 0),
(37, 'ajsdlf', 'ajlkdf@yahoo.com', '47bce5c74f589f4867dbd57e9ca9f808', 'images/photo-20559.png', 1, '2018-01-31 17:50:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zhanret`
--

CREATE TABLE `zhanret` (
  `zhanri` varchar(20) NOT NULL DEFAULT '',
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zhanret`
--

INSERT INTO `zhanret` (`zhanri`, `id`) VALUES
('drama', 1),
('sci-fi', 1),
('animated', 2),
('komedi', 2),
('animated', 3),
('komedi', 3),
('aksion', 4),
('aventure', 4),
('komedi', 4),
('aventure', 5),
('drama', 5),
('drama', 6),
('drama', 7),
('drama', 8),
('aksion', 9),
('aventure', 9),
('komedi', 9),
('aksion', 10),
('aventure', 10),
('fantasy', 10),
('aksion', 11),
('aventure', 11),
('fantasy', 11),
('horror', 12),
('horror', 13),
('horror', 14),
('aksion', 15),
('aventure', 15),
('komedi', 15),
('aksion', 16),
('sci-fi', 16),
('aventure', 17),
('drama', 17),
('aksion', 18),
('aventure', 18),
('sci-fi', 18),
('aksion', 19),
('aventure', 19),
('fantasy', 19),
('aksion', 20),
('aventure', 20),
('sci-fi', 20),
('aventure', 21),
('drama', 21),
('aventure', 22),
('drama', 22),
('sci-fi', 22),
('Drama', 23),
('drama', 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `koment`
--
ALTER TABLE `koment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `movieID` (`movieID`,`userID`,`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `titulli` (`titulli`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `zhanret`
--
ALTER TABLE `zhanret`
  ADD PRIMARY KEY (`id`,`zhanri`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `koment`
--
ALTER TABLE `koment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `zhanret`
--
ALTER TABLE `zhanret`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `koment`
--
ALTER TABLE `koment`
  ADD CONSTRAINT `koment_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
