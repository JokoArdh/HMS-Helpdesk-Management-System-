@extends('layouts.home')
@section('content')

    <div class="card">
        <div class="card-title p-3">
            <h4>Isi Data Formulir Permintaan Barang</h4>
        </div>
              
            <div class="w-75 me-auto ">
              <!-- Multi Columns Form -->
              <form action="{{ route('user.transaksi-out.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label>Kode Barang</label>
                    <select id="kode_barang" class="form-control" readonly disabled>
                        <option value="">-- Pilih Kode --</option>
                    </select>
                    <span class="text-muted" style="font-size: 11px">**kode otomatis</span>
                </div>

                 <div class="col-md-6">
                  <label for="nama" class="form-label">Nama Barang</label>
                  <input type="text" id="nama_barang" class="form-control" required>
                  <div><span class="text-muted" style="font-size: 11px">**ketik nama barang lalu enter, kode otomatis</span></div>
                </div> 
                
                <input type="hidden" name="barang_id" id="barang_id">
                <input type="hidden" name="jenis_transaksi" value="keluar"> 

                <div class="col-md-6">
                  <label for="qty" class="form-label">Jumlah</label>
                  <input type="text" class="form-control" name="jumlah" required>
                </div>
                <div class="col-md-4">
                  <label for="tgl" class="form-label">Tanggal</label>
                  <input type="date" name="tgl_transaksi" class="form-control" required>
                </div>
                <div class="col-12">
                    <label for="ket" class="form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan" style="height: 100px;" required></textarea>
                </div>
                <div class="text-center mb-3 mt-4">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="reset" class="btn btn-secondary">Batal</button>
                </div>
              </form><!-- End Multi Columns Form -->
            </div>
     
    </div>

 <script>
$(document).ready(function() {

    $("#nama_barang").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('user.barang.auto') }}",
                dataType: "json",
                data: { term: request.term },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 1, // mulai auto-complete setelah 1 karakter
        select: function(event, ui) {
            // set nilai input
            $("#nama_barang").val(ui.item.value);
            $("#kode_barang").val(ui.item.kode);
            $("#barang_id").val(ui.item.id);
            return false;
        }
    });
});
</script> 


 
<script>
const namaInput = document.getElementById('nama_barang');
const kodeSelect = document.getElementById('kode_barang');
const barangIdInput = document.getElementById('barang_id');

namaInput.addEventListener('change', function () {
    let nama = this.value.trim();

    fetch(`/user/riwayat-permintaan/by-nama/${nama}`)
        .then(res => res.json())
        .then(data => {
            kodeSelect.innerHTML = '<option value="">-- Pilih Kode --</option>';
            barangIdInput.value = '';

            if (data.length === 1) {
                // ✅ AUTO PILIH
                kodeSelect.innerHTML += `
                    <option value="${data[0].id}" selected>
                        ${data[0].kode_barang}
                    </option>`;
                kodeSelect.disabled = true;
                barangIdInput.value = data[0].id;

            } else if (data.length > 1) {
                // 👀 PILIH MANUAL
                data.forEach(item => {
                    kodeSelect.innerHTML += `
                        <option value="${item.id}">
                            ${item.kode_barang}
                        </option>`;
                });
                kodeSelect.disabled = false;

            } else {
                alert('Barang tidak ditemukan');
                kodeSelect.disabled = true;
            }
        });
});

kodeSelect.addEventListener('change', function () {
    barangIdInput.value = this.value;
});
</script>

@endsection