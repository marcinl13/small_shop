<div style="padding-right: 3rem; margin-top: 3rem;">
  <div x-data="{categories: []}"
    x-init="fetch('<?php echo get_rest_url(null, SmallShopCategories::ROUTE_LIST); ?>').then(res => res.json()).then(res =>{categories = res;})">

    <table class="sm-shop-table sm-shop-table-grid-categories">
      <thead>
        <th>name</th>
        <th></th>
      </thead>
      <tbody>
        <template x-for="category in categories" :key="category.id">
          <tr>
            <td x-text="category.name"></td>
            <td class="sm-shop-center">
              <figure x-on:click="edtCategory(category.id)" class="sm-shop-action" data-tooltip="Edit category">
                <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="16px" height="16px">
                  <path
                    d="M 22.828125 3 C 22.316375 3 21.804562 3.1954375 21.414062 3.5859375 L 19 6 L 24 11 L 26.414062 8.5859375 C 27.195062 7.8049375 27.195062 6.5388125 26.414062 5.7578125 L 24.242188 3.5859375 C 23.851688 3.1954375 23.339875 3 22.828125 3 z M 17 8 L 5.2597656 19.740234 C 5.2597656 19.740234 6.1775313 19.658 6.5195312 20 C 6.8615312 20.342 6.58 22.58 7 23 C 7.42 23.42 9.6438906 23.124359 9.9628906 23.443359 C 10.281891 23.762359 10.259766 24.740234 10.259766 24.740234 L 22 13 L 17 8 z M 4 23 L 3.0566406 25.671875 A 1 1 0 0 0 3 26 A 1 1 0 0 0 4 27 A 1 1 0 0 0 4.328125 26.943359 A 1 1 0 0 0 4.3378906 26.939453 L 4.3632812 26.931641 A 1 1 0 0 0 4.3691406 26.927734 L 7 26 L 5.5 24.5 L 4 23 z" />
                </svg>
              </figure>

              <figure x-on:click="delCategory(category.id)" class="sm-shop-action" data-tooltip="Delete category">
                <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16px" height="16px">
                  <path
                    d="M 10 2 L 9 3 L 5 3 C 4.4 3 4 3.4 4 4 C 4 4.6 4.4 5 5 5 L 7 5 L 17 5 L 19 5 C 19.6 5 20 4.6 20 4 C 20 3.4 19.6 3 19 3 L 15 3 L 14 2 L 10 2 z M 5 7 L 5 20 C 5 21.1 5.9 22 7 22 L 17 22 C 18.1 22 19 21.1 19 20 L 19 7 L 5 7 z M 9 9 C 9.6 9 10 9.4 10 10 L 10 19 C 10 19.6 9.6 20 9 20 C 8.4 20 8 19.6 8 19 L 8 10 C 8 9.4 8.4 9 9 9 z M 15 9 C 15.6 9 16 9.4 16 10 L 16 19 C 16 19.6 15.6 20 15 20 C 14.4 20 14 19.6 14 19 L 14 10 C 14 9.4 14.4 9 15 9 z" />
                </svg>
              </figure>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>

  <div x-data="{ newCat: '' }">
    <label for="name">category name</label>
    <input type="text" x-model="newCat" id="name" name="name">

    <button x-on:click="addCategory(newCat)">Change Message</button>
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