<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa Validasi
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut berisi pesan kesalahan default yang digunakan oleh
	| kelas validator. Beberapa aturan ini memiliki beberapa versi, seperti
	| aturan ukuran. Anda bebas untuk menyesuaikan setiap pesan ini di sini.
    |
    */

    'accepted' => 'Input :attribute harus diterima.',
    'accepted_if' => 'Input :attribute harus diterima ketika :other adalah :value.',
    'active_url' => 'Input :attribute harus merupakan URL yang valid.',
    'after' => 'Input :attribute harus merupakan tanggal setelah :date.',
    'after_or_equal' => 'Input :attribute harus merupakan tanggal setelah atau sama dengan :date.',
    'alpha' => 'Input :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'Input :attribute hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
    'alpha_num' => 'Input :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Input :attribute harus berupa array.',
    'ascii' => 'Input :attribute hanya boleh berisi karakter alfanumerik dan simbol satu byte.',
    'before' => 'Input :attribute harus merupakan tanggal sebelum :date.',
    'before_or_equal' => 'Input :attribute harus merupakan tanggal sebelum atau sama dengan :date.',
    'between' => [
        'array' => 'Input :attribute harus memiliki antara :min dan :max item.',
        'file' => 'Input :attribute harus antara :min dan :max kilobyte.',
        'numeric' => 'Input :attribute harus antara :min dan :max.',
        'string' => 'Input :attribute harus antara :min dan :max karakter.',
    ],
    'boolean' => 'Input :attribute harus bernilai true atau false.',
    'can' => 'Input :attribute mengandung nilai yang tidak sah.',
    'confirmed' => 'Input :attribute tidak cocok.',
    'contains' => 'Input :attribute tidak memiliki nilai yang diperlukan.',
    'current_password' => 'Kata sandi salah.',
    'date' => 'Input :attribute harus merupakan tanggal yang valid.',
    'date_equals' => 'Input :attribute harus merupakan tanggal yang sama dengan :date.',
    'date_format' => 'Input :attribute harus sesuai dengan format :format.',
    'decimal' => 'Input :attribute harus memiliki :decimal tempat desimal.',
    'declined' => 'Input :attribute harus ditolak.',
    'declined_if' => 'Input :attribute harus ditolak ketika :other adalah :value.',
    'different' => 'Input :attribute dan :other harus berbeda.',
    'digits' => 'Input :attribute harus terdiri dari :digits digit.',
    'digits_between' => 'Input :attribute harus memiliki antara :min dan :max digit.',
    'dimensions' => 'Input :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => 'Input :attribute memiliki nilai duplikat.',
    'doesnt_end_with' => 'Input :attribute tidak boleh diakhiri dengan salah satu dari berikut ini: :values.',
    'doesnt_start_with' => 'Input :attribute tidak boleh diawali dengan salah satu dari berikut ini: :values.',
    'email' => 'Input :attribute harus merupakan alamat email yang valid.',
    'ends_with' => 'Input :attribute harus diakhiri dengan salah satu dari berikut ini: :values.',
    'enum' => 'Pilihan :attribute yang dipilih tidak valid.',
    'exists' => 'Pilihan :attribute yang dipilih tidak valid.',
    'extensions' => 'Input :attribute harus memiliki salah satu ekstensi berikut: :values.',
    'file' => 'Input :attribute harus berupa file.',
    'filled' => 'Input :attribute harus memiliki nilai.',
    'gt' => [
        'array' => 'Input :attribute harus memiliki lebih dari :value item.',
        'file' => 'Input :attribute harus lebih besar dari :value kilobyte.',
        'numeric' => 'Input :attribute harus lebih besar dari :value.',
        'string' => 'Input :attribute harus lebih dari :value karakter.',
    ],
    'gte' => [
        'array' => 'Input :attribute harus memiliki :value item atau lebih.',
        'file' => 'Input :attribute harus lebih besar dari atau sama dengan :value kilobyte.',
        'numeric' => 'Input :attribute harus lebih besar dari atau sama dengan :value.',
        'string' => 'Input :attribute harus lebih dari atau sama dengan :value karakter.',
    ],
    'hex_color' => 'Input :attribute harus berupa warna hexadecimal yang valid.',
    'image' => 'Input :attribute harus berupa gambar.',
    'in' => 'Pilihan :attribute yang dipilih tidak valid.',
    'in_array' => 'Input :attribute harus ada di dalam :other.',
    'integer' => 'Input :attribute harus berupa bilangan bulat.',
    'ip' => 'Input :attribute harus berupa alamat IP yang valid.',
    'ipv4' => 'Input :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => 'Input :attribute harus berupa alamat IPv6 yang valid.',
    'json' => 'Input :attribute harus berupa string JSON yang valid.',
    'list' => 'Input :attribute harus berupa daftar.',
    'lowercase' => 'Input :attribute harus berupa huruf kecil.',
    'lt' => [
        'array' => 'Input :attribute harus memiliki kurang dari :value item.',
        'file' => 'Input :attribute harus kurang dari :value kilobyte.',
        'numeric' => 'Input :attribute harus kurang dari :value.',
        'string' => 'Input :attribute harus kurang dari :value karakter.',
    ],
    'lte' => [
        'array' => 'Input :attribute tidak boleh memiliki lebih dari :value item.',
        'file' => 'Input :attribute harus kurang dari atau sama dengan :value kilobyte.',
        'numeric' => 'Input :attribute harus kurang dari atau sama dengan :value.',
        'string' => 'Input :attribute harus kurang dari atau sama dengan :value karakter.',
    ],
    'mac_address' => 'Input :attribute harus berupa alamat MAC yang valid.',
    'max' => [
        'array' => 'Input :attribute tidak boleh memiliki lebih dari :max item.',
        'file' => 'Input :attribute tidak boleh lebih dari :max kilobyte.',
        'numeric' => 'Input :attribute tidak boleh lebih dari :max.',
        'string' => 'Input :attribute tidak boleh lebih dari :max karakter.',
    ],
    'max_digits' => 'Input :attribute tidak boleh memiliki lebih dari :max digit.',
    'mimes' => 'Input :attribute harus berupa file dengan tipe: :values.',
    'mimetypes' => 'Input :attribute harus berupa file dengan tipe: :values.',
    'min' => [
        'array' => 'Input :attribute harus memiliki setidaknya :min item.',
        'file' => 'Input :attribute harus memiliki setidaknya :min kilobyte.',
        'numeric' => 'Input :attribute harus memiliki setidaknya :min.',
        'string' => 'Input :attribute harus memiliki setidaknya :min karakter.',
    ],
    'min_digits' => 'Input :attribute harus memiliki setidaknya :min digit.',
    'missing' => 'Input :attribute harus hilang.',
    'missing_if' => 'Input :attribute harus hilang ketika :other bernilai :value.',
    'missing_unless' => 'Input :attribute harus hilang kecuali :other bernilai :value.',
    'missing_with' => 'Input :attribute harus hilang ketika :values ada.',
    'missing_with_all' => 'Input :attribute harus hilang ketika :values ada.',
    'multiple_of' => 'Input :attribute harus merupakan kelipatan dari :value.',
    'not_in' => 'Pilihan :attribute yang dipilih tidak valid.',
    'not_regex' => 'Format :attribute tidak valid.',
    'numeric' => 'Input :attribute harus berupa angka.',
    'password' => [
        'letters' => 'Input :attribute harus mengandung setidaknya satu huruf.',
        'mixed' => 'Input :attribute harus mengandung setidaknya satu huruf kapital dan satu huruf kecil.',
        'numbers' => 'Input :attribute harus mengandung setidaknya satu angka.',
        'symbols' => 'Input :attribute harus mengandung setidaknya satu simbol.',
        'uncompromised' => 'Input :attribute yang diberikan telah muncul dalam kebocoran data. Harap pilih :attribute yang berbeda.',
    ],
    'present' => 'Input :attribute harus ada.',
    'present_if' => 'Input :attribute harus ada ketika :other bernilai :value.',
    'present_unless' => 'Input :attribute harus ada kecuali :other bernilai :value.',
    'present_with' => 'Input :attribute harus ada ketika :values ada.',
    'present_with_all' => 'Input :attribute harus ada ketika :values ada.',
    'prohibited' => 'Input :attribute dilarang.',
    'prohibited_if' => 'Input :attribute dilarang ketika :other bernilai :value.',
    'prohibited_unless' => 'Input :attribute dilarang kecuali :other ada dalam :values.',
    'prohibits' => 'Input :attribute melarang :other untuk ada.',
    'regex' => 'Format :attribute tidak valid.',
    'required' => 'Input :attribute wajib diisi.',
    'required_array_keys' => 'Input :attribute harus mengandung entri untuk: :values.',
    'required_if' => 'Input :attribute wajib diisi ketika :other bernilai :value.',
    'required_if_accepted' => 'Input :attribute wajib diisi ketika :other diterima.',
    'required_if_declined' => 'Input :attribute wajib diisi ketika :other ditolak.',
    'required_unless' => 'Input :attribute wajib diisi kecuali :other ada dalam :values.',
    'required_with' => 'Input :attribute wajib diisi ketika :values ada.',
    'required_with_all' => 'Input :attribute wajib diisi ketika :values ada.',
    'required_without' => 'Input :attribute wajib diisi ketika :values tidak ada.',
    'required_without_all' => 'Input :attribute wajib diisi ketika tidak ada satu pun dari :values yang ada.',
    'same' => 'Input :attribute harus cocok dengan :other.',
    'size' => [
        'array' => 'Input :attribute harus mengandung :size item.',
        'file' => 'Input :attribute harus berukuran :size kilobyte.',
        'numeric' => 'Input :attribute harus bernilai :size.',
        'string' => 'Input :attribute harus terdiri dari :size karakter.',
    ],
    'starts_with' => 'Input :attribute harus diawali dengan salah satu dari berikut ini: :values.',
    'string' => 'Input :attribute harus berupa string.',
    'timezone' => 'Input :attribute harus merupakan zona waktu yang valid.',
    'unique' => 'Data sudah digunakan.',
    'uploaded' => 'Gagal mengunggah :attribute.',
    'uppercase' => 'Input :attribute harus menggunakan huruf kapital.',
    'url' => 'Input :attribute harus merupakan URL yang valid.',
    'ulid' => 'Input :attribute harus merupakan ULID yang valid.',
    'uuid' => 'Input :attribute harus merupakan UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa Validasi Kustom
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi kustom untuk atribut dengan
    | menggunakan konvensi "attribute.rule" untuk memberi nama baris pesan.
    | Ini memudahkan untuk menentukan baris bahasa kustom tertentu untuk aturan atribut tertentu.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atribut Validasi Kustom
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk mengganti placeholder atribut kita
    | dengan sesuatu yang lebih ramah pembaca seperti "Alamat email" daripada
    | "email". Ini membantu kita membuat pesan lebih ekspresif.
    |
    */

    'attributes' => [],

];
