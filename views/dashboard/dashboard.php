<div class="container">
  <div class="page-inner">
    <div class="row">
      <!-- Revenue -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-primary bubble-shadow-small">
                  <i class="fa-solid fa-money-bill"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Revenue</p>
                  <h4 class="card-title">$<?php echo $total_revenue_formatted; ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Expenses -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-info bubble-shadow-small">
                  <i class="fa-solid fa-money-bill-trend-up"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Expenses</p>
                  <h4 class="card-title">$<?php echo $total_expenses_formatted; ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- sale -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-primary bubble-shadow-small">
                  <i class="fa-solid fa-boxes-stacked"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Total Items Sold</p>
                  <h4 class="card-title"><?php echo $data['total_quantity_sold']; ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- profit -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                  <i class="fa-solid fa-sack-dollar"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Profit</p>
                  <h4 class="card-title">$<?php echo $total_profit_formatted; ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- User_chart -->
    <div class="row ">
      <div class="col-md-8 ">
        <div class="card card-round">
          <div class="card-header">
            <div class="card-head-row gap-3">
              <div class="card-title">Sale Report</div>
              <div class="d-flex">
                <div class="btn-group gap-1" role="group" aria-label="Time Period Selection">
                  <button class="btn btn-sm btn-outline-primary fw-bold active rounded-pill border-success"
                    onclick="showPage(event, 'week')">Week</button>
                  <button class="btn btn-sm btn-outline-primary fw-bold rounded-pill"
                    onclick="showPage(event, 'month')">Month</button>
                  <button class="btn btn-sm btn-outline-primary fw-bold rounded-pill"
                    onclick="showPage(event, 'year')">Year</button>
                </div>
              </div>
              <div class="card-tools">
                <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                  <span class="btn-label">
                    <i class="fa fa-pencil"></i>
                  </span>
                  Export
                </a>
                <a href="#" class="btn btn-label-info btn-round btn-sm">
                  <span class="btn-label">
                    <i class="fa fa-print"></i>
                  </span>
                  Print
                </a>
              </div>
            </div>
          </div>
          <div class="container mt-4">
            <div id="week" class="d-block">
              <div class="card-body">
                <div class="chart-container">
                  <canvas id="barChart" height="390"></canvas>
                </div>
              </div>
            </div>
            <div id="month" class="d-none">
              <div class="card-body">
                <div class="chart-container p-9">
                  <canvas id="singelBarChart" height="390"></canvas>
                </div>
              </div>
            </div>
            <div id="year" class="d-none">
              <div class="card-body ">
                <div class="chart-container p-3" style="height: 390px;">
                  <canvas id="morris-bar-chart" height="390"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Top product -->
      <div class="col-md-4">
        <div class="card card-round">
          <div class="card-body">
            <div class="card-head-row card-tools-still-right">
              <div class="card-title">Top Selling Products</div>
              <div class="card-tools">
                <div class="dropdown">
                </div>
              </div>
            </div>
            <div class="card-list py-3">
              <?php if (empty($orders)): ?>
                <div class="alert alert-warning">No sales data available.</div>
              <?php else: ?>
                <?php foreach ($orders as $order): ?>
                  <div class="item-list d-flex align-items-center mb-0">
                    <div class="avatar">
                      <img src="<?= htmlspecialchars($order['image'] ?: '/default-image.jpg'); ?>"
                        alt="<?= htmlspecialchars($order['item']); ?>" class="avatar-img rounded-circle shadow "
                        style="width: 50px; height: 50px; object-fit: cover;" />
                    </div>
                    <div class="info-user ms-3">
                      <div class="username fw-bold"><?= htmlspecialchars($order['item']); ?></div>
                      <div class="status">Sold: <?= htmlspecialchars($order['quantity']); ?> units</div>
                      <div class="status">Revenue: $<?= number_format($order['total_price'], 2); ?></div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Recent Transactions -->
    <div class="row">
      <div class="col-md-12">
        <div class="card card-round">
          <div class="card-header">
            <div class="card-head-row card-tools-still-right">
              <div class="card-title">Product Low stock</div>
              <div class="card-tools">
              </div>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <!-- Low Stock Products Table -->
              <table class="table align-items-center mb-0">
                <thead class="thead-light" style="background-color: #f5a623; color: white;">
                  <tr>
                    <th scope="col">NO</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">PRODUCTS</th>
                    <th scope="col">DATE ADDED</th>
                    <th scope="col">STOCK</th>
                    <th scope="col">STATUS</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Fetch stock list using StockListModel (already instantiated in SalesController)
                  $stockModel = new StockListModel();
                  $stockList = $stockModel->getStockList();

                  // Filter for low stock (quantity <= 5)
                  $lowStockItems = array_filter($stockList, function ($item) {
                    return $item['quantity'] <= 3; 
                  });

                  // Reindex array to ensure continuous numbering
                  $lowStockItems = array_values($lowStockItems);

                  // Check if there are low stock items
                  if (empty($lowStockItems)) {
                    echo '<tr><td colspan="6" class="text-center">No low stock products found.</td></tr>';
                  } else {
                    foreach ($lowStockItems as $index => $stock) {
                      // Determine status and color
                      $status = $stock['quantity'] == 0 ? 'Out of Stock' : 'Low Stock';
                      $statusColor = $stock['quantity'] == 0 ? 'red' : 'orange';
                  ?>
                      <tr>
                        <th scope="row"><?php echo $index + 1; ?></th>
                        <td>
                          <img src="<?php echo $stock['product_image'] ?? 'assets/img/default.jpg'; ?>" alt="Product Image" style="width: 40px; height: 40px; object-fit: cover;" />
                        </td>
                        <td><?php echo htmlspecialchars($stock['product_name']); ?></td>
                        <td><?php echo date('F j, Y', strtotime($stock['date'])); ?></td>
                        <td><?php echo $stock['quantity']; ?></td>
                        <td style="color: <?php echo $statusColor; ?>;">
                          <?php echo $status; ?>
                        </td>
                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="../views/assets/js/plugin/chart.js/chart.min.js"></script>
<script>
  var weeklyLabels = <?php echo json_encode($weekly_labels); ?>;
  var weeklyData = <?php echo json_encode($weekly_data); ?>;

  var myBarChart = new Chart(barChart, {
    type: "bar",
    data: {
      labels: weeklyLabels, // Dynamic labels from controller
      datasets: [{
        label: "Revenue",
        backgroundColor: "#177dff", // Updated to match the image color
        borderColor: "#177dff",
        borderWidth: 1,
        data: weeklyData, // Dynamic data from controller
        barPercentage: 0.9, // Reduce gaps between bars
        categoryPercentage: 0.9
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: {
        duration: 1500, // Smooth transition duration (1.5 seconds)
        easing: 'easeInOutQuad', // Smooth easing effect
        onComplete: function() {
          // Optional: Add a subtle bounce effect after animation
          this.options.animation.duration = 500;
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            fontSize: 12,
            fontColor: '#666',
            callback: function(value) {
              return '$' + value; // Add dollar sign to y-axis labels
            }
          },
          gridLines: {
            color: 'rgba(200, 200, 200, 0.2)', // Light grid lines
            zeroLineColor: 'rgba(200, 200, 200, 0.5)'
          }
        }],
        xAxes: [{
          ticks: {
            fontSize: 12,
            fontColor: '#666'
          },
          gridLines: {
            display: false // Hide x-axis grid lines for cleaner look
          }
        }]
      },
      plugins: {
        legend: {
          labels: {
            fontSize: 14,
            fontColor: '#333'
          }
        },
        tooltip: {
          backgroundColor: 'rgba(0, 0, 0, 0.8)',
          titleFontSize: 14,
          bodyFontSize: 12,
          callbacks: {
            label: function(tooltipItem) {
              return 'Revenue: $' + tooltipItem.raw; // Customize tooltip
            }
          }
        }
      }
    }
  });
</script>

<!-- JavaScript for Page Switching -->
<script>
  function showPage(event, pageId) {
    // Hide all content sections
    document.querySelectorAll(".container.mt-4 > div").forEach(section => {
      section.classList.remove("d-block");
      section.classList.add("d-none");
    })
    // Show the selected section
    document.getElementById(pageId).classList.remove("d-none");
    document.getElementById(pageId).classList.add("d-block")
    // Remove active class and border from all buttons
    document.querySelectorAll(".btn").forEach(button => {
      button.classList.remove("active", "border-bottom", "border-3", "border-success");
    })
    // Add active class and border to the clicked button
    event.currentTarget.classList.add("active", "border-bottom", "border-3", "border-success");
  }
</script>
<script src="../views/assets/js/dist/jquery.js"></script>
<script>
  var monthlyLabels = <?php echo json_encode($monthly_labels); ?>;
  var monthlyData = <?php echo json_encode($monthly_data); ?>;

  var ctx = document.getElementById("singelBarChart");
  ctx.height = 160;
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: monthlyLabels, // Dynamic labels from controller
      datasets: [{
        label: "Revenue",
        data: monthlyData, // Dynamic data from controller
        borderColor: "#177dff", // Updated to match the image color
        borderWidth: 1,
        backgroundColor: "#177dff", // Updated to match the image color
        barPercentage: 0.9, // Reduce gaps between bars
        categoryPercentage: 0.9
      }]
    },
    options: {
      animation: {
        duration: 1500, // Smooth transition duration (1.5 seconds)
        easing: 'easeInOutQuad', // Smooth easing effect
        onComplete: function() {
          this.options.animation.duration = 500;
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            fontSize: 12,
            fontColor: '#666',
            callback: function(value) {
              return '$' + value; // Add dollar sign to y-axis labels
            }
          },
          gridLines: {
            color: 'rgba(200, 200, 200, 0.2)',
            zeroLineColor: 'rgba(200, 200, 200, 0.5)'
          }
        }],
        xAxes: [{
          ticks: {
            fontSize: 12,
            fontColor: '#666'
          },
          gridLines: {
            display: false
          }
        }]
      },
      plugins: {
        legend: {
          labels: {
            fontSize: 14,
            fontColor: '#333'
          }
        },
        tooltip: {
          backgroundColor: 'rgba(0, 0, 0, 0.8)',
          titleFontSize: 14,
          bodyFontSize: 12,
          callbacks: {
            label: function(tooltipItem) {
              return 'Revenue: $' + tooltipItem.raw;
            }
          }
        }
      }
    }
  });
</script>

<!-- years of dashboard -->
<script src="../views/assets/js/dashboard-1.js"></script>
<script src="../views/assets/js/dashboard-js/rephael.min.js"></script>
<script src="../views/assets/js/dashboard-js/morris.min.js"></script>

<script src="../views/assets/js/dist/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  $(document).ready(function() {
    var yearlyLabels = <?php echo json_encode($yearly_labels); ?>;
    var yearlyData = <?php echo json_encode($yearly_data); ?>;

    var ctx = document.getElementById("morris-bar-chart").getContext("2d");

    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: yearlyLabels, // Dynamic labels from controller
        datasets: [{
          label: "Revenue",
          data: yearlyData, // Dynamic data from controller
          borderColor: "#177dff", // Updated to match the image color
          borderWidth: 1,
          backgroundColor: "#177dff", // Updated to match the image color
          hoverBackgroundColor: "#177dff",
          hoverBorderColor: "#177dff",
          barPercentage: 0.9, // Reduce gaps between bars
          categoryPercentage: 0.9
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 1500, // Smooth transition duration (1.5 seconds)
          easing: 'easeInOutQuad', // Smooth easing effect
          onComplete: function() {
            this.options.animation.duration = 500;
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              fontSize: 12,
              fontColor: '#666',
              callback: function(value) {
                return '$' + value; // Add dollar sign instead of 'units'
              }
            },
            gridLines: {
              color: 'rgba(200, 200, 200, 0.2)',
              zeroLineColor: 'rgba(200, 200, 200, 0.5)'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Years',
              fontSize: 14,
              fontColor: '#333'
            },
            ticks: {
              fontSize: 12,
              fontColor: '#666'
            },
            gridLines: {
              display: false
            }
          }
        },
        plugins: {
          legend: {
            labels: {
              fontSize: 14,
              fontColor: '#333'
            }
          },
          tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            titleFontSize: 14,
            bodyFontSize: 12,
            callbacks: {
              label: function(tooltipItem) {
                return 'Revenue: $' + tooltipItem.raw; // Customize tooltip
              }
            }
          }
        }
      }
    });
  });
</script>



<script>
  // Define translations for Dashboard page
  const dashboardTranslations = {
    en: {
      card_categories: ["Revenue", "Expenses", "Total Items Sold", "Profit"],
      sale_report_title: "Sale Report",
      time_periods: ["Week", "Month", "Year"],
      action_buttons: ["Export", "Print"],
      top_selling_title: "Top Selling Products",
      top_selling_labels: ["Sold:", "Revenue:"],
      low_stock_title: "Product Low Stock",
      low_stock_headers: ["NO", "IMAGE", "PRODUCTS", "DATE ADDED", "STOCK", "STATUS"],
      low_stock_status: ["Out of Stock", "Low Stock"],
      no_low_stock_message: "No low stock products found.",
      no_sales_message: "No sales data available."
    },
    km: {
      card_categories: ["ប្រាក់ចំណូល", "ចំណាយ", "ទំនិញលក់សរុប", "ប្រាក់ចំណេញ"],
      sale_report_title: "របាយការណ៍លក់",
      time_periods: ["សប្តាហ៍", "ខែ", "ឆ្នាំ"],
      action_buttons: ["នាំចេញ", "បោះពុម្ព"],
      top_selling_title: "ផលិតផលលក់ដាច់បំផុត",
      top_selling_labels: ["លក់:", "ប្រាក់ចំណូល:"],
      low_stock_title: "ផលិតផលស្តុកទាប",
      low_stock_headers: ["លេខរៀង", "រូបភាព", "ផលិតផល", "កាលបរិច្ឆេទបន្ថែម", "ស្តុក", "ស្ថានភាព"],
      low_stock_status: ["អស់ស្តុក", "ស្តុកទាប"],
      no_low_stock_message: "រកមិនឃើញផលិតផលស្តុកទាបទេ។",
      no_sales_message: "មិនមានទិន្នន័យលក់ទេ។"
    }
  };

  // Function to update Dashboard page language
  function updateDashboardLanguage(language) {
    // Update card categories (Revenue, Expenses, Total Items Sold, Profit)
    const cardCategories = document.querySelectorAll('.card-category');
    cardCategories.forEach((category, index) => {
      if (index < dashboardTranslations[language].card_categories.length) {
        category.textContent = dashboardTranslations[language].card_categories[index];
      }
    });

    // Update Sale Report title - Fixed selector
    const saleReportTitle = document.querySelector('.col-md-8 .card-head-row .card-title');
    if (saleReportTitle) {
      saleReportTitle.textContent = dashboardTranslations[language].sale_report_title;
      console.log('Sale Report title updated to:', saleReportTitle.textContent); // Debug
    } else {
      console.error('Sale Report title not found with selector .col-md-8 .card-head-row .card-title');
    }

    // Update time period buttons (Week, Month, Year)
    const timePeriodButtons = document.querySelectorAll('.btn-group .btn');
    timePeriodButtons.forEach((button, index) => {
      if (index < dashboardTranslations[language].time_periods.length) {
        button.textContent = dashboardTranslations[language].time_periods[index];
      }
    });

    // Update Export and Print buttons
    const actionButtons = document.querySelectorAll('.card-tools .btn');
    actionButtons.forEach((button, index) => {
      if (index < dashboardTranslations[language].action_buttons.length) {
        const label = button.querySelector('.btn-label');
        if (label) {
          button.innerHTML = `<span class="btn-label">${label.innerHTML}</span> ${dashboardTranslations[language].action_buttons[index]}`;
        }
      }
    });

    // Update Top Selling Products title
    const topSellingTitle = document.querySelector('.col-md-4 .card-title');
    if (topSellingTitle) {
      topSellingTitle.textContent = dashboardTranslations[language].top_selling_title;
    }

    // Update Top Selling Products labels (Sold, Revenue)
    const topSellingLabels = document.querySelectorAll('.info-user .status');
    topSellingLabels.forEach((label, index) => {
      const value = label.textContent.split(': ')[1]; // Preserve the value (e.g., "5 units" or "$100.00")
      label.textContent = `${dashboardTranslations[language].top_selling_labels[index % 2]} ${value}`;
    });

    // Update No Sales Data message
    const noSalesMessage = document.querySelector('.alert.alert-warning');
    if (noSalesMessage) {
      noSalesMessage.textContent = dashboardTranslations[language].no_sales_message;
    }

    // Update Product Low Stock title
    const lowStockTitle = document.querySelector('.col-md-12 .card-title');
    if (lowStockTitle) {
      lowStockTitle.textContent = dashboardTranslations[language].low_stock_title;
    }

    // Update Product Low Stock table headers
    const lowStockHeaders = document.querySelectorAll('.table thead th');
    lowStockHeaders.forEach((header, index) => {
      if (index < dashboardTranslations[language].low_stock_headers.length) {
        header.textContent = dashboardTranslations[language].low_stock_headers[index];
      }
    });

    // Update Product Low Stock status (Out of Stock, Low Stock)
    const lowStockStatuses = document.querySelectorAll('.table tbody td:last-child');
    lowStockStatuses.forEach((status) => {
      if (status.textContent === "Out of Stock") {
        status.textContent = dashboardTranslations[language].low_stock_status[0];
      } else if (status.textContent === "Low Stock") {
        status.textContent = dashboardTranslations[language].low_stock_status[1];
      }
    });

    // Update No Low Stock message
    const noLowStockMessage = document.querySelector('.table tbody td.text-center');
    if (noLowStockMessage && noLowStockMessage.textContent === "No low stock products found.") {
      noLowStockMessage.textContent = dashboardTranslations[language].no_low_stock_message;
    }
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    originalSetLanguage(language); // Call any existing setLanguage function
    updateDashboardLanguage(language); // Update this page
  };

  // Load saved language on page load
  document.addEventListener('DOMContentLoaded', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    setLanguage(savedLanguage);
  });
</script>