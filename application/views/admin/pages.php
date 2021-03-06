<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">


    <div class="col-md-6 m-auto box add_area mt-50" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?>">
      
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title"><?php echo trans('edit-page') ?></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('add-new-page') ?></h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <?php $required = ''; ?>
            <a href="<?php echo base_url('admin/pages') ?>" class="pull-right btn btn-default btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
          <?php else: ?>
            <?php $required = 'required'; ?>
            <a href="#" class="text-right btn btn-default btn-sm cancel_btn"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/pages/add')?>" role="form" novalidate>

          <div class="form-group">
              <label><?php echo trans('page-title') ?></label>
              <input type="text" class="form-control" name="title" value="<?php echo html_escape($page[0]['title']); ?>" <?php echo html_escape($required); ?>>
          </div>

          <div class="form-group">
              <label><?php echo trans('page-slug') ?></label>
              <input type="text" class="form-control" name="slug" value="<?php echo html_escape($page[0]['slug']); ?>" <?php echo html_escape($required); ?>>
          </div>
         
          <div class="form-group">
              <label><?php echo trans('page-description') ?></label>
              <textarea id="summernote" class="form-control" name="details"><?php echo html_escape($page[0]['details']); ?></textarea>
          </div>

          <input type="hidden" name="id" value="<?php echo html_escape($page['0']['id']); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <div class="row mb-20">
            <div class="col-sm-12">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <button type="submit" class="btn btn-info pull-left"><?php echo trans('save-changes') ?></button>
              <?php else: ?>
                <button type="submit" class="btn btn-info pull-left"> <?php echo trans('save') ?></button>
              <?php endif; ?>
            </div>
          </div>

        </form>

      </div>
    </div>


    <?php if (isset($page_title) && $page_title != "Edit"): ?>

    <div class="list_area container">

      <?php if (isset($page_title) && $page_title == "Edit"): ?>
        <h3 class="box-title"><?php echo trans('edit-page') ?> <a href="<?php echo base_url('admin/pages') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
      <?php else: ?>
        <h3 class="box-title"><?php echo trans('pages') ?> <a href="#" class="pull-right btn btn-info btn-sm add_btn"><i class="fa fa-plus"></i> <?php echo trans('add-new-page') ?></a></h3>
      <?php endif; ?>

      <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive p-0">
          <table class="table table-hover cushover <?php if(count($pages) > 10){echo "datatable";} ?>" id="dg_table">
              <thead>
                  <tr>
                      <th>#</th>
                      <th><?php echo trans('title') ?></th>
                      <th><?php echo trans('details') ?></th>
                      <th><?php echo trans('action') ?></th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($pages as $row): ?>
                  <tr id="row_<?php echo ($row->id); ?>">
                      
                      <td width="5%"><?php echo $i; ?></td>
                      <td><?php echo html_escape($row->title); ?></td>
                      <td><?php echo character_limiter($row->details, 100); ?></td>

                      <td class="actions" width="12%">
                        <a href="<?php echo base_url('admin/pages/edit/'.html_escape($row->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                        <a data-val="page" data-id="<?php echo html_escape($row->id); ?>" href="<?php echo base_url('admin/pages/delete/'.html_escape($row->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> 
                      </td>
                  </tr>
                <?php $i++; endforeach; ?>
              </tbody>
          </table>
      </div>

    </div>
    <?php endif; ?>

  </section>
</div>
