> Đồ án Phát triển ứng dụng web.
## Cách chạy
1. Cài đặt môi trường:
	B1: Cài đặt bộ Webserver bất kì nào đó ví dụ như XAMPP, WARMPP,... Sau đó copy mã nguồn vào thư mục htdocs trong thư mục cài webserver
 		Chú ý: Mặc định là shopbh
	B2: Mở cửa sổ CMD trong Folder chứa mã nguồn và gõ dòng lệnh composer update.
	B3: Mở mã nguồn bằng chương trình Code (Sublime text, Atom,...) sửa lại thông tin kết nối database trong config/database.php, trước đó phải tạo database mới trước.
	B4: Chạy lệnh php artisan migrate --seed để import các bảng cơ sở dữ liệu và dữ liệu mẫu.
	B5: Chạy lệnh php artisan key:generate để khởi tạo keygen cho app.
	B6: Chạy lênh php artisan serve. Mở trình duyệt và cào đường dẫn http://localhost:8000/index.
2. Import dữ liệu mẫu: Flide dữ liệu mẫu nằm ở shopbh/database/shopbh.sql
3. Đăng nhập với tài khoản User - Password:
  - SUPPER_ADMIN: "Admin" - 123
  - ADMIN: "Admin 2" - 123
  - Khách hàng: "User 1" - 123