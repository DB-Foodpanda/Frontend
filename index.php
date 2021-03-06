<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Foodpanda</title>
  <link rel="stylesheet" href="./css/style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="panda">
    <div class="ear"></div>
    <div class="face">
      <div class="eye-shade"></div>
      <div class="eye-white">
        <div class="eye-ball"></div>
      </div>
      <div class="eye-shade rgt"></div>
      <div class="eye-white rgt">
        <div class="eye-ball"></div>
      </div>
      <div class="nose"></div>
      <div class="mouth"></div>
    </div>
    <div class="body"> </div>
    <div class="foot">
      <div class="finger"></div>
    </div>
    <div class="foot rgt">
      <div class="finger"></div>
    </div>
  </div>
  <form action="logindata.php">
    <div class="hand"></div>
    <div class="hand rgt"></div>
    <h1>Foodpanda Login</h1>
    <div class="form-group">
      <input type="text" class="form-control" name="cus_username" Required/>
      <label class="form-label">Username </label>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" name="cus_password" Required/>
      <label class="form-label">Password</label>
      <p class="alert">Invalid Login..!!</p>
      <button class="btn" type="submit">Login </button>
    </div>
  </form>

  <br><br> Not a member? <br><br>
  <button type="button" class="button"><a href="register.php" target="_blank" rel="" >Register for member</a></button>
  <button type="button" class="button"><a href="./website/regis_drive.php" target="_blank" rel="">Register for driver</a></button>
  <button type="button" class="button"><a href="./website/regis_shop.php" target="_blank" rel="">Register for shop</a></button>

  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="./js/script.js"></script>

</body>

</html>