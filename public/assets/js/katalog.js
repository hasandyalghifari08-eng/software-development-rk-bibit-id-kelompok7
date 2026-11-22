// Dipakai di index.html (data-limit) dan katalog.html (search + filter)
(async function () {
  const w = document.getElementById('daftar-produk'); if (!w) return;
  const limit = +w.dataset.limit || 0, cari = document.getElementById('cari'),
        kat = document.getElementById('kategori-chip'), info = document.getElementById('jumlah');
  let data = [], k = 'Semua', q = '';
  const kartu = p => { const h = p.stok < 1;
    return '<div class="col"><article class="card kartu h-100' + (h ? ' habis' : '') + '"><div class="foto"><span class="tag">' + esc(p.kategori) + '</span>' +
      (p.gambar ? '<img src="img/' + esc(p.gambar) + '" alt="' + esc(p.nama) + '" loading="lazy">' : '<span class="em">' + esc(p.emoji || EMO[p.kategori] || '🌱') + '</span>') +
      '</div><div class="card-body d-flex flex-column gap-1"><h3 class="h6 fw-bold mb-0">' + esc(p.nama) + '</h3><p class="small text-secondary mb-1">' + esc(p.ringkas) +
      '</p><div class="d-flex justify-content-between align-items-center mt-auto"><strong>' + rp(p.harga) + '</strong><span class="stok' + (h ? ' x' : '') + '">' + (h ? 'Stok habis' : 'Stok tersedia') +
      '</span></div><a class="btn ' + (h ? 'btn-off' : 'btn-primary') + ' mt-2" href="detail.html?id=' + encodeURIComponent(p.id) + '">Detail</a></div></article></div>'; };
  function tampil() {
    let d = data.filter(p => (k === 'Semua' || p.kategori === k) && (p.nama + ' ' + p.ringkas).toLowerCase().includes(q));
    if (limit) d = d.filter(p => p.stok > 0).slice(0, limit);
    if (info) info.innerHTML = 'Menampilkan <b>' + d.length + ' bibit</b>';
    w.innerHTML = d.length ? d.map(kartu).join('') : '<div class="col-12 text-center text-secondary py-5">Tidak ada bibit yang cocok. Coba kata kunci atau kategori lain.</div>';
  }
  try { data = await getProduk(); }
  catch (e) { w.innerHTML = '<div class="col-12 text-center text-secondary py-5">Gagal memuat data bibit. Muat ulang halaman. Kalau jalan lokal, buka lewat server (Live Server / XAMPP), bukan klik file langsung.</div>'; return; }
  const n = document.getElementById('stat-jenis'), c = document.getElementById('stat-kat');
  if (n) n.textContent = data.length;
  if (c) c.textContent = new Set(data.map(p => p.kategori)).size;
  if (kat) {
    kat.innerHTML = ['Semua', ...new Set(data.map(p => p.kategori))].map(x => '<button type="button" class="btn btn-sm rounded-pill chip ' + (x === 'Semua' ? 'btn-primary' : 'btn-outline-secondary') + '">' + esc(x) + '</button>').join('');
    kat.onclick = e => { if (!e.target.matches('.chip')) return; k = e.target.textContent;
      kat.querySelectorAll('.chip').forEach(b => { const on = b === e.target; b.classList.toggle('btn-primary', on); b.classList.toggle('btn-outline-secondary', !on); }); tampil(); };
  }
  if (cari) cari.oninput = () => { q = cari.value.trim().toLowerCase(); tampil(); };
  tampil();
})();
