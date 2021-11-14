<div style="padding-right: 3rem; margin-top: 3rem">
  <div x-data="getData()" x-init="fetchData()">
    <div class="sm-shop-filters">

      <select name="perPage" id="perPage">
        <template x-for="option in perPage.options">
          <option :value="option" x-text="option" x-on:click="updateAmountShownRows(option)"></option>
        </template>
      </select>

      <input type="text" id="search" name="search" placeholder="<?php echo SmallShopTranslation::translate('Search'); ?>" x-model="searchValue" x-on:keyup.enter="fetchData()">

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
              <figure class="sm-shop-icon" x-on:click="edtCategory(category.id, category.name)"
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
      <tfoot>
        <tr x-show="categories.length == 0">
          <td colspan="2" style="text-align: center;"><?php echo SmallShopTranslation::translate('No results'); ?>.</td>
        </tr>
      </tfoot>
    </table>

    <div class="sm-shop-paginate">
      <button class="pagi" x-on:click="changePage('prev')" :disabled="page == 1"><</button>
      <span x-html="page + ' of ' + lastPage"></span>
      <button class="pagi" x-on:click="changePage('next')" :disabled="lastPage == page">></button>
    </div>
  </div>
</div>

<script type="text/javascript">
  function getData() {
    return {
      searchValue: "",
      isLoading: false,

      categories: [],
      newCategory: null,

      page: 1,
      lastPage: 1,
      perPage: {
        selected: 5,
        options: [5, 10, 15, 20],
      },

      fetchData() {
        this.isLoading = true;

        let prepareUrl = new URL("<?php echo get_rest_url(null, SmallShopCategories::ROUTE_LIST); ?>");
        let params = prepareUrl.searchParams;
        params.append("q", this.searchValue);
        params.append("perPage", this.perPage.selected);
        params.append("page", this.page);

        fetch(prepareUrl.toString())
          .then((res) => res.json())
          .then((data) => {
            this.isLoading = false;
            
            this.categories = data.result;

            this.page = data.page;
            this.lastPage = data.last;
          });
      },
      updateAmountShownRows(_amount) {
        if (!this.perPage.options.includes(_amount)) {
          this.page = 1;
          this.perPage.selected = this.perPage.options[0];
          this.fetchData();
          return;
        }

        this.page = 1;
        this.perPage.selected = _amount;
        this.fetchData();
      },
      changePage(_page) {
        switch (_page) {
          case 'next':
            this.page += 1;
            this.fetchData();
            break;
          case 'prev':
            this.page -= 1;
            this.fetchData();
            break;
          default:
            this.page = 1;
            this.fetchData();
            break;
        }
      },

      addCategory() {
        Swal.fire({
          title: "<?php echo SmallShopTranslation::translate('Category_add'); ?>",
          input: "text",
          showCancelButton: true,
          confirmButtonColor: '#ff4500',
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
      delCategory(_categoyId) {
        Swal.fire({
          title: "<?php echo SmallShopTranslation::translate('Are you sure?'); ?>",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "<?php echo SmallShopTranslation::translate('Yes'); ?>",
          cancelButtonText: "<?php echo SmallShopTranslation::translate('No'); ?>",
          confirmButtonColor: '#ff4500',
        }).then((result) => {
          if (result.isConfirmed) {
            fetch("<?php echo get_rest_url(null, SmallShopCategories::ROUTE_DELETE); ?>", {
              method: "DELETE",
              body: JSON.stringify({ id: _categoyId }),
            }).then((res) => {
              // console.log(res);

              //refresh list
              this.fetchData();
            });
          }
        });
      },
      edtCategory(_categoyId, _val) {
        Swal.fire({
          title: "<?php echo SmallShopTranslation::translate('Category_edit'); ?>",
          input: "text",
          inputValue: _val,
          showCancelButton: true,
          confirmButtonColor: '#ff4500',
          confirmButtonText: "<?php echo SmallShopTranslation::translate('Category_edit'); ?>",
          showLoaderOnConfirm: true,
          inputValidator: (value) => {
            if (!value) {
              return "You need to write something!";
            }
          },
          preConfirm: (newName) => {
            return fetch("<?php echo get_rest_url(null, SmallShopCategories::ROUTE_UPDATE); ?>" + `/${_categoyId}`, {
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