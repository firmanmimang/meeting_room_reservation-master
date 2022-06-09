<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\Kemampuan;
use App\Models\Mahasiswa;
use App\Models\Pendidikan;
use App\Models\Pengalaman;
use Config\Database;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class CurriculumVitaeController extends BaseController
{
    protected $mahasiswaModel, $kemampuanModel, $pengalamanModel, $pendidikanModel, $db;

    public function __construct()
    {
        $this->mahasiswaModel = new Mahasiswa();
        $this->kemampuanModel = new Kemampuan();
        $this->pengalamanModel = new Pengalaman();
        $this->pendidikanModel = new Pendidikan();
        $this->db = Database::connect();
    }
    
    public function index()
    {
        $cvs = $this->mahasiswaModel->findAll();
        return view('backend/pages/cv/index', [
            'cvs' => $cvs
        ]);
    }

    public function create()
    {
        return view('backend/pages/cv/create', [
            'validation' => \Config\Services::validation()
        ]);
    }

    public function store()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Name cannot be empty'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email cannot be empty'
                ]
            ],
            'no_hp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor HP cannot be empty'
                ]
            ],
            'tempat_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat lahir cannot be empty',
                ]
            ],
            'tanggal_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal lahir cannot be empty',
                ]
            ],
            'agama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Agama cannot be empty',
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis kelamin cannot be empty',
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status cannot be empty',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat cannot be empty',
                ]
            ],

        ])) {
            $validation =  \Config\Services::validation();
            return redirect()->to('internal/cv/create')->withInput()->with('validation', $validation);
        }

        $data = $this->request->getVar();

        if($this->mahasiswaModel->insert($data)){
            $id_mahasiswa = $this->mahasiswaModel->insertID;
            $pendidikan = [];
            $kemampuan = [];
            $pengalaman = [];
            for($i = 0; $i < count($data['nama_pendidikan']); $i++){
                if($data['nama_pendidikan'][$i]) {
                    $pendidikan[] = array(
                        'id_mahasiswa' => $id_mahasiswa,
                        'tipe_pendidikan' => $data['tipe_pendidikan'][$i],
                        'nama_pendidikan' => $data['nama_pendidikan'][$i],
                        'tempat_pendidikan' => $data['tempat_pendidikan'][$i],
                        'waktu_pendidikan' => $data['waktu_pendidikan'][$i],
                    );
                }
            }
            for($i = 0; $i < count($data['pengalaman']); $i++){
                if($data['pengalaman'][$i]){
    
                    $pengalaman[] = array(
                        'id_mahasiswa' => $id_mahasiswa,
                        'pengalaman' => $data['pengalaman'][$i],
                    );
                }
            }
            for($i = 0; $i < count($data['kategori_kemampuan']); $i++){
                if($data['kategori_kemampuan'][$i]){
    
                    $kemampuan[] = array(
                        'id_mahasiswa' => $id_mahasiswa,
                        'kategori_kemampuan' => $data['kategori_kemampuan'][$i],
                        'sub_kategori_kemampuan' => $data['sub_kategori_kemampuan'][$i],
                    );
                }
            }
            count($pengalaman)>0 ? $this->pengalamanModel->insertBatch($pengalaman) : null;
            count($kemampuan)>0 ? $this->kemampuanModel->insertBatch($kemampuan) : null;
            count($pendidikan)>0 ? $this->pendidikanModel->insertBatch($pendidikan) : null;
        }


        return redirect()->to('internal/cv')->with('success', 'Data Added Successfully');
    }

    public function edit($id)
    {
        return view('backend/pages/cv/edit', [
            'cv' => $this->mahasiswaModel->find($id),
            'pengalaman' => $this->db->table('pengalaman')->select('*')->where('id_mahasiswa', $id)->get()->getResultArray(),
            'pendidikan' => $this->db->table('pendidikan')->select('*')->where('id_mahasiswa', $id)->get()->getResultArray(),
            'kemampuan' => $this->db->table('kemampuan')->select('*')->where('id_mahasiswa', $id)->get()->getResultArray(),
            'validation' => \Config\Services::validation()
        ]);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Name cannot be empty'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email cannot be empty'
                ]
            ],
            'no_hp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor HP cannot be empty'
                ]
            ],
            'tempat_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat lahir cannot be empty',
                ]
            ],
            'tanggal_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal lahir cannot be empty',
                ]
            ],
            'agama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Agama cannot be empty',
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis kelamin cannot be empty',
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status cannot be empty',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat cannot be empty',
                ]
            ],

        ])) {
            $validation =  \Config\Services::validation();
            return redirect()->to('internal/cv/edit/'+$id+'')->withInput()->with('validation', $validation);
        }

        $data = $this->request->getVar();

        if($this->mahasiswaModel->update($id, $data)){
            $pendidikan = [];
            $kemampuan = [];
            $pengalaman = [];
            for($i = 0; $i < count($data['nama_pendidikan']); $i++){
                if($data['nama_pendidikan'][$i]) {
                    if(isset($data['id_pendidikan'][$i])) { 
                        $this->pendidikanModel->update($data['id_pendidikan'][$i], array(
                            'id_mahasiswa' => $id,
                            'tipe_pendidikan' => $data['tipe_pendidikan'][$i],
                            'nama_pendidikan' => $data['nama_pendidikan'][$i],
                            'tempat_pendidikan' => $data['tempat_pendidikan'][$i],
                            'waktu_pendidikan' => $data['waktu_pendidikan'][$i],
                        ));
                    } else {
                        $pendidikan[] = array(
                            'id_mahasiswa' => $id,
                            'tipe_pendidikan' => $data['tipe_pendidikan'][$i],
                            'nama_pendidikan' => $data['nama_pendidikan'][$i],
                            'tempat_pendidikan' => $data['tempat_pendidikan'][$i],
                            'waktu_pendidikan' => $data['waktu_pendidikan'][$i],
                        );
                    }
                }
            }
            for($i = 0; $i < count($data['pengalaman']); $i++){
                if($data['pengalaman'][$i]){
                    if(isset($data['id_pengalaman'][$i])) { 
                        $this->pengalamanModel->update($data['id_pengalaman'][$i], array(
                            'id_mahasiswa' => $id,
                            'pengalaman' => $data['pengalaman'][$i],
                        ));
                    } else {
                        $pengalaman[] = array(
                            'id_mahasiswa' => $id,
                            'pengalaman' => $data['pengalaman'][$i],
                        );
                    }
                }
            }
            for($i = 0; $i < count($data['kategori_kemampuan']); $i++){
                if($data['kategori_kemampuan'][$i]){
                    if(isset($data['id_kemampuan'][$i])) { 
                        $this->kemampuanModel->update($data['id_kemampuan'][$i], array(
                            'id_mahasiswa' => $id,
                            'kategori_kemampuan' => $data['kategori_kemampuan'][$i],
                            'sub_kategori_kemampuan' => $data['sub_kategori_kemampuan'][$i],
                        ));
                    } else {
                        $kemampuan[] = array(
                            'id_mahasiswa' => $id,
                            'kategori_kemampuan' => $data['kategori_kemampuan'][$i],
                            'sub_kategori_kemampuan' => $data['sub_kategori_kemampuan'][$i],
                        );
                    }
                }
            }
            count($pengalaman)>0 ? $this->pengalamanModel->insertBatch($pengalaman) : null;
            count($kemampuan)>0 ? $this->kemampuanModel->insertBatch($kemampuan) : null;
            count($pendidikan)>0 ? $this->pendidikanModel->insertBatch($pendidikan) : null;
        }

        return redirect()->to('internal/cv')->with('success', 'Data Update Successfully');
    }

    public function delete($id)
    {
        $pengalaman = $this->db->table('pengalaman')->select('*')->where('id_mahasiswa', $id)->get()->getResultArray();
        $kemampuan = $this->db->table('kemampuan')->select('*')->where('id_mahasiswa', $id)->get()->getResultArray();
        $pendidikan = $this->db->table('pendidikan')->select('*')->where('id_mahasiswa', $id)->get()->getResultArray();

        $this->mahasiswaModel->delete($id);

        foreach($pengalaman as $p){
            $this->pengalamanModel->delete(['id_pengalaman' => $p['id_pengalaman']]);
        }
        foreach($pendidikan as $pd){
            $this->pendidikanModel->delete(['id_pendidikan' => $pd['id_pendidikan']]);
        }
        foreach($kemampuan as $k){
            $this->kemampuanModel->delete(['id_kemampuan' => $k['id_kemampuan']]);
        }
        
        return redirect()->back()->with('success', 'CV Deleted Successfully');
    }

    public function exportPdfAll()
    {
        // $all_mahasiswa = $this->db->query("SELECT mahasiswa.id_mahasiswa, nama, tempat_lahir, tanggal_lahir, agama, jenis_kelamin, alamat, no_hp, status, email, phase_1.id_pendidikan, phase_1.tipe_pendidikan, phase_1.tempat_pendidikan, phase_1.waktu_pendidikan, phase_1.nama_pendidikan, GROUP_CONCAT(phase_1.id_pengalaman SEPARATOR '[,]') as id_pengalaman, GROUP_CONCAT(phase_1.pengalaman SEPARATOR '[,]') as pengalaman, phase_1.id_kemampuan, phase_1.kategori_kemampuan, phase_1.sub_kategori_kemampuan from mahasiswa left join ( select id_pengalaman, pengalaman.pengalaman, pengalaman.id_mahasiswa, phase_2.kategori_kemampuan, phase_2.sub_kategori_kemampuan, phase_2.id_kemampuan, GROUP_CONCAT(phase_2.tipe_pendidikan SEPARATOR '[,]') as tipe_pendidikan, GROUP_CONCAT(phase_2.id_pendidikan SEPARATOR '[,]') as id_pendidikan, GROUP_CONCAT(phase_2.waktu_pendidikan SEPARATOR '[,]') as waktu_pendidikan, GROUP_CONCAT(phase_2.tempat_pendidikan SEPARATOR '[,]') as tempat_pendidikan, GROUP_CONCAT(phase_2.nama_pendidikan SEPARATOR '[,]') as nama_pendidikan from pengalaman LEFT join ( select id_pendidikan, pendidikan.id_mahasiswa as id_mahasiswa, pendidikan.tipe_pendidikan, pendidikan.nama_pendidikan, pendidikan.waktu_pendidikan, pendidikan.tempat_pendidikan, GROUP_CONCAT(kemampuan.kategori_kemampuan SEPARATOR '[,]' ) as kategori_kemampuan, GROUP_CONCAT( kemampuan.sub_kategori_kemampuan SEPARATOR '[,]' ) as sub_kategori_kemampuan, GROUP_CONCAT(kemampuan.id_kemampuan SEPARATOR '[,]') as id_kemampuan from pendidikan left JOIN kemampuan on pendidikan.id_mahasiswa = kemampuan.id_mahasiswa GROUP BY id_pendidikan ) as phase_2 on pengalaman.id_mahasiswa = phase_2.id_mahasiswa GROUP BY id_pengalaman ) as phase_1 on mahasiswa.id_mahasiswa = phase_1.id_mahasiswa GROUP BY id_mahasiswa")->getResult();
        
        $all_mahasiswa = $this->db->table('mahasiswa')->select('*')->get()->getResult();
        foreach($all_mahasiswa as $i => $mahasiswa){
            $all_mahasiswa[$i]->pengalaman = $this->db->table('pengalaman')->select('*')->where('id_mahasiswa', $mahasiswa->id_mahasiswa)->get()->getResult();
            $all_mahasiswa[$i]->pendidikan = $this->db->table('pendidikan')->select('*')->where('id_mahasiswa', $mahasiswa->id_mahasiswa)->get()->getResult();
            $all_mahasiswa[$i]->kemampuan = $this->db->table('kemampuan')->select('*')->where('id_mahasiswa', $mahasiswa->id_mahasiswa)->get()->getResult();
        }
        
        // var_dump($all_mahasiswa);die;
        $data = [
            'all_mahasiswa' => $all_mahasiswa,
        ];
        $filename = "Data Mahasiswa";

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('pdf/pdfAllCv', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        return $dompdf->stream($filename);
    }

    public function exportExcelAll()
    {
        // $all_mahasiswa = $this->db->query("
        //     SELECT 
        //         mahasiswa.id_mahasiswa, 
        //         nama, 
        //         tempat_lahir, 
        //         tanggal_lahir, 
        //         agama, 
        //         jenis_kelamin, 
        //         alamat, 
        //         no_hp, 
        //         status, 
        //         email, 
        //         phase_1.id_pendidikan, 
        //         phase_1.tipe_pendidikan, 
        //         phase_1.tempat_pendidikan, 
        //         phase_1.waktu_pendidikan, 
        //         phase_1.nama_pendidikan, 
        //         GROUP_CONCAT(phase_1.id_pengalaman SEPARATOR '[,]') as id_pengalaman, 
        //         GROUP_CONCAT(phase_1.pengalaman SEPARATOR '[,]') as pengalaman, 
        //         phase_1.id_kemampuan, 
        //         phase_1.kategori_kemampuan, 
        //         phase_1.sub_kategori_kemampuan 
        //     from mahasiswa left join ( 
        //         select 
        //             id_pengalaman, 
        //             pengalaman.pengalaman, 
        //             pengalaman.id_mahasiswa, 
        //             phase_2.kategori_kemampuan, 
        //             phase_2.sub_kategori_kemampuan, 
        //             phase_2.id_kemampuan, 
        //             GROUP_CONCAT(phase_2.tipe_pendidikan SEPARATOR '[,]') as tipe_pendidikan, 
        //             GROUP_CONCAT(phase_2.id_pendidikan SEPARATOR '[,]') as id_pendidikan, 
        //             GROUP_CONCAT(phase_2.waktu_pendidikan SEPARATOR '[,]') as waktu_pendidikan, 
        //             GROUP_CONCAT(phase_2.tempat_pendidikan SEPARATOR '[,]') as tempat_pendidikan, 
        //             GROUP_CONCAT(phase_2.nama_pendidikan SEPARATOR '[,]') as nama_pendidikan 
        //         from pengalaman LEFT join ( 
        //             select id_pendidikan, 
        //                 pendidikan.id_mahasiswa as id_mahasiswa, 
        //                 pendidikan.tipe_pendidikan, 
        //                 pendidikan.nama_pendidikan, 
        //                 pendidikan.waktu_pendidikan, 
        //                 pendidikan.tempat_pendidikan, 
        //                 GROUP_CONCAT(kemampuan.kategori_kemampuan SEPARATOR '[,]' ) as kategori_kemampuan, 
        //                 GROUP_CONCAT( kemampuan.sub_kategori_kemampuan SEPARATOR '[,]' ) as sub_kategori_kemampuan, 
        //                 GROUP_CONCAT(kemampuan.id_kemampuan SEPARATOR '[,]') as id_kemampuan 
        //             from pendidikan left JOIN 
        //             kemampuan on pendidikan.id_mahasiswa = kemampuan.id_mahasiswa GROUP BY id_pendidikan 
        //         ) as phase_2 on pengalaman.id_mahasiswa = phase_2.id_mahasiswa GROUP BY id_pengalaman 
        //     ) as phase_1 on mahasiswa.id_mahasiswa = phase_1.id_mahasiswa GROUP BY id_mahasiswa"
        // )->getResult();

        $all_mahasiswa = $this->db->table('mahasiswa')->select('*')->get()->getResult();
        foreach($all_mahasiswa as $i => $mahasiswa){
            $all_mahasiswa[$i]->pengalaman = $this->db->table('pengalaman')->select('*')->where('id_mahasiswa', $mahasiswa->id_mahasiswa)->get()->getResult();
            $all_mahasiswa[$i]->pendidikan = $this->db->table('pendidikan')->select('*')->where('id_mahasiswa', $mahasiswa->id_mahasiswa)->get()->getResult();
            $all_mahasiswa[$i]->kemampuan = $this->db->table('kemampuan')->select('*')->where('id_mahasiswa', $mahasiswa->id_mahasiswa)->get()->getResult();
        }
        
        $filename = "CV " . $mahasiswa->nama;

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nama')
                    ->setCellValue('C1', 'Tempat, tanggal lahir')
                    ->setCellValue('D1', 'Agama')
                    ->setCellValue('E1', 'Jenis Kelamin')
                    ->setCellValue('F1', 'Status')
                    ->setCellValue('G1', 'Email')
                    ->setCellValue('H1', 'No Handphone')
                    ->setCellValue('I1', 'Pendidikan')
                    ->setCellValue('J1', 'Pengalaman')
                    ->setCellValue('K1', 'Kemampuan');
        
        $column = 2;
        // tulis data ke cell
        
        foreach($all_mahasiswa as $mahasiswa) {
            $pengalamanHTML = "";
            $pendidikanHTML = "";
            $kemampuanHTML = "";

            for($i = 0; $i < count($mahasiswa->pendidikan); $i++) {
                if($mahasiswa->pendidikan[$i]) {
                    $pendidikanHTML .= "-> ".$mahasiswa->pendidikan[$i]->tipe_pendidikan."-".$mahasiswa->pendidikan[$i]->nama_pendidikan."-".$mahasiswa->pendidikan[$i]->tempat_pendidikan."-".$mahasiswa->pendidikan[$i]->waktu_pendidikan."\n";
                }
            }
            for($i = 0; $i < count($mahasiswa->pengalaman); $i++) {
                if($mahasiswa->pengalaman[$i]){
                    $pengalamanHTML .= "-> ".$mahasiswa->pengalaman[$i]->pengalaman."\n";
                }
            }
            for($i = 0; $i < count($mahasiswa->kemampuan); $i++) {
                if($mahasiswa->kemampuan[$i]){
                    $kemampuanHTML .= "-> ".$mahasiswa->kemampuan[$i]->kategori_kemampuan."-".$mahasiswa->kemampuan[$i]->sub_kategori_kemampuan."\n";
                }
            }
            $pendidikanHTML .= "";
            $pengalamanHTML .= "";
            $kemampuanHTML .= "";

            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $column - 1)
                        ->setCellValue('B' . $column, $mahasiswa->nama)
                        ->setCellValue('C' . $column, $mahasiswa->tempat_lahir . ", " . $mahasiswa->tanggal_lahir )
                        ->setCellValue('D' . $column, $mahasiswa->agama)
                        ->setCellValue('E' . $column, $mahasiswa->jenis_kelamin)
                        ->setCellValue('F' . $column, $mahasiswa->status)
                        ->setCellValue('G' . $column, $mahasiswa->email)
                        ->setCellValue('H' . $column, $mahasiswa->no_hp)
                        ->setCellValue('I' . $column, $pendidikanHTML)
                        ->setCellValue('J' . $column, $pengalamanHTML)
                        ->setCellValue('K' . $column, $kemampuanHTML);
            
            $spreadsheet->getActiveSheet()->getStyle('I'.$column)->getAlignment()->setWrapText(true);
            $spreadsheet->getActiveSheet()->getStyle('J'.$column)->getAlignment()->setWrapText(true);
            $spreadsheet->getActiveSheet()->getStyle('K'.$column)->getAlignment()->setWrapText(true);
            $column++;
        }

        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(40);

        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Mahasiswa';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        die;
    }

    public function exportPdf($id)
    {
        $mahasiswa = $this->db->table('mahasiswa')->select('*')->where('id_mahasiswa', $id)->get()->getFirstRow();
        $pengalaman = $this->db->table('pengalaman')->select('*')->where('id_mahasiswa', $id)->get()->getResult();
        $pendidikan_formal = $this->db->table('pendidikan')->select('*')->where('id_mahasiswa', $id)->where('tipe_pendidikan', 'formal')->get()->getResult();
        $pendidikan_non_formal = $this->db->table('pendidikan')->select('*')->where('id_mahasiswa', $id)->where('tipe_pendidikan', 'non-formal')->get()->getResult();
        $kemampuan = $this->db->table('kemampuan')->select('*')->where('id_mahasiswa', $id)->get()->getResult();
        
        $filename = "CV " . $mahasiswa->nama;

        $data = [
            'mahasiswa' => $mahasiswa,
            'tentang_saya' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. In harum natus animi error. Voluptatem aperiam accusantium eveniet, quibusdam vel tempora placeat sit omnis saepe sapiente ab? Voluptate nobis inventore adipisci!",
            'pengalaman' => (count($pengalaman)>0) ? array_chunk($pengalaman, ceil(count($pengalaman)/2)): null,
            'pendidikan_formal' => $pendidikan_formal,
            'pendidikan_non_formal' => $pendidikan_non_formal,
            'kemampuan' => $kemampuan,
        ];

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $view = view('pdf/pdfCv', $data);
        // load HTML content
        $dompdf->loadHtml($view);

        // (optional) setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        return $dompdf->stream($filename);
    }
}
