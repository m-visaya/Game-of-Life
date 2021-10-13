<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="./static/index.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet" />
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<title>Game of Life</title>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <div class="main-container">

    <div class="left">
      <div class="image">
        <img src="./assets/game_of_life.png" height="540" width="960">
      </div>
      <div class="aplay">
        <div>
          <a href="https://play.google.com/store/apps/details?id=com.miHoYo.GenshinImpact">
            <img src="./assets/gplay2.png" height="52.5" width="172.5">
          </a>
        </div>
      </div>

    </div>

    <div class="right" id="login">
      <div align="right">
        <div class="login">
          <div align="center">
            <h1 class="header"> Log in </h1>
            <form method="POST" action="#">
              <br>
              <div class="word">
                <h2 class="userpass">username</h2>
              </div>
              <div class="row">
                <input id="username" type="text" class="sizebox" name="username" required>
              </div>
              <div class="word">
                <h2 class="userpass">password</h2>
              </div>
              <div class="row">
                <input id="password" type="password" class="sizebox" name="password" required>
              </div>
              <a class="link" onclick="to_signup()">create an account</a>
              <br>
              <div class="button">
                <button name="login_btn" id="login_btn" onclick="login()" type="button" class="btn btn-danger">Submit</submit>
              </div>
              <div class="gameoflife">
                <p><img src="assets/game_of_life_straight_white.png" height="30" width="125">
                  <a href="https://play.google.com/store/apps/details?id=com.miHoYo.GenshinImpact">
                    <img src="./assets/playstore.png" height="20" width="23"></a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="right" id="signup" style="display: none;">
      <div align="right">
        <div class="login">
          <div align="center">
            <h1 class="header"> Sign up </h1>
            <form method="POST" action="#">
              <br>
              <div class="word">
                <h2 class="userpass">username</h2>
              </div>
              <div class="row">
                <input id="signname" type="text" class="sizebox" name="username" required>
              </div>
              <div class="word">
                <h2 class="userpass">password</h2>
              </div>
              <div class="row">
                <input id="signpass" type="password" class="sizebox" name="password" required>
              </div>
              <a class="link2" onclick="to_login()">already have an account</a>
              <br>
              <div class="button">
                <button name="signup_btn" id="signup_btn" type="button" onclick="signup()" class="btn btn-danger">Submit</submit>
              </div>
              <div class="gameoflife">
                <p><img src="./assets/game_of_life_straight_white.png" height="30" width="125">
                  <a href="https://play.google.com/store/apps/details?id=com.miHoYo.GenshinImpact">
                    <img src="./assets/playstore.png" height="20" width="23"></a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>


<style>
  .swal2-title {
    color: var(--text-light-gray) !important;
    font-weight: 500 !important;
    font-family: Roboto;
    font-size: 1.2rem !important;
  }

  .swal2-popup {
    background-color: var(--bg-darker-gray) !important;
    opacity: 0.99;
  }

  body {
    font-family: "Roboto", sans-serif !important;
    background-image: url(./assets/index_bg.gif);
    background-size: cover;
    /* backdrop-filter: blur(2px) contrast(100%);*/
  }

  .main-container {
    display: flex;
    width: 100%;
    height:100%;
  }

  .login, .signup {
    background-color: #232323;
    height: 100%;
    width: 100%;
    padding: 20px;
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .row {
    margin-bottom: 2em;
  }

  .header {
    text-align: centered;
    color: white;
    font-size: 90px;
    margin-top: 100px;
    margin-bottom: 40px;
    font-weight: 400;

  }

  .userpass {
    color: white;
    font-size: 20px;
    font-weight: 400;
  }

  .word {
    /* margin-right: 500px;
    margin-left: 55px */
    text-align:center;
  }

  .link {
    color: white;
    /* margin-left: 140px; */
  }

  .link2 {
    color: white;
    /* margin-left: 100px; */
  }

  .sizebox {
    border-radius: 0.8em !important;
    width: 270px;
    /* margin-left: 60px; */
  }

  .button {
    margin-top: 120px;
  }

  .left {
    width: 70%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items:center;
    margin-top: -5em;
    /* margin: 0;
    padding: 0;
    outline: 0; */
    /* height: 100%; */
  }

  .right {
    width: 30%;
    /* margin: 0;
    padding: 0;
    outline: 0; */
    border: none;
    /* float: left; */
    height: 100%;
  }

  .foot {
    background-color: #111111;
    color: white;
    position: absolute;
    bottom: 0px;
    width: 73.95%;
  }

  .contact {
    text-align: right;
    /* margin-right: 45px; */
    height: 30;
    width: 30;
  }

  .footleft {
    width: 50%;
    margin: 0;
    padding: 0;
    outline: 0;
    border: none;
    float: left;
    background-color: #333333;
    color: white;
  }

  .footright {
    width: 50%;
    margin: 0;
    padding: 0;
    outline: 0;
    border: none;
    float: left;
    background-color: #333333;
    color: white;
  }

  .image {
    /* margin-left: 70px;
    margin-top: 90px; */
  }

  .aplay {
    display:flex;
    flex-direction: column;
    align-items: center;
  }

  .gameoflife {
    margin-top: 40px;
    display: none;
  }

  .contactus {
    text-decoration: none;
    color: white;
  }

  .contactus:hover {
    color: #ff6600;
  }

  .link:hover {
    color: #ff6600;
  }

  .link2:hover {
    color: #ff6600;
  }

    form  {
      margin-inline:auto !important;
    }

    form input {
      margin-inline:auto !important;
    }

    .word {
      width: 90% !important;
    }

  @media only screen and (max-width: 1080px) {
    .left {
      transform: scale(0.8);
      width: 60%;
    }

    .right {
      width: 40% !important;
    }

    .login {
      width: 100% !important;
    }
  }

  @media only screen and (max-width: 900px) {
    .left {
      display: none;
    }

    .right {
      display:flex;
      flex-direction:column;
      width: 100% !important;
    }

    input, h2, .word{
      margin-inline: auto !important;
      text-align:center;
    }

    .login {
      background-image: url('./assets/bg2.png');
      background-color: #333333;
      height: 100%;
      width: 100% !important;
      color: white;

    }

    form  {
      margin-inline:auto !important;
    }

    .userpass {
      color: white;
      font-size: 20px;
      font-weight: 400;
    }

    .word {
    }

    .link {
      color: white;
    }

    .link2 {
      color: white;
    }

    .sizebox {
      border-radius: 0.8em !important;
      width: 390px;
    }

    .button {
      margin-top: 90px;
    }

    .gameoflife {
      margin-top: 100px;
      display: block;
    }
  }
</style>