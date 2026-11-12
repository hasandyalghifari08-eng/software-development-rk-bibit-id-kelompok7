// Halaman admin: isi tabel, form ubah, dan info toko dari data
(async function () {
  const isi = o => Object.keys(o).forEach(k => { const e = document.getElementById(k); if (e && e.type !== 'file') e.value = o[k] ?? ''; });
  const tb = document.getElementById('tbody-bibit'), fb = document.getElementById('form-bibit'), ft = document.getElementById('form-toko');
  if (tb) {
    try {
      const d = await getProduk(), ada = d.filter(p => p.stok > 0).length;
      document.getElementById('stat-total').textContent = d.length;
      document.getElementById('stat-ada').textContent = ada;
      document.getElementById('stat-habis').textContent = d.length - ada;
      tb.innerHTML = d.map(p => '<tr><td><b>' + esc(p.nama) + '</b></td><td>' + esc(p.kategori) + '</td><td>' + rp(p.harga) + '</td><td>' + p.stok +
        '</td><td><span class="stok' + (p.stok < 1 ? ' x' : '') + '">' + (p.stok < 1 ? 'Habis' : 'Tersedia') + '</span></td><td class="aksi">' +
        '<a class="btn btn-soft btn-sm" href="admin-form.php?id=' + encodeURIComponent(p.id) + '">Ubah</a> ' +
        '<form method="post" action="proses-hapus.php" style="display:inline" data-nama="' + esc(p.nama) + '"><input type="hidden" name="id" value="' + esc(p.id) + '">' +
        '<button class="btn btn-del btn-sm" type="submit">Hapus</button></form></td></tr>').join('') ||
        '<tr><td colspan="6">Belum ada bibit. Klik “+ Tambah Bibit” untuk mulai.</td></tr>';
      tb.addEventListener('submit', e => { if (!confirm('Hapus ' + e.target.dataset.nama + '?')) e.preventDefault(); });
    } catch (e) { tb.innerHTML = '<tr><td colspan="6">Gagal memuat data. Muat ulang halaman.</td></tr>'; }
  }
  if (fb) {
    const id = new URLSearchParams(location.search).get('id'), f = document.getElementById('gambar');
    if (id) try {
      const p = await getDetail(id);
      if (p) { isi(p); document.getElementById('id').value = p.id; document.getElementById('judul-form').textContent = 'Ubah Bibit'; document.title = 'Ubah Bibit — Admin RK Bibit ID'; }
    } catch (e) {}
    f.addEventListener('change', () => { if (f.files[0] && f.files[0].size > 200 * 1024) { alert('Ukuran gambar maksimal 200 KB.'); f.value = ''; } });
  }
  if (ft) try { isi(await getToko()); } catch (e) {}
})();