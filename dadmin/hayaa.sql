-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2021 at 09:11 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hayaa`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus`
--

CREATE TABLE `aboutus` (
  `id` int(11) NOT NULL,
  `aboutus` varchar(2555) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `head1` varchar(255) DEFAULT NULL,
  `div1` text DEFAULT NULL,
  `head2` varchar(255) DEFAULT NULL,
  `div2` text DEFAULT NULL,
  `head3` varchar(255) DEFAULT NULL,
  `div3` text DEFAULT NULL,
  `head4` varchar(255) DEFAULT NULL,
  `div4` text DEFAULT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`id`, `aboutus`, `image`, `head1`, `div1`, `head2`, `div2`, `head3`, `div3`, `head4`, `div4`, `datentime`) VALUES
(1, '                                                                                        Fruits and nuts add a touch of regality to the spread, and we pride ourselves in making that experience, special for you. Ambrosia specialises in superior quality walnuts and almonds, that are specially sourced from the gardens of Kashmir and California.\r\nWe stand for the finest in nuts, dry fruits, seeds and beyond, sourced from the best origins across the globe and processed for each palate with the utmost care. Whether it be retaining the choicest flavour and best nutritional value in each piece, or supplying to a variety of clientele from food processing units and retailers to individual consumers, Ambrosiaâ€™s commitment to its wholesome, organic values is legendary.\r\nWe are in the business of creating healthy culinary experiences through our wide range of handpicked nuts and dry fruits. Available in a wide range of forms and volumes, walnuts and dried fruits from Ambrosia give you the best bang for your buck.                                                                                ', 'about.jpg', '400+', 'People have joined the Purani dillise team in the past six months', '2x', 'Rate of growth in our monthly user base', '10 days', 'Time taken to launch in 8 cities across India', '95k', 'App downloads on iOS and Android', '2020-08-10 09:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `add_cart`
--

CREATE TABLE `add_cart` (
  `id` int(255) NOT NULL,
  `pid` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_cart`
--

INSERT INTO `add_cart` (`id`, `pid`, `user_id`, `quantity`, `datetime`) VALUES
(45, '4', '3', '1', '2021-01-13 20:32:18'),
(51, '12', '1', '1', '2021-01-14 06:57:20'),
(52, '8', '1', '2', '2021-01-14 06:57:20');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(25) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_name`, `password`, `status`) VALUES
(1, 'info@localhost.com', 'puranidillise', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `available_place`
--

CREATE TABLE `available_place` (
  `id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `country` int(11) NOT NULL DEFAULT 99,
  `state` varchar(25) NOT NULL,
  `city` varchar(30) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `available_place_code`
--

CREATE TABLE `available_place_code` (
  `id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `z_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bestsellerimage`
--

CREATE TABLE `bestsellerimage` (
  `id` int(11) NOT NULL,
  `image1` varchar(2555) NOT NULL,
  `image2` varchar(2555) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `image4` varchar(255) NOT NULL,
  `link1` varchar(255) NOT NULL,
  `link2` varchar(255) NOT NULL,
  `link3` varchar(255) NOT NULL,
  `link4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_address`
--

CREATE TABLE `billing_address` (
  `id` int(255) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `flat` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `locality` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `addr_type` varchar(255) DEFAULT NULL,
  `o_date` varchar(255) DEFAULT NULL,
  `o_time` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_address`
--

INSERT INTO `billing_address` (`id`, `user_id`, `order_id`, `first_name`, `last_name`, `flat`, `street`, `locality`, `country`, `state`, `city`, `zip_code`, `email`, `phone`, `addr_type`, `o_date`, `o_time`, `datetime`) VALUES
(28, '1', 'PDS674643777791', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-22', '16:41:56', '2020-10-22 11:26:42'),
(29, '2', 'PDS735969726891', 'Kiran', 'J', '68', 'Pedariyar Koil Street', 'Broadway', 'India', 'Tamil Nadu', 'Chennai', '600001', 'kkjkkjsagev@gmail.com', '7904159930', 'Home', '2021-01-11', '21:13:28', '2021-01-11 15:58:13'),
(30, '5', 'PDS297472951389', 'Himanshu', 'Mittal', '701', 'NSP', 'NSP', 'India', 'Delhi', 'Delhi', '110034', 'himanshu@maishainfotech.com', '9871751656', 'Home', '2021-01-15', '15:01:06', '2021-01-15 09:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `create_by` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_description`
--

CREATE TABLE `blog_description` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_like`
--

CREATE TABLE `blog_like` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_view`
--

CREATE TABLE `blog_view` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `brandslogo`
--

CREATE TABLE `brandslogo` (
  `id` int(11) NOT NULL,
  `logo` varchar(2555) NOT NULL,
  `brandname` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(255) NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`, `cat_image`, `status`, `date`, `time`) VALUES
(1, 'Walnut', 'walnut.png', 'Active', '2020-09-25', '12:42:34'),
(2, 'Almonds', 'almond.png', 'Active', '2020-09-25', '14:38:03'),
(3, 'Kurtis', 'cashew.png', 'Active', '2020-10-09', '12:12:05'),
(4, 'Lehenga', 'pista.png', 'Active', '2020-10-09', '12:12:05'),
(5, 'Suit Set', 'raisins.png', 'Active', '2020-10-09', '12:12:05'),
(6, 'Dresses', NULL, 'Active', '2021-01-15', '18:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `city_list`
--

CREATE TABLE `city_list` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'SS', 'South Sudan'),
(203, 'ES', 'Spain'),
(204, 'LK', 'Sri Lanka'),
(205, 'SH', 'St. Helena'),
(206, 'PM', 'St. Pierre and Miquelon'),
(207, 'SD', 'Sudan'),
(208, 'SR', 'Suriname'),
(209, 'SJ', 'Svalbard and Jan Mayen Islands'),
(210, 'SZ', 'Swaziland'),
(211, 'SE', 'Sweden'),
(212, 'CH', 'Switzerland'),
(213, 'SY', 'Syrian Arab Republic'),
(214, 'TW', 'Taiwan'),
(215, 'TJ', 'Tajikistan'),
(216, 'TZ', 'Tanzania, United Republic of'),
(217, 'TH', 'Thailand'),
(218, 'TG', 'Togo'),
(219, 'TK', 'Tokelau'),
(220, 'TO', 'Tonga'),
(221, 'TT', 'Trinidad and Tobago'),
(222, 'TN', 'Tunisia'),
(223, 'TR', 'Turkey'),
(224, 'TM', 'Turkmenistan'),
(225, 'TC', 'Turks and Caicos Islands'),
(226, 'TV', 'Tuvalu'),
(227, 'UG', 'Uganda'),
(228, 'UA', 'Ukraine'),
(229, 'AE', 'United Arab Emirates'),
(230, 'GB', 'United Kingdom'),
(231, 'US', 'United States'),
(232, 'UM', 'United States minor outlying islands'),
(233, 'UY', 'Uruguay'),
(234, 'UZ', 'Uzbekistan'),
(235, 'VU', 'Vanuatu'),
(236, 'VA', 'Vatican City State'),
(237, 'VE', 'Venezuela'),
(238, 'VN', 'Vietnam'),
(239, 'VG', 'Virgin Islands (British)'),
(240, 'VI', 'Virgin Islands (U.S.)'),
(241, 'WF', 'Wallis and Futuna Islands'),
(242, 'EH', 'Western Sahara'),
(243, 'YE', 'Yemen'),
(244, 'ZR', 'Zaire'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `deliverymen`
--

CREATE TABLE `deliverymen` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `trash` varchar(255) NOT NULL DEFAULT 'No',
  `free` enum('Yes','No') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deliverymen_mobile`
--

CREATE TABLE `deliverymen_mobile` (
  `id` int(255) NOT NULL,
  `deliverymen_id` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_schedule`
--

CREATE TABLE `delivery_schedule` (
  `id` int(255) NOT NULL,
  `deliverymen_id` varchar(255) DEFAULT NULL,
  `order_tbl_id` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `tracking_id` varchar(255) DEFAULT NULL,
  `delivery_status` varchar(255) DEFAULT NULL,
  `delivery_status_by` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `dmen_date` date NOT NULL,
  `dmen_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `del_time`
--

CREATE TABLE `del_time` (
  `id` int(255) NOT NULL,
  `stime` varchar(255) DEFAULT NULL,
  `etime` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `del_time`
--

INSERT INTO `del_time` (`id`, `stime`, `etime`, `status`) VALUES
(1, '08:05 AM', '10:00 AM', 'Active'),
(2, '10:00 AM', '12:00 PM', 'Active'),
(3, '12:00 PM', '02:00 PM', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `description`
--

CREATE TABLE `description` (
  `id` int(255) NOT NULL,
  `cat_id` varchar(255) DEFAULT NULL,
  `subcat_id` varchar(255) DEFAULT NULL,
  `p_id` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `description`
--

INSERT INTO `description` (`id`, `cat_id`, `subcat_id`, `p_id`, `description`, `status`) VALUES
(1, '1', '0', '1000', 'This is a Vegetarian product. This is a Vegetarian product.', 'Active'),
(2, '1', '0', '1000', 'This is a Vegetarian product.', 'Active'),
(3, '5', '0', '1001', 'Purani Dilli Se Abjosh Munakka Rasins Kandhari. Purani Dilli Se Abjosh Munakka Rasins Kandhari 400g', 'Active'),
(5, '4', '0', '1003', 'Purani Dilli Se Chilgoza Pine Nuts. Purani Dilli Se Chilgoza Pine Seeds Kernels AAA 200gms', 'Active'),
(6, '2', '1', '1005', 'This is a vegetarian Product. Purani Dilli Se Abjosh Munakka Rasins Kandhari.', 'Active'),
(7, '2', '1', '1004', 'Purani Dilli Se Almonds(400g)', 'Active'),
(8, '2', '1', '1004', 'Purani Dilli Se Almonds(400g)', 'Active'),
(9, '5', '0', '1005', 'sss', 'Active'),
(10, '1', '0', '1006', 'aa', 'Active'),
(11, '2', '2', '1002', 'Purani Dilli Se Khubani Khurmani.\r\nPurani Dilli Se Khubani Khurmani Dried Apricot (400g)', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(255) NOT NULL,
  `title_id` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `title_id`, `description`, `status`, `datentime`) VALUES
(1, '1', 'You could see different prices for the same product, as it could be listed by many Sellers.', 'Active', '2019-03-29 05:49:04'),
(2, '1', '', 'Active', '2019-03-29 05:53:56'),
(3, '2', 'Installation and demo are offered for certain items by sellers through the brand or an authorised service provider. Please check the individual product page to see if these services are offered for the item.', 'Active', '2019-03-29 06:38:37'),
(4, '3', 'The courier service delivering your order usually tries to deliver on the next business day in case you miss a delivery.', 'Active', '2019-03-29 06:39:43'),
(5, '3', 'You can check your SMS for more details on when the courier service will try to deliver again.', 'Active', '2019-03-29 06:39:43'),
(6, '4', 'On the rare occasion that your order is delayed, please check your email & messages for updates. A new delivery timeframe will be shared with you and you can also track its status by visiting My Orders.\n\n', 'Active', '2019-03-29 06:40:16'),
(7, '6', 'Visit My Orders to check the status of your replacement.', 'Active', '2019-03-29 06:44:16'),
(8, '6', 'In most locations, the replacement item is delivered to you at the time of pick-up. In all other areas, the replacement is initiated after the originally delivered item is picked up. Please check the SMS & email we send you for your replacement request for more details.', 'Active', '2019-03-29 06:44:17'),
(9, '7', 'xyz', 'Active', '2019-06-13 05:24:40');

-- --------------------------------------------------------

--
-- Table structure for table `faq_title`
--

CREATE TABLE `faq_title` (
  `id` int(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq_title`
--

INSERT INTO `faq_title` (`id`, `title`, `status`, `datentime`) VALUES
(1, 'Why do I see different prices for the same product?', 'Active', '2019-03-29 05:49:04'),
(2, 'Is installation offered for all products?', 'Active', '2019-03-29 06:38:36'),
(3, 'I missed the delivery of my order today. What should I do?', 'Active', '2019-03-29 06:39:43'),
(4, 'The delivery of my order is delayed. What should I do?', 'Active', '2019-03-29 06:40:16'),
(5, 'How do I know my order has been confirmed?', 'Inactive', '2019-03-29 06:43:06'),
(6, 'If I request for a replacement, when will I get it?', 'Active', '2019-03-29 06:44:16'),
(7, 'abc', 'Inactive', '2019-06-13 05:24:40');

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE `footer` (
  `id` int(11) NOT NULL,
  `address` varchar(2555) DEFAULT NULL,
  `email` varchar(2555) DEFAULT NULL,
  `phone` varchar(2555) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `facebook` varchar(2555) DEFAULT NULL,
  `twitter` varchar(2555) DEFAULT NULL,
  `googleplus` varchar(2555) DEFAULT NULL,
  `instagram` varchar(2555) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`id`, `address`, `email`, `phone`, `telephone`, `facebook`, `twitter`, `googleplus`, `instagram`, `linkedin`) VALUES
(1, 'Dummy Address, New Delhi-110088', 'info@hayaa.in', '1800-000-000', '+91-xxxxxxxxxx', 'https://www.facebook.com/', 'https://twitter.com/', 'https://plus.google.com/', 'https://www.instagram.com/', '');

-- --------------------------------------------------------

--
-- Table structure for table `footerbottomimage`
--

CREATE TABLE `footerbottomimage` (
  `id` int(11) NOT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `footercontent`
--

CREATE TABLE `footercontent` (
  `id` int(11) NOT NULL,
  `head1` varchar(255) DEFAULT NULL,
  `con1` varchar(255) DEFAULT NULL,
  `head2` varchar(255) DEFAULT NULL,
  `con2` varchar(255) DEFAULT NULL,
  `head3` varchar(255) DEFAULT NULL,
  `con3` varchar(255) DEFAULT NULL,
  `head4` varchar(255) DEFAULT NULL,
  `con4` varchar(255) DEFAULT NULL,
  `head5` varchar(255) DEFAULT NULL,
  `con5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `headerimage`
--

CREATE TABLE `headerimage` (
  `id` int(255) NOT NULL,
  `header` varchar(255) DEFAULT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `headerimage`
--

INSERT INTO `headerimage` (`id`, `header`, `datentime`) VALUES
(1, 'ad-banner.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `homemiddle`
--

CREATE TABLE `homemiddle` (
  `id` int(11) NOT NULL,
  `image` varchar(2555) NOT NULL,
  `catid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(255) NOT NULL,
  `cat_id` varchar(255) DEFAULT NULL,
  `sub_cat_id` varchar(255) DEFAULT NULL,
  `p_id` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `cat_id`, `sub_cat_id`, `p_id`, `image`, `status`) VALUES
(1, '1', '0', '1000', 'new-walnut.jpg', 'Active'),
(2, '1', '0', '1000', 'walnut.jpg', 'Active'),
(3, '5', '0', '1001', 'new-munakka.jpg', 'Active'),
(4, '5', '0', '1001', 'raisins.jpg', 'Active'),
(5, '2', '2', '1002', 'new-khumbani-dried-apricot.jpg', 'Active'),
(6, '4', '0', '1003', 'new-khumbani-dried-apricot.jpg', 'Active'),
(7, '4', '0', '1003', 'new-munakka.jpg', 'Active'),
(8, '4', '0', '1003', 'raisins.jpg', 'Active'),
(9, '2', '1', '1004', 'cashews.jpg', 'Active'),
(10, '2', '1', '1004', 'new-almonds.jpg', 'Active'),
(11, '2', '1', '1004', 'new-khumbani-dried-apricot.jpg', 'Active'),
(12, '2', '1', '1005', 'dates.jpg', 'Active'),
(13, '2', '1', '1005', 'new-chilgoza.jpg', 'Active'),
(14, '2', '1', '1005', 'new-khumbani-dried-apricot.jpg', 'Active'),
(15, '2', '1', '1005', 'new-munakka.jpg', 'Active'),
(16, '5', '0', '1005', 'new-munakka.jpg', 'Active'),
(17, '5', '0', '1005', 'new-walnut.jpg', 'Active'),
(18, '5', '0', '1005', 'raisins.jpg', 'Active'),
(19, '1', '0', '1006', 'cashews.jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `logo`, `datentime`) VALUES
(1, 'logo.png', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifyme`
--

CREATE TABLE `notifyme` (
  `id` int(11) NOT NULL,
  `pid` int(50) NOT NULL,
  `userid` int(50) NOT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offer_slider`
--

CREATE TABLE `offer_slider` (
  `id` int(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cat_id` varchar(255) DEFAULT NULL,
  `off_type` varchar(255) DEFAULT NULL,
  `off_value` varchar(255) DEFAULT NULL,
  `text_image` varchar(255) DEFAULT NULL,
  `click` varchar(255) DEFAULT NULL,
  `ad_date` varchar(255) DEFAULT NULL,
  `ad_timer` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer_slider`
--

INSERT INTO `offer_slider` (`id`, `image`, `cat_id`, `off_type`, `off_value`, `text_image`, `click`, `ad_date`, `ad_timer`, `status`) VALUES
(1, 'offer-1.jpg', 'cat_1', 'per', '5', 'Hot Deals on New Items', 'yes', '2020-07-21', '13:31:01', 'Active'),
(2, 'offer-5.jpg', 'sub_1', 'flat', '20', 'Hot Deals on New Items', 'yes', '2020-07-21', '13:46:11', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `online_payment_detail`
--

CREATE TABLE `online_payment_detail` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `trnx_id` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `trnx_status` varchar(255) NOT NULL,
  `trnx_date` date NOT NULL,
  `trnx_time` time NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `online_payment_detail`
--

INSERT INTO `online_payment_detail` (`id`, `user_id`, `order_id`, `trnx_id`, `amount`, `trnx_status`, `trnx_date`, `trnx_time`, `created_on`) VALUES
(1, '1', 'PDS819879353893', '982052', '1855.00', 'Success', '2020-10-20', '12:36:08', '2020-10-20 12:08:37'),
(2, '1', 'PDS315683021940', '148958', '280.00', 'Success', '2020-10-22', '15:44:25', '2020-10-22 15:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_coupon_code`
--

CREATE TABLE `order_coupon_code` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `totalprice` varchar(255) NOT NULL,
  `discount_price` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(255) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `tracking_id` varchar(255) DEFAULT NULL,
  `productid` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL COMMENT 'unit price multiply with quantity not the unit price only',
  `quantity` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `tracking_id`, `productid`, `price`, `quantity`, `date`, `time`) VALUES
(1, 'PDS158913138239', 'TDI4898379', '12', '280', '1', '2020-10-20', '17:46:59'),
(2, 'PDS158913138239', 'TDI48983710', '8', '1000', '1', '2020-10-20', '17:46:59'),
(3, 'PDS158913138239', 'TDI48983711', '7', '295', '1', '2020-10-20', '17:46:59'),
(4, 'PDS519555549531', 'TDI4898372', '12', '280', '1', '2020-10-21', '10:05:41'),
(5, 'PDS519555549531', 'TDI4898373', '8', '1000', '1', '2020-10-21', '10:05:41'),
(6, 'PDS519555549531', 'TDI4898374', '7', '295', '1', '2020-10-21', '10:05:41'),
(7, 'PDS431498117566', 'TDI4898375', '12', '280', '1', '2020-10-21', '18:10:11'),
(8, 'PDS431498117566', 'TDI4898376', '8', '1000', '1', '2020-10-21', '18:10:11'),
(9, 'PDS286576900491', 'TDI4898377', '12', '280', '1', '2020-10-22', '11:04:43'),
(10, 'PDS286576900491', 'TDI4898378', '8', '1000', '1', '2020-10-22', '11:04:43'),
(11, 'PDS286576900491', 'TDI4898379', '7', '295', '1', '2020-10-22', '11:04:43'),
(12, 'PDS315683021940', 'TDI48983710', '12', '280', '1', '2020-10-22', '15:21:25'),
(13, 'PDS674643777791', 'TDI48983711', '8', '1000', '1', '2020-10-22', '16:41:56'),
(14, 'PDS735969726891', 'TDI4898372', '2', '250', '1', '2021-01-11', '21:13:28'),
(15, 'PDS297472951389', 'TDI4898373', '8', '1000', '1', '2021-01-15', '15:01:06'),
(16, 'PDS297472951389', 'TDI4898374', '7', '295', '1', '2021-01-15', '15:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(255) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `order_tbl_id` int(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `tracking_id` varchar(255) DEFAULT NULL,
  `tracking_status` varchar(255) DEFAULT NULL,
  `by` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `delivery_date` varchar(255) NOT NULL,
  `delivery_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `user_id`, `order_tbl_id`, `order_id`, `tracking_id`, `tracking_status`, `by`, `reason`, `date`, `time`, `delivery_date`, `delivery_time`) VALUES
(1, '1', 0, 'PDS431498117566', 'TDI4898375', 'Your Order has been placed', NULL, NULL, '2020-10-21', '18:10:11', '', ''),
(2, '1', 0, 'PDS431498117566', 'TDI4898376', 'Your Order has been placed', NULL, NULL, '2020-10-21', '18:10:11', '', ''),
(3, '1', 3, 'PDS431498117566', 'TDI4898375', 'Delivered', ' ', '', '2020-10-21', '18:11:39', '', ''),
(4, '1', 0, 'PDS286576900491', 'TDI4898377', 'Your Order has been placed', NULL, NULL, '2020-10-22', '11:04:43', '', ''),
(5, '1', 0, 'PDS286576900491', 'TDI4898378', 'Your Order has been placed', NULL, NULL, '2020-10-22', '11:04:43', '', ''),
(6, '1', 0, 'PDS286576900491', 'TDI4898379', 'Your Order has been placed', NULL, NULL, '2020-10-22', '11:04:43', '', ''),
(7, '1', 4, 'PDS286576900491', 'TDI4898378', 'Delivered', ' ', '', '2020-10-22', '11:43:42', '', ''),
(8, '1', 0, 'PDS315683021940', 'TDI48983710', 'Your Order has been placed', NULL, NULL, '2020-10-22', '15:21:25', '', ''),
(9, '1', 0, 'PDS674643777791', 'TDI48983711', 'Your Order has been placed', NULL, NULL, '2020-10-22', '16:41:56', '', ''),
(10, '2', 0, 'PDS735969726891', 'TDI4898372', 'Your Order has been placed', NULL, NULL, '2021-01-11', '21:13:28', '', ''),
(11, '5', 0, 'PDS297472951389', 'TDI4898373', 'Your Order has been placed', NULL, NULL, '2021-01-15', '15:01:06', '', ''),
(12, '5', 0, 'PDS297472951389', 'TDI4898374', 'Your Order has been placed', NULL, NULL, '2021-01-15', '15:01:06', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `id` int(255) NOT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `orderprice` varchar(255) DEFAULT NULL,
  `promo_code_id` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `shipping` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `exp_time` varchar(255) DEFAULT NULL,
  `exp_date` varchar(255) DEFAULT NULL,
  `coupan_code` varchar(255) NOT NULL DEFAULT 'No',
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`id`, `userid`, `orderprice`, `promo_code_id`, `payment_type`, `payment_status`, `shipping`, `order_id`, `exp_time`, `exp_date`, `coupan_code`, `date`, `time`) VALUES
(1, '1', '1575', '0', 'cashondelivery', 'Pending', '0', 'PDS158913138239', '08:05 AM-10:00 AM', '2020-10-21', 'No', '2020-10-20', '17:46:59'),
(2, '1', '1575', '0', 'cashondelivery', 'Pending', '0', 'PDS519555549531', '10:00 AM-12:00 PM', '2020-10-22', 'No', '2020-10-21', '10:05:41'),
(3, '1', '1280', '0', 'cashondelivery', 'Pending', '0', 'PDS431498117566', '10:00 AM-12:00 PM', '2020-10-23', 'No', '2020-10-21', '18:10:11'),
(4, '1', '1575', '0', 'cashondelivery', 'Pending', '0', 'PDS286576900491', '08:05 AM-10:00 AM', '2020-10-23', 'No', '2020-10-22', '11:04:43'),
(5, '1', '280', '0', 'atomtech', 'Success', '0', 'PDS315683021940', '08:05 AM-10:00 AM', '2020-10-23', 'No', '2020-10-22', '15:21:25'),
(6, '1', '1000', '0', 'cashondelivery', 'Pending', '0', 'PDS674643777791', '08:05 AM-10:00 AM', '2020-10-23', 'No', '2020-10-22', '16:41:56'),
(7, '2', '250', '0', 'cashondelivery', 'Pending', '0', 'PDS735969726891', '08:05 AM-10:00 AM', '2021-01-12', 'No', '2021-01-11', '21:13:28'),
(8, '5', '1195', '0', 'cashondelivery', 'Pending', '0', 'PDS297472951389', '10:00 AM-12:00 PM', '2021-01-15', 'demo', '2021-01-15', '15:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `privacy&policy`
--

CREATE TABLE `privacy&policy` (
  `id` int(255) NOT NULL,
  `title_id` varchar(25) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privacy&policy`
--

INSERT INTO `privacy&policy` (`id`, `title_id`, `description`, `status`, `datentime`) VALUES
(1, '1', 'When you use our Website, we collect and store your personal information which is provided by you from time to time. Our primary goal in doing so is to provide you a safe, efficient, smooth and customized experience. This allows us to provide services and features that most likely meet your needs, and to customize our Website to make your experience safer and easier. More importantly, while doing so we collect personal information from you that we consider necessary for achieving this purpose.', 'Active', '2019-03-29 06:13:10'),
(2, '1', 'We use data collection devices such as \"cookies\" on certain pages of the Website to help analyse our web page flow, measure promotional effectiveness, and promote trust and safety. \"Cookies\" are small files placed on your hard drive that assist us in providing our services. We offer certain features that are only available through the use of a \"cookie\". We also use cookies to allow you to enter your password less frequently during a session. Cookies can also help us provide information that is targeted to your interests. Most cookies are \"session cookies,\" meaning that they are automatically deleted from your hard drive at the end of a session. You are always free to decline our cookies if your browser permits, although in that case you may not be able to use certain features on the Website and you may be required to re-enter your password more frequently during a session.', 'Active', '2019-03-29 06:13:10'),
(3, '1', 'Additionally, you may encounter \"cookies\" or other similar devices on certain pages of the Website that are placed by third parties. We do not control the use of cookies by third parties.', 'Active', '2019-03-29 06:13:10'),
(4, '1', 'f you send us personal correspondence, such as emails or letters, or if other users or third parties send us correspondence about your activities or postings on the Website, we may collect such information into a file specific to you.', 'Active', '2019-03-29 06:13:10'),
(6, '2', 'We use personal information to provide the services you request. To the extent we use your personal information to market to you, we will provide you the ability to opt-out of such uses. We use your personal information to resolve disputes; troubleshoot problems; help promote a safe service; collect money; measure consumer interest in our products and services, inform you about online and offline offers, products, services, and updates; customize your experience; detect and protect us against error, fraud and other criminal activity; enforce our terms and conditions; and as otherwise described to you at the time of collection.', 'Active', '2019-03-29 06:15:38'),
(7, '2', 'With your consent, we will have access to your SMS, contacts in your directory, location and device information and we may request you to provide your PAN and Aadhaar details to check your eligibility for certain products/services including but not limited to providing credit) being offered by us, our affiliates or our lending partners. We may share this data with our affiliates or our lending partners for the same purposes as mentioned above, however, we will not store any Aadhaar data ourselves. In the event that consent to this such use of data is withdrawn in the future, we will stop collection of such data but continue to store the data (save for Aadhaar data) and use it for internal purposes to further improve our services.', 'Active', '2019-03-29 06:15:38'),
(8, '2', 'We identify and use your IP address to help diagnose problems with our server, and to administer our Website. Your IP address is also used to help identify you and to gather broad demographic information.\r\n\r\n', 'Active', '2019-03-29 06:15:38'),
(9, '2', 'We will occasionally ask you to complete optional online surveys. These surveys may ask you for contact information and demographic information (like zip code, age, or income level). We use this data to tailor your experience at our Website, providing you with content that we think you might be interested in and to display content according to your preferences.', 'Active', '2019-03-29 06:15:38'),
(10, '3', 'We may share personal information with our other corporate entities and affiliates. These entities and affiliates may market to you as a result of such sharing unless you explicitly opt-out.', 'Active', '2019-03-29 06:17:10'),
(11, '4', 'We may share personal information with our other corporate entities and affiliates. These entities and affiliates may market to you as a result of such sharing unless you explicitly opt-out.', 'Active', '2019-03-29 06:17:59'),
(12, '5', 'We may disclose personal information to third parties. This disclosure may be required for us to provide you access to our Services, to comply with our legal obligations, to enforce our User Agreement, to facilitate our marketing and advertising activities, or to prevent, detect, mitigate, and investigate fraudulent or illegal activities related to our Services. We do not disclose your personal information to third parties for their marketing and advertising purposes without your explicit consent.', 'Active', '2019-03-29 06:18:38'),
(13, '6', ',n,', 'Active', '2020-08-12 08:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `privacy&policy_title`
--

CREATE TABLE `privacy&policy_title` (
  `id` int(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privacy&policy_title`
--

INSERT INTO `privacy&policy_title` (`id`, `title`, `status`, `datentime`) VALUES
(1, 'Collection of Personally Identifiable Information and other Information', 'Active', '2020-08-18 05:36:26'),
(2, 'Use of Demographic / Profile Data / Your Information', 'Active', '2019-03-29 06:15:38'),
(3, 'Cookies', 'Inactive', '2019-03-29 06:17:33'),
(4, 'Cookies', 'Active', '2019-03-29 06:17:59'),
(5, 'Sharing of personal information', 'Active', '2019-03-29 06:18:38'),
(6, 'test', 'Active', '2020-08-12 08:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `cat_id` varchar(255) DEFAULT NULL,
  `subcat_id` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `stock` varchar(255) NOT NULL DEFAULT 'Yes',
  `minimum` varchar(255) NOT NULL DEFAULT '1',
  `maximum` varchar(255) NOT NULL DEFAULT '0',
  `weight` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT '0',
  `hot_deals` enum('No','Yes') NOT NULL,
  `new_arrivals` enum('No','Yes') NOT NULL,
  `top` enum('No','Yes') NOT NULL,
  `cod` varchar(255) DEFAULT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `vendor_id` varchar(255) DEFAULT NULL,
  `vendor_product_id` varchar(255) DEFAULT NULL,
  `over_rating` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `trash` varchar(255) NOT NULL DEFAULT 'No',
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cat_id`, `subcat_id`, `product_name`, `stock`, `minimum`, `maximum`, `weight`, `price`, `discount`, `hot_deals`, `new_arrivals`, `top`, `cod`, `product_code`, `vendor_id`, `vendor_product_id`, `over_rating`, `status`, `trash`, `date`, `time`) VALUES
(1, '1', NULL, 'Purani Dilli Se Walnut Kernels Akhrot Chilian AAA', 'Yes', '1', '0', '250gm', '220', '0', 'Yes', 'Yes', 'Yes', 'Yes', '1000', '0', '0', NULL, 'Inactive', 'Yes', '2020-10-09', '12:16:02'),
(2, '1', NULL, 'Purani Dilli Se Walnut Kernels Akhrot Chilian AAA', 'Yes', '1', '0', '500gm', '250', '0', 'Yes', 'Yes', 'Yes', 'Yes', '1000', '0', '0', NULL, 'Inactive', 'Yes', '2020-10-09', '12:18:49'),
(3, '5', NULL, 'Purani Dilli Se Abjosh Munakka Rasins Kandhari', 'Yes', '1', '5', '500gm', '220', '200', 'Yes', 'Yes', 'Yes', 'No', '1001', '0', '0', NULL, 'Inactive', 'Yes', '2020-10-09', '12:22:42'),
(4, '5', NULL, 'Purani Dilli Se Abjosh Munakka Rasins Kandhari', 'Yes', '1', '0', '1kg', '300', '280', 'Yes', 'Yes', 'Yes', 'No', '1001', '0', '0', NULL, 'Inactive', 'Yes', '2020-10-09', '12:24:42'),
(5, '2', '2', 'Purani Dilli Se Khubani Dried Apricot', 'Yes', '1', '0', '250gm', '200', '0', 'Yes', 'Yes', 'Yes', 'Yes', '1002', '0', '0', NULL, 'Inactive', 'Yes', '2020-10-09', '12:27:48'),
(6, '2', '2', 'Purani Dilli Se Khubani Dried Apricot', 'Yes', '1', '0', '500gm', '220', '200', 'Yes', 'Yes', 'Yes', 'Yes', '1002', '0', '0', NULL, 'Inactive', 'Yes', '2020-10-09', '12:29:26'),
(7, '2', '2', 'Purani Dilli Se Khubani Dried Apricot', 'Yes', '1', '0', '1kg', '300', '295', 'Yes', 'Yes', 'Yes', 'Yes', '1002', '0', '0', NULL, 'Inactive', 'Yes', '2020-10-09', '12:31:01'),
(8, '4', NULL, 'Purani Dilli Se Chilgoza Pine Nuts/Seeds Kernels', 'Yes', '1', '0', '500gm', '1000', '0', 'Yes', 'Yes', 'Yes', 'Yes', '1003', '0', '0', NULL, 'Inactive', 'Yes', '2020-10-09', '12:32:42'),
(9, '2', '1', 'Purani Dilli Se Almonds', 'Yes', '1', '0', '500gm', '300', '228', 'Yes', 'Yes', 'Yes', 'Yes', '1004', '0', '0', NULL, 'Inactive', 'Yes', '2020-10-09', '12:34:44'),
(10, '2', '1', 'Purani Dilli Se Almond Kandhari', 'Yes', '1', '0', '250gm', '200', '180', 'Yes', 'Yes', 'No', 'Yes', '1005', '0', '0', NULL, 'Inactive', 'Yes', '2020-10-09', '12:36:58'),
(11, '2', '1', 'Purani Dilli Se Almond Kandhari', 'Yes', '1', '0', '500gm', '300', '270', 'Yes', 'Yes', 'No', 'Yes', '1005', '0', '0', NULL, 'Inactive', 'Yes', '2020-10-09', '12:38:34'),
(12, '2', '1', 'Purani Dilli Se Almonds', 'Yes', '1', '0', '250gm', '280', '0', 'Yes', 'Yes', 'Yes', 'Yes', '1004', '0', '0', NULL, 'Inactive', 'Yes', '2020-10-09', '12:39:53'),
(13, '1', NULL, 'lkjl', 'Yes', '1', '0', '250gm', '100', '0', 'No', 'Yes', 'No', 'No', '1006', '0', '0', NULL, 'Inactive', 'Yes', '2020-10-09', '12:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `promo_code`
--

CREATE TABLE `promo_code` (
  `id` int(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `percentage` varchar(255) DEFAULT NULL,
  `use_quantity` varchar(255) DEFAULT NULL,
  `date_of_expiry` varchar(225) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `trash` varchar(255) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo_code`
--

INSERT INTO `promo_code` (`id`, `code`, `title`, `price`, `type`, `percentage`, `use_quantity`, `date_of_expiry`, `date`, `time`, `status`, `trash`) VALUES
(1, 'A123Test', 'testing', '10', 'all', 'yes', '1', '2021-01-15', '2021-01-14', '11:21:00', 'Active', 'No'),
(2, 'DEMO', 'Testing', '100', 'all', 'no', '1', '2021-01-22', '2021-01-15', '15:05:41', 'Active', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `star` varchar(2555) NOT NULL,
  `review_title` varchar(255) NOT NULL,
  `review` varchar(2555) NOT NULL,
  `pid` int(11) NOT NULL,
  `userid` varchar(2555) NOT NULL,
  `status` enum('Inactive','Active') NOT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review_image`
--

CREATE TABLE `review_image` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `reviewid` varchar(255) NOT NULL,
  `status` enum('Inactive','Active') NOT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shiping_address`
--

CREATE TABLE `shiping_address` (
  `id` int(255) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `flat` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `locality` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `addr_type` varchar(255) DEFAULT NULL,
  `o_date` varchar(255) DEFAULT NULL,
  `o_time` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shiping_address`
--

INSERT INTO `shiping_address` (`id`, `order_id`, `user_id`, `first_name`, `last_name`, `flat`, `street`, `locality`, `country`, `state`, `city`, `zip_code`, `email`, `phone`, `addr_type`, `o_date`, `o_time`, `datetime`) VALUES
(1, 'PDS89291', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Home', '2020-10-19', '12:57:10', '2020-10-19 06:40:58'),
(2, 'PDS23525', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Home', '2020-10-19', '12:38:34', '2020-10-19 07:04:38'),
(3, 'PDS27363', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Home', '2020-10-19', '12:34:36', '2020-10-19 07:06:34'),
(4, 'PDS49231', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Home', '2020-10-19', '12:55:42', '2020-10-19 07:12:56'),
(5, 'PDS79054', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Home', '2020-10-19', '13:42:21', '2020-10-19 07:51:42'),
(6, 'PDS96814', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Home', '2020-10-19', '13:47:24', '2020-10-19 07:54:48'),
(7, 'PDS99701', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Home', '2020-10-19', '13:11:40', '2020-10-19 08:10:11'),
(8, 'PDS81924', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-19', '13:06:45', '2020-10-19 08:15:07'),
(9, 'PDS81924', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-19', '13:46:45', '2020-10-19 08:15:46'),
(10, 'PDS78589', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-19', '13:53:55', '2020-10-19 08:25:53'),
(11, 'PDS68717', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-19', '14:55:38', '2020-10-19 09:08:55'),
(12, 'PDS31785', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-19', '14:45:40', '2020-10-19 09:10:46'),
(13, 'PDS95041', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-19', '14:03:52', '2020-10-19 09:22:03'),
(14, 'PDS16702', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-19', '14:08:54', '2020-10-19 09:24:08'),
(15, 'PDS50062', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-19', '14:11:58', '2020-10-19 09:28:12'),
(16, 'PDS64708', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-19', '14:13:59', '2020-10-19 09:29:13'),
(17, 'PDS394375851009', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-19', '15:40:36', '2020-10-19 10:06:40'),
(18, 'PDS883533083904', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-19', '16:08:48', '2020-10-19 11:18:08'),
(19, 'PDS28597733051', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-19', '17:26:28', '2020-10-19 11:58:26'),
(20, 'PDS824796039617', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-19', '18:23:05', '2020-10-19 12:35:23'),
(21, 'PDS185557800973', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-20', '10:53:53', '2020-10-20 05:23:54'),
(22, 'PDS819879353893', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-20', '12:23:08', '2020-10-20 06:38:24'),
(23, 'PDS158913138239', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-20', '17:46:59', '2020-10-20 12:29:46'),
(24, 'PDS519555549531', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-21', '10:05:41', '2020-10-21 05:11:05'),
(25, 'PDS431498117566', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-21', '18:10:11', '2020-10-21 12:41:10'),
(26, 'PDS286576900491', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-22', '11:04:43', '2020-10-22 06:13:05'),
(27, 'PDS315683021940', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-22', '15:21:25', '2020-10-22 09:55:22'),
(28, 'PDS674643777791', '1', 'Test', 'User-1', '701 - 7th floor', 'Maishha infotech', 'NSP', 'India', 'DELHI', 'NSP', '110083', 'test1@gmail.com', '9718187815', 'Office', '2020-10-22', '16:41:56', '2020-10-22 11:26:42'),
(29, 'PDS735969726891', '2', 'Kiran', 'J', '68', 'Pedariyar Koil Street', 'Broadway', 'India', 'Tamil Nadu', 'Chennai', '600001', 'kkjkkjsagev@gmail.com', '7904159930', 'Home', '2021-01-11', '21:13:28', '2021-01-11 15:58:13'),
(30, 'PDS297472951389', '5', 'Himanshu', 'Mittal', '701', 'NSP', 'NSP', 'India', 'Delhi', 'Delhi', '110034', 'himanshu@maishainfotech.com', '9871751656', 'Home', '2021-01-15', '15:01:06', '2021-01-15 09:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `subcat_id` varchar(255) DEFAULT NULL,
  `click` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `image`, `subcat_id`, `click`, `status`, `date`, `time`) VALUES
(1, 'banner1.jpg', '0', 'yes', 'Active', '2020-07-21', '13:21:46'),
(2, 'banner2.jpg', '0', 'no', 'Active', '2020-07-21', '13:23:04'),
(3, 'banner3.jpg', '0', 'no', 'Active', '2020-07-21', '13:23:26'),
(4, 'banner4.jpg', '0', 'no', 'Active', '2020-07-21', '13:23:51'),
(5, 'banner2 - Copy.jpg', '0', 'no', 'Active', '2020-08-12', '14:00:25'),
(6, 'offer-5.jpg', '0', 'no', 'Active', '2020-08-12', '14:57:42'),
(7, 'offer-5.jpg', '0', 'no', 'Active', '2020-08-12', '15:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `special_image`
--

CREATE TABLE `special_image` (
  `id` int(11) NOT NULL,
  `productid` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `timendate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `specifications`
--

CREATE TABLE `specifications` (
  `id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `specifications` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state_list`
--

CREATE TABLE `state_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(11) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state_list`
--

INSERT INTO `state_list` (`id`, `country_id`, `state`) VALUES
(1, 99, 'ANDAMAN AND NICOBAR ISLANDS'),
(2, 99, 'ANDHRA PRADESH'),
(3, 99, 'ARUNACHAL PRADESH'),
(4, 99, 'ASSAM'),
(5, 99, 'BIHAR'),
(6, 99, 'CHATTISGARH'),
(7, 99, 'CHANDIGARH'),
(8, 99, 'DAMAN AND DIU'),
(9, 99, 'DELHI'),
(10, 99, 'DADRA AND NAGAR HAVELI'),
(11, 99, 'GOA'),
(12, 99, 'GUJARAT'),
(13, 99, 'HIMACHAL PRADESH'),
(14, 99, 'HARYANA'),
(15, 99, 'JAMMU AND KASHMIR'),
(16, 99, 'JHARKHAND'),
(17, 99, 'KERALA'),
(18, 99, 'KARNATAKA'),
(19, 99, 'LAKSHADWEEP'),
(20, 99, 'MEGHALAYA'),
(21, 99, 'MAHARASHTRA'),
(22, 99, 'MANIPUR'),
(23, 99, 'MADHYA PRADESH'),
(24, 99, 'MIZORAM'),
(25, 99, 'NAGALAND'),
(26, 99, 'ORISSA'),
(27, 99, 'PUNJAB'),
(28, 99, 'PONDICHERRY'),
(29, 99, 'RAJASTHAN'),
(30, 99, 'SIKKIM'),
(31, 99, 'TAMIL NADU'),
(32, 99, 'TRIPURA'),
(33, 99, 'UTTARAKHAND'),
(34, 99, 'UTTAR PRADESH'),
(35, 99, 'WEST BENGAL'),
(36, 99, 'TELANGANA');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(255) NOT NULL,
  `c_id` varchar(255) DEFAULT NULL,
  `s_id` varchar(255) DEFAULT NULL,
  `p_id` varchar(255) DEFAULT NULL,
  `cod` varchar(225) DEFAULT NULL,
  `online` varchar(200) DEFAULT NULL,
  `stock` enum('Instock','OutOfStock') NOT NULL,
  `stock_no` varchar(255) DEFAULT NULL,
  `delivery_charges` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(255) NOT NULL,
  `cat_id` varchar(255) DEFAULT NULL,
  `sub_cat_name` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `cat_id`, `sub_cat_name`, `status`, `date`, `time`) VALUES
(1, '2', 'Almonds Kagzi Jumbo', 'Active', '2020-10-09', '12:43:18'),
(2, '2', 'Almonds Afghani Kagzi', 'Active', '2020-10-09', '12:43:18'),
(3, '2', 'Mamra Almond King Size', 'Active', '2020-10-09', '12:43:18'),
(4, '2', 'California Almonds Sanora', 'Active', '2020-10-09', '12:43:18'),
(7, '6', '', 'Active', '2021-03-02', '13:02:38'),
(8, '5', '', 'Active', '2021-03-02', '13:02:56'),
(9, '4', '', 'Active', '2021-03-02', '13:03:11'),
(10, '3', '', 'Active', '2021-03-02', '13:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE `tbl_country` (
  `country_id` int(11) NOT NULL,
  `country_name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `terms&condition`
--

CREATE TABLE `terms&condition` (
  `id` int(255) NOT NULL,
  `title_id` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms&condition`
--

INSERT INTO `terms&condition` (`id`, `title_id`, `description`, `status`, `datentime`) VALUES
(1, '1', 'This document is an electronic record in terms of Information Technology Act, 2000 and rules there under as applicable and the amended provisions pertaining to electronic records in various statutes as amended by the Information Technology Act, 2000. This electronic record is generated by a computer system and does not require any physical or digital signatures.', 'Active', '2019-03-29 06:04:09'),
(2, '1', 'This document is published in accordance with the provisions of Rule 3 (1) of the Information Technology (Intermediaries guidelines) Rules, 2011 that require publishing the rules and regulations, privacy policy and Terms of Use for access or usage of wwwpuranidilli.com website.', 'Active', '2019-03-29 06:04:09'),
(3, '1', 'Your use of the Website and services and tools are governed by the following terms and conditions ( \"Terms of Use\" ) as applicable to the Website including the applicable policies which are incorporated herein by way of reference. If You transact on the Website, You shall be subject to the policies that are applicable to the Website for such transaction. By mere use of the Website, You shall be contracting with Purani Dillli shop Internet Private Limited and these terms and conditions including the policies constitute Your binding obligations, with Purani Dilli shop', 'Active', '2019-03-29 06:04:09'),
(4, '1', 'For the purpose of these Terms of Use, wherever the context so requires \"You\" or \"User\" shall mean any natural or legal person who has agreed to become a buyer on the Website by providing Registration Data while registering on the Website as Registered User using the computer systems. Purani Dilli shop allows the User to surf the Website or making purchases without registering on the Website. The term \"We\" , \"Us\" , \"Our\" shall mean Purani Dilli shop Internet Private Limited', 'Active', '2019-03-29 06:04:09'),
(5, '1', 'When You use any of the services provided by Us through the Website, including but not limited to, (e.g. Product Reviews, Seller Reviews), You will be subject to the rules, guidelines, policies, terms, and conditions applicable to such service, and they shall be deemed to be incorporated into this Terms of Use and shall be considered as part and parcel of this Terms of Use. We reserve the right, at Our sole discretion, to change, modify, add or remove portions of these Terms of Use, at any time without any prior written notice to You. It is Your responsibility to review these Terms of Use periodically for updates / changes. Your continued use of the Website following the posting of changes will mean that You accept and agree to the revisions. As long as You comply with these Terms of Use, We grant You a personal, non-exclusive, non-transferable, limited privilege to enter and use the Website.', 'Active', '2019-03-29 06:04:09'),
(6, '2', 'Use of the Website is available only to persons who can form legally binding contracts under Indian Contract Act, 1872. Persons who are \"incompetent to contract\" within the meaning of the Indian Contract Act, 1872 including minors, un-discharged insolvents etc. are not eligible to use the Website. If you are a minor i.e. under the age of 18 years, you shall not register as a User of the Flipkart website and shall not transact on or use the website. As a minor if you wish to use or transact on website, such use or transaction may be made by your legal guardian or parents on the Website. Puirani Dilli shop reserves the right to terminate your membership and / or refuse to provide you with access to the Website if it is brought to Puirani Dilli shop notice or if it is discovered that you are under the age of 18 years.', 'Active', '2019-03-29 06:06:17'),
(7, '3', 'If You use the Website, You shall be responsible for maintaining the confidentiality of your Display Name and Password and You shall be responsible for all activities that occur under your Display Name and Password. You agree that if You provide any information that is untrue, inaccurate, not current or incomplete or We have reasonable grounds to suspect that such information is untrue, inaccurate, not current or incomplete, or not in accordance with the this Terms of Use, We shall have the right to indefinitely suspend or terminate or block access of your membership on the Website and refuse to provide You with access to the Website.', 'Active', '2019-03-29 06:07:09'),
(8, '3', 'Your mobile phone number and/or e-mail address is treated as Your primary identifier on the Website. It is your responsibility to ensure that Your mobile phone number and your email address is up to date on the Website at all times. You agree to notify Us promptly if your mobile phone number or e-mail address changes by updating the same on the Website through a onetime password verification.', 'Active', '2019-03-29 06:07:09'),
(9, '3', 'You agree that Puirani Dilli shop shall not be liable or responsible for the activities or consequences of use or misuse of any information that occurs under your display name in cases where You have failed to update Your revised mobile phone number and/or e-mail address on the Website.', 'Active', '2019-03-29 06:07:09'),
(10, '4', 'When You use the Website or send emails or other data, information or communication to us, You agree and understand that You are communicating with Us through electronic records and You consent to receive communications via electronic records from Us periodically and as and when required. We may communicate with you by email or by such other mode of communication, electronic or otherwise.', 'Active', '2019-03-29 06:08:01'),
(11, '5', 'All commercial/contractual terms are offered by and agreed to between Buyers and Sellers alone. The commercial/contractual terms include without limitation price, shipping costs, payment methods, payment terms, date, period and mode of delivery, warranties related to products and services and after sales services related to products and services. purani dilli shop does not have any control or does not determine or advise or in any way involve itself in the offering or acceptance of such commercial/contractual terms between the Buyers and Sellers. All discounts, offers (including exchange offers) are by the Seller/Brand and not by purani dilli shop.', 'Active', '2019-03-29 06:10:01'),
(12, '5', 'purani dilli shop does not make any representation or Warranty as to specifics (such as quality, value, salability, etc) of the products or services proposed to be sold or offered to be sold or purchased on the Website. purani dilli  shop does not implicitly or explicitly support or endorse the sale or purchase of any products or services on the Website. purani dilli shop accepts no liability for any errors or omissions, whether on behalf of itself or third parties.\r\n\r\n', 'Active', '2019-03-29 06:10:01'),
(13, '5', 'Purani Dilli shop is not responsible for any non-performance or breach of any contract entered into between Buyers and Sellers. puani dilli shop cannot and does not guarantee that the concerned Buyers and/or Sellers will perform any transaction concluded on the Website. purani dilli shop shall not and is not required to mediate or resolve any dispute or disagreement between Buyers and Sellers.', 'Active', '2019-03-29 06:10:01'),
(14, '6', 'Puirani Dilli', 'Active', '2019-06-13 05:29:08'),
(15, '1', 'Your use of the Website and services and tools are governed by the following terms and conditions ( \"Terms of Use\" ) as applicable to the Website including the applicable policies which are incorporated herein by way of reference. If You transact on the Website, You shall be subject to the policies that are applicable to the Website for such transaction. By mere use of the Website, You shall be contracting with Purani Dillli shop Internet Private Limited and these terms and conditions including the policies constitute Your binding obligations, with Purani Dilli shop', 'Active', '2020-08-10 09:50:55'),
(16, '1', 'For the purpose of these Terms of Use, wherever the context so requires \"You\" or \"User\" shall mean any natural or legal person who has agreed to become a buyer on the Website by providing Registration Data while registering on the Website as Registered User using the computer systems. Purani Dilli shop allows the User to surf the Website or making purchases without registering on the Website. The term \"We\" , \"Us\" , \"Our\" shall mean Purani Dilli shop Internet Private Limited', 'Active', '2020-08-10 09:50:56'),
(18, '1', 'This document is an electronic record in terms of Information Technology Act, 2000 and rules there under as applicable and the amended provisions pertaining to electronic records in various statutes as amended by the Information Technology Act, 2000. This electronic record is generated by a computer system and does not require any physical or digital signatures.', 'Active', '2020-08-10 09:50:56'),
(20, '1', 'o', 'Active', '2020-08-10 09:51:11'),
(46, '1', 'wdqwd', 'Active', '2020-08-10 10:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `terms&conditions_title`
--

CREATE TABLE `terms&conditions_title` (
  `id` int(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms&conditions_title`
--

INSERT INTO `terms&conditions_title` (`id`, `title`, `status`, `datentime`) VALUES
(1, 'Purani Dilli Terms of Use', 'Active', '2019-03-29 06:04:09'),
(2, 'Membership Eligibility', 'Active', '2019-03-29 06:06:17'),
(3, 'Your Account and Registration Obligations', 'Active', '2019-03-29 06:07:09'),
(4, 'Communications', 'Active', '2019-03-29 06:08:00'),
(5, 'Platform for Transaction and Communication', 'Active', '2019-03-29 06:10:01'),
(6, 'Puirani Dilli', 'Inactive', '2019-06-13 05:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `today_deal`
--

CREATE TABLE `today_deal` (
  `id` int(11) NOT NULL,
  `pid` varchar(255) NOT NULL,
  `start` varchar(2555) NOT NULL,
  `end` varchar(255) NOT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `track_order`
--

CREATE TABLE `track_order` (
  `id` int(255) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `status` enum('Delivered','Cancelled') NOT NULL,
  `date` date NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `mobileverified` varchar(255) DEFAULT 'No',
  `email` varchar(255) DEFAULT NULL,
  `emailverified` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `flat` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `locality` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `addr_type` varchar(255) DEFAULT NULL,
  `joining_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `subscribe` varchar(255) DEFAULT NULL,
  `datentime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `mobile`, `mobileverified`, `email`, `emailverified`, `gender`, `password`, `flat`, `street`, `locality`, `city`, `zipcode`, `state`, `country`, `addr_type`, `joining_date`, `status`, `subscribe`, `datentime`) VALUES
(1, 'Test', 'User-1', '9718187815', 'yes', 'test1@gmail.com', NULL, NULL, '121', '701 - 7th floor', 'Maishha infotech', 'NSP', 'NSP', '110083', 'DELHI', 'India', 'Office', '2020-10-19', 'Active', NULL, '2020-10-19 06:40:03'),
(2, 'Kiran', 'J', '8903005709', 'yes', 'kkjkkjsagev@gmail.com', NULL, NULL, 'passw0rd1', '68', 'Pedariyar Koil Street', 'Broadway', 'Chennai', '600001', 'Tamil Nadu', NULL, '', '2021-01-11', 'Active', NULL, '2021-01-11 15:38:08'),
(3, 'CA', 'sharma', '8209511399', 'yes', 'caanshul15@gmail.com', NULL, NULL, 'anshul#2020', 'Near Satyanarayana temple', 'W.no 3', 'Gopinath temple', 'Jhunjhunu', '333705', 'Rajasthan', NULL, '', '2021-01-13', 'Active', NULL, '2021-01-13 20:31:59'),
(4, 'Yash', 'Agarwal', '9313080313', 'yes', 'yash.agg@gmail.com', NULL, NULL, '6sr3061', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-14', 'Active', NULL, '2021-01-14 10:58:46'),
(5, 'Himanshu', 'Mittal', '9871751656', 'yes', 'himanshu@maishainfotech.com', NULL, NULL, '123456', '701', 'NSP', 'NSP', 'Delhi', '110034', 'Delhi', 'India', 'Home', '2021-01-15', 'Active', NULL, '2021-01-15 09:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_tmp_table`
--

CREATE TABLE `user_tmp_table` (
  `id` int(11) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `otp` int(255) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tmp_table`
--

INSERT INTO `user_tmp_table` (`id`, `mobile`, `otp`, `datentime`) VALUES
(1, '9718187815', 4857, '2020-10-19 12:10:03'),
(2, '8903005709', 1439, '2021-01-11 21:08:08'),
(3, '8903005709', 7127, '2021-01-11 21:13:15'),
(4, '8209511399', 3407, '2021-01-14 02:01:59'),
(5, '9313080313', 7215, '2021-01-14 16:28:46'),
(6, '9871751656', 2546, '2021-01-15 15:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cp_name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_approval_products`
--

CREATE TABLE `vendor_approval_products` (
  `id` int(255) NOT NULL,
  `vendor_id` varchar(255) DEFAULT NULL,
  `p_id` varchar(255) DEFAULT NULL,
  `vp_id` varchar(255) DEFAULT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_description`
--

CREATE TABLE `vendor_description` (
  `id` int(255) NOT NULL,
  `vp_id` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_image`
--

CREATE TABLE `vendor_image` (
  `id` int(255) NOT NULL,
  `vp_id` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_mobile`
--

CREATE TABLE `vendor_mobile` (
  `id` int(255) NOT NULL,
  `vendor_id` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_order_tbl`
--

CREATE TABLE `vendor_order_tbl` (
  `id` int(255) NOT NULL,
  `vendor_id` varchar(255) DEFAULT NULL,
  `vp_id` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `order_tbl_id` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `tracking_id` varchar(255) DEFAULT NULL,
  `p_id` varchar(255) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `order_status_by` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `vendor_date` date NOT NULL,
  `vendor_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_products`
--

CREATE TABLE `vendor_products` (
  `id` int(255) NOT NULL,
  `cat_id` varchar(255) DEFAULT NULL,
  `subcat_id` varchar(255) DEFAULT NULL,
  `vendor_id` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `size` enum('Yes','No') DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `similar_products_id` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `admin_approval` enum('Unapproved','Approved') DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_specifications`
--

CREATE TABLE `vendor_specifications` (
  `id` int(255) NOT NULL,
  `vp_id` varchar(255) DEFAULT NULL,
  `specifications` text DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_stock`
--

CREATE TABLE `vendor_stock` (
  `id` int(255) NOT NULL,
  `vp_id` varchar(255) DEFAULT NULL,
  `cod` varchar(255) DEFAULT NULL,
  `online` varchar(255) DEFAULT NULL,
  `stock` enum('Instock','OutOfStock') NOT NULL,
  `stock_no` varchar(255) DEFAULT NULL,
  `delivery_charges` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cp_name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `locality` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_mobile`
--

CREATE TABLE `warehouse_mobile` (
  `id` int(255) NOT NULL,
  `warehouse_id` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_schedule`
--

CREATE TABLE `warehouse_schedule` (
  `id` int(255) NOT NULL,
  `warehouse_id` varchar(255) DEFAULT NULL,
  `order_tbl_id` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `tracking_id` varchar(255) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `order_status_by` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `war_date` date NOT NULL,
  `war_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_stock`
--

CREATE TABLE `warehouse_stock` (
  `id` int(255) NOT NULL,
  `warehouse_id` varchar(255) DEFAULT NULL,
  `c_id` varchar(255) DEFAULT NULL,
  `s_id` varchar(255) DEFAULT NULL,
  `p_id` varchar(255) DEFAULT NULL,
  `stock_no` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `weight`
--

CREATE TABLE `weight` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `trash` varchar(255) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weight`
--

INSERT INTO `weight` (`id`, `name`, `class`, `status`, `trash`) VALUES
(1, '250', '1', 'Active', 'No'),
(2, '500', '1', 'Active', 'No'),
(3, '1', '2', 'Active', 'No'),
(4, '2', '2', 'Inactive', 'No'),
(5, '100', '1', 'Active', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `weight_class`
--

CREATE TABLE `weight_class` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `symbol` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `trash` varchar(255) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weight_class`
--

INSERT INTO `weight_class` (`id`, `name`, `symbol`, `status`, `trash`) VALUES
(1, 'gram', 'gm', 'Active', 'No'),
(2, 'kilogram', 'kg', 'Active', 'No'),
(3, 'centim', 'gm', 'Inactive', 'No'),
(6, 'testaaa', 's', 'Inactive', 'Yes'),
(7, 'test', 'sas', 'Inactive', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `datetime` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `datetime`) VALUES
(1, '1', '13', '2021-01-14 06:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `zip_list`
--

CREATE TABLE `zip_list` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_cart`
--
ALTER TABLE `add_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `available_place`
--
ALTER TABLE `available_place`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `available_place_code`
--
ALTER TABLE `available_place_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bestsellerimage`
--
ALTER TABLE `bestsellerimage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_address`
--
ALTER TABLE `billing_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_description`
--
ALTER TABLE `blog_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_like`
--
ALTER TABLE `blog_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_view`
--
ALTER TABLE `blog_view`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brandslogo`
--
ALTER TABLE `brandslogo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_list`
--
ALTER TABLE `city_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliverymen`
--
ALTER TABLE `deliverymen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliverymen_mobile`
--
ALTER TABLE `deliverymen_mobile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_schedule`
--
ALTER TABLE `delivery_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `del_time`
--
ALTER TABLE `del_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `description`
--
ALTER TABLE `description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_title`
--
ALTER TABLE `faq_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footerbottomimage`
--
ALTER TABLE `footerbottomimage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footercontent`
--
ALTER TABLE `footercontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headerimage`
--
ALTER TABLE `headerimage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homemiddle`
--
ALTER TABLE `homemiddle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `notifyme`
--
ALTER TABLE `notifyme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_slider`
--
ALTER TABLE `offer_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_payment_detail`
--
ALTER TABLE `online_payment_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_coupon_code`
--
ALTER TABLE `order_coupon_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy&policy`
--
ALTER TABLE `privacy&policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy&policy_title`
--
ALTER TABLE `privacy&policy_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_code`
--
ALTER TABLE `promo_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_image`
--
ALTER TABLE `review_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shiping_address`
--
ALTER TABLE `shiping_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_image`
--
ALTER TABLE `special_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specifications`
--
ALTER TABLE `specifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_list`
--
ALTER TABLE `state_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `terms&condition`
--
ALTER TABLE `terms&condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms&conditions_title`
--
ALTER TABLE `terms&conditions_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `today_deal`
--
ALTER TABLE `today_deal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `track_order`
--
ALTER TABLE `track_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tmp_table`
--
ALTER TABLE `user_tmp_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_approval_products`
--
ALTER TABLE `vendor_approval_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_description`
--
ALTER TABLE `vendor_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_image`
--
ALTER TABLE `vendor_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_mobile`
--
ALTER TABLE `vendor_mobile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_order_tbl`
--
ALTER TABLE `vendor_order_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_products`
--
ALTER TABLE `vendor_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_specifications`
--
ALTER TABLE `vendor_specifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_stock`
--
ALTER TABLE `vendor_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_mobile`
--
ALTER TABLE `warehouse_mobile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_schedule`
--
ALTER TABLE `warehouse_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_stock`
--
ALTER TABLE `warehouse_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weight`
--
ALTER TABLE `weight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weight_class`
--
ALTER TABLE `weight_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zip_list`
--
ALTER TABLE `zip_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus`
--
ALTER TABLE `aboutus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `add_cart`
--
ALTER TABLE `add_cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `available_place`
--
ALTER TABLE `available_place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `available_place_code`
--
ALTER TABLE `available_place_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bestsellerimage`
--
ALTER TABLE `bestsellerimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing_address`
--
ALTER TABLE `billing_address`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_comment`
--
ALTER TABLE `blog_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_description`
--
ALTER TABLE `blog_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_like`
--
ALTER TABLE `blog_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_view`
--
ALTER TABLE `blog_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brandslogo`
--
ALTER TABLE `brandslogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `city_list`
--
ALTER TABLE `city_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `deliverymen`
--
ALTER TABLE `deliverymen`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliverymen_mobile`
--
ALTER TABLE `deliverymen_mobile`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_schedule`
--
ALTER TABLE `delivery_schedule`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `del_time`
--
ALTER TABLE `del_time`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `description`
--
ALTER TABLE `description`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `faq_title`
--
ALTER TABLE `faq_title`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `footer`
--
ALTER TABLE `footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `footerbottomimage`
--
ALTER TABLE `footerbottomimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `footercontent`
--
ALTER TABLE `footercontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `headerimage`
--
ALTER TABLE `headerimage`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `homemiddle`
--
ALTER TABLE `homemiddle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifyme`
--
ALTER TABLE `notifyme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offer_slider`
--
ALTER TABLE `offer_slider`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `online_payment_detail`
--
ALTER TABLE `online_payment_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_coupon_code`
--
ALTER TABLE `order_coupon_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `privacy&policy`
--
ALTER TABLE `privacy&policy`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `privacy&policy_title`
--
ALTER TABLE `privacy&policy_title`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `promo_code`
--
ALTER TABLE `promo_code`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review_image`
--
ALTER TABLE `review_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shiping_address`
--
ALTER TABLE `shiping_address`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `special_image`
--
ALTER TABLE `special_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specifications`
--
ALTER TABLE `specifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state_list`
--
ALTER TABLE `state_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms&condition`
--
ALTER TABLE `terms&condition`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `terms&conditions_title`
--
ALTER TABLE `terms&conditions_title`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `today_deal`
--
ALTER TABLE `today_deal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `track_order`
--
ALTER TABLE `track_order`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_tmp_table`
--
ALTER TABLE `user_tmp_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_approval_products`
--
ALTER TABLE `vendor_approval_products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_description`
--
ALTER TABLE `vendor_description`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_image`
--
ALTER TABLE `vendor_image`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_mobile`
--
ALTER TABLE `vendor_mobile`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_order_tbl`
--
ALTER TABLE `vendor_order_tbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_products`
--
ALTER TABLE `vendor_products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_specifications`
--
ALTER TABLE `vendor_specifications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_stock`
--
ALTER TABLE `vendor_stock`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouse_mobile`
--
ALTER TABLE `warehouse_mobile`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouse_schedule`
--
ALTER TABLE `warehouse_schedule`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouse_stock`
--
ALTER TABLE `warehouse_stock`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weight`
--
ALTER TABLE `weight`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `weight_class`
--
ALTER TABLE `weight_class`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zip_list`
--
ALTER TABLE `zip_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
