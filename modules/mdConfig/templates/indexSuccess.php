<?php include_partial('mdConfig/assets') ?>

<?php slot('config'); ?>
<?php slot('nav') ?>Configuracion<?php end_slot(); ?>

<div id="sf_admin_container">
  <h1><?php echo __('Home_List', array(), 'messages') ?></h1>

  <?php include_partial('mdConfig/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('mdConfig/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('mdConfig/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('md_log_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('mdConfig/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('mdConfig/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('mdConfig/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('mdConfig/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
