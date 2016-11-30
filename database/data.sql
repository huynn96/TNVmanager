CREATE DATABASE IF NOT EXISTS tnv_manager;
USE tnv_manager;
CREATE TABLE IF NOT EXISTS nghien_cuu(
	id VARCHAR(20) NOT NULL,
	ten_nc VARCHAR(400),
	date_year DATE NOT NULL,
	date_year_end DATE,
    	gd2_begin DATE,
    	gd2_end DATE,
    	gd3_begin DATE,
    	gd3_end DATE,
	thoi_gian VARCHAR(500),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS tinh_nguyen_vien(
	so_cmt VARCHAR(20) NOT NULL,
	ho_ten VARCHAR(70) NOT NULL,
	year INT(4),
	address VARCHAR(300),
	phone VARCHAR(15) NOT NULL,
	ngay_cap_cmt DATE,
	noi_cap_cmt VARCHAR(100),
	ghi_chu VARCHAR(500),
    	ds_den INT(1) NOT NULL,
	PRIMARY KEY (so_cmt)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS tnv_nghien_cuu(
	id VARCHAR(20) NOT NULL,
	so_cmt VARCHAR(20) NOT NULL,
	ma_tnv VARCHAR(10),
	note VARCHAR(500),
	ct INT(1) NOT NULL,
	PRIMARY KEY (id, so_cmt)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;