<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../styles.css" rel="stylesheet">
</head>
<body class="h-screen overflow-hidden flex items-center justify-center bg-red-700">
    <body class="font-mono bg-gray-400">
		<!-- Container -->
		<div class="container mx-auto">
			<div class="flex justify-center px-6 my-12">
				<!-- Row -->
				<div class="w-full xl:w-3/4 lg:w-11/12 flex">
					<!-- Col -->
					<div
						class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
						style="background-image:url('bg-login.png');background-size:cover:background-position:center;"
					></div>
					<!-- Col -->
					<div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
            <h1 class="text-4xl text-red-700 text-center">Admin Login</h1>
						<form class="px-8 py-12 mb-4 bg-white rounded" action="login-process.php" method="post">
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
									class="transition duration-300 ease-in-out w-full px-4 py-2 font-bold text-red-700 border border-red-700 hover:text-white rounded-full hover:bg-red-700 focus:outline-none focus:shadow-outline"
									type="submit"
								>
									Sign In
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</body>
</html>
