<?php

$servername = "localhost";
$database = "db_qrcode";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['simpan'])) {
  $kode_barang = $_POST['kode_barang'];
  $insert = mysqli_query($conn, "INSERT INTO `tbl_barang` (`id`, `kode_barang`) VALUES (NULL, '$kode_barang')");
  if ($insert) {
    echo "
    <script>
    alert('Kode barang berhasil disimpan');
    </script>
    ";
  } else {
    echo "
    <script>
    alert('Kode barang gagal disimpan');
    </script>
    ";
  }
}

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>COBA QRCODE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

</head>

<body>
  <div class="container">
    <div class="text-center">
      <h1 class="text-success">
        Nyoba QRCODE
      </h1>
      <h2>
        Menggunakan HTML 5 QRCode
      </h2>
    </div>

    <div class="row mt-3">
      <div class="col-lg-6 m-auto">
        <div class="card border-dark mb-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Pendataan Barang</h5>
          </div>
          <div class="card-body">
            <form action="" method="post" class="form-simpan">
              <div class="mb-3">
                <label for="kode_barang" class="form-label">Kode barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
              </div>
              <div class="mb-3">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-3 mt-3">
      <div class="col-md-6 m-auto">

        <button id="refresh" onclick="window.location.reload();">Refresh</button>

        <hr>

        <div id="qr-reader" style="width: 100%;"></div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  <script src="html5-qrcode.min.js"></script>

  <script>
    // Square QR box with edge size = 70% of the smaller edge of the viewfinder.
    let qrboxFunction = function(viewfinderWidth, viewfinderHeight) {
      let minEdgePercentage = 0.7; // 70%
      let minEdgeSize = Math.min(viewfinderWidth, viewfinderHeight);
      let qrboxSize = Math.floor(minEdgeSize * minEdgePercentage);
      return {
        width: qrboxSize,
        height: qrboxSize
      };
    };

    function onScanSuccess(decodedText, decodedResult) {
      // console.log(`Code matched = ${decodedText}`, decodedResult);
      // html5QrcodeScanner.clear();
      document.getElementById('kode_barang').value = decodedText;
    }

    function onScanFailure(error) {
      console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
      "qr-reader", {
        fps: 10,
        qrbox: qrboxFunction
      },
      /* verbose= */
      false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
  </script>

</body>

</html>