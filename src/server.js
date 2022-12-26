//const express = require('express');
import express from 'express';
import configViewEngine from './configs/viewEngine';
import initWebRoute from './route/web';
import connection from './configs/connectDB';
import initAPIRoute from './route/api';
const fileUpload = require('express-fileupload');
require('dotenv').config();

const app = express();
const port = process.env.PORT || 3005;

app.use(express.urlencoded({ extended: true }));
app.use(express.json());

configViewEngine(app);
initWebRoute(app);
initAPIRoute(app);

app.listen(port, () => {
    console.log(`Example app listening at http://localhost:${port}`)
})