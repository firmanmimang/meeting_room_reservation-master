<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
<style>
  body{ 
    font-family: sans-serif !important;
  }
  table.table-detail,.table-detail th,.table-detail td {
    border: 1px solid black;
    border-collapse: collapse;
    padding: 5px;
  }
  table.table-top,.table-top th,.table-top td {
    padding-right: 10px;
    padding-left: 0;
  }
  .table-top {
    padding-top: 10px;
    padding-bottom: 3px;
  }
  ol {
    padding: 0 0 0 25px;
  }
</style>
  <h2> Data Mahasiswa</h2>
    <?php foreach($all_mahasiswa as $mahasiswa):?>
        <?php 

          $pengalamanHTML = "<ol>";
          $pendidikanHTML = "<ol>";
          $kemampuanHTML = "<ol>";

          for($i = 0; $i < count($mahasiswa->pendidikan); $i++) {
            if($mahasiswa->pendidikan[$i]){
              $pendidikanHTML .= "<li>".$mahasiswa->pendidikan[$i]->tipe_pendidikan."-".$mahasiswa->pendidikan[$i]->nama_pendidikan."-".$mahasiswa->pendidikan[$i]->tempat_pendidikan."-".$mahasiswa->pendidikan[$i]->waktu_pendidikan."</li>";
            }
          }

          for($i = 0; $i < count($mahasiswa->pengalaman); $i++) {
            if($mahasiswa->pengalaman[$i]){
              $pengalamanHTML .= "<li>".$mahasiswa->pengalaman[$i]->pengalaman."</li>";
            }
          }

          for($i = 0; $i < count($mahasiswa->kemampuan); $i++) {
              if($mahasiswa->kemampuan[$i]){
                $kemampuanHTML .= "<li>".$mahasiswa->kemampuan[$i]->kategori_kemampuan."-".$mahasiswa->kemampuan[$i]->sub_kategori_kemampuan."</li>";
              }
          }
          
          $pendidikanHTML .= "</ol>";
          $pengalamanHTML .= "</ol>";
          $kemampuanHTML .= "</ol>";
        ?>
        <table class="table-top">
          <tr>
            <td><b>Nama Mahasiswa</b> : <?= $mahasiswa->nama?></td>
            <td><b>Kontak Email</b> : <?= $mahasiswa->email?></td>
            <td><b>Kontak No Handphone</b> : <?= $mahasiswa->no_hp?></td>
          </tr>  
        </table>
        <b style="padding-left: 2px; padding-bottom:4px; display:block;">Detail:</b>
        <table width="100%" cellspacing="0" class="table-detail">
          <thead>
              <tr>
                  <th>Tempat, tanggal lahir</th>
                  <th>Agama</th>
                  <th>Jenis Kelamin</th>
                  <th>Status</th>
                  <th>Pendidikan</th>
                  <th>Pengalaman</th>
                  <th>Kemampuan</th>
              </tr>
          </thead>
          <tbody>
          <tr>
              <td><?= $mahasiswa->tempat_lahir.",".$mahasiswa->tanggal_lahir ?></td>
              <td><?= $mahasiswa->agama ?></td>
              <td><?= $mahasiswa->jenis_kelamin ?></td>
              <td><?= $mahasiswa->status ?></td>
              <td><?= $pendidikanHTML ?></td>
              <td><?= $pengalamanHTML ?></td>
              <td><?= $kemampuanHTML ?></td>
          </tr>
        </tbody>
      </table>
        <hr/>
        <?php //$no++; ?>
    <?php endforeach;?>
</body>
</html>