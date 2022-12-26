import express from "express";
import APIController from '../controller/APIController';
import multer from "multer";
import path from 'path';
import fileUpload from "express-fileupload";
let router = express.Router();
var appRoot = require('app-root-path');

const app = express();
app.use(fileUpload());
app.use(express.static('public'));

const storage = multer.diskStorage({
    destination: function (req, file, cb) {

        cb(null, appRoot + "/src/public/image/");
    },

    // By default, multer removes file extensions so let's add them back
    filename: function (req, file, cb) {

        cb(null, file.fieldname + '-' + Date.now() + path.extname(file.originalname));
    }
});

const imageFilter = function (req, file, cb) {
    // Accept images only
    if (!file.originalname.match(/\.(jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF)$/)) {
        req.fileValidationError = 'Only image files are allowed!';
        return cb(new Error('Only image files are allowed!'), false);
    }
    cb(null, true);
};

let upload = multer({ storage: storage, fileFilter: imageFilter });

const initAPIRoute = (app) => {
    router.get('/sanpham', APIController.getAllSanpham);
    router.post('/themsanpham', upload.single(`hinhanh`), APIController.themSanpham);
    router.put('/suasanpham', upload.single(`hinhanh`), APIController.suaSanpham);
    router.delete('/xoasanpham/:id', APIController.xoaSanpham);
    ;

    return app.use('/api/v1', router)

}

module.exports = initAPIRoute;