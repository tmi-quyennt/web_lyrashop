<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
            font-size: 2.5em;
        }

        .stat-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .stat-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 150px;
            border: 2px solid #e3e6ea;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
        }

        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .stat-box h2 {
            font-size: 1.2em;
            color: #fff;
            margin: 0;
            margin-bottom: 10px;
        }

        .stat-box .value {
            font-size: 2.5em;
            color: #fff;
        }

        .total-orders {
            background-color: #3498db;
        }

        .processed-orders {
            background-color: #2ecc71;
        }

        .pending-orders {
            background-color: #f1c40f;
        }

        .unprocessed-orders {
            background-color: #e74c3c;
        }

        .total-revenue {
            background-color: #9b59b6;
        }

        .total-products-in-stock {
            background-color: #e67e22;
        }

        .chart-container {
            width: 100%;
            margin: 30px auto;
        }

        .year-selector {
            margin: 20px 0;
            text-align: center;
        }

        .year-selector select {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 2em;
            }

            .stat-box h2 {
                font-size: 1em;
            }

            .stat-box .value {
                font-size: 2em;
            }

            .chart-container {
                width: 100%;
                margin: 20px auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thống kê đơn hàng</h1>
        <div class="stat-container">
            <div class="stat-box total-orders">
                <h2>Tổng đơn hàng</h2>
                <div class="value"><?= $total_orders; ?></div>
            </div>
            <div class="stat-box total-revenue">
                <h2>Tổng doanh thu</h2>
                <div class="value"><?= number_format($total_revenue, 0, ',', '.'); ?> VND</div>
            </div>
            <div class="stat-box total-products-in-stock">
                <h2>Tổng số sản phẩm trong kho</h2>
                <div class="value"><?= $total_products_in_stock; ?></div>
            </div>
            <div class="stat-box processed-orders">
                <h2>Đơn hàng đã được xử lý</h2>
                <div class="value"><?= $processed_orders; ?></div>
            </div>
            <div class="stat-box unprocessed-orders">
                <h2>Đơn hàng bị hủy</h2>
                <div class="value"><?= $unprocessed_orders; ?></div>
            </div> 
            <div class="stat-box pending-orders">
                <h2>Đơn hàng chưa được xử lý</h2>
                <div class="value"><?= $pending_orders; ?></div>
            </div>
        </div>
        <div class="year-selector">
            <form method="get" action="<?= base_url('order/statistics'); ?>">
                <label for="year">Chọn năm:</label>
                <select name="year" id="year" onchange="this.form.submit()">
                    <?php foreach ($years as $year): ?>
                        <option value="<?= $year; ?>" <?= $year == $selected_year ? 'selected' : ''; ?>>
                            <?= $year; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
        <div class="chart-container">
            <h1>Biểu đồ doanh thu theo từng tháng</h1>
            <canvas id="revenueChart"></canvas>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php 
                    for ($i = 1; $i <= 12; $i++) {
                        echo '"' . date('F', mktime(0, 0, 0, $i, 1)) . '",';
                    }
                ?>],
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: [<?php 
                        $revenue_data = array_fill(1, 12, 0);
                        foreach ($monthly_revenue as $revenue) {
                            $revenue_data[$revenue->month] = $revenue->total_revenue;
                        }
                        echo implode(',', $revenue_data);
                    ?>],
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y.toLocaleString('en-US') + ' VND';
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tháng'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Doanh thu (VND)'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
