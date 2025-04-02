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
                <div class="icon-big text-center icon-success bubble-shadow-small">
                  <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Sales</p>
                  <h4 class="card-title">345</h4>
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
    <div class="row ">
      <div class="col-md-8 ">
        <div class="card card-round">
          <div class="card-header">
            <div class="card-head-row gap-3">
              <div class="card-title">User Statistics</div>
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

      <div class="col-md-4">
        <div class="card card-round">
          <div class="card-body">
            <div class="card-head-row card-tools-still-right">
              <div class="card-title">Top Selling Products</div>
              <div class="card-tools">
                <div class="dropdown">
                  <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Refresh</a>
                    <a class="dropdown-item" href="#">View All Products</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-list py-4">
              <?php if (empty($orders)): ?>
                <div class="alert alert-warning">No sales data available.</div>
              <?php else: ?>
                <?php foreach ($orders as $order): ?>
                  <div class="item-list d-flex align-items-center mb-3">
                    <div class="avatar">
                      <img src="<?= htmlspecialchars($order['image'] ?: '/default-image.jpg'); ?>"
                        alt="<?= htmlspecialchars($order['item']); ?>" class="avatar-img rounded-circle"
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
    <div class="row">
      <div class="col-md-12">
        <div class="card card-round">
          <div class="card-header">
            <div class="card-head-row card-tools-still-right">
              <div class="card-title">Recent Transactions</div>
              <div class="card-tools">
                <div class="dropdown">
                  <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center mb-0">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Payment Number</th>
                    <th scope="col" class="text-end">Date & Time</th>
                    <th scope="col" class="text-end">Amount</th>
                    <th scope="col" class="text-end">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                        <i class="fa fa-check"></i>
                      </button>
                      Payment from #10231
                    </th>
                    <td class="text-end">Mar 19, 2020, 2.45pm</td>
                    <td class="text-end">$250.00</td>
                    <td class="text-end">
                      <span class="badge badge-success">Completed</span>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                        <i class="fa fa-check"></i>
                      </button>
                      Payment from #10231
                    </th>
                    <td class="text-end">Mar 19, 2020, 2.45pm</td>
                    <td class="text-end">$250.00</td>
                    <td class="text-end">
                      <span class="badge badge-success">Completed</span>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                        <i class="fa fa-check"></i>
                      </button>
                      Payment from #10231
                    </th>
                    <td class="text-end">Mar 19, 2020, 2.45pm</td>
                    <td class="text-end">$250.00</td>
                    <td class="text-end">
                      <span class="badge badge-success">Completed</span>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                        <i class="fa fa-check"></i>
                      </button>
                      Payment from #10231
                    </th>
                    <td class="text-end">Mar 19, 2020, 2.45pm</td>
                    <td class="text-end">$250.00</td>
                    <td class="text-end">
                      <span class="badge badge-success">Completed</span>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                        <i class="fa fa-check"></i>
                      </button>
                      Payment from #10231
                    </th>
                    <td class="text-end">Mar 19, 2020, 2.45pm</td>
                    <td class="text-end">$250.00</td>
                    <td class="text-end">
                      <span class="badge badge-success">Completed</span>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                        <i class="fa fa-check"></i>
                      </button>
                      Payment from #10231
                    </th>
                    <td class="text-end">Mar 19, 2020, 2.45pm</td>
                    <td class="text-end">$250.00</td>
                    <td class="text-end">
                      <span class="badge badge-success">Completed</span>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                        <i class="fa fa-check"></i>
                      </button>
                      Payment from #10231
                    </th>
                    <td class="text-end">Mar 19, 2020, 2.45pm</td>
                    <td class="text-end">$250.00</td>
                    <td class="text-end">
                      <span class="badge badge-success">Completed</span>
                    </td>
                  </tr>
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
  var myBarChart = new Chart(barChart, {

    type: "bar",
    data: {
      labels: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],
      datasets: [{
        label: "Sales",
        backgroundColor: "rgb(23, 125, 255)",
        borderColor: "rgb(23, 125, 255)",
        data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
      },],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
          },
        },],
      },
    },
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
  var ctx = document.getElementById("singelBarChart");
  ctx.height = 160;
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat"],
      datasets: [{
        label: "My First dataset",
        data: [40, 55, 75, 81, 56, 55, 40],
        borderColor: "rgba(0, 123, 255, 0.9)",
        borderWidth: "0",
        backgroundColor: "rgba(0, 123, 255, 0.5)"
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
</script>
<!-- years of dashbouth -->
<script src="../views/assets/js/dashboard-1.js"></script>
<script src="../views/assets/js/dashboard-js/rephael.min.js"></script>
<script src="../views/assets/js/dashboard-js/morris.min.js"></script>


<script src="../views/assets/js/dist/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  $(document).ready(function () {
    var ctx = document.getElementById("morris-bar-chart").getContext("2d");

    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["2020", "2021", "2022", "2023", "2024", "2025", "2026"],
        datasets: [{
          label: "Sales Data",
          data: [40, 55, 75, 81, 56, 55, 40],
          borderColor: "rgba(14, 66, 122, 0.9)",
          borderWidth: 1,
          backgroundColor: "rgba(13, 87, 167, 0.82)",
          hoverBackgroundColor: "rgba(25, 96, 172, 0.7)",
          hoverBorderColor: "rgb(23, 76, 132)",
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function (value) {
                return value + ' units';
              }
            }
          },
          x: {
            title: {
              display: true,
              text: 'Years'
            }
          },
        },
        plugins: {
          tooltip: {
            callbacks: {
              label: function (tooltipItem) {
                return tooltipItem.dataset.label + ': ' + tooltipItem.raw + ' units';
              }
            }
          }
        }
      }
    });
  });
</script>