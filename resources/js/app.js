import '@tabler/core';
import './bootstrap';
import Alpine from 'alpinejs';

Alpine.data('createUser', () => ({
  role: 'admin',
  showCustomerDataForm: false,

  init() {
    this.$watch('role', () => {
      this.showCustomerDataForm = this.role === 'customer';
    })
  },
}));

Alpine.data('createCustomer', () => ({
  createUser: null,

  init() {
    this.$watch('createUser', () => {
      console.log(this.createUser);
    })
  },
}));

Alpine.data('indexCustomer', () => ({
  deleteUrl: '',
  confirmDelete(event) {
    this.deleteUrl = event.target.href
  },
}))

Alpine.data('indexUser', () => ({
  deleteUrl: '',
  confirmDelete(event) {
    this.deleteUrl = event.target.href
  },
}))

Alpine.data('indexCar', () => ({
  deleteUrl: '',
  confirmDelete(event) {
    this.deleteUrl = event.target.href
  },
}))

Alpine.data('indexBrand', () => ({
  logoUrl: '',
  deleteUrl: '',

  confirmDelete(event) {
    this.deleteUrl = event.target.href
  },

  clearPreview() {
    this.logoUrl = '';
  },

  showLogoPreview(event) {
    this.logoUrl = '';

    if (!event.target.files.length) {
      return;
    }

    const reader = new FileReader();

    reader.readAsDataURL(event.target.files[0]);
    reader.onload = (e) => {
      this.logoUrl = e.target.result;
    }
  }
}))

Alpine.start()
