-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 07:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idea`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `idhoadon` int(11) NOT NULL,
  `idsanpham` int(11) NOT NULL,
  `idmau` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` float NOT NULL,
  `thanhtien` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`idhoadon`, `idsanpham`, `idmau`, `soluong`, `dongia`, `thanhtien`) VALUES
(21, 2, 3, 3, 10000, 30000),
(22, 4, 2, 1, 100000, 100000),
(23, 2, 3, 1, 10000, 10000),
(25, 2, 3, 1, 1, 10000),
(26, 2, 3, 1, 1, 10000),
(27, 2, 3, 1, 1, 0),
(28, 2, 3, 4, 1, 6),
(29, 2, 3, 1, 1, 1),
(30, 1, 2, 2, 0, 0),
(30, 2, 3, 1, 1, 1),
(31, 2, 3, 1, 1, 1),
(32, 2, 3, 4, 1, 6),
(33, 2, 3, 1, 1, 1),
(34, 2, 3, 2, 1, 3),
(35, 2, 3, 2, 1, 3),
(38, 1, 2, 1, 1400, 1400),
(38, 2, 3, 1, 1, 1),
(40, 1, 2, 1, 0, 0),
(42, 1, 2, 1, 1450, 1400),
(43, 1, 2, 1, 1450, 1400),
(44, 1, 2, 1, 0, 0),
(50, 1, 2, 1, 0, 0),
(51, 1, 2, 1, 1450, 1450),
(55, 1, 2, 1, 1450, 1400),
(57, 1, 2, 1, 1450, 1400),
(58, 1, 2, 1, 1450, 1400),
(59, 1, 2, 1, 1450, 1400),
(60, 2, 3, 1, 22, 21),
(61, 2, 3, 4, 22, 84),
(62, 2, 3, 3, 22, 63),
(63, 2, 3, 3, 22, 63),
(64, 2, 3, 1, 22, 21),
(65, 2, 3, 6, 22, 126),
(66, 2, 3, 5, 22, 105),
(67, 2, 3, 3, 22, 63),
(68, 2, 3, 3, 21.75, 63),
(69, 2, 3, 3, 21.75, 65.25),
(70, 2, 3, 3, 21.75, 65.25),
(73, 2, 3, 1, 21.75, 21.75);

-- --------------------------------------------------------

--
-- Table structure for table `chitietphieunhap`
--

CREATE TABLE `chitietphieunhap` (
  `idphieunhap` int(11) NOT NULL,
  `idsanpham` int(11) NOT NULL,
  `idmau` int(11) NOT NULL,
  `Gia` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `TrangThai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chitietphieunhap`
--

INSERT INTO `chitietphieunhap` (`idphieunhap`, `idsanpham`, `idmau`, `Gia`, `soluong`, `TrangThai`) VALUES
(21, 1, 2, 1000, 1, 0),
(24, 2, 3, 10, 0, 0),
(25, 2, 3, 15, 3, 0),
(26, 2, 3, 16, 0, 0),
(27, 2, 3, 17, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `idnguoidung` int(11) NOT NULL,
  `idsanpham` int(11) NOT NULL,
  `idmau` int(11) NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `idhoadon` int(11) NOT NULL,
  `idnguoidung` int(11) NOT NULL,
  `thoigiandat` date NOT NULL,
  `trangthai` int(11) NOT NULL,
  `idphutrach` int(11) DEFAULT NULL,
  `diachigiaohang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`idhoadon`, `idnguoidung`, `thoigiandat`, `trangthai`, `idphutrach`, `diachigiaohang`) VALUES
(1, 3, '2024-05-07', 2, 2, '41345'),
(2, 3, '2024-05-14', 0, NULL, '23122003'),
(3, 3, '2024-05-14', 0, NULL, '23122003'),
(4, 3, '2024-05-14', 0, NULL, '23122003'),
(5, 3, '2024-05-14', 2, 1, '23122003'),
(6, 3, '2024-09-14', 2, 1, 'tp hcm 123'),
(7, 4, '2024-09-15', 1, NULL, 'ewew'),
(8, 4, '2024-09-15', 2, 2, 'ewew'),
(9, 4, '2024-09-15', 2, 1, 'ekwoekwo'),
(10, 2, '2024-10-04', 1, NULL, '23122003'),
(11, 4, '2024-10-04', 2, 2, 'ewew'),
(12, 4, '2024-10-05', 1, NULL, 'ewew'),
(13, 4, '2024-10-05', 2, 1, 'OK'),
(14, 4, '2024-10-05', 2, 2, 'ABCDE'),
(15, 4, '2024-10-05', 2, 1, 'Giao di'),
(16, 4, '2024-10-06', 2, 2, 'cc'),
(17, 4, '2024-10-06', 2, 2, 'ddd'),
(18, 4, '2024-10-06', 2, 2, 'wwww'),
(19, 4, '2024-10-06', 2, 2, 'hihihi'),
(20, 4, '2024-10-06', 2, 2, 'đw'),
(21, 4, '2024-10-06', 2, 2, 'ewew'),
(22, 4, '2024-10-06', 1, NULL, 'ewew'),
(23, 4, '2024-10-06', 1, NULL, 'ewew'),
(24, 4, '2024-10-06', 1, NULL, 'new'),
(25, 4, '2024-10-06', 1, NULL, 'OK'),
(26, 4, '2024-10-06', 2, 2, 'OKla'),
(27, 4, '2024-10-06', 2, 2, 'ewewqa'),
(28, 4, '2024-10-06', 1, NULL, 'ewew'),
(29, 4, '2024-10-15', 1, NULL, '14'),
(30, 4, '2024-10-15', 1, NULL, '15'),
(31, 4, '2024-10-15', 1, NULL, 'ewew'),
(32, 4, '2024-10-15', 1, NULL, 'OKLA'),
(33, 4, '2024-10-15', 1, NULL, 'Meo'),
(34, 4, '2024-10-17', 2, 2, 'WWW'),
(35, 4, '2024-10-17', 2, 1, 'DDD'),
(36, 16, '2024-10-17', 1, NULL, 'swnm'),
(37, 16, '2024-10-17', 1, NULL, 'swnm'),
(38, 4, '2024-10-17', 2, 2, 'ZôZ'),
(39, 16, '2024-10-17', 1, NULL, 'swnm'),
(40, 16, '2024-10-17', 1, NULL, 'swnm'),
(41, 16, '2024-10-17', 1, NULL, 'swnm'),
(42, 4, '2024-10-17', 2, 2, 'MYMY'),
(43, 4, '2024-10-17', 2, 2, 'YZYYZ'),
(44, 16, '2024-10-17', 1, NULL, 'x'),
(45, 16, '2024-10-17', 2, 2, 'swnm'),
(46, 16, '2024-10-17', 1, NULL, 'swnm'),
(47, 16, '2024-10-17', 1, NULL, 'swnm'),
(48, 16, '2024-10-17', 1, NULL, 'oiuy'),
(49, 16, '2024-10-17', 1, NULL, 'po'),
(50, 16, '2024-10-17', 1, NULL, 'swnm'),
(51, 16, '2024-10-17', 1, NULL, '123'),
(52, 16, '2024-10-17', 1, NULL, 'swnm'),
(53, 16, '2024-10-17', 1, NULL, '123'),
(54, 16, '2024-10-17', 1, NULL, 'xsa'),
(55, 16, '2024-10-17', 1, NULL, 'swnm'),
(56, 16, '2024-10-17', 1, NULL, 'swnm'),
(57, 16, '2024-10-17', 1, NULL, 'swnm'),
(58, 16, '2024-10-17', 1, NULL, 'swnm'),
(59, 16, '2024-10-17', 1, NULL, 'swnm'),
(60, 4, '2024-10-17', 1, NULL, 'ewew'),
(61, 4, '2024-10-18', 1, NULL, 'Mua Ne'),
(62, 4, '2024-10-18', 1, NULL, 'Mua moi'),
(63, 4, '2024-10-18', 1, NULL, 'Mua'),
(64, 4, '2024-10-18', 1, NULL, 'ewew'),
(65, 4, '2024-10-18', 1, NULL, 'ewew'),
(66, 4, '2024-10-18', 1, NULL, 'ewew'),
(67, 4, '2024-10-18', 1, NULL, 'ewew'),
(68, 4, '2024-10-18', 1, NULL, 'ewew'),
(69, 4, '2024-10-18', 1, NULL, 'ewew'),
(70, 4, '2024-10-18', 2, 1, 'OKMM'),
(71, 4, '2024-10-18', 1, NULL, 'Mua'),
(72, 4, '2024-10-18', 1, NULL, 'ewew'),
(73, 4, '2024-10-18', 1, NULL, 'ewew');

-- --------------------------------------------------------

--
-- Table structure for table `loai`
--

CREATE TABLE `loai` (
  `idloai` int(11) NOT NULL,
  `tenloai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loai`
--

INSERT INTO `loai` (`idloai`, `tenloai`) VALUES
(0, 'default'),
(1, 'ghế'),
(2, 'bàn');

-- --------------------------------------------------------

--
-- Table structure for table `mau`
--

CREATE TABLE `mau` (
  `idmau` int(11) NOT NULL,
  `tenMau` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mau`
--

INSERT INTO `mau` (`idmau`, `tenMau`) VALUES
(0, 'default'),
(1, 'màu đen'),
(2, 'màu trắng'),
(3, 'màu đỏ'),
(4, 'màu xanh'),
(5, 'màu vàng'),
(6, 'màu xanh lá');

-- --------------------------------------------------------

--
-- Table structure for table `mottaquyen`
--

CREATE TABLE `mottaquyen` (
  `idquyen` int(11) NOT NULL,
  `mota` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `tieude` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mottaquyen`
--

INSERT INTO `mottaquyen` (`idquyen`, `mota`, `model`, `tieude`) VALUES
(1, 'Access ', 'Thống kê', b'1'),
(2, 'Access ', 'Sản phẩm', b'1'),
(3, 'Add', 'Sản phẩm', b'0'),
(4, 'Edit', 'Sản phẩm', b'0'),
(5, 'Active', 'Sản phẩm', b'0'),
(6, 'Access ', 'Hóa đơn', b'1'),
(7, 'Edit', 'Hóa đơn', b'0'),
(8, 'Access ', 'Phiếu nhập', b'1'),
(9, 'Add', 'Phiếu nhập', b'0'),
(10, 'Access ', 'Tài khoản', b'1'),
(11, 'Add', 'Tài khoản', b'0'),
(12, 'Edit', 'Tài khoản', b'0'),
(13, 'Access ', 'Quyền ', b'1'),
(14, 'Add', 'Quyền ', b'0'),
(15, 'Edit', 'Quyền ', b'0'),
(16, 'Delete ', 'Quyền ', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `idnguoidung` int(11) NOT NULL,
  `hoten` varchar(100) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `trangthai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`idnguoidung`, `hoten`, `sdt`, `diachi`, `email`, `trangthai`) VALUES
(1, 'admin', '0938023118', '23122003', 'admin@gmail.com', 1),
(2, 'admin', '0938023118', '23122003', 'admin@gmail.com', 1),
(3, 'user123', '0938023118', 'tp hcm 123', 'user@gmail.com', 1),
(4, 'fe', '0958465846', 'ewew', 'das@gmail.com', 1),
(5, 'vkdo', '0908866548', 'koj', 'dem@gmail.com', 1),
(6, '432hu', '0907799843', '@e3829!', 'ewm@gmail.com', 1),
(7, 'kofr213', '0907799843', '123 Nguyen DU', 'dew@gmail.com', 1),
(8, 'dewij3127!!', '0907799843', 'sq12', 'aewf@gmail.com', 1),
(9, 'ccno123 !!', '0907799843', 'xsakook123', 'dewni@gmail.com', 1),
(10, '   ', '0908685364', 'đưewm', 'vds@gmail.com', 1),
(11, 'dksao1!', '0959484848', 'đanự', 'fafe@gmail.com', 1),
(12, '    ', '0907799843', 'gre', 'fejsuof@gmail.com', 1),
(13, 'xsxsnj', '0907799843', 'x!!!', 'xsmk@gmail.com', 1),
(14, 'tan', '0907799846', 'xsko 123', 'e3e3@gmail.com', 1),
(15, 'sjwiij', '0907788463', 'koi1', 'xko@gmail.com', 1),
(16, 'dsa', '0987654369', 'swnm', 'dwenj@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `phieunhap`
--

CREATE TABLE `phieunhap` (
  `idphieunhap` int(11) NOT NULL,
  `idnguoinhap` int(11) NOT NULL,
  `ngaynhap` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phieunhap`
--

INSERT INTO `phieunhap` (`idphieunhap`, `idnguoinhap`, `ngaynhap`) VALUES
(1, 1, '2024-05-12'),
(2, 1, '2024-05-13'),
(6, 1, '2024-05-14'),
(7, 1, '2024-09-14'),
(10, 1, '2024-09-15'),
(11, 1, '2024-10-03'),
(12, 1, '2024-10-04'),
(13, 1, '2024-10-04'),
(14, 1, '2024-10-04'),
(15, 1, '2024-10-04'),
(16, 1, '2024-10-04'),
(17, 1, '2024-10-04'),
(18, 1, '2024-10-04'),
(19, 1, '2024-10-04'),
(20, 1, '2024-10-04'),
(21, 1, '2024-10-05'),
(22, 1, '2024-10-06'),
(23, 1, '2024-10-06'),
(24, 1, '2024-10-06'),
(25, 1, '2024-10-17'),
(26, 1, '2024-10-17'),
(27, 1, '2024-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `idphong` int(11) NOT NULL,
  `tenphong` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`idphong`, `tenphong`) VALUES
(0, 'default'),
(1, 'phòng khách'),
(2, 'phòng ngủ');

-- --------------------------------------------------------

--
-- Table structure for table `quyen`
--

CREATE TABLE `quyen` (
  `idvaitro` int(11) NOT NULL,
  `idquyen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quyen`
--

INSERT INTO `quyen` (`idvaitro`, `idquyen`) VALUES
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(4, 2),
(4, 8),
(4, 9),
(5, 1),
(5, 2),
(5, 10),
(5, 11),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `idsanpham` int(11) NOT NULL,
  `idmau` int(11) NOT NULL,
  `idphong` int(11) NOT NULL,
  `idloai` int(11) NOT NULL,
  `tensanpham` varchar(100) NOT NULL,
  `gia` bigint(20) NOT NULL,
  `mota` varchar(100) NOT NULL,
  `hinh` varchar(100) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`idsanpham`, `idmau`, `idphong`, `idloai`, `tensanpham`, `gia`, `mota`, `hinh`, `soLuong`, `trangthai`) VALUES
(1, 0, 2, 2, 'ghế sofa uppland', 2000000, 'ghế sofa cao cấp', '', 0, 0),
(1, 2, 2, 2, 'ghế sofa uppland', 2000000, 'ghế sofa cao cấp', 'th.jpg', 11, 1),
(2, 0, 1, 1, 'ghế nhựa', 10000, 'ghế nhựa Vergil', '', 0, 0),
(2, 3, 1, 1, 'ghế nhựa', 10000, 'ghế nhựa Vergil', 'image_2024-05-12_235147442.png', 132, 1),
(2, 4, 1, 1, 'ghế nhựa', 10000, 'ghế nhựa Vergil', 'image_2024-05-12_235129135.png', 124, 1),
(2, 5, 1, 1, 'ghế nhựa', 10000, 'ghế nhựa Vergil', 'image_2024-05-12_235758134.png', 91, 1),
(2, 6, 1, 1, 'ghế nhựa', 10000, 'ghế nhựa Vergil', 'image_2024-05-12_235831281.png', 0, 1),
(3, 0, 1, 1, 'ghe nhua cao cap', 100000, 'ghe nhua cao cap', '', 0, 0),
(3, 4, 1, 1, 'ghe nhua cao cap', 100000, 'ghe nhua cao cap', 'th.jpg', 2, 0),
(4, 0, 1, 1, 'ghế nhựa Vergil', 100000, 'ngồi phê lắm', '', 0, 0),
(4, 2, 1, 1, 'ghế nhựa Vergil', 100000, 'ngồi phê lắm', 'image_2024-05-15_014429249.png', 944, 1),
(5, 0, 2, 1, 'asd', 100000, 'asd', '', 0, 0),
(5, 2, 2, 1, 'asd', 100000, 'asd', 'image_2024-05-15_015657079.png', 0, 1),
(6, 0, 1, 2, 'asd', 213, 'asd', '', 0, 0),
(6, 4, 1, 2, 'asd', 213, 'asd', 'image_2024-05-15_015705734.png', 0, 1),
(7, 0, 2, 2, 'ghe sofa ', 2, 'ghe sofa ', '', 0, 0),
(7, 4, 2, 2, 'ghe sofa ', 2, 'ghe sofa ', 'image_2024-05-15_015734790.png', 0, 1),
(8, 0, 1, 1, 'kkkk', 100001, 'kkkk', '', 0, 0),
(8, 6, 1, 1, 'kkkk', 100001, 'kkkk', 'default.jpg', 0, 1),
(9, 0, 1, 1, 'kkkk', 13123, 'ưqwq', '', 0, 0),
(10, 0, 1, 1, 'vnsjfvnjdf', 635, '321', '', 0, 0),
(10, 5, 1, 1, 'vnsjfvnjdf', 635, '321', 'image_2024-05-12_235758134.png', 0, 1),
(11, 0, 1, 1, 'uuuu', 0, 'dsxa', '', 0, 0),
(11, 1, 1, 1, 'uuuu', 0, 'dsxa', 'image_2024-05-12_235129135.png', 0, 1),
(12, 0, 1, 1, 'abc', 1, '2', '', 0, 0),
(13, 0, 1, 1, 'dsadsamk', 0, 'dasdsa', '', 0, 0),
(14, 0, 1, 2, 'Anh', 0, 'Anh123', '', 0, 0),
(14, 3, 1, 2, 'Anh', 0, 'Anh123', 'default.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `idnguoidung` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ngaytao` date NOT NULL,
  `vaitro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`idnguoidung`, `username`, `password`, `ngaytao`, `vaitro`) VALUES
(1, 'admin', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-04-15', 4),
(2, 'admin1', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-05-10', 3),
(3, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', '2024-04-15', 1),
(4, 'user5', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-09-15', 1),
(5, 'user6', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-10-01', 1),
(6, 'dsadsa', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-10-14', 3),
(7, '2e21', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-10-14', 3),
(8, 'few', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-10-14', 4),
(9, 'csak', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-10-14', 2),
(10, 'sad', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-10-14', 3),
(11, 'dưok', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-10-14', 2),
(12, 'ư1w1', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-10-14', 2),
(13, 'xsx', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-10-14', 3),
(14, 'admin123', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-10-15', 5),
(15, 'admin456', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-10-15', 6),
(16, 'user10', 'e2b420cc9ebe16a0d170dd1b1b22f08c', '2024-10-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vaitro`
--

CREATE TABLE `vaitro` (
  `idvaitro` int(11) NOT NULL,
  `tenvaitro` varchar(50) NOT NULL,
  `mota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaitro`
--

INSERT INTO `vaitro` (`idvaitro`, `tenvaitro`, `mota`) VALUES
(1, 'khachhang', 'khach hang'),
(2, 'default', 'role mac dinh '),
(3, 'admin', 'admin'),
(4, '12345', 'quản lý nhập kho'),
(5, 'no edit', ''),
(6, 'admin456', 'no1234');

-- --------------------------------------------------------

--
-- Table structure for table `yeuthich`
--

CREATE TABLE `yeuthich` (
  `idsanpham` int(11) NOT NULL,
  `idnguoidung` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`idhoadon`,`idsanpham`,`idmau`),
  ADD KEY `consthdsanpham` (`idsanpham`,`idmau`);

--
-- Indexes for table `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD PRIMARY KEY (`idphieunhap`,`idsanpham`,`idmau`),
  ADD KEY `idsanpham` (`idsanpham`),
  ADD KEY `idmau` (`idmau`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`idnguoidung`,`idsanpham`,`idmau`),
  ADD KEY `constsp_mau` (`idmau`,`idsanpham`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`idhoadon`),
  ADD KEY `constidxacnhan` (`idphutrach`) USING BTREE,
  ADD KEY `constidmua` (`idnguoidung`) USING BTREE;

--
-- Indexes for table `loai`
--
ALTER TABLE `loai`
  ADD PRIMARY KEY (`idloai`);

--
-- Indexes for table `mau`
--
ALTER TABLE `mau`
  ADD PRIMARY KEY (`idmau`);

--
-- Indexes for table `mottaquyen`
--
ALTER TABLE `mottaquyen`
  ADD PRIMARY KEY (`idquyen`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`idnguoidung`);

--
-- Indexes for table `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`idphieunhap`),
  ADD KEY `constnguoinhap` (`idnguoinhap`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`idphong`);

--
-- Indexes for table `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`idvaitro`,`idquyen`),
  ADD KEY `idquyen` (`idquyen`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`idsanpham`,`idmau`),
  ADD KEY `constphong` (`idphong`),
  ADD KEY `constmau` (`idmau`),
  ADD KEY `constloai` (`idloai`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`idnguoidung`),
  ADD KEY `cosntvaitro` (`vaitro`);

--
-- Indexes for table `vaitro`
--
ALTER TABLE `vaitro`
  ADD PRIMARY KEY (`idvaitro`);

--
-- Indexes for table `yeuthich`
--
ALTER TABLE `yeuthich`
  ADD PRIMARY KEY (`idsanpham`,`idnguoidung`),
  ADD KEY `constyeuthich` (`idnguoidung`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `consthdsanpham` FOREIGN KEY (`idsanpham`,`idmau`) REFERENCES `sanpham` (`idsanpham`, `idmau`),
  ADD CONSTRAINT `consthoadon` FOREIGN KEY (`idhoadon`) REFERENCES `hoadon` (`idhoadon`);

--
-- Constraints for table `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD CONSTRAINT `chitietphieunhap_ibfk_1` FOREIGN KEY (`idphieunhap`) REFERENCES `phieunhap` (`idphieunhap`),
  ADD CONSTRAINT `chitietphieunhap_ibfk_2` FOREIGN KEY (`idsanpham`) REFERENCES `sanpham` (`idsanpham`),
  ADD CONSTRAINT `chitietphieunhap_ibfk_3` FOREIGN KEY (`idmau`) REFERENCES `sanpham` (`idmau`);

--
-- Constraints for table `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `constsp_mau` FOREIGN KEY (`idmau`,`idsanpham`) REFERENCES `sanpham` (`idmau`, `idsanpham`),
  ADD CONSTRAINT `cosntnguoidung` FOREIGN KEY (`idnguoidung`) REFERENCES `nguoidung` (`idnguoidung`);

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`idnguoidung`) REFERENCES `taikhoan` (`idnguoidung`),
  ADD CONSTRAINT `hoadon_ibfk_2` FOREIGN KEY (`idphutrach`) REFERENCES `taikhoan` (`idnguoidung`);

--
-- Constraints for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD CONSTRAINT `nguoidung_ibfk_1` FOREIGN KEY (`idnguoidung`) REFERENCES `taikhoan` (`idnguoidung`);

--
-- Constraints for table `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `phieunhap_ibfk_1` FOREIGN KEY (`idnguoinhap`) REFERENCES `taikhoan` (`idnguoidung`);

--
-- Constraints for table `quyen`
--
ALTER TABLE `quyen`
  ADD CONSTRAINT `quyen_ibfk_1` FOREIGN KEY (`idvaitro`) REFERENCES `vaitro` (`idvaitro`),
  ADD CONSTRAINT `quyen_ibfk_2` FOREIGN KEY (`idquyen`) REFERENCES `mottaquyen` (`idquyen`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `constloai` FOREIGN KEY (`idloai`) REFERENCES `loai` (`idloai`),
  ADD CONSTRAINT `constmau` FOREIGN KEY (`idmau`) REFERENCES `mau` (`idmau`),
  ADD CONSTRAINT `constphong` FOREIGN KEY (`idphong`) REFERENCES `phong` (`idphong`);

--
-- Constraints for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `cosntvaitro` FOREIGN KEY (`vaitro`) REFERENCES `vaitro` (`idvaitro`);

--
-- Constraints for table `yeuthich`
--
ALTER TABLE `yeuthich`
  ADD CONSTRAINT `constyeuthich` FOREIGN KEY (`idnguoidung`) REFERENCES `taikhoan` (`idnguoidung`),
  ADD CONSTRAINT `yeuthich_ibfk_1` FOREIGN KEY (`idsanpham`) REFERENCES `sanpham` (`idsanpham`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
