import express from "express";
import homeController from "../controller/homeController";
import multer from "multer";
import path from 'path';
import fileUpload from "express-fileupload";
const util = require("util");
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

const initWebRoute = (app) => {
    router.get('/', homeController.getHomepage);

    router.get('/sanpham/lietke/', homeController.lietkesp);
    router.get('/sanpham/sua/:id', homeController.getsuaSanpham);
    router.get('/sanpham/them/', homeController.getThemsp);
    router.post('/sanpham/themsp', upload.single(`hinhanh`), homeController.themSanpham);
    router.post('/sanpham/delete/', homeController.xoaSanpham);
    router.post('/sanpham/suasp/', upload.single(`hinhanh`), homeController.suaSanpham);

    router.get('/danhmucsanpham/lietke/', homeController.lietkeDmsp);
    router.get('/danhmucsanpham/sua/:id', homeController.getsuaDmSanpham);
    router.get('/danhmucsanpham/them/', homeController.getDmThemsp);
    router.post('/danhmucsanpham/themsp/', homeController.themDmSanpham);
    router.post('/danhmucsanpham/delete/', homeController.xoaDmSanpham);
    router.post('/danhmucsanpham/suasp/', homeController.suaDmSanpham);

    router.get('/danhmucbaiviet/lietke/', homeController.lietkeDmbv);
    router.get('/danhmucbaiviet/sua/:id', homeController.getsuaDmbaiviet);
    router.get('/danhmucbaiviet/them/', homeController.getDmThembv);
    router.post('/danhmucbaiviet/thembv/', homeController.themDmbaiviet);
    router.post('/danhmucbaiviet/delete/', homeController.xoaDmbaiviet);
    router.post('/danhmucbaiviet/suabv/', homeController.suaDmbaiviet);

    router.get('/baiviet/lietke/', homeController.lietkebv);
    router.get('/baiviet/sua/:id', homeController.getsuabaiviet);
    router.get('/baiviet/them/', homeController.getThembv);
    router.post('/baiviet/thembv/', upload.single(`hinhanh`), homeController.thembaiviet);
    router.post('/baiviet/delete/', homeController.xoabaiviet);
    router.post('/baiviet/suabv/', upload.single(`hinhanh`), homeController.suabaiviet);

    router.get('/donhang/lietke/', homeController.lietkedonhang);
    router.get('/donhang/xem/:id', homeController.xemdonhang);

    return app.use('/', router)

}

module.exports = initWebRoute;