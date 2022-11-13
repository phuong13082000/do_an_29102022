-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 08:10 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `phone`, `token`) VALUES
(1, 'Admin', 'hoangphuong0813@gmail.com', '9256f07cf3c731a53e71937461aa7950', '0356929673', 'JkUAcbnwtBhuSERN');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `title`, `status`) VALUES
(1, 'Iphone', 0),
(2, 'Samsung', 0),
(4, 'Xiaomi', 0),
(8, 'OnePlus', 0),
(9, 'Oppo', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `status`) VALUES
(1, 'Ios', 0),
(2, 'Giá rẻ', 0),
(5, 'Android', 0),
(6, 'Chơi game Cấu hình cao', 0),
(7, 'Chụp ảnh Quay phim', 0),
(8, 'Mỏng nhẹ', 0),
(9, 'Nhỏ gọn dễ cầm', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `comment_parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `title`, `status`, `customer_id`, `product_id`, `admin_id`, `comment_parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Điện thoại đẹp quá', 0, 1, 22, NULL, NULL, '2022-11-03 08:46:27', '2022-11-03 10:11:21'),
(2, 'hihi', 0, 1, 22, NULL, NULL, '2022-11-03 08:47:24', '2022-11-03 11:00:49'),
(3, 'cam on ban nha', 0, NULL, 22, 1, 1, '2022-11-03 10:53:03', '2022-11-03 10:53:03'),
(4, '=))', 0, NULL, 22, 1, 2, '2022-11-03 11:14:50', '2022-11-03 11:14:50'),
(6, 'ban nho mua nha', 0, NULL, 22, 1, 1, '2022-11-04 00:21:23', '2022-11-04 00:21:23'),
(7, 'ád', 0, 1, 22, NULL, NULL, '2022-11-05 19:50:14', '2022-11-05 19:50:52'),
(8, 'da', 0, NULL, 22, 1, 7, '2022-11-05 19:50:59', '2022-11-05 19:50:59'),
(9, 'Điện thoại đẹp quá', 0, 1, 23, NULL, NULL, '2022-11-08 13:06:39', '2022-11-08 13:06:39'),
(10, 'alo', 0, 1, 23, NULL, NULL, '2022-11-11 02:39:57', '2022-11-11 02:39:57'),
(11, 'hello', 0, NULL, 23, 1, 10, '2022-11-11 02:40:18', '2022-11-11 02:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `fullname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `customer_token` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fullname`, `email`, `password`, `gender`, `birthday`, `phone`, `address`, `status`, `customer_token`, `google_id`, `facebook_id`, `provider`) VALUES
(1, 'Phuong', 'hoangphuong0813@gmail.com', '$2y$10$m.KjtpvH2PflOWXDflnNVOtZ/tFHpixoZABle52UbztDBjx3lKSYi', NULL, NULL, '0356929673', 'Xã Phong Phú-Huyện Bình Chánh-Hồ Chí Minh', 0, NULL, NULL, NULL, NULL),
(2, 'Phương', 'hoangphuong0813@gmail.com', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '3330089617264301', 'facebook');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `image`, `product_id`) VALUES
(5, 'iphone-11-trang.jpg', 'iphone-11-trang-1-2-org5364.jpg', 22),
(6, 'vi-vn-iphone-11-tinhnang2475.jpg', 'vi-vn-iphone-11-tinhnang2475.jpg', 22);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_ship` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `payment_method` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_nguoinhan` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_nguoinhan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_nguoinhan` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `price_ship`, `note`, `status`, `payment_method`, `name_nguoinhan`, `phone_nguoinhan`, `address_nguoinhan`, `customer_id`, `created_at`, `updated_at`) VALUES
('52b17', '170500', '751', 1, 'Tiền mặt', 'Phuong', '01656929673', 'Xã Phong Phú-Huyện Bình Chánh-Hồ Chí Minh', 1, '2022-11-08 12:47:58', '2022-11-06 05:51:42'),
('999de', '97951', 'adsad', 1, 'Tiền mặt', 'asda', '1231231', 'Xã Nghĩa Lộ--', 1, '2022-11-06 07:00:55', '2022-11-06 07:00:55'),
('d1239', '205498', 'sdadas', 1, 'Tiền mặt', 'Phuong', '0356929673', 'Xã Tú Nang-Huyện Yên Châu-Sơn La', 1, '2022-11-08 12:48:08', '2022-11-05 02:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `order_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `num`, `price`, `status`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(21, 1, 28300000, 1, 'd1239', 23, '2022-11-05 02:51:18', '2022-11-05 02:51:18'),
(22, 1, 11790000, 1, 'd1239', 22, '2022-11-05 02:51:18', '2022-11-05 02:51:18'),
(23, 2, 28300000, 1, '52b17', 23, '2022-11-06 05:51:42', '2022-11-06 05:51:42'),
(24, 1, 11790000, 1, '999de', 22, '2022-11-06 07:00:55', '2022-11-06 07:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `price_sale` bigint(20) NOT NULL,
  `manhinh` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mausac` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `camera_sau` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `camera_truoc` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpu` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonho` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ram` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketnoi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin_sac` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tienich` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thongtin_chung` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `image`, `number`, `price`, `price_sale`, `manhinh`, `mausac`, `camera_sau`, `camera_truoc`, `cpu`, `bonho`, `ram`, `ketnoi`, `pin_sac`, `tienich`, `thongtin_chung`, `status`, `brand_id`, `category_id`, `created_at`, `updated_at`) VALUES
(22, 'Điện thoại iPhone 11 64GB', '\"iphone-11-trang-600x6009959.jpg\"', 11, 15000000, 11790000, 'IPS LCD 6.1\" Liquid Retina', 'Trắng', '2 camera 12 MP', '12 MP', 'Apple A13 Bionic', '64GB', '4GB', '1 Nano SIM & 1 eSIMHỗ trợ 4G', '3110 mAh 20 W', 'Bảo mật nâng cao:  Mở khoá khuôn mặt Face ID Tính năng đặc biệt:  Apple Pay Âm thanh Dolby Audio Kháng nước, bụi:  IP68 Ghi âm:  Ghi âm có microphone chuyên dụng chống ồn Xem phim:  H.264(MPEG4-AVC) Nghe nhạc:  AAC  MP3  Lossless  FLAC', '<h2><strong>Th&ocirc;ng tin sản phẩm</strong></h2>\r\n\r\n<h3>Apple đ&atilde; ch&iacute;nh thức tr&igrave;nh l&agrave;ng bộ 3 si&ecirc;u phẩm iPhone 11, trong đ&oacute; phi&ecirc;n bản&nbsp;iPhone 11 64GB&nbsp;c&oacute; mức gi&aacute; rẻ nhất nhưng vẫn được n&acirc;ng cấp mạnh mẽ như&nbsp;iPhone Xr&nbsp;ra mắt&nbsp;trước đ&oacute;.</h3>\r\n\r\n<h3><strong>N&acirc;ng cấp mạnh mẽ về camera</strong></h3>\r\n\r\n<p>N&oacute;i về n&acirc;ng cấp th&igrave; camera ch&iacute;nh l&agrave; điểm c&oacute; nhiều cải tiến nhất tr&ecirc;n thế hệ&nbsp;iPhone&nbsp;mới.</p>\r\n\r\n<p>Nếu như trước đ&acirc;y iPhone Xr chỉ c&oacute; một camera th&igrave; nay với&nbsp;iPhone 11&nbsp;ch&uacute;ng ta sẽ c&oacute; tới hai camera ở mặt sau.</p>\r\n\r\n<p>Ngo&agrave;i camera ch&iacute;nh vẫn c&oacute; độ ph&acirc;n giải 12 MP th&igrave; ch&uacute;ng ta sẽ c&oacute; th&ecirc;m một camera g&oacute;c si&ecirc;u rộng v&agrave; cũng với độ ph&acirc;n giải tương tự.</p>\r\n\r\n<h3><strong>Hiệu năng mạnh mẽ h&agrave;ng đầu thế giới</strong></h3>\r\n\r\n<p>Mỗi lần ra&nbsp;iPhone&nbsp;mới l&agrave; mỗi lần Apple mang đến cho người d&ugrave;ng một trải nghiệm về hiệu năng &quot;chưa từng c&oacute;&quot;.</p>\r\n\r\n<p>Tr&ecirc;n iPhone 11 mới Apple n&acirc;ng cấp con chip của m&igrave;nh l&ecirc;n thế hệ&nbsp;Apple A13 Bionic&nbsp;rất mạnh mẽ.</p>\r\n\r\n<p>Chiếc iPhone n&agrave;y cũng được n&acirc;ng cấp dung lượng&nbsp;RAM 4 GB&nbsp;thay v&igrave; 3 GB như thế hệ trước đ&oacute;.</p>\r\n\r\n<p>Ở mức cấu h&igrave;nh tr&ecirc;n gi&uacute;p&nbsp;điện thoại chơi game&nbsp;tốt với c&aacute;c tựa game phổ biến hiện nay một c&aacute;ch mượt m&agrave;, ổn định. Mọi thao t&aacute;c tr&ecirc;n iPhone mới cũng cho tốc độ phản hồi nhanh m&agrave; bạn gần như sẽ kh&ocirc;ng cảm nhận được sự giật lag cho d&ugrave; c&oacute; sử dụng trong một thời gian d&agrave;i.</p>\r\n\r\n<p>Phi&ecirc;n bản iOS 15 (12/2021) đi k&egrave;m với chiếc iPhone n&agrave;y cũng được trang bị nhiều t&iacute;nh năng hơn gi&uacute;p bạn sử dụng chiếc iPhone hiệu quả hơn.</p>\r\n\r\n<p>Face ID tr&ecirc;n iPhone 11 cũng được cải tiến để c&oacute; thể nhận diện ở nhiều g&oacute;c độ hơn v&agrave; tốc độ phản hồi nhanh hơn.</p>\r\n\r\n<h3><strong>Những thay đổi về thiết kế theo hướng t&iacute;ch cực</strong></h3>\r\n\r\n<p>Ch&uacute;ng ta sẽ c&oacute; một mặt lưng ho&agrave;n thiện dưới dạng k&iacute;nh v&agrave; Apple n&oacute;i rằng họ đ&atilde; sử dụng loại k&iacute;nh bền nhất từ trước tới nay cho chiếc iPhone n&agrave;y.</p>\r\n\r\n<p>Camera k&eacute;p tr&ecirc;n iPhone mới cũng được thiết kế lại v&agrave; tin vui l&agrave; n&oacute; sẽ bớt lồi hơn so với tr&ecirc;n iPhone Xr trước đ&acirc;y.</p>\r\n\r\n<p>Điểm nhấn về cụm camera to bản ở mặt sau sẽ gi&uacute;p người kh&aacute;c dễ d&agrave;ng nhận biết bạn đang sử dụng một chiếc iPhone 11 tr&ecirc;n tay.</p>\r\n\r\n<p>Logo quả t&aacute;o truyền thống của Apple nay đ&atilde; được di chuyển về phần ch&iacute;nh giữa của mặt lớn thay v&igrave; đặt lệch về ph&iacute;a cạnh tr&ecirc;n như những đời iPhone trước đ&oacute;.</p>\r\n\r\n<p>Apple cho biết họ đ&atilde; ho&agrave;n thiện tr&ecirc;n iPhone mới để n&oacute; cho khả năng&nbsp;chống nước&nbsp;tốt hơn v&agrave; người d&ugrave;ng c&oacute; thể y&ecirc;n t&acirc;m về điều đ&oacute;.&nbsp;</p>\r\n\r\n<h3><strong>Thời lượng pin tốt nhất từ trước tới nay</strong></h3>\r\n\r\n<p>Khi n&oacute;i đến thời lượng pin iPhone 11, hẳn nhiều người đ&atilde; ước ao rằng m&aacute;y sẽ c&oacute; vi&ecirc;n pin tốt giống như iPhone Xr (c&oacute; thời lượng pin tốt nhất so với bất kỳ iPhone hiện đại n&agrave;o).</p>\r\n\r\n<p>Tuy nhi&ecirc;n bạn sẽ c&ograve;n c&oacute; một chiếc m&aacute;y thậm ch&iacute; c&ograve;n tốt hơn nữa.</p>\r\n\r\n<p>Theo Apple th&igrave; chiếc iPhone mới sẽ c&oacute; thời lượng pin tr&acirc;u hơn 1 giờ so với chiếc iPhone Xr.</p>\r\n\r\n<p>Như vậy với iPhone mới bạn ho&agrave;n to&agrave;n c&oacute; thể sử dụng m&aacute;y l&ecirc;n tới 2 ng&agrave;y m&agrave; kh&ocirc;ng cần lo lắng việc thiết bị sẽ hết pin giữa chừng.</p>\r\n\r\n<p>Tất nhi&ecirc;n m&aacute;y cũng sẽ hỗ trợ c&ocirc;ng nghệ&nbsp;sạc nhanh&nbsp;nhưng bạn phải mua th&ecirc;m củ sạc b&ecirc;n ngo&agrave;i để c&oacute; thể sử dụng t&iacute;nh năng n&agrave;y.</p>\r\n\r\n<p>Với chừng đ&oacute; t&iacute;nh năng, chừng đ&oacute; cải tiến th&igrave; chiếc iPhone 11 n&agrave;y tự tin sẽ l&agrave; một đối thủ đ&aacute;ng gờm với những chiếc flagship đến từ c&aacute;c h&atilde;ng Android đang c&oacute; mặt tr&ecirc;n thị trường.</p>', 0, 1, 1, '2022-11-09 05:52:54', '2022-11-09 05:52:54'),
(23, 'Điện thoại iPhone 13 Pro Max 128GB', '\"iphone-13-pro-max-xanh-la-thumb-600x6008822.jpg\"', 11, 34000000, 28300000, 'OLED 6.7\" Super Retina XDR', 'Xám', '3 camera 12 MP', '12 MP', 'Apple A15 Bionic', '128GB', '8GB', '1 Nano SIM & 1 eSIMHỗ trợ 5G', '5000 mAh 15 W', 'Bảo mật nâng cao:  Mở khoá khuôn mặt  Face ID Kháng nước, bụi:  IP68 Ghi âm:  Ghi âm có microphone chuyên dụng chống ồn Xem phim:  H.264(MPEG4-AVC) Nghe nhạc:  AAC  Lossless  FLAC', '<h2><strong>Th&ocirc;ng tin sản phẩm</strong></h2>\r\n\r\n<h3>Điện thoại&nbsp;iPhone 13 Pro Max 128 GB&nbsp;- si&ecirc;u phẩm được mong chờ nhất ở nửa cuối năm 2021 đến từ&nbsp;Apple. M&aacute;y c&oacute; thiết kế kh&ocirc;ng mấy đột ph&aacute; khi so với người tiền nhiệm, b&ecirc;n trong đ&acirc;y vẫn l&agrave; một sản phẩm c&oacute; m&agrave;n h&igrave;nh si&ecirc;u đẹp, tần số qu&eacute;t được n&acirc;ng cấp l&ecirc;n 120 Hz mượt m&agrave;, cảm biến camera c&oacute; k&iacute;ch thước lớn hơn, c&ugrave;ng hiệu năng mạnh mẽ với sức mạnh đến từ Apple A15 Bionic, sẵn s&agrave;ng c&ugrave;ng bạn chinh phục mọi thử th&aacute;ch.</h3>\r\n\r\n<h3><strong>Thiết kế đẳng cấp h&agrave;ng đầu</strong></h3>\r\n\r\n<p>iPhone mới kế thừa thiết kế đặc trưng từ&nbsp;iPhone 12 Pro Max khi sở hữu khung viền vu&ocirc;ng vức, mặt lưng k&iacute;nh c&ugrave;ng m&agrave;n h&igrave;nh tai thỏ tr&agrave;n viền nằm ở ph&iacute;a trước.</p>\r\n\r\n<p>Với iPhone 13 Pro Max phần tai thỏ đ&atilde; được thu gọn lại 20% so với thế hệ trước, kh&ocirc;ng chỉ giải ph&oacute;ng nhiều kh&ocirc;ng gian hiển thị hơn m&agrave; c&ograve;n gi&uacute;p mặt trước chiếc&nbsp;điện thoại&nbsp;trở n&ecirc;n hấp dẫn hơn m&agrave; vẫn đảm bảo được hoạt động của c&aacute;c cảm biến.</p>\r\n\r\n<p>Điểm thay đổi dễ d&agrave;ng nhận biết tr&ecirc;n iPhone 13 Pro Max ch&iacute;nh l&agrave; k&iacute;ch thước của cảm biến camera sau được l&agrave;m to hơn v&agrave; để tăng độ nhận diện cho sản phẩm mới th&igrave; Apple cũng đ&atilde; bổ sung một t&ugrave;y chọn m&agrave;u sắc&nbsp;Sierra Blue (m&agrave;u xanh dương nhạt hơn so với Pacific Blue của iPhone 12 Pro Max).</p>\r\n\r\n<p>M&aacute;y vẫn tiếp tục sử dụng khung viền th&eacute;p cao cấp cho khả năng chống trầy xước v&agrave; va đập một c&aacute;ch vượt trội, kết hợp với khả năng kh&aacute;ng bụi, nước&nbsp;chuẩn IP68.</p>\r\n\r\n<h3><strong>M&agrave;n h&igrave;nh giải tr&iacute; si&ecirc;u mượt c&ugrave;ng tần số qu&eacute;t 120 Hz</strong></h3>\r\n\r\n<p>iPhone 13 Pro Max được trang bị m&agrave;n h&igrave;nh k&iacute;ch thước 6.7 inch c&ugrave;ng độ ph&acirc;n giải 1284 x 2778 Pixels, sử dụng tấm nền OLED c&ugrave;ng c&ocirc;ng nghệ Super Retina XDR cho khả năng tiết kiệm năng lượng vượt trội nhưng vẫn đảm bảo hiển thị sắc n&eacute;t sống động ch&acirc;n thực.</p>\r\n\r\n<p>iPhone Pro Max năm nay đ&atilde; được n&acirc;ng cấp l&ecirc;n tần số qu&eacute;t 120 Hz, mọi thao t&aacute;c chuyển cảnh khi lướt ng&oacute;n tay tr&ecirc;n m&agrave;n h&igrave;nh trở n&ecirc;n mượt m&agrave; hơn đồng thời hiệu ứng thị gi&aacute;c khi ch&uacute;ng ta chơi game hoặc xem video cũng cực kỳ m&atilde;n nh&atilde;n.</p>\r\n\r\n<p>C&ugrave;ng c&ocirc;ng nghệ ProMotion th&ocirc;ng minh c&oacute; thể thay đổi tần số qu&eacute;t từ 10 đến 120 lần mỗi gi&acirc;y t&ugrave;y thuộc v&agrave;o ứng dụng, thao t&aacute;c bạn đang sử dụng, nhằm tối ưu thời lượng sử dụng pin v&agrave; trải nghiệm của bạn.</p>\r\n\r\n<p>Nếu bạn d&ugrave;ng iPhone 13 Pro Max để chơi game, tần số qu&eacute;t 120 Hz kết hợp hiệu suất đồ họa tuyệt vời của GPU sẽ khiến m&aacute;y trở n&ecirc;n v&ocirc; c&ugrave;ng ho&agrave;n hảo khi trải nghiệm.</p>\r\n\r\n<h3><strong>Hiệu năng đầy hứa hẹn với Apple A15 Bionic&nbsp;</strong></h3>\r\n\r\n<p>iPhone 13 Pro Max sẽ được trang bị bộ vi xử l&yacute; Apple A15 Bionic mới nhất của h&atilde;ng, được sản xuất tr&ecirc;n tiến tr&igrave;nh 5 nm, đảm bảo mang lại hiệu năng vận h&agrave;nh ấn tượng m&agrave; vẫn tiết kiệm điện tốt nhất c&ugrave;ng khả năng hỗ trợ mạng 5G tốc độ si&ecirc;u cao.</p>\r\n\r\n<p>Theo Apple c&ocirc;ng bố, A15 Bionic l&agrave; chipset nhanh nhất trong thế giới smartphone (9/2021), c&oacute;&nbsp;tốc độ nhanh hơn 50% so với c&aacute;c chip kh&aacute;c tr&ecirc;n thị trường, c&oacute; thể thực hiện 15.8 ngh&igrave;n tỷ ph&eacute;p t&iacute;nh mỗi gi&acirc;y, gi&uacute;p hiệu năng CPU nhanh hơn bao giờ hết.</p>\r\n\r\n<p>M&aacute;y sở hữu bộ nhớ trong 128 GB, vừa đủ với nhu cầu sử dụng của một người d&ugrave;ng cơ bản, kh&ocirc;ng c&oacute; nhu cầu quay video qu&aacute; nhiều, ngo&agrave;i ra năm nay cũng c&oacute; th&ecirc;m phi&ecirc;n bản bộ nhớ trong l&ecirc;n đến 1TB, bạn c&oacute; thể c&acirc;n nhắc nếu c&oacute; nhu cầu lưu trữ cao.</p>\r\n\r\n<p>Ngo&agrave;i ra, m&aacute;y c&ograve;n được t&iacute;ch hợp c&ocirc;ng nghệ Wi-Fi 6, chuẩn kết nối kh&ocirc;ng d&acirc;y mới với việc trang bị nhiều băng tần 5G, tương th&iacute;ch với nhiều nh&agrave; mạng ở c&aacute;c quốc gia kh&aacute;c nhau, iPhone 13 Pro Max lu&ocirc;n cho tốc độ mạng tối đa, cho trải nghiệm xem phim 4K mượt m&agrave;, tải tệp tin trong chớp mắt, chơi game online kh&ocirc;ng độ trễ ở bất cứ đ&acirc;u.</p>\r\n\r\n<h3><strong>Bước nhảy vọt về thời lượng pin</strong></h3>\r\n\r\n<p>iPhone Pro Max đ&aacute;nh dấu bước ngoặt mới trong thời lượng pin sử dụng. Với vi&ecirc;n pin dung lượng pin lớn kết hợp c&ugrave;ng m&agrave;n h&igrave;nh mới v&agrave; bộ vi xử l&yacute; Apple A15 Bionic tiết kiệm điện, gi&uacute;p iPhone 13 Pro Max trở th&agrave;nh chiếc iPhone c&oacute; thời lượng pin tốt nhất từ trước đến nay, d&agrave;i hơn 2.5 giờ so với người tiền nhiệm.&nbsp;</p>\r\n\r\n<p>Đ&aacute;ng tiếc l&agrave; dung lượng pin của c&aacute;c mẫu iPhone mới được cải thiện nhưng tốc độ sạc nhanh của ch&uacute;ng vẫn chỉ dừng ở mức 20 W qua kết nối c&oacute; d&acirc;y v&agrave; sạc qua MagSafe ở mức tối đa 15 W hoặc c&oacute; thể qua bộ sạc kh&ocirc;ng d&acirc;y dựa tr&ecirc;n Qi với c&ocirc;ng suất 7.5 W.</p>\r\n\r\n<p>Apple đ&atilde; kh&ocirc;ng ngừng cải tiến đem đến cho người d&ugrave;ng sản phẩm tốt nhất, iPhone 13 Pro Max 128GB vẫn giữ được c&aacute;c điểm nổi bật của người tiền nhiệm, nổi bật với cải tiến về cấu h&igrave;nh, thời lượng pin cũng như camera v&agrave; nhiều điều c&ograve;n chờ bạn kh&aacute;m ph&aacute;.</p>', 0, 1, 1, '2022-11-09 05:53:58', '2022-11-09 05:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `image`, `url`, `status`) VALUES
(1, 'dt', '800-200-800x200-958058.png', 'dt', 0),
(2, 'dt1', '800-200-800x200-137806.png', 'dt1', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `comment_parent_id` (`comment_parent_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brands_id` (`brand_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `comments_ibfk_4` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `comments_ibfk_5` FOREIGN KEY (`comment_parent_id`) REFERENCES `comments` (`id`);

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
