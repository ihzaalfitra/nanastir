<?php
  if(!isset($_SESSION['username']) && !isset($_SESSION['name'])){
    header("location:login.php");
  }
?>
<div class="px-6 w-full overflow-auto display-block">
  <h1 class="text-4xl text-blue-700 mb-10 pt-12">Laporan</h1>
	<div class="pl-12 w-full">
		<h2 class="text-xl text-blue-700 my-12">
			<a href="index.php?page=laporan-generated&type=a" class="transition duration-300 ease-in-out hover:bg-blue-700 hover:text-gray-200 text-blue-700 border border-blue-700 p-5 rounded-full">Laporan Mingguan
			</a>
		</h2>
		<h2 class="text-xl text-blue-700 my-12">
			<a href="index.php?page=laporan-generated&type=b" class="transition duration-300 ease-in-out hover:bg-blue-700 hover:text-gray-200 text-blue-700 border border-blue-700 p-5 rounded-full">
				Laporan Bulanan
			</a>
		</h2>
		<!-- <h2 class="text-xl text-blue-700 my-12">
			<a href="index.php?page=laporan-generated&type=c" class="transition duration-300 ease-in-out hover:bg-blue-700 hover:text-gray-200 text-blue-700 border border-blue-700 p-5 rounded-full">
				Buat laporan berdasarkan tanggal
			</a>
		</h2> -->
	</div>
</div>
