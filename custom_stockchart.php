<?php
if ($companygraph) {
  foreach ($companygraph as $comdata) {
      $timezone = 'UTC';
      $curdate = new DateTime($comdata->price_dateCreated, new DateTimeZone($timezone));
      date_sub($curdate, date_interval_create_from_date_string("20 minutes"));
      $date = $curdate->getTimestamp() . '000';
      $dataval[$date] = '[' . $date . ',' . $comdata->price_price . ']' . ',';
  }
  ksort($dataval);
?>
<script src="/sites/all/themes/shareadvisor/js/highstock/highstock.js"></script>
<script src="/sites/all/themes/shareadvisor/js/highstock/highstock-theme.js"></script>
<script>

var data = [<?php
      foreach ($dataval as $finaldata) {
                  print $finaldata;
      }
?>];
var options = {
    chart: {
    renderTo: 'company-chart'
  },
  rangeSelector: {
    selected : 1,
    inputEnabled: false
  },
    yAxis: {
      floor: 0,
      labels: {
          formatter: price_format
      }
  },
  series: [{
     name:'<?php echo "$company_name ($node->title)"; ?>',
     data: data,
     tooltip: {
         valuePrefix: '$'
     },
     dataGrouping: {
      dateTimeLabelFormats: {
        millisecond: ['%a, %e %b %Y, %I:%M:%S.%L%P', '%a, %e %b %Y, %I:%M:%S.%L%P', '-%H:%M:%S.%L%P'],
        second: ['%a, %e %b %Y, %I:%M:%S%P', '%a, %e %b %Y, %I:%M:%S%P', '-%I:%M:%S%P'],
        minute: ['%a, %e %b %Y, %I:%M%P', '%a, %e %b %Y, %I:%M%P', '-%I:%M%P'],
        hour: ['%a, %e %b %Y, %I:%M%P', '%a, %e %b %Y, %I:%M%P', '-%I:%M%P'],
        day: ['%a, %e %b %Y', '%a, %e %b %Y', '-%a, %e %b %Y'],
        week: ['Week from %a, %e %b %Y', '%a, %e %b %Y', '-%a, %e %b %Y']
      }

    }

  }]
};

var chart = new Highcharts.StockChart(options);

function price_format() {
  if (this.value == 0)
    return '$0';
  else if (this.value < 1)
    return '$' + parseFloat(Math.round(this.value * 1000) / 1000).toFixed(3);
  else
    return '$' + parseFloat(Math.round(this.value * 100) / 100).toFixed(2);
      }
</script>
<?php } ?>

