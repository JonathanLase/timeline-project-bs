<?= $this->extend("layouts/master_app") ?>

<?= $this->section("content") ?>
<div class="container-xxl flex-grow-1 container-p-y ">
  <div class="card-header" style="background: rgb(11,57,106);background: linear-gradient(135deg, rgba(11,57,106,1) 0%, rgba(15,76,141,1) 50%, rgba(237,126,37,1) 100%);border-radius:6px;">
    <div class="container">
      <h3 class="py-3 fw-bold text-capitalize text-white">
        Daftar Project
      </h3>
    </div>
  </div>
  <div class="card mb-2">
    <div class="card-datatable table-responsive px-4">
      <table class="table border-top" id="data_table">
        <thead>
          <tr>
            <th class="text-center">No.</th>
            <!-- <th class="text-center">Nama cabang</th> -->
            <th class="text-center">Nama divisi</th>
            <th class="text-center">Nama bidang</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-center"></tbody>
      </table>
    </div>
  </div>
  <!-- <span><b style="color:red">* </b><i>Klik nama bidang untuk melihat daftar project</i></span> -->
</div>

<!-- /Main content -->

<!-- ADD modal content -->
<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
    <div class="modal-content" style="background-color: var(--bs-body-bg);">
      <div class="text-center p-3 btn-primary" id="model-header">
        <h4 class="modal-title text-white" id="info-header-modalLabel"></h4>
      </div>
      <div class="modal-body">
        <?= form_open('', ['class' => 'pr-3 pl-3', 'id' => 'data-form']) ?>
        <div class="row">
          <input type="hidden" id="id_bidang" name="id_bidang" class="form-control" placeholder="Id bidang" required>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group mb-3">
              <label for="nama_bidang" class="col-form-label"> Divisi : <span class="text-danger">*</span> </label>
              <select class="form-select" id="divisi-bank" name="divisi_id" data-placeholder="Masukkan Nama Divisi">
                <?php foreach ($divisi as $d) { ?>
                  <option value="<?= $d->id_divisi ?>"> <?= $d->divisi ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group mb-3">
              <label for="nama_bidang" class="col-form-label"> Nama bidang: <span class="text-danger">*</span> </label>
              <input type="text" id="nama_bidang" name="nama_bidang" class="form-control" placeholder="Nama bidang" minlength="3" maxlength="200" required>
            </div>
          </div>
        </div>
        <div class="form-group text-center">
          <div class="btn-group">
            <button type="submit" class="btn btn-primary mr-2" id="form-btn"><?= lang("App.save") ?></button>
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><?= lang("App.cancel") ?></button>
          </div>
        </div>
        <?= form_close(); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /ADD modal content -->

<?= $this->endSection() ?>


<!-- page script -->
<?= $this->section("script") ?>
<script>
  $('.modal #divisi-bank').select2({
    theme: "bootstrap-5",
    dropdownParent: $('.modal'),
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
  });
</script>
<script>
  let csrfHash = '<?= csrf_hash(); ?>'
  let csrfToken = '<?= csrf_token(); ?>'
  let baseUrl = '<?= site_url(); ?>'

  $(function() {
    var tabel = $('#data_table').DataTable({
      processing: true,
      responsive: true,
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "scrollCollapse": false,
      "ajax": {
        "url": '<?= base_url($controller . "/getAllBidang") ?>',
        "type": "POST",
        "data": {
          [csrfToken]: csrfHash
        },
      },
      "dataType": "json",
      async: "true",
      order: [],
      columnDefs: [{
        targets: 0,
        orderable: false
      }, ],
      dom: '<"card-header flex-column flex-md-row float-start"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',

      buttons: [{
        extend: "collection",
        className: "btn btn-secondary dropdown-toggle me-2",
        text: '<i class="bx bx-export me-sm-2"></i> <span class="d-none d-sm-inline-block">Ekspor</span>',
        buttons: [{
          extend: "print",
          text: '<i class="bx bx-printer me-2" ></i>Print',
          className: "dropdown-item",
        }, {
          extend: "csv",
          text: '<i class="bx bx-file me-2" ></i>Csv',
          className: "dropdown-item",
        }, {
          extend: "excel",
          text: "Excel",
          className: "dropdown-item",
        }, {
          extend: "pdf",
          text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
          className: "dropdown-item",
        }, {
          extend: "copy",
          text: '<i class="bx bx-copy me-2" ></i>Copy',
          className: "dropdown-item",
        }]
      }, {
        text: '<i class="bx bx-plus bx-spin me-sm-2" onclick="save()"></i><span class="d-none d-sm-inline-block" onclick="save()">Tambah Data</span>',
        className: "btn btn-primary"
      }]
    });
  });

  var urlController = '';
  var submitText = '';

  function getUrl() {
    return urlController;
  }

  function getSubmitText() {
    return submitText;
  }

  function generateSlug(text) {
    return text.toString().toLowerCase()
      .replace(/^-+/, '')
      .replace(/-+$/, '')
      .replace(/\s+/g, '-')
      .replace(/\-\-+/g, '-')
      .replace(/[^\w\-]+/g, '');
  }

  function save(id_bidang) {
    // reset the form 
    $("#data-form")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof id_bidang === 'undefined' || id_bidang < 1) { //add
      urlController = '<?= base_url($controller . "/add") ?>';
      submitText = '<?= lang("App.save") ?>';
      $("#info-header-modalLabel").text('<?= lang("App.add") ?>');
      $("#form-btn").text(submitText);
      $('#data-modal').modal('show');
    } else { //edit
      urlController = '<?= base_url($controller . "/edit") ?>';
      submitText = '<?= lang("App.update") ?>';
      $.ajax({
        url: '<?= base_url($controller . "/getOne") ?>',
        type: 'post',
        data: {
          id_bidang: id_bidang,
          [csrfToken]: csrfHash
        },
        dataType: 'json',
        success: function(response) {
          $("#info-header-modalLabel").text('<?= lang("App.edit") ?>');
          $("#form-btn").text(submitText);
          $('#data-modal').modal('show');
          //insert data to form
          $("#data-form #id_bidang").val(response.id_bidang);
          $("#data-form #nama_bidang").val(response.nama_bidang);
          $("#data-form #id_divisi").val(response.divisi_id);
          // $("#data-form #divisi-bank").val(response.cabang_id).trigger('change');
        }
      });
    }
    $.validator.setDefaults({
      highlight: function(element) {
        $(element).addClass('is-invalid').removeClass('is-valid');
      },
      unhighlight: function(element) {
        $(element).removeClass('is-invalid').addClass('is-valid');
      },
      errorElement: 'div ',
      errorClass: 'invalid-feedback',
      errorPlacement: function(error, element) {
        if (element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        } else if ($(element).is('.select')) {
          element.next().after(error);
        } else if (element.hasClass('select2')) {
          //error.insertAfter(element);
          error.insertAfter(element.next());
        } else if (element.hasClass('selectpicker')) {
          error.insertAfter(element.next());
        } else {
          error.insertAfter(element);
        }
      },
      submitHandler: function(form) {
        var form = $('#data-form');
        var nama_bidang = $("#nama_bidang").val();
        var htmlProject = `
        <li class="menu-item">
          <a href="<?= base_url(); ?>/` + nama_bidang.toLowerCase() + `" class="menu-link">
            <div data-i18n="` + nama_bidang + `">` + nama_bidang + `</div>
          </a>
        </li>
        `
        $(".text-danger").remove();
        $.ajax({
          url: getUrl(),
          type: 'post',
          data: form.serialize(),
          cache: false,
          dataType: 'json',
          beforeSend: function() {
            $('#form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
          },
          success: function(response) {
            if (response.success === true) {
              if (response.tambah === true) {
                $("#menu-sub-project").append(htmlProject);
              }
              if (response.ubah === true) {
                $('#' + $('#id_bidang').val() + '_menu').attr("href", baseUrl + generateSlug($('#nama_bidang').val()))
                $('#' + $('#id_bidang').val() + '_nmbidang').attr("data-i18n", $('#nama_bidang').val())
                $('#' + $('#id_bidang').val() + '_nmbidang').text($('#nama_bidang').val())
              }
              $('#data-modal').modal('hide');
              Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'success',
                title: response.messages,
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
                location.reload();
                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
              })
            } else {
              if (response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var ele = $("#" + index);
                  ele.closest('.form-control')
                    .removeClass('is-invalid')
                    .removeClass('is-valid')
                    .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');
                  ele.after('<div class="invalid-feedback">' + response.messages[index] + '</div>');
                });
              } else {
                Swal.fire({
                  toast: false,
                  position: 'bottom-end',
                  icon: 'error',
                  title: response.messages,
                  showConfirmButton: false,
                  timer: 3000
                })

              }
            }
            $('#form-btn').html(getSubmitText());
          }
        });
        return false;
      }
    });

    $('#data-form').validate({

      //insert data-form to database

    });
  }

  function remove(id_bidang) {
    Swal.fire({
      title: "<?= lang("App.remove-title") ?>",
      text: "<?= lang("App.remove-text") ?>",
      icon: 'warning',
      showCancelButton: true,
      showClass: {
        popup: 'animate__animated animate__fadeInDown'
      },
      hideClass: {
        popup: 'animate__animated animate__fadeOutUp'
      },
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '<?= lang("App.confirm") ?>',
      cancelButtonText: '<?= lang("App.cancel") ?>'
    }).then((result) => {
      console.log(result.value)
      if (result.value) {
        $.ajax({
          url: '<?php echo base_url($controller . "/remove") ?>',
          type: 'post',
          data: {
            id_bidang: id_bidang,
            [csrfToken]: csrfHash
          },
          dataType: 'json',
          success: function(response) {
            if (response.success === true) {
              if (response.hapus === true) {
                $('#' + response.id_hapus + '_menu_item').remove()
              }
              Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'success',
                title: response.messages,
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
                location.reload();
                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
              })
            } else {
              Swal.fire({
                toast: false,
                position: 'bottom-end',
                icon: 'error',
                title: response.messages,
                showConfirmButton: false,
                timer: 3000
              })
            }
          }
        });
      }
    })
  }
</script>
<?= $this->endSection() ?>