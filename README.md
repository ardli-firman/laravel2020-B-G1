> NOTE : PREVIOUS commit in gitlab repository >
> Repo : [SINTAK](https://gitlab.com/a0i/sintak) thanks.

# INTRO

## Tema Project

-   SISTEM INFORMASI TUGAS AKHIR (SINTAK)

## Anggota Kelompok

-   Muhammad Irfan Bakhtiar (17090047)
-   Ardli Firman Maulana    (17090081)
-   Naufal Islam            (17090086)
-   Muhamad Abdul Muiz      (17090150)

# CARA INSTALL

### Windows
- Klik Clone or Download silahkan download zip
- Pindah kedalam folder /xampp/htdocs dan extrak 
- Buka Comandline atau bisa menggunakan terminal didalam Visual Studio Code, arahkan ke folder projek dengan ketik
  " cd /xampp/htdocs/sintak "
- Ketikan " composer install "
-   Ubah nama file .env.example menjadi .env
-   Isi nama database
-   Kembali ke cmd lalu ketik php artisan key:generate (Pada project laravel sintak)
-   Lalu ketik kembali php artisan migrate --seed
-   Untuk menjalankan ketik php artisan serve
-   Seeder Judul TA ketik php artisan db:seed JudulTASeeder
-   Seeder Pembimbimg ketik php artisan db:seed PembimbingSeeder

### LINUX
-   Ke folder /lampp/htdocs 
-   Buka Terminal dengan klik kanan open terminal
-   ketik "git clone https://github.com/mirza-alim-m/laravel2020-B-G1.git" pada terminal
-   Ubah nama folder menjadi sintak    
-   Masuk ke folder project lewat cmd. (cd sintak) *tanpa kurung
-   Ubah nama file .env.example menjadi .env
-   Isi nama database
-   Kembali ke cmd lalu ketik php artisan key:generate (Pada project laravel sintak)
-   Lalu ketik kembali php artisan migrate --seed
-   Untuk menjalankan ketik php artisan serve
-   Seeder Judul TA ketik php artisan db:seed JudulTASeeder
-   Seeder Pembimbimg ketik php artisan db:seed PembimbingSeeder

*note apabila terjadi eror setelah perintah " composer install ", silahkan ketikan "composer update"

# DEMO:
laravel-b1.tegalian.com

### Admin
tester.admin@mailinator.com : 123

### Dosen
tester.dosen@mailinator.com : 123

### Kaprodi
tester.kaprodi@mailinator.com : 123

### Mahasiswa
12345678 : 123
