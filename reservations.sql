-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 25 avr. 2024 à 21:01
-- Version du serveur : 5.7.33
-- Version de PHP : 8.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reservations`
--

-- --------------------------------------------------------

--
-- Structure de la table `artists`
--

CREATE TABLE `artists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `artists`
--

INSERT INTO `artists` (`id`, `firstname`, `lastname`) VALUES
(1, 'Daniel', 'Marcelin'),
(2, 'Philippe', 'Laurent'),
(3, 'Marius', 'Von Mayenburg'),
(4, 'Olivier', 'Boudon'),
(5, 'Anne Marie', 'Loop'),
(6, 'Pietro', 'Varasso'),
(7, 'Laurent', 'Caron'),
(8, 'Élena', 'Perez'),
(9, 'Guillaume', 'Alexandre'),
(10, 'Claude', 'Semal'),
(11, 'Laurence', 'Warin'),
(12, 'Pierre', 'Wayburn'),
(13, 'Gwendoline', 'Gauthier'),
(14, 'Jean-Claude', 'Van Damme');

-- --------------------------------------------------------

--
-- Structure de la table `artist_type`
--

CREATE TABLE `artist_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `artist_type`
--

INSERT INTO `artist_type` (`id`, `artist_id`, `type_id`) VALUES
(1, 1, 3),
(2, 2, 3),
(3, 1, 4),
(4, 2, 4),
(5, 1, 1),
(6, 3, 3),
(7, 4, 4),
(8, 5, 1),
(9, 6, 1),
(10, 7, 1),
(11, 8, 1),
(12, 9, 1),
(13, 10, 3),
(14, 11, 4),
(15, 10, 1),
(16, 12, 3),
(17, 13, 3),
(18, 2, 4),
(19, 12, 1),
(20, 13, 1),
(21, 14, 1);

-- --------------------------------------------------------

--
-- Structure de la table `artist_type_show`
--

CREATE TABLE `artist_type_show` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_type_id` bigint(20) UNSIGNED NOT NULL,
  `show_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `artist_type_show`
--

INSERT INTO `artist_type_show` (`id`, `artist_type_id`, `show_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(7, 5, 3),
(10, 14, 6);

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `localities`
--

CREATE TABLE `localities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `postal_code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locality` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `localities`
--

INSERT INTO `localities` (`id`, `postal_code`, `locality`) VALUES
(1, '1000', 'Bruxelles'),
(2, '1020', 'Laeken'),
(3, '1030', 'Schaerbeek'),
(4, '1040', 'Etterbeek'),
(5, '1050', 'Ixelles'),
(6, '1060', 'Saint-Gilles'),
(7, '1070', 'Anderlecht'),
(8, '1080', 'Molenbeek-Saint-Jean'),
(9, '1081', 'Koekelberg'),
(10, '1082', 'Berchem-Sainte-Agathe'),
(11, '1083', 'Ganshoren'),
(12, '1090', 'Jette'),
(13, '1140', 'Evere'),
(14, '1150', 'Woluwe-Saint-Pierre'),
(15, '1160', 'Auderghem'),
(16, '1170', 'Watermael-Boitsfort'),
(17, '1180', 'Uccle'),
(18, '1190', 'Forest'),
(19, '1200', 'Woluwe-Saint-Lambert');

-- --------------------------------------------------------

--
-- Structure de la table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `locality_id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `locations`
--

INSERT INTO `locations` (`id`, `locality_id`, `slug`, `designation`, `address`, `website`, `phone`, `created_at`, `updated_at`) VALUES
(1, 16, 'espace-delvaux-la-venerie', 'Espace Delvaux / La Vénerie', '3 rue Gratès', 'https://www.lavenerie.be', '+32 (0)2/663.85.50', NULL, NULL),
(2, 1, 'dexia-art-center', 'Dexia Art Center', '50 rue de l\'Ecuyer', NULL, NULL, NULL, NULL),
(3, 1, 'la-samaritaine', 'La Samaritaine', '16 rue de la samaritaine', 'http://www.lasamaritaine.be/', NULL, NULL, NULL),
(4, 1, 'espace-magh', 'Espace Magh', '17 rue du Poinçon', 'http://www.espacemagh.be', '+32 (0)2/274.05.10', NULL, NULL),
(5, 1, 'centre-culturel-des-riches-claires', 'Centre culturel des Riches-Claires', '24 rue des Riches-Claires', 'http://www.lesrichesclaires.be/', '02/548 25 70', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_03_09_160428_create_customer_columns', 1),
(5, '2024_03_09_160429_create_subscriptions_table', 1),
(6, '2024_03_09_160430_create_subscription_items_table', 1),
(7, '2024_03_09_170552_create_artists_table', 1),
(8, '2024_03_11_134922_create_locations_table', 1),
(9, '2024_03_11_135906_create_types_table', 1),
(10, '2024_03_11_140131_create_localities_table', 1),
(11, '2024_03_11_140219_create_roles_table', 1),
(12, '2024_03_15_090952_create_artist_type_table', 1),
(13, '2024_03_15_102740_create_shows_table', 1),
(14, '2024_03_29_173928_create_representations_table', 1),
(15, '2024_03_29_180434_create_reservations_table', 1),
(16, '2024_03_30_202510_create_prices_table', 1),
(17, '2024_03_30_202855_create_representation_reservation_table', 1),
(18, '2024_03_30_211633_create_reviews_table', 1),
(19, '2024_03_31_115219_create_artist_type_show_table', 1),
(20, '2024_03_31_123057_create_user_role_table', 1),
(21, '2024_04_02_091857_update_users_table', 1),
(23, '2024_04_23_113556_add_stripe_invoice_id_to_reservations_table', 2),
(24, '2024_04_24_104002_create_seats_table', 2),
(25, '2024_04_24_104937_add_seat_id_to_representation_reservation_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prices`
--

CREATE TABLE `prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `prices`
--

INSERT INTO `prices` (`id`, `type`, `price`, `start_date`, `end_date`) VALUES
(1, 'Adulte', 24.00, '2012-10-01', '2012-12-31'),
(2, 'Étudiant', 10.00, '2012-10-01', NULL),
(3, 'Senior', 18.00, '2012-10-01', NULL),
(4, 'Adulte', 26.00, '2013-01-01', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `representations`
--

CREATE TABLE `representations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `show_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `schedule` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `representations`
--

INSERT INTO `representations` (`id`, `show_id`, `location_id`, `schedule`) VALUES
(1, 1, 1, '2012-10-12 13:30:00'),
(2, 1, 2, '2012-10-12 20:30:00'),
(4, 3, NULL, '2012-10-16 20:30:00'),
(5, 6, 5, '2024-04-26 21:41:00'),
(6, 6, 5, '2024-04-26 21:41:00');

-- --------------------------------------------------------

--
-- Structure de la table `representation_reservation`
--

CREATE TABLE `representation_reservation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `representation_id` bigint(20) UNSIGNED NOT NULL,
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `price_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `seat_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `representation_reservation`
--

INSERT INTO `representation_reservation` (`id`, `representation_id`, `reservation_id`, `price_id`, `quantity`, `seat_id`) VALUES
(1, 2, 1, 1, 2, NULL),
(2, 1, 2, 2, 1, NULL),
(7, 2, 26, 3, 1, NULL),
(9, 2, 28, 2, 1, NULL),
(10, 1, 29, 3, 1, NULL),
(15, 1, 44, 4, 1, NULL),
(16, 1, 45, 2, 1, NULL),
(17, 1, 45, 3, 1, NULL),
(18, 1, 45, 4, 1, NULL),
(19, 1, 46, 2, 1, NULL),
(20, 1, 47, 4, 1, NULL),
(21, 1, 48, 4, 2, NULL),
(22, 1, 49, 4, 2, NULL),
(23, 1, 50, 2, 1, NULL),
(24, 1, 58, 2, 1, NULL),
(25, 1, 59, 2, 1, NULL),
(27, 2, 61, 2, 1, NULL),
(28, 1, 62, 2, 1, NULL),
(29, 1, 63, 2, 1, NULL),
(30, 1, 64, 2, 1, NULL),
(31, 1, 65, 2, 4, NULL),
(32, 1, 66, 4, 1, NULL),
(33, 1, 67, 4, 1, NULL),
(34, 1, 68, 4, 1, NULL),
(35, 1, 69, 2, 1, NULL),
(36, 1, 70, 4, 1, NULL),
(37, 1, 71, 2, 1, NULL),
(38, 1, 72, 3, 1, NULL),
(39, 1, 73, 2, 1, NULL),
(40, 2, 74, 3, 1, NULL),
(41, 1, 75, 3, 1, NULL),
(42, 1, 75, 4, 1, NULL),
(43, 1, 76, 2, 2, NULL),
(44, 1, 78, 2, 1, NULL),
(45, 1, 78, 3, 1, NULL),
(46, 1, 78, 4, 1, NULL),
(47, 1, 79, 2, 1, NULL),
(48, 1, 79, 3, 1, NULL),
(49, 1, 79, 4, 1, NULL),
(50, 1, 81, 2, 1, NULL),
(51, 1, 81, 3, 1, NULL),
(52, 1, 82, 4, 1, NULL),
(53, 1, 85, 3, 1, NULL),
(54, 1, 85, 4, 1, NULL),
(55, 1, 87, 4, 1, NULL),
(56, 1, 89, 2, 1, NULL),
(57, 1, 89, 3, 1, NULL),
(58, 1, 89, 4, 1, NULL),
(59, 1, 90, 2, 1, NULL),
(60, 1, 90, 3, 1, NULL),
(61, 1, 91, 2, 1, NULL),
(62, 1, 92, 2, 1, NULL),
(63, 1, 93, 2, 1, NULL),
(64, 4, 94, 2, 1, NULL),
(65, 1, 95, 2, 1, NULL),
(66, 2, 96, 3, 1, NULL),
(67, 2, 96, 4, 1, NULL),
(68, 1, 97, 4, 1, NULL),
(69, 4, 98, 2, 1, NULL),
(70, 4, 99, 2, 1, NULL),
(71, 4, 100, 2, 1, NULL),
(72, 4, 101, 2, 1, NULL),
(73, 2, 102, 2, 1, NULL),
(74, 2, 103, 2, 3, NULL),
(75, 2, 103, 4, 2, NULL),
(76, 2, 104, 2, 1, NULL),
(77, 2, 104, 3, 1, NULL),
(78, 2, 104, 4, 1, NULL),
(79, 2, 105, 2, 1, NULL),
(80, 2, 106, 3, 1, NULL),
(81, 2, 107, 2, 1, NULL),
(82, 2, 107, 3, 1, NULL),
(83, 2, 107, 4, 1, NULL),
(84, 2, 108, 2, 1, NULL),
(85, 2, 108, 3, 1, NULL),
(86, 2, 109, 3, 1, NULL),
(87, 1, 110, 4, 1, NULL),
(88, 1, 111, 2, 1, NULL),
(89, 1, 112, 4, 1, NULL),
(90, 1, 113, 2, 1, NULL),
(91, 1, 114, 4, 1, NULL),
(92, 1, 115, 2, 1, NULL),
(93, 1, 116, 4, 1, NULL),
(94, 1, 117, 2, 1, NULL),
(95, 1, 118, 2, 1, NULL),
(96, 1, 119, 2, 1, NULL),
(97, 1, 120, 2, 1, NULL),
(98, 1, 121, 3, 1, NULL),
(99, 1, 122, 4, 1, NULL),
(100, 1, 123, 4, 1, NULL),
(101, 1, 124, 3, 1, NULL),
(102, 1, 125, 2, 1, NULL),
(103, 1, 126, 2, 1, NULL),
(104, 2, 127, 2, 1, NULL),
(105, 1, 128, 2, 1, NULL),
(106, 1, 129, 4, 1, NULL),
(107, 1, 130, 2, 1, NULL),
(108, 1, 131, 4, 1, NULL),
(109, 1, 132, 4, 1, NULL),
(110, 1, 133, 2, 1, NULL),
(111, 1, 134, 4, 1, NULL),
(112, 1, 135, 3, 1, NULL),
(113, 1, 136, 2, 1, NULL),
(114, 1, 137, 2, 1, NULL),
(115, 1, 138, 2, 1, NULL),
(116, 1, 139, 2, 1, NULL),
(117, 1, 140, 2, 1, NULL),
(118, 1, 141, 3, 1, NULL),
(119, 1, 142, 3, 1, NULL),
(120, 1, 143, 3, 1, NULL),
(121, 1, 144, 4, 1, NULL),
(122, 1, 145, 4, 1, NULL),
(123, 1, 146, 4, 1, NULL),
(124, 1, 147, 2, 1, NULL),
(125, 1, 148, 2, 1, NULL),
(126, 1, 149, 2, 1, NULL),
(127, 1, 174, 2, 1, 1),
(128, 1, 175, 2, 1, 17),
(129, 1, 177, 2, 1, 19),
(130, 1, 178, 2, 1, 7),
(131, 2, 179, 3, 1, 18),
(132, 1, 183, 3, 1, 13),
(133, 2, 187, 2, 1, 8),
(134, 1, 189, 2, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_invoice_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `booking_date`, `status`, `stripe_invoice_id`) VALUES
(1, 1, '2012-10-10 08:00:00', NULL, NULL),
(2, 4, '2012-10-08 08:00:00', NULL, NULL),
(3, 2, '2012-10-15 08:00:00', NULL, NULL),
(26, 4, '2024-04-11 17:50:03', 'canceled', NULL),
(28, 4, '2024-04-11 17:58:08', 'canceled', NULL),
(29, 4, '2024-04-11 18:15:50', 'canceled', NULL),
(44, 4, '2024-04-11 18:41:15', 'canceled', NULL),
(45, 4, '2024-04-11 18:41:52', 'canceled', NULL),
(46, 1, '2024-04-11 19:21:42', 'canceled', NULL),
(47, 1, '2024-04-12 05:32:36', 'pending', NULL),
(48, 1, '2024-04-12 05:32:47', 'pending', NULL),
(49, 1, '2024-04-12 05:33:14', 'canceled', NULL),
(50, 1, '2024-04-12 07:50:06', 'pending', NULL),
(51, 1, '2024-04-12 07:50:10', 'pending', NULL),
(52, 1, '2024-04-12 07:50:12', 'pending', NULL),
(53, 1, '2024-04-12 07:50:13', 'pending', NULL),
(54, 1, '2024-04-12 07:50:14', 'pending', NULL),
(55, 1, '2024-04-12 07:50:15', 'pending', NULL),
(56, 1, '2024-04-12 07:50:17', 'pending', NULL),
(57, 1, '2024-04-12 07:50:18', 'pending', NULL),
(58, 1, '2024-04-12 07:50:48', 'pending', NULL),
(59, 1, '2024-04-12 07:50:52', 'canceled', NULL),
(60, 1, '2024-04-12 07:57:22', 'pending', NULL),
(61, 1, '2024-04-12 07:57:26', 'canceled', NULL),
(62, 1, '2024-04-15 06:50:30', 'canceled', NULL),
(63, 1, '2024-04-15 10:05:35', 'canceled', NULL),
(64, 1, '2024-04-15 10:45:47', 'canceled', NULL),
(65, 1, '2024-04-15 12:49:46', 'canceled', NULL),
(66, 1, '2024-04-16 12:07:08', 'pending', NULL),
(67, 1, '2024-04-16 12:07:09', 'pending', NULL),
(68, 1, '2024-04-16 12:07:10', 'canceled', NULL),
(69, 4, '2024-04-19 10:59:25', 'canceled', NULL),
(70, 4, '2024-04-19 11:09:56', 'canceled', NULL),
(71, 4, '2024-04-19 11:33:09', 'canceled', NULL),
(72, 4, '2024-04-19 11:50:46', 'canceled', NULL),
(73, 4, '2024-04-21 11:04:06', 'canceled', NULL),
(74, 4, '2024-04-21 11:08:47', 'canceled', NULL),
(75, 4, '2024-04-21 11:26:34', 'canceled', NULL),
(76, 4, '2024-04-21 11:27:51', 'canceled', NULL),
(78, 4, '2024-04-21 13:37:51', 'canceled', NULL),
(79, 4, '2024-04-21 13:38:10', 'canceled', NULL),
(81, 4, '2024-04-21 13:40:17', 'pending', NULL),
(82, 4, '2024-04-21 13:40:43', 'canceled', NULL),
(85, 4, '2024-04-21 14:24:55', 'pending', NULL),
(87, 4, '2024-04-21 14:25:51', 'pending', NULL),
(89, 4, '2024-04-21 14:26:08', 'pending', NULL),
(90, 4, '2024-04-21 17:52:24', 'pending', NULL),
(91, 4, '2024-04-22 07:33:21', 'canceled', NULL),
(92, 4, '2024-04-22 07:40:02', 'canceled', NULL),
(93, 4, '2024-04-22 09:28:41', 'pending', NULL),
(94, 4, '2024-04-22 09:29:15', 'pending', NULL),
(95, 4, '2024-04-23 09:40:20', 'canceled', NULL),
(96, 4, '2024-04-23 09:46:32', 'canceled', NULL),
(97, 4, '2024-04-23 09:54:11', 'canceled', NULL),
(98, 4, '2024-04-23 10:06:34', 'pending', NULL),
(99, 4, '2024-04-23 10:06:43', 'pending', NULL),
(100, 4, '2024-04-23 10:06:47', 'pending', NULL),
(101, 4, '2024-04-23 10:06:51', 'pending', NULL),
(102, 4, '2024-04-23 10:07:23', 'canceled', NULL),
(103, 4, '2024-04-23 10:15:23', 'pending', NULL),
(104, 4, '2024-04-23 10:15:33', 'pending', NULL),
(105, 4, '2024-04-23 10:15:39', 'pending', NULL),
(106, 4, '2024-04-23 10:15:43', 'pending', NULL),
(107, 4, '2024-04-23 10:15:53', 'pending', NULL),
(108, 4, '2024-04-23 10:20:30', 'pending', NULL),
(109, 4, '2024-04-23 11:05:03', 'pending', NULL),
(110, 4, '2024-04-23 11:18:09', 'canceled', NULL),
(111, 4, '2024-04-23 11:22:36', 'canceled', NULL),
(112, 4, '2024-04-23 11:27:55', 'canceled', NULL),
(113, 4, '2024-04-23 11:35:23', 'canceled', NULL),
(114, 4, '2024-04-23 12:00:19', 'canceled', NULL),
(115, 4, '2024-04-23 12:57:30', 'canceled', NULL),
(116, 4, '2024-04-23 13:01:26', 'canceled', NULL),
(117, 4, '2024-04-23 13:06:14', 'pending', NULL),
(118, 4, '2024-04-23 13:06:15', 'pending', NULL),
(119, 4, '2024-04-23 13:06:19', 'pending', NULL),
(120, 4, '2024-04-23 13:06:22', 'pending', NULL),
(121, 4, '2024-04-23 13:06:33', 'pending', NULL),
(122, 4, '2024-04-23 13:06:37', 'pending', NULL),
(123, 4, '2024-04-23 13:20:50', 'canceled', NULL),
(124, 4, '2024-04-23 13:30:25', 'canceled', NULL),
(125, 4, '2024-04-23 13:51:41', 'canceled', NULL),
(126, 4, '2024-04-23 13:56:13', 'confirmed', NULL),
(127, 4, '2024-04-23 14:03:55', 'pending', NULL),
(128, 4, '2024-04-23 14:04:21', 'pending', NULL),
(129, 4, '2024-04-23 14:08:40', 'pending', NULL),
(130, 4, '2024-04-23 14:13:18', 'pending', NULL),
(131, 4, '2024-04-23 14:27:53', 'pending', NULL),
(132, 4, '2024-04-23 14:27:57', 'pending', NULL),
(133, 4, '2024-04-23 14:34:09', 'pending', NULL),
(134, 4, '2024-04-23 14:37:49', 'pending', NULL),
(135, 4, '2024-04-23 14:38:15', 'pending', NULL),
(136, 4, '2024-04-23 14:40:02', 'pending', NULL),
(137, 4, '2024-04-23 14:42:23', 'pending', NULL),
(138, 4, '2024-04-23 14:43:17', 'pending', NULL),
(139, 4, '2024-04-23 16:04:45', 'pending', NULL),
(140, 4, '2024-04-23 16:04:51', 'pending', NULL),
(141, 4, '2024-04-23 16:05:45', 'pending', NULL),
(142, 4, '2024-04-23 16:07:48', 'pending', NULL),
(143, 4, '2024-04-23 16:08:39', 'pending', NULL),
(144, 4, '2024-04-23 16:10:39', 'pending', NULL),
(145, 4, '2024-04-23 16:14:17', 'pending', NULL),
(146, 4, '2024-04-23 16:16:44', 'pending', NULL),
(147, 4, '2024-04-23 16:21:44', 'confirmed', NULL),
(148, 4, '2024-04-23 16:27:04', 'confirmed', NULL),
(149, 4, '2024-04-23 16:35:13', 'confirmed', NULL),
(150, 4, '2024-04-24 10:13:21', 'pending', NULL),
(151, 4, '2024-04-24 10:13:32', 'pending', NULL),
(152, 4, '2024-04-24 10:21:56', 'pending', NULL),
(153, 4, '2024-04-24 10:22:13', 'pending', NULL),
(154, 4, '2024-04-24 10:22:18', 'pending', NULL),
(155, 4, '2024-04-24 10:23:51', 'pending', NULL),
(156, 4, '2024-04-24 10:27:36', 'pending', NULL),
(157, 4, '2024-04-24 10:35:30', 'pending', NULL),
(158, 4, '2024-04-24 10:35:35', 'pending', NULL),
(159, 4, '2024-04-24 10:37:21', 'pending', NULL),
(160, 4, '2024-04-24 10:39:57', 'pending', NULL),
(161, 4, '2024-04-24 10:42:26', 'pending', NULL),
(162, 4, '2024-04-24 10:44:01', 'pending', NULL),
(163, 4, '2024-04-24 10:57:51', 'pending', NULL),
(164, 4, '2024-04-24 10:58:04', 'pending', NULL),
(165, 4, '2024-04-24 10:58:16', 'pending', NULL),
(166, 4, '2024-04-24 10:58:23', 'pending', NULL),
(167, 4, '2024-04-24 11:01:03', 'pending', NULL),
(168, 4, '2024-04-24 11:14:35', 'pending', NULL),
(169, 4, '2024-04-24 11:16:12', 'pending', NULL),
(170, 4, '2024-04-24 11:24:51', 'pending', NULL),
(171, 4, '2024-04-24 11:25:06', 'pending', NULL),
(172, 4, '2024-04-24 11:25:15', 'pending', NULL),
(173, 4, '2024-04-24 11:29:43', 'pending', NULL),
(174, 4, '2024-04-24 11:32:30', 'confirmed', 'cs_test_a1F0Q6oCgXRzlNJyQaofG37G13KL5pWM9mfYPfzb2mVxzMCAIiMPWW2iGG'),
(175, 4, '2024-04-24 13:12:47', 'pending', 'cs_test_a1dTaBKiq4FL0LhXeFIGzUmpgw6ZrrVJAXS23CVzS1MJr3c2St7kXQQD9s'),
(176, 4, '2024-04-24 13:14:50', 'pending', NULL),
(177, 4, '2024-04-24 16:19:14', 'canceled', 'cs_test_a1zO788L26umAiNP6A2ISBit7nkpaAAFaNru1iiXOuouctMsJvXdlSFHEm'),
(178, 4, '2024-04-24 16:35:47', 'canceled', 'cs_test_a1GfnmOC9zIkoGmnfqd56ZUkbd8nLL7E80Ci23HhhyRKEh1MaA9msMd5Qi'),
(179, 4, '2024-04-24 16:37:01', 'canceled', 'cs_test_a1pezqQ8YmK73Mu4uy3e5eO1jffL8ueSsDsbr2EELKYknPaEY3jcafL4Mm'),
(180, 4, '2024-04-24 16:37:36', 'pending', NULL),
(181, 4, '2024-04-24 16:37:41', 'pending', NULL),
(182, 4, '2024-04-24 16:38:27', 'pending', NULL),
(183, 4, '2024-04-24 16:38:32', 'canceled', 'cs_test_a1NF15bcpLrkZxpZRCxbq2GTQGH8ejJlDFtVhj8xkKtuA4ORskVwweqeMx'),
(184, 4, '2024-04-24 18:04:40', 'pending', NULL),
(185, 4, '2024-04-24 18:06:55', 'pending', NULL),
(186, 4, '2024-04-24 18:28:31', 'pending', NULL),
(187, 4, '2024-04-24 18:28:37', 'confirmed', 'cs_test_a1XyJS1Bu9t9eg1CKfziOTdc9S9p5s0DBY9pYScHaHJFlMAkLrMHwH4Ok0'),
(188, 1, '2024-04-24 19:13:14', 'pending', NULL),
(189, 4, '2024-04-25 18:31:09', 'canceled', 'cs_test_a1flHNmbIPa1i9oygBt2qUn6ULDBE6zUOt2zWG52v2ke02I8ogr9EiJ1bE');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `show_id` bigint(20) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stars` tinyint(3) UNSIGNED NOT NULL,
  `validated` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'member'),
(3, 'affiliate');

-- --------------------------------------------------------

--
-- Structure de la table `seats`
--

CREATE TABLE `seats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seat_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('available','reserved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `seats`
--

INSERT INTO `seats` (`id`, `seat_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 'S1', 'reserved', NULL, NULL),
(2, 'S2', 'available', NULL, NULL),
(3, 'S3', 'available', NULL, NULL),
(4, 'S4', 'available', NULL, NULL),
(5, 'S5', 'available', NULL, NULL),
(6, 'S6', 'available', NULL, NULL),
(7, 'S7', 'reserved', NULL, NULL),
(8, 'S8', 'reserved', NULL, NULL),
(9, 'S9', 'available', NULL, NULL),
(10, 'S10', 'available', NULL, NULL),
(11, 'S11', 'available', NULL, NULL),
(12, 'S12', 'available', NULL, NULL),
(13, 'S13', 'available', NULL, NULL),
(14, 'S14', 'available', NULL, NULL),
(15, 'S15', 'available', NULL, NULL),
(16, 'S16', 'available', NULL, NULL),
(17, 'S17', 'reserved', NULL, NULL),
(18, 'S18', 'reserved', NULL, NULL),
(19, 'S19', 'reserved', NULL, NULL),
(20, 'S20', 'available', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bxBYZF0WIpO4ZxUyCPD37aqfyCMrs211qrcRcFoS', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibTFwOVp6Y2U2VlR2SHhzYlRKNDNKVXVzNlNUU1ptOGFhUTN0VldrViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJsb2NhbGUiO3M6MjoiZnIiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1714078755);

-- --------------------------------------------------------

--
-- Structure de la table `shows`
--

CREATE TABLE `shows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `poster_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bookable` tinyint(1) NOT NULL DEFAULT '0',
  `created_in` year(4) NOT NULL,
  `duration` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `shows`
--

INSERT INTO `shows` (`id`, `title`, `slug`, `description`, `poster_url`, `location_id`, `bookable`, `created_in`, `duration`) VALUES
(1, 'Ayiti', 'ayiti', 'Un homme est bloqué à l\'aéroport.\n Questionné par les douaniers, il doit alors justifier son identité, et surtout prouver qu\'il est haïtien - qu\'est-ce qu\'être haïtien ?', 'ayiti.jpg', 1, 1, '2010', 90),
(3, 'Ceci n\'est pas un chanteur belge', 'ceci-nest-pas-un-chanteur-belge', 'Non peut-être ?!\r\nEntre Magritte (pour le surréalisme comique) et Maigret (pour le réalisme mélancolique), ce dixième opus semalien propose quatorze nouvelles chansons mêlées à de petits textes humoristiques et à quelques fortes images poétiques.', 'claudebelgesaison220.jpg', 5, 1, '2012', 80),
(4, 'Manneke… !', 'manneke', 'A tour de rôle, Pierre se joue de ses oncles, tantes, grands-parents et surtout de sa mère.', 'wayburn.jpg', 3, 1, '2012', 80),
(5, 'Èmigrés', 'emigres', 'Le titre banal ne présage pas de sa force. Les Émigrés  est une pièce contemporaine au texte saturé d\'esprit et défendue par deux comédiens aussi talentueux qu\'attachants.Une pièce très drôle qu\'il faut ne pas rater.', 'emigres.jpg', 4, 0, '2012', 90),
(6, 'Lend me a Tenor', 'lend-me-a-tenor', 'Lend me a Tenor', 'https://th.bing.com/th/id/R.838a93547312e1ee9560e704db1f72b6?rik=sWtMc3UzPkkEzQ&pid=ImgRaw&r=0', NULL, 1, '2024', 80);

-- --------------------------------------------------------

--
-- Structure de la table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `type`) VALUES
(1, 'comédien'),
(2, 'metteur en scène'),
(3, 'auteur'),
(4, 'scénographe'),
(5, 'costumier'),
(6, 'maquilleur'),
(7, 'régisseur'),
(8, 'technicien'),
(9, 'administratif'),
(10, 'communication'),
(11, 'public');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `login` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `langue` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `firstname`, `lastname`, `email`, `langue`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`) VALUES
(1, 'bob', 'Bob', 'Sull', 'bob@sull.com', 'fr', NULL, '$2y$12$Da4cVP.dQbTunLNVEHO9Ce.TPFNjqq4KmL22X/ORVcd6ugoekooaC', 'EPS6GGylDqCSlbAD2SWYC1uOGwfpg8mFfjGVAXjLrqO7BQFpvrO3QaU0yCgQ', '2024-04-04 13:33:06', '2024-04-19 10:30:40', NULL, NULL, NULL, NULL),
(2, 'john', 'John', 'Doe', 'john@doe.com', 'en', NULL, '$2y$12$vPLvX1Q5hHQyzeDjKzGbuOybjWh5bYKulwRdXuZpsVlJfeKREvGOa', NULL, '2024-04-04 13:33:06', NULL, NULL, NULL, NULL, NULL),
(3, 'jane', 'Jane', 'Doe', 'jane@doe.com', 'en', NULL, '$2y$12$IiRLKfrJyg1xO8rttvUxoOVYifWaPRFPLEA.N0liospFxY/Y3SOuW', NULL, '2024-04-04 13:33:06', NULL, NULL, NULL, NULL, NULL),
(4, 'antoine', 'Antoine', 'Demeure', 'ademeure29@gmail.com', 'fr', NULL, '$2y$12$.qQNBACDZrQd5r1vWwdlLe8qEDPA2pxUYEm/CpxVlLDYBgyG1eTey', 'EMNkkQyMcvh2fUSKGYwEBitmPh8fKTwMZGmw1v68cbExk4J7jYm38kT4scRS', '2024-04-04 13:33:06', '2024-04-23 14:13:18', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_role`
--

CREATE TABLE `user_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_role`
--

INSERT INTO `user_role` (`id`, `role_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 2, 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `artist_type`
--
ALTER TABLE `artist_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist_type_artist_id_foreign` (`artist_id`),
  ADD KEY `artist_type_type_id_foreign` (`type_id`);

--
-- Index pour la table `artist_type_show`
--
ALTER TABLE `artist_type_show`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist_type_show_artist_type_id_foreign` (`artist_type_id`),
  ADD KEY `artist_type_show_show_id_foreign` (`show_id`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `localities`
--
ALTER TABLE `localities`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locations_slug_unique` (`slug`),
  ADD KEY `locations_locality_id_foreign` (`locality_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `representations`
--
ALTER TABLE `representations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `representations_show_id_foreign` (`show_id`),
  ADD KEY `representations_location_id_foreign` (`location_id`);

--
-- Index pour la table `representation_reservation`
--
ALTER TABLE `representation_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `representation_reservation_representation_id_foreign` (`representation_id`),
  ADD KEY `representation_reservation_reservation_id_foreign` (`reservation_id`),
  ADD KEY `representation_reservation_price_id_foreign` (`price_id`),
  ADD KEY `representation_reservation_seat_id_foreign` (`seat_id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_show_id_foreign` (`show_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seats_seat_number_unique` (`seat_number`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shows_slug_unique` (`slug`),
  ADD KEY `shows_location_id_foreign` (`location_id`);

--
-- Index pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Index pour la table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_items_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscription_items_subscription_id_stripe_price_index` (`subscription_id`,`stripe_price`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_login_unique` (`login`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- Index pour la table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_role_id_foreign` (`role_id`),
  ADD KEY `user_role_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `artist_type`
--
ALTER TABLE `artist_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `artist_type_show`
--
ALTER TABLE `artist_type_show`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `localities`
--
ALTER TABLE `localities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `representations`
--
ALTER TABLE `representations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `representation_reservation`
--
ALTER TABLE `representation_reservation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `shows`
--
ALTER TABLE `shows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `artist_type`
--
ALTER TABLE `artist_type`
  ADD CONSTRAINT `artist_type_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `artist_type_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `artist_type_show`
--
ALTER TABLE `artist_type_show`
  ADD CONSTRAINT `artist_type_show_artist_type_id_foreign` FOREIGN KEY (`artist_type_id`) REFERENCES `artist_type` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `artist_type_show_show_id_foreign` FOREIGN KEY (`show_id`) REFERENCES `shows` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_locality_id_foreign` FOREIGN KEY (`locality_id`) REFERENCES `localities` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `representations`
--
ALTER TABLE `representations`
  ADD CONSTRAINT `representations_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `representations_show_id_foreign` FOREIGN KEY (`show_id`) REFERENCES `shows` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `representation_reservation`
--
ALTER TABLE `representation_reservation`
  ADD CONSTRAINT `representation_reservation_price_id_foreign` FOREIGN KEY (`price_id`) REFERENCES `prices` (`id`),
  ADD CONSTRAINT `representation_reservation_representation_id_foreign` FOREIGN KEY (`representation_id`) REFERENCES `representations` (`id`),
  ADD CONSTRAINT `representation_reservation_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`),
  ADD CONSTRAINT `representation_reservation_seat_id_foreign` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_show_id_foreign` FOREIGN KEY (`show_id`) REFERENCES `shows` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `shows`
--
ALTER TABLE `shows`
  ADD CONSTRAINT `shows_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
