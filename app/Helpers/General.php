<?php

if (! function_exists('tanggal_indo')) {
    function tanggal_indo($date, $day = false)
    {
        $hari = array ( 1 =>    'Senin',
				'Selasa',
				'Rabu',
				'Kamis',
				'Jumat',
				'Sabtu',
				'Minggu'
			);

		$bulan = array (1 =>   'Januari',
					'Februari',
					'Maret',
					'April',
					'Mei',
					'Juni',
					'Juli',
					'Agustus',
					'September',
					'Oktober',
					'November',
					'Desember'
				);
        $split 	  = explode(' ', $date);
        $time = $split[1] ?: null;
        $split 	  = explode('-', $split[0]);
		$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0] . ', ' . $time;

		if ($day) {
			$num = date('N', strtotime($date));
			return $hari[$num] . ', ' . $tgl_indo;
        }

		return $tgl_indo;
    }
}

if (! function_exists('month_indo')) {
    function month_indo($key)
    {
		$month = array (1 =>   'Januari',
					'Februari',
					'Maret',
					'April',
					'Mei',
					'Juni',
					'Juli',
					'Agustus',
					'September',
					'Oktober',
					'November',
					'Desember'
				);

		return $month[$key];
    }
}
