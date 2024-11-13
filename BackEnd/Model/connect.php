<?php 
Class Connect {
    public function connect() {
        switch ($conn = new mysqli('localhost', 'root', '123456', 'website')) {
            case false:
                echo "Kết nối thất bại";
                exit();
            default:
                mysqli_set_charset($conn, 'utf8');
                return $conn;
        }
    }
    # Hàm lấy dữ liệu trong cơ sở dữ liệu
    public function Select($a, $table, $column, $value) {
        $conn = $this->connect();
        if (!$conn) {
            echo "Không thể thực hiện truy vấn. Kết nối chưa được thiết lập.";
            return false;
        } else {
            $sql = "SELECT $a from $table WHERE $column = '$value'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return $row[$a];
        }
    }
    public function SelectTable($sql) {
        // Kết nối cơ sở dữ liệu
        $conn = $this->connect();
    
        // Kiểm tra kết nối
        if (!$conn) {
            echo "Không thể thực hiện truy vấn. Kết nối chưa được thiết lập.";
            return false;
        } else {
    
            // Thực hiện truy vấn
            $result = $conn->query($sql);
    
            // Kiểm tra nếu có dữ liệu
            if ($result->num_rows > 0) {
                // Tạo mảng chứa tất cả kết quả
                $row = [];
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;  // Thêm mỗi dòng vào mảng
                }
                return $rows;  // Trả về mảng chứa tất cả dữ liệu
            } 
        }
    }
    
    # Hàm Kiểm tra tồn tại trong cơ sở dữ liệu
    public function Check($table, $column, $value) {
        $conn = $this->connect();
        if (!$conn) {
            echo "Không thể thực hiện truy vấn. Kết nối chưa được thiết lập.";
            return false;
        } else {
            $sql = "SELECT 1 from $table WHERE $column = '$value'";
            $result = $conn->query($sql);
            return $result->num_rows > 0;
        }
    }
    # Hàm thêm vào cơ sở dữ liệu
    public function Insert($value, $table) {
        $conn = $this->connect();
        if (!$conn) {
            echo "Không thể thực hiện truy vấn. Kết nối chưa được thiết lập.";
            return false;
        } else {
            $sql = "INSERT INTO $table VALUES ($value) ";
            $result = $conn->query($sql);
            return $result;
        }
    }
    # Hàm cập nhật cơ sở dữ liệu
    public function Update($table, $column, $value, $column2, $value2) {
        $conn = $this->connect();
        if (!$conn) {
            echo "Không thể thực hiện truy vấn. Kết nối chưa được thiết lập.";
            return false;
        } else {
            $sql = "UPDATE $table SET $column = '$value' WHERE $column2 = '$value2'";
            return $conn->query($sql);
        }
    }
    # Hàm xóa cơ sở dữ liệu
    public function Delete($table, $value ) {
        $conn = $this->connect();
        if (!$conn) {
            echo "Không thể thực hiện truy vấn. Kết nối chưa được thiết lập.";
            return false;
        } else {
            $sql = "DELETE FROM $table WHERE $value";
            return $conn->query($sql);
        }
    }
    public function count($sql) {
        $conn = $this->connect();
        if (!$conn) {
            echo "Không thể thực hiện truy vấn. Kết nối chưa được thiết lập.";
            return false;
        } else {
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) { // Kiểm tra nếu có kết quả
                $row = $result->fetch_assoc();
                return $row['total'];  // Trả về tổng số hàng
            } else {
                echo "Không có dữ liệu hoặc lỗi khi thực hiện truy vấn.";
                return 0; // Trả về 0 nếu không có dữ liệu
            }
        }
    }
    
    public function SelectTable2($sql) {
        // Kết nối cơ sở dữ liệu
        $conn = $this->connect();
    
        // Kiểm tra kết nối
        if (!$conn) {
            echo "Không thể thực hiện truy vấn. Kết nối chưa được thiết lập.";
            return false;
        } else {
            // Thực hiện truy vấn
            $result = $conn->query($sql);
    
            // Kiểm tra nếu có dữ liệu
            if ($result->num_rows > 0) {
                $rows = [];  // Khởi tạo mảng để chứa tất cả kết quả
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;  // Thêm mỗi dòng vào mảng
                }
                return $rows;  // Trả về mảng chứa tất cả dữ liệu
            } else {
                return [];  // Trả về mảng rỗng nếu không có kết quả
            }
        }
    }
}
?>