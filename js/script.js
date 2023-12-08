let products
let total_products = ''
let total_price = 0

let add_address = document.querySelector('#add-address')
let add_address_page = document.querySelector('#add-address-page')
let buy_now = document.querySelector('#buy-now')
let Cart = document.querySelector('#cart')
let cart_page = document.querySelector('#cart-page')
let products_page = document.querySelector('#products-page')
let product_page = document.querySelector('#product-page')
let backs = document.querySelectorAll('.page .bar i')
let promotion_banner = document.querySelector('#promotion-banner')
let arrivals_banner = document.querySelector('#arrivals-banner')
let popular_banner = document.querySelector('#popular-banner')
let best_seller_banner = document.querySelector('#best-seller-banner')
let other_banner = document.querySelector('#other-banner')
let order_name = document.querySelector('#order-name')
let order_phone = document.querySelector('#order-phone')
let order_address = document.querySelector('#order-address')

const productBox = (img, title, price, des, id) => {
  return `
    <div class="p-2 product-box bg-light c shadow-sm me-3">
      <img class="shadow-sm" src="images/${img}">
      <div class="c mt-1 ttsh text-primary">
        <span>${price} Ks</span>
        <small>${title}</small>
        <small class="d-none">${des}</small>
        <div class="c action-row px-2 mt-2">
          <i id="${id}" class="fa-solid text-success fa-shopping-cart"></i>
          <i id="${id}" class="fa-solid text-info fa-eye view-details"></i>
        </div>
      </div>
    </div>
  `
}

const cartAction = (id, action = 'add') => {
  const AJAX = new XMLHttpRequest();
  AJAX.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (action == 'add') {
        if (this.responseText == 'ok') {
          alert('Success')
        } else {
          alert('Something wrong')
        }
      } else {
        cart_page.querySelector('.wrapper').innerHTML = ''
        let carts = JSON.parse(this.responseText)
        total_products = ''
        total_price = 0
        for (let i = 0; i < carts.length; i++) {
           total_price += parseInt(carts[i].price, 10)
           total_products += ', ' + carts[i].title
           cart_page.querySelector('.wrapper').innerHTML += `
           <div class="c mt-1 tb-row text-dark ttsh">
              <b class="c">
                <img class="shadow-sm" src="images/${carts[i].image}">
              </b>
              <b class="c">${carts[i].title}</b>
              <b class="c">${carts[i].price}</b>
            </div>
           `
        }
        if (total_price <= 0) {
          cart_page.querySelector('#order-bar').classList.add('d-none')
        } else {
          cart_page.querySelector('#order-bar').classList.remove('d-none')
        }
        cart_page.querySelector('#order-bar div span b').innerHTML = total_price + ' Ks'
      }
    }
  };
  AJAX.open("GET", `server/cart.php?id=${id}&action=${action}`);
  AJAX.send();
}

const moreProductBox = cat => {
  return `
  <div id="${cat}" class="p-2 pointer to-products product-box bg-light c shadow-sm me-3">
    <h1 class="text-primary ttsh">+</h1>
    <h3 class="text-primary mt-2 ttsh">More</h3>
  </div>
  `
}

const productPageShow = id => {
  for (let i = 0; i < products.length; i++) {
    if (products[i].id == id) {
      product_page.querySelector('.bar b').innerHTML = products[i].title
      product_page.querySelector('img').setAttribute('src', `images/${products[i].image}`)
      product_page.querySelector('h3').innerHTML = products[i].title
      product_page.querySelector('h2').innerHTML = products[i].price + ' Ks'
      product_page.querySelector('span').innerHTML = products[i].description
    }
  }
}

const actionButton = () => {
  let view_details = document.querySelectorAll('.view-details')
  let carts = document.querySelectorAll('.fa-shopping-cart')
  view_details.forEach(view_detail => {
    view_detail.addEventListener('click', function (e) {
      product_page.classList.remove('d-none')
      let id = e.target.getAttribute('id')
      productPageShow(id)
    })
  })
  carts.forEach(cart => {
    cart.addEventListener('click', function (e) {
      let id = e.target.getAttribute('id')
      cartAction(id)
    })
  })
}

const productsPageShow = cat => {
  products_page.querySelector('.wrapper').innerHTML = ''
  products_page.querySelector('.bar b').innerHTML = cat.replace('more-', '').toUpperCase() + ' PRODUCTS';
  let category = cat.replace('more-', '')
  for (let i = 0; i < products.length; i++) {
    if (products[i].category == category) {
      products_page.querySelector('.wrapper').innerHTML += productBox(products[i].image, products[i].title, products[i].price, products[i].description, products[i].id)
    }
  }
  actionButton()
}

const getProducts = () => {
  const AJAX = new XMLHttpRequest();
    AJAX.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          products = JSON.parse(this.responseText)
          let promotion_count = 0
          let arrivals_count = 0
          let popular_count = 0
          let best_count = 0
          let other_count = 0
          for (let i = 0; i < products.length; i++) {
            if (promotion_count <= 7 && products[i].category == 'promotion') {
              promotion_banner.innerHTML += productBox(products[i].image, products[i].title, products[i].price, products[i].description, products[i].id)
              promotion_count += 1
            }
            if (arrivals_count <= 7 && products[i].category == 'arrivals') {
              arrivals_banner.innerHTML += productBox(products[i].image, products[i].title, products[i].price, products[i].description, products[i].id)
              arrivals_count += 1
            }
            if (popular_count <= 7 && products[i].category == 'popular') {
              popular_banner.innerHTML += productBox(products[i].image, products[i].title, products[i].price, products[i].description, products[i].id)
              popular_count += 1
            }
            if (best_count <= 7 && products[i].category == 'best') {
              best_seller_banner.innerHTML += productBox(products[i].image, products[i].title, products[i].price, products[i].description, products[i].id)
              best_count += 1
            }
            if (other_count <= 7 && products[i].category == 'other') {
              other_banner.innerHTML += productBox(products[i].image, products[i].title, products[i].price, products[i].description, products[i].id)
              other_count += 1
            }
          }
          promotion_banner.innerHTML += moreProductBox('more-promotion')
          arrivals_banner.innerHTML += moreProductBox('more-arrivals')
          popular_banner.innerHTML += moreProductBox('more-popular')
          best_seller_banner.innerHTML += moreProductBox('more-best')
          other_banner.innerHTML += moreProductBox('more-other')
          
          let to_products = document.querySelectorAll('.to-products')
          to_products.forEach(to_product => {
            to_product.addEventListener('click', function (e) {
              products_page.classList.remove('d-none')
              let id = e.target.getAttribute('id')
              productsPageShow(id)
            })
          })
          actionButton()
      }
    };
    AJAX.open("GET", "server/products.php");
    AJAX.send();
}
getProducts()

backs.forEach(back => {
  back.addEventListener('click', function () {
    this.parentElement.parentElement.classList.add('d-none')
  })
})

Cart.addEventListener('click', () => {
  cart_page.classList.remove('d-none')
  cartAction('', 'get')
})

add_address.addEventListener('click', () => {
  add_address_page.classList.remove('d-none')
})

buy_now.addEventListener('click', () => {
  if (order_name.value == '') {
    alert('Invalid name')
  } else {
    if (order_phone.value == '') {
      alert('Invalid phone')
    } else {
      if (order_address.value == '') {
        alert('Invalid address')
      } else {
        /*let order_form = document.querySelector('#order-form')
        let data = {
          action: 'add',
          name: order_name.value,
          phone: order_phone.value,
          address: order_address.value,
          products: total_products.slice(2, total_products.length),
          price: total_price
        }
        const AJAX = new XMLHttpRequest();
        AJAX.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText)
          }
        };
        AJAX.open("POST", "server/orders.php");
        AJAX.send(data);
        */
        document.querySelector('#order-price').value = total_price
        document.querySelector('#order-products').value = total_products.slice(2, total_products.length)
        buy_now.setAttribute("type", "submit")
        order_form.submit()
      }
    }
  }
})