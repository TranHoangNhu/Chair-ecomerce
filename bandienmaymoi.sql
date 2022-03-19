-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 13, 2021 lúc 05:40 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bandienmaymoi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`) VALUES
(1, 'admin@gmail.com', 'MjEyMzJmMjk3YTU3YTVhNzQzODk0YTBlNGE4MDFmYzM=', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_baiviet`
--

CREATE TABLE `tbl_baiviet` (
  `baiviet_id` int(11) NOT NULL,
  `baiviet_name` varchar(100) NOT NULL,
  `baiviet_tomtat` text NOT NULL,
  `baiviet_noidung` text NOT NULL,
  `danhmuc_tin_id` int(11) NOT NULL,
  `baiviet_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(7, 'Ngôn tình'),
(8, 'Hiện đại'),
(9, 'Tu tiên'),
(10, 'Dị năng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_danhmuc_tin`
--

CREATE TABLE `tbl_danhmuc_tin` (
  `danhmuc_tin_id` int(11) NOT NULL,
  `danhmuc_tin_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_danhmuc_tin`
--

INSERT INTO `tbl_danhmuc_tin` (`danhmuc_tin_id`, `danhmuc_tin_name`) VALUES
(1, 'Kiến thức bán nhà'),
(2, 'Kiến thức bán dấu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_donhang`
--

CREATE TABLE `tbl_donhang` (
  `donhang_id` int(11) NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `donhang_soluong` int(11) NOT NULL,
  `donhang_mahang` int(11) NOT NULL,
  `khachhang_id` int(11) NOT NULL,
  `donhang_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `donhang_tinhtrang` int(11) NOT NULL,
  `donhang_huydon` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_donhang`
--

INSERT INTO `tbl_donhang` (`donhang_id`, `sanpham_id`, `donhang_soluong`, `donhang_mahang`, `khachhang_id`, `donhang_datetime`, `donhang_tinhtrang`, `donhang_huydon`) VALUES
(19, 17, 1, 12045427, 16, '2021-04-13 02:53:53', 1, 2),
(20, 20, 1, 12042522, 16, '2021-04-13 03:38:23', 1, 0),
(21, 15, 1, 12042522, 16, '2021-04-13 03:38:23', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_giaodich`
--

CREATE TABLE `tbl_giaodich` (
  `giaodich_id` int(11) NOT NULL,
  `khachhang_id` int(11) NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `giaodich_soluong` int(11) NOT NULL,
  `giaodich_magiaodich` int(11) NOT NULL,
  `giaodich_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `giaodich_tinhtrang` int(11) NOT NULL DEFAULT 0,
  `giaodich_huydon` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_giaodich`
--

INSERT INTO `tbl_giaodich` (`giaodich_id`, `khachhang_id`, `sanpham_id`, `giaodich_soluong`, `giaodich_magiaodich`, `giaodich_datetime`, `giaodich_tinhtrang`, `giaodich_huydon`) VALUES
(5, 11, 18, 2, 12044647, '2021-04-12 19:57:27', 0, 0),
(6, 11, 17, 2, 12044647, '2021-04-12 19:57:27', 0, 0),
(7, 16, 17, 1, 12045427, '2021-04-13 02:53:53', 1, 2),
(8, 16, 20, 1, 12042522, '2021-04-13 03:38:23', 1, 0),
(9, 16, 15, 1, 12042522, '2021-04-13 03:38:23', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_giohang`
--

CREATE TABLE `tbl_giohang` (
  `giohang_id` int(11) NOT NULL,
  `giohang_tensanpham` varchar(100) NOT NULL,
  `giohang_image` varchar(100) NOT NULL,
  `giohang_soluong` int(11) NOT NULL,
  `giohang_gia` float NOT NULL,
  `sanpham_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_khachhang`
--

CREATE TABLE `tbl_khachhang` (
  `khachhang_id` int(11) NOT NULL,
  `khachhang_name` varchar(100) NOT NULL,
  `khachhang_address` varchar(100) NOT NULL,
  `khachhang_phone` varchar(100) NOT NULL,
  `khachhang_note` text NOT NULL,
  `khachhang_email` varchar(50) NOT NULL,
  `khachhang_password` varchar(100) NOT NULL,
  `khachhang_giaohang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_khachhang`
--

INSERT INTO `tbl_khachhang` (`khachhang_id`, `khachhang_name`, `khachhang_address`, `khachhang_phone`, `khachhang_note`, `khachhang_email`, `khachhang_password`, `khachhang_giaohang`) VALUES
(16, 'Nghĩa Bùi', '98 Hoàng Quốc Việt, Nghĩa Đô', '0397557146', 'hihi', 'chinghia190399@gmail.com', 'MjAyY2I5NjJhYzU5MDc1Yjk2NGIwNzE1MmQyMzRiNzA=', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sanpham`
--

CREATE TABLE `tbl_sanpham` (
  `sanpham_id` int(11) NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `sanpham_name` varchar(100) NOT NULL,
  `sanpham_chitiet` text NOT NULL,
  `sanpham_mota` text NOT NULL,
  `sanpham_gia` float NOT NULL,
  `sanpham_giakhuyenmai` float NOT NULL,
  `sanpham_soluong` int(11) NOT NULL,
  `sanpham_image` varchar(100) NOT NULL,
  `sanpham_hot` int(11) NOT NULL,
  `sanpham_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`sanpham_id`, `category_id`, `sanpham_name`, `sanpham_chitiet`, `sanpham_mota`, `sanpham_gia`, `sanpham_giakhuyenmai`, `sanpham_soluong`, `sanpham_image`, `sanpham_hot`, `sanpham_active`) VALUES
(15, '9', 'Tru Tiên Kiếm', 'Tru Tiên kể về một thời đại thần tiên không xác định ở Trung Quốc, với 3 đại phái là Thanh Vân Môn, Thiên Âm Tự và Phần Hương Cốc, đối lập với Ma Giáo. Thanh Vân Môn là lực lượng đứng đầu chính đạo trong thiên hạ.\r\n\r\nNhân vật chính Trương Tiểu Phàm sống ở thôn Thảo Miếu, một làng nhỏ bên dưới chân núi Thanh Vân Môn, có bạn thân là Lâm Kinh Vũ. Trương Tiểu Phàm ngốc nghếch kém cỏi, không thông minh lanh lợi như Lâm Kinh Vũ. Trong 1 lần hai đứa trẻ đang chơi đùa, Tiểu Phàm tình cờ được Phổ Trí (một trong Tứ Đại Thần Tăng của Thiên Âm Tự) cứu thoát khi suýt bị Kinh Vũ vô ý bóp cổ. Đêm xuống, một hắc y nhân bắt cóc Lâm Kinh Vũ chạy đi. Lúc đó có Phổ Trí đã ra tay giải cứu, nhưng bị trúng độc của Thất Vĩ Ngô Công - con rết cực độc trong thiên hạ. Hắc y nhân cho biết mục tiêu của hắn không phải là Lâm Kinh Vũ mà chính là Phệ Huyết Châu - vật chí hung của Ma Giáo đã biệt tích hơn 800 năm - mà Phổ Trí đang phong ấn và giữ lại bên mình. Phổ Trí kinh ngạc khi hắc y nhân dùng Thần Kiếm Ngự Lôi Chân Quyết của Thanh Vân môn đánh tới, nhưng vẫn gắng gượng dùng Đại Phạm Bát Nhã của Thiên Âm Tự chống đỡ, đánh bị thương hắc y nhân, nhưng bản thân cũng sức tàn lực kiệt, chỉ còn chờ chết. Vô tình, Trương Tiểu Phàm lúc này cũng có mặt và chứng kiến từ đầu tới cuối màn giao đấu của Phổ Trí với hắc y nhân bí ẩn nọ. Lúc sắp mất, Phổ Trí vẫn day dứt vì nguyện ước thống nhất sở học của 2 đại môn phái để tìm ra phương thức trường sinh bất lão chưa thành, liền nghĩ ra cách dạy khẩu quyết Đại Phạm Bát Nhã cho một trong hai đứa bé, hi vọng Thanh Vân Môn sẽ thu nạp, sau này có thể kết hợp tuyệt nghệ của cả hai đại môn pháp, giải đáp được bí ẩn về sự trường thọ. Sau một lúc đắn đo lựa chọn, Phổ Trí chọn Trương Tiểu Phàm vì thấy cậu thật thà, tâm tính kiên định, không quá thông minh dẫn đến dễ bị chú ý như Lâm Kinh Vũ. Sau khi dạy khẩu quyết luyện công xong Phổ Trí đánh ngất Trương Tiểu Phàm.\r\n\r\nLúc tỉnh dậy, Lâm Kinh Vũ (cả đêm bị ngất không biết gì) và Trương Tiểu Phàm kinh hãi khi thấy cả làng mình đã bị giết sạch. Các đệ tử Thanh Vân Môn đi ngang biết chuyện liền đưa hai đứa trẻ lên Thanh Vân Môn. Chưởng môn Thanh Vân Môn Đạo Huyền Chân Nhân một mặt ra lệnh truy tìm kẻ thủ ác, mặt khác cho hai đứa trẻ gia nhập Thanh Vân Môn. Lâm Kinh Vũ thông minh khác thường, được Thương Tùng Đạo Nhân - thủ tọa chi phái Long Thủ Phong - nhận lấy làm đồ đệ, trong khi không ai muốn nhận Trương Tiểu Phàm. Cuối cùng Đạo Huyền Chân Nhân ép thủ tọa Đại Trúc Phong là Điền Bất Dịch, chi phái nhỏ nhất, phải tiếp nhận Trương Tiểu Phàm.', 'Tru Tiên (giản thể: 诛仙; phồn thể: 誅仙; bính âm: Zhūxiān) là một bộ tiểu thuyết giả tưởng thần tiên kiếm hiệp (còn gọi là tiên hiệp) do Tiêu Đỉnh sáng tác. Tru Tiên được đưa lên mạng vào năm 2003 khi còn chưa hoàn thành, tác phẩm này nhanh chóng thu hút đông đảo sự quan tâm của độc giả và nên gây một làn sóng mới trong văn học Trung Quốc. Đài Loan đã mua bản quyền xuất bản bộ truyện với giá 1 triệu nhân dân tệ. Tại Trung Quốc, trong 3 năm liên tiếp kể từ khi xuất bản, Tru Tiên đã phát hành được gần 2 triệu bản, vượt qua kỷ lục của Harry Potter ở Trung Quốc.', 50000, 48000, 10, '6772612611072040128024372714163771927953408o-1567763289984240629983.jpg', 0, 0),
(16, '9', 'Tiên nghịch', 'Trong ký ức của Cổ Thần Đồ Ti từng nhắc đến mặt trăng, một loại vật sống ký sinh trên sự tồn tại của Cổ Thần.\r\n- Nếu thiên đạo có minh thì Cổ Thần có đan !\r\nChữ minh này có thể giải thích là linh, cũng có thể là hồn, nói chung ý nghĩa của nửa câu đầu là nói thiên đạo cũng không phải vật chết mà quả thật có sự tồn tại, có lẽ thiên đạo có linh và hồn nhưng sinh linh không thể hiểu rõ.\r\nNửa câu sau nói về Vọng Nguyệt, trong ký ức của Cổ Thần Đồ Ti không nhắc đến Vọng Nguyệt vì sao xuất hiện, ngay cả hắn cũng không hiểu được. Hình như nó đã tồn tại từ trước đó rất lâu rồi.\r\nHình như hồn và linh của thiên đạo đều giống nhau, đều là những vật không thể nắm lấy, không ai có thể hiểu được rõ ràng.\r\n-Vọng Nguyệt phẫn nộ như một chỉ của Cổ Thần !\r\nĐây là một miêu tả thứ hai về Vọng Nguyệt trong ký ức của Đồ Ti, một câu nói này lại làm Vương Lâm có ấn tượng rất sâu.\r\nTừ nội dung của nó thì có thể hiểu, Vọng Nguyệt một khi phẫn nộ thì sẽ đạt đến hình thái thứ ba, lúc này sẽ có uy lực tương đương với một chỉ của Cổ Thần. Uy lực có thể mạnh có thể yếu, nhưng nếu là cực mạnh thì giống như một chỉ của Cửu Tinh Cổ Thần, mặc dù là tu chân tinh cũng phải tan vỡ.\r\nNếu uy lực nhỏ nhất thì giống như một chỉ của Nhất Tinh Cổ Thần. ', 'Tiên Nghịch là câu chuyện Tiên Hiệp kể về Vương Lâm - một thiếu niên bình thường, may mắn được gia nhập vào một môn phái tu tiên xuống dốc của nước Triệu, vì thiếu linh căn, vì một hiểu nhầm tai hại, vì một khối thiết tinh và nhờ có được một \"Thần Bí Hạt Châu\". Vương Lâm đã bước lên con đường tu tiên và trên con đường này, hắn sẽ đối mặt với chuyện gì?', 50000, 48000, 10, 'tải xuống.jfif', 0, 0),
(17, '10', 'Đại lục thất lạc', '\"Tôi không phải là một con quái vật sẽ biến thành hoàng tử sau khi lời nguyền được hóa giải. Tôi chỉ là quái vật mà thôi...\" (*)\r\n\r\nVà sẽ như thế nào nếu có một tình yêu được nảy mầm từ chính cô gái bé nhỏ con người cùng với con quái thú to lớn đáng sợ như quái vật? Liệu tình yêu ấy có thật sự đi đến cuối cùng để có một kết thúc trọn vẹn hay không? Khi mà khoảng cách giữa họ là cả một chặng đường thật xa...\r\n\r\nDương Phàm trong một lần tình cờ thì xuyên không về thời viễn cổ, khi mà tất cả mọi thứ chỉ là sự thô sơ nguyên thủy cùng hoang dã. Thế giới này quá xa lạ, cô không tìm thấy được bất cứ điều gì để bấu víu và hy vọng. Sự tuyệt vọng sợ hãi như lan tràn...\r\n\r\nRồi cô bị một con quái thú to lớn với bộ lông rậm rạp trên người, đôi mắt như thằn lằn và cái đuôi dài đầy hung tợn bắt đem về hang của nó. Phút giây đó, mọi thứ trong cô như đổ vỡ. Chẳng lẽ, cô chính là thức ăn của con quái thú này?\r\n\r\nNhưng điều kỳ lạ là nó không hề có ý định thương tổn hay giết gì cô. Nó để mặc cho cô chạy trốn khỏi hang động rồi nhanh như sóc bắt cô đem về lại. Dường như, nó nghĩ rằng màn chạy trốn mà cô trối sống trối chết bày ra đó chỉ là màn \"dạo mát\" quanh quẩn đâu đây mà thôi. Và thật dễ dàng khi tóm gọn cô đem về :v :v\r\n\r\nSau những lần \"bỏ đi\" không thành, Dương Phàm cũng thôi ngay ý định đó. Ở bên con quái thú này ít ra cô còn được an toàn hơn so với thế giới đầy đáng sợ ngoài kia. Cô đặt tên cho nó là Nick và bắt đầu tìm hiểu thân cận cũng như muốn lợi dụng nó để tồn tại ở đây.\r\n\r\nNick không phải là con người, cũng không hẳn là thú. Nick là người-nguyên-thủy nên vẫn mang trong mình những bản chất của người, nhưng phần thú vẫn luôn tồn tại song song. Ngay khi nhặt được Dương Phàm ngoài bìa rừng, Nick đã cảm thấy thích cô gái bé nhỏ này và muốn đem về hang nuôi làm vợ.\r\n\r\nNick không thể nói, cũng không thông minh hiểu chuyện, mọi thứ Nick làm đều xuất phát từ bản năng và tập tính của dã thú. Nhưng điều đó, cũng không thể ngăn cản được phần tình cảm tốt đẹp mà Nick dành riêng cho Dương Phàm. Thế nên, khi thấy cô bị \"chảy máu\" đến tháng, Nick đã cuống cuồng lo lắng tìm đủ mọi cách chữa bệnh cho cô. Nick không đi đâu hết, chỉ luôn ôm cô vào lòng và kêu lên những tiếng G-rù G-rù rất thương tâm.\r\n\r\nRồi khi đi săn thú trở về, những miếng thịt ngon nhất Nick luôn để dành riêng cho Dương Phàm. Bất kể cô muốn làm gì Nick đều mặc kệ mà dung túng. Chỉ cần cô không thoát khỏi phạm vi an toàn Nick đặt ra và đi quá giới hạn thì mọi chuyện đều ổn. Vì thế, Nick hái đủ loại trái cây, săn đủ con thú, bắt cá tôm, lấy trứng... về cho cô thí nghiệm toàn bộ.\r\n\r\nSự dung túng đó, yêu thương đó... không hề được nói ra bằng bất cứ lời nào, Nick chỉ biết dùng hành động của mình để thể hiện mà thôi. Và Dương Phàm, từ ban đầu là sợ hãi muốn chạy trốn đến khi bất lực cam chịu và cuối cùng là tình nguyện ở lại bên Nick. Chặng đường đó, không hề dễ dàng chút nào đối với một con người văn minh trí tuệ như cô. Nhưng không biết từ bao giờ mọi thứ Nick làm vì cô đã khiến tim rung động như thế.\r\n\r\nCó thể với nhiều người, nam chính trong một câu chuyện nên là một anh chàng soái ca với đầy đủ tiêu chí để hạ gục nữ chính. Còn với mình, Nick mới là một nam chính thật sự. Bởi Nick có đủ sự yêu thương đối với Dương Phàm, sự dung túng chở che hết mực và hơn hết là Nick sẵn sàng vì cô mà hy sinh đi bản thân mình. Bấy nhiêu đó đủ để đánh bại tất cả mọi nam chính khác rồi nhỉ?\r\n\r\nDương Phàm muốn đem kiến thức có ích của mình ở hiện đại để áp dụng vào cuộc sống xa lạ này. Cô dạy cho Nick hành động, cử chỉ để biểu lộ cảm xúc cũng như có thể giao tiếp nói chuyện với nhau mà không cần phải dùng cái G-rù G-rù đó. Thời gian chung sống lâu ngày khiến Nick cũng có thể hiểu một số thói quen và biểu cảm của Dương Phàm, Nick cũng muốn làm theo để khiến cô vui vẻ. Đáng tiếc, khi Nick cười đáp trả lại Dương Phàm, cũng là lúc cô suýt tý nữa bay tim ra ngoài. Đoạn đó, cô cứ tưởng Nick tức giận muốn cắn chết cô nữa chứ :v :v\r\n\r\nVề sau, trải qua nhiều tranh đấu trong tư tưởng thì Dương Phàm mới dần chấp nhận và tình nguyện bên Nick. Đoạn bên nhau này khỏi nói vì ngọt ngào dễ thương gì đâu luôn á. Nick đi đâu cũng luôn cõng theo cô bên mình để bảo vệ chăm sóc hết nè. Rồi khi Nick bị thay lông thì mặc cảm tự ti lắm luôn. Cứ sợ bộ lông cũ không nhanh rụng hết để lông mới lên thì thể nào Dương Phàm cũng chán ghét cho xem. Thế nên, khi trông thấy cô khoác tấm lông của người khác, Nick ghen kinh hồn. Đến mức ném bay đi xa luôn.\r\n\r\nChưa kể, sau này khi cô sinh con trai ý, Nick chỉ muốn đá văng cái tên này càng xa càng tốt. Lại còn xấu bụng muốn nó nhanh nhanh học cách trưởng thành đi. Đừng có muốn quấn quýt quanh Dương Phàm nữa, Nick bực mình lắm lắm. Nói thật, Nick đến khi làm cha rồi mà vẫn dễ thương và đáng yêu kinh khủng luôn đó nha.\r\n\r\nNên bạn nào đang cần tìm những câu chuyện thú vị hài hước và cute thế này thì nhanh nhảy hố nghen. Truyện không hề có những cao trào sóng gió gì mà chỉ kể về cuộc sống hằng ngày đơn giản và sự đấu tranh tư tưởng của Dương Phàm khi đối mặt với thế giới xa lạ mới mà thôi. Nhưng, phải thừa nhận rằng Nick quá sức đáng yêu cùng tình cảm của anh dành cho Dương Phàm khiến người đọc vô cùng cảm động và thích thú. Chỉ mong, nếu được cũng muốn mang ngay một anh Nick thế này về nhà nuôi để có thể mỗi lúc buồn hay cô đơn đều nghe tiếng G-rù G-rù thân thuộc kia ', '\"Tôi không phải là một con quái vật sẽ biến thành hoàng tử sau khi lời nguyền được hóa giải. Tôi chỉ là quái vật mà thôi...\" (*)\r\n\r\nVà sẽ như thế nào nếu có một tình yêu được nảy mầm từ chính cô gái bé nhỏ con người cùng với con quái thú to lớn đáng sợ như quái vật? Liệu tình yêu ấy có thật sự đi đến cuối cùng để có một kết thúc trọn vẹn hay không? Khi mà khoảng cách giữa họ là cả một chặng đường thật xa...\r\n\r\nDương Phàm trong một lần tình cờ thì xuyên không về thời viễn cổ, khi mà tất cả mọi thứ chỉ là sự thô sơ nguyên thủy cùng hoang dã. Thế giới này quá xa lạ, cô không tìm thấy được bất cứ điều gì để bấu víu và hy vọng. Sự tuyệt vọng sợ hãi như lan tràn...\r\n\r\nRồi cô bị một con quái thú to lớn với bộ lông rậm rạp trên người, đôi mắt như thằn lằn và cái đuôi dài đầy hung tợn bắt đem về hang của nó. Phút giây đó, mọi thứ trong cô như đổ vỡ. Chẳng lẽ, cô chính là thức ăn của con quái thú này?\r\n\r\nNhưng điều kỳ lạ là nó không hề có ý định thương tổn hay giết gì cô. Nó để mặc cho cô chạy trốn khỏi hang động rồi nhanh như sóc bắt cô đem về lại. Dường như, nó nghĩ rằng màn chạy trốn mà cô trối sống trối chết bày ra đó chỉ là màn \"dạo mát\" quanh quẩn đâu đây mà thôi. Và thật dễ dàng khi tóm gọn cô đem về :v :v\r\n\r\nSau những lần \"bỏ đi\" không thành, Dương Phàm cũng thôi ngay ý định đó. Ở bên con quái thú này ít ra cô còn được an toàn hơn so với thế giới đầy đáng sợ ngoài kia. Cô đặt tên cho nó là Nick và bắt đầu tìm hiểu thân cận cũng như muốn lợi dụng nó để tồn tại ở đây.\r\n\r\nNick không phải là con người, cũng không hẳn là thú. Nick là người-nguyên-thủy nên vẫn mang trong mình những bản chất của người, nhưng phần thú vẫn luôn tồn tại song song. Ngay khi nhặt được Dương Phàm ngoài bìa rừng, Nick đã cảm thấy thích cô gái bé nhỏ này và muốn đem về hang nuôi làm vợ.\r\n\r\nNick không thể nói, cũng không thông minh hiểu chuyện, mọi thứ Nick làm đều xuất phát từ bản năng và tập tính của dã thú. Nhưng điều đó, cũng không thể ngăn cản được phần tình cảm tốt đẹp mà Nick dành riêng cho Dương Phàm. Thế nên, khi thấy cô bị \"chảy máu\" đến tháng, Nick đã cuống cuồng lo lắng tìm đủ mọi cách chữa bệnh cho cô. Nick không đi đâu hết, chỉ luôn ôm cô vào lòng và kêu lên những tiếng G-rù G-rù rất thương tâm.\r\n\r\nRồi khi đi săn thú trở về, những miếng thịt ngon nhất Nick luôn để dành riêng cho Dương Phàm. Bất kể cô muốn làm gì Nick đều mặc kệ mà dung túng. Chỉ cần cô không thoát khỏi phạm vi an toàn Nick đặt ra và đi quá giới hạn thì mọi chuyện đều ổn. Vì thế, Nick hái đủ loại trái cây, săn đủ con thú, bắt cá tôm, lấy trứng... về cho cô thí nghiệm toàn bộ.', 50000, 48000, 10, '20638270_1975349652747363_2612861335452521033_n.png', 0, 0),
(18, '10', 'Cửu Gia, đừng làm vậy', 'Khi nàng cảm thấy hàn khí quanh người dần tan biến thì gió trong không trung đã bình ổn lại.\r\n\r\nVụn gỗ đầy trời sột soạt rải xuống, nàng ngơ ngác nhìn lên nóc nhà trống không.\r\n\r\nAi có thể cho nàng biết vừa rồi là cái gì không… Truyện Cửu Gia, Đừng Làm Vậy mở màn đầy ấn tượng, với những tình tiết lí giải tiếp theo cũng vô cùng tinh tế.\r\n\r\nBên tai nhất thời yên lặng một cách đáng sợ, Đại Bạch trong lòng hất tay nàng ra há miệng kêu lên, Nhẫm Cửu không nghe tiếng tiếng nó, mãi một lúc sau mới có động tĩnh từ từ truyền vào tai nàng, nàng bò dậy, ôm đầu nhìn ra ngoài, các nữ nhân đều ôm con bước ra, nhìn chằm chằm về phía sau núi với vẻ mặt kinh hoàng, không biết đang xầm xì cái gì.\r\n\r\nNhẫm Cửu ngưng thần, ổn định bước chân tiến ra đại sảnh: “Mọi người đừng hoảng!” Nàng cao giọng hét lên, cho dù tai mình vẫn đang không ngừng ong ong, nhưng đã trấn áp được nỗi sợ của mọi người.\r\n\r\nBa tháng trước nàng đã là Trại chủ, phải có dáng vẻ của Trại chủ. Nhẫm Cửu nghĩ vậy, nàng vừa xoa dịu nữ nhân và trẻ con, vừa nhìn theo hướng họ chỉ… Sau đó, nàng nghe thấy giọng mình không ngừng ong ong lặp lại bên tai hết lần này đến lần khác: “Đó là thứ gì vậy?”', 'Khi nàng cảm thấy hàn khí quanh người dần tan biến thì gió trong không trung đã bình ổn lại.\r\n\r\nVụn gỗ đầy trời sột soạt rải xuống, nàng ngơ ngác nhìn lên nóc nhà trống không.\r\n\r\nAi có thể cho nàng biết vừa rồi là cái gì không… Truyện Cửu Gia, Đừng Làm Vậy mở màn đầy ấn tượng, với những tình tiết lí giải tiếp theo cũng vô cùng tinh tế.', 50000, 48000, 10, 'cuu-gia-dung-lam-vay.jpg', 0, 0),
(19, '8', 'Ông xã là Phúc Hắc Đại Nhân', '“Ông xã là phúc hắc đại nhân” kể về quá trình một cô nàng ngây thơ gặp gỡ và yêu một anh chàng gian xảo, có một ước mơ được làm phi công, cả 2 quen nhau từ thời đi học. Nam chính là một người bá đạo trên từng hạt gạo, anh tên là Khang Duật, sinh ra trong một gia đình người Đông Bắc và thuộc dòng hoàng thân quốc thích của triều Thanh nên anh có họ mĩ miều là Ái Tân Giác La. Trong một lần tình cờ gặp gỡ, cô đã hiểu lầm anh là kẻ xấu chuyên đi trêu chọc chó nên cô đã đánh anh. Điều làm nên sự hài hước, cuốn hút của truyện là tính cách của anh nam chính rất bá đạo, gian xảo và biến thái, một người thù dai và sẽ chơi khăm người khác nếu ai dám động vào người anh yêu hay làm gì có lỗi với anh.\r\n\r\nSau bao nhiêu năm đọc truyện, ngoài cái tên Ái Tân Giác La Khang Duật thì mình vẫn mãi ấn tượng với nam chính vì lối suy nghĩ khác người. Có 1 lần nữ chính hỏi anh: “Cậu nói xem, đại và tiểu tiện khác nhau chỗ nào?”, nam chính đã bình tĩnh trả lời thế này: “Tụi nó là anh em cùng chung một con đường, nhưng mà tiểu rất có nghĩa khí, đại không phải lần nào cũng đi với tiểu, nhưng mà mỗi lần đại đi ra, tiểu luôn đi theo!!”', '“Ông xã là phúc hắc đại nhân” kể về quá trình một cô nàng ngây thơ gặp gỡ và yêu một anh chàng gian xảo, có một ước mơ được làm phi công, cả 2 quen nhau từ thời đi học. Nam chính là một người bá đạo trên từng hạt gạo, anh tên là Khang Duật, sinh ra trong một gia đình người Đông Bắc và thuộc dòng hoàng thân quốc thích của triều Thanh nên anh có họ mĩ miều là Ái Tân Giác La. Trong một lần tình cờ gặp gỡ, cô đã hiểu lầm anh là kẻ xấu chuyên đi trêu chọc chó nên cô đã đánh anh. Điều làm nên sự hài hước, cuốn hút của truyện là tính cách của anh nam chính rất bá đạo, gian xảo và biến thái, một người thù dai và sẽ chơi khăm người khác nếu ai dám động vào người anh yêu hay làm gì có lỗi với anh.', 50000, 48000, 10, '4a2010b753291d745784c1ae1be0f8b3.jpg', 0, 0),
(20, '8', 'Con thỏ bắt nạt cỏ gần hang', 'Bộ truyện rất dễ thương, mang đầy tâm lý con người, xuyên suốt từ khi còn là trẻ em đến khi lớn lên của một cặp thanh mai trúc mã. Tiêu Thố và Lăng Siêu biết nhau từ một lần gặp mặt trong bệnh viện, vài ngày sau khi Siêu Siêu được sinh ra và Thỏ Thỏ sinh non được xuất viện. Ở gần nhà nhau, cùng tuổi với nhau, cha mẹ lại thân với nhau tạo nhiều điều kiện khiến hai đứa trẻ trở thành bạn từ nhỏ. Mặc dù không thông minh được như Lăng Siêu, Thỏ Thỏ luôn cố gắng ‘bảo kê’ cậu ’em trai nuôi’ này. Mặc dù không quan tâm lắm đến các bạn xung quanh mình, ánh mắt Siêu Siêu từ lúc nào đã hướng về Thỏ Thỏ. Lớn lên từng ngày, tình cảm càng tiến triển mạnh mẽ. Điều quan trọng nhất là: Làm sao có thể cho cô nàng Tiểu Thỏ biết được tình cảm của Tiểu Siêu đây?”\r\n\r\nCon thỏ bắt nạt cỏ gần hang là một trong những bộ ngôn tình sủng hiện đại tiêu biểu cho giai đoạn đầu khi truyện ngôn tình vừa du nhập vào Việt Nam, đem đến cảm giác ngọt ngào và ấm áp cho người đọc, đặc biệt phù hợp với ai yêu thích thể loại truyện tình yêu lãng mạn, kết thúc có hậu và nam nữ chính yêu thương nhau từ đầu chí cuối.', 'Bộ truyện rất dễ thương, mang đầy tâm lý con người, xuyên suốt từ khi còn là trẻ em đến khi lớn lên của một cặp thanh mai trúc mã. Tiêu Thố và Lăng Siêu biết nhau từ một lần gặp mặt trong bệnh viện, vài ngày sau khi Siêu Siêu được sinh ra và Thỏ Thỏ sinh non được xuất viện. Ở gần nhà nhau, cùng tuổi với nhau, cha mẹ lại thân với nhau tạo nhiều điều kiện khiến hai đứa trẻ trở thành bạn từ nhỏ. Mặc dù không thông minh được như Lăng Siêu, Thỏ Thỏ luôn cố gắng ‘bảo kê’ cậu ’em trai nuôi’ này. Mặc dù không quan tâm lắm đến các bạn xung quanh mình, ánh mắt Siêu Siêu từ lúc nào đã hướng về Thỏ Thỏ. Lớn lên từng ngày, tình cảm càng tiến triển mạnh mẽ. Điều quan trọng nhất là: Làm sao có thể cho cô nàng Tiểu Thỏ biết được tình cảm của Tiểu Siêu đây?”', 50000, 48000, 10, 'con-tho-bat-nat-co-gan-hang.jpg', 0, 0),
(21, '7', 'Yêu em từ cái nhìn đầu tiên', 'Thế giới ảo – cầu nối của những trái tim… “Yêu em từ cái nhìn đầu tiên” là câu chuyện kể về một mối tình lãng mạn từ trong game đến ngoài đời thực của Bối Vi Vi và Tiêu Nại. Bối Vi Vi là hoa khôi của khoa Công nghệ thông tin trong trường còn Tiêu Nại là một đại nam thần, là học trưởng của Bối Vi Vi. Và Bối Vi Vi với Tiêu Nại cũng nhờ game online mà quen biết nhau nhưng tình yêu của họ không hề ảo, mà rất thực tế. Bối Vi Vi và Tiêu Nại đã mang chuyện tình cảm của họ từ thế giới ảo ra ngoài đời thật theo một cách rất ngọt ngào. Còn game online chỉ là chất xúc tác để làm cho tình yêu của hai người thêm thú vị và hấp dẫn.\r\n\r\nCó thể nói Yêu em từ cái nhìn đầu tiên là 1 trong những bộ ngôn tình võng du đầu tiên và nổi bật nhất của thể loại này. Tiêu Nại luôn ở thế chủ động trong mối tình này, tình yêu mà Tiêu Nại dành cho Bối Vy Vy là một thứ tình cảm yêu thương vô điều kiện. Nó khiến cho người đọc cũng cảm thấy ngọt ngào và hạnh phúc cùng với nhân vật chính.', 'Thế giới ảo – cầu nối của những trái tim… “Yêu em từ cái nhìn đầu tiên” là câu chuyện kể về một mối tình lãng mạn từ trong game đến ngoài đời thực của Bối Vi Vi và Tiêu Nại. Bối Vi Vi là hoa khôi của khoa Công nghệ thông tin trong trường còn Tiêu Nại là một đại nam thần, là học trưởng của Bối Vi Vi. Và Bối Vi Vi với Tiêu Nại cũng nhờ game online mà quen biết nhau nhưng tình yêu của họ không hề ảo, mà rất thực tế. Bối Vi Vi và Tiêu Nại đã mang chuyện tình cảm của họ từ thế giới ảo ra ngoài đời thật theo một cách rất ngọt ngào. Còn game online chỉ là chất xúc tác để làm cho tình yêu của hai người thêm thú vị và hấp dẫn.', 50000, 48000, 10, 'yeuem12.jpg', 0, 0),
(22, '7', 'Ngày em đến', 'Nam chính hơn nữ chính 13 tuổi, là boss lớn, giàu có, đẹp trai, tài giỏi, lão luyện. Nam chính tàn tật, bị tai nạn giao thông mất cẳng chân trái. Nữ chính cũng là người có tiền, xinh đẹp đáng yêu đặc biệt nhất là vô cùng hiểu chuyện. Nam nữ chính không phải nhất kiến chung tình mà tình cảm được tích luỹ từ những lần tiếp xúc, chung đụng. Tình cảm của 2 anh chị rất nhẹ nhàng, anh sủng cô, yêu cô. Còn cô thì quan tâm, chăm sóc, nghe lời anh từ những điều nhỏ nhặt nhất.\r\n\r\nĐặc biệt là cái tàn tật của anh không phải là lý do để ngược mà còn giúp anh chiếm được nhiều cái “đầu tiên” của con gái nhà người ta. Cao trào của truyện không đến từ tiểu tam hay người yêu cũ mà đến từ những người thân trong gia đình anh chị. Điểm cộng của truyện không đến từ cốt truyện mà đến từ tính cách nữ chính, từ cách nam chính sủng nữ chính, đến từ từng câu chữ cho dù đang tả nghiêm túc nhưng khi ta ngẫm nghĩ nó thì lại bất giác phì cười. Nữ chính thông minh hiểu chuyện, anh dặn gì cô cũng đều nghe, không nóng nảy hành động thiếu suy nghĩ, biết phân tích rõ tình huống, biết chăm sóc anh tinh tế mà không làm anh tổn thương.', 'Nam chính hơn nữ chính 13 tuổi, là boss lớn, giàu có, đẹp trai, tài giỏi, lão luyện. Nam chính tàn tật, bị tai nạn giao thông mất cẳng chân trái. Nữ chính cũng là người có tiền, xinh đẹp đáng yêu đặc biệt nhất là vô cùng hiểu chuyện. Nam nữ chính không phải nhất kiến chung tình mà tình cảm được tích luỹ từ những lần tiếp xúc, chung đụng. Tình cảm của 2 anh chị rất nhẹ nhàng, anh sủng cô, yêu cô. Còn cô thì quan tâm, chăm sóc, nghe lời anh từ những điều nhỏ nhặt nhất.', 50000, 48000, 10, 'ngay-em-den.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `slider_id` int(11) NOT NULL,
  `slider_image` varchar(100) NOT NULL,
  `slider_caption` varchar(100) NOT NULL,
  `slider_order` int(11) NOT NULL,
  `slider_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`slider_id`, `slider_image`, `slider_caption`, `slider_order`, `slider_active`) VALUES
(1, 'banner-truyện-trọn-bộ.jpg', '', 0, 1),
(2, 'b3.jpg', 'Slider 2', 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `tbl_baiviet`
--
ALTER TABLE `tbl_baiviet`
  ADD PRIMARY KEY (`baiviet_id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `tbl_danhmuc_tin`
--
ALTER TABLE `tbl_danhmuc_tin`
  ADD PRIMARY KEY (`danhmuc_tin_id`);

--
-- Chỉ mục cho bảng `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  ADD PRIMARY KEY (`donhang_id`);

--
-- Chỉ mục cho bảng `tbl_giaodich`
--
ALTER TABLE `tbl_giaodich`
  ADD PRIMARY KEY (`giaodich_id`);

--
-- Chỉ mục cho bảng `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  ADD PRIMARY KEY (`giohang_id`);

--
-- Chỉ mục cho bảng `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  ADD PRIMARY KEY (`khachhang_id`);

--
-- Chỉ mục cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD PRIMARY KEY (`sanpham_id`);

--
-- Chỉ mục cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_baiviet`
--
ALTER TABLE `tbl_baiviet`
  MODIFY `baiviet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_danhmuc_tin`
--
ALTER TABLE `tbl_danhmuc_tin`
  MODIFY `danhmuc_tin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  MODIFY `donhang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `tbl_giaodich`
--
ALTER TABLE `tbl_giaodich`
  MODIFY `giaodich_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  MODIFY `giohang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  MODIFY `khachhang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `sanpham_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
