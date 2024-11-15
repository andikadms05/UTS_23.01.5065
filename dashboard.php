<?php
#add file config
require "./config.php";
#start php session
session_start();
#take user status accses
$akses = @$_SESSION["akses"];

#check if user has an accses
if ($akses != true){
    #redirect to login if access is false
    header("location:./index.php?error=Halaman Dashboard Harus Login");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #fff;
        }

        form {
            width: fit-content;
            margin: 20px auto;
            text-align: center;
        }

        input[type="text"] {
            padding: 8px;
            margin-right: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            padding: 8px 15px;
            border: none;
            background-color: #7b3f00;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #9c4b00;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            background-color: #f9f9f9;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #7b3f00;
            color: white;
        }

        td {
            color: #333;
        }

        a {
            display: block;
            text-align: center;
            margin: 20px auto;
            width: 120px;
            padding: 10px;
            background-color: #7b3f00;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #9c4b00;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 400px;
            text-align: center;
            position: relative;
            margin: 10px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            cursor: pointer;
            color: #333;
        }

        .modal-content form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .modal-content label,
        .modal-content input {
            width: 45%;
            margin: 8px 0;
        }

        .modal-content button {
            margin-top: 10px;
            padding: 8px 15px;
            border: none;
            background-color: #7b3f00;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .modal-content button:hover {
            background-color: #9c4b00;
        }
</style>

    </style>
</head>
<body>
    <h1>Dashboard</h1>
    <h1>Rekapitulasi Nilai</h1>

    <?php
        $sql = "select * from responsi";
        $query = mysqli_query($sambung, $sql);
    ?>

    <main>
        <form action="add_data.php" method="POST">
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required>
            <button type="submit">Tambah Data</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tugas 1</th>
                    <th>Tugas 2</th>
                    <th>Tugas 3</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1; // Inisialisasi nomor
                    while($datauser = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>". $no . "</td>"; // Kolom nomor
                        echo "<td>". $datauser["nama"] . "</td>";
                        echo "<td>". $datauser["tugas 1"] . "</td>";
                        echo "<td>". $datauser["tugas 2"] . "</td>";
                        echo "<td>". $datauser["tugas 3"] . "</td>";
                        echo "<td>". $datauser["UTS"] . "</td>"; // Tambahkan kolom UTS
                        echo "<td>". $datauser["UAS"] . "</td>"; // Tambahkan kolom UAS
                        echo "<td>";
                        echo "<button onclick=\"openModal('". $datauser["nama"] ."', '". $datauser["tugas 1"] ."', '". $datauser["tugas 2"] ."', '". $datauser["tugas 3"] ."', '". $datauser["UTS"] ."', '". $datauser["UAS"] ."')\">Edit</button>";
                        echo "<form action='proses_delete.php' method='POST' style='display:inline-block;'>";
                        echo "<input type='hidden' name='nama' value='". $datauser["nama"] ."'>";
                        echo "<button type='submit' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                        $no++; // Tambah nomor
                    }
                ?>
            </tbody>
        </table>

        <a href="./logout.php">Log out</a>

        <!-- Modal for editing data -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h3>Update Nilai</h3>
                <form action="update.php" method="POST">
                    <input type="hidden" id="modalNama" name="nama">
                    <label for="modalTugas1">Tugas 1:</label>
                    <input type="text" id="modalTugas1" name="tugas_1" required><br><br>
                    <label for="modalTugas2">Tugas 2:</label>
                    <input type="text" id="modalTugas2" name="tugas_2" required><br><br>
                    <label for="modalTugas3">Tugas 3:</label>
                    <input type="text" id="modalTugas3" name="tugas_3" required><br><br>
                    <label for="modalUTS">UTS:</label>
                    <input type="text" id="modalUTS" name="uts" required><br><br>
                    <label for="modalUAS">UAS:</label>
                    <input type="text" id="modalUAS" name="uas" required><br><br>
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>

        <script>
            // Open the modal and populate data
            function openModal(nama, tugas1, tugas2, tugas3, uts, uas) {
                document.getElementById('modalNama').value = nama;
                document.getElementById('modalTugas1').value = tugas1;
                document.getElementById('modalTugas2').value = tugas2;
                document.getElementById('modalTugas3').value = tugas3;
                document.getElementById('modalUTS').value = uts;
                document.getElementById('modalUAS').value = uas;
                document.getElementById('editModal').style.display = 'flex';
            }

            // Close the modal
            function closeModal() {
                document.getElementById('editModal').style.display = 'none';
            }

            // Close modal when clicking outside content
            window.onclick = function(event) {
                var modal = document.getElementById('editModal');
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }
        </script>

</body>
</html>
