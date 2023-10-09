# Baca.a

> Disusun untuk memenuhi Tugas Milestone 1 - Monolithic PHP & Vanilla Web Application IF3110 Pengembangan Aplikasi Berbasis Web

## Daftar Isi

- [Deskripsi Aplikasi _Web_](#deskripsi-aplikasi-web)
- [Daftar _Requirement_](#daftar-requirement)
- [Cara Instalasi](#cara-instalasi)
- [Cara Menjalankan _Server_](#cara-menjalankan-server)
- [Screenshot Tampilan Aplikasi](#screenshot-tampilan-aplikasi)
- [Pembagian Tugas](#pembagian-tugas)

## Deskripsi Aplikasi _Web_

**Baca.a** adalah sebuah aplikasi web yang sederhana namun sangat berguna, dirancang untuk memberikan penilaian terhadap audiobook dan juga memungkinkan pengguna untuk mendengarkannya. Website ini menjadi alat yang penting bagi mereka yang ingin mengevaluasi atau mendengarkan audiobook. Aplikasi ini dikembangkan tanpa mengandalkan framework apapun, menggunakan teknologi seperti PHP, HTML, CSS, dan JavaScript, serta memanfaatkan XHR (XMLHttpRequest) sebagai implementasi Ajax. Untuk penyimpanan data, web ini memanfaatkan database PostgreSQL.

# Daftar requirement

1. Login
2. Register
3. Home
4. Profile
5. History Review
6. Search, Sort, dan Filter
7. List-List Audiobook
8. Review Audiobook
9. Edit Audiobook
10. Detail Audiobook
11. Add Audiobook
12. Delete Audiobook
13. Navbar
14. Pagination
15. List-List User

# Cara instalasi

1. Lakukan pengunduhan _repository_ ini dengan menggunakan perintah `git clone https://gitlab.informatika.org/if3110-2023-01-24/tugas-besar-1-wbd.git` pada terminal komputer Anda.
2. Pastikan komputer Anda telah menginstalasi dan menjalankan aplikasi Docker.
3. Lakukan pembuatan _image_ Docker yang akan digunakan oleh aplikasi ini dengan menjalankan perintah `docker-compose up --build -d.` pada terminal _directory_ aplikasi web.
4. Buatlah sebuah file `.env` yang bersesuaian dengan penggunaan (contoh file tersebut dapat dilihat pada `.env.example`).

# Cara menjalankan server

1. Anda dapat menjalankan program ini dengan menjalankan perintah `docker-compose up -d` pada terminal _directory_ aplikasi web.
2. Aplikasi web dapat diakses dengan menggunakan browser pada URL `http://localhost:8008/home`.
3. Aplikasi web dapat dihentikan dengan menjalankan perintah perintah `docker-compose down` pada terminal _directory_ aplikasi web.

# Screenshot tampilan aplikasi

### Login

![Login Page](../../screenshots/Login.png)

### Register

![Register Page](././screenshots/SignUp.png)

### Home

![Home Page](./screenshots/Home1.png)
![Home Page](./screenshots/Home2.png)

### Profile

![Profile](./screenshots/Profile1.png)
![Profile](./screenshots/Profile2.png)

### History Review

![History Review](./screenshots/HistoryReview1.png)
![History Review](./screenshots/HistoryReview2.png)

### Search, Sort, dan Filter

![Search, Sort, dan Filter Page](./screenshots/Search-Sort-Filter.png)

### List-List Audiobook

![List-List Audiobook](./screenshots/ListOfAllBook1.png)
![List-List Audiobook](./screenshots/ListOfAllBook2.png)

### Review Audiobook

![Add Review Admin](./screenshots/AddReviewAdmin.png)
![Add Review User](./screenshots/AddReviewUser.png)
![Edit Review](EditReview./screenshots/.png)

### Edit Audiobook

![Edit Audiobook](./screenshots/EditAudiobook.png)

### Detail Audiobook

![Detail Audiobook](./screenshots/DetailAudioBook1.png)
![Detail Audiobook](./screenshots/DetailAudioBook2.png)

### Add Audiobook

![Add Audiobook](./screenshots/TambahBuku.png)

### Delete Audiobook

![Delete Audiobook](./screenshots/DeleteAudioBook.png)

### List-List User

![List Semua User](./screenshots/ListUser1.png)
![List Semua User](./screenshots/ListUser2.png)
![Hapus User](./screenshots/HapusUser.png)
![Edit User](./screenshots/EditUser.png)

### Error

![Error 404](./screenshots/Error404.png)
![Error 501](./screenshots/Error501.png)

# Pembagian tugas

## Frontend / Client-side

1. Login: 13521115
2. Register: 13521115
3. Home: 13521095
4. Profile: 13521115
5. Search, Sort, Filter: 13521095
6. List-List Audiobook: 13521095
7. Review Audiobook: 13521127
8. Edit Audiobook: 13521127
9. Delete Audiobook: 13521127
10. Navbar: 13521095
11. Pagination: 13521095
12. List-List User: 13521127
13. Error : 13521095
14. Responsive Adjustments: 13521095
15. Global Styling: 13521095

## Backend / Server-side

1. Login: 13521115
2. Register: 13521115
3. Home: 13521095
4. Profile: 13521115
5. Search, Sort, Filter: 13521095
6. List-List Audiobook: 13521095
7. Review Audiobook: 13521127
8. Edit Audiobook: 13521127
9. Delete Audiobook: 13521127
10. Navbar: 13521095
11. Pagination: 13521095
12. List-List User: 13521127
13. Initial Project,Routing, Database & Docker Setup: 13521095
