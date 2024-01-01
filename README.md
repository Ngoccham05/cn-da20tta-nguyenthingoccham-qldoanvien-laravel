# cn-da20tta-nguyenthingoccham-qldoanvien-laravel
**Tên đề tài:** Xây dựng Website quản lý đoàn viên khoa Kỹ thuật và Công nghệ  

**Sinh viên thực hiện:** Nguyễn Thị Ngọc Chăm - 110120008
  - Email: ngoccham0912@gmail.com
  - Điện thoại: 0397 256 410  

**Nội dung đề tài bao gồm:** phân quyền đăng nhập cho các nhóm người dùng; quản lý thông tin của đoàn viên; quản lý các hoạt động, phong trào; đánh giá và xếp loại đoàn viên, chi đoàn theo học kỳ, năm học; thống kê số lượng đoàn viên.

## Cài đặt
- Cài đặt [Composer](https://getcomposer.org/)
- Tải dự án về máy: `git clone https://github.com/Ngoccham05/cn-da20tta-nguyenthingoccham-qldoanvien-laravel.git`
- Sao chép tệp _.env.example_ thành _.env_
- Tạo khóa ứng dụng trong _.env_: `php artisan key:generate`
- Thay đổi cài đặt trong tệp _.env_:
  - DB_CONNECTION
  - DB_DATABASE
  - DB_USERNAME
  - DB_PASSWORD
- Import dữ liệu từ _ql_doanvien.sql_ trong thư mục _public/db_ (có dữ liệu mẫu)
- Xóa thư mục _fileUploads_ trong _public_ rồi sử dụng lệnh `php artisan storage:link`
