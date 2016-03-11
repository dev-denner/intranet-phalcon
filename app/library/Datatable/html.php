<!-- datatable -->
<div class="datatable">
  <?php echo $hiddenArea; ?>
  <div class="card">
    <div class="card-header ch-alt">
      <?php echo $titleArea; ?>

      <ul class="actions">
        <?php echo $actionsArea; ?>
      </ul>
      <div class="row actionBar">
        <div class="col-md-2">
          <div class="btn-group">
            <?php echo $lengthArea; ?>
          </div>
        </div>
        <div class="col-md-4 col-md-offset-6">
          <div class="search form-group">
            <div class="input-group fg-float">
              <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
              <div class="fg-line">
                <?php echo $filterArea; ?>
                <label class="fg-label">Busca Simples</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card-body card-padding">
      <div class="table-responsive">
        <!-- table -->
        <?php echo $tableArea; ?>
        <!-- table -->
      </div>
    </div>
    <div class="card-header ch-alt">
      <div class="row">
        <?php if ($hasData): ?>
          <div class="col-md-4 col-xs-12">
            <!-- datatable_Info -->
            <div class="datatable_info" role="alert">
              <?php echo $infoArea; ?>
            </div>
            <!-- datatable_Info -->
          </div>

          <div class="col-md-5 col-xs-12 col-md-offset-3">
            <!-- datatable_Pagination -->
            <div class="datatable_pagination">
              <ul class="pagination pagination-sm">
                <?php echo $paginationArea; ?>
              </ul>
            </div>
            <!-- datatable_Pagination -->
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <!-- Emissary -->
  <?php echo $formArea; ?>
  <!-- Emissary -->
</div>
<!-- controldatatable -->
<!-- modal -->
<div class="modal fade in" id="datatable_modal" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body" id="datatable_modal_content">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn bgm-lightblue waves-effect" data-dismiss="modal"id="datatable_modal_bt">OK</button>
      </div>
    </div>
  </div>
</div>
<!-- modal -->
<script type="text/javascript">
<?php include_once __DIR__ . '\app.js'; ?>
</script>