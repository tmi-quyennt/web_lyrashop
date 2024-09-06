-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 01, 2024 lúc 07:17 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_lyrashop_phanquyen`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`brand_id`, `title`, `description`, `image`, `status`, `slug`) VALUES
(11, 'Spring/Summer 2024 Collection', 'Bộ sưu tập xuân hè 2024 với những thiết kế tươi mới, phù hợp với khí hậu ấm áp.', '1723658909312990665_2288289791341855_3457304086739874480_n.jpg', 1, 'spring-summer-2024-collection'),
(12, 'Autumn/Winter 2024 Collection', 'Bộ sưu tập thu đông 2024 với các trang phục ấm áp và phong cách cho mùa lạnh.', '1723658946BeIMPRESSSIVE.jpg', 1, 'autumn-winter-2024-collection'),
(13, 'Casual Wear Collection', 'Bộ sưu tập trang phục thường ngày, thoải mái và dễ dàng phối đồ.', '1723658972DearSummer.jpg', 1, 'casual-wear-collection'),
(14, 'Evening Wear Collection', 'Bộ sưu tập trang phục dạ hội, sang trọng và lịch lãm cho các buổi tiệc tối.', '1723659038capturethemoment.jpg', 1, 'evening-wear-collection'),
(15, 'Sportswear Collection', 'Bộ sưu tập đồ thể thao, phù hợp cho các hoạt động thể chất và tập luyện.', '1723659092winterrecord.jpg', 1, 'sportswear-collection'),
(16, 'Vintage Collection', 'Bộ sưu tập phong cách cổ điển, mang đậm hơi thở của thời trang xưa.', '1723659146WindyDay.jpg', 1, 'vintage-collection'),
(17, 'Street Style Collection', 'Bộ sưu tập thời trang đường phố, năng động và cá tính.', '1723659202BackToSchol.jpg', 1, 'street-style-collection'),
(19, 'Workwear Collection', 'Bộ sưu tập trang phục công sở, chuyên nghiệp và thanh lịch.', '1723659273July.jpg', 1, 'workwear-collection');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `title`, `description`, `status`, `image`, `slug`) VALUES
(10, 'Áo sơ mi (Shirts)', 'Danh mục các loại áo sơ mi lịch sự và thời trang.', 1, '1725106648121383195_1677692459068261_7044036679103204325_n.jpg', 'shirts'),
(11, 'Áo thun (T-Shirts)', 'Danh mục các loại áo thun đa dạng về màu sắc và kiểu dáng.', 1, '1725106592aophong4.jpg', 't-shirts'),
(12, 'Váy đầm (Dresses)', 'Danh mục các loại váy đầm từ hàng ngày đến dạ tiệc.', 1, '1725106499255453730_1993784420792395_3926276240871119299_n.jpg', 'dresses'),
(13, 'Quần short (Shorts)', 'Danh mục các loại quần short thoải mái và phong cách.', 1, '1724084748shorts.jpg', 'shorts'),
(14, 'Giày dép (Footwear)', 'Danh mục các loại giày dép từ giày thể thao đến giày cao gót', 1, '1724084819giay.jpg', 'footwear');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `email`, `password`, `phone`, `address`) VALUES
(7, 'Quyen', 'nguyenquyen@gmail.com', '123456', '686868', 'PX HN'),
(8, 'Nguyễn Thu Quyên', 'quyenadmin@gmail.com', '20092002', '0393872616', 'Hà Nội'),
(11, 'Phúc', 'duongvanphuc169@gmail.com', 'Phuc1692002@', '0328790256', 'Dương Nội, Hà Đông');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `ship_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `order_code`, `status`, `ship_id`, `order_date`, `customer_id`) VALUES
(8, '8745', 2, 10, '2024-07-27 10:52:52', 7),
(9, '5828', 2, 11, '2023-12-30 12:41:23', 7),
(12, '8762', 2, 14, '2024-09-01 10:52:52', 7),
(13, '523', 3, 15, '2024-09-01 10:52:52', 7),
(16, '3890', 2, 18, '2024-09-01 10:52:52', 8),
(20, '8951', 2, 22, '2024-09-01 10:52:52', 8),
(44, '3535', 2, 45, '2024-09-01 13:51:31', 8),
(45, '9680', 1, 46, '2024-09-01 13:55:46', 8),
(64, '9145', 1, 65, '2024-09-01 14:54:53', 11),
(65, '5641', 1, 66, '2024-09-01 16:42:05', 11),
(77, '5300', 1, 91, '2024-09-01 23:46:45', 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_code` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_code`, `product_id`, `quantity`, `order_id`) VALUES
(6, '8745', 40, 1, 8),
(7, '5828', 40, 1, 9),
(14, '8762', 40, 1, 12),
(15, '523', 40, 1, 13),
(18, '3890', 48, 1, 16),
(23, '8951', 40, 1, 20),
(33, '3535', 44, 1, 44),
(34, '9680', 45, 1, 45),
(52, '9145', 48, 1, 64),
(53, '5641', 46, 1, 65),
(54, '5641', 48, 1, 65),
(55, '5300', 48, 1, 77);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `title`, `description`, `image`, `status`, `category_id`, `brand_id`, `slug`, `quantity`, `price`) VALUES
(40, 'LYRA Áo baby tee phối ren thêu tim', 'LYRA Áo baby tee phối ren thêu tim Babe xinh chất thun tăm Hàn cực tôn dáng VSYAP0462', '1723660183aophong4.jpg', 1, 11, 11, 'lyra-ao-baby-tee-phoi-ren-theu-tim', 47, '130000'),
(44, 'Áo thun in hình cherry', 'Áo phông nữ mùa hè chất cotton mềm thấm mồ hôi', '1724085659tshort.jpg', 1, 11, 11, 'ao-thun-in-hinh-cherry', 95, '250000'),
(45, 'Bộ đồ thể thao Adidas', 'Bộ đồ thể thao Adidas chất lượng cao, thoải mái khi tập luyện.', '1724087646bodothethao.jpg', 1, 13, 15, 'bo-do-the-thao-adidas', 25, '290000'),
(46, 'Áo Thun Cotton Hàn', 'Siêu Mát  Mẫu Áo bán chạy nhất 2024', '1724088581Screenshot-2024-08-20-002559.jpg', 1, 11, 11, 'ao-thun-cotton-han', 64, '195000'),
(48, 'Giày Nike', 'Giày thể thao chính hãng', '1724162486giay1.jpg', 1, 14, 15, 'giay-nike', 52, '395000'),
(51, 'Test', 'Áo vintage', '1725108564phan-mem-quan-ly-hoc-sinh-hoc-vien.jpg', 1, 10, 11, 'test', 5, '350.000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping`
--

CREATE TABLE `shipping` (
  `ship_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shipping`
--

INSERT INTO `shipping` (`ship_id`, `name`, `phone`, `address`, `email`, `method`) VALUES
(6, 'Phúc', '686868', 'HD HN', 'duongphuc@gmail.com', 'cod'),
(7, 'Quyen', '686868', 'PX HN', 'quyenadmin@gmail.com', 'cod'),
(8, 'Quyen', '686868', 'PX HN', 'duongvanphuc169@gmail.com', 'cod'),
(9, 'Quyen', '686868', 'PX HN', 'duongvanphuc169@gmail.com', 'cod'),
(10, 'Quyen', '686868', 'PX HN', 'duongvanphuc169@gmail.com', 'cod'),
(11, 'Quyena', '686868', 'PX HN', 'admin@gmail.com', 'cod'),
(12, 'Ngerrr', '686868', 'HD HN', 'duongvanphuc169@gmail.com', 'cod'),
(13, 'Quyen', '686868', 'PX HN', 'quyenadmin@gmail.com', 'cod'),
(14, 'Quyen', '686868', 'PX HN', 'admin@gmail', 'vnpay'),
(15, 'Quyen', '686868', 'PX HN', 'admin@gmail', 'vnpay'),
(16, 'Quyen', '686868', 'PX HN', 'admin@gmail', 'vnpay'),
(17, 'Phúc', '686868', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(18, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(19, 'Phúc', '0328790256', 'Phú Xuyên, Hà Nội', 'duongvanphuc169@gmail.com', 'cod'),
(20, 'Dương Phúc', '0328790256', 'Phú Xuyên, Hà Nội', 'duongphuc@gmail.com', 'cod'),
(21, 'Dương Phúc 2', '0328790256', 'Phú Xuyên, Hà Nội', 'duongphuc@gmail.com', 'cod'),
(22, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(23, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(24, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(25, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(26, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(27, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(28, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(29, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(30, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(31, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(32, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(33, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(34, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'nguyenquyen@gmail.com', 'cod'),
(35, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(36, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(37, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(38, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(39, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(40, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(41, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(42, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(43, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(44, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(45, 'Phúc', '0328790256', 'HD HN', 'duongvanphuc169@gmail.com', 'cod'),
(46, 'Ngerrr', '0328790256', 'Phú Xuyên, Hà Nội', 'duongvanphuc169@gmail.com', 'cod'),
(47, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(48, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(49, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(50, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(51, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(52, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(53, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(54, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(55, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(56, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(57, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(58, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(59, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(60, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(61, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(62, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(63, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(64, 'Ngerrr', '0328790256', 'PX HN', 'duongphuc@gmail.com', 'cod'),
(65, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'quyenadmin@gmail.com', 'cod'),
(66, 'Quyen', '0328790256', 'Phú Xuyên, Hà Nội', 'admin@gmail.com', 'cod'),
(67, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(68, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(69, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(70, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(71, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(72, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(73, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(74, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(75, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(76, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(77, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(78, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(79, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(80, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(81, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(82, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(83, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(84, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(85, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(86, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(87, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(88, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(89, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(90, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod'),
(91, 'Phúc', '0328790256', 'Dương Nội, Hà Đông', 'duongvanphuc169@gmail.com', 'cod');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `image`, `status`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', '123456', '1724835484giay1.jpg', 1, 1),
(11, 'Quyên Staff 1', 'quyen_staff@gmail.com', '123456', '1724984556Tệp_000.png', 1, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `ship_id` (`ship_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_order` (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`ship_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `shipping`
--
ALTER TABLE `shipping`
  MODIFY `ship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ship_id`) REFERENCES `shipping` (`ship_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
