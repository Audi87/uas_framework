import './bootstrap';
import Swal from 'sweetalert2'

// or via CommonJS
const Swal = require('sweetalert2')
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'

Swal.fire({
    title: 'Error!',
    text: 'Do you want to continue',
    icon: 'error',
    confirmButtonText: 'Cool'
  })
