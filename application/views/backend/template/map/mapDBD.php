<script>
    // Menghitung IR
    <?php
    foreach ($pemetaan as $pmt) {
        $jumlahPenduduk = $pmt['jumlahPenduduk'];
        $total_kasus = $pmt['jumlah_kasus'];
        $ir = $total_kasus / $jumlahPenduduk * 100000;

        $data[$pmt['nama']] = number_format($ir, 2);
    }
    ?>
    var PERHITUNGAN = <?= json_encode($data) ?>;

    // Peta Dasar Koordinat tengah KKKU [-1.1505796, 109.5429503]
    var map = L.map('mapDBD').setView([-1.1505796, 109.5429503], 9);
    var LayerKita = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
    });
    map.addLayer(LayerKita);
    // End Peta Dasar

    // Menampilkan informasi pada peta
    var info = L.control();

    info.onAdd = function(map) {
        this._div = L.DomUtil.create('div', 'info');
        this.update();
        return this._div;
    };

    info.update = function(props) {
        this._div.innerHTML = '<h4>Incidence Rate</h4>' + (props ?
            '<b>' + props.KECAMATAN + '</b><br /> IR ' + PERHITUNGAN[props.KECAMATAN] :
            'Arahkan kursor untuk melihat');
    };

    info.addTo(map);

    // Memberi warna legenda sesuai hasil perhitungan
    function getColor(d) {
        return d > 75 ? '#FF0000' :
            d > 55 ? '#FF8C00' :
            d > 35 ? '#FFFF00' :
            '#008000';
    }

    function style(feature) {
        return {
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7,
            fillColor: getColor(PERHITUNGAN[feature.properties.KECAMATAN])
        };
    }

    function highlightFeature(e) {
        var layer = e.target;

        layer.setStyle({
            weight: 2,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.7
        });

        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
            layer.bringToFront();
        }

        info.update(layer.feature.properties);
    }

    // pengaturan geojson
    function resetHighlight(e) {
        var layer = e.target;

        layer.setStyle({
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3'
        });
        info.update();
    }

    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
    }

    function onEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature
        });
    }

    // legenda
    var legend = L.control({
        position: 'bottomright'
    });

    legend.onAdd = function(map) {

        var div = L.DomUtil.create('div', 'info legend'),
            grades = [0, 35, 55, 75],
            labels = [],
            from, to;

        for (var i = 0; i < grades.length; i++) {
            from = grades[i];
            to = grades[i + 1];

            labels.push(
                '<i style="background:' + getColor(from + 1) + '"></i> ' +
                from + (to ? ' &ndash; ' + to : '+'));
        }

        div.innerHTML = labels.join('<br>');
        return div;
    };

    legend.addTo(map);

    // Memanggil GeoJSON
    <?php foreach ($kecamatan as $kcm) : ?>
        var jsonTest = new L.GeoJSON.AJAX(["<?= base_url() ?>assets/geojson/<?= $kcm['geojson'] ?>"], {
            style: style,
            onEachFeature: onEachFeature
        }).addTo(map);
    <?php endforeach; ?>
</script>