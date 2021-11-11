<div style="padding-right: 3rem; margin-top: 3rem">
  <div x-data="getData()" x-init="fetchData()">
    <div class="sm-shop-filters">
      <figure class="sm-shop-icon" x-on:click="addCategory()"
        data-tooltip="<?php echo SmallShopTranslation::translate('Category_add'); ?>">
        <?php echo SmallShopIcon::add(SmallShopIconSize::ICON_24) ?>
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
      searchValue: "",
      page: 1,
      limit: 10,
      total: 50,
      isLoading: false,
      categories: null,
      newCategory: null,

      fetchData(page = this.page) {
        this.page = page;
        this.isLoading = true;

        fetch("<?php echo get_rest_url(null, SmallShopCategories::ROUTE_LIST); ?>")
          .then((res) => res.json())
          .then((data) => {
            this.isLoading = false;
            this.categories = data;
          });
      },
      addCategory() {
        Swal.fire({
          title: "<?php echo SmallShopTranslation::translate('Category_add'); ?>",
          input: "text",
          showCancelButton: true,
          confirmButtonText: "<?php echo SmallShopTranslation::translate('Category_add'); ?>",
          showLoaderOnConfirm: true,
          inputValidator: (value) => {
            if (!value) {
              return "You need to write something!";
            }
          },
          preConfirm: (newName) => {
            return fetch("<?php echo get_rest_url(null, SmallShopCategories::ROUTE_ADD); ?>", {
              method: "POST",
              body: JSON.stringify({ name: newName }),
            })
              .then((response) => {
                if (!response.ok) {
                  throw new Error(response.statusText);
                }

                return response.json();
              })
              .catch((error) => Swal.showValidationMessage(`Request failed: ${error}`));
          },
          allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
          if (result.isConfirmed) {
            //refresh list
            this.fetchData();
          }
        });
      },
      delCategory(categoyId) {
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          reverseButtons: true,
        }).then((result) => {
          if (result.isConfirmed) {
            fetch("<?php echo get_rest_url(null, SmallShopCategories::ROUTE_DELETE); ?>", {
              method: "DELETE",
              body: JSON.stringify({ id: categoyId }),
            }).then((res) => {
              // console.log(res);

              //refresh list
              this.fetchData();
            });
          }
        });
      },
      edtCategory(categoyId) {
        Swal.fire({
          title: "<?php echo SmallShopTranslation::translate('Category_edit'); ?>",
          input: "text",
          showCancelButton: true,
          confirmButtonText: "<?php echo SmallShopTranslation::translate('Category_edit'); ?>",
          showLoaderOnConfirm: true,
          inputValidator: (value) => {
            if (!value) {
              return "You need to write something!";
            }
          },
          preConfirm: (newName) => {
            return fetch("<?php echo get_rest_url(null, SmallShopCategories::ROUTE_UPDATE); ?>" + `/10`, {
              method: "PUT",
              body: JSON.stringify({ name: newName }),
            })
              .then((response) => {
                if (!response.ok) {
                  throw new Error(response.statusText);
                }

                return response.json();
              })
              .catch((error) => Swal.showValidationMessage(`Request failed: ${error}`));
          },
          allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
          if (result.isConfirmed) {
            //refresh list
            this.fetchData();
          }
        });
      },
    };
  }
</script>