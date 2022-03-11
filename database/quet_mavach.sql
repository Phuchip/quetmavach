-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2022 at 04:35 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quet_mavach`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_right`
--

CREATE TABLE IF NOT EXISTS `admin_user_right` (
`adu_admin_id` int(11) NOT NULL,
  `adu_admin_module_id` int(11) NOT NULL DEFAULT '0',
  `adu_add` int(1) DEFAULT '0',
  `adu_edit` int(1) DEFAULT '0',
  `adu_delete` int(1) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_user_right`
--

INSERT INTO `admin_user_right` (`adu_admin_id`, `adu_admin_module_id`, `adu_add`, `adu_edit`, `adu_delete`) VALUES
(7, 1, 0, 0, 0),
(7, 4, 0, 0, 0),
(2, 2, 0, 0, 0),
(2, 1, 0, 0, 0),
(2, 4, 0, 0, 0),
(2, 3, 0, 0, 0),
(3, 3, 0, 0, 0),
(3, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
`mod_id` int(11) NOT NULL,
  `mod_name` varchar(100) DEFAULT NULL,
  `mod_path` varchar(255) DEFAULT NULL,
  `mod_listname` text,
  `mod_listfile` text,
  `mod_order` int(11) DEFAULT '0',
  `mod_help` mediumtext,
  `lang_id` int(11) DEFAULT '1',
  `mod_checkloca` int(11) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`mod_id`, `mod_name`, `mod_path`, `mod_listname`, `mod_listfile`, `mod_order`, `mod_help`, `lang_id`, `mod_checkloca`) VALUES
(1, 'Danh mục sản phẩm', 'product', 'Sản phẩm|Hãng sản xuất|Loại sản phẩm|Loại tia|Kiểu dáng|Kết nối', 'list_product|list_manufacturer|list_category|list_ray_type|list_style|list_connector', 1, NULL, 1, 0),
(12, 'Trang chủ', 'admin_home', 'Trang chủ', 'index', 0, NULL, 1, 0),
(4, 'Quản lý tags', 'tags', 'Tags', 'list_tags', 4, NULL, 1, 0),
(2, 'Đơn đặt hàng', 'order', 'Đơn hàng', 'list_order', 2, NULL, 1, 0),
(80, 'Quản lý giảm giá', 'sale', 'Mã giảm giá', 'list_voucher', 5, NULL, 1, 0),
(3, 'Quản lý bình luận', 'comment', 'Bình luận', 'list_comment', 3, NULL, 1, 0),
(11, 'Quản lý tài khoản', 'admin_user', 'Tài khoản|Đổi mật khẩu', 'list_account|change_pass', 7, NULL, 1, 0),
(81, 'Liên hệ sản phẩm', 'contact', 'Liên hệ', 'list_advise', 6, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `sapo` text NOT NULL,
  `create_time` int(50) NOT NULL,
  `modify_time` int(50) NOT NULL,
  `status` int(11) NOT NULL,
  `delete` int(11) NOT NULL DEFAULT '0',
  `create_date` int(11) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '0' COMMENT '1: là tk admin'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `name`, `phone`, `email`, `image`, `address`, `sapo`, `create_time`, `modify_time`, `status`, `delete`, `create_date`, `is_admin`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', ' Administrator', '', '', '', '', '', 0, 1642162325, 1, 0, 0, 1),
(2, 'binh', 'e10adc3949ba59abbe56e057f20f883e', 'bbb', '0589193831', 'binhnt.318@gmail.com', '', '', '', 0, 0, 0, 0, 1642572864, 0),
(3, 'phuc', 'e10adc3949ba59abbe56e057f20f883e', 'fvxv', '0987654321', 'nguyenthibinh.31082001@gmail.com', '', '', '', 0, 0, 0, 0, 1642572960, 0),
(6, 'aa', 'e10adc3949ba59abbe56e057f20f883e', 'bbbiiii', '0589193831', 'binhnt.318@gmail.com', '', '', '', 0, 0, 0, 0, 1642603651, 0),
(7, 'binh1234', 'e10adc3949ba59abbe56e057f20f883e', 'bbbiiii123', '0589193831', 'binhnt.318@gmail.com', '', '', '', 0, 0, 0, 0, 1642604646, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advise`
--

CREATE TABLE IF NOT EXISTS `tbl_advise` (
`id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `created_time` varchar(50) NOT NULL,
  `modify_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_comments` (
`id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `isAdmin` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `created_time` varchar(50) NOT NULL,
  `modify_time` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`id`, `id_product`, `parent`, `isAdmin`, `name`, `email`, `phone`, `comment`, `created_time`, `modify_time`, `status`) VALUES
(1, 1, 0, 0, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', 'áhvcs', '1642817859', '', 1),
(2, 1, 0, 0, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', 'oke', '1642817863', '', 1),
(3, 1, 2, 0, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', 'abc', '1642818445', '', 1),
(4, 1, 2, 0, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', 'cawnw', '1642818707', '', 1),
(5, 1, 1, 0, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', 'hú', '1642818726', '', 1),
(6, 1, 0, 0, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', 'oke', '1642818732', '', 1),
(7, 1, 6, 0, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', 'được đấy', '1642818743', '', 1),
(8, 1, 0, 0, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', 'ácbsc', '1642818866', '', 1),
(9, 1, 8, 0, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', 'ẹc', '1642818876', '', 1),
(10, 1, 1, 0, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', 'duyệt', '1642818947', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_order`
--

CREATE TABLE IF NOT EXISTS `tbl_detail_order` (
`id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `created_time` varchar(100) NOT NULL,
  `modify_time` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_detail_order`
--

INSERT INTO `tbl_detail_order` (`id`, `id_order`, `id_product`, `quantity`, `price`, `created_time`, `modify_time`, `status`) VALUES
(1, 1, 3, 2, '3680000', '1642847577', '1642847577', 1),
(2, 1, 2, 1, '2160000', '1642847577', '1642847577', 1),
(3, 1, 1, 1, '2560000', '1642847577', '1642847577', 1),
(4, 2, 6, 1, '2560000', '1643469053', '1643469053', 1),
(5, 2, 5, 2, '4140000', '1643469053', '1643469053', 1),
(6, 3, 5, 1, '4140000', '1643469258', '1643469258', 1),
(7, 3, 3, 3, '3910000', '1643469258', '1643469258', 1),
(8, 3, 1, 1, '2560000', '1643469258', '1643469258', 1),
(9, 4, 6, 4, '2560000', '1643470192', '1643470192', 1),
(10, 4, 2, 1, '2160000', '1643470192', '1643470192', 1),
(11, 5, 6, 1, '2560000', '1643470266', '1643470266', 1),
(12, 6, 6, 1, '2560000', '1643470367', '1643470367', 1),
(13, 6, 5, 1, '4140000', '1643470367', '1643470367', 1),
(14, 6, 4, 1, '4160000', '1643470367', '1643470367', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manufacturer`
--

CREATE TABLE IF NOT EXISTS `tbl_manufacturer` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `created_time` int(50) NOT NULL,
  `modify_time` int(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_manufacturer`
--

INSERT INTO `tbl_manufacturer` (`id`, `name`, `alias`, `created_time`, `modify_time`, `status`) VALUES
(1, 'ANTEC', 'antec', 1638954424, 1643102525, 0),
(2, 'ANTECH', 'antech', 1638954424, 1643102478, 1),
(3, 'APOS', 'apos', 1638954424, 1643102484, 1),
(4, 'ROCO', 'roco', 1638954424, 1643102488, 1),
(5, 'EPSON', 'epson', 1638954424, 1643102497, 1),
(6, 'XPRINTER', 'xprinter', 1638954424, 1643102501, 1),
(8, 'Cannon', 'cannon', 1639187147, 1643102506, 1),
(9, 'HP', 'hp', 1639469983, 1643102510, 1),
(10, 'HPRT', 'hprt', 1640747056, 1643102514, 1),
(11, 'dcds111111', 'dcds111111', 1642561153, 1643102518, 0),
(12, 'ANTECH111', 'antech111', 1642600815, 1643102548, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules`
--

CREATE TABLE IF NOT EXISTS `tbl_modules` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_modules`
--

INSERT INTO `tbl_modules` (`id`, `name`, `alias`, `status`) VALUES
(1, 'Sản phẩm', 'san-pham', 1),
(2, 'Hãng sản xuất', 'hang-san-xuat', 1),
(3, 'Loại máy in', 'loai-may-in', 1),
(4, 'Đơn hàng', 'cong-ket-noi', 1),
(5, 'Khổ giấy', 'kho-giay', 1),
(6, 'Tag', 'tag', 1),
(7, 'Đơn hàng', 'don-hang', 1),
(8, 'Bình luận', 'binh-luan', 1),
(9, 'Đăng ký nhận tin', 'new-letter', 1),
(10, 'Quản lý tài khoản', 'tai-khoan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `ship_name` varchar(255) NOT NULL,
  `ship_phone` varchar(50) NOT NULL,
  `ship_address` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `discount` double NOT NULL,
  `total` varchar(50) NOT NULL,
  `created_time` int(50) NOT NULL,
  `modify_time` int(50) NOT NULL,
  `complete` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `name`, `email`, `phone`, `address`, `ship_name`, `ship_phone`, `ship_address`, `note`, `quantity`, `code`, `discount`, `total`, `created_time`, `modify_time`, `complete`, `status`, `delete`) VALUES
(1, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', 'Phúc Híp', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', '', 4, '', 0, '12080000', 1642847577, 1642847577, 0, 1, 0),
(2, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', 'Phúc Híp', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', '', 3, '', 0, '10840000', 1643469053, 1643469053, 0, 1, 0),
(3, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', 'Phúc Híp', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', '', 5, 'MV1', 100000, '18330000', 1643469257, 1643469257, 0, 1, 0),
(4, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', 'Phúc Híp', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', '', 5, 'MV1', 100000, '12300000', 1643470192, 1643470192, 0, 1, 0),
(5, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', 'Phúc Híp', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', '', 1, 'MV1', 100000, '2460000', 1643470266, 1643470266, 0, 1, 0),
(6, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', 'Phúc Híp', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', '', 3, 'MV12345', 2172000, '8688000', 1643470367, 1643470367, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
`id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `alias` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price_old` double NOT NULL,
  `discount` float NOT NULL,
  `price_new` double NOT NULL,
  `code_product` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `des_images` text NOT NULL COMMENT 'Ảnh mô tả sản phẩm',
  `manufacturer` varchar(50) NOT NULL COMMENT 'Hãng sản xuất',
  `category` varchar(50) NOT NULL COMMENT 'Loại máy quét',
  `ray_style` varchar(50) NOT NULL COMMENT 'Loại tia',
  `style` varchar(50) NOT NULL COMMENT 'Kiểu dáng',
  `connector` varchar(50) NOT NULL COMMENT 'Cổng kết nối',
  `parameter` text NOT NULL COMMENT 'Thông số sản phẩm',
  `review_product` text NOT NULL COMMENT 'Đánh giá sản phẩm',
  `thuong_hieu` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `cong_nghe_quet` varchar(255) NOT NULL,
  `do_tuong_phan` varchar(255) NOT NULL,
  `doc_ma_vach` varchar(255) NOT NULL,
  `cong_giao_tiep` varchar(100) NOT NULL,
  `chan_de` int(5) NOT NULL DEFAULT '0',
  `dien_ap` varchar(100) NOT NULL,
  `do_phan_giai` varchar(100) NOT NULL,
  `do_ben` varchar(100) NOT NULL,
  `goc_quet` varchar(100) NOT NULL,
  `trong_luong` varchar(100) NOT NULL,
  `kich_thuoc` varchar(100) NOT NULL,
  `mau_sac` varchar(100) NOT NULL,
  `phu_kien` varchar(100) NOT NULL,
  `xuat_xu` varchar(100) NOT NULL,
  `bao_hanh` varchar(100) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `rate` int(11) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL,
  `modify_time` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `delete` int(11) NOT NULL DEFAULT '0',
  `robots` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `alias`, `image`, `price_old`, `discount`, `price_new`, `code_product`, `quantity`, `des_images`, `manufacturer`, `category`, `ray_style`, `style`, `connector`, `parameter`, `review_product`, `thuong_hieu`, `model`, `cong_nghe_quet`, `do_tuong_phan`, `doc_ma_vach`, `cong_giao_tiep`, `chan_de`, `dien_ap`, `do_phan_giai`, `do_ben`, `goc_quet`, `trong_luong`, `kich_thuoc`, `mau_sac`, `phu_kien`, `xuat_xu`, `bao_hanh`, `tags`, `title`, `description`, `keyword`, `view`, `rate`, `created_time`, `modify_time`, `status`, `delete`, `robots`) VALUES
(1, 'HPRT-TP80BE', 'hprt-tp80be', 'hprt-tp80be/hprt-tp80be.png', 3200000, 20, 2560000, 'TP80BE', 20, 'hprt-tp80be/hprt-tp80be-0.png,hprt-tp80be/hprt-tp80be-1.png,hprt-tp80be/hprt-tp80be-2.png', '2', '1', '2', '2', '1', 'Sử dụng công nghệ quét ảnh (area image) với mắt đọc có độ phân giải cao, giúp đọc được các mã vạch màu, mã vạch hư hỏng, bị che khuất một phần hoặc in chất lượng kém.|Đọc được các mã vạch 1D, 2D và có khả năng đọc tốt mã vạch trên màn hình vi tính, điện thoại.|Công nghệ: quét hình ảnh (1280 x 800 pixel).|Góc quét: ngang 47°, dọc 30°.', '<p>M&ocirc; tả</p>\r\n', 'Thicas', 'LQ310', 'scnaj', 'sdcvdkb', 'jndsv', 'jcasc sm', 1, 'svjcbdv ', '03dpi, 8dots/mm', 'oke', 'dvbja', 'dvbsdjkv', 'sdvjsdkv', 'hdvv sj', 'bsdkvca', 'dvbcdj', '2 năm', '12,13', 'acgb', 'sbcjska', 'bjsdvcad', 0, 0, 0, 0, 1, 0, 0),
(2, 'HPRT-TP80BA', 'hprt-tp80ba', 'hprt-tp80ba/hprt-tp80ba.png', 3600000, 40, 2160000, 'INTR30', 10, 'hprt-tp80ba/hprt-tp80ba-0.png,hprt-tp80ba/hprt-tp80ba-1.png,hprt-tp80ba/hprt-tp80ba-2.png', '2', '1', '1', '2', '1', 'avca snvc', '', 'ấcc', 'sajbvcas,cvm', 'ịacnjsaanc', 'ícncvklas', 'knkcsnsdvcn', 'jcasc sm', 1, 'vdjnadmv ', 'scjkqmw', 'scnec ', 'scnkl', 'cjnvckm', 'cqojnsck', 'asdjvcm ', 'nựkcnm', 'cjncqec', 'ocnwkc', '12', '', '', '', 0, 0, 0, 0, 1, 0, 0),
(3, 'sancm', 'sancm', 'sancm/sancm.png', 4600000, 15, 3680000, 'INTR32', 10, 'sancm/sancm-0.png,sancm/sancm-1.png', '2', '1', '1', '2', '1', 'avqbdvj', '<p>scbjsk&nbsp;</p>\r\n', 'sdv ad', 'jvkndsv', 'vjkvbdvjk', 'kncsjks', 'ksjcs', 'csajbcaks ', 1, 'dsvjbds', 'bsdjak m', 'jjcbaks', 'hcasj n', 'hbsjck sanm', 'jbksc ', 'ibwcjw', 'acjbask m', 'jbcskc ', '20 năm', '14', '', '', '', 0, 0, 0, 0, 1, 0, 0),
(4, 'phuchip', 'phuchip', 'phuchip/phuchip.png', 5200000, 20, 4160000, 'INTR30', 5, 'phuchip/phuchip-0.png,phuchip/phuchip-1.png', '2', '1', '1', '2', '1', 'sac', '<p style="margin-left: 80px;">vkadq</p>\r\n', 'vah', 'hsvca', 'jcsba', 'bscjacb', 'scabjs', 'vaknv', 1, 'acvabj', 'mvskdm', 'vndskv', 'kvadsv', 'ksnvd', 'vnkav', 'knvadl', 'vnkadv', 'vskdv', 'vnskd', '12', '', '', '', 0, 0, 0, 0, 1, 0, 0),
(5, 'sancm', 'sancm', 'sancm/sancm.png', 4600000, 10, 3680000, 'INTR32', 10, 'sancm/sancm-0.png,sancm/sancm-1.png', '2', '1', '1', '2', '1', 'avqbdvj', '<p>scbjsk&nbsp;</p>\r\n', 'sdv ad', 'jvkndsv', 'vjkvbdvjk', 'kncsjks', 'ksjcs', 'csajbcaks ', 1, 'dsvjbds', 'bsdjak m', 'jjcbaks', 'hcasj n', 'hbsjck sanm', 'jbksc ', 'ibwcjw', 'acjbask m', 'jbcskc ', '20 năm', '14', '', '', '', 0, 0, 0, 0, 1, 0, 0),
(6, 'HPRT-TP80BE', 'hprt-tp80be', 'hprt-tp80be/hprt-tp80be.png', 3200000, 20, 2560000, 'TP80BE', 20, 'hprt-tp80be/hprt-tp80be-0.png,hprt-tp80be/hprt-tp80be-1.png,hprt-tp80be/hprt-tp80be-2.png', '2', '1', '1', '2', '1', 'Sử dụng công nghệ quét ảnh (area image) với mắt đọc có độ phân giải cao, giúp đọc được các mã vạch màu, mã vạch hư hỏng, bị che khuất một phần hoặc in chất lượng kém.|Đọc được các mã vạch 1D, 2D và có khả năng đọc tốt mã vạch trên màn hình vi tính, điện thoại.|Công nghệ: quét hình ảnh (1280 x 800 pixel).|Góc quét: ngang 47°, dọc 30°.', '<p>M&ocirc; tả</p>\r\n', 'Thicas', 'LQ310', 'scnaj', 'sdcvdkb', 'jndsv', 'jcasc sm', 1, 'svjcbdv ', '03dpi, 8dots/mm', 'oke', 'dvbja', 'dvbsdjkv', 'sdvjsdkv', 'hdvv sj', 'bsdkvca', 'dvbcdj', '2 năm', '12,13', 'acgb', 'sbcjska', 'bjsdvcad', 0, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE IF NOT EXISTS `tbl_role` (
  `id_user` int(11) NOT NULL,
  `id_modules` int(11) NOT NULL,
  `view` int(11) NOT NULL,
  `add` int(11) NOT NULL,
  `edit` int(11) NOT NULL,
  `delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id_user`, `id_modules`, `view`, `add`, `edit`, `delete`) VALUES
(1, 1, 1, 1, 1, 1),
(1, 2, 1, 1, 1, 1),
(1, 3, 1, 1, 1, 1),
(1, 4, 1, 1, 1, 1),
(1, 5, 1, 1, 1, 1),
(1, 6, 1, 1, 1, 1),
(1, 7, 1, 1, 1, 1),
(1, 8, 1, 1, 1, 1),
(1, 9, 1, 1, 1, 1),
(1, 10, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tags`
--

CREATE TABLE IF NOT EXISTS `tbl_tags` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `title_suggest` varchar(255) NOT NULL,
  `content_suggest` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `created_time` int(11) NOT NULL,
  `modify_time` int(11) NOT NULL,
  `show_post` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `robots` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_tags`
--

INSERT INTO `tbl_tags` (`id`, `name`, `alias`, `content`, `title_suggest`, `content_suggest`, `title`, `description`, `keyword`, `created_time`, `modify_time`, `show_post`, `status`, `robots`) VALUES
(12, 'máy in hóa đơn cầm tay', 'may-in-hoa-don-cam-tay', '', 'máy in hóa đơn cầm tay', '<p>m&aacute;y in h&oacute;a đơn cầm tay</p>\r\n', 'máy in hóa đơn cầm tay', 'máy in hóa đơn cầm tay', 'máy in hóa đơn cầm tay', 0, 1642126684, 1, 1, 0),
(13, 'máy in hóa đơn mini', 'may-in-hoa-don-mini', '', '', '', 'máy in hóa đơn mini', 'máy in hóa đơn mini', 'máy in hóa đơn mini', 1642126743, 1642126743, 1, 1, 0),
(14, 'máy in hóa đơn bluetooth', 'may-in-hoa-don-bluetooth', '', '', '', 'máy in hóa đơn bluetooth', 'máy in hóa đơn bluetooth', 'máy in hóa đơn bluetooth', 1642126760, 1642126760, 1, 1, 0),
(15, 'máy in hóa đơn kết nối điện thoại', 'may-in-hoa-don-ket-noi-dien-thoai', '', '', '', 'máy in hóa đơn kết nối điện thoại', 'máy in hóa đơn kết nối điện thoại', 'máy in hóa đơn kết nối điện thoại', 1642126803, 1642126803, 1, 1, 0),
(16, 'máy in hóa đơn wifi', 'may-in-hoa-don-wifi', '<p>m&aacute;y in h&oacute;a đơn wifi</p>\r\n', 'máy in hóa đơn wifi', '<p>m&aacute;y in h&oacute;a đơn wifi</p>\r\n', 'máy in hóa đơn wifi', 'máy in hóa đơn wifi', 'máy in hóa đơn wifi', 1642126981, 1642126981, 1, 1, 0),
(17, 'máy in hóa đơn 2 liên', 'may-in-hoa-don-2-lien', '<p>m&aacute;y in h&oacute;a đơn 2 li&ecirc;n</p>\r\n', '', '', 'máy in hóa đơn 2 liên', 'máy in hóa đơn 2 liên', 'máy in hóa đơn 2 liên', 1642127027, 1642127027, 1, 1, 0),
(18, 'máy in hóa đơn 3 liên', 'may-in-hoa-don-3-lien', '', '', '', 'máy in hóa đơn 3 liên', 'máy in hóa đơn 3 liên', 'máy in hóa đơn 3 liên', 1642127046, 1642127046, 1, 1, 0),
(19, 'máy in hóa đơn dán', 'may-in-hoa-don-dan', '', '', '', 'máy in hóa đơn dán', 'máy in hóa đơn dán', 'máy in hóa đơn dán', 1642127077, 1642127077, 1, 1, 0),
(20, 'máy in hóa đơn khổ a5', 'may-in-hoa-don-kho-a5', '', '', '', 'máy in hóa đơn khổ a5', 'máy in hóa đơn khổ a5', 'máy in hóa đơn khổ a5', 1642127088, 1642127088, 1, 1, 0),
(21, 'máy in hóa đơn nhiệt', 'may-in-hoa-don-nhiet', '', 'máy in hóa đơn nhiệt', '<p>m&aacute;y in h&oacute;a đơn nhiệt</p>\r\n', 'máy in hóa đơn nhiệt', 'máy in hóa đơn nhiệt', 'máy in hóa đơn nhiệt', 1642127953, 1642127953, 1, 1, 0),
(22, 'máy in hóa đơn a4', 'may-in-hoa-don-a4', '', '', '', 'máy in hóa đơn a4', 'máy in hóa đơn a4', 'máy in hóa đơn a4', 1642127972, 1642127972, 1, 1, 0),
(23, 'máy in hóa đơn mạng lan', 'may-in-hoa-don-mang-lan', '', '', '', 'máy in hóa đơn mạng lan', 'máy in hóa đơn mạng lan', 'máy in hóa đơn mạng lan', 1642127985, 1642127985, 1, 1, 0),
(24, 'máy in hóa đơn không dây', 'may-in-hoa-don-khong-day', '', '', '', 'máy in hóa đơn không dây', 'máy in hóa đơn không dây', 'máy in hóa đơn không dây', 1642127996, 1642127996, 1, 1, 0),
(25, 'máy in hóa đơn nhiệt', 'may-in-hoa-don-nhiet', '', '', '', 'máy in hóa đơn nhiệt', 'máy in hóa đơn nhiệt', 'máy in hóa đơn nhiệt', 1642128086, 1642128086, 1, 1, 0),
(26, 'máy in hóa đơn Xprinter', 'may-in-hoa-don-xprinter', '', '', '', 'máy in hóa đơn xprinter', 'máy in hóa đơn xprinter', 'máy in hóa đơn xprinter', 0, 1642128199, 1, 1, 0),
(27, 'máy in hóa đơn epson', 'may-in-hoa-don-epson', '', '', '', 'máy in hóa đơn epson', 'máy in hóa đơn epson', 'máy in hóa đơn epson', 1642128113, 1642128113, 1, 1, 0),
(28, 'máy in hóa đơn HP', 'may-in-hoa-don-hp', '', '', '', 'máy in hóa đơn HP', 'máy in hóa đơn HP', 'máy in hóa đơn HP', 1642128172, 1642128172, 1, 1, 0),
(29, 'máy in hóa đơn APOS', 'may-in-hoa-don-apos', '', '', '', 'máy in hóa đơn APOS', 'máy in hóa đơn APOS', 'máy in hóa đơn APOS', 1642128182, 1642128182, 1, 1, 0),
(30, 'máy in hóa đơn HPRT', 'may-in-hoa-don-hprt', '', '', '', 'máy in hóa đơn hprt', 'máy in hóa đơn hprt', 'máy in hóa đơn hprt', 1642128215, 1642128215, 1, 1, 0),
(31, 'máy in hóa đơn Roco', 'may-in-hoa-don-roco', '', '', '', 'máy in hóa đơn Roco', 'máy in hóa đơn Roco', 'máy in hóa đơn Roco', 1642128237, 1642128237, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voucher`
--

CREATE TABLE IF NOT EXISTS `tbl_voucher` (
`id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount` int(11) NOT NULL COMMENT '% giảm giá',
  `price` double NOT NULL COMMENT 'Số tiền giảm',
  `type` int(5) NOT NULL COMMENT 'Loại giảm giá',
  `start_day` varchar(50) NOT NULL COMMENT 'Ngày bắt đầu',
  `end_day` varchar(50) NOT NULL COMMENT 'Ngày kết thúc',
  `status` int(5) NOT NULL COMMENT 'Trạng thái'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_voucher`
--

INSERT INTO `tbl_voucher` (`id`, `code`, `discount`, `price`, `type`, `start_day`, `end_day`, `status`) VALUES
(1, 'MV12345', 20, 0, 1, '1642746109', '1643699756', 1),
(2, 'MV1', 0, 100000, 2, '1642746109', '1643569975', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user_right`
--
ALTER TABLE `admin_user_right`
 ADD PRIMARY KEY (`adu_admin_id`,`adu_admin_module_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
 ADD PRIMARY KEY (`mod_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_advise`
--
ALTER TABLE `tbl_advise`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_manufacturer`
--
ALTER TABLE `tbl_manufacturer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tags`
--
ALTER TABLE `tbl_tags`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_voucher`
--
ALTER TABLE `tbl_voucher`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user_right`
--
ALTER TABLE `admin_user_right`
MODIFY `adu_admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
MODIFY `mod_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_advise`
--
ALTER TABLE `tbl_advise`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_manufacturer`
--
ALTER TABLE `tbl_manufacturer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_tags`
--
ALTER TABLE `tbl_tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `tbl_voucher`
--
ALTER TABLE `tbl_voucher`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
