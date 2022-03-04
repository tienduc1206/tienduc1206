<?php
require_once('dbhelp.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Quản lý thông tin sinh viên
                <form action="" method="get">
                    <input type="text" name="s" class="form-control" style="margin-top: 15px;margin-bottom: 15px" placeholder="Tìm kiếm theo tên">
                </form>
            </div>
            <div class="panel-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ và Tên</th>
                            <th>Tuổi</th>
                            <th>Địa chỉ</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['s']) && $_GET['s'] != '') {
                            $sql =  'select * from student where fullname like"%'.$_GET['s'].'%"';
                        }else {
                            $sql = 'select * from student';
                        }
                        $studentList = executeResult($sql);
                        $index = 1;
                        foreach ($studentList as $std) {
                            echo '
                            <tr>
                                <td>' . ($index++) . '</td>
                                <td>' . $std['fullname'] . '</td>
                                <td>' . $std['age'] . '</td>
                                <td>' . $std['address'] . '</td>
                                <td><button class="btn btn-warning" onclick = \'window.open("input.php?id=' . $std['id'] . '","_self")\'>Edit</button></td>
                                <td><button class="btn btn-danger" onclick="deleteStudent(' . $std['id'] . ')">Delete</button></td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary" onclick="window.open('input.php','_self')">Add student</button>
            </div>
        </div>
    </div>

    <script type="text/javaScript">
        function deleteStudent(id){
            option = confirm('Bạn có muốn xóa sinh viên này không')
            if (!option) {
                return;
            }
            $.post('delete_student.php',{
                'id': id
            } , function(data){
                alert(data)
                location.reload()
            })
        }
    </script>
</body>

</html>