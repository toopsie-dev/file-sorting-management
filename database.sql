-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2021 at 03:09 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gleentdocs`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'melvin@gmail.com', '$2y$10$OkpqZH2z.n.U6utFvwoX3uXE/WKeLShUI1xR0LAV3IA1P0jdcHwA.', 1, '2021-06-29 06:14:36', '2021-06-29 15:47:28'),
(2, 'gabayan@gmail.com', '$2y$10$ri08K5kzutoGM.7XZJjVxO5mhRuTxOAie8yivKN81CRPjSHEzeF1m', 2, NULL, NULL),
(3, 'librando@gmail.com', '$2y$10$uiQfGcVOGSLfp2j1QUcCcO20Z2rObHG5F/Gj/ujjtg/23hklfy1AW', 3, NULL, NULL),
(4, 'marana@gmail.com', '$2y$10$.eIXpVX1MJ7LMcVfPVqyvuWqT3w1.WbeJsegkhoa7GykXq1mSljkW', 4, NULL, NULL),
(5, 'sarte@gmail.com', '$2y$10$YRM7sES4l2HHw782st0AtO8HGowolDcO5ucESo3LdncEU9Y5s58GO', 5, NULL, NULL),
(6, 'kevin@gmail.com', '$2y$10$Mmkqmrp1p0RBSehV5frV8.QNhJKt0GAEq5KwYmszsbDQaot4Yy.FO', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `division_id`, `created_at`, `updated_at`) VALUES
(1, 'Overall', 1, '2021-06-29 06:12:50', '2021-06-29 06:12:50'),
(2, 'Finance', 2, '2021-06-29 14:22:04', '2021-06-29 14:22:04'),
(3, 'Accounting', 2, '2021-06-29 14:22:11', '2021-06-29 14:22:11'),
(4, 'Training', 2, '2021-06-29 14:22:20', '2021-06-29 14:22:20'),
(5, 'SprintHR', 3, '2021-06-29 14:22:28', '2021-06-29 14:22:28'),
(6, 'Intellident', 3, '2021-06-29 14:23:12', '2021-06-29 14:23:12'),
(7, 'International Development', 4, '2021-06-30 08:17:35', '2021-06-30 08:17:35'),
(8, 'Outsourcing', 4, '2021-06-30 08:17:53', '2021-06-30 08:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Overall', '2021-06-29 06:12:30', '2021-06-29 06:12:30'),
(2, 'General Admin', '2021-06-29 14:21:28', '2021-06-29 14:21:28'),
(3, 'Local', '2021-06-29 14:21:47', '2021-06-29 14:21:47'),
(4, 'Operations', '2021-06-30 08:17:18', '2021-06-30 08:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `implementors`
--

CREATE TABLE `implementors` (
  `post_id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `implementors`
--

INSERT INTO `implementors` (`post_id`, `dep_id`) VALUES
(1, 1),
(2, 1),
(3, 5),
(4, 5),
(6, 8),
(7, 8),
(8, 1),
(9, 1),
(10, 1),
(5, 5),
(5, 6),
(11, 7),
(11, 8),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(49, '2021_06_08_120832_create_divisions_table', 1),
(50, '2021_06_08_120940_create_departments_table', 1),
(51, '2021_06_12_153635_create_posts_table', 1),
(52, '2021_06_12_153806_create_implementors_table', 1),
(53, '2021_06_12_153822_create_revisions_table', 1),
(54, '2021_06_21_195349_create_users_table', 1),
(55, '2021_06_21_195408_create_accounts_table', 1),
(56, '2021_06_21_223557_create_user_departments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `isConfirm` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `type`, `title`, `description`, `author`, `division_id`, `image`, `status`, `isConfirm`, `created_at`, `updated_at`) VALUES
(1, 'Process', 'Laravel Routing', 'So, what if the incoming request fields do not pass the given validation rules? As mentioned previously, Laravel will automatically redirect the user back', 'Melvin Lilis', '1', 'default.jpg', 1, 1, '2021-06-29 14:30:41', '2021-06-29 14:49:10'),
(2, 'Process', 'JQuery Validation', 'If the incoming HTTP request contains \"nested\" field data, you may specify these fields in your validation rules using \"dot\" syntax:', 'Camille Sarte', '1', '0629212302phonepicutres-TA.jpg', 1, 1, '2021-06-29 14:33:11', '2021-06-29 15:03:26'),
(3, 'Form', 'Validating File Upload', 'The \"accept\" rule-method that\'s built into jQuery Validation takes values in a format resembling \"jpg|png\".', 'Erick James Gabayan', '3', 'default.jpg', 1, 1, '2021-06-29 15:35:24', '2021-06-29 15:47:49'),
(4, 'Form', 'Approval', 'Thesis Approval', 'Erick James Gabayan', '3', 'default.jpg', 1, 1, '2021-06-29 15:46:14', '2021-06-29 15:47:42'),
(5, 'Form', 'Completion Form with Authorization', 'n this example, the sidebar section is utilizing the @parent directive to append (rather than overwriting) content to the layout\'s sidebar. The @parent directive will be replaced by the content of the layout when the view is rendered.', 'Erick James Gabayan', '3', '0630210009wp2936933.jpg', 1, 1, '2021-06-29 16:09:57', '2021-07-01 05:19:19'),
(6, 'Process', 'Default Route Files', 'Routes defined in the routes/api.php file are nested within a route group by the RouteServiceProvider. Within this group, the /api URI prefix is automatically applied so you do not need to manually apply it to every route in the file. You may modify the prefix and other route group options by modifying your RouteServiceProvider class.', 'Melvin Lilis', '4', '0630211630france-in-pictures-beautiful-places-to-photograph-eiffel-tower.jpg', 1, 1, '2021-06-30 08:18:53', '2021-07-05 11:15:47'),
(7, 'Form', 'Basic Controllers', 'Laravel\'s encryption services provide a simple, convenient interface for encrypting and decrypting text via OpenSSL u', 'Kevin De Guzman', '4', '0630211637phonepicutres-TA.jpg', 1, 1, '2021-06-30 08:37:50', '2021-06-30 08:54:54'),
(8, 'Form', 'Authentication', 'By default, Laravel includes an App\\Models\\User Eloquent model in your app/Models directory. This model may be used with the default Eloquent authentication driver. If your application is not using Eloquent, you may use the', 'Melvin Lilis', '1', 'default.jpg', 0, 0, '2021-06-30 08:57:44', '2021-06-30 09:02:20'),
(9, 'Form', 'Starter Kits', 'By default, Laravel includes an App\\Models\\User Eloquent model in your app/Models directory. This model may be used with the default Eloquent authentication driver. If your application is not using Eloquent, you may use the', 'Melvin Lilis', '1', 'default.jpg', 0, 0, '2021-06-30 08:59:40', '2021-06-30 09:02:16'),
(10, 'Form', 'Passport', 'Passport is an OAuth2 authentication provider, offering a variety of OAuth2 \"grant types\" which allow you to issue various types of tokens. In general, this is a robust and complex package for API authentication. How', 'Melvin Lilis', '1', 'default.jpg', 0, 0, '2021-06-30 09:01:57', '2021-06-30 09:02:11'),
(11, 'Form', 'Sanctum', 'Displays an image overlay effect on hover.', 'Kevin De Guzman', '4', '070121133815531840725c93b5489d84e9.43781620.jpg', 1, 1, '2021-06-30 09:03:12', '2021-07-01 05:38:21'),
(12, 'Form', 'Database: Seeding', 'As an example, let\'s modify the default DatabaseSeeder class and add a database insert statement to the run method:', 'Alex Librando', '1', '0705211149063021001320200429211042-GettyImages-1164615296.jpeg', 1, 1, '2021-07-05 03:45:04', '2021-07-05 03:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `revisions`
--

CREATE TABLE `revisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `revision_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `changes` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `change_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `isConfirm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `revisions`
--

INSERT INTO `revisions` (`id`, `post_id`, `type`, `document`, `revision_id`, `changes`, `change_by`, `date`, `status`, `isConfirm`) VALUES
(1, 1, 'link', 'https://laravel.com/docs/8.x/routing', '', '', 'Melvin Lilis', '2021-06-29 22:30:42', 1, 0),
(2, 2, 'link', 'https://laravel.com/docs/8.x/validation', '', '', 'Camille Sarte', '2021-06-29 22:33:11', 1, 0),
(3, 2, 'link', 'https://laravel.com/docs/8.x/validation', '1', 'Sometimes you may wish to stop running validation rules on an attribute after the first validation failure. To do so, assign the bail rule to the attribute', 'Camille Sarte', '2021-06-29 22:44:46', 1, 0),
(4, 2, 'link', 'https://laravel.com/docs/8.x/validation', '2', 'On the other hand, if your field name contains a literal period, you can explicitly prevent this from being interpreted as \"dot\" syntax by escaping the period with a backslash:', 'Camille Sarte', '2021-06-29 22:47:15', 1, 0),
(5, 1, 'link', 'https://laravel.com/docs/8.x/validation', '1', 'So, what if the incoming request fields do not pass the given validation rules? As mentioned previously, Laravel will automatically redirect the user back', 'Camille Sarte', '2021-06-29 22:49:10', 1, 0),
(6, 2, 'link', 'https://laravel.com/docs/8.x/validation', '3', 'On the other hand, if your field name contains a literal period, you can explicitly prevent this from being interpreted as \"dot\" syntax by escaping the period with a backslash:', 'Camille Sarte', '2021-06-29 23:02:51', 1, 0),
(7, 2, 'link', 'https://laravel.com/docs/8.x/validation', '4', 'If the incoming HTTP request contains \"nested\" field data, you may specify these fields in your validation rules using \"dot\" syntax:', 'Camille Sarte', '2021-06-29 23:03:27', 1, 0),
(8, 3, 'link', 'https://stackoverflow.com/questions/10496952/validating-file-upload-jquery-and-accept-attribute', '', '', 'Erick James Gabayan', '2021-06-29 23:35:25', 1, 0),
(9, 4, 'file', '0629212346APPROVAL.docx', '', '', 'Erick James Gabayan', '2021-06-29 23:46:14', 1, 0),
(10, 5, 'file', '0630210009Certificate-of-completion.docx', '', '', 'Erick James Gabayan', '2021-06-30 00:09:58', 1, 0),
(11, 5, 'file', '0630210012Certificate-of-completion.docx', '1', 'Adding Authorization approval', 'Erick James Gabayan', '2021-06-30 00:12:02', 1, 0),
(12, 6, 'link', 'https://laravel.com/docs/8.x/routing', '', '', 'Melvin Lilis', '2021-06-30 16:18:54', 1, 0),
(13, 6, 'link', 'https://laravel.com/docs/8.x/routing', '1', 'For most applications, you will begin by defining routes in your routes/web.php file. The routes defined in routes/web.php may be accessed by entering the defined route\'s URL in your browser. For example, you may access the following route by navigating to http://example.com/user in your browser:', 'Melvin Lilis', '2021-06-30 16:30:31', 1, 0),
(14, 6, 'link', 'https://laravel.com/docs/8.x/routing', '2', 'Routes defined in the routes/api.php file are nested within a route group by the RouteServiceProvider. Within this group, the /api URI prefix is automatically applied so you do not need to manually apply it to every route in the file. You may modify the prefix and other route group options by modifying your RouteServiceProvider class.', 'Melvin Lilis', '2021-06-30 16:33:36', 1, 0),
(15, 7, 'file', '0630211637History.docx', '', '', 'Kevin De Guzman', '2021-06-30 16:37:51', 1, 0),
(16, 7, 'link', 'https://laravel.com/docs/8.x/encryption', '1', 'Let\'s take a look at an example of a basic controller. Note that the controller extends the base controller class included with Laravel:', 'Kevin De Guzman', '2021-06-30 16:44:14', 1, 0),
(17, 7, 'link', 'https://laravel.com/docs/8.x/encryption', '2', 'Laravel\'s encryption services provide a simple, convenient interface for encrypting and decrypting text via OpenSSL u', 'Kevin De Guzman', '2021-06-30 16:54:55', 1, 0),
(18, 8, 'link', 'https://laravel.com/docs/8.x/authentication', '', '', 'Melvin Lilis', '2021-06-30 16:57:45', 1, 0),
(19, 9, 'link', 'https://laravel.com/docs/8.x/authentication', '', '', 'Melvin Lilis', '2021-06-30 16:59:41', 1, 0),
(20, 10, 'link', 'https://laravel.com/docs/8.x/authentication', '', '', 'Melvin Lilis', '2021-06-30 17:01:57', 1, 0),
(21, 11, 'link', 'https://laravel.com/docs/8.x/authentication', '', '', 'Kevin De Guzman', '2021-06-30 17:03:13', 1, 0),
(22, 11, 'link', 'https://laravel.com/docs/7.x/blade', '1', 'When defining a child view, use the Blade @extends directive to specify which layout the child view should \"inherit\".', 'Melvin Lilis', '2021-07-01 12:59:55', 1, 0),
(23, 11, 'link', 'https://laravel.com/docs/7.x/blade', '2', 'In this example, the sidebar section is utilizing the @parent directive to append (rather than overwriting) content to the la', 'Melvin Lilis', '2021-07-01 13:00:25', 1, 0),
(24, 11, 'link', 'https://laravel.com/docs/7.x/blade', '3', 'In this example, the sidebar section is utilizing the @parent directive to append (rather than overwriting) content to the layout\'s sidebar. The @parent directive will be replaced by the content of the layout when the vi', 'Melvin Lilis', '2021-07-01 13:17:09', 1, 0),
(25, 5, 'link', 'https://laravel.com/docs/7.x/blade', '2', 'n this example, the sidebar section is utilizing the @parent directive to append (rather than overwriting) content to the layout\'s sidebar. The @parent directive will be replaced by the content of the layout when the view is rendered.', 'Melvin Lilis', '2021-07-01 13:19:19', 1, 0),
(26, 11, 'link', 'https://www.30secondsofcode.org/css/s/image-overlay-hover', '4', 'Displays an image overlay effect on hover.', 'Melvin Lilis', '2021-07-01 13:38:21', 1, 0),
(27, 12, 'link', 'https://laravel.com/docs/8.x/database', '', '', 'Alex Librando', '2021-07-05 11:45:04', 1, 0),
(28, 12, 'link', 'https://laravel.com/docs/8.x/seeding', '1', 'Laravel includes the ability to seed your database with test data using seed classes. All seed classes are stored in the database/seeders directory. By default, a DatabaseSeeder class is defined for you. From this class, you may use the call method to run other seed classes, allowing you to control the seeding order.', 'Alex Librando', '2021-07-05 11:49:12', 1, 0),
(29, 12, 'link', 'https://laravel.com/docs/8.x/seeding', '2', 'As an example, let\'s modify the default DatabaseSeeder class and add a database insert statement to the run method:', 'Alex Librando', '2021-07-05 11:50:23', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `access_level`, `division_id`, `status`, `img`, `created_at`, `updated_at`) VALUES
(1, 'Melvin', 'Lilis', 'Admin', '1', 1, 'default.png', '2021-06-29 06:13:50', '2021-06-29 06:13:50'),
(2, 'Erick James', 'Gabayan', 'Employee', '3', 1, '063021001320200429211042-GettyImages-1164615296.jpeg', '2021-06-29 14:26:30', '2021-06-29 16:13:59'),
(3, 'Alex', 'Librando', 'Employee', '3', 1, '07052111290630210013phonepicutres-TA.jpg', '2021-06-29 14:27:27', '2021-07-05 03:29:31'),
(4, 'John Harold', 'Marana', 'Intern', '2', 1, NULL, '2021-06-29 14:28:07', '2021-06-29 14:28:07'),
(5, 'Camille', 'Sarte', 'Admin', '2', 1, NULL, '2021-06-29 14:28:45', '2021-06-29 14:28:45'),
(6, 'Kevin', 'De Guzman', 'Employee', '4', 1, NULL, '2021-06-30 08:35:54', '2021-06-30 08:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_departments`
--

CREATE TABLE `user_departments` (
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_departments`
--

INSERT INTO `user_departments` (`user_id`, `department_id`) VALUES
(1, 1),
(2, 5),
(3, 5),
(3, 6),
(6, 7),
(6, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revisions`
--
ALTER TABLE `revisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `revisions`
--
ALTER TABLE `revisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
