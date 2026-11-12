// detail.html?id=1
(async function () {
  const root = document.getElementById('detail'); if (!root) return;
  const salah = m => { root.className = 'text-center py-5'; root.innerHTML = '<h2 class="h4 mb-3">' + m + '</h2><a class="btn btn-primary" href="katalog.html">Kembali ke katalog</a>'; };
  const id = new URLSearchParams(location.search).get('id');
  let p, t;
  try { [p, t] = await Promise.all([getDetail(id), getToko()]); }
  catch (e) { return salah(e.message === 'Bibit tidak ditemukan' ? 'Bibit tidak ditemukan' : 'Gagal memuat data bibit'); }
  document.title = p.nama + ' — RK Bibit ID';
  const h = p.stok < 1, ext = ' target="_blank" rel="noopener"', v = x => esc(x || '-');
  const tombol = h
    ? '<span class="btn btn-lg btn-off disabled" aria-disabled="true">Stok habis</span><a class="btn btn-soft"' + ext + ' href="' + linkWa(t.wa, 'Halo, kapan ' + p.nama + ' tersedia lagi?') + '">Tanya kapan tersedia lagi</a>'
    : '<a class="btn btn-lg btn-primary"' + ext + ' href="' + linkWa(t.wa, 'Halo, saya mau pesan ' + p.nama) + '">Pesan lewat WhatsApp</a>' +
      '<a class="btn btn-lg btn-shopee"' + ext + ' href="' + esc(t.shopee) + '">Pesan lewat Shopee</a>' +
      '<a class="btn btn-lg btn-dark"' + ext + ' href="' + esc(t.tiktok) + '">Pesan lewat TikTok Shop</a>';
  root.innerHTML = '<div class="col-md-6"><div class="foto besar">' + (p.gambar ? '<img src="img/' + esc(p.gambar) + '" alt="' + esc(p.nama) + '">' : '<span class="em">' + esc(p.emoji || EMO[p.kategori] || '🌱') + '</span>') + '</div></div>' +
    '<div class="col-md-6"><small>' + esc(p.kategori) + '</small><h1 class="display-6 fw-bold">' + esc(p.nama) + '</h1><p class="small text-secondary mb-0">' + esc(p.ringkas) + '</p>' +
    '<div class="harga">' + rp(p.harga) + ' <span>/ bibit</span></div>' +
    '<dl class="rinci"><div><dt>Stok</dt><dd>' + (h ? 'Habis' : p.stok + ' bibit') + '</dd></div><div><dt>Tinggi bibit</dt><dd>' + v(p.tinggi) + '</dd></div><div><dt>Kategori</dt><dd>' + esc(p.kategori) + '</dd></div></dl>' +
    '<p class="catatan">Pemesanan, pembayaran, dan pengiriman dilakukan di platform yang kamu pilih. Tidak ada transaksi di website ini.</p>' +
    '<div class="d-grid gap-2">' + tombol + '</div></div>';
  const r = document.getElementById('rawat'); r.hidden = false;
  r.innerHTML = '<div class="container"><div class="row g-4"><div class="col-lg-7"><h2 class="h4 fw-bold">Tentang ' + esc(p.nama) + '</h2><p class="text-secondary">' + v(p.deskripsi) + '</p></div>' +
    '<div class="col-lg-5"><div class="rawat card p-3"><h3 class="h6 fw-bold">Kebutuhan perawatan</h3><dl>' +
    '<div><dt>Cahaya</dt><dd>' + v(p.cahaya) + '</dd></div><div><dt>Penyiraman</dt><dd>' + v(p.air) + '</dd></div>' +
    '<div><dt>Media tanam</dt><dd>' + v(p.media) + '</dd></div><div><dt>Tinggi bibit</dt><dd>' + v(p.tinggi) + '</dd></div></dl></div></div></div></div>';
})();