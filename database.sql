-- database.sql
CREATE TABLE sessions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT
);

CREATE TABLE exercises (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    session_id INTEGER NOT NULL,
    photo TEXT,
    title TEXT NOT NULL,
    weight DECIMAL NOT NULL,
    repetitions INTEGER NOT NULL,
    FOREIGN KEY (session_id) REFERENCES sessions(id)
);
