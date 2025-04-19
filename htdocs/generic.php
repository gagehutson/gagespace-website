<?php
ini_set("session.gc_maxlifetime", 500);
session_set_cookie_params(500);

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.html");
    exit();
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>File Server - Gagespace</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<style>
			/* Modal Styles */
			.modal {
				display: none;
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background: rgba(0, 0, 0, 0.5);
				justify-content: center;
				align-items: center;
				z-index: 9999; /* Ensures modal is above all */
			}

			.modal-content {
				background: white;
				padding: 25px;
				border-radius: 10px;
				width: 45%;
				min-height: 50%; /* Minimum height */
				max-height: 90vh; /* Prevents it from getting too large */
				text-align: center;
				position: relative;
				z-index: 10000;
				display: flex;
				flex-direction: column;
				overflow: auto; /* Allows scrolling if too many files */
			}



			.close-btn {
				color: rgb(65, 62, 62);
				position: absolute;
				top: 5px;
				right: 20px;
				font-size: 25px;
				cursor: pointer;
			}
			.drop-zone-container h2 {
				font-size: 20px;
				font: arial;
				font-weight: bold;
				color: #4d4d4d; /* Orange */
				letter-spacing: 2px; /* Add space between letters */
				text-align: left;
				padding-left: 0px;
			}

			.drop-zone {
				border: 2px dashed #007bff;
				padding: 20px;
				width: 100%;
				min-height: 130px;
				border-radius: 5px;
				cursor: pointer;
				background: #f8f9fa;
				color: rgb(119, 119, 119);
				display: flex;
				justify-content: flex-start;  /* Aligns text to the left */
				align-items: flex-start;  /* Moves text to the top */
				text-align: left;  /* Ensures text stays left-aligned */
				padding: 15px;  /* Adds spacing from edges */
				font-size: 15px;
				flex-direction: column;
				cursor: default;
				display: flex;
			}

			#upload {
				background-color: #cad0da;
				border: none;
				cursor: pointer;
				border-radius: 5px;
				margin-top: 10px;
			}
			#upload:hover {
				background-color: #babec7;
			}

			#cancel {
				background-color: #cad0da;
				border: none;
				cursor: pointer;
				margin-top: 10px;
			}
			#cancel:hover {
				background-color: #babec7;
			}

			#add {
				background-color: #007bff;
				border: none;
				cursor: pointer;
				margin-top: 10px;
			}
			#add:hover {
				background-color: #0268d4;
			}

			.drop-zone.highlight {
				background: #dde6ec;
			}

			#fileList {
				list-style: none;
				padding: 0;
				margin-top: 10px;
				font-size: 14px;
				color: rgb(0,128,255);
				width: 100%;
			}

			#fileList a {
				color: rgb(0,128,255);

			}

			#fileList a:hover {
				text-decoration: underline;
				color: rgb(1, 94, 187);
			}

			#fileList li {
				margin: 5px 0;
				padding: 5px 10px;
				border-radius: 5px;
				word-wrap: break-word;
			}

			.modal-footer {
				display: flex;
				justify-content: left; /* or center */
				gap: 20px;
				margin-top: auto; /* Pushes it to the bottom */
				padding-top: 15px;

				padding-left: 15px;
			}

			@media (max-width: 768px) {
				.modal-content {
					width: 90%;
					padding: 15px;
					border-radius: 8px;
					min-height: auto;
					max-height: 90vh;
					font-size: 14px;
				}

				.drop-zone-container h2 {
					font-size: 18px;
					text-align: center;
					padding-left: 0;
				}

				.drop-zone {
					padding: 10px;
					font-size: 14px;
				}

				.modal-footer {
					flex-direction: column;
					align-items: stretch;
					gap: 10px;
					padding-left: 0;
				}
				
				#upload,
				#add,
				#cancel {
					width: 100%;
				}
			}

			@media (max-width: 768px) {
				#header nav ul {
					display: flex;
					flex-direction: row;
					flex-wrap: nowrap;
					justify-content: center;
					align-items: center;
					gap: 4px; /* smaller gap between nav items */
					padding: 0;
					margin: 0;
					overflow: hidden;
				}

				#header nav ul li {
					font-size: 13px; /* slightly smaller font */
					padding: 0 2px;
					white-space: nowrap;
				}

				#header nav ul li a {
					padding: 4px 6px; /* tighter button area */
				}
			}


		</style>
	</head>
	<body class="is-preload">

		<!-- Header -->
			<header id="header">
				<a href="index.html" class="title">Gagespace</a>
				<nav>
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="generic.php" class="active">File Server</a></li>
						<li><a href="filestorage.html">File Storage</a></li>
						<li><a href="#" onclick="document.getElementById('logoutForm').submit();">Logout</a></li>
						<form id="logoutForm" action="logout.php" method="post" style="display:none;"></form>

					</ul>
				</nav>
			</header>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">
					<h1 class="major">File Server</h1>
					<ul class="actions">
						<li><a href="#" class="button primary" onclick="openModal()">Upload</a></li>
						<li><a href="filestorage.html" class="button">File Storage</a></li>
					</ul>
					<p>Select <a href="#" onclick="openModal()">upload</a> to send a file to the server, select <a href="filestorage.html">file storage</a> to view all files that are uploaded to the server.</p>
				</div>
			</section>

		</div>

		<!-- Upload Modal -->
		<div id="uploadModal" class="modal">
			<div class="modal-content">
				<span class="close-btn" onclick="closeModal()">&times;</span>
				<div class="drop-zone-container">
					<h2>Add a file - Gagespace File Server</h2>
					<div id="drop-zone" class="drop-zone">
						Drop files here, or click below!
						<input type="file" id="fileInput" multiple hidden>
						<a href="#" id="upload" class="button icon solid fa-upload">Upload</a>
						
						<ul id="fileList"></ul>
					</div>
				</div>

				<div class="modal-footer">
					<form id="uploadForm" action="https://gagespace.com/upload.php" method="POST" enctype="multipart/form-data">
						<input type="file" id="fileInputReal" name="files[]" multiple hidden>
						<a href="#" id="add" class="button">ADD</a>
					</form>
					
					
					<a href="#" id="cancel" class="button" onclick="closeModal()">Cancel</a>
				</div>
				
			</div>
		</div>

	
		

		<script>
			const modal = document.getElementById("uploadModal");
			const dropZone = document.getElementById("drop-zone");
			const fileInput = document.getElementById("fileInput");
			const upload = document.getElementById("upload");
			const fileList = document.getElementById("fileList");

			function openModal() {
				modal.style.display = "flex";
			}

			function closeModal() {
				modal.style.display = "none";
			}

			// Handle drag-and-drop events
			upload.addEventListener("click", () => fileInput.click());

			document.addEventListener("keydown", (e) => {
				if (e.key === "Escape") closeModal();
			});

			dropZone.addEventListener("dragover", (event) => {
				event.preventDefault();
				dropZone.classList.add("highlight");
			});

			dropZone.addEventListener("dragleave", () => {
				dropZone.classList.remove("highlight");
			});

			dropZone.addEventListener("drop", (event) => {
				event.preventDefault();
				dropZone.classList.remove("highlight");
				const files = event.dataTransfer.files;
				handleFiles(files);
			});

			fileInput.addEventListener("change", (event) => {
				handleFiles(event.target.files);
			});

			function formatFileSize(size) {
				if (size >= 1073741824) { // 1 GB = 1073741824 bytes
					return (size / 1073741824).toFixed(2) + " GB";
				} else if (size >= 1048576) { // 1 MB = 1048576 bytes
					return (size / 1048576).toFixed(2) + " MB";
				} else if (size >= 1024) { // 1 KB = 1024 bytes
					return (size / 1024).toFixed(2) + " KB";
				} else {
					return size + " B"; // Bytes
				}
			}
			let selectedFiles = []; // Holds files from drag/drop or file picker
			function handleFiles(files) {
				if (files.length > 0) {
					for (const file of files) {
						selectedFiles.push(file);

						const listItem = document.createElement("li");

						// Create file download link
						const link = document.createElement("a");
						link.textContent = `${file.name}`;
						link.href = URL.createObjectURL(file);
						link.download = file.name;
						link.style.color = "#007bff"; // Ensure visibility

						const size = document.createElement("span");
						size.textContent = ` (${formatFileSize(file.size)})`;
						size.style.color = "#000000";

						// Create remove (X) button
						const removeBtn = document.createElement("span");
						removeBtn.textContent = "✖";
						removeBtn.style.cursor = "pointer";
						removeBtn.style.marginLeft = "10px";
						removeBtn.style.color = "black";
						removeBtn.onclick = function () {
							listItem.remove(); // Remove the file entry from the list
							selectedFiles = selectedFiles.filter(f => f.name !== file.name);
						};

						listItem.appendChild(link);
						listItem.appendChild(size);
						listItem.appendChild(removeBtn);
						fileList.appendChild(listItem);
					}
				}
			}

				// Submit files via form
			document.getElementById("add").addEventListener("click", function (e) {
				e.preventDefault();

				if (selectedFiles.length === 0) {
					alert("Please select a file first!");
					return;
				}

				const formData = new FormData();
				selectedFiles.forEach(file => formData.append("files[]", file));

				fetch("https://gagespace.com/upload.php", {
					method: "POST",
					body: formData
				})
				.then(response => response.text())
				.then(result => {
					console.log(result);
					alert("Upload successful!");
					closeModal();
					selectedFiles = [];
					fileList.innerHTML = "";
				})

				.catch(error => {
					alert("Upload failed.");
					console.error("Error:", error);
				});
			});

		</script>

		<!-- Footer -->
			<footer id="footer" class="wrapper alt" style="margin-top: 450px;">
				<div class="inner">
					<ul class="menu">
						<li>&copy; Untitled. All rights reserved.</li><li>Designer: Gage Hutson</li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>