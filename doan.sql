-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2022 at 10:12 AM
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
(1, 'Admin', 'hoangphuong0813@gmail.com', '9256f07cf3c731a53e71937461aa7950', '0356929673', 'OWmQoWK5XP3TDsze');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `title`, `status`, `customer_id`, `product_id`, `admin_id`, `comment_parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Điện thoại đẹp quá', 0, 1, 22, NULL, NULL, '2022-11-03 08:46:27', '2022-11-03 10:11:21'),
(13, 'Cám ơn bạn nha', 0, NULL, 22, 1, 1, '2022-11-13 16:12:59', '2022-11-13 16:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `fullname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `customers` (`id`, `fullname`, `email`, `password`, `phone`, `address`, `status`, `customer_token`, `google_id`, `facebook_id`, `provider`) VALUES
(1, 'Hoang Phuong', 'hoangphuong0813@gmail.com', '$2y$10$6HGrjKFoLBvGPw9yTWVxFuJ6WvuhUi2MU93/4XeNwNP.vbBtAcsJm', '0356929673', 'A2/47a, Ấp 1 Xã Phong Phú-Huyện Bình Chánh-Hồ Chí Minh', 0, 'dfyh45bdItFhoITh', NULL, NULL, NULL),
(2, 'Phương', '', NULL, NULL, NULL, 0, NULL, NULL, '3330089617264301', 'facebook'),
(15, 'Phuong Bui Hoang', 'dh51805388@student.stu.edu.vn', NULL, NULL, NULL, 0, NULL, '105129479750824051899', NULL, 'google');

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
(6, 'vi-vn-iphone-11-tinhnang2475.jpg', 'vi-vn-iphone-11-tinhnang2475.jpg', 22),
(7, 'samsung-galaxy-z-flip4-note-1-11852.jpg', 'samsung-galaxy-z-flip4-note-1-11852.jpg', 24),
(8, 'samsung-galaxy-z-flip4-tim-128gb-26421.jpg', 'samsung-galaxy-z-flip4-tim-128gb-26421.jpg', 24),
(9, 'samsung-galaxy-z-flip4-tim-128gb-39249.jpg', 'samsung-galaxy-z-flip4-tim-128gb-39249.jpg', 24),
(10, 'iphone-13-pro-xanh-xa-19102.jpg', 'iphone-13-pro-xanh-xa-19102.jpg', 23),
(11, 'iphone-13-pro-xanh-xa-2423.jpg', 'iphone-13-pro-xanh-xa-2423.jpg', 23),
(12, 'iphone-13-pro-xanh-xa-32853.jpg', 'iphone-13-pro-xanh-xa-32853.jpg', 23),
(13, 'xiaomi-redmi-note-11-43002.jpg', 'xiaomi-redmi-note-11-43002.jpg', 25),
(14, 'xiaomi-redmi-note-11-52294.jpg', 'xiaomi-redmi-note-11-52294.jpg', 25),
(15, 'xiaomi-redmi-note-11-81370.jpg', 'xiaomi-redmi-note-11-81370.jpg', 25),
(16, 'xiaomi-redmi-note-11-91018.jpg', 'xiaomi-redmi-note-11-91018.jpg', 25),
(17, 'xiaomi-redmi-note-11-n-21006.jpg', 'xiaomi-redmi-note-11-n-21006.jpg', 25),
(18, 'iphone-14-pro-tong-quan-1020x570446.jpg', 'iphone-14-pro-tong-quan-1020x570446.jpg', 26),
(19, 'vi-vn-iphone-14-pro--(2)1486.jpg', 'vi-vn-iphone-14-pro--(2)1486.jpg', 26);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_ship` bigint(19) DEFAULT NULL,
  `note` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `payment_method` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_nguoinhan` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_nguoinhan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_nguoinhan` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `price_ship`, `note`, `status`, `payment_method`, `name_nguoinhan`, `phone_nguoinhan`, `address_nguoinhan`, `customer_id`, `created_at`, `updated_at`) VALUES
('589a3', 21000, 'qưe', 3, 'Tiền mặt', 'phuong', '0356929673', 'Xã Phong Phú-Huyện Bình Chánh-Hồ Chí Minh', 1, '2022-11-18 16:55:34', '2022-11-18 16:55:54'),
('925c7', 21000, 'qưe', 1, 'Tiền mặt', 'Phuong', '0356929673', 'A2/47a, Ấp 1-Xã Phong Phú-Huyện Bình Chánh-Hồ Chí Minh', 1, '2022-11-18 17:03:24', '2022-11-18 17:03:24'),
('9cdb8', 128449, 'asd', 3, 'Tiền mặt', 'phuong', '0356929673', 'Xã Phong Phú-Huyện Bình Chánh-Hồ Chí Minh', 2, '2022-11-18 03:04:31', '2022-11-18 03:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `price` bigint(19) NOT NULL,
  `status` int(11) NOT NULL,
  `order_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `number`, `price`, `status`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(37, 1, 20990000, 1, '9cdb8', 24, '2022-11-18 03:04:31', '2022-11-18 03:04:31'),
(38, 1, 28300000, 1, '589a3', 23, '2022-11-18 16:55:34', '2022-11-18 16:55:34'),
(39, 1, 20990000, 1, '925c7', 24, '2022-11-18 17:03:24', '2022-11-18 17:03:24');

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
  `ketnoi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin_sac` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tienich` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thongtin_chung` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `image`, `number`, `price`, `price_sale`, `manhinh`, `mausac`, `camera_sau`, `camera_truoc`, `cpu`, `bonho`, `ram`, `ketnoi`, `pin_sac`, `tienich`, `thongtin_chung`, `height`, `length`, `weight`, `width`, `status`, `brand_id`, `category_id`, `created_at`, `updated_at`) VALUES
(22, 'Điện thoại iPhone 11 64GB', '\"iphone-11-trang-600x6009959.jpg\"', 9, 15000000, 11790000, 'IPS LCD 6.1\" Liquid Retina', 'Trắng', '2 camera 12 MP', '12 MP', 'Apple A13 Bionic', '64GB', '4GB', '1 Nano SIM & 1 eSIMHỗ trợ 4G', '3110 mAh 20 W', 'Bảo mật nâng cao:  Mở khoá khuôn mặt Face ID Tính năng đặc biệt:  Apple Pay Âm thanh Dolby Audio Kháng nước, bụi:  IP68 Ghi âm:  Ghi âm có microphone chuyên dụng chống ồn Xem phim:  H.264(MPEG4-AVC) Nghe nhạc:  AAC  MP3  Lossless  FLAC', '<h2><strong>Thông tin sản phẩm</strong></h2>\r\n\r\n<h3>Apple đã chính thức trình làng bộ 3 siêu phẩm iPhone 11, trong đó phiên bản iPhone 11 64GB có mức giá rẻ nhất nhưng vẫn được nâng cấp mạnh mẽ như iPhone Xr ra mắt trước đó.</h3>\r\n\r\n<h3><strong>Nâng cấp mạnh mẽ về camera</strong></h3>\r\n\r\n<p>Nói về nâng cấp thì camera chính là điểm có nhiều cải tiến nhất trên thế hệ iPhone mới.</p>\r\n\r\n<p>Nếu như trước đây iPhone Xr chỉ có một camera thì nay với iPhone 11 chúng ta sẽ có tới hai camera ở mặt sau.</p>\r\n\r\n<p>Ngoài camera chính vẫn có độ phân giải 12 MP thì chúng ta sẽ có thêm một camera góc siêu rộng và cũng với độ phân giải tương tự.</p>\r\n\r\n<h3><strong>Hiệu năng mạnh mẽ hàng đầu thế giới</strong></h3>\r\n\r\n<p>Mỗi lần ra iPhone mới là mỗi lần Apple mang đến cho người dùng một trải nghiệm về hiệu năng \"chưa từng có\".</p>\r\n\r\n<p>Trên iPhone 11 mới Apple nâng cấp con chip của mình lên thế hệ Apple A13 Bionic rất mạnh mẽ.</p>\r\n\r\n<p>Chiếc iPhone này cũng được nâng cấp dung lượng RAM 4 GB thay vì 3 GB như thế hệ trước đó.</p>\r\n\r\n<p>Ở mức cấu hình trên giúp điện thoại chơi game tốt với các tựa game phổ biến hiện nay một cách mượt mà, ổn định. Mọi thao tác trên iPhone mới cũng cho tốc độ phản hồi nhanh mà bạn gần như sẽ không cảm nhận được sự giật lag cho dù có sử dụng trong một thời gian dài.</p>\r\n\r\n<p>Phiên bản iOS 15 (12/2021) đi kèm với chiếc iPhone này cũng được trang bị nhiều tính năng hơn giúp bạn sử dụng chiếc iPhone hiệu quả hơn.</p>\r\n\r\n<p>Face ID trên iPhone 11 cũng được cải tiến để có thể nhận diện ở nhiều góc độ hơn và tốc độ phản hồi nhanh hơn.</p>\r\n\r\n<h3><strong>Những thay đổi về thiết kế theo hướng tích cực</strong></h3>\r\n\r\n<p>Chúng ta sẽ có một mặt lưng hoàn thiện dưới dạng kính và Apple nói rằng họ đã sử dụng loại kính bền nhất từ trước tới nay cho chiếc iPhone này.</p>\r\n\r\n<p>Camera kép trên iPhone mới cũng được thiết kế lại và tin vui là nó sẽ bớt lồi hơn so với trên iPhone Xr trước đây.</p>\r\n\r\n<p>Điểm nhấn về cụm camera to bản ở mặt sau sẽ giúp người khác dễ dàng nhận biết bạn đang sử dụng một chiếc iPhone 11 trên tay.</p>\r\n\r\n<p>Logo quả táo truyền thống của Apple nay đã được di chuyển về phần chính giữa của mặt lớn thay vì đặt lệch về phía cạnh trên như những đời iPhone trước đó.</p>\r\n\r\n<p>Apple cho biết họ đã hoàn thiện trên iPhone mới để nó cho khả năng chống nước tốt hơn và người dùng có thể yên tâm về điều đó. </p>\r\n\r\n<h3><strong>Thời lượng pin tốt nhất từ trước tới nay</strong></h3>\r\n\r\n<p>Khi nói đến thời lượng pin iPhone 11, hẳn nhiều người đã ước ao rằng máy sẽ có viên pin tốt giống như iPhone Xr (có thời lượng pin tốt nhất so với bất kỳ iPhone hiện đại nào).</p>\r\n\r\n<p>Tuy nhiên bạn sẽ còn có một chiếc máy thậm chí còn tốt hơn nữa.</p>\r\n\r\n<p>Theo Apple thì chiếc iPhone mới sẽ có thời lượng pin trâu hơn 1 giờ so với chiếc iPhone Xr.</p>\r\n\r\n<p>Như vậy với iPhone mới bạn hoàn toàn có thể sử dụng máy lên tới 2 ngày mà không cần lo lắng việc thiết bị sẽ hết pin giữa chừng.</p>\r\n\r\n<p>Tất nhiên máy cũng sẽ hỗ trợ công nghệ sạc nhanh nhưng bạn phải mua thêm củ sạc bên ngoài để có thể sử dụng tính năng này.</p>\r\n\r\n<p>Với chừng đó tính năng, chừng đó cải tiến thì chiếc iPhone 11 này tự tin sẽ là một đối thủ đáng gờm với những chiếc flagship đến từ các hãng Android đang có mặt trên thị trường.</p>', 0, 0, 0, 0, 0, 1, 1, '2022-11-16 07:56:42', '2022-11-16 18:58:46'),
(23, 'Điện thoại iPhone 13 Pro Max 128GB', '\"iphone-13-pro-max-xanh-la-thumb-600x6008822.jpg\"', 7, 34000000, 28300000, 'OLED 6.7\" Super Retina XDR', 'Xám', '3 camera 12 MP', '12 MP', 'Apple A15 Bionic', '128GB', '8GB', '1 Nano SIM & 1 eSIMHỗ trợ 5G', '5000 mAh 15 W', 'Bảo mật nâng cao:  Mở khoá khuôn mặt  Face ID Kháng nước, bụi:  IP68 Ghi âm:  Ghi âm có microphone chuyên dụng chống ồn Xem phim:  H.264(MPEG4-AVC) Nghe nhạc:  AAC  Lossless  FLAC', '<h2><strong>Thông tin sản phẩm</strong></h2>\r\n\r\n<h3>Điện thoại iPhone 13 Pro Max 128 GB - siêu phẩm được mong chờ nhất ở nửa cuối năm 2021 đến từ Apple. Máy có thiết kế không mấy đột phá khi so với người tiền nhiệm, bên trong đây vẫn là một sản phẩm có màn hình siêu đẹp, tần số quét được nâng cấp lên 120 Hz mượt mà, cảm biến camera có kích thước lớn hơn, cùng hiệu năng mạnh mẽ với sức mạnh đến từ Apple A15 Bionic, sẵn sàng cùng bạn chinh phục mọi thử thách.</h3>\r\n\r\n<h3><strong>Thiết kế đẳng cấp hàng đầu</strong></h3>\r\n\r\n<p>iPhone mới kế thừa thiết kế đặc trưng từ iPhone 12 Pro Max khi sở hữu khung viền vuông vức, mặt lưng kính cùng màn hình tai thỏ tràn viền nằm ở phía trước.</p>\r\n\r\n<p>Với iPhone 13 Pro Max phần tai thỏ đã được thu gọn lại 20% so với thế hệ trước, không chỉ giải phóng nhiều không gian hiển thị hơn mà còn giúp mặt trước chiếc điện thoại trở nên hấp dẫn hơn mà vẫn đảm bảo được hoạt động của các cảm biến.</p>\r\n\r\n<p>Điểm thay đổi dễ dàng nhận biết trên iPhone 13 Pro Max chính là kích thước của cảm biến camera sau được làm to hơn và để tăng độ nhận diện cho sản phẩm mới thì Apple cũng đã bổ sung một tùy chọn màu sắc Sierra Blue (màu xanh dương nhạt hơn so với Pacific Blue của iPhone 12 Pro Max).</p>\r\n\r\n<p>Máy vẫn tiếp tục sử dụng khung viền thép cao cấp cho khả năng chống trầy xước và va đập một cách vượt trội, kết hợp với khả năng kháng bụi, nước chuẩn IP68.</p>\r\n\r\n<h3><strong>Màn hình giải trí siêu mượt cùng tần số quét 120 Hz</strong></h3>\r\n\r\n<p>iPhone 13 Pro Max được trang bị màn hình kích thước 6.7 inch cùng độ phân giải 1284 x 2778 Pixels, sử dụng tấm nền OLED cùng công nghệ Super Retina XDR cho khả năng tiết kiệm năng lượng vượt trội nhưng vẫn đảm bảo hiển thị sắc nét sống động chân thực.</p>\r\n\r\n<p>iPhone Pro Max năm nay đã được nâng cấp lên tần số quét 120 Hz, mọi thao tác chuyển cảnh khi lướt ngón tay trên màn hình trở nên mượt mà hơn đồng thời hiệu ứng thị giác khi chúng ta chơi game hoặc xem video cũng cực kỳ mãn nhãn.</p>\r\n\r\n<p>Cùng công nghệ ProMotion thông minh có thể thay đổi tần số quét từ 10 đến 120 lần mỗi giây tùy thuộc vào ứng dụng, thao tác bạn đang sử dụng, nhằm tối ưu thời lượng sử dụng pin và trải nghiệm của bạn.</p>\r\n\r\n<p>Nếu bạn dùng iPhone 13 Pro Max để chơi game, tần số quét 120 Hz kết hợp hiệu suất đồ họa tuyệt vời của GPU sẽ khiến máy trở nên vô cùng hoàn hảo khi trải nghiệm.</p>\r\n\r\n<h3><strong>Hiệu năng đầy hứa hẹn với Apple A15 Bionic </strong></h3>\r\n\r\n<p>iPhone 13 Pro Max sẽ được trang bị bộ vi xử lý Apple A15 Bionic mới nhất của hãng, được sản xuất trên tiến trình 5 nm, đảm bảo mang lại hiệu năng vận hành ấn tượng mà vẫn tiết kiệm điện tốt nhất cùng khả năng hỗ trợ mạng 5G tốc độ siêu cao.</p>\r\n\r\n<p>Theo Apple công bố, A15 Bionic là chipset nhanh nhất trong thế giới smartphone (9/2021), có tốc độ nhanh hơn 50% so với các chip khác trên thị trường, có thể thực hiện 15.8 nghìn tỷ phép tính mỗi giây, giúp hiệu năng CPU nhanh hơn bao giờ hết.</p>\r\n\r\n<p>Máy sở hữu bộ nhớ trong 128 GB, vừa đủ với nhu cầu sử dụng của một người dùng cơ bản, không có nhu cầu quay video quá nhiều, ngoài ra năm nay cũng có thêm phiên bản bộ nhớ trong lên đến 1TB, bạn có thể cân nhắc nếu có nhu cầu lưu trữ cao.</p>\r\n\r\n<p>Ngoài ra, máy còn được tích hợp công nghệ Wi-Fi 6, chuẩn kết nối không dây mới với việc trang bị nhiều băng tần 5G, tương thích với nhiều nhà mạng ở các quốc gia khác nhau, iPhone 13 Pro Max luôn cho tốc độ mạng tối đa, cho trải nghiệm xem phim 4K mượt mà, tải tệp tin trong chớp mắt, chơi game online không độ trễ ở bất cứ đâu.</p>\r\n\r\n<h3><strong>Bước nhảy vọt về thời lượng pin</strong></h3>\r\n\r\n<p>iPhone Pro Max đánh dấu bước ngoặt mới trong thời lượng pin sử dụng. Với viên pin dung lượng pin lớn kết hợp cùng màn hình mới và bộ vi xử lý Apple A15 Bionic tiết kiệm điện, giúp iPhone 13 Pro Max trở thành chiếc iPhone có thời lượng pin tốt nhất từ trước đến nay, dài hơn 2.5 giờ so với người tiền nhiệm. </p>\r\n\r\n<p>Đáng tiếc là dung lượng pin của các mẫu iPhone mới được cải thiện nhưng tốc độ sạc nhanh của chúng vẫn chỉ dừng ở mức 20 W qua kết nối có dây và sạc qua MagSafe ở mức tối đa 15 W hoặc có thể qua bộ sạc không dây dựa trên Qi với công suất 7.5 W.</p>\r\n\r\n<p>Apple đã không ngừng cải tiến đem đến cho người dùng sản phẩm tốt nhất, iPhone 13 Pro Max 128GB vẫn giữ được các điểm nổi bật của người tiền nhiệm, nổi bật với cải tiến về cấu hình, thời lượng pin cũng như camera và nhiều điều còn chờ bạn khám phá.</p>', 0, 0, 0, 0, 0, 1, 1, '2022-11-16 07:35:18', '2022-11-18 16:55:54'),
(24, 'Điện thoại Samsung Galaxy Z Flip4 128GB', '\"samsung-galaxy-z-flip4-5g-128gb-thumb-tim-600x6003276.jpg\"', 8, 23990000, 20990000, 'Chính: Dynamic AMOLED 2X, Phụ: Super AMOLED Chính 6.7\" & Phụ 1.9\" Full HD+', 'Tím', '2 camera 12 MP', '10 MP', 'Snapdragon 8+ Gen 1', '128GB', '8GB', 'Mạng di động:  Hỗ trợ 5G SIM:  1 Nano SIM & 1 eSIM Wifi: Dual-band (2.4 GHz/5 GHz)  Wi-Fi 802.11 a/b/g/n/ac/ax  6 GHz  Wi-Fi MIMO  GPS: GPS  GALILEO  GLONASS  QZSS  BEIDOU  Bluetooth: v5.2 Cổng kết nối/sạc:  Type-C Jack tai nghe:  Type-C Kết nối khác:  OTGNFC', '3700 mAh 25 W', 'Bảo mật nâng cao:  Mở khoá vân tay cạnh viền Mở khoá khuôn mặt Tính năng đặc biệt:  Samsung DeX (Kết nối màn hình sử dụng giao diện tương tự PC)  Thu nhỏ màn hình sử dụng một tay  Đa cửa sổ (chia đôi màn hình)  Màn hình luôn hiển thị AOD  Trợ lý ảo Samsung Bixby  Ứng dụng kép (Dual Messenger)  Tối ưu game (Game Booster)  Samsung Pay  Chế độ trẻ em (Samsung Kids)  Âm thanh Dolby Atmos  Chế độ đơn giản (Giao diện đơn giản)  Kháng nước, bụi:  IPX8 Ghi âm:  Ghi âm mặc địnhGhi âm cuộc gọi', '<h3 style=\"margin: 20px 0px 15px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 28px; outline: none;\"><span style=\"transition-duration: 0.2s; transition-property: all; font-stretch: normal; line-height: 18px; outline-color: initial; outline-width: initial;\"><b style=\"\"><font color=\"#000000\" style=\"\">Samsung Galaxy Z Flip4 128GB</font></b></span><b style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 20px;\"> đã chính thức ra mắt thị trường công nghệ, đánh dấu sự trở lại của Samsung trên con đường định hướng người dùng về sự tiện lợi trên những chiếc điện thoại gập. Với độ bền được gia tăng cùng kiểu thiết kế đẹp mắt giúp Flip4 trở thành một trong những tâm điểm sáng giá cho nửa cuối năm 2022.</b></h3><h3 style=\"margin: 20px 0px 15px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 20px; line-height: 28px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none; text-align: justify;\">Dẫn đầu xu hướng thiết kế mới </h3><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Có lẽ điện thoại gập đã không còn là cái tên quá xa lạ bởi nhiều ông lớn trong ngành sản xuất thiết bị di động đã cho ra mắt khá nhiều sản phẩm có thiết kế tương tự, gần đây nhất thì có sự góp mặt của chiếc flagship đến từ nhà Samsung mang tên Galaxy Z Flip4. </p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Ngay từ những giây phút đầu tiên sử dụng chiếc Galaxy Z Flip4 mình đã cảm nhận được sự khác biệt của nó so với thế hệ trước, máy bây giờ đã vuông vắn hơn nhờ tạo hình vát phẳng ở hai mặt và các cạnh.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Phần mặt lưng của máy được phủ một lớp nhám nhẹ giúp cho mình có thể cầm nắm chắc tay hơn, hạn chế được tình trạng bám dấu vân tay trong quá trình sử dụng. </p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><font color=\"#333333\">Theo như hãng công bố thì phiên bản </font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all;\">điện thoại Galaxy Z</span></font><font color=\"#333333\"> này có thể gập lên đến 200.000 lần liên tục trong phòng thí nghiệm. Nếu trung bình một ngày bạn gập, mở máy khoảng 50 lần thì mất khoảng 10 năm thì mới có thể đạt đến số lần gập này.</font></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: rgb(51, 51, 51);\">Bộ khung và bản lề của sản phẩm được hoàn thiện từ vật liệu Armor Aluminum cứng cáp. Liên kết giữa các chi tiết được làm khít lại để giúp máy có thể kháng nước tốt hơn với chuẩn IPX8, từ đó giúp Galaxy Z Flip4 trở thành chiếc </span><span style=\"transition-duration: 0.2s; transition-property: all;\"><font color=\"#000000\" style=\"\">điện thoại</font></span><span style=\"color: rgb(51, 51, 51);\"> gập bền bỉ nhất.</span><font color=\"#333333\"><br></font></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><font color=\"#333333\">Với những thông tin trên cho thấy Samsung Galaxy Z Flip4 là một chiếc </font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all; background-color: rgb(255, 255, 255);\">điện thoại kháng nước, bụi</span></font><font color=\"#333333\"> có độ bền rất cao, vì thế bạn hoàn toàn có thể an tâm trong việc sử dụng thiết bị một khoảng thời gian dài.</font></p><h3 style=\"margin: 20px 0px 15px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 20px; line-height: 28px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none; text-align: justify;\">Nâng tầm trải nghiệm smartphone </h3><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Với một người thích sử dụng những chiếc điện thoại màn hình lớn như mình thì trở ngại thường gặp đó chính là kích thước máy khá to, gây khó khăn cho mình trong những lúc bỏ vào túi. Thế nhưng điều này lại được khắc phục hoàn toàn trên chiếc Galaxy Z Flip4 bởi sau khi gập thì chiều dài của máy chỉ còn khoảng 84.9 mm.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Với kích thước nhỏ gọn như vậy thì máy dễ dàng nằm gọn trong lòng bàn tay, đây được xem là một sản phẩm rất thích hợp dành cho những bạn nữ mong muốn có cho mình một thiết bị có màn hình lớn nhưng vẫn đáp ứng được tiêu chí nhỏ gọn và thời trang.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Một điểm hay trên phiên bản này là về giao diện chụp ảnh chia đôi màn hình đã hỗ trợ trên ứng dụng camera bên thứ 3, giờ đây khung hình hiển thị màn chụp sẽ được thu nhỏ và nằm vừa vặn bên trong nửa màn hình còn lại để mình dễ dàng theo dõi chất lượng ảnh, từ đó có thể chủ động hơn trong việc điều chỉnh góc chụp.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Hơn nữa, bạn có thể selfie bằng cụm camera sau để nâng cao chất lượng ảnh một cách dễ dàng nhờ có màn hình phụ.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Một điểm hay nữa ở phần màn hình phụ mà mình muốn chia sẻ với các bạn là ở phần tính năng hiển thị, Galaxy Z Flip4 có thể đem đến nhiều thông tin và tiện ích để bạn có thể sử dụng nhanh chóng mà không cần mở thiết bị, nổi bật trong số đó có thể kể đến như: Nhạc, lịch, thời tiết, gọi trực tiếp,...</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Điều nâng cấp ở phiên bản này so với thế hệ trước là giờ đây Galaxy Z Flip4 có thể giúp bạn nhận trực tiếp cuộc gọi từ màn hình phụ (hỗ trợ nghe loa ngoài), trả lời tin nhắn bằng văn bản soạn sẵn. </p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100357.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><font color=\"#333333\">Để màn hình phụ trở nên thú vị hơn thì hãng </font><font color=\"#000000\" style=\"background-color: rgb(255, 255, 255);\"><font style=\"\"><span style=\"transition-duration: 0.2s; transition-property: all;\">điện thoại Samsung</span></font> </font><span style=\"color: rgb(51, 51, 51);\">đã bổ sung rất nhiều kiểu màn hình để bạn có thể tùy biến giao diện theo ý thích cá nhân. Không những thế, việc cài đặt màn hình mang dấu ấn cá nhân cũng đã tạo thêm điểm nhấn cho chiếc máy ở phần mặt lưng.</span></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100358.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><h3 style=\"margin: 20px 0px 15px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 20px; line-height: 28px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none; text-align: justify;\">Sở hữu màn hình cao cấp</h3><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Màn hình chính được trang bị một tấm nền Dynamic AMOLED 2X có độ phân giải Full HD+ (2640 x 1080 Pixels), ảnh cho ra sẽ có màu sắc rực rỡ và nhìn rất trong trẻo, mọi nội dung đều được tái hiện sắc nét.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Nếu như chỉ sử dụng điện thoại cho những tác vụ cơ bản thì dường như mình ít cảm nhận được sự khác biệt rõ rệt, đặc biệt là khi so sánh với những tấm nền Super AMOLED của các thiết bị đến từ nhà Samsung trước đây.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100400.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Tuy nhiên sau khi mình chơi những tựa game có đồ họa nhiều màu sắc và hiệu ứng hình ảnh như Liên Quân Mobile, xem những bộ phim bom tấn đến từ Marvel thì mọi thứ dường như đã làm mình choáng ngợp. Màu sắc phải nói là rất đã mắt và chân thực.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100402.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Màn hình chính có kích thước đến 6.7-inch nên ta hoàn toàn có thể sử dụng đồng thời hai app bằng tính năng chia đôi màn hình. Ngoài ra khi chơi game mình cũng cảm thấy thoải mái hơn bởi các phím chức năng được bố trí cách xa với nhau mà không làm che đi quá nhiều phần hiển thị, lúc thao tác cũng hạn chế được tình trạng ấn nhầm.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Nhờ có độ sáng tối đa lên tới 1200 nits nên khi sử dụng ngoài trời mình cũng cảm thấy dễ dàng hơn, tuy nhiên nếu dùng máy ở mức sáng này liên tục trong khoảng thời gian dài sẽ làm giảm thời lượng dùng của viên pin.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100404.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Nhờ có tần số quét 120 Hz trên tấm nền Dynamic AMOLED 2X nên mọi thao tác vuốt chạm ở phần màn hình được phản hồi nhanh chóng và hết sức mượt mà. Galaxy Z Flip4 có khả năng tự động điều chỉnh tần số quét từ 1 - 120 Hz phụ thuộc vào tác vụ sử dụng, nhằm tiết kiệm điện năng tiêu thụ.</p><h3 style=\"margin: 20px 0px 15px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 20px; line-height: 28px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none; text-align: justify;\">Ảnh chụp bắt trọn vẻ đẹp từ mọi khung cảnh</h3><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Điện thoại được trang bị hai camera sau có cùng độ phân giải 12 MP với rất nhiều tính năng chụp ảnh chuyên nghiệp, giúp mình có thể thỏa sức khám phá vẻ đẹp của khung cảnh qua nhiều kiểu ảnh khác nhau.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100405.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Đầu tiên là đến với phần chụp ảnh bằng chế độ mặc định, ảnh cho ra có độ chi tiết cao nên dù mình có phóng to lên 30% thì ảnh vẫn chưa xuất hiện tình trạng vỡ ảnh.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100407.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a><i style=\"margin: 0px; padding: 0px;\">*Ảnh chụp nguyên bản</i></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100409.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><i style=\"margin: 0px; padding: 0px;\">*Ảnh chụp sau khi phóng to</i></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Với những tình huống chụp ảnh ngoài trời khi cường độ ánh sáng cao làm cho bức ảnh có khả năng bị cháy sáng thì Galaxy Z Flip4 sẽ tự động điều chỉnh và cân bằng ánh sáng, ảnh sau khi chụp sẽ được load trong 1 đến 3 giây để máy có thể sử dụng thuật toán xử lý ảnh thông minh giúp bức ảnh trở nên hài hòa hơn.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100410.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Ở những khung cảnh có vùng tối - sáng chênh lệch nhau quá nhiều thì Galaxy Z Flip4 cũng có thể đem đến cho bạn một bức ảnh đẹp mắt, những vùng tối sẽ được nâng sáng lên đôi chút và tương tự vùng sáng cũng sẽ được giảm lại để cân bằng với nhau.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100412.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Tính năng mà mình ấn tượng nhất chính là chụp ảnh xóa phông trên camera sau, chủ thể được tách nền cực kỳ mịn ở môi trường đủ sáng, với cảnh chụp có nhiều chi tiết nhỏ thì máy vẫn có thể xử lý và tách nền hiệu quả.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100414.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Chuyển qua phần camera góc siêu rộng thì ảnh thu nhiều không gian hơn, phù hợp để chụp những khung ảnh rộng lớn. Chất lượng ảnh ở các góc không bị bóp méo quá nhiều.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100416.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Nhờ có chế độ chụp ảnh zoom nên khi mình chụp các vật thể ở khoảng cách xa bằng Samsung Galaxy Z Flip4 cũng trở nên dễ dàng hơn, tiết kiệm thời gian khi không phải thường xuyên di chuyển để chọn góc chụp, nhưng chất lượng ảnh cho ra vẫn có độ chi tiết cao.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100418.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Nói đến phần chụp ảnh đêm trên Galaxy Z Flip4 phải nói là rất tốt khi hiện tượng nhiễu hạt dường như không xuất hiện trên bức ảnh (ảnh gốc), tình trạng cháy sáng ở những nơi có độ sáng cao cũng được cải thiện so với thế hệ trước.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100420.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Tuy nhiên khả năng thu sáng của máy theo mình cảm nhận là chưa được tốt cho lắm, nhìn tổng quan vẫn còn khá tối ở những vùng thiếu sáng.</p><h3 style=\"margin: 20px 0px 15px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 20px; line-height: 28px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none; text-align: justify;\">Sức mạnh đáng kinh ngạc đến từ Qualcomm</h3><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Trang bị trên chiếc flagship này là một bộ vi xử lý cao cấp mới nhất đến từ nhà Qualcomm với tên gọi Snapdragon 8+ Gen 1 và xung nhịp tối đa đạt vào khoảng 3.18 GHz. Mình có test qua một vài phần mềm chấm điểm hiệu năng với những con số sau khi đo được như sau: 1283 (đơn nhân), 3748 (đa nhân) trên Benchmark và 14223 trên PCMark, quả là một con số quá kinh khủng trên giới smartphone.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100422.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><font color=\"#333333\">Đi kèm với CPU mạnh mẽ thì đây cũng là chiếc </font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all; background-color: rgb(255, 255, 255);\">điện thoại RAM 8 GB</span></font><font color=\"#333333\">* chạy trên hệ điều hành Android 12 và được tùy biến riêng theo nhà Samsung, giúp mang lại một giao diện đẹp mắt cũng như nâng cao trải nghiệm trên một chiếc </font><font color=\"#2f80ed\" style=\"color: rgb(51, 51, 51);\"><span style=\"transition-duration: 0.2s; transition-property: all;\">điện thoại chơi game</span></font><font color=\"#333333\">.</font></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100423.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><i style=\"margin: 0px; padding: 0px;\">*Có hỗ trợ tính năng mở rộng RAM lên tới 8 GB</i></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Đến với phần trải nghiệm chơi game thì Snapdragon 8+ Gen 1 đã bộc lộ gần như hết sức mạnh của chip, điều này được minh chứng trong lúc mình chơi tựa game Liên Quân Mobile ở mức đồ họa cao nhất. Hình ảnh cho ra phải nói là cực kỳ đã mắt, màu sắc rực rỡ nên mình có thể cảm nhận được vẻ đẹp trên từng hiệu ứng kỹ năng của nhân vật.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100425.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Về phần trải nghiệm thì Galaxy Z Flip4 mang đến cho mình một sự ổn định xuyên suốt quá trình chơi, tốc độ khung hình sau khi đo bằng phần mềm thì kết quả được ghi nhận vào khoảng 59.8 FPS.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100427.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Còn đối với tựa game PUBG Mobile ở mức đồ họa HDR cùng tốc độ khung hình cực độ, hình ảnh nhân vật và quang cảnh có đổ bóng làm cho mình cảm nhận được sự chân thật trên từng chuyển động. Kèm với đó là sự hỗ trợ đến từ màn hình tần số quét cao nên mọi hiệu ứng di chuyển, giao tranh được xử lý mượt mà hơn rất nhiều.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100428.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Cảm nhận về phần nhiệt độ của máy thì mình thấy Galaxy Z Flip4 không thực sự quá nóng khi được trang bị một con chip có hiệu suất khủng, mọi thứ chỉ dừng ở mức ấm tay sau khi mình chơi game tầm 40 - 50 phút liên tục. Còn đối với các tác vụ phổ thông khác thì nhiệt độ của máy gần như không có sự thay đổi so với bình thường.</p><h3 style=\"margin: 20px 0px 15px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 20px; line-height: 28px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none; text-align: justify;\">Hỗ trợ sạc pin nhanh chóng</h3><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Mình đã từng cho rằng viên pin có dung lượng 3700 mAh sẽ không đủ đáp ứng một ngày sử dụng của mình, nhưng sau khi kiểm chứng bằng cách dùng máy liên tục cho mọi tác vụ từ chụp ảnh, xem phim, lướt web và chơi game thì Galaxy Z Flip4 lại có thể đáp ứng thời lượng sử dụng cho tới 6 tiếng 47 phút* rất ấn tượng.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100430.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><i style=\"margin: 0px; padding: 0px;\">*Thời gian có thể thay đổi tùy vào tác vụ sử dụng</i></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><font color=\"#333333\">Nhờ có công nghệ sạc nhanh 25 W nên mình chỉ mất khoảng 1 giờ 30 phút* là có thể sạc đầy được viên pin trên Galaxy Z Flip4. Với một vài trường hợp gấp cần sử dụng thì chỉ cần đợi 30 phút là mình đã có ngay 37% pin để sử dụng (tất cả đều sạc khi máy ở trạng thái 0% pin). Thực sự là một chiếc </font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all; background-color: rgb(255, 255, 255);\">điện thoại sạc pin nhanh</span></font><font color=\"#333333\"> đáng sắm để tối ưu công việc nhanh chóng.</font></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Chia sẻ pin không dây là tính năng khá tiện lợi đối với một người đang sử dụng một chiếc smartwatch như mình (có hỗ trợ sạc không dây), khi đồng hồ hết pin thì mình chỉ việc đặt thiết bị lên trên mặt lưng của Galaxy Z Flip4 là đã có thể kích hoạt tính năng trên (cần kích hoạt tính năng trước ở trong phần cài đặt).</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><a class=\"preventdefault\" href=\"https://cdn.tgdd.vn/Products/Images/42/258047/samsung-galaxy-z-flip4-230922-100432.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; text-align: justify;\">Là một người dùng trẻ trung năng động hay yêu thích các loại điện thoại dẫn đầu xu hướng thì chiếc Samsung Galaxy Z Flip4 sẽ là cái tên mà bạn không nên bỏ qua, nhờ có cơ chế gập vô cùng độc đáo kèm với bộ thông số kỹ thuật hết sức mạnh mẽ nên máy hứa hẹn sẽ mang đến cho bạn vô vàn trải nghiệm thú vị</p>', NULL, NULL, NULL, NULL, 0, 2, 5, '2022-11-17 15:23:53', '2022-11-18 17:03:24'),
(25, 'Xiaomi Redmi Note 11', '\"Xiaomi-redmi-note-11-black-600x6002214.jpeg\"', 12, 4690000, 4390000, 'AMOLED 6.43\" Full HD+', 'Đen', 'Chính 50 MP & Phụ 8 MP, 2 MP, 2 MP', '13 MP', 'Snapdragon 680', '64GB', '4GB', 'Mạng di động:  Hỗ trợ 4G SIM:  2 Nano SIM Wifi: Wi-Fi DirectWi-Fi 802.11 a/b/g/n/ac GPS: GPS  GALILEO  GLONASS  BEIDOU  Bluetooth: v5.0 Cổng kết nối/sạc:  Type-C Jack tai nghe:  3.5 mm', '5000 mAh 33 W', 'Bảo mật nâng cao:  Mở khoá vân tay cạnh viềnMở khoá khuôn mặt Tính năng đặc biệt:  Loa kép Kháng nước, bụi:  Không có Ghi âm:  Ghi âm mặc định Xem phim:  Có Nghe nhạc:  Có', NULL, 16, 1, 179, 8, 0, 4, 5, '2022-11-19 17:37:00', '2022-11-19 17:37:00'),
(26, 'Điện thoại iPhone 14 Pro 128GB', '\"iphone-14-pro-tim-thumb-600x6008861.jpg\"', 13, 30990000, 30590000, 'OLED6.1\"Super Retina XDR', 'Đen', 'Chính 48 MP & Phụ 12 MP, 12 MP', '12 MP', 'Apple A16 Bionic', '128GB', '6GB', 'Mạng di động:  Hỗ trợ 5G SIM:  1 Nano SIM & 1 eSIM Wifi: Wi-Fi 802.11 a/b/g/n/ac/ax  Wi-Fi hotspot  Wi-Fi MIMO  GPS: GPS  GALILEO  GLONASS  QZSS  BEIDOU  Bluetooth: v5.3 Cổng kết nối/sạc:  Lightning Jack tai nghe:  Lightning Kết nối khác:  NFC', '3200 mAh20 W', 'Bảo mật nâng cao:  Mở khoá khuôn mặt Face ID Tính năng đặc biệt:  Màn hình luôn hiển thị AOD  Chạm 2 lần sáng màn hình  Loa kép  Apple Pay  Phát hiện va chạm (Crash Detection)  Kháng nước, bụi:  IP68 Ghi âm:  Ghi âm mặc định Xem phim:  H.264(MPEG4-AVC) Nghe nhạc:  AAC  MP3  FLAC', NULL, 15, 1, 206, 1, 0, 1, 1, '2022-11-20 07:49:27', '2022-11-20 07:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `image`, `product_id`, `status`) VALUES
(3, 'dt', '800-200-800x200-1289190.png', 26, 0),
(4, 'dt2', 's22-800-200-800x200-34329.png', 24, 0);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
