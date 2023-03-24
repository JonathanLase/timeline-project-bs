<?= $this->extend("layouts/master_app") ?>
<?= $this->section("content") ?>
<!-- ChartJS -->
<script src="/assets/chart.js/Chart.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- PIE CHART -->
    <div class="row">
        <?php foreach ($bidang as $b) : ?>
            <div class="col-sm-6 mb-3">
                <div class="card card-danger">
                    <div class="card-header" style="background: rgb(11,57,106); background: linear-gradient(135deg, rgba(11,57,106,1) 0%, rgba(15,76,141,1) 50%, rgba(237,126,37,1) 100%);border-radius:6px;">
                        <h3 class="card-title" style="color:white">Dashboard Project Bidang <?= $b->nama_bidang; ?></h3>
                    </div>
                    <div class="card-body">
                        <canvas id="<?= url_title($b->nama_bidang); ?>"></canvas>
                    </div>
                    <!-- /.card-body -->
                    <h6 class="text-center">Total Project :
                        <?php foreach ($projectpasi as $pps) : ?>
                            <?php if ($pps['nm_bidang'] == $b->nama_bidang) {
                                echo $pps['totalProjectPasi'];
                            }
                            ?>
                        <?php endforeach; ?>
                    </h6>
                </div>
            </div>
            <script>
                const <?= url_title($b->nama_bidang, '_'); ?> = document.getElementById('<?= url_title($b->nama_bidang, '_'); ?>');
            </script>
        <?php endforeach; ?>
    </div>
</div>

<script>
    <?php $no = 0; ?>
    <?php foreach ($bidang as $b) : ?>
        new Chart(<?= url_title($b->nama_bidang, '_'); ?>, {
            type: 'pie',
            data: {
                labels: ['Done', 'On Progress'],
                datasets: [{
                    data: [
                        <?php foreach ($projectDone as $pD) : ?>
                            <?php if ($pD['nm_bidang'] == $b->nama_bidang) {
                                echo $pD['total_project_done'];
                            }
                            ?>
                        <?php endforeach; ?>,
                        <?php foreach ($projectProgress as $pD) : ?>
                            <?php if ($pD['nm_bidang'] == $b->nama_bidang) {
                                echo $pD['total_project_progress'];
                            }
                            ?>
                        <?php endforeach; ?>
                    ],
                    backgroundColor: [
                        'rgb(127, 230, 100)',
                        'rgb(255, 205, 86)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    <?php endforeach; ?>
</script>
<?= $this->endSection(); ?>