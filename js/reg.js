let submit = document.querySelector('#submit')
let eyes = document.querySelectorAll('.eye')
let inputs = document.querySelectorAll('input')
let phone = document.querySelector('#phone')
let password = document.querySelector('#password')
let form = document.querySelector('#form')

inputs.forEach(input => {
  input.addEventListener('keyup', e => {
    if (e.target.value != '') {
      e.target.parentElement.querySelector('label').classList.add("labelup")
    } else {
      e.target.parentElement.querySelector('label').classList.remove("labelup")
    }
    
  })
})

eyes.forEach(eye => {
  eye.addEventListener('click', e => {
    if (e.target.classList.contains('fa-eye')) {
      e.target.classList.remove('fa-eye')
      e.target.classList.add('fa-eye-slash')
      e.target.parentElement.querySelector('input').setAttribute("type", "text")
    } else {
      e.target.classList.add('fa-eye')
      e.target.classList.remove('fa-eye-slash')
      e.target.parentElement.querySelector('input').setAttribute("type", "password")
    }
    
  })
})

submit.addEventListener('click', e => {
  if (e.target.classList.contains('signup')) {
    let name = document.querySelector('#name')
    let c_password = document.querySelector('#c-password')
    if (name.value == '') {
      alert('Invalid name')
    } else {
      if (phone.value == '') {
        alert('Invalid phone')
      } else {
        if (password.value == '') {
          alert('Invalid password')
        } else {
          if (password.value.length < 8) {
            alert('Must have 8 passwords')
          } else {
            if (password.value == c_password.value) {
              submit.setAttribute("type", "submit")
              form.submit()
            } else {
              alert('Enter two passwords that match')
            }
          }
        }
      }
    }
  } else {
    if (phone.value == '') {
      alert('Invalid username or phone')
    } else {
      if (password.value == '') {
        alert('Invalid password')
      } else {
        submit.setAttribute("type", "submit")
        form.submit()
      }
    }
  }
})