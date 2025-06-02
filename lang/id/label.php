<?php

return [
    // IDs
    'id' => 'ID',
    'user_id' => 'ID pelanggan',
    'service_id' => 'ID layanan',
    'service_order_id' => 'ID pesanan',

    // Umum
    'name' => 'Nama',
    'slug' => 'Slug',
    'phone' => 'No. telepon',
    'address' => 'Alamat',
    'description' => 'Deskripsi',
    'thumbnail' => 'Thumbnail',
    'category' => 'Kategori',
    'unit' => 'Satuan',
    'created_at' => 'Dibuat pada',
    'updated_at' => 'Diperbarui pada',
    'copyable' => 'Klik untuk menyalin',
    'all' => 'Semua',

    // Dashboard
    'dashboard' => 'Dashboard',

    // Profil
    'email' => 'Alamat email',
    'password' => 'Kata sandi',
    'password_confirmation' => 'Konfirmasi kata sandi',
    'gender' => 'Jenis kelamin',
    'birth_date' => 'Tanggal lahir',
    'occupation' => 'Pekerjaan',
    'email_verified_at' => 'Terverifikasi pada',
    'is_verified' => 'Terverifikasi?',
    'verified' => 'Terverifikasi',
    'not_verified' => 'Belum terverifikasi',

    // Pelanggan
    'customer' => 'Pelanggan',
    'customer_name' => 'Nama pelanggan',
    'customer_email' => 'Email pelanggan',

    // FAQ
    'faq' => 'FAQ',
    'question' => 'Pertanyaan',
    'answer' => 'Jawaban',

    // Kategori Layanan
    'service_category' => 'Kategori Layanan',

    // Satuan Layanan
    'service_unit' => 'Satuan Layanan',

    // Layanan
    'service' => 'Layanan',
    'price' => 'Harga',
    'is_outside_area' => 'Luar area?',
    'area' => 'Area',
    'service_name' => 'Nama layanan',
    'service_price' => 'Harga layanan',

    // Pesanan
    'order' => 'Pesanan',
    'start_time' => 'Waktu mulai',
    'end_time' => 'Waktu selesai',
    'notes' => 'Catatan',
    'status' => 'Status',
    'no_testimonial' => 'Perlu ulasan',
    'has_testimonial' => 'Sudah diulas',

    // Testimoni
    'testimonial' => 'Testimoni',
    'content' => 'Konten',
    'is_publish' => 'Tayang?',

    // Enum
    /* Jenis Kelamin */
    'male' => 'Laki-laki',
    'female' => 'Perempuan',

    /* Pekerjaan */
    'student' => 'Pelajar',
    'college_student' => 'Mahasiswa',
    'civil_servant' => 'PNS',
    'military' => 'TNI',
    'police_officer' => 'Polisi',
    'private_employee' => 'Karyawan Swasta',
    'entrepreneur' => 'Wiraswasta',
    'farmer' => 'Petani',
    'fisherman' => 'Nelayan',
    'laborer' => 'Buruh',
    'teacher' => 'Guru',
    'lecturer' => 'Dosen',
    'doctor' => 'Dokter',
    'nurse' => 'Perawat',
    'housewife' => 'Ibu Rumah Tangga',
    'unemployed' => 'Tidak Bekerja',
    'other' => 'Lainnya',

    /* Status Pesanan */
    'pending' => 'Menunggu konfirmasi',
    'confirmed' => 'Dikonfirmasi',
    'onprogress' => 'Sedang dikerjakan',
    'completed' => 'Selesai',
    'canceled' => 'Dibatalkan',

    /* Status Publikasi Testimoni */
    'published' => 'Tayang',
    'private' => 'Disembunyikan',

    /* Tipe Lokasi */
    'outside' => 'Dalam',
    'inside' => 'Luar',

    // Navigation
    'nav' => [
		'group' => [
			'customer_management' => 'Manajemen Pelanggan',
			'service_management' => 'Manajemen Layanan',
			'guide' => 'Panduan',
		],
        'badge' => [
            'tooltip' => [
                'order' => 'Total pesanan baru'
            ],
        ],
    ],

	// Widget
	'widget' => [
		'increase' => 'Naik ',
		'decrease' => 'Turun ',
		'weekly' => ' dalam seminggu',
		'neutral' => 'Tidak ada perubahan',
		'customer' => [
			'total' => 'Total Pengguna Terdaftar',
		],
		'order' => [
			'total' => 'Total Pesanan Masuk',
		],
		'testimonial' => [
			'total' => 'Total Ulasan Layanan',
		],
	]

];
