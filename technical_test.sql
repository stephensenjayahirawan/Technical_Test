-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2019 at 07:28 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `technical_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(1000) NOT NULL,
  `GENDER` varchar(11) NOT NULL,
  `PLACE_OF_BIRTH` varchar(100) NOT NULL,
  `DATE_OF_BIRTH` date NOT NULL,
  `RELIGION` varchar(100) NOT NULL,
  `ADDRESS` varchar(200) NOT NULL,
  `PHONE` varchar(20) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `NOTES` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ID`, `NAME`, `GENDER`, `PLACE_OF_BIRTH`, `DATE_OF_BIRTH`, `RELIGION`, `ADDRESS`, `PHONE`, `EMAIL`, `NOTES`) VALUES
(2, 'Amery Daugherty', 'Male', 'Laja', '2019-02-11', 'Islam', '521-6559 Lorem, Street', '628665322501', 'Phasellus@Phasellusdapibusquam.edu', 'aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet molestie tellus. Aenean egestas hendrerit neque. In ornare sagittis'),
(3, 'Kermit Stanton', 'Male', 'Rödermark', '2020-03-15', 'Buddhism', 'Ap #339-4568 Non Rd.', '785-3513', 'ac@arcu.ca', 'massa. Integer vitae nibh. Donec est mauris, rhoncus id, mollis nec, cursus a, enim. Suspendisse aliquet, sem ut cursus luctus,'),
(4, 'Ferdinand Mathews', 'Male', 'Pontarlier', '2019-01-11', 'Others', 'P.O. Box 139, 2909 Maecenas Road', '314-4597', 'inceptos@lectusrutrumurna.org', 'justo sit amet nulla. Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor,'),
(5, 'Palmer Willis', 'Male', 'Wachtebeke', '2020-06-06', 'Christian', '1737 Nunc St.', '628725833344', 'tellus.imperdiet@vehiculaetrutrum.com', 'nonummy. Fusce fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices'),
(6, 'Harding Rivers', 'Male', 'Fairbanks', '2018-09-07', 'Christian', '974-7706 In Rd.', '621795983973', 'diam.Duis.mi@semut.edu', 'Suspendisse non leo. Vivamus nibh dolor, nonummy ac, feugiat non, lobortis quis, pede. Suspendisse dui. Fusce diam nunc, ullamcorper eu, euismod ac, fermentum vel, mauris. Integer sem elit, pharetra ut, pharetra sed, hendrerit a, arcu. Sed'),
(7, 'Paki Tillman', 'Male', 'Hijuelas', '2019-09-22', 'Islam ', '806-1860 Lacus. St.', '355-3000', 'non@etipsum.org', 'elit, pellentesque a, facilisis non, bibendum sed, est. Nunc laoreet lectus quis massa. Mauris vestibulum, neque sed dictum eleifend, nunc risus varius orci,'),
(8, 'Vaughan Murray', 'Female', 'Neustadt', '2020-01-14', 'Islam', 'P.O. Box 607, 6199 Proin Road', '623639152777', 'elit.pharetra@lacus.edu', 'arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi. Aenean eget metus. In nec'),
(9, 'Silas Perry', 'Male', 'Montpellier', '2020-01-17', 'Others', 'Ap #188-6754 Phasellus Ave', '624418784879', 'diam.luctus.lobortis@Etiam.com', 'hendrerit neque. In ornare sagittis felis. Donec tempor, est ac mattis semper, dui lectus rutrum urna, nec luctus felis purus ac tellus. Suspendisse sed dolor. Fusce mi lorem, vehicula et, rutrum eu, ultrices sit amet, risus. Donec nibh enim, gravida sit amet,'),
(10, 'Kadeem Bruce', 'Male', 'Grande Cache', '2020-04-17', 'Atheist', '4708 Vulputate, Road', '621777806516', 'vel@pharetra.co.uk', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec dignissim magna a tortor. Nunc commodo auctor velit. Aliquam nisl. Nulla eu neque pellentesque massa lobortis ultrices. Vivamus rhoncus. Donec est. Nunc ullamcorper, velit in aliquet lobortis, nisi nibh lacinia orci, consectetuer'),
(11, 'Raphael Rodriquez', 'Male', 'Cassaro', '2019-01-16', 'Others', 'Ap #882-8425 Et Street', '627238882405', 'dolor.Fusce@Innec.edu', 'sit amet, risus. Donec nibh enim, gravida sit amet, dapibus id, blandit at, nisi. Cum sociis natoque penatibus et magnis dis parturient'),
(12, 'Seth Perez', 'Female', 'Ravenstein', '2020-05-05', 'Christian', 'P.O. Box 517, 7106 Orci. St.', '621035356326', 'quis.pede@Maurisvestibulum.co.uk', 'cursus et, eros. Proin ultrices. Duis volutpat nunc sit amet metus. Aliquam erat volutpat. Nulla facilisis. Suspendisse commodo tincidunt nibh. Phasellus nulla. Integer vulputate, risus a ultricies adipiscing, enim mi tempor lorem, eget mollis lectus pede et risus. Quisque libero lacus, varius et, euismod et, commodo at, libero. Morbi accumsan'),
(13, 'Harlan Stark', 'Female', 'Ponte nelle Alpi', '2019-02-25', 'Islam ', '538-3325 Arcu. St.', '415-4690', 'Etiam@euismodacfermentum.org', 'magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui, in sodales elit erat vitae risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonummy ultricies ornare, elit elit fermentum risus, at fringilla purus mauris a'),
(14, 'Graiden Holland', 'Female', 'Caccamo', '2019-11-08', 'Catholic', 'Ap #640-1969 Fringilla Ave', '704-4996', 'Etiam@Nunc.edu', 'lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravida non, sollicitudin a, malesuada id, erat. Etiam vestibulum massa rutrum'),
(15, 'Merrill Klein', 'Female', 'Milwaukee', '2019-12-20', 'Islam', '116-7641 Fringilla Av.', '62921198445', 'pellentesque.tellus.sem@et.co.uk', 'parturient montes, nascetur ridiculus mus. Aenean eget magna. Suspendisse tristique neque venenatis lacus. Etiam bibendum fermentum metus. Aenean sed pede nec ante blandit viverra.'),
(16, 'Oscar Shaffer', 'Male', 'Trento', '2020-04-10', 'Hinduism', '2994 Sed Avenue', '622797621129', 'magna.Phasellus@Morbi.ca', 'non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia at, iaculis quis, pede. Praesent eu'),
(17, 'Xavier Bentley', 'Female', 'Hope', '2019-06-07', 'Buddhism', '5336 Quis Avenue', '435-5483', 'ante.dictum.cursus@vestibulumnequesed.com', 'at, iaculis quis, pede. Praesent eu dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eget magna. Suspendisse tristique neque venenatis lacus. Etiam bibendum fermentum metus.'),
(18, 'Alexander Watts', 'Female', 'Amravati', '2020-01-24', 'Catholic', 'Ap #365-2694 Blandit St.', '624126306390', 'consectetuer.mauris@molestie.net', 'Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum eget,'),
(19, 'Grady Burton', 'Female', 'Chapecó', '2020-02-26', 'Hiduism', '523-9733 Ornare Rd.', '340-6230', 'tempor.arcu@amet.co.uk', 'Vivamus molestie dapibus ligula. Aliquam erat volutpat. Nulla dignissim. Maecenas ornare egestas ligula. Nullam feugiat placerat velit. Quisque varius. Nam porttitor scelerisque neque. Nullam nisl. Maecenas'),
(20, 'Keane Oneal', 'Male', 'Yellowhead County', '2019-06-19', 'Others', '421 Faucibus Rd.', '626947573067', 'pede@augue.edu', 'et malesuada fames ac turpis egestas. Fusce aliquet magna a neque. Nullam ut nisi a odio');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
