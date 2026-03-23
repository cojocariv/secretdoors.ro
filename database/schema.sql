CREATE DATABASE IF NOT EXISTS secretdoors CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE secretdoors;

CREATE TABLE categorii (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(120) NOT NULL UNIQUE
);

CREATE TABLE produse (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categorie_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(180) NOT NULL UNIQUE,
    short_description TEXT NOT NULL,
    technical_specs TEXT,
    price DECIMAL(10,2) NOT NULL DEFAULT 0,
    finish VARCHAR(100),
    dimensions VARCHAR(100),
    image_url VARCHAR(255),
    position INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categorie_id) REFERENCES categorii(id) ON DELETE CASCADE
);

CREATE TABLE proiecte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    slug VARCHAR(180) NOT NULL UNIQUE,
    summary TEXT NOT NULL,
    project_type ENUM('rezidential','comercial') NOT NULL,
    image_url VARCHAR(255),
    gallery_json JSON,
    position INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE articole (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    excerpt TEXT NOT NULL,
    body LONGTEXT NOT NULL,
    cover_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE mesaje_contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(160) NOT NULL,
    phone VARCHAR(30),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
