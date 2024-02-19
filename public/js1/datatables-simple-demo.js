window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }

    // datatables Tabel Hutang - Detail Karyawan
    const tabelHutang = document.getElementById('tabelHutang');
    if (tabelHutang) {
        new simpleDatatables.DataTable(tabelHutang);
    }
});
