<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Admin Panel</title>
  <style>
    /* ... (your existing styles) ... */
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <!-- ... (your existing navbar code) ... -->
  </nav>

  <!-- Sidebar -->
  <div class="container-fluid">
    <div class="row">
      <!-- ... (your existing sidebar code) ... -->
      <!-- Page Content -->
      <main class="main-content">
        <div class="container-fluid">
          <h1>Thông Tin Đơn Hàng</h1>
          <!-- Table -->
          <table class="table table-bordered" id="donhang">
            <thead>
              <tr>
                <th>Mã DH</th>
                <th>Ngày Đặt Hàng</th>
                <th>Ngày Giao Hàng</th>
                <th>Số Lượng</th>
                <th>Tổng Tiền</th>
                <th>Mã KH</th>
                <th>Mã SP</th>
              </tr>
            </thead>
          </table>
        </div>
      </main>    
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Script để gọi API và hiển thị dữ liệu -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      fetchData(); // Gọi hàm để lấy dữ liệu khi trang được tải

      function fetchData() {
        fetch('http://localhost:3000/api/getallDH')
          .then(response => response.json())
          .then(data => displayDonHang(data))
          .catch(error => console.error('Error fetching data:', error));
      }

      function deleteDonHang(madh) {
  console.log('Attempting to delete DonHang with ID:', madh);

  if (confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')) {
    fetch(`http://localhost:3000/api/deleteDH/${madh}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
      },
    })
    .then(response => response.json())
    .then(data => {
      console.log('Server response:', data);
      if (data.message) {
        alert(data.message);
        fetchData();
      } else {
        alert('Xóa đơn hàng thất bại.');
      }
    })
    .catch(error => {
      console.error('Error deleting order:', error);
      alert('Đã có lỗi xảy ra khi xóa đơn hàng.');
    });
  }
}
  

      function updateDonHang(madh) {
        // Lấy thông tin cần sửa đổi (có thể hiển thị một form và cho người dùng nhập liệu)
        const ngayGiaoHang = prompt('Nhập ngày giao hàng mới (YYYY-MM-DD):');
        
        // Gửi yêu cầu cập nhật đến API
        fetch(`http://localhost:3000/api/updateDH/${madh}`, {
          method: 'POST', // Bạn có thể sử dụng method PUT hoặc PATCH tùy thuộc vào yêu cầu của API
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ ngayGiaoHang }),
        })
          .then(response => response.json())
          .then(data => {
            console.log('Server response:', data);
            if (data.message) {
              alert(data.message);
              fetchData();
            } else {
              alert('Cập nhật đơn hàng thất bại.');
            }
          })
          .catch(error => {
            console.error('Error updating order:', error);
            alert('Đã có lỗi xảy ra khi cập nhật đơn hàng.');
          });
      }

      function displayDonHang(data) {
        const tableBody = document.getElementById('donhang').createTBody();
        tableBody.innerHTML = '';

        data.forEach(row => {
          const newRow = tableBody.insertRow();

          const cell1 = newRow.insertCell(0);
          cell1.textContent = row.madh;

          const cell2 = newRow.insertCell(1);
          cell2.textContent = new Date(row.ngaydathang).toLocaleDateString();

          const cell3 = newRow.insertCell(2);
          cell3.textContent = new Date(row.ngaygiaohang).toLocaleDateString();

          const cell4 = newRow.insertCell(3);
          cell4.textContent = row.soluong;

          const cell5 = newRow.insertCell(4);
          cell5.textContent = row.tongtien;

          const cell6 = newRow.insertCell(5);
          cell6.textContent = row.makh;

          const cell7 = newRow.insertCell(6);
          cell7.textContent = row.masp;

          const cell8 = newRow.insertCell(7);
          cell8.innerHTML = `
          <button type="button" class="btn btn-danger btn-sm" onclick="deleteDonHang('${row.madh}')">Xóa</button>
            <a href="editDH.php?id=${row.madh}" class="btn btn-warning btn-sm">Sửa</a>
            

            <button type="button" class="btn btn-primary btn-sm" onclick="updateDonHang(${row.madh})">Cập nhật</button>
          `;

          // Thêm thuộc tính data-id để dễ dàng xác định dòng khi cần xóa
          newRow.setAttribute('data-id', row.madh);
        });
      }
    });
  </script>
</body>
</html>
