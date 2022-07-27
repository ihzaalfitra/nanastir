<?php
  // error_reporting(0);
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if(!isset($_SESSION['username']) && !isset($_SESSION['name'])){
    header("location:login.php");
  }
  include('function.php');
  include("conn.php");
 ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="content-type" content="text/plain; charset=UTF-8"/>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="styles.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3c684c54ef.js" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript">
      document.addEventListener('contextmenu', event => event.preventDefault()); -->
    <!-- </script> -->
    <title> NanaStir
        </title>
</head>
<body class="h-screen overflow flex h-auto items-center justify-center bg-gray-100">
  <div class="font-sans antialiased h-screen flex w-screen">
    <div class="bg-blue-700 text-yellow-500 flex-none w-64 pb-6 hidden md:block h-screen">
        <div class="text-yellow-500 mb-2 mt-3 px-4 flex justify-between border-b border-blue-700">
            <div class="flex-auto">
                <h1 class="font-semibold text-xl leading-tight mb-1 truncate">NanaStir</h1>
                <div class="flex items-center mb-6">
                    <span class="bg-green rounded-full block w-2 h-2 mr-2"></span>
                    <!-- <span class="text-yellow-500 opacity-50 text-sm">NanaStir</span> -->
                </div>
            </div>
            <!-- <div>
                <svg class="h-6 w-6 fill-current text-yellow-500 opacity-25" viewBox="0 0 20 20">
                    <path d="M14 8a4 4 0 1 0-8 0v7h8V8zM8.027 2.332A6.003 6.003 0 0 0 4 8v6l-3 2v1h18v-1l-3-2V8a6.003 6.003 0 0 0-4.027-5.668 2 2 0 1 0-3.945 0zM12 18a2 2 0 1 1-4 0h4z" fill-rule="evenodd" />
                </svg>
            </div> -->
        </div>
        <div class="mb-8">
            <!-- <div class="px-4 mb-2 text-yellow-500 flex justify-between items-center">Home</div> -->
            <a class="" href="index.php">
              <div class="transition duration-300 ease-in-out hover:bg-yellow-500 hover:text-gray-200 bg-blue-700 py-1 px-8 text-yellow-500">Home</div>
            </a>
            <a href="index.php?page=daftar_siswa">
              <div class="transition duration-300 ease-in-out hover:bg-yellow-500 hover:text-gray-200 bg-blue-700 py-1 px-8 text-yellow-500">Daftar Siswa</div>
            </a>
            <a href="index.php?page=jadwal">
              <div class="transition duration-300 ease-in-out hover:bg-yellow-500 hover:text-gray-200 bg-blue-700 py-1 px-8 text-yellow-500">Jadwal</div>
            </a>
			<a href="index.php?page=laporan">
              <div class="transition duration-300 ease-in-out hover:bg-yellow-500 hover:text-gray-200 bg-blue-700 py-1 px-8 text-yellow-500">Laporan</div>
            </a>
            <a href="index.php?page=logout">
              <div class="transition duration-300 ease-in-out hover:bg-yellow-500 hover:text-gray-200 bg-blue-700 mt-10 py-1 px-8 text-yellow-500">Keluar</div>
            </a>
        </div>
  </div>
  <?php
  if(isset($_GET['page'])){
    if(include($_GET['page'].".php")){

    }else{
      echo "<span class='inline-block align-middle h-screen w-full text-4xl text-blue-700 text-center'>Page not found.</span>";
    }
    // switch($_GET['page']){
    //   case "home":
    //   include("home.php");
    //   break;
    //   case "product_detail":
    //     include("product_detail.php");
    //   break;
    //   default:
    //     include("home.php");
    //   break;
    // }
  }else{
    include("home.php");
  }

  ?>
</div>
</body>
</html>
