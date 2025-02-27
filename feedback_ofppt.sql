CREATE DATABASE feedback_ofppt;

USE feedback_ofppt;

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    formation VARCHAR(255),
    enseignant VARCHAR(255),
    infrastructure VARCHAR(255),
    commentaire TEXT
);
SELECT * FROM feedback; 
CREATE DATABASE IF NOT EXISTS feedback_ofppt;
USE feedback_ofppt;

CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    formation VARCHAR(50) NOT NULL,
    enseignant VARCHAR(50) NOT NULL,
    infrastructure VARCHAR(50) NOT NULL,
    commentaire TEXT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create feedback table
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    formation VARCHAR(50) NOT NULL,
    enseignant VARCHAR(50) NOT NULL,
    infrastructure VARCHAR(50) NOT NULL,
    commentaire TEXT,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Create feedback table
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    formation VARCHAR(50) NOT NULL,
    enseignant VARCHAR(50) NOT NULL,
    infrastructure VARCHAR(50) NOT NULL,
    commentaire TEXT,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
-- Insert a test user (password: test123)
INSERT INTO users (email, password, name) VALUES 
('test@ofppt.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Test User');