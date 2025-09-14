-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 02, 2024 at 11:27 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cc_justhire`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admins', 'admin@site.com', 'admin', NULL, '6624ee96387ea1713696406.png', '$2y$12$vc.c.pNxefhOjFzLFNMEW.16i/h1vQCigtZeTLDY12QlIlS0KTWbm', NULL, NULL, '2024-04-21 04:46:46');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `click_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `rent_id` int NOT NULL,
  `method_code` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `method_currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `final_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `btc_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_try` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` tinyint(1) NOT NULL DEFAULT '0',
  `admin_feedback` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `success_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `failed_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_cron` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_tokens`
--

CREATE TABLE `device_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `is_app` tinyint(1) NOT NULL DEFAULT '0',
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'object',
  `support` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'twak.png', 0, '2019-10-18 11:16:05', '2024-05-16 06:23:02'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\n<div class=\"g-recaptcha\" data-sitekey=\"{{site_key}}\" data-callback=\"verifyCaptcha\"></div>\n<div id=\"g-recaptcha-error\"></div>', '{\"site_key\":{\"title\":\"Site Key\",\"value\":\"6LdPC88fAAAAADQlUf_DV6Hrvgm-pZuLJFSLDOWV\"},\"secret_key\":{\"title\":\"Secret Key\",\"value\":\"6LdPC88fAAAAAG5SVaRYDnV2NpCrptLg2XLYKRKB\"}}', 'recaptcha.png', 0, '2019-10-18 11:16:05', '2024-07-30 20:03:54'),
(3, 'custom-captcha', 'Custom Captcha', 'Just put any random string', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, '2019-10-18 11:16:05', '2024-09-02 01:08:16'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{measurement_id}}\"></script>\n                <script>\n                  window.dataLayer = window.dataLayer || [];\n                  function gtag(){dataLayer.push(arguments);}\n                  gtag(\"js\", new Date());\n                \n                  gtag(\"config\", \"{{measurement_id}}\");\n                </script>', '{\"measurement_id\":{\"title\":\"Measurement ID\",\"value\":\"------\"}}', 'ganalytics.png', 0, NULL, '2021-05-03 22:19:12'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"----\"}}', 'fb_com.png', 0, NULL, '2022-03-21 17:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `act`, `form_data`, `created_at`, `updated_at`) VALUES
(7, 'kyc', '{\"permanent_address\":{\"name\":\"Permanent Address\",\"label\":\"permanent_address\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":\"\",\"options\":[],\"type\":\"text\",\"width\":\"6\"},\"present_address\":{\"name\":\"Present Address\",\"label\":\"present_address\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":\"\",\"options\":[],\"type\":\"text\",\"width\":\"6\"},\"national_identity_number\":{\"name\":\"National Identity Number\",\"label\":\"national_identity_number\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":\"jpg,jpeg,png,pdf\",\"options\":[],\"type\":\"file\",\"width\":\"12\"}}', '2022-03-17 02:56:14', '2024-07-30 22:38:41'),
(22, 'store_kyc', '{\"license\":{\"name\":\"License\",\"label\":\"license\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":\"pdf\",\"options\":[],\"type\":\"file\",\"width\":\"12\"}}', '2024-07-30 11:56:14', '2024-07-30 22:42:34');

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint UNSIGNED NOT NULL,
  `data_keys` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tempname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `seo_content`, `tempname`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"vehicle\",\"rental\",\"platform\",\"car\",\"car rent\",\"bike\",\"truck\"],\"description\":\"Discover top-notch rentals tailored to your needs on the Vehicle Rental Platform. Start your search now and experience hassle-free leasing like never before!\",\"social_title\":\"Justhire- Vehicle Rental Platform\",\"social_description\":\"Discover top-notch rentals tailored to your needs on the Vehicle Rental Platform. Start your search now and experience hassle-free leasing like never before!\",\"image\":\"66d5638abea651725260682.png\"}', NULL, NULL, '', '2020-07-04 23:42:52', '2024-09-02 01:06:12'),
(24, 'about.content', '{\"has_image\":\"1\",\"heading\":\"About Company\",\"subheading\":\"You start the engine and your adventure begins\",\"description\":\"Certain but she but shyness why cottage. Guy the put instrument sir entreaties affronting. Pretended exquisite see cordially the you. Weeks quiet do vexed or whose. Motionless if no to affronting imprudence no precaution. My indulged as disposal strongly attended.\",\"image\":\"66a937a6159051722365862.png\"}', NULL, 'basic', '', '2020-10-28 00:51:20', '2024-07-30 12:57:42'),
(25, 'blog.content', '{\"heading\":\"Latest News\",\"subheading\":\"Our Latest Blogs\"}', NULL, 'basic', '', '2020-10-28 00:51:34', '2024-07-30 13:38:35'),
(27, 'contact_us.content', '{\"title\":\"Get in Touch\",\"short_details\":\"Reach out to us for any inquiries or assistance.\",\"map_embedded_link\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d2993.6862912792812!2d2.1202448764395387!3d41.38089999639698!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a498f576297baf%3A0x44f65330fe1b04b9!2sSpotify%20Camp%20Nou!5e0!3m2!1sen!2sbd!4v1717222893198!5m2!1sen!2sbd\",\"contact_address\":\"123 Sample St, Sydney NSW 2000 AU\",\"contact_email\":\"demo@example.com\",\"contact_number\":\"+1(555)000-0000\"}', NULL, 'basic', 'contact', '2020-10-28 00:59:19', '2024-07-30 13:01:01'),
(28, 'counter.content', '{\"heading\":\"Latest News\",\"subheading\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus necessitatibus repudiandae porro reprehenderit, beatae perferendis repellat quo ipsa omnis, vitae!\"}', NULL, 'basic', NULL, '2020-10-28 01:04:02', '2024-03-13 23:54:07'),
(31, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"fab fa-facebook-f\\\"><\\/i>\",\"url\":\"https:\\/\\/www.fb.com\\/\"}', NULL, 'basic', '', '2020-11-12 04:07:30', '2024-07-30 13:29:53'),
(33, 'feature.content', '{\"has_image\":\"1\",\"heading\":\"Our Features\",\"subheading\":\"Experience seamless vehicle rental with our hassle-free service.\",\"background_image\":\"66a939e35243c1722366435.png\",\"image\":\"66a939e368e631722366435.png\"}', NULL, 'basic', '', '2021-01-03 23:40:54', '2024-07-30 13:07:15'),
(34, 'feature.element', '{\"icon\":\"<i class=\\\"icon-fi_3706334\\\"><\\/i>\",\"title\":\"Free Delivery\",\"description\":\"Enjoy the convenience of complimentary delivery for your rented vehicle at no extra cost.\"}', NULL, 'basic', '', '2021-01-03 23:41:02', '2024-07-30 13:47:18'),
(36, 'service.content', '{\"has_image\":\"1\",\"heading\":\"Our Services\",\"subheading\":\"What Makes Us Different?\",\"background_image\":\"66a93c94b64241722367124.png\"}', NULL, 'basic', '', '2021-03-06 01:27:34', '2024-07-30 13:18:45'),
(41, 'cookie.data', '{\"short_desc\":\"We may use cookies or any other tracking technologies when you visit our website, including any other media form, mobile website, or mobile application related or connected to help customize the Site and improve your experience.\",\"description\":\"<h4>Cookie Policy<\\/h4>\\r\\n\\r\\n<p>This Cookie Policy explains how to use cookies and similar technologies to recognize you when you visit our website. It explains what these technologies are and why we use them, as well as your rights to control our use of them.<\\/p>\\r\\n<br>\\r\\n<h4>What are cookies?<\\/h4>\\r\\n\\r\\n<p>Cookies are small pieces of data stored on your computer or mobile device when you visit a website. Cookies are widely used by website owners to make their websites work, or to work more efficiently, as well as to provide reporting information.<\\/p>\\r\\n<br>\\r\\n<h4>Why do we use cookies?<\\/h4>\\r\\n\\r\\n<p>We use cookies for several reasons. Some cookies are required for technical reasons for our Website to operate, and we refer to these as \\\"essential\\\" or \\\"strictly necessary\\\" cookies. Other cookies enable us to track and target the interests of our users to enhance the experience on our Website. Third parties serve cookies through our Website for advertising, analytics, and other purposes.<\\/p>\\r\\n<br>\\r\\n<h4>What types of cookies do we use?<\\/h4>\\r\\n\\r\\n<div>\\r\\n    <ul style=\\\"list-style: unset;\\\">\\r\\n        <li>\\r\\n            <strong>Essential Website Cookies:<\\/strong> \\r\\n            These cookies are strictly necessary to provide you with services available through our Website and to use some of its features.\\r\\n        <\\/li>\\r\\n        <li>\\r\\n            <strong>Analytics and Performance Cookies:<\\/strong> \\r\\n            These cookies allow us to count visits and traffic sources to measure and improve our Website\'s performance.\\r\\n        <\\/li>\\r\\n        <li>\\r\\n            <strong>Advertising Cookies:<\\/strong> \\r\\n            These cookies make advertising messages more relevant to you and your interests. They perform functions like preventing the same ad from continuously reappearing, ensuring that ads are properly displayed, and in some cases selecting advertisements that are based on your interests.\\r\\n        <\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n<br>\\r\\n<h4>Data Collected by Cookies<\\/h4>\\r\\n<p>Cookies may collect various types of data, including but not limited to:<\\/p>\\r\\n<ul style=\\\"list-style: unset;\\\">\\r\\n    <li>IP addresses<\\/li>\\r\\n    <li>Browser and device information<\\/li>\\r\\n    <li>Referring website addresses<\\/li>\\r\\n    <li>Pages visited on our website<\\/li>\\r\\n    <li>Interactions with our website, such as clicks and mouse movements<\\/li>\\r\\n    <li>Time spent on our website<\\/li>\\r\\n<\\/ul>\\r\\n<br>\\r\\n<h4>How We Use Collected Data<\\/h4>\\r\\n\\r\\n<p>We may use data collected by cookies for the following purposes:<\\/p>\\r\\n<ul style=\\\"list-style: unset;\\\">\\r\\n    <li>To personalize your experience on our website<\\/li>\\r\\n    <li>To improve our website\'s functionality and performance<\\/li>\\r\\n    <li>To analyze trends and gather demographic information about our user base<\\/li>\\r\\n    <li>To deliver targeted advertising based on your interests<\\/li>\\r\\n    <li>To prevent fraudulent activity and enhance website security<\\/li>\\r\\n<\\/ul>\\r\\n<br>\\r\\n<h4>Third-party cookies<\\/h4>\\r\\n\\r\\n<p>In addition to our cookies, we may also use various third-party cookies to report usage statistics of our Website, deliver advertisements on and through our Website, and so on.<\\/p>\\r\\n<br>\\r\\n<h4>How can we control cookies?<\\/h4>\\r\\n\\r\\n<p>You have the right to decide whether to accept or reject cookies. You can exercise your cookie preferences by clicking on the \\\"Cookie Settings\\\" link in the footer of our website. You can also set or amend your web browser controls to accept or refuse cookies. If you choose to reject cookies, you may still use our Website though your access to some functionality and areas of our Website may be restricted.<\\/p>\\r\\n<br>\\r\\n<h4>Changes to our Cookie Policy<\\/h4>\\r\\n\\r\\n<p>We may update our Cookie Policy from time to time. We will notify you of any changes by posting the new Cookie Policy on this page.<\\/p>\",\"status\":1}', NULL, NULL, NULL, '2020-07-04 23:42:52', '2024-04-25 06:26:36'),
(42, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<h5 style=\\\"margin:0px;line-height:1.4;font-size:1.125rem;color:rgb(52,73,94);\\\"><b>What information do we collect?<\\/b><\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><p><br \\/><\\/p><\\/div><h5>How do we protect your information?<\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>All provided delicate\\/credit data is sent through Stripe.<br \\/>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><p><br \\/><\\/p><\\/div><h5>Do we disclose any information to outside parties?<\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/p><p><br \\/><\\/p><\\/div><h5>Children\'s Online Privacy Protection Act Compliance<\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><p><br \\/><\\/p><\\/div><h5>Changes to our Privacy Policy<\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>If we decide to change our privacy policy, we will post those changes on this page.<\\/p><p><br \\/><\\/p><\\/div><h5>How long we retain your information?<\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><p><br \\/><\\/p><\\/div><h5>What we don\\u2019t do with your data<\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\"}', '{\"image\":null,\"description\":null,\"social_title\":null,\"social_description\":null,\"keywords\":null}', 'basic', 'privacy-policy', '2021-06-09 08:50:42', '2024-07-30 19:56:10'),
(43, 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>We claim all authority to dismiss, end, or handicap any help with or without cause per administrator discretion. This is a Complete independent facilitating, on the off chance that you misuse our ticket or Livechat or emotionally supportive network by submitting solicitations or protests we will impair your record. The solitary time you should reach us about the seaward facilitating is if there is an issue with the worker. We have not many substance limitations and everything is as per laws and guidelines. Try not to join on the off chance that you intend to do anything contrary to the guidelines, we do check these things and we will know, don\'t burn through our own and your time by joining on the off chance that you figure you will have the option to sneak by us and break the terms.<\\/p><\\/div><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><ul><li>Configuration requests - If you have a fully managed dedicated server with us then we offer custom PHP\\/MySQL configurations, firewalls for dedicated IPs, DNS, and httpd configurations.<\\/li><li>Software requests - Cpanel Extension Installation will be granted as long as it does not interfere with the security, stability, and performance of other users on the server.<\\/li><li>Emergency Support - We do not provide emergency support \\/ Phone Support \\/ LiveChat Support. Support may take some hours sometimes.<\\/li><li>Webmaster help - We do not offer any support for webmaster related issues and difficulty including coding, & installs, Error solving. if there is an issue where a library or configuration of the server then we can help you if it\'s possible from our end.<\\/li><li>Backups - We keep backups but we are not responsible for data loss, you are fully responsible for all backups.<\\/li><li><br \\/><\\/li><li>We Don\'t support any child porn or such material.<\\/li><li>No spam-related sites or material, such as email lists, mass mail programs, and scripts, etc.<\\/li><li>No harassing material that may cause people to retaliate against you.<\\/li><li>No phishing pages.<\\/li><li>You may not run any exploitation script from the server. reason can be terminated immediately.<\\/li><li>If Anyone attempting to hack or exploit the server by using your script or hosting, we will terminate your account to keep safe other users.<\\/li><li>Malicious Botnets are strictly forbidden.<\\/li><li>Spam, mass mailing, or email marketing in any way are strictly forbidden here.<\\/li><li>Malicious hacking materials, trojans, viruses, & malicious bots running or for download are forbidden.<\\/li><li>Resource and cronjob abuse is forbidden and will result in suspension or termination.<\\/li><li>Php\\/CGI proxies are strictly forbidden.<\\/li><li>CGI-IRC is strictly forbidden.<\\/li><li>No fake or disposal mailers, mass mailing, mail bombers, SMS bombers, etc.<\\/li><li>NO CREDIT OR REFUND will be granted for interruptions of service, due to User Agreement violations.<\\/li><li><br \\/><\\/li><\\/ul><\\/div><h5>Terms & Conditions for Users<\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>Before getting to this site, you are consenting to be limited by these site Terms and Conditions of Use, every single appropriate law, and guidelines, and concur that you are answerable for consistency with any material neighborhood laws. If you disagree with any of these terms, you are restricted from utilizing or getting to this site.<\\/p><p><br \\/><\\/p><\\/div><h5>Support<\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>Whenever you have downloaded our item, you may get in touch with us for help through email and we will give a valiant effort to determine your issue. We will attempt to answer using the Email for more modest bug fixes, after which we will refresh the center bundle. Content help is offered to confirmed clients by Tickets as it were. Backing demands made by email and Livechat.<\\/p><p>On the off chance that your help requires extra adjustment of the System, at that point, you have two alternatives:<\\/p><ul><li>Hang tight for additional update discharge.<\\/li><li>Or on the other hand, enlist a specialist (We offer customization for extra charges).<\\/li><li><br \\/><\\/li><\\/ul><\\/div><h5>Ownership<\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>You may not guarantee scholarly or selective possession of any of our items, altered or unmodified. All items are property, we created them. Our items are given \\\"with no guarantees\\\" without guarantee of any sort, either communicated or suggested. On no occasion will our juridical individual be subject to any harms including, however not restricted to, immediate, roundabout, extraordinary, accidental, or significant harms or different misfortunes emerging out of the utilization of or powerlessness to utilize our items.<\\/p><p><br \\/><\\/p><\\/div><h5>Warranty<\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>We don\'t offer any guarantee or assurance of these Services in any way. When our Services have been modified we can\'t ensure they will work with all outsider plugins, modules, or internet browsers. Program similarity ought to be tried against the show formats on the demo worker. If you don\'t mind guarantee that the programs you use will work with the component, as we can not ensure that our systems will work with all program mixes.<\\/p><p><br \\/><\\/p><\\/div><h5>Unauthorized\\/Illegal Usage<\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>You may not utilize our things for any illicit or unapproved reason or may you, in the utilization of the stage, disregard any laws in your locale (counting yet not restricted to copyright laws) just as the laws of your nation and International law. Specifically, it is disallowed to utilize the things on our foundation for pages that advance: brutality, illegal intimidation, hard sexual entertainment, bigotry, obscenity content or warez programming joins.<br \\/><br \\/>You can\'t imitate, copy, duplicate, sell, exchange or adventure any of our segment, utilization of the offered on our things, or admittance to the administration without the express composed consent by us or item proprietor.<br \\/>Our Members are liable for all substance posted on the discussion and demo and movement that happens under your record.<br \\/>We hold the chance of hindering your participation account quickly if we will think about a particularly not allowed conduct.<br \\/>If you make a record on our site, you are liable for keeping up the security of your record, and you are completely answerable for all exercises that happen under the record and some other activities taken regarding the record. You should quickly inform us, of any unapproved employments of your record or some other penetrates of security.<\\/p><p><br \\/><\\/p><\\/div><h5>Fiverr, Seoclerks Sellers Or Affiliates<\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>We do NOT ensure full SEO campaign conveyance within 24 hours. We make no assurance for conveyance time by any means. We give our best assessment to orders during the putting in of requests, anyway, these are gauges. We won\'t be considered liable for loss of assets, negative surveys or you being prohibited for late conveyance. If you are selling on a site that requires time touchy outcomes, utilize Our SEO Services at your own risk<\\/p><p><br \\/><\\/p><\\/div><h5>Payment\\/Refund Policy<\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>No refund or cash back will be made. After a deposit has been finished, it is extremely unlikely to invert it. You should utilize your equilibrium on requests our administrations, Hosting, SEO campaign. You concur that once you complete a deposit, you won\'t document a debate or a chargeback against us in any way, shape, or form.<br \\/>If you document a debate or chargeback against us after a deposit, we claim all authority to end every single future request, prohibit you from our site. False action, for example, utilizing unapproved or taken charge cards will prompt the end of your record. There are no special cases.<\\/p><p><br \\/><\\/p><\\/div><h5>Free Balance \\/ Coupon Policy<\\/h5><h4><\\/h4><div style=\\\"color:rgb(33,37,41);font-size:16px;\\\"><p>We offer numerous approaches to get FREE Balance, Coupons and Deposit offers yet we generally reserve the privilege to audit it and deduct it from your record offset with any explanation we may it is a sort of misuse. If we choose to deduct a few or all of free Balance from your record balance, and your record balance becomes negative, at that point the record will naturally be suspended. If your record is suspended because of a negative Balance you can request to make a custom payment to settle your equilibrium to actuate your record.<\\/p><\\/div>\"}', '{\"image\":\"6635d5d9618e71714804185.png\",\"description\":null,\"social_title\":null,\"social_description\":null,\"keywords\":null}', 'basic', 'terms-of-service', '2021-06-09 08:51:18', '2024-07-30 13:17:00'),
(44, 'maintenance.data', '{\"description\":\"<div class=\\\"mb-5\\\" style=\\\"font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"text-align: center; font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif;\\\"><font color=\\\"#ff0000\\\">THE SITE IS UNDER MAINTENANCE<\\/font><\\/h3><p class=\\\"font-18\\\" style=\\\"color: rgb(111, 111, 111); text-align: center; margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We\'re just tuning up a few things. We apologize for the inconvenience but Front is currently undergoing planned maintenance. Thanks for your patience.<\\/p><\\/div>\",\"image\":\"6603c203472ad1711522307.png\"}', NULL, NULL, NULL, '2020-07-04 23:42:52', '2024-07-31 00:50:42'),
(55, 'counter.content', '{\"heading\":\"Latest Newsss\",\"subheading\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus necessitatibus repudiandae porro reprehenderit, beatae perferendis repellat quo ipsa omnis, vitae!\"}', NULL, 'basic', '', '2024-04-21 01:13:50', '2024-04-21 01:13:50'),
(56, 'counter.content', '{\"heading\":\"Latest News\",\"subheading\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus necessitatibus repudiandae porro reprehenderit, beatae perferendis repellat quo ipsa omnis, vitae!\"}', NULL, 'basic', '', '2024-04-21 01:13:52', '2024-04-21 01:13:52'),
(60, 'kyc.content', '{\"required\":\"Complete KYC to unlock the full potential of our platform! KYC helps us verify your identity and keep things secure. It is quick and easy just follow the on-screen instructions. Get started with KYC verification now!\",\"pending\":\"Your KYC verification is being reviewed. We might need some additional information. You will get an email update soon. In the meantime, explore our platform with limited features.\"}', NULL, 'basic', '', '2024-04-25 06:35:35', '2024-04-25 06:35:35'),
(61, 'kyc.content', '{\"required\":\"Complete KYC to unlock the full potential of our platform! KYC helps us verify your identity and keep things secure. It is quick and easy just follow the on-screen instructions. Get started with KYC verification now!\",\"pending\":\"Your KYC verification is being reviewed. We might need some additional information. You will get an email update soon. In the meantime, explore our platform with limited features.\",\"reject\":\"We regret to inform you that the Know Your Customer (KYC) information provided has been reviewed and unfortunately, it has not met our verification standards.\"}', NULL, 'basic', '', '2024-04-25 06:40:29', '2024-04-25 06:40:29'),
(64, 'banner.content', '{\"has_image\":\"1\",\"heading\":\"Start Your Journey,\",\"subheading\":\"Ultimate Vehicle Rental Platform\",\"short_description\":\"Rent a luxury vehicle for as low as $150 daily from our extensive network of over 100 premium locations.\",\"button_name\":\"Contact Us\",\"button_link\":\"\\/contact\",\"background_image\":\"66a938198523e1722365977.png\"}', NULL, 'basic', '', '2024-05-01 00:06:45', '2024-07-30 12:59:37'),
(66, 'register_disable.content', '{\"has_image\":\"1\",\"heading\":\"Registration Currently Disabled\",\"subheading\":\"Page you are looking for doesn\'t exit or an other error occurred or temporarily unavailable.\",\"button_name\":\"Go to Home\",\"button_url\":\"#\",\"image\":\"663a0f20ecd0b1715080992.png\"}', NULL, 'basic', '', '2024-05-07 05:23:12', '2024-05-07 05:28:09'),
(67, 'about.element', '{\"icon\":\"<i class=\\\"icon-fi_3534548\\\"><\\/i>\",\"amount\":\"9\",\"title\":\"Service Point\"}', NULL, 'basic', '', '2024-07-30 12:55:43', '2024-07-30 14:45:57'),
(68, 'banned.content', '{\"has_image\":\"1\",\"heading\":\"You Are Banned\",\"image\":\"66a937e8ebcc01722365928.png\"}', NULL, 'basic', '', '2024-07-30 12:58:48', '2024-07-30 12:58:49'),
(69, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"66a9382371bbd1722365987.png\"}', NULL, 'basic', '', '2024-07-30 12:59:47', '2024-07-30 12:59:47'),
(70, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"66a93829b6b3d1722365993.png\"}', NULL, 'basic', '', '2024-07-30 12:59:53', '2024-07-30 12:59:53'),
(71, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"66a938303c2751722366000.png\"}', NULL, 'basic', '', '2024-07-30 13:00:00', '2024-07-30 13:00:00'),
(72, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"66a9383689b311722366006.png\"}', NULL, 'basic', '', '2024-07-30 13:00:06', '2024-07-30 13:00:06'),
(73, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"66a9383cc60541722366012.png\"}', NULL, 'basic', '', '2024-07-30 13:00:12', '2024-07-30 13:00:12'),
(74, 'cta.content', '{\"has_image\":\"1\",\"heading\":\"200+ sports & luxury vehicles\",\"subheading\":\"DRIVE YOUR DREAM VEHICLE TODAY\",\"short_description\":\"Rent a sports or luxury car , delivered directly to your hotel in Dubai\",\"video_link\":\"https:\\/\\/url8.viserlab.com\\/justhire\\/video.mp4\",\"button_name\":\"Book Ride\",\"button_link\":\"\\/user\\/login\",\"image\":\"66a938a2da3361722366114.png\"}', NULL, 'basic', '', '2024-07-30 13:01:54', '2024-07-30 13:01:55'),
(75, 'cta_contact.content', '{\"has_image\":\"1\",\"heading\":\"Rentaly customer care is here to help you anytime.\",\"subheading\":\"Committed to Providing Prompt and Reliable Support for a Seamless and Enjoyable Rental Experience\",\"contact_button\":\"Contact US\",\"contact_button_link\":\"\\/contact\",\"image\":\"66a938cf185361722366159.png\"}', NULL, 'basic', '', '2024-07-30 13:02:39', '2024-07-30 13:02:39'),
(76, 'cta_contact.element', '{\"title\":\"24\\/7 Roadside Assistance\"}', NULL, 'basic', '', '2024-07-30 13:02:54', '2024-07-30 13:02:54'),
(77, 'cta_contact.element', '{\"title\":\"Inquiries and Modifications\"}', NULL, 'basic', '', '2024-07-30 13:02:58', '2024-07-30 13:02:58'),
(78, 'cta_contact.element', '{\"title\":\"Vehicle Selection Guidance\"}', NULL, 'basic', '', '2024-07-30 13:03:03', '2024-07-30 13:03:03'),
(79, 'cta_contact.element', '{\"title\":\"Advice and Support\"}', NULL, 'basic', '', '2024-07-30 13:03:08', '2024-07-30 13:03:08'),
(80, 'faq.content', '{\"heading\":\"Do You Have\",\"subheading\":\"Any Questions?\"}', NULL, 'basic', '', '2024-07-30 13:03:30', '2024-07-30 13:03:30'),
(81, 'faq.element', '{\"question\":\"How can I make a reservation?\",\"answer\":\"Making a reservation is easy! Simply visit our website or download our mobile app, choose your desired vehicle, select your pickup and drop-off locations and dates, and complete the booking process.\"}', NULL, 'basic', '', '2024-07-30 13:05:20', '2024-07-30 13:05:20'),
(82, 'faq.element', '{\"question\":\"Do you offer delivery and pickup services?\",\"answer\":\"Yes, we do! We offer convenient delivery and pickup services to various locations, including airports, hotels, and more. Just let us know your preferred location, and we\'ll take care of the rest.\"}', NULL, 'basic', '', '2024-07-30 13:05:30', '2024-07-30 13:05:30'),
(83, 'faq.element', '{\"question\":\"What are your rental rates?\",\"answer\":\"Our rental rates vary depending on the vehicle type, rental duration, and other factors. You can find our competitive rates displayed on our website or by contacting our customer support team for a personalized quote.\"}', NULL, 'basic', '', '2024-07-30 13:05:40', '2024-07-30 13:05:40'),
(84, 'faq.element', '{\"question\":\"What happens if I need to cancel my reservation?\",\"answer\":\"We understand that plans can change, which is why we offer flexible cancellation policies. Depending on the timing of your cancellation, there may be applicable fees. Please refer to our terms and conditions or contact our customer support team for assistance with cancellations.\"}', NULL, 'basic', '', '2024-07-30 13:05:50', '2024-07-30 13:05:50'),
(85, 'faq.element', '{\"question\":\"Is there an age requirement for renting a vehicle?\",\"answer\":\"Yes, the minimum age requirement for renting a vehicle is usually 21 years old. However, some locations may have higher age requirements or additional restrictions for certain vehicle types.\"}', NULL, 'basic', '', '2024-07-30 13:05:59', '2024-07-30 13:05:59'),
(86, 'faq.element', '{\"question\":\"What documents do I need to rent a vehicle?\",\"answer\":\"To rent a vehicle, you\'ll typically need a valid driver\'s license, a credit card for payment and security deposit, and proof of insurance. Additional requirements may vary depending on your location and the type of vehicle you\'re renting.\"}', NULL, 'basic', '', '2024-07-30 13:06:10', '2024-07-30 13:06:10'),
(87, 'feature.element', '{\"icon\":\"<i class=\\\"icon-fi_854952\\\"><\\/i>\",\"title\":\"Any Pickup Location\",\"description\":\"Choose any location for convenient vehicle pickup, tailored to your needs and preferences\"}', NULL, 'basic', '', '2024-07-30 13:09:23', '2024-07-30 13:47:33'),
(88, 'feature.element', '{\"icon\":\"<i class=\\\"icon-fi_9156007\\\"><\\/i>\",\"title\":\"Easier & Faster Bookings\",\"description\":\"Simplify and expedite the booking process with our platform for quicker access to your desired vehicle.\"}', NULL, 'basic', '', '2024-07-30 13:09:36', '2024-07-30 13:47:50'),
(89, 'feature.element', '{\"icon\":\"<i class=\\\"icon-fi_8541356\\\"><\\/i>\",\"title\":\"Customers Satisfaction\",\"description\":\"Our priority is ensuring customer satisfaction through excellent service, reliability, and personalized attention to your needs.\"}', NULL, 'basic', '', '2024-07-30 13:09:51', '2024-07-30 13:48:03'),
(90, 'footer.content', '{\"has_image\":\"1\",\"description\":\"Explore our platform for hassle-free vehicle rentals. Book your ride easily and embark on unforgettable journeys with confidence.\",\"subscribe_title\":\"Subscribe\",\"subscribe_subtitle\":\"Subscribe to our mailing list for the latest updates!\",\"image\":\"66a93aa97c1471722366633.png\"}', NULL, 'basic', '', '2024-07-30 13:10:33', '2024-07-30 13:10:34'),
(91, 'how_to_work.content', '{\"heading\":\"How it\\u2019s Works\",\"subheading\":\"Fast and Convenient Vehicle Rental\"}', NULL, 'basic', '', '2024-07-30 13:10:48', '2024-07-30 13:10:48'),
(92, 'how_to_work.element', '{\"icon\":\"<i class=\\\"icon-fi_14183674\\\"><\\/i>\",\"title\":\"Choose a vehicle\",\"short_description\":\"Explore our diverse fleet and find the perfect vehicle to suit your needs, preferences, and budget effortlessly\"}', NULL, 'basic', '', '2024-07-30 13:11:43', '2024-07-30 13:50:04'),
(93, 'how_to_work.element', '{\"icon\":\"<i class=\\\"icon-Group-18\\\"><\\/i>\",\"title\":\"Sit back & relax\",\"short_description\":\"Once booked, sit back and relax as we prepare your chosen vehicle for a seamless and enjoyable rental experience.\"}', NULL, 'basic', '', '2024-07-30 13:11:58', '2024-07-30 13:50:37'),
(94, 'how_to_work.element', '{\"icon\":\"<i class=\\\"icon-fi_3436734\\\"><\\/i>\",\"title\":\"Make a booking\",\"short_description\":\"Easily confirm your reservation online with just a few clicks, securing your chosen vehicle for your desired dates instantly.\"}', NULL, 'basic', '', '2024-07-30 13:12:07', '2024-07-30 13:50:27'),
(95, 'how_to_work.element', '{\"icon\":\"<i class=\\\"icon-Group-17\\\"><\\/i>\",\"title\":\"Pick location & date\",\"short_description\":\"Select your preferred location and dates seamlessly to ensure a smooth and hassle-free rental experience tailored to your schedule\"}', NULL, 'basic', '', '2024-07-30 13:12:19', '2024-07-30 13:50:17'),
(96, 'login.content', '{\"has_image\":\"1\",\"heading\":\"Welcome Back\",\"subheading\":\"Login to Your Account\",\"image\":\"66a93ba2d7b881722366882.png\"}', NULL, 'basic', '', '2024-07-30 13:14:42', '2024-07-30 13:14:42'),
(97, 'partner.element', '{\"has_image\":\"1\",\"image\":\"66a93bb4bf8831722366900.png\"}', NULL, 'basic', '', '2024-07-30 13:15:00', '2024-07-30 13:15:00'),
(98, 'partner.element', '{\"has_image\":\"1\",\"image\":\"66a93bbc6c3a01722366908.png\"}', NULL, 'basic', '', '2024-07-30 13:15:08', '2024-07-30 13:15:08'),
(99, 'partner.element', '{\"has_image\":\"1\",\"image\":\"66a93bc296b871722366914.png\"}', NULL, 'basic', '', '2024-07-30 13:15:14', '2024-07-30 13:15:14'),
(100, 'partner.element', '{\"has_image\":\"1\",\"image\":\"66a93bc93fc291722366921.png\"}', NULL, 'basic', '', '2024-07-30 13:15:21', '2024-07-30 13:15:21'),
(101, 'partner.element', '{\"has_image\":\"1\",\"image\":\"66a93bd1a888f1722366929.png\"}', NULL, 'basic', '', '2024-07-30 13:15:29', '2024-07-30 13:15:29'),
(102, 'partner.element', '{\"has_image\":\"1\",\"image\":\"66a93bd9647e71722366937.png\"}', NULL, 'basic', '', '2024-07-30 13:15:37', '2024-07-30 13:15:37'),
(103, 'partner.element', '{\"has_image\":\"1\",\"image\":\"66a93be1352161722366945.png\"}', NULL, 'basic', '', '2024-07-30 13:15:45', '2024-07-30 13:15:45'),
(104, 'partner.element', '{\"has_image\":\"1\",\"image\":\"66a93be84daf61722366952.png\"}', NULL, 'basic', '', '2024-07-30 13:15:52', '2024-07-30 13:15:52'),
(105, 'policy_pages.element', '{\"title\":\"Refund Policy\",\"details\":\"<div><p>We claim all authority to dismiss, end, or handicap any help with or without cause per administrator discretion. This is a Complete independent facilitating, on the off chance that you misuse our ticket or Livechat or emotionally supportive network by submitting solicitations or protests we will impair your record. The solitary time you should reach us about the seaward facilitating is if there is an issue with the worker. We have not many substance limitations and everything is as per laws and guidelines. Try not to join on the off chance that you intend to do anything contrary to the guidelines, we do check these things and we will know, don\'t burn through our own and your time by joining on the off chance that you figure you will have the option to sneak by us and break the terms.<\\/p><\\/div><div><ul><li>Configuration requests - If you have a fully managed dedicated server with us then we offer custom PHP\\/MySQL configurations, firewalls for dedicated IPs, DNS, and httpd configurations.<\\/li><li>Software requests - Cpanel Extension Installation will be granted as long as it does not interfere with the security, stability, and performance of other users on the server.<\\/li><li>Emergency Support - We do not provide emergency support \\/ Phone Support \\/ LiveChat Support. Support may take some hours sometimes.<\\/li><li>Webmaster help - We do not offer any support for webmaster related issues and difficulty including coding, & installs, Error solving. if there is an issue where a library or configuration of the server then we can help you if it\'s possible from our end.<\\/li><li>Backups - We keep backups but we are not responsible for data loss, you are fully responsible for all backups.<\\/li><li><br \\/><\\/li><li>We Don\'t support any child porn or such material.<\\/li><li>No spam-related sites or material, such as email lists, mass mail programs, and scripts, etc.<\\/li><li>No harassing material that may cause people to retaliate against you.<\\/li><li>No phishing pages.<\\/li><li>You may not run any exploitation script from the server. reason can be terminated immediately.<\\/li><li>If Anyone attempting to hack or exploit the server by using your script or hosting, we will terminate your account to keep safe other users.<\\/li><li>Malicious Botnets are strictly forbidden.<\\/li><li>Spam, mass mailing, or email marketing in any way are strictly forbidden here.<\\/li><li>Malicious hacking materials, trojans, viruses, & malicious bots running or for download are forbidden.<\\/li><li>Resource and cronjob abuse is forbidden and will result in suspension or termination.<\\/li><li>Php\\/CGI proxies are strictly forbidden.<\\/li><li>CGI-IRC is strictly forbidden.<\\/li><li>No fake or disposal mailers, mass mailing, mail bombers, SMS bombers, etc.<\\/li><li>NO CREDIT OR REFUND will be granted for interruptions of service, due to User Agreement violations.<\\/li><li><br \\/><\\/li><\\/ul><\\/div><div><h5>Terms & Conditions for Users<\\/h5><p>Before getting to this site, you are consenting to be limited by these site Terms and Conditions of Use, every single appropriate law, and guidelines, and concur that you are answerable for consistency with any material neighborhood laws. If you disagree with any of these terms, you are restricted from utilizing or getting to this site.<\\/p><p><br \\/><\\/p><\\/div><div><h5>Support<\\/h5><p>Whenever you have downloaded our item, you may get in touch with us for help through email and we will give a valiant effort to determine your issue. We will attempt to answer using the Email for more modest bug fixes, after which we will refresh the center bundle. Content help is offered to confirmed clients by Tickets as it were. Backing demands made by email and Livechat.<\\/p><p>On the off chance that your help requires extra adjustment of the System, at that point, you have two alternatives:<\\/p><ul><li>Hang tight for additional update discharge.<\\/li><li>Or on the other hand, enlist a specialist (We offer customization for extra charges).<\\/li><li><br \\/><\\/li><\\/ul><\\/div><div><h5>Ownership<\\/h5><p>You may not guarantee scholarly or selective possession of any of our items, altered or unmodified. All items are property, we created them. Our items are given \\\"with no guarantees\\\" without guarantee of any sort, either communicated or suggested. On no occasion will our juridical individual be subject to any harms including, however not restricted to, immediate, roundabout, extraordinary, accidental, or significant harms or different misfortunes emerging out of the utilization of or powerlessness to utilize our items.<\\/p><p><br \\/><\\/p><\\/div><div><h5>Warranty<\\/h5><p>We don\'t offer any guarantee or assurance of these Services in any way. When our Services have been modified we can\'t ensure they will work with all outsider plugins, modules, or internet browsers. Program similarity ought to be tried against the show formats on the demo worker. If you don\'t mind guarantee that the programs you use will work with the component, as we can not ensure that our systems will work with all program mixes.<\\/p><p><br \\/><\\/p><\\/div><div><h5>Unauthorized\\/Illegal Usage<\\/h5><p>You may not utilize our things for any illicit or unapproved reason or may you, in the utilization of the stage, disregard any laws in your locale (counting yet not restricted to copyright laws) just as the laws of your nation and International law. Specifically, it is disallowed to utilize the things on our foundation for pages that advance: brutality, illegal intimidation, hard sexual entertainment, bigotry, obscenity content or warez programming joins.<br \\/><br \\/>You can\'t imitate, copy, duplicate, sell, exchange or adventure any of our segment, utilization of the offered on our things, or admittance to the administration without the express composed consent by us or item proprietor.<br \\/>Our Members are liable for all substance posted on the discussion and demo and movement that happens under your record.<br \\/>We hold the chance of hindering your participation account quickly if we will think about a particularly not allowed conduct.<br \\/>If you make a record on our site, you are liable for keeping up the security of your record, and you are completely answerable for all exercises that happen under the record and some other activities taken regarding the record. You should quickly inform us, of any unapproved employments of your record or some other penetrates of security.<\\/p><p><br \\/><\\/p><\\/div><div><h5>Fiverr, Seoclerks Sellers Or Affiliates<\\/h5><p>We do NOT ensure full SEO campaign conveyance within 24 hours. We make no assurance for conveyance time by any means. We give our best assessment to orders during the putting in of requests, anyway, these are gauges. We won\'t be considered liable for loss of assets, negative surveys or you being prohibited for late conveyance. If you are selling on a site that requires time touchy outcomes, utilize Our SEO Services at your own risk<\\/p><p><br \\/><\\/p><\\/div><div><h5>Payment\\/Refund Policy<\\/h5><p>No refund or cash back will be made. After a deposit has been finished, it is extremely unlikely to invert it. You should utilize your equilibrium on requests our administrations, Hosting, SEO campaign. You concur that once you complete a deposit, you won\'t document a debate or a chargeback against us in any way, shape, or form.<br \\/>If you document a debate or chargeback against us after a deposit, we claim all authority to end every single future request, prohibit you from our site. False action, for example, utilizing unapproved or taken charge cards will prompt the end of your record. There are no special cases.<\\/p><p><br \\/><\\/p><\\/div><div><h5>Free Balance \\/ Coupon Policy<\\/h5><p>We offer numerous approaches to get FREE Balance, Coupons and Deposit offers yet we generally reserve the privilege to audit it and deduct it from your record offset with any explanation we may it is a sort of misuse. If we choose to deduct a few or all of free Balance from your record balance, and your record balance becomes negative, at that point the record will naturally be suspended. If your record is suspended because of a negative Balance you can request to make a custom payment to settle your equilibrium to actuate your record.<\\/p><\\/div>\"}', '{\"image\":null,\"description\":null,\"social_title\":null,\"social_description\":null,\"keywords\":[\"viserlab\"]}', 'basic', 'refund-policy', '2024-07-30 13:17:17', '2024-07-30 13:17:25'),
(106, 'register.content', '{\"has_image\":\"1\",\"heading\":\"Create Your Account\",\"subheading\":\"Join Us Today for Exclusive Benefits\",\"image\":\"66a93c6270ac31722367074.png\"}', NULL, 'basic', '', '2024-07-30 13:17:54', '2024-07-30 13:17:54'),
(107, 'service.element', '{\"has_image\":[\"1\"],\"icon\":\"<i class=\\\"icon-Clip-path-group\\\"><\\/i>\",\"title\":\"Pick up and Drop\",\"description\":\"<div><font color=\\\"#ffffff\\\">Our pick-up and drop service ensures your rental experience is seamless. Select your preferred location for vehicle collection, whether it\'s at the airport, hotel, or any other convenient spot.\\u00a0<\\/font><\\/div><div><font color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font color=\\\"#ffffff\\\">Our team will coordinate the pick-up time to align with your schedule. Similarly, when your rental period ends, we offer hassle-free drop-off options.\\u00a0<\\/font><\\/div><div><font color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font color=\\\"#ffffff\\\">Simply choose a location that suits you best, and our staff will be there to receive the vehicle. With this service, you can enjoy the freedom of exploring without worrying about logistical hassles, making your journey more convenient and enjoyable<\\/font><\\/div>\",\"image\":\"66a93ddad7ea71722367450.png\"}', NULL, 'basic', '', '2024-07-30 13:24:10', '2024-07-30 14:19:18'),
(108, 'service.element', '{\"has_image\":[\"1\"],\"icon\":\"<i class=\\\"icon-Clip-path-group-1\\\"><\\/i>\",\"title\":\"Maintained Cars\",\"description\":\"<div><font color=\\\"#ffffff\\\">Maintaining your car is essential for its longevity and performance. Regular upkeep includes oil changes, tire rotations, brake inspections, and fluid checks.\\u00a0<\\/font><\\/div><div><font color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font color=\\\"#ffffff\\\">Following the manufacturer\'s recommended maintenance schedule ensures optimal functioning and prevents costly repairs. Addressing minor issues promptly can prevent them from escalating into major problems.<\\/font><\\/div><div><font color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font color=\\\"#ffffff\\\">Additionally, keeping your car clean and organized enhances comfort and resale value. Regularly check your car\'s exterior and interior for signs of wear and tear. Proper maintenance not only extends your car\'s lifespan but also ensures your safety and the safety of others on the road.<\\/font><\\/div>\",\"image\":\"66a93e0087b261722367488.png\"}', NULL, 'basic', '', '2024-07-30 13:24:48', '2024-07-30 14:19:07'),
(109, 'service.element', '{\"has_image\":[\"1\"],\"icon\":\"<i class=\\\"icon-Clip-path-group-2\\\"><\\/i>\",\"title\":\"Professional Staff\",\"description\":\"<div><font color=\\\"#ffffff\\\">Our professional staff is dedicated to providing top-notch service, whether you\'re renting a vehicle or seeking assistance.\\u00a0<\\/font><\\/div><div><font color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font color=\\\"#ffffff\\\">With extensive training and expertise, they\'re equipped to answer your questions, offer recommendations, and ensure your needs are met with efficiency and courtesy.\\u00a0<\\/font><\\/div><div><font color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font color=\\\"#ffffff\\\">Their attention to detail and commitment to customer satisfaction set us apart, guaranteeing a positive experience every time. From helping you choose the perfect vehicle to providing support throughout your rental period, our team is here to make your journey smooth and enjoyable.\\u00a0<\\/font><\\/div><div><font color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font color=\\\"#ffffff\\\">Trust our professional staff to exceed your expectations and deliver exceptional service at every interaction.<\\/font><\\/div>\",\"image\":\"66a93ea3f2e721722367651.png\"}', NULL, 'basic', '', '2024-07-30 13:27:31', '2024-07-30 14:18:57'),
(110, 'service.element', '{\"has_image\":[\"1\"],\"icon\":\"<i class=\\\"icon-Clip-path-group-4\\\"><\\/i>\",\"title\":\"Excellent Prices\",\"description\":\"<div><font color=\\\"#ffffff\\\">At our company, we prioritize offering excellent prices without compromising on quality or service. We understand the importance of value for money, which is why we strive to provide competitive rates for all our products and services.\\u00a0<\\/font><\\/div><div><font color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font color=\\\"#ffffff\\\">Through strategic partnerships and efficient operations, we\'re able to keep our prices affordable without sacrificing the standards our customers deserve.\\u00a0<\\/font><\\/div><div><font color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font color=\\\"#ffffff\\\">Whether you\'re renting a vehicle, purchasing a product, or utilizing our services, you can trust that you\'re getting exceptional value for your money. Experience the satisfaction of receiving high-quality offerings at unbeatable prices when you choose us as your preferred provider.\\u00a0<\\/font><\\/div>\",\"image\":\"66a93ee2b7a9c1722367714.png\"}', NULL, 'basic', '', '2024-07-30 13:28:34', '2024-07-30 14:18:45'),
(111, 'service.element', '{\"has_image\":[\"1\"],\"icon\":\"<i class=\\\"icon-Layer_1\\\"><\\/i>\",\"title\":\"Easy Booking\",\"description\":\"<div><font color=\\\"#ffffff\\\">With our easy booking process, renting a vehicle has never been simpler.\\u00a0<\\/font><\\/div><div><font color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font color=\\\"#ffffff\\\">Our user-friendly platform allows you to browse through a wide selection of vehicles, select your desired options, and make a reservation in just a few clicks.\\u00a0<\\/font><\\/div><div><font color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font color=\\\"#ffffff\\\">Whether you prefer to book online or through our mobile app, you\'ll find the process intuitive and straightforward. We prioritize convenience and efficiency, so you can quickly finalize your booking and get on the road without any hassle.\\u00a0<\\/font><\\/div><div><font color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font color=\\\"#ffffff\\\">Plus, our customer support team is always available to assist you along the way, ensuring a smooth and stress-free experience from start to finish.\\u00a0<\\/font><\\/div>\",\"image\":\"66a93f04a3dd21722367748.png\"}', NULL, 'basic', '', '2024-07-30 13:29:08', '2024-07-30 14:18:27'),
(112, 'social_icon.element', '{\"title\":\"Twitter\",\"social_icon\":\"<i class=\\\"fab fa-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/www.twitter.com\\/\"}', NULL, 'basic', '', '2024-07-30 13:30:19', '2024-07-30 14:23:40'),
(113, 'social_icon.element', '{\"title\":\"Linkedin\",\"social_icon\":\"<i class=\\\"fab fa-linkedin-in\\\"><\\/i>\",\"url\":\"https:\\/\\/www.linkedin.com\\/\"}', NULL, 'basic', '', '2024-07-30 13:30:40', '2024-07-30 13:30:40'),
(114, 'social_icon.element', '{\"title\":\"Instagram\",\"social_icon\":\"<i class=\\\"fab fa-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/www.instagram.com\\/\"}', NULL, 'basic', '', '2024-07-30 13:30:59', '2024-07-30 13:30:59'),
(115, 'support.content', '{\"has_image\":\"1\",\"heading\":\"Save big with our cheap car rental!\",\"subheading\":\"Top outlet. Local Suppliers. 24\\/7 Support.\",\"button_one_name\":\"Book Ride\",\"button_one_link\":\"\\/user\\/register\",\"button_two_name\":\"Contact Us\",\"button_two_link\":\"\\/contact\",\"image\":\"66a93f9686c711722367894.jpg\"}', NULL, 'basic', '', '2024-07-30 13:31:34', '2024-07-30 13:31:34'),
(116, 'testimonial.content', '{\"heading\":\"Feedback\",\"subheading\":\"Our Customer Reviews\"}', NULL, 'basic', '', '2024-07-30 13:31:56', '2024-07-30 13:31:56'),
(117, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Emily Johnson\",\"designation\":\"Marketing Manager\",\"company_name\":\"Bright Ideas Inc.\",\"quotes\":\"Renting a vehicle from  Bright Ideas Inc was a breeze! Their easy booking process and excellent prices made my trip stress-free.\",\"image\":\"66a93fc98e6a91722367945.png\"}', NULL, 'basic', '', '2024-07-30 13:32:25', '2024-07-30 13:32:25');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `seo_content`, `tempname`, `slug`, `created_at`, `updated_at`) VALUES
(118, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"David Smith\",\"designation\":\"CEO\",\"company_name\":\"Summit Solutions\",\"quotes\":\"The professionalism of the Summit Solutions staff stood out to me. They helped me find the perfect vehicle for my needs at an unbeatable price.\",\"image\":\"66a93fe88c4fe1722367976.png\"}', NULL, 'basic', '', '2024-07-30 13:32:56', '2024-07-30 13:32:56'),
(119, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Sophia Lee\",\"designation\":\"Freelance\",\"company_name\":\"Photography LLC\",\"quotes\":\"I rely on Photography LLC for all my travel needs. Their convenient pick-up and drop-off services make my photography assignments a breeze\",\"image\":\"66a94000738411722368000.png\"}', NULL, 'basic', '', '2024-07-30 13:33:20', '2024-07-30 13:33:20'),
(120, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Michael Anderson\",\"designation\":\"Traveller\",\"company_name\":\"Travel Enthusiast\",\"quotes\":\"I\'ve tried many rental services, but none compare to Travel Enthusiast. Their excellent prices and easy booking process keep me coming back every time!\",\"image\":\"66a940196b1121722368025.png\"}', NULL, 'basic', '', '2024-07-30 13:33:45', '2024-07-30 13:33:45'),
(121, 'vehicle.content', '{\"has_image\":\"1\",\"heading\":\"Enjoy Your Ride\",\"subheading\":\"Our Fleet of Vehicles\",\"background_image\":\"66a9403c73b541722368060.png\"}', NULL, 'basic', '', '2024-07-30 13:34:20', '2024-07-30 13:34:21'),
(122, 'vehicle_store.content', '{\"store_required_content\":\"Your vehicle store registration is incomplete. Please provide necessary details for approval.\",\"store_pending_content\":\"Your vehicle store registration is pending. All listings are disabled until approval.\",\"store_approved_content\":\"If you wish to update your vehicle store, please contact the admin via support ticket for assistance.\"}', NULL, 'basic', '', '2024-07-30 13:34:44', '2024-07-30 13:34:44'),
(123, 'why_choose_us.content', '{\"has_image\":\"1\",\"heading\":\"Why Choose Us\",\"subheading\":\"Experience Excellence in Every Mile\",\"short_description\":\"Discover unparalleled convenience, reliability, and value with our exceptional service. From hassle-free bookings to top-notch vehicles, we\'re your ultimate travel partner.\",\"button_name\":\"Find Deal\",\"button_link\":\"\\/\",\"image\":\"66a94078d14761722368120.png\"}', NULL, 'basic', '', '2024-07-30 13:35:20', '2024-07-30 13:35:20'),
(124, 'why_choose_us.element', '{\"title\":\"Expert Staff\",\"icon\":\"<i class=\\\"icon-Group-20\\\"><\\/i>\"}', NULL, 'basic', '', '2024-07-30 13:35:43', '2024-07-30 13:35:43'),
(125, 'why_choose_us.element', '{\"title\":\"Easy Process\",\"icon\":\"<i class=\\\"icon-Group-20\\\"><\\/i>\"}', NULL, 'basic', '', '2024-07-30 13:35:59', '2024-07-30 13:35:59'),
(126, 'why_choose_us.element', '{\"title\":\"Exceptional Service\",\"icon\":\"<i class=\\\"icon-Group-20\\\"><\\/i>\"}', NULL, 'basic', '', '2024-07-30 13:36:12', '2024-07-30 13:36:12'),
(127, 'why_choose_us.element', '{\"title\":\"Affordable Rates\",\"icon\":\"<i class=\\\"icon-Group-20\\\"><\\/i>\"}', NULL, 'basic', '', '2024-07-30 13:36:24', '2024-07-30 13:36:24'),
(128, 'why_choose_us.element', '{\"title\":\"Reliable Vehicles\",\"icon\":\"<i class=\\\"icon-Group-20\\\"><\\/i>\"}', NULL, 'basic', '', '2024-07-30 13:36:39', '2024-07-30 13:36:39'),
(129, 'why_choose_us.element', '{\"title\":\"Convenient Booking\",\"icon\":\"<i class=\\\"icon-Group-20\\\"><\\/i>\"}', NULL, 'basic', '', '2024-07-30 13:36:55', '2024-07-30 13:36:55'),
(133, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Discovering the World One Journey at a Time\",\"description\":\"<p class=\\\"blog-details__desc\\\" style=\\\"margin-right:0px;margin-bottom:15px;margin-left:0px;padding:0px;\\\">Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<br style=\\\"margin:0px;padding:0px;\\\" \\/><br style=\\\"margin:0px;padding:0px;\\\" \\/><\\/p><h5 style=\\\"margin-bottom:20px;padding:0px;font-weight:700;line-height:1.2;font-size:1.5rem;\\\">From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div style=\\\"margin:0px;padding:0px;\\\">we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br style=\\\"margin:0px;padding:0px;\\\" \\/><\\/div><div style=\\\"margin:0px;padding:0px;\\\"><br \\/><\\/div><div style=\\\"margin:0px;padding:0px;\\\"><blockquote style=\\\"padding:20px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;font-style:italic;text-align:center;background:rgb(255,222,196);font-size:18px;border-left:4px solid rgb(254,134,40);\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote><div><h5 style=\\\"margin-bottom:20px;padding:0px;font-weight:700;line-height:1.2;font-size:1.5rem;background-color:rgb(255,252,250);\\\">Planning for retirement doesn\'t end with accumulating savings<\\/h5><div style=\\\"margin:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;background-color:rgb(255,252,250);\\\">It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br style=\\\"margin:0px;padding:0px;\\\" \\/><\\/div><div style=\\\"margin:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;background-color:rgb(255,252,250);\\\"><br style=\\\"margin:0px;padding:0px;\\\" \\/><\\/div><h5 style=\\\"margin-bottom:20px;padding:0px;font-weight:700;line-height:1.2;font-size:1.5rem;background-color:rgb(255,252,250);\\\">Planning before starting<\\/h5><div style=\\\"margin:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;background-color:rgb(255,252,250);\\\">Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<\\/div><\\/div><\\/div>\",\"image\":\"66a94d994de891722371481.png\"}', '{\"image\":null,\"description\":null,\"social_title\":null,\"social_description\":null,\"keywords\":null}', 'basic', 'discovering-the-world-one-journey-at-a-time', '2024-07-30 14:31:21', '2024-07-30 14:31:29'),
(134, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Curabitur at lacus ac velit ornare lobortis. Suspendisse feugiat.\",\"description\":\"<p class=\\\"blog-details__desc\\\" style=\\\"margin-right:0px;margin-bottom:15px;margin-left:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;font-size:16px;background-color:rgb(255,252,250);\\\">Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<br style=\\\"margin:0px;padding:0px;\\\" \\/><br style=\\\"margin:0px;padding:0px;\\\" \\/><\\/p><h5 style=\\\"margin-bottom:20px;padding:0px;font-weight:700;line-height:1.2;font-size:1.5rem;background-color:rgb(255,252,250);\\\">From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div style=\\\"margin:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;background-color:rgb(255,252,250);\\\">we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<\\/div><div style=\\\"margin:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;background-color:rgb(255,252,250);\\\"><br \\/><\\/div><div style=\\\"margin:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;background-color:rgb(255,252,250);\\\"><blockquote style=\\\"padding:20px;font-style:italic;text-align:center;background:rgb(255,222,196);font-size:18px;border-left:4px solid rgb(254,134,40);\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote><div><h5 style=\\\"margin-bottom:20px;padding:0px;font-weight:700;line-height:1.2;font-size:1.5rem;\\\">Planning for retirement doesn\'t end with accumulating savings<\\/h5><div style=\\\"margin:0px;padding:0px;\\\">It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br style=\\\"margin:0px;padding:0px;\\\" \\/><\\/div><div style=\\\"margin:0px;padding:0px;\\\"><br style=\\\"margin:0px;padding:0px;\\\" \\/><\\/div><h5 style=\\\"margin-bottom:20px;padding:0px;font-weight:700;line-height:1.2;font-size:1.5rem;\\\">Planning before starting<\\/h5><div style=\\\"margin:0px;padding:0px;\\\">Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<\\/div><\\/div><\\/div>\",\"image\":\"66a94dc4e77a11722371524.png\"}', '{\"image\":null,\"description\":null,\"social_title\":null,\"social_description\":null,\"keywords\":null}', 'basic', 'curabitur-at-lacus-ac-velit-ornare-lobortis-suspendisse-feugiat', '2024-07-30 14:32:04', '2024-07-30 14:32:10'),
(135, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Praesent adipiscing Cras dapibus Salsabel car House\",\"description\":\"<p class=\\\"blog-details__desc\\\" style=\\\"margin-right:0px;margin-bottom:15px;margin-left:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;font-size:16px;background-color:rgb(255,252,250);\\\">Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<br style=\\\"margin:0px;padding:0px;\\\" \\/><br style=\\\"margin:0px;padding:0px;\\\" \\/><\\/p><h5 style=\\\"margin-bottom:20px;padding:0px;font-weight:700;line-height:1.2;font-size:1.5rem;background-color:rgb(255,252,250);\\\">From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div style=\\\"margin:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;background-color:rgb(255,252,250);\\\">we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<\\/div><div style=\\\"margin:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;background-color:rgb(255,252,250);\\\"><br \\/><\\/div><div style=\\\"margin:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;background-color:rgb(255,252,250);\\\"><blockquote style=\\\"padding:20px;font-style:italic;text-align:center;background:rgb(255,222,196);font-size:18px;border-left:4px solid rgb(254,134,40);\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote><div><br \\/><\\/div><\\/div><div style=\\\"margin:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;background-color:rgb(255,252,250);\\\"><h5 style=\\\"margin-bottom:20px;padding:0px;font-weight:700;line-height:1.2;font-size:1.5rem;\\\">Planning for retirement doesn\'t end with accumulating savings<\\/h5><div style=\\\"margin:0px;padding:0px;\\\">It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br style=\\\"margin:0px;padding:0px;\\\" \\/><\\/div><div style=\\\"margin:0px;padding:0px;\\\"><br style=\\\"margin:0px;padding:0px;\\\" \\/><\\/div><h5 style=\\\"margin-bottom:20px;padding:0px;font-weight:700;line-height:1.2;font-size:1.5rem;\\\">Planning before starting<\\/h5><div style=\\\"margin:0px;padding:0px;\\\">Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<\\/div><\\/div>\",\"image\":\"66a94dffe273f1722371583.png\"}', '{\"image\":null,\"description\":null,\"social_title\":null,\"social_description\":null,\"keywords\":null}', 'basic', 'praesent-adipiscing-cras-dapibus-salsabel-car-house', '2024-07-30 14:33:03', '2024-07-30 14:33:06'),
(136, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Embracing the Journey: Finding Serenity on the Open Road\",\"description\":\"<p class=\\\"blog-details__desc\\\" style=\\\"margin-right:0px;margin-bottom:15px;margin-left:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;font-size:16px;background-color:rgb(255,252,250);\\\">Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<br style=\\\"margin:0px;padding:0px;\\\" \\/><br style=\\\"margin:0px;padding:0px;\\\" \\/><\\/p><h5 style=\\\"margin-bottom:20px;padding:0px;font-weight:700;line-height:1.2;font-size:1.5rem;background-color:rgb(255,252,250);\\\">From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div style=\\\"margin:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;background-color:rgb(255,252,250);\\\">we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<\\/div><div style=\\\"margin:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;background-color:rgb(255,252,250);\\\"><br \\/><\\/div><div style=\\\"margin:0px;padding:0px;color:rgba(49,24,7,0.7);font-family:Inter, sans-serif;background-color:rgb(255,252,250);\\\"><blockquote style=\\\"padding:20px;font-style:italic;text-align:center;background:rgb(255,222,196);font-size:18px;border-left:4px solid rgb(254,134,40);\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote><div><h5 style=\\\"margin-bottom:20px;padding:0px;font-weight:700;line-height:1.2;font-size:1.5rem;\\\">Planning for retirement doesn\'t end with accumulating savings<\\/h5><div style=\\\"margin:0px;padding:0px;\\\">It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br style=\\\"margin:0px;padding:0px;\\\" \\/><\\/div><div style=\\\"margin:0px;padding:0px;\\\"><br style=\\\"margin:0px;padding:0px;\\\" \\/><\\/div><h5 style=\\\"margin-bottom:20px;padding:0px;font-weight:700;line-height:1.2;font-size:1.5rem;\\\">Planning before starting<\\/h5><div style=\\\"margin:0px;padding:0px;\\\">Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<\\/div><\\/div><\\/div>\",\"image\":\"66a95097913311722372247.png\"}', '{\"image\":null,\"description\":null,\"social_title\":null,\"social_description\":null,\"keywords\":null}', 'basic', 'embracing-the-journey-finding-serenity-on-the-open-road', '2024-07-30 14:44:07', '2024-07-30 14:44:10'),
(137, 'about.element', '{\"icon\":\"<i class=\\\"icon-fi_6686695\\\"><\\/i>\",\"amount\":\"8\",\"title\":\"Rental Outlet\"}', NULL, 'basic', '', '2024-07-30 14:46:12', '2024-07-30 14:46:12'),
(138, 'about.element', '{\"icon\":\"<i class=\\\"icon-fi_9851490\\\"><\\/i>\",\"amount\":\"6\",\"title\":\"Car Types\"}', NULL, 'basic', '', '2024-07-30 14:46:28', '2024-07-30 14:46:28');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint UNSIGNED NOT NULL,
  `form_id` int UNSIGNED NOT NULL DEFAULT '0',
  `code` int DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `gateway_parameters` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `supported_currencies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `crypto` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `form_id`, `code`, `name`, `alias`, `image`, `status`, `gateway_parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 101, 'Paypal', 'Paypal', '663a38d7b455d1715091671.png', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"sb-owud61543012@business.example.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:21:11'),
(2, 0, 102, 'Perfect Money', 'PerfectMoney', '663a3920e30a31715091744.png', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"hR26aw02Q1eEeUPSIfuwNypXX\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:22:24'),
(3, 0, 103, 'Stripe Hosted', 'Stripe', '663a39861cb9d1715091846.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:24:06'),
(4, 0, 104, 'Skrill', 'Skrill', '663a39494c4a91715091785.png', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"merchant@skrill.com\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"---\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:23:05'),
(5, 0, 105, 'PayTM', 'Paytm', '663a390f601191715091727.png', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"DIY12386817555501617\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"bKMfNxPPf_QdZppa\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"DIYtestingweb\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:22:07'),
(6, 0, 106, 'Payeer', 'Payeer', '663a38c9e2e931715091657.png', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"866989763\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"7575\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.Payeer\"}}', NULL, '2019-09-14 13:14:22', '2024-05-07 08:20:57'),
(7, 0, 107, 'PayStack', 'Paystack', '663a38fc814e91715091708.png', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_cd330608eb47970889bca397ced55c1dd5ad3783\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_8a0b1f199362d7acc9c390bff72c4e81f74e2ac3\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.Paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.Paystack\"}}\r\n', NULL, '2019-09-14 13:14:22', '2024-05-07 08:21:48'),
(9, 0, 109, 'Flutterwave', 'Flutterwave', '663a36c2c34d61715091138.png', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------------------\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"------------------\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:12:18'),
(10, 0, 110, 'RazorPay', 'Razorpay', '663a393a527831715091770.png', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"rzp_test_kiOtejPbRZU90E\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"osRDebzEqbsE1kbyQJ4y0re7\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:22:50'),
(11, 0, 111, 'Stripe Storefront', 'StripeJs', '663a3995417171715091861.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:24:21'),
(12, 0, 112, 'Instamojo', 'Instamojo', '663a384d54a111715091533.png', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_2241633c3bc44a3de84a3b33969\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"test_279f083f7bebefd35217feef22d\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:18:53'),
(13, 0, 501, 'Blockchain', 'Blockchain', '663a35efd0c311715090927.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"55529946-05ca-48ff-8710-f279d86b1cc5\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:08:47'),
(15, 0, 503, 'CoinPayments', 'Coinpayments', '663a36a8d8e1d1715091112.png', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"---------------------\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"---------------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"---------------------\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"USDT.BEP20\":\"Tether USD (BSC Chain)\",\"USDT.ERC20\":\"Tether USD (ERC20)\",\"USDT.TRC20\":\"Tether USD (Tron/TRC20)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:11:52'),
(16, 0, 504, 'CoinPayments Fiat', 'CoinpaymentsFiat', '663a36b7b841a1715091127.png', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"6515561\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:12:07'),
(17, 0, 505, 'Coingate', 'Coingate', '663a368e753381715091086.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"6354mwVCEw5kHzRJ6thbGo-N\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:11:26'),
(18, 0, 506, 'Coinbase Commerce', 'CoinbaseCommerce', '663a367e46ae51715091070.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"c47cd7df-d8e8-424b-a20a\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"55871878-2c32-4f64-ab66\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.CoinbaseCommerce\"}}', NULL, '2019-09-14 13:14:22', '2024-05-07 08:11:10'),
(24, 0, 113, 'Paypal Express', 'PaypalSdk', '663a38ed101a61715091693.png', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"Ae0-tixtSV7DvLwIh3Bmu7JvHrjh5EfGdXr_cEklKAVjjezRZ747BxKILiBdzlKKyp-W8W_T7CKH1Ken\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"EOhbvHZgFNO21soQJT1L9Q00M3rK6PIEsdiTgXRBt2gtGtxwRer5JvKnVUGNU5oE63fFnjnYY7hq3HBA\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:21:33'),
(25, 0, 114, 'Stripe Checkout', 'StripeV3', '663a39afb519f1715091887.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"whsec_lUmit1gtxwKTveLnSe88xCSDdnPOt8g5\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.StripeV3\"}}', NULL, '2019-09-14 13:14:22', '2024-05-07 08:24:47'),
(27, 0, 115, 'Mollie', 'Mollie', '663a387ec69371715091582.png', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"vi@gmail.com\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:19:42'),
(30, 0, 116, 'Cashmaal', 'Cashmaal', '663a361b16bd11715090971.png', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"3748\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"546254628759524554647987\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.Cashmaal\"}}', NULL, NULL, '2024-05-07 08:09:31'),
(36, 0, 119, 'Mercado Pago', 'MercadoPago', '663a386c714a91715091564.png', 1, '{\"access_token\":{\"title\":\"Access Token\",\"global\":true,\"value\":\"APP_USR-7924565816849832-082312-21941521997fab717db925cf1ea2c190-1071840315\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2024-05-07 08:19:24'),
(37, 0, 120, 'Authorize.net', 'Authorize', '663a35b9ca5991715090873.png', 1, '{\"login_id\":{\"title\":\"Login ID\",\"global\":true,\"value\":\"59e4P9DBcZv\"},\"transaction_key\":{\"title\":\"Transaction Key\",\"global\":true,\"value\":\"47x47TJyLw2E7DbR\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2024-05-07 08:07:53'),
(46, 0, 121, 'NMI', 'NMI', '663a3897754cf1715091607.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"2F822Rw39fx762MaV7Yy86jXGTC7sCDy\"}}', '{\"AED\":\"AED\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"RUB\":\"RUB\",\"SEC\":\"SEC\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2024-05-07 08:20:07'),
(50, 0, 507, 'BTCPay', 'BTCPay', '663a35cd25a8d1715090893.png', 1, '{\"store_id\":{\"title\":\"Store Id\",\"global\":true,\"value\":\"HsqFVTXSeUFJu7caoYZc3CTnP8g5LErVdHhEXPVTheHf\"},\"api_key\":{\"title\":\"Api Key\",\"global\":true,\"value\":\"4436bd706f99efae69305e7c4eff4780de1335ce\"},\"server_name\":{\"title\":\"Server Name\",\"global\":true,\"value\":\"https:\\/\\/testnet.demo.btcpayserver.org\"},\"secret_code\":{\"title\":\"Secret Code\",\"global\":true,\"value\":\"SUCdqPn9CDkY7RmJHfpQVHP2Lf2\"}}', '{\"BTC\":\"Bitcoin\",\"LTC\":\"Litecoin\"}', 1, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.BTCPay\"}}', NULL, NULL, '2024-05-07 08:08:13'),
(51, 0, 508, 'Now payments hosted', 'NowPaymentsHosted', '663a38b8d57a81715091640.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"--------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------------\"}}', '{\"BTG\":\"BTG\",\"ETH\":\"ETH\",\"XMR\":\"XMR\",\"ZEC\":\"ZEC\",\"XVG\":\"XVG\",\"ADA\":\"ADA\",\"LTC\":\"LTC\",\"BCH\":\"BCH\",\"QTUM\":\"QTUM\",\"DASH\":\"DASH\",\"XLM\":\"XLM\",\"XRP\":\"XRP\",\"XEM\":\"XEM\",\"DGB\":\"DGB\",\"LSK\":\"LSK\",\"DOGE\":\"DOGE\",\"TRX\":\"TRX\",\"KMD\":\"KMD\",\"REP\":\"REP\",\"BAT\":\"BAT\",\"ARK\":\"ARK\",\"WAVES\":\"WAVES\",\"BNB\":\"BNB\",\"XZC\":\"XZC\",\"NANO\":\"NANO\",\"TUSD\":\"TUSD\",\"VET\":\"VET\",\"ZEN\":\"ZEN\",\"GRS\":\"GRS\",\"FUN\":\"FUN\",\"NEO\":\"NEO\",\"GAS\":\"GAS\",\"PAX\":\"PAX\",\"USDC\":\"USDC\",\"ONT\":\"ONT\",\"XTZ\":\"XTZ\",\"LINK\":\"LINK\",\"RVN\":\"RVN\",\"BNBMAINNET\":\"BNBMAINNET\",\"ZIL\":\"ZIL\",\"BCD\":\"BCD\",\"USDT\":\"USDT\",\"USDTERC20\":\"USDTERC20\",\"CRO\":\"CRO\",\"DAI\":\"DAI\",\"HT\":\"HT\",\"WABI\":\"WABI\",\"BUSD\":\"BUSD\",\"ALGO\":\"ALGO\",\"USDTTRC20\":\"USDTTRC20\",\"GT\":\"GT\",\"STPT\":\"STPT\",\"AVA\":\"AVA\",\"SXP\":\"SXP\",\"UNI\":\"UNI\",\"OKB\":\"OKB\",\"BTC\":\"BTC\"}', 1, '', NULL, NULL, '2024-05-07 08:20:40'),
(52, 0, 509, 'Now payments checkout', 'NowPaymentsCheckout', '663a38a59d2541715091621.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"---------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 1, '', NULL, NULL, '2024-05-07 08:20:21'),
(53, 0, 122, '2Checkout', 'TwoCheckout', '663a39b8e64b91715091896.png', 1, '{\"merchant_code\":{\"title\":\"Merchant Code\",\"global\":true,\"value\":\"253248016872\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"eQM)ID@&vG84u!O*g[p+\"}}', '{\"AFN\": \"AFN\",\"ALL\": \"ALL\",\"DZD\": \"DZD\",\"ARS\": \"ARS\",\"AUD\": \"AUD\",\"AZN\": \"AZN\",\"BSD\": \"BSD\",\"BDT\": \"BDT\",\"BBD\": \"BBD\",\"BZD\": \"BZD\",\"BMD\": \"BMD\",\"BOB\": \"BOB\",\"BWP\": \"BWP\",\"BRL\": \"BRL\",\"GBP\": \"GBP\",\"BND\": \"BND\",\"BGN\": \"BGN\",\"CAD\": \"CAD\",\"CLP\": \"CLP\",\"CNY\": \"CNY\",\"COP\": \"COP\",\"CRC\": \"CRC\",\"HRK\": \"HRK\",\"CZK\": \"CZK\",\"DKK\": \"DKK\",\"DOP\": \"DOP\",\"XCD\": \"XCD\",\"EGP\": \"EGP\",\"EUR\": \"EUR\",\"FJD\": \"FJD\",\"GTQ\": \"GTQ\",\"HKD\": \"HKD\",\"HNL\": \"HNL\",\"HUF\": \"HUF\",\"INR\": \"INR\",\"IDR\": \"IDR\",\"ILS\": \"ILS\",\"JMD\": \"JMD\",\"JPY\": \"JPY\",\"KZT\": \"KZT\",\"KES\": \"KES\",\"LAK\": \"LAK\",\"MMK\": \"MMK\",\"LBP\": \"LBP\",\"LRD\": \"LRD\",\"MOP\": \"MOP\",\"MYR\": \"MYR\",\"MVR\": \"MVR\",\"MRO\": \"MRO\",\"MUR\": \"MUR\",\"MXN\": \"MXN\",\"MAD\": \"MAD\",\"NPR\": \"NPR\",\"TWD\": \"TWD\",\"NZD\": \"NZD\",\"NIO\": \"NIO\",\"NOK\": \"NOK\",\"PKR\": \"PKR\",\"PGK\": \"PGK\",\"PEN\": \"PEN\",\"PHP\": \"PHP\",\"PLN\": \"PLN\",\"QAR\": \"QAR\",\"RON\": \"RON\",\"RUB\": \"RUB\",\"WST\": \"WST\",\"SAR\": \"SAR\",\"SCR\": \"SCR\",\"SGD\": \"SGD\",\"SBD\": \"SBD\",\"ZAR\": \"ZAR\",\"KRW\": \"KRW\",\"LKR\": \"LKR\",\"SEK\": \"SEK\",\"CHF\": \"CHF\",\"SYP\": \"SYP\",\"THB\": \"THB\",\"TOP\": \"TOP\",\"TTD\": \"TTD\",\"TRY\": \"TRY\",\"UAH\": \"UAH\",\"AED\": \"AED\",\"USD\": \"USD\",\"VUV\": \"VUV\",\"VND\": \"VND\",\"XOF\": \"XOF\",\"YER\": \"YER\"}', 0, '{\"approved_url\":{\"title\": \"Approved URL\",\"value\":\"ipn.TwoCheckout\"}}', NULL, NULL, '2024-05-07 08:24:56'),
(54, 0, 123, 'Checkout', 'Checkout', '663a3628733351715090984.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------\"},\"public_key\":{\"title\":\"PUBLIC KEY\",\"global\":true,\"value\":\"------\"},\"processing_channel_id\":{\"title\":\"PROCESSING CHANNEL\",\"global\":true,\"value\":\"------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"AUD\":\"AUD\",\"CAN\":\"CAN\",\"CHF\":\"CHF\",\"SGD\":\"SGD\",\"JPY\":\"JPY\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2024-05-07 08:09:44'),
(56, 0, 510, 'Binance', 'Binance', '663a35db4fd621715090907.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"tsu3tjiq0oqfbtmlbevoeraxhfbp3brejnm9txhjxcp4to29ujvakvfl1ibsn3ja\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"jzngq4t04ltw8d4iqpi7admfl8tvnpehxnmi34id1zvfaenbwwvsvw7llw3zdko8\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"231129033\"}}', '{\"BTC\":\"Bitcoin\",\"USD\":\"USD\",\"BNB\":\"BNB\"}', 1, '{\"cron\":{\"title\": \"Cron Job URL\",\"value\":\"ipn.Binance\"}}', NULL, NULL, '2024-05-07 08:08:27'),
(57, 0, 124, 'SslCommerz', 'SslCommerz', '663a397a70c571715091834.png', 1, '{\"store_id\":{\"title\":\"Store ID\",\"global\":true,\"value\":\"---------\"},\"store_password\":{\"title\":\"Store Password\",\"global\":true,\"value\":\"----------\"}}', '{\"BDT\":\"BDT\",\"USD\":\"USD\",\"EUR\":\"EUR\",\"SGD\":\"SGD\",\"INR\":\"INR\",\"MYR\":\"MYR\"}', 0, NULL, NULL, NULL, '2024-05-07 08:23:54'),
(58, 0, 125, 'Aamarpay', 'Aamarpay', '663a34d5d1dfc1715090645.png', 1, '{\"store_id\":{\"title\":\"Store ID\",\"global\":true,\"value\":\"---------\"},\"signature_key\":{\"title\":\"Signature Key\",\"global\":true,\"value\":\"----------\"}}', '{\"BDT\":\"BDT\"}', 0, NULL, NULL, NULL, '2024-05-07 08:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_code` int DEFAULT NULL,
  `gateway_alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `max_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `percent_charge` decimal(5,2) NOT NULL DEFAULT '0.00',
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `gateway_parameter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateway_currencies`
--

INSERT INTO `gateway_currencies` (`id`, `name`, `currency`, `symbol`, `method_code`, `gateway_alias`, `min_amount`, `max_amount`, `percent_charge`, `fixed_charge`, `rate`, `gateway_parameter`, `created_at`, `updated_at`) VALUES
(268, 'Authorize.net - USD', 'USD', '$', 120, 'Authorize', 1.00000000, 10.00000000, 1.00, 1.00000000, 1.00000000, '{\"login_id\":\"59e4P9DBcZv\",\"transaction_key\":\"47x47TJyLw2E7DbR\"}', '2024-05-07 08:07:53', '2024-05-07 08:07:53'),
(269, 'BTCPay - BTC', 'BTC', '₿', 507, 'BTCPay', 1.00000000, 100.00000000, 1.00, 1.00000000, 1.00000000, '{\"store_id\":\"HsqFVTXSeUFJu7caoYZc3CTnP8g5LErVdHhEXPVTheHf\",\"api_key\":\"4436bd706f99efae69305e7c4eff4780de1335ce\",\"server_name\":\"https:\\/\\/testnet.demo.btcpayserver.org\",\"secret_code\":\"SUCdqPn9CDkY7RmJHfpQVHP2Lf2\"}', '2024-05-07 08:08:13', '2024-05-07 08:08:13'),
(272, 'Cashmaal - PKR', 'PKR', 'pkr', 116, 'Cashmaal', 1.00000000, 10000.00000000, 10.00, 1.00000000, 100.00000000, '{\"web_id\":\"3748\",\"ipn_key\":\"546254628759524554647987\"}', '2024-05-07 08:09:31', '2024-05-07 08:09:31'),
(273, 'Checkout - USD', 'USD', '$', 123, 'Checkout', 1.00000000, 100.00000000, 1.00, 1.00000000, 1.00000000, '{\"secret_key\":\"------\",\"public_key\":\"------\",\"processing_channel_id\":\"------\"}', '2024-05-07 08:09:44', '2024-05-07 08:09:44'),
(276, 'Coingate - USD', 'USD', '$', 505, 'Coingate', 1.00000000, 100.00000000, 1.00, 1.00000000, 1.00000000, '{\"api_key\":\"6354mwVCEw5kHzRJ6thbGo-N\"}', '2024-05-07 08:11:37', '2024-05-07 08:11:37'),
(280, 'CoinPayments Fiat - USD', 'USD', '$', 504, 'CoinpaymentsFiat', 1.00000000, 10000.00000000, 10.00, 1.00000000, 10.00000000, '{\"merchant_id\":\"6515561\"}', '2024-05-07 08:12:07', '2024-05-07 08:12:07'),
(281, 'CoinPayments Fiat - AUD', 'AUD', '$', 504, 'CoinpaymentsFiat', 1.00000000, 10000.00000000, 0.00, 1.00000000, 1.00000000, '{\"merchant_id\":\"6515561\"}', '2024-05-07 08:12:07', '2024-05-07 08:12:07'),
(282, 'Flutterwave - USD', 'USD', 'USD', 109, 'Flutterwave', 1.00000000, 2000.00000000, 0.00, 1.00000000, 1.00000000, '{\"public_key\":\"----------------\",\"secret_key\":\"-----------------------\",\"encryption_key\":\"------------------\"}', '2024-05-07 08:12:18', '2024-05-07 08:12:18'),
(284, 'Mercado Pago - USD', 'USD', '$', 119, 'MercadoPago', 1.00000000, 10.00000000, 1.00, 1.00000000, 1.00000000, '{\"access_token\":\"APP_USR-7924565816849832-082312-21941521997fab717db925cf1ea2c190-1071840315\"}', '2024-05-07 08:19:24', '2024-05-07 08:19:24'),
(285, 'Mollie - USD', 'USD', '$', 115, 'Mollie', 1.00000000, 10000.00000000, 1.00, 1.00000000, 1.00000000, '{\"mollie_email\":\"vi@gmail.com\",\"api_key\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}', '2024-05-07 08:19:42', '2024-05-07 08:19:42'),
(286, 'NMI - USD', 'USD', '$', 121, 'NMI', 1.00000000, 10000.00000000, 1.00, 1.00000000, 1.00000000, '{\"api_key\":\"2F822Rw39fx762MaV7Yy86jXGTC7sCDy\"}', '2024-05-07 08:20:07', '2024-05-07 08:20:07'),
(287, 'Now payments checkout - USD', 'USD', '$', 509, 'NowPaymentsCheckout', 1.00000000, 100.00000000, 1.00, 1.00000000, 1.00000000, '{\"api_key\":\"---------------\",\"secret_key\":\"-----------\"}', '2024-05-07 08:20:21', '2024-05-07 08:20:21'),
(288, 'Payeer - USD', 'USD', '$', 106, 'Payeer', 1.00000000, 10000.00000000, 1.00, 1.00000000, 1.00000000, '{\"merchant_id\":\"866989763\",\"secret_key\":\"7575\"}', '2024-05-07 08:20:58', '2024-05-07 08:20:58'),
(289, 'Paypal - USD', 'USD', '$', 101, 'Paypal', 1.00000000, 10000.00000000, 1.00, 1.00000000, 1.00000000, '{\"paypal_email\":\"sb-owud61543012@business.example.com\"}', '2024-05-07 08:21:11', '2024-05-07 08:21:11'),
(290, 'Paypal Express - USD', 'USD', '$', 113, 'PaypalSdk', 1.00000000, 1000000.00000000, 1.00, 1.00000000, 1.00000000, '{\"clientId\":\"Ae0-tixtSV7DvLwIh3Bmu7JvHrjh5EfGdXr_cEklKAVjjezRZ747BxKILiBdzlKKyp-W8W_T7CKH1Ken\",\"clientSecret\":\"EOhbvHZgFNO21soQJT1L9Q00M3rK6PIEsdiTgXRBt2gtGtxwRer5JvKnVUGNU5oE63fFnjnYY7hq3HBA\"}', '2024-05-07 08:21:33', '2024-05-07 08:21:33'),
(292, 'PayTM - AUD', 'AUD', '$', 105, 'Paytm', 1.00000000, 10000.00000000, 1.00, 1.00000000, 1.00000000, '{\"MID\":\"DIY12386817555501617\",\"merchant_key\":\"bKMfNxPPf_QdZppa\",\"WEBSITE\":\"DIYtestingweb\",\"INDUSTRY_TYPE_ID\":\"Retail\",\"CHANNEL_ID\":\"WEB\",\"transaction_url\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\",\"transaction_status_url\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}', '2024-05-07 08:22:07', '2024-05-07 08:22:07'),
(293, 'PayTM - USD', 'USD', '$', 105, 'Paytm', 1.00000000, 10000.00000000, 1.00, 1.00000000, 2.00000000, '{\"MID\":\"DIY12386817555501617\",\"merchant_key\":\"bKMfNxPPf_QdZppa\",\"WEBSITE\":\"DIYtestingweb\",\"INDUSTRY_TYPE_ID\":\"Retail\",\"CHANNEL_ID\":\"WEB\",\"transaction_url\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\",\"transaction_status_url\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}', '2024-05-07 08:22:07', '2024-05-07 08:22:07'),
(294, 'Perfect Money - USD', 'USD', '$', 102, 'PerfectMoney', 1.00000000, 10000.00000000, 1.00, 1.00000000, 1.00000000, '{\"passphrase\":\"hR26aw02Q1eEeUPSIfuwNypXX\",\"wallet_id\":\"U30603391\"}', '2024-05-07 08:22:25', '2024-05-07 08:22:25'),
(295, 'RazorPay - INR', 'INR', '$', 110, 'Razorpay', 1.00000000, 10000.00000000, 1.00, 1.00000000, 1.00000000, '{\"key_id\":\"rzp_test_kiOtejPbRZU90E\",\"key_secret\":\"osRDebzEqbsE1kbyQJ4y0re7\"}', '2024-05-07 08:22:50', '2024-05-07 08:22:50'),
(299, 'Stripe Hosted - USD', 'USD', '$', 103, 'Stripe', 1.00000000, 10000.00000000, 1.00, 1.00000000, 1.00000000, '{\"secret_key\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\",\"publishable_key\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}', '2024-05-07 08:24:06', '2024-05-07 08:24:06'),
(300, 'Stripe Storefront - USD', 'USD', '$', 111, 'StripeJs', 1.00000000, 10000.00000000, 1.00, 1.00000000, 1.00000000, '{\"secret_key\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\",\"publishable_key\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}', '2024-05-07 08:24:21', '2024-05-07 08:24:21'),
(301, 'Stripe Checkout - USD', 'USD', 'USD', 114, 'StripeV3', 10.00000000, 1000.00000000, 0.00, 1.00000000, 1.00000000, '{\"secret_key\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\",\"publishable_key\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\",\"end_point\":\"whsec_lUmit1gtxwKTveLnSe88xCSDdnPOt8g5\"}', '2024-05-07 08:24:47', '2024-05-07 08:24:47'),
(302, '2Checkout - USD', 'USD', '$', 122, 'TwoCheckout', 1.00000000, 10000.00000000, 1.00, 1.00000000, 1.00000000, '{\"merchant_code\":\"253248016872\",\"secret_key\":\"eQM)ID@&vG84u!O*g[p+\"}', '2024-05-07 08:24:57', '2024-05-07 08:24:57'),
(304, 'SslCommerz - BDT', 'BDT', '৳', 124, 'SslCommerz', 1.00000000, 100.00000000, 1.00, 1.00000000, 115.00000000, '{\"store_id\":\"---------\",\"store_password\":\"----------\"}', '2024-05-08 07:34:12', '2024-05-08 07:34:12'),
(309, 'CoinPayments - BTC', 'BTC', '₿', 503, 'Coinpayments', 1.00000000, 10000.00000000, 10.00, 1.00000000, 1.00000000, '{\"public_key\":\"---------------------\",\"private_key\":\"---------------------\",\"merchant_id\":\"---------------------\"}', '2024-05-08 07:35:24', '2024-05-08 07:35:24'),
(312, 'Binance - BTC', 'BTC', '₿', 510, 'Binance', 1.00000000, 100.00000000, 1.00, 1.00000000, 1.00000000, '{\"api_key\":\"tsu3tjiq0oqfbtmlbevoeraxhfbp3brejnm9txhjxcp4to29ujvakvfl1ibsn3ja\",\"secret_key\":\"jzngq4t04ltw8d4iqpi7admfl8tvnpehxnmi34id1zvfaenbwwvsvw7llw3zdko8\",\"merchant_id\":\"231129033\"}', '2024-05-08 07:36:01', '2024-05-08 07:36:01'),
(313, 'Blockchain - BTC', 'BTC', '₿', 501, 'Blockchain', 1.00000000, 1.11000000, 1.00, 11.00000000, 1.00000000, '{\"api_key\":\"55529946-05ca-48ff-8710-f279d86b1cc5\",\"xpub_code\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}', '2024-05-08 07:40:45', '2024-05-08 07:40:45'),
(314, 'Coinbase Commerce - USD', 'USD', '$', 506, 'CoinbaseCommerce', 1.00000000, 10000.00000000, 10.00, 1.00000000, 1.00000000, '{\"api_key\":\"c47cd7df-d8e8-424b-a20a\",\"secret\":\"55871878-2c32-4f64-ab66\"}', '2024-05-08 07:41:51', '2024-05-08 07:41:51'),
(315, 'Instamojo - INR', 'INR', '₹', 112, 'Instamojo', 1.00000000, 10000.00000000, 1.00, 1.00000000, 85.00000000, '{\"api_key\":\"test_2241633c3bc44a3de84a3b33969\",\"auth_token\":\"test_279f083f7bebefd35217feef22d\",\"salt\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}', '2024-05-08 07:42:57', '2024-05-08 07:42:57'),
(316, 'Now payments hosted - BTC', 'BTC', '₿', 508, 'NowPaymentsHosted', 1.00000000, 1000.00000000, 1.00, 1.00000000, 1.00000000, '{\"api_key\":\"--------\",\"secret_key\":\"------------\"}', '2024-05-08 07:43:55', '2024-05-08 07:43:55'),
(318, 'PayStack - NGN', 'NGN', '₦', 107, 'Paystack', 1.00000000, 10000.00000000, 1.00, 1.00000000, 1420.00000000, '{\"public_key\":\"pk_test_cd330608eb47970889bca397ced55c1dd5ad3783\",\"secret_key\":\"sk_test_8a0b1f199362d7acc9c390bff72c4e81f74e2ac3\"}', '2024-05-08 07:44:50', '2024-05-08 07:44:50'),
(319, 'Skrill - AED', 'AED', '$', 104, 'Skrill', 1.00000000, 10000.00000000, 1.00, 1.00000000, 1.00000000, '{\"pay_to_email\":\"merchant@skrill.com\",\"secret_key\":\"---\"}', '2024-05-08 07:45:07', '2024-05-08 07:45:07'),
(320, 'Skrill - USD', 'USD', '$', 104, 'Skrill', 1.00000000, 10000.00000000, 1.00, 1.00000000, 2.00000000, '{\"pay_to_email\":\"merchant@skrill.com\",\"secret_key\":\"---\"}', '2024-05-08 07:45:07', '2024-05-08 07:45:07');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `site_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'email configuration',
  `sms_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `firebase_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `global_shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kv` tinyint(1) NOT NULL DEFAULT '0',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'mobile verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'sms notification, 0 - dont send, 1 - send',
  `pn` tinyint(1) NOT NULL DEFAULT '1',
  `force_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT '0',
  `secure_password` tinyint(1) NOT NULL DEFAULT '0',
  `agree` tinyint(1) NOT NULL DEFAULT '0',
  `multi_language` tinyint(1) NOT NULL DEFAULT '1',
  `registration` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Off	, 1: On',
  `active_template` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `socialite_credentials` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_cron` datetime DEFAULT NULL,
  `available_version` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_customized` tinyint(1) NOT NULL DEFAULT '0',
  `paginate_number` int NOT NULL DEFAULT '0',
  `currency_format` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>Both\r\n2=>Text Only\r\n3=>Symbol Only',
  `api_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_image_upload` int NOT NULL DEFAULT '0',
  `rental_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `cur_text`, `cur_sym`, `email_from`, `email_from_name`, `email_template`, `sms_template`, `sms_from`, `push_title`, `push_template`, `base_color`, `secondary_color`, `mail_config`, `sms_config`, `firebase_config`, `global_shortcodes`, `kv`, `ev`, `en`, `sv`, `sn`, `pn`, `force_ssl`, `maintenance_mode`, `secure_password`, `agree`, `multi_language`, `registration`, `active_template`, `socialite_credentials`, `last_cron`, `available_version`, `system_customized`, `paginate_number`, `currency_format`, `api_key`, `max_image_upload`, `rental_charge`, `created_at`, `updated_at`) VALUES
(1, 'Justhire', 'USD', '$', 'info@viserlab.com', '{{site_name}}', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"https://i.ibb.co/rw2fTRM/logo-dark.png\" width=\"220\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello {{fullname}} ({{username}})</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\">{{message}}</td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2024 <a href=\"#\">{{site_name}}</a>&nbsp;. All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'hi {{fullname}} ({{username}}), {{message}}', '{{site_name}}', '{{site_name}}', 'hi {{fullname}} ({{username}}), {{message}}', 'fd7921', '311807', '{\"name\":\"php\"}', '{\"name\":\"clickatell\",\"clickatell\":{\"api_key\":\"----------------\"},\"infobip\":{\"username\":\"------------8888888\",\"password\":\"-----------------\"},\"message_bird\":{\"api_key\":\"-------------------\"},\"nexmo\":{\"api_key\":\"----------------------\",\"api_secret\":\"----------------------\"},\"sms_broadcast\":{\"username\":\"----------------------\",\"password\":\"-----------------------------\"},\"twilio\":{\"account_sid\":\"-----------------------\",\"auth_token\":\"---------------------------\",\"from\":\"----------------------\"},\"text_magic\":{\"username\":\"-----------------------\",\"apiv2_key\":\"-------------------------------\"},\"custom\":{\"method\":\"get\",\"url\":\"https:\\/\\/hostname.com\\/demo-api-v1\",\"headers\":{\"name\":[\"api_key\"],\"value\":[\"test_api 555\"]},\"body\":{\"name\":[\"from_number\"],\"value\":[\"5657545757\"]}}}', '{\"apiKey\":\"AIzaSyCb6zm7_8kdStXjZMgLZpwjGDuTUg0e_qM\",\"authDomain\":\"flutter-prime-df1c5.firebaseapp.com\",\"projectId\":\"flutter-prime-df1c5\",\"storageBucket\":\"flutter-prime-df1c5.appspot.com\",\"messagingSenderId\":\"274514992002\",\"appId\":\"1:274514992002:web:4d77660766f4797500cd9b\",\"measurementId\":\"G-KFPM07RXRC\",\"serverKey\":\"AAAA14oqxFc:APA91bE9uJdrjU_FX3gg_EtCfApRqoNojV71m6J-9yCQC7GoL2pBFcN9pdJjLLQxEAUcNxxatfWKLcnl5qCuLsmpPdr_3QRtH9XzfIu1MrLUJU3dHkBc4CGIkYMM9EWgXCNFjudhhQmH\"}', '{\n    \"site_name\":\"Name of your site\",\n    \"site_currency\":\"Currency of your site\",\n    \"currency_symbol\":\"Symbol of currency\"\n}', 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 0, 'basic', '{\\\"google\\\":{\\\"client_id\\\":\\\"------------\\\",\\\"client_secret\\\":\\\"-------------\\\",\\\"status\\\":1},\\\"facebook\\\":{\\\"client_id\\\":\\\"------\\\",\\\"client_secret\\\":\\\"------\\\",\\\"status\\\":1},\\\"linkedin\\\":{\\\"client_id\\\":\\\"-----\\\",\\\"client_secret\\\":\\\"-----\\\",\\\"status\\\":1}}', '2024-06-27 10:36:16', '0', 0, 20, 3, 'AIzaSyAeirrkfO92G0Xz37zXwAqC_xLco636W9E', 5, 20.00000000, NULL, '2024-08-01 04:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: not default language, 1: default language',
  `image` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `is_default`, `image`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 1, '660b94fa876ac1712035066.png', '2020-07-06 03:47:55', '2024-04-01 23:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `sender` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_to` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notification_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_read` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subj` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_status` tinyint(1) NOT NULL DEFAULT '1',
  `sms_status` tinyint(1) NOT NULL DEFAULT '1',
  `push_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `push_status`, `created_at`, `updated_at`) VALUES
(1, 'BAL_ADD', 'Balance - Added', 'Your Account has been Credited', '<div><div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been added to your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}&nbsp;</span></font><br></div><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin note:&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 12px; font-weight: 600; white-space: nowrap; text-align: var(--bs-body-text-align);\">{{remark}}</span></div>', '{{amount}} {{site_currency}} credited in your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin note is \"{{remark}}\"', '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 0, 0, '2021-11-03 12:00:00', '2022-04-03 02:18:28'),
(2, 'BAL_SUB', 'Balance - Subtracted', 'Your Account has been Debited', '<div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been subtracted from your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}</span></font><br><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin Note: {{remark}}</div>', '{{amount}} {{site_currency}} debited from your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin Note is {{remark}}', '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, 0, '2021-11-03 12:00:00', '2022-04-03 02:24:11'),
(3, 'DEPOSIT_COMPLETE', 'Payment- Automated - Successful', 'Payment Completed Successfully', '<div>Your payment of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been completed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#000000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Received : {{method_amount}} {{method_currency}}<br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Payment successfully by {{method_name}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, 0, '2021-11-03 12:00:00', '2024-04-01 00:35:54'),
(4, 'DEPOSIT_APPROVE', 'Payment - Manual - Approved', 'Your Payment is Approved', '<div style=\"font-family: Montserrat, sans-serif;\">Your payment request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>is Approved .<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your Payment:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Admin Approve Your {{amount}} {{site_currency}} payment request by {{method_name}} transaction : {{trx}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, 0, '2021-11-03 12:00:00', '2024-04-01 00:34:28'),
(5, 'DEPOSIT_REJECT', 'Payment - Manual - Rejected', 'Your Payment Request is Rejected', '<div style=\"font-family: Montserrat, sans-serif;\">Your payment request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}} has been rejected</span>.<span style=\"font-weight: bolder;\"><br></span></div><div><br></div><div><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge: {{charge}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number was : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">if you have any queries, feel free to contact us.<br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><br><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">{{rejection_message}}</span><br>', 'Admin Rejected Your {{amount}} {{site_currency}} payment request by {{method_name}}\r\n\r\n{{rejection_message}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"rejection_message\":\"Rejection message by the admin\"}', 1, 1, 0, '2021-11-03 12:00:00', '2024-04-01 00:34:42'),
(6, 'DEPOSIT_REQUEST', 'Payment - Manual - Requested', 'Payment Request Submitted Successfully', '<div>Your payment request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>submitted successfully<span style=\"font-weight: bolder;\">&nbsp;.<br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Payment:<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}}<br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} payment requested by {{method_name}}. Charge: {{charge}} . Trx: {{trx}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\"}', 1, 1, 0, '2021-11-03 12:00:00', '2024-04-01 00:35:07'),
(7, 'PASS_RESET_CODE', 'Password - Reset - Code', 'Password Reset', '<div style=\"font-family: Montserrat, sans-serif;\">We have received a request to reset the password for your account on&nbsp;<span style=\"font-weight: bolder;\">{{time}} .<br></span></div><div style=\"font-family: Montserrat, sans-serif;\">Requested From IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size=\"6\"><span style=\"font-weight: bolder;\">{{code}}</span></font></div><div><br></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size=\"4\" color=\"#CC0000\"><br></font></div>', 'Your account recovery code is: {{code}}', '{\"code\":\"Verification code for password reset\",\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 0, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:05'),
(8, 'PASS_RESET_DONE', 'Password - Reset - Confirmation', 'You have reset your password', '<p style=\"font-family: Montserrat, sans-serif;\">You have successfully reset your password.</p><p style=\"font-family: Montserrat, sans-serif;\">You changed from&nbsp; IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{time}}</span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><font color=\"#ff0000\">If you did not change that, please contact us as soon as possible.</font></span></p>', 'Your password has been changed successfully', '{\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 1, 0, '2021-11-03 12:00:00', '2022-04-05 03:46:35'),
(9, 'ADMIN_SUPPORT_REPLY', 'Support - Reply', 'Reply Support Ticket', '<div><p><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\">A member from our support team has replied to the following ticket:</span></span></p><p><span style=\"font-weight: bolder;\"><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\"><br></span></span></span></p><p><span style=\"font-weight: bolder;\">[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</span></p><p>----------------------------------------------</p><p>Here is the reply :<br></p><p>{{reply}}<br></p></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', 'Your Ticket#{{ticket_id}} :  {{ticket_subject}} has been replied.', '{\"ticket_id\":\"ID of the support ticket\",\"ticket_subject\":\"Subject  of the support ticket\",\"reply\":\"Reply made by the admin\",\"link\":\"URL to view the support ticket\"}', 1, 1, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:51'),
(10, 'EVER_CODE', 'Verification - Email', 'Please verify your email address', '<br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For joining us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use the below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;{{code}}</span></font></div></div>', '---', '{\"code\":\"Email verification code\"}', 1, 0, 0, '2021-11-03 12:00:00', '2022-04-03 02:32:07'),
(11, 'SVER_CODE', 'Verification - SMS', 'Verify Your Mobile Number', '---', 'Your phone verification code is: {{code}}', '{\"code\":\"SMS Verification Code\"}', 0, 1, 0, '2021-11-03 12:00:00', '2022-03-20 19:24:37'),
(12, 'WITHDRAW_APPROVE', 'Withdraw - Approved', 'Withdraw Request has been Processed and your money is sent', '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been Processed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You will get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">-----</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\">Details of Processed Payment :</font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\"><span style=\"font-weight: bolder;\">{{admin_details}}</span></font></div>', 'Admin Approve Your {{amount}} {{site_currency}} withdraw request by {{method_name}}. Transaction {{trx}}', '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"admin_details\":\"Details provided by the admin\"}', 1, 1, 0, '2021-11-03 12:00:00', '2022-03-20 20:50:16'),
(13, 'WITHDRAW_REJECT', 'Withdraw - Rejected', 'Withdraw Request has been Rejected and your money is refunded to your account', '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been Rejected.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You should get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">----</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><br></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\">{{amount}} {{currency}} has been&nbsp;<span style=\"font-weight: bolder;\">refunded&nbsp;</span>to your account and your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}}</span><span style=\"font-weight: bolder;\">&nbsp;{{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">-----</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\">Details of Rejection :</font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\"><span style=\"font-weight: bolder;\">{{admin_details}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br><br><br><br><br></div><div></div><div></div>', 'Admin Rejected Your {{amount}} {{site_currency}} withdraw request. Your Main Balance {{post_balance}}  {{method_name}} , Transaction {{trx}}', '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after fter this action\",\"admin_details\":\"Rejection message by the admin\"}', 1, 1, 0, '2021-11-03 12:00:00', '2022-03-20 20:57:46'),
(14, 'WITHDRAW_REQUEST', 'Withdraw - Requested', 'Withdraw Request Submitted Successfully', '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been submitted Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You will get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br><br><br></div>', '{{amount}} {{site_currency}} withdraw requested by {{method_name}}. You will get {{method_amount}} {{method_currency}} Trx: {{trx}}', '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after fter this transaction\"}', 1, 1, 0, '2021-11-03 12:00:00', '2022-03-21 04:39:03'),
(15, 'DEFAULT', 'Default Template', '{{subject}}', '{{message}}', '{{message}}', '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, 1, 0, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(16, 'KYC_APPROVE', 'KYC Approved', 'KYC has been approved', NULL, NULL, '[]', 1, 1, 0, NULL, NULL),
(17, 'KYC_REJECT', 'KYC Rejected Successfully', 'KYC has been rejected', NULL, NULL, '[]', 1, 1, 0, NULL, NULL),
(18, 'STORE_APPROVED', 'Store Approved', 'Vehicle store has been approved', 'Dear {{username}},<div><br></div><div>Your vehicle store&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: var(--bs-body-text-align);\">{{store}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;has been approved successfully.</span></div><div><br></div>', 'Dear {{username}},\r\n\r\nYour vehicle store {{store}} has been approved successfully.', '{\n    \"username\":\"Store Creator\",\n    \"store\":\"Store Name\"\n}', 1, 1, 0, NULL, '2024-03-25 01:24:14'),
(19, 'STORE_REJECTED', 'Store Rejected', 'Vehicle store has been rejected', '<span style=\"color: rgb(33, 37, 41);\">Dear {{username}},</span><div><br></div><div>Your vehicle store&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: var(--bs-body-text-align);\">{{store}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;has been rejected.</span></div><div><br></div><div>Reason :&nbsp;</div><div>{{store_feedback}}</div>', 'Dear {{username}},\r\n\r\nYour vehicle store {{store}} has been rejected.', '\n{\n    \"username\":\"Store Creator\",\n    \"store\":\"Store Name\",\n    \"store_feedback\":\"Store Rejected Reason\"\n}', 1, 1, 0, NULL, '2024-03-25 01:24:45'),
(20, 'VEHICLE_APPROVED', 'Vehicle Approved', 'Vehicle has been approved', 'Dear {{username}},<div><br></div><div>Your vehicle has been approved successfully.</div><div>Identification No : {{identification_number}}</div><div>Manufactured By : {{brand}}</div><div>Name:{{name}}</div><div>Model: {{model}}</div><div><br></div>', 'Your vehicle has been approved successfully.', '{\n        \"username\" : \"vehicle Owner Username\",\n        \"identification_number\" : \"Vehicle Identification Number\",\n        \"brand\":\"Vehicle Manufactured By\",\n        \"name\" : \"Vehicle Name\",\n        \"model\": \"Vehicle Model\"\n    }', 1, 1, 0, NULL, '2024-04-06 01:25:48'),
(21, 'VEHICLE_REJECTED', 'Vehicle Rejected', 'Vehicle has been rejected', '<div>Dear {{username}},<div><br></div><div>Your vehicle has been rejected</div><div>Identification No : {{identification_number}}</div><div>Manufactured By : {{brand}}</div><div>Name:{{name}}</div><div>Model: {{model}}</div><div><br></div></div><div>Rejected Reason :</div><div>{{admin_feedback}}</div>', 'Your vehicle has been rejected', '{\n        \"username\" : \"vehicle Owner Username\",\n        \"identification_number\" : \"Vehicle Identification Number\",\n        \"brand\":\"Vehicle Manufactured By\",\n        \"name\" : \"Vehicle Name\",\n        \"model\": \"Vehicle Model\",\n        \"admin_feedback\": \"Vehicle Rejected Reason\"\n    }', 1, 1, 0, NULL, '2024-04-06 01:25:59'),
(22, 'VEHICLE_REQUEST', 'Vehicle Request', 'Vehicle request is pending', 'Dear {{username}},<div><br></div><div>Your vehicle request is pending</div><div>Identification No : {{identification_number}}</div><div>Manufactured By : {{brand}}</div><div>Name:{{name}}</div><div>Model: {{model}}</div><div><br></div>', 'Your vehicle request is pending', '{\n        \"username\" : \"vehicle Owner Username\",\n        \"identification_number\" : \"Vehicle Identification Number\",\n        \"brand\":\"Vehicle Manufactured By\",\n        \"name\" : \"Vehicle Name\",\n        \"model\": \"Vehicle Model\"\n    }', 1, 1, 0, NULL, '2024-04-06 01:01:32'),
(23, 'RENTAL_REQUEST', 'Rental Request', 'Rental request is pending', '<div><div>Dear {{username}},</div><div><br></div><div>Thank you for choosing our rental service! We are pleased to confirm your recent rental request with the following details:</div><div><br></div><div>Rental Number:{{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}} {{site_currency}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div><br></div><div>Your request is now being processed, and we will notify you once it\'s approved. If you have any questions or need further assistance, please don\'t hesitate to contact us.</div></div>', 'Your request is now being processed, and we will notify you once it\'s approved. If you have any questions or need further assistance, please don\'t hesitate to contact us.', '{\n  \"username\": \"Requested For Rent\",\n  \"rent_no\": \"Rent Request Number\",\n  \"brand\": \"Vehicle Brand\",\n  \"name\": \"Vehicle Name\",\n  \"model\": \"Vehicle Model\",\n  \"price\": \"Rented Price\",\n  \"start_date\": \"Rent Started At\",\n  \"end_date\": \"Rent End At\",\n  \"pickup\": \"Pickup Location\",\n  \"dropoff\": \"Drop Off Location\"\n}', 1, 1, 0, NULL, '2024-04-02 00:27:42'),
(24, 'VEHICLE_RENTAL_REQUEST', 'Vehicle Rental Request', 'Rental Request for Your Vehicle', '<div>Dear {{username}}</div><div><br></div><div>We hope this email finds you well. We wanted to inform you that a rental request has been made for your vehicle with the following details:</div><div><br></div><div>Rental Request By: {{rented_user}}</div><div>Rental Number: {{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}} {{site_currency}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div>Your vehicle has been requested for rental, and we are currently processing the request. We will keep you updated on the status of the rental request.</div>', 'We wanted to inform you that a rental request has been made for your vehicle', '{\r\n\"username\": \"Vehicle Owner\",\r\n  \"rented_user\": \"Requested For Rent\",\r\n  \"rent_no\": \"Rent Request Number\",\r\n  \"brand\": \"Vehicle Brand\",\r\n  \"name\": \"Vehicle Name\",\r\n  \"model\": \"Vehicle Model\",\r\n  \"price\": \"Rented Price\",\r\n  \"start_date\": \"Rent Started At\",\r\n  \"end_date\": \"Rent End At\",\r\n  \"pickup\": \"Pickup Location\",\r\n  \"dropoff\": \"Drop Off Location\"\r\n}', 1, 1, 0, NULL, '2024-04-02 00:28:00'),
(25, 'RENTAL_APPROVED', 'Rental Approved', 'Rental Request Approved', '<div>Dear {{username}},</div><div><br></div><div>We\'re excited to inform you that your rental request has been approved! You can now proceed with the rental of the following vehicle:</div><div><br></div><div>Rental Number: {{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}} {{site_currency}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div>Your rental request has been confirmed, and the vehicle is ready for pickup. Please review the details and make the necessary arrangements to collect the vehicle.</div>', 'We\'re excited to inform you that your rental request has been approved!', '{\n  \"username\": \"Requested For Rent\",\n  \"rent_no\": \"Rent Request Number\",\n  \"brand\": \"Vehicle Brand\",\n  \"name\": \"Vehicle Name\",\n  \"model\": \"Vehicle Model\",\n  \"price\": \"Rented Price\",\n  \"start_date\": \"Rent Started At\",\n  \"end_date\": \"Rent End At\",\n  \"pickup\": \"Pickup Location\",\n  \"dropoff\": \"Drop Off Location\"\n}', 1, 1, 0, NULL, '2024-04-02 00:27:22'),
(26, 'RENTAL_CANCELLED', 'Rental Cancelled', 'Rental Request Cancelled', '<div>Dear {{username}}</div><div><br></div><div>We regret that the vehicle owner has canceled your rental request. We apologize for any inconvenience this may cause.</div><div><br></div><div>The rental request for the following vehicle has been canceled:</div><div><br></div><div>Rental Number: {{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div>Post Balance:{{post_balance}}</div><div><br></div><div>If you have any questions or need further assistance, please don\'t hesitate to contact us</div>', 'We regret that the vehicle owner has canceled your rental request.', '{\n  \"username\": \"Requested For Rent\",\n  \"rent_no\": \"Rent Request Number\",\n  \"brand\": \"Vehicle Brand\",\n  \"name\": \"Vehicle Name\",\n  \"model\": \"Vehicle Model\",\n  \"price\": \"Rented Price\",\n  \"start_date\": \"Rent Started At\",\n  \"end_date\": \"Rent End At\",\n  \"pickup\": \"Pickup Location\",\n  \"dropoff\": \"Drop Off Location\",\n\"post_balance\":\"User Post Balance\"\n}', 1, 1, 0, NULL, '2024-04-02 00:39:21'),
(27, 'RENTAL_ONGOING', 'Rental On Going', 'Rental Vehicle Ongoing', '<div>Dear {{username}},</div><div><br></div><div>We want to inform you that the vehicle owner has accessed the ongoing rental for driving the vehicle.</div><div><br></div><div>Rental Number: {{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}} {{site_currency}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div><br></div><div>Thank you for your understanding.<br></div>', 'We want to inform you that the vehicle owner has accessed the ongoing rental for driving the vehicle.', '{\r\n  \"username\": \"Requested For Rent\",\r\n  \"rent_no\": \"Rent Request Number\",\r\n  \"brand\": \"Vehicle Brand\",\r\n  \"name\": \"Vehicle Name\",\r\n  \"model\": \"Vehicle Model\",\r\n  \"price\": \"Rented Price\",\r\n  \"start_date\": \"Rent Started At\",\r\n  \"end_date\": \"Rent End At\",\r\n  \"pickup\": \"Pickup Location\",\r\n  \"dropoff\": \"Drop Off Location\"\r\n}', 1, 1, 0, NULL, '2024-04-02 02:21:44'),
(28, 'RENTAL_VEHICLE_RECEIVED', 'Rental Vehicel Received', 'Rental Vehicel Received', '<div>Dear {{username}},</div><div><br></div><div>We are writing to inform you that the vehicle owner has accessed the ongoing rental to drive the vehicle. During this time, please be aware that the vehicle may be temporarily unavailable for pickup or dropoff.</div><div><br></div><div>Rental Number: {{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}} {{site_currency}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div><br></div><div>Thank you for your understanding.<br></div>', 'We are writing to inform you that the vehicle owner has accessed the ongoing rental to drive the vehicle. During this time, please be aware that the vehicle may be temporarily unavailable for pickup or dropoff.', '{\r\n  \"username\": \"Receiving Store Username\",\r\n  \"rent_no\": \"Rent Request Number\",\r\n  \"brand\": \"Vehicle Brand\",\r\n  \"name\": \"Vehicle Name\",\r\n  \"model\": \"Vehicle Model\",\r\n  \"price\": \"Rented Price\",\r\n  \"start_date\": \"Rent Started At\",\r\n  \"end_date\": \"Rent End At\",\r\n  \"pickup\": \"Pickup Location\",\r\n  \"dropoff\": \"Drop Off Location\"\r\n}', 1, 1, 0, NULL, '2024-04-02 02:24:58'),
(29, 'RENTAL_COMPLETED', 'Rental Completed', 'Rental Vehicle Completed', '<div>Dear {{username}},</div><div><br></div><div>We are pleased to inform you that the rental for the following vehicle has been completed:</div><div><br></div><div>Rental Number: {{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}} {{site_currency}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div><br></div><div>Thank you for choosing our rental service. We hope you had a pleasant experience. If you have any feedback or questions, please feel free to reach out to us.<br></div>', 'We are pleased to inform you that the rental for the following vehicle has been completed.', '{\n  \"username\": \"Requested For Rent\",\n  \"rent_no\": \"Rent Request Number\",\n  \"brand\": \"Vehicle Brand\",\n  \"name\": \"Vehicle Name\",\n  \"model\": \"Vehicle Model\",\n  \"price\": \"Rented Price\",\n  \"start_date\": \"Rent Started At\",\n  \"end_date\": \"Rent End At\",\n  \"pickup\": \"Pickup Location\",\n  \"dropoff\": \"Drop Off Location\"\n}', 1, 1, 0, NULL, '2024-04-03 23:11:36'),
(30, 'VEHICLE_RETURN_CONFIRMATION', 'Vehicle Return Confirmation', 'Vehicle Return Confirmation', '<div>Dear {{username}},</div><div><br></div><div>We\'re pleased to inform you that the rental for your vehicle has been completed. The vehicle has been returned according to the agreed terms and conditions.<br></div><div><br></div><div>Rental Number: {{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}} {{site_currency}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div><br></div><div>Thank you for being part of our rental network. If you have any questions or require further assistance, please don\'t hesitate to contact us.<br></div>', 'We\'re pleased to inform you that the rental for your vehicle has been completed. The vehicle has been returned according to the agreed terms and conditions.', '{\r\n  \"username\": \"Vehicle Owner\",\r\n  \"rent_no\": \"Rent Request Number\",\r\n  \"brand\": \"Vehicle Brand\",\r\n  \"name\": \"Vehicle Name\",\r\n  \"model\": \"Vehicle Model\",\r\n  \"price\": \"Rented Price\",\r\n  \"start_date\": \"Rent Started At\",\r\n  \"end_date\": \"Rent End At\",\r\n  \"pickup\": \"Pickup Location\",\r\n  \"dropoff\": \"Drop Off Location\"\r\n}', 1, 1, 0, NULL, '2024-04-03 23:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `seo_content`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', '/', 'templates.basic.', '[\"how_to_work\",\"vehicle\",\"feature\",\"partner\",\"service\",\"faq\",\"cta\",\"testimonial\",\"cta_contact\",\"blog\"]', '{\"image\":\"663212c9551ed1714557641.png\",\"description\":\"Et recusandae Minus\",\"social_title\":null,\"social_description\":\"Odit magna eos cons\",\"keywords\":null}', 1, '2020-07-11 06:23:58', '2024-07-30 14:22:36'),
(4, 'Blog', 'blog', 'templates.basic.', NULL, NULL, 1, '2020-10-22 01:14:43', '2020-10-22 01:14:43'),
(5, 'Contact', 'contact', 'templates.basic.', NULL, '{\"image\":null,\"description\":null,\"social_title\":null,\"social_description\":null,\"keywords\":[\"viserlab\"]}', 1, '2020-10-22 01:14:53', '2024-07-31 05:17:27'),
(26, 'About', 'about', 'templates.basic.', '[\"about\",\"support\",\"why_choose_us\",\"cta\",\"faq\"]', NULL, 0, '2024-07-30 14:44:33', '2024-07-30 14:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `vehicle_user_id` int NOT NULL DEFAULT '0',
  `vehicle_id` int UNSIGNED NOT NULL DEFAULT '0',
  `pick_up_zone_id` int NOT NULL DEFAULT '0',
  `drop_off_zone_id` int NOT NULL DEFAULT '0',
  `pick_up_location_id` int UNSIGNED NOT NULL DEFAULT '0',
  `drop_off_location_id` int UNSIGNED NOT NULL DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `price` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rent_no` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `rental_id` int NOT NULL DEFAULT '0',
  `vehicle_id` int NOT NULL DEFAULT '0',
  `star` tinyint(1) NOT NULL DEFAULT '0',
  `review` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint UNSIGNED NOT NULL,
  `support_message_id` int UNSIGNED NOT NULL DEFAULT '0',
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `support_ticket_id` int UNSIGNED NOT NULL DEFAULT '0',
  `admin_id` int UNSIGNED NOT NULL DEFAULT '0',
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `post_balance` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `trx_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `update_logs`
--

CREATE TABLE `update_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_log` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `location_id` int NOT NULL DEFAULT '0',
  `zone_id` int NOT NULL DEFAULT '0',
  `firstname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dial_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_by` int UNSIGNED NOT NULL DEFAULT '0',
  `balance` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: banned, 1: active',
  `kyc_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kyc_rejection_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kv` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: KYC Unverified, 2: KYC pending, 1: KYC verified',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: mobile unverified, 1: mobile verified',
  `profile_complete` tinyint(1) NOT NULL DEFAULT '0',
  `ver_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `ts` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store` tinyint(1) DEFAULT NULL,
  `store_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `store_feedback` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_ip` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `vehicle_type_id` int NOT NULL DEFAULT '0',
  `vehicle_class_id` int NOT NULL DEFAULT '0',
  `brand_id` int NOT NULL DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cc` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `bhp` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `speed` int NOT NULL DEFAULT '0',
  `cylinder` int NOT NULL DEFAULT '0',
  `year` year DEFAULT NULL,
  `color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification_number` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mileage` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_condition` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transmission_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fuel_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seat` tinyint(1) DEFAULT '0',
  `price` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `total_run` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `image` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `rating` decimal(5,2) NOT NULL DEFAULT '0.00',
  `rented` tinyint(1) NOT NULL DEFAULT '0',
  `approval_status` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `admin_feedback` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_classes`
--

CREATE TABLE `vehicle_classes` (
  `id` int UNSIGNED NOT NULL,
  `vehicle_type_id` int NOT NULL DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manage_class` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_zones`
--

CREATE TABLE `vehicle_zones` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_id` int UNSIGNED NOT NULL DEFAULT '0',
  `zone_id` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint UNSIGNED NOT NULL,
  `method_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `after_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `withdraw_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel,  ',
  `admin_feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `form_id` int UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_limit` decimal(28,8) DEFAULT '0.00000000',
  `max_limit` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `fixed_charge` decimal(28,8) DEFAULT '0.00000000',
  `rate` decimal(28,8) DEFAULT '0.00000000',
  `percent_charge` decimal(5,2) DEFAULT NULL,
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coordinates` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `zoom` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_tokens`
--
ALTER TABLE `device_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `update_logs`
--
ALTER TABLE `update_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_classes`
--
ALTER TABLE `vehicle_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_zones`
--
ALTER TABLE `vehicle_zones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_tokens`
--
ALTER TABLE `device_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `update_logs`
--
ALTER TABLE `update_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_classes`
--
ALTER TABLE `vehicle_classes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_zones`
--
ALTER TABLE `vehicle_zones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
