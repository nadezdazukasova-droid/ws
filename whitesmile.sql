-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.4:3306
-- Время создания: Окт 11 2026 г., 11:08
-- Версия сервера: 8.4.8
-- Версия PHP: 8.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `whitesmile`
--

-- --------------------------------------------------------

--
-- Структура таблицы `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `client_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `appointment_time` datetime NOT NULL,
  `duration` int UNSIGNED DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `doctor_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `service_id`, `client_name`, `client_phone`, `appointment_time`, `duration`, `status`, `created_at`, `updated_at`, `doctor_id`) VALUES
(1, 2, 4, 'Тестовый пациент', '+7 (999) 111-22-33', '2026-10-08 09:40:00', NULL, 'completed', '2026-10-08 12:36:50', '2026-10-09 09:00:15', 1),
(2, 2, 7, 'Тестовый пациент', '+7 (999) 111-22-33', '2026-10-13 14:00:00', 90, 'cancelled', '2026-10-08 13:00:14', '2026-10-09 09:01:45', 4),
(3, 1, 1, 'Admin', '+7 (999) 000-00-00', '2026-10-10 10:30:00', 30, 'completed', '2026-10-09 11:02:39', '2026-10-10 06:22:05', 1),
(4, 2, 2, 'Тестовый пациент', '+7 (999) 111-22-33', '2026-10-12 16:00:00', 60, 'confirmed', '2026-10-10 07:21:31', '2026-10-10 07:22:22', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialization` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `specialization`, `photo`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Иванов Иван Иванович', 'Стоматолог-терапевт', 'images/doctors/doctor1.jpg', 'Лечение кариеса, пульпита, установка пломб. Стаж 12 лет.', '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(2, 'Петрова Анна Сергеевна', 'Стоматолог-ортодонт', 'images/doctors/doctor2.jpg', 'Исправление прикуса, брекеты, элайнеры. Стаж 8 лет.', '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(3, 'Сидоров Пётр Алексеевич', 'Стоматолог-хирург', 'images/doctors/doctor3.jpg', 'Удаление зубов, имплантация, костная пластика. Стаж 15 лет.', '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(4, 'Кузнецова Мария Владимировна', 'Стоматолог-гигиенист', 'images/doctors/doctor4.jpg', 'Профессиональная чистка, отбеливание, профилактика. Стаж 6 лет.', '2026-10-08 12:33:43', '2026-10-08 12:33:43');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `leads`
--

CREATE TABLE `leads` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `leads`
--

INSERT INTO `leads` (`id`, `name`, `phone`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(3, 'цацацацка', '+7(912)-523-92-49', 'цукацуаука', 'processed', '2026-10-09 10:41:14', '2026-10-09 10:41:25'),
(4, 'Надежда Жукасова', '+7 (999) 111-22-33', 'привет', 'processed', '2026-10-09 11:00:14', '2026-10-09 11:02:17'),
(5, 'Жукасова Надежда', '89226711942', 'привет', 'processed', '2026-10-09 11:03:24', '2026-10-10 06:46:17');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_09_22_124811_create_services_table', 1),
(5, '2026_09_22_124822_create_appointments_table', 1),
(6, '2026_09_22_133809_create_doctors_table', 1),
(7, '2026_09_22_133902_add_doctor_id_to_appointments_table', 1),
(8, '2026_09_22_135448_create_portfolios_table', 1),
(9, '2026_09_22_145556_create_reviews_table', 1),
(10, '2026_10_08_164916_add_specialization_to_services_table', 1),
(11, '2026_10_08_171311_add_phone_to_users_table', 1),
(12, '2026_10_08_171546_add_user_id_to_appointments_table', 1),
(13, '2026_10_08_174227_add_duration_to_appointments_table', 2),
(14, '2026_10_09_111310_add_role_to_users_table', 3),
(15, '2026_10_09_120941_create_leads_table', 4),
(16, '2026_10_09_145451_add_user_id_to_reviews_table', 5),
(17, '2026_10_09_153607_create_notifications_table', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `title`, `message`, `link`, `is_read`, `created_at`, `updated_at`) VALUES
(13, 2, 'appointment_confirmed', 'Запись подтверждена', 'Ваша запись на «Профессиональная чистка зубов» подтверждена. Ждём вас 12.10.2026 16:00.', '/profile', 1, '2026-10-10 07:22:22', '2026-10-10 07:33:23');

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `portfolios`
--

CREATE TABLE `portfolios` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `portfolios`
--

INSERT INTO `portfolios` (`id`, `title`, `image`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Имплантация переднего зуба', 'images/cases/case1.jpg', 'Имплантация', '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(2, 'Профессиональное отбеливание ZOOM 4', 'images/cases/case2.jpg', 'Отбеливание', '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(3, 'Исправление прикуса брекетами', 'images/cases/case3.jpg', 'Ортодонтия', '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(4, 'Лечение кариеса с реставрацией', 'images/cases/case4.jpg', 'Терапия', '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(5, 'Протезирование коронками', 'images/cases/case5.jpg', 'Протезирование', '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(6, 'Профессиональная гигиена полости рта', 'images/cases/case6.jpg', 'Гигиена', '2026-10-08 12:33:43', '2026-10-08 12:33:43');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL DEFAULT '5',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `client_name`, `text`, `rating`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Мария С.', 'Лечила кариес у Ивана Ивановича. Всё прошло абсолютно безболезненно, врач очень внимательный. Теперь хожу только сюда!', 5, 1, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(2, NULL, 'Екатерина Л.', 'Делала профессиональную чистку у Марии Владимировны. Результат отличный, зубы заметно посветлели. Спасибо!', 5, 1, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(3, NULL, 'Ольга П.', 'Поставила имплант у Петра Алексеевича. Всё аккуратно, без боли. Клиника чистая, современная. Рекомендую!', 5, 1, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(4, NULL, 'Ирина К.', 'Носила брекеты у Анны Сергеевны два года. Результат превзошёл ожидания — улыбка ровная, прикус исправлен!', 5, 1, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(5, NULL, 'Дмитрий В.', 'Удалял зуб мудрости. Была паника, но врач успокоил и всё сделал быстро. На следующий день даже не болело.', 5, 1, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(6, NULL, 'Анна М.', 'Отбеливала зубы перед свадьбой. Результат потрясающий — улыбка стала заметно белее! Спасибо WhiteSmile.', 5, 1, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(7, NULL, 'Сергей Н.', 'Привёл ребёнка на первый осмотр. Врач нашёл подход, объяснил всё, ребёнок больше не боится стоматологов.', 5, 1, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(8, NULL, 'Наталья Т.', 'Хорошая клиника, современное оборудование. Записываюсь онлайн — очень удобно, всегда нахожу свободное время.', 5, 1, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(9, NULL, 'Алексей Р.', 'Лечение пульпита прошло отлично. Врач всё подробно объяснил, показал снимки. Цены адекватные.', 5, 1, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(10, NULL, 'Елена Ж.', 'Приятная атмосфера, вежливый персонал. Делала гигиену и пломбу — быстро и качественно.', 5, 1, '2026-10-08 12:33:43', '2026-10-08 12:33:43');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialization` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` int NOT NULL,
  `duration` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `title`, `specialization`, `description`, `price`, `duration`, `created_at`, `updated_at`) VALUES
(1, 'Консультация стоматолога', 'Стоматолог-терапевт', 'Осмотр полости рта, постановка диагноза, составление плана лечения.', 500, 30, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(2, 'Профессиональная чистка зубов', 'Стоматолог-гигиенист', 'Ультразвуковая чистка, удаление налёта и камня, полировка эмали.', 3500, 60, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(3, 'Лечение кариеса', 'Стоматолог-терапевт', 'Пломбирование зубов современными материалами. Без боли.', 4500, 60, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(4, 'Лечение пульпита', 'Стоматолог-терапевт', 'Эндодонтическое лечение — удаление нерва, пломбирование каналов.', 7500, 90, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(5, 'Удаление зуба', 'Стоматолог-хирург', 'Простое и сложное удаление зубов. Атравматично, с обезболиванием.', 3000, 45, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(6, 'Имплантация зуба', 'Стоматолог-хирург', 'Установка импланта с последующей коронкой. Гарантия 5 лет.', 45000, 120, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(7, 'Отбеливание зубов', 'Стоматолог-гигиенист', 'Профессиональное отбеливание Philips ZOOM 4. Осветление до 8 тонов.', 18000, 90, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(8, 'Брекеты (установка)', 'Стоматолог-ортодонт', 'Металлические или керамические брекеты. Консультация и установка.', 60000, 120, '2026-10-08 12:33:43', '2026-10-08 12:33:43');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pbZv4Sq8YvcUVrnvqPA2XX4w5Abvdll6smuLT1RD', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 16; Pixel 10) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Mobile Safari/537.36', 'eyJfdG9rZW4iOiJEYm13bFNYR3VOSHVxQWxFdkVZejJQRjl5SWZIMmRwamVQdDNrVUhHIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cHM6XC9cL3doaXRlc21pbGVcL3BvcnRmb2xpbyIsInJvdXRlIjoicG9ydGZvbGlvLmluZGV4In19', 1791650536),
('TIuIyMdpQhEHj0OPlPK55MEgxRWEi1FPtXM2COxm', 1, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 16; Pixel 10) AppleWebKit/537.36 (KHTML, like Gecko) Edg/155.0.0.0 Mobile Safari/537.36', 'eyJfdG9rZW4iOiJIMTA2eUhRS2ZjSzFNTmY3YURCTzJwMk9ya2pobDBsM09ZbzVlTHFqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC93aGl0ZXNtaWxlXC9hcGlcL25vdGlmaWNhdGlvbnNcL3JlY2VudCIsInJvdXRlIjoiYXBpLm5vdGlmaWNhdGlvbnMucmVjZW50In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwidXJsIjpbXSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9', 1791648818);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@whitesmile.ru', 'admin', '+7 (999) 000-00-00', NULL, '$2y$12$REzUrKOVAQQhk1rBHaD1yupcahN8HEvD.GkAq4KJOPBQ9B75pxaW.', NULL, '2026-10-08 12:33:43', '2026-10-08 12:33:43'),
(2, 'Тестовый пациент', 'test@test.ru', 'client', '+7 (999) 111-22-33', NULL, '$2y$12$kMvGcIwvIEhXm2Zy2RX3Se.GpF3jR0sBXAdYcc48Q4sw/Ad0bjsh.', NULL, '2026-10-08 12:35:01', '2026-10-08 12:35:01'),
(3, 'София', 'anuta.vasilevs@mail.ru', 'client', '+7 (999) 111-22-33', NULL, '$2y$12$5QQxSmz.n3VNfATIxrLQoOyehQIW1Zz2our1nJdIwZqAH4K.ycyxm', 'KG6RPnAPWzmhLGhMSybpjnjIgndN2MufPWS0EOSoS5GQtLltTMvap8X1hqTW', '2026-10-10 10:12:39', '2026-10-10 10:18:31'),
(4, 'Жукасова Надежда', 'nadiazhukasova45@mail.ru', 'client', '+7 (999) 111-22-33', NULL, '$2y$12$dMprRL/VC97MMEdX1Y8RieJl9VRTuxyIlrwowMGoHxfmSgTvule0a', 'ddraazARnElY7botxAxAvnCsOtdfgqp4wITh3dEX43YDZKhbUrU1tOEtVxfE', '2026-10-10 10:31:42', '2026-10-10 10:34:58');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_service_id_foreign` (`service_id`),
  ADD KEY `appointments_doctor_id_foreign` (`doctor_id`),
  ADD KEY `appointments_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Индексы таблицы `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Индексы таблицы `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Индексы таблицы `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_is_read_index` (`user_id`,`is_read`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `leads`
--
ALTER TABLE `leads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `appointments_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
