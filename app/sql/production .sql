-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-06-21 05:36:00
-- サーバのバージョン： 10.4.24-MariaDB
-- PHP のバージョン: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `production`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `ancillary_equipments`
--

CREATE TABLE `ancillary_equipments` (
  `CID` varchar(8) NOT NULL,
  `equipment_id` varchar(8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `bathing_information`
--

CREATE TABLE `bathing_information` (
  `ZPX_ID` varchar(8) NOT NULL,
  `UID` varchar(12) NOT NULL,
  `open_air_bath` varchar(1) DEFAULT NULL,
  `sauna` varchar(1) DEFAULT NULL,
  `spring_quality` varchar(120) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `location_roads`
--

CREATE TABLE `location_roads` (
  `CID` varchar(8) NOT NULL,
  `location_road_id` int(1) NOT NULL,
  `location_road_type` varchar(8) NOT NULL,
  `road_number` varchar(4) DEFAULT NULL,
  `road_name` varchar(80) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_equipments`
--

CREATE TABLE `mst_equipments` (
  `id` int(2) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `mst_equipments`
--

INSERT INTO `mst_equipments` (`id`, `name`) VALUES
(0, '多機能トイレ'),
(1, 'EVスタンド'),
(2, 'コインランドリー'),
(3, 'Wi-Fi'),
(4, 'レンタサイクル'),
(5, 'RVパーク'),
(6, 'スタンプ'),
(7, '道の駅きっぷ'),
(8, '温水洗浄便座トイレ');

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_facilities`
--

CREATE TABLE `mst_facilities` (
  `id` int(2) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `mst_facilities`
--

INSERT INTO `mst_facilities` (`id`, `name`) VALUES
(0, '売店'),
(1, '飲食店'),
(2, '入浴施設'),
(3, '宿泊施設'),
(4, '遊戯施設'),
(5, '体験・学習施設'),
(6, 'ランドマーク施設'),
(7, '観光案内所');

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_roadstation_labels`
--

CREATE TABLE `mst_roadstation_labels` (
  `id` int(2) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `mst_roadstation_labels`
--

INSERT INTO `mst_roadstation_labels` (`id`, `name`) VALUES
(0, 'NEW区分'),
(1, '全国モデル「道の駅」'),
(2, '重点「道の駅」'),
(3, '重点「道の駅」候補'),
(4, '住民サービス部門 モデル「道の駅」'),
(5, '地域交通拠点部門 モデル「道の駅」'),
(6, '防災「道の駅」');

-- --------------------------------------------------------

--
-- テーブルの構造 `restaurant_information`
--

CREATE TABLE `restaurant_information` (
  `ZPX_ID` varchar(8) NOT NULL,
  `UID` varchar(12) NOT NULL,
  `japanese_food` varchar(1) DEFAULT NULL,
  `western_food` varchar(1) DEFAULT NULL,
  `chinese_food` varchar(1) DEFAULT NULL,
  `sweets` varchar(1) DEFAULT NULL,
  `bar` varchar(1) DEFAULT NULL,
  `eat_in` varchar(1) DEFAULT NULL,
  `take_out` varchar(1) DEFAULT NULL,
  `buffet` varchar(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `roadstations`
--

CREATE TABLE `roadstations` (
  `ZPX_ID` varchar(8) NOT NULL,
  `CID` varchar(8) NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `name_furi` varchar(240) DEFAULT NULL,
  `thumbnail` text DEFAULT NULL,
  `registry_year` varchar(4) DEFAULT NULL,
  `catch_copy` varchar(120) DEFAULT NULL,
  `introduction` text DEFAULT NULL,
  `gift` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `roadstation_business_hours`
--

CREATE TABLE `roadstation_business_hours` (
  `CID` varchar(12) NOT NULL,
  `start_time` varchar(64) DEFAULT NULL,
  `end_time` varchar(64) DEFAULT NULL,
  `time_supplement1` varchar(128) DEFAULT NULL,
  `time_supplement2` varchar(128) DEFAULT NULL,
  `regular_holiday` varchar(256) DEFAULT NULL,
  `holiday_supplement1` varchar(64) DEFAULT NULL,
  `holiday_supplement2` varchar(64) DEFAULT NULL,
  `holiday_sightseeing_code` varchar(64) DEFAULT NULL,
  `time_sightseeing_code` varchar(64) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `roadstation_business_stamp_information`
--

CREATE TABLE `roadstation_business_stamp_information` (
  `CID` varchar(8) NOT NULL,
  `id` int(1) NOT NULL,
  `installation_location` text DEFAULT NULL,
  `start_time` varchar(8) DEFAULT NULL,
  `end_time` varchar(8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `roadstation_contacts`
--

CREATE TABLE `roadstation_contacts` (
  `CID` varchar(8) NOT NULL,
  `contact_address` varchar(100) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `tel` varchar(64) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `manager` varchar(30) DEFAULT NULL,
  `mail` varchar(124) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `roadstation_evals`
--

CREATE TABLE `roadstation_evals` (
  `CID` varchar(8) NOT NULL,
  `eval_index` varchar(32) DEFAULT NULL,
  `eval_comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `roadstation_labels`
--

CREATE TABLE `roadstation_labels` (
  `CID` varchar(8) NOT NULL,
  `label_id` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `roadstation_parkings`
--

CREATE TABLE `roadstation_parkings` (
  `CID` varchar(8) NOT NULL,
  `learge_parking_number` varchar(16) DEFAULT NULL,
  `middle_parking_number` varchar(16) DEFAULT NULL,
  `disabilities_parking_number` varchar(16) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `roadstation_sightseeings`
--

CREATE TABLE `roadstation_sightseeings` (
  `CID` varchar(8) NOT NULL,
  `id` int(1) NOT NULL,
  `name` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `roadstation_urls`
--

CREATE TABLE `roadstation_urls` (
  `CID` varchar(8) NOT NULL,
  `web` varchar(128) DEFAULT NULL,
  `twitter` varchar(128) DEFAULT NULL,
  `facebook` varchar(128) DEFAULT NULL,
  `instagram` varchar(128) DEFAULT NULL,
  `line` varchar(128) DEFAULT NULL,
  `other` varchar(128) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `seasonal_information`
--

CREATE TABLE `seasonal_information` (
  `id` varchar(8) NOT NULL,
  `CID` varchar(8) NOT NULL,
  `title` varchar(32) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `start_time` varchar(10) DEFAULT NULL,
  `end_time` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `seasonal_information_flags`
--

CREATE TABLE `seasonal_information_flags` (
  `CID` varchar(8) NOT NULL,
  `is_closed` varchar(1) DEFAULT NULL,
  `is_shutdown` varchar(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `ancillary_equipments`
--
ALTER TABLE `ancillary_equipments`
  ADD PRIMARY KEY (`CID`,`equipment_id`);

--
-- テーブルのインデックス `bathing_information`
--
ALTER TABLE `bathing_information`
  ADD PRIMARY KEY (`ZPX_ID`,`UID`);

--
-- テーブルのインデックス `location_roads`
--
ALTER TABLE `location_roads`
  ADD PRIMARY KEY (`CID`,`location_road_id`);

--
-- テーブルのインデックス `mst_equipments`
--
ALTER TABLE `mst_equipments`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `mst_facilities`
--
ALTER TABLE `mst_facilities`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `mst_roadstation_labels`
--
ALTER TABLE `mst_roadstation_labels`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `restaurant_information`
--
ALTER TABLE `restaurant_information`
  ADD PRIMARY KEY (`ZPX_ID`,`UID`);

--
-- テーブルのインデックス `roadstations`
--
ALTER TABLE `roadstations`
  ADD PRIMARY KEY (`ZPX_ID`,`CID`);

--
-- テーブルのインデックス `roadstation_business_hours`
--
ALTER TABLE `roadstation_business_hours`
  ADD PRIMARY KEY (`CID`);

--
-- テーブルのインデックス `roadstation_business_stamp_information`
--
ALTER TABLE `roadstation_business_stamp_information`
  ADD PRIMARY KEY (`CID`,`id`);

--
-- テーブルのインデックス `roadstation_contacts`
--
ALTER TABLE `roadstation_contacts`
  ADD PRIMARY KEY (`CID`);

--
-- テーブルのインデックス `roadstation_evals`
--
ALTER TABLE `roadstation_evals`
  ADD PRIMARY KEY (`CID`);

--
-- テーブルのインデックス `roadstation_labels`
--
ALTER TABLE `roadstation_labels`
  ADD PRIMARY KEY (`CID`);

--
-- テーブルのインデックス `roadstation_parkings`
--
ALTER TABLE `roadstation_parkings`
  ADD PRIMARY KEY (`CID`);

--
-- テーブルのインデックス `roadstation_sightseeings`
--
ALTER TABLE `roadstation_sightseeings`
  ADD PRIMARY KEY (`CID`,`id`);

--
-- テーブルのインデックス `roadstation_urls`
--
ALTER TABLE `roadstation_urls`
  ADD PRIMARY KEY (`CID`);

--
-- テーブルのインデックス `seasonal_information`
--
ALTER TABLE `seasonal_information`
  ADD PRIMARY KEY (`id`,`CID`);

--
-- テーブルのインデックス `seasonal_information_flags`
--
ALTER TABLE `seasonal_information_flags`
  ADD PRIMARY KEY (`CID`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `mst_equipments`
--
ALTER TABLE `mst_equipments`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
