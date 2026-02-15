<!-- Location Detail Modal -->
<div id="location-detail-modal" class="location-modal-overlay" style="display:none; position:fixed; z-index:99999; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4);">
    <div class="location-modal-container" style="max-width:560px;margin:5vw auto;background:white;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.08);overflow:hidden;position:relative;">
        <button class="location-modal-close" onclick="closeLocationModal()" aria-label="Close"
                style="position:absolute;top:16px;right:24px;font-size:28px;background:none;border:none;cursor:pointer;z-index:1000;color:#01215E;">&times;</button>
        <div style="padding:42px 40px 24px 40px;">
    <img id="modal-location-image" src="" alt="Gambar Cabang" style="width:100%;max-height:210px;object-fit:cover;border-radius:12px;margin-bottom:18px;display:none;">
    <h2 id="modal-location-name" style="font-size:32px;font-weight:800;color:#01215E;margin-bottom:12px;"></h2>
            <div id="modal-location-address" style="color:#444;font-size:17px;margin-bottom:12px;line-height:1.6;"></div>
            <div id="modal-location-contact" style="color:#202020;font-size:17px;margin-bottom:18px;"></div>
            <div id="modal-location-email" style="margin-bottom:18px;"></div>
            <div id="modal-location-hours" style="background:#f8f9fa;border-radius:12px;padding:16px 18px;margin-bottom:18px;"></div>
            <div id="modal-location-actions" style="margin-top: 14px;display: flex;gap: 10px;flex-wrap: wrap;"></div>
        </div>
    </div>
</div>
<script>
function showLocationModal(data) {
    var imgElem = document.getElementById('modal-location-image');
    if (data.image) {
        imgElem.src = data.image;
        imgElem.style.display = 'block';
    } else {
        imgElem.style.display = 'none';
    }
    document.getElementById('modal-location-name').textContent = data.name||'';
    document.getElementById('modal-location-address').textContent = data.address||'';
    document.getElementById('modal-location-contact').innerHTML = data.whatsapp ? `<a href='https://wa.me/${data.whatsapp.replace(/[^0-9]/g, '')}' target='_blank' style='color:#25D366;text-decoration:none;font-weight:600;'><i class='fab fa-whatsapp'></i> WhatsApp: ${data.whatsapp}</a>` : '';
    document.getElementById('modal-location-email').innerHTML = data.email ? `<a href='mailto:${data.email}' style='color:#01215E;text-decoration:underline;'>${data.email}</a>` : '';
    let days = data.hours||[];
    let fmt = t => (typeof t === 'string' && t.length >= 5) ? t.slice(0,5) : (t||'');
    let daysHtml = days.length ? days.map(d => `<div style='display:flex;justify-content:space-between;'><strong>${d.day}</strong><span>${d.open&&d.close?fmt(d.open)+" - "+fmt(d.close):"Tutup"}</span></div>`).join('') : '';
    document.getElementById('modal-location-hours').innerHTML = daysHtml;

    // Action Buttons (Whatsapp/Map)
    let action = '';
    if(data.whatsapp_url) {
      action += `<a href='${data.whatsapp_url}' target='_blank' class='btn btn-primary'><i class='fab fa-whatsapp'></i> Reservasi</a>`;
    }
    if(data.maps_url) {
      action += `<a href='${data.maps_url}' target='_blank' class='btn btn-secondary'><i class='fas fa-directions'></i> Lihat Rute</a>`;
    }
    document.getElementById('modal-location-actions').innerHTML = action;

    document.getElementById('location-detail-modal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}
function closeLocationModal() {
    document.getElementById('location-detail-modal').style.display = 'none';
    document.body.style.overflow = '';
}
</script>
<style>
.location-modal-overlay {transition: background 0.2s;}
.location-modal-container {animation: modalFadeIn 0.22s;}
@keyframes modalFadeIn { from {opacity:0; transform:scale(0.92);} to {opacity:1;transform:scale(1);} }
</style>
