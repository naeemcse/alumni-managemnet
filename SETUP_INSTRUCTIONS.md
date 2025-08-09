# Setup Instructions for Alumni Registration System

## Database Setup

1. **Open phpMyAdmin** by going to `http://localhost/phpmyadmin/`

2. **Select your database** `alumni123`

3. **Run this SQL query** to create the Running Students table:

```sql
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
```

## System Features

### 1. **Registration System** (`signup.php`)
- **Type Selection**: Choose between Alumni or Running Student
- **Alumni Form**: Name, Email, Contact, Student ID, Passing Year, Company, Job Title, Photo
- **Student Form**: Name, Email, Contact, Student ID, Semester, Academic Year, GPA, Photo
- **Features**: Form validation, duplicate checking, secure image upload

### 2. **Alumni Directory** (`alumni.php`)
- **View All Alumni**: Complete list of graduated students
- **Advanced Search**: Search by name, email, company, job title, passing year, etc.
- **Column Filters**: Filter by specific fields
- **Actions**: View and edit alumni profiles
- **Responsive Design**: Works on all devices

### 3. **Students Directory** (`students.php`)
- **View All Students**: Complete list of current students  
- **Advanced Search**: Search by name, email, student ID, semester, etc.
- **Column Filters**: Filter by specific fields
- **GPA Display**: Shows student academic performance
- **Actions**: View and edit student profiles

### 4. **Quick Search Portal** (`search.php`)
- **Landing Page**: Choose between Alumni or Student directories
- **Quick Actions**: Register new members or return to home
- **Modern UI**: Clean, intuitive interface

## Navigation Structure

- **Home** (`index.php`) - Main landing page with carousels
- **Alumni Directory** (`alumni.php`) - Complete alumni database
- **Running Students** (`students.php`) - Current students database  
- **Quick Search** (`search.php`) - Search portal landing page
- **Sign Up** (`signup.php`) - Registration for new members

## Key Features

### ✅ **Search & Filter Capabilities**
- **Global Search**: Search across all fields
- **Column-Specific Filters**: Target specific data fields
- **Real-time Results**: Instant search results
- **No Results Handling**: Clear messaging when no matches found

### ✅ **User Experience**
- **Responsive Design**: Mobile, tablet, and desktop optimized
- **Modern UI**: Clean, professional appearance
- **Fast Performance**: Efficient database queries
- **Intuitive Navigation**: Easy to use interface

### ✅ **Data Management**
- **Separate Tables**: Alumni and Students have dedicated tables
- **Image Handling**: Secure photo upload and display
- **Data Validation**: Prevents duplicate entries
- **Error Handling**: Comprehensive error management

## File Structure
```
alumni/
├── index.php              # Main homepage
├── signup.php             # Registration portal  
├── alumni.php             # Alumni directory
├── students.php           # Students directory
├── search.php             # Search portal
├── process_registration.php # Form processing
├── css/
│   ├── style.css          # Main styles
│   ├── signup.css         # Registration styles
│   └── directory.css      # Directory pages styles
├── includes/
│   ├── header.php         # Common header
│   └── footer.php         # Common footer
└── images/                # Uploaded photos
```

## Testing
1. **Create Database Table**: Run the SQL query above
2. **Register Users**: Test both Alumni and Student registration
3. **View Directories**: Check `alumni.php` and `students.php`
4. **Test Search**: Try various search terms and filters
5. **Test Responsiveness**: Check on different screen sizes
