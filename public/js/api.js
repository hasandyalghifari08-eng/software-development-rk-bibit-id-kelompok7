// Alamat folder public/ dihitung dari lokasi file ini, jadi aman dipakai dari halaman admin juga
const BASE = document.currentScript.src.replace(/js\/api\.js.*$/, '');
// Sumber data. Kalau BE sudah jadi, ganti ke endpoint PHP: BASE + 'api_bibit.php' dan BASE + 'api_toko.php'
const API = { produk: BASE + 'data/produk.json', toko: BASE + 'data/toko.json' };
const EMO = { Buah: '🍊', Hias: '🪴', Bunga: '🌸', Sayur: '🥬' };
const esc = s => String(s ?? '').replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
const rp = n => 'Rp' + Number(n).toLocaleString('id-ID');
const ambil = u => fetch(u).then(r => { if (!r.ok) throw new Error(r.status); return r.json(); });
const buka = j => { if (j && j.status === 'error') throw new Error(j.pesan); return j && j.status !== undefined ? j.data : j; };
const norm = p => ({ ...p, id: p.id ?? p.id_bibit, kategori: p.kategori ?? p.nama_kategori, harga: Number(p.harga), stok: Number(p.stok) });
const getProduk = () => ambil(API.produk).then(j => (buka(j) || []).map(norm));
const getToko = () => ambil(API.toko).then(j => { const d = buka(j); return Array.isArray(d) ? d[0] : d; });
const linkWa = (wa, pesan) => 'https://wa.me/' + wa + (pesan ? '?text=' + encodeURIComponent(pesan) : '');
const fmtWa = wa => ('0' + String(wa).slice(2)).replace(/^(\d{4})(\d{4})(\d+)$/, '$1-$2-$3');

// Isi semua link/teks toko di halaman dari satu sumber data
function isiToko(t) {
  document.querySelectorAll('[data-link]').forEach(a => {
    const k = a.dataset.link;
    a.href = k === 'wa' ? linkWa(t.wa, a.dataset.pesan) : t[k];
  });
  document.querySelectorAll('[data-toko]').forEach(e => {
    const k = e.dataset.toko;
    e.textContent = k === 'wa_fmt' ? fmtWa(t.wa) : t[k];
  });
}
document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('[data-link],[data-toko]')) getToko().then(isiToko).catch(() => {});
});