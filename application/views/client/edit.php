<div class="content-wrapper">
<div class="container pt-5">
    <h3><?= $title ?></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Client</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('client'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php
                    //create form
                    $attributes = array('id' => 'FrmEditClient', 'method' => "post", "autocomplete" => "off");
                    echo form_open('', $attributes);
                    ?>
                    <div class="form-group row">
                        <label for="nama_client" class="col-sm-2 col-form-label">Nama Client</label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="id" name="id" value=" <?= $data_client->id; ?>">
                            <input type="text" class="form-control" id="nama_client" name="nama_client" value=" <?= $data_client->nama_client; ?>">
                            <small class="text-danger">
                                <?php echo form_error('nama_client') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="logo_client" class="col-sm-2 col-form-label">Logo Client</label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="id" name="id" value=" <?= $data_client->id; ?>">
                            <input type="text" class="form-control" id="logo_client" name="logo_client" value=" <?= $data_client->logo_client; ?>">
                            <small class="text-danger">
                                <?php echo form_error('logo_client') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status_id" class="col-sm-2 col-form-label">Status Id</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="status_id" name="status_id">
                                <option value="" selected disabled>Pilih</option>
                                <option value="0" <?php if ($data_client->status_id == "0") : echo "selected";
                                                        endif; ?>>0</option>
                                <option value="1" <?php if ($data_client->status_id == "1") : echo "selected";
                                                            endif; ?>>1</option>
                            </select>
                            <small class="text-danger">
                                <?php echo form_error('status_id') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 offset-md-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a class="btn btn-secondary" href="javascript:history.back()">Kembali</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>