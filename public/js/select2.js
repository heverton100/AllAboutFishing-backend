(function($) {
  'use strict';
  if ($(".js-service-basic-multiple").length) {
    $(".js-service-basic-multiple").select2({
      placeholder: "Services",
      allowClear: true
    });
  }

  if ($(".js-fish-basic-multiple").length) {
    $(".js-fish-basic-multiple").select2({
      placeholder: "Fishes",
      allowClear: true
    });
  }
})(jQuery);