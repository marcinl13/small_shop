<div
  x-cloak
  x-data="{endpoints: [], index: 0}"
  x-init="fetch('<?php echo get_rest_url(null, 'wp/v2/sm-shop'); ?>').then(res => res.json()).then(res => { endpoints = res.routes; index = 1; })" >
    <figure x-show="!endpoints.length">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background: none;display:block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
            <g transform="translate(50,50)"><circle cx="0" cy="0" r="8.333333333333334" fill="none" stroke="#e15b64" stroke-width="4" stroke-dasharray="26.179938779914945 26.179938779914945">
            <animateTransform attributeName="transform" type="rotate" values="0 0 0;360 0 0" times="0;1" dur="1s" calcMode="spline" keySplines="0.2 0 0.8 1" begin="0" repeatCount="indefinite"></animateTransform>
            </circle><circle cx="0" cy="0" r="16.666666666666668" fill="none" stroke="#f47e60" stroke-width="4" stroke-dasharray="52.35987755982989 52.35987755982989">
            <animateTransform attributeName="transform" type="rotate" values="0 0 0;360 0 0" times="0;1" dur="1s" calcMode="spline" keySplines="0.2 0 0.8 1" begin="-0.2" repeatCount="indefinite"></animateTransform>
            </circle><circle cx="0" cy="0" r="25" fill="none" stroke="#f8b26a" stroke-width="4" stroke-dasharray="78.53981633974483 78.53981633974483">
            <animateTransform attributeName="transform" type="rotate" values="0 0 0;360 0 0" times="0;1" dur="1s" calcMode="spline" keySplines="0.2 0 0.8 1" begin="-0.4" repeatCount="indefinite"></animateTransform>
            </circle><circle cx="0" cy="0" r="33.333333333333336" fill="none" stroke="#abbd81" stroke-width="4" stroke-dasharray="104.71975511965978 104.71975511965978">
            <animateTransform attributeName="transform" type="rotate" values="0 0 0;360 0 0" times="0;1" dur="1s" calcMode="spline" keySplines="0.2 0 0.8 1" begin="-0.6" repeatCount="indefinite"></animateTransform>
            </circle><circle cx="0" cy="0" r="41.666666666666664" fill="none" stroke="#849b87" stroke-width="4" stroke-dasharray="130.89969389957471 130.89969389957471">
            <animateTransform attributeName="transform" type="rotate" values="0 0 0;360 0 0" times="0;1" dur="1s" calcMode="spline" keySplines="0.2 0 0.8 1" begin="-0.8" repeatCount="indefinite"></animateTransform>
            </circle></g>
        </svg>
    </figure>

    <table x-show="endpoints" class="sm-shop-table-grid">
      <thead>
        <tr>
          <th>Lp.</th>
          <th>Methods</th>
          <th>Endpoint</th>
        </tr>
      </thead>
      <tbody>
        <template x-for="(details, endpoint) in endpoints" :key="endpoint">
          <tr>
            <td x-text="index++"></td>
            <td class="text-center" x-text="details?.methods?.join(', ')"></td>
            <td x-text="endpoint">
              <!-- <a x-bind:href="endpoint" x-text="endpoint"></a> -->
            </td>
          </tr>
        </template>
      </tbody> 
    </table>
</div>