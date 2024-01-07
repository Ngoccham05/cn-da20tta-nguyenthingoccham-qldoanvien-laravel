-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 07, 2024 lúc 09:05 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ql_doanvien`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bieumau`
--

CREATE TABLE `bieumau` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenbm` varchar(100) NOT NULL,
  `duongdan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bieumau`
--

INSERT INTO `bieumau` (`id`, `tenbm`, `duongdan`) VALUES
(5, 'Danh sách tham gia hoạt động', 'bieumau/Danh sách tham gia hoạt động.docx'),
(6, 'Biên bản họp chi đoàn', 'bieumau/Biên bản họp chi đoàn.docx'),
(7, 'Kế hoạch', 'bieumau/Kế hoạch.docx'),
(10, 'HD đánh giá, xếp loại chất lượng hằng năm đối với tổ chức Đoàn, tập thể lãnh đạo và cá nhân', 'bieumau/HD đánh giá, xếp loại chất lượng hằng năm đối với tổ chức Đoàn, tập thể lãnh đạo và cá nhân.pdf');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chidoan`
--

CREATE TABLE `chidoan` (
  `macd` varchar(10) NOT NULL,
  `tencd` varchar(50) NOT NULL,
  `manganh` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chidoan`
--

INSERT INTO `chidoan` (`macd`, `tencd`, `manganh`) VALUES
('DA20DT', 'Đại học Công nghệ Điện, Điện tử khóa 20', 2),
('DA20TTA', 'Đại học Công nghệ Thông tin A khóa 20', 1),
('DA20TTB', 'Đại học Công nghệ Thông tin B khóa 20', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucvu`
--

CREATE TABLE `chucvu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tencv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chucvu`
--

INSERT INTO `chucvu` (`id`, `tencv`) VALUES
(1, 'Bí thư Đoàn khoa'),
(2, 'Phó bí thư Đoàn khoa'),
(3, 'UV thường vụ Đoàn khoa'),
(4, 'UV Ban chấp hành Đoàn khoa'),
(5, 'Bí thư Chi đoàn'),
(6, 'Phó bí thư Chi đoàn'),
(7, 'UV Chi đoàn'),
(8, 'Đoàn viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgiacd`
--

CREATE TABLE `danhgiacd` (
  `macd` varchar(10) NOT NULL,
  `maloaicd` bigint(20) UNSIGNED NOT NULL,
  `madot` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhgiacd`
--

INSERT INTO `danhgiacd` (`macd`, `maloaicd`, `madot`) VALUES
('DA20TTA', 3, 'cuoi-23'),
('DA20TTB', 3, 'cuoi-23'),
('DA20DT', 4, 'cuoi-23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgiadv`
--

CREATE TABLE `danhgiadv` (
  `madv` varchar(10) NOT NULL,
  `maloaidv` bigint(20) UNSIGNED NOT NULL,
  `madot` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhgiadv`
--

INSERT INTO `danhgiadv` (`madv`, `maloaidv`, `madot`) VALUES
('110120002', 1, 'nam-23'),
('110120014', 1, 'cuoi-23'),
('110120019', 1, 'cuoi-23'),
('110120051', 1, 'cuoi-23'),
('110120004', 2, 'nam-23'),
('110120010', 2, 'cuoi-23'),
('110120013', 2, 'cuoi-23'),
('110120026', 2, 'cuoi-23'),
('110120054', 2, 'cuoi-23'),
('110120166', 2, 'cuoi-23'),
('110120002', 3, 'cuoi-23'),
('110120004', 3, 'cuoi-23'),
('110120008', 3, 'nam-23'),
('110120029', 3, 'cuoi-23'),
('110120034', 3, 'cuoi-23'),
('110120060', 3, 'cuoi-23'),
('110120071', 3, 'nam-23'),
('110120084', 3, 'cuoi-23'),
('110120001', 4, 'nam-23'),
('110120007', 4, 'cuoi-23'),
('110120049', 4, 'cuoi-23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dattc`
--

CREATE TABLE `dattc` (
  `madv` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `matc` bigint(20) NOT NULL,
  `madot` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `minhchung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dattc`
--

INSERT INTO `dattc` (`madv`, `matc`, `madot`, `minhchung`) VALUES
('110120002', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120002', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120002', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120002', 6, 'cuoi-23', 'https://drive.google.com/file/d/1FafDsKV9RebONkjc2RezMWle2pXuuu0K/view?usp=sharing'),
('110120002', 9, 'cuoi-23', 'https://drive.google.com/file/d/1SePckClxmTB7J49EDstA44Mena1AqsbK/view?usp=sharing'),
('110120002', 11, 'cuoi-23', 'https://drive.google.com/file/d/13SIfYYAyiUkm459WpUkr40UI6v2rTOUp/view?usp=sharing'),
('110120004', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120004', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120004', 7, 'cuoi-23', 'https://drive.google.com/file/d/15KyIu_LFMOlomgbG_OvxuvDHQkVU5XMZ/view?usp=sharing'),
('110120004', 9, 'cuoi-23', 'https://drive.google.com/file/d/1SePckClxmTB7J49EDstA44Mena1AqsbK/view?usp=sharing'),
('110120004', 11, 'cuoi-23', 'https://drive.google.com/file/d/13SIfYYAyiUkm459WpUkr40UI6v2rTOUp/view?usp=sharing'),
('110120010', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120010', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120010', 4, 'cuoi-23', 'https://drive.google.com/file/d/1IYvtBOxx8IYJQJT4TFVXAPRYy96m0ce2/view?usp=sharing'),
('110120010', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120010', 6, 'cuoi-23', 'https://drive.google.com/file/d/1FafDsKV9RebONkjc2RezMWle2pXuuu0K/view?usp=sharing'),
('110120010', 7, 'cuoi-23', 'https://drive.google.com/file/d/15KyIu_LFMOlomgbG_OvxuvDHQkVU5XMZ/view?usp=sharing'),
('110120010', 11, 'cuoi-23', 'https://drive.google.com/file/d/13SIfYYAyiUkm459WpUkr40UI6v2rTOUp/view?usp=sharing'),
('110120013', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120013', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120013', 4, 'cuoi-23', 'https://drive.google.com/file/d/1IYvtBOxx8IYJQJT4TFVXAPRYy96m0ce2/view?usp=sharing'),
('110120013', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120013', 6, 'cuoi-23', 'https://drive.google.com/file/d/1FafDsKV9RebONkjc2RezMWle2pXuuu0K/view?usp=sharing'),
('110120013', 7, 'cuoi-23', 'https://drive.google.com/file/d/15KyIu_LFMOlomgbG_OvxuvDHQkVU5XMZ/view?usp=sharing'),
('110120013', 9, 'cuoi-23', 'https://drive.google.com/file/d/1SePckClxmTB7J49EDstA44Mena1AqsbK/view?usp=sharing'),
('110120014', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120014', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120014', 4, 'cuoi-23', 'https://drive.google.com/file/d/1IYvtBOxx8IYJQJT4TFVXAPRYy96m0ce2/view?usp=sharing'),
('110120014', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120014', 6, 'cuoi-23', 'https://drive.google.com/file/d/1FafDsKV9RebONkjc2RezMWle2pXuuu0K/view?usp=sharing'),
('110120014', 7, 'cuoi-23', 'https://drive.google.com/file/d/15KyIu_LFMOlomgbG_OvxuvDHQkVU5XMZ/view?usp=sharing'),
('110120014', 8, 'cuoi-23', 'https://drive.google.com/file/d/11Wc7dMaRKXHVuvoJpwrCf1hrRKFEereO/view?usp=sharing'),
('110120014', 9, 'cuoi-23', 'https://drive.google.com/file/d/1SePckClxmTB7J49EDstA44Mena1AqsbK/view?usp=sharing'),
('110120014', 11, 'cuoi-23', 'https://drive.google.com/file/d/13SIfYYAyiUkm459WpUkr40UI6v2rTOUp/view?usp=sharing'),
('110120019', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120019', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120019', 4, 'cuoi-23', 'https://drive.google.com/file/d/1IYvtBOxx8IYJQJT4TFVXAPRYy96m0ce2/view?usp=sharing'),
('110120019', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120019', 6, 'cuoi-23', 'https://drive.google.com/file/d/1FafDsKV9RebONkjc2RezMWle2pXuuu0K/view?usp=sharing'),
('110120019', 7, 'cuoi-23', 'https://drive.google.com/file/d/15KyIu_LFMOlomgbG_OvxuvDHQkVU5XMZ/view?usp=sharing'),
('110120019', 8, 'cuoi-23', 'https://drive.google.com/file/d/11Wc7dMaRKXHVuvoJpwrCf1hrRKFEereO/view?usp=sharing'),
('110120019', 9, 'cuoi-23', 'https://drive.google.com/file/d/1SePckClxmTB7J49EDstA44Mena1AqsbK/view?usp=sharing'),
('110120019', 11, 'cuoi-23', 'https://drive.google.com/file/d/13SIfYYAyiUkm459WpUkr40UI6v2rTOUp/view?usp=sharing'),
('110120026', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120026', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120026', 4, 'cuoi-23', 'https://drive.google.com/file/d/1IYvtBOxx8IYJQJT4TFVXAPRYy96m0ce2/view?usp=sharing'),
('110120026', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120026', 6, 'cuoi-23', 'https://drive.google.com/file/d/1FafDsKV9RebONkjc2RezMWle2pXuuu0K/view?usp=sharing'),
('110120026', 7, 'cuoi-23', 'https://drive.google.com/file/d/15KyIu_LFMOlomgbG_OvxuvDHQkVU5XMZ/view?usp=sharing'),
('110120026', 9, 'cuoi-23', 'https://drive.google.com/file/d/1SePckClxmTB7J49EDstA44Mena1AqsbK/view?usp=sharing'),
('110120029', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120029', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120029', 4, 'cuoi-23', 'https://drive.google.com/file/d/1IYvtBOxx8IYJQJT4TFVXAPRYy96m0ce2/view?usp=sharing'),
('110120029', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120031', 1, 'cuoi-23', NULL),
('110120034', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120034', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120034', 4, 'cuoi-23', 'https://drive.google.com/file/d/1IYvtBOxx8IYJQJT4TFVXAPRYy96m0ce2/view?usp=sharing'),
('110120034', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120034', 6, 'cuoi-23', 'https://drive.google.com/file/d/1FafDsKV9RebONkjc2RezMWle2pXuuu0K/view?usp=sharing'),
('110120034', 7, 'cuoi-23', 'https://drive.google.com/file/d/15KyIu_LFMOlomgbG_OvxuvDHQkVU5XMZ/view?usp=sharing'),
('110120049', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120049', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120049', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120051', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120051', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120051', 4, 'cuoi-23', 'https://drive.google.com/file/d/1IYvtBOxx8IYJQJT4TFVXAPRYy96m0ce2/view?usp=sharing'),
('110120051', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120051', 6, 'cuoi-23', 'https://drive.google.com/file/d/1FafDsKV9RebONkjc2RezMWle2pXuuu0K/view?usp=sharing'),
('110120051', 7, 'cuoi-23', 'https://drive.google.com/file/d/15KyIu_LFMOlomgbG_OvxuvDHQkVU5XMZ/view?usp=sharing'),
('110120051', 8, 'cuoi-23', 'https://drive.google.com/file/d/11Wc7dMaRKXHVuvoJpwrCf1hrRKFEereO/view?usp=sharing'),
('110120051', 9, 'cuoi-23', 'https://drive.google.com/file/d/1SePckClxmTB7J49EDstA44Mena1AqsbK/view?usp=sharing'),
('110120051', 11, 'cuoi-23', 'https://drive.google.com/file/d/13SIfYYAyiUkm459WpUkr40UI6v2rTOUp/view?usp=sharing'),
('110120054', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120054', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120054', 4, 'cuoi-23', 'https://drive.google.com/file/d/1IYvtBOxx8IYJQJT4TFVXAPRYy96m0ce2/view?usp=sharing'),
('110120054', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120054', 6, 'cuoi-23', 'https://drive.google.com/file/d/1FafDsKV9RebONkjc2RezMWle2pXuuu0K/view?usp=sharing'),
('110120054', 8, 'cuoi-23', 'https://drive.google.com/file/d/11Wc7dMaRKXHVuvoJpwrCf1hrRKFEereO/view?usp=sharing'),
('110120054', 11, 'cuoi-23', 'https://drive.google.com/file/d/13SIfYYAyiUkm459WpUkr40UI6v2rTOUp/view?usp=sharing'),
('110120060', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120060', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120060', 4, 'cuoi-23', 'https://drive.google.com/file/d/1IYvtBOxx8IYJQJT4TFVXAPRYy96m0ce2/view?usp=sharing'),
('110120060', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120060', 6, 'cuoi-23', 'https://drive.google.com/file/d/1FafDsKV9RebONkjc2RezMWle2pXuuu0K/view?usp=sharing'),
('110120060', 7, 'cuoi-23', 'https://drive.google.com/file/d/15KyIu_LFMOlomgbG_OvxuvDHQkVU5XMZ/view?usp=sharing'),
('110120071', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120071', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120071', 4, 'cuoi-23', 'https://drive.google.com/file/d/1IYvtBOxx8IYJQJT4TFVXAPRYy96m0ce2/view?usp=sharing'),
('110120071', 5, 'cuoi-23', NULL),
('110120084', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120084', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120084', 4, 'cuoi-23', 'https://drive.google.com/file/d/1IYvtBOxx8IYJQJT4TFVXAPRYy96m0ce2/view?usp=sharing'),
('110120084', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120084', 7, 'cuoi-23', 'https://drive.google.com/file/d/15KyIu_LFMOlomgbG_OvxuvDHQkVU5XMZ/view?usp=sharing'),
('110120166', 2, 'cuoi-23', 'https://drive.google.com/file/d/1k_YZegz4EM5O-If9PpjeLhlOuYsYB5i0/view?usp=sharing'),
('110120166', 3, 'cuoi-23', 'https://drive.google.com/file/d/10noU_N8iUoxtt9Nir6oP2nf_YCUL10Qa/view?usp=sharing'),
('110120166', 4, 'cuoi-23', 'https://drive.google.com/file/d/1IYvtBOxx8IYJQJT4TFVXAPRYy96m0ce2/view?usp=sharing'),
('110120166', 5, 'cuoi-23', 'https://drive.google.com/file/d/1fa4-P93GTXedAD8WJ567kiBfCOqAqSsh/view?usp=sharing'),
('110120166', 6, 'cuoi-23', 'https://drive.google.com/file/d/1FafDsKV9RebONkjc2RezMWle2pXuuu0K/view?usp=sharing'),
('110120166', 7, 'cuoi-23', 'https://drive.google.com/file/d/15KyIu_LFMOlomgbG_OvxuvDHQkVU5XMZ/view?usp=sharing'),
('110120166', 9, 'cuoi-23', 'https://drive.google.com/file/d/1SePckClxmTB7J49EDstA44Mena1AqsbK/view?usp=sharing');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doanvien`
--

CREATE TABLE `doanvien` (
  `madv` varchar(10) NOT NULL,
  `hoten` varchar(50) NOT NULL,
  `gioitinh` varchar(3) NOT NULL,
  `ngaysinh` date NOT NULL,
  `sdt` varchar(10) DEFAULT NULL,
  `diachi` varchar(50) DEFAULT NULL,
  `ngayvaodoan` date DEFAULT NULL,
  `noivaodoan` varchar(100) DEFAULT NULL,
  `macd` varchar(10) NOT NULL,
  `macv` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `doanvien`
--

INSERT INTO `doanvien` (`madv`, `hoten`, `gioitinh`, `ngaysinh`, `sdt`, `diachi`, `ngayvaodoan`, `noivaodoan`, `macd`, `macv`) VALUES
('110120001', 'Nguyễn Văn An', 'Nam', '2002-03-06', '0152013617', 'Trà Vinh', '2018-03-02', 'Trà Vinh', 'DA20DT', 8),
('110120002', 'Huỳnh Trần Tuấn Anh', 'Nam', '1994-06-24', '0131750376', 'Trà Vinh', '2018-03-02', 'Trà Vinh', 'DA20TTA', 8),
('110120004', 'Trần Tiến Anh', 'Nam', '2002-12-18', '0425064969', 'Trà Vinh', '2022-03-26', 'Trà Vinh', 'DA20TTA', 8),
('110120007', 'Lâm Chí Nhân', 'Nam', '2002-01-24', '0446572223', 'Trà Vinh', '2022-03-26', 'Trà Vinh', 'DA20TTB', 8),
('110120008', 'Nguyễn Thị Ngọc Chăm', 'Nữ', '2002-05-09', '0397256411', 'Châu Thành, Trà Vinh', '2018-03-02', 'Trà Vinh', 'DA20TTA', 6),
('110120010', 'Hà Minh Chiến', 'Nam', '2002-01-30', '0491171767', 'Trà Vinh', '2022-03-26', 'Trà Vinh', 'DA20TTA', 8),
('110120011', 'Trần Quốc Bình', 'Nam', '2001-02-02', '0335115995', 'Vĩnh Long', '2022-03-26', 'Trà Vinh', 'DA20TTB', 8),
('110120013', 'Nguyễn Minh Đăng', 'Nam', '2002-01-01', '0591159876', 'Trà Vinh', '2022-03-26', 'Trà Vinh', 'DA20TTB', 8),
('110120014', 'Trần Nguyễn Võ Minh Đăng', 'Nam', '2002-03-25', '0502151657', 'Vĩnh Long', '2022-03-26', 'Vĩnh Long', 'DA20TTA', 8),
('110120019', 'Phạm Quyển Đình', 'Nữ', '2002-04-30', '0208090981', 'Trà Vinh', '2022-03-26', 'Trà Vinh', 'DA20TTB', 8),
('110120026', 'Lâm Ngọc Hân', 'Nữ', '2002-09-02', '0553193206', 'Cần Thơ', '2018-03-02', 'Cần Thơ', 'DA20TTA', 7),
('110120029', 'Huỳnh Hữu Hiếu', 'Nam', '2002-02-01', '0350236800', 'Trà Vinh', '2022-03-26', 'Trà Vinh', 'DA20TTA', 8),
('110120031', 'Trần Thái Hưng', 'Nam', '2001-03-16', '0212004144', 'Vĩnh Long', '2018-03-02', 'Vĩnh Long', 'DA20TTB', 8),
('110120034', 'Trương Vũ Huy', 'Nam', '2002-08-31', '0871204111', 'Sóc Trăng', '2018-03-02', 'Sóc Trăng', 'DA20TTA', 8),
('110120037', 'Phan Vĩ Khang', 'Nam', '2002-10-28', '0448070277', 'Trà Vinh', '2021-03-26', 'Trà Vinh', 'DA20TTB', 8),
('110120038', 'Trần Thị Mỹ Khánh', 'Nữ', '2002-08-01', '0565138471', 'Trà Vinh', '2021-03-26', 'Trà Vinh', 'DA20TTB', 8),
('110120049', 'Lê Bảo Nghi', 'Nữ', '2002-10-02', '0318006397', 'Sóc Trăng', '2021-03-26', 'Sóc Trăng', 'DA20TTA', 8),
('110120051', 'Trần Trọng Nhân', 'Nam', '2002-09-06', '0610989169', 'Trà Vinh', '2021-03-26', 'Trà Vinh', 'DA20TTA', 3),
('110120054', 'Lê Đức Nhuận', 'Nam', '2002-12-27', '0789542565', 'Trà Vinh', '2021-03-26', 'Trà Vinh', 'DA20TTA', 8),
('110120060', 'Kim Thị Sô Phi', 'Nữ', '2000-01-11', '0874962233', 'Trà Vinh', '2021-03-26', 'Trà Vinh', 'DA20TTA', 8),
('110120064', 'Tăng Xuân Lộc', 'Nam', '2001-10-30', '0839465966', 'Trà Vinh', '2019-03-26', 'Trà Vinh', 'DA20TTB', 8),
('110120070', 'Lê Thị Hiếu Thảo', 'Nữ', '2002-08-12', '0960632111', 'Trà Vinh', '2019-03-26', 'Trà Vinh', 'DA20TTB', 8),
('110120071', 'Nguyễn Ngọc Thịnh', 'Nam', '2002-03-01', '0370548506', 'Trà Vinh', '2019-03-26', 'Trà Vinh', 'DA20TTA', 8),
('110120078', 'Nguyễn Trọng Tín', 'Nam', '2002-11-03', '0711123262', 'Trà Vinh', '2019-03-26', 'Trà Vinh', 'DA20TTB', 8),
('110120081', 'Nguyễn Triến', 'Nam', '2002-02-27', '0688657681', 'Trà Vinh', '2020-03-26', 'Trà Vinh', 'DA20TTA', 8),
('110120084', 'Trần Phúc Vĩ', 'Nam', '2002-07-21', '0981506129', 'Trà Vinh', '2019-03-26', 'Trà Vinh', 'DA20TTA', 8),
('110120087', 'Nguyễn Thị Mỹ Yến', 'Nữ', '2002-05-01', '0474156296', 'Trà Vinh', '2020-03-26', 'Trà Vinh', 'DA20TTB', 8),
('110120092', 'Nguyễn Thái Điền', 'Nam', '2002-12-19', '0629009362', 'Trà Vinh', '2020-03-26', 'Trà Vinh', 'DA20TTB', 7),
('110120128', 'Huỳnh Gia Bảo', 'Nam', '2002-03-26', '0989893758', 'Trà Vinh', '2020-03-26', 'Trà Vinh', 'DA20TTA', 7),
('110120146', 'Kim Thanh Ái Nhân', 'Nữ', '2001-01-19', '0993774226', 'Trà Vinh', '2020-03-26', 'Trà Vinh', 'DA20TTB', 5),
('110120164', 'Mạch Khánh Duy', 'Nam', '2001-08-03', '0360847432', 'Trà Vinh', '2020-03-26', 'Trà Vinh', 'DA20TTA', 8),
('110120166', 'Ngô Tấn Lợi', 'Nam', '2002-12-04', '0197862508', 'Trà Vinh', '2020-03-26', 'Trà Vinh', 'DA20TTA', 8),
('110120171', 'Trần Huỳnh Khang', 'Nam', '2002-06-23', '0429476994', 'Trà Vinh', '2020-03-26', 'Trà Vinh', 'DA20TTB', 8),
('110120177', 'Trần Trung Bình', 'Nam', '2002-01-10', '0397255641', 'Trà Vinh', '2020-03-26', 'Trà Vinh', 'DA20TTB', 8),
('110120178', 'Kim Thanh Nhàn', 'Nữ', '2002-06-30', '0993783102', 'Trà Vinh', '2020-03-26', 'Trà Vinh', 'DA20TTB', 7),
('110120179', 'Nguyễn Ngọc Sen', 'Nữ', '2002-10-16', '0232198209', 'Trà Vinh', '2019-03-26', 'Trà Vinh', 'DA20TTB', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dotdg`
--

CREATE TABLE `dotdg` (
  `madot` varchar(10) NOT NULL,
  `tendot` varchar(50) NOT NULL,
  `tgbatdau` date NOT NULL,
  `tgketthuc` date NOT NULL,
  `trangthai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dotdg`
--

INSERT INTO `dotdg` (`madot`, `tendot`, `tgbatdau`, `tgketthuc`, `trangthai`) VALUES
('cuoi-23', '6 tháng cuối năm 2023', '2023-12-25', '2024-01-07', 'Khóa'),
('nam-23', 'Cả năm 2023', '2024-01-15', '2024-01-31', 'Khóa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoatdong`
--

CREATE TABLE `hoatdong` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenhd` varchar(100) NOT NULL,
  `thoigian` date NOT NULL,
  `diadiem` varchar(100) DEFAULT NULL,
  `mota` text DEFAULT NULL,
  `minhchung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoatdong`
--

INSERT INTO `hoatdong` (`id`, `tenhd`, `thoigian`, `diadiem`, `mota`, `minhchung`) VALUES
(10, '[DS] Tham gia về nguồn tại Đền thờ Bác chào mừng lễ Quốc Khánh', '2022-08-31', 'Đền thờ Bác', NULL, 'hoatdong/[DS] Tham gia về nguồn tại Đền thờ Bác chào mừng lễ Quốc Khánh_2022-08-31.pdf'),
(11, '[DS] Tham gia lễ ra quân toàn quốc Ngày chủ nhật xanh lần IV, năm 2023', '2023-09-17', 'Khu I, Đại học Trà Vinh', NULL, 'hoatdong/[DS] Tham gia lễ ra quân toàn quốc Ngày chủ nhật xanh lần IV, năm 2023_2023-09-17.pdf'),
(13, '[Ds] Tham gia chương trình văn nghệ chào mừng tân sinh viên 2023', '2023-09-20', 'Hội trường D5, khu I, Đại học Trà Vinh', NULL, 'hoatdong/[Ds] Tham gia chương trình văn nghệ chào mừng tân sinh viên 2023_2023-09-20.pdf'),
(14, '[DS] Tham gia cổ vũ thi đấu bóng đá', '2023-10-31', 'Sân bóng đá khu I, Đại học Trà Vinh', NULL, 'hoatdong/[DS] Tham gia cổ vũ thi đấu bóng đá_2023-10-31.pdf'),
(15, '[DS] Tham gia chương  tư vấn hướng nghiệp', '2023-10-22', 'Hội trường D5, khu I, Đại học Trà Vinh', NULL, 'hoatdong/[DS] Tham gia chương  tư vấn hướng nghiệp_2023-10-22.pdf'),
(16, '[DS] Tham gia chương trình giao lưu văn hóa Việt - Nhật', '2023-09-29', 'Khu I, Đại học Trà Vinh', NULL, 'hoatdong/[DS] Tham gia chương trình giao lưu văn hóa Viêt - Nhật_2023-09-29.pdf');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaicd`
--

CREATE TABLE `loaicd` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenloaicd` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaicd`
--

INSERT INTO `loaicd` (`id`, `tenloaicd`) VALUES
(1, 'Hoàn thành xuất sắc'),
(2, 'Hoàn thành tốt'),
(3, 'Hoàn thành'),
(4, 'Không hoàn thành');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaidv`
--

CREATE TABLE `loaidv` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenloaidv` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaidv`
--

INSERT INTO `loaidv` (`id`, `tenloaidv`) VALUES
(1, 'Hoàn thành xuất sắc'),
(2, 'Hoàn thành tốt'),
(3, 'Hoàn thành'),
(4, 'Không hoàn thành');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nganh`
--

CREATE TABLE `nganh` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tennganh` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nganh`
--

INSERT INTO `nganh` (`id`, `tennganh`) VALUES
(1, 'Công nghệ Thông Tin'),
(2, 'Công nghệ Kỹ thuật Điện, Điện tử'),
(3, 'Trí tuệ nhân tạo (AI)');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thamgia`
--

CREATE TABLE `thamgia` (
  `mahd` bigint(20) UNSIGNED NOT NULL,
  `madv` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thamgia`
--

INSERT INTO `thamgia` (`mahd`, `madv`) VALUES
(10, '110120001'),
(10, '110120008'),
(11, '110120008'),
(10, '110120081'),
(11, '110120081'),
(10, '110120171');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tieuchi`
--

CREATE TABLE `tieuchi` (
  `id` bigint(20) NOT NULL,
  `tentc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tieuchi`
--

INSERT INTO `tieuchi` (`id`, `tentc`) VALUES
(1, 'Nộp sổ Đoàn viên'),
(2, 'Đóng đoàn phí đầy đủ'),
(3, 'Tham gia chăm sóc công trình thanh niên (vệ sinh)'),
(4, 'Tham gia đầy đủ buổi sinh hoạt chi đoàn'),
(5, 'Tham gia hoạt động về nguồn'),
(6, 'Tham gia các chương trình sự kiện, văn nghệ, khởi nghiệp…'),
(7, 'Tham gia quyên góp, các hoạt động thiện nguyện'),
(8, 'Tham gia hỗ trợ Đoàn khoa'),
(9, 'Tham gia công tác xã hội hoặc mùa hè xanh'),
(11, 'Tham gia hoạt động thể dục thể thao');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tkadmin`
--

CREATE TABLE `tkadmin` (
  `username_admin` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` varchar(1) NOT NULL,
  `role` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tkadmin`
--

INSERT INTO `tkadmin` (`username_admin`, `password`, `active`, `role`) VALUES
('admin', '123', '1', '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tkdoanvien`
--

CREATE TABLE `tkdoanvien` (
  `username` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` varchar(1) NOT NULL,
  `role` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tkdoanvien`
--

INSERT INTO `tkdoanvien` (`username`, `password`, `active`, `role`) VALUES
('110120001', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120002', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120004', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120007', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120008', 'e10adc3949ba59abbe56e057f20f883e', '1', '2'),
('110120010', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120011', '123456', '1', '3'),
('110120013', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120014', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120019', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120026', 'e10adc3949ba59abbe56e057f20f883e', '1', '2'),
('110120029', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120031', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120034', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120037', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120038', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120049', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120051', 'e10adc3949ba59abbe56e057f20f883e', '1', '1'),
('110120054', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120060', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120064', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120070', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120071', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120078', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120081', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120084', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120087', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120092', 'e10adc3949ba59abbe56e057f20f883e', '1', '2'),
('110120128', 'e10adc3949ba59abbe56e057f20f883e', '1', '2'),
('110120146', 'e10adc3949ba59abbe56e057f20f883e', '1', '2'),
('110120164', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120166', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120171', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120177', 'e10adc3949ba59abbe56e057f20f883e', '1', '3'),
('110120178', 'e10adc3949ba59abbe56e057f20f883e', '1', '2'),
('110120179', 'e10adc3949ba59abbe56e057f20f883e', '1', '3');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bieumau`
--
ALTER TABLE `bieumau`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chidoan`
--
ALTER TABLE `chidoan`
  ADD PRIMARY KEY (`macd`),
  ADD KEY `chidoan_manganh_foreign` (`manganh`);

--
-- Chỉ mục cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danhgiacd`
--
ALTER TABLE `danhgiacd`
  ADD PRIMARY KEY (`macd`,`madot`),
  ADD KEY `danhgiacd_maloaicd_foreign` (`maloaicd`),
  ADD KEY `danhgiacd_madot_foreign` (`madot`);

--
-- Chỉ mục cho bảng `danhgiadv`
--
ALTER TABLE `danhgiadv`
  ADD PRIMARY KEY (`madv`,`madot`),
  ADD KEY `danhgiadv_maloaidv_foreign` (`maloaidv`),
  ADD KEY `danhgiadv_madot_foreign` (`madot`);

--
-- Chỉ mục cho bảng `dattc`
--
ALTER TABLE `dattc`
  ADD PRIMARY KEY (`madv`,`matc`,`madot`),
  ADD KEY `dattc_madot_foreign` (`madot`),
  ADD KEY `dattc_matc_foreign` (`matc`);

--
-- Chỉ mục cho bảng `doanvien`
--
ALTER TABLE `doanvien`
  ADD PRIMARY KEY (`madv`),
  ADD KEY `doanvien_macd_foreign` (`macd`),
  ADD KEY `doanvien_macv_foreign` (`macv`);

--
-- Chỉ mục cho bảng `dotdg`
--
ALTER TABLE `dotdg`
  ADD PRIMARY KEY (`madot`);

--
-- Chỉ mục cho bảng `hoatdong`
--
ALTER TABLE `hoatdong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `loaicd`
--
ALTER TABLE `loaicd`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `loaidv`
--
ALTER TABLE `loaidv`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thamgia`
--
ALTER TABLE `thamgia`
  ADD PRIMARY KEY (`madv`,`mahd`),
  ADD KEY `thamgia_mahd_foreign` (`mahd`);

--
-- Chỉ mục cho bảng `tieuchi`
--
ALTER TABLE `tieuchi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tkadmin`
--
ALTER TABLE `tkadmin`
  ADD PRIMARY KEY (`username_admin`) USING BTREE;

--
-- Chỉ mục cho bảng `tkdoanvien`
--
ALTER TABLE `tkdoanvien`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bieumau`
--
ALTER TABLE `bieumau`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `hoatdong`
--
ALTER TABLE `hoatdong`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `loaicd`
--
ALTER TABLE `loaicd`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `loaidv`
--
ALTER TABLE `loaidv`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `nganh`
--
ALTER TABLE `nganh`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tieuchi`
--
ALTER TABLE `tieuchi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chidoan`
--
ALTER TABLE `chidoan`
  ADD CONSTRAINT `chidoan_manganh_foreign` FOREIGN KEY (`manganh`) REFERENCES `nganh` (`id`);

--
-- Các ràng buộc cho bảng `danhgiacd`
--
ALTER TABLE `danhgiacd`
  ADD CONSTRAINT `danhgiacd_macd_foreign` FOREIGN KEY (`macd`) REFERENCES `chidoan` (`macd`),
  ADD CONSTRAINT `danhgiacd_madot_foreign` FOREIGN KEY (`madot`) REFERENCES `dotdg` (`madot`),
  ADD CONSTRAINT `danhgiacd_maloaicd_foreign` FOREIGN KEY (`maloaicd`) REFERENCES `loaicd` (`id`);

--
-- Các ràng buộc cho bảng `danhgiadv`
--
ALTER TABLE `danhgiadv`
  ADD CONSTRAINT `danhgiadv_madot_foreign` FOREIGN KEY (`madot`) REFERENCES `dotdg` (`madot`),
  ADD CONSTRAINT `danhgiadv_madv_foreign` FOREIGN KEY (`madv`) REFERENCES `doanvien` (`madv`),
  ADD CONSTRAINT `danhgiadv_maloaidv_foreign` FOREIGN KEY (`maloaidv`) REFERENCES `loaidv` (`id`);

--
-- Các ràng buộc cho bảng `dattc`
--
ALTER TABLE `dattc`
  ADD CONSTRAINT `dattc_madot_foreign` FOREIGN KEY (`madot`) REFERENCES `dotdg` (`madot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dattc_madv_foreign` FOREIGN KEY (`madv`) REFERENCES `doanvien` (`madv`),
  ADD CONSTRAINT `dattc_matc_foreign` FOREIGN KEY (`matc`) REFERENCES `tieuchi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `doanvien`
--
ALTER TABLE `doanvien`
  ADD CONSTRAINT `doanvien_macd_foreign` FOREIGN KEY (`macd`) REFERENCES `chidoan` (`macd`),
  ADD CONSTRAINT `doanvien_macv_foreign` FOREIGN KEY (`macv`) REFERENCES `chucvu` (`id`);

--
-- Các ràng buộc cho bảng `thamgia`
--
ALTER TABLE `thamgia`
  ADD CONSTRAINT `thamgia_madv_foreign` FOREIGN KEY (`madv`) REFERENCES `doanvien` (`madv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thamgia_mahd_foreign` FOREIGN KEY (`mahd`) REFERENCES `hoatdong` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tkdoanvien`
--
ALTER TABLE `tkdoanvien`
  ADD CONSTRAINT `tkdoanvien_username_foreign` FOREIGN KEY (`username`) REFERENCES `doanvien` (`madv`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
