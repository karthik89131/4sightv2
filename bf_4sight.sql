-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 28, 2016 at 11:11 AM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bf_4sight`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_documentation`
--

CREATE TABLE `activity_documentation` (
  `id` int(10) UNSIGNED NOT NULL,
  `documentation_id` int(11) NOT NULL,
  `project_phase_activity_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_resources`
--

CREATE TABLE `activity_resources` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_phase_activity_id` int(11) NOT NULL,
  `role` enum('scribe','creator') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_standards`
--

CREATE TABLE `activity_standards` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activity_introduction` longtext COLLATE utf8_unicode_ci NOT NULL,
  `activity_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `activity_type` enum('generic','pir','pra','pll') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ppms_type` enum('pa','sa','vmp','dsp') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activity_standards`
--

INSERT INTO `activity_standards` (`id`, `activity_name`, `activity_introduction`, `activity_description`, `activity_type`, `created_at`, `updated_at`, `ppms_type`) VALUES
(1, 'PRA 1', '', 'adhfgashjdfghajsdf', 'pra', NULL, NULL, 'vmp'),
(2, 'PIR 1', '', '', 'pir', NULL, NULL, NULL),
(3, 'PLL 1', '', '', 'pll', NULL, NULL, NULL),
(4, 'Generic Activity', '', '', 'generic', NULL, NULL, NULL),
(5, 'PRA 2', '', '', 'pra', NULL, NULL, NULL),
(6, 'PIR 2', '', '', 'pir', NULL, NULL, NULL),
(7, 'PLL 2', '', '', 'pll', NULL, NULL, NULL),
(8, 'Generic Activity', '', '', 'generic', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `activity_standards_project_phase`
--

CREATE TABLE `activity_standards_project_phase` (
  `id` int(10) UNSIGNED NOT NULL,
  `config_project_phase_id` int(11) NOT NULL,
  `activity_standards_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activity_standards_project_phase`
--

INSERT INTO `activity_standards_project_phase` (`id`, `config_project_phase_id`, `activity_standards_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 2, 5, NULL, NULL),
(6, 2, 6, NULL, NULL),
(7, 2, 7, NULL, NULL),
(8, 2, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` date NOT NULL,
  `properties` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `actions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `config_business`
--

CREATE TABLE `config_business` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `config_company`
--

CREATE TABLE `config_company` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `authority` int(11) NOT NULL,
  `company_type_id` int(11) NOT NULL,
  `owner_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_company`
--

INSERT INTO `config_company` (`id`, `name`, `description`, `website`, `authority`, `company_type_id`, `owner_user_id`) VALUES
(1, 'Chemicals Unit', '', '', 0, 0, 0),
(2, 'Development Unit', '', '', 0, 0, 0),
(3, 'Engineering Unit', '', '', 0, 0, 0),
(4, 'Gas Unit', '', '', 0, 0, 0),
(5, 'Lubricants Unit', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `config_company_type`
--

CREATE TABLE `config_company_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_company_type`
--

INSERT INTO `config_company_type` (`id`, `name`, `description`) VALUES
(1, 'Client', ''),
(2, 'Vendor', ''),
(3, 'Supplier', ''),
(4, 'Manufacturer', ''),
(5, 'Fabricator', ''),
(6, 'Engineering', ''),
(7, 'Distributor', ''),
(8, 'Construction', ''),
(9, 'Installer', '');

-- --------------------------------------------------------

--
-- Table structure for table `config_contracting_mode`
--

CREATE TABLE `config_contracting_mode` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_contracting_mode`
--

INSERT INTO `config_contracting_mode` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'EPCC', '', NULL, NULL),
(2, 'EPC', '', NULL, NULL),
(3, 'EPCIC', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `config_currency`
--

CREATE TABLE `config_currency` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_currency`
--

INSERT INTO `config_currency` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'USD', 'United States Dollar', NULL, NULL),
(2, 'MYR', 'Malaysian Ringgit', NULL, NULL),
(3, 'AUD', 'Australian Dollar', NULL, NULL),
(4, 'SGD', 'Singapore Dollar', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `config_discipline`
--

CREATE TABLE `config_discipline` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_discipline`
--

INSERT INTO `config_discipline` (`id`, `name`, `description`) VALUES
(1, 'Electrical', ''),
(2, 'Mechanical', ''),
(3, 'Civil', ''),
(4, 'Safety', ''),
(5, 'Pipe', ''),
(6, 'Structural', '');

-- --------------------------------------------------------

--
-- Table structure for table `config_elements`
--

CREATE TABLE `config_elements` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_elements`
--

INSERT INTO `config_elements` (`id`, `name`, `description`) VALUES
(1, 'Project Management', ''),
(2, 'Engineering', ''),
(3, 'Commissioning', ''),
(4, 'HSE', ''),
(5, 'Process', ''),
(6, 'Mechanical Static', ''),
(7, 'Civil Structure', ''),
(8, 'Construction', ''),
(9, 'QA/QC', ''),
(10, 'Contract & Procurement', ''),
(11, 'Project Control', ''),
(12, 'Financial', '');

-- --------------------------------------------------------

--
-- Table structure for table `config_project_classification`
--

CREATE TABLE `config_project_classification` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_project_classification`
--

INSERT INTO `config_project_classification` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Oil and Gas', '', NULL, NULL),
(2, 'Refinery', '', NULL, NULL),
(3, 'Ethylene and Derivatives', '', NULL, NULL),
(4, 'Petrochemical and Polymers', '', NULL, NULL),
(5, 'Chemicals', '', NULL, NULL),
(6, 'Power Station / Co-generation', '', NULL, NULL),
(7, 'Ports', '', NULL, NULL),
(8, 'Steam Cracker Complex', '', NULL, NULL),
(9, 'UIO And Special Packages', '', NULL, NULL),
(10, 'Construction Infrastructure', '', NULL, NULL),
(11, 'Water Treatment Plants', '', NULL, NULL),
(12, 'Pipelines', '', NULL, NULL),
(13, 'Aromatics', '', NULL, NULL),
(14, 'Upstream', '', NULL, NULL),
(15, 'Downstream', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `config_project_date_type`
--

CREATE TABLE `config_project_date_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_project_date_type`
--

INSERT INTO `config_project_date_type` (`id`, `name`, `tag`, `required`, `description`) VALUES
(1, 'Project Sanction Date', 'project_sanction_date', 1, ''),
(2, 'Mechanical Completion Date', 'machanical_completion_date', 1, ''),
(3, 'Start-Up Date', 'start_up_date', 1, ''),
(4, 'Initial Acceptance(IA) Date', 'initial_acceptance_date', 1, ''),
(5, 'Defect Liability Period Date', 'defect_liability_date', 1, ''),
(6, 'Final Acceptance Date', 'final_acceptance_date', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `config_project_plant_capacity`
--

CREATE TABLE `config_project_plant_capacity` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_project_plant_capacity`
--

INSERT INTO `config_project_plant_capacity` (`id`, `name`, `description`) VALUES
(1, 'Hrs', ''),
(2, 'Kbd', ''),
(3, 'KM', ''),
(4, 'mins', ''),
(5, 'MW', '');

-- --------------------------------------------------------

--
-- Table structure for table `config_project_type`
--

CREATE TABLE `config_project_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_project_type`
--

INSERT INTO `config_project_type` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Brownfield', '', NULL, NULL),
(2, 'Greenfield', '', NULL, NULL),
(3, 'Hybrid', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `config_project_type_phase`
--

CREATE TABLE `config_project_type_phase` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `config_project_type_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_project_type_phase`
--

INSERT INTO `config_project_type_phase` (`id`, `name`, `description`, `order`, `config_project_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Framing', 'Framing', 0, 1, NULL, NULL),
(2, 'FEL 1', 'Front End Loading 1', 1, 1, NULL, NULL),
(3, 'FEL 2', 'Front End Loading 2', 2, 1, NULL, NULL),
(4, 'FEL 3', 'Front End Loading 3', 3, 1, NULL, NULL),
(5, 'Execution', 'Execution', 4, 1, NULL, NULL),
(6, 'Start Up', 'Start up', 5, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `config_title`
--

CREATE TABLE `config_title` (
  `id` int(10) UNSIGNED NOT NULL,
  `prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postfix` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_title`
--

INSERT INTO `config_title` (`id`, `prefix`, `postfix`, `name`) VALUES
(1, 'Mr', '', 'Gentlemen'),
(2, 'Mrs', '', 'Lady');

-- --------------------------------------------------------

--
-- Table structure for table `config_user_status`
--

CREATE TABLE `config_user_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `has_access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_user_status`
--

INSERT INTO `config_user_status` (`id`, `name`, `description`, `has_access`) VALUES
(1, 'Active', '', 0),
(2, 'Inactive', '', 0),
(3, 'Banned', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `internal_issues`
--

CREATE TABLE `internal_issues` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `projectid` int(10) UNSIGNED NOT NULL,
  `taskid` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `internal_issue_trails`
--

CREATE TABLE `internal_issue_trails` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `internal_projects`
--

CREATE TABLE `internal_projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `internal_project_trails`
--

CREATE TABLE `internal_project_trails` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `internal_tasks`
--

CREATE TABLE `internal_tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `projectid` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `progress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `internal_task_trails`
--

CREATE TABLE `internal_task_trails` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `license`
--

CREATE TABLE `license` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expiry` date NOT NULL,
  `created` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lng` double(10,6) NOT NULL,
  `lat` double(10,6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `address`, `lng`, `lat`, `created_at`, `updated_at`) VALUES
(1, '', '', 0.000000, 0.000000, '2016-12-19 00:22:27', '2016-12-19 00:22:27'),
(2, '', '', 0.000000, 0.000000, '2016-12-21 20:12:00', '2016-12-21 20:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_11_06_072534_create_users_table', 1),
('2016_11_15_115503_create_tokens_table', 1),
('2016_11_16_102352_create_user_attributes_table', 1),
('2016_11_16_102430_create_role_profile_table', 1),
('2016_11_16_102448_create_config_company_table', 1),
('2016_11_16_102509_create_config_title_table', 1),
('2016_11_16_102715_create_resource_type_table', 1),
('2016_11_16_102738_create_config_status_table', 1),
('2016_11_16_102814_create_license_table', 1),
('2016_11_16_122726_create_company_type_table', 1),
('2016_11_17_005040_create_audit_trail', 1),
('2016_11_17_005231_create_role_profile_user', 1),
('2016_11_17_010355_create_user_attributes_list', 1),
('2016_11_17_213532_create_initial_tabledata', 1),
('2016_11_24_081830_create_projects_table', 1),
('2016_11_28_042233_create_location_info', 1),
('2016_12_05_061131_create_risk_register', 1),
('2016_12_06_053832_create_internal_projects', 1),
('2016_12_06_054128_create_internal_tasks', 1),
('2016_12_06_054147_create_internal_issues', 1),
('2016_12_06_054155_create_internal_project_trails', 1),
('2016_12_06_054204_create_internal_task_trails', 1),
('2016_12_06_054213_create_internal_issue_trails', 1),
('2016_12_07_021341_create_activities_table', 1),
('2016_12_14_041741_create_risk_activity', 1),
('2016_12_14_084341_create_documents_module', 1),
('2016_12_14_084355_create_config_elements', 1),
('2016_12_14_084404_create_config_discipline', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `capex_currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `capex_cost` decimal(10,2) NOT NULL,
  `sanction_currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sanction_cost` decimal(10,2) NOT NULL,
  `status` enum('active','not-active','completed') COLLATE utf8_unicode_ci NOT NULL,
  `config_project_type_id` int(11) NOT NULL,
  `config_project_classification_id` int(11) NOT NULL,
  `config_company_id` int(11) NOT NULL,
  `config_business_id` int(11) NOT NULL,
  `config_contracting_mode_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `current_phase_id` int(11) NOT NULL,
  `project_sponsor_id` int(11) NOT NULL,
  `project_director_id` int(11) NOT NULL,
  `project_manager_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `tag`, `name`, `description`, `capex_currency`, `capex_cost`, `sanction_currency`, `sanction_cost`, `status`, `config_project_type_id`, `config_project_classification_id`, `config_company_id`, `config_business_id`, `config_contracting_mode_id`, `location_id`, `current_phase_id`, `project_sponsor_id`, `project_director_id`, `project_manager_id`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'Test', '', '', '0.00', '', '0.00', 'active', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, '2016-12-19 00:22:27', '2016-12-19 00:22:27'),
(2, 'test1', 'test1', '', '', '0.00', '', '0.00', 'active', 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, '2016-12-21 20:12:01', '2016-12-21 20:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `project_attribute`
--

CREATE TABLE `project_attribute` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_dates`
--

CREATE TABLE `project_dates` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` datetime NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_phase`
--

CREATE TABLE `project_phase` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `planned_start_date` datetime NOT NULL,
  `planned_end_date` datetime NOT NULL,
  `actual_start_date` datetime NOT NULL,
  `actual_end_date` datetime NOT NULL,
  `order` int(11) NOT NULL,
  `config_project_type_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_phase`
--

INSERT INTO `project_phase` (`id`, `name`, `description`, `planned_start_date`, `planned_end_date`, `actual_start_date`, `actual_end_date`, `order`, `config_project_type_id`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 'Framing', 'Framing', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 1, '2016-12-19 00:22:27', '2016-12-19 00:22:27'),
(2, 'FEL 1', 'Front End Loading 1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 1, '2016-12-19 00:22:27', '2016-12-19 00:22:27'),
(3, 'FEL 2', 'Front End Loading 2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 1, '2016-12-19 00:22:28', '2016-12-19 00:22:28'),
(4, 'FEL 3', 'Front End Loading 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 0, 1, '2016-12-19 00:22:28', '2016-12-19 00:22:28'),
(5, 'Execution', 'Execution', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, 0, 1, '2016-12-19 00:22:28', '2016-12-19 00:22:28'),
(6, 'Start Up', 'Start up', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 5, 0, 1, '2016-12-19 00:22:28', '2016-12-19 00:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `project_phase_activity`
--

CREATE TABLE `project_phase_activity` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `venue` longtext COLLATE utf8_unicode_ci NOT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci NOT NULL,
  `project_background` longtext COLLATE utf8_unicode_ci NOT NULL,
  `objective` longtext COLLATE utf8_unicode_ci NOT NULL,
  `methodology` longtext COLLATE utf8_unicode_ci NOT NULL,
  `schedule` longtext COLLATE utf8_unicode_ci NOT NULL,
  `other_pmt` longtext COLLATE utf8_unicode_ci NOT NULL,
  `other` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('not_planned','pending','completed','endorsed','late') COLLATE utf8_unicode_ci NOT NULL,
  `planned_date_date` datetime NOT NULL,
  `config_project_type_id` int(11) NOT NULL,
  `project_phase_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `activity_standards_id` int(11) NOT NULL,
  `responsible_person_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_phase_activity`
--

INSERT INTO `project_phase_activity` (`id`, `name`, `venue`, `introduction`, `project_background`, `objective`, `methodology`, `schedule`, `other_pmt`, `other`, `status`, `planned_date_date`, `config_project_type_id`, `project_phase_id`, `project_id`, `activity_standards_id`, `responsible_person_id`, `created_at`, `updated_at`) VALUES
(1, 'PRA 1', 'test 5', 'test intro', '', '', '', '', '', '', 'not_planned', '0000-00-00 00:00:00', 1, 1, 1, 1, 0, '2016-12-19 00:22:27', '2016-12-26 23:33:25'),
(2, 'PIR 1', '', '', '', '', '', '', '', '', 'not_planned', '0000-00-00 00:00:00', 1, 1, 1, 2, 0, '2016-12-19 00:22:27', '2016-12-19 00:22:27'),
(3, 'PLL 1', '', '', '', '', '', '', '', '', 'not_planned', '0000-00-00 00:00:00', 1, 1, 1, 3, 0, '2016-12-19 00:22:27', '2016-12-19 00:22:27'),
(4, 'Generic Activity', '', '', '', '', '', '', '', '', 'not_planned', '0000-00-00 00:00:00', 1, 1, 1, 4, 0, '2016-12-19 00:22:27', '2016-12-19 00:22:27'),
(5, 'PRA 2', 'test', '', '', '', '', '', '', '', 'not_planned', '0000-00-00 00:00:00', 1, 2, 1, 5, 0, '2016-12-19 00:22:27', '2016-12-19 00:22:27'),
(6, 'PIR 2', '', '', '', '', '', '', '', '', 'not_planned', '0000-00-00 00:00:00', 1, 2, 1, 6, 0, '2016-12-19 00:22:27', '2016-12-19 00:22:27'),
(7, 'PLL 2', '', '', '', '', '', '', '', '', 'not_planned', '0000-00-00 00:00:00', 1, 2, 1, 7, 0, '2016-12-19 00:22:28', '2016-12-19 00:22:28'),
(8, 'Generic Activity', '', '', '', '', '', '', '', '', 'not_planned', '0000-00-00 00:00:00', 1, 2, 1, 8, 0, '2016-12-19 00:22:28', '2016-12-19 00:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `project_phase_activity_pir`
--

CREATE TABLE `project_phase_activity_pir` (
  `id` int(10) UNSIGNED NOT NULL,
  `pir_subject_issues` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pir_findings` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pir_supporting_facts` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pir_recommendations` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pir_ratings` enum('A','B','C') COLLATE utf8_unicode_ci NOT NULL,
  `pir_status` enum('open','close') COLLATE utf8_unicode_ci NOT NULL,
  `pir_pmt_response` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pir_pmt_outcome` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pir_pmt_action_by_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pir_pmt_due_date` datetime NOT NULL,
  `pir_pmd_comment_status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pir_pmd_follow_up_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pir_pmd_comment` datetime NOT NULL,
  `project_phase_activity_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_phase_activity_pll`
--

CREATE TABLE `project_phase_activity_pll` (
  `id` int(10) UNSIGNED NOT NULL,
  `pll_expected` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pll_occurred` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pll_went_well` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pll_went_wrong` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pll_actions_taken` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pll_be_improved` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pll_to_document` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pll_impact_levels` enum('1','2','3','G') COLLATE utf8_unicode_ci NOT NULL,
  `config_elements_id` int(11) NOT NULL,
  `project_phase_activity_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_phase_activity_pra`
--

CREATE TABLE `project_phase_activity_pra` (
  `id` int(10) UNSIGNED NOT NULL,
  `pra_objective` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pra_target` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pra_very_low` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pra_low` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pra_moderate` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pra_high` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pra_very_high` longtext COLLATE utf8_unicode_ci NOT NULL,
  `project_phase_activity_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_phase_activity_pra`
--

INSERT INTO `project_phase_activity_pra` (`id`, `pra_objective`, `pra_target`, `pra_very_low`, `pra_low`, `pra_moderate`, `pra_high`, `pra_very_high`, `project_phase_activity_id`, `created_at`, `updated_at`) VALUES
(1, '', '', '', '', '', '', '', 0, '2016-12-22 20:13:23', '2016-12-22 20:13:23'),
(2, '', '', '', '', '', '', '', 0, '2016-12-22 20:13:55', '2016-12-22 20:13:55'),
(3, '', '', '', '', '', '', '', 0, '2016-12-22 20:14:57', '2016-12-22 20:14:57'),
(4, '', '', '', '', '', '', '', 0, '2016-12-22 23:45:49', '2016-12-22 23:45:49'),
(5, '', '', '', '', '', '', '', 0, '2016-12-22 23:45:53', '2016-12-22 23:45:53'),
(6, '', '', '', '', '', '', '', 0, '2016-12-22 23:46:33', '2016-12-22 23:46:33'),
(7, '', '', '', '', '', '', '', 0, '2016-12-22 23:59:04', '2016-12-22 23:59:04'),
(8, '', '', '', '', '', '', '', 0, '2016-12-23 00:02:05', '2016-12-23 00:02:05'),
(9, '', '', '', '', '', '', '', 0, '2016-12-23 00:18:22', '2016-12-23 00:18:22'),
(10, '', '', '', '', '', '', '', 0, '2016-12-23 00:19:38', '2016-12-23 00:19:38'),
(11, '', '', '', '', '', '', '', 0, '2016-12-26 23:05:04', '2016-12-26 23:05:04'),
(12, '', '', '', '', '', '', '', 0, '2016-12-26 23:11:36', '2016-12-26 23:11:36'),
(13, '', '', '', '', '', '', '', 0, '2016-12-26 23:29:24', '2016-12-26 23:29:24'),
(14, '', '', '', '', '', '', '', 0, '2016-12-26 23:31:42', '2016-12-26 23:31:42'),
(15, '', '', '', '', '', '', '', 0, '2016-12-26 23:33:25', '2016-12-26 23:33:25');

-- --------------------------------------------------------

--
-- Table structure for table `project_phase_gatekeepers`
--

CREATE TABLE `project_phase_gatekeepers` (
  `id` int(10) UNSIGNED NOT NULL,
  `added_by_user` int(11) NOT NULL,
  `target_user` int(11) NOT NULL,
  `project_phase_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_plant_capacity_data`
--

CREATE TABLE `project_plant_capacity_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `config_plant_capacity_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_plant_capacity_data`
--

INSERT INTO `project_plant_capacity_data` (`id`, `tag`, `unit`, `value`, `project_id`, `config_plant_capacity_id`, `created_at`, `updated_at`) VALUES
(1, '', '', '', 1, 0, '2016-12-19 00:22:27', '2016-12-19 00:22:27'),
(2, '', '', '', 2, 0, '2016-12-21 20:12:01', '2016-12-21 20:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE `project_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `assigned_date` datetime NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_user`
--

INSERT INTO `project_user` (`id`, `assigned_date`, `project_id`, `user_id`, `assigned_by`, `created_at`, `updated_at`) VALUES
(1, '0000-00-00 00:00:00', 1, 1, 0, '2016-12-19 00:22:28', '2016-12-19 00:22:28'),
(2, '0000-00-00 00:00:00', 2, 1, 0, '2016-12-21 20:12:01', '2016-12-21 20:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `resource_type`
--

CREATE TABLE `resource_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `needs_license` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `resource_type`
--

INSERT INTO `resource_type` (`id`, `name`, `description`, `needs_license`) VALUES
(1, 'User', 'Regular User that needs license', 1),
(2, 'Resource', 'Reference user that is not part of system', 0),
(99, 'Admin', 'A seed user to initialize the system', 0);

-- --------------------------------------------------------

--
-- Table structure for table `risk`
--

CREATE TABLE `risk` (
  `id` int(10) UNSIGNED NOT NULL,
  `risk_event` longtext COLLATE utf8_unicode_ci NOT NULL,
  `direct_impact` longtext COLLATE utf8_unicode_ci NOT NULL,
  `rationale` longtext COLLATE utf8_unicode_ci NOT NULL,
  `existing_control` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mitigation_action` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mitigation_outcome` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mitigation_trigger_point` longtext COLLATE utf8_unicode_ci NOT NULL,
  `cost` int(11) NOT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule` int(11) NOT NULL,
  `hse` int(11) NOT NULL,
  `others` int(11) NOT NULL,
  `likelihood` int(11) NOT NULL,
  `overall_impact` int(11) NOT NULL,
  `risk_rating` int(11) NOT NULL,
  `residual_likelihood` int(11) NOT NULL,
  `residual_impact` int(11) NOT NULL,
  `residual_rating` int(11) NOT NULL,
  `risk_category` enum('organizational','stakeholder','definition','technical') COLLATE utf8_unicode_ci NOT NULL,
  `response_strategy` enum('avoid','accept','transfer','share','mitigate') COLLATE utf8_unicode_ci NOT NULL,
  `mitigation_action_status` enum('pending','verified','closed') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('open','close') COLLATE utf8_unicode_ci NOT NULL,
  `action_due` datetime NOT NULL,
  `project_id` int(11) NOT NULL,
  `action_owner` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `risk`
--

INSERT INTO `risk` (`id`, `risk_event`, `direct_impact`, `rationale`, `existing_control`, `mitigation_action`, `mitigation_outcome`, `mitigation_trigger_point`, `cost`, `tag`, `schedule`, `hse`, `others`, `likelihood`, `overall_impact`, `risk_rating`, `residual_likelihood`, `residual_impact`, `residual_rating`, `risk_category`, `response_strategy`, `mitigation_action_status`, `status`, `action_due`, `project_id`, `action_owner`, `created_at`, `updated_at`) VALUES
(1, 'test risk ', '', '', '', '', '', '', 0, 'test', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'organizational', 'avoid', 'pending', 'open', '0000-00-00 00:00:00', 1, 0, '2016-12-20 00:15:16', '2016-12-21 23:08:02'),
(2, 'test2', '', '', '', '', '', '', 0, 'test', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'organizational', 'avoid', 'pending', 'open', '0000-00-00 00:00:00', 1, 0, '2016-12-20 23:35:55', '2016-12-20 23:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `risk_activity`
--

CREATE TABLE `risk_activity` (
  `id` int(10) UNSIGNED NOT NULL,
  `risk_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `risk_assessment`
--

CREATE TABLE `risk_assessment` (
  `id` int(10) UNSIGNED NOT NULL,
  `existing_control` longtext COLLATE utf8_unicode_ci NOT NULL,
  `assessment_cost` int(11) NOT NULL,
  `assessment_schedule` int(11) NOT NULL,
  `assessment_hse` int(11) NOT NULL,
  `assessment_others` int(11) NOT NULL,
  `assessment_likelihood` int(11) NOT NULL,
  `assessment_impact_rating` int(11) NOT NULL,
  `assessment_risk_rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `risk_mitigation`
--

CREATE TABLE `risk_mitigation` (
  `id` int(10) UNSIGNED NOT NULL,
  `mitigation_action` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mitigation_outcome` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mitigation_trigger_point` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mitigation_action_status` enum('pending','verified','closed') COLLATE utf8_unicode_ci NOT NULL,
  `mitigation_response_strategy` enum('avoid','accept','transfer','share','mitigate') COLLATE utf8_unicode_ci NOT NULL,
  `action_due` datetime NOT NULL,
  `mitigation_owner_id` int(11) NOT NULL,
  `risk_register_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `risk_register`
--

CREATE TABLE `risk_register` (
  `id` int(10) UNSIGNED NOT NULL,
  `risk_event` longtext COLLATE utf8_unicode_ci NOT NULL,
  `direct_impact` longtext COLLATE utf8_unicode_ci NOT NULL,
  `rationale` longtext COLLATE utf8_unicode_ci NOT NULL,
  `risk_category` enum('organizational','stakeholder','definition','technical') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('open','close') COLLATE utf8_unicode_ci NOT NULL,
  `action_due` datetime NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `risk_register_project_phase_activity`
--

CREATE TABLE `risk_register_project_phase_activity` (
  `id` int(10) UNSIGNED NOT NULL,
  `risk_register_id` int(11) NOT NULL,
  `project_phase_activity_id` int(11) NOT NULL,
  `assigned_by_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_profile`
--

CREATE TABLE `role_profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `access` int(11) NOT NULL,
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_profile_user`
--

CREATE TABLE `role_profile_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `expiry` date NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'q4EXVr7ocxoYnzWf', '2016-12-18 20:42:37', '2016-12-18 20:42:37', 1),
(2, '1neBzbUMVDcVYT2s', '2016-12-19 18:48:49', '2016-12-19 18:48:49', 1),
(3, 'PAY9bQmgAPBdzZcs', '2016-12-21 17:28:23', '2016-12-21 17:28:23', 1),
(4, 'c6iaCY6VSkvTSzwG', '2016-12-22 20:14:21', '2016-12-22 20:14:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resource_type_id` int(11) NOT NULL,
  `user_status_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL,
  `license_id` int(11) NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `forgot_password_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `profile_picture`, `full_name`, `email`, `resource_type_id`, `user_status_id`, `company_id`, `title_id`, `license_id`, `password_hash`, `forgot_password_token`, `created_at`, `updated_at`) VALUES
(1, '', 'Admin', 'admin@cjpengineering.com', 99, 0, 1, 1, 0, '123123123', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_attributes`
--

CREATE TABLE `user_attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_attributes_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_attributes`
--

INSERT INTO `user_attributes` (`id`, `value`, `user_id`, `user_attributes_type_id`) VALUES
(1, '0123456789', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_attributes_type`
--

CREATE TABLE `user_attributes_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `should_show` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_attributes_type`
--

INSERT INTO `user_attributes_type` (`id`, `name`, `type`, `should_show`) VALUES
(1, 'Primary Phone', 'string', 1),
(2, 'Secondary Phone', 'string', 1),
(3, 'Mailing Address', 'string', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_documentation`
--
ALTER TABLE `activity_documentation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_resources`
--
ALTER TABLE `activity_resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_standards`
--
ALTER TABLE `activity_standards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_standards_project_phase`
--
ALTER TABLE `activity_standards_project_phase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_business`
--
ALTER TABLE `config_business`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_company`
--
ALTER TABLE `config_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_company_type`
--
ALTER TABLE `config_company_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_contracting_mode`
--
ALTER TABLE `config_contracting_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_currency`
--
ALTER TABLE `config_currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_discipline`
--
ALTER TABLE `config_discipline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_elements`
--
ALTER TABLE `config_elements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_project_classification`
--
ALTER TABLE `config_project_classification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_project_date_type`
--
ALTER TABLE `config_project_date_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_project_plant_capacity`
--
ALTER TABLE `config_project_plant_capacity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_project_type`
--
ALTER TABLE `config_project_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_project_type_phase`
--
ALTER TABLE `config_project_type_phase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_title`
--
ALTER TABLE `config_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_user_status`
--
ALTER TABLE `config_user_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_issues`
--
ALTER TABLE `internal_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_issue_trails`
--
ALTER TABLE `internal_issue_trails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_projects`
--
ALTER TABLE `internal_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_project_trails`
--
ALTER TABLE `internal_project_trails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_tasks`
--
ALTER TABLE `internal_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_task_trails`
--
ALTER TABLE `internal_task_trails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `license`
--
ALTER TABLE `license`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_attribute`
--
ALTER TABLE `project_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_dates`
--
ALTER TABLE `project_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_phase`
--
ALTER TABLE `project_phase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_phase_activity`
--
ALTER TABLE `project_phase_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_phase_activity_pir`
--
ALTER TABLE `project_phase_activity_pir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_phase_activity_pll`
--
ALTER TABLE `project_phase_activity_pll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_phase_activity_pra`
--
ALTER TABLE `project_phase_activity_pra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_phase_gatekeepers`
--
ALTER TABLE `project_phase_gatekeepers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_plant_capacity_data`
--
ALTER TABLE `project_plant_capacity_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource_type`
--
ALTER TABLE `resource_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `risk`
--
ALTER TABLE `risk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `risk_activity`
--
ALTER TABLE `risk_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `risk_assessment`
--
ALTER TABLE `risk_assessment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `risk_mitigation`
--
ALTER TABLE `risk_mitigation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `risk_register`
--
ALTER TABLE `risk_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `risk_register_project_phase_activity`
--
ALTER TABLE `risk_register_project_phase_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_profile`
--
ALTER TABLE `role_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_profile_user`
--
ALTER TABLE `role_profile_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_attributes`
--
ALTER TABLE `user_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_attributes_type`
--
ALTER TABLE `user_attributes_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_documentation`
--
ALTER TABLE `activity_documentation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `activity_resources`
--
ALTER TABLE `activity_resources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `activity_standards`
--
ALTER TABLE `activity_standards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `activity_standards_project_phase`
--
ALTER TABLE `activity_standards_project_phase`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `config_business`
--
ALTER TABLE `config_business`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `config_company`
--
ALTER TABLE `config_company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `config_company_type`
--
ALTER TABLE `config_company_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `config_contracting_mode`
--
ALTER TABLE `config_contracting_mode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `config_currency`
--
ALTER TABLE `config_currency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `config_discipline`
--
ALTER TABLE `config_discipline`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `config_elements`
--
ALTER TABLE `config_elements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `config_project_classification`
--
ALTER TABLE `config_project_classification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `config_project_date_type`
--
ALTER TABLE `config_project_date_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `config_project_plant_capacity`
--
ALTER TABLE `config_project_plant_capacity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `config_project_type`
--
ALTER TABLE `config_project_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `config_project_type_phase`
--
ALTER TABLE `config_project_type_phase`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `config_title`
--
ALTER TABLE `config_title`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `config_user_status`
--
ALTER TABLE `config_user_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `internal_issues`
--
ALTER TABLE `internal_issues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `internal_issue_trails`
--
ALTER TABLE `internal_issue_trails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `internal_projects`
--
ALTER TABLE `internal_projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `internal_project_trails`
--
ALTER TABLE `internal_project_trails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `internal_tasks`
--
ALTER TABLE `internal_tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `internal_task_trails`
--
ALTER TABLE `internal_task_trails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `license`
--
ALTER TABLE `license`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `project_attribute`
--
ALTER TABLE `project_attribute`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_dates`
--
ALTER TABLE `project_dates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_phase`
--
ALTER TABLE `project_phase`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `project_phase_activity`
--
ALTER TABLE `project_phase_activity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `project_phase_activity_pir`
--
ALTER TABLE `project_phase_activity_pir`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_phase_activity_pll`
--
ALTER TABLE `project_phase_activity_pll`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_phase_activity_pra`
--
ALTER TABLE `project_phase_activity_pra`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `project_phase_gatekeepers`
--
ALTER TABLE `project_phase_gatekeepers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_plant_capacity_data`
--
ALTER TABLE `project_plant_capacity_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `project_user`
--
ALTER TABLE `project_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `resource_type`
--
ALTER TABLE `resource_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `risk`
--
ALTER TABLE `risk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `risk_activity`
--
ALTER TABLE `risk_activity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `risk_assessment`
--
ALTER TABLE `risk_assessment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `risk_mitigation`
--
ALTER TABLE `risk_mitigation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `risk_register`
--
ALTER TABLE `risk_register`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `risk_register_project_phase_activity`
--
ALTER TABLE `risk_register_project_phase_activity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role_profile`
--
ALTER TABLE `role_profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role_profile_user`
--
ALTER TABLE `role_profile_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_attributes`
--
ALTER TABLE `user_attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_attributes_type`
--
ALTER TABLE `user_attributes_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
