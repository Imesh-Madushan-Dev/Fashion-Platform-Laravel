-- Fashion Platform Database Schema
-- Run this SQL in phpMyAdmin or MySQL command line

-- Create database
CREATE DATABASE IF NOT EXISTS fashion_platform;
USE fashion_platform;

-- Designers table
CREATE TABLE designers (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Buyers table
CREATE TABLE buyers (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Designs table
CREATE TABLE designs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    designer_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_path VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (designer_id) REFERENCES designers(id) ON DELETE CASCADE
);

-- Orders table
CREATE TABLE orders (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    buyer_id BIGINT UNSIGNED NOT NULL,
    design_id BIGINT UNSIGNED NOT NULL,
    status ENUM('pending', 'paid') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (buyer_id) REFERENCES buyers(id) ON DELETE CASCADE,
    FOREIGN KEY (design_id) REFERENCES designs(id) ON DELETE CASCADE
);

-- Create indexes for better performance
CREATE INDEX idx_designs_designer_id ON designs(designer_id);
CREATE INDEX idx_orders_buyer_id ON orders(buyer_id);
CREATE INDEX idx_orders_design_id ON orders(design_id);
CREATE INDEX idx_orders_status ON orders(status);