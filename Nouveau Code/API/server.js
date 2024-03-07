const express = require('express');
const mysql = require("mysql");
const app = express();
const login = require("./login");

login("test");

const connection = mysql.createConnection({
    host : 'localhost',
    user : 'journalltrpedago',
    password : 'Pedago1234',
    database : 'journalltrpedago'
});