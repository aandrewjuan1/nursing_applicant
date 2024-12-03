CREATE DATABASE applicant_management;

USE applicant_management;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE, -- Unique username for login
    email VARCHAR(100) NOT NULL UNIQUE, -- User's email for communication/login
    password_hash VARCHAR(255) NOT NULL, -- Password stored as a secure hash
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE applicants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    birth_date DATE NOT NULL,
    gender VARCHAR(50) NOT NULL,
    email_address VARCHAR(255) NOT NULL,
    phone_number VARCHAR(50) NOT NULL,
    applied_position VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    address TEXT NOT NULL,
    nationality VARCHAR(100) NOT NULL
);

CREATE TABLE activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(255), -- Email of the user performing the action
    action_type ENUM('INSERT', 'UPDATE', 'DELETE', 'SEARCH') NOT NULL, -- Type of activity
    record_id INT, -- ID of the record that was affected
    search_keywords TEXT, -- If action_type is SEARCH, store the searched keywords
    action_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- When the action occurred
    FOREIGN KEY (user_email) REFERENCES users(email) ON DELETE CASCADE
);


INSERT INTO applicants (username, first_name, last_name, birth_date, gender, email_address, phone_number, applied_position, start_date, address, nationality)
VALUES
('john_doe', 'John', 'Doe', '1990-05-15', 'Male', 'johndoe@example.com', '123-456-7890', 'Software Engineer', '2024-01-15', '123 Elm Street, Springfield, IL', 'American'),
('jane_smith', 'Jane', 'Smith', '1992-07-22', 'Female', 'janesmith@example.com', '234-567-8901', 'Data Scientist', '2024-02-01', '456 Oak Avenue, Chicago, IL', 'American'),
('alex_jones', 'Alex', 'Jones', '1985-12-30', 'Male', 'alexjones@example.com', '345-678-9012', 'Marketing Manager', '2024-03-10', '789 Pine Road, Dallas, TX', 'American'),
('maria_garcia', 'Maria', 'Garcia', '1994-03-18', 'Female', 'mariagarcia@example.com', '456-789-0123', 'HR Specialist', '2024-01-20', '101 Maple Street, Miami, FL', 'American'),
('li_wei', 'Li', 'Wei', '1988-09-10', 'Male', 'liwei@example.com', '567-890-1234', 'Product Manager', '2024-02-05', '202 Bamboo Lane, San Francisco, CA', 'Chinese'),
('emily_davis', 'Emily', 'Davis', '1991-06-14', 'Female', 'emilydavis@example.com', '678-901-2345', 'UX Designer', '2024-04-10', '303 Cedar Drive, Austin, TX', 'American'),
('michael_wilson', 'Michael', 'Wilson', '1987-11-23', 'Male', 'michaelwilson@example.com', '789-012-3456', 'Financial Analyst', '2024-01-25', '404 Birch Boulevard, Seattle, WA', 'American'),
('susan_lee', 'Susan', 'Lee', '1993-01-11', 'Female', 'susanlee@example.com', '890-123-4567', 'Software Developer', '2024-02-20', '505 Willow Street, Boston, MA', 'American'),
('robert_martin', 'Robert', 'Martin', '1990-10-30', 'Male', 'robertmartin@example.com', '901-234-5678', 'IT Support Specialist', '2024-03-01', '606 Maple Avenue, Phoenix, AZ', 'American'),
('olivia_thompson', 'Olivia', 'Thompson', '1992-04-17', 'Female', 'oliviathompson@example.com', '012-345-6789', 'Graphic Designer', '2024-01-15', '707 Pine Street, Denver, CO', 'American'),
('peter_brown', 'Peter', 'Brown', '1986-08-09', 'Male', 'peterbrown@example.com', '123-456-7890', 'Content Writer', '2024-03-05', '808 Oak Street, Atlanta, GA', 'American'),
('sarah_miller', 'Sarah', 'Miller', '1995-12-25', 'Female', 'sarahmiller@example.com', '234-567-8901', 'Operations Manager', '2024-04-01', '909 Elm Road, Houston, TX', 'American'),
('david_clark', 'David', 'Clark', '1984-05-06', 'Male', 'davidclark@example.com', '345-678-9012', 'Business Analyst', '2024-02-28', '1010 Maple Drive, New York, NY', 'American'),
('chloe_wilson', 'Chloe', 'Wilson', '1996-02-20', 'Female', 'chloewilson@example.com', '456-789-0123', 'Digital Marketing Specialist', '2024-03-15', '1111 Birch Avenue, Los Angeles, CA', 'American'),
('daniel_moore', 'Daniel', 'Moore', '1989-11-11', 'Male', 'danielmoore@example.com', '567-890-1234', 'Network Engineer', '2024-01-10', '1212 Cedar Street, Orlando, FL', 'American'),
('katherine_rodgers', 'Katherine', 'Rodgers', '1994-03-25', 'Female', 'katherinerodgers@example.com', '678-901-2345', 'Accountant', '2024-04-05', '1313 Pine Drive, Tampa, FL', 'American'),
('andrew_scott', 'Andrew', 'Scott', '1983-12-05', 'Male', 'andrewscott@example.com', '789-012-3456', 'Senior Developer', '2024-01-15', '1414 Oak Boulevard, San Diego, CA', 'American'),
('ella_hall', 'Ella', 'Hall', '1992-09-13', 'Female', 'ellahall@example.com', '890-123-4567', 'Product Designer', '2024-02-10', '1515 Maple Street, San Jose, CA', 'American'),
('sebastian_king', 'Sebastian', 'King', '1987-10-18', 'Male', 'sebastianking@example.com', '901-234-5678', 'Software Engineer', '2024-01-05', '1616 Birch Road, Portland, OR', 'American'),
('lucy_jackson', 'Lucy', 'Jackson', '1991-01-30', 'Female', 'lucyjackson@example.com', '012-345-6789', 'Project Manager', '2024-03-25', '1717 Cedar Avenue, Charlotte, NC', 'American');
