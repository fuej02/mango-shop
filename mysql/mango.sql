-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-01-29 03:36:23
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `mango`
--

-- --------------------------------------------------------

--
-- 資料表結構 `list_detail`
--

CREATE TABLE `list_detail` (
  `detailid` int(11) UNSIGNED NOT NULL,
  `OrderID` int(11) UNSIGNED DEFAULT NULL,
  `productid` int(11) UNSIGNED DEFAULT NULL,
  `productimage` varchar(100) CHARACTER SET big5 COLLATE big5_chinese_ci DEFAULT NULL,
  `productname` varchar(254) CHARACTER SET big5 COLLATE big5_chinese_ci DEFAULT NULL,
  `price` int(11) UNSIGNED DEFAULT NULL,
  `quantity` int(11) UNSIGNED DEFAULT NULL,
  `totalprice` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 傾印資料表的資料 `list_detail`
--

INSERT INTO `list_detail` (`detailid`, `OrderID`, `productid`, `productimage`, `productname`, `price`, `quantity`, `totalprice`) VALUES
(46, 4, 46, 'mangodry-1.png', '無添加糖芒果乾(200克)', 200, 2, 400);

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `a_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `e_mail` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT '會員'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`a_id`, `name`, `tel`, `e_mail`, `address`, `pwd`, `level`) VALUES
(1, 'admin', '0988888888', 'a12345678@gmail.com', '台南市北區', '222', '會員'),
(2, '2222', '0912345679', '11111@gmail.com', '我的', '111', '會員'),
(3, '林哈哈', '0912345678', 'a0983806183@gmail.com', '我的', '333', '會員'),
(4, '林哈哈', '0999999999', 'a0960120181@gmail.com', '我的', '4', '會員'),
(5, '123', '098380613', 'a0960120181@gmail.com', '我的', '123', '會員'),
(7, '黃大衛', '0978978323', 'a0960120181@gmail.com', '我的', '', '會員');

-- --------------------------------------------------------

--
-- 資料表結構 `newsadmin`
--

CREATE TABLE `newsadmin` (
  `username` varchar(50) CHARACTER SET big5 COLLATE big5_chinese_ci DEFAULT NULL,
  `passwd` varchar(50) CHARACTER SET big5 COLLATE big5_chinese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `newsadmin`
--

INSERT INTO `newsadmin` (`username`, `passwd`) VALUES
('admin', '111111');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) UNSIGNED NOT NULL,
  `SubTotal` int(11) UNSIGNED DEFAULT NULL,
  `Shipping` int(11) UNSIGNED DEFAULT NULL,
  `GrandTotal` int(11) UNSIGNED DEFAULT NULL,
  `CustomerName` varchar(100) DEFAULT NULL,
  `CustomerEmail` varchar(100) DEFAULT NULL,
  `CustomerAddress` varchar(100) DEFAULT NULL,
  `CustomerPhone` varchar(100) DEFAULT NULL,
  `paytype` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=big5 COLLATE=big5_chinese_ci;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`OrderID`, `SubTotal`, `Shipping`, `GrandTotal`, `CustomerName`, `CustomerEmail`, `CustomerAddress`, `CustomerPhone`, `paytype`) VALUES
(4, 689, NULL, 100, '黃大千', 'a09@gmail.com', '台南市仁德區', '0988888888', NULL),
(19, NULL, NULL, 67, '藩雨倢', 'a0988@gmail.com', '台南市仁德', '09833344444', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `productid` int(11) UNSIGNED NOT NULL,
  `productname` varchar(100) DEFAULT NULL,
  `productprice` int(11) UNSIGNED DEFAULT NULL,
  `productimages` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `a1` varchar(10) DEFAULT NULL,
  `a2` varchar(10) DEFAULT NULL,
  `a3` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=big5 COLLATE=big5_chinese_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`productid`, `productname`, `productprice`, `productimages`, `description`, `a1`, `a2`, `a3`) VALUES
(47, '愛文 - 15顆裝(15斤)', 800, 'mangogift2-1.png', '粒粒皆飽滿的愛文，籽薄果肉質細膩，每一口都是極品饗宴！口感香甜紮實而且擁有自己獨特的果香味。飽滿果肉， 厚實多汁，濃濃果香，保證您一試難忘。', '愛文', '', ''),
(48, '愛文 - 12顆裝(15斤)', 650, 'mangogift-1.png', '粒粒皆飽滿的愛文，籽薄果肉質細膩，每一口都是極品饗宴！口感香甜紮實而且擁有自己獨特的果香味。飽滿果肉， 厚實多汁，濃濃果香，保證您一試難忘。', '愛文', '', ''),
(46, '無添加糖芒果乾(200克)', 200, 'mangodry-1.png', '大朋友、小朋友都愛吃，不添加任何糖就可以讓您吃得過癮，吃過的都說讚!採用低溫烘焙，持續烘乾12小時，不添加任何添加物，保留水果最自然風味，讓您吃得健康、安心。', '愛文', '芒果乾', ''),
(61, '888', 40, '23f7850d1e4ae3e6b5c1bc0cc8e1b60f9788ce05.jpg', '123', '', '', '');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `list_detail`
--
ALTER TABLE `list_detail`
  ADD PRIMARY KEY (`detailid`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`a_id`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `list_detail`
--
ALTER TABLE `list_detail`
  MODIFY `detailid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
