# Baca.a

> Disusun untuk memenuhi Tugas Milestone 2 - IF3110 Pengembangan Aplikasi Berbasis Web

## Daftar Isi

- [Deskripsi Aplikasi _Web_](#deskripsi-aplikasi-web)
- [Daftar _Requirement_](#daftar-requirement)
- [Cara Instalasi](#cara-instalasi)
- [Cara Menjalankan _Server_](#cara-menjalankan-server)
- [Screenshot Tampilan Aplikasi](#screenshot-tampilan-aplikasi)
- [Screenshot Google Lighthouse](#screenshot-google-lighthouse)
- [Daftar _Perubahan_](#daftar-perubahan)
- [Screenshot _Perubahan_](#screenshot-perubahan)
- [Pembagian Tugas](#pembagian-tugas)
- [Anggota Kelompok](#anggota-kelompok)

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
16. Add User
17. Delete User
18. Edit Info User

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

![Login Page](./doc/screenshots/Login.png)

### Register

![Register Page](./doc/screenshots/SignUp.png)

### Home

![Home Page](./doc/screenshots/Home1.png)
![Home Page](./doc/screenshots/Home2.png)

### Profile

![Profile](./doc/screenshots/Profile1.png)
![Profile](./doc/screenshots/Profile2.png)

### History Review

![History Review](./doc/screenshots/HistoryReview1.png)
![History Review](./doc/screenshots/HistoryReview2.png)

### Search, Sort, dan Filter

![Search, Sort, dan Filter Page](./doc/screenshots/Search-Sort-Filter.png)

### List-List Audiobook

![List-List Audiobook](./doc/screenshots/ListOfAllBook1.png)
![List-List Audiobook](./doc/screenshots/ListOfAllBook2.png)

### Review Audiobook

![Add Review Admin](./doc/screenshots/AddReviewAdmin.png)
![Add Review User](./doc/screenshots/AddReviewUser.png)
![Edit Review](./doc/screenshots/EditReview.png)

### Edit Audiobook

![Edit Audiobook](./doc/screenshots/EditAudiobook.png)

### Detail Audiobook

![Detail Audiobook](./doc/screenshots/DetailAudioBook1.png)
![Detail Audiobook](./doc/screenshots/DetailAudioBook2.png)

### Add Audiobook

![Add Audiobook](./doc/screenshots/TambahBuku.png)

### Delete Audiobook

![Delete Audiobook](./doc/screenshots/DeleteAudiobook.png)

### List-List User

![List Semua User](./doc/screenshots/ListUser1.png)

### Add User

![Add User](./doc/screenshots/AddUser.png)

### Delete User

![Delete User](./doc/screenshots/HapusUser.png)

### Edit Info User

![Edit User](./doc/screenshots/EditUser.png)

### Error

![Error 404](./doc/screenshots/Error404.png)
![Error 501](./doc/screenshots/Error501.png)

# Screenshot Google Lighthouse

### Page Login

![Page Login](./doc/lighthouse/loginpage.png)

### Page Register

![Page Register](./doc/lighthouse/registerpage.png)

### Page Audiobook

![Page Audiobool](./doc/lighthouse/bookspage.png)

### Page Details

![Page Details](./doc/lighthouse/detailspage.png)

### Home

![Home](./doc/lighthouse/homepng.png)

### Page Profile

![Page Profile](./doc/lighthouse/profilepage.png)

### Page Reviews

![Page Reviews](./doc/lighthouse/reviewspage.png)

### Page User

![Page User](./doc/lighthouse/userspage.png)

# Daftar Perubahan

1. Page subscriber
2. Page daftar buku-buku yang dibuat user(UserBooks)

# Screenshot tampilan aplikasi

### Page Subscriber

![Page Subscriber](./doc/screenshots/subscriber.png)

### Page daftar buku-buku yang dibuat user

![Page UserBooks](./doc/screenshots/userbooks.png)


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
13. Add User: 13521127
14. Delete User: 13521127
15. Edit Info User: 13521127
16. Error : 13521095
17. Responsive Adjustments: 13521095
18. Global Styling: 13521095
19. Page Subscriber: 13521115
20. Page UserBooks: 13521115

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
13. Add User: 13521127
14. Delete User: 13521127
15. Edit Info User: 13521127
16. Initial Project,Routing, Database & Docker Setup: 13521095
17. Page Subscriber: 13521095
18. Page Detail Buku: 13521095
19. Integrasi monolithic dengan SOAP dan REST : 13521095

# Angota Kelompok

1. Muhamad Aji Wibisoni: 13521095
2. Shelma Salsabila: 13521115
3. Marcel Ryan Anthony : 13521127


