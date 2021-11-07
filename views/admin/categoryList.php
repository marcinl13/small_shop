<div style="padding-right: 3rem; margin-top: 3rem;">
  <div x-data="{categories: []}"
    x-init="fetch('<?php echo get_rest_url(null, SmallShopCategories::ROUTE_LIST); ?>').then(res => res.json()).then(res =>{categories = res;})">

    <table class="sm-shop-table sm-shop-table-grid-categories">
      <thead>
        <th><?php echo SmallShopTranslation::translate('Category_name'); ?></th>
        <th></th>
      </thead>
      <tbody>
        <template x-for="category in categories" :key="category.id">
          <tr>
            <td x-text="category.name"></td>
            <td class="sm-shop-center">
              <figure class="sm-shop-icon" x-on:click="edtCategory(category.id)" class="sm-shop-action" data-tooltip="<?php echo SmallShopTranslation::translate('Category_edit'); ?>">
                <?php echo SmallShopIcon::edit(); ?>
              </figure>

              <figure class="sm-shop-icon" x-on:click="delCategory(category.id)" class="sm-shop-action" data-tooltip="<?php echo SmallShopTranslation::translate('Category_delete'); ?>">
                <?php echo SmallShopIcon::delete(); ?>
              </figure>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>

  <div x-data="{ newCat: '' }">
    <input type="text" x-model="newCat" id="name" name="name" placeholder="<?php echo SmallShopTranslation::translate('Category_add'); ?>">
    <figure class="sm-shop-icon" x-on:click="addCategory(newCat)" class="sm-shop-action" data-tooltip="<?php echo SmallShopTranslation::translate('Category_add'); ?>">
      <?php echo SmallShopIcon::add(); ?>
    </figure>
  </div>
</div>

<script>
  function addCategory(newCategoryName) {
    fetch('<?php echo get_rest_url(null, SmallShopCategories::ROUTE_ADD); ?>', {
      method: 'POST',
      body: JSON.stringify({ name: newCategoryName })
    })
      .then(res => {
        console.log(res);
        Swal.fire('', 'You clicked the button!', 'success');
      })
  }

  function delCategory(categoyId) {
    fetch('<?php echo get_rest_url(null, SmallShopCategories::ROUTE_DELETE); ?>', {
      method: 'DELETE',
      body: JSON.stringify({ id: categoyId })
    })
      .then(res => { console.log(res); })
  }

  function edtCategory(categoyId) {
    console.log('edtCategory', categoyId)
  }
</script>