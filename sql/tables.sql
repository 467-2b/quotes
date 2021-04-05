# Run this SQL script to create the tables needed for a MySQL database
# Usage: mysql < ./tables.sql

# Cleanup
\! echo "Dropping tables if they exist..."
DROP TABLE IF EXISTS `order`, `note`, `line_item`, `quote`, `role`, `user`;
\! echo "...done!"

# Create tables
\! echo "Creating tables:"
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(191) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) DEFAULT '',
    accumulated_comission DECIMAL(9,2) DEFAULT 0.00
);
\! echo " * user"

CREATE TABLE role (
    user_id INT NOT NULL,
    role ENUM('admin', 'associate', 'clerk') NOT NULL,
    PRIMARY KEY(user_id, role),
    FOREIGN KEY (user_id) REFERENCES user(id)
);
\! echo " * role"

CREATE TABLE quote (
    id INT AUTO_INCREMENT PRIMARY KEY,
    associate_id INT NOT NULL,
    customer_id INT NOT NULL,
    status ENUM ('unsanctioned', 'sanctioned', 'processed') DEFAULT 'unsanctioned',
    FOREIGN KEY (associate_id) REFERENCES user(id)
    # customer_id references a table attribute, *customer(id)*, in another database, *csci467*,
    # so it is not a foreign key in in the table schema, but will be managed by the application instead
);
\! echo " * quote"

CREATE TABLE line_item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quote_id INT NOT NULL,
    description VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (quote_id) REFERENCES quote(id)
);
\! echo " * line_item"

CREATE TABLE note (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quote_id INT NOT NULL,
    secret BOOLEAN DEFAULT false,
    text TEXT DEFAULT '',
    FOREIGN KEY(quote_id) REFERENCES quote(id)
);
\! echo " * note"

CREATE TABLE `order` (
    id VARCHAR(50) PRIMARY KEY,
    quote_id INT NOT NULL,
    processed_timestamp TIMESTAMP NOT NULL,
    FOREIGN KEY(quote_id) REFERENCES quote(id)
);
\! echo " * order"

\! echo "...done!"
