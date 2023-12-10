## Hướng dẫn sử dụng Sudo Page ##

**Giới thiệu:** Module tạo sitemap cho website trên SudoCore.

### Cài đặt để sử dụng ###

- Thêm sudo/sitemap vào phần require của file composer.json sau đó chạy composer update
- Chạy php artisan vendor:publish --tag=sudo/sitemap để public file config, và assets ra ngoài
- Cấu hình các dữ liệu muốn hiển thị tại file `config/SudoSitemap.php` 
