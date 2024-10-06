-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 14, 2024 at 10:38 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
  `idhoadon` int NOT NULL,
  `idsanpham` int NOT NULL,
  `idmau` int NOT NULL,
  `soluong` int NOT NULL,
  `dongia` bigint NOT NULL,
  `thanhtien` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`idhoadon`, `idsanpham`, `idmau`, `soluong`, `dongia`, `thanhtien`) VALUES
(1, 2, 5, 12, 10000, 120000),
(2, 2, 3, 1, 10000, 10000),
(3, 1, 2, 4, 2000000, 8000000),
(3, 2, 5, 4, 10000, 40000),
(4, 2, 3, 2, 10000, 20000),
(4, 2, 4, 1, 10000, 10000),
(4, 2, 6, 1, 10000, 10000),
(4, 3, 4, 1, 100000, 100000),
(5, 4, 2, 10, 100000, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `chitietphieunhap`
--

CREATE TABLE `chitietphieunhap` (
  `idphieunhap` int NOT NULL,
  `idsanpham` int NOT NULL,
  `idmau` int NOT NULL,
  `soluong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chitietphieunhap`
--

INSERT INTO `chitietphieunhap` (`idphieunhap`, `idsanpham`, `idmau`, `soluong`) VALUES
(1, 2, 3, 100),
(1, 2, 4, 100),
(2, 2, 5, 100),
(6, 4, 2, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `idnguoidung` int NOT NULL,
  `idsanpham` int NOT NULL,
  `idmau` int NOT NULL,
  `soluong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `idhoadon` int NOT NULL,
  `idnguoidung` int NOT NULL,
  `thoigiandat` date NOT NULL,
  `trangthai` int NOT NULL,
  `idphutrach` int DEFAULT NULL,
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
(5, 3, '2024-05-14', 2, 1, '23122003');

-- --------------------------------------------------------

--
-- Table structure for table `loai`
--

CREATE TABLE `loai` (
  `idloai` int NOT NULL,
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
  `idmau` int NOT NULL,
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
  `idquyen` int NOT NULL,
  `mota` varchar(100) NOT NULL,
  `model` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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
  `idnguoidung` int NOT NULL,
  `hoten` varchar(100) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `trangthai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`idnguoidung`, `hoten`, `sdt`, `diachi`, `email`, `trangthai`) VALUES
(1, 'admin', '0938023118', '23122003', 'admin@gmail.com', 1),
(2, 'Luong gia tuan', '0938023118', '23122003', 'tuandj23122003@gmail.com', 1),
(3, 'user', '0938023118', 'tp hcm', 'user@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `phieunhap`
--

CREATE TABLE `phieunhap` (
  `idphieunhap` int NOT NULL,
  `idnguoinhap` int NOT NULL,
  `ngaynhap` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phieunhap`
--

INSERT INTO `phieunhap` (`idphieunhap`, `idnguoinhap`, `ngaynhap`) VALUES
(1, 1, '2024-05-12'),
(2, 1, '2024-05-13'),
(6, 1, '2024-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `idphong` int NOT NULL,
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
  `idvaitro` int NOT NULL,
  `idquyen` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quyen`
--

INSERT INTO `quyen` (`idvaitro`, `idquyen`) VALUES
(3, 1),
(3, 2),
(4, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(4, 8),
(3, 9),
(4, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16);

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `idsanpham` int NOT NULL,
  `idmau` int NOT NULL,
  `idphong` int NOT NULL,
  `idloai` int NOT NULL,
  `tensanpham` varchar(100) NOT NULL,
  `gia` bigint NOT NULL,
  `mota` varchar(100) NOT NULL,
  `hinh` varchar(100) NOT NULL,
  `soLuong` int NOT NULL,
  `trangthai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`idsanpham`, `idmau`, `idphong`, `idloai`, `tensanpham`, `gia`, `mota`, `hinh`, `soLuong`, `trangthai`) VALUES
(1, 0, 1, 1, 'ghế sofa uppland', 2000000, 'ghế sofa cao cấp', '', 0, 0),
(1, 2, 1, 1, 'ghế sofa uppland', 2000000, 'ghế sofa cao cấp', 'th.jpg', 0, 1),
(2, 0, 1, 1, 'ghế nhựa', 10000, 'ghế nhựa Vergil', '', 0, 0),
(2, 3, 1, 1, 'ghế nhựa', 10000, 'ghế nhựa Vergil', 'image_2024-05-12_235147442.png', 100, 1),
(2, 4, 1, 1, 'ghế nhựa', 10000, 'ghế nhựa Vergil', 'image_2024-05-12_235129135.png', 100, 1),
(2, 5, 1, 1, 'ghế nhựa', 10000, 'ghế nhựa Vergil', 'image_2024-05-12_235758134.png', 88, 1),
(2, 6, 1, 1, 'ghế nhựa', 10000, 'ghế nhựa Vergil', 'image_2024-05-12_235831281.png', 0, 1),
(3, 0, 1, 1, 'ghe nhua cao cap', 100000, 'ghe nhua cao cap', '', 0, 0),
(3, 4, 1, 1, 'ghe nhua cao cap', 100000, 'ghe nhua cao cap', 'th.jpg', 0, 1),
(4, 0, 1, 1, 'ghế nhựa Vergil', 100000, 'ngồi phê lắm', '', 0, 0),
(4, 2, 1, 1, 'ghế nhựa Vergil', 100000, 'ngồi phê lắm', 'image_2024-05-15_014429249.png', 940, 1),
(5, 0, 2, 1, 'asd', 100000, 'asd', '', 0, 0),
(5, 2, 2, 1, 'asd', 100000, 'asd', 'image_2024-05-15_015657079.png', 0, 1),
(6, 0, 2, 1, 'asd', 213, 'asd', '', 0, 0),
(6, 4, 2, 1, 'asd', 213, 'asd', 'image_2024-05-15_015705734.png', 0, 1),
(7, 0, 2, 2, 'ghe sofa ', 2, 'ghe sofa ', '', 0, 0),
(7, 4, 2, 2, 'ghe sofa ', 2, 'ghe sofa ', 'image_2024-05-15_015734790.png', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `idnguoidung` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ngaytao` date NOT NULL,
  `vaitro` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`idnguoidung`, `username`, `password`, `ngaytao`, `vaitro`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2024-04-15', 3),
(2, 'zdnghost', '444db57c96106e7f5c8a4941dab449d8', '2024-05-10', 3),
(3, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', '2024-04-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vaitro`
--

CREATE TABLE `vaitro` (
  `idvaitro` int NOT NULL,
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
(4, 'supplyer', 'quản lý nhập kho');

-- --------------------------------------------------------

--
-- Table structure for table `yeuthich`
--

CREATE TABLE `yeuthich` (
  `idsanpham` int NOT NULL,
  `idnguoidung` int NOT NULL
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
  ADD CONSTRAINT `consthdsanpham` FOREIGN KEY (`idsanpham`,`idmau`) REFERENCES `sanpham` (`idsanpham`, `idmau`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `consthoadon` FOREIGN KEY (`idhoadon`) REFERENCES `hoadon` (`idhoadon`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
  ADD CONSTRAINT `constsp_mau` FOREIGN KEY (`idmau`,`idsanpham`) REFERENCES `sanpham` (`idmau`, `idsanpham`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cosntnguoidung` FOREIGN KEY (`idnguoidung`) REFERENCES `nguoidung` (`idnguoidung`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
  ADD CONSTRAINT `nguoidung_ibfk_1` FOREIGN KEY (`idnguoidung`) REFERENCES `taikhoan` (`idnguoidung`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `phieunhap_ibfk_1` FOREIGN KEY (`idnguoinhap`) REFERENCES `taikhoan` (`idnguoidung`);

--
-- Constraints for table `quyen`
--
ALTER TABLE `quyen`
  ADD CONSTRAINT `quyen_ibfk_1` FOREIGN KEY (`idvaitro`) REFERENCES `vaitro` (`idvaitro`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `quyen_ibfk_2` FOREIGN KEY (`idquyen`) REFERENCES `mottaquyen` (`idquyen`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `constloai` FOREIGN KEY (`idloai`) REFERENCES `loai` (`idloai`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `constmau` FOREIGN KEY (`idmau`) REFERENCES `mau` (`idmau`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `constphong` FOREIGN KEY (`idphong`) REFERENCES `phong` (`idphong`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `cosntvaitro` FOREIGN KEY (`vaitro`) REFERENCES `vaitro` (`idvaitro`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `yeuthich`
--
ALTER TABLE `yeuthich`
  ADD CONSTRAINT `constyeuthich` FOREIGN KEY (`idnguoidung`) REFERENCES `taikhoan` (`idnguoidung`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `yeuthich_ibfk_1` FOREIGN KEY (`idsanpham`) REFERENCES `sanpham` (`idsanpham`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
