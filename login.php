<!doctype html>
<html lang="en">
<head>
    <title>
        Login - NanaStir
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="styles.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">
</head>
<body class="h-screen overflow-hidden flex items-center justify-center bg-red-700">
    <body class="font-mono" style=" background:#f5ebff">
		<div class="">
			<img src="book-2765983_1920.jpg" style="position:absolute;z-index:-100;top:0;left:0;opacity:0.1">
		</div>
		<!-- Container -->
		<div class="container mx-auto">
			<div class="flex px-6 my-12 justify-center">
					<!-- Col -->
					<div class="w-full lg:w-1/3 p-5 bg-white rounded-lg border-dashed border-8 border-blue-600">
            		<h1 class="text-4xl text-center text-blue-600">Log in</h1>
						<form class="px-8 py-12 mb-4 rounded" action="login-process.php" method="post">
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="username">
									Username
								</label>
								<input
									class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                  name="username"
									id="username"
									type="text"
									placeholder="Username"
                  required
								/>
							</div>
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="password">
									Password
								</label>
								<input
									class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                  name="password"
                  id="password"
									type="password"
									placeholder="******************"
                  required
								/>
							</div>
							<div class="mb-6 text-center">
                <?php
                  if (isset($_GET['err'])&&$_GET['err']=="404") {
                ?>
                <h1 class="text-base font-thin text-red-700 text-left">Login Credential Incorrect.</h1>
                <?php
                  }
                ?>
								<button
									class="border-2 border-blue-600 text-blue-600 transition duration-300 ease-in-out w-full px-4 py-2 font-bold border-2 rounded-full focus:outline-none focus:shadow-outline hover:bg-blue-600 hover:text-white"
									type="submit"
								>
									Log in
								</button>
							</div>
						</form>
					</div>
			</div>
		</div>
	</body>
</body>
</html>
