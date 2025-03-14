
CREATE TABLE Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    role ENUM('student', 'teacher') NOT NULL
);

CREATE TABLE Exam (
    exam_id INT PRIMARY KEY AUTO_INCREMENT,
    teacher_id INT,
    title VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    finished_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES Users(user_id)
);

CREATE TABLE Question (
    question_id INT PRIMARY KEY AUTO_INCREMENT,
    exam_id INT,
    content TEXT NOT NULL,
    question_type ENUM('MCQ') NOT NULL,
    FOREIGN KEY (exam_id) REFERENCES Exam(exam_id)
);

CREATE TABLE Answer (
    answer_id INT PRIMARY KEY AUTO_INCREMENT,
    question_id INT,
    answer_option ENUM('A', 'B', 'C', 'D') NOT NULL,
    answer_text TEXT NOT NULL,
    is_correct BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (question_id) REFERENCES Question(question_id)
);


CREATE TABLE Student_Exam (
    student_exam_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    exam_id INT,
    score FLOAT,
    completed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES Users(user_id),
    FOREIGN KEY (exam_id) REFERENCES Exam(exam_id)
);
