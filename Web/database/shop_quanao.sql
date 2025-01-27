
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_quanao`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Hoodie', '2024-11-11 11:50:15', '2024-11-14 15:07:28'),
(2, 'T-shirt', '2024-11-11 11:50:15', '2024-11-14 15:03:28'),
(3, 'Shorts', '2024-11-11 11:50:15', '2024-11-14 15:57:28'),
(4, 'Trousers', '2024-11-11 10:57:52', '2024-11-14 15:14:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `collection`
--

CREATE TABLE `collection` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `collection`
--

INSERT INTO `collection` (`id`, `name`) VALUES
(1, 'One Piece'),
(2, 'The Spring'),
(3, 'Lil Wuyn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `fullname`, `phone_number`, `email`, `address`, `note`, `order_date`) VALUES
(163, 'hiep_1', '12345678', 'admin@gmail.com', 'Tphcm', 'DC x OP Luffy Raglan Hoodie - Multicolor', '2024-11-12 22:39:49'),
(164, 'hiep_2', '12345678', 'admin@gmail.com', 'HaNoi', 'DC x OP Brook Hoodie - Blue', '2024-11-12 22:40:51'),
(165, 'hiep_4', '12345678', 'admin@gmail.com', 'CanTho', 'DC x OP Chopper Hoodie - Black', '2024-11-12 22:44:20'),
(166, 'hiep_3', '12345678', 'admin@gmail.com', 'NhaTrang', 'Hoodie - Black', '2024-11-12 22:47:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `price` float NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `id_user`, `num`, `price`, `status`) VALUES
(172, 163, 1, 1, 1, 720000, 'Đang chuẩn bị'),
(173, 164, 2, 1, 1, 699000, 'Đang chuẩn bị'),
(176, 165, 5, 1, 1, 699000, 'Đang chuẩn bị'),
(177, 166, 4, 1, 1, 648000, 'Đang chuẩn bị');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `number` float NOT NULL,
  `thumbnail` varchar(500) NOT NULL,
  `thumbnail_1` varchar(500) NOT NULL,
  `thumbnail_2` varchar(500) NOT NULL,
  `thumbnail_3` varchar(500) NOT NULL,
  `thumbnail_4` varchar(500) NOT NULL,
  `thumbnail_5` varchar(500) NOT NULL,
  `content` longtext NOT NULL,
  `id_category` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_sanpham` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `title`, `price`, `number`, `thumbnail`, `thumbnail_1`, `thumbnail_2`, `thumbnail_3`, `thumbnail_4`, `thumbnail_5`, `content`, `id_category`, `created_at`, `updated_at`, `id_sanpham`) VALUES
(1, 'DC x OP Luffy Raglan Hoodie - Multicolor', 720000, 10, 'uploads/p1.png', 'uploads/p4.png', 'uploads/p2.png', 'uploads/p5.png', 'uploads/p6.png', 'uploads/p3.png', 'Chất liệu nỉ cotton. Hình in thân trước và tay áo áp dụng công nghệ in kéo lụa thủ công. Bo cổ tay và bo thân trùng với màu vải tay áo và thân áo tương ứng. Tag vải riêng của BST được may trên túi phía trước.', 1, '2024-11-11 10:37:18', '2024-11-11 10:37:18', 0),
(2, 'DC x OP Brook Hoodie - Blue', 699000, 20, 'uploads/p7.png', 'uploads/p8.png', 'uploads/p9.png', 'uploads/p12.png', 'uploads/p11.png', 'uploads/p10.png', 'Chất liệu nỉ cotton. Hình in thân trước và tay áo áp dụng công nghệ in kéo lụa thủ công. Bo cổ tay và bo thân trùng với màu vải tay áo và thân áo tương ứng. Tag vải riêng của BST được may trên túi phía trước.', 1, '2024-11-11 15:11:49', '2024-11-11 15:11:49', 1),
(3, 'DC x OP Luffy Attack T-shirt - White', 420000, 20, 'uploads/p13.png', 'uploads/p18.png', 'uploads/p15.png', 'uploads/p14.png', 'uploads/p17.png', 'uploads/p18.png', 'Chất liệu nỉ cotton. Hình in thân trước và tay áo áp dụng công nghệ in kéo lụa thủ công. Bo cổ tay và bo thân trùng với màu vải tay áo và thân áo tương ứng. Tag vải riêng của BST được may trên túi phía trước.', 2, '2024-11-11 17:31:22', '2024-11-11 17:31:22', 1),
(4, 'DirtyCoins Don\'t Test Us Hoodie - Black', 648000, 20, 'uploads/p31.png', 'uploads/p32.png', 'uploads/p33.png', 'uploads/p36.png', 'uploads/p35.png', 'uploads/p34.png', 'Chất liệu nỉ cotton. Hình in thân trước và tay áo áp dụng công nghệ in kéo lụa thủ công. Bo cổ tay và bo thân trùng với màu vải tay áo và thân áo tương ứng. Tag vải riêng của BST được may trên túi phía trước.', 1, '2024-11-11 21:59:06', '2024-11-11 21:59:06', 2),
(5, 'DC x OP Chopper Hoodie - Black', 699000, 10, 'uploads/p67.png', 'uploads/p71.png', 'uploads/p69.png', 'uploads/p68-1.png', 'uploads/p70.png', 'uploads/p72.png', 'Chất liệu nỉ cotton. Hình in thân trước và tay áo áp dụng công nghệ in kéo lụa thủ công. Bo cổ tay và bo thân trùng với màu vải tay áo và thân áo tương ứng. Tag vải riêng của BST được may trên túi phía trước.', 1, '2024-11-11 22:10:40', '2024-11-11 22:10:40', 1),
(6, 'DirtyCoins x LilWuyn Logo Shorts - Black', 450000, 10, 'uploads/p25.png', 'uploads/p26.png', 'uploads/p27.png', 'uploads/p28.png', 'uploads/p29.png', 'uploads/p30.png', 'Chất liệu vải sợi tổng hợp. Hình mặt trước quần và logo DirtyCoins áp dụng kĩ thuật in lụa, lưng thun, có túi hai bên. Túi quần sau có nắp kèm nút bấm. Logo DirtyCoins thêu trên túi.', 3, '2024-11-11 12:37:46', '2024-11-12 12:37:46', 3),
(7, 'Dico Wavy Shorts - Black', 490000, 20, 'uploads/p55.png', 'uploads/p56.png', 'uploads/p57.png', 'uploads/p58.png', 'uploads/p59.png', 'uploads/p60.png', 'Chất liệu vải sợi tổng hợp. Hình mặt trước quần và logo DirtyCoins áp dụng kĩ thuật in lụa, lưng thun, có túi hai bên. Túi quần sau có nắp kèm nút bấm. Logo DirtyCoins thêu trên túi.', 3, '2024-11-12 12:40:58', '2024-11-12 12:40:58', 2),
(8, 'Shorts - Green', 450000, 20, 'uploads/p61.png', 'uploads/p62.png', 'uploads/p63.png', 'uploads/p64.png', 'uploads/p65.png', 'uploads/p66.png', 'Chất liệu vải sợi tổng hợp. Hình mặt trước quần và logo DirtyCoins áp dụng kĩ thuật in lụa, lưng thun, có túi hai bên. Túi quần sau có nắp kèm nút bấm. Logo DirtyCoins thêu trên túi.', 3, '2024-11-12 12:43:18', '2024-11-12 12:43:18', 2),
(9, 'Cargo Pants - Black', 620000, 15, 'uploads/p43.png', 'uploads/p44.png', 'uploads/p45.png', 'uploads/p46.png', 'uploads/p47.png', 'uploads/p48.png', 'Chất liệu vải sợi tổng hợp. Hình mặt trước quần và logo DirtyCoins áp dụng kĩ thuật in lụa, lưng thun, có túi hai bên. Túi quần sau có nắp kèm nút bấm. Logo DirtyCoins thêu trên túi.', 4, '2024-11-12 12:55:56', '2024-11-12 12:55:56', 2),
(10, 'DirtyCoins Dico Starry Jogger Pants - Red', 490000, 20, 'uploads/p49-1.png', 'uploads/p50.png', 'uploads/p51.png', 'uploads/p52.png', 'uploads/p53.png', 'uploads/p54.png', 'Chất liệu vải sợi tổng hợp. Hình mặt trước quần và logo DirtyCoins áp dụng kĩ thuật in lụa, lưng thun, có túi hai bên. Túi quần sau có nắp kèm nút bấm. Logo DirtyCoins thêu trên túi.', 4, '2024-11-12 12:59:42', '2024-11-12 12:59:42', 2),
(11, 'DC x OP Logo Print Khaki Pants - Black', 620000, 10, 'uploads/p73.png', 'uploads/p74.png', 'uploads/p75.png', 'uploads/p76.png', 'uploads/p77.png', 'uploads/p78.png', 'Chất liệu vải sợi tổng hợp. Hình mặt trước quần và logo DirtyCoins áp dụng kĩ thuật in lụa, lưng thun, có túi hai bên. Túi quần sau có nắp kèm nút bấm. Logo DirtyCoins thêu trên túi.', 4, '2024-11-12 13:06:27', '2024-11-12 13:06:27', 1),
(12, 'DirtyCoins Print Cardigan - Ivory/Green', 490000, 15, 'uploads/p37.png', 'uploads/p39.png', 'uploads/p40.png', 'uploads/p38.png', 'uploads/p41.png', 'uploads/p42.png', 'Chất liệu nỉ cotton. Hình in thân trước và tay áo áp dụng công nghệ in kéo lụa thủ công. Bo cổ tay và bo thân trùng với màu vải tay áo và thân áo tương ứng. Tag vải riêng của BST được may trên túi phía trước.', 1, '2024-11-12 21:03:16', '2024-11-12 21:03:16', 2),
(13, 'DirtyCoins x LilWuyn Print L/S T-Shirt - Tan', 550000, 10, 'uploads/p19.png', 'uploads/p21.png', 'uploads/p22.png', 'uploads/p20.png', 'uploads/p23.png', 'uploads/p24.png', 'Chất liệu nỉ cotton. Hình in thân trước và tay áo áp dụng công nghệ in kéo lụa thủ công. Bo cổ tay và bo thân trùng với màu vải tay áo và thân áo tương ứng. Tag vải riêng của BST được may trên túi phía trước.', 1, '2024-11-13 21:07:54', '2024-11-13 21:07:54', 3),
(14, 'DirtyCoins x LilWuyn Basic T-Shirt - Silver Lining', 699000, 10, 'uploads/1.png', 'uploads/3.png', 'uploads/4.png', 'uploads/2.png', 'uploads/5.png', 'uploads/6.png', 'Chất liệu nỉ cotton. Hình in thân trước và tay áo áp dụng công nghệ in kéo lụa thủ công. Bo cổ tay và bo thân trùng với màu vải tay áo và thân áo tương ứng. Tag vải riêng của BST được may trên túi phía trước.', 2, '2024-11-07 08:44:17', '2024-11-13 08:44:17', 3),
(15, 'DirtyCoins Twin Flowers T-shirt - White', 420000, 20, 'uploads/7.png', 'uploads/9.png', 'uploads/10.png', 'uploads/8.png', 'uploads/11.png', 'uploads/12.png', 'Chất liệu nỉ cotton. Hình in thân trước và tay áo áp dụng công nghệ in kéo lụa thủ công. Bo cổ tay và bo thân trùng với màu vải tay áo và thân áo tương ứng. Tag vải riêng của BST được may trên túi phía trước.', 2, '2024-11-13 08:48:39', '2024-11-13 08:48:39', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `tenadmin` varchar(100) NOT NULL,
  `tendangnhap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `dienthoai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `tenadmin`, `tendangnhap`, `email`, `diachi`, `matkhau`, `dienthoai`) VALUES
(1, 'hiep', 'hiep123', 'hieptuannguyen23@gmail.com', 'HN', '1234', '0336862003');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_dangky`
--

CREATE TABLE `tbl_dangky` (
  `id_dangky` int(11) NOT NULL,
  `tenkhachhang` varchar(200) NOT NULL,
  `tendangnhap` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `diachi` varchar(200) NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `dienthoai` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_dangky`
--

INSERT INTO `tbl_dangky` (`id_dangky`, `tenkhachhang`, `tendangnhap`, `email`, `diachi`, `matkhau`, `dienthoai`) VALUES
(1, 'chuchu', 'chuchu', 'chuchu@gmail.com', 'hn', '1234', '3232323'),
(2, 'haha', 'haha', 'haha@gmail.com', 'hn', '1234', '3232323'),
(3, 'hehe', 'hehe', 'hehe@gmail.com', 'hn', '1234', '12345678');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `hoten` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(28) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id_user`, `hoten`, `username`, `password`, `phone`, `email`) VALUES
(1, 'Nguyễn Tuấn Hiệp', 'AdminHiep', 'hiep8686', '0123456789', 'hiep86@gmail.com'),
(2, 'hoho', 'hoho', 'hoho1', '0915465654', 'hoho1@gmail.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Chỉ mục cho bảng `tbl_dangky`
--
ALTER TABLE `tbl_dangky`
  ADD PRIMARY KEY (`id_dangky`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_dangky`
--
ALTER TABLE `tbl_dangky`
  MODIFY `id_dangky` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
