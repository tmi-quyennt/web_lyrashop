<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
    }
    .login-container {
      max-width: 400px;
      width: 100%;
      padding: 40px;
      border-radius: 12px;
      background: #ffffff;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
      border: 1px solid #dcdcdc;
      transition: transform 0.3s ease;
    }
    .login-container:hover {
      transform: scale(1.03);
    }
    .login-container h1 {
      margin-bottom: 20px;
      font-size: 26px;
      color: #333;
      text-align: center;
    }
    .form-group label {
      font-weight: bold;
      color: #555;
    }
    .form-control {
      border-radius: 8px;
      border: 1px solid #ced4da;
      box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
    }
    .btn-primary {
      background: linear-gradient(45deg, #007bff, #0056b3);
      border: none;
      border-radius: 8px;
      padding: 12px 24px;
      font-size: 16px;
      transition: background 0.3s ease, transform 0.3s ease;
    }
    .btn-primary:hover {
      background: linear-gradient(45deg, #0056b3, #003d80);
      transform: translateY(-2px);
    }
    .btn-primary:active {
      transform: translateY(1px);
    }
    .alert {
      border-radius: 8px;
      margin-bottom: 20px;
    }
    .vali {
      color: red;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h1>Login Admin Page</h1>
    <?php if($this->session->flashdata('success')): ?>
      <div class="alert alert-success"> <?php echo $this->session->flashdata('success') ?> </div>
    <?php elseif($this->session->flashdata('error')): ?>
      <div class="alert alert-danger"> <?php echo $this->session->flashdata('error') ?> </div>
    <?php endif; ?>

    <form action="<?php echo base_url('login-user') ?>" method="POST">
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <div class="vali">
          <?php echo form_error('email'); ?>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name='password' class="form-control" id="exampleInputPassword1" placeholder="Password">
        <div class="vali">
          <?php echo form_error('password'); ?>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
