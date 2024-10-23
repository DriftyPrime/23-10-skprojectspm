<?php include 'header.php'; ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">upload</h2>
            <form action="" method="post" name="upload_excel" enctype="multipart/form-data">
                <input type="file" name="file" id="file" accept=".csv"><br>
                <button type="submit" id="submit" name="Import" class="btn btn-primary">Upload</button>
            </form><br><br><br><br><br><br><br><br>
            <style>
                p{
                    color: red;
                    text-align: left;
                }
            </style>
            <h1 style="color:red; text-align:left">Pastikan fail ialah fail csv</h1>
            <p style="text-decoration:underline">Contoh</p>
            <p> contoh@gmail.com,contohnama,passwordcontoh,nombortelefoncontoh,1(rumahsukan)</p>
            <p>*bagi rumah sukan</p>
            <p>Ruby=1, Emerald=2, Topaz=3, Saphire=4, Amethyst=5</p>
        </div>  
    </div>    
</div>
<?php 
if (isset($_POST["Import"])) {
    $filename = $_FILES["file"]["tmp_name"];
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        $successful_inserts = 0;
        $total_rows = 0;
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            $total_rows++;
            try {
                $stmt = mysqli_prepare($conn, "INSERT INTO peserta (idpeserta, nama, password, nombor_telefon, idrumahsukan) VALUES (?,?,?,?,?)");
                mysqli_stmt_bind_param($stmt, "ssssi", $getData[0], $getData[1], $getData[2], $getData[3], $getData[4]);
                if (mysqli_stmt_execute($stmt)) {
                    $successful_inserts++;
                } else {
                    // Handle SQL error without showing the raw error message
                    throw new mysqli_sql_exception("Failed to insert data for row $total_rows.");
                }
                mysqli_stmt_close($stmt);
            } catch (mysqli_sql_exception $e) {
                // Log the detailed error (optional) and show a generic error message to the user
                error_log($e->getMessage()); // Log the error for debugging
                echo "<script>alert('Error inserting data for row $total_rows. This might be due to duplicate data or other issues.')</script>";
            }
        }
        fclose($file);
        if ($successful_inserts > 0) {
            echo "<script>alert('Successfully imported $successful_inserts out of $total_rows records.')</script>";
        } else {
            echo "<script>alert('No records were imported. Please check the file format.')</script>";
        }
    } else {
        echo "<script>alert('File is empty or not valid.')</script>";
    }
}
