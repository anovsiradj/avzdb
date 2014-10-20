SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `buku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `pengarang` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `buku` (`judul`, `pengarang`) VALUES
('So EasyPHP', 'Arashi'),
('Cara Santet Online', 'Anov Siradj'),
('Hack Akun Facebull', 'NeAR'),
('Santet Departement Kejaksaan Lewat Onlen', 'Badwolvess'),
('Desain Multimedia', 'Pak Radi'),
('Database', 'Pak Agung'),
('RTS', 'Pak Harban'),
('Menjadi Ketua Kelas Idaman', 'Renaldi Anggriawan'),
('Melintas Pegunungan', 'Aditya Fajar NP'),
('AN2D', 'Pak Dahono'),
('High Japan City', 'http://lastgameover.files.wordpress.com/2009/03/tokyo-city.jpg');
