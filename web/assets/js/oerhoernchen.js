/* general functions */


// console.log fallback
if (typeof console === 'undefined') {
  window.console = {
    log: function() {}
  };
}

// functions 
// https://www.creativejuiz.fr/blog/en/javascript-en/read-url-get-parameters-with-javascript
function $_GET(param) {
  var vars = {};
  window.location.href.replace(location.hash, '').replace(
    /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
    function(m, key, value) { // callback
      vars[key] = value !== undefined ? value : '';
    }
  );

  if (param) {
    return vars[param] ? vars[param] : null;
  }
  return vars;
}

$(document).ready(function() {

  $('[data-toggle="tooltip"]').tooltip();

  // toogle action for license filter, dynamic content event
  $("body").on('click', "a.card-body-toggle", function(e) {
    e.preventDefault();
    $(this).parent().toggleClass("toggled");
    $(this).parent().parent().find('.card-body:first').toggle();
  });

  // license filter is used on multiple subpages - do not remove from here!

  /* LICENSE FILTER EVENTS */
  // listen for select change events

  // check if GET parameter has license filter
  var license_filter_val_param = $_GET('license_filter_val');
  if (license_filter_val_param !== null) {
    console.log($('select[name="license-filter"] > option[value="' + license_filter_val_param + '"]'));
    $('select[name="license-filter"] > option[value="' + license_filter_val_param + '"]').prop('selected', true);
    $('select[name="license-filter"]').trigger('change');

  }

  // license filter explanation
  $('body').on('change','select[name="license-filter"], select[name="web-search-license-filter"], select[name="media-search-license-filter"]',function() {
    console.log('license filter changed');
    var val = $(this).find(':selected').val();
    var explanation_div = $(this).parent().parent().find('div.license-explanation:first');
    console.log('explanation_div',explanation_div,$(this).parent());
    var explanation_header_div = $(this).parent().parent().parent();
    console.log('explanation_header_div', explanation_header_div);
    $('div', explanation_div).hide();
    switch (val) {
      case 'only-oer':
        $('div[data-value="oer"]', explanation_div).show();
        $("span.license-filter-heading", explanation_header_div).html("Lizenzfilter: OER - frei für alle Zwecke ✓");
        break;
      case 'nc':
        $('div[data-value="oer"]', explanation_div).show();
        $('div[data-value="nc"]', explanation_div).show();
        $("span.license-filter-heading", explanation_header_div).html("Lizenzfilter: OER + NC-Inhalte");
        break;
      case 'nc-nd':
        $('div[data-value="oer"]', explanation_div).show();
        $('div[data-value="nc-nd"]', explanation_div).show();
        $("span.license-filter-heading", explanation_header_div).html("Lizenzfilter: OER + NC/ND-Inhalte");
        break;
      case 'no-filter':
        $('div[data-value="no-filter"]', explanation_div).show();
        $("span.license-filter-heading", explanation_header_div).html("Lizenzfilter: deaktiviert");
        break;
    }
  });
  $('select[name="license-filter"], select[name="web-search-license-filter"], select[name="media-search-license-filter"]').trigger('change');

});