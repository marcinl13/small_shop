<div style="padding-right: 3rem; margin-top: 3rem;">
  <div x-data="getData()" x-init="fetchData()">

    <div>
      <input type="text" x-model="newCategory" id="name" name="name" placeholder="<?php echo SmallShopTranslation::translate('Category_add'); ?>">
      <figure class="sm-shop-icon" x-on:click="addCategory()"
        data-tooltip="<?php echo SmallShopTranslation::translate('Category_add'); ?>">
        <?php echo SmallShopIcon::add() ?>
      </figure>
    </div>

    <table class="sm-shop-table sm-shop-table-grid-categories">
      <thead>
        <th>
          <?php echo SmallShopTranslation::translate('Category_name'); ?>
        </th>
        <th></th>
      </thead>
      <tbody>
        <template x-for="category in categories" :key="category.id">
          <tr>
            <td x-text="category.name"></td>
            <td class="sm-shop-center">
              <figure class="sm-shop-icon" x-on:click="edtCategory(category.id)"
                data-tooltip="<?php echo SmallShopTranslation::translate('Category_edit'); ?>">
                <?php echo SmallShopIcon::edit() ?>
              </figure>

              <figure class="sm-shop-icon" x-on:click="delCategory(category.id)"
                data-tooltip="<?php echo SmallShopTranslation::translate('Category_delete'); ?>">
                <?php echo SmallShopIcon::delete() ?>
              </figure>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</div>


<script type="text/javascript">
  function getData() {
    return {
      searchValue: '',
      page: 1,
      limit: 10,
      total: 50,
      isLoading: false,
      categories: null,
      newCategory: null,

      fetchData(page = this.page) {
        this.page = page
        this.isLoading = true;

        fetch('<?php echo get_rest_url(null, SmallShopCategories::ROUTE_LIST); ?>')
          .then((res) => res.json())
          .then((data) => {
            this.isLoading = false;
            this.categories = data;
          });
      },
      addCategory() {
        if (!this.newCategory) {
          Swal.fire('', 'empty', 'warning');
          return;
        }

        fetch('<?php echo get_rest_url(null, SmallShopCategories::ROUTE_ADD); ?>', {
          method: 'POST',
          body: JSON.stringify({ name: this.newCategory })
        })
          .then(res => {
            console.log(res);
            Swal.fire('', 'You clicked the button!', 'success');
          })
      },
      delCategory(categoyId) {
        fetch('<?php echo get_rest_url(null, SmallShopCategories::ROUTE_DELETE); ?>', {
          method: 'DELETE',
          body: JSON.stringify({ id: categoyId })
        })
          .then(res => { console.log(res); })
      },
      edtCategory(categoyId) {
        console.log('edtCategory', categoyId)
      }
    };
  }
</script>