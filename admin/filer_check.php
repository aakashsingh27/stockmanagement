<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Management Dashboard</title>
  <!-- Include Bootstrap CSS -->

  <style>
    /* Additional custom styles for the dashboard */
    body {
      background-color: #f9f9f9;
      font-family: Arial, sans-serif;
    }

    .containerLo {
      /*max-width: 900px;*/
      width:100%;
      margin: 0 auto;
      border:1px solid black;
      padding-top: 20px;
       padding-bottom: 20px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    header {
      text-align: center;
      margin-bottom: 30px;
      padding-bottom: 10px;
      border-bottom: 1px solid #ccc;
    }

    .section-title {
      font-size: 28px;
      margin-bottom: 20px;
      color: #343a40;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      border-radius: 3px;
    }

    .stats {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .stats-card {
      padding: 20px;
      background-color: #f1f1f1;
      border-radius: 5px;
      flex: 1;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .stats-card h3 {
      font-size: 24px;
      color: #007bff;
      margin-bottom: 10px;
    }

    .stats-card p {
      font-size: 18px;
      color: #333;
    }

    .view-button {
      display: inline-block;
      background-color: #007bff;
      color: #fff;
      padding: 8px 20px;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s;
    }

    .view-button:hover {
      background-color: #0056b3;
    }

    @media (max-width: 767px) {
      .container {
        padding: 10px;
      }

      .stats {
        flex-direction: column;
      }

      .stats-card {
        margin-bottom: 10px;
      }
    }
  </style>
</head>
<body>
<?php
@ob_start();
require_once 'config/config.php';  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
          

$prdt_id=$_POST['txt1'];

$clt_prdt_prc="select * from `stock_quantity` where `product_id`='$prdt_id' and `sale_to_id` IS NULL";
$qst_clt_prdt_prc=$db->query($clt_prdt_prc);

$assign_data = $db->query("select sum(`qty`) as `quantity` from `assign_product` where `product_id`='$prdt_id' ");
$clt_fetch = $assign_data->fetch_assoc();

$assign_sell = $db->query("select sum(`quantity`) as `quantity` from `product_sale` where `product_id`='$prdt_id'");
$allSell = $assign_sell->fetch_assoc();

$Total_qty = $db->query("select sum(`quantity`) as `quantity` from `stock_quantity` where `product_id`='$prdt_id' AND `sale_to_id` IS NULL");
$totalCount = $Total_qty->fetch_assoc();

$availble_qty = $totalCount['quantity'] - ($clt_fetch['quantity'] +  $allSell['quantity']);
          
?>
  <div class="containerLo mt-4 p-3" >
    <!-- Header -->
    <header>
      <h1>Stock Quantity</h1>
    </header>
    
       <section id="saleProduct">
          <h2 class="section-title">Total Quantity List</h2>

          <table class="table table-striped">
            <thead>
              <tr>
                <th>S.no</th>
                <th>Vendor</th>
                <th>Price</th>
                <th>Quantity</th>
              </tr>
            </thead>
            <tbody>
<?php
$i=1;
while($clct_clt_prdt_prc=$qst_clt_prdt_prc->fetch_assoc()){
    $prec = $clct_clt_prdt_prc['per_product_price'];
    $venderID = $clct_clt_prdt_prc['vendor_id'];
    $vender = $db->query("select * from `venders` where `id`='$venderID'");
    $vender_name = $vender->fetch_assoc();
    
?>
              <tr>
                <td><?php echo $i ?></td>
                                <td><?php echo $vender_name['company'] ?>   ( <?php echo $vender_name['name'] ?> )</td>
                <td><?php echo $prec;?></td>
                <td><?php echo $clct_clt_prdt_prc['quantity']; ?></td>
                
              </tr>
              <?php $i++ ?>
               <?php
}
?>
        <td colspan="3"><b>Total Quantity</b></td>
        <td><?php echo  $totalCount['quantity'] ?></td>
             
            </tbody>
          </table>
        </section>
        
        
        
    

    <!-- Stats Section --><br>
       <h2 class="section-title">Total Stock Availability</h2>
    <div class="stats">
        
      <!-- Total Assign Section -->
      <div class="stats-card">
        <h3>Total Assign Qty</h3>
        <p><?php echo $clt_fetch['quantity'] ?? 0 ?></p>
        <a target="_blank" href="view_assign_product.php?total_assign=<?php echo $prdt_id ?>&target=check_quantity" class="btn btn-primary">View Details</a>
      </div>

      <!-- Total Sell Section -->
      <div class="stats-card">
        <h3>Total Sell Qty</h3>
        <p><?php echo $allSell['quantity'] ?? 0 ?></p>
        <a target="_blank" href="view_sales.php?total_assign=<?php echo $prdt_id ?>&target=check_quantity" class="btn btn-primary">View Details</a>
      </div>

      <!-- Available Quantity Section -->
      <div class="stats-card">
        <h3>Available Quantity</h3>
        <p><?php echo $availble_qty; ?></p>
        <a target="_blank" href="view_quantity.php?total_assign=<?php echo $prdt_id ?>&target=check_quantity" class="btn btn-primary">View Details</a>
      </div>
    </div>

    <!-- Pie Chart Section -->
        <section id="productPieChart" class="mt-4">
      <h2 class="section-title">Product Stock Pie Chart</h2>
      <div class="chart-container">
        <!-- Your canvas for displaying the pie chart using Chart.js -->
        <canvas id="productSalesPieChart" width="400" height="200"></canvas>
      </div>
    </section>
    
    
 
  </div>


  <!-- Include Chart.js for graph visualization -->
  

  <script>
    // Add your Chart.js script here to create and display the pie chart using data from your sales
    // For example:
    var ctx = document.getElementById('productSalesPieChart').getContext('2d');
    var productSalesData = {
      labels: ['Availble Qty', 'Assign Qty','Sell Qty'], // Your product names here
      datasets: [{
        data: [<?php echo  $availble_qty ?> , <?php  echo $clt_fetch['quantity'] ?>,<?php echo $allSell['quantity']; ?>], // Your sales data here
        backgroundColor: ['#ffcc00', '#0033cc','#00cc66'], // Custom colors for slices
        borderColor: '#fff',
        borderWidth: 1
      }]
    };
 var productSalesPieChart = new Chart(ctx, {
  type: 'pie',
  data: productSalesData,
  options: {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
      display: true, // Show the legend
      position: 'bottom',
      labels: {
        fontSize: 14,
        boxWidth: 12
      }
    }
  }
});

  </script>

  <!-- Include Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>

</body>
</html>

<?php
ob_flush();

?>
