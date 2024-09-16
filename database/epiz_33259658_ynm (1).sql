-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: sql306.infinityfree.com
-- Thời gian đã tạo: Th5 13, 2024 lúc 11:40 AM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `epiz_33259658_ynm`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `is_paid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_detail`
--

CREATE TABLE `cart_detail` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Have Dinner'),
(2, 'Play Game Together'),
(3, 'Hangout'),
(4, 'Picnic'),
(5, 'Watching Movie Together');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oder`
--

CREATE TABLE `oder` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `stt` enum('available','rented') COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_view` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `dob`, `gender`, `phone_number`, `description`, `price`, `images`, `category_id`, `stt`, `product_view`) VALUES
(1, 'Kim yến', '2003-01-01', 'female', '0123456788', 'Điều quan trọng không phải là anh đang ở đâu,\r\nmà là em đang ở đâu trong trái tim anh', 300000, '5-hot-girl-goi-cam-thu-hut-su-chu-y-trong-thang-3-docx-1617123615041.webp', 2, 'available', 78),
(2, 'Trịnh Ngọc Huyền', '2002-10-20', 'female', '0909158364', 'Vẻ đẹp không nằm trên gò má, mà trên ánh mắt kẻ si tình', 5000000, 'le-phuong-anh-ngosaovn-5-ngoisaovn-w1367-h2048.jpg', 3, 'available', 41),
(3, 'Phương Nga', '2002-08-21', 'female', '0909158721', 'Trái tim em giờ đầy axit, cần anh dung hoà một ít Bazơ', 350000, 'u5-15935680709581348231404.jpg', 1, 'available', 176),
(4, 'Phạm Khánh Thy', '2003-04-16', 'female', '0909153261', 'Đôi khi muốn giả làm gà, để xem anh thịt hay là anh nuôi', 700000, 'grey_hot_girls_long_sleeve_top_1631841931_a1b955a3_progressive.jpg', 4, 'available', 43),
(5, 'Thái Ngọc Hà', '1999-12-31', 'female', '0123456782', 'Tình yêu của em cũng giống như món cháo đêm, vì lúc nào cũng hết lòng', 1000000, 'diem-danh-top-nhung-hotgirl-tren-facebook-2020-11.jpg', 2, 'available', 71),
(6, 'Julia Pham', '1999-01-22', 'female', '0123456222', 'Em gọi anh là đá vì nhìn anh em cũng chỉ muốn đập.', 700000, 'img6.jpg', 4, 'available', 60),
(7, 'Kiều Anh Heyo', '2002-10-10', 'female', '0123456727', 'Người ta trao anh bông dể nhìn nó tàn úa. em trao anh hạt để nhìn nó trổ hoa', 1500000, 'img7.jpeg', 5, 'available', 75),
(8, 'Bảo An', '1997-06-03', 'male', '0123456969', 'Không có gì ngoài đẹp trai, main TOP nhưng thích đi BOT', 300000, 'img8.jpeg', 2, 'available', 50),
(9, 'Trịnh Hoàng Nhi', '1999-12-12', 'female', '0369123030', 'Yêu màu tím, sống nội tâm hay khóc thầm, thích thủ thỉ', 700000, 'img9.jpeg', 3, 'available', 44),
(10, 'Bùi Trí Nhân', '1996-04-16', 'male', '0909151121', 'Con tim anh đang bị đông đá, cần người đập đá cứu anh ra.', 1000000, 'img10.jpeg', 4, 'available', 27),
(11, 'Bảo Thoa', '2003-11-14', 'female', '0969123033', 'Định rủ anh đi ăn tối nhưng lại sợ thành bữa tối của anh.', 400000, 'img11.jpeg', 1, 'available', 72),
(12, 'Phạm Anh Mỹ', '1997-12-31', 'male', '0909153333', 'Đường tình anh thua, đường đua anh chấp hết.', 700000, 'img12.jpeg', 5, 'available', 23),
(13, 'Rio Nguyen', '1996-12-22', 'male', '0973215427', 'Lồng thì anh để nhốt chim\r\nCòn em để nhốt trong tim anh nè.', 1500000, 'img13.jpeg', 2, 'available', 58),
(14, 'Bảo Ngọc', '2000-10-25', 'female', '0369372845', 'Thiếu 500 nghìn là em tròn một củ, thiếu anh nữa là em đủ một đôi.', 400000, 'img14.jpg', 3, 'available', 59),
(15, 'Thương Đỗ', '1998-03-20', 'female', '0916123456', 'Nghe nói anh có nhiều tâm sự, Thật tình cờ… em có cả vạn tâm tư!', 300000, 'img15.jpeg', 1, 'available', 73),
(16, 'Nguyễn Hạnh', '2002-07-20', 'female', '0933763912', 'Trăng kia ai vẽ mà tròn, Lòng anh ai trộm mà hoài nhớ thương.', 400000, 'img16.jpeg', 5, 'available', 62),
(17, 'Nguyễn Hiếu Ngân', '2002-06-20', 'female', '0869482164', 'Trời không xanh, Mây cũng không trắng, Em không say nắng, Em lại say anh', 400000, 'img17.jpeg', 5, 'available', 44),
(18, 'Thành long', '2001-12-21', 'male', '0909155630', 'Thời tiết này yêu anh là hợp lý, em mà bỏ phí thì là em ngu.', 1000000, 'img18.jpeg', 3, 'available', 38),
(19, 'Giang Yến', '1998-02-26', 'female', '0178459280', 'Trứng rán cần mỡ bắp cần bơ, yêu không cần cớ cần cậu cơ', 5000000, 'img19.jpeg', 2, 'available', 31),
(20, 'Ly Nguyen', '2002-03-30', 'female', '0783956254', 'Em thì không thích trà sữa, em chỉ thích trà trộn vào tim anh', 400000, 'img20.png', 1, 'available', 70),
(21, 'Nhi Phụng', '1999-11-20', 'female', '0869483652', 'Em không thích chiều hoàng hôn buông,\r\nem chỉ thích chiều buồn hôn anh.', 700000, 'img21.jpeg', 3, 'available', 37),
(22, 'Phương Anh', '2003-04-01', 'female', '0300257293', 'Trăm năm hút cỏ hút cần, không bằng 1 phút được gần bên em.', 1000000, 'img22.jpeg', 4, 'available', 66),
(23, 'Hà Minh Quang', '2003-08-10', 'male', '0337590497', 'Đừng rủ anh về quê nuôi cá, trồng thêm rau\r\nAnh thích thành phố chật chội, để ta chồng lên nhau.', 1000000, 'img23.jpeg', 1, 'available', 45),
(24, 'Hoàng Vy', '2003-02-26', 'female', '0964246562', 'Ông trời tạo ra địa chấn, để em làm điểm nhấn của đời anh.', 1000000, 'img24.jpeg', 5, 'available', 79),
(25, 'Tiến Linh', '2000-09-12', 'male', '0133774455', 'Cũng muốn mời em đi ăn bún,\r\nmà chỉ sợ thành thú nhún của em', 700000, 'img25.jpeg', 4, 'available', 34),
(34, 'Han Jina ', '2001-08-21', 'female', '0923948514', 'Cho em một cốc trà đào\r\nTiện cho em hỏi lối vào tim anh.', 2000000, 'photo-1-1620357519578885309410.webp', 5, 'available', 92),
(35, 'Võ Ngọc Trâm', '1999-12-02', 'female', '0377458653', 'Đâu cần anh tặng hoa hồng\r\nYêu anh dẫu có xương rồng cũng cam.', 700000, 'vo-ngoc-tran-di-bien12.jpg', 5, 'available', 27),
(36, 'Tiểu Nhi', '2003-03-30', 'male', '0863155231', 'Anh không phải thứ 6, thứ 7\r\nAnh là thứ em yêu!', 500000, 'photo-1-1578368300431366420427.webp', 1, 'available', 69),
(37, 'Miu Nhi', '2003-06-08', 'female', '0346123890', 'Anh ơi em thích đồng hồ\r\nThích luôn cả việc làm bồ của anh.', 1000000, 'bat-ngo-voi-nhan-sac-xinh-nhu-hotgirl-cua-con-gai-nsnd-tran-nhuong-4.jpg', 2, 'available', 32),
(38, 'Trương Gia Hân', '2004-01-22', 'female', '0137593767', 'Cá chép là để om dưa\r\nTim em là để đón đưa anh vào.', 800000, '5024476922473530419630273923347604840442415n-15597309030811868609871.webp', 4, 'available', 24),
(39, 'Uyển Nhi', '2002-11-23', 'female', '0111113722', 'Em đây là dân tổ lái\r\nXi nhan rẽ trái, rẽ nhầm tim anh.', 1000000, 'mot-kieu-vay-ma-mua-han-hai-mau-hotgirl-lien-tuc-gay-bao-boi-cach-khoe-da-thit-tao-bao-ed1-5903074.jpg', 3, 'available', 52),
(43, 'Võ Kim Phúc', '1999-07-04', 'female', '097258175', 'Nụ cười em bao la vũ trụ\r\nMuôn vạn thiên hà lấp lánh trăng sao.', 5000000, '327745424_932591474819540_7276045811892941369_n.jpg', 5, 'available', 35),
(44, 'Tâm An', '2003-11-11', 'male', '0765443255', '2k3 IT mãi đỉnh, Với kỹ năng biến phần mềm thành phần cứng.', 5000, 'taman.jpg', 3, 'available', 60),
(45, 'Phuong Thanh Thảo', '2000-03-02', 'female', '012785937', 'Dễ thương vui tính', 500000, 'hot-girl.jpg', 1, 'available', 35),
(46, 'Lý Phương Thoa', '2000-02-02', 'female', '048736519', 'Virus thì tui không dính\r\nNhưng yêu cậu thì tui dương tính.', 500000, 'hot-girl_8-683x1024.jpg', 2, 'available', 27),
(47, 'Ngọc Thảo', '1988-01-23', 'female', '082745182', 'You là cậu, I là tôi,\r\nYour là của cậu, còn cậu là của tôi.', 10000000, 'photo1658478744850-1658478745126338382813-63794106863683.webp', 5, 'available', 42),
(48, 'Kim Nhung', '2001-02-21', 'female', '0111111300', 'Việc của mình là xanh.\r\nTa chỉ là quả chanh\r\nChờ một người đến vắt.', 800000, 'Anh-gai-xinh-Viet-Nam.jpg', 2, 'available', 33),
(49, 'Thư Phạm', '1999-03-19', 'female', '0827615861', 'Cuộc đời em còn đang dang dở\r\nAnh bước vào che chở có được không?', 1000000, 'b626c36976ac71db521b357a0ae7d3c3.jpg', 5, 'available', 21),
(52, 'Ngân Khánh Trần', '2003-12-16', 'female', '0129837465', 'Cậu ơi trà sữa tôi mời\r\nUống xong cậu nhớ một đời thương tôi.', 700000, 'photo-1619443143266-6008deeee7c2.jpeg', 5, 'available', 6),
(53, 'Thoại My', '2001-08-20', 'female', '0827651841', 'Mời anh một miếng dưa cà\r\nDạo này ế quá hay là yêu nhau?', 2000000, 'f9c1abf911bf7574402ef73cf0543f83.jpg', 5, 'available', 19),
(54, 'Thu Thuỷ', '1999-03-11', 'female', '0198476254', 'Mùa hè nóng bức thì ăn kem\r\nAnh cần bạn gái thì yêu em', 1500000, '4541a67b1ea0e970300732788f2f919c.jpg', 5, 'available', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_comment`
--

CREATE TABLE `product_comment` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `product_comment`
--

INSERT INTO `product_comment` (`id`, `product_id`, `user_id`, `created_at`, `content`) VALUES
(8, 6, 2, '2023-02-04 02:22:23', 'thân thiện, tâm lý'),
(72, 46, 1, '2023-07-05 23:54:00', 'dễ thương'),
(7, 3, 2, '2023-02-04 01:59:25', 'tâm lý'),
(6, 3, 1, '2023-02-04 01:57:00', 'xinh, dễ thương'),
(9, 8, 11, '2023-02-04 02:43:36', 'Đẹp trai mà hơi yếu'),
(10, 38, 11, '2023-02-04 02:44:18', 'Già nhưng mặn mà'),
(11, 13, 10, '2023-02-04 02:45:12', 'Kiến thức còn hơi yếu nha!!!'),
(12, 10, 10, '2023-02-04 02:45:40', 'Bên ngoài lạnh lùng, bên trong ấm áp <3'),
(13, 25, 16, '2023-02-04 02:46:51', 'bún này hơi dai nha!!!!'),
(14, 13, 16, '2023-02-04 02:47:24', 'Dân It đa số sống tình cảm, lại tâm lý'),
(15, 18, 16, '2023-02-04 02:48:22', 'Em ngu thật rồi, xin lỗi anh trai nha'),
(16, 8, 16, '2023-02-04 02:49:15', 'Đi lan BOT mà farm hơi yếu nha anh trai, cần phải tryHard thêm nha'),
(17, 23, 16, '2023-02-04 02:50:16', 'Trồng củ cải vs anh trai khá là vui, lần sau có dịp sẽ gặp lại'),
(18, 12, 16, '2023-02-04 02:51:01', 'Con xe này nó chiến quá, em thở không nổi luôn á!'),
(19, 37, 15, '2023-02-04 02:52:41', 'Mèo mèo meo mèo meo!!'),
(20, 36, 15, '2023-02-04 02:53:03', 'Xin lỗi anh lại là chủ nhật'),
(21, 3, 10, '2023-02-04 02:54:11', 'Bằng phương pháp hóa học, nhận biết các lọ mất nhãn đựng các dung dịch không màu sau : (Viết phương trình hóa học của phản ứng xảy ra)\r\na) HCl, H2SO4, HNO3\r\nb) HCl, H2SO4, HNO3, NaOH, Ca(OH)2.\r\nc)CaCl2 HCl, NaCl, NaOH, CuSO4\r\nd) NaCl, Na2SO4, H2SO4, KOH, HCl, NaNO3'),
(22, 3, 16, '2023-02-04 02:54:30', 'Nụ cười thiên thần'),
(70, 36, 1, '2023-05-18 08:09:17', '.'),
(71, 36, 1, '2023-05-18 08:09:44', 'test'),
(23, 5, 16, '2023-02-04 02:55:16', 'Hết cháo thì còn quẩy, em quẩy rất oke'),
(24, 39, 15, '2023-02-04 02:55:50', 'Nhiệt tình, chu đáo 10 điểm'),
(25, 15, 15, '2023-02-04 02:56:38', 'Tâm tư của em rất là... ư ư ư'),
(26, 3, 15, '2023-02-04 02:57:30', 'thiên thần là em'),
(27, 34, 15, '2023-02-04 02:58:07', 'Phải nói là trên cả tuyệt vời'),
(28, 2, 12, '2023-02-04 02:58:55', 'hiền lành Dam Dang'),
(29, 14, 12, '2023-02-04 02:59:27', 'Chuyên nghiệp'),
(30, 4, 12, '2023-02-04 03:00:06', 'Thịt gà này rất mền và mịn!'),
(31, 24, 12, '2023-02-04 03:00:55', 'Địa chấn suốt 30p cùng em thật thù vị'),
(32, 15, 12, '2023-02-04 03:01:16', 'Em làm anh lại tâm tư rồi'),
(33, 19, 12, '2023-02-04 03:01:57', 'Ngọt Ngào, tâm lý'),
(34, 1, 9, '2023-02-04 03:02:39', 'Cô bé quá ư là dễ thương'),
(35, 16, 9, '2023-02-04 03:03:23', 'Công nhận trăng hôm nay to và tròn quá'),
(36, 17, 9, '2023-02-04 03:03:52', 'Say yes!'),
(37, 9, 9, '2023-02-04 03:04:20', 'Anh thì yêu màu nho'),
(38, 39, 9, '2023-02-04 03:05:04', 'bấy bề của anh'),
(39, 7, 9, '2023-02-04 03:05:52', 'Bông  hoa xinh đẹp'),
(40, 4, 9, '2023-02-04 03:06:27', 'Anh nuôi em'),
(41, 24, 9, '2023-02-04 03:07:05', 'Chuyên nghiệp, nhiều skill hay'),
(42, 36, 9, '2023-02-04 03:08:43', 'bé này hư lắm, phạt phạt bằng cà vạt ms chịu cơ'),
(43, 2, 2, '2023-02-04 04:27:18', 'Dễ thương, nhiều kinh nghiệm'),
(44, 39, 2, '2023-02-04 04:31:08', 'Đua hông em'),
(45, 43, 2, '2023-02-04 04:36:46', 'Dịu dàng, chân thật'),
(46, 20, 41, '2023-02-04 04:42:51', 'em trà vào người anh nè'),
(47, 44, 2, '2023-02-04 04:46:30', 'Máy dập Thủ Đức, uy tín cho ae'),
(48, 44, 10, '2023-02-04 04:52:20', 'Anh này cài win hơi bị oke'),
(49, 44, 16, '2023-02-04 04:55:38', 'không nói nhiều 10 điểm'),
(50, 16, 15, '2023-02-04 05:26:29', 'Tục Tưng ơi'),
(51, 36, 8, '2023-02-04 05:27:39', 'mlem mlem'),
(52, 1, 8, '2023-02-04 05:28:09', 'dễ thương quá à'),
(53, 17, 8, '2023-02-04 05:28:49', 'Nhà em có bán rựu không?'),
(54, 21, 8, '2023-02-04 05:30:38', 'Cưng xỉu'),
(55, 1, 42, '2023-02-04 05:51:02', 'Xinh ạ!'),
(56, 3, 43, '2023-02-04 05:57:19', 'Dễ thương'),
(57, 46, 1, '2023-02-04 05:59:44', 'Xinh'),
(58, 21, 2, '2023-02-04 10:54:35', 'Anh ko muốn hơn ai, chỉ muốn hon em'),
(59, 14, 2, '2023-02-04 10:56:45', 'May quá anh có 1 củ'),
(60, 22, 45, '2023-02-05 08:32:04', '3212'),
(61, 22, 45, '2023-02-05 08:32:10', '3123'),
(62, 47, 14, '2023-02-05 09:15:08', 'Gọi em là cô giáo'),
(63, 5, 47, '2023-02-05 09:46:11', 'qua đêm nhiêu'),
(64, 24, 51, '2023-02-05 10:03:01', 'ưewq'),
(65, 24, 51, '2023-02-05 10:03:10', 'qqeqwe'),
(66, 34, 53, '2023-02-05 10:19:54', 'Tao lạy mày thiệt ắ chứ'),
(67, 3, 56, '2023-02-05 12:16:09', '.'),
(68, 34, 57, '2023-02-05 13:41:36', 'Ôí dồi'),
(69, 3, 65, '2023-02-06 22:38:03', 'Hoang Van Anh xin giá'),
(73, 5, 81, '2023-07-06 01:41:56', 'xinh'),
(74, 5, 81, '2023-07-06 01:42:18', 'xinh'),
(75, 13, 1, '2023-07-29 10:21:35', 'Xinh'),
(76, 17, 1, '2023-12-21 02:50:46', 'ahihi'),
(77, 5, 2, '2024-02-19 23:18:12', 'hi em'),
(78, 45, 2, '2024-02-19 23:18:50', 'hello');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_like`
--

CREATE TABLE `product_like` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `product_like`
--

INSERT INTO `product_like` (`product_id`, `user_id`) VALUES
(0, 56),
(1, 2),
(1, 8),
(1, 9),
(1, 12),
(2, 8),
(2, 9),
(2, 12),
(2, 15),
(3, 1),
(3, 2),
(3, 8),
(3, 12),
(3, 15),
(3, 43),
(4, 8),
(4, 12),
(5, 1),
(5, 2),
(5, 8),
(5, 9),
(5, 12),
(5, 15),
(6, 2),
(7, 8),
(7, 9),
(7, 12),
(8, 1),
(8, 8),
(8, 9),
(8, 11),
(9, 8),
(9, 12),
(9, 15),
(10, 1),
(10, 8),
(10, 10),
(11, 1),
(11, 2),
(11, 9),
(11, 12),
(12, 8),
(12, 12),
(13, 1),
(13, 10),
(14, 8),
(14, 12),
(15, 2),
(15, 8),
(15, 15),
(15, 16),
(16, 2),
(16, 8),
(16, 9),
(16, 12),
(16, 15),
(17, 1),
(17, 2),
(17, 8),
(17, 9),
(18, 8),
(18, 9),
(18, 12),
(18, 16),
(19, 1),
(19, 12),
(20, 1),
(20, 8),
(20, 15),
(20, 46),
(21, 8),
(21, 12),
(22, 1),
(22, 2),
(22, 8),
(22, 12),
(22, 42),
(22, 45),
(23, 8),
(23, 12),
(23, 16),
(24, 8),
(24, 12),
(24, 51),
(25, 1),
(25, 8),
(25, 16),
(34, 15),
(34, 16),
(35, 1),
(35, 12),
(36, 8),
(36, 12),
(37, 1),
(37, 8),
(37, 12),
(37, 54),
(38, 1),
(38, 8),
(38, 12),
(39, 2),
(39, 8),
(39, 12),
(39, 15),
(43, 2),
(43, 12),
(44, 1),
(44, 2),
(44, 10),
(44, 12),
(44, 16),
(45, 1),
(47, 1),
(48, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_view`
--

CREATE TABLE `product_view` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `phone_number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('standard','premium','deluxe') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `name`, `gender`, `dob`, `phone_number`, `password`, `role`, `type`) VALUES
(1, 'admin', 'male', '1994-04-21', '0123456789', '$2y$10$TxndoIm6j.z4w.kM8snEre3oBY3AJOx6ohsyonDwJpP1t9eMHjkeu', 'admin', 'deluxe'),
(2, 'Mr Taurus', 'male', '1994-04-21', '0937969416', '$2y$10$TxndoIm6j.z4w.kM8snEre3oBY3AJOx6ohsyonDwJpP1t9eMHjkeu', 'user', 'deluxe'),
(8, 'Trịnh Trọng Kiểm', 'other', '2015-02-25', '0111111112', '$2y$10$TxndoIm6j.z4w.kM8snEre3oBY3AJOx6ohsyonDwJpP1t9eMHjkeu', 'user', 'standard'),
(9, 'Nguyễn Văn Phước', 'male', '2003-06-20', '0356459324', '$2y$10$TxndoIm6j.z4w.kM8snEre3oBY3AJOx6ohsyonDwJpP1t9eMHjkeu', 'user', 'standard'),
(10, 'Xuân Mai', 'female', '2022-11-10', '0111111113', '$2y$10$TxndoIm6j.z4w.kM8snEre3oBY3AJOx6ohsyonDwJpP1t9eMHjkeu', 'user', 'standard'),
(11, 'kyo Ken', 'male', '2022-11-09', '0111111114', '$2y$10$TxndoIm6j.z4w.kM8snEre3oBY3AJOx6ohsyonDwJpP1t9eMHjkeu', 'user', 'standard'),
(12, 'Tuấn An', 'male', '2003-06-11', '0111177776', '$2y$10$TxndoIm6j.z4w.kM8snEre3oBY3AJOx6ohsyonDwJpP1t9eMHjkeu', 'user', 'standard'),
(13, 'Long An', 'female', '2022-11-10', '0111111333', '$2y$10$TxndoIm6j.z4w.kM8snEre3oBY3AJOx6ohsyonDwJpP1t9eMHjkeu', 'user', 'standard'),
(14, 'khoa Phạm', 'male', '2022-08-19', '0111111118', '$2y$10$TxndoIm6j.z4w.kM8snEre3oBY3AJOx6ohsyonDwJpP1t9eMHjkeu', 'user', 'standard'),
(15, 'A kA', 'male', '2022-11-11', '0111177788', '$2y$10$TxndoIm6j.z4w.kM8snEre3oBY3AJOx6ohsyonDwJpP1t9eMHjkeu', 'user', 'standard'),
(16, 'Alice', 'female', '2022-09-16', '0111111111', '$2y$10$6j38KHRIHsRokyajdAqIgO1q7hZ0sNdONdTkImADbGVsORnoND9fG', 'user', 'standard'),
(41, 'Nguyễn Tâm An', 'male', '2003-11-11', '0765443255', '$2y$10$R5PPl7HMOHwF3HH91DZO6eMa/BYCsZUTeN1.6qBi8zvEhodmwg3oy', 'user', 'standard'),
(42, 'Long', 'male', '2022-11-17', '0123459876', '$2y$10$ldZKVyylJfGLU5nIwR3D9.ub3aHhcdOM1q.UsSJhS70CcRq9fQyx.', 'user', 'standard'),
(43, 'Long', 'male', '1994-02-16', '0128757362', '$2y$10$Rn5.kL9E4XekWV0SdH3H.ueMr1sPLEDy69pm7AkjgL/eoEDEio8Ym', 'user', 'standard'),
(44, 'an', 'male', '0001-01-01', '0123213444', '$2y$10$Czjs509W58XzQtGJJO/G4OqdYQyrbZfVglxPT0/7E5QJ4RkHwNYCG', 'user', 'standard'),
(45, 'dwqe', 'male', '2023-01-31', '0012312345', '$2y$10$5xjtZoqH5PIMRqxH/fcAMuhgTjz06KEcIVfsPdvNa8I2Yrgj0uC5.', 'user', 'standard'),
(46, 'dfsdf', 'male', '2023-02-23', '0353987457', '$2y$10$BkAUyKdyma4TdTmHYQ5WFO6Kl6cHfn.vz4NQ8kXih6vlyXaHVfbaK', 'user', 'standard'),
(47, 'ok', 'male', '2004-04-02', '0967544333', '$2y$10$KBwSRdy4enIdQreWqxlC8OtVrdNl4JKkaeUYTvfPCUjaqgeI2X83O', 'user', 'standard'),
(48, 'sond', 'male', '1999-02-22', '0303030365', '$2y$10$DHnzdi189Zz625U9Vm9Pe.P30tRw.tToKQ1tuY.qCrLSTAj5/j0Dy', 'user', 'standard'),
(50, '22233', 'male', '1111-02-23', '0343434344', '$2y$10$1MnqO0FbiBc4lfSiasX7.uUxe21VZv0zRxlWvAaUEGNANTQaA5Mtq', 'user', 'standard'),
(51, 'ưeqqw', 'female', '0002-02-02', '0313131244', '$2y$10$q6MWqjBPw.NDyQXZ/PfKeeGufx5IpBg4LH/gKJHE22HVY1tCbDUl2', 'user', 'standard'),
(52, 'aa', 'male', '2222-11-11', '0123445653', '$2y$10$neWT9DjMXnLQmXQYMvN9/ep6TvX0D6iI8tmOosEOaz/oniLS2W7AK', 'user', 'standard'),
(53, 'Bùi Hảo', 'male', '2002-09-06', '0945135919', '$2y$10$4AxoplTCeBlIEQvFfv7kO.TigkAPTutNVllteLmdDOnTW3m6pSF7W', 'user', 'standard'),
(54, 'aa', 'male', '2023-02-08', '0000000000', '$2y$10$djx/ItDwOQYIJF6/zEInX.NKPx3EyH2DAzL1vPnoi7RKIRzJujDoO', 'user', 'standard'),
(56, 'Hello world', 'male', '2023-02-06', '0905555666', '$2y$10$.H22hco1whXk8BzWE90tZeL4r/1N6uuMwgkahVyaB4lhWqJwKW4C.', 'user', 'standard'),
(57, 'sdsd', 'female', '2023-03-03', '0656565434', '$2y$10$5V7tTC5H4aupoMpZEJCRk.vd2VBhXfxqPahGpKnZcCESogOfamgqu', 'user', 'standard'),
(60, 'Quách Gia Quy', 'male', '2003-01-15', '0987654321', '$2y$10$J3.WAqDQ3G7FgOEG3GyVku8xuJhCi4PQgTaD36Mu7bd8oDASjd4zu', 'user', 'standard'),
(61, 'bocuaban', 'other', '2003-01-06', '0985836842', '$2y$10$bNWg0.vBazAHwHLPvHk4KOH1u04QC2Za6DfFOy8Ndc1XHzcgHWAGu', 'user', 'standard'),
(64, 'Admin', 'female', '0000-00-00', '0905115502', '$2y$10$bVZ83Zfq.mXhNydoXcUmZORhnh.9v49pxY18jF5fvkiJpbM21R3GS', 'user', 'standard'),
(65, 'Hoang Van Anh', 'male', '2003-02-10', '0349307649', '$2y$10$pkrh.Uqk723fLemRZrG6wuJxznAPgZF..MxVO8o9/LqUKvq9BYPcS', 'user', 'standard'),
(67, 'hihi', 'male', '2023-02-27', '0009998887', '$2y$10$BTcv8CmszgDWHO2UTIgW2u5VURv5qa.P/92qBu2ZRzQQMIU07dqmi', 'user', 'standard'),
(71, 'Namson', 'male', '1999-02-09', '0909090909', '$2y$10$Bd0nDrLV/i2t.HZT2yIgIeybt1KKW7QuW9.Xhc2eTo5GwLIJFEDAq', 'user', 'standard'),
(72, '34Ty', 'other', '2023-02-07', '0322342542', '$2y$10$D1nO0jmLHh8QlCvlcZxF4uijSGbDCPfrenb6IBoAc.QPILuHpQRKG', 'user', 'standard'),
(73, 'quan', 'female', '2023-02-16', '0913534231', '$2y$10$ZRy2uQU95DpyjY/pPFoZFeBUabVvzB.brlx7ZWDoesQdE1JyR7RvC', 'user', 'standard'),
(75, 'chipchip1512', 'female', '2023-02-24', '0123123123', '$2y$10$2qJhKBY.o/fJozgvaizDte7avPNCy4t/lkANS4LxtjbBRYy7ZPRTa', 'user', 'standard');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_cart` (`user_id`);

--
-- Chỉ mục cho bảng `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_cart_detail` (`product_id`),
  ADD KEY `FK_cart_cart_detail` (`cart_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `oder`
--
ALTER TABLE `oder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`) USING BTREE,
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_comment`
--
ALTER TABLE `product_comment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_like`
--
ALTER TABLE `product_like`
  ADD PRIMARY KEY (`product_id`,`user_id`);

--
-- Chỉ mục cho bảng `product_view`
--
ALTER TABLE `product_view`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `phone_number_2` (`phone_number`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `cart_detail`
--
ALTER TABLE `cart_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `oder`
--
ALTER TABLE `oder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `product_comment`
--
ALTER TABLE `product_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `product_view`
--
ALTER TABLE `product_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_user_cart` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD CONSTRAINT `FK_cart_cart_detail` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `FK_product_cart_detail` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `oder`
--
ALTER TABLE `oder`
  ADD CONSTRAINT `oder_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `oder_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Các ràng buộc cho bảng `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
