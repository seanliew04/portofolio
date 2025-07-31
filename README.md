# SEGI Portfolio Website

This is a personal portfolio website project built for SEGI College students. It showcases individual student profiles, skills, projects, and includes a contact form with database and email functionality.

---

## 📁 Project Structure

/portofolio
│
├── index.html # Ooi Jian Hen's homepage
├── about.html # About Me (Ooi Jian Hen)
├── skills.html # Skills & Projects (Ooi Jian Hen)
├── contact.php # Contact form with database + email
│
├── liew.html # Liew Zhi Xian's homepage
├── about-liew.html # About Me (Liew)
├── skills-liew.html # Skills & Projects (Liew)
├── contact-liew.php # Contact form for Liew
│
├── students.html # Landing page to choose which student profile to view
│
├── style.css # Shared styling
├── men.jpg / men2.jpg # Profile images
│
├── /phpmailer # PHPMailer library files
│ ├── PHPMailer.php
│ ├── SMTP.php
│ └── Exception.php
│
└── README.md
---

## ⚙️ Features

- 📄 Two separate student portfolios
- 📬 Contact forms that:
  - Store messages into **MySQL** databases
  - Send emails using **PHPMailer + Gmail SMTP**
- 📊 Message history displayed under contact form
- 🧑‍💻 Responsive layout using HTML, CSS (Poppins font)
- 🔐 Log Out button on each portfolio to return to the student selection screen

---

## 🧑‍💻 Technologies Used

- HTML5
- CSS3
- PHP (XAMPP for local dev)
- MySQL
- PHPMailer (SMTP)
- Gmail App Password for email sending

---

## 📦 Setup Instructions

1. **Install XAMPP** and start `Apache` and `MySQL`.
2. Place project folder inside `htdocs`.
3. Create the following databases:

### ➤ `portfolio`
```sql
CREATE DATABASE portfolio;
USE portfolio;
CREATE TABLE contact_messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  message TEXT NOT NULL,
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
