<main class="main">
    <div class="jumbotron">
        <div class="row">
            <div class="col-lg-12">
            <h1 class="active"><i class="fa fa-area-chart"></i> Grafik</h1>
            <ol class="breadcrumb">
                <li> Data Grafik Tingkat <em>Similarity</em></li>
            </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="data_grafik"></div>
            </div>
        </div>  
        <?php
        include "models/m_plagiarisme.php";
        $plagiarisme = new Plagiarisme($connection);
        $tampil= $plagiarisme->select_plagiarisme();
        $title = array();
        $similarity = array();
        while($data = $tampil->fetch_object()){
        $title[] = $data->title;
        $similarity[] = intval($data->similarity);
        }
        ?>

        <script src="assets/highcharts/highcharts.js"></script>
        <script src="assets/highcharts/exporting.js"></script>
        <script type="text/javascript">   
            Highcharts.chart('data_grafik', {
            chart: {
                type: 'area'
            },
            title: {
                text: 'Nama Dokumen dan Tingkat Plagiarisme'
            },
            subtitle: {
                text: 'Source: @wahyudesena'
            },
            xAxis: {
                categories: <?= json_encode($title);?>,
                tickmarkPlacement: 'on',
                title: {
                enabled: false
                }
            },
            yAxis: {
                title: {
                text: 'Tingkat Similarity'
                },
                labels: {
                formatter: function () {
                    return this.value;
                }
                }
            },
            tooltip: {
            split: false,
            valueSuffix: ''
            },
            plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                lineWidth: 1,
                lineColor: '#666666'
                }
            }
            },
            series: [{
            name: 'Jumlah Similarity',
            data: <?= json_encode($similarity);?>
            }]
            });
        </script> 
    </div>
</main>