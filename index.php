<?php
include 'templates/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>

  <style>
    /* garis bawah */
    .custom-underline {
      display: inline-block;
      position: relative;
    }

    .custom-underline::before {
      content: "";
      position: absolute;
      width: 100%;
      height: 6px;
      background-color: #fff;
      bottom: -8px;
      border-radius: 150px;
    }

    /* card */
    .card {
      position: relative;
      overflow: hidden;
      transition: filter 0.5s ease-in-out;
    }

    .card:hover {
      transition: filter 0.5s ease-in-out;
      border: 1px solid white;
    }

    .card img {
      transition: filter 0.2s ease-in-out;
    }

    .card:hover img {
      filter: blur(30px);
    }

    .overlay {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      width: 100%;
      opacity: 0;
      transition: opacity 0.2s ease-in-out;
    }

    .card:hover .overlay {
      opacity: 1;
    }

    .overlay img {
      width: 50px;
      border-radius: 50%;
      margin-bottom: 10px;
    }

    .overlay h6 {
      color: white;
      /* border: 1px solid white; */
      padding: 5px;
      border-radius: 5px;
    }

    .overlay .logo-and-text {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* hero */
    .hero {
      position: relative;
      overflow: hidden;
      color: #fff;
      text-align: center;
    }

    .hero video {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: auto;
      object-fit: cover;
      z-index: -1;
    }
  </style>
</head>

<body class="custom-font">
  <div class="container mt-5">
    <div class="md-5 mt-5 pt-5">
      <div class="hero">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">

            <?php
            $sql2 = "SELECT * FROM slide";
            $cek2 = mysqli_query($koneksi, $sql2);
            $jml2 = mysqli_num_rows($cek2);

            if ($jml2 > 0) {
              $result2 = mysqli_query($koneksi, $sql2);
              $hasil2 = 0;
              while ($row2 = mysqli_fetch_assoc($result2)) {
                $id_slide = $row2['id_slide'];
                $nama_slide = $row2['nama'];
                $gambar_slide = $row2['gambar'];

                if ($id_slide == "ZS001") {
            ?>

                  <div class="carousel-item active">
                    <img src="data:image/payment/;base64,<?php echo base64_encode($gambar_slide) ?>" class="rounded mx-auto img-fluid d-block" width="900" alt="<?php echo $nama_slide ?>">
                  </div>

                <?php
                } else {
                ?>

                  <div class="carousel-item">
                    <img src="data:image/payment/;base64,<?php echo base64_encode($gambar_slide) ?>" class="rounded mx-auto img-fluid d-block" width="900" alt="<?php echo $nama_slide ?>">
                  </div>

            <?php
                }
              }
            }
            ?>

          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
    <div class="mt-5">
      <h4 class="mb-4 custom-underline text-light">Mobile Legends</h4>
      <div class="container">
        <div class="row">
          <?php
          $sql = "SELECT * FROM produk";
          $cek = mysqli_query($koneksi, $sql);
          $jml = mysqli_num_rows($cek);

          if ($jml > 0) {
            $result = mysqli_query($koneksi, $sql);
            $hasil = 0;
            while ($row = mysqli_fetch_assoc($result)) {
              $id_produk = $row['id_produk'];
              $nama_produk = $row['nama'];
              $gambar_produk = $row['gambar'];
              $kategori_produk = $row['genre'];
              $desc_produk = $row['deskripsi'];
          ?>
            <div class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-2">
              <div class="mb-4">
                <a href="order/index.php?id=<?php echo $id_produk ?>&&c=<?php echo $kategori_produk ?>" class="card text-bg-dark text-decoration-none shadow" style="width: 10rem;">
                  <?php echo '<img class="card-img-top img-fluid" src="data:image/product/;base64,' . base64_encode($gambar_produk) . '"/>'; ?>
                  <div class="card-body overlay">
                    <div class="logo-and-text">
                      <h6 class="card-text align-middle text-center text-light"><?php echo $nama_produk; ?></h6>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <a href="https://wa.me/087856754195" class="btn btn-service btn-bulat d-flex justify-content-center align-items-center">
    <h2><i class="fab fa-whatsapp fa-lg" style="color: #ffffff; margin-top: 25px; margin-left: 2px"></i></h2>
  </a>
</body>
<footer>
  <?php
  include 'templates/footer.php';
  ?>
</footer>

</html>