-- Create table for Running Students
USE alumni123;

CREATE TABLE IF NOT EXISTS RunningStudents (
    sid INT AUTO_INCREMENT PRIMARY KEY,
    s_image VARCHAR(255),
    sname VARCHAR(100) NOT NULL,
    s2name VARCHAR(100) NOT NULL,
    semail VARCHAR(150) UNIQUE NOT NULL,
    scontact VARCHAR(20) NOT NULL,
    ssemester VARCHAR(20) NOT NULL,
    syear VARCHAR(20) NOT NULL,
    student_id VARCHAR(50) UNIQUE NOT NULL,
    sgpa DECIMAL(3,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Show table structure
DESCRIBE RunningStudents;
