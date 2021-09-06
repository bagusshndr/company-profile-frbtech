<div class="content-wrapper">
<div class="container pt-5">
    <h3><?= $title ?></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Services</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('services'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Data</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php
                    //create form
                    $attributes = array('id' => 'FrmAddServices', 'method' => "post", "autocomplete" => "off");
                    echo form_open('', $attributes);
                    ?>

                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="judul" name="judul" value=" <?= set_value('judul'); ?>">
                            <small class="text-danger">
                                <?php echo form_error('judul') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= set_value('deskripsi'); ?></textarea>
                            <small class="text-danger">
                                <?php echo form_error('deskripsi') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="icon" class="col-sm-2 col-form-label">icon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="icon" name="icon" value=" <?= set_value('icon'); ?>">
                            <small class="text-danger">
                                <?php echo form_error('icon') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status_id" class="col-sm-2 col-form-label">Status Id</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="status_id" name="status_id">
                                <option value="" selected disabled>Pilih</option>
                                <option value="0" <?php if (set_value('status_id') == "0") : echo "selected";
                                                        endif; ?>>0</option>
                                <option value="1" <?php if (set_value('status_id') == "1") : echo "selected";
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