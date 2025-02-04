<?php
// pages/daftar.php
?>
<h1>Buat Laporan</h1>
<p>Isi form berikut untuk melaporkan permasalahan. Segala informasi pribadi seperti nama, NIM, dan kelas akan dirahasiakan.</p>

<form action="index.php?page=addlpr" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="nama">Nama</label>
    <input 
      type="text" 
      name="nama" 
      class="form-control" 
      placeholder="Masukkan nama lengkap Anda" 
      title="Masukkan nama lengkap Anda" 
      required>
    <small class="form-text text-muted">Contoh: Rania Permata Sari.</small>
  </div>

  <div class="form-group">
    <label>NIM</label>
    <input 
      type="text" 
      name="nim" 
      class="form-control" 
      placeholder="Masukkan NIM Anda" 
      title="Masukkan Nomor Induk Mahasiswa (NIM) Anda" 
      required>
    <small class="form-text text-muted">Contoh: 123456789.</small>
  </div>

  <div class="form-group">
    <label>Kelas</label>
    <input 
      type="text" 
      name="kelas" 
      class="form-control" 
      placeholder="Masukkan kelas Anda" 
      title="Masukkan kelas Anda, misalnya A, B, atau C" 
      required>
    <small class="form-text text-muted">Contoh: A atau B.</small>
  </div>

  <div class="form-group">
    <label>Semester</label>
    <input 
      type="number" 
      name="semester" 
      class="form-control" 
      placeholder="Masukkan semester Anda" 
      title="Masukkan semester Anda dalam angka, misalnya 1 atau 2" 
      min="1" 
      max="8" 
      required>
    <small class="form-text text-muted">Contoh: 5.</small>
  </div>

  <div class="form-group">
    <label>Nomor HP</label>
    <input 
      type="tel" 
      name="nomorHp" 
      class="form-control" 
      placeholder="Masukkan nomor HP Anda" 
      title="Masukkan nomor HP Anda tanpa spasi atau karakter lain" 
      pattern="[0-9]{10,15}" 
      required>
    <small class="form-text text-muted">Contoh: 081234567890.</small>
  </div>

  <div class="form-group">
    <label>Jenis Laporan</label>
    <select 
      name="jenisLaporan" 
      class="form-control" 
      title="Pilih jenis laporan yang sesuai dengan masalah Anda" 
      required>
      <option value="">Pilih Jenis</option>
      <option value="Masalah KRS">Masalah KRS</option>
      <option value="Masalah SIA">Masalah SIA</option>
      <option value="Masalah Lainnya">Masalah Lainnya</option>
    </select>
    <small class="form-text text-muted">Pilih salah satu jenis laporan yang sesuai.</small>
  </div>

  <div class="form-group">
    <label>Deskripsi</label>
    <textarea 
      name="deskripsi" 
      class="form-control" 
      rows="3" 
      placeholder="Deskripsikan permasalahan Anda secara jelas" 
      title="Jelaskan permasalahan Anda dengan detail" 
      required></textarea>
    <small class="form-text text-muted">Berikan deskripsi lengkap dari permasalahan Anda.</small>
  </div>

  <div class="form-group">
    <label>Upload Berkas Pendukung</label>
    <input 
      type="file" 
      name="berkas" 
      class="form-control-file" 
      accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
      title="Unggah berkas pendukung seperti KRS, KHS, atau bukti pembayaran">
    <small class="form-text text-muted">Contoh: KRS, KHS, atau bukti pembayaran.</small>
  </div>

  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  <a href="index.php?page=home" class="btn btn-secondary">Kembali</a>
</form>
