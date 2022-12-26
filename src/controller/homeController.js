import pool from "../configs/connectDB";
import connection from "../configs/connectDB";
import multer from 'multer';
import fileUpload from "express-fileupload";
const uploadFile = require("../middleware/upload");
var fs = require('fs');
let getHomepage = async (req, res) => {
    let data = []
    const [rows, fields] = await pool.execute(`SELECT tbl_danhmuc.id_danhmuc,tbl_danhmuc.tendanhmuc,COUNT(*) AS 'soluong',
    MAX(tbl_sanpham.giasp) AS 'giacao',
    MIN(tbl_sanpham.giasp) AS 'giathap',
    AVG(tbl_sanpham.giasp) AS 'giatrungbinh'
    FROM tbl_danhmuc 
    JOIN tbl_sanpham on tbl_danhmuc.id_danhmuc=tbl_sanpham.id_danhmuc
    GROUP BY tbl_danhmuc.id_danhmuc,tbl_danhmuc.tendanhmuc`);
    var xValues = []; var yValues = [];
    for (let i = 0; i < rows.length; i++) {
        xValues.push(rows[i].tendanhmuc);
        yValues.push(rows[i].soluong);
    }
    return res.render('home.ejs', { sanpham: rows, xValues: xValues, yValues: yValues })
}

// San pham
let lietkesp = async (req, res) => {
    var page = parseInt(req.query.page) || 1;
    var perPage = 5;
    var start = (page - 1) * perPage;
    var end = page * perPage;

    const [rows, fields] = await pool.execute(`SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc ORDER BY id_sanpham DESC LIMIT ${start},5`);
    const [rows_sp, fields_sp] = await pool.execute(`SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc ORDER BY id_sanpham DESC `);
    var trang = Math.ceil(rows_sp.length / 5)

    return res.render('sanpham/lietke.ejs', { sanpham: rows, trang: trang })



}

let getsuaSanpham = async (req, res) => {
    let id = req.params.id;
    let [sp] = await pool.execute(`SELECT * FROM tbl_sanpham,tbl_danhmuc where tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc and id_sanpham=? `, [id]);
    let [danhmucsp] = await pool.execute(`SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC`);

    return res.render('sanpham/sua.ejs', { sanpham: sp[0], danhmucsp: danhmucsp })

}

let getThemsp = async (req, res) => {
    let [danhmucsp] = await pool.execute(`SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC`);
    return res.render('sanpham/them.ejs', { danhmucsp: danhmucsp })
}


let themSanpham = async (req, res) => {

    if (req.fileValidationError) {

        return res.send(req.fileValidationError);
    }
    else if (!req.file) {
        return res.send('Please select an image to upload');
    }

    let hinhanh = req.file.filename
    let { tensanpham, masp, giasp, soluong, tomtat, noidung, tinhtrang, danhmuc } = req.body;
    await pool.execute('insert into tbl_sanpham(tensanpham,masp,giasp,soluong,hinhanh,tomtat,noidung,tinhtrang,id_danhmuc) VALUE(?,?,?,?,?,?,?,?,?)',
        [tensanpham, masp, giasp, soluong, hinhanh, tomtat, noidung, tinhtrang, danhmuc]);
    return res.redirect('lietke',)
}

let xoaSanpham = async (req, res) => {
    let id_sanpham = req.body.id_sanpham
    const [rows, fields] = await pool.execute('SELECT * FROM tbl_sanpham WHERE id_sanpham = ?', [id_sanpham]);
    let path = `D:/Xampp/htdocs/Nodejs/src/public/image/${rows[0].hinhanh}`;
    fs.unlinkSync(path);
    await pool.execute('delete from tbl_sanpham where id_sanpham=?', [id_sanpham]);
    return res.redirect('/')
}

let suaSanpham = async (req, res) => {
    if (req.fileValidationError) {

        return res.send(req.fileValidationError);
    }
    else if (!req.file) {
        let { tensanpham, masp, giasp, soluong, tomtat, noidung, tinhtrang, danhmuc, id_sanpham } = req.body;
        await pool.execute('update tbl_sanpham set tensanpham=?,masp= ?,giasp= ?,soluong= ?,tomtat= ?,noidung= ?,tinhtrang= ?,id_danhmuc= ? where id_sanpham=?',
            [tensanpham, masp, giasp, soluong, tomtat, noidung, tinhtrang, danhmuc, id_sanpham]);
        return res.redirect('lietke')
    } else if (req.file) {
        let { tensanpham, masp, giasp, soluong, tomtat, noidung, tinhtrang, danhmuc, id_sanpham } = req.body;
        const [rows, fields] = await pool.execute('SELECT * FROM tbl_sanpham WHERE id_sanpham = ?', [id_sanpham]);

        let path = `D:/Xampp/htdocs/Nodejs/src/public/image/${rows[0].hinhanh}`;
        fs.unlinkSync(path);

        let hinhanh = req.file.filename
        await pool.execute('update tbl_sanpham set tensanpham=?,masp= ?,giasp= ?,soluong= ?,hinhanh= ?,tomtat= ?,noidung= ?,tinhtrang= ?,id_danhmuc= ? where id_sanpham=?',
            [tensanpham, masp, giasp, soluong, hinhanh, tomtat, noidung, tinhtrang, danhmuc, id_sanpham]);
        return res.redirect('lietke')
    }


}

// Danh muc san pham
let lietkeDmsp = async (req, res) => {
    const [rows, fields] = await pool.execute('SELECT * FROM tbl_danhmuc  ORDER BY id_danhmuc DESC ');
    return res.render('danhmucsp/lietke.ejs', { danhmucsp: rows })
}

let getsuaDmSanpham = async (req, res) => {
    let id = req.params.id;
    let [sp] = await pool.execute(`SELECT * FROM tbl_danhmuc where id_danhmuc=?`, [id]);
    return res.render('danhmucsp/sua.ejs', { danhmucsp: sp[0] })

}

let getDmThemsp = async (req, res) => {
    return res.render('danhmucsp/them.ejs')
}

let themDmSanpham = async (req, res) => {
    let { tendanhmuc } = req.body;
    await pool.execute('insert into tbl_danhmuc(tendanhmuc) VALUE(?)',
        [tendanhmuc]);
    return res.redirect('lietke')
}

let xoaDmSanpham = async (req, res) => {
    let id_danhmuc = req.body.id_danhmuc
    await pool.execute('delete from tbl_danhmuc where id_danhmuc=?', [id_danhmuc]);
    return res.redirect('/lietke')
}

let suaDmSanpham = async (req, res) => {
    let { id_danhmuc, tendanhmuc } = req.body;
    await pool.execute('update tbl_danhmuc set tendanhmuc= ? where id_danhmuc=?',
        [tendanhmuc, id_danhmuc]);
    return res.redirect('lietke')
}

//Danh muc bai viet
let lietkeDmbv = async (req, res) => {
    const [rows, fields] = await pool.execute('SELECT * FROM tbl_danhmucbaiviet  ORDER BY id_baiviet DESC ');
    return res.render('danhmucbaiviet/lietke.ejs', { danhmucbv: rows })
}

let getsuaDmbaiviet = async (req, res) => {
    let id = req.params.id;
    let [bv] = await pool.execute(`SELECT * FROM tbl_danhmucbaiviet where id_baiviet=?`, [id]);
    return res.render('danhmucbaiviet/sua.ejs', { danhmucbv: bv[0] })

}

let getDmThembv = async (req, res) => {
    return res.render('danhmucbaiviet/them.ejs')
}

let themDmbaiviet = async (req, res) => {
    let { tendanhmuc } = req.body;
    await pool.execute('insert into tbl_danhmucbaiviet(tendanhmuc_baiviet) VALUE(?)',
        [tendanhmuc]);
    return res.redirect('lietke')
}

let xoaDmbaiviet = async (req, res) => {
    let id_danhmuc = req.body.id_danhmuc
    await pool.execute('delete from tbl_danhmuc where id_baiviet=?', [id_danhmuc]);
    return res.redirect('/')
}

let suaDmbaiviet = async (req, res) => {
    let { id_danhmuc, tendanhmuc } = req.body;
    await pool.execute('update tbl_danhmucbaiviet set tendanhmuc_baiviet= ? where id_baiviet=?',
        [tendanhmuc, id_danhmuc]);
    return res.redirect('lietke')
}

//Bai viet
let lietkebv = async (req, res) => {
    var page = parseInt(req.query.page) || 1;
    var perPage = 5;
    var start = (page - 1) * perPage;
    var end = page * perPage;
    const [rows_bv, fields_sp] = await pool.execute(`SELECT * FROM tbl_baiviet,tbl_danhmucbaiviet WHERE tbl_baiviet.id_danhmuc=tbl_danhmucbaiviet.id_baiviet ORDER BY tbl_baiviet.id DESC `);
    var trang = Math.ceil(rows_bv.length / 5)
    const [rows, fields] = await pool.execute(`SELECT * FROM tbl_baiviet,tbl_danhmucbaiviet WHERE tbl_baiviet.id_danhmuc=tbl_danhmucbaiviet.id_baiviet ORDER BY tbl_baiviet.id DESC LIMIT ${start},5`);
    return res.render('baiviet/lietke.ejs', { baiviet: rows, trang: trang })

}

let getsuabaiviet = async (req, res) => {
    let id = req.params.id;
    let [bv] = await pool.execute(`SELECT * FROM tbl_baiviet,tbl_danhmucbaiviet where id=? `, [id]);
    let [danhmucbv] = await pool.execute(`SELECT * FROM tbl_danhmucbaiviet ORDER BY id_baiviet DESC`);

    return res.render('baiviet/sua.ejs', { baiviet: bv[0], danhmucbv: danhmucbv })

}

let getThembv = async (req, res) => {
    let [baiviet] = await pool.execute(`SELECT * FROM tbl_danhmucbaiviet ORDER BY id_baiviet DESC`);
    return res.render('baiviet/them.ejs', { baiviet: baiviet })
}

let thembaiviet = async (req, res) => {

    if (req.fileValidationError) {

        return res.send(req.fileValidationError);
    }
    else if (!req.file) {
        return res.send('Please select an image to upload');
    }

    let hinhanh = req.file.filename
    let { tenbaiviet, tomtat, noidung, danhmuc, tinhtrang } = req.body;
    await pool.execute('INSERT INTO tbl_baiviet(tenbaiviet,hinhanh,tomtat,noidung,tinhtrang,id_danhmuc) VALUE(?,?,?,?,?,?)',
        [tenbaiviet, hinhanh, tomtat, noidung, tinhtrang, danhmuc]);
    return res.redirect('/')
}

let xoabaiviet = async (req, res) => {
    let id = req.body.id
    const [rows, fields] = await pool.execute('SELECT * FROM tbl_baiviet WHERE id = ?', [id]);

    let path = `D:/Xampp/htdocs/Nodejs/src/public/image/${rows[0].hinhanh}`;
    fs.unlinkSync(path);
    await pool.execute('delete from tbl_baiviet where id=?', [id]);
    return res.redirect('/')
}

let suabaiviet = async (req, res) => {

    if (req.fileValidationError) {
        return res.send(req.fileValidationError);
    }
    else if (!req.file) {
        let { tenbaiviet, tomtat, noidung, danhmuc, tinhtrang, id } = req.body;
        await pool.execute('update tbl_baiviet set tenbaiviet=?,tomtat= ?,noidung= ?,tinhtrang= ?,id_danhmuc= ? where id=?',
            [tenbaiviet, tomtat, noidung, tinhtrang, danhmuc, id]);
        return res.redirect('lietke')
    } else if (req.file) {
        let { tenbaiviet, tomtat, noidung, danhmuc, tinhtrang, id } = req.body;
        const [rows, fields] = await pool.execute('SELECT * FROM tbl_baiviet WHERE id = ?', [id]);

        let path = `D:/Xampp/htdocs/Nodejs/src/public/image/${rows[0].hinhanh}`;
        fs.unlinkSync(path);

        let hinhanh = req.file.filename

        await pool.execute('update tbl_baiviet set tenbaiviet=?,hinhanh= ?,tomtat= ?,noidung= ?,tinhtrang= ?,id_danhmuc= ? where id=?',
            [tenbaiviet, hinhanh, tomtat, noidung, tinhtrang, danhmuc, id]);
        return res.redirect('/')
    }
}

//Don hang
let lietkedonhang = async (req, res) => {
    const [rows, fields] = await pool.execute('SELECT * FROM tbl_cart,tbl_dangky WHERE tbl_cart.id_khachhang=tbl_dangky.id_dangky ORDER BY tbl_cart.id_khachhang DESC ');
    return res.render('donhang/lietke.ejs', { donhang: rows })
}

let xemdonhang = async (req, res) => {

    let id = req.params.id
    const [rows, fields] = await pool.execute('SELECT * FROM tbl_cart_details,tbl_sanpham WHERE tbl_cart_details.id_sanpham=tbl_sanpham.id_sanpham AND tbl_cart_details.code_cart=? ORDER BY tbl_cart_details.id_cart_details DESC', [id]);
    if (id > 0) {
        await pool.execute('UPDATE tbl_cart SET cart_status=0  WHERE code_cart=?', [id])
    }
    return res.render('donhang/xem.ejs', { donhang: rows[0] })

}

module.exports = {
    getHomepage, lietkesp, getsuaSanpham, getThemsp, themSanpham, xoaSanpham, suaSanpham, lietkeDmsp, getsuaDmSanpham, getDmThemsp, themDmSanpham, xoaDmSanpham, suaDmSanpham,
    lietkeDmbv, getsuaDmbaiviet, getDmThembv, themDmbaiviet, xoaDmbaiviet, suaDmbaiviet, lietkebv, getsuabaiviet, getThembv, thembaiviet, xoabaiviet, suabaiviet, lietkedonhang,
    xemdonhang

};
