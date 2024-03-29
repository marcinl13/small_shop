CREATE TABLE `small_shop_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `small_shop_categories`
--

INSERT INTO `small_shop_categories` (`id`, `name`) VALUES(1, 'men\'s clothing');
INSERT INTO `small_shop_categories` (`id`, `name`) VALUES(2, 'jewelery');
INSERT INTO `small_shop_categories` (`id`, `name`) VALUES(3, 'electronics');
INSERT INTO `small_shop_categories` (`id`, `name`) VALUES(4, 'women\'s clothing');

-- --------------------------------------------------------

--
-- Table structure for table `small_shop_migrations`
--

CREATE TABLE `small_shop_migrations` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `small_shop_migrations`
--

INSERT INTO `small_shop_migrations` (`id`, `name`) VALUES(1, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `small_shop_products`
--

CREATE TABLE `small_shop_products` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `small_shop_products`
--

INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(1, 'Fjallraven - Foldsack No. 1 Backpack, Fits 15 Laptops', 109.95, 1, 'https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(2, 'Mens Casual Premium Slim Fit T-Shirts', 22.3, 1, 'https://fakestoreapi.com/img/71-3HjGNDUL._AC_SY879._SX._UX._SY._UY_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(3, 'Mens Cotton Jacket', 55.99, 1, 'https://fakestoreapi.com/img/71li-ujtlUL._AC_UX679_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(4, 'Mens Casual Slim Fit', 15.99, 1, 'https://fakestoreapi.com/img/71YXzeOuslL._AC_UY879_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(5, 'John Hardy Women\'s Legends Naga Gold & Silver Dragon Station Chain Bracelet', 695, 2, 'https://fakestoreapi.com/img/71pWzhdJNwL._AC_UL640_QL65_ML3_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(6, 'Solid Gold Petite Micropave', 168, 2, 'https://fakestoreapi.com/img/61sbMiUnoGL._AC_UL640_QL65_ML3_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(7, 'White Gold Plated Princess', 9.99, 2, 'https://fakestoreapi.com/img/71YAIFU48IL._AC_UL640_QL65_ML3_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(8, 'Pierced Owl Rose Gold Plated Stainless Steel Double', 10.99, 2, 'https://fakestoreapi.com/img/51UDEzMJVpL._AC_UL640_QL65_ML3_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(9, 'WD 2TB Elements Portable External Hard Drive - USB 3.0', 64, 3, 'https://fakestoreapi.com/img/61IBBVJvSDL._AC_SY879_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(10, 'SanDisk SSD PLUS 1TB Internal SSD - SATA III 6 Gb/s', 109, 3, 'https://fakestoreapi.com/img/61U7T1koQqL._AC_SX679_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(11, 'Silicon Power 256GB SSD 3D NAND A55 SLC Cache Performance Boost SATA III 2.5', 109, 3, 'https://fakestoreapi.com/img/71kWymZ+c+L._AC_SX679_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(12, 'WD 4TB Gaming Drive Works with Playstation 4 Portable External Hard Drive', 114, 3, 'https://fakestoreapi.com/img/61mtL65D4cL._AC_SX679_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(13, 'Acer SB220Q bi 21.5 inches Full HD (1920 x 1080) IPS Ultra-Thin', 599, 3, 'https://fakestoreapi.com/img/81QpkIctqPL._AC_SX679_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(14, 'Samsung 49-Inch CHG90 144Hz Curved Gaming Monitor (LC49HG90DMNXZA) – Super Ultrawide Screen QLED', 999.99, 3, 'https://fakestoreapi.com/img/81Zt42ioCgL._AC_SX679_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(15, 'BIYLACLESEN Women\'s 3-in-1 Snowboard Jacket Winter Coats', 56.99, 4, 'https://fakestoreapi.com/img/51Y5NI-I5jL._AC_UX679_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(16, 'Lock and Love Women\'s Removable Hooded Faux Leather Moto Biker Jacket', 29.95, 4, 'https://fakestoreapi.com/img/81XH0e8fefL._AC_UY879_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(17, 'Rain Jacket Women Windbreaker Striped Climbing Raincoats', 39.99, 4, 'https://fakestoreapi.com/img/71HblAHs5xL._AC_UY879_-2.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(18, 'MBJ Women\'s Solid Short Sleeve Boat Neck V', 9.85, 4, 'https://fakestoreapi.com/img/71z3kpMAYsL._AC_UY879_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(19, 'Opna Women\'s Short Sleeve Moisture', 7.95, 4, 'https://fakestoreapi.com/img/51eg55uWmdL._AC_UX679_.jpg');
INSERT INTO `small_shop_products` (`id`, `name`, `price`, `category_id`, `image`) VALUES(20, 'DANVOUY Womens T Shirt Casual Cotton Short', 12.99, 4, 'https://fakestoreapi.com/img/61pHAEJ4NML._AC_UX679_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `small_shop_products_likes`
--

CREATE TABLE `small_shop_products_likes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `unlikes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `small_shop_categories`
--
ALTER TABLE `small_shop_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `small_shop_migrations`
--
ALTER TABLE `small_shop_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `small_shop_products`
--
ALTER TABLE `small_shop_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `small_shop_products_likes`
--
ALTER TABLE `small_shop_products_likes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `small_shop_categories`
--
ALTER TABLE `small_shop_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `small_shop_migrations`
--
ALTER TABLE `small_shop_migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `small_shop_products`
--
ALTER TABLE `small_shop_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `small_shop_products_likes`
--
ALTER TABLE `small_shop_products_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--