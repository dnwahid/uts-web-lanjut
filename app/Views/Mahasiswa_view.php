<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa AJAX</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Form Mahasiswa</h2>
    <input type="text" id="nama" placeholder="Nama Mahasiswa">
    <input type="text" id="prodi" placeholder="Program Studi">
    <button type="button" id="btnSimpan">Simpan</button>

    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Prodi</th>
            </tr>
        </thead>
        <tbody id="tbody">
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            const baseUrl = '<?= base_url() ?>'; 

            loadData();

            function loadData() {
                $.ajax({
                    url: baseUrl + "mahasiswa/getData",
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        let html = "";
                        response.data.forEach(function(row) {
                            html += "<tr>";
                            html += "<td>" + row.id + "</td>";
                            html += "<td>" + row.nama + "</td>";
                            html += "<td>" + row.prodi + "</td>";
                            html += "</tr>";
                        });
                        $("#tbody").html(html);
                    }
                });
            }

            $("#btnSimpan").click(function(e) {
                e.preventDefault(); 
                let nama = $("#nama").val();
                let prodi = $("#prodi").val();

                if(nama === "" || prodi === "") {
                    alert("Nama dan Prodi harus diisi!");
                    return;
                }

                $.ajax({
                    url: baseUrl + "mahasiswa/simpan",
                    method: "POST",
                    data: { nama: nama, prodi: prodi },
                    success: function(res) {
                        alert("Data berhasil disimpan!");
                        $("#nama").val(""); 
                        $("#prodi").val("");
                        loadData(); 
                    }
                });
            });
        });
    </script>
</body>
</html>