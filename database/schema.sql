CREATE TABLE IF NOT EXISTS users
(
    id         INT UNSIGNED       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    handle     VARCHAR(15) UNIQUE NOT NULL,
    password   VARCHAR(255)       NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS posts
(
    id         INT UNSIGNED        NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id    INT UNSIGNED        NOT NULL,
    slug       VARCHAR(255) UNIQUE NOT NULL,
    title      VARCHAR(255)        NOT NULL,
    content    TEXT                NOT NULL,
    status     ENUM ('draft', 'published') DEFAULT 'draft',
    created_at DATETIME                    DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id)
);
