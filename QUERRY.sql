CREATE DATABASE db_uts;
USE db_uts;

CREATE TABLE hasil_karya (
  id INT PRIMARY KEY AUTO_INCREMENT,
  judul VARCHAR(100) NOT NULL,
  deskripsi TEXT,
  tipe ENUM('gambar', 'video'),
  konten VARCHAR(255)
);
