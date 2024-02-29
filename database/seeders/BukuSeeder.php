<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $booksData = [
            [
                'judul' => 'Cantik Itu Luka',
                'penulis' => 'Eka Kurniawan',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2018,
                'deskripsi' => 'Hidup di era kolonialisme bagi para wanita dianggap sudah setara seperti hidup di neraka. Terutama bagi para wanita berparas cantik yang menjadi incaran tentara penjajah untuk melampiaskan hasrat mereka. Itu lah takdir miris yang dilalui Dewi Ayu, demi menyelamatkan hidupnya sendiri Dewi harus menerima paksaan menjadi pelacur bagi tentara Belanda dan Jepang selama masa kedudukan mereka di Indonesia.
                Kecantikan Dewi tidak hanya terkenal dikalangan para penjajah saja, seluruh desa pun mengakui pesona parasnya itu. Namun bagi Dewi, kecantikannya ini seperti kutukan, kutukan yang membuat hidupnya sengsara, dan kutukan yang mengancam takdir keempat anak perempuannya yang ikut mewarisi genetik cantiknya.',
                'stock' => '10',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Cantik-itu-Luka-Novel-1.jpg',
            ],
            [
                'judul' => 'Bumi',
                'penulis' => 'Tere Liye',
                'penerbit' => 'SABAKGRIP',
                'tahun_terbit' => 2022,
                'deskripsi' => 'Bumi, merupakan rangkaian awal dari kisah sekelompok anak remaja berkemampuan istimewa. Menceritakan tentang Raib, Ali, dan Seli yang bertualang ke dunia paralel. Mereka yang istimewa, mampu pergi ke dunia pararel bumi, bertemu dengan klan lain dan berhadapan dengan Tamus yang memiliki ambisi membebaskan si Tanpa Mahkota dan kemudian, menguasai bumi.
                Perkenalkan, Raib, seorang gadis belia berusia lima belas tahun yang tidak biasa. Dia bisa menghilang. Jangan beritahu siapapun, Itu adalah rahasia terbesar yang tak pernah ia ceritakan pada siapapun, termasuk kedua orangtuanya. Kehidupannya tetap berjalan normal, meskipun untuk dirinya sendiri. Tidak jarang Raib menjahili orang tuanya dengan tiba-tiba menghilang, lalu muncul kembali secara tiba-tiba membuat kaget kedua orangtuanya.
                Tidak hanya menyuguhkan cerita fantasi, novel ini juga memberikan pesan moral tentang keluarga, dan persahabatan. Tere Liye sukses membangun kisah persahabatan antara Raib, Ali, dan Seli terasa nyata. Hubungan antara Raib dan keluarganya membuat pembaca penasaran sekaligus tersadar akan cara berkomunikasi dengan orang tua.',
                'stock' => '20',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Bumi-Novel-2.jpg',
            ],
            [
                'judul' => 'Bumi Manusia',
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Lentera Dipantara',
                'tahun_terbit' => 2015,
                'deskripsi' => 'Roman Tetralogi Buru mengambil latar belakang dan cikal bakal nation Indonesia di awal abad ke-20. Dengan membacanya waktu kita dibalikkan sedemikian rupa dan hidup di era membibitnya pergerakan nasional mula-mula, juga pertautan rasa, kegamangan jiwa, percintaan, dan pertarungan kekuatan anonim para srikandi yang mengawal penyemaian bangunan nasional yang kemudian kelak melahirkan Indonesia modern.
                Roman bagian pertama; Bumi Manusia, sebagai periode penyemaian dan kegelisahan dimana Minke sebagai aktor sekaligus kreator adalah manusia berdarah priyayi yang semampu mungkin keluar dari kepompong kejawaannya menuju manusia yang bebas dan merdeka, di sudut lain membelah jiwa ke-Eropa-an yang menjadi simbol dan kiblat dari ketinggian pengetahuan dan peradaban.',
                'stock' => '5',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Bumi-Manusia-Novel-3.jpg',
            ],
            [
                'judul' => 'Blue Lock',
                'penulis' => 'Muneyuki Kaneshiro',
                'penerbit' => 'Elex Media Komputindo',
                'tahun_terbit' => 2022,
                'deskripsi' => 'Tahun 2018 timnas Jepang tereliminasi pada putaran per delapan final Piala Dunia. Akibat kegagalan ini, persatuan sepak bola Jepang mendirikan training camp ‘Blue Lock’, mengumpulkan 300 orang penyerang pelajar tingkat SMA supaya Jepang menjadi juara piala dunia. Jinpachi Ego, laki-laki yang menjabat sebagai pelatih, menegaskan, “yang dibutuhkan Jepang itu striker yang penuh keegoisan”. Penyerang yang tidak terkenal, Yoichi Isagi, dan teman-teman penyerang lainnya mengikuti training di mana mereka bersaing satu sama lain, training yang akan mengubah diri mereka menjadi egois!
                "Mulai hari ini kalian akan tinggal bersama di sini, mengikuti training khusus yang aku rancang. Kalian tidak bisa pulang ke rumah, tidak lagi melakukan kegiatan sepak bola yang selama ini kalian lakukan. Tapi, aku tegaskan. Kalau berhasil bertahan dalam blue lock ini dan mengalahkan 299 Peserta yang lain, maka, 1 orang terakhir yang tersisa bisa menjadi striker nomor 1 di dunia!” -Jinpachi Ego
                Kalimat tersebut bergemuruh di dalam dada Yoichi Isagi, seorang penyerang tim sepak bola pelajar SMA tidak terkenal yang gagal maju ke kejuaraan nasional setelah umpan yang diberikannya pada teman satu timnya, gagal membobol gawang lawan dan malah kecolongan gol oleh serangan balik penyerang lawan, Ryousuke Kira.',
                'stock' => '15',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Blue-Lock-Komik-1.jpg',
            ],
            [
                'judul' => 'Tokyo Ghoul',
                'penulis' => 'SUI ISHIDA',
                'penerbit' => 'm&c!',
                'tahun_terbit' => 2022,
                'deskripsi' => 'Di kota ini, ada sebentuk "keputusasaan" yang menyelusup… Monster yang membaur dalam keramaian, memburu manusia dan memakan dagingnya… Manusia menyebutnya "ghoul". Seorang pemuda tak sengaja bertemu monster… Saat itulah, roda nasib yang aneh mulai berputar...!',
                'stock' => '10',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Tokyo Ghoul Komik 2.jpg',
            ],
            [
                'judul' => 'Komik Next G: Angkot Tua Rpl',
                'penulis' => 'Sausan Apsarini',
                'penerbit' => 'Muffin Graphics',
                'tahun_terbit' => 2022,
                'deskripsi' => 'Belakangan ini, Nadya dan Syifa sering mendengar kisah horor tentang angkot tua yang selalu menakut-nakuti penumpangnya. Konon, angkot itu akan muncul secara misterius di malam hari. Banyak peringatan untuk tidak menaiki angkot tua itu. Tapi, apa jadinya kalau Nadya dan Syifa nekat menaiki angkot tua itu?
                ',
                'stock' => '5',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Komik 2.jpg',
            ],
            [
                'judul' => 'Kitab Kisah-Kisah Legenda Nusantara',
                'penulis' => 'Kak Karina',
                'penerbit' => 'Anak Hebat Indonesia',
                'tahun_terbit' => 2023,
                'deskripsi' => 'Buku 101 Kisah-Kisah Legenda Nusantara memuat cerita menarik dari Provinsi Aceh hingga Provinsi Papua. Buku ini mengajarkan kita 101 hikmah yang terkandung dalam cerita legenda tersebut.
                Dalam buku besar ini, kalian akan menemukan cerita-cerita yang menyajikan kisah cinta kasih, kejujuran, keberanian, akhlak mulia, dan juga moral terpuji yang patut diteladani dan dipelajari sejak dini.
                Ayo, kita berpetualang bersama dengan para tokoh di dalam buku cerita legenda di Nusantara ini!',
                'stock' => '5',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Dongeng-1.jpg',
            ],
            [
                'judul' => 'Si Cimo : Dongeng Budi Pekerti',
                'penulis' => 'Hastarita Dewanti',
                'penerbit' => 'Anak Hebat Indonesia',
                'tahun_terbit' => 2023,
                'deskripsi' => 'Si Cimo: Dongeng Budi Pekerti menceritakan tentang kelinci kecil nan lucu bernama Cimo yang bersekolah di TK Satwa Ceria. Cimo mempunyai sahabat bernama Monay Si Monyet dan Baba Si Badak. Banyak sekali kisah seru mereka bersama.
                Ayo, kita baca cerita seru Cimo dan sahabatnya dalam buku ini. Pasti menarik sekali dan sayang untuk dilewatkan. Di sini, Adik-adik akan belajar banyak tentang pesan moral dalam kehidupan sehari-hari. Buku cerita ini sangat cocok menemani aktivitas belajar Adik-adik semua, apalagi sebagai pengantar tidur.',
                'stock' => '10',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Dongeng 2.jpg',
            ],
            [
                'judul' => 'Sukarno-Sebuah Biografi Politik',
                'penulis' => 'J.D. Legge',
                'penerbit' => '-',
                'tahun_terbit' => 2023,
                'deskripsi' => 'Sukarno ialah salah satu tokoh yang paling spektakuler di antara para pemimpin antikolonial yang berjuang melawan penjajahan Eropa di Asia dan Afrika pada paruh pertama abad ke-20.
                Ketika Indonesia merdeka, Sukarno menjadi pilihan satu-satunya untuk posisi presiden. Meski begitu, dalam banyak hal, ia merupakan presiden yang kontroversial. Sesudah namanya tercoreng pada pertengahan 1960-an, Sukarno pelan-pelan disingkirkan dari jabatannya dan sempat terlupakan setelah kematiannya.
                Ketika putrinya, Megawati Sukarnoputri, menjadi presiden Indonesia pada 2001, perhatian terhadap Sukarno bangkit kembali, sehingga karier dan warisan politiknya layak ditinjau kembali. Apakah berjalannya waktu dan kejadian-kejadian dalam 35 tahun ke belakang mempengaruhi cara ia dipandang?
                Biografi Sukarno karya Legge ini berusaha menjawab pertanyaan tentang persepsi Indonesia saat ini terhadap presiden pertamanya.',
                'stock' => '5',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Biografi 1.jpg',
            ],
            [
                'judul' => 'Hingga Akhir Waktu',
                'penulis' => 'Brian Greene',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2022,
                'deskripsi' => 'Dalam keutuhan waktu, segala yang hidup akan mati. Selama tiga miliar tahun lebih, selagi spesies-spesies sederhana dan kompleks mendapat tempat di hierarki Bumi, kematian telah terus membayangi mekarnya kehidupan. Keragaman menyebar selagi kehidupan merayap dari laut ke darat, dan terbang ke angkasa. Namun tunggulah cukup lama, hingga buku catatan kelahiran dan kematian, yang isinya lebih banyak daripada jumlah bintang di galaksi, akan menjadi imbang dengan sungguh presisi. Apa yang terjadi di sembarang satu kehidupan tak bisa diprediksi. Ujung akhir sembarang kehidupan sudah pasti.
                Greene membawa kita memahami penciptaan awal alam semesta. Dia menelaah bagaimana kehidupan dan akal budi muncul dari kekacauan purba, dan bagaimana akal budi kita, dalam upaya memahami kegunaannya, mencari berbagai cara untuk memberi makna bagi pengalaman: dalam cerita, mitos, agama, ekspresi kreatif, sains, pencarian kebenaran, dan kerinduan kita akan yang kekal. Melalui serangkaian cerita yang menjelaskan berbagai lapis realitas yang saling berhubungan dari mekanika kuantum sampai kesadaran dan lubang hitam, Greene memberi kita gambaran lebih jernih tentang bagaimana kita terbentuk, di mana kita sekarang, dan ke mana kita menuju.',
                'stock' => '20',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Sains 1.jpg',
            ],
            [
                'judul' => 'Kosmos: Aneka Ragam Dunia',
                'penulis' => 'Ann Druyan',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2020,
                'deskripsi' => 'Cosmos: Possible Worlds adalah saga lanjutan petualangan besar yang diawali bersama oleh Carl Sagan dan Ann Druyan. Cosmos: A SpaceTime Odyssey Druyan yang meraih Emmy Award dan Peabody Award merupakan fenomena global, ditayangkan di 181 negara di seantero planet ini. Kini, dengan Possible Worlds, Druyan melanjutkan perjalanan menarik yang akan membawa Anda melintas 14 miliar evolusi kosmik dan berbagai rahasia alam. Inilah kisah-kisah penanya tanpa takut yang belum pernah disampaikan, yang pencariannya—bahkan kadang dengan biaya setinggi-tingginya—memberi kita gambaran alam semesta luas yang baru kita mulai kenali. Dalam buku memukau ini, Druyan membayangkan masa depan penuh inspirasi yang kita masih dapatkan di dunia ini—jika kita sadar pada waktunya untuk menggunakan sains dan teknologi canggih dengan kebijaksanaan. Siap-siap berlayar ke bintang-bintang!
                ',
                'stock' => '10',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Sains 2.jpg',
            ],
            [
                'judul' => 'Ekologi Umum',
                'penulis' => 'Prof. Amin Setyo Leksono, M.Si., Ph.D.',
                'penerbit' => 'Selaksa Media',
                'tahun_terbit' => 2023,
                'deskripsi' => 'Buku ini mengajak kita berkenalan secara mendalam dengan ilmu ekologi. Menurut penulis, ekologi merupakan ilmu yang mempelajari hubungan antara organisme dengan lingkungannya, baik lingkungan biotik maupun lingkungan abiotik. Interaksi tersebut dipelajari dalam berbagai tingkat organisasi biologi mulai dari populasi, komunitas, sampai ekosistem. Berbekal ilmu ini, kita akan sepenuhnya paham bahwa terdapat hubungan erat antara manusia, hewan, dan tumbuhan dalam lingkungan kehidupan di Bumi.
                Selain aspek teoretis seputar dasar-dasar ekologi dan ruang lingkup ekologi, melalui buku ini, penulis mengajak pembaca untuk bersama-sama mengurai permasalahan aktual seputar lingkungan. Contoh fenomena secara deskriptif dan analisis matematis sederhana pun penulis hadirkan demi menunjukkan upaya-upaya yang dapat ditempuh guna menyelesaikan permasalahan tersebut.
                ',
                'stock' => '5',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Sains 3.jpg',
            ],
            [
                'judul' => 'Buku Ensiklopedia Interaktif: Tubuh Manusia',
                'penulis' => 'Marcus Johnson',
                'penerbit' => 'Bhuana Ilmu Populer',
                'tahun_terbit' => 2023,
                'deskripsi' => 'Seri buku Ensiklopedia Interaktif: Tubuh Manusia memuat berbagai informasi mendalam mengenai tubuh manusia, seperti sistem dalam tubuh, jenis sel, struktur otak manusia, hingga berbagai penemuan penting di bidang kedokteran. Buku ini dilengkapi dengan ilustrasi penuh warna dan foto asli. Unduh aplikasi gratis di Google Play dan App Store (TapADot-HumanBody) di gawaimu, temukan video tersembunyi dari gambar, dan pelajari anatomi tubuh manusia dengan menyenangkan!  
                ',
                'stock' => '5',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Ensiklopedia 1.jpg',
            ],
            [
                'judul' => 'National Geographic Faunapedia Edisi Kedua',
                'penulis' => 'Lucy Spelman',
                'penerbit' => 'Kepustakaan Populer Gramedia',
                'tahun_terbit' => 2023,
                'deskripsi' => 'National Geographic Faunapedia adalah buku referensi tentang hewan yang diterbitkan oleh National Geographic. Buku ini berisi informasi tentang lebih dari 10.000 spesies hewan, termasuk mamalia, burung, reptil, amfibi, ikan, dan invertebrata. Informasi yang diberikan dalam buku ini meliputi nama ilmiah, nama umum, ukuran, berat, habitat, makanan, perilaku, dan distribusi hewan. Buku ini juga dilengkapi dengan foto-foto berwarna yang indah dari hewan-hewan tersebut.
                National Geographic Faunapedia adalah sumber yang berharga bagi siapa saja yang tertarik untuk belajar lebih banyak tentang hewan. Buku ini cocok untuk anak-anak, remaja, dan orang dewasa. Buku ini juga dapat digunakan sebagai sumber penelitian oleh siswa, peneliti, dan siapa saja yang tertarik untuk mempelajari lebih lanjut tentang hewan.',
                'stock' => '15',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Ensiklopedia 2.jpg',
            ],
            [
                'judul' => 'Mengenal Dinosaurus : Dari Zaman Kapur Sampai Masa Kepunahannya',
                'penulis' => 'Herman Adamson',
                'penerbit' => 'Anak Hebat Indonesia',
                'tahun_terbit' => 2024,
                'deskripsi' => 'Dinosaurus adalah kelompok hewan reptil yang hidup di Bumi selama zaman Mesozoikum, yang dibagi menjadi tiga periode utama: Trias, Jura, dan Kapur. Zaman Kapur merupakan periode terakhir dalam era Mesozoikum dan menjadi waktu di mana dinosaurus mencapai puncak keberagaman dan dominasi. Berikut adalah beberapa informasi umum tentang dinosaurus dari zaman Kapur sampai masa kepunahannya
                Dominasi Dinosaurus: Zaman Kapur dikenal sebagai puncak dominasi dinosaurus. Mereka mendominasi berbagai ekosistem di darat, laut, dan udara. Beragam Jenis Dinosaurus: Ada berbagai jenis dinosaurus, mulai dari yang kecil hingga yang besar, pemakan daging hingga pemakan tumbuhan. Dinosaurus Terkenal: Dinosaurus terkenal dari zaman Kapur meliputi Tyrannosaurus rex, Triceratops, Velociraptor, dan Brachiosaurus.',
                'stock' => '5',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Ensiklopedia 3.jpg',
            ],
            [
                'judul' => 'Matematika untuk SMA/SMK Kelas 11',
                'penulis' => 'Dicky Susanto',
                'penerbit' => 'Kemendikbud',
                'tahun_terbit' => 2022,
                'deskripsi' => 'Buku Matematika SMA/MA Kelas XI ini dirancang untuk memberikan siswa pengalaman belajar yang berharga di mana siswa terlibat aktif dari awal dengan bereksplorasi dan mengapresiasi matematika yang muncul dalam kehidupan dunia nyata. Buku ini disusun untuk memenuhi Capaian Pembelajaran Fase F untuk Kelas XI SMA/MA dan selaras dengan elemen dari Profil Pelajar Pancasila, serta merefleksikan pengembangan keterampilan abad ke-21.
                Topik pembahasan dalam buku ini mencakup komposisi fungsi dan fungsi invers, teorema-teorema tentang lingkaran, diagram pencar, model regresi linear, dan analisis korelasi. Selain pemahaman konsep matematika dan keterampilan memecahkan masalah, buku ini juga menekankan penalaran matematis serta kemampuan mengomunikasikan ide-ide matematika.
                ',
                'stock' => '20',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Pelajaran Umum 1.jpg',
            ],
            [
                'judul' => 'Buku Siswa Bahasa Indonesia SMA-/SMK Kelas 11',
                'penulis' => 'Yadi Mulyadi',
                'penerbit' => 'YRAMA WIDYA',
                'tahun_terbit' => 2021,
                'deskripsi' => 'Buku Bahasa Indonesia ini merupakan salah satu mata pelajaran umum yang dipelajari oleh semua siswa di SMA-MA atau SMK-MAK di kelas 11, Kompetensi dasar dalam Bahasa Indonesia ini dilandasi tiga aspek, yakni bahasa, sastra, dan literasi. Aspek berbahasa merupakan pengetahuan tentang bahasa Indonesia dan bagaimana penggunaannya yang efektif. Siswa dapat mengetahui fungsi bahasa Indonesia untuk dapat berinteraksi secara efektif; membangun dan membina hubungan; mengungkapkan dan mempertukarkan pengetahuan, keterampilan, sikap, perasaan, dan pendapat. Tentu saja komunikasi tersebut dapat efektif melalui teks yang koheren, kalimat yang tertata dengan baik, termasuk tata ejaan, tanda baca pada tingkat kata, kalimat, dan teks yang lebih luas.
                ',
                'stock' => '30',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Pelajaran Umum 2.jpg',
            ],
            [
                'judul' => 'Bahasa Inggris SMA/MA SMK/MAK Kelas 11',
                'penulis' => 'Mahrukh Bashir M.Ed.',
                'penerbit' => 'DIKNAS',
                'tahun_terbit' => 2021,
                'deskripsi' => 'Belajar bahasa Inggris untuk tingkat sekolah menengah atas hukumnya wajib, sebab pada beberapa tahun lalu pemerintah yang menangani masalah pendidikan di Indonesia telah mengambil bahasa Inggris sebagai mata pelajaran yang diujian nasionalkan pada tingkat SMA. SMA memiliki tiga kelas yaitu kelas 10, kelas 11 dan kelas 12 dan di semua tingkatan tersebut mempelajari bahasa Inggris. Bahasa Inggris untuk kelas 10, 11, dan 12 akan dipelajari materi yang berkaitan seperti reading texts, expressens, dan grammar. Grammar adalah materi yang sering ditemukan dalam pelajaran bahasa Inggris. Dalam bahasa Indonesia, grammar adalah tata bahasa. Bahasa tidak dapat berfungsi tanpa grammar.',
                'stock' => '25',
                'cover_buku' => 'http://127.0.0.1:8000/storage/cover_bukus/Pelajaran Umum 3.jpg',
            ],
        ];
        foreach ($booksData as $book) {
            Buku::create($book);
        }
    }
}
