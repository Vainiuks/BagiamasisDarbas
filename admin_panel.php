<?php
include_once 'navigation_bar.php';
include_once 'classes/product.class.php';
include_once 'classes/filter.class.php';
include_once 'classes/feedback.class.php';
include_once 'classes/receipt.class.php';
$productObj = new Product();
$filterObj = new Filter();
$feedbackObj = new FeedBack();
$receiptObj = new Receipt();

$products = $productObj->getProducts();
$categories = $filterObj->getCategories();
$attributes = $filterObj->getAttributes();
$comments = $feedbackObj->getCommentsForAdminPanel();
$receipts = $receiptObj->getReceipts();


$_SESSION['panel_window'] = 'product';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administratoriaus panelė</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <style>
    /* [class*="col"] {
        padding: 1rem;
        background-color: #33b5e5;
        border: 2px solid #fff;
        color: #fff;
      }
      .child{
        background-color: #2041d3;
      } */
  </style>
</head>

<body>

  <div class="container" style="margin-top: 40px;">
    <div class="row justify-content-md-center">
      <div class="col-lg-3 col-md-6 text-center" style=" 
            padding: 1rem;
            background-color: #FE828C;
            border: 2px solid #fff;
            color: #fff;">
        <a href="#" class="" id="product_panel" style="text-decoration: none; color:white;">Produktų valdymo panelė</a>
      </div>
      <div class="col-lg-3 col-md-6 text-center" style=" 
            padding: 1rem;
            background-color: #FE828C;
            border: 2px solid #fff;
            color: #fff;">
        <a href="#" class="" id="category_panel" style="text-decoration: none; color:white;">Kategorijų valdymo panelė</a>
      </div>
      <div class="col-lg-3 col-md-6 text-center" style=" 
            padding: 1rem;
            background-color: #FE828C;
            border: 2px solid #fff;
            color: #fff;">
        <a href="#" class="" id="attribute_panel" style="text-decoration: none; color:white;">Atribūtų valdymo panelė</a>
      </div>
    </div>
  </div>

  <div class="container" style="margin-top: 0.5px;">
    <div class="row justify-content-md-center">
      <div class="col-lg-3 col-md-6 text-center" style=" 
            padding: 1rem;
            background-color: #FE828C;
            border: 2px solid #fff;
            color: #fff;">
        <a href="#" class="" id="comment_panel" style="text-decoration: none; color:white;">Komentarų valdymo panelė</a>
      </div>
      <div class="col-lg-3 col-md-6 text-center" style=" 
            padding: 1rem;
            background-color: #FE828C;
            border: 2px solid #fff;
            color: #fff;">
        <a href="#" class="" id="shipping_panel" style="text-decoration: none; color:white;">Užsakymų valdymo panelė </a>
      </div>
      <div class="col-lg-3 col-md-6 text-center" style=" 
            padding: 1rem;
            background-color: #FE828C;
            border: 2px solid #fff;
            color: #fff;">
        <a href="#" class="" id="other_panel" style="text-decoration: none; color:white;">Kitų valdymų panelė</a>
      </div>
    </div>
  </div>


  <div class="container">
    <div class="row flex-lg-nowrap">

      <div class="col" style="margin-top: 20px; display:block;" id="ProductPanel">
        <div class="e-tabs mb-3 px-3">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" href="#">Produktų valdymo panelė</a></li>
          </ul>
        </div>

        <div class="row flex-lg-nowrap">
          <div class="col mb-3">
            <div class="e-panel card">
              <div class="card-body">
                <div class="card-title">
                </div>
                <div class="e-table">
                  <div class="table-responsive table-lg mt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="align-top">
                            <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                              <input type="checkbox" class="custom-control-input" id="all-items">
                              <label class="custom-control-label" for="all-items"></label>
                            </div>
                          </th>
                          <th>Nuotrauka</th>
                          <th class="max-width">Pavadinimas - Markė - Modelis - Prekės gamintojas - Kaina</th>
                          <th> </th>
                          <th>Veiksmai</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($products as $product => $value) : ?>
                          <tr>
                            <td class="align-middle">
                              <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                <input type="checkbox" class="custom-control-input" id="item-1">
                                <label class="custom-control-label" for="item-1"></label>
                              </div>
                            </td>
                            <td class="align-middle text-center">
                              <div class="bg-light d-inline-flex justify-content-center align-items-center align-top" style="width: 50px; height: 50px; border-radius: 3px;"><img src="<?php echo $value['product_Image']; ?>" alt="" width="50" height="30" /></div>
                            </td>
                            <td class="text-nowrap align-middle"><?php echo $value['product_Name'] . " - " . $value['car_Brand'] . " - " . $value['car_Model'] . " - " . $value['product_Brand'] . " - " . $value['product_Price'] . "€"; ?></td>
                            <td class="text-center align-middle"><i class="fa fa-fw text-secondary cursor-pointer fa-toggle-on"></i></td>
                            <td class="text-center align-middle">
                              <div class="btn-group align-top">
                                <form action="handling/admin_panel.han.php" method="POST">
                                  <input type="hidden" name="product_Image" value="<?php echo $value['product_Image']; ?>">
                                  <input type="hidden" name="productID" value="<?php echo $value['productID']; ?>">
                                  <button class="btn btn-sm btn-outline-secondary" type="submit" name="delete_product"><i class="fa fa-trash"></i></button>
                                </form>
                                <button class="btn btn-sm btn-outline-secondary" type="submit" name="" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#updateProductModal<?php echo $value['productID']; ?>"><i class="fa fa-pencil"></i></button>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="d-flex justify-content-center">
                    <ul class="pagination mt-3 mb-0">
                      <li class="disabled page-item"><a href="#" class="page-link">‹</a></li>
                      <li class="active page-item"><a href="#" class="page-link">1</a></li>
                      <li class="page-item"><a href="#" class="page-link">2</a></li>
                      <li class="page-item"><a href="#" class="page-link">3</a></li>
                      <li class="page-item"><a href="#" class="page-link">4</a></li>
                      <li class="page-item"><a href="#" class="page-link">5</a></li>
                      <li class="page-item"><a href="#" class="page-link">›</a></li>
                      <li class="page-item"><a href="#" class="page-link">»</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-3 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center px-xl-3">
                  <button class="btn btn-success btn-block" type="submit" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#productModal">Nauja prekė</button>
                </div>
                <hr class="my-3">
                <div class="e-navlist e-navlist--active-bold">
                  <ul class="nav">
                    <li class="nav-item active"><a href="" class="nav-link"><span>Visi</span>&nbsp;<small>/&nbsp;32</small></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><span>Aktyvus</span>&nbsp;<small>/&nbsp;16</small></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><span>Pasirinkti</span>&nbsp;<small>/&nbsp;0</small></a></li>
                  </ul>
                </div>
                <hr class="my-3">
                <div>
                  <div class="form-group">
                    <label>Paieška pagal raktinį žodį:</label>
                    <div><input class="form-control w-100" type="text" placeholder="Pavadinimas" value=""></div>
                  </div>
                </div>
                <hr class="my-3">
              </div>
            </div>
          </div>
        </div>

        <!-- Atnaujinti produkta modal -->
        <?php foreach($products as $product => $value): ?>
        <div class="modal fade" role="dialog" tabindex="-1" id="updateProductModal<?php echo $value['productID']; ?>">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Atnaujinti prekę</h5>
              </div>
              <div class="modal-body">
                <div class="py-1">
                  <form class="form" action="handling/admin_panel.han.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col">
                      <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Automobilio markė</label>
                              <input class="form-control" type="text" name="carBrand" value="<?php echo $value['car_Brand'] ?>" placeholder="<?php echo $value['car_Brand']; ?>">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Automobilio modelis</label>
                              <input class="form-control" type="text" name="carModel" value="<?php echo $value['car_Model'] ?>" placeholder="<?php echo $value['car_Model']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Prekės prekinis ženklas</label>
                              <input class="form-control" type="text" name="productBrand" value="<?php echo $value['product_Brand'] ?>" placeholder="<?php echo $value['product_Brand']; ?>">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Prekės pavadinimas</label>
                              <input class="form-control" type="text" name="productName" value="<?php echo $value['product_Brand'] ?>" placeholder="<?php echo $value['product_Brand']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Prekės kaina</label>
                              <input class="form-control" type="text" name="productPrice" value="<?php echo $value['product_Price'] ?>" placeholder="<?php echo $value['product_Price']; ?>">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Prekės svoris</label>
                              <input class="form-control" type="text" name="productWeight" value="<?php echo $value['product_Weight'] ?>" placeholder="<?php echo $value['product_Weight']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Prekės tipas</label>
                              <input class="form-control" name="productType" type="text" value="<?php echo $value['product_Type'] ?>" placeholder="<?php echo $value['product_Type']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>Prekės aprašymas</label>
                              <textarea class="form-control" name="productDescription" rows="5" placeholder="<?php echo $value['product_Description']; ?>"><?php echo $value['product_Description'] ?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="custom-file">
                              <input type="hidden" name="product_Image" value="<?php echo $value['product_Image']; ?>">
                              <label class="custom-file-label" for="picture2">Pasirinkite nuotrauką...</label>
                              <input type="file" class="custom-file-input" name="productNewImage" id="picture2">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row pt-3">
                      <div class="col d-flex justify-content-end space-between: 5px;">
                      <input type="hidden" name="productID" value="<?php echo $value['productID']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Uždaryti</button>
                        <button class="btn btn-primary" name="update_product" type="submit">Atnaujinti</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>

        <!-- Sukurti produkta modal -->
        <div class="modal fade" role="dialog" tabindex="-1" id="productModal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Sukurti naują prekę</h5>
              </div>
              <div class="modal-body">
                <div class="py-1">
                  <form class="form" action="handling/admin_panel.han.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col">
                      <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Automobilio markė</label>
                              <input class="form-control" type="text" name="carBrand" placeholder="BMW">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Automobilio modelis</label>
                              <input class="form-control" type="text" name="carModel" placeholder="E39">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Prekės prekinis ženklas</label>
                              <input class="form-control" type="text" name="productBrand" placeholder="BOSCH">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Prekės pavadinimas</label>
                              <input class="form-control" type="text" name="productName" placeholder="Tepalo filtras">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Prekės kaina</label>
                              <input class="form-control" type="text" name="productPrice" placeholder="7.99€">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Prekės svoris</label>
                              <input class="form-control" type="text" name="productWeight" placeholder="200g">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Prekės tipas</label>
                              <input class="form-control" name="productType" type="text" value="" placeholder="tepalo_filtras">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>Prekės aprašymas</label>
                              <textarea class="form-control" name="productDescription" rows="5" placeholder="Prekės aprašymas..."></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="custom-file">
                              <label class="custom-file-label" for="picture">Pasirinkite nuotrauką...</label>
                              <input type="file" class="custom-file-input" name="productImage" id="picture">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row pt-3">
                      <div class="col d-flex justify-content-end space-between: 5px;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Uždaryti</button>
                        <button class="btn btn-primary" name="create_product" type="submit">Sukurti</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="col" style="margin-top: 20px; display:none;" id="CategoryPanel">
        <div class="e-tabs mb-3 px-3">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" href="#">Kategorijų valdymo panelė</a></li>
          </ul>
        </div>

        <div class="row flex-lg-nowrap">
          <div class="col mb-3">
            <div class="e-panel card">
              <div class="card-body">
                <div class="card-title">
                </div>
                <div class="e-table">
                  <div class="table-responsive table-lg mt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="align-top">
                            <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                              <input type="checkbox" class="custom-control-input" id="all-items">
                              <label class="custom-control-label" for="all-items"></label>
                            </div>
                          </th>
                          <th class="max-width" style="width: 30px;">Kategorijos ID</th>
                          <th class="max-width">Kategorijos pavadinimas</th>
                          <th class="max-width">Kategorijos pavadinimas(duomenų bazėje)</th>
                          <th> </th>
                          <th>Veiksmai</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($categories as $category => $value) : ?>
                          <tr>
                            <td class="align-middle">
                              <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                <input type="checkbox" class="custom-control-input" id="item-1">
                                <label class="custom-control-label" for="item-1"></label>
                              </div>
                            </td>
                            <td class="text-nowrap align-middle"><?php echo $value['filterCategoryID']; ?></td>
                            <td class="text-nowrap align-middle"><?php echo $value['display_Category_Name']; ?></td>
                            <td class="text-nowrap align-middle"><?php echo $value['category_Name']; ?></td>
                            <td class="text-center align-middle"><i class="fa fa-fw text-secondary cursor-pointer fa-toggle-on"></i></td>
                            <td class="text-center align-middle">
                              <div class="btn-group align-top">
                                <form action="handling/admin_panel.han.php" method="POST">
                                  <input type="hidden" name="filterCategoryID" value="<?php echo $value['filterCategoryID']; ?>">
                                  <button class="btn btn-sm btn-outline-secondary" type="submit" name="delete_category"><i class="fa fa-trash"></i></button>
                                </form>
                                <button class="btn btn-sm btn-outline-secondary" type="submit" name="" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#categoryModal<?php echo $value['filterCategoryID']; ?>"><i class="fa fa-pencil"></i></button>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="d-flex justify-content-center">
                    <ul class="pagination mt-3 mb-0">
                      <li class="disabled page-item"><a href="#" class="page-link">‹</a></li>
                      <li class="active page-item"><a href="#" class="page-link">1</a></li>
                      <li class="page-item"><a href="#" class="page-link">2</a></li>
                      <li class="page-item"><a href="#" class="page-link">3</a></li>
                      <li class="page-item"><a href="#" class="page-link">4</a></li>
                      <li class="page-item"><a href="#" class="page-link">5</a></li>
                      <li class="page-item"><a href="#" class="page-link">›</a></li>
                      <li class="page-item"><a href="#" class="page-link">»</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-3 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center px-xl-3">
                <button class="btn btn-success btn-block" type="submit" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#categoryModal">Nauja kategorija</button>
                </div>
                <hr class="my-3">
                <div class="e-navlist e-navlist--active-bold">
                  <ul class="nav">
                    <li class="nav-item active"><a href="" class="nav-link"><span>Visi</span>&nbsp;<small>/&nbsp;32</small></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><span>Aktyvus</span>&nbsp;<small>/&nbsp;16</small></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><span>Pasrinkti</span>&nbsp;<small>/&nbsp;0</small></a></li>
                  </ul>
                </div>
                <hr class="my-3">
                <div>
                  <div class="form-group">
                    <label>Paieška pagal raktinį žodį:</label>
                    <div><input class="form-control w-100" type="text" placeholder="Žodis" value=""></div>
                  </div>
                </div>
                <hr class="my-3">
              </div>
            </div>
          </div>
        </div>

        <!-- Atnaujinti kategorija modal -->
        <?php foreach($categories as $category => $value): ?>
        <div class="modal fade" role="dialog" tabindex="-1" id="categoryModal<?php echo $value['filterCategoryID']; ?>">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Atnaujinti filtro kategoriją</h5>
              </div>
              <div class="modal-body">
                <div class="py-1">
                  <form class="form" method="POST" action="handling/admin_panel.han.php">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Kategorijos pavadinimas</label>
                              <input class="form-control" name="display_Category_Name" type="text" value="<?php echo $value['display_Category_Name']; ?>" placeholder="<?php echo $value['display_Category_Name']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="row pt-1">
                            <div class="form-group">
                              <label>Kategorijos pavadinimas duomenų bazėje</label>
                              <input class="form-control" name="category_Name" type="text" value="<?php echo $value['category_Name']; ?>" placeholder="<?php echo $value['category_Name']; ?>">
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row pt-3">
                      <div class="col d-flex justify-content-end" style="margin-left: 5px;">
                      <input type="hidden" name="filterCategoryID" value="<?php echo $value['filterCategoryID']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Uždaryti</button>
                        <button class="btn btn-primary" name="update_category" type="submit">Atnaujinti</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>

        <!-- Sukurti nauja kategorija modal -->
        <div class="modal fade" role="dialog" tabindex="-1" id="categoryModal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Sukurti naują filtro kategoriją</h5>
              </div>
              <div class="modal-body">
                <div class="py-1">
                  <form class="form" method="POST" action="handling/admin_panel.han.php">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Kategorijos pavadinimas</label>
                              <input class="form-control" name="display_Category_Name" type="text" placeholder="Stabdžių sistema">
                            </div>
                          </div>
                        </div>
                        <div class="row pt-1">
                            <div class="form-group">
                              <label>Kategorijos pavadinimas duomenų bazėje</label>
                              <input class="form-control" name="category_Name" type="text" placeholder="stabdziai">
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row pt-3">
                      <div class="col d-flex justify-content-end" style="margin-left: 5px;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Uždaryti</button>
                        <button class="btn btn-primary" name="create_category" type="submit">Sukurti</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="col" style="margin-top: 20px; display:none;" id="AttributePanel">
        <div class="e-tabs mb-3 px-3">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" href="#">Atribūtų valdymo panelė</a></li>
          </ul>
        </div>

        <div class="row flex-lg-nowrap">
          <div class="col mb-3">
            <div class="e-panel card">
              <div class="card-body">
                <div class="card-title">
                </div>
                <div class="e-table">
                  <div class="table-responsive table-lg mt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="align-top">
                            <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                              <input type="checkbox" class="custom-control-input" id="all-items">
                              <label class="custom-control-label" for="all-items"></label>
                            </div>
                          </th>
                          <th class="max-width">Požymio pavadinimas</th>
                          <th class="max-width">Požymio pavadinimas(duomenų bazėje)</th>
                          <th> </th>
                          <th>Veiksmai</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($attributes as $attribute => $value) : ?>
                          <tr>
                            <td class="align-middle">
                              <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                <input type="checkbox" class="custom-control-input" id="item-1">
                                <label class="custom-control-label" for="item-1"></label>
                              </div>
                            </td>
                            <td class="text-nowrap align-middle"><?php echo $value['display_Name']; ?></td>
                            <td class="text-nowrap align-middle"><?php echo $value['attribute_Name']; ?></td>
                            <td class="text-center align-middle"><i class="fa fa-fw text-secondary cursor-pointer fa-toggle-on"></i></td>
                            <td class="text-center align-middle">
                              <div class="btn-group align-top">
                                <form action="handling/admin_panel.han.php" method="POST">
                                  <input type="hidden" name="filterAttributeID" value="<?php echo $value['filterAttributeID']; ?>">
                                  <button class="btn btn-sm btn-outline-secondary" type="submit" name="delete_attribute"><i class="fa fa-trash"></i></button>
                                </form>
                                <button class="btn btn-sm btn-outline-secondary" type="submit" name="" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#updateAttributeModal<?php echo $value['filterAttributeID']; ?>"><i class="fa fa-pencil"></i></button>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="d-flex justify-content-center">
                    <ul class="pagination mt-3 mb-0">
                      <li class="disabled page-item"><a href="#" class="page-link">‹</a></li>
                      <li class="active page-item"><a href="#" class="page-link">1</a></li>
                      <li class="page-item"><a href="#" class="page-link">2</a></li>
                      <li class="page-item"><a href="#" class="page-link">3</a></li>
                      <li class="page-item"><a href="#" class="page-link">4</a></li>
                      <li class="page-item"><a href="#" class="page-link">5</a></li>
                      <li class="page-item"><a href="#" class="page-link">›</a></li>
                      <li class="page-item"><a href="#" class="page-link">»</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-3 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center px-xl-3">
                <button class="btn btn-success btn-block" type="submit" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#attributeModal">Naujas atribūtas</button>
                </div>
                <hr class="my-3">
                <div class="e-navlist e-navlist--active-bold">
                  <ul class="nav">
                    <li class="nav-item active"><a href="" class="nav-link"><span>Visi</span>&nbsp;<small>/&nbsp;32</small></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><span>Aktyvus</span>&nbsp;<small>/&nbsp;16</small></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><span>Pasirinkti</span>&nbsp;<small>/&nbsp;0</small></a></li>
                  </ul>
                </div>
                <hr class="my-3">
                <div>
                  <div class="form-group">
                    <label>Paieška pagal raktinį žodį</label>
                    <div><input class="form-control w-100" type="text" placeholder="Žodis" value=""></div>
                  </div>
                </div>
                <hr class="my-3">
              </div>
            </div>
          </div>
        </div>

        <!-- Atnaujinti filtro pozymi -->
        <?php foreach($attributes as $attribute => $value): ?>
        <div class="modal fade" role="dialog" tabindex="-1" id="updateAttributeModal<?php echo $value['filterAttributeID']; ?>">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Atnaujinti filtro požymį</h5>
              </div>
              <div class="modal-body">
                <div class="py-1">
                  <form class="form" action="handling/admin_panel.han.php" method="POST">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Požymio pavadinimas</label>
                              <input class="form-control" name="display_Name" type="text" value="<?php echo $value['display_Name']; ?>" placeholder="<?php echo $value['display_Name']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="row pt-1">
                            <div class="form-group">
                              <label>Požymio pavadinimas duomenų bazėje</label>
                              <input class="form-control" name="attribute_Name" type="text" value="<?php echo $value['attribute_Name']; ?>" placeholder="<?php echo $value['attribute_Name']; ?>">
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="form-group">
                              <label>Kuriai kategorijai priskirti šį požymį</label>
                              <input class="form-control" name="filterCategoryID" type="text" value="<?php echo $value['filterCategoryID']; ?>" placeholder="1 - šis ID priklauso filtrams">
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row pt-3">
                      <div class="col d-flex justify-content-end space-between: 5px;">
                      <input type="hidden" name="filterAttributeID" value="<?php echo $value['filterAttributeID']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Uždaryti</button>
                        <button class="btn btn-primary" name="update_attribute" type="submit">Atnaujinti</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>

        <!-- Sukurti nauja filtro pozymi -->
        <div class="modal fade" role="dialog" tabindex="-1" id="attributeModal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Sukurti naują požymį</h5>
              </div>
              <div class="modal-body">
                <div class="py-1">
                  <form class="form" action="handling/admin_panel.han.php" method="POST">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Požymio pavadinimas</label>
                              <input class="form-control" name="display_Name" type="text" placeholder="Kuro filtras">
                            </div>
                          </div>
                        </div>
                        <div class="row pt-1">
                            <div class="form-group">
                              <label>Požymio pavadinimas duomenų bazėje</label>
                              <input class="form-control" name="attribute_Name" type="text" placeholder="kuro_filtras-product_Type">
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="form-group">
                              <label>Kuriai kategorijai priskirti šį požymį</label>
                              <input class="form-control" name="filterCategoryID" type="text" placeholder="1 - šis ID priklauso filtrams">
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row pt-3">
                      <div class="col d-flex justify-content-end space-between: 5px;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Uždaryti</button>
                        <button class="btn btn-primary" name="create_attribute" type="submit">Sukurti</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col" style="margin-top: 20px; display:none;" id="CommentPanel">
        <div class="e-tabs mb-3 px-3">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" href="#">Komentarų valdymo panelė</a></li>
          </ul>
        </div>

        <div class="row flex-lg-nowrap">
          <div class="col mb-3">
            <div class="e-panel card">
              <div class="card-body">
                <div class="card-title">
                </div>
                <div class="e-table">
                  <div class="table-responsive table-lg mt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="align-top">
                            <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                              <input type="checkbox" class="custom-control-input" id="all-items">
                              <label class="custom-control-label" for="all-items"></label>
                            </div>
                          </th>
                          <th class="max-width">Komentaro data</th>
                          <th class="max-width">Naudotojo vardas</th>
                          <th class="max-width">Komentaras</th>
                          <th class="max-width">Ar gali komentuoti</th>
                          <th> </th>
                          <th>Veiksmai</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($comments as $comment => $value) : ?>
                          <tr>
                            <td class="align-middle">
                              <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                <input type="checkbox" class="custom-control-input" id="item-1">
                                <label class="custom-control-label" for="item-1"></label>
                              </div>
                            </td>
                            <td class="text-nowrap align-middle"><?php echo $value['comment_Date']; ?></td>
                            <td class="text-nowrap align-middle"><?php echo $value['user_Username']; ?></td>
                            <td class="text-nowrap align-middle"><?php echo $value['product_Comment']; ?></td>
                            <td class="text-nowrap align-middle"><?php echo $value['is_Able_To_Comment']; ?></td>
                            <td class="text-center align-middle"><i class="fa fa-fw text-secondary cursor-pointer fa-toggle-on"></i></td>
                            <td class="text-center align-middle">
                              <div class="btn-group align-top">
                                <form action="handling/admin_panel.han.php" method="POST">
                                  <input type="hidden" name="productCommentID" value="<?php echo $value['productCommentID']; ?>">
                                  <input type="hidden" name="productID" value="<?php echo $value['productID']; ?>">
                                  <input type="hidden" name="userID" value="<?php echo $value['userID']; ?>">
                                  <button class="btn btn-sm btn-outline-secondary" type="submit" name="delete_comment"><i class="fa fa-trash"></i></button>
                                  <button class="btn btn-sm btn-outline-secondary" type="submit" name="ban_user"><i class="fa fa-ban"></i></button>
                                </form>
                                <button class="btn btn-sm btn-outline-secondary" type="submit" name="" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#updateCommentModal<?php echo $value['productCommentID']; ?>"><i class="fa fa-pencil"></i></button>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="d-flex justify-content-center">
                    <ul class="pagination mt-3 mb-0">
                      <li class="disabled page-item"><a href="#" class="page-link">‹</a></li>
                      <li class="active page-item"><a href="#" class="page-link">1</a></li>
                      <li class="page-item"><a href="#" class="page-link">2</a></li>
                      <li class="page-item"><a href="#" class="page-link">3</a></li>
                      <li class="page-item"><a href="#" class="page-link">4</a></li>
                      <li class="page-item"><a href="#" class="page-link">5</a></li>
                      <li class="page-item"><a href="#" class="page-link">›</a></li>
                      <li class="page-item"><a href="#" class="page-link">»</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-3 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center px-xl-3">
                <!-- <button class="btn btn-success btn-block" type="submit" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#attributeModal">Naujas atribūtas</button> -->
                </div>
                <hr class="my-3">
                <div class="e-navlist e-navlist--active-bold">
                  <ul class="nav">
                    <li class="nav-item active"><a href="" class="nav-link"><span>Visi</span>&nbsp;<small>/&nbsp;32</small></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><span>Aktyvus</span>&nbsp;<small>/&nbsp;16</small></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><span>Pasirinkti</span>&nbsp;<small>/&nbsp;0</small></a></li>
                  </ul>
                </div>
                <hr class="my-3">
                <div>
                  <div class="form-group">
                    <label>Paieška pagal raktinį žodį</label>
                    <div><input class="form-control w-100" type="text" placeholder="Žodis" value=""></div>
                  </div>
                </div>
                <hr class="my-3">
              </div>
            </div>
          </div>
        </div>

        <!-- Atnaujinti komentarą -->
        <?php foreach($comments as $comment => $value): ?>
        <div class="modal fade" role="dialog" tabindex="-1" id="updateCommentModal<?php echo $value['productCommentID']; ?>">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Atnaujinti komentarą</h5>
              </div>
              <div class="modal-body">
                <div class="py-1">
                  <form class="form" action="handling/admin_panel.han.php" method="POST">
                    <div class="row">
                      <div class="col">
                        <div class="row pt-1">
                            <div class="form-group">
                              <label>Komentaras</label>
                              <input class="form-control" name="product_Comment" type="text" value="<?php echo $value['product_Comment']; ?>" placeholder="<?php echo $value['product_Comment']; ?>">
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row pt-3">
                      <div class="col d-flex justify-content-end space-between: 5px;">
                      <input type="hidden" name="productCommentID" value="<?php echo $value['productCommentID']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Uždaryti</button>
                        <button class="btn btn-primary" name="update_comment" type="submit">Atnaujinti</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="col" style="margin-top: 20px; display:block;" id="ShippingPanel">
        <div class="e-tabs mb-3 px-3">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" href="#">Užsakymų valdymo panelė</a></li>
          </ul>
        </div>

        <div class="row flex-lg-nowrap">
          <div class="col mb-3">
            <div class="e-panel card">
              <div class="card-body">
                <div class="card-title">
                </div>
                <div class="e-table">
                  <div class="table-responsive table-lg mt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="align-top">
                            <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                              <input type="checkbox" class="custom-control-input" id="all-items">
                              <label class="custom-control-label" for="all-items"></label>
                            </div>
                          </th>
                          <th>Pirkimo data</th>
                          <th>Pristatymo data</th>
                          <th class="max-width">Namų adresas</th>
                          <th>Miestas</th>
                          <th>El. paštas</th>
                          <th>Veiksmai</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($receipts as $receipt => $value) : ?>
                          <tr>
                            <td class="align-middle">
                              <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                <input type="checkbox" class="custom-control-input" id="item-1">
                                <label class="custom-control-label" for="item-1"></label>
                              </div>
                            </td>
                            <td><?php echo $value['date_Purchased']; ?> </td>
                            <td><?php echo $value['delivery_Date']; ?></td>
                            <td><?php echo $value['home_Address']; ?></td>
                            <td><?php echo $value['city']; ?></td>
                            <td><?php echo $value['email_address']; ?></td>
                            <td>
                              <div class="btn-group align-top">
                                <form action="handling/admin_panel.han.php" method="POST">
                                  <input type="hidden" name="receiptID" value="<?php echo $value['receiptID']; ?>">
                                  <button class="btn btn-sm btn-outline-secondary" type="submit" name="delete_receipt"><i class="fa fa-trash"></i></button>
                                </form>
                                <button class="btn btn-sm btn-outline-secondary" type="submit" name="" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#updateShippingModal<?php echo $value['receiptID']; ?>"><i class="fa fa-pencil"></i></button>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="d-flex justify-content-center">
                    <ul class="pagination mt-3 mb-0">
                      <li class="disabled page-item"><a href="#" class="page-link">‹</a></li>
                      <li class="active page-item"><a href="#" class="page-link">1</a></li>
                      <li class="page-item"><a href="#" class="page-link">2</a></li>
                      <li class="page-item"><a href="#" class="page-link">3</a></li>
                      <li class="page-item"><a href="#" class="page-link">4</a></li>
                      <li class="page-item"><a href="#" class="page-link">5</a></li>
                      <li class="page-item"><a href="#" class="page-link">›</a></li>
                      <li class="page-item"><a href="#" class="page-link">»</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-3 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center px-xl-3">
                </div>
                <hr class="my-3">
                <div class="e-navlist e-navlist--active-bold">
                  <ul class="nav">
                    <li class="nav-item active"><a href="" class="nav-link"><span>Visi</span>&nbsp;<small>/&nbsp;32</small></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><span>Aktyvus</span>&nbsp;<small>/&nbsp;16</small></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><span>Pasirinkti</span>&nbsp;<small>/&nbsp;0</small></a></li>
                  </ul>
                </div>
                <hr class="my-3">
                <div>
                  <div class="form-group">
                    <label>Paieška pagal raktinį žodį:</label>
                    <div><input class="form-control w-100" type="text" placeholder="Pavadinimas" value=""></div>
                  </div>
                </div>
                <hr class="my-3">
              </div>
            </div>
          </div>
        </div>

        <!-- Atnaujinti produkta modal -->
        <?php foreach($receipts as $receipt => $value): ?>
        <div class="modal fade" role="dialog" tabindex="-1" id="updateShippingModal<?php echo $value['receiptID']; ?>">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Atnaujinti užsakymą</h5>
              </div>
              <div class="modal-body">
                <div class="py-1">
                  <form class="form" action="handling/admin_panel.han.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col">
                      <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Pristatymo data</label>
                              <input class="form-control" type="text" name="deliveryDate" value="<?php echo $value['delivery_Date'] ?>" placeholder="<?php echo $value['delivery_Date']; ?>">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Namų adresas</label>
                              <input class="form-control" type="text" name="homeAddress" value="<?php echo $value['home_Address'] ?>" placeholder="<?php echo $value['home_Address']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Miestas</label>
                              <input class="form-control" type="text" name="city" value="<?php echo $value['city'] ?>" placeholder="<?php echo $value['city']; ?>">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>El. paštas</label>
                              <input class="form-control" type="text" name="emailAddress" value="<?php echo $value['email_address'] ?>" placeholder="<?php echo $value['email_address']; ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row pt-3">
                      <div class="col d-flex justify-content-end space-between: 5px;">
                      <input type="hidden" name="receiptID" value="<?php echo $value['receiptID']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Uždaryti</button>
                        <button class="btn btn-primary" name="update_receipt" type="submit">Atnaujinti</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>

</body>

</html>

<script>
  const product = document.getElementById('product_panel');
  const category = document.getElementById('category_panel');
  const attribute = document.getElementById('attribute_panel');
  const comment = document.getElementById('comment_panel');
  const shipping = document.getElementById('shipping_panel');

  const product_box = document.getElementById('ProductPanel');
  const category_box = document.getElementById('CategoryPanel');
  const attribute_box = document.getElementById('AttributePanel');
  const comment_box = document.getElementById('CommentPanel');
  const shipping_box = document.getElementById('ShippingPanel');

  product.addEventListener('click', function handleClick() {
    <?php $_SESSION['panel_window'] = 'product'; ?>
    product_box.style.display = "block";
    category_box.style.display = "none";
    attribute_box.style.display = "none";
    comment_box.style.display = "none";
    shipping_box.style.display = "none";
  });

  category.addEventListener('click', function handleClick() {
    <?php $_SESSION['panel_window'] = 'category'; ?>
    product_box.style.display = "none";
    category_box.style.display = "block";
    attribute_box.style.display = "none";
    comment_box.style.display = "none";
    shipping_box.style.display = "none";
  });


  attribute.addEventListener('click', function handleClick() {
    <?php $_SESSION['panel_window'] = 'attribute'; ?>
    product_box.style.display = "none";
    category_box.style.display = "none";
    attribute_box.style.display = "block";
    comment_box.style.display = "none";
    shipping_box.style.display = "none";
  });

  comment.addEventListener('click', function handleClick() {
    <?php $_SESSION['panel_window'] = 'comment'; ?>
    product_box.style.display = "none";
    category_box.style.display = "none";
    attribute_box.style.display = "none";
    comment_box.style.display = "block";
    shipping_box.style.display = "none";
  });

  shipping.addEventListener('click', function handleClick() {
    <?php $_SESSION['panel_window'] = 'shipping'; ?>
    product_box.style.display = "none";
    category_box.style.display = "none";
    attribute_box.style.display = "none";
    comment_box.style.display = "none";
    shipping_box.style.display = "block";
  });

    <?php if ($_SESSION['panel_window'] == 'product') { ?>
    product_box.style.display = "block";
    category_box.style.display = "none";
    attribute_box.style.display = "none";
    comment_box.style.display = "none";
    shipping_box.style.display = "none";
  <?php } else if ($_SESSION['panel_window'] == 'category') { ?>
    product_box.style.display = "none";
    category_box.style.display = "block";
    attribute_box.style.display = "none";
    comment_box.style.display = "none";
    shipping_box.style.display = "none";
  <?php } else if ($_SESSION['panel_window'] == 'attribute') { ?>
    product_box.style.display = "none";
    category_box.style.display = "none";
    attribute_box.style.display = "block";
    comment_box.style.display = "none";
    shipping_box.style.display = "none";
    <?php } else if ($_SESSION['panel_window'] == 'comment') { ?>
    product_box.style.display = "none";
    category_box.style.display = "none";
    attribute_box.style.display = "none";
    comment_box.style.display = "block";
    shipping_box.style.display = "none";
    <?php } else if ($_SESSION['panel_window'] == 'shipping') { ?>
    product_box.style.display = "none";
    category_box.style.display = "none";
    attribute_box.style.display = "none";
    comment_box.style.display = "none";
    shipping_box.style.display = "block";
  <?php } ?>
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>