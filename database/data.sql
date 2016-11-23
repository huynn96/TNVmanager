CREATE DATABASE IF NOT EXISTS tnv_manager;
USE tnv_manager;
CREATE TABLE IF NOT EXISTS nghien_cuu(
	id VARCHAR(20) NOT NULL,
	ten_nc VARCHAR(400),
	date_year DATE NOT NULL,
	date_year_end DATE,
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
	PRIMARY KEY (so_cmt)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS tnv_nghien_cuu(
	id VARCHAR(20) NOT NULL,
	so_cmt VARCHAR(20) NOT NULL,
	ma_tnv VARCHAR(10),
	note VARCHAR(500),
	ct INT(1) NOT NULL,
	PRIMARY KEY (id, so_cmt),
    FOREIGN KEY (id) references nghien_cuu (id),
    FOREIGN KEY (so_cmt) references tinh_nguyen_vien (so_cmt)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;