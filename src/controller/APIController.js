import pool from '../configs/connectDB';
var fs = require('fs');
let getAllSanpham = async (req, res) => {
    const [rows, fields] = await pool.execute('SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc ORDER BY id_sanpham DESC ');
    return res.status(200).json({
        message: 'ok',
        data: rows
    })
}

let themSanpham = async (req, res) => {
    if (req.fileValidationError) {

        return res.send(req.fileValidationError);
    }
    else if (!req.file) {
        return res.send('Please select an image to upload');
    }
    let { tensanpham, masp, giasp, soluong, tomtat, noidung, tinhtrang, danhmuc } = req.body;
    let hinhanh = req.file.filename
    if (!tensanpham || !masp || !giasp || !soluong || !tomtat || !noidung || !tinhtrang || !danhmuc || !hinhanh) {
        return res.status(200).json({
            message: 'missing required params'
        })
    }
    await pool.execute('insert into tbl_sanpham(tensanpham,masp,giasp,soluong,hinhanh,tomtat,noidung,tinhtrang,id_danhmuc) VALUE(?,?,?,?,?,?,?,?,?)',
        [tensanpham, masp, giasp, soluong, hinhanh, tomtat, noidung, tinhtrang, danhmuc]);
    return res.status(200).json({
        message: 'ok',

    })
}

let suaSanpham = async (req, res) => {
    if (req.fileValidationError) {
        return res.send(req.fileValidationError);
    }
    else if (!req.file) {
        let { tensanpham, masp, giasp, soluong, tomtat, noidung, tinhtrang, danhmuc, id_sanpham } = req.body;
        if (!tensanpham || !masp || !giasp || !soluong || !tomtat || !noidung || !tinhtrang || !danhmuc || !id_sanpham) {
            return res.status(200).json({
                message: 'missing required params'
            })
        }
        await pool.execute('update tbl_sanpham set tensanpham=?,masp= ?,giasp= ?,soluong= ?,tomtat= ?,noidung= ?,tinhtrang= ?,id_danhmuc= ? where id_sanpham=?',
            [tensanpham, masp, giasp, soluong, tomtat, noidung, tinhtrang, danhmuc, id_sanpham]);

    } else if (req.file) {
        let { tensanpham, masp, giasp, soluong, tomtat, noidung, tinhtrang, danhmuc, id_sanpham } = req.body;
        let hinhanh = req.file.filename
        if (!tensanpham || !masp || !giasp || !soluong || !tomtat || !noidung || !tinhtrang || !danhmuc || !id_sanpham) {
            return res.status(200).json({
                message: 'missing required params'
            })
        }
        await pool.execute('update tbl_sanpham set tensanpham=?,masp= ?,giasp= ?,soluong= ?,hinhanh= ?,tomtat= ?,noidung= ?,tinhtrang= ?,id_danhmuc= ? where id_sanpham=?',
            [tensanpham, masp, giasp, soluong, hinhanh, tomtat, noidung, tinhtrang, danhmuc, id_sanpham]);
    }
    return res.status(200).json({
        message: 'ok',

    })
}

let xoaSanpham = async (req, res) => {
    let id_sanpham = req.params.id
    if (!id_sanpham) {
        return res.status(200).json({
            message: 'missing required params'
        })
    }
    await pool.execute('delete from tbl_sanpham where id_sanpham=?', [id_sanpham]);
    return res.status(200).json({
        message: 'ok',

    })
}

module.exports = {
    getAllSanpham, themSanpham, suaSanpham, xoaSanpham
}