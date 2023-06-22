import './bootstrap';
import * as storeUtils from './storeUtils.ts'

if (window.location.pathname.startsWith("/store/")) {
    window.storeUtils = storeUtils;
}
