-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2021 at 08:20 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) DEFAULT 'Chưa có tên',
  `user_name` varchar(50) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `image` longblob DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `full_name`, `user_name`, `pwd`, `image`, `role_id`) VALUES
(1, 'ADMIN', 'admin', '$2y$10$.wQ.V6MEcZZyx3qQUZsIkuwVnDKKP9gMmHsWvOmCoQnJzMR2tlydO', NULL, 1),
(2, 'USER', 'user', '$2y$10$ZSbRedjYGvnXLY4iKoot2OtM9Cr6gZoHQnhtC/cb2LYtEamfxXNmC', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `date_of_brith` date DEFAULT NULL,
  `country` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `full_name`, `date_of_brith`, `country`) VALUES
(1, 'Nguyễn Hữu Hưng', '1972-01-01', 'Việt Nam'),
(2, 'Stephen Hawking', '1973-01-02', 'Anh'),
(3, 'Sigmund Freud', '1939-05-23', 'Áo'),
(4, 'Nguyễn Nhật Ánh', '1985-07-03', 'Việt Nam'),
(5, 'Haruki Murakami', '1970-09-03', 'Nhật'),
(6, 'Robin Sharma', '1976-04-30', 'Ấn Độ'),
(7, 'Benjamin Graham', '1969-05-19', 'Mỹ'),
(8, 'George Charles Selden', '1930-04-01', 'Mỹ'),
(9, 'Fujiko F Fujio', '1950-07-03', 'Nhật'),
(10, 'Nguyễn Thanh Tùng', '1980-04-22', 'Việt Nam'),
(11, 'Lương Trọng Minh', '1989-06-16', 'Việt Nam');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` longblob DEFAULT NULL,
  `price` float NOT NULL,
  `publish_year` int(4) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `description` varchar(1000) DEFAULT 'Hiện chưa có mô tả'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `author_id`, `title`, `image`, `price`, `publish_year`, `category_id`, `description`) VALUES
(1, 1, 'Lập trình với Scratch 3.0', NULL, 200000, 2019, 2, 'Giới thiệu về ngôn ngữ lập trình kéo thả phổ biến nhất thế giới cho học sinh phổ thông, Scratch 3.0 (phiên bản mới, phát hành năm 2019). Cuốn sách kế thừa hoàn toàn những quan điểm về nội dung, cách trình bày của cuốn sách “Lập trình với Scratch” xuất bản năm 2016 tại NXBGD (viết cho phiên bản Scratch 2.0), đồng thời bổ sung những thông tin mới về giao diện, cách lập trình cũng như các khối lệnh của phiên bản Scratch 3.0. Giúp người học nhanh chóng làm chủ hoàn toàn cách sử dụng Scratch 3.0 thông qua từng bước hướng dẫn thiết kế và lập trình ra 05 chương trình mẫu theo cấp độ từ dễ đến khó. Trên cơ sở đó người học có thể tự tạo ra các ứng dụng trò chơi, ứng dụng hỗ trợ học tập nghiên cứu hoặc đơn giản như làm tấm thiệp hay bộ phim hoạt hình, tùy theo trình độ cũng như  ý tưởng của riêng mình.'),
(2, 2, 'Lược sử thời gian', NULL, 78000, 2020, 2, 'Cùng với Vũ trụ trong vỏ hạt dẻ, Lược sử thời gian được xem là cuốn sách nổi tiếng và phổ biến nhất về vũ trụ học của Stephen Hawking, liên tục được nằm trong danh mục sách bán chạy nhất của các tạp chí nổi tiếng thế giới. Lược sử thời gian là cuốn sử thi về sự ra đời, sự hình thành và phát triển của vũ trụ. Tác giả đưa vào tác phẩm của mình toàn bộ tiến bộ tiến trình khám phá của trí tuệ loài người trên nhiều lĩnh vực: Triết học, Vật lý, Thiên văn học… Nhân dịp kỷ niệm lần in thứ 10 xin trân trong giới thiệu cùng bạn đọc.'),
(3, 2, 'Vũ trụ trong vỏ hạt dẻ', NULL, 80000, 2017, 2, 'Lòng khát khao khám phá luôn là động lực cho trí sáng tạo của con người trong mọi lĩnh vực không chỉ trong khoa học. Điều đó được kiểm chứng trong quyển \"Vũ trụ trong vỏ hạt dẻ.\"'),
(4, 3, 'Về giấc mơ và giải mã giấc mơ', NULL, 120000, 2019, 2, 'Cuốn sách này nhất định là đã mở rộng nhận thức của loài người về bản thân thêm cả toàn bộ lãnh vực cái vô thức và mở ra một hoàng lộ để hiểu được sự chuyển đổi từ cái suy nghĩ vô thức về ý thức, hội nhập về sự hiểu biết và nắm bắt được tác động trị liệu của việc hội nhập này. Nó vĩ đại hơn một công trình mang tầm thế kỷ.'),
(5, 4, 'Mắt biếc', NULL, 88000, 2019, 3, 'Mắt biếc là một tác phẩm được nhiều người bình chọn là hay nhất của nhà văn Nguyễn Nhật Ánh. Tác phẩm này cũng đã được dịch giả Kato Sakae dịch sang tiếng Nhật để giới thiệu với độc giả Nhật Bản.\n“Tôi gửi tình yêu cho mùa hè, nhưng mùa hè không giữ nổi. Mùa hè chỉ biết ra hoa, phượng đỏ sân trường và tiếng ve nỉ non trong lá. Mùa hè ngây ngô, giống như tôi vậy. Nó chẳng làm được những điều tôi ký thác. Nó để Hà Lan đốt tôi, đốt rụi. Trái tim tôi cháy thành tro, rơi vãi trên đường về.”\n… Bởi sự trong sáng của một tình cảm, bởi cái kết thúc buồn, rất buồn khi xuyên suốt câu chuyện vẫn là những điều vui, buồn lẫn lộn…'),
(6, 5, 'Rừng Na-uy', NULL, 95000, 2019, 3, 'Xuất bản lần đầu ở Nhật Bản năm 1987, Truyện Tiểu Thuyết Rừng Na Uy thực sự là một hiện tượng kỳ lạ với 4 triệu bản sách được bán ra, và theo thống kê hiện tại, cứ 7 người Nhật thì có 1 người đã đọc Rừng Na Uy. Tại Trung Quốc, Rừng Na Uy đã trở thành một hiện tượng văn hoá với hơn 1 triệu bản sách được tiêu thụ và được đánh giá là 1 trong 10 cuốn sách có ảnh hưởng lớn nhất ở đại lục trong thế kỷ 20.'),
(7, 5, 'Biên niên ký chim vặn dây cót', NULL, 160000, 2020, 3, 'Toru Okada, một luật sư vừa bỏ việc, đang có một cuộc sống bình thường, giản dị bên cạnh người vợ Kumiko thì đột nhiên con mèo của anh biến mất. Ngay sau đó, vợ anh bỏ đi, để lại một lời nhắn rằng anh đừng cố đi tìm cô. Toru cố gắng đi tìm vợ và con mèo, nhưng việc tìm kiếm đó liên tục bị gián đoạn bởi sự xuất hiện của những nhân vật kỳ lạ trong cuộc sống của anh: Một cô gái điếm tâm thần gọi đến để quấy rối tình dục qua điện thoại, hai chị em thầy đồng, một cô bé 16 tuổi bị ám ảnh bởi cái chết của bạn trai gọi anh là “Chim vặn dây cót”, một cựu chiến binh kể lại cho anh câu chuyện về nỗi kinh hoàng của binh lính Nhật trong những năm đầu Chiến tranh Thế giới thứ hai tại Cao nguyên Mông Cổ và trên đất Trung Hoa. Tất cả những sự kiện kỳ quặc đó lại tiếp tục đẩy anh tới những sự kiện còn kỳ quặc hơn nữa.'),
(8, 6, 'Nhà lãnh đạo không chức danh', NULL, 66000, 2017, 4, 'Suốt hơn 15 năm, Robin Sharma đã thầm lặng chia sẻ với những công ty trong danh sách Fortune 500 và nhiều người siêu giàu khác một công thức thành công đã giúp ông trở thành một trong những nhà cố vấn lãnh đạo được theo đuổi nhiều nhất thế giới. Đây là lần đầu tiên Sharma công bố công thức độc quyền này với bạn, để bạn có thể đạt được những gì tốt nhất, đồng thời giúp tổ chức của bạn có thể có những bước đột phá đến một cấp độ thành công mới trong thời đại thiên biến vạn hóa như hiện nay.'),
(9, 7, 'Nhà đầu tư thông minh', NULL, 140000, 2018, 4, 'Là nhà tư vấn đầu tư vĩ đại nhất của thế kỷ 20, Benjamin Graham đã giảng dạy và truyền cảm hứng cho nhiều người trên khắp thế giới. Triết lý “đầu tư theo giá trị“ của Graham, bảo vệ nhà đầu tư khỏi những sai lầm lớn và dạy anh ta phát triển các chiến lược dài hạn, đã khiến Nhà đầu tư thông minh trở thành cẩm nang của thị trường chứng khoán kể từ lần xuất bản đầu tiên vào năm 1949.'),
(10, 8, 'Tâm lý thị trường chứng khoán', NULL, 75000, 2017, 4, 'Được xuất bản năm 1912, đã trải qua hơn 100 năm nhưng Psychology of Stock Market với phiên bản tiếng Việt mang tên Tâm lý thị trường chứng khoán vẫn giữ nguyên được giá trị của nó cho đến hôm nay.'),
(11, 9, 'Đô-ra-ê-mon tập 1', NULL, 20000, 2019, 5, 'Chuyện nổi tiếng về chú mèo máy thông minh Doraemon và các bạn.'),
(12, 9, 'Đô-ra-ê-mon tập 2', NULL, 20000, 2019, 5, 'Chuyện nổi tiếng về chú mèo máy thông minh Doraemon và các bạn.'),
(13, 9, 'Đô-ra-ê-mon tập 3', NULL, 20000, 2019, 5, 'Chuyện nổi tiếng về chú mèo máy thông minh Doraemon và các bạn.'),
(14, 10, 'Hackers Ielts: Reading', NULL, 190000, 2019, 6, 'Bộ sách luyện thi IELTS đầu tiên có kèm giải thích đáp án chi tiết và hướng dẫn cách tự nâng band điểm.'),
(15, 10, 'Hackers Ielts: Writing', NULL, 165000, 2019, 6, 'Bộ sách luyện thi IELTS đầu tiên có kèm giải thích đáp án chi tiết và hướng dẫn cách tự nâng band điểm.'),
(16, 10, 'Hackers Ielts: Speaking', NULL, 150000, 2019, 6, 'Bộ sách luyện thi IELTS đầu tiên có kèm giải thích đáp án chi tiết và hướng dẫn cách tự nâng band điểm.'),
(17, 10, 'Hackers Ielts: Listening', NULL, 135000, 2019, 6, 'Bộ sách luyện thi IELTS đầu tiên có kèm giải thích đáp án chi tiết và hướng dẫn cách tự nâng band điểm.'),
(18, 11, 'Cờ vua - Tập 1: Những bài học đầu tiên', NULL, 60000, 2018, 7, 'Cờ vua là môn thể thao rèn luyện khả năng tư duy cao cho mỗi người chơi, đồng thời nó là một trò chơi giải trí mang tính sáng tạo. Cờ vua không chỉ có lịch sử lâu dài và được nhiều người yêu thích mà qua mỗi giai đoạn lại có bước đổi mới, phát triển phong phú hơn. Chúng ta có thể chơi cờ vua ở mọi lúc, mọi nơi, trong nhiều trường hợp và hoàn cảnh khác nhau.'),
(19, 11, 'Cờ vua - Tập 2: Những bài học đầu tiên', NULL, 73000, 2018, 7, 'Cờ vua là môn thể thao rèn luyện khả năng tư duy cao cho mỗi người chơi, đồng thời nó là một trò chơi giải trí mang tính sáng tạo. Cờ vua không chỉ có lịch sử lâu dài và được nhiều người yêu thích mà qua mỗi giai đoạn lại có bước đổi mới, phát triển phong phú hơn. Chúng ta có thể chơi cờ vua ở mọi lúc, mọi nơi, trong nhiều trường hợp và hoàn cảnh khác nhau.'),
(20, 11, 'Cờ vua - Tập 3: Những bài học đầu tiên', NULL, 80000, 2018, 7, 'Cờ vua là môn thể thao rèn luyện khả năng tư duy cao cho mỗi người chơi, đồng thời nó là một trò chơi giải trí mang tính sáng tạo. Cờ vua không chỉ có lịch sử lâu dài và được nhiều người yêu thích mà qua mỗi giai đoạn lại có bước đổi mới, phát triển phong phú hơn. Chúng ta có thể chơi cờ vua ở mọi lúc, mọi nơi, trong nhiều trường hợp và hoàn cảnh khác nhau.');

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `book_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(7, 'Giải trí'),
(1, 'Khác'),
(2, 'Khoa học kỹ thuật'),
(4, 'Kinh tế'),
(6, 'Ngoại ngữ'),
(5, 'Thiếu nhi'),
(3, 'Tiểu thuyết');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'ADMIN'),
(2, 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `card_owner` varchar(30) DEFAULT NULL,
  `card_number` int(11) NOT NULL,
  `address` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `number_phone` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD KEY `fk_account_role` (`role_id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `full_name` (`full_name`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `fk_book_author` (`author_id`),
  ADD KEY `fk_book_category` (`category_id`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cartitem_account` (`account_id`),
  ADD KEY `fk_cartitem_book` (`book_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_shipping_account` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `fk_account_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_book_author` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`),
  ADD CONSTRAINT `fk_book_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `fk_cartitem_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `fk_cartitem_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`);

--
-- Constraints for table `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `fk_shipping_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
