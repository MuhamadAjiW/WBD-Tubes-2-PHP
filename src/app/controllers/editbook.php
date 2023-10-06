<?php

namespace app\controllers;

use app\core\Controller;

class EditBook extends Controller{
    public function index(){
        if (isset($_GET['book_id'])) {
            $bookmodel = $this->model("BookModel");

            $bookdata = $bookmodel->fetchBookByID($_GET['book_id']);
        }

        $this->view('EditBook', ['bookdata' => $bookdata]);
    }

    public function edit() {
        /* Oke jadi disini paling tinggal ngeproses data yang dikirim dari editbook.js aja
        nah jadi ntar cek dulu dia ada update image atau audio nya ga kalau ga ada ya berarti
        ga usah di update image sama audionya pake isset($_FILES) buat cek ada data audio atau image
        yang dikirim atau ga
        
        Terus kalau misal ada image atau audio yang dikirim berarti ada image atau audio baru buat bukunya
        itu berarti delete dlu image atau audio di storage baru tambahin yang baru deletenya bisa pake unlink
        kalau addnya bisa pake move_uploaded_file 
        
        Sebenarnya ini mirip sama addbook si jadi paling liat liat addbook aja sama ini deletenya ntah kenapa
        gw masih blm bisa jadi maaf teman-teman merepotkan */
    }
}

?>