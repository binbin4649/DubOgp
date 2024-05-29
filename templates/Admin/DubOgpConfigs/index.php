<?php
/*
参考
https://www.sungrove.co.jp/ogp-setting/

[OGP設定]
twitter_id
twitter_card
facebook_app_id
default_image
locale
locale_alternate

TODO
add_blog
add_content
*/
/**
 * [ADMIN] 
 * @var \BaserCore\View\BcAdminAppView $this
 * @var \DubOgp\Model\Entity\DubOgpConfig $entity
 */
$this->BcAdmin->setTitle(__d('baser_core', 'OGP設定'));
$this->BcAdmin->setHelp('dub_ogp_configs_form');

?>


<h2 class="bca-main__heading" data-bca-heading-size="lg"><?php echo __d('baser_core', 'OGP設定') ?></h2>

<!-- form -->
<?php echo $this->BcAdminForm->create($entity) ?>

<?php echo $this->BcFormTable->dispatchBefore() ?>

<div class="section">
  <table id="FormTable" class="form-table bca-form-table">
    <tr>
      <th class="bca-form-table__label">
        <?php echo $this->BcAdminForm->label('twitter_id', 'X(twitter) id') ?>
      </th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcAdminForm->control('twitter_id', ['type' => 'text', 'size' => 35, 'maxlength' => 255]) ?>
        <i class="bca-icon--question-circle bca-help"></i>
        <div class="bca-helptext">X(twitter)のアカウントを入力。@除く。</div>
        <?php echo $this->BcAdminForm->error('twitter_id') ?>
      </td>
    </tr>
    <tr>
      <th class="bca-form-table__label">
        <?php echo $this->BcAdminForm->label('twitter_card', 'X(twitter) card') ?>
      </th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcAdminForm->control('twitter_card', ['type' => 'select', 'options' => $twitterCards]) ?>
        <i class="bca-icon--question-circle bca-help"></i>
        <div class="bca-helptext">X(twitter)idが入力されている場合のみ有効。</div>
        <?php echo $this->BcAdminForm->error('twitter_card') ?>
      </td>
    </tr>
    <tr>
      <th class="bca-form-table__label">
        <?php echo $this->BcAdminForm->label('facebook_app_id', 'facebook App_id') ?>
      </th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcAdminForm->control('facebook_app_id', ['type' => 'text', 'size' => 35, 'maxlength' => 255]) ?>
        <i class="bca-icon--question-circle bca-help"></i>
        <div class="bca-helptext">facebookはApp-IDを入力することを推奨している。 詳しくは「ヘルプ」へ。</div>
        <?php echo $this->BcAdminForm->error('facebook_app_id') ?>
      </td>
    </tr>
    <tr>
      <th class="bca-form-table__label">
        <?php echo $this->BcAdminForm->label('default_image', 'デフォルトイメージ') ?>
      </th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcAdminForm->control('default_image', ['type' => 'text', 'size' => 35, 'maxlength' => 255]) ?>
        <i class="bca-icon--question-circle bca-help"></i>
        <div class="bca-helptext">アイキャッチがない場合に代替する画像のファイル名。 詳しくは「ヘルプ」へ。</div>
        <?php echo $this->BcAdminForm->error('default_image') ?>
      </td>
    </tr>
    <tr>
      <th class="bca-form-table__label">
        <?php echo $this->BcAdminForm->label('locale', 'locale') ?>
      </th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcAdminForm->control('locale', ['type' => 'text', 'size' => 20, 'maxlength' => 255]) ?>
        <i class="bca-icon--question-circle bca-help"></i>
        <div class="bca-helptext">省略すると「ja_JP」が入る。</div>
        <?php echo $this->BcAdminForm->error('locale') ?>
      </td>
    </tr>
    <tr>
      <th class="bca-form-table__label">
        <?php echo $this->BcAdminForm->label('locale_alternate', 'locale_alternate') ?>
      </th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcAdminForm->control('locale_alternate', ['type' => 'text', 'size' => 20, 'maxlength' => 255]) ?>
        <i class="bca-icon--question-circle bca-help"></i>
        <div class="bca-helptext">省略すると出力されない。</div>
        <?php echo $this->BcAdminForm->error('locale_alternate') ?>
      </td>
    </tr>
    <?php echo $this->BcAdminForm->dispatchAfterForm() ?>
  </table>
</div>

<?php echo $this->BcFormTable->dispatchAfter() ?>

<div class="submit bca-actions">
  <div class="bca-actions__main">
    <?php echo $this->BcAdminForm->button(__d('baser_core', '保存'), [
      'div' => false,
      'class' => 'button bca-btn bca-actions__item bca-loading',
      'data-bca-btn-type' => 'save',
      'data-bca-btn-size' => 'lg',
      'data-bca-btn-width' => 'lg',
    ]) ?>
  </div>
</div>

<?php echo $this->BcAdminForm->end() ?>