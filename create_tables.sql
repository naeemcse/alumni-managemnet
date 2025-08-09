-- SQL to create the Running Students table
CREATE TABLE IF NOT EXISTS RunningStudents (
    sid INT AUTO_INCREMENT PRIMARY KEY,
    s_image VARCHAR(255),
    sname VARCHAR(100) NOT NULL,
    s2name VARCHAR(100) NOT NULL,
    semail VARCHAR(150) NOT NULL UNIQUE,
    scontact VARCHAR(20),
    ssemester VARCHAR(20),
    syear VARCHAR(10),
    sdepartment VARCHAR(100) DEFAULT 'CSE',
    sgpa DECIMAL(4,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- You can run this SQL in phpMyAdmin or MySQL command line
