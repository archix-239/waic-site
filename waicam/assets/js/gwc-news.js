(function ($) {
  'use strict';

  const config = window.gwcNewsVars || {};
  const labels = config.labels || {};

  $('#gwc-load-more').on('click', function () {
    const button = $(this);
    const list = $('#gwc-news-list');
    const page = parseInt(button.attr('data-page'), 10) || 2;

    $.ajax({
      url: config.ajax_url,
      type: 'post',
      dataType: 'json',
      data: {
        action: 'gwc_load_more_posts',
        nonce: config.nonce,
        paged: page
      },
      beforeSend: function () {
        button.prop('disabled', true).addClass('is-loading').find('span').text(labels.loading || 'Loading…');
      },
      success: function (response) {
        const data = response && response.data ? response.data : {};

        if (response && response.success && data.html && data.html.trim() !== '') {
          list.append(data.html);
          button.attr('data-page', page + 1);

          if (data.has_more) {
            button.prop('disabled', false).removeClass('is-loading').find('span').text(labels.load_more || 'Load More');
          } else {
            button.prop('disabled', true).removeClass('is-loading').addClass('is-disabled').find('span').text(labels.no_more || 'No more posts');
          }
        } else {
          button.prop('disabled', true).removeClass('is-loading').addClass('is-disabled').find('span').text(labels.no_more || 'No more posts');
        }
      },
      error: function () {
        button.prop('disabled', true).removeClass('is-loading').addClass('is-disabled').find('span').text(labels.error || 'Error');
      }
    });
  });
})(jQuery);
