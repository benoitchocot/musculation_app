-- database.sql
CREATE TABLE sessions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT
);

CREATE TABLE exercises (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    session_id INTEGER NOT NULL,
    title TEXT NOT NULL,
    description TEXT,
    photo TEXT,
    FOREIGN KEY (session_id) REFERENCES sessions(id)
);

CREATE TABLE exercise_entries (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    exercise_id INTEGER NOT NULL,
    date TEXT NOT NULL,
    weight DECIMAL NOT NULL,
    repetitions INTEGER NOT NULL,
    FOREIGN KEY (exercise_id) REFERENCES exercises(id)
);
