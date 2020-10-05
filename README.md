
# Comp440 Team 5 Project1

This branch is created and contributed by Zhen Sun. 

---

## How to start

1. Execute the following SQL query to create the users table inside your MySQL database.

```sql
CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)
```

2. Change `config.php` file with your Database info. 

3. Open SQL service and open localhost. 

---
## Features

This project saves hashed password on database to make a more secure login. 

Also, it checks whether a user name is taken and warning when password is too short.
