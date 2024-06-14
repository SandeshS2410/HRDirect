CREATE TABLE employees (
    EmployeeID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100),
    Email VARCHAR(100),
    Password VARCHAR(255),
    -- Add other columns as needed (e.g., Department, Position, Salary)
    UNIQUE (Email)
);
