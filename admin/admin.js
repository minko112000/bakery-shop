let preview
let orders_arr
let dashboard_actions = document.querySelectorAll('.dashboard-action')
let pages = document.querySelectorAll('.page')
let product_file = document.querySelector('.product-file')
let upload_img_btn = document.querySelector('#upload-img')
let form = document.querySelector('#form')
let categories_value = document.querySelector('#categories-value')
let price_value = document.querySelector('#price-value')
let title_value = document.querySelector('#title-value')
let des_value = document.querySelector('#des-value')
let upload_product_btn = document.querySelector('#upload-product')
let users_container = document.querySelector('#users-container')
let orders_page = document.querySelector('#Orders-page')
let details_page = document.querySelector('#details-page')
let backs = document.querySelectorAll('.page .bar i')

const orderDetails = id => {
  for (let i = 0; i < orders_arr.length; i++) {
    if (orders_arr[i].id == id) {
      details_page.querySelector('.name-div').innerHTML = orders_arr[i].name
      details_page.querySelector('.phone-div').innerHTML = orders_arr[i].phone
      details_page.querySelector('.price-div').innerHTML = orders_arr[i].price + ' Ks'
      details_page.querySelector('.products-div').innerHTML = orders_arr[i].products
      details_page.querySelector('.address-div').innerHTML = orders_arr[i].address
    }
  }
}

const orders = (id, action = 'get') => {
  const AJAX = new XMLHttpRequest();
  AJAX.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (action == 'del') {
        if (this.responseText == 'ok') {
          alert('Success')
        } else {
          alert('Something wrong')
        }
      } else {
        orders_page.querySelector('.tb-wrapper').innerHTML = ''
        orders_arr = JSON.parse(this.responseText)
        for (let i = 0; i < orders_arr.length; i++) {
           orders_page.querySelector('.tb-wrapper').innerHTML += `
           <div class="c tb-row text-dark ttsh">
              <b class="c">${orders_arr[i].name}</b>
              <b class="c">${orders_arr[i].phone}</b>
              <b class="c">${orders_arr[i].price}</b>
              <b class="c">
                <i id="${orders_arr[i].id}" class="text-danger fa-solid fa-trash me-2"></i>|
                <i id="${orders_arr[i].id}" class="text-info details-order fa-solid fa-eye ms-2"></i>
              </b>
            </div>
           `
        }
        let details_orders = document.querySelectorAll('.details-order')
        details_orders.forEach(details_order => {
          details_order.addEventListener('click', function (e) {
            details_page.classList.remove('d-none')
            let id = e.target.getAttribute('id')
            orderDetails(id)
          })
        })
      }
    }
  };
  AJAX.open("GET", `orders.php?id=${id}&action=${action}`);
  AJAX.send();
}
orders(0)

const users = () => {
  const AJAX = new XMLHttpRequest();
      AJAX.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          let users = JSON.parse(this.responseText)
          for (let i = 0; i < users.length; i++) {
            users_container.innerHTML += `
            <div id="users-container" class="c tb-row text-dark ttsh">
              <b class="c">${(users.length - users[i].id) + 1}</b>
              <b class="c">${users[i].name}</b>
              <b class="c">${users[i].phone}</b>
              <b class="c">${users[i].status}</b>
            </div>
            `
          }
      }
    };
    AJAX.open("GET", "users.php");
    AJAX.send();
}
users()

backs.forEach(back => {
  back.addEventListener('click', function () {
    this.parentElement.parentElement.classList.add('d-none')
  })
})

dashboard_actions.forEach(dashboard_action => {
  dashboard_action.addEventListener('click', e => {
    pages.forEach(page => {
      page.classList.add('d-none')
    })
    let id = `${e.target.text}-page`
    let show_page = document.querySelector(`#${id}`)
    show_page.classList.remove('d-none')
  })
})

upload_img_btn.addEventListener('click', () => {
  product_file.click()
})

product_file.addEventListener('change', () => {
  var reader = new FileReader();
  reader.onload = function(){
    upload_img_btn.innerHTML = ""
    preview = document.createElement('img')
    upload_img_btn.append(preview)
    preview.src = reader.result
  };
  reader.readAsDataURL(event.target.files[0]);
})

upload_product_btn.addEventListener('click', () => {
  if (preview == undefined) {
    alert('Invalid image file')
  } else {
    if (categories_value.value == '') {
      alert('Invalid categories')
    } else {
      if (price_value.value <= 0) {
        alert('Invalid price')
      } else {
        if (title_value.value == '') {
          alert('Invalid title')
        } else {
          if (des_value.value == '') {
            alert('Invalid description')
          } else {
            upload_product_btn.setAttribute("type", "submit")
            form.submit()
          }
        }
      }
    }
  }
})