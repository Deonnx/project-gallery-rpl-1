<?php
include('../includes/db.php');

$sql = "SELECT * FROM categories";
$categories = mysqli_query($conn, $sql);

$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
$sql = $category_id ? "SELECT * FROM photos WHERE category_id = ?" : "SELECT * FROM photos";
$stmt = mysqli_prepare($conn, $sql);
if ($category_id) mysqli_stmt_bind_param($stmt, "i", $category_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Home Five || Nuron - NFT Marketplace Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <meta name="theme-style-mode" content="1" />
    <!-- 0 == light, 1 == dark -->

    <!-- Favicon -->
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="assets/images/favicon.png"
    />
    <!-- CSS 
    ============================================ -->
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/vendor/slick.css" />
    <link rel="stylesheet" href="../assets/css/vendor/slick-theme.css" />
    <link rel="stylesheet" href="../assets/css/vendor/nice-select.css" />
    <link rel="stylesheet" href="../assets/css/plugins/feature.css" />
    <link rel="stylesheet" href="../assets/css/plugins/jquery-ui.min.css" />
    <link rel="stylesheet" href="../assets/css/vendor/odometer.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        
    $(document).ready(function(){
      // Add smooth scrolling to all links
      $("a").on('click', function(event) {
    
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
          // Prevent default anchor click behavior
          event.preventDefault();
    
          // Store hash
          var hash = this.hash;
    
          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){
       
            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        } // End if
      });
    });
    </script>

    <!-- Style css -->
    <link rel="stylesheet" href="../assets/css/style.css" />
  </head>

  <body class="template-color-1 with-particles">
    <div id="particles-js"></div>

    <!-- Start Header -->
    <header class="rn-header haeder-default header--sticky">
      <div class="container">
        <div class="header-inner">
          <div class="header-left">
            <div class="logo-thumbnail logo-custom-css">
              <a class="logo-light" href=""
                ><img src="../images/pp.jpeg" alt="" width="95px" 
              /></a>
            </div>
            <div class="mainmenu-wrapper">
              <nav id="sideNav" class="mainmenu-nav d-none d-xl-block">
                <!-- Start Mainmanu Nav -->
                <ul class="mainmenu">
                  <li>
                    <a href="#galery">Home</a>
                  </li>
                  <li><a href="#about">About Us!</a></li>
                  
                <!-- End Mainmanu Nav -->
              </nav>
            </div>
          </div>
          <div class="header-right">
            
            <div class="setting-option rn-icon-list d-block d-lg-none">
              <div class="icon-box search-mobile-icon">
                <button><i class='bx bx-search-alt-2' ></i></button>
              </div>
              <form
                id="header-search-1"
                action="#"
                method="GET"
                class="large-mobile-blog-search"
              >
                <div class="rn-search-mobile form-group">
                  <button type="submit" class="search-button">
                    <i class='bx bx-search-alt-2' ></i>
                  </button>
                  <input type="text" placeholder="Search ..." />
                </div>
              </form>
            </div>

            <div
              class="setting-option header-btn rbt-site-header"
              id="rbt-site-header"
            >
              <div class="icon-box">
                <a
                  id="connectbtn"
                  class="btn btn-primary-alta btn-small"
                  href="index_admin.html"
                  >Login Admin</a
                >
              </div>
            </div>

            <div class="setting-option rn-icon-list notification-badge">
             
            </div>

            <div class="header_admin" id="header_admin">
              <div class="setting-option rn-icon-list user-account">
                <div class="icon-box">
                  <a href="author.html"
                    ><img src="assets/images/icons/boy-avater.png" alt="Images"
                  /></a>
                  <div class="rn-dropdown">
                    <div class="rn-inner-top">
                      <h4 class="title">
                        <a href="product-details.html">Christopher William</a>
                      </h4>
                      <span><a href="#">Set Display Name</a></span>
                    </div>
                    <div class="rn-product-inner">
                      <ul class="product-list">
                        <li class="single-product-list">
                          <div class="thumbnail">
                            <a href="product-details.html"
                              ><img
                                src="assets/images/portfolio/portfolio-07.jpg"
                                alt="Nft Product Images"
                            /></a>
                          </div>
                          <div class="content">
                            <h6 class="title">
                              <a href="product-details.html">Balance</a>
                            </h6>
                            <span class="price">25 ETH</span>
                          </div>
                          <div class="button"></div>
                        </li>
                        <li class="single-product-list">
                          <div class="thumbnail">
                            <a href="product-details.html"
                              ><img
                                src="assets/images/portfolio/portfolio-01.jpg"
                                alt="Nft Product Images"
                            /></a>
                          </div>
                          <div class="content">
                            <h6 class="title">
                              <a href="product-details.html">Balance</a>
                            </h6>
                            <span class="price">25 ETH</span>
                          </div>
                          <div class="button"></div>
                        </li>
                      </ul>
                    </div>
                    <div class="add-fund-button mt--20 pb--20">
                      <a class="btn btn-primary-alta w-100" href="connect.html"
                        >Add Your More Funds</a
                      >
                    </div>
                    <ul class="list-inner">
                      <li><a href="author.html">My Profile</a></li>
                      <li><a href="edit-profile.html">Edit Profile</a></li>
                      <li><a href="connect.html">Manage funds</a></li>
                      <li><a href="login.html">Sign Out</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            
                  
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- End Header Area -->

   
    <!-- top top-seller end -->
    <!-- Start product area -->
   <!-- Start product area -->
<div class="rn-product-area rn-section-gapTop" id="galery">
  <div class="container">
    <div class="row mb--30 align-items-center">
      <div class="col-12">
        <h3
          class="title mb--0"
          data-sal-delay="150"
          data-sal="slide-up"
          data-sal-duration="800"
        >
          GALERY XII RPL 1
        </h3>
      </div>
    </div>

    <!-- Filter form -->
    <div class="default-exp-wrapper">
      <div class="inner">
        <form method="get" action="gallery.php">
          <label for="category_id">Filter by Category:</label>
          <select name="category_id" id="category_id">
            <option value="0">All</option>
            <?php while ($row = mysqli_fetch_assoc($categories)): ?>
              <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $category_id) echo 'selected'; ?>>
                <?php echo $row['name']; ?>
              </option>
            <?php endwhile; ?>
          </select>
          <input type="submit" value="Filter">
        </form>
      </div>
    </div>

    <!-- Gallery items -->
    <div class="row g-5 mt_dec--30">
      <?php while ($photo = mysqli_fetch_assoc($result)): ?>
        <div
          class="col-5 col-lg-4 col-md-6 col-sm-6 col-12"
          data-sal="slide-up"
          data-sal-delay="150"
          data-sal-duration="800"
        >
          <div class="product-style-one no-overlay with-placeBid">
            <div class="card-thumbnail">
             
              <a href="product-details.html" class="btn btn-primary">Place Bid</a>
            </div>
            <div class="product-share-wrapper">
              <div class="share-btn share-btn-activation dropdown">
                <button
                  class="icon"
                  type="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <svg
                    viewBox="0 0 14 4"
                    fill="none"
                    width="16"
                    height="16"
                    class="sc-bdnxRM sc-hKFxyN hOiKLt"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z"
                      fill="currentColor"
                    ></path>
                  </svg>
                </button>
                <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                  <button
                    type="button"
                    class="btn-setting-text share-text"
                    data-bs-toggle="modal"
                    data-bs-target="#shareModal"
                  >
                    Share
                  </button>
                  <button
                    type="button"
                    class="btn-setting-text report-text"
                    data-bs-toggle="modal"
                    data-bs-target="#reportModal"
                  >
                    Report
                  </button>
                </div>
              </div>
            </div>
            <div class="gallery">
              <div class="photo">
                <img src="<?php echo $photo['file_path']; ?>" alt="<?php echo $photo['title']; ?>">
                <p><?php echo $photo['title']; ?></p>
                <p><?php echo $photo['description']; ?></p>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
<!-- End product area -->


    <!-- end product area -->
    <!-- start service area -->
    <div class="rn-service-area rn-section-gapTop" id="about">
      <div class="container">
        <div class="row">
          <div class="col-12 mb--50">
            <h3
              class="title"
              data-sal-delay="150"
              data-sal="slide-up"
              data-sal-duration="800"
            >
              About Us!
            </h3>
          </div>
        </div>
        <div class="row g-5">
          <!-- start single service -->
          <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 col-12">
            <div
              data-sal="slide-up"
              data-sal-delay="150"
              data-sal-duration="800"
              class="rn-service-one color-shape-7"
            >
              <div class="inner">
                <div class="icon">
                  <img src="../images/pp.jpeg" alt="" width="100px" />
                </div>
               
                <div class="content">
                  <h4 class="title"><a href="#">ANGKATAN</a></h4>
                  <p class="description">
                    2022-2025
                  </p>
                  <a class="read-more-button" href="#"
                    ><i class="feather-arrow-right"></i
                  ></a>
                </div>
              </div>
              <a class="over-link" href="#"></a>
            </div>
          </div>
          <!-- End single service -->
          <!-- start single service -->
          <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 col-12">
            <div
              data-sal="slide-up"
              data-sal-delay="200"
              data-sal-duration="800"
              class="rn-service-one color-shape-1"
            >
              <div class="inner">
                <div class="icon">
                <img src="../images/pp.jpeg" alt="" width="100px" />
                </div>
               
                <div class="content">
                  <h4 class="title"><a href="#">WALI KELAS</a></h4>
                  <p class="description">
                   ANDIES PRAMUDIYANTARA S.KOM
                  </p>
                  <a class="read-more-button" href="#"
                    ><i class="feather-arrow-right"></i
                  ></a>
                </div>
              </div>
              <a class="over-link" href="#"></a>
            </div>
          </div>
          <!-- End single service -->
          <!-- start single service -->
          <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 col-12">
            <div
              data-sal="slide-up"
              data-sal-delay="250"
              data-sal-duration="800"
              class="rn-service-one color-shape-5"
            >
              <div class="inner">
                <div class="icon">
                <img src="../images/pp.jpeg" alt="" width="100px" />
                </div>
                
                <div class="content">
                  <h4 class="title"><a href="#">KETUA KELAS</a></h4>
                  <p class="description">
                    VERY YUASDI AKBAR
                  </p>
                  <a class="read-more-button" href="#"
                    ><i class="feather-arrow-right"></i
                  ></a>
                </div>
              </div>
              <a class="over-link" href="#"></a>
            </div>
          </div>
          <!-- End single service -->
          <!-- start single service -->
          <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 col-12">
            <div
              data-sal="slide-up"
              data-sal-delay="300"
              data-sal-duration="800"
              class="rn-service-one color-shape-6"
            >
              <div class="inner">
                <div class="icon">
                <img src="../images/pp.jpeg" alt="" width="100px" />
                </div>
               
                <div class="content">
                  <h4 class="title"><a href="#">SISWA SISWI BERPRESTASI</a></h4>
                  <p class="description">
                   ARDYNA ANGGRAENI FAARDIVO MAWARDHIEN
                  </p>
                  <a class="read-more-button" href="#"
                    ><i class="feather-arrow-right"></i
                  ></a>
                </div>
              </div>
              <a class="over-link" href="#"></a>
            </div>
          </div>
          <!-- End single service -->
        </div>
      </div>
    </div>
    
    <!-- End Footer Area -->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
    <!-- Start Top To Bottom Area  -->
    <div class="rn-progress-parent">
      <svg
        class="rn-back-circle svg-inner"
        width="100%"
        height="100%"
        viewBox="-1 -1 102 102"
      >
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
    </div>
    <!-- End Top To Bottom Area  -->
    <!-- JS ============================================ -->
    <script src="../assets/js/vendor/jquery.js"></script>
    <script src="../assets/js/vendor/jquery.nice-select.min.js"></script>
    <script src="../assets/js/vendor/jquery-ui.js"></script>
    <script src="../assets/js/vendor/modernizer.min.js"></script>
    <script src="../assets/js/vendor/feather.min.js"></script>
    <script src="../assets/js/vendor/slick.min.js"></script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/vendor/sal.min.js"></script>
    <script src="../assets/js/vendor/particles.js"></script>
    <script src="../assets/js/vendor/jquery.style.swicher.js"></script>
    <script src="../assets/js/vendor/js.cookie.js"></script>
    <script src="../assets/js/vendor/count-down.js"></script>
    <script src="../assets/js/vendor/isotop.js"></script>
    <script src="../assets/js/vendor/imageloaded.js"></script>
    <script src="../assets/js/vendor/backtoTop.js"></script>
    <script src="../assets/js/vendor/odometer.js"></script>
    <script src="../assets/js/vendor/jquery-appear.js"></script>
    <script src="../assets/js/vendor/scrolltrigger.js"></script>
    <script src="../assets/js/vendor/jquery.custom-file-input.js"></script>
    <script src="../assets/js/vendor/savePopup.js"></script>
    <script src="../assets/js/vendor/vanilla.tilt.js"></script>

    <!-- main JS -->
    <script src="../assets/js/main.js"></script>
    <!-- Meta Mask  -->
    <script src="../assets/js/vendor/web3.min.js"></script>
    <script src="../assets/js/vendor/maralis.js"></script>
    <script src="../assets/js/vendor/nft.js"></script>
    <script>
      particlesJS(
        "particles-js",

        {
          particles: {
            number: {
              value: 40,
              density: {
                enable: true,
                value_area: 1000,
              },
            },
            color: {
              value: ["#7FC7BD", "#ffE7BD"],
            },
            shape: {
              type: "circle",
              stroke: {
                width: 0,
                color: "#000000",
              },
              polygon: {
                nb_sides: 4,
              },
              image: {
                src: "img/github.svg",
                width: 100,
                height: 100,
              },
            },
            opacity: {
              value: 0.8,
              random: true,
              anim: {
                enable: false,
                speed: 1,
                opacity_min: 0.1,
                sync: false,
              },
            },
            size: {
              value: 3,
              random: true,
              anim: {
                enable: false,
                speed: 40,
                size_min: 0.08,
                sync: false,
              },
            },
            line_linked: {
              enable: false,
              distance: 150,
              color: "#ffffff",
              opacity: 0.4,
              width: 1,
            },
            move: {
              enable: true,
              speed: 4,
              direction: "none",
              random: false,
              straight: false,
              out_mode: "out",
              attract: {
                enable: false,
                rotateX: 600,
                rotateY: 1200,
              },
            },
          },
          interactivity: {
            detect_on: "canvas",
            events: {
              onhover: {
                enable: true,
                mode: "repulse",
              },
              onclick: {
                enable: true,
                mode: "push",
              },
              resize: true,
            },
            modes: {
              grab: {
                distance: 400,
                line_linked: {
                  opacity: 1,
                },
              },
              bubble: {
                distance: 800,
                size: 40,
                duration: 2,
                opacity: 8,
                speed: 3,
              },
              repulse: {
                distance: 200,
              },
              push: {
                particles_nb: 4,
              },
              remove: {
                particles_nb: 2,
              },
            },
          },
          retina_detect: true,
          config_demo: {
            hide_card: false,
            background_color: "#b61924",
            background_image: "",
            background_position: "50% 50%",
            background_repeat: "no-repeat",
            background_size: "cover",
          },
        }
      );
    </script>
  </body>
</html>
