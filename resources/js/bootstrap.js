import Alpine from 'alpinejs';
import axios from 'axios';
import IMask from 'imask';
import Litepicker from 'litepicker';
import TomSelect from 'tom-select';

window.Alpine = Alpine;
window.axios = axios;
window.IMask = IMask;
window.Litepicker = Litepicker;
window.TomSelect = TomSelect;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
