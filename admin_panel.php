<?php
include_once 'navigation_bar.php';
include_once 'classes/product.class.php';
include_once 'classes/filter.class.php';
$productObj = new Product();
$filterObj = new Filter();

$products = $productObj->getProducts();
$categories = $filterObj->getCategories();
$attributes = $filterObj->getAttributes();

if (isset($_GET['window'])) {
  $window = $_GET['window'];
  $_SESSION['panel_window'] = $window;
}
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


  <div class="container">
    <div class="row flex-lg-nowrap">



      <div class="col" style="margin-top: 20px; display:block;" id="ProductPanel">
        <div class="e-tabs mb-3 px-3">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" href="#">Prekės</a></li>
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
                                  <input type="hidden" name="productID" value="<?php echo $value['productID']; ?>">
                                  <button class="btn btn-sm btn-outline-secondary badge" type="submit" name="delete_product"><i class="fa fa-trash"></i></button>
                                </form>
                                <button class="btn btn-sm btn-outline-secondary badge" type="submit" name="update_product" data-toggle="modal" data-target="#1user-form-modal">Edit</button>
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
                  <button class="btn btn-success btn-block" type="submit" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Nauja prekė</button>
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

        <!-- User Form Modal -->
        <div class="modal fade" role="dialog" tabindex="-1" id="exampleModal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Sukurti naują prekę</h5>
              </div>
              <div class="modal-body">
                <div class="py-1">
                  <form class="form" action="handling/admin_panel.han.php" method="POST">
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
                              <input class="form-control" type="text" name="productName" placeholder="Kuro filtras">
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
                              <input class="form-control" name="productType" type="text" placeholder="kuro_filtras-product_Type">
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
                              <input type="file" class="custom-file-input" name="productImage" id="picture" required>
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
            <li class="nav-item"><a class="nav-link active" href="#">Filtrų kategorijos</a></li>
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
                                  <button class="btn btn-sm btn-outline-secondary badge" type="submit" name="update_category" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                  <button class="btn btn-sm btn-outline-secondary badge" type="submit" name="delete_category"><i class="fa fa-trash"></i></button>
                                </form>
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
            <li class="nav-item"><a class="nav-link active" href="#">Filtro požymiai</a></li>
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
                                  <button class="btn btn-sm btn-outline-secondary badge" type="submit" name="update_attribute" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                  <button class="btn btn-sm btn-outline-secondary badge" type="submit" name="delete_attribute"><i class="fa fa-trash"></i></button>
                                </form>
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
                <button class="btn btn-success btn-block" type="submit" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#attributeModal">Naujas požymis</button>
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

    </div>
  </div>



</body>

</html>


<script>
  const product = document.getElementById('product_panel');
  const category = document.getElementById('category_panel');
  const attribute = document.getElementById('attribute_panel');

  const product_box = document.getElementById('ProductPanel');
  const category_box = document.getElementById('CategoryPanel');
  const attribute_box = document.getElementById('AttributePanel');

  <?php if ($_SESSION['panel_window'] == 'product') { ?>
    product_box.style.display = "block";
    category_box.style.display = "none";
    attribute_box.style.display = "none";
  <?php } else if ($_SESSION['panel_window'] == 'category') { ?>
    product_box.style.display = "none";
    category_box.style.display = "block";
    attribute_box.style.display = "none";
  <?php } else if ($_SESSION['panel_window'] == 'attribute') { ?>
    product_box.style.display = "none";
    category_box.style.display = "none";
    attribute_box.style.display = "block";
  <?php } ?>

  product.addEventListener('click', function handleClick() {
    product_box.style.display = "block";
    category_box.style.display = "none";
    attribute_box.style.display = "none";
  });

  category.addEventListener('click', function handleClick() {
    product_box.style.display = "none";
    category_box.style.display = "block";
    attribute_box.style.display = "none";
  });


  attribute.addEventListener('click', function handleClick() {
    product_box.style.display = "none";
    category_box.style.display = "none";
    attribute_box.style.display = "block";
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>