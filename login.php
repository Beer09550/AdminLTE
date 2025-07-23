<!doctype html>
<html lang="th">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>เข้าสู่ระบบ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <style>
    @font-face {
      font-family: 'MN Taohuai';
      src: url('เต้าฮวย/MN Taohuai Italic.ttf') format('truetype');
    }

    body {
      font-family: 'MN Taohuai', sans-serif;
      background: linear-gradient(to right, #74ebd5, #9face6);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-card {
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      width: 100%;
      max-width: 400px;
    }

    .form-control:focus {
      box-shadow: none;
      border-color: #6c63ff;
    }

    .btn-primary {
      background-color: #6c63ff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #5a54d1;
    }

    .bi {
      font-size: 3rem;
      color: #6c63ff;
    }
  </style>
</head>


<body>
  <div class="login-card">
    <h3 class="text-center mb-4">เข้าสู่ระบบ</h3>
    <form action="check_login.php" method="POST">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="username" name="username" placeholder="ชื่อผู้ใช้" required>
        <label for="username">ชื่อผู้ใช้</label>
      </div>
      <div class="form-floating mb-4">
        <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" required>
        <label for="password">รหัสผ่าน</label>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg">เข้าสู่ระบบ</button>
      </div>
    </form>
    <p class="mt-3 text-center text-muted">ยังไม่มีบัญชี? <a href="#">สมัครสมาชิก</a></p>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>


</html>