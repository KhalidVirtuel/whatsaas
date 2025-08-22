CREATE DATABASE IF NOT EXISTS es2im_site DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE es2im_site;

-- Utilisateurs (admin)
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  name VARCHAR(120) NOT NULL,
  role ENUM('admin') NOT NULL DEFAULT 'admin',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Leads (contact)
CREATE TABLE leads (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL,
  phone VARCHAR(40),
  message TEXT NOT NULL,
  source_page VARCHAR(255),
  ip VARBINARY(16),
  user_agent VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (email), INDEX (created_at)
) ENGINE=InnoDB;

-- Admissions (candidatures)
CREATE TABLE admissions (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  fullname VARCHAR(150) NOT NULL,
  email VARCHAR(190) NOT NULL,
  phone VARCHAR(40),
  program VARCHAR(150) NOT NULL,
  degree VARCHAR(120),
  bac_year VARCHAR(10),
  message TEXT,
  status ENUM('new','review','accepted','rejected') DEFAULT 'new',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (program), INDEX (created_at)
) ENGINE=InnoDB;

-- Newsletter
CREATE TABLE newsletter_subscribers (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(190) NOT NULL UNIQUE,
  subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Formations (courses)
CREATE TABLE courses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  slug VARCHAR(200) NOT NULL UNIQUE,
  level VARCHAR(100),
  duration VARCHAR(100),
  location VARCHAR(120),
  cover_url VARCHAR(255),
  description_md MEDIUMTEXT,
  prerequisites_md MEDIUMTEXT,
  outcomes_md MEDIUMTEXT,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Articles (actualités)
CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(220) NOT NULL,
  slug VARCHAR(220) NOT NULL UNIQUE,
  excerpt TEXT,
  cover_url VARCHAR(255),
  content_md MEDIUMTEXT,
  published_at DATETIME,
  status ENUM('draft','published') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (published_at)
) ENGINE=InnoDB;

-- Médias (optionnel)
CREATE TABLE media (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  original_url VARCHAR(255) NOT NULL,
  optimized_url VARCHAR(255),
  alt_text VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
