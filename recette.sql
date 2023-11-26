-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2023 at 08:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recette`
--

-- --------------------------------------------------------

--
-- Table structure for table `cookbooks`
--

CREATE TABLE `cookbooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `saved_recipes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`saved_recipes`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cookbooks`
--

INSERT INTO `cookbooks` (`id`, `user_id`, `saved_recipes`, `created_at`, `updated_at`) VALUES
(1, 1, '[\"2\"]', '2023-05-16 05:39:10', '2023-05-16 05:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_05_15_172636_recipes', 1),
(5, '2023_05_15_172650_cookbooks', 1),
(6, '2023_05_15_180857_users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `ingredients` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `author`, `likes`, `description`, `image_url`, `ingredients`, `created_at`, `updated_at`) VALUES
(2, 'Ugali', 'Nelson Mwangi', 3, 'Boil water for 5 minutes. Add the flour gradually as you stir to amalgamate the flour into a thick cake. Flip once the ugali becomes thick to your liking. Serve with some stew or veggies(Your option) while still hot.', 'https://firebasestorage.googleapis.com/v0/b/recette-cd6aa.appspot.com/o/recipeImages%2Fugali.jpg?alt=media&token=1a81091b-693f-427a-8644-2bb22282500e', 'water|corn flour|stew', '2023-05-14 04:04:21', '2023-05-16 05:39:10'),
(3, 'Ellen\'s Beef Stew', 'Nelson Kamau', 2, 'Combine flour, pepper, and salt in bag. Add meat and shake til coated. Heat oil in Dutch oven. Brown meat on all sides. Add onion, garlic, water, tomatoes, salt, and worcestershire. Cover, reduce heat to low and simmer 2 hours, until meat begins to get tender. Add potatoes, onions, and carrots. Cook 30-45 mins, until vegetables are done. Add peas. Cook until heated.', 'https://firebasestorage.googleapis.com/v0/b/recette-cd6aa.appspot.com/o/recipeImages%2Fellen\'s%20beef.jpg?alt=media&token=d9b15b91-0faf-4d37-81cc-22ff2b05cf91', '1 3/4 lb chuck; or round, cubed|1/3 c flour|1/4 ts pepper|1/2 ts salt|3 tb oil|1/2 onion; chopped|1 cl garlic; minced|2 3/4 c boiling water|28 oz tomatoes; canned|1/2 ts worcestershire|1 pn basil|1 pn dill|1 pn thyme|4 md potatoes; quartered|2 onions; quartered|1 lb carrots; 2 inch pieces|1 c peas', '2023-05-14 06:22:51', '2023-05-14 09:06:08'),
(4, 'Negroni Cocktails', 'Nelson Kamau', 1, 'Place a dozen ice cubes in a tall pitcher. Add the gin, vermouth, and Campari. Stir and chill. Serve over ice in Old-Fashioned glasses; garnish with twists of lemon peel. AMBROSINO\'S NORTH SCOTTSDALE RD., SCOTTSDALE', 'https://firebasestorage.googleapis.com/v0/b/recette-cd6aa.appspot.com/o/recipeImages%2FNegroni%20Cocktails.jpg?alt=media&token=b3936c8e-db6f-4e84-9db6-ae1d6c7c35e4', '1 c gin|1 c sweet italian vermouth|1 c campari|6 lemon-peel twists', '2023-05-14 06:25:12', '2023-05-14 06:29:43'),
(5, 'Goat Cheese Burgers', 'Nelson Kamau', 1, 'Combine beef with crumbs, lemon juice, lemon zest, thyme, salt and pepper. Mix well. Form into 12 thin (4\\\" diameter) patties. Place 1 tablespoon goat cheese atop 6 of the beef patties. Top each with remaining 6 patties. Seal at edges to enclose cheese. Grill until cooked through, about 5 minutes per side, or until desired doneness. Serve with buns and red pepper relish. Yield: 6 servings.', 'https://firebasestorage.googleapis.com/v0/b/recette-cd6aa.appspot.com/o/recipeImages%2FGoat%20Cheese%20Burgers.jpg?alt=media&token=bcf63244-a2e8-4a98-bcc7-60292b764c5c', '1 1/2 lb lean ground beef|1/2 c fresh breadcrumbs|2 tb fresh lemon juice|2 ts lemon zest|2 ts thyme|1 ts salt|1/2 ts pepper|6 tb soft; fresh goat cheese|hamburger buns|red pepper relish', '2023-05-14 06:29:26', '2023-05-14 06:29:39'),
(6, 'Grandpa\'s Homemade Noodles', 'James Brian', 1, 'Mix dry ingredients into liquid by hand. Do not overmix, as it tends to toughen noodles. Use flour sparingly when rolling out dough. Roll out to 1/4 inch thickness and use pizza cutter for cutting noodles. Per serving: 278 Calories (kcal); 6g Total Fat; (20% calories from fat); 7g Protein; 48g Carbohydrate; 16mg Cholesterol; 593mg Sodium Food Exchanges: 3 Grain(Starch); 0 Lean Meat; 0 Vegetable; 0 Fruit; 1 Fat; 0 Other Carbohydrates', 'https://firebasestorage.googleapis.com/v0/b/recette-cd6aa.appspot.com/o/recipeImages%2Forijit-chatterjee-wEBg_pYtynw-unsplash.jpg?alt=media&token=9f553e43-f1cf-478d-8aa2-d913d4ea246e', '2 c flour|2 beaten eggs|2 tb water|2 tb butter or margarine|2 ts bouillon|1 shake pepper|1 ts salt', '2023-05-14 09:11:44', '2023-05-14 09:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'star Boy', 'starboy@gmail.com', '$2y$10$61dQcD0wqVZlQqpTeNJZLu9uhcgz1krIW344k3naTAoTvUQp6AoMq', NULL, '2023-05-16 05:35:28', '2023-05-16 05:35:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cookbooks`
--
ALTER TABLE `cookbooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cookbooks`
--
ALTER TABLE `cookbooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cookbooks`
--
ALTER TABLE `cookbooks`
  ADD CONSTRAINT `cookbooks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
