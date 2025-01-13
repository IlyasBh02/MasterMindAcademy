-- Créer la base de données
CREATE DATABASE IF NOT EXISTS youdemy;

-- Sélectionner la base de données
USE youdemy;

-- Création des tables

-- Table des utilisateurs (users)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'teacher', 'student') NOT NULL,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des cours (courses)
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    teacher_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table des réservations (reservations)
CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    student_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table des catégories (categories)
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

-- Table de jointure pour Cours et Catégories (course_categories)
CREATE TABLE IF NOT EXISTS course_categories (
    course_id INT,
    category_id INT,
    PRIMARY KEY (course_id, category_id),
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Table des tags (tags)
CREATE TABLE IF NOT EXISTS tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

-- Table de jointure pour Cours et Tags (course_tags)
CREATE TABLE IF NOT EXISTS course_tags (
    course_id INT,
    tag_id INT,
    PRIMARY KEY (course_id, tag_id),
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

-- Table des messages (messages)
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT,
    receiver_id INT,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insertion des données initiales

-- Insertion des utilisateurs (admin, teacher, student)
INSERT INTO users (email, password, role, first_name, last_name)
VALUES
    ('ilyas@bahsi.com', '2468', 'admin', 'ilyas', 'bahsi'),
    ('teacher@example.com', 'teacherpassword', 'teacher', 'John', 'Doe'),
    ('student@example.com', 'studentpassword', 'student', 'Jane', 'Smith');

-- Insertion des catégories
INSERT INTO categories (name) VALUES
    ('Development'),
    ('Design'),
    ('Marketing');

-- Insertion des tags
INSERT INTO tags (name) VALUES
    ('PHP'),
    ('JavaScript'),
    ('CSS');

-- Insertion des cours
INSERT INTO courses (title, description, teacher_id) VALUES
    ('PHP for Beginners', 'Learn PHP from scratch', 2),
    ('Advanced JavaScript', 'Master JavaScript techniques', 2);

-- Insertion des réservations
INSERT INTO reservations (course_id, student_id) VALUES
    (1, 3);
