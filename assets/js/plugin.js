import dayjs from 'dayjs';

jQuery(document).ready(($) => {
  const timestamp = $('.timestamp-wrap .save-timestamp');

  if (!timestamp.length) {
    return;
  }

  timestamp.after(
    $('<a>')
      .css({
        display: 'flex',
        float: 'right',
        minHeight: '28px',
        cursor: 'pointer',
        alignItems: 'center',
        textDecoration: 'none',
      })
      .attr({
        href: '#reset_timestamp',
        class: 'reset-timestamp hide-if-no-js',
      })
      .html('<span class="dashicons dashicons-update"></span>')
  );

  $('.reset-timestamp').bind('click', (event) => {
    event.preventDefault();

    const time = dayjs();

    if ($('select[name="mm"]').length > 0) {
      $('select[name="mm"]').val(time.format('MM'));
    }

    if ($('input[name="jj"]').length > 0) {
      $('input[name="jj"]').val(time.format('DD'));
    }

    if ($('input[name="aa"]').length > 0) {
      $('input[name="aa"]').val(time.format('YYYY'));
    }

    if ($('input[name="hh"]').length > 0) {
      $('input[name="hh"]').val(time.format('HH'));
    }

    if ($('input[name="mn"]').length > 0) {
      $('input[name="mn"]').val(time.format('mm'));
    }
  });
});
