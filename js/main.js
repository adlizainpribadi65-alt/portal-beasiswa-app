// Script penyimpanan Array JSON lokal DIHAPUS karena digantikan PHP & MySQL.

// Navigation Logic
const navLinks = document.querySelectorAll('.nav-link');
const sections = document.querySelectorAll('.section');

navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const targetId = link.getAttribute('data-target');
        navigateTo(targetId);
    });
});

// Fungsi Navigasi SPA
function navigateTo(targetId) {
    navLinks.forEach(link => {
        if(link.getAttribute('data-target') === targetId) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });

    sections.forEach(section => {
        if(section.id === targetId) {
            section.classList.add('active');
        } else {
            section.classList.remove('active');
        }
    });
}

// Logic Validasi IPK -> Disabling Forms
const ipkInput = document.getElementById('ipk');
const beasiswaSelect = document.getElementById('beasiswa');
const berkasInput = document.getElementById('berkas');
const btnDaftar = document.getElementById('btnDaftar');

if(ipkInput) {
    ipkInput.addEventListener('input', (e) => {
        const valStr = e.target.value;
        if(!valStr) {
            disableFormAdditions();
            return;
        }

        let value = parseFloat(valStr);
        
        // Memaksa batas maksimum nilai 4.0
        if(value > 4.0) {
            e.target.value = 4.0;
            value = 4.0;
        }
        
        // Aturan Ujikom: IPK Minimal 3.0
        if(value >= 3.0) {
            enableFormAdditions();
        } else {
            disableFormAdditions();
        }
    });
}

function enableFormAdditions() {
    beasiswaSelect.disabled = false;
    berkasInput.disabled = false;
    btnDaftar.disabled = false;
    
    beasiswaSelect.setAttribute('required', 'required');
    berkasInput.setAttribute('required', 'required');
}

function disableFormAdditions() {
    beasiswaSelect.disabled = true;
    berkasInput.disabled = true;
    btnDaftar.disabled = false; // Tetap aktif agar form bisa disubmit
    
    beasiswaSelect.value = '';
    berkasInput.value = '';
    
    beasiswaSelect.removeAttribute('required');
    berkasInput.removeAttribute('required');
}
