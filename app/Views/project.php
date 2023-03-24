<?= $this->extend("layouts/master_app") ?>

<?= $this->section("content") ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h3 class="fw-bold py-3 text-capitalize">
    List Project
  </h3>

  <div class="card">
    <div class="card-datatable table-responsive px-4">
      <table class="table border-top" id="data_table">
        <thead>
          <tr>
            <th class="text-center">No.</th>
            <th class="text-center">Judul project</th>
            <!-- <th>Name divisi</th> -->
            <th class="text-center">Nama Bidang</th>
            <th class="text-center">Nama PIC</th>
            <th class="text-center">Start</th>
            <th class="text-center">Deadline</th>
            <th class="text-center">Time Left</th>
            <th class="text-center">Status</th>

            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-center"></tbody>
      </table>
    </div>
  </div>
</div>

<!-- /Main content -->

<!-- ADD modal content -->
<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
    <div class="modal-content" style="background-color: var(--bs-body-bg);">
      <div class="text-center p-3 btn-dark" id="model-header">
        <h4 class="modal-title text-white" id="info-header-modalLabel"></h4>
      </div>
      <div class="modal-body">
        <?= form_open('', ['class' => 'pr-3 pl-3', 'id' => 'data-form']) ?>
        <div class="row">
          <input type="hidden" id="id_project" name="id_project" class="form-control" placeholder="Id project" required>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group mb-3">
              <label for="name_project" class="col-form-label"> Name project: <span class="text-danger">*</span> </label>
              <input type="text" id="name_project" name="name_project" class="form-control" placeholder="Name project" minlength="0" maxlength="200" required>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group mb-3">
              <label for="nama_pic" class="col-form-label"> Nama bidang: <span class="text-danger">*</span> </label>
              <select class="form-select" id="id_bidang" name="id_bidang" data-placeholder="Masukkan Nama Bidang">
                <?php foreach ($bidang as $d) { ?>
                  <option value="<?= $d->id_bidang ?>"> <?= $d->nama_bidang ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group mb-3">
              <label for="nama_pic" class="col-form-label"> Nama pic: <span class="text-danger">*</span> </label>
              <input type="text" id="nama_pic" name="nama_pic" class="form-control" placeholder="Name pic" minlength="0" maxlength="200" required>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group mb-3">
              <label for="start" class="col-form-label"> Start: <span class="text-danger">*</span> </label>
              <input type="date" id="start" name="start" class="form-control" dateISO="true" required>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group mb-3">
              <label for="deadline" class="col-form-label"> Deadline: <span class="text-danger">*</span> </label>
              <input type="date" id="deadline" name="deadline" class="form-control" dateISO="true" required>
            </div>
          </div>
        </div>
        <div class="row" id="form-project">

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
  let csrfHash = '<?= csrf_hash(); ?>'
  let csrfToken = '<?= csrf_token(); ?>'
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
        "url": '<?= base_url($controller . "/getAll") ?>',
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
        text: '<i class="bx bx-plus bx-spin me-sm-2 " onclick="save()"></i><span class="d-none d-sm-inline-block" onclick="save()">Tambah Data</span>',
        className: "btn btn-primary viewdata"
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

  $('body').on('click', '.viewdata', function() {
    datepilihan = $(this).data('start');
    if (typeof datepilihan !== 'undefined') {
      $('#deadline')[0].setAttribute('min', datepilihan);
      $('#deadline')[0].removeAttribute('disabled', '');
    } else {
      $('#deadline')[0].setAttribute('disabled', '');
    }

    $('#start').on('change', function() {
      datepilihan = this.value;
      $('#deadline')[0].removeAttribute('disabled', '');
      $('#deadline')[0].setAttribute('min', datepilihan);
    });
  });



  function save(id_project) {
    // reset the form 

    $("#data-form")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof id_project === 'undefined' || id_project < 1) { //add
      urlController = '<?= base_url($controller . "/add") ?>';
      submitText = '<?= lang("App.save") ?>';
      $("#info-header-modalLabel").text('<?= lang("App.add") ?>');
      $("#form-btn").text(submitText);
      $('#data-modal').modal('show');
    } else { //edit
      urlController = '<?= base_url($controller . "/edit") ?>';
      submitText = '<?= lang("App.update") ?>';
      $('#data-form #form-project').html(`
          <div class="col-md-12">
            <div class="form-group mb-3">
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Keterangan</label>
                  <textarea id="keterangan" class="form-control" name="keterangan" rows="3"></textarea>
              </div>
            </div>
          </div>
      `)
      $.ajax({
        url: '<?= base_url($controller . "/getOne") ?>',
        type: 'post',
        data: {
          id_project: id_project,
          [csrfToken]: csrfHash
        },
        dataType: 'json',
        success: function(response) {
          $("#info-header-modalLabel").text('<?= lang("App.edit") ?>');
          $("#form-btn").text(submitText);
          $('#data-modal').modal('show');
          //insert data to form
          $("#data-form #id_project").val(response.id_project);
          $("#data-form #name_project").val(response.name_project);
          $("#data-form #bidang_id").val(response.bidang_id);
          $("#data-form #nama_pic").val(response.nama_pic);
          $("#data-form #start").val(response.start);
          $("#data-form #deadline").val(response.deadline);
          $("#data-form #form-project #keterangan").text(response.keterangan);
          $("#data-form #status").val(response.status);
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
        $(".text-danger").remove();
        $.ajax({
          // fixBug get url from global function only
          // get global variable is bug!
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
              $('#data-modal').modal('hide');
              Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'success',
                title: response.messages,
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
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

  function remove(id_project) {
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

      if (result.value) {
        $.ajax({
          url: '<?php echo base_url($controller . "/remove") ?>',
          type: 'post',
          data: {
            id_project: id_project,
            [csrfToken]: csrfHash
          },
          dataType: 'json',
          success: function(response) {
            if (response.success === true) {
              Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'success',
                title: response.messages,
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
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

  function statusProject(id_project) {
    Swal.fire({
      title: "Ubah Status",
      text: "Apakah pekerjaan telah selesai?",
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
      if (result.value) {
        $.ajax({
          url: '<?php echo base_url($controller . "/updateStatus") ?>',
          type: 'post',
          data: {
            id_project: id_project,
            [csrfToken]: csrfHash
          },
          dataType: 'json',
          success: function(response) {
            if (response.success === true) {
              Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'success',
                title: response.messages,
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
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

  function keterangan(id_project) {
    var detailKeterangan = ""
    $.ajax({
      url: '<?= base_url($controller . "/getKeterangan") ?>',
      type: 'post',
      data: {
        id_project: id_project,
        [csrfToken]: csrfHash
      },
      dataType: 'json',
      success: function(data) {
        $("#info-header-modalLabel").text('Detail Project');
        $("#form-btn").text(submitText);
        $('#data-modal').modal('show');
        if (data.length) {
          for (let i = 0; i < data.length; i++) {
            if (data[i].project_id == id_project) {
              detailKeterangan += `
          <div class="col-md-12">
            <div class="form-group mb-3">
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Keterangan</label>
                  <textarea id="keterangan" class="form-control" name="keterangan" rows="3" readonly>` + data[i].keterangan + `</textarea>
                  <p>Terakhir diubah : ` + data[i].created_at + `</p>
              </div>
            </div>
          </div>
      `
            }
          }
          $("#data-form").html(detailKeterangan);
        } else {
          $("#data-form").html("");
        }
      }
    });
  }
</script>
<!-- <script>
  window.onload = function() { //from ww  w . j  a  va2s. c  o  m

    var today = new Date().toISOString().split('T')[0];
    var val_datestart = document.getElementsByName('start')
    console.log(val_datestart)
    document.getElementsByName("deadline")[0].setAttribute('min', val_datestart);
  }
  
</script> -->
<!-- <script>
  console.log($('input[name = "deadline"]'));
</script> -->

<?= $this->endSection() ?>