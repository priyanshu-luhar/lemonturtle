-- **************************************************************************************
-- SQLITE3 file for Lemon Turtle
-- Spring 2025
-- AUTH: Luhar, Priyanshu pluhar@csub.edu
-- DATE: Mar 27, 2025

-- **************************************************************************************
-- TABLES

CREATE TABLE IF NOT EXISTS person (
    userID integer primary key autoincrement,
    fname text,
    lname text,
    email text not null,
    hash text not null,
    profileimg text default "../img/default.png",
    openTime datetime default CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS api (
    apiNo integer primary key autoincrement,
    userID integer,
    url text,
    response blob default null CHECK (length(response) <= 40000),
    foreign key (userID) references person(userID) on update cascade on delete set null
);

CREATE TABLE IF NOT EXISTS usession (
    sessionID integer primary key autoincrement,
    userID integer,
    startTime datetime default CURRENT_TIMESTAMP,
    endTime datetime default CURRENT_TIMESTAMP,
    foreign key (userID) references person(userID) on update cascade on delete set null
);

CREATE TABLE IF NOT EXISTS sessionApi (
    sessionID integer primary key,
    apiNo integer,
    foreign key (sessionID) references usession(sessionID) on update cascade on delete set null
    foreign key (apiNo) references api(apiNo) on update cascade on delete set null

);

CREATE TABLE IF NOT EXISTS ipMap (
    ipMapID integer primary key autoincrement,
    userID integer,
    url text,
    ipAddr text,
    lat real,
    lng real,
    hopNo integer,
    foreign key (userID) references person(userID) on update cascade on delete set null
);


CREATE TABLE IF NOT EXISTS website (
    websiteID integer primary key autoincrement,
    url text not null,
    name text,
    category text not null,
    addedBy integer,
    description blob default null CHECK (length(description) <= 255),
    foreign key (addedBy) references person(userID) on update cascade on delete set null
);

-- **************************************************************************************
-- DEMO DATA

-- **************************************************************************************
-- FLAGS

PRAGMA foreign_keys = ON;
