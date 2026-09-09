<?php

$kriteria = [
    // MADDA
    "K2" => ["ukm" => "UKM1", "bobot" => 30],
    "K4" => ["ukm" => "UKM1", "bobot" => 25],
    "K7" => ["ukm" => "UKM1", "bobot" => 20],
    "K10" => ["ukm" => "UKM1", "bobot" => 10],
    "K13" => ["ukm" => "UKM1", "bobot" => 15],

    // TECHNOSANTRI
    "K3" => ["ukm" => "UKM3", "bobot" => 25],
    "K6" => ["ukm" => "UKM3", "bobot" => 15],
    "K12" => ["ukm" => "UKM3", "bobot" => 20],
    "K8" => ["ukm" => "UKM3", "bobot" => 15],
    "K14" => ["ukm" => "UKM3", "bobot" => 20],

    // YOUNG RESEARCH
    "K1"  => ["ukm" => "UKM2", "bobot" => 32],
    "K5" => ["ukm" => "UKM2", "bobot" => 21],
    "K9" => ["ukm" => "UKM2", "bobot" => 13],
    "K11" => ["ukm" => "UKM2", "bobot" => 10],
    "K15" => ["ukm" => "UKM2", "bobot" => 24],

    // MAPALA BATIK
    "K16"  => ["ukm" => "UKM2", "bobot" => 30],
    "K20" => ["ukm" => "UKM2", "bobot" => 20],
    "K24" => ["ukm" => "UKM2", "bobot" => 20],
    "K28" => ["ukm" => "UKM2", "bobot" => 20],
    "K32" => ["ukm" => "UKM2", "bobot" => 10],

    // AKSEN
    "K17"  => ["ukm" => "UKM2", "bobot" => 27],
    "K21" => ["ukm" => "UKM2", "bobot" => 22],
    "K25" => ["ukm" => "UKM2", "bobot" => 18],
    "K29" => ["ukm" => "UKM2", "bobot" => 18],
    "K33" => ["ukm" => "UKM2", "bobot" => 15],

    // SPORT
    "K18"  => ["ukm" => "UKM2", "bobot" => 30],
    "K22" => ["ukm" => "UKM2", "bobot" => 25],
    "K26" => ["ukm" => "UKM2", "bobot" => 20],
    "K30" => ["ukm" => "UKM2", "bobot" => 15],
    "K34" => ["ukm" => "UKM2", "bobot" => 10],

    // HIITSNU
    "K19"  => ["ukm" => "UKM2", "bobot" => 33],
    "K23" => ["ukm" => "UKM2", "bobot" => 23],
    "K27" => ["ukm" => "UKM2", "bobot" => 22],
    "K31" => ["ukm" => "UKM2", "bobot" => 17],
    "K35" => ["ukm" => "UKM2", "bobot" => 5],
];

function kombinasi($array, $length) {
    $result = [];
    $recurse = function($start, $combo) use (&$recurse, &$result, $array, $length) {
        if (count($combo) == $length) {
            $result[] = $combo;
            return;
        }
        for ($i = $start; $i < count($array); $i++) {
            $recurse($i + 1, array_merge($combo, [$array[$i]]));
        }
    };
    $recurse(0, []);
    return $result;
}

$allK = array_keys($kriteria);
$rules = [];
$id = 1;

for ($i = 3; $i <= 5; $i++) {
    $kombinasiList = kombinasi($allK, $i);

    foreach ($kombinasiList as $komb) {

        $count = [];
        $bobot = [];

        foreach ($komb as $k) {
            $ukm = $kriteria[$k]["ukm"];
            $count[$ukm] = ($count[$ukm] ?? 0) + 1;
            $bobot[$ukm] = ($bobot[$ukm] ?? 0) + $kriteria[$k]["bobot"];
        }

        // Step 1: jumlah terbanyak
        $maxCount = max($count);
        $kandidat = array_keys(array_filter($count, fn($v) => $v == $maxCount));

        // Step 2: bobot
        if (count($kandidat) > 1) {
            $maxBobot = max(array_intersect_key($bobot, array_flip($kandidat)));
            $kandidat = array_keys(array_filter($bobot, fn($v, $k) => in_array($k, $kandidat) && $v == $maxBobot, ARRAY_FILTER_USE_BOTH));
        }

        // Step 3: alfabet
        sort($kandidat);
        $final = $kandidat[0];

        // Alasan
        if (count($kandidat) == 1) {
            $alasan = "Berdasarkan jumlah kriteria terbanyak";
        } else {
            $alasan = "Jumlah sama, dipilih berdasarkan bobot tertinggi atau alfabet";
        }

        $rules[] = [
            "R$id",
            implode(",", $komb),
            $final,
            $alasan
        ];

        $id++;
    }
}

// Export CSV
$file = fopen("rule_ukm.csv", "w");
fputcsv($file, ["idRule","kriteriaTerpilih","idUkm","alasan"]);

foreach ($rules as $r) {
    fputcsv($file, $r);
}

fclose($file);

echo "CSV berhasil dibuat!";
?>