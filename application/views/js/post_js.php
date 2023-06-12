<script type="text/javascript">
    var table; // for table
    var foor; // for table
    var save_method; // untuk metode save data varible global

    // itu yang buat add udah jalan ga bakalan bener soalna harus satu file lamun banyak pati menumpuk di file footer.php
    function reload_data() {
        foor.ajax.reload(null, false); //reload datatable ajax
    }

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax
    }

    function showAlert(type, msg) {

        toastr.options.closeButton = true;
        toastr.options.progressBar = true;
        toastr.options.extendedTimeOut = 1000; //1000

        toastr.options.timeOut = 3000;
        toastr.options.fadeOut = 250;
        toastr.options.fadeIn = 250;

        toastr.options.positionClass = 'toast-top-center';
        toastr[type](msg);
    }


    $(document).ready(function() {

        table = $("#post-datatable").DataTable({

            "ajax": "<?= base_url("administrasi/post/datatable") ?>",

            // select: {
            //     style: "multi"
            // },
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>",
                },
                info: "Showing products _START_ to _END_ of _TOTAL_",
                lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> products',
            },
            pageLength: 5,

            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            },
        });

    });


    function addProduk() {
        save_method = 'add';
        $('#form')[0].reset();
        $('#imagePreview').html('');
        $('#summernote').summernote('code', '');
        $('#staticBackdrop').modal('show');
        $('.modal-title').text('Tambah Konten');
    }



    function addfoto(id) {

        $('#fileUpload')[0].reset();
        $('#imagePreview').html('');
        $('#addfoto').modal('show');
        $('#fotoProduk').empty();
        $('[name="id"]').val(id);
        $.ajax({
            url: "<?php echo site_url('administrasi/post/subFoto/') ?>" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {

                $('#fotoProduk').html(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
        // alert(id);
        // console.log(data);
    }

    function fileValidation() {
        var fileInput = document.getElementById('file');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
            fileInput.value = '';
            return false;
        } else {
            //Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').innerHTML = '<img style="max-width:350px;" src="' + e.target
                        .result + '"/>';
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }

    $('#form').submit(function(e) {
        e.preventDefault();
        var form = $('#form')[0];
        var data = new FormData(form);
        if (save_method == 'add') {
            if ($('[name="foto"]').val() == '') {
                alert('Pilih Foto Produk Yang Akan di Upload !');
                return false;
            }
        }
        $('#btnSave').text('Sedang Proses, Mohon tunggu...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('administrasi/post/input_konten') ?>";
        } else {
            url = "<?php echo site_url('administrasi/post/update_konten') ?>";
        }
        $.ajax({
            url: url,
            type: "POST",
            //contentType: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            data: data,
            dataType: "JSON",

            success: function(data) {
                if (data.status == '00') {
                    showAlert(data.type, data.mess);
                    $('#staticBackdrop').modal('hide');
                    $('#form')[0].reset();
                    reload_table();
                } else {

                    showAlert(data.type, data.mess);
                }
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable
            },
            error: function(jqXHR, textStatus, errorThrown) {
                type = 'error';
                msg = 'Error adding / update data';
                showAlert(type, msg); //utk show alert
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable
            }
        });

    });


    $('#fileUpload').submit(function(e) {
        e.preventDefault();
        var form = $('#fileUpload')[0];
        var data = new FormData(form);
        if ($('[name="file"]').val() == '') {
            alert('Pilih Foto Produk Yang Akan di Upload !');
            return false;
        }

        $('#upload').text('Sedang Proses..'); //change button text
        $('#upload').attr('disabled', true); //set button disable

        $.ajax({
            url: "<?php echo site_url('administrasi/post/fileUpload') ?>",
            type: "POST",
            //contentType: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            data: data,
            dataType: "JSON",

            success: function(data, id) {
                if (data.status == '00') {
                    showAlert(data.type, data.mess);
                    $('#fileUpload')[0].reset();
                    $('#fotoProduk').html(data);

                    $('#addfoto').modal('hide');
                } else {

                    showAlert(data.type, data.mess);
                }
                $('#upload').text('Simpan'); //change button text
                $('#upload').attr('disabled', false); //set button enable
            },
            error: function(jqXHR, textStatus, errorThrown) {
                type = 'error';
                msg = 'Error adding / update data';
                showAlert(type, msg); //utk show alert
                $('#upload').text('Simpan'); //change button text
                $('#upload').attr('disabled', false); //set button enable
            }
        });

    });



    function detail(id) {
        $('#produkdetail').modal('show');
        $('#detaildata').empty();

        $.ajax({
            url: "<?php echo site_url('administrasi/post/detailpost/') ?>" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                // console.log(data);
                $('#detaildata').html(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    }

    function edit(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('#staticBackdrop').modal('show');
        $('#imagePreview').html('');
        $('.modal-title').text('Edit konten');
        $('#summernote').summernote('code', '');

        $.ajax({
            url: "<?php echo site_url('administrasi/post/editkonten/') ?>" + id,
            type: "POST",
            dataType: "JSON",

            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="judul"]').val(data.judul);
                $('[name="deskripsi"]').val(data.deskripsi);
                $('[name="kategori"]').val(data.kategori);
                $('#summernote').summernote('code', data.konten);

                $('[name="old_foto"]').val(data.foto);
                $('[#file').text(data.foto);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }


    function hapus(id) {
        if (confirm('Apakah Anda yakin menghapus data ini ?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('administrasi/post/delete_data/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status == '00') {
                        showAlert(data.type, data.mess);
                        reload_table();
                    } else {
                        showAlert(data.type, data.mess);
                        reload_table();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        }
    }

    function remove(id) {
        if (confirm('Apakah Anda yakin menghapus data ini ?')) {
            var id_foto = id;
            $.ajax({
                url: "<?php echo site_url('administrasi/post/delete_foto/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status == '00') {
                        showAlert(data.type, data.mess);
                        addfoto(id_foto);

                    } else {
                        showAlert(data.type, data.mess);
                        addfoto(id_foto);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        }
    }



    function on_slide(id) {
        if (confirm('Apakah Anda yakin menampilkan data ini di Slide ?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('administrasi/post/slide_on/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status == '00') {
                        showAlert(data.type, data.mess);
                        reload_table();
                    } else {
                        showAlert(data.type, data.mess);
                        reload_table();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error data switch');
                }
            });
        }
    }

    function produk_on(id) {
        if (confirm('Apakah Anda yakin menampilkan data ini di widget produk ?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('administrasi/post/produk_on/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status == '00') {
                        showAlert(data.type, data.mess);
                        reload_table();
                    } else {
                        showAlert(data.type, data.mess);
                        reload_table();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error data switch');
                }
            });
        }
    }

    function port_on(id) {
        if (confirm('Apakah Anda yakin menampilkan data ini di widget portfolio ?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('administrasi/post/port_on/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status == '00') {
                        showAlert(data.type, data.mess);
                        reload_table();
                    } else {
                        showAlert(data.type, data.mess);
                        reload_table();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error data switch');
                }
            });
        }
    }

    function berita_on(id) {
        if (confirm('Apakah Anda yakin menampilkan data ini di widget Berita ?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('administrasi/post/berita_on/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status == '00') {
                        showAlert(data.type, data.mess);
                        reload_table();
                    } else {
                        showAlert(data.type, data.mess);
                        reload_table();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error data switch');
                }
            });
        }
    }

    function of_slide(id) {
        if (confirm('Apakah Anda yakin menutup data ini di slide ?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('administrasi/post/slide_of/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status == '00') {
                        showAlert(data.type, data.mess);
                        reload_table();
                    } else {
                        showAlert(data.type, data.mess);
                        reload_table();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error data switch');
                }
            });
        }
    }

    function produk_of(id) {
        if (confirm('Apakah Anda yakin menutup data ini di widget Produk ?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('administrasi/post/produk_of/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status == '00') {
                        showAlert(data.type, data.mess);
                        reload_table();
                    } else {
                        showAlert(data.type, data.mess);
                        reload_table();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error data switch');
                }
            });
        }

    }

    function port_of(id) {
        if (confirm('Apakah Anda yakin menutup data ini di widget Portfolio ?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('administrasi/post/port_of/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status == '00') {
                        showAlert(data.type, data.mess);
                        reload_table();
                    } else {
                        showAlert(data.type, data.mess);
                        reload_table();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error data switch');
                }
            });
        }

    }

    function berita_of(id) {
        if (confirm('Apakah Anda yakin menutup data ini di widget Berita ?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('administrasi/post/berita_of/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status == '00') {
                        showAlert(data.type, data.mess);
                        reload_table();
                    } else {
                        showAlert(data.type, data.mess);
                        reload_table();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error data switch');
                }
            });
        }

    }
</script>