<?php
$this->BcAdmin->setTitle(__d('baser_core', 'OGPプラグイン設定'));
$this->BcAdmin->setHelp('ogp_configs_form');
?>

<h2 class="bca-main__heading" data-bca-heading-size="lg"><?php echo __d('baser_core', 'OGP設定') ?></h2>

<!-- form -->
<?php echo $this->BcAdminForm->create($entity) ?>

<?php echo $this->BcFormTable->dispatchBefore() ?>

<div class="section">
  <table id="FormTable" class="form-table bca-form-table">
    <tr>
      <th class="bca-form-table__label">
        <?php echo $this->BcAdminForm->label('twitter_id', __d('baser_core', 'Twitter ID')) ?>
      </th>
      <td class="col-input bca-form-table__input">
        @<?php echo $this->BcAdminForm->control('twitter_id', ['type' => 'text', 'size' => 35, 'maxlength' => 255, 'autofocus' => true]) ?>
        <i class="bca-icon--question-circle bca-help"></i>
        <?php echo $this->BcAdminForm->error('twitter_id') ?>
        <div class="bca-helptext"><?php echo __d('baser_core', 'Twitterアカウントがあったら、@の後ろを入力。') ?></div>
      </td>
    </tr>
    <tr>
      <th class="bca-form-table__label">
        <?php echo $this->BcAdminForm->label('twitter_card', __d('baser_core', 'Twitter Card')) ?>
      </th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcAdminForm->control('twitter_card', ['type' => 'select', 'options' => ['summary_large_image', 'summary', 'app', 'player']]) ?>
        <i class="bca-icon--question-circle bca-help"></i>
        <?php echo $this->BcAdminForm->error('twitter_card') ?>
        <div class="bca-helptext"><?php echo __d('baser_core', 'Twitter IDが入力されていれば、選択されたTwitter Cardが反映されます。') ?></div>
      </td>
    </tr>
    <tr>
      <th class="bca-form-table__label">
        <?php echo $this->BcAdminForm->label('fb_app_id', __d('baser_core', 'facebook App-ID')) ?>
      </th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcAdminForm->control('fb_app_id', ['type' => 'text', 'size' => 35, 'maxlength' => 255]) ?>
        <i class="bca-icon--question-circle bca-help"></i>
        <?php echo $this->BcAdminForm->error('fb_app_id') ?>
        <div class="bca-helptext">
          <?php echo __d('baser_core', 'facebookはApp-IDを入力することを推奨している。Facebookで開発者（デベロッパー）登録し、取得したApp-IDを記述します。App-IDを取得するにはFacebookにログイン後、「すべてのアプリ – 開発者向けFacebook」ページにアクセスし、「新しいアプリを追加」します。新しいアプリを追加し、もろもろ設定することで、App-IDが取得できます。') ?>
        </div>
      </td>
    </tr>
    <tr>
      <th class="bca-form-table__label">
        <?php echo $this->BcAdminForm->label('default_image', __d('baser_core', 'Default Image')) ?>
      </th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcAdminForm->control('default_image', ['type' => 'text', 'size' => 35, 'maxlength' => 255]) ?>
        <i class="bca-icon--question-circle bca-help"></i>
        <?php echo $this->BcAdminForm->error('default_image') ?>
        <div class="bca-helptext"><?php echo __d('baser_core', 'アイキャッチがない場合に代替する画像のファイル名。( app/webroot/テーマ名/img/ ) or ( app/webroot/img/ )デフォルトイメージはどちらかのディレクトに入れてください。') ?></div>
      </td>
    </tr>
    <tr>
      <th class="bca-form-table__label">
        <?php echo $this->BcAdminForm->label('locale', __d('baser_core', 'locale')) ?>
      </th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcAdminForm->control('locale', ['type' => 'text', 'size' => 35, 'maxlength' => 255]) ?>
        <i class="bca-icon--question-circle bca-help"></i>
        <?php echo $this->BcAdminForm->error('locale') ?>
      </td>
    </tr>
    <tr>
      <th class="bca-form-table__label">
        <?php echo $this->BcAdminForm->label('locale_alternate', __d('baser_core', 'locale_alternate')) ?>
      </th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcAdminForm->control('locale_alternate', ['type' => 'text', 'size' => 35, 'maxlength' => 255]) ?>
        <i class="bca-icon--question-circle bca-help"></i>
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