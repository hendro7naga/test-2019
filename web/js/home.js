(function () {
    'use strict';
    let elModalEdit     = document.querySelector('#modaledit'),
        modaledit       = undefined,
        btnEdit         = document.querySelector('#btn-edit'),
        handleEdit      = function (event) {
            event.stopPropagation();
        },
        modaleditOpen   = function () {};
    document.addEventListener('DOMContentLoaded', function () {
        modaledit   = M.Modal.init(elModalEdit, {onOpenStart: modaleditOpen, dismissible: false});
    });
})();